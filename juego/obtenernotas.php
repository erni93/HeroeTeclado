<?php
	require("crearcancion.php");
	require("../inc/duracionSeg.php");
	$duracionSeg = getCancionSec();
	$notas = crearNotas($duracionSeg);
	echo json_encode($notas);
	
 ?>