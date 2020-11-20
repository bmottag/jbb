<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipos extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("equipos_model");
    }
	
	/**
	 * Listado de equipos
     * @since 19/11/2020
     * @author BMOTTAG
	 */
	public function index($estado=1)
	{
			$data['estadoEquipo'] = $estado;

			$arrParam = array(
				"estadoEquipo" => $estado
			);
			
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			$data["view"] = 'equipos';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario equipos
     * @since 19/11/2020
     */
    public function cargarModalEquipo() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$idVehicle = $this->input->post("idVehicle");
						
			if ($idVehicle != 'x') {
				$arrParam = array(
					"table" => "param_vehicle",
					"order" => "id_vehicle",
					"column" => "id_vehicle",
					"id" => $data["idVehicle"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("equipos_modal", $data);
    }

	/**
	 * Guardar equipos
	 * @review 19/11/2020
     * @author BMOTTAG
	 */
	public function guardar_equipos()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idVehicle = $this->input->post('hddId');

//			$pass = $this->generaPass();//clave para colocarle al codigo QR
		
			$msj = "Se adicionó equipo!";
			$flag = true;
			if ($idVehicle != '') {
				$msj = "Se actualizó equipo!";
				$flag = false;
			}

			if ($idVehicle = $this->equipos_model->guardarEquipo()) 
			{
				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			echo json_encode($data);
    }	

	


	
}