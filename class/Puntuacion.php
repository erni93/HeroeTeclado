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
