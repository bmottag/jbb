<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenimiento extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model("mantenimientos_model");
    }

	/**
	 * Mantenimiento preventivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function preventivo($estado=1)
	{
		$data['estadoMantenimiento'] = $estado;
		$data['tituloListado'] = FALSE;
		if(!$_POST)
		{
			$data['tituloListado'] = 'LISTA DE ÚLTIMOS 10 MANTENIMIENTOS PREVENTIVOS REGISTRADOS';
			$arrParam = array(
				"estadoMantenimiento" => $estado,
				'limit' => 10
			);
			$data['info'] = $this->mantenimientos_model->get_preventivos_info($arrParam);
		} elseif ($this->input->post('tipo_equipo') || $this->input->post('frecuencia'))
		{
			$data['tituloListado'] = 'LISTA DE MANTENIMIENTOS PREVENTIVOS QUE COINCIDEN CON SU BUSQUEDA';
			$data['tipo_equipo'] =  $this->input->post('tipo_equipo');
			$data['frecuencia'] =  $this->input->post('frecuencia');	
			$arrParam = array(
				"tipo_equipo" => $this->input->post('tipo_equipo'),
				"frecuencia" => $this->input->post('frecuencia'),
				"estadoMantenimiento" => $estado
			);
			$data['info'] = $this->mantenimientos_model->get_preventivos_info($arrParam);
		} else {
			$data['info'] = FALSE;
		}
		$arrParam = array(
			"table" => "param_tipo_equipos",
			"order" => "tipo_equipo",
			"id" => "x"
		);
		$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_frecuencia",
			"order" => "id_frecuencia",
			"id" => "x"
		);
		$data['frecuencia'] = $this->general_model->get_basic_search($arrParam);
		$data["view"] = 'preventivo';
		$this->load->view("layout", $data);
	}

	/**
     * Cargo modal - formulario mantenimiento preventivo
     * @since 20/12/2020
     */
    public function cargarModalPreventivo() 
	{
		header("Content-Type: text/plain; charset=utf-8");
		$data['information'] = FALSE;
		$id_preventivo = $this->input->post("id_preventivo");
		$arrParam = array(
			"table" => "param_tipo_equipos",
			"order" => "tipo_equipo",
			"id" => "x"
		);
		$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_frecuencia",
			"order" => "id_frecuencia",
			"id" => "x"
		);
		$data['frecuencia'] = $this->general_model->get_basic_search($arrParam);
		$this->load->view("preventivo_modal", $data);
    }

	/**
	 * Guardar mantenimiento preventivo
     * @since 16/12/2020
     * @author BMOTTAG
	 */
	public function guardar_preventivo()
	{
		header('Content-Type: application/json');
		$data = array();
		$msj = "Se guardo la información!";
		if ($this->mantenimientos_model->guardarPreventivo())
		{				
			$data["result"] = true;		
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
	}

	/**
	 * Mantenimiento correctivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function correctivo($idEquipo, $idCorrectivo = 'x')
	{
		$arrParam = array("idEquipo" => $idEquipo);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);
		$data['listadoCorrectivos'] = $this->mantenimientos_model->get_correctivo($arrParam);
		$data['infoCorrectivo'] = FALSE;
		if ($idCorrectivo != 'x') {
			$arrParam = array(
				"idCorrectivo" => $idCorrectivo,
				"idEquipo" => $idEquipo
			);
			$data['infoCorrectivo'] = $this->mantenimientos_model->get_correctivo($arrParam);
		}
		$data["view"] = 'correctivo';
		$this->load->view("layout", $data);
	}

	/**
	 * Guardar mantenimiento correctivo
     * @since 20/12/2020
     * @author BMOTTAG
	 */
	public function guardar_correctivo()
	{
		header('Content-Type: application/json');
		$data = array();
		$idCorrectivo = $this->input->post('hddId');
		$data["idRecord"] = $this->input->post('hddIdEquipo');
		$msj = "Se guardo la información!";
		if ($this->mantenimientos_model->guardarCorrectivo())
		{				
			$data["result"] = true;		
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
	}
}