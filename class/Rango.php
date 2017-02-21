<?php

class Rango {
    private $db;

    public function __construct() {
        $this->instancia = Conexion::dameInstancia();
        $this->db=$this->instancia->conexion();
    }

    public function verRango($id) {
              $sql = "SELECT * from rangos WHERE id=".$id;
              $consulta= $this->db->query($sql);

            if ($this->instancia->numRows($consulta) == 1) {
                  $fila = $consulta->fetchArray(SQLITE3_ASSOC);
                  return $fila;

              } else {
                  return "No existe la canción";
              }
      }

      public function verRangoID($nombre) {
                $sql = "SELECT * from rangos WHERE rango='".$nombre."'";
            		$consulta= $this->db->query($sql);

    					if ($this->instancia->numRows($consulta) == 1) {
                    $fila = $consulta->fetchArray(SQLITE3_ASSOC);
    				        return $fila['id'];
                } else {
                    return "No existe el rango";
                }
        }
}
?>
