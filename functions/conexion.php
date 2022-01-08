<?php
	$host="localhost";
	$dbname="directoriotelefonico";
	$dbuser="root";
	$dbpass="sys73xrv";
	$dominio="172.101.1.146";
	$proyecto="dir-telefonico";
	$url = "http://" . $_SERVER["SERVER_NAME"] ."/". $proyecto."/"; //aquí debo quitar la barra final y hacer que lo pongan explisito en los archivos donde lo usen
	$conexion=mysqli_connect($host,$dbuser,$dbpass);
	if (mysqli_connect_errno($conexion)) {
		# code...
		echo "hubo un error al conectar a la BD";
		exit();
	}
	mysqli_set_charset($conexion,"utf8");
	mysqli_select_db( $conexion,"$dbname") or die("no se pudo seleccionar la BD");
?>
