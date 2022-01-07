<?php

//session_start();

function lista_completa($filtro = NULL) {
    require("conexion.php");
    //echo 'Consulta SIN filtro<br>';
    if ($filtro <> NULL) {
        echo 'Consulta con filtro <br>' . $filtro . "<br>";
        $consulta = "SELECT departamento, puesto, nombre, exten, telefono, locacion "
                . "FROM dir_general "
                . "WHERE departamento LIKE %'$filtro'% or Locacion like %'$filtro'%"
                . "ORDER BY directorio.Locacion DESC";
        echo $consulta;
        echo mysqli_errno($conexion);
    } 
    else {
        $consulta = "SELECT departamento, puesto, nombre, exten, telefono, locacion "
                . "FROM dir_general "
                . "ORDER BY Locacion DESC";

        //echo "<br><br> $consulta <br><br>";
    }
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado == false) {
        # code...
        echo "No se ejecutó la consulta <br>";
        echo mysqli_errno($conexion);
    } else {
        $countfilas = 0;
        echo '<table class="table table-striped table-hover" id="id01">';
        echo '</thead>';
        echo "<tr>";
        //echo '<th>Id</th>';
        echo '<th>Locación</th>';
        echo '<th>Departamento</th>';
        echo '<th>Puesto</th>';
        echo '<th>Nombre</th>';
        echo '<th>Ext</th>';
        echo '<th>Telefono</th>';
        
        //echo "<th>Complejo</th>";
        echo '</thead>';
        echo "</tr><tbody>";
        
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
            $countfilas++;
            echo '<tr class="item">';
            //echo "<td id='$countfilas'> $countfilas</td><td>";
            echo "<td>";
            echo $fila['locacion'] . "</td><td>";
            echo $fila['departamento'] . "</td><td>";
            echo $fila['puesto'] . "</td><td>";
            echo $fila['nombre'] . "</td><td>";
            echo $fila['exten'] . "</td><td>";
            echo $fila['telefono'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    mysqli_close($conexion);
}

function btn_buscar(){
  $output ='<FORM method=GET action="index" method="get"> '
  .'<INPUT TYPE=text id="busqueda" name="busqueda" value="" size="25" /> '
  .'<INPUT type=submit  id="buscar" name=buscar VALUE="Buscar" />'
  .'</FORM>'
  ;
  echo $output;
  }


  function btn_nuevo(){
  $nuevo='<form action="nuevo" method="get">'
                . '<input type="submit" name="new_extension" value="Nueva Extension">'
                . '</form>'
                ;
                echo $nuevo;

}

function btn_quickUpdate($consulta){
	require("conexion.php");
	$resultado = mysqli_query($conexion, $consulta);
	if ($resultado == false) {
      # code...
      echo "No se ejecutó la consulta";
      echo mysqli_errno($conexion);
  }
}

function buscar_dpn($busqueda){
  //SELECT * FROM `directorio` WHERE `Departamento` LIKE "%sis%"
  //    OR Nombre LIKE "%sis%"
  //    OR Puesto LIKE "%sis%"
  require("conexion.php");
      $consulta = "SELECT Departamento, Puesto, Nombre, ext, telefono, Locacion "
              . "FROM directorio "
              . "WHERE Departamento LIKE '%$busqueda%' OR Nombre LIKE '%$busqueda%' "
              . "OR Puesto LIKE '%$busqueda%' "
              . "ORDER BY `directorio`.`Locacion`";
      //echo $consulta;

  $resultado = mysqli_query($conexion, $consulta);
  if ($resultado == false) {
      # code...
      echo "No se ejecutó la consulta";
      echo mysqli_errno($conexion);
  } elseif(mysqli_num_rows($resultado) <> 0) {
      $countfilas = 0;
      echo "<table border=1>";
      echo "<th>Id</th>";
      echo "<th>Departamento</th>";
      echo "<th>Puesto</th>";
      echo "<th>Nombre</th>";
      echo "<th>Ext</th>";
      echo "<th>Telefono</th>";
      // echo "<th>Complejo</th>";
      while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
          $countfilas++;
          echo "<tr><td id='$countfilas'> $countfilas</td><td>";
          echo $fila['Departamento'] . "</td><td>";
          echo $fila['Puesto'] . "</td><td>";
          echo $fila['Nombre'] . "</td><td>";
          echo $fila['ext'] . "</td><td>";
          echo $fila['telefono'] . "</td>";
          //echo $fila['Locacion'] . "</td>";
          echo "</tr>";
      }
      echo "</table>";
  }
  else {
    # code...
    echo "no se encontraron registros";
  }
  mysqli_close($conexion);
}

