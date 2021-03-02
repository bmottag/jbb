<?php
// create some HTML content	
$html = '
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	</style>';
				
//datos especificos
if($infoEquipo)
{ 
	foreach ($infoEquipo as $lista):
		$html.= '<table cellspacing="0" cellpadding="5">
					<tr>
						<th rowspan="5" width="20%">
						<img src="' . base_url($lista['qr_code_img']) . '" class="img-rounded" width="150" height="150" />
						</th>
						<th bgcolor="#86bd62" style="color:white;" width="15%"><strong>Marca: </strong></th>
						<th width="20%">' . $lista['marca']. '</th>
					</tr>
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Modelo: </strong></th>
						<th >' . $lista['modelo']. '</th>
					</tr>
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Número Serial: </strong></th>
						<th >' . $lista['numero_serial']. '</th>
					</tr>
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Valor Comercial: </strong></th>
						<th >$ ' . $lista['valor_comercial']. '</th>
					</tr>
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Observación: </strong></th>
						<th >' . $lista['observacion']. '</th>
					</tr>
				</table>';
	endforeach;
}


//datos detalados
if($infoEspecifica)
{ 
	foreach ($infoEspecifica as $lista):
		$html.= '<br><br><table cellspacing="0" cellpadding="5">
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Placa: </strong></th>
						<th >' . $lista['placa']. '</th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Línea: </strong></th>
						<th >' . $lista['linea']. '</th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Color: </strong></th>
						<th >' . $lista['color']. '</th>
					</tr>
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Capacidad: </strong></th>
						<th >' . $lista['capacidad']. '</th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Servicio: </strong></th>
						<th >' . $lista['servicio']. '</th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Número Motor: </strong></th>
						<th >' . $lista['numero_motor']. '</th>
					</tr>
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Multas: </strong></th>
						<th >' . $lista['multas']. '</th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Clase Vehículo: </strong></th>
						<th >' . $lista['clase_vehiculo']. '</th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Tipo Carrocería: </strong></th>
						<th >' . $lista['tipo_carroceria']. '</th>
					</tr>
				</table>';
	endforeach;
}
			
echo $html;
						
?>