<?php
    require("../inc/funciones.inc.php");
    require("../class/Conexion.php");
    require("../class/Usuario.php");
    iniciarSesion();
    crearNombreIdSesion();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cuenta</title>
		<link rel="stylesheet" type="text/css" href="../css/cuenta.css">
		<link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
    <script src="https://use.fontawesome.com/2c348761fe.js"></script>
		<?php
            $mensaje="";
            $mensajeC="";
            $emailBBDD="";
            $nickBBDD="";
            if(isset($_SESSION['id'])){
                $emailBBDD=$_SESSION['correo'];
                $pass=$_SESSION['password'];
				        $rango=$_SESSION['rango'];
                $nickBBDD=$_SESSION['nick'];
            }else{
                header("Location: login.php");
                $usuario=$_POST['user'];
                $pass=$_POST['pass'];
				        $rango=-1;
            }
            if(isset($_POST['modificar'])){
                if(!empty($_POST['pass'])){
                  if(validarPass($_POST['pass'])){
                    $newUser=new Usuario();
                    if($newUser->modificarPass($_SESSION['id'],md5($_POST['pass']))){
                      $mensajeC="<p class='noerror'>La contraseña ha sido cambiada correctamente</p>";
                    }else{
                        $mensajeC="<p class='error'>No se ha podido cambiar la contraseña</p>";
                    }
                  }else{
                    $mensajeC="<p class='error'>Error en el formato de contraseña. Entre 4 y 8 caracteres y mínimo 1 mayúsucla, 1 minúscula y 1 número.</p>";
                  }

                }
                  if($_FILES['avatar']['error']==0){
                          $dir_subida = '../img/';
                          $fichero_subido = $dir_subida . basename($_FILES['avatar']['name']);
                          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_subida.$_FILES['avatar']['name'])){
                             $mensaje= "El archivo ha sido cargado correctamente.";
                          }else{
                             $mensaje= "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                          }
                          $data=file_get_contents($fichero_subido);
                          $newUser=new Usuario;
                          if($newUser->modificarFoto($_SESSION['id'],$data)){
                              $mensaje= '<p class="noerror">Avatar modificado correctamente';
                          }else{
                              $mensaje= "<p class='error'>Problema al modificar el avatar.</p>";
                          }
                  }else if($_FILES['avatar']['error']==1){
                      $mensaje= "<h1 class='error'>La imagen supera el limite de tamaño(2MB)</h1>";
                  }

            }
		?>
	</head>
	<body>
		<header>
			    <?php echo "<a href='../index.php'><i class='fa fa-arrow-left' aria-hidden='true'></i>Volver al juego</a>";?>
          <div class="user">
  			    <p><i class="fa fa-check-square-o" aria-hidden="true"></i>Conectado como: <?php echo $nickBBDD;?></p>
          </div>
		</header>
		<section>
           <div class="datosusuario">
               <?php
                        echo '<ul class="menu-user">';
                        if($_SESSION['rango']==0){
                            echo '<li id="administrar"><a href="../admin/index.php"><i class="fa fa-cogs" aria-hidden="true"></i>Administrar</a></li>';
                        }
                        echo '<li id="mis-datos"><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>Mis datos</a></li><li id="historial"><a href="historialusuario.php"><i class="fa fa-history" aria-hidden="true"></i>Historial de canciones</a></li><li id="finsesion"><a href="finalizarsesion.php"><i class="fa fa-user-times" aria-hidden="true"></i>Salir de la cuenta</a></li><li id="eliminar"><a href="borrar-cuenta.php"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar esta cuenta</a></li></ul>';
               ?>
           </div>
           <div class="moddatos">
               <form method="post" action="#" enctype="multipart/form-data">
                  <p>Datos del usuario:</p>
                   <label>Nick:</label><input type="text" name="nick" id="nick" value=<?php echo $_SESSION['nick'];?> readonly="readonly"/><br />
                   <label>Email:</label><input type="text" name="correo" id="correo" value=<?php echo $_SESSION['correo'];?> readonly="readonly"/><br />
                   <p>Datos que puedes modificar:</p>
                   <label>Contraseña:</label><input type="password" name="pass" id="pass" /><br />
                   <?php echo '<label for="avatar"><img src="verFoto.php?id='.$_SESSION['id'].'" alt="avatar"></label>'?><br /><input type="file" name="avatar" id="avatar" />
                   <br /><input type="submit" name="modificar" value="Modificar datos" id="">
               </form>
           </div>
           <?php
              echo $mensaje."<br />".$mensajeC;
            ?>
		</section>
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
