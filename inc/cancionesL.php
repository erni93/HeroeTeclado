<?php
  require_once("../class/Cancion.php");
  require_once("../class/Conexion.php");
  require_once("funciones.inc.php");
  iniciarSesion();
  if(isset($_POST['c'])){
    switch ($_POST['c']) {
      case 'listar':
        listarCanciones();
        break;
      case 'cambiar':
        $_SESSION['cancion']=$_POST['cancion'];
        echo $_SESSION['cancion'];
        break;
      default:
        # code...
        break;
    }
  }
function listarCanciones(){
  $canciones= new Cancion;
  $lista=$canciones->verCanciones();
  echo json_encode($lista);
}
 ?>
