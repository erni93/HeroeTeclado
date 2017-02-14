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
            
            $login=false;
            if(isset($_SESSION['id'])){
                $usuario=$_SESSION['correo'];
                $pass=$_SESSION['password'];
            }else{
                $usuario=$_POST['user'];
                $pass=$_POST['pass'];
            }
            /*$mensaje="";
            $db = Conexion::dameInstancia();
            $mysqli = $db->dameConexion();
            $sql_query = "SELECT pass,email,nick FROM usuarios WHERE nick = ?;";
            $stmt = $mysqli->stmt_init();
            if ( $stmt->prepare($sql_query) ) {
                @$stmt->bind_param('s', $usuario);

                if ( $stmt->execute() ) {
                    $stmt->store_result();	
                    	
                    $stmt->bind_result($passBBDD,$emailBBDD,$nickBBDD);		
                    $stmt->fetch();

                        if($passBBDD!=$pass){
                            $mensaje="Usuario/contraseña incorrectos";
                            $login=false;
                        }else{
                            $mensaje="Usuario y contraseña correctos";
                            $login=true;
                          
                        }
                    if ($stmt->free_result()){
                        
                    }
                    
                } else {
                    echo "<p class='error'>", "** Fallo en la ejecución de la consulta !!<br><br>" .$stmt->errno. " - " .$stmt->error. " **</p>";	
                }
            } else {
                echo "<p class='error'>", "* Fallo en la preparación de la consulta !!<br><br>en stmt: " .$stmt->errno. " y en mysqli: ".$mysqli->error." *</p>";
               
            }*/

          
        
            
		?>
	</head>
	<body>
		<header>		
			<h1 class="usuariologueado">
                <?php if($login)echo "<a href='finalizarsesion.php'>Finalizar Sesion</a>";?>
			    <p><?php if($login)echo $emailBBDD;else echo "Usuario/contraseña incorrectos. <a href='login.php'>Volver</a>";?></p>
			    <p><?php if($login)echo $nickBBDD;?></p>
			    
			</h1>
		</header>
		<section>
           <div class="datosusuario">
               <?php
                    if($login){
                        $usuario= new Usuario;
                        $usuario->login_usuario($emailBBDD,$password);
                        echo '<ul class="menu-user"><li id="mis-datos"><a href="datos.php">Mis Datos</a></li><li id="mis-favoritas"><a href="favoritas.php">Mis Favortias</a></li><li id="mis-valoraciones"><a href="valoracion.php">Valoración Pelis</a></li></ul>';
                    }
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