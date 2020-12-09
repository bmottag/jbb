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
					'observacion' => $this->input->post('observacion')
				);	

				//revisar si es para adicionar o editar
				if ($idEquipo == '') 
				{							
					$query = $this->db->insert('equipos', $data);
					$idEquipo = $this->db->insert_id();
					
					//actualizo la url del codigo QR
					$path = $idEquipo . $pass;
					$rutaQRcode = "images/equipos/" . $idEquipo . "_qr_code.png";
			
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
		
		
		
		
		
		
	    
	}