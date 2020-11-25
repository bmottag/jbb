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

			if(!$_POST)
			{
				$arrParam = array("estadoEquipo" => $estado);
				$data['info'] = $this->general_model->get_equipos_info($arrParam);
			}elseif($this->input->post('numero_unidad') || $this->input->post('fabricante') || $this->input->post('modelo') || $this->input->post('numero_serial'))
			{				
				$data['numero_unidad'] =  $this->input->post('numero_unidad');
				$data['fabricante'] =  $this->input->post('fabricante');
				$data['modelo'] =  $this->input->post('modelo');
				$data['numero_serial'] =  $this->input->post('numero_serial');
						
				$arrParam = array(
					"numero_unidad" => $this->input->post('numero_unidad'),
					"fabricante" => $this->input->post('fabricante'),
					"modelo" => $this->input->post('modelo'),
					"numero_serial" => $this->input->post('numero_serial'),
					"estadoEquipo" => $estado
				);

//////////////guardo la informacion en la base de datos para el boton de regresar
//////////////$this->workorders_model->saveInfoGoBack($arrParam);
	
				//informacion Work Order
				$data['info'] = $this->general_model->get_equipos_info($arrParam);
				
			}
			
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
			
			$idEquipo = $this->input->post('hddId');

			$pass = $this->generaPass();//clave para colocarle al codigo QR
		
			$msj = "Se adicionó equipo!";
			$flag = true;
			if ($idEquipo != '') {
				$msj = "Se actualizó equipo!";
				$flag = false;
			}

			if ($idEquipo = $this->equipos_model->guardarEquipo($pass)) 
			{
				if($flag)
				{
					//si es un registro nuevo genero el codigo QR y subo la imagen
					//INCIO - genero imagen con la libreria y la subo 
					$this->load->library('ciqrcode');

					$valorQRcode = base_url("login/index/" . $idEquipo . $pass);
					$rutaImagen = "images/equipos/" . $idEquipo . "_qr_code.png";
					
					$params['data'] = $valorQRcode;
					$params['level'] = 'H';
					$params['size'] = 10;
					$params['savename'] = FCPATH.$rutaImagen;
									
					$this->ciqrcode->generate($params);
					//FIN - genero imagen con la libreria y la subo
				}
				
				
				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			echo json_encode($data);
    }	

	public function generaPass()
	{
			//Se define una cadena de caractares. Te recomiendo que uses esta.
			$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			//Obtenemos la longitud de la cadena de caracteres
			$longitudCadena=strlen($cadena);
			 
			//Se define la variable que va a contener la contraseña
			$pass = "";
			//Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
			$longitudPass=50;
			 
			//Creamos la contraseña
			for($i=1 ; $i<=$longitudPass ; $i++){
				//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
				$pos=rand(0,$longitudCadena-1);
			 
				//Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
				$pass .= substr($cadena,$pos,1);
			}
			return $pass;
	}	
	
	/**
	 * Listado de equipos INACTVOS
     * @since 23/11/2020
     * @author BMOTTAG
	 */
	public function inactivos($estado=2)
	{
			$data['estadoEquipo'] = $estado;

			$arrParam = array("estadoEquipo" => $estado);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			
			$data["view"] = 'equipos_inactivos';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Detalle de un equipo
     * @since 23/11/2020
     * @author BMOTTAG
	 */
	public function detalle($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			
			$data["view"] = 'equipos_detalle';
			$this->load->view("layout", $data);
	}


	
}