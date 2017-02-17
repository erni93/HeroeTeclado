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
        	header("Location: ../inc/login.php");
    	}else if($_SESSION['rango']!=0){
    		header("Location: ../inc/login.php");
    	}
    	crearNombreIdSesion();
		//echo "Hola admin";
	?>
	<header>
		<nav>
			<ul>
				<li><a href=""></a>Canciones</li>
				<li><a href=""></a>Puntuaciones</li>
				<li><a href=""></a>Usuarios</li>
				<li><a href=""></a>Volver a Mi Cuenta</li>
			</ul>
		</nav>
	</header>
	<section>
		<h1>Vista general</h1>
		<section id="infoUsuarios">
			<h2>Usuarios</h2>
			<p>Actualmente hay ? usuarios registrados en la pagina</p>
		</section>
		<section id="infoCanciones">
			<h2>Canciones</h2>
			<p>Actualmente hay ? canciones subidas a la pagina</p>
		</section>
		<section id="InfoPuntuaciones">
			<h2>Puntuaciones</h2>
			<p>La puntuacion más alta es ? en la canción ?</p>
			<p>Hay registradas ? puntuaciones</p>
		</section>
	</section>
</body>
</html>