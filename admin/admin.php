<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Administracion del sitio</title>
</head>
<body>
	<?php
	require_once("../inc/funciones.inc.php");
		iniciarSesion();
    	if(!isset($_SESSION['id'])){
        	header("Location: login.php");
    	}else if($_SESSION['rango']!=0){
    		header("Location: login.php");
    	}
    	crearNombreIdSesion();

    	echo "Hola admin";
	?>
</body>
</html>