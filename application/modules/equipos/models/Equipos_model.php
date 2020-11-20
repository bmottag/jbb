<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Equipos_model extends CI_Model {

	    		
		/**
		 * Guardar equipo
		 * @since 19/11/2020
		 */
		public function guardarEquipo() 
		{
				$idEquipo = $this->input->post('hddId');
				
				$data = array(
					'numero_unidad' => $this->input->post('numero_unidad'),
					'nombre_equipo' => $this->input->post('nombre_equipo'),
					'fabricante' => $this->input->post('fabricante'),
					'modelo' => $this->input->post('modelo'),
					'numero_serial' => $this->input->post('numero_serial'),
					'estado_equipo' => $this->input->post('estado'),
					'observacion' => $this->input->post('observacion')
				);	

				//revisar si es para adicionar o editar
				if ($idEquipo == '') {							
					$query = $this->db->insert('equipos', $data);
					$idEquipo = $this->db->insert_id();
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