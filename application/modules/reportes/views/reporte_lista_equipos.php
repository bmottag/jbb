<?php
// create some HTML content	
$html = '<style>
			table {
				font-family: arial, sans-serif;
				border: 1px solid black;
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid black;
				text-align: left;
				padding: 8px;
			}
			</style>';
				
//datos especificos
if($infoEquipo)
{ 

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="35%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Propietario/Entidad Asignada/Entidad tenedora del Vehículo:</strong></th>
					<th width="20%">Jardín Botánico De Bogotá</th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Identificación del Propietario:</strong></th>
					<th width="20%">860030197</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo de Servicio</strong></th>
					<th>Oficial</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong></strong></th>
					<th></th>
				</tr>
			</table><br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Nro. Inventario</strong></th>
					<th width="5%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Placa</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Línea</strong></th>
					<th width="5%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Modelo</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Color</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Clase de Vehículo</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Carrocería</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Combustible</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Capacidad</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Motor</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Serie/No. Chasis</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Valor</strong></th>
					<th width="5%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Multas o Restricciones</strong></th>
					<th width="12%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Conductor Responsable</strong></th>				
				</tr>';

/*
placa 
cédula conductor
motivo
*/
				$x=0;
				foreach ($infoEquipo as $lista):
					$x++;
					$combustible = $lista["combustible"]==1?"Gasolina":"Diesel";
					$multas = $lista['multas']==1?"Si":"No";
					$html.= '<tr>
								<th >' . $lista['numero_inventario']. '</th>
								<th >' . $lista['placa']. '</th>
								<th >' . $lista['marca']. '</th>
								<th >' . $lista['modelo']. '</th>
								<th >' . $lista['color']. '</th>
								<th >' . $lista['clase_vehiculo']. '</th>
								<th >' . $lista['tipo_carroceria']. '</th>
								<th >' . $combustible. '</th>
								<th >' . $lista['capacidad']. '</th>
								<th >' . $lista['numero_motor']. '</th>
								<th >' . $lista['numero_chasis']. '</th>
								<th >$ ' . number_format($lista['valor_comercial'],0). '</th>
								<th >' . $multas. '</th>
								<th >' . $lista['name'] . '<br>C.C. ' . $lista['numero_cedula'] . '</th>

							</tr>';
				endforeach;
	$html.= '</table>';


}


			
echo $html;
						
?>