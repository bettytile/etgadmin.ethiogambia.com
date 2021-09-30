<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_entries extends CI_Model {
	public function select_all_entries() {
		$sql = "SELECT * FROM production_entry";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT employees.e_id AS id, employees.employee_name AS employee, employees.employee_phone AS phone, employees.employee_tin AS tin, employees.employee_code AS code, employees.id_station AS id_station, employees.id_position AS id_position, position.position_name AS position, station.station_name AS station, position.position_name AS position FROM production_entry, station, position WHERE employees.id_station = station.s_id AND employees.id_position = position.p_id";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT employees.e_id AS id_employee, employees.name AS employee, employees.employee_tin AS tin, employees.id_station AS id_station, employees.id_position AS id_position, employees.employee_phone AS phone, station.station_name AS station, position.position_name AS position FROM employees, station, position WHERE employees.id_station = station.s_id AND employees.id_position = position.p_id AND employee.e_id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_position($id) {
		$sql = "SELECT COUNT(*) AS jml FROM production_entry WHERE id_position = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_station($id) {
		$sql = "SELECT COUNT(*) AS jml FROM production_entry WHERE id_station = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE production_entry SET employee_name='" .$data['e_name'] ."', employee_phone='" .$data['phone'] ."', id_position=" .$data['position'] .", id_station=" .$data['station'] ." WHERE e_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM production_entry WHERE e_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO production_entry (employee_code,employee_name,employee_gender,employee_phone,employee_tin, id_position,id_station) VALUES('" .$data['code'] ."','" .$data['e_name'] ."','" .$data['gender'] ."','" .$data['phone'] ."','" .$data['tin'] ."','" .$data['position'] ."','" .$data['station'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('production_entry', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($name) {
		$this->db->where('name', $name);
		$data = $this->db->get('production_entry');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('production_entry');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */