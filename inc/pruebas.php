<?php
  require_once("Cancion.php");
  $cancion=new Cancion();
  print_r($cancion->verCancion(1));
  echo "<br>";
  print_r($cancion->verCanciones());
 ?>
