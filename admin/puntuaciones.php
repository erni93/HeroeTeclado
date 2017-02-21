<?php
	require_once("../inc/funciones.inc.php");
    require_once("./funciones.inc.php");
    require_once("../class/Conexion.php");
  require_once("../class/Puntuacion.php");
    iniciarSesion();
    if(!isset($_SESSION['id'])){
      header("Location: ../inc/login.php");
    }else if($_SESSION['rango']!=0){
      header("Location: ../inc/login.php");
    }
    crearNombreIdSesion();
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Keyboard Hero Administration - Puntuaciones</title>
	<!--Normalize Css -->
	<link rel="stylesheet" href="../css/normalize.css" 	type="text/css"	/>
	<!--Bootstrap Css-->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!--Main Css-->
	<link rel="stylesheet" href="../css/admin.css" 		type="text/css" />
	<link rel="stylesheet" href="../css/jquery-ui.min.css" 		type="text/css" />

	<!--fontawesome-->
	<script src="https://use.fontawesome.com/0f800d37bb.js"></script>
	<!--JQuery-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<!--Bootstrap JQuery-->
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">

  </script>
</head>
<body>
    <?php
      cabeceraAdmin();
  		$listaC=Puntuacion::verCampos();
  		//print_r($listaC);
  		echo "<h1>CANCIONES</h1>";
  		echo "<div id='cBusqueda'>";
  			echo "<label for='buscar'>Buscar: </label>";
  			echo "<input type='text' name='buscar' id='buscar'/>";
  		echo "</div>";
  		echo "<table id='puntuaciones'>";
  		echo "<thead>";
  		echo "<tr>";
      for ($i=0; $i <count($listaC) ; $i++) {
        echo "<th>".formatearTexto($listaC[$i])."</th>";
      }
  		echo "<th>Borrar</th>";
  		echo "</tr>";
  		echo "</thead>";
  		echo "<tbody>";
  		echo "</tbody>";
  		echo "</table>";
    ?>
</body>
</html>
