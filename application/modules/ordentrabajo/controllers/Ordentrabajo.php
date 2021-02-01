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

			//DESHABILITAR ORDEN DE TRABAJO
			$data['deshabilitar'] = '';
			$userRol = $this->session->rol;
			$estadoOT = $data['information'][0]['estado_actual'];
			if($userRol != 99 && $estadoOT > 1)
			{
				$data['deshabilitar'] = 'disabled';
			}

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
			$arrParam['idEquipo'] = $data['information'][0]['fk_id_equipo_ot'];
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
     * Cargo modal - formulario Estado orden trabajo
     * @since 29/01/2021
     * @author BMOTTAG
     */
    public function cargarModalEstadoOrdenTrabajo() 
	{
			header("Content-Type: text/plain; charset=utf-8");

			$data['idOrdenTrabajo'] = $this->input->post("idOrdenTrabajo");
			$data['information'] = $this->general_model->get_orden_trabajo($data);

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
			$tipoMantenimiento = $this->input->post("hddtipoMantenimiento");
				
			$msj = "Se guardo la información!";

			if ($this->ordentrabajo_model->guardarEstadoOrdentrabajo($data['idRecord'])) 
			{
				//actualizar estado actual en OT
				$this->ordentrabajo_model->updateOrdentrabajo($data['idRecord']);

				//si es mantenimiento correctivo y el estado es diferente de asignado entonces cambio el estado de mantenimiento a FINALIZADO
				$estadoActual = $this->input->post('estado');
				if($tipoMantenimiento == 1 && $estadoActual>1){
					$estadoMantenimiento = 3;//FINALIZADO
					$this->ordentrabajo_model->updateEstadoMantenimientoCorrectivo($estadoMantenimiento);
				}

				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
		
			echo json_encode($data);
    }

	/**
	 * Lista de OT filtrado por estado
     * @since 1/2/2021
     * @author BMOTTAG
	 */
	public function orden_estado($estado, $year="x")
	{						
			$from = date('Y-m-d', mktime(0,0,0, 1, 1, $year));//primer dia del año
			$to = date('Y-m-d', mktime(0,0,0, 1, 1, $year+1));//primer dia del siguiente año para que incluya todo el dia anterior en la consulta
			
			$arrParam = array(
				"from" => $from,
				"to" => $to,
				"estado" => $estado
			);
			$data['infoOrdenesTrabajo'] = $this->general_model->get_orden_trabajo($arrParam);

			$data["view"] = "listado_orden_trabajo";
			$this->load->view("layout", $data);	
	}

	/**
     * Cargo modal - formulario orden trabajo para mentenimiento preventivo
     * @since 1/2/2021
     * @author BMOTTAG
     */
    public function cargarModalOrdenTrabajo() 
	{
			header("Content-Type: text/plain; charset=utf-8");

			$arrParam['tipoMantenimiento'] = $data["tipoMantenimiento"] = $this->input->post("tipoMantenimiento");

			$idCompuesto = $this->input->post("idCompuesto");
			$porciones = explode('-', $idCompuesto);

			$arrParam['idMantenimiento'] = $data['idMantenimiento'] = $porciones[0];
			$arrParam['idEquipo'] = $data['idEquipo'] = $porciones[1];

			//busco datos del equipo
			$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);

			//buscar informacion de la orden de trabajo
			$data['information'] = FALSE;
			//$data['information'] = $this->general_model->get_orden_trabajo($arrParam);
		
			//Lista de encargados activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 3
						);
			$data['listaEncargados'] = $this->general_model->get_user($arrParam);

			$this->load->view("ordentrabajo_modal", $data);
    }
	
	
	
	
	
}