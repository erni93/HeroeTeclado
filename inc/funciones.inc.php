<?php
function iniciarSesion(){
	session_cache_limiter();
    session_name('heroeteclado');
    session_start();
}

function crearNombreIdSesion() {
	$sn=session_name();
	$si=session_id();
	$_SESSION['nombreId'] = $sn."=". $si;
}

function verImagen($id){
	$instancia = Conexion::dameInstancia();
	$con=$instancia->conexion();
}
function imprimirPuntuaciones(){
	$puntuaciones=new Puntuacion();
	$listaP=$puntuaciones->verPuntuaciones();
	for ($i=0; $i < 10 ; $i++) {
		# code...
		echo "<tr>";
			echo "<td>".$listaP[$i]['titulo']."</td>";
			echo "<td>".$listaP[$i]['puntuacion']."</td>";
			echo "<td>".$listaP[$i]['nick']."</td>";
		echo "</tr>";
	}
}
function validarPass($pass){
	$expresionReg='/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,8}$/i';
	if (preg_match($expresionReg, $pass)) {
		return true;
	} else{
		return false;
	}
}
function validarCorreo($correo){
	$expresionReg='/^[a-zA-Z0-9]+([[a-zA-Z0-9\.]+)*@([_a-z0-9\-]+\.)+([a-z])+$/i';
	if (preg_match($expresionReg, $correo)) {
		return true;
	} else{
		return false;
	}
}
function imprimirRegistro(){
	echo '<div id="registro">';
			echo '<form action="#" method="post" enctype="multipart/form-data">';
					echo '<h1>Registro nuevo usuario</h1>';
							echo '<p><label for="nick">Nick: </label><input name="nick" id="nick" type="text" required></p>';
							echo '<p><label for="email">Email:</label><input placeholder="Formato x@x.x" name="email" id="email" type="text"></p>';
							echo '<p><label for="pass">Contraseña: </label><input placeholder="Entre 4 y 8 caracteres, mínimo 1 may, 1 mín y 1 número" name="pass" id="pass" type="password"></p>';
							echo '<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />';
							echo '<p><label for="imagen">Imagen: </label><input name="imagen" id="imagen" type="file"></p>';
							echo '<br /><input class="iregistro" type="submit" name="registrar" value="Registrar">';
			echo '</form>';
	echo '</div> ';
}
function generaPass(){
	//Se define una cadena de caractares.
	$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	//Obtenemos la longitud de la cadena de caracteres
	$longitudCadena=strlen($cadena);
	//Se define la variable que va a contener la contraseña
	$pass = "";
	//Se define la longitud de la contraseña
	$longitudPass=8;
	//Creamos la contraseña
	for($i=1 ; $i<=$longitudPass ; $i++){
		//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
		$pos=rand(0,$longitudCadena-1);
		$pass .= substr($cadena,$pos,1);
	}
	return $pass;
}
function mandarPass($correo,$pass){
	$mensaje="Ha solicitado cambiar su contraseña.\r".
	"El sistema le ha asignado una contraseña aleatoria, por favor cambiela nada más acceda a su cuenta de nuevo.\n".
	"La contraseña que le ha asignado el sistema es: ".$pass."\n".
	"\n\nUn saludo de la administración de Heroe del Teclado";
	$mensaje=wordwrap($mensaje,70,"\r\n");
	/*return mail($correo,'Heroe del Teclado--Recuperacion Contraseña',$mensaje);*/
		$mail = new PHPMailer();

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  											// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = "heroetecladodaw@gmail.com";        // SMTP username
		$mail->Password = "galileo2017";                      // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		$mail->setFrom("heroetecladodaw@gmail.com", 'Heroe del Teclado');
		$mail->addAddress($correo);               // Name is optional


		$mail->Subject = 'Heroe del Teclado--Recuperar contraseña';
		$mail->Body    = $mensaje;
		$mail->AltBody = $mensaje;

		if(!$mail->send()) {
		    return $mail->ErrorInfo;
		} else {
		    return 1;
		}

}
?>
