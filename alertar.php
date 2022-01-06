<?php
require 'functions/conexion.php';
require 'functions/functions.php';

            if (isset($_POST["alertar"])) {
            # code...
            alertar($_POST["ubicacion"],$_POST["ext"],$_POST["nombre"],$_POST["comentarios"],$_POST["mail"]);
			}
			header('Location: edit.php');

?>