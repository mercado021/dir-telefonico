<?php
		include('functions/conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Directorio Sunset</title>
		<link rel="icon" type="image/png" href="favicon.png" />
		<script src="<?php echo $url?>lib/jquery-3.2.1.js"></script>
		<script src="<?php echo $url?>lib/w3.js"></script>
		<script src="<?php echo $url?>bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="<?php echo $url?>bootstrap-3.3.7-dist/css/bootstrap.min.css" />
		<style>
			#menus {
				position: fixed;
			}
			.head{
				position: fixed;
				background-color:black;
				z-index: 1001;
			}
			.sidenav {
				position: fixed;
				
			}
			.top-pading{
				padding-top:120px;
				}
			.btn-pading-right{
				padding-right: 30px;
			}
			.main-menu{
				background-color: #4E6084;
			}
				body {
			position: relative; 
		}
			</style>
	</head>
    <body>
	<div class="container-fluid">

		<div>
			<div class="row bg-primary">
				<h1 class="text-center">Directorio Sunset</h1>
			</div>	
			<div class='row main-menu'>
				<div class="navbar-right btn-pading-right">
					<a class="btn btn-info navbar-btn" href="edit.php" role="button">Regresar </a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-2">

			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<?php
							//require 'functions/conexion.php';
							require 'functions/functions.php';
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
			<div class="col-sm-4">

			</div>
		</div>



	</div>
	
    </body>
</html>