function menu_locaciones($foco = null){
  require("conexion.php");
  $output = '';
  $consulta = "SELECT DISTINCT Locacion FROM directorio "
          . "ORDER by Locacion ";
  $resultado = mysqli_query($conexion, $consulta);
  $output .= '<form action="index" method="get">'
          . '<select name="locacion">'
          ;
  if ($foco == NULL) {
    # code...
      $output .= '<option disabled selected value> -- Selecciona Locacion -- </option>'
              ;
    while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
        //echo $fila['Departamento'];
        $output .= "<option value=\"" . $fila['Locacion'] . "\">" . $fila['Locacion'] . "</option>"
                ;
    }
    $output .= "</select>"
            . '<input type="submit" value="consultar" name="filtro_depto">'
            . '</form>'
            . '<br>'
            ;
  }
  else {
    # code...
    while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
        //echo $fila['Departamento'];
        if ($fila['Locacion'] == $foco) {
          # code...
          $output .= "<option value=\"" . $fila['Locacion'] . "\" selected>" . $fila['Locacion'] . "</option>";
          //echo $fila['Departamento'] ."es diferente a $depto".
        }
        $output .= "<option value=\"" . $fila['Locacion'] . "\">" . $fila['Locacion'] . "</option>";
    }
    $output .= "</select>"
            . '<input type="submit" value="consultar" name="filtro_depto">'
            . '</form>'
            . '<br>'
    ;
  }
  //return $output;
  echo $output;

}

function menu_departamento($hotel = null, $foco = null) {
    require("conexion.php");
    $output = '';
    $output .= '<form action="index" method="get">'
            . '<input type="hidden" name="locacion" value="' . $hotel . '">'
            . '<select name="depto">'
            ;
    if ($hotel <> NULL) {
      # code...
      $consulta = "SELECT DISTINCT Locacion, Departamento FROM directorio "
              . "WHERE Locacion='$hotel' ORDER by Departamento ";
      $resultado = mysqli_query($conexion, $consulta);
      if ($foco == NULL) {
        # code...
        $output .= '<option disabled selected value> -- Selecciona departamento -- </option>'
        ;
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
            //echo $fila['Departamento'];

            $output .= "<option value=\"" . $fila['Departamento'] . "\">" . $fila['Departamento'] . "</option>";
        }
      }
        else {
          # code...
          while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
              //echo $fila['Departamento'];
              if ($fila['Departamento'] == $foco) {
                # code...
                $output .= "<option value=\"" . $fila['Departamento'] . "\" selected>" . $fila['Departamento'] . "</option>";
                //echo $fila['Departamento'] ."es diferente a $depto".
              }
              $output .= "<option value=\"" . $fila['Departamento'] . "\">" . $fila['Departamento'] . "</option>";
          }

        }
      }
    $output .= "</select>"
            . '<input type="submit" value="consultar" name="filtro_depto">'
            . '</form>'
            . '<br>'
    ;
    echo $output;
}

function correo($sugerencia, $ubicacion, $ext, $nombre=null, $depto=null, $puesto=null, $nodirecto=null, $comentario=null, $correo=null ){
	
	$to = "amercado@sunset.com.mx,odzul@sunset.com.mx";
	$message = "
	Por medio de la presente solicito se ".$sugerencia." la Extension ".$ext." con los siguientes datos. " ."\r\n". "
	Ubicacion: ".$ubicacion." " ."\r\n". "
	Nombre: ".$nombre." " ."\r\n". "
	Departamento: ".$depto." " ."\r\n". "
	Puesto: ".$puesto." " ."\r\n". "
	No. Directo: ".$nodirecto." " ."\r\n". "
	Comentario Adicional:" ."\r\n". " ".$comentario." 
	";
	$subject = "Dir telefonico - solicito se ".$sugerencia." Ext ".$ext;
	$headers = "From: directorio" . "\r\n" . "Reply-To: ".$correo .", amercado@sunset.com.mx, odzul@sunset.com.mx";
 
    mail($to, $subject, $message, $headers);
}

