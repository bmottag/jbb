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
		} elseif ($this->input->post('tipo_equipo') || $this->input->post('frecuencia'))
		{
			$data['tituloListado'] = 'LISTA DE MANTENIMIENTOS PREVENTIVOS QUE COINCIDEN CON SU BUSQUEDA';
			$data['tipo_equipo'] =  $this->input->post('tipo_equipo');
			$data['frecuencia'] =  $this->input->post('frecuencia');	
			$arrParam = array(
				"tipo_equipo" => $this->input->post('tipo_equipo'),
				"frecuencia" => $this->input->post('frecuencia'),
				"estadoMantenimiento" => $estado
			);
			$data['info'] = $this->mantenimientos_model->get_preventivos_info($arrParam);
		} else {
			$data['info'] = FALSE;
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
	public function correctivo($idEquipo)
	{
		$arrParam = array("idEquipo" => $idEquipo);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);
		$data['listadoCorrectivos'] = $this->mantenimientos_model->get_correctivo($arrParam);
		$data["view"] = 'correctivo';
		$this->load->view("layout_calendar", $data);
	}

	/**
     * Cargo modal - formulario correctivo
     * @since 19/01/2021
     * @author BMOTTAG
     */
    public function cargarModalCorrectivo() 
	{
		header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
		$data['infoCorrectivo'] = FALSE;
		$data["idEquipo"] = $this->input->post("idEquipo");
		$data["idCorrectivo"] = $this->input->post("idCorrectivo");
		if ($data["idCorrectivo"] != 'x')
		{
			$arrParam = array(
				"idCorrectivo" => $data["idCorrectivo"]
			);
			$data['infoCorrectivo'] = $this->mantenimientos_model->get_correctivo($arrParam);
			$data["idEquipo"] = $data['infoCorrectivo'][0]['fk_id_equipo_correctivo'];

		}
		$this->load->view("correctivo_modal", $data);
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
		$idCorrectivo = $this->input->post('hddId');
		$data["idRecord"] = $this->input->post('hddIdEquipo');
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

	/**
	 * Foto del daño
	 * @since 20/01/2021
     * @author BMOTTAG
	 */
	public function foto_danio($idEquipo, $idCorrectivo, $error = '')
	{	
		$arrParam = array("idEquipo" => $idEquipo);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);
		$arrParam = array("idCorrectivo" => $idCorrectivo);
		$data['infoCorrectivo'] = $this->mantenimientos_model->get_correctivo($arrParam);
		$data['fotosDanios'] = $this->mantenimientos_model->get_fotos_danios($arrParam);
		$data['error'] = $error;
		$data["view"] = 'foto_danios';
		$this->load->view("layout_calendar", $data);
	}

	/**
	 * Subir Foto del daño
	 * @since 20/01/2021
     * @author BMOTTAG
	 */
    function do_upload_danio() 
	{
		$config['upload_path'] = './images/danios/';
        $config['overwrite'] = false;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '3200';
        $config['max_height'] = '2400';
		$idCorrectivo = $this->input->post('hddId');
		$idEquipo = $this->input->post('hddIdEquipo');
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
			$this->foto_danio($idEquipo, $idCorrectivo, $error);
        } else {
            $file_info = $this->upload->data();
			$data = array('upload_data' => $this->upload->data());
			$imagen = $file_info['file_name'];
			$path = "images/danios/" . $imagen;
			if($this->mantenimientos_model->add_fotoDanio($path))
			{
				$this->session->set_flashdata('retornoExito', 'Se cargó la foto del daño.');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			redirect('mantenimiento/foto_danio/' . $idEquipo . "/" . $idCorrectivo);
        }
    }
	
	/**
	 * Eliminar foto del daño
     * @since 20/01/2021
     * @author BMOTTAG
	 */
	public function eliminar_foto_danio()
	{			
		header('Content-Type: application/json');
		$data = array();
		$idEquipo = $this->input->post('hddIdEquipo');
		$idFotoDanio = $this->input->post('identificador');
		$arrParam = array("idFotoDanio" => $idFotoDanio);
		$fotosDanios = $this->mantenimientos_model->get_fotos_danios($arrParam);
		$data["idRecord"] = $fotosDanios[0]['fk_id_correctivo'];
		$data["idEquipo"] = $fotosDanios[0]['fk_id_equipo_correctivo'];
		unlink($fotosDanios[0]['ruta_foto']);
		$arrParam = array(
			"table" => "mantenimiento_correctivo_fotos",
			"primaryKey" => "id_foto_danio",
			"id" => $idFotoDanio
		);
		if ($this->general_model->deleteRecord($arrParam))
		{				
			$data["result"] = true;
			$this->session->set_flashdata('retornoExito', 'Se eliminó la foto del daño.');
		} else {
			$data["result"] = "error";
			$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
			$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
		}				
		echo json_encode($data);
    }
}