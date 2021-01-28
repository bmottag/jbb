<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ordentrabajo_model extends CI_Model {

		
		/**
		 * Guardar orden trabajo
		 * @since 27/1/2021
		 */
		public function guardarOrdentrabajo() 
		{
				$idOrdenTrabajo = $this->input->post('hddIdOrdenTrabajo');
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_user_encargado' => $this->input->post('id_encargado'),
					'informacion_adicional' => $this->input->post('informacion'),
					'ultimo_estado' => 1
				);	

				//revisar si es para adicionar o editar
				if ($idOrdenTrabajo == '') 
				{
					$data['tipo_mantenimiento'] = $this->input->post('hddtipoMantenimiento');
					$data['fk_id_mantenimiento'] = $this->input->post('hddIdMantenimiento');
					$data['fecha_asignacion'] = date("Y-m-d");
					$data['fk_id_user_orden'] = $idUser;
					$query = $this->db->insert('orden_trabajo', $data);
				} else {
					$this->db->where('id_orden_trabajo', $idLocalizacion);
					$query = $this->db->update('orden_trabajo', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}



		
		

		
	    
	}