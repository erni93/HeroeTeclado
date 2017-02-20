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
		<link rel="stylesheet" type="text/css" href="./css/stylelogin.css">
		<link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
		<?php
            $mensaje="";
            $emailBBDD="";
            $nickBBDD="";
            $login=true;
            if(isset($_SESSION['id'])){
                $emailBBDD=$_SESSION['correo'];
                $pass=$_SESSION['password'];
				$rango=$_SESSION['rango'];
                echo "Con sesion";
            }else{
                header("Location: login.php");
                $usuario=$_POST['user'];
                $pass=$_POST['pass'];
				$rango=-1;
                echo "Sin sesion";
            }
		?>
	</head>
	<body>
		<header>
			<h1 class="usuariologueado">
                <?php if($login)echo "<a href='finalizarsesion.php'>Finalizar Sesion</a>";?>
			    <p><?php if($login)echo $emailBBDD;else echo "Usuario/contraseña incorrectos. <a href='login.php'>Volver</a>";?></p>
			    <p><?php if($login)echo $nickBBDD;?></p>
				<p><?php if($login)echo $rango;?></p>
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
		</section>
		<footer>
		    <a href="../index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>
