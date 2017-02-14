<?php
    session_cache_limiter('nocache');
	require_once("./inc/funciones.inc.php");
	iniciarSesion();	
	session_destroy();
	header("Location: login.php");	
?>