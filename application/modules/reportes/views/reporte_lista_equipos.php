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

	//<!-- FIN IMAGEN DEL EQUIPO -->
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="3%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Nro.</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Vehículo.</strong></th>
					<th width="5%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Placa</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Línea</strong></th>
					<th width="5%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Modelo</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Color</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Clase de Vehículo</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Carrocería</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Combustible</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Capacidad</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Servicio</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Motor</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Serie/No. Chasis</strong></th>
					<th width="7%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Valor</strong></th>
					<th width="5%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Multas</strong></th>
					<th width="12%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Conductor Asignado</strong></th>				
				</tr>';
				$x=0;
				foreach ($infoEquipo as $lista):
					$x++;
					$combustible = $lista["combustible"]==1?"Gasolina":"Diesel";
					$multas = $lista['multas']==1?"Si":"No";
					$html.= '<tr>
								<th >' . $x. '</th>
								<th >' . $lista['tipo_equipo']. '</th>
								<th >' . $lista['placa']. '</th>
								<th >' . $lista['marca']. '</th>
								<th >' . $lista['modelo']. '</th>
								<th >' . $lista['color']. '</th>
								<th >' . $lista['clase_vehiculo']. '</th>
								<th >' . $lista['tipo_carroceria']. '</th>
								<th >' . $combustible. '</th>
								<th >' . $lista['capacidad']. '</th>
								<th >' . $lista['servicio']. '</th>
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