<?php
    require_once("../class/Novedad.php");
    require_once("../class/Conexion.php");
    $novedades = new Novedad();
	$listaN = $novedades->verNovedades();
	$listaN_size = count($listaN);
	for ($i = 0; $i < $listaN_size; $i++) {
		echo "<div class='novedad'>";
		echo "<h2>" . $listaN[$i]['titular'] . " </h2>";
		echo $listaN[$i]['contenido'];
		echo "<p>Fecha: " . $listaN[$i]['fecha'] . "</p>";
		echo "</div>";
	}


?>