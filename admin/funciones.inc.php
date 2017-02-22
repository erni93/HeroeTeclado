<?php
  require_once("../class/Cancion.php");
  require_once("../class/Usuario.php");
  require_once("../class/Rango.php");
  require_once("../class/Puntuacion.php");
  function cabeceraAdmin(){
    echo '
      <header>
      <nav>
        <ul class="container-fluid menu-admin">
          <li class="adInicio col-md-2 col-md-offset-1"><a href="index.php">Inicio</a></li>
          <li class="adCanciones col-md-2"><a href="canciones.php">Canciones</a></li>
          <li class="adPuntuaciones col-md-2 "><a href="puntuaciones.php">Puntuaciones</a></li>
          <li class="adUsuarios col-md-2 "><a href="usuarios.php">Usuarios</a></li>
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
  //FUNCIONES PARA CANCIONES.PHP
  if(isset($_REQUEST['o'])){
    switch ($_REQUEST['o']) {
      case 'b':
        buscarCancion($_POST['nombre']);
        break;
      case 't':
        verTodas();
        break;
      case 'd':
        borrarCancion($_POST['id']);
        break;
      case 'a':
        print_r($_FILES);
        //print_r($_POST);
        //print_r($_GET);
        //print_r($_REQUEST);
        anadirCancion($_POST['titulo'],$_POST['grupo'],$_POST['duracion'],$_FILES['caratula'],$_FILES['cancion']);
        break;
      default:
        # code...
        break;
    }
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
  function anadirCancion($titulo,$grupo,$duracion,$caratula,$cancion){
    $canciones=new Cancion;
    echo $canciones->addCancion($titulo,$grupo,$duracion,$caratula,$cancion);
  }

  //FUNCIONES PARA USUARIOS.PHP
  if(isset($_REQUEST['u'])){
    switch ($_REQUEST['u']) {
      case 'b':
        buscarUsuario($_POST['nombre']);
        break;
      case 'd':
        borrarUsuario($_POST['id']);
        break;
      case 'c':
        //echo $_POST['rangoN'];
        actualizarRango($_POST['id'],idRango($_POST['rangoN']));
        break;
      default:
        # code...
        break;
    }
  }
  function buscarUsuario($nom){
    $usuarios= new Usuario;
    $lista=$usuarios->verUsuariosN($nom);
    echo json_encode($lista);
  }
  function borrarUsuario($id){
    $usuarios=new Usuario;
    echo $usuarios->removeUser($id);
  }
  function idRango($nombre){
    $rangos=new Rango;
    return $rangos->verRangoID($nombre);
  }
  function actualizarRango($id,$rango){
    $usuarios=new Usuario;
    echo $usuarios->updateRango($id,$rango);
  }
  //FUNCIONES PARA PUNTUACIONES.PHP
  if(isset($_REQUEST['p'])){
    switch ($_REQUEST['p']) {
      case 'b':
        buscarPuntuacion($_POST['nombre']);
        break;
      case 'd':
        borrarPuntuacion($_POST['id']);
        break;
      default:
        # code...
        break;
    }
  }
  function buscarPuntuacion($nom){
    $puntuaciones= new Puntuacion;
    $lista=$puntuaciones->verPuntuacionesN($nom);
    echo json_encode($lista);
  }
  function borrarPuntuacion($id){
    $puntuaciones= new Puntuacion;
    echo $puntuaciones->removePuntuacion($id);
  }
?>
