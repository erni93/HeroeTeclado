<?php
//clases para canciones
require_once("../class/Conexion.php");
class Cancion{
	//ATRIBUTOS
	private $instancia;
	private $db;
 	//CONSTRUCTOR
	public function __construct() {
			$this->instancia = Conexion::dameInstancia();
			$this->db=$this->instancia->conexion();
	}
	//METODOS
	public function get_db() {
			return $this->db;
	}

	public function verCancion($id) {
            $sql = "SELECT * from canciones WHERE id=".$id;
        		$consulta= $this->db->query($sql);

					if ($this->instancia->numRows($consulta) == 1) {
                $fila = $consulta->fetchArray();
				        $id=$fila["id"];
                $titulo=$fila["titulo"];
                $grupo=$fila["grupo"];
                $duracion=$fila["duracion"];
                $ruta=$fila["ruta"];
                return array($id,$titulo, $grupo, $duracion, $ruta);

            } else {
                return "No existe la canción";
            }
    }

		public function addCancion(){
			$sql="INSERT INTO canciones VALUES (NULL,?,?,?,?)";
				"$titulo,$grupo,$ruta,$duracion)";
		}
}
?>
