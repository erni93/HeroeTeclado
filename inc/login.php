<?php

    require("./heroeteclado/inc/funciones.inc.php");


    iniciarSesion();
    if(isset($_SESSION['mi_uid'])){
        header("Location: cuenta.php");
    }
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

		?>
	</head>
	<body>
		<header>		
			<h1>Acceso a mi cuenta</h1>
		</header>
		<section>
           <div id="acceso">
                <div id="datos">
                   <form action="cuenta.php" method="post">
                        <input type="text" placeholder="Usuario" name="user" id="user"><br />
                        <input type="password" placeholder="Contraseña" name="pass" id="pass"><br />
                        <input type="submit" value="Acceder" id="acceder" name="acceder">
                        <a href="recordar_pass.php">¿Recordar contraseña?</a>
                   </form>
                </div>
                <div id="registrar">
                    <p>¿Aún no formas parte de nuestra red?</p>
                    <p class="carac">Comparte tu opinion</p>
                    <p class="carac">Valora las películas</p>
                    <p class="carac">Reserva entradas</p>
                    <a href="registro.php"><button>Registrar</button></a>
                </div>
           </div>
            
		</section>
		<footer>
		    <a href="index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>