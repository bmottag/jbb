<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reportes_model extends CI_Model {
	    
		/**
		 * Consulta lista de equipos
		 * @since 19/11/2020
		 */
		public function get_equipos_info($arrData) 
		{		
				$this->db->select();
				$this->db->join('param_dependencias D', 'D.id_dependencia = A.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = A.fk_id_tipo_equipo', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.id_equipo', $arrData["idEquipo"]);
				}
				if (array_key_exists("estadoEquipo", $arrData)) {
					$this->db->where('A.estado_equipo', $arrData["estadoEquipo"]);
				}
				if (array_key_exists("encryption", $arrData)) {
					$this->db->where('A.qr_code_encryption ', $arrData["encryption"]);
				}
				if (array_key_exists("idTipoEquipo", $arrData) && $arrData["idTipoEquipo"] != '') {
					$this->db->like('A.fk_id_tipo_equipo', $arrData["idTipoEquipo"]); 
				}
				if (array_key_exists("numero_inventario", $arrData) && $arrData["numero_inventario"] != '') {
					$this->db->like('A.numero_inventario', $arrData["numero_inventario"]); 
				}
				if (array_key_exists("marca", $arrData) && $arrData["marca"] != '') {
					$this->db->like('A.marca', $arrData["marca"]); 
				}
				if (array_key_exists("modelo", $arrData) && $arrData["modelo"] != '') {
					$this->db->like('A.modelo', $arrData["modelo"]); 
				}
				if (array_key_exists("numero_serial", $arrData) && $arrData["numero_serial"] != '') {
					$this->db->like('A.numero_serial', $arrData["numero_serial"]); 
				}

				$this->db->order_by('id_equipo', 'desc');
				
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('equipos A', $arrData["limit"]);
				}else{
					$query = $this->db->get('equipos A');
				}

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta detalles de quipos tipo vehiculos
		 * @since 3/12/2020
		 */
		public function equipos_detalle_vehiculo($arrData) 
		{		
				$this->db->select();				
				$this->db->join('param_clase_vehiculo C', 'C.id_clase_vechiculo = A.fk_id_clase_vechiculo', 'LEFT');
				$this->db->join('param_tipo_carroceria T', 'T.id_tipo_carroceria = A.fk_id_tipo_carroceria', 'LEFT');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo', $arrData["idEquipo"]);
				}
				
				$query = $this->db->get('equipos_detalle_vehiculo A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Lista de localizacion por equipo
		 * @since 17/12/2020
		 */
		public function get_localizacion($arrData) 
		{		
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_user_localizacion', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_localizacion', $arrData["idEquipo"]);
				}
				if (array_key_exists("idEquipoLocalizacion", $arrData)) {
					$this->db->where('A.id_equipo_localizacion', $arrData["idEquipoLocalizacion"]);
				}
				
				$this->db->order_by('A.id_equipo_localizacion', 'desc');
				$query = $this->db->get('equipos_localizacion A', 1);


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Lista de polizas
		 * Modules: Dashboard 
		 * @since 6/1/2021
		 */
		public function get_polizas($arrData) 
		{		
				$this->db->select();
				$this->db->join('equipos E', 'E.id_equipo = P.fk_id_equipo_poliza ', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('P.fk_id_equipo_poliza', $arrData["idEquipo"]);
				}
				
				if (array_key_exists('to', $arrData) && $arrData['to'] != '') {
					$this->db->where('P.fecha_vencimiento >=', $arrData['to']);
				}								
				$this->db->order_by('P.id_equipo_poliza', 'desc');
				$query = $this->db->get('equipos_poliza P');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}			
		}

		/**
		 * Lista de control combustile por equipo
		 * @since 17/12/2020
		 */
		public function get_control_combustible($arrData) 
		{		
				$this->db->select('A.*, CONCAT(first_name, " ", last_name) name');				
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_operador_combustible', 'INNER');
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_combustible', $arrData["idEquipo"]);
				}
				if (array_key_exists("idControlCombustible", $arrData)) {
					$this->db->where('A.id_equipo_control_combustible', $arrData["idControlCombustible"]);
				}
				
				$this->db->order_by('A.id_equipo_control_combustible', 'desc');
				$query = $this->db->get('equipos_control_combustible A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		
		
	    
	}