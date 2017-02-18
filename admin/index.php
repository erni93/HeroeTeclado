<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Keyboard Hero Administration</title>
	<!--Normalize Css -->
	<link rel="stylesheet" href="../css/normalize.css" 	type="text/css"	/>
	<!--Bootstrap Css-->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!--Main Css-->
	<link rel="stylesheet" href="../css/admin.css" 		type="text/css" />
	<!--JQuery-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<!--Bootstrap JQuery-->
	<script src="../js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	require_once("../inc/funciones.inc.php");
	require_once("./inc/funciones.inc.php");
	require_once("../class/Conexion.php");
		iniciarSesion();
    	if(!isset($_SESSION['id'])){
        	header("Location: ../inc/login.php");
    	}else if($_SESSION['rango']!=0){
    		header("Location: ../inc/login.php");
    	}
    	crearNombreIdSesion();
			$instancia=Conexion::dameInstancia();
			$db=$instancia->conexion();
			$sql1=" SELECT count(*) FROM usuarios WHERE rango=1";
			$sql15=" SELECT count(*) FROM usuarios WHERE rango=0";
			$sql2=" SELECT count(*) FROM canciones";
			$sql3=" SELECT count(*) FROM puntuaciones";
			$consulta1=$db->query($sql1);
			$consulta15=$db->query($sql15);
			$consulta2=$db->query($sql2);
			$consulta3=$db->query($sql3);
			$usuariosAD=$consulta1->fetchArray();
			$usuariosNO=$consulta15->fetchArray();
			$usuarios=$usuariosNO[0]+$usuariosAD[0];
			$cancionesC=$consulta2->fetchArray();
			$puntuacionesC=$consulta3->fetchArray();
			$consulta1->finalize();
			$consulta2->finalize();
			$consulta3->finalize();
		//echo "Hola admin";
	?>
		<?php cabeceraAdmin() ?>
		<h1>Vista general</h1>
		<div class="col-md-5 col-md-offset-1">
		<section id="infoUsuarios">
			<h2>Usuarios</h2>
			<p>Actualmente hay <?php echo $usuarios?> usuarios registrados en la pagina</p>
			<p>Hay <?php echo ($usuariosAD[0]==1)?"1 usuario ":$usuariosAD[0]. " usuarios"?> "Admin"</p>
			<p>Hay <?php echo ($usuariosNO[0]==1)?"1 usuario ":$usuariosNO[0]. " usuarios"?> "Player"</p>
		</section>
		<br/>
		<section id="infoCanciones">
			<h2>Canciones</h2>
			<p>Actualmente hay <?php echo ($cancionesC[0]==1)?"1 canción subida ":$cancionesC[0]." canciones subidas " ?>en la pagina</p>
		</section>
		<br/>
		</div>
		<div class="col-md-5">
		<section id="InfoPuntuaciones">
			<h2>Puntuaciones</h2>
			<p>Hay registradas <?php echo $puntuacionesC[0]?> puntuaciones</p>
			<?php
				if($puntuacionesC[0]>0){
					$sql4="SELECT max(p.puntuacion), c.titulo, u.nick FROM puntuaciones p JOIN canciones c ON p.id_cancion=c.id JOIN usuarios u ON p.id_usuario=u.id"; // SIN COMPLETAR
					$consulta4=$db->query($sql4);
					while($fila=$consulta4->fetchArray()){
						echo "<p>La puntuacion más alta es ".$fila[0]." en la canción ".$fila[1]." por el usuario ".$fila[2]."</p>";
					}
				}
			?>
		</section>
		<br/>
		</div>

</body>
</html>
