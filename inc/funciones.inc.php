<?php
function iniciarSesion(){
	session_cache_limiter();
    session_name('heroeteclado');
    session_start();
}

function crearNombreIdSesion() {
	$sn=session_name();
	$si=session_id();
	$_SESSION['nombreId'] = $sn."=". $si;
}

function verImagen($id){
	$instancia = Conexion::dameInstancia();
	$con=$instancia->conexion();
}
function imprimirPuntuaciones(){
	$puntuaciones=new Puntuacion();
	$listaP=$puntuaciones->verPuntuaciones();
	for ($i=0; $i < 10 ; $i++) {
		# code...
		echo "<tr>";
			echo "<td>".$listaP[$i]['titulo']."</td>";
			echo "<td>".$listaP[$i]['puntuacion']."</td>";
			echo "<td>".$listaP[$i]['nick']."</td>";
		echo "</tr>";
	}
}
function imprimirNovedades(){
	
	$novedades = new Novedad();
	$listaN = $novedades->verNovedades();
	$listaN_size = count($listaN);
	echo "<div class='novedad'>";
	for ($i = 0; $i < $listaN_size; $i++) {
		echo "<h2>" . $listaN[$i]['titular'] . " </h2>";
		echo $listaN[$i]['contenido'];
		echo "<p>Fecha: " . $listaN[$i]['fecha'] . "</p>";
	}
	echo "</div>";
	 
}
?>
