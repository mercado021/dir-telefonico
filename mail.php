<?php
require 'functions/conexion.php';
require 'functions/functions.php';

            if (isset($_POST["solicitud"])) {
            # code...
            correo($_POST["sugerencia"],$_POST["ubicacion"],$_POST["ext"],$_POST["depto"],$_POST["nombre"],$_POST["puesto"],$_POST["nodirecto"],$_POST["comentarios"],$_POST["mail"]);
			}
			header('Location: index.php');

?>