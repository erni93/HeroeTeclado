<?php
    require("../inc/funciones.inc.php");
    require_once("../class/Conexion.php");
    require_once("../class/Usuario.php");

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
		<title>Inicio de Sesión</title>
        <link rel="stylesheet" type="text/css" href="../css/normalize.css">
		<link rel="stylesheet" type="text/css" href="../css/login.css">

		<link href="https://fonts.googleapis.com/css?family=Sniglet" rel="stylesheet">
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script>
            function validar(){
                valido=true;
                $("#user+p").remove();
                $("#pass+p").remove();
                valor = $("#user").val();
                valor2 = $("#pass").val();
                if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {    
                    $("#user").after("<p>El campo de usuario no puede estar vacio</p>");
                    valido=false;
                }
                if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {          
                    $("#pass").after("<p>El campo de contraseña no puede estar vacio</p>");
                    valido=false;
                }
                return valido;
            }
        </script>
		<?php
            if(isset($_POST['acceder'])){
                $nick=$_POST['user'];
                $pass=md5($_POST['pass']);
                $instancia=Conexion::dameInstancia();
                $db=$instancia->conexion();
                $sql="SELECT * from usuarios WHERE nick='".$nick."'";
                $consulta=$db->query($sql);
                if($instancia->numRows($consulta) == 1){
                    $fila = $consulta->fetchArray(SQLITE3_ASSOC);
                    if($pass==$fila['password']){
                        $user = new Usuario;
                        if($user->login_usuario($fila['correo'],$fila['password'])){
                            header("Location: cuenta.php");     
                        }else{
                            $mensaje="Ha ocurrido un error al iniciar sesion, por favor intentelo mas tarde en unos segundos";
                        }
                    }else{
                        $mensaje="Contraseña incorrecta";
                    }
                }else{
                    $mensaje="No existe el usuario";
                }
            }
		?>
	</head>
	<body>
				
			
		<section>
           <div id="acceso">
                <div id="datos">
                   <form action="#" method="post" onsubmit="return validar()">
                   		<h1>Acceso a mi cuenta</h1>
	
                       <input type="text" placeholder="Usuario" class="login-input" name="user" id="user" value=<?php echo (isset($_POST['user']))?$_POST['user']:""; ?>><br />
                      <input type="password" class="login-input" placeholder="Contraseña" name="pass" id="pass"><br />

                       	<input type="submit" value="Acceder"  id="acceder" name="acceder"><button href="registro.php">¡Regístrate si no lo estas!</button><br/>
                        <a href="recordar_pass.php">¿Recordar contraseña?</a>
                   </form>
                <p><?php if(isset($_POST['acceder'])&&isset($mensaje)) echo $mensaje ?></p>
                </div>
              
           </div>
            
		</section>
        <a href="../index.php">Inicio</a>
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