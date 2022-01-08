<!DOCTYPE html>
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
		<div class="row bg-primary">
			<div >
				<h1 class="text-center">Directorio Sunset</h1>
			</div>			
		</div>	
		<div class='row main-menu'>
			<div class="navbar-right btn-pading-right">
				<a class="btn btn-info navbar-btn" href="edit.php" role="button">Regresar </a>
			</div>
		</div>
			<div class="row">
				<div class="col-xs-4"></div>
				
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