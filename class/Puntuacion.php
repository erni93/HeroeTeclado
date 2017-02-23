<?php

class Puntuacion {
    private $db;

    public function __construct() {
        $this->instancia = Conexion::dameInstancia();
        $this->db=$this->instancia->conexion();
    }

    public function verPuntuaciones(){
      $sql="SELECT titulo,puntuacion,nick,fecha FROM puntuaciones p JOIN canciones c ON p.id_cancion=c.id JOIN usuarios u ON p.id_usuario=u.id";
      $consulta= $this->db->query($sql);
      $puntuaciones=array();
      while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
        array_push($puntuaciones,$fila);
      }
      return $puntuaciones;
    }

    public function verPuntuacionesN($nombre){
      $sql="SELECT p.id,titulo,puntuacion,nick,fecha FROM puntuaciones p JOIN canciones c ON p.id_cancion=c.id JOIN usuarios u ON p.id_usuario=u.id WHERE titulo like '%".$nombre."%'";
      $consulta= $this->db->query($sql);
      $puntuaciones=array();
      while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
        array_push($puntuaciones,$fila);
      }
      return $puntuaciones;
    }
    public function verPuntuacionID($id){
      $sql="SELECT p.id,titulo,puntuacion,nick,fecha FROM puntuaciones p JOIN canciones c ON p.id_cancion=c.id JOIN usuarios u ON p.id_usuario=u.id WHERE id_cancion=".$id." ORDER BY puntuacion DESC LIMIT 10";
      $consulta= $this->db->query($sql);
      $puntuaciones=array();
      while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
        array_push($puntuaciones,$fila);
      }
      return $puntuaciones;
    }

    public function removePuntuacion($id){
      $sql="DELETE FROM puntuaciones WHERE id=".$id;
      if($this->db->query($sql)){
        return 1;
      }else{
        return 0;
      }
    }


    public static function verCampos(){
      $instancia = Conexion::dameInstancia();
      $db=$instancia->conexion();
      $sql="SELECT titulo,puntuacion,nick,fecha FROM puntuaciones p JOIN canciones c ON p.id_cancion=c.id JOIN usuarios u ON p.id_usuario=u.id";
      $consulta= $db->query($sql);
      $cols=$consulta->numColumns();
      $camposP=array();
      for ($i=0; $i < $cols; $i++) {
        # code...
        array_push($camposP,$consulta->columnName($i));
      }
      $db->close();
      return $camposP;

    }
}
