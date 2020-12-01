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
		
		
		
		
		
		
	    
	}