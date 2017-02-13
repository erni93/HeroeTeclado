<?php 
// establece la sesión 'practica_7'

function iniciarSesion(){
	session_cache_limiter();
    session_name('cine');
    session_start();  
}
function crearNombreIdSesion() {
	$sn=session_name();
	$si=session_id();	
	$_SESSION['nombreId'] = $sn."=". $si;
}
?>