function alertar($ubicacion, $ext, $nombre, $comentarios=null, $correo=null ){
	
	$to = "dx82o7f45p@pomail.net,amercado@sunset.com.mx";
	$message = "
	Error en  " .$ubicacion."\r\n". "
	Comentario:" ."\r\n". " ".$comentarios."
	Reporta: ".$nombre." " ."\r\n". "
	Ext: ".$ext." " ."\r\n". "
	";
	$subject = $comentarios;
	$headers = "From: directorio" . "\r\n" . "Reply-To: ".$correo;
 
    mail($to, $subject, $message, $headers);
}

//Esta funcion sólo muestra el directorio, sin mostrar los botones de edicion

//Muestra los botones de editar en cada campo
function lista_completa2($hotel = NULL, $departamento = NULL) {
    require("conexion.php");
    if ($departamento <> NULL) {
        $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
                . "FROM directorio "
                . "WHERE Locacion='$hotel' && Departamento='$departamento' "//sustituir locacion y depto por las variables $hotel y $filtro, //&& Departamento='sistemas'
                . "ORDER BY `directorio`.`Departamento`";
                menu_departamento($hotel,$departamento);
    }   elseif  ($hotel <> NULL) {
      # code...
      $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
              . "FROM directorio "
              . "WHERE Locacion='$hotel' "//sustituir locacion y depto por las variables $hotel y $filtro, //&& Departamento='sistemas'
              . "ORDER BY `directorio`.`Departamento`";
              menu_departamento($hotel);
    }else {
      $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
              . "FROM directorio "
              //. "WHERE Locacion='$hotel' "//sustituir locacion y depto por las variables $hotel y $filtro, //&& Departamento='sistemas'
              . "ORDER BY `directorio`.`Locacion`";
             // menu_departamento();
    }
    $resultado = mysqli_query($conexion, $consulta);
    $encabezado = '<form class="form-inline" name="f1" action="medita" method="GET">';
    $tabla = '';
    $tabla .= '	<br>
				<div id="content" >
					<select name="mult-edit">
						<option value="Departamento" >Departamento</option>
						<option value="Locacion">Locacion</option>
						<option value="Puesto" >Puesto</option>
					</select>
					<input type="text" class="form-control" name="cambio">
					<input type="submit" class="btn btn-link" value="Edicion rápida">
				</div>
					<br>
					<table  class="table table-striped"  id="id01">
					<thead>
						<th><input type="checkbox" onclick="marcar(this);"></th>
						<th>Locacion</th>
						<th>Departamento</th>
						<th >Puesto</th>
						<th >Nombre</th>
						<th>Ext</th>
						<th>Telefono</th>
						<th >Edit</th>
					</thead><tbody>'
        ;
		//esto es para implementarlo en el futuro
		//$btn_check = '<input type="checkbox" name="check" id="check" onchange="showContent()" name="fila[]" value="' . $fila['id'].'">';
    while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
        $tabla .= '<tr class="item">
					<td>
						<input type="checkbox" name="fila[]" value="' . $fila['id'].'">
					</td>
					<td>' . $fila['Locacion'] . '</td>
					<td>' . $fila['Departamento'] . '</td>
					<td>' . $fila['Puesto'] . '</td>
					<td>' . $fila['Nombre'] . '</td>
					<td>' . $fila['ext'] . '</td>
					<td>' . $fila['telefono'] . '</td>
					<td style="width:60px;">
						<button type="button" style="width:55px;" onclick="location.href = \'edita?edita_fila='.$fila['id'].'\'">edita</button>
						<button type="button" style="width:55px;" onclick="confirmar('.$fila['id'].')">Borrar</button>
					</td>
                </tr>';
				
    }
	
    $tabla .= '</tbody></form>'
	."</table>";
    echo $encabezado;
    echo $tabla;
}

