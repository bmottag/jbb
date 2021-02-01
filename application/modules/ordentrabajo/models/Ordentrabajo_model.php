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
					'informacion_adicional' => $this->input->post('informacion')
				);	

				//revisar si es para adicionar o editar
				if ($idOrdenTrabajo == '') 
				{
					$data['tipo_mantenimiento'] = $this->input->post('hddtipoMantenimiento');
					$data['fk_id_mantenimiento'] = $this->input->post('hddIdMantenimiento');
					$data['fk_id_equipo_ot '] = $this->input->post('hddIdEquipo');
					$data['fecha_asignacion'] = date("Y-m-d");
					$data['fk_id_user_orden'] = $idUser;
					$data['estado_actual'] = $this->input->post('estado');
					$query = $this->db->insert('orden_trabajo', $data);
					$idOrdenTrabajo = $this->db->insert_id();
				} else {
					$this->db->where('id_orden_trabajo', $idOrdenTrabajo);
					$query = $this->db->update('orden_trabajo', $data);
				}
				if ($query) {
					return $idOrdenTrabajo;
				} else {
					return false;
				}
		}

		/**
		 * Guardar estado orden trabajo
		 * @since 29/1/2021
		 */
		public function guardarEstadoOrdentrabajo($idOrdenTrabajo) 
		{
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_orden_trabajo_estado' => $idOrdenTrabajo,
					'fk_id_user_ote' => $idUser,
					'fecha_registro_estado' => date("Y-m-d G:i:s"),
					'informacion_adicional_estado' => $this->input->post('informacion'),
					'estado' => $this->input->post('estado')
				);	

				$query = $this->db->insert('orden_trabajo_estado', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar orden trabajo estado
		 * @since 29/1/2021
		 */
		public function updateOrdentrabajo() 
		{		
				$idOrdenTrabajo = $this->input->post("hddIdOrdenTrabajo");

				$data = array(
					'informacion_adicional' => $this->input->post('informacion'),
					'estado_actual' => $this->input->post('estado')
				);

				$this->db->where('id_orden_trabajo', $idOrdenTrabajo);
				$query = $this->db->update('orden_trabajo', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar Estado Mantenimiento Correctivo
		 * @since 31/1/2021
		 */
		public function updateEstadoMantenimientoCorrectivo($estado)
		{		
				$idMantenimiento = $this->input->post('hddIdMantenimiento');

				$data = array(
					'estado' => $estado
				);

				$this->db->where('id_correctivo', $idMantenimiento);
				$query = $this->db->update('mantenimiento_correctivo', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
		

		
	    
	}