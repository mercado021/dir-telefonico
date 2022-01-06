<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Directorio Sunset</title>
		<link rel="icon" type="image/png" href="favicon.png" />
        <script src="https://www.w3schools.com/lib/w3.js"></script>
		<script src="/lib/jquery-3.2.1.js"></script>
        <script src="/lib/w3.js"></script>
        <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <?php require 'functions/functions.php'; ?>
        <style>
		header{
background:#2c3e50;
color:#fff;
}
        </style>
    </head>
    <body>
	<div class="container">
        <div class="row bg-primary">
			<div class="col-md-2"></div>
			<header>
				<div class="col-md-5">
					<h1>Directorio Sunset</h1>
				</div>
				
				<div class="col-md-4">
					<br> 
          
				</div>
			</header>
			</div>
		
		
		<div class"row">
			<div class="form-group">
				<?php
				require 'functions/conexion.php';
				//filtro_hotel
				if (isset($_GET["edita_fila"])) {
					# code...
					editar($_GET["edita_fila"]);
				}
				if (isset($_GET["actualiza"])) {
					# code...
					actualiza($_GET["id"], $_GET["locacion"], $_GET["depto"], $_GET["puesto"], $_GET["nombre"],$_GET["ext"], $_GET["telefono"]);
					Header( "Location: edit.php");
				}
				?>
			</div>
		</div>
	</div>
    </body>
</html>