//Muestra los botones de editar pero no la columna de seleccionar.
function lista_completa3($hotel = NULL, $departamento = NULL) {
    require("conexion.php");
    $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
              . "FROM directorio "
              . "ORDER BY `directorio`.`Locacion`";
    
    $resultado = mysqli_query($conexion, $consulta);
    $encabezado = '';
    $tabla = '';
    $tabla .= '<table  class="table table-striped" id="id01">
				<thead><form action="#" method="post">
                <th>Locacion</th>
                <th>Departamento</th>
                <th >Puesto</th>
                <th >Nombre</th>
                <th>Ext</th>
                <th>Telefono</th>
                <th >Edit</th>
				</thead><tbody>'
        ;
    while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
        $tabla .= '<tr class="item">
					<td>' . $fila['Locacion'] . '</td>
					<td>' . $fila['Departamento'] . '</td>
					<td>' . $fila['Puesto'] . '</td>
					<td>' . $fila['Nombre'] . '</td>
					<td>' . $fila['ext'] . '</td>
					<td>' . $fila['telefono'] . '</td>
					<td style="width:60px;">
						<button type="button" style="width:55px;" id="editar" onclick="location.href = \'edita?edita_fila='.$fila['id'].'\'">Edita</button>
						<button type="button" style="width:55px;" id="borrar" onclick="confirmar('.$fila['id'].')">Borrar</button>
					</td>
                </tr>';
				
    }
	
    $tabla .= '</tbody></form>
	</table>';
    echo $encabezado;
    echo $tabla;
}


function listaporhotel($hotel="M4SG", $filtro = NULL) {
    require("conexion.php");
    if ($filtro <> NULL) {
        echo 'Consulta con filtro <br>' . $filtro . "<br>";
        $consulta = "SELECT Departamento, Puesto, Nombre, ext, telefono, Locacion "
                . "FROM directorio "
                . "WHERE Locacion='$hotel' && Departamento='$filtro' "
                . "ORDER BY `directorio`.`Departamento`";
        echo $consulta;
    } else {
       # echo 'Consulta SIN filtro<br>';
        $consulta = "SELECT Departamento, Puesto, Nombre, ext, telefono, Locacion "
                . "FROM directorio WHERE Locacion='$hotel' "
                . "ORDER BY `directorio`.`Departamento`";
        //echo "<br><br> $consulta <br><br>";
    }
    $resultado = mysqli_query($conexion, $consulta);
	/*
    if ($resultado == false) {
        # code...
        echo "No se ejecutó la consulta";
        echo mysqli_errno($conexion);
    } else {
        $countfilas = 0;
        echo "<table border=1>";
        echo "<th>Id</th>";
        echo "<th>Departamento</th>";
        echo "<th>Puesto</th>";
        echo "<th>Nombre</th>";
        echo "<th>Ext</th>";
        echo "<th>Telefono</th>";
        // echo "<th>Complejo</th>";
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
            $countfilas++;
            echo "<tr><td id='$countfilas'> $countfilas</td><td>";
            echo $fila['Departamento'] . "</td><td>";
            echo $fila['Puesto'] . "</td><td>";
            echo $fila['Nombre'] . "</td><td>";
            echo $fila['ext'] . "</td><td>";
            echo $fila['telefono'] . "</td>";
            //echo $fila['Locacion'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    mysqli_close($conexion);
	*/

	if ($resultado == false) {
        # code...
        echo "No se ejecutó la consulta <br>";
        echo mysqli_errno($conexion);
    } else {
        $countfilas = 0;
        echo '<table class="table table-striped table-hover" id="id01">';
		echo '</thead>';
        echo "<tr>";
        //echo '<th>Id</th>';
		echo '<caption class="text-center"><h4>'.$hotel.'</h4></caption>';
		echo '<th>Locación</th>';
        echo '<th>Departamento</th>';
        echo '<th>Puesto</th>';
        echo '<th>Nombre</th>';
        echo '<th>Ext</th>';
        echo '<th>Telefono</th>';
        
        //echo "<th>Complejo</th>";
		echo '</thead>';
        echo "</tr><tbody>";
		
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
            $countfilas++;
            echo '<tr class="item">';
            //echo "<td id='$countfilas'> $countfilas</td><td>";
			echo "<td>";
			echo $fila['Locacion'] . "</td><td>";
            echo $fila['Departamento'] . "</td><td>";
            echo $fila['Puesto'] . "</td><td>";
            echo $fila['Nombre'] . "</td><td>";
            echo $fila['ext'] . "</td><td>";
            echo $fila['telefono'] . "</td>";
            
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    mysqli_close($conexion);
	
	}

function selectbox_depto_autofoco($hotel,$depto) {
   require("conexion.php");
   $output = '';
   $consulta = "SELECT DISTINCT Departamento FROM directorio "
            . "WHERE Locacion='$hotel' ORDER by Departamento ";
    $output .= ''
    ;
    $resultado = mysqli_query($conexion, $consulta);
    while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
      if ($fila['Departamento'] == $depto) {
        # code...
        $output .= "<option value=\"" . $fila['Departamento'] . "\" selected>" . $fila['Departamento'] . "</option>";
        //echo $fila['Departamento'] ."es diferente a $depto".
      }
        $output .= "<option value=\"" . $fila['Departamento'] . "\">" . $fila['Departamento'] . "</option>";
    }

    // $output .= "</select>"
    ;
    return $output;
    mysqli_close($conexion);
}
/*
function selectbox_location($locacion = NULL) {
  require("conexion.php");
  $output = '';
  $consulta = "SELECT DISTINCT Locacion FROM directorio "
           //. "WHERE Locacion='$locacion' ORDER by Locacion ";
             . "ORDER by Locacion ";
   $output .= ''
   ;
   $resultado = mysqli_query($conexion, $consulta);
   while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
     if ($fila['Departamento'] == $depto) {
       # code...
       $output .= "<option value=\"" . $fila['Departamento'] . "\" selected>" . $fila['Departamento'] . "</option>";
       //echo $fila['Departamento'] ."es diferente a $depto".
     }
       $output .= "<option value=\"" . $fila['Departamento'] . "\">" . $fila['Departamento'] . "</option>";
   }
   ;
   return $output;
   mysqli_close($conexion);
}
*/

