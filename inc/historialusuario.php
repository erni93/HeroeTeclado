<?php
    require("../inc/funciones.inc.php");
    require("../class/Conexion.php");
    require("../class/Usuario.php");
    require("../class/Puntuacion.php");
    iniciarSesion();
    crearNombreIdSesion();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Historial</title>
		<link rel="stylesheet" type="text/css" href="../css/cuenta.css">
		<link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
    <script src="https://use.fontawesome.com/2c348761fe.js"></script>
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

		?>
	</head>
	<body>
    <header>
			    <?php echo "<a href='finalizarsesion.php'><i class='fa fa-arrow-left' aria-hidden='true'></i>Finalizar Sesion</a>";?>
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
                   echo '<li id="mis-datos"><a href="cuenta.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Mis datos</a></li><li id="historial"><a href="historialusuario.php"><i class="fa fa-history" aria-hidden="true"></i>Historial de canciones</a></li><li id="finsesion"><a href="finalizarsesion.php"><i class="fa fa-user-times" aria-hidden="true"></i>Salir de la cuenta</a></li><li id="eliminar"><a href="borrar-cuenta.php"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar esta cuenta</a></li></ul>';
          ?>
      </div>
           <div class="history">
             <?php
                $newPuntuaciones=new Puntuacion();
                $resultado=$newPuntuaciones->verPuntuacionesUsuario($_SESSION['id']);
                echo "<p>Historial de puntuaciones:</p>";
                echo "<table>";
                  echo "<tr><td>id</td><td>Canción</td><td>Puntuación</td><td>Fecha</td></tr>";
                foreach ($resultado as $fila => $valor) {
                  echo "<tr><td>".$valor['id']."</td><td>".$valor['titulo']."</td><td>".$valor['puntuacion']."</td><td>".$valor['fecha']."</td></tr>";
                }
                echo "</table>";
              ?>
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
