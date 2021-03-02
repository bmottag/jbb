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
	public function infoEquipoPDF($idEquipo)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$arrParam = array('idEquipo' => $idEquipo);
			$data['infoEquipo'] = $this->reportes_model->get_equipos_info($arrParam);
			$data['listadoLocalizacion'] = $this->reportes_model->get_localizacion($arrParam);

			$arrParam = array(
				'idEquipo' => $idEquipo,
				'to' => date('Y-m-d')
			);
			$data['listadoPolizas'] = $this->reportes_model->get_polizas($arrParam);

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
			$pdf->SetFont('dejavusans', '', 8);

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
			if($data['listadoPolizas']){
				$html .= $this->load->view('reporte_polizas', $data, true);
			}

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			
			// Print some HTML Cells

			// reset pointer to the last page
			$pdf->lastPage();


			//Close and output PDF document
			$pdf->Output('hv_equipo_' . $idEquipo . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		
	}	

	
}