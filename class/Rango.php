<?php

class Rango {
    private $db;

    public function __construct() {
        $this->instancia = Conexion::dameInstancia();
        $this->db=$this->instancia->conexion();
    }



}
?>
