<?php
  require("../class/Cancion.php");
  if(isset($_POST['o'])){
    switch ($_POST['o']) {
      case 'b':
        $nombre=$_POST['nombre'];
        buscarCancion($nombre);
        break;
      case 't':
        verTodas();
        break;
      case 'd':
        borrarCancion($_POST['id']);
        break;
      default:
        # code...
        break;
    }
  }
  function cabeceraAdmin(){
    echo '
      <header>
      <nav>
        <ul class="container-fluid menu-admin">
          <li class="adInicio col-md-2 col-md-offset-1"><a href="index.php">Inicio</a></li>
          <li class="adCanciones col-md-2"><a href="canciones.php">Canciones</a></li>
          <li class="adPuntuaciones col-md-2 "><a href="">Puntuaciones</a></li>
          <li class="adUsuarios col-md-2 "><a href="">Usuarios</a></li>
          <li class="miCuenta col-md-2 "><a href="../inc/cuenta.php">Mi Cuenta</a></li>
        </ul>
      </nav>
    </header>';
  }
  function formatearTexto($text){
    $nText="";
    $nText.=strtoupper(substr($text,0,1));
    $nText.=strtolower(substr($text,1));
    return $nText;
  }
  function buscarCancion($nom){
    $canciones= new Cancion;
    $lista=$canciones->verCancionN($nom);
    echo json_encode($lista);
  }
  function verTodas(){
    $canciones= new Cancion;
    $lista=$canciones->verCanciones();
    echo json_encode($lista);
  }
  function borrarCancion($id){
    $canciones=new Cancion;
    echo $canciones->removeCancion($id);
  }
?>
