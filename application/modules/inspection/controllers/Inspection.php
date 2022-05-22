<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspection extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("inspection_model");
    }
		
	/**
	 * Set session with vehicle ID to do inspection
     * @since 13/1/2021
     * @author BMOTTAG
	 */	
	public function set_vehicle($idEquipo)
	{
		//busco informacion del vehiculo
		$this->load->model("general_model");
		$arrParam['idEquipo'] = $idEquipo;
		$data['vehicleInfo'] = $this->general_model->get_equipos_info($arrParam);

		$sessionData = array(
			"idEquipo" => $idEquipo,
			"idTipoEquipo" => $data['vehicleInfo'][0]['tipo_equipo'],
			"linkInspection" => $data['vehicleInfo'][0]['enlace_inspeccion'],
			"formInspection" => $data['vehicleInfo'][0]['formulario_inspeccion']
		);
								
		$this->session->set_userdata($sessionData);
		
		redirect($data['vehicleInfo'][0]['enlace_inspeccion'],"location",301);		
	}
	
	/**
	 * Form Add daily Inspection
     * @since 13/1/2021
     * @author BMOTTAG
	 */
	public function add_encuesta($id = 'x')
	{
			$this->load->model("general_model");
			
			$data['information'] = FALSE;	
			$arrParam = array("idUser" => $this->session->id);
			$data['infoUser'] = $this->general_model->get_user($arrParam);
					
			//si envio el id, entonces busco la informacion 
			if ($id != 'x') {


					$idEquipo = $id ;
			}else{
					$idEquipo = $this->session->userdata("idEquipo");
					if (!$idEquipo || empty($idEquipo) || $idEquipo == "x" ) { 
						show_error('ERROR!!! - You are in the wrong place.');	
					}
			}
			
			//busco datos del vehiculo
			$arrParam['idEquipo'] = $idEquipo;
			$data['vehicleInfo'] = $this->general_model->get_equipos_info($arrParam);//busco datos del vehiculo
		
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			$data["view"] = "encuesta";
			$this->load->view("layout", $data);
	}
	
	
	
}