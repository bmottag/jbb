<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("reportes_model");
    }

	/**
	 * Generate Hoja de vida del Equipo en PDF
	 * @param int $idEquipo
     * @since 14/5/2021
     * @author BMOTTAG
	 */
	public function hojaVidaPDF($idEquipo)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('MANUAL DE PROCESOS');
			$pdf->SetSubject('FIS');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MANUAL DE PROCESOS Y PROCEDIMIENTOS', "FIS - GESTIÓN DE RECURSOS FÍSICOS \nHOJA DE VIDA VEHICULAR ", array(0,140,0), array(147,204,110));	
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 5);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$html = '<table border="0" cellspacing="0" cellpadding="5" >
						<tr>
							<th width="20%" style="text-align:center;"></th>
							<th width="60%" style="text-align:center;">
								<table cellspacing="0" cellpadding="5">
									<tr>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="34%"><strong>Código: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Versión: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Fecha: </strong></th>
									</tr>
									<tr>
										<th style="text-align:center;">FIS.PR.06.F.08</th>
										<th style="text-align:center;">1</th>
										<th style="text-align:center;">10/06/2019</th>
									</tr>
								</table>
							</th>
						</tr>
					</table>';
			$html.='<br><br>';
			$pdf->writeHTML($html, true, false, true, false, '');

			$arrParam = array('idEquipo' => $idEquipo);
			$data['infoEquipo'] = $this->reportes_model->get_equipos_info($arrParam);
			$arrParam['idTipoDocumento'] = ID_TIPO_DOC_SOAT;
			$data['infoSOAT'] = $this->reportes_model->get_documento($arrParam);
			$arrParam['idTipoDocumento'] = ID_TIPO_DOC_TECNO_MECANICA;
			$data['infoTecnoMecanica'] = $this->reportes_model->get_documento($arrParam);
			$arrParam['idTipoDocumento'] = ID_TIPO_DOC_POLIZA;
			$data['infoPoliza'] = $this->reportes_model->get_documento($arrParam);

			$consulta = $data['infoEquipo'][0]['formulario_especifico'];
			$data['infoEspecifica'] = $this->reportes_model->$consulta($arrParam);

			$data['fotosEquipos'] = $this->reportes_model->get_fotos_equipos($arrParam);

			$html2 = $this->load->view('reporte_hoja_vida', $data, true);


			//$html = $this->load->view('reporte_equipos_detalle_vehiculo', $data, true);

			// output the HTML content
			$pdf->writeHTML($html2, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();

			ob_end_clean();
			//Close and output PDF document
			$pdf->Output('hv_equipo_' . $idEquipo . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}
	
	/**
	 * Generate Hoja de vida del Equipo en PDF
	 * @param int $idEquipo
     * @since 1/3/2021
     * @author BMOTTAG
	 */
	public function infoEquipoPDF($idEquipo)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$arrParam = array('idEquipo' => $idEquipo);
			$data['infoEquipo'] = $this->reportes_model->get_equipos_info($arrParam);

			$data['listadoLocalizacion'] = $this->reportes_model->get_localizacion($arrParam);
			$data['listadoControlCombustible'] = $this->reportes_model->get_control_combustible($arrParam);
			$data['listadoDocumentos'] = $this->reportes_model->get_documento($arrParam);
			$data['fotosEquipos'] = $this->reportes_model->get_fotos_equipos($arrParam);

			$consulta = $data['infoEquipo'][0]['formulario_especifico'];
			$data['infoEspecifica'] = $this->reportes_model->$consulta($arrParam);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('RESERVAS');
			$pdf->SetSubject('TCPDF Tutorial');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'HOJA DE VIDA', 'No. Inventario: ' . $data['infoEquipo'][0]['numero_inventario'] . "\nTipo Equipo: " . $data['infoEquipo'][0]['tipo_equipo'], array(94,164,49), array(147,204,110));					

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 7);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$vista = 'reporte_' .  $consulta;
			$html = $this->load->view($vista, $data, true);

			if($data['listadoLocalizacion']){
				$html .= $this->load->view('reporte_localizacion', $data, true);
			}
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			if($data['listadoDocumentos']){
				$pdf->AddPage();
				$html = $this->load->view('reporte_documentos', $data, true);
				// output the HTML content
				$pdf->writeHTML($html, true, false, true, false, '');
			}

			if($data['listadoControlCombustible']){

				$pdf->AddPage();
				$html = $this->load->view('reporte_combustible', $data, true);
				// output the HTML content
				$pdf->writeHTML($html, true, false, true, false, '');
			}
			// Print some HTML Cells

			// reset pointer to the last page
			$pdf->lastPage();


			//Close and output PDF document
			$pdf->Output('hv_equipo_' . $idEquipo . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}

	/**
	 * Generate Informe de una OT en PDF
	 * @param int $idOrdenTrabajo
     * @since 16/9/2021
     * @author BMOTTAG
	 */
	public function reporteOT($idOrdenTrabajo)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$arrParam = array("idOrdenTrabajo" => $idOrdenTrabajo);
			$data['infoOT'] = $this->reportes_model->get_orden_trabajo($arrParam);
			$data['infoDocumentos'] = $this->reportes_model->get_documento_ot($arrParam);//busco documentos
			//buscar historial de estados orden de trabajo
			$data['infoEstado'] = $this->reportes_model->get_estado_orden_trabajo($arrParam);

			$arrParam = array(
				"idMantenimiento" => $data['infoOT'][0]['fk_id_mantenimiento'],
				"tipoMantenimiento" => $data['infoOT'][0]['tipo_mantenimiento']
			);			
			//buscar informacion del mantenimiento
			if($data['infoOT'][0]['tipo_mantenimiento']== 1)
			{
				$data['infoMantenimiento'] = $this->reportes_model->get_mantenimiento_correctivo($arrParam);
			}else{
				$data['infoMantenimiento'] = $this->reportes_model->get_mantenimiento_preventivo_equipo($arrParam);
			}

			//busco datos del vehiculo
			$arrParam['idEquipo'] = $data['infoOT'][0]['fk_id_equipo_ot'];
			$data['infoEquipo'] = $this->reportes_model->get_equipos_info($arrParam);//busco datos del vehiculo

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->reportes_model->get_fotos_equipos($arrParam);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('RESERVAS');
			$pdf->SetSubject('TCPDF Tutorial');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'HOJA DE VIDA', 'No. Inventario: ' . $data['infoEquipo'][0]['numero_inventario'] . "\nTipo Equipo: " . $data['infoEquipo'][0]['tipo_equipo'], array(94,164,49), array(147,204,110));					

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 7);

			$pdf->AddPage();

			$html = $this->load->view('reporte_info_equipo', $data, true);
			$html .= $this->load->view('reporte_mantenimiento', $data, true);
			$html .= $this->load->view('reporte_ot', $data, true);

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();


			//Close and output PDF document
			$pdf->Output('onden_trabajo_' . $idOrdenTrabajo . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		
	}

	/**
	 * Descargar listado de equipos
     * @since 17/5/2022
     * @author BMOTTAG
	 */
	public function litadoEquipos()
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('MANUAL DE PROCESOS');
			$pdf->SetSubject('FIS');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MANUAL DE PROCESOS Y PROCEDIMIENTOS', "ANEXO 1- INVENTARIO DE PARQUE AUTOMOTOR 2022", array(0,140,0), array(147,204,110));	
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(3, PDF_MARGIN_TOP, 3);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 5);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			$pdf->AddPage('L', 'A4');

			$arrParam = array("idTipoEquipo" => 1, "estadoEquipo" => 1);
			$data['infoEquipo'] = $this->reportes_model->get_vehiculos_info($arrParam);

			$html = $this->load->view('reporte_lista_equipos', $data, true);

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();

			ob_end_clean();
			//Close and output PDF document
			$pdf->Output('listado_equipos.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}

	/**
	 * Inspecciones en PDF
	 * @param int $idInspeccion
     * @since 22/5/2021
     * @author BMOTTAG
	 */
	public function inspecciones($idInspeccion)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('MANUAL DE PROCESOS');
			$pdf->SetSubject('FIS');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MANUAL DE PROCESOS Y PROCEDIMIENTOS', "FIS - GESTIÓN DE RECURSOS FÍSICOS \nChequeo preoperacional diario sobre el estado de los vehículos ", array(0,140,0), array(147,204,110));	
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 6);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$html = '<table border="0" cellspacing="0" cellpadding="5" >
						<tr>
							<th width="20%" style="text-align:center;"></th>
							<th width="60%" style="text-align:center;">
								<table cellspacing="0" cellpadding="5">
									<tr>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="34%"><strong>Código: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Versión: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Fecha: </strong></th>
									</tr>
									<tr>
										<th style="text-align:center;">FIS.PR.06.F.13</th>
										<th style="text-align:center;">1</th>
										<th style="text-align:center;">5/11/2021</th>
									</tr>
								</table>
							</th>
						</tr>
					</table>';
			$html.='<br><br>';
			$pdf->writeHTML($html, true, false, true, false, '');

			$arrParam = array('idInspeccion' => $idInspeccion);
			$data['infoInspeccion'] = $this->reportes_model->get_inspecciones($arrParam);

			$html2 = $this->load->view('reporte_inspeccion_vehiculos', $data, true);

			// output the HTML content
			$pdf->writeHTML($html2, true, false, true, false, '');
