<?php

class Caracteristica {
    private $id;
    private $producto_id;
    private $sistema_operativo;
    private $ram;
    private $camara;
    private $bateria;
    private $almacenamiento;
    private $pantalla;
    private $procesador;
    private $carga_rapida;
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

    public function getSistema_operativo() {
        return $this->sistema_operativo;
    }

    public function setSistema_operativo($sistema_operativo) {
        $this->sistema_operativo = $sistema_operativo;
        return $this;
    }

    public function getRam() {
        return $this->ram;
    }

    public function setRam($ram) {
        $this->ram = $ram;
        return $this;
    }

    public function getCamara() {
        return $this->camara;
    }

    public function setCamara($camara) {
        $this->camara = $camara;
        return $this;
    }

    public function getBateria() {
        return $this->bateria;
    }

    public function setBateria($bateria) {
        $this->bateria = $bateria;
        return $this;
    }

    public function getAlmacenamiento() {
        return $this->almacenamiento;
    }

    public function setAlmacenamiento($almacenamiento) {
        $this->almacenamiento = $almacenamiento;
        return $this;
    }

    public function getPantalla() {
        return $this->pantalla;
    }

    public function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
        return $this;
    }

    public function getProcesador() {
        return $this->procesador;
    }

    public function setProcesador($procesador) {
        $this->procesador = $procesador;
        return $this;
    }

    public function getCarga_rapida() {
        return $this->carga_rapida;
    }

    public function setCarga_rapida($carga_rapida) {
        $this->carga_rapida = $carga_rapida;
        return $this;
    }

    // Obtener las características de un producto específico
    public function obtenerCaracteristicasProducto($producto_id) {
        $sql = "SELECT * FROM caracteristica WHERE producto_id = '{$producto_id}' LIMIT 1";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    // Guardar las características de un producto
    public function guardar() {
        $sql = "INSERT INTO caracteristica (producto_id, sistema_operativo, ram, camara, bateria, almacenamiento, pantalla, procesador, carga_rapida) 
                VALUES ('{$this->getProducto_id()}', '{$this->getSistema_operativo()}', '{$this->getRam()}', '{$this->getCamara()}', 
                        '{$this->getBateria()}', '{$this->getAlmacenamiento()}', '{$this->getPantalla()}', '{$this->getProcesador()}', 
                        '{$this->getCarga_rapida()}')";

        $guardar = $this->db->query($sql);
        return $guardar ? true : false;
    }

    // Actualizar las características de un producto
    public function actualizar() {
        $sql = "UPDATE caracteristica 
                SET sistema_operativo='{$this->getSistema_operativo()}', ram='{$this->getRam()}', camara='{$this->getCamara()}', 
                    bateria='{$this->getBateria()}', almacenamiento='{$this->getAlmacenamiento()}', pantalla='{$this->getPantalla()}', 
                    procesador='{$this->getProcesador()}', carga_rapida='{$this->getCarga_rapida()}'
                WHERE id='{$this->getId()}'";

        $actualizar = $this->db->query($sql);
        return $actualizar ? true : false;
    }

    // Eliminar las características de un producto
    public function eliminar() {
        $sql = "DELETE FROM caracteristica WHERE id = '{$this->getId()}'";
        $eliminar = $this->db->query($sql);
        return $eliminar ? true : false;
    }
}
?>
