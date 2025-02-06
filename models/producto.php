<?php

class Producto {
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $descuento;
    private $fecha;
    private $imagen;
    private $color;  // Atributo para color
    private $db;

    public function __construct(){
        $this->db = Database::conexion();
    }

    /**
     * Obtener el valor de id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Establecer el valor de id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Obtener el valor de categoria_id
     */ 
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Establecer el valor de categoria_id
     *
     * @return  self
     */ 
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    /**
     * Obtener el valor de nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establecer el valor de nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    /**
     * Obtener el valor de descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Establecer el valor de descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    /**
     * Obtener el valor de precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Establecer el valor de precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    /**
     * Obtener el valor de stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Establecer el valor de stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    /**
     * Obtener el valor de descuento
     */ 
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Establecer el valor de descuento
     *
     * @return  self
     */ 
    public function setDescuento($descuento)
    {
        $this->descuento = $this->db->real_escape_string($descuento);

        return $this;
    }

    /**
     * Obtener el valor de fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Establecer el valor de fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Obtener el valor de imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Establecer el valor de imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Obtener el valor de color
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Establecer el valor de color
     *
     * @return  self
     */ 
    public function setColor($color) {
        $this->color = $this->db->real_escape_string($color);
        return $this;
    }

    /**
     * Obtener todos los productos de la base de datos
     */
    public function obtenerProductos(){
        $productos = $this->db->query("SELECT * FROM producto ORDER BY id DESC");
        return $productos;
    }

    /**
     * Guardar un nuevo producto en la base de datos
     */
    public function guardar(){
        $sql = "INSERT INTO producto (categoria_id, nombre, descripcion, precio, stock, descuento, fecha, imagen, color) 
                VALUES('{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', 
                       '{$this->getPrecio()}', '{$this->getStock()}', NULL, CURDATE(), '{$this->getImagen()}', '{$this->getColor()}')";
        $guardar = $this->db->query($sql);

        return $guardar ? true : false;
    }

    /**
     * Actualizar un producto existente
     */
    public function actualizar(){
        $sql = "UPDATE producto SET 
                categoria_id='{$this->getCategoria_id()}', 
                nombre='{$this->getNombre()}', 
                descripcion='{$this->getDescripcion()}', 
                precio='{$this->getPrecio()}', 
                stock='{$this->getStock()}', 
                color='{$this->getColor()}'";  // Agregar color

        // Actualizar imagen solo si se ha enviado una nueva imagen
        if($this->getImagen() != NULL) {
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id='{$this->getId()}'";
        $actualizar = $this->db->query($sql);

        return $actualizar ? true : false;
    }
    /**
    * Eliminar un producto de la base de datos
    */
   public function eliminar() {
       // Paso 1: Desvincular las características asociadas al producto
       $sql_update_caracteristicas = "UPDATE caracteristica SET producto_id = NULL WHERE producto_id = '{$this->getId()}'";
       $this->db->query($sql_update_caracteristicas);
   
       // Paso 2: Desvincular las promociones asociadas al producto
       $sql_update_promociones = "UPDATE promocion SET producto_id = NULL WHERE producto_id = '{$this->getId()}'";
       $this->db->query($sql_update_promociones);
   
       // Paso 3: Eliminar el producto
       $sql_delete = "DELETE FROM producto WHERE id = '{$this->getId()}'";
       $eliminar = $this->db->query($sql_delete);
   
       // Retornar si la eliminación fue exitosa
       return $eliminar ? true : false;
   }

    public function obtenerProductoActual(){
        $query = "SELECT 
                      p.*, 
                      c.sistema_operativo, 
                      c.ram, 
                      c.camara_posterior, 
                      c.camara_frontal, 
                      c.bateria, 
                      c.almacenamiento, 
                      c.pantalla, 
                      c.procesador, 
                      c.carga_rapida 
                  FROM 
                      producto p
                  LEFT JOIN 
                      caracteristica c 
                  ON 
                      p.id = c.producto_id
                  WHERE 
                      p.id = {$this->id}";
                      
        $producto = $this->db->query($query);
        return $producto->fetch_object();
    }
    

    public function obtenerAleatorio($limite){
        $productos = $this->db->query("SELECT * FROM producto ORDER BY RAND() LIMIT $limite");
        return $productos;
    }

    public function obtenerProductosPorCategoria(){
        $sql = "SELECT p.*, c.nombre AS 'nombreCategoria' FROM producto p "
                . "INNER JOIN categoria c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id={$this->getCategoria_id()} "
                . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }
    public function obtenerProductosEnPromocion() {
        // Consulta SQL para obtener productos que están en promoción
        $sql = "SELECT p.*, pr.descuento_porcentaje, pr.fecha_inicio, pr.fecha_fin
                FROM producto p
                JOIN promocion pr ON p.id = pr.producto_id
                WHERE pr.activo = 1 
                AND CURDATE() BETWEEN pr.fecha_inicio AND pr.fecha_fin
                ORDER BY p.id DESC";
    
        // Ejecutamos la consulta
        $productos = $this->db->query($sql);
    
        // Devolvemos los productos obtenidos
        return $productos;
    }
    

    public function obtenerImagenesAdicionales($producto_id) {
        $sql = "SELECT * FROM imagenes WHERE producto_id = '{$producto_id}'";
        $imagenes = $this->db->query($sql);
        
        $imagenes_adicionales = [];
        while ($imagen = $imagenes->fetch_object()) {
            $imagenes_adicionales[] = $imagen;
        }
        
        return $imagenes_adicionales;
    }
    
    

    
}
?>
