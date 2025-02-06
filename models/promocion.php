<?php

class Promocion {
    private $id;
    private $producto_id;
    private $fecha_inicio;
    private $fecha_fin;
    private $descuento_porcentaje;
    private $activo;
    private $tipo_promocion_id; // Nuevo atributo para el tipo de promoción
    private $db;

    public function __construct() {
        $this->db = Database::conexion(); // Conexión a la base de datos
    }

    // Métodos Getter y Setter para cada propiedad

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getProducto_id() {
        return $this->producto_id;
    }

    public function setProducto_id($producto_id) {
        $this->producto_id = $producto_id;
        return $this;
    }

    public function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    public function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
        return $this;
    }

    public function getFecha_fin() {
        return $this->fecha_fin;
    }

    public function setFecha_fin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
        return $this;
    }

    public function getDescuento_porcentaje() {
        return $this->descuento_porcentaje;
    }

    public function setDescuento_porcentaje($descuento_porcentaje) {
        $this->descuento_porcentaje = $descuento_porcentaje;
        return $this;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
        return $this;
    }

    public function getTipo_promocion_id() {
        return $this->tipo_promocion_id;
    }

    public function setTipo_promocion_id($tipo_promocion_id) {
        $this->tipo_promocion_id = $tipo_promocion_id;
        return $this;
    }

    // Obtener todas las promociones activas
    public function obtenerPromociones() {
        $promociones = $this->db->query("SELECT * FROM promocion WHERE activo = 1 ORDER BY id DESC");
        return $promociones;
    }

    // Guardar nueva promoción
    public function guardar() {
        $sql = "INSERT INTO promocion 
                (producto_id, fecha_inicio, fecha_fin, descuento_porcentaje, activo, tipo_promocion_id) 
                VALUES ('{$this->getProducto_id()}', 
                        '{$this->getFecha_inicio()}', 
                        '{$this->getFecha_fin()}', 
                        '{$this->getDescuento_porcentaje()}', 
                        '{$this->getActivo()}', 
                        '{$this->getTipo_promocion_id()}')";

        $guardar = $this->db->query($sql);
        return $guardar ? true : false;
    }

    public function actualizar() {
        // Validar que los valores no sean nulos o vacíos
        if (empty($this->descuento_porcentaje) || empty($this->tipo_promocion_id)) {
            return false; // Si los campos están vacíos, no hacemos la actualización
        }
    
        // Sanitización de los valores (aunque el uso de consultas preparadas sería ideal para mayor seguridad)
        $fecha_inicio = $this->db->real_escape_string($this->fecha_inicio);
        $fecha_fin = $this->db->real_escape_string($this->fecha_fin);
        $descuento_porcentaje = $this->db->real_escape_string($this->descuento_porcentaje);
        $tipo_promocion_id = $this->db->real_escape_string($this->tipo_promocion_id);
        $activo = $this->db->real_escape_string($this->activo);
        $id = $this->db->real_escape_string($this->id);
    
        // Generar la consulta SQL
        $sql = "UPDATE promocion SET 
                    fecha_inicio = '{$fecha_inicio}', 
                    fecha_fin = '{$fecha_fin}', 
                    descuento_porcentaje = {$descuento_porcentaje}, 
                    tipo_promocion_id = {$tipo_promocion_id}, 
                    activo = {$activo} 
                WHERE id = {$id}";
    
        // Depuración: muestra la consulta antes de ejecutarla (solo para pruebas)
        // echo $sql;
        // exit();
    
        // Ejecutar la consulta
        $actualizar = $this->db->query($sql);
    
        // Retorna true si la actualización fue exitosa, de lo contrario false
        return $actualizar ? true : false;
    }
    

    // Desactivar promoción
    public function desactivar() {
        $sql = "UPDATE promocion SET activo = 0 WHERE id = '{$this->getId()}'";
        $desactivar = $this->db->query($sql);
        return $desactivar ? true : false;
    }

    // Obtener promociones activas para un producto específico
    public function obtenerPromocionesProducto($producto_id) {
        $fechaActual = date('Y-m-d');
        $sql = "SELECT * FROM promocion 
                WHERE producto_id = '{$producto_id}' 
                AND activo = 1 
                AND CURDATE() BETWEEN fecha_inicio AND IFNULL(fecha_fin, CURDATE()) 
                ORDER BY fecha_inicio DESC";

        $promociones = $this->db->query($sql);
        return $promociones;
    }

    public function eliminar() {
        // Asegúrate de que el ID esté bien sanitizado para evitar SQL Injection
        $id = $this->getId();  // Obtenemos el ID de la promoción a eliminar
    
        // Verificamos si el ID es un número válido (para evitar eliminar todas las filas)
        if (is_numeric($id)) {
            // Especificamos la eliminación solo de la promoción con ese ID
            $sql = "DELETE FROM promocion WHERE id = {$id}";  
            
            // Ejecutamos la consulta
            $eliminar = $this->db->query($sql);
            
            // Si la consulta fue exitosa, retornamos true
            return $eliminar ? true : false;
        }
    
        // Si no es un número válido, no ejecutamos la eliminación y retornamos false
        return false;
    }

    public function obtenerPorId($id) {
        $id = (int) $id;  // Aseguramos que el ID sea un número entero
        $sql = "SELECT * FROM promocion WHERE id = {$id} LIMIT 1";
        $promocion = $this->db->query($sql);
        
        // Si encontramos la promoción, la retornamos
        if ($promocion && $promocion->num_rows == 1) {
            return $promocion->fetch_object();
        }
        
        // Si no encontramos la promoción, retornamos null
        return null;
    }
    
    
}
?>
