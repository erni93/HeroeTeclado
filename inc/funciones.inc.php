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

?>