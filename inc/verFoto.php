<?php
	require("../class/Conexion.php");
	header("Content-type: image/gif");
	$instancia = Conexion::dameInstancia();
	$con=$instancia->conexion();

	$sql="select * from usuarios where id = ?";
    $consulta = $con->prepare($sql);

    $consulta->bindValue(1, $_GET['id']);

    $resultado=$consulta->execute();

    if($instancia->numRows($resultado)==1){
      	$fila = $resultado->fetchArray();
        $_SESSION['avatar'] = $fila['avatar'];
    }

    echo $_SESSION['avatar'];
?>