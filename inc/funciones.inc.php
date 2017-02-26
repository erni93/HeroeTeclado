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
							echo '<p><label for="email">Email:</label><input name="email" id="email" type="text"></p>';
							echo '<p><label for="pass">Contraseña: </label><input name="pass" id="pass" type="password"></p>';
							echo '<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />';
							echo '<p><label for="imagen">Imagen: </label><input name="imagen" id="imagen" type="file"></p>';
							echo '<br /><input class="iregistro" type="submit" name="registrar" value="Registrar">';
			echo '</form>';
	echo '</div> ';
}
?>
