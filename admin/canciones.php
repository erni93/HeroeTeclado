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
	<!--fontawesome-->
	<script src="https://use.fontawesome.com/0f800d37bb.js"></script>
	<!--JQuery-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<!--Bootstrap JQuery-->
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		  $( function() {
				buscar();
				function buscar(){
					busqueda=$("#buscar").val();
					//if(busqueda=""){
						//envio="o=t";
					//}else{
						envio="o=b&nombre="+busqueda;
					//}
					$("#canciones tbody").find("tr").remove();
					$.post("./funciones.inc.php",envio,function(datos_devueltos){
						console.log(datos_devueltos);
						myObj = JSON.parse(datos_devueltos);
						$
      			for (x in myObj) {
							$("#canciones tbody").append(
								"<tr>"+
									"<td>"+myObj[x].id+"</td>"+
									"<td>"+myObj[x].titulo+"</td>"+
									"<td>"+myObj[x].grupo+"</td>"+
									"<td>"+myObj[x].ruta+"</td>"+
									"<td>"+myObj[x].duracion+"</td>"+
									"<td> <i class='fa fa-trash-o' aria-hidden='true' title='"+myObj[x].id+"'></i> </td>"+
								"</tr>"
							);
						}
						$(".fa-trash-o").click(borrarCancion);
						function borrarCancion(){
							id=$(this).attr("title");
							envio="o=d&id="+id;
							$.post("./funciones.inc.php",envio,function(datos_devueltos){
								alert(datos_devueltos);
								location.reload();
							});
						}
					});
				}
				$("#buscar").keyup(buscar);
			});
	</script>
</head>
<body>
  <?php
    require_once("../inc/funciones.inc.php");
    require_once("./funciones.inc.php");
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
		echo "<div id='cBusqueda'>";
			echo "<label for='buscar'>Buscar: </label>";
			echo "<input type='text' name='buscar' id='buscar'/>";
		echo "</div>";
		echo "<table id='canciones'>";
		echo "<thead>";
		echo "<tr>";
		foreach ($listaC as $key => $value) {
			foreach ($value as $key => $value2) {
				echo "<th>".formatearTexto($key)."</th>";
			}
			break;
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
