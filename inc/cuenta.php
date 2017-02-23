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
		<title>Cartelera</title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
		<?php
            $mensaje="";
            $emailBBDD="";
            $nickBBDD="";
            if(isset($_SESSION['id'])){
                $emailBBDD=$_SESSION['correo'];
                $pass=$_SESSION['password'];
				        $rango=$_SESSION['rango'];
            }else{
                header("Location: login.php");
                $usuario=$_POST['user'];
                $pass=$_POST['pass'];
				        $rango=-1;
            }
            if(isset($_POST['modificar'])){
                if(!empty($_POST['pass'])){
                  $newUser=new Usuario();
                  if($newUser->modificarPass($_SESSION['id'],md5($_POST['pass']))){
                    echo "<p class='noerror'>La contraseña ha sido cambiada correctamente</p>";
                  }else{
                      echo "<p class='error'>No se ha podido cambiar la contraseña</p>";
                  }
                }
                  if($_FILES['avatar']['error']==0){
                    echo "<p>Avatar existe</p>";
                          $dir_subida = '../img/';
                          $fichero_subido = $dir_subida . basename($_FILES['avatar']['name']);
                          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_subida.$_FILES['avatar']['name'])){
                             echo "El archivo ha sido cargado correctamente.";
                          }else{
                             echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                          }
                          $data=file_get_contents($fichero_subido);
                          /*$newuser=new Usuario;
                          if($newuser->insertar_usuario($_POST['nick'],md5($_POST['pass']),$_POST['email'],$data)){
                              echo '<p class="noerror">Avatar modificado correctamente';
                          }else{
                              echo "<p class='error'>Problema al modificar el avatar.</p>";
                          }*/
                  }else if($_FILES['avatar']['error']==1){
                    echo "<p>Avatar mal</p>";
                      echo "<h1 class='error'>La imagen supera el limite de tamaño(2MB)</h1>";
                  } else{
                    echo "<p>Avatar no existe</p>";
                      $imagen_temporal = "../img/sinfoto.png";
                      $data=file_get_contents($imagen_temporal);
                      $newuser=new Usuario;
                      /*if($newuser->insertar_usuario($_POST['nick'],md5($_POST['pass']),$_POST['email'],$data)){
                          echo '<p class="noerror">Usuario registrado correctamente';
                      }else{
                          echo "<p class='error'>Problema al registrar el usuario. Usuario no registrado.</p>";
                      }*/
                  }




            }
		?>
	</head>
	<body>
		<header>
			<h1 class="usuariologueado">
                <?php echo "<a href='finalizarsesion.php'>Finalizar Sesion</a>";?>
			    <p><?php echo $emailBBDD;?></p>
			    <p><?php echo $nickBBDD;?></p>
				<p><?php echo $rango;?></p>
			</h1>
		</header>
		<section>
           <div class="datosusuario">
               <?php
                        echo '<ul class="menu-user"><li id="mis-datos"><a href="datos.php">Mis datos</a></li><li id="historial"><a href="historial.php">Historial de canciones</a></li><li id="eliminar"><a href="borrar-cuenta.php">Eliminar esta cuenta</a></li>';
                        if($_SESSION['rango']==0){
                            echo '<li id="administrar"><a href="../admin/index.php">Administrar</a></li>';
                        }
                        echo '</ul>';
               ?>
           </div>
           <div class="moddatos">
               <form method="post" action="#" enctype="multipart/form-data">
                   <label>Nick:</label><input type="text" name="nick" id="nick" value=<?php echo $_SESSION['nick'];?> readonly="readonly"/><br />
                   <label>Email:</label><input type="text" name="correo" id="correo" value=<?php echo $_SESSION['correo'];?> readonly="readonly"/><br />
                   <label>Contraseña:</label><input type="password" name="pass" id="pass" /><br />
                   <?php echo '<img src="verFoto.php?id='.$_SESSION['id'].'" alt="avatar">'?><input type="file" name="avatar" id="avatar" />
                   <br /><input type="submit" name="modificar" value="Modificar datos">
               </form>
           </div>
		</section>
		<footer>
		    <a href="../index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>
