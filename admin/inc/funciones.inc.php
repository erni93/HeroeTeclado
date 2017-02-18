<?php
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


?>
