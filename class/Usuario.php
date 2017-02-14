<?php

class Usuario {
    private $db;
	
    public function __construct() {
        $this->db = Conexion::dameInstancia();
    }

    public function insertar_usuario($nick,$password,$correo,$avatar){ //pendiente de prueba
        
        $sentencia = $this->db->prepare("insert into usuarios (nick,password,correo,avatar) values (?,?,?,?)");
        $password_md5=md5($password);
        $sentencia->bindValue(1, $nick);
        $sentencia->bindValue(2, $password_md5);
        $sentencia->bindValue(3, $correo);
        $sentencia->bindValue(4, $avatar);
       
        $sentencia->execute();
        
    }

    public function login_usuario($email,$password){ //pendiente de prueba

    	$success=false;

    	$sql="select * from usuarios where correo = ? and password = ?";
    	$consulta = $this->db->prepare($sql);

    	$password_md5 = md5($password);
        $consulta->bindValue(1, $email);
        $consulta->bindValue(2, $password_md5);
        $consulta->execute();

        //Si existe en la BBDD
        if($consulta->numrows()==1){
        	$fila = $consulta->fetch();
            $_SESSION['id'] = $fila['id'];
            $_SESSION['correo'] = $fila['correo'];
            $_SESSION['nick'] = $fila['nick'];
            $_SESSION['password'] = $fila['password'];
            $_SESSION['rango'] = $fila['rango'];
            $_SESSION['avatar'] = $fila['avatar'];
            $success=true;
        }

        return $success;
    }

    public function verPuntuacionesTotales(){ //pendiente de prueba
    	$sql="select * from usuarios,puntuaciones,canciones where (usuario.id = puntuaciones.id_usuario,canciones.id=puntuaciones.id_cancion) AND (puntuaciones.id_usuario = ?)";
    	$consulta=$this->db->prepare($sql);
    	$consulta->bindValue(1,$_SESSION['id']);
    	$consulta->execute();

    	$puntos=array();
    	$count=0;

    	while($fila=$consulta->fetch()){
    		$titulo=$fila['titulo'];
    		$nick=$fila['nick'];
    		$puntuacion=$fila['puntaucion'];
    		$provisional=array($titulo,$nick,$puntuacion);
    		$puntos[$count]=$provisional; //$puntos es un array de dos dimensiones que contiene para cada indice, un array con los datos de cada cancion para ese usuario.
    		$count++;
    	}

    	return $puntos;

    }

    public function __clone() {
       return "La clonacion de este objeto no esta permitida";
    }
}