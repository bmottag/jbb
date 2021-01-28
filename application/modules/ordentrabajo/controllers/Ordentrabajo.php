<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordentrabajo extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("ordentrabajo_model");
    }
	
	/**
	 * Infro de orden de trabajo
     * @since 26/1/2021
     * @author BMOTTAG
	 */
	public function crear_orden($idMantenimiento, $tipoMantenimiento = '1') 
	{		
			if(empty($idMantenimiento) || empty($tipoMantenimiento)){
				show_error('ERROR!!! - You are in the wrong place.');
			}
			
			$data['information'] = FALSE;

			$this->load->model("general_model");			
			$data['tipoMantenimiento'] = $tipoMantenimiento;

			$arrParam = array(
				"idMantenimiento" => $idMantenimiento,
				"tipoMantenimiento" => $tipoMantenimiento
			);
			
			//buscar informacion del mantenimiento
			if($tipoMantenimiento == 1)
			{
				$data['infoMantenimiento'] = $this->general_model->get_mantenimiento_correctivo($arrParam);
			}else{
				$data['infoMantenimiento'] = $this->general_model->get_mantenimiento_preventivo($arrParam);
			}

			//buscar informacion de la orden de trabajo
			$data['information'] = $this->general_model->get_orden_trabajo($arrParam);

			//busco datos del vehiculo
			$arrParam['idEquipo'] = $data['infoMantenimiento'][0]['fk_id_equipo_correctivo'];
			$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);//busco datos del vehiculo
		
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			//Lista de encargados activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 3
						);
			$data['listaEncargados'] = $this->general_model->get_user($arrParam);

			$data["view"] = 'form_ordentrabajo';
			$this->load->view("layout", $data);
	}

	/**
	 * Guardar orden de trabajo
	 * @since 27/1/2021
     * @author BMOTTAG
	 */
	public function guardar_ordentrabajo()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idOrdenTrabajo = $this->input->post('hddIdOrdenTrabajo');
			$data["idRecord"] = $this->input->post('hddIdMantenimiento');
		
			$msj = "Se guardo la información!";

			if ($idOrdenTrabajo = $this->ordentrabajo_model->guardarOrdentrabajo()) 
			{				
				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}

			//$data["idRecord"] = $idMantenimiento . '/' . $idOrdenTrabajo;
		
			echo json_encode($data);
    }

	/**
	 * Editar el estado de la otden de trabajo
     * @since 28/1/2021
     * @author BMOTTAG
	 */
	public function editar_orden($idOrdenTrabajo) 
	{		
			if(empty($idOrdenTrabajo)){
				show_error('ERROR!!! - You are in the wrong place.');
			}
			
			$data['information'] = FALSE;
			//buscar informacion de la orden de trabajo
			$arrParam = array("idOrdenTrabajo" => $idOrdenTrabajo);
			$data['information'] = $this->general_model->get_orden_trabajo($arrParam);

			$data['tipoMantenimiento'] = $data['information'][0]['tipo_mantenimiento'];

			$arrParam = array(
				"idMantenimiento" => $data['information'][0]['fk_id_mantenimiento'],
				"tipoMantenimiento" => $data['tipoMantenimiento']
			);
			
			//buscar informacion del mantenimiento
			if($data['tipoMantenimiento'] == 1)
			{
				$data['infoMantenimiento'] = $this->general_model->get_mantenimiento_correctivo($arrParam);
			}else{
				$data['infoMantenimiento'] = $this->general_model->get_mantenimiento_preventivo($arrParam);
			}



			//busco datos del vehiculo
			$arrParam['idEquipo'] = $data['infoMantenimiento'][0]['fk_id_equipo_correctivo'];
			$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);//busco datos del vehiculo
		
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			//Lista de encargados activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 3
						);
			$data['listaEncargados'] = $this->general_model->get_user($arrParam);

			$data["view"] = 'form_ordentrabajo';
			$this->load->view("layout", $data);
	}

	/**
	 * Guardar orden de trabajo
	 * @since 27/1/2021
     * @author BMOTTAG
	 */
	public function actualizar_ordentrabajo()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idOrdenTrabajo = $this->input->post('hddIdOrdenTrabajo');
			$data["idRecord"] = $this->input->post('hddIdMantenimiento');
		
			$msj = "Se guardo la información!";

			if ($idOrdenTrabajo = $this->ordentrabajo_model->guardarOrdentrabajo()) 
			{				
				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}

			//$data["idRecord"] = $idMantenimiento . '/' . $idOrdenTrabajo;
		
			echo json_encode($data);
    }
	
	
	
	
}