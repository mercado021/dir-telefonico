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

        </style>
    </head>
    <body>
        <div class="container">
          <div class="row bg-primary ">
			<div class="col-md-2">
			</div>
				<header>
					<div class="col-md-5">
						<h1>Directorio Sunset</h1>
					</div>
					
					<div class="col-md-4">
						<br> 
					  <p>
						 <input class="form-control" oninput="w3.filterHTML('#id01', '.item', this.value)" placeholder="A quien buscas?">
					  </p>
					</div>
				</header>
			</div>
				
          <section class="row bg-warning">
			  <div class="col-md-2 ">
					<div  class="form-group">
						<div>
							<br><br>
							<label>Marcación entre hoteles </label><br><br>
						  
							<form  action='edit.php' method='post'> 
								<p>Me encuentro en: </p>
								<select class="form-control" name="origen" required>
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
								<select class="form-control" name="destino" required><br>
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
								<input class="btn btn-default" type="submit" name="enviando" value="¿Cómo marco?">
							</form>
							<?php
								//require("functions/functions.php");
								if (isset($_POST["enviando"])) {
									# code...
									echo "<br>";
									f_busca_marcacion($_POST["origen"],$_POST["destino"]);
								}
							?>
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
							<form action='alertar' method='post'>
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
						
						
						
						
						
						
						
						
						
						
						<br><br><br>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Notificar falla</button><br><br>
						<a class="btn btn-success" href="nuevo.php?new_extension" role="button">Nueva Extension </a><br><br><br><br><br><br>
						<a class="btn btn-default" href="/" role="button">Salir </a>
					</div>
				</div>
				<div class="col-md-10">
					<?php
						// require 'functions/conexion.php';
						  lista_completa3();
					?>
				</div>
            </section>
        </div>
		<script>
	var btn_editar=document.getElementById("editar");
	var btn_borrar=document.getElementById("borrar");
	btn_borrar.style.width="55px";
	btn_editar.style.width="55px";
function confirmar(id) {
	
	var r = confirm('Desea borrar éste registro? ' +id);
	if (r==true){
		window.location.href="/borrar.php?id="+id;
	}
	return false;
}
		</script>
    </body>
</html>