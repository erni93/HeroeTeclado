<?php
    require("./inc/funciones.inc.php");
    iniciarSesion();
    crearNombreIdSesion();  
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Keyboard Hero</title>
		<!--Normalize Css -->
		<link rel="stylesheet" href="./css/normalize.css" 	type="text/css"	/>
		<!--Bootstrap Css-->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--Main Css-->
		<link rel="stylesheet" href="./css/main.css" 		type="text/css" />
		<!--JQuery-->
		<script src="js/jquery-3.1.1.min.js"></script>
		<!--Bootstrap JQuery-->
		<script src="js/bootstrap.min.js"></script>
		<!--Menu
		<script src="js/menu.js"></script>-->
		<!--anclas -->
		<script src="js/anclas.js"></script>
	</head>
	<body>
		<header>
			<nav>
				<ul class="container-fluid menu-principal">
					<li class="juego col-md-2 "><a href="#principal" id="uno" class="link-1 ">Juego</a></li>
					<li class="novedades col-md-2"><a href="#novedades" id="dos" class=" link-2">Novedades</a></li>
					<li class="puntuaciones col-md-2  "><a href="#puntuaciones" id="tres" class="link-3">Puntuaciones</a></li>
					<li class="canciones col-md-2  "><a href="#canciones" id="cuatro" class="link-4">Canciones</a></li>
					<?php
					if(isset($_SESSION['mi_uid'])){
        				echo '<li class="col-md-2 col-md-offset-2 cuenta"><a href="./inc/login.php " id="cinco">'.$_SESSION['usuario'].'</a></li>';
    				}else{
    					echo '<li class="col-md-2 col-md-offset-2 cuenta"><a href="./inc/login.php " id="cinco">Cuenta</a></li>';
    				}
    				?>
					
				</ul>
			</nav>
		</header>
		<div id="contenedor">
			<section id="principal">
				<div id="cancionesP">
					
				</div>
				<div id="juegoP">
					
				</div>
				<div id="puntuacionesP">
					
				</div>
			</section>
			<section id="novedades">
			</section>
			<section id="puntuaciones">
			</section>
			<section id="canciones">
			</section>
		</div>
		<footer>
			<h2>Página desarrollada por los estudiantes de DAW:</h2>
			<ul>
				<li>David Parro</li>
				<li>Ernesto del Valle</li>
				<li>Jonatan Tomillo</li>
				<li>Renzo Roca</li>
				<li>Pablo Ruiz</li>
			</ul>
		</footer>
	</body>
</html>