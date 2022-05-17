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
					<th width="18%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Nro. Inventario</strong></th>
					<th width="18%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Placa</strong></th>
					<th width="26%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Dependencia</strong></th>
					<th width="18%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Marca</strong></th>
					<th width="18%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Modelo</strong></th>
				</tr>';

				foreach ($infoEquipo as $lista):
					$html.= '<tr>
								<th >' . $lista['numero_inventario']. '</th>
								<th >' . $lista['placa']. '</th>
								<th >' . $lista['dependencia']. '</th>
								<th >' . $lista['marca']. '</th>
								<th >' . $lista['modelo']. '</th>
							</tr>';
				endforeach;
	$html.= '</table>';


}


			
echo $html;
						
?>