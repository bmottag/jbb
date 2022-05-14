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
		border: 1px solid #939591;
		text-align: left;
		padding: 8px;
	}
	</style>';
				
//datos especificos
if($infoEquipo)
{ 

	$html = '<br><br><table cellspacing="0" cellpadding="5">
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;" colspan="5"><strong>Información del mantenimiento solicitado </strong></th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Nro. Inventario</strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Placa </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Dependencia</strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Marca </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Modelo</strong></th>
				</tr>
				<tr>';

				foreach ($infoEquipo as $lista):
					$html.= '<tr>
								<th >' . $lista['numero_inventario']. '</th>
								<th >' . $lista['numero_inventario']. '</th>
								<th >' . $lista['name']. '</th>
								<th >' . $lista['numero_inventario']. '</th>
								<th >' . $lista['numero_inventario']. '</th>
							</tr>';
				endforeach;
	$html.= '</tr>
			</table>';
}
			
echo $html;
						
?>