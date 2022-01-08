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
        <?php require 'functions/functions.php'; ?>
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
			<div class='row  main-menu'>
				<form class="navbar-form navbar-left">
					<input type="text" class=" form-control" oninput="w3.filterHTML('#id01', '.item', this.value)" placeholder="A quien estás buscando?">							
				</form>
				<div class="navbar-right btn-pading-right">
					<button class="btn btn-info navbar-btn" data-toggle="modal" data-target="#myModal"> Sugerir cambio</button>
					<a class="btn btn-info navbar-btn" href="index.php" role="button">Inicio </a>
					<a class="btn btn-success" href="nuevo.php?new_extension" role="button">Nueva Extension </a>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Notificar falla</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="left-bar" class="col-md-2 bg-warning ">
				<fieldset>
					<div class="form-group">
						<legend>Marcación entre hoteles </legend> 
						<p>Me encuentro en: </p>
						<select class="form-control" name="origen" id="origen" required>
							<option disabled selected value> ------ </option>
							<option value="Sunset Royal">Royal Sunset</option>
							<option value="Hacienda tres rios">Hacienda tres rios</option>
							<option value="Ocean Spa">Ocean Spa</option>
							<option value="Sunset Marina">Sunset Marina</option>
							<option value="Sunset Fisherman">Fisherman</option>
							<option value="Laguna Suites">Laguna Suites</option>
							<option value="Plaza Hacienda">Plaza Hacienda (M4SG)</option>
							<option value="Servicenter">Servicenter</option>
							<option value="VIP Travel">VIP Travel</option>
							<option value="Spectrum">Spectrum</option>
						</select>
						<br>
						<p>Quiero marcar a: </p>
						<select class="form-control" name="destino" id="destino" required>
							<option disabled selected value> ------ </option>
							<option value="Sunset Royal">Royal Sunset</option>
							<option value="Hacienda tres rios">Hacienda tres rios</option>
							<option value="Ocean Spa">Ocean Spa</option>
							<option value="Sunset Marina">Sunset Marina</option>
							<option value="Sunset Fisherman">Fisherman</option>
							<option value="Plaza Hacienda">Plaza Hacienda (M4SG)</option>
							<option value="Servicenter">Servicenter</option>
							<option value="VIP Travel">VIP Travel</option>
							<option value="Spectrum">Spectrum</option>
							<option value="Laguna Suites directo">Laguna Suites directo</option>
							<option value="Hacienda tres rios directo">Hacienda tres rios directo</option>
							<option value="Ocean Spa directo">Ocean Spa directo</option>
							<option value="Admiral Yacht Club Directo">Admiral Yacht Club Directo</option>
						</select>
					</div>
					<input class="btn btn-default" type="submit" name="enviando" onclick="ajax_post();" value="¿Cómo marco?">
				</fieldset>
				<div id="marcadito"></div>
			</div>	
			<div class="col-md-10">
				<?php
					// require 'functions/conexion.php';
					lista_completa3();
					?>
			</div>
		</div>	
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Notificar Falla</h4><br>
					<p class="text-primary"> Utilice éste formulario para notificar fallas fuera del horario laboral. Se enviará una alerta al Móvil de Arturo
						</p>
					</div>
					<div class="modal-body">
						<form action='alertar.php' method='post'>
							<table>
								<tr><td>Cual es tu correo?</td><td><input title="Se usará para comunicar el dictamen técnico" type="email" name="mail" placeholder="Tu correo "></td></tr>
								<tr><td>Donde es la falla?*</td>
								<td>
									<select name="ubicacion" required>
										<option disabled selected value> ------ </option>
										<option value="Sunset Royal">Royal Sunset</option>
										<option value="Hacienda tres rios">Hacienda tres rios</option>
										<option value="Ocean Spa">Ocean Spa</option>
										<option value="Sunset Marina">Sunset Marina</option>
										<option value="Admiral Yacht Club">Admiral Yacht Club</option>
										<option value="Sunset Fisherman">Fisherman</option>
										<option value="Laguna Suites">Laguna Suites</option>
							<option value="Plaza Hacienda">Plaza Hacienda (M4SG)</option>
							<option value="Servicenter">Servicenter</option>
						</select>
					</td>
				</tr>
				<tr><td>Ext*</td><td><input type="text" name="ext" pattern="[0-9]{3,4}" required></td></tr>
				<tr><td>Cual es tu Nombre</td><td><input required type="text" name="nombre" ></td></tr>
				<tr><td>Comentario Adicional</td><td><textarea required name="comentarios" rows="3" cols="22"></textarea></td></tr>
				
				<tr><td><input class="btn btn-default"  type="submit" name="alertar" value="Alertar"></td></tr>
			</form>
		</table>
		<br>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>
</div>
</div>
<br>
</div>

</div>



<script>
	var resultado = document.getElementById("marcadito");
	var btn_editar=document.getElementById("editar");
	var btn_borrar=document.getElementById("borrar");
	btn_borrar.style.width="55px";
	btn_editar.style.width="55px";
	function confirmar(id) {
		var r = confirm('Desea borrar éste registro? ' +id);
		if (r==true){
			window.location.href="borrar.php?id="+id;
		}
		return false;
	}

	var resultado = document.getElementById("marcadito");
		function ajax_post(){
			var ajaxRequest;
			if (window.XMLHttpRequest) {
				ajaxRequest = new XMLHttpRequest();
			}else{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP")
			}
			var a = document.getElementById("origen").value;
			var b = document.getElementById("destino").value;
			var consulta = "origen="+ a +"&destino="+ b;
			
			ajaxRequest.onreadystatechange = function(){
			if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
				var mensaje = ajaxRequest.responseText;
				resultado.innerHTML = mensaje;
				/*
				document.getElementById("info").innerHTML = ajaxRequest.responseText;
				*/
			}
		}
		
			ajaxRequest.open("POST", "callfromhotel.php", true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxRequest.send(consulta)
		}
	
</script>
</body>
</html>