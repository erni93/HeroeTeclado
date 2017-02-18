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
            /*$db = new SQLite3('../bbdd/heroeteclado.sqlite');

            //$results = $db->query('SELECT * FROM usuarios WHERE correo = ? AND password=?;');
            /*$db = Conexion::dameInstancia();
            $db2 = Conexion::conexion();
            echo $db2."db";*/
            //$password_md5 = md5($pass);
            //$sql_query = "SELECT * FROM usuarios WHERE correo = ? AND password=?;";
            /*echo "Prepare;".$db->prepare($sql_query);*/
           /* if ( $reultado=$db->prepare($sql_query) ) {
                $reultado->bindValue(1,$usuario);
                $reultado->bindValue(2,$password_md5);
                //echo  "Hola".$db->execute() ;
                if ( $filas=$reultado->execute() ) {

                   $prueba=$filas->fetchArray();
                   echo "<br />".$prueba['nick']."<br />";
                        if(count($prueba)==0){
                            $mensaje="Usuario/contraseña incorrectos";
                            $login=false;
                        }else{
                            $mensaje="Usuario y contraseña correctos";
                            $emailBBDD=$prueba['correo'];
                            $nickBBDD=$prueba['nick'];
                            $login=true;

                        }

                } else {
                   // echo "<p class='error'>", "** Fallo en la ejecución de la consulta !!<br><br>" .$db->errno. " - " .$db->error. " **</p>";
                }
            } else {
                //echo "<p class='error'>", "* Fallo en la preparación de la consulta !!<br><br>en stmt: " .$db->errno. " y en mysqli: ".$db->error." *</p>";

            }



            echo $mensaje;*/
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
                   /* if($login){
                        $usuario= new Usuario;
                        $usuario->login_usuario($emailBBDD,$pass);*/
                        echo '<ul class="menu-user"><li id="mis-datos"><a href="datos.php">Mis Datos</a></li><li id="mis-favoritas"><a href="favoritas.php">Mis Favortias</a></li><li id="mis-valoraciones"><a href="valoracion.php">Valoración Pelis</a></li>';
                        if($_SESSION['rango']==0){
                            echo '<li id="administrar"><a href="../admin/index.php">Administrar</a></li>';
                        }
                        echo '</ul>';
                    //}
               //header("Location: datos.php");
               ?>
           </div>

		</section>
		<footer>
		    <a href="../index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>