function selectbox_location() {
    require("conexion.php");
    $output = '';
        $consulta = "SELECT DISTINCT Locacion FROM directorio "
                . "ORDER by Locacion ";
        $output .= ''
                //. '<input type="select" name="depto">'
                . '<option disabled selected value> -- Selecciona Ubicacion -- </option>'
        ;
        $resultado = mysqli_query($conexion, $consulta);
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
            //echo $fila['Departamento'];
            $output .= "<option value=\"" . $fila['Locacion'] . "\">" . $fila['Locacion'] . "</option>";
        }
    
    
    return $output;
    mysqli_close($conexion);
}

function selectbox_depto($hotel = NULL) {
    require("conexion.php");
    $output = '';
    if ($hotel <> NULL) {
        $consulta = "SELECT DISTINCT Departamento FROM directorio "
                . "WHERE Locacion='$hotel' ORDER by Departamento ";
        $output .= ''
               // . '<input type="select" name="depto">'
                . '<option disabled selected value> -- Selecciona departamento -- </option>'
        ;
        $resultado = mysqli_query($conexion, $consulta);
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
            $output .= "<option value=\"" . $fila['Departamento'] . "\">" . $fila['Departamento'] . "</option>";
        }
    }
    else {
        $consulta = "SELECT DISTINCT Departamento FROM directorio "
                . "ORDER by Departamento ";
        $output .= ''
                //. '<input type="select" name="depto">'
                . '<option disabled selected value> -- Selecciona departamento -- </option>'
        ;
        $resultado = mysqli_query($conexion, $consulta);
        while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == TRUE) {
            //echo $fila['Departamento'];
            $output .= "<option value=\"" . $fila['Departamento'] . "\">" . $fila['Departamento'] . "</option>";
        }
    }
    ;
    return $output;
    mysqli_close($conexion);
}

