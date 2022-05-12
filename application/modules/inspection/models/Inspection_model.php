<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Inspection_model extends CI_Model {

		
		/**
		 * Add/Edit Vehicle Inspection
		 * @since 18/1/2021
		 */
		public function saveVehicleInspection() 
		{
				$idUser = $this->session->userdata("id");
				$idVehicleInspection = $this->input->post('hddId');
						
				$data = array(
					'fk_id_equipo_vehiculo' => $this->input->post('hddIdVehicle'),
					'activo' => $this->input->post('activo'),
					'razon_inactivo' => $this->input->post('razon'),
					'razon_cual' => $this->input->post('cual'),
					'horas_actuales_vehiculo' => $this->input->post('hours'),
					'radiador' => 1,
					'tapa' => 1,
					'nivel_refrigeracion' => 1,
					'tension_correa_ventilacion' => 1,
					'manometro_temperatura' => 1,
					'persiana' => 1,
					'comments' => 1,
					'tanque_combustible' => 1,
					'indicador' => 1,
					'tuberia_baja_presion' => 1,
					'grifo' => 1,
					'vaso_sedimentacion' => 1,
					'filtro_aire' => 1,
					'filtro_combustible' => 1,
					'prefiltro' => 1,
					'filtro_aire_tipo_seco' => 1,
					'pre_calentador' => 1,
					'acelerador_manual' => 1,
					'acelerador_aire' => 1,
					'ahogador' => 1,
					'tapon_carter' => 1,
					'nivel_aceite_motor' => 1,
					'bayoneta' => 1,
					'presion_aceite_motor' => 1,
					'indicador_presion' => 1,
					'tapa_drenaje_caja' => 1,
					'bombillo_tablero' => 1,
					'nivel_aceite_direccion' => 1,
					'bomba_hidraulica' => 1,
					'bateria' => 1,
					'nivel_electrolito' => 1,
					'bornes_bateria' => 1,
					'terminales' => 1,
					'seguro_bateria' => 1,
					'caja' => 1,
					'tapa_celdas' => 1,
					'conexiones_alternador' => 1,
					'regulador_corriente' => 1,
					'indicador_tablero' => 1,
					'luz_testigo' => 1,
					'horometro' => 1,
					'interruptor' => 1,
					'farolas_delanteras' => 1,
					'farolas_traseras' => 1,
					'pedal_embrague' => 1,
					'tolerancia_pedal' => 1,
					'engrase_sistema' => 1,
					'nivel_aceite' => 1,
					'palanca_baja' => 1,
					'palanca_alta' => 1,
					'selector_velocidad' => 1,
					'esfera_palanca' => 1,
					'palanca' => 1,
					'barra_tiro' => 1,
					'bloqueador' => 1,
					'nivel_aceite_diferencial' => 1,
					'bayoneta_diferencial' => 1,
					'pesas_delanteras' => 1,
					'pesas_traseras' => 1,
					'pernos_delanteros' => 1,
					'palanca_control_posicion' => 1,
					'palanca_control_automatico' => 1,
					'nivel_aceite_hidraulico' => 1,
					'bayoneta_hidraulico' => 1,
					'tuberia_conduccion' => 1,
					'radiador_enfriado' => 1,
					'brazos_levante' => 1,
					'cadenas_tensoras' => 1,
					'mangueras' => 1,
					'tonillo_nivelados' => 1,
					'guardafangos' => 1,
					'asiento' => 1,
					'capot' => 1,
					'caja_direccion' => 1,
					'brazo_direccion' => 1,
					'barra_principal' => 1,
					'soporte_delantero' => 1,
					'tolerancia_frenos' => 1,
					'freno_mano' => 1,
					'tapa_rueda_delantera' => 1,
					'rines_traseros' => 1,
					'rines_delanteros' => 1
				);
								
				//revisar si es para adicionar o editar
				if ($idVehicleInspection == '') 
				{
					$data['fk_id_user_responsable'] = $idUser;
					$data['fecha_registro'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('inspection_vehiculos', $data);
					$idVehicleInspection = $this->db->insert_id();
				} else {
					$this->db->where('id_inspection_vehiculos', $idVehicleInspection);
					$query = $this->db->update('inspection_vehiculos', $data);
				}
				if ($query) {
					return $idVehicleInspection;
				} else {
					return false;
				}
		}
		
		/**
		 * Add vehicle next oil change
		 * @since 18/1/2017
		 */
		public function saveVehicleNextOilChange($idVehicle, $state, $idInspection) 
		{
				$idUser = $this->session->userdata("id");
				
				$data = array(
					'fk_id_vehicle' => $idVehicle,
					'fk_id_user' => $idUser,
					'current_hours' => $this->input->post('hours'),
					'next_oil_change' => $this->input->post('oilChange'),
					'state' => $state,
					'current_hours_2' => $this->input->post('hours2'),
					'next_oil_change_2' => $this->input->post('oilChange2'),
					'current_hours_3' => $this->input->post('hours3'),
					'next_oil_change_3' => $this->input->post('oilChange3'),
					'fk_id_inspection' => $idInspection
				);	


				$query = $this->db->insert('vehicle_oil_change', $data);
				$idVehicleNextOilChange = $this->db->insert_id();
				$fecha = date("Y-m-d G:i:s");

				//actualizo fecha del registo
				$sql = "UPDATE vehicle_oil_change SET date_issue = '$fecha' WHERE id_oil_change=$idVehicleNextOilChange";
				$query = $this->db->query($sql);

				if ($query) {
					
					$data = array(
						'hours' => $this->input->post('hours'),
						'hours_2' => $this->input->post('hours2'),
						'hours_3' => $this->input->post('hours3')
					);

					$this->db->where('id_vehicle', $idVehicle);
					$query = $this->db->update('param_vehicle', $data);
	
					if ($query) {
						return true;
					}else{
						//se debe borrar el registro en la tabla vehicle_oil_change
						return false;
					}
				} else {
					return false;
				}
		}



		
		

		
	    
	}