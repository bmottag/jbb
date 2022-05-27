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
if($infoInspeccion)
{ 

	//<!-- FIN IMAGEN DEL EQUIPO -->
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>1. FECHA</strong></th>
					<th width="75%">' . $infoInspeccion[0]['fecha_registro']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>2. DEPEDENCIA</strong></th>
					<th>' . $infoInspeccion[0]['dependencia']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>3. NOMBRE DEL CONDUCTOR</strong></th>
					<th>' . $infoInspeccion[0]['name']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>4. KILOMETRAJE DEL VEHÍCULO</strong></th>
					<th>' . $infoInspeccion[0]['horas_actuales_vehiculo']. '</th>
				</tr>
			</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>VERIFICACIÓN DE DOCUMENTOS</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$licenciaCumple = "";
	$licenciaNOCumple = "";
	if($infoInspeccion[0]['licencia']==1){
		$licenciaCumple = "X";
		$licenciaNOCumple = "";
	}elseif($infoInspeccion[0]['licencia']==0){
		$licenciaCumple = "";
		$licenciaNOCumple = "X";
	}else{
		$licenciaCumple = "N/A";
		$licenciaNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LICENCIA DE CONDUCCIÓN</strong></th>
				<th style="text-align: center;">' . $licenciaCumple . '</th>
				<th style="text-align: center;">' . $licenciaNOCumple . '</th>
				<th ></th>
			</tr>';

	$soatCumple = "";
	$soatNOCumple = "";
	if($infoInspeccion[0]['soat']==1){
		$soatCumple = "X";
		$soatNOCumple = "";
	}elseif($infoInspeccion[0]['soat']==0){
		$soatCumple = "";
		$soatNOCumple = "X";
	}else{
		$soatCumple = "N/A";
		$soatNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SOAT</strong></th>
				<th style="text-align: center;">' . $soatCumple . '</th>
				<th style="text-align: center;">' . $soatNOCumple . '</th>
				<th ></th>
			</tr>';

	$tarjetaCumple = "";
	$tarjetaNOCumple = "";
	if($infoInspeccion[0]['tarjeta_propiedad']==1){
		$tarjetaCumple = "X";
		$tarjetaNOCumple = "";
	}elseif($infoInspeccion[0]['tarjeta_propiedad']==0){
		$tarjetaCumple = "";
		$tarjetaNOCumple = "X";
	}else{
		$tarjetaCumple = "N/A";
		$tarjetaNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>TARJETA DE PROPIEDAD</strong></th>
				<th style="text-align: center;">' . $tarjetaCumple . '</th>
				<th style="text-align: center;">' . $tarjetaNOCumple . '</th>
				<th ></th>
			</tr>';

	$seguroCumple = "";
	$seguroNOCumple = "";
	if($infoInspeccion[0]['seguro']==1){
		$seguroCumple = "X";
		$seguroNOCumple = "";
	}elseif($infoInspeccion[0]['seguro']==0){
		$seguroCumple = "";
		$seguroNOCumple = "X";
	}else{
		$seguroCumple = "N/A";
		$seguroNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SEGURO DE DAÑOS A TERCEROS</strong></th>
				<th style="text-align: center;">' . $seguroCumple . '</th>
				<th style="text-align: center;">' . $seguroNOCumple . '</th>
				<th ></th>
			</tr>';

	$html.= '</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>DIRECCIONALES</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$dir_delanterasCumple = "";
	$dir_delanterasNOCumple = "";
	if($infoInspeccion[0]['dir_delanteras']==1){
		$dir_delanterasCumple = "X";
		$dir_delanterasNOCumple = "";
	}elseif($infoInspeccion[0]['dir_delanteras']==0){
		$dir_delanterasCumple = "";
		$dir_delanterasNOCumple = "X";
	}else{
		$dir_delanterasCumple = "N/A";
		$dir_delanterasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DELANTERAS</strong></th>
				<th style="text-align: center;">' . $dir_delanterasCumple . '</th>
				<th style="text-align: center;">' . $dir_delanterasNOCumple . '</th>
				<th ></th>
			</tr>';

	$dir_traserasCumple = "";
	$dir_traserasNOCumple = "";
	if($infoInspeccion[0]['dir_traseras']==1){
		$dir_traserasCumple = "X";
		$dir_traserasNOCumple = "";
	}elseif($infoInspeccion[0]['dir_traseras']==0){
		$dir_traserasCumple = "";
		$dir_traserasNOCumple = "X";
	}else{
		$dir_traserasCumple = "N/A";
		$dir_traserasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>TRASERAS</strong></th>
				<th style="text-align: center;">' . $dir_traserasCumple . '</th>
				<th style="text-align: center;">' . $dir_traserasNOCumple . '</th>
				<th ></th>
			</tr>';

	$html.= '</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>LUCES</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>ALTAS</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';

	$luces_bajasCumple = "";
	$luces_bajasNOCumple = "";
	if($infoInspeccion[0]['dir_traseras']==1){
		$luces_bajasCumple = "X";
		$luces_bajasNOCumple = "";
	}elseif($infoInspeccion[0]['dir_traseras']==0){
		$luces_bajasCumple = "";
		$luces_bajasNOCumple = "X";
	}else{
		$luces_bajasCumple = "N/A";
		$luces_bajasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>BAJAS</strong></th>
				<th style="text-align: center;">' . $luces_bajasCumple . '</th>
				<th style="text-align: center;">' . $luces_bajasNOCumple . '</th>
				<th ></th>
			</tr>';

	$STOPSCumple = "";
	$STOPSNOCumple = "";
	if($infoInspeccion[0]['dir_traseras']==1){
		$STOPSCumple = "X";
		$STOPSNOCumple = "";
	}elseif($infoInspeccion[0]['dir_traseras']==0){
		$STOPSCumple = "";
		$STOPSNOCumple = "X";
	}else{
		$STOPSCumple = "N/A";
		$STOPSNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>STOPS</strong></th>
				<th style="text-align: center;">' . $STOPSCumple . '</th>
				<th style="text-align: center;">' . $STOPSNOCumple . '</th>
				<th ></th>
			</tr>';

	$reversaCumple = "";
	$reversaNOCumple = "";
	if($infoInspeccion[0]['dir_traseras']==1){
		$reversaCumple = "X";
		$reversaNOCumple = "";
	}elseif($infoInspeccion[0]['dir_traseras']==0){
		$reversaCumple = "";
		$reversaNOCumple = "X";
	}else{
		$reversaCumple = "N/A";
		$reversaNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>REVERSA</strong></th>
				<th style="text-align: center;">' . $reversaCumple . '</th>
				<th style="text-align: center;">' . $reversaNOCumple . '</th>
				<th ></th>
			</tr>';

	$parqueoCumple = "";
	$parqueoNOCumple = "";
	if($infoInspeccion[0]['dir_traseras']==1){
		$parqueoCumple = "X";
		$parqueoNOCumple = "";
	}elseif($infoInspeccion[0]['dir_traseras']==0){
		$parqueoCumple = "";
		$parqueoNOCumple = "X";
	}else{
		$parqueoCumple = "N/A";
		$parqueoNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>PARQUEO</strong></th>
				<th style="text-align: center;">' . $parqueoCumple . '</th>
				<th style="text-align: center;">' . $parqueoNOCumple . '</th>
				<th ></th>
			</tr>';

	$html.= '</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>LIMPIABRISAS</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DER/IZQ/ATRÁS</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';


	$html.= '</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>FRENOS</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>PRINCIPAL</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DE EMERGENIA</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';


	$html.= '</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>LLANTAS</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DELANTERAS</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>TRASERAS</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DE REPUESTO</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';


	$html.= '</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>ESPEJOS</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>NO CUMPLE</strong></th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>OBSERVACIONES</strong></th>
				</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DELANTERAS</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LATERALES</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';

	$luces_altasCumple = "";
	$luces_altasNOCumple = "";
	if($infoInspeccion[0]['luces_altas']==1){
		$luces_altasCumple = "X";
		$luces_altasNOCumple = "";
	}elseif($infoInspeccion[0]['luces_altas']==0){
		$luces_altasCumple = "";
		$luces_altasNOCumple = "X";
	}else{
		$luces_altasCumple = "N/A";
		$luces_altasNOCumple = "N/A";
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>RETROVISOR</strong></th>
				<th style="text-align: center;">' . $luces_altasCumple . '</th>
				<th style="text-align: center;">' . $luces_altasNOCumple . '</th>
				<th ></th>
			</tr>';


	$html.= '</table>';



//echo $html; exit;




}


			
echo $html;
						
?>