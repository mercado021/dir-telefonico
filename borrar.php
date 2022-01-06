<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Directorio Sunset</title>
        <style>
        </style>
    </head>
    <body>
        <?php
        require 'functions/conexion.php';
        require 'functions/functions.php';
        //filtro_hotel
        if (isset($_GET["id"])) {
            # code...
            borrar($_GET["id"]);
			//echo $_GET["id"];
			Header( "Location: edit.php");
        }
		/*
        if (isset($_GET["actualiza"])) {
            # code...
            actualiza($_GET["id"], $_GET["locacion"], $_GET["depto"], $_GET["puesto"], $_GET["nombre"],$_GET["ext"], $_GET["telefono"]);
            Header( "Location: http://$dominio/$proyecto/users/edit.php");
        }
		*/
        ?>
    </body>
</html>
