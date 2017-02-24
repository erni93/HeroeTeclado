<?php
    session_cache_limiter('nocache');
	   require_once("./funciones.inc.php");
	iniciarSesion();	
	session_destroy();
	header("Location: login.php");
?>
