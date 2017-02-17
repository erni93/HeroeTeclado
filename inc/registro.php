<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Keyboard Hero</title>
        <!--Normalize Css -->
        <link rel="stylesheet" href="./css/normalize.css"   type="text/css" />
        <!--Bootstrap Css-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--Main Css-->
        <link rel="stylesheet" href="./css/main.css"        type="text/css" />
        <!--JQuery-->
        <script src="js/jquery-3.1.1.min.js"></script>
        <!--Bootstrap JQuery-->
        <script src="js/bootstrap.min.js"></script>
		<?php
            require("../class/Conexion.php");
            require("../class/Usuario.php");
		?>
	</head>
	<body>

		<header>		
			<h1>Registro nuevo usuario</h1>
		</header>
        <section>
        <?php
        if(isset($_POST['registrar'])){
            if($_FILES['imagen']['error']==0){
                    $imagen_temporal = $_FILES['imagen']['tmp_name'];
                    $tipo = $_FILES['imagen']['type'];
                    $fp = fopen($imagen_temporal, 'r+b');
                    $data = fread($fp, filesize($imagen_temporal));
                    fclose($fp);
                    $data = mysql_escape_string($data);
                    $newuser=new Usuario;
                    if($newuser->insertar_usuario($_POST['nick'],md5($_POST['pass']),$_POST['email'],$data)){
                        echo '<p class="noerror">Usuario registrado correctamente';
                    }else{
                        echo "<p class='error'>Problema al registrar el usuario. Usuario no registrado.</p>";
                    }
            }else if($_FILES['imagen']['error']==1){
                echo "<h1 class='error'>La imagen supera el limite de tamaño(2MB)</h1>";
                echo '<div id="registro">';
                    echo '<form action="#" method="post" enctype="multipart/form-data">';
                            echo '<p><label for="nick">Nick: </label><input name="nick" id="nick" type="text" required></p>';
                            echo '<p><label for="email">Email:</label><input name="email" id="email" type="text"></p>';
                            echo '<p><label for="pass">Contraseña: </label><input name="pass" id="pass" type="password"></p>';
                            echo '<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />';
                            echo '<p><label for="imagen">Imagen: </label><input name="imagen" id="imagen" type="file"></p>';
                            echo '<br /><input type="submit" name="registrar" value="registrar">';
                    echo '</form>';
                echo '</div> ';
            } else{

                $imagen_temporal = "../img/sinfoto.png";
                $fp = fopen($imagen_temporal, 'r+b');
                $data = fread($fp, filesize($imagen_temporal));
                fclose($fp);
                $data = mysql_escape_string($data);
                $newuser=new Usuario;
                if($newuser->insertar_usuario($_POST['nick'],md5($_POST['pass']),$_POST['email'],$data)){
                    echo '<p class="noerror">Usuario registrado correctamente';
                }else{
                    echo "<p class='error'>Problema al registrar el usuario. Usuario no registrado.</p>";
                }
            }
        }else{
            echo '<div id="registro">';
                echo '<form action="#" method="post" enctype="multipart/form-data">';
                        echo '<p><label for="nick">Nick: </label><input name="nick" id="nick" type="text" required></p>';
                        echo '<p><label for="email">Email:</label><input name="email" id="email" type="text"></p>';
                        echo '<p><label for="pass">Contraseña: </label><input name="pass" id="pass" type="password"></p>';
                        echo '<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />';
                        echo '<p><label for="imagen">Imagen: </label><input name="imagen" id="imagen" type="file"></p>';
                        echo '<br /><input type="submit" name="registrar" value="registrar">';
                echo '</form>';
            echo '</div> ';
        }
        
        
		?>
		<footer>
		    <a href="../index.php">Inicio</a>
			<p>Práctica 7 en PHP. David Parro Rubio</p>
		</footer>
	</body>
</html>