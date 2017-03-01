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
		<title>Borrar cuenta</title>
		<link rel="stylesheet" type="text/css" href="../css/cuenta.css">
		<link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
		<script src="https://use.fontawesome.com/2c348761fe.js"></script>
    <!--Favicon-->
		<link rel="icon" type="image/png" href="../img/guitarra.png" />
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
           <?php if(!isset($_GET['borrar'])) { ?>
           <div class="history">
             <p>¿Deseas borrar la cuenta <?php echo $_SESSION['nick']; ?>?</p>
              <button type="submit" name="borrar" onclick="window.location.href='./borrar-cuenta.php?borrar=si'">Si</button><button type="submit" name="cancelar" onclick="window.location.href='./cuenta.php'">No</button>
           </div>
           <?php } else{
             echo "<p>Su cuenta está siendo borrada, reedireccionando...</p>";
             $newUser=new Usuario();
             if($newUser->removeUser($_SESSION['id'])==1){
               header("Refresh: 3; ./finalizarsesion.php");
             }else{
               echo "<p class='error'>ERROR. No se ha podido borrar la cuenta.</p>";
             }

           }?>
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
