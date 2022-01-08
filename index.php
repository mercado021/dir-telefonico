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
					<form class="navbar-form navbar-left">
						<input type="text" class=" form-control" oninput="w3.filterHTML('#id01', '.item', this.value)" placeholder="A quien estás buscando?">							
					</form>
					<div class=" navbar-right btn-pading-right">
						<button class="btn btn-info navbar-btn" data-toggle="modal" data-target="#myModal"> Sugerir cambio</button>
						<a class="btn btn-info navbar-btn" href="edit.php" role="button">Editar </a>
						<button class="btn btn-info navbar-btn" data-toggle="modal" data-target="#myModal2">Responsabilidad</button>
						<a class="btn btn-success navbar-btn dropdown-toggle" data-toggle="dropdown" href="#dropdown-menu">Locaciones</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $url?>?hotel=all">Todos</a></li>
							<li><a href="<?php echo $url?>?hotel=sr">Sunset Royal</a></li>
							<li><a href="<?php echo $url?>?hotel=sm">Sunset Marina</a></li>
							<li><a href="<?php echo $url?>?hotel=sf">Sunset Fisherman</a></li>
							<li><a href="<?php echo $url?>?hotel=h3r">Hacienda Tres Rios</a></li>
							<li><a href="<?php echo $url?>?hotel=os">Ocean Spa</a></li>
							<li><a href="<?php echo $url?>?hotel=ls">Laguna Suites</a></li>
							<li><a href="<?php echo $url?>?hotel=sc">Servicenter</a></li>
							<li><a href="<?php echo $url?>?hotel=ph">Plaza Hacienda</a></li>
							<li><a href="<?php echo $url?>?hotel=pm">Plaza Mayafair</a></li>
						</ul>
					</div>
				</div>	
			</div>




			<div class="row ">
				<div  class="col-sm-2 " >
					<fieldset>
						<div  class="form-group">
							<legend>Marcación entre hoteles </legend>
							<p>Me encuentro en: </p>
							<select class="form-control" name="origen" id="origen" required>
								<option disabled selected value> ------ </option>
								<option value="Sunset Royal">Royal Sunset</option>
								<option value="Hacienda tres rios">Hacienda tres rios</option>
								<option value="Ocean Spa">Ocean Spa</option>
								<option value="Sunset Marina">Sunset Marina</option>
								<option value="Admiral Yacht Club">Admiral Yacht Club</option>
								<option value="Sunset Fisherman">Fisherman</option>
								<option value="Laguna Suites">Laguna Suites</option>
								<option value="Plaza Hacienda">Plaza Hacienda (M4SG)</option>
								<option value="Plaza Mayafair">Plaza Mayafair</option>
								<option value="Servicenter">Servicenter</option>
							</select>
							<br>
							<p>Quiero marcar a: </p>
							<select class="form-control" name="destino" id="destino" required><br>
								<option disabled selected value> ------ </option>
								<option value="Sunset Royal">Royal Sunset</option>
								<option value="Hacienda tres rios">Hacienda tres rios</option>
								<option value="Ocean Spa">Ocean Spa</option>
								<option value="Sunset Marina">Sunset Marina</option>
								<option value="Admiral Yacht Club">Admiral Yacht Club</option>
								<option value="Sunset Fisherman">Fisherman</option>
								<option value="Plaza Hacienda">Plaza Hacienda (M4SG)</option>
								<option value="Plaza Mayafair">Plaza Mayafair</option>
								<option value="Servicenter">Servicenter</option>
								<option value="Laguna Suites directo">Laguna Suites - Directo</option>
								<option value="Hacienda tres rios directo">Hacienda tres rios - Directo</option>
								<option value="Ocean Spa directo">Ocean Spa - Directo</option>
								<option value="Admiral Yacht Club Directo">Admiral Yacht Club - Directo </option>
							</select>
						</div>
						<input class=" btn btn-default" type="submit" name="enviando" onclick="ajax_post();" value="¿Cómo marco?">
					</fieldset> 
					<div id="marcadito"></div>
				</div>	
				<div id="lista" class="col-xs-10 table-responsive">
					<?php
						require 'functions/conexion.php';
						require 'functions/functions.php';
						
						if (isset($_GET["hotel"])) {
							# code...
							#echo "hola mundo";
							#listaporhotel();
							switch ($_GET["hotel"]) {
								case "sr":
									#echo "i es igual a sr";
									listaporhotel("Sunset Royal");
									break;
									case "sm":
										listaporhotel("Sunset Marina");
										break;
										case "sf":
											listaporhotel("Fisherman");
											break;
											case "h3r":
												listaporhotel("Hacienda Tres Rios");
												break;
												case "os":
													listaporhotel("Ocean Spa");
													break;
													case "ls":
														listaporhotel("Laguna Suites");
														break;
														case "sc":
															listaporhotel("Servicenter");
															break;
															case "ph":
																listaporhotel("M4SG");
																break;
																case "pm":
																	listaporhotel("Plaza Mayafair");
																	break;
																	case "all":
																		#echo "i es igual a 2";
																		lista_completa();
																		break;
																		
																	}
																	
																	
																}else{
																	lista_completa();
																}
															
															
					?>
				</div>
				<div id="modales">
												  <!-- Modal Sugerir cambio-->
					  <div class="modal fade" id="myModal" role="dialog">
						  <div class="modal-dialog modal-md">
							  
							  <!-- Modal content-->
							  <div class="modal-content">
								  <div class="modal-header ">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h3 class="modal-title text-center">Sugerencias</h3>
									  <p class="text-muted"></p>
									</div>
									<div class="modal-body">
										<form action='mail.php' method='post'>
											<h4>Cual es tu correo?</h4>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"> <i class="glyphicon glyphicon-envelope"></i></span><input class="form-control" title="Se usará para notificarte cuando se aplique tu sugerencia" type="email" name="mail" placeholder="Tu correo ">
												</div>
											</div>
											<br>
											<h4>Ingresa tu sugerencia</h4>
											<div class="form-group" >
												<label class="radio-inline"><input type="radio" name="sugerencia" value="MODIFIQUE" > Modificar</label>
												<label class="radio-inline"><input type="radio" name="sugerencia" value="AGREGUE" checked> Agregar</label>
												<label class="radio-inline"><input type="radio" name="sugerencia" value="ELIMINE" > Eliminar</label>
											</div>
											<div class="form-group" >
												<div class="row">										
													<div class="col-sm-6">
														<div class="form-group">
															<label class="text-muted">Ubicacion *</label>
															<select class="form-control" name="ubicacion" required>
																<option disabled selected value> ------ </option>
																<option value="Sunset Royal">Royal Sunset</option>
																<option value="Hacienda tres rios">Hacienda tres rios</option>
																<option value="Ocean Spa">Ocean Spa</option>
																<option value="Sunset Marina">Sunset Marina</option>
																<option value="Admiral Yacht Club">Admiral Yacht Club</option>
																<option value="Sunset Fisherman">Fisherman</option>
																<option value="Laguna Suites">Laguna Suites</option>
																<option value="Plaza Hacienda">Plaza Hacienda (M4SG)</option>
																<option value="Plaza Hacienda">Plaza Mayafair</option>
																<option value="Servicenter">Servicenter</option>
															</select>
														</div>
														
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="text-muted">Ext a modificar *</label>
															<input class="form-control" type="text" placeholder="9999" name="ext" pattern="[0-9]{3,4}" required>
														</div>
													</div>
												</div>
										<div class="input-group">
											<span class="input-group-addon"> <i class="glyphicon glyphicon-user"></i></span><input class="form-control" placeholder="Nombre" type="text" name="nombre">
											<span class="input-group-addon"> <i class="glyphicon glyphicon-flag"></i></span><input class="form-control" placeholder="Departamento" type="text" name="depto">
										</div>
										<div class="input-group">
											<span class="input-group-addon"> <i class="glyphicon glyphicon-star"></i></span><input class="form-control" placeholder="Puesto" type="text" name="puesto">
										</div>
										<div class="input-group">
											<span class="input-group-addon"> <i class="glyphicon glyphicon-pencil"></i></span><textarea class="form-control" placeholder="Comentarios Adicionales" name="comentarios" rows="3" cols="22"></textarea>
										</div>
									</div>
									<input class="btn btn-success "  type="submit" name="solicitud" value="Sugerir">
								</form>
							</div>	
							<div class="modal-footer  ">
								<p class="text-left small"> 
									También puedes mandar tus sugerencias a los correos: 
									<br><em>odzul@sunset.com.mx, amercado@sunset.com.mx</em> <br>
									los cuales harán los cambios pertinentes
								</p>
								<!-- Comenté el boton de cierre para no olvidarme de como se pone-->
								<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal2" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Exclusion de responsabilidad</h4><br>
								<p class="bg-info text-muted" >
									<em> 
										El presente software "Directorio Sunset" es puesto a disposición de nuestros usuarios por el área de telefonía de Plaza Hacienda como  herramienta de consulta de extensiones con su respectiva descripción así cómo la marcación inter-empresa. <br><br>
										El sistema es entregado "COMO ES” y no se realizarán cambios en el funcionamiento, tampoco se asegura la operatividad diaria  ni se asume ninguna responsabilidad u obligación por el uso del mismo.<br><br>
										Si alguna información presentada es considerada "confidencial", favor de contactarnos para retirarla inmediatamente.
										Olga Dzul y el área de telefonía de Plaza Hacienda realizan actualizaciones eventuales de la información.
										Se utiliza software libre para la programación y la operación de este sistema.
										<br><br>
										<font size=1> Telefonía M4SG: amercado@sunset.com.mx </font>
									</em>
								</p>
							</div>
							<div class="modal-body">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
						</div>
						
						
					</div>
				</div>
			</div>		
		</div>
			

		
		<script>
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
			
			function sugerir(){
				alert("Tu sugerencia a sido enviada. Gracias por tu ayuda!");
			}
		</script>
    </body>
</html>