<?php
class Conexion {
	
	private static $bd= '../bbdd/heroeTeclado.sqlite';
	private $conex;
	private static $instancia;

	private function dameInstancia(){
		if ( !self::$instancia ) {
			self::$instancia = new self();
			}
		return self::$instancia;
	}
	private function __construct() {
		@$this->conex = new SQLite3($this->bd);
	}
	
	public static function conexion() {
		return $this->conex;
	}

	
	public function __clone() {
		return "La clonacion de este objeto no esta permitida";
	}
}
?>