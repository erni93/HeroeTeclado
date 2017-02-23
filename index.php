<?php
    require("./inc/funciones.inc.php");
    require_once("./class/Conexion.php");
    require_once("./class/Puntuacion.php");
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
		<header class="main">
			<nav>
				<ul class="container-fluid menu-principal">
					<li class="juego col-md-2 "><a href="#principal" id="uno" class="link-1 ">Juego</a></li>
					<li class="novedades col-md-2"><a href="#novedades" id="dos" class=" link-2">Novedades</a></li>
					<li class="puntuaciones col-md-2  "><a href="#puntuaciones" id="tres" class="link-3">Puntuaciones</a></li>
					<li class="canciones col-md-2  "><a href="#canciones" id="cuatro" class="link-4">Canciones</a></li>
					<?php
					if(isset($_SESSION['id'])){
        				echo '<li class="col-md-2 col-md-offset-2 cuenta"><a href="./inc/login.php " id="cinco">'.$_SESSION['nick'].'</a></li>';
    				}else{
    					echo '<li class="col-md-2 col-md-offset-2 cuenta"><a href="./inc/login.php " id="cinco">Cuenta</a></li>';
    				}
    				?>

				</ul>
			</nav>
		</header>
		<div id="contenedor">
			<section id="principal">
				<div id="cancionesP" class="col-md-3" >
					<h1>MÚSICA</h1>
					<!-- Datos de ejemplo que devolveria el PHP -->
  			       	<div>
  			       		<h2>Welcome to the Jungle</h2>
	  			       	<p>Duración: <b>3:20 min</b></p>
  			       	</div>
				</div>
				<div id="juegoP" class="col-md-6">
					<iframe src="./juego/index.html" height="660px" width="632px"></iframe>
				</div>
				
				<div id="puntuacionesP" class="col-md-3">
  			     	<table class="table table-responsive">
  			       		<caption>PUNTUACIONES</caption>
	               		<thead>
	                 		<tr>
	                 			<th>#</th>
			                   	<th>Canción</th>
			                   	<th>Puntuación</th>
			                   	<th>Usuario</th>
	                 		</tr>
	               		</thead>
	              	 	<tbody>
	              	 		<!-- Datos de ejemplo que devolveria el PHP -->
	              	 		<tr>
	              	 			<td>1</td>
	              	 			<td>Welcome to the jungle</td>
	              	 			<td>1242</td>
	              	 			<td>Feredico</td>
	              	 		</tr>
			                <?php
			                ?>
	               		</tbody>
  			     	</table>
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
