<?php 
	function crearNotas(){
		$notaDisponible = ["0001","0010","0100","1000"];
		$cancion = [];

		for ($i=0,$c=0; $i < 1064; $i++,$c++) { 
			if ($i == 0 || $c == 4){
				$cancion[$i] = $notaDisponible[mt_rand(0,3)];
				$c = 0;
			}else{
				$cancion[$i] = "0000";
			}
		}
		// Devolver el array o una string json?
		return $cancion;
	}
	
 ?>