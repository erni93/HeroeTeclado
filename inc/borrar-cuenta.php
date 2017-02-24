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
                        echo '<ul class="menu-user"><li id="mis-datos"><a href="cuenta.php">Mis datos</a></li><li id="historial"><a href="#">Historial de canciones</a></li><li id="eliminar"><a href="borrar-cuenta.php">Eliminar esta cuenta</a></li>';
                        if($_SESSION['rango']==0){
                            echo '<li id="administrar"><a href="../admin/index.php">Administrar</a></li>';
                        }
                        echo '</ul>';
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
		    <a href="../index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>
