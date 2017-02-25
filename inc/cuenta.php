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
		<?php
            $mensaje="";
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
                  $newUser=new Usuario();
                  if($newUser->modificarPass($_SESSION['id'],md5($_POST['pass']))){
                    echo "<p class='noerror'>La contraseña ha sido cambiada correctamente</p>";
                  }else{
                      echo "<p class='error'>No se ha podido cambiar la contraseña</p>";
                  }
                }
                  if($_FILES['avatar']['error']==0){
                          $dir_subida = '../img/';
                          $fichero_subido = $dir_subida . basename($_FILES['avatar']['name']);
                          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_subida.$_FILES['avatar']['name'])){
                             echo "El archivo ha sido cargado correctamente.";
                          }else{
                             echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                          }
                          $data=file_get_contents($fichero_subido);
                          $newUser=new Usuario;
                          if($newUser->modificarFoto($_SESSION['id'],$data)){
                              echo '<p class="noerror">Avatar modificado correctamente';
                          }else{
                              echo "<p class='error'>Problema al modificar el avatar.</p>";
                          }
                  }else if($_FILES['avatar']['error']==1){
                      echo "<h1 class='error'>La imagen supera el limite de tamaño(2MB)</h1>";
                  }

            }
		?>
	</head>
	<body>
		<header>
			    <?php echo "<a href='finalizarsesion.php'>Finalizar Sesion</a>";?>
          <div class="user">
  			    <p>Conectado como: <?php echo $nickBBDD;?></p>
          </div>
		</header>
		<section>
           <div class="datosusuario">
               <?php
                        echo '<ul class="menu-user"><li id="mis-datos"><a href="#">Mis datos</a></li><li id="historial"><a href="historialusuario.php">Historial de canciones</a></li><li id="finsesion"><a href="finalizarsesion.php">Salir de la cuenta</a></li>';
                        if($_SESSION['rango']==0){
                            echo '<li id="administrar"><a href="../admin/index.php">Administrar</a></li>';
                        }
                        echo '<li id="eliminar"><a href="borrar-cuenta.php">Eliminar esta cuenta</a></li></ul>';
               ?>
           </div>
           <div class="moddatos">
               <form method="post" action="#" enctype="multipart/form-data">
                   <label>Nick:</label><input type="text" name="nick" id="nick" value=<?php echo $_SESSION['nick'];?> readonly="readonly"/><br />
                   <label>Email:</label><input type="text" name="correo" id="correo" value=<?php echo $_SESSION['correo'];?> readonly="readonly"/><br />
                   <label>Contraseña:</label><input type="password" name="pass" id="pass" /><br />
                   <?php echo '<label for="avatar"><img src="verFoto.php?id='.$_SESSION['id'].'" alt="avatar"></label>'?><input type="file" name="avatar" id="avatar" />
                   <br /><input type="submit" name="modificar" value="Modificar datos" id="">
               </form>
           </div>
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
