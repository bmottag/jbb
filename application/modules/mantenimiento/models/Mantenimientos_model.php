<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mantenimientos_model extends CI_Model {

	/**
	 * Consulta lista de mantenimientos preventivos
	 * @since 20/12/2020
	 */
	public function get_preventivos_info($arrData)
	{		
		$this->db->select();
		$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = P.fk_id_tipo_equipo', 'INNER');
		$this->db->join('param_frecuencia F', 'F.id_frecuencia = P.fk_id_frecuencia', 'INNER');
		if (array_key_exists("id_preventivo", $arrData)) {
			$this->db->where('P.id_preventivo', $arrData["id_preventivo"]);
		}
		if (array_key_exists("estado", $arrData)) {
			$this->db->where('P.estado', $arrData["estado"]);
		}
		if (array_key_exists("fecha_inicio", $arrData) && $arrData["fecha_inicio"] != '') {
			$this->db->like('P.fecha_inicio', $arrData["fecha_inicio"]); 
		}
		if (array_key_exists("tipo_equipo", $arrData) && $arrData["tipo_equipo"] != '') {
			$this->db->like('P.fk_id_tipo_equipo', $arrData["tipo_equipo"]); 
		}
		if (array_key_exists("frecuencia", $arrData) && $arrData["frecuencia"] != '') {
			$this->db->like('P.fk_id_frecuencia', $arrData["frecuencia"]); 
		}
		$this->db->order_by('id_preventivo', 'desc');
		if (array_key_exists("limit", $arrData)) {
			$query = $this->db->get('mantenimiento_preventivo P', $arrData["limit"]);
		}else{
			$query = $this->db->get('mantenimiento_preventivo P');
		}
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	/**
	 * Guardar mantenimiento preventivo
	 * @since 16/12/2020
	 */
	public function guardarPreventivo() 
	{
		$data = array(
			'fecha_inicio' => $this->input->post('fecha_inicio'),
			'fk_id_tipo_equipo' => $this->input->post('id_tipo_equipo'),
			'fk_id_frecuencia' => $this->input->post('frecuencia'),
			'descripcion' => $this->input->post('descripcion'),
			'estado' => 1
		);	
		$query = $this->db->insert('mantenimiento_preventivo', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Consulta lista de mantenimientos preventivos
	 * @since 20/12/2020
	 */
	public function get_correctivos_info($arrData)
	{		
		$this->db->select();
		$this->db->join('equipos E', 'E.id_equipo = C.fk_id_equipo', 'INNER');
		if (array_key_exists("id_correctivo", $arrData)) {
			$this->db->where('C.id_correctivo', $arrData["id_correctivo"]);
		}
		if (array_key_exists("estado", $arrData)) {
			$this->db->where('C.estado', $arrData["estado"]);
		}
		if (array_key_exists("fecha_inicio", $arrData) && $arrData["fecha_inicio"] != '') {
			$this->db->like('C.fecha_inicio', $arrData["fecha_inicio"]); 
		}
		if (array_key_exists("numero_inventario", $arrData) && $arrData["numero_inventario"] != '') {
			$this->db->like('E.numero_inventario', $arrData["numero_inventario"]); 
		}
		$this->db->order_by('id_correctivo', 'desc');
		if (array_key_exists("limit", $arrData)) {
			$query = $this->db->get('mantenimiento_correctivo C', $arrData["limit"]);
		} else {
			$query = $this->db->get('mantenimiento_correctivo C');
		}
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	/**
	 * Consulta lista de mantenimientos preventivos por equipo
	 * @since 20/12/2020
	 */
	public function get_correctivos_infoEquipo($arrData)
	{		
		$this->db->select();
		$this->db->join('equipos E', 'E.id_equipo = C.fk_id_equipo', 'INNER');
		$this->db->order_by('id_correctivo', 'desc');
		$this->db->where('C.fk_id_equipo', $arrData["idEquipo"]);
		$query = $this->db->get('mantenimiento_correctivo C', $arrData["limit"]);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	/**
	 * Guardar mantenimiento correctivo
	 * @since 16/12/2020
	 */
	public function guardarCorrectivo() 
	{
		$data = array(
			'fecha_inicio' => $this->input->post('fecha_inicio'),
			'fk_id_equipo' => $this->input->post('hddId'),
			'descripcion' => $this->input->post('descripcion'),
			'estado' => 1
		);	
		$query = $this->db->insert('mantenimiento_correctivo', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
}