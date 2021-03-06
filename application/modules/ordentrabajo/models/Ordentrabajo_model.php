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
					'fk_id_user_encargado' => $this->input->post('id_encargado')
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
					$data['observacion'] = $this->input->post('informacion');
					$data['informacion_adicional'] = 'O.T. Creada y asignada';
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
					'informacion_adicional_estado' => 'O.T. Creada y asignada',
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

		/**
		 * Add info boton go back
		 * @since 25/2/2021
		 */
		public function saveInfoGoBack($arrData) 
		{
			$idUser = $this->session->userdata("id");
			
			//delete datos anteriores del usuario
			$this->db->delete('orden_trabajo_go_back', array('fk_id_user_go_back' => $idUser));
			
			$data = array('fk_id_user_go_back' => $idUser);

			if (array_key_exists("idTipoEquipo", $arrData)) {
				$data['post_id_tipo_equipo'] = $arrData["idTipoEquipo"];
			}
			if (array_key_exists("idEquipo", $arrData)) {
				$data['post_id_equipo'] = $arrData["idEquipo"];
			}
			if (array_key_exists("OTNumber", $arrData)) {
				$data['post_id_orden_trabajo'] = $arrData["OTNumber"];
			}
			if (array_key_exists("estado", $arrData)) {
				$data['post_estado'] = $arrData["estado"];
			}
			if (array_key_exists("from", $arrData)) {
				$data['post_from'] = $arrData["from"];
			}
			if (array_key_exists("to", $arrData)) {
				$data['post_to'] = $arrData["to"];
			}
			
			$query = $this->db->insert('orden_trabajo_go_back', $data);

		}

		
		

		
	    
	}