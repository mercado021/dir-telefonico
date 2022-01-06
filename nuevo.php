<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Directorio Sunset</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		
        <script src="https://www.w3schools.com/lib/w3.js"></script>
		<script src="/lib/jquery-3.2.1"></script>
        <script src="/lib/w3.js"></script>
        <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
		
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
			<div class="row">
			<?php
				require 'functions/conexion.php';
				require 'functions/functions.php';
				//filtro_hotel
				if (isset($_GET["new_extension"])) {
					# code...
					editar();
				}
				if (isset($_GET["nueva_ext"])) {
					# code...
					inserta($_GET["locacion"], $_GET["depto"], $_GET["puesto"], $_GET["nombre"],$_GET["ext"], $_GET["telefono"]);
					Header( "Location: edit.php");
				}
				?>
			
			</div>
		</div>
    </body>
</html>