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
	 * @review 10/12/2020
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
			
			$numeroInventario = $this->input->post('numero_inventario');
			
			$result_numero_inventario = false;
			
			//verificar si ya el numero de inventario
			$arrParam = array(
				"idEquipo" => $idEquipo,
				"column" => "numero_inventario",
				"value" => $numeroInventario
			);
			$result_numero_inventario = $this->equipos_model->verificarEquipo($arrParam);

			if ($result_numero_inventario)
			{
				$data["result"] = "error";
				$data["mensaje"] = " Error. El Número de Inventario ya existe.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El Número de Inventario ya existe.');
			} else {
				if ($idEquipo = $this->equipos_model->guardarEquipo($pass)) 
				{
					if($flag)
					{
						//si es un registro nuevo genero el codigo QR y subo la imagen
						//INCIO - genero imagen con la libreria y la subo 
						$this->load->library('ciqrcode');

						$valorQRcode = base_url("login/index/" . $idEquipo . $pass);
						$rutaImagen = "images/equipos/QR/" . $idEquipo . "_qr_code.png";
						
						$params['data'] = $valorQRcode;
						$params['level'] = 'H';
						$params['size'] = 10;
						$params['savename'] = FCPATH.$rutaImagen;
										
						$this->ciqrcode->generate($params);
						//FIN - genero imagen con la libreria y la subo
					}
					
					$data["idRecord"] = $idEquipo;
					$data["result"] = true;		
					$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
				} else {
					$data["result"] = "error";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
				}
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
	public function guardar_info_especifica()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idInfoEspecificaEquipo = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
			$MetodoGuardar = $this->input->post('hddMetodoGuardar');
		
			$msj = "Se guardo la información!";

			if ($idInfoEspecificaEquipo = $this->equipos_model->$MetodoGuardar()) 
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
	 * Foto del equipo
	 * @since 12/12/2020
     * @author BMOTTAG
	 */
	public function foto($idEquipo, $error = '')
	{			
			//busco datos del equipo
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->equipos_model->get_fotos_equipos($arrParam);
						
			$data['error'] = $error; //se usa para mostrar los errores al cargar la imagen 
			$data["view"] = 'foto_equipo';
			$this->load->view("layout", $data);
	}
		
	/**
	 * Subir Foto del equipo
	 * @since 12/12/2020
     * @author BMOTTAG
	 */
    function do_upload_equipo() 
	{
		$config['upload_path'] = './images/equipos/';
        $config['overwrite'] = false;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '3200';
        $config['max_height'] = '2400';
		$idEquipo = $this->input->post('hddId');

        $this->load->library('upload', $config);
        //SI LA IMAGEN FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA 
        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
			$this->foto($idEquipo, $error);
        } else {
            $file_info = $this->upload->data();//subimos la imagen
			
			$data = array('upload_data' => $this->upload->data());
			$imagen = $file_info['file_name'];
			$path = "images/equipos/" . $imagen;
			
			//insertar datos
			if($this->equipos_model->add_fotos($path))
			{
				$this->session->set_flashdata('retornoExito', 'Se cargó la foto del Equipo.');
			}else{
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
						
			redirect('equipos/foto/' . $idEquipo);
        }
    }
	
	/**
	 * Eliminar foto
     * @since 16/12/2020
	 */
	public function eliminar_foto()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEquipoFoto = $this->input->post('identificador');
			
			//busco el ID del equipo
			$arrParam = array("idEquipoFoto" => $idEquipoFoto);
			$fotosEquipos = $this->equipos_model->get_fotos_equipos($arrParam);
			
			$data["idRecord"] = $fotosEquipos[0]['fk_id_equipo_foto']; //$idEquipo
			
			unlink($fotosEquipos[0]['equipo_foto']);//elimino archivo 
			
			//elimino registro de la base de datos
			$arrParam = array(
				"table" => "equipos_fotos",
				"primaryKey" => "id_equipo_foto",
				"id" => $idEquipoFoto
			);
			
			if ($this->general_model->deleteRecord($arrParam))
			{				
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se eliminó la foto del equipo.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}				

			echo json_encode($data);
    }
	
	/**
	 * Localizacion del equipo
     * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function localizacion($idEquipo, $idLocalizacion = 'x')
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			
			$data['listadoLocalizacion'] = $this->equipos_model->get_localizacion($arrParam);
			
			$data['infoLocalizacion'] = FALSE;
			if ($idLocalizacion != 'x') {
				$arrParam = array(
					"idEquipoLocalizacion" => $idLocalizacion,
					"idEquipo" => $idEquipo
				);
				$data['infoLocalizacion'] = $this->equipos_model->get_localizacion($arrParam);
			}
			
			$data["view"] = 'equipos_localizacion';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Guardar Localizacion
	 * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function guardar_localizacion()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idLocalizacion = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
		
			$msj = "Se guardo la información!";

			if ($idLocalizacion = $this->equipos_model->guardarLocalizacion()) 
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
	 * Control de combustible del equipo
     * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function combustible($idEquipo, $idControlCombustible = 'x')
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			
			$data['listadoControlCombustible'] = $this->equipos_model->get_control_combustible($arrParam);
			
			$data['infoControlCombustible'] = FALSE;
			if ($idControlCombustible != 'x') {
				$arrParam = array(
					"idControlCombustible" => $idControlCombustible,
					"idEquipo" => $idEquipo
				);
				$data['infoControlCombustible'] = $this->equipos_model->get_control_combustible($arrParam);
			}
			
			$data["view"] = 'equipos_combustible';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Guardar Control del combustible
	 * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function guardar_combustible()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idControlCombustible = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
		
			$msj = "Se guardo la información!";

			if ($idControlCombustible = $this->equipos_model->guardarControlCombustible()) 
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