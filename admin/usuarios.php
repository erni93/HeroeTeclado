<?php
		require_once("../inc/funciones.inc.php");
	  require_once("./funciones.inc.php");
	  require_once("../class/Conexion.php");
		require_once("../class/Usuario.php");
		require_once("../class/Rango.php");
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
	<title>Keyboard Hero Administration - Usuarios</title>
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
						envio="u=b&nombre="+busqueda;
					//}
					$("#usuarios tbody").find("tr").remove();
					$.post("./funciones.inc.php",envio,function(datos_devueltos){
						//console.log(datos_devueltos);
						myObj = JSON.parse(datos_devueltos);
						$
      			for (x in myObj) {
							var oRango=(myObj[x].rango=="admin")?"player":"admin";
							$("#usuarios tbody").append(
								"<tr>"+
									"<td>"+myObj[x].id+"</td>"+
									"<td>"+myObj[x].nick+"</td>"+
									"<td>"+myObj[x].correo+"</td>"+
									"<td><select class='rangoA'>"+
									//ESTO DEBERIA COGERLO DE LA BASE DE DATOS
										"<option>"+myObj[x].rango+"</option>"+
										"<option>"+oRango+"</option>"+
									"</select></td>"+
									"<td> <i class='fa fa-pencil'  aria-hidden='true' title='"+myObj[x].id+"'></i> </td>"+
									"<td> <i class='fa fa-trash-o' aria-hidden='true' title='"+myObj[x].id+"'></i> </td>"+
								"</tr>"
							);
						}
						$(".fa-trash-o").click(borrarUsuario);
						$(".fa-pencil").click(function(){
							$( "#dialog-form" ).dialog( "open" );
						});
						$(".rangoA").change(function(){
							rango=$(this).val();
							indice=$('#usuarios tr').index($(this).closest('tr'));
							dato=$('#usuarios').find("tr").eq(indice).find("td").eq(0).html();
							envio="u=c&rangoN="+rango+"&id="+dato;
							$.post("./funciones.inc.php",envio,function(datos_devueltos){
								if(datos_devueltos==1){
									alert("Cambio de rango realizado con exito");
									location.reload();
								}
							})
						})
						function borrarUsuario(){
							id=$(this).attr("title");
							envio="u=d&id="+id;
							$.post("./funciones.inc.php",envio,function(datos_devueltos){
								//alert(datos_devueltos);
								location.reload();
							});

						}
					});
				}
				$("#buscar").keyup(buscar);
				/*---DIALOGO---*/
				$( "#dialog-form" ).dialog({
			      autoOpen: false,
			      show: {
			        effect: "blind",
			        duration: 1000
			      },
			      height: 470,
			      width: 370,
			      modal: true,
			      buttons: {
			        "Modificar Usuario": function(){
			        	/*if(validarDatos()){
					        //var lacadena="o=a&"+$("#addSong").serialize();
						    var archivos = new FormData(document.getElementById("addSong"));

					        $.ajax({
				              url: './funciones.inc.php?o=a',
				              type: 'POST',
				              contentType: false,
				              data: archivos,
				              processData: false,
				              success: function (data) {
				              	if(data==0){
				          				$(".error").html("HA OCURRIDO UN ERROR");
				            			return false;
				            		}
												location.reload();
				              },
				              error: function (xhr, ajaxOptions,thrownError) {
				                  alert(thrownError);}

			        		});
								}*/
									alert("FUNCION TEMPORALMENTE DESHABILITADA");

			        },
			        Cancelar: function() {
			          $(this).dialog( "close" );
			        }
			      },
			      close: function() {}
			    });
					function validarDatos(){
					}
		});
	</script>
</head>
<body>
	<!--DIALOGO ADD CANCION-->
	<div id="dialog-form" title="Editar Usuario">
    <p class="validateTips">Rellene todos los campos.</p>
    <p class="error"></p>
    <form id="editUsers" enctype="multipart/form-data" method="POST">
      <fieldset>
        <label for="nick">Nick</label>
        <input required="required" type="text" name="nick" id="nick" class="text ui-widget-content ui-corner-all"><br/>
				<label for="pass">Password</label>
				<input required="required" type="password" name="pass" id="pass" class="text ui-widget-content ui-corner-all"></br>
				<label for="correo">correo</label>
				<input required="required" type="text" name="correo" id="correo" class="text ui-widget-content ui-corner-all"><br/>
				<label for="avatar">Avatar</label>
				<input required="required" type="file" name="avatar" id="avatar" class="text ui-widget-content ui-corner-all"><br/>
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
      </fieldset>
    </form>
  </div>
  <?php
    cabeceraAdmin();
		$usuarios=new Usuario;
		$listaC=$usuarios->verUsuarios();
		//print_r($listaC);
		echo "<h1>USUARIOS</h1>";
		echo "<div id='cBusqueda'>";
			echo "<label for='buscar'>Buscar: </label>";
			echo "<input type='text' name='buscar' id='buscar'/>";
		echo "</div>";
		echo "<table id='usuarios'>";
		echo "<thead>";
		echo "<tr>";
		foreach ($listaC as $key => $value) {
			foreach ($value as $key => $value2) {
				echo "<th>".formatearTexto($key)."</th>";
			}
			break;
		}
		echo "<th>Editar</th>";
		echo "<th>Borrar</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		echo "</tbody>";
		echo "</table>";
?>
</body>
</html>
