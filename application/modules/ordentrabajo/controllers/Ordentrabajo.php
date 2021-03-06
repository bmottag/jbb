<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordentrabajo extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("ordentrabajo_model");
        $this->load->model("general_model");
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

	/**
	 * Buscar OT
     * @since 11/02/2021
     * @author BMOTTAG
	 */
    public function search($goBack = 'x') 
	{
			//filtrar por estado y fecha, para el cuadro de notificaciones
			$year = date('Y');
			$firstDay = date('Y-m-d', mktime(0,0,0, 1, 1, $year));//primer dia del año, para filtrar por año

			$arrParam = array(
				'estado' => 1,
				'from' => $firstDay
			);
			$data['asignadas'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['asignadas'] = $data['asignadas']?count($data['asignadas']):0;

			$arrParam['estado'] = 2;
			$data['solucionadas'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['solucionadas'] = $data['solucionadas']?count($data['solucionadas']):0;

			$arrParam['estado'] = 3;
			$data['canceladas'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['canceladas'] = $data['canceladas']?count($data['canceladas']):0;

			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);
			
			$data['view'] = 'form_search';

			//viene desde el boton go back
			if($goBack == 'y')
			{
				$workOrderGoBackInfo = $this->workorders_model->get_workorder_go_back();

				if(!$workOrderGoBackInfo){
					redirect(base_url('workorders'), 'refresh');
				}else{	
					//le sumo un dia al dia final para que ingrese ese dia en la consulta
					$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($workOrderGoBackInfo['post_to']) ) ) );
					//$from = formatear_fecha($workOrderGoBackInfo['post_from']);
					
					$arrParam = array(
						"jobId" => $workOrderGoBackInfo['post_id_job'],
						"idWorkOrder" => $workOrderGoBackInfo['post_id_work_order'],
						"idWorkOrderFrom" => $workOrderGoBackInfo['post_id_wo_from'],
						"idWorkOrderTo" => $workOrderGoBackInfo['post_id_wo_to'],
						"from" => $workOrderGoBackInfo['post_from'],//$from,
						"to" => $to,
						"state" => $workOrderGoBackInfo['post_state']
					);

					$data['workOrderInfo'] = $this->workorders_model->get_workorder_by_idJob($arrParam);

					$data["view"] = "asign_rate_list";
					$this->load->view("layout_calendar", $data);
				}
			}
			//Si envian los datos del filtro entonces lo direcciono a la lista respectiva con los datos de la consulta
			elseif($this->input->post('id_tipo_equipo') || $this->input->post('idEquipo') || $this->input->post('OTNumber') || $this->input->post('estado'))
			{								
				$data['id_tipo_equipo'] =  $this->input->post('id_tipo_equipo');
				$data['idEquipo'] =  $this->input->post('idEquipo');
				$data['OTNumber'] =  $this->input->post('OTNumber');
				$data['estado'] =  $this->input->post('estado');
				$data['from'] =  $this->input->post('from');
				$data['to'] =  $this->input->post('to');
			
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				if($data['to']){
					$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );
				}else{
					$to = "";
				}
				if($data['from']){
					$from = formatear_fecha($data['from']);
				}else{
					$from = "";
				}
				
				$arrParam = array(
					"idTipoEquipo" => $this->input->post('id_tipo_equipo'),
					"idEquipo" => $this->input->post('idEquipo'),
					"idOrdenTrabajo" => $this->input->post('OTNumber'),
					"estado" => $this->input->post('estado'),
					"from" => $from,
					"to" => $to
				);
				
				//guardo la informacion en la base de datos para el boton de regresar
				$this->ordentrabajo_model->saveInfoGoBack($arrParam);

				//informacion Ordenes de trabajo
				$data['infoOrdenesTrabajo'] = $this->general_model->get_orden_trabajo($arrParam);

				$data["view"] = "listado_orden_trabajo";
				$this->load->view("layout", $data);
			}else{
				$this->load->view("layout", $data);
			}
    }

	/**
	 * Lista de equipos
     * @since 25/2/2021
     * @author BMOTTAG
	 */
    public function listaEquipos() {
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
		
		//lista de equipos
		$arrParam = array("idTipoEquipo" => $this->input->post('idTipoEquipo'));
		$lista = $this->general_model->get_equipos_info($arrParam);

        echo "<option value=''>Select...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_equipo"] . "' >" . $fila["numero_inventario"] . "</option>";
            }
        }
    }
	
	
	
	
	
}