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
                $fila = $consulta->fetchArray(SQLITE3_ASSOC);
				        return $fila;

            } else {
                return "No existe la canción";
            }
    }
		public function verCancionN($nombre) {
	            $sql = "SELECT * from canciones WHERE titulo like '%".$nombre."%'";
	        		$consulta= $this->db->query($sql);
							$canciones=array();
							while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
					    	array_push($canciones,$fila);
							}
							return $canciones;
	    }
		public function verCanciones() {
	            $sql = "SELECT * from canciones";
	        		$consulta= $this->db->query($sql);
							$canciones=array();
	            while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
					    	array_push($canciones,$fila);
							}
							return $canciones;
	    }
		public function addCancion($titulo,$grupo,$duracion){
				$tit_aux=explode(" ",trim($titulo));
				$tit_aux2=implode("-",$tit_aux);
				$gru_aux=explode(" ",trim($grupo));
				$gru_aux2=implode("-",$gru_aux);
				$ruta="canciones/".$tit_aux2."_".$gru_aux2;
				$sql="INSERT INTO canciones VALUES (NULL,'".$titulo."','".$grupo."','".$ruta."','".$duracion."')";
				if($this->db->query($sql)){
					mkdir("../".$ruta);
					return 1;
				}else{
					return 0;
				}
		}

		public function removeCancion($id){
			$sql="DELETE FROM canciones WHERE id=".$id;
			if($this->db->query($sql)){
				return 1;
			}else{
				return 0;
			}
		}

		public function modificarCancion($campo,$nValor,$id){
			$sql="UPDATE canciones SET ".$campo."='".$nvalor."' WHERE id=".$id;
			if($this->db->query($sql)){
				return 1;
			}else{
				return 0;
			}
		}

}
?>
