<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordentrabajo extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("ordentrabajo_model");
    }
	
	/**
	 * Info orden de trabajo
     * @since 26/1/2021
     * @author BMOTTAG
	 */
	public function ver_orden($idOrdenTrabajo) 
	{		
			if(empty($idOrdenTrabajo)){
				show_error('ERROR!!! - You are in the wrong place.');
			}
			
			//buscar informacion de la orden de trabajo
			$arrParam = array("idOrdenTrabajo" => $idOrdenTrabajo);
			$data['information'] = $this->general_model->get_orden_trabajo($arrParam);

			//buscar historial de estados orden de trabajo
			$data['infoEstado'] = $this->general_model->get_estado_orden_trabajo($arrParam);

			$data['idMantenimiento'] = $data['information'][0]['fk_id_mantenimiento'];
			$data['tipoMantenimiento'] = $data['information'][0]['tipo_mantenimiento'];

			$arrParam = array(
				"idMantenimiento" => $data['idMantenimiento'],
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

			$data["view"] = 'ordentrabajo';
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
			$tipoMantenimiento = $this->input->post('hddtipoMantenimiento');
			
			$flag = false;
			if($idOrdenTrabajo == ''){
				$flag = true;
			}


			$msj = "Se guardo la información!";

			if ($idOrdenTrabajo = $this->ordentrabajo_model->guardarOrdentrabajo()) 
			{				
				$this->ordentrabajo_model->guardarEstadoOrdentrabajo($idOrdenTrabajo);

				//si es un registro nuevo entonces cambio el estado de mantenimiento de correctivo a EN PROCESO
				if($flag && $tipoMantenimiento == 1){
					$estado = 2;//EN PROCESO
					$this->ordentrabajo_model->updateEstadoMantenimientoCorrectivo($estado);
				}

				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}

			$data["idRecord"] = $idOrdenTrabajo;
		
			echo json_encode($data);
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

	/**
     * Cargo modal - formulario orden trabajo
     * @since 19/01/2021
     * @author BMOTTAG
     */
    public function cargarModalOrdenTrabajo() 
	{
			header("Content-Type: text/plain; charset=utf-8");

			$data["idMantenimiento"] = $this->input->post("idMantenimiento");
			$data["tipoMantenimiento"] = $this->input->post("tipoMantenimiento");

			$data['information'] = FALSE;

			$arrParam = array(
				"idMantenimiento" => $data["idMantenimiento"],
				"tipoMantenimiento" => $data["tipoMantenimiento"] 
			);
			
			//buscar informacion del mantenimiento
			if($data["tipoMantenimiento"] == 1)
			{
				$data['infoMantenimiento'] = $this->general_model->get_mantenimiento_correctivo($arrParam);
			}else{
				$data['infoMantenimiento'] = $this->general_model->get_mantenimiento_preventivo($arrParam);
			}
/**
FALTA DEFINIR ESTA PARTE
if ($data["idOrdenTrabajo"] != 'x')
{
	$arrParam = array(
		"idOrdenTrabajo" => $data["idOrdenTrabajo"]
	);
	$data['infoCorrectivo'] = $this->mantenimientos_model->get_correctivo($arrParam);
	$data["idEquipo"] = $data['infoCorrectivo'][0]['fk_id_equipo_correctivo'];

}
*/

			//buscar informacion de la orden de trabajo
			$data['information'] = $this->general_model->get_orden_trabajo($arrParam);


//NOTA: FALTA AJUSTAR ESTA BUSQUEDA PORQUE EN ESTE MOMENTO ESTA SOLO PARA MENTENIMIENTO CORRECTIVO
			//busco datos del vehiculo
			$arrParam['idEquipo'] = $data['infoMantenimiento'][0]['fk_id_equipo_correctivo'];
			$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);
		
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			//Lista de encargados activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 3
						);
			$data['listaEncargados'] = $this->general_model->get_user($arrParam);

			$this->load->view("ordentrabajo_modal", $data);
    }

	/**
     * Cargo modal - formulario Estado orden trabajo
     * @since 29/01/2021
     * @author BMOTTAG
     */
    public function cargarModalEstadoOrdenTrabajo() 
	{
			header("Content-Type: text/plain; charset=utf-8");

			$data["idOrdenTrabajo"] = $this->input->post("idOrdenTrabajo");

			$data['information'] = FALSE;

			$this->load->view("ordentrabajoestado_modal", $data);
    }

	/**
	 * Guardar orden de trabajo estado
	 * @since 29/1/2021
     * @author BMOTTAG
	 */
	public function guardar_ordentrabajo_estado()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$data['idRecord'] = $this->input->post("hddIdOrdenTrabajo");
				
			$msj = "Se guardo la información!";

			if ($this->ordentrabajo_model->guardarEstadoOrdentrabajo($data['idRecord'])) 
			{
				//actualizar estado
				$this->ordentrabajo_model->updateOrdentrabajo($data['idRecord']);

				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
		
			echo json_encode($data);
    }
	
	
	
	
	
}