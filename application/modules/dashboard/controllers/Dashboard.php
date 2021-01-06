<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
    }

	/**
	 * Index Page for this controller.
	 * Basic dashboard
	 */
	public function index()
	{	
			//cuenta payroll para el usuario 
			$arrParam["task"] = 1;//buscar por timestap
			$data['noTareas'] = $this->general_model->countTask($arrParam);
			
			$data['noSafety'] = $this->dashboard_model->countSafety();//cuenta registros de safety
			$data['noJobs'] = $this->dashboard_model->countJobs();//cuenta registros de Jobs
			$data['noHauling'] = $this->dashboard_model->countHauling();//cuenta registros de hauling
			$data['noDailyInspection'] = $this->dashboard_model->countDailyInspection();//cuenta registros de DailyInspection
			$data['noHeavyInspection'] = $this->dashboard_model->countHeavyInspection();//cuenta registros de HeavyInspection
			$data['noSpecialInspection'] = $this->dashboard_model->countSpecialInspection();//cuenta registros de SpecialInspection
			
			//informacion de un dayoff si lo aprobaron y lo negaron
			$data['dayoff'] = $this->dashboard_model->dayOffInfo();
				
			$data['infoMaintenance'] = $this->general_model->get_maintenance_check();
						
			$arrParam["limit"] = 30;//Limite de registros para la consulta
			$data['info'] = $this->general_model->get_task($arrParam);//search the last 5 records 
			
			$data['infoSafety'] = $this->general_model->get_safety($arrParam);//info de safety
			
			$arrParam["limit"] = 6;//Limite de registros para la consulta
			$data['infoWaterTruck'] = $this->general_model->get_special_inspection_water_truck($arrParam);//info de water truck
			$data['infoHydrovac'] = $this->general_model->get_special_inspection_hydrovac($arrParam);//info de hydrovac
			$data['infoSweeper'] = $this->general_model->get_special_inspection_sweeper($arrParam);//info de sweeper
			$data['infoGenerator'] = $this->general_model->get_special_inspection_generator($arrParam);//info de generador
		
			$data["view"] = "dashboard";
			$this->load->view("layout", $data);
	}
		
	/**
	 * SUPER ADMIN DASHBOARD
	 */
	public function admin()
	{				
			$data = array();
		
			$data["view"] = "dashboard";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Informacion de los roles
     * @since 1/12/2020
     * @author BMOTTAG
	 */
	public function rol_info()
	{		
			$data["view"] ='rol_info';
			$this->load->view("layout", $data);
	}

	/**
	 * Calendario
     * @since 6/1/2021
     * @author BMOTTAG
	 */
	public function calendar()
	{
			$data["view"] = 'calendar';
			$this->load->view("layout", $data);
	}

	/**
	 * Consulta desde el calendario
     * @since 6/1/2021
     * @author BMOTTAG
	 */
    public function consulta() 
    {
	        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$start = substr($start,0,10);
			$end = substr($end,0,10);

			$arrParam = array(
				"from" => $start,
				"to" => $end
			);
			
			//informacion Work Order
			$polizas = $this->general_model->get_polizas($arrParam);

			echo  '[';

			if($polizas)
			{
				$longitud = count($polizas);
				$i=1;
				foreach ($polizas as $data):
					echo  '{
						      "title": "Póliza a vencerse #: ' . $data['numero_poliza'] . ' - Equipo No. Inventario: ' . $data['numero_inventario'] . '",
						      "start": "' . $data['fecha_vencimiento'] . '",
						      "end": "' . $data['fecha_vencimiento'] . '",
						      "color": "green",
						      "url": "' . base_url("equipos/detalle/" . $data['id_equipo']) . '"
						    }';

					if($i<$longitud){
							echo ',';
					}
					$i++;
				endforeach;
			}

			echo  ']';

    }
	
	
}