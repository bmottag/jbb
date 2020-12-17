<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Equipos_model extends CI_Model {

	    		
		/**
		 * Guardar equipo
		 * @since 19/11/2020
		 */
		public function guardarEquipo($pass) 
		{
				$idEquipo = $this->input->post('hddId');
				
				$data = array(
					'numero_inventario' => $this->input->post('numero_inventario'),
					'fk_id_dependencia' => $this->input->post('id_dependencia'),
					'marca' => $this->input->post('marca'),
					'modelo' => $this->input->post('modelo'),
					'numero_serial' => $this->input->post('numero_serial'),
					'fk_id_tipo_equipo' => $this->input->post('id_tipo_equipo'),
					'estado_equipo' => $this->input->post('estado'),
					'valor_comercial' => $this->input->post('valor_comercial'),
					'fecha_adquisicion' => $this->input->post('fecha_adquisicion'),
					'observacion' => $this->input->post('observacion')
				);	

				//revisar si es para adicionar o editar
				if ($idEquipo == '') 
				{							
					$query = $this->db->insert('equipos', $data);
					$idEquipo = $this->db->insert_id();
					
					//actualizo la url del codigo QR
					$path = $idEquipo . $pass;
					$rutaQRcode = "images/equipos/QR/" . $idEquipo . "_qr_code.png";
			
					//actualizo campo con el path encriptado
					$sql = "UPDATE equipos SET qr_code_encryption = '$path', qr_code_img = '$rutaQRcode'  WHERE id_equipo = $idEquipo";
					$query = $this->db->query($sql);
				} else {
					$this->db->where('id_equipo', $idEquipo);
					$query = $this->db->update('equipos', $data);
				}
				if ($query) {
					return $idEquipo;
				} else {
					return false;
				}
		}	
		
		/**
		 * Guardar equipo
		 * @since 3/12/2020
		 */
		public function guardarInfoEspecificaVehiculo() 
		{
				$idInfoEspecificaEquipo = $this->input->post('hddId');
				
				$data = array(
					'fk_id_equipo' => $this->input->post('hddIdEquipo'),
					'placa' => $this->input->post('placa'),
					'linea' => $this->input->post('linea'),
					'color' => $this->input->post('color'),
					'fk_id_clase_vechiculo' => $this->input->post('id_clase_vechiculo'),
					'fk_id_tipo_carroceria' => $this->input->post('id_tipo_carroceria'),
					'combustible' => $this->input->post('combustible'),
					'capacidad' => $this->input->post('capacidad'),
					'servicio' => $this->input->post('servicio'),
					'numero_motor' => $this->input->post('numero_motor'),
					'multas' => $this->input->post('multas')
				);	

				//revisar si es para adicionar o editar
				if ($idInfoEspecificaEquipo == '') 
				{							
					$query = $this->db->insert('equipos_detalle_vehiculo', $data);
				} else {
					$this->db->where('id_equipo_detalle_vehiculo', $idInfoEspecificaEquipo);
					$query = $this->db->update('equipos_detalle_vehiculo', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Guardar equipo
		 * @since 9/12/2020
		 */
		public function guardarInfoEspecificaBomba() 
		{
				$idInfoEspecificaEquipo = $this->input->post('hddId');
				
				$data = array(
					'fk_id_equipo_bomba' => $this->input->post('hddIdEquipo'),
					'dimension' => $this->input->post('dimension'),
					'motor_frecuencia' => $this->input->post('motor_frecuencia'),
					'motor_velocidad' => $this->input->post('motor_velocidad'),
					'motor_voltaje' => $this->input->post('motor_voltaje'),
					'potencia' => $this->input->post('potencia'),
					'consumo' => $this->input->post('consumo'),
					'hmax' => $this->input->post('hmax'),
					'succion' => $this->input->post('succion'),
					'qmax' => $this->input->post('qmax'),
					'color' => $this->input->post('color'),
					'peso' => $this->input->post('peso'),
					'caracteristicas' => $this->input->post('caracteristicas'),
					'condiciones_operacion' => $this->input->post('condiciones_operacion')
				);	

				//revisar si es para adicionar o editar
				if ($idInfoEspecificaEquipo == '') 
				{							
					$query = $this->db->insert('equipos_detalle_bomba', $data);
				} else {
					$this->db->where('id_equipo_detalle_bomba', $idInfoEspecificaEquipo);
					$query = $this->db->update('equipos_detalle_bomba', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Verificar si el equipo ya existe por el numero de inventario
		 * @author BMOTTAG
		 * @since  10/12/2020
		 */
		public function verificarEquipo($arrData) 
		{
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('id_equipo !=', $arrData["idEquipo"]);
				}			

				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("equipos");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
		/**
		 * Add fotos
		 * @since 14/12/2020
		 */
		public function add_fotos($path) 
		{							
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_equipo_foto' => $this->input->post('hddId'),
					'equipo_foto' => $path,
					'fecha_foto' => date("Y-m-d")
				);			

				$query = $this->db->insert('equipos_fotos', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
				
		/**
		 * Lista de fotos por equipo
		 * @since 14/12/2020
		 */
		public function get_fotos_equipos($arrData) 
		{		
				$this->db->select();				

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_foto', $arrData["idEquipo"]);
				}
				if (array_key_exists("idEquipoFoto", $arrData)) {
					$this->db->where('A.id_equipo_foto', $arrData["idEquipoFoto"]);
				}
				
				$this->db->order_by('A.id_equipo_foto', 'asc');
				$query = $this->db->get('equipos_fotos A');


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
				$this->db->select();				

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_localizacion', $arrData["idEquipo"]);
				}
				if (array_key_exists("idEquipoLocalizacion", $arrData)) {
					$this->db->where('A.id_equipo_localizacion', $arrData["idEquipoLocalizacion"]);
				}
				
				$this->db->order_by('A.id_equipo_localizacion', 'desc');
				$query = $this->db->get('equipos_localizacion A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
	
		/**
		 * Guardar localizacion
		 * @since 17/12/2020
		 */
		public function guardarLocalizacion() 
		{
				$idLocalizacion = $this->input->post('hddId');
				$idEquipo = $this->input->post('hddIdEquipo');
				
				$data = array(
					'fk_id_equipo_localizacion' => $idEquipo,
					'localizacion' => $this->input->post('localizacion'),
					'fecha_localizacion' => $this->input->post('fecha')
				);	

				//revisar si es para adicionar o editar
				if ($idLocalizacion == '') 
				{							
					$query = $this->db->insert('equipos_localizacion', $data);
				} else {
					$this->db->where('id_equipo_localizacion', $idLocalizacion);
					$query = $this->db->update('equipos_localizacion', $data);
				}
				if ($query) {
					return true;
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
				$this->db->select();				

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
	
		/**
		 * Guardar localizacion
		 * @since 17/12/2020
		 */
		public function guardarControlCombustible() 
		{
				$idControlCombustible = $this->input->post('hddId');
				$idEquipo = $this->input->post('hddIdEquipo');
				
				$data = array(
					'fk_id_equipo_combustible' => $idEquipo,
					'kilometros_actuales' => $this->input->post('kilometros_actuales'),
					'cantidad' => $this->input->post('cantidad'),
					'fk_id_conductor_combustible ' => 1,
					'valor' => $this->input->post('valor'),
					'observacion' => $this->input->post('observacion')
				);	

				//revisar si es para adicionar o editar
				if ($idControlCombustible == '') 
				{
					$data['fecha_combustible'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('equipos_control_combustible', $data);
				} else {
					$this->db->where('id_equipo_control_combustible', $idControlCombustible);
					$query = $this->db->update('equipos_control_combustible', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		
		
		
		
	    
	}