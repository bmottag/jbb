<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspection extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("inspection_model");
    }
	
	/**
	 * Form Add daily Inspection
     * @since 13/1/2021
     * @author BMOTTAG
	 */
	public function add_vehiculos_inspection($id = 'x')
	{
			$this->load->model("general_model");
			
			$data['information'] = FALSE;
			$view = 'form_1_vehiculos';
					
			//si envio el id, entonces busco la informacion 
			if ($id != 'x') {
					$arrParam = array(
						"table" => "inspection_vehiculos",
						"order" => "id_inspection_vehiculos",
						"column" => "id_inspection_vehiculos",
						"id" => $id
					);
					$data['information'] = $this->general_model->get_basic_search($arrParam);//info inspection_heavy

					$idEquipo = $data['information'][0]['fk_id_equipo_vehiculo'];
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

			$data["view"] = $view;
			$this->load->view("layout", $data);
	}
	
	/**
	 * Save vehiculos inspection
     * @since 18/1/2021
     * @author BMOTTAG
	 */
	public function save_inspection_vehiculos()
	{
			header('Content-Type: application/json');
			$data = array();
		
			$idInspection = $this->input->post('hddId');
			$idVehicle = $this->input->post('hddIdVehicle');
		
			$msj = "Se guardó el diagnóstico, por favor firmar!";
			$flag = true;
			if ($idInspection != '') {
				$msj = "Se actualizó  la información!";
				$flag = false;
			}
			
			if ($idInspection = $this->inspection_model->saveVehicleInspection()) 
			{
				/**
				 * si es un registro nuevo entonces guardo el historial de cambio de aceite
				 * y verifico si hay comentarios y envio correo al administrador
				
				if($flag)
				{				
					//FALTA DEFINIR ESTA PARTE


					//busco datos del vehiculo
					$arrParam = array(
						"table" => "param_vehicle",
						"order" => "id_vehicle",
						"column" => "id_vehicle",
						"id" => $idVehicle
					);
					$this->load->model("general_model");
					$vehicleInfo = $this->general_model->get_basic_search($arrParam);
					
					//el que vaya con comentario le envio correo al administrador
					$comments = $this->input->post('comments');

					$state = 1;//Inspection
					//$this->inspection_model->saveVehicleNextOilChange($idVehicle, $state, $idInspection);
					
				}
 */
				$data["result"] = true;
				$data["idInspection"] = $idInspection;
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Ask for help.";
				$data["idInspection"] = "";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}


			echo json_encode($data);
    }	

	/**
	 * Signature
     * @since 27/12/2016
     * @author BMOTTAG
	 */
	public function add_signature($typo, $idInspection)
	{
			if (empty($typo) || empty($idInspection) ) {
				show_error('ERROR!!! - You are in the wrong place.');
			}
		
			if($_POST)
			{
				//update signature with the name of de file
				$name = "images/signature/inspection/" . $typo . "_" . $idInspection . ".png";
				
				$arrParam = array(
					"table" => "inspection_" . $typo,
					"primaryKey" => "id_inspection_" . $typo,
					"id" => $idInspection,
					"column" => "signature",
					"value" => $name
				);
				
				$data_uri = $this->input->post("image");
				$encoded_image = explode(",", $data_uri)[1];
				$decoded_image = base64_decode($encoded_image);
				file_put_contents($name, $decoded_image);
				
				$this->load->model("general_model");
				$data['linkBack'] = "inspection/add_" . $typo . "_inspection/" . $idInspection;
				$data['titulo'] = "<i class='fa fa-life-saver fa-fw'></i>FIRMA";
				if ($this->general_model->updateRecord($arrParam)) {
					//$this->session->set_flashdata('retornoExito', 'You just save your signature!!!');
					
					$data['clase'] = "alert-success";
					$data['msj'] = "Se guardó la firma con éxito.";	
				} else {
					//$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
					
					$data['clase'] = "alert-danger";
					$data['msj'] = "Ask for help.";
				}
				
				$data["view"] = 'template/answer';
				$this->load->view("layout", $data);
				//redirect("/inspection/add_" . $typo . "_inspection/" . $idInspection,'refresh');
			}else{		
				$this->load->view('template/make_signature');
			}
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
	
	
	
	
}