<?php
require_once("../class/Puntuacion.php");
require_once("../class/Conexion.php");
require_once("./funciones.inc.php");
iniciarSesion();

$puntuaciones=new Puntuacion;
$lPunt=$puntuaciones->verPuntuacionID($_SESSION['cancion']);
echo json_encode($lPunt);

?>
