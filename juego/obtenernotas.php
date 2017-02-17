<?php
	require("crearcancion.php");
	$notas = crearNotas();
	echo json_encode($notas);
	
 ?>