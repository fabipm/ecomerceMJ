<?php

class TipoPromocion {
    private $id;
    private $nombre;
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

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    // Obtener todos los tipos de promoción
    public function obtenerTiposPromocion() {
        $sql = "SELECT * FROM tipo_promocion ORDER BY nombre ASC";
        $result = $this->db->query($sql);
        $tipos = [];
        while ($row = $result->fetch_object()) {
            $tipos[] = $row;
        }
        return $tipos;
    }

    // Guardar nuevo tipo de promoción
    public function guardar() {
        $sql = "INSERT INTO tipo_promocion (nombre) VALUES ('{$this->getNombre()}')";
        $guardar = $this->db->query($sql);
        return $guardar ? true : false;
    }

    // Actualizar tipo de promoción
    public function actualizar() {
        $sql = "UPDATE tipo_promocion SET nombre = '{$this->getNombre()}' WHERE id = '{$this->getId()}'";
        $actualizar = $this->db->query($sql);
        return $actualizar ? true : false;
    }

    // Eliminar tipo de promoción
    public function eliminar() {
        $sql = "DELETE FROM tipo_promocion WHERE id = '{$this->getId()}'";
        $eliminar = $this->db->query($sql);
        return $eliminar ? true : false;
    }
}
?>
