<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Keyboard Hero Administration - Canciones</title>
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
    require_once("inc/funciones.inc.php");
    require_once("../class/Conexion.php");
		require_once("../class/Cancion.php");
    iniciarSesion();
    if(!isset($_SESSION['id'])){
      header("Location: ../inc/login.php");
    }else if($_SESSION['rango']!=0){
      header("Location: ../inc/login.php");
    }
    crearNombreIdSesion();
    cabeceraAdmin();
		$canciones=new Cancion;
		$listaC=$canciones->verCanciones();
		//print_r($listaC);
		echo "<h1>CANCIONES</h1>";
		echo "<table>";
		echo "<thead>";
		echo "<tr>";
		foreach ($listaC as $key => $value) {
			foreach ($value as $key => $value2) {
				echo "<th>".$key."</th>";
			}
			break;
		}
		echo "<th>Borrar</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach ($listaC as $key => $value) {
			echo "<tr>";
			foreach ($value as $key => $value2) {
				echo "<td>".$value2."</td>";
			}
			echo "<td></td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
   ?>
</body>
</html>
