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
     * @since 1/3/2021
     * @author BMOTTAG
	 */
	public function infoEquipoPDF()
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$idEquipo = $this->input->post('idEquipo');
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
     * @since 1/3/2021
     * @author BMOTTAG
	 */
	public function litadoEquipos()
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$arrParam = array();
			$data['infoEquipo'] = $this->reportes_model->get_equipos_info($arrParam);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('Bienes');
			$pdf->SetSubject('TCPDF Tutorial');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING, array(94,164,49), array(147,204,110));
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'LISTA EQUIPOS', 'Listdo de equipos', array(94,164,49), array(147,204,110));					

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

			$vista = 'reporte_lista_equipos';
			$html = $this->load->view($vista, $data, true);
echo $html; exit;
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');


			// Print some HTML Cells

			// reset pointer to the last page
			$pdf->lastPage();


			//Close and output PDF document
			$pdf->Output('listado_equipos.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+		
	}

	
}