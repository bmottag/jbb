<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mantenimientos_model extends CI_Model {

	/**
	 * Consulta lista de mantenimientos preventivos
	 * @since 20/12/2020
	 */
	public function get_preventivo($arrData)
	{
		$this->db->select("P.*, T.tipo_equipo, CONCAT(U.first_name, ' ', U.last_name) name");
		$this->db->join('usuarios U', 'P.fk_id_user_preventivo = U.id_user', 'INNER');
		$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = P.fk_id_tipo_equipo_preventivo', 'INNER');
		if (array_key_exists("idPreventivo", $arrData)) {
			$this->db->where('P.id_preventivo', $arrData["idPreventivo"]);
		}
		if (array_key_exists("estado", $arrData)) {
			$this->db->where('P.estado', $arrData["estado"]);
		}
		if (array_key_exists("tipoEquipo", $arrData) && $arrData["tipoEquipo"] != '') {
			$this->db->like('P.fk_id_tipo_equipo_preventivo', $arrData["tipoEquipo"]); 
		}
		$this->db->order_by('P.id_preventivo', 'desc');
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
		$idPreventivo = $this->input->post('hddId');
		$idUser = $this->session->userdata("id");
		$data = array(
			'fk_id_tipo_equipo_preventivo' => $this->input->post('id_tipo_equipo'),
			'frecuencia' => $this->input->post('frecuencia'),
			'descripcion' => $this->input->post('descripcion'),
			'estado' => 1
		);	
		if ($idPreventivo == '') {
			$data['fk_id_user_preventivo'] = $idUser;
			$query = $this->db->insert('mantenimiento_preventivo', $data);
		} else {
			$this->db->where('id_preventivo', $idPreventivo);
			$query = $this->db->update('mantenimiento_preventivo', $data);
		}
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Consulta lista de mantenimientos preventivos por equipo
	 * @since 20/12/2020
	 */
	public function get_correctivo($arrData)
	{
		$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name");
		$this->db->join('usuarios U', 'C.fk_id_user_correctivo = U.id_user', 'INNER');
		if (array_key_exists("idEquipo", $arrData)) {
			$this->db->where('C.fk_id_equipo_correctivo', $arrData["idEquipo"]);
		}
		if (array_key_exists("idCorrectivo", $arrData)) {
			$this->db->where('C.id_correctivo', $arrData["idCorrectivo"]);
		}
		$this->db->order_by('C.id_correctivo', 'desc');
		$query = $this->db->get('mantenimiento_correctivo C');
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
		$idCorrectivo = $this->input->post('hddId');
		$idEquipo = $this->input->post('hddIdEquipo');
		$idUser = $this->session->userdata("id");
		$data = array(
			'fk_id_equipo_correctivo' => $idEquipo,
			'descripcion' => $this->input->post('descripcion'),
			'consideracion' => $this->input->post('consideracion'),
			'estado' => 1
		);
		if ($idCorrectivo == '') {
			$data['fecha'] = date("Y-m-d G:i:s");
			$data['fk_id_user_correctivo'] = $idUser;
			$query = $this->db->insert('mantenimiento_correctivo', $data);
		} else {
			$this->db->where('id_correctivo', $idCorrectivo);
			$query = $this->db->update('mantenimiento_correctivo', $data);
		}
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/**
	* Lista de fotos por daño
	* @since 20/01/2021
	*/
	public function get_fotos_danios($arrData) 
	{
		$this->db->select("F.*, C.fk_id_equipo_correctivo");
		$this->db->join('mantenimiento_correctivo C', 'C.id_correctivo = F.fk_id_correctivo', 'INNER');
		if (array_key_exists("idCorrectivo", $arrData)) {
			$this->db->where('F.fk_id_correctivo', $arrData["idCorrectivo"]);
		}
		if (array_key_exists("idFotoDanio", $arrData)) {
			$this->db->where('F.id_foto_danio', $arrData["idFotoDanio"]);
		}
		$this->db->order_by('F.id_foto_danio', 'asc');
		$query = $this->db->get('mantenimiento_correctivo_fotos F');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	/**
	* Add fotos
	* @since 20/01/2021
	*/
	public function add_fotoDanio($path) 
	{							
		$data = array(
			'fk_id_correctivo' => $this->input->post('hddId'),
			'ruta_foto' => $path,
			'fecha_foto_danio' => date("Y-m-d"),
			'descripcion' => $this->input->post('descripcion')
		);
		$query = $this->db->insert('mantenimiento_correctivo_fotos', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
}