function select($hotel = NULL, $departamento = NULL) {
    require("conexion.php");
    if ($departamento <> NULL) {
        $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
                . "FROM directorio "
                . "WHERE Locacion='$hotel' && Departamento='$departamento' "//sustituir locacion y depto por las variables $hotel y $filtro, //&& Departamento='sistemas'
                . "ORDER BY `directorio`.`Departamento`";
                menu_departamento($hotel,$departamento);
    }   elseif  ($hotel <> NULL) {
      # code...
      $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
              . "FROM directorio "
              . "WHERE Locacion='$hotel' "//sustituir locacion y depto por las variables $hotel y $filtro, //&& Departamento='sistemas'
              . "ORDER BY `directorio`.`Departamento`";
              menu_departamento($hotel);
    }else {
      $consulta = "SELECT id, Departamento, Puesto, Nombre, ext, telefono, Locacion "
              . "FROM directorio "
              //. "WHERE Locacion='$hotel' "//sustituir locacion y depto por las variables $hotel y $filtro, //&& Departamento='sistemas'
              . "ORDER BY `directorio`.`Locacion`";
              menu_departamento();
    }
    $resultado = mysqli_query($conexion, $consulta);
    $encabezado = '';
    $tabla = '';
    $encabezado .='<form action="index" method="get">';
    $encabezado . "<fieldset>"
            . "<legend>Edicion</legend>";
    $encabezado .= "<select name='accion'>"
            . "<option value='Editar'>Editar</option>"
            . "<option value='nuevo'>Agregar Extension</option>"
            . "<option value='Eliminar'>Eliminar</option>"
            . "</select>"
    ;
    $encabezado .= "<select name='campo'>"
            . "<option value='departamento'>Departamento</option>"
            . "<option value='puesto'>Puesto</option>"
            . "</select>"
    ;
    $encabezado .= '<input type="submit" name="mass_action" value="Accion Multiple"></input>'
            . '</fieldset>'
    ;
    $tabla .= '<table border=1 id="id01">'
                . '<th><input type="reset" value="Reset"></th>'
                . '<th>Departamento</th>'
                . '<th>Puesto</th>'
                . '<th>Nombre</th>'
                . '<th>Ext</th>'
                . '<th>Telefono</th>'
                . '<th></th>'
        ;
    while (($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) == true) {
        $tabla .= '<tr class="item">'
                . '<td>'
                . '<input type="checkbox" name="fila[]" value="' . $fila['id'] . '">'
                . '</form>'
                . '<form action="edita" method="get">'
                . '<input type="hidden" name="edita_fila" value="' . $fila['id'] . '">'
                //  . '<input type="submit" value="Edit">'
                . '</td>'
                . "<td>" . $fila['Departamento'] . "</td>"
                . "<td>" . $fila['Puesto'] . "</td>"
                . "<td>" . $fila['Nombre'] . "</td>"
                . "<td>" . $fila['ext'] . "</td>"
                . "<td>" . $fila['telefono'] . "</td>"
                . '<td><input type="submit" value="Edit"></td>'
                . '</form>'
                . '</tr>';
    }
    $tabla .= "</table>";
    echo $encabezado;
    echo $tabla;
}

function editar($fila = NULL) {
    require("conexion.php");
    if ($fila == NULL) {
      # code...
      //entra en esta parte del IF cuando se va a Insertar nueva extension
      //echo "edito sin filtro";
      $consulta = "SELECT Departamento "
				. "FROM directorio "
              //. "WHERE id='$fila' "
      ;
      $resultado = mysqli_query($conexion, $consulta);
      $resultado = mysqli_fetch_array($resultado, MYSQL_ASSOC);
     // $select = selectbox_depto($resultado['Locacion']);
      $locacion= selectbox_location();
      $depto = selectbox_depto();

      $output = '';
      $output .= "<table class=\"table table-striped\">"
              . '<form action="nuevo" method="get">'
              . "<tr>"
                  . "<th>Locacion</th>"
                  . "<th>Departamento</th>"
                  . "<th>Puesto</th>"
                  . "<th>Nombre</th>"
                  . "<th>Extension</th>"
                  . "<th>Telefono</th>"
              . "</tr>"
              . "<tr>"
                  . '<td> <select class="form-control" name="locacion">'. $locacion .'</select></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9]{,20}" type="text" name="depto" value=""></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="puesto" value=""></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="nombre" value=""></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="ext" value=""></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="telefono" value=""></td>'
              . "</tr>"
              . '<tr>'
                   . '<td colspan=6><input type="submit" name="nueva_ext" value="Agrega"></td>'
              . '</tr>'
      ;
      $output .= "</form></table>";
      echo $output;
    }
	else {
      # code...
      $consulta = "SELECT * "
              . "FROM directorio "
              . "WHERE id='$fila' "
      ;
      $resultado = mysqli_query($conexion, $consulta);
      $resultado = mysqli_fetch_array($resultado, MYSQL_ASSOC);
     // $select = selectbox_depto($resultado['Locacion']);
      $selectbox = selectbox_depto_autofoco($resultado['Locacion'],$resultado['Departamento']);

      $output = '';
      $output .= "<table class=\"table table-striped\">"
              . '<form action="edita" method="get">'
              . "<tr>"
                  . "<th>Locacion</th>"
                  . "<th>Departamento</th>"
                  . "<th>Puesto</th>"
                  . "<th>Nombre</th>"
                  . "<th>Extension</th>"
                  . "<th>Telefono</th>"
              . "</tr>"
              . "<tr>"
                  . '<input type="hidden" name="id" value="' . $resultado['id'] . '">'
                  . '<input type="hidden" name="locacion" value="' . $resultado['Locacion'] . '">'
                  . '<td><input class="form-control" disabled type="text" name="locacion" value="' . $resultado['Locacion'] . '"></td>'
                  //. '<td><input type="text" name="depto" value="' . $resultado['Departamento'] . '"></td>'
                  . '<td> <select class="form-control"  name="depto">'. $selectbox .'</select></td>'
                  //selectbox_depto
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="puesto" value="' . $resultado['Puesto'] . '"></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="nombre" value="' . $resultado['Nombre'] . '"></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="ext" value="' . $resultado['ext'] . '"></td>'
                  . '<td><input class="form-control" pattern="[a-zA-Z0-9].{1,40}|.{}" type="text" name="telefono" value="' . $resultado['telefono'] . '"></td>'
              . "</tr>"
              . '<tr>'
                   . '<td colspan=6><input class="btn btn-default" type="submit" name="actualiza" value="actualiza"></td>'
              . '</tr>'
      ;
      $output .= "</form></table>";
      echo $output;
    }
}

