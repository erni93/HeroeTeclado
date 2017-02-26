<?php
require("../inc/funciones.inc.php");
require_once("../class/Conexion.php");
require_once("../class/Usuario.php");
require_once("../class/PHPMailer/PHPMailerAutoload.php");

iniciarSesion();
if(isset($_SESSION['id'])){
    header("Location: cuenta.php");
}
crearNombreIdSesion();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Recordar contraseña</title>
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="https://use.fontawesome.com/2c348761fe.js"></script>
  </head>
  <body>
    <section>
      <form action="" method="post">
          <h1>Recordar contraseña olvidada</h1>
          <input type="text" name="correo" placeholder="&#xF0E0;   Correo electrónico"/>
          <input type="submit" name="recordar" value="Recordar" style="float:none"/><br>
      </form>
    </section>
    <?php
      if(isset($_POST['recordar'])){
        $usuarios=new Usuario;
        $existe=$usuarios->verUsuariosC($_POST['correo']);
        echo "<section>";
        if(count($existe)==1){
          $id= $existe[0]['id'];
          $newPass=generaPass();
          if($usuarios->modificarPass($id,md5($newPass))){
            $mandado=mandarPass($_POST['correo'],$newPass);
            if($mandado==1){
              echo "<p>Contraseña restablecia.</p>";
              echo "<p>Revise su correo.</p>";
            }else{
              echo "<p>Ha ocurrido un error al mandarle el correo</p>";
              echo $mandado;
            }
          }else{
            echo "<p>Ha ocuurido un error al recuperar la contraseña</p>";
          }
        }else{
          echo "<p>Ese correo no se encuentra registrado</p>";
        }
        echo "</section>";
      }
     ?>
    <footer>
      <a href="login.php">Volver</a>
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
