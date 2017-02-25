<?php 
	function crearNotas($segundos){
		//1024 notas = 104 segundos
		$numNotas = intval(($segundos*1024)/104);
		$notaDisponible = ["0001","0010","0100","1000"];
		$cancion = [];

		for ($i=0,$c=0; $i < $numNotas; $i++,$c++) { 
			if ($i == 0 || $c == 4){
				$cancion[$i] = $notaDisponible[mt_rand(0,3)];
				$c = 0;
			}else{
				$cancion[$i] = "0000";
			}
		}
		return $cancion;
	}
	
 ?>