<?php
    require_once("../class/Cancion.php");
    require_once("../class/Conexion.php");
    require_once("../inc/funciones.inc.php");
    iniciarSesion();
    function getCancionSec(){
        $cancion=new Cancion;
        $dCan=$cancion->verCancion($_SESSION['cancion']);
        $duracionMin = $dCan["duracion"];
        $parsed = date_parse($duracionMin);
        $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
        return $seconds;
    }
 ?>