/*
			$html3 = '<table border="0" cellspacing="0" cellpadding="5" >';
			if($data['infoInspeccion'][0]['signature ']){
				$html3.= '<tr>
							<th>'. $data['infoInspeccion'][0]['signature'] . '</th>
						</tr>';
			}
				$html3.= '<tr>
							<th width="25%">'. $data['infoInspeccion'][0]['name'] . '</th>
						</tr>';
			$html3.= '</table>';
	

			$pdf->writeHTML($html3, true, false, true, false, '');
*/
			// reset pointer to the last page
			$pdf->lastPage();

			ob_end_clean();
			//Close and output PDF document
			$pdf->Output('inpeccion_cotidiana_' . $idInspeccion . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}

	/**
	 * Encuesta en PDF
	 * @param int $idEncuesta
     * @since 22/5/2021
     * @author BMOTTAG
	 */
	public function encuesta($idEncuesta)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('MANUAL DE PROCESOS');
			$pdf->SetSubject('FIS');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MANUAL DE PROCESOS Y PROCEDIMIENTOS', "FIS - GESTIÓN DE RECURSOS FÍSICOS \nEncuesta de Satisfacción ", array(0,140,0), array(147,204,110));	
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 6);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$arrParam = array('idEncuesta' => $idEncuesta);
			$data['infoEncuesta'] = $this->reportes_model->get_encuestas($arrParam);

			$html = $this->load->view('reporte_encuesta_vehiculos', $data, true);

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();

			ob_end_clean();
			//Close and output PDF document
			$pdf->Output('encuesta_satisfaccion' . $idEncuesta . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}

	/**
	 * Descargar Comparendos por Equipo
     * @since 30/5/2022
     * @author BMOTTAG
	 */
	public function comparendos($idEquipo)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('MANUAL DE PROCESOS');
			$pdf->SetSubject('FIS');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MANUAL DE PROCESOS Y PROCEDIMIENTOS', "FIS - GESTIÓN DE RECURSOS FÍSICOS \nFormato: Verificación de comparendos a conductores y parque automotor ", array(0,140,0), array(147,204,110));	
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 7);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			$pdf->AddPage('L', 'A4');

			$html = '<table border="0" cellspacing="0" cellpadding="5" >
						<tr>
							<th width="20%" style="text-align:center;"></th>
							<th width="60%" style="text-align:center;">
								<table cellspacing="0" cellpadding="5">
									<tr>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="34%"><strong>Código: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Versión: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Fecha: </strong></th>
									</tr>
									<tr>
										<th style="text-align:center;">FIS.PR.06.F.12</th>
										<th style="text-align:center;">1</th>
										<th style="text-align:center;">30/11/2021</th>
									</tr>
								</table>
							</th>
						</tr>
					</table>';
			$html.='<br><br>';
			$pdf->writeHTML($html, true, false, true, false, '');

			$arrParam = array("idEquipo" => $idEquipo);
			$data['infoComparendos'] = $this->reportes_model->get_comparendos($arrParam);

			$html2 = $this->load->view('reporte_lista_comparendos', $data, true);

			// output the HTML content
			$pdf->writeHTML($html2, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();

			ob_end_clean();
			//Close and output PDF document
			$pdf->Output('listado_equipos.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}

	/**
	 * Caracterizcion general del Equipo en PDF
	 * @param int $idEquipo
     * @since 13/6/2022
     * @author BMOTTAG
	 */
	public function caracterizacionPDF($idEquipo)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('MANUAL DE PROCESOS');
			$pdf->SetSubject('FIS');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MANUAL DE PROCESOS Y PROCEDIMIENTOS', "FIS - GESTIÓN DE RECURSOS FÍSICOS \nCARACTERIZACIÓN GENERAL DE LA MAQUINA / EQUIPO O VEHICULO ", array(0,140,0), array(147,204,110));	
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 5);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$html = '<table border="0" cellspacing="0" cellpadding="5" >
						<tr>
							<th width="20%" style="text-align:center;"></th>
							<th width="60%" style="text-align:center;">
								<table cellspacing="0" cellpadding="5">
									<tr>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="34%"><strong>Código: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Versión: </strong></th>
										<th bgcolor="#dde1da" style="color:#3e403e;" width="33%"><strong>Fecha: </strong></th>
									</tr>
									<tr>
										<th style="text-align:center;">FIS.PR.06.F.01</th>
										<th style="text-align:center;">3</th>
										<th style="text-align:center;">14/06/2019</th>
									</tr>
								</table>
							</th>
						</tr>
					</table>';
			$html.='<br><br>';
			$pdf->writeHTML($html, true, false, true, false, '');

			$arrParam = array('idEquipo' => $idEquipo);
			$data['infoEquipo'] = $this->reportes_model->get_equipos_info($arrParam);

			$consulta = $data['infoEquipo'][0]['formulario_especifico'];
			$data['infoEspecifica'] = $this->reportes_model->$consulta($arrParam);

			$html2 = $this->load->view('reporte_caracterizacion', $data, true);

			// output the HTML content
			$pdf->writeHTML($html2, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();

			ob_end_clean();
			//Close and output PDF document
			$pdf->Output('hv_equipo_' . $idEquipo . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}
	
}