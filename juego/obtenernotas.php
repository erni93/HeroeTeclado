<?php
	require("crearcancion.php");
	if (isset($_GET["action"]) && $_GET["action"] == "notas") {
		// total notas 1064
		//recuperar el array de notas de la sesion
		$notas = crearNotas();
		echo json_encode($notas);
	}


 ?>