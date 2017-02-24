<?php
class Novedad {
    private $db;

    public function __construct() {
        $this->instancia = Conexion::dameInstancia();
        $this->db=$this->instancia->conexion();
    }
	public function verNovedades() {
	        $sql = "SELECT * from novedades order by fecha desc";
	        $consulta= $this->db->query($sql);
			$novedades=array();
	        while($fila = $consulta->fetchArray(SQLITE3_ASSOC)){
				array_push($novedades,$fila);
			}
			return $novedades;
	}

}
?>
