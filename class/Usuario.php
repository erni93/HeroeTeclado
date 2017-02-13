<?php
class Usuario {
    private $db;
	
    public function __construct() {
        $this->db = Conexion::dameInstancia();
    }

    	public function insertar_usuario($nick,$password,$correo,$avatar){ //pendiente de prueba
        
            $sentencia = $this->db->prepare("insert into usuarios (nick,password,correo,avatar) values (?,?,?,?)");
            $sentencia->bindValue(1, $nick);
            $sentencia->bindValue(2, $password);
            $sentencia->bindValue(3, $correo);
            $sentencia->bindValue(4, $avatar);
           
            $sentencia->execute();

        
    }
}