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
			$data['tituloListado'] = FALSE;

			if(!$_POST)
			{
				$data['tituloListado'] = 'LISTA DE ÚLTIMOS 10 EQUIPOS REGISTRADOS';
				//busco los ultimos 10 equipos de la base de datos
				$arrParam = array(
							"estadoEquipo" => $estado,
							'limit' => 10
							);
				$data['info'] = $this->general_model->get_equipos_info($arrParam);
			}elseif($this->input->post('numero_inventario') || $this->input->post('marca') || $this->input->post('modelo') || $this->input->post('numero_serial'))
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
			$idEquipo = $this->input->post("idEquipo");
			
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
							
			$this->load->view("equipos_modal", $data);
    }

	/**
	 * Guardar equipos
	 * @since 19/11/2020
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
				
				$data["idRecord"] = $idEquipo;
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
			
			$data["view"] = 'equipos_detalle';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Detalle de un equipo
     * @since 3/12/2020
     * @author BMOTTAG
	 */
	public function especifico($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			
			$consulta = $data['info'][0]['formulario_especifico'];

			$data['infoEspecifica'] = $this->general_model->$consulta($arrParam);
					
			$arrParam = array(
				"table" => "param_clase_vehiculo",
				"order" => "clase_vehiculo",
				"id" => "x"
			);
			$data['claseVehiculo'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_tipo_carroceria",
				"order" => "tipo_carroceria",
				"id" => "x"
			);
			$data['tipoCarroceria'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = $consulta;
			$this->load->view("layout", $data);
	}
	
	/**
	 * Guardar Informacion Especifica
	 * @since 3/12/2020
     * @author BMOTTAG
	 */
	public function guardar_info_especifica_vehiculo()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idInfoEspecificaEquipo = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
		
			$msj = "Se guardo la información!";

			if ($idInfoEspecificaEquipo = $this->equipos_model->guardarInfoEspecificaVehiculo()) 
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