<?php
	require_once("../inc/funciones.inc.php");
	require_once("../class/Conexion.php");
	iniciarSesion();
	//Obtener cancion seleccionada
	//$_SESSION["cancion"] = "30";
	if (isset($_SESSION['id']) && isset($_SESSION["cancion"])){
		if (isset($_REQUEST["action"])){
			$action = $_REQUEST["action"];
			if ($action == "actualizar"){
				if (isset($_REQUEST["puntuacion"])){
					$id_cancion = $_SESSION["cancion"];
					$id_usuario = $_SESSION['id'];
					$puntuacion = intval($_REQUEST["puntuacion"]);
					//Verificar el tiempo de inicio del juego y el final para evitar falsas puntuaciones
					$instancia=Conexion::dameInstancia();
					$db=$instancia->conexion();
					$sql="INSERT INTO puntuaciones (id_cancion, id_usuario, puntuacion, fecha) VALUES ({$id_cancion}, {$id_usuario}, {$puntuacion}, datetime('now','localtime'))";
					$consulta=$db->query($sql);
					$consulta->finalize();
				}
			}else if ($action == "cancion"){
				$id_cancion = $_SESSION["cancion"];
				$instancia=Conexion::dameInstancia();
				$db=$instancia->conexion();
				$sql="SELECT ruta FROM canciones WHERE id={$id_cancion}";
				$consulta=$db->query($sql);
				$resultado = $consulta->fetchArray();
				$ruta = $resultado["ruta"];
				$consulta->finalize();
				echo $ruta;
			}
		}

	}else{
		echo "canciones/So-Payaso_Extremoduro";
	}

 ?>
