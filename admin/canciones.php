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
	<link rel="stylesheet" href="../css/jquery-ui.min.css" 		type="text/css" />

	<!--fontawesome-->
	<script src="https://use.fontawesome.com/0f800d37bb.js"></script>
	<!--JQuery-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
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
						//console.log(datos_devueltos);
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
				$(".fa-plus-square").click(function(){
        	//alert("Add song");
        	$( "#dialog-form" ).dialog( "open" );
    		});
				function addcancion(){
						alert("añadir cancion");
				}
				/*---DIALOGO---*/
				$( "#dialog-form" ).dialog({
			      autoOpen: false,
			      show: {
			        effect: "blind",
			        duration: 1000
			      },
			      height: 400,
			      width: 350,
			      modal: true,
			      buttons: {
			        "Registrar Canción": function(){
			          var lacadena="o=a&"+$("#addSong").serialize();
			          $.post("./funciones.inc.php",lacadena,function(datos_devueltos){
			          if(datos_devueltos==0){
			            //$(this).dialog( "close" );
			            //location.reload();
			            $(".error").html("HA OCURRIDO UN ERROR");
			            return false;
			            }
									location.reload();
			          })
			        },
			        Cancelar: function() {
			          $(this).dialog( "close" );
			        }
			      },
			      close: function() {}
			    });

			});
	</script>
</head>
<body>
	<!--DIALOGO ADD CANCION-->
	<div id="dialog-form" title="Añadir cancion">
    <p class="validateTips">Rellene todos los campos.</p>
    <p class="error"></p>
    <form id="addSong">
      <fieldset>
        <label for="tit">Nombre</label>
        <input required="required" type="text" name="titulo" id="tit" class="text ui-widget-content ui-corner-all"><br/>
				<label for="grup">Grupo</label>
				<input required="required" type="text" name="grupo" id="grup" class="text ui-widget-content ui-corner-all"></br>
				<label for="duracion">Duración</label>
				<input required="required" type="text" name="duracion" id="duracion" placeholder="00:00" class="text ui-widget-content ui-corner-all">
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
      </fieldset>
    </form>
  </div>
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
			echo '<i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>';
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