//función editar2 sólo fue una copia por si todo fallaba al editar la funcion original
//se puede borrar si ya todo jala bien con la funcion editar()
function editar2($fila = NULL) {
    require("conexion.php");
    if ($fila == NULL) {
      # code...
      //echo "edito sin filtro";
      $consulta = "SELECT Departamento "
              . "FROM directorio "
              //. "WHERE id='$fila' "
      ;
      $resultado = mysqli_query($conexion, $consulta);
      $resultado = mysqli_fetch_array($resultado, MYSQL_ASSOC);
     // $select = selectbox_depto($resultado['Locacion']);
      $selectbox = selectbox_depto();

      $output = '';
      $output .= "<table border=1>"
              . '<form action="agregar" method="get">'
              . "<tr>"
                  . "<th>Locacion</th>"
                  . "<th>Departamento</th>"
                  . "<th>Puesto</th>"
                  . "<th>Nombre</th>"
                  . "<th>Extension</th>"
                  . "<th>Telefono</th>"
              . "</tr>"
              . "<tr>"
                  //. '<input type="hidden" name="id" value="' . $resultado['id'] . '">'
                  . '<td><input type="text" name="locacion" value=""></td>'
                  //. '<td><input type="text" name="depto" value="' . $resultado['Departamento'] . '"></td>'
                  . '<td> <select name="depto">'. $selectbox .'</select></td>'
                  //selectbox_depto
                  . '<td><input type="text" name="puesto" value=""></td>'
                  . '<td><input type="text" name="nombre" value=""></td>'
                  . '<td><input type="text" name="ext" value=""></td>'
                  . '<td><input type="text" name="telefono" value=""></td>'
              . "</tr>"
              . '<tr>'
                   . '<td colspan=6><input type="submit" name="agregar_reg" value="agrega"></td>'
              . '</tr>'
      ;
      $output .= "</form></table>";
      echo $output;
    }else {
      # code...
      $consulta = "SELECT * "
              . "FROM directorio "
              . "WHERE id='$fila' "
      ;
      $resultado = mysqli_query($conexion, $consulta);
      $resultado = mysqli_fetch_array($resultado, MYSQL_ASSOC);
     // $select = selectbox_depto($resultado['Locacion']);
      $selectbox = selectbox_depto_autofoco($resultado['Locacion'],$resultado['Departamento']);

      $output = '';
      $output .= "<table border=1>"
              . '<form action="edita" method="get">'
              . "<tr>"
                  . "<th>Locacion</th>"
                  . "<th>Departamento</th>"
                  . "<th>Puesto</th>"
                  . "<th>Nombre</th>"
                  . "<th>Extension</th>"
                  . "<th>Telefono</th>"
              . "</tr>"
              . "<tr>"
                  . '<input type="hidden" name="id" value="' . $resultado['id'] . '">'
                  . '<td><input type="text" name="locacion" value="' . $resultado['Locacion'] . '"></td>'
                  //. '<td><input type="text" name="depto" value="' . $resultado['Departamento'] . '"></td>'
                  . '<td> <select name="depto">'. $selectbox .'</select></td>'
                  //selectbox_depto
                  . '<td><input type="text" name="puesto" value="' . $resultado['Puesto'] . '"></td>'
                  . '<td><input type="text" name="nombre" value="' . $resultado['Nombre'] . '"></td>'
                  . '<td><input type="text" name="ext" value="' . $resultado['ext'] . '"></td>'
                  . '<td><input type="text" name="telefono" value="' . $resultado['telefono'] . '"></td>'
              . "</tr>"
              . '<tr>'
                   . '<td colspan=6><input type="submit" name="actualiza" value="actualiza"></td>'
              . '</tr>'
      ;
      $output .= "</form></table>";
      echo $output;
    }
}
function actualiza($id, $locacion, $depto, $puesto, $nombre, $ext, $tele) {
    require("conexion.php");
    $consulta = "UPDATE `directorio` "
            . "SET `Locacion` = '$locacion', "
            . "`Departamento` = '$depto', "
            . "`Puesto` = '$puesto', "
            . "`Nombre` = '$nombre', "
            . "`ext` = '$ext', "
            . "`telefono` = '$tele' "
            . "WHERE `directorio`.`id` = '$id'"
    ;
    $resultado = mysqli_query($conexion, $consulta);
    if (mysqli_connect_errno($resultado)) {
        # code...
        echo "Hubo un error al editar el registro";
        exit();
    } else {
        echo $consulta . "<br>";
        printf("Affected rows (SELECT): %d\n", mysqli_affected_rows($conexion));
    }
}

