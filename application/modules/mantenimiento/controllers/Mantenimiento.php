<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenimiento extends CI_Controller {

	/**
	 * Mantenimiento preventivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
    public function preventivo($estado=1)
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
		$data["view"] = 'preventivo';
		$this->load->view("layout", $data);
	}

	/**
	 * Guardar mantenimiento preventivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function detallePreventivo($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			
			$arrParam = array(
				"table" => "param_dependencias",
				"order" => "dependencia",
				"id" => "x"
			);
			$data['dependencias'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'detalle_preventivo';
			$this->load->view("layout", $data);
	}

	/**
	 * Mantenimiento correctivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
    public function correctivo($estado=1)
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
		$data["view"] = 'correctivo';
		$this->load->view("layout", $data);
	}

	/**
	 * Guardar mantenimiento correctivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function detalleCorrectivo($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			
			$arrParam = array(
				"table" => "param_dependencias",
				"order" => "dependencia",
				"id" => "x"
			);
			$data['dependencias'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'detalle_correctivo';
			$this->load->view("layout", $data);
	}
}