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
		} elseif ($this->input->post('fecha_inicio') || $this->input->post('tipo_equipo') || $this->input->post('frecuencia'))
		{
			$data['tituloListado'] = 'LISTA DE MANTENIMIENTOS PREVENTIVOS QUE COINCIDEN CON SU BUSQUEDA';
			$data['fecha_inicio'] =  $this->input->post('fecha_inicio');
			$data['tipo_equipo'] =  $this->input->post('tipo_equipo');
			$data['frecuencia'] =  $this->input->post('frecuencia');	
			$arrParam = array(
				"fecha_inicio" => $this->input->post('fecha_inicio'),
				"tipo_equipo" => $this->input->post('tipo_equipo'),
				"frecuencia" => $this->input->post('frecuencia'),
				"estadoMantenimiento" => $estado
			);
			$data['info'] = $this->mantenimientos_model->get_preventivos_info($arrParam);
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
	public function correctivo($estado=1)
	{
		$data['estadoMantenimiento'] = $estado;
		$data['tituloListado'] = FALSE;
		if(!$_POST)
		{
			$data['tituloListado'] = 'LISTA DE ÚLTIMOS 10 MANTENIMIENTOS CORRECTIVOS REGISTRADOS';
			$arrParam = array(
				"estadoMantenimiento" => $estado,
				'limit' => 10
			);
			$data['info'] = $this->mantenimientos_model->get_correctivos_info($arrParam);
		} elseif ($this->input->post('fecha_inicio') || $this->input->post('numero_inventario'))
		{
			$data['tituloListado'] = 'LISTA DE MANTENIMIENTOS CORRECTIVOS QUE COINCIDEN CON SU BUSQUEDA';
			$data['fecha_inicio'] =  $this->input->post('fecha_inicio');
			$data['numero_inventario'] =  $this->input->post('numero_inventario');
			$arrParam = array(
				"fecha_inicio" => $this->input->post('fecha_inicio'),
				"numero_inventario" => $this->input->post('numero_inventario'),
				"estadoMantenimiento" => $estado
			);
			$data['info'] = $this->mantenimientos_model->get_correctivos_info($arrParam);
		}
		$data["view"] = 'correctivo';
		$this->load->view("layout", $data);
	}

	/**
	 * Mantenimiento correctivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
    public function equipoCorrectivo($estado=1)
    {
    	$data['estadoEquipo'] = $estado;
		$data['tituloListado'] = FALSE;
		if(!$_POST)
		{
			$data['tituloListado'] = 'LISTA DE ÚLTIMOS 10 EQUIPOS REGISTRADOS';
			$arrParam = array(
				"estadoEquipo" => $estado,
				'limit' => 10
			);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
		} elseif ($this->input->post('numero_inventario') || $this->input->post('marca') || $this->input->post('modelo') || $this->input->post('numero_serial'))
		{
			$data['tituloListado'] = 'LISTA DE EQUIPOS QUE COINCIDEN CON SU BUSQUEDA';
			$data['numero_inventario'] =  $this->input->post('numero_inventario');
			$data['marca'] =  $this->input->post('marca');
			$data['modelo'] =  $this->input->post('modelo');
			$data['numero_serial'] =  $this->input->post('numero_serial');
			$arrParam = array(
				"numero_inventario" => $this->input->post('numero_inventario'),
				"marca" => $this->input->post('marca'),
				"modelo" => $this->input->post('modelo'),
				"numero_serial" => $this->input->post('numero_serial'),
				"estadoEquipo" => $estado
			);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
		}
		$data["view"] = 'equipo_correctivo';
		$this->load->view("layout", $data);
	}

	/**
	 * Guardar mantenimiento correctivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function detalleCorrectivo($idEquipo)
	{
		$arrParam = array(
			'idEquipo' => $idEquipo,
			'limit' => 10
		);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);
		$data['tituloListado'] = 'LISTA DE ÚLTIMOS 10 MANTENIMIENTOS CORRECTIVOS REGISTRADOS DE ESTE EQUIPO';
		$data['infoCorrectivo'] = $this->mantenimientos_model->get_correctivos_infoEquipo($arrParam);
		$data["view"] = 'detalle_correctivo';
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