function inserta($locacion, $depto, $puesto, $nombre, $ext, $tele) {
    require("conexion.php");
    $consulta = "INSERT INTO `directorio` "
            . "(`Departamento`, `ext`, `telefono`, `Nombre`, `Puesto`,"
            . "`Locacion`) "
            . "VALUES ('$depto','$ext','$tele','$nombre','$puesto','$locacion')"
    ;
    $resultado = mysqli_query($conexion, $consulta);
    if (mysqli_connect_errno($resultado)) {
        # code...
        echo "Hubo un error al ingresar el registro";
        exit();
    } else {
        echo $consulta . "<br>";
        //printf("Affected rows (SELECT): %d\n", mysqli_affected_rows($conexion));
    }
}

function borrar($id) {
    require("conexion.php");
    $consulta = "DELETE FROM `directorio` "
            . "WHERE id = {$id}"
    ;
    $resultado = mysqli_query($conexion, $consulta);
    if (mysqli_connect_errno($resultado)) {
        # code...
        echo "Hubo un error al borrar el registro";
        exit();
    } else {
       // echo $consulta . "<br>";
        //printf("Affected rows (SELECT): %d\n", mysqli_affected_rows($conexion));
    }
}

function f_busca_marcacion($origen,$destino){
	//require("conexion_dirtelefonico.php");
	require("conexion.php");
	//$select = "select Prefijo from prefijos where Origen='$origen' && Destino='$destino'";
	if ($origen==$destino) {
		# code...
		echo "<b>Extension</b>";
	}else{
	$query_prefijo=mysqli_query($conexion,"select Prefijo from prefijos where Origen='$origen' && Destino='$destino'");
	$prefijo=mysqli_fetch_array($query_prefijo,MYSQLI_ASSOC);
	switch (true) {
		case $prefijo['Prefijo']=="NA":
			# code...
		echo "<b>No puedes marcar a esta Ubicación</b>";
			break;
		case $prefijo['Prefijo']=="Ext.":
			# code...
		echo "<b>Extension</b>";
			break;
		case 
		$prefijo['Prefijo']=="78483, (998) 891 5252" || 
		$prefijo['Prefijo']=="*110 o bien (998) 287 4100" ||
		$prefijo['Prefijo']=="(984) 877 2400" ||
		$prefijo['Prefijo']=="(998) 848 7170" ||
		$prefijo['Prefijo']=="6 + Ext, Alternativa: 3 + Ext"||
		$prefijo['Prefijo']=="(998) 849 5317, (998) 849 5318":
			# code...
		echo "De ".$origen." ----> ".$destino ."<b>: ".$prefijo['Prefijo']."</b>";
			break;
		case
		$prefijo['Prefijo']=="8 + EXT, Alternativa: 84444"||		
		$prefijo['Prefijo']=="5 + Ext, Alternativa: 56666":
		echo "De ".$origen." ----> ".$destino ."<b>: ".$prefijo['Prefijo']. "</b> Directo a Operadora";
		break;
	
		default:
			# code...
		echo "De ".$origen." ----> ".$destino ."<b>: ".$prefijo['Prefijo']." + Ext.</b><br>";
		//echo $select;
			break;
	}
	mysqli_close($conexion);
	}
}
?>
