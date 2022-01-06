					<?php
						require("functions/functions.php");
							$origen = $_POST["origen"];
							$destino = $_POST["destino"];
							if(!empty($origen) || !empty($destino)){
								echo "<br>";
							f_busca_marcacion($_POST["origen"],$_POST["destino"]);
								
							}
					?>