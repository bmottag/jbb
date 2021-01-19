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
					'horas_actuales_vehiculo' => $this->input->post('hours'),
					'radiador' => $this->input->post('radiador'),
					'tapa' => $this->input->post('tapa'),
					'nivel_refrigeracion' => $this->input->post('nivel_refrigeracion'),
					'tension_correa_ventilacion' => $this->input->post('tension_correa_ventilacion'),
					'manometro_temperatura' => $this->input->post('manometro_temperatura'),
					'persiana' => $this->input->post('persiana'),
					'comments' => $this->input->post('comments'),
					'tanque_combustible' => $this->input->post('tanque_combustible'),
					'indicador' => $this->input->post('indicador'),
					'tuberia_baja_presion' => $this->input->post('tuberia_baja_presion'),
					'grifo' => $this->input->post('grifo'),
					'vaso_sedimentacion' => $this->input->post('vaso_sedimentacion'),
					'filtro_aire' => $this->input->post('filtro_aire'),
					'filtro_combustible' => $this->input->post('filtro_combustible'),
					'prefiltro' => $this->input->post('prefiltro'),
					'filtro_aire_tipo_seco' => $this->input->post('filtro_aire_tipo_seco'),
					'pre_calentador' => $this->input->post('pre_calentador'),
					'acelerador_manual' => $this->input->post('acelerador_manual'),
					'acelerador_aire' => $this->input->post('acelerador_aire'),
					'ahogador' => $this->input->post('ahogador'),
					'consumo_acpm' => $this->input->post('consumo_acpm'),
					'tapon_carter' => $this->input->post('tapon_carter'),
					'nivel_aceite_motor' => $this->input->post('nivel_aceite_motor'),
					'bayoneta' => $this->input->post('bayoneta'),
					'presion_aceite_motor' => $this->input->post('presion_aceite_motor'),
					'indicador_presion' => $this->input->post('indicador_presion'),
					'tapa_drenaje_caja' => $this->input->post('tapa_drenaje_caja'),
					'bombillo_tablero' => $this->input->post('bombillo_tablero'),
					'nivel_aceite_direccion' => $this->input->post('nivel_aceite_direccion'),
					'bomba_hidraulica' => $this->input->post('bomba_hidraulica'),
					'bateria' => $this->input->post('bateria'),
					'nivel_electrolito' => $this->input->post('nivel_electrolito'),
					'bornes_bateria' => $this->input->post('bornes_bateria'),
					'terminales' => $this->input->post('terminales'),
					'seguro_bateria' => $this->input->post('seguro_bateria'),
					'caja' => $this->input->post('caja'),
					'tapa_celdas' => $this->input->post('tapa_celdas'),
					'conexiones_alternador' => $this->input->post('conexiones_alternador'),
					'regulador_corriente' => $this->input->post('regulador_corriente'),
					'indicador_tablero' => $this->input->post('indicador_tablero'),
					'luz_testigo' => $this->input->post('luz_testigo'),
					'horometro' => $this->input->post('horometro'),
					'interruptor' => $this->input->post('interruptor'),
					'farolas_delanteras' => $this->input->post('farolas_delanteras'),
					'farolas_traseras' => $this->input->post('farolas_traseras'),
					'pedal_embrague' => $this->input->post('pedal_embrague'),
					'tolerancia_pedal' => $this->input->post('tolerancia_pedal'),
					'engrase_sistema' => $this->input->post('engrase_sistema'),
					'nivel_aceite' => $this->input->post('nivel_aceite'),
					'palanca_baja' => $this->input->post('palanca_baja'),
					'palanca_alta' => $this->input->post('palanca_alta'),
					'selector_velocidad' => $this->input->post('selector_velocidad'),
					'esfera_palanca' => $this->input->post('esfera_palanca'),
					'palanca' => $this->input->post('palanca'),
					'barra_tiro' => $this->input->post('barra_tiro'),
					'bloqueador' => $this->input->post('bloqueador'),
					'nivel_aceite_diferencial' => $this->input->post('nivel_aceite_diferencial'),
					'bayoneta_diferencial' => $this->input->post('bayoneta_diferencial'),
					'pesas_delanteras' => $this->input->post('pesas_delanteras'),
					'pesas_traseras' => $this->input->post('pesas_traseras'),
					'pernos_delanteros' => $this->input->post('pernos_delanteros'),
					'palanca_control_posicion' => $this->input->post('palanca_control_posicion'),
					'palanca_control_automatico' => $this->input->post('palanca_control_automatico'),
					'nivel_aceite_hidraulico' => $this->input->post('nivel_aceite_hidraulico'),
					'bayoneta_hidraulico' => $this->input->post('bayoneta_hidraulico'),
					'tuberia_conduccion' => $this->input->post('tuberia_conduccion'),
					'radiador_enfriado' => $this->input->post('radiador_enfriado'),
					'brazos_levante' => $this->input->post('brazos_levante'),
					'cadenas_tensoras' => $this->input->post('cadenas_tensoras'),
					'mangueras' => $this->input->post('mangueras'),
					'tonillo_nivelados' => $this->input->post('tonillo_nivelados'),
					'guardafangos' => $this->input->post('guardafangos'),
					'asiento' => $this->input->post('asiento'),
					'capot' => $this->input->post('capot'),
					'caja_direccion' => $this->input->post('caja_direccion'),
					'brazo_direccion' => $this->input->post('brazo_direccion'),
					'barra_principal' => $this->input->post('barra_principal'),
					'soporte_delantero' => $this->input->post('soporte_delantero'),
					'tolerancia_frenos' => $this->input->post('tolerancia_frenos'),
					'freno_mano' => $this->input->post('freno_mano'),
					'tapa_rueda_delantera' => $this->input->post('tapa_rueda_delantera'),
					'rines_traseros' => $this->input->post('rines_traseros'),
					'rines_delanteros' => $this->input->post('rines_delanteros')
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