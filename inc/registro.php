<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Keyboard Hero</title>
        <!--Normalize Css -->
        <link rel="stylesheet" href="../css/normalize.css"   type="text/css" />
        <!--Bootstrap Css-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!--Main Css-->
        <link rel="stylesheet" href="../css/login.css"        type="text/css" />
        <!--JQuery-->
        <script src="../js/jquery-3.1.1.min.js"></script>
        <!--Bootstrap JQuery-->
        <script src="../js/bootstrap.min.js"></script>
				<!--Font Awesome-->
				<script src="https://use.fontawesome.com/2c348761fe.js"></script>
		<?php
            require("../class/Conexion.php");
            require("../class/Usuario.php");
						require("../inc/funciones.inc.php");
		?>
	</head>
	<body>

		<header>

		</header>
        <section>
        <?php
        if(isset($_POST['registrar'])){
            if($_FILES['imagen']['error']==0){

							if(validarPass($_POST['pass'])){
								if(validarCorreo($_POST['email'])){
									$dir_subida = '../img/';
									$fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);
									if (move_uploaded_file($_FILES['imagen']['tmp_name'], $dir_subida.$_FILES['imagen']['name'])){
										 echo "El archivo ha sido cargado correctamente.";
									}else{
										 echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
									}
									$data=file_get_contents($fichero_subido);
									$newuser=new Usuario;
									if($newuser->insertar_usuario($_POST['nick'],md5($_POST['pass']),$_POST['email'],$data)){
											echo '<p class="noerror">Usuario registrado correctamente';
											header("Refresh: 5; ./login.php");
									}else{
											echo "<p class='error'>Problema al registrar el usuario. Usuario no registrado.</p>";
									}
								}else{
									 echo "<p class='error'>El correo debe tener el formato _@_._.</p>";
									 imprimirRegistro();
								}
							}else{
								echo "<p class='error'>La contraseña debe tener entre 4 y 8 caracteres,y por lo menos una mayúscula,una minúscula y un número.</p>";
								imprimirRegistro();
							}


            }else if($_FILES['imagen']['error']==1){
                echo "<h1 class='error'>La imagen supera el limite de tamaño(2MB)</h1>";
                imprimirRegistro();
            } else{
                $imagen_temporal = "../img/sinfoto.png";
                $data=file_get_contents($imagen_temporal);
								if(validarPass($_POST['pass'])){
									if(validarCorreo($_POST['email'])){
										$newuser=new Usuario;
		                if($newuser->insertar_usuario($_POST['nick'],md5($_POST['pass']),$_POST['email'],$data)){
		                    echo '<p class="noerror">Usuario registrado correctamente';
												header("Refresh: 5; ./login.php");
		                }else{
		                    echo "<p class='error'>Problema al registrar el usuario. Usuario no registrado.</p>";
												imprimirRegistro();
		                }
									}else{
										 echo "<p class='error'>El correo debe tener el formato _@_._.</p>";
										 imprimirRegistro();
									}
								}else{
								  echo "<p class='error'>La contraseña debe tener entre 4 y 8 caracteres,y por lo menos una mayúscula, una minúscula y un número.</p>";
									imprimirRegistro();
								}

            }
        }else{
            imprimirRegistro();
        }


		?>
		<footer>
						<a href="../inc/cuenta.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
