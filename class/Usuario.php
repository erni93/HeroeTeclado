<?php

class Usuario {
    private $db;

    public function __construct() {
        $this->instancia = Conexion::dameInstancia();
        $this->db=$this->instancia->conexion();
    }

    public function insertar_usuario($nick,$password,$correo,$avatar){ //pendiente de prueba

        $sentencia = $this->db->prepare("insert into usuarios (nick,password,correo,avatar) values (?,?,?,?)");
        $sentencia->bindValue(1, $nick);
        $sentencia->bindValue(2, $password);
        $sentencia->bindValue(3, $correo);
        $sentencia->bindValue(4, $avatar,SQLITE3_BLOB);

        if($sentencia->execute()){
            return true;
        }

        return false;
    }

    public function login_usuario($email,$password){

    	$success=false;

    	$sql="select * from usuarios where correo = ? and password = ?";
    	$consulta = $this->db->prepare($sql);

        $consulta->bindValue(1, $email);
        $consulta->bindValue(2, $password);
        $resultado=$consulta->execute();

        //Si existe en la BBDD
        if($this->instancia->numRows($resultado)==1){
        	$fila = $resultado->fetchArray();
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

    public function verUsuarios(){
      $sql = "SELECT u.id,u.nick,u.correo,r.rango FROM usuarios u JOIN rangos r ON u.rango=r.id";
      $consulta=$this->db->query($sql);
      $usuarios=array();
      while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
        array_push($usuarios,$fila);
      }
      return $usuarios;
    }

    public function verUsuariosN($nombre){
      $sql = "SELECT u.id,u.nick,u.correo,r.rango FROM usuarios u JOIN rangos r ON u.rango=r.id WHERE nick like '%".$nombre."%'";
      $consulta=$this->db->query($sql);
      $usuarios=array();
      while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
        array_push($usuarios,$fila);
      }
      return $usuarios;
    }

    public function removeUser($id){
      $sql="DELETE FROM usuarios WHERE id=".$id;
      if($this->db->query($sql)){
        return 1;
      }else{
        return 0;
      }
    }

    public function updateRango($id,$rango){
      $sql="UPDATE usuarios SET rango=".$rango." WHERE id=".$id;
      if($this->db->query($sql)){
        return 1;
      }else{
        return 0;
      }
    }

    public function modificarPass($id,$newPass){
      $sql="UPDATE usuarios SET password='".$newPass."' WHERE id=".$id;
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function modificarFoto($id,$newFoto){
      $sentencia = $this->db->prepare("UPDATE usuarios SET avatar=? WHERE id=?");
      $sentencia->bindValue(1, $newFoto,SQLITE3_BLOB);
      $sentencia->bindValue(2, $id);

      if($sentencia->execute()){
          return true;
      }else{
        return false;
      }
    }

    public function __clone() {
       return "La clonacion de este objeto no esta permitida";
    }
}
