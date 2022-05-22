<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class External extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("external_model");
        $this->load->model("general_model");
		$this->load->helper('form');
    }
	
	/**
	 * Info equipo
     * @since 22/1/2021
     * @author BMOTTAG
	 */
	public function buscar_equipo()
	{
			$arrParam = array("numero_inventario" => $this->security->xss_clean($this->input->post('numero_inventario')));
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
						
			$data["view"] = 'listado_equipos';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Form Add daily Inspection
     * @since 13/1/2022
     * @author BMOTTAG
	 */
	public function add_vehiculos_inspection($idEquipo, $idInspeccion = 'x')
	{
			$this->load->model("general_model");
			
			$data['information'] = FALSE;	
					
			//si envio el id, entonces busco la informacion 
			if ($idInspeccion != 'x') {
					$arrParam = array(
						"idInspeccion" => $idInspeccion
					);
					$data['information'] = $this->general_model->get_inspecciones($arrParam);//info inspection_heavy
					$idEquipo = $data['information'][0]['fk_id_equipo_vehiculo'];
			}else{
					if (!$idEquipo || empty($idEquipo) || $idEquipo == "x" ) { 
						show_error('ERROR!!! - You are in the wrong place.');	
					}
			}
			
			//busco datos del vehiculo
			$arrParam['idEquipo'] = $idEquipo;
			$data['vehicleInfo'] = $this->general_model->get_equipos_info($arrParam);//busco datos del vehiculo

			//Lista de usuarios activos
			$arrParam = array("filtroState" => TRUE, "idRole" => ID_ROL_CONDUCTOR);
			$data['listaUsuarios'] = $this->general_model->get_user($arrParam);//workers list
		
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			$data["view"] = $data['vehicleInfo'][0]['formulario_inspeccion'];
			$this->load->view("layout_calendar", $data);
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
			$data["idVehicle"] = $this->input->post('hddIdVehicle');
			

			$msj = "Se guardó la Inspección Cotidiana, por favor firmar!";
			$flag = true;
			if ($idInspection != '') {
				$msj = "Se actualizó la Inspección Cotidiana!";
				$flag = false;
			}
			
			if ($idInspection = $this->external_model->saveVehicleInspection()) 
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
					"idInspeccion" => $idInspection
				);
				$data['information'] = $this->general_model->get_inspecciones($arrParam);//info inspection_heavy
				$idEquipo = $data['information'][0]['fk_id_equipo_vehiculo'];
				
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

				$data['linkBack'] = "external/add_" . $typo . "_inspection/". $idEquipo . "/" . $idInspection;
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
	 * Trucks list by company and type
     * @since 25/1/2017
     * @author BMOTTAG
	 */
    public function infoConductor() {
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
		$conductor = $this->input->post('conductor');
		
		$arrParam = array("idUser" => $conductor);
		$infoUsuario = $this->general_model->get_user($arrParam);
		if ($infoUsuario) {
			echo "<b>Número de Identificación: </b>" . $infoUsuario[0]["numero_cedula"];
			echo "<br><b>Dependencia: </b>" . $infoUsuario[0]["dependencia"];
		}			

    }
	


	
	
}