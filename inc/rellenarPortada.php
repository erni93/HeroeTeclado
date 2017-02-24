<?php
require_once("../class/Cancion.php");
require_once("../class/Conexion.php");
require_once("./funciones.inc.php");
iniciarSesion();

$cancion=new Cancion;
$dCan=$cancion->verCancion($_SESSION['cancion']);
echo json_encode($dCan);
?>
