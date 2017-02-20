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
               <form method="post" action="#">
                   <label>Nick:</label><input type="text" name="nick" id="nick" value=<?php echo $_SESSION['nick'];?> readonly="readonly"/><br />
                   <label>Email:</label><input type="text" name="correo" id="correo" value=<?php echo $_SESSION['correo'];?> readonly="readonly"/><br />
                   <label>Contraseña:</label><input type="password" name="pass" id="pass" /><br />
                   <?php echo '<img src="verFoto.php?id='.$_SESSION['id'].'" alt="avatar">'?><input type="file" name="avatar" id="avatar" />
                   
                   
               </form>
           </div>
		</section>
		<footer>
		    <a href="../index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>
