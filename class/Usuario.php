<?php
class Usuario {
    private $db;
	
    public function __construct() {
        $this->db = Conexion::dameInstancia();
    }
}