<?php

class Imagen {
    private $id;
    private $producto_id;
    private $imagen_url; // Cambié de 'url_imagen' a 'imagen_url' para consistencia
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

    public function getImagen_url() {
        return $this->imagen_url;
    }

    public function setImagen_url($imagen_url) {
        $this->imagen_url = $imagen_url;
        return $this;
    }

    // Obtener todas las imágenes de un producto
    public function obtenerImagenesProducto($producto_id) {
        $sql = "SELECT * FROM imagenes WHERE producto_id = ? ORDER BY id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $producto_id); // 'i' para integer
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        $imagenes = [];

        while ($img = $resultado->fetch_assoc()) {
            $imagenes[] = $img;
        }
        
        return $imagenes;
    }

    // Guardar nueva imagen para un producto
    public function guardar() {
        $sql = "INSERT INTO imagenes (producto_id, imagen_url) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $this->producto_id, $this->imagen_url); // 'i' para integer, 's' para string
        return $stmt->execute();
    }

    // Actualizar la URL de una imagen
    public function actualizar() {
        $sql = "UPDATE imagenes SET producto_id = ?, imagen_url = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isi", $this->producto_id, $this->imagen_url, $this->id); // 'i' para integer, 's' para string
        return $stmt->execute();
    }

    // Eliminar una imagen
    public function eliminar() {
        $sql = "DELETE FROM imagenes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $this->id); // 'i' para integer
        return $stmt->execute();
    }

    // Guardar imagen estáticamente
    public static function guardar_imagen($producto_id, $ruta_completa) {
        $db = Database::conexion();
        $sql = "INSERT INTO imagenes (producto_id, imagen_url) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("is", $producto_id, $ruta_completa); // 'i' para integer, 's' para string
        return $stmt->execute();
    }

    // Obtener imagen por ID
    public static function obtener_imagen_por_id($id) {
        $db = Database::conexion();
        $sql = "SELECT * FROM imagenes WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id); // 'i' para integer
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Eliminar imagen por ID
    public static function eliminar_imagen($id) {
        $db = Database::conexion();
        $sql = "DELETE FROM imagenes WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id); // 'i' para integer
        return $stmt->execute();
    }

    // Método para actualizar la imagen en la base de datos (con MySQLi)
    public static function actualizar_imagen($imagen_id, $producto_id, $imagen_url) {
        $db = Database::conexion();  // Estás obteniendo la conexión aquí
        $sql = "UPDATE imagenes SET imagen_url = ? WHERE id = ? AND producto_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $imagen_url, $imagen_id, $producto_id);  // 's' para string, 'i' para entero
        return $stmt->execute();
    }
    

}
?>
