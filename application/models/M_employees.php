<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_employees extends CI_Model {
	public function select_all_employees() {
		$sql = "SELECT * FROM employees";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT employees.e_id AS id, employees.employee_name AS employee, employees.employee_phone AS phone, employees.employee_tin AS tin, employees.employee_code AS code, employees.id_station AS id_station, employees.id_position AS id_position, position.position_name AS position, station.station_name AS station, position.position_name AS position FROM employees, station, position WHERE employees.id_station = station.s_id AND employees.id_position = position.p_id";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
	$sql = "SELECT employees.e_id AS id, employees.employee_name AS employee, employees.employee_gender AS gender, employees.employee_phone AS phone, employees.employee_tin AS tin, employees.employee_code AS code, employees.id_station AS id_station, employees.id_position AS id_position, position.position_name AS position, station.station_name AS station, position.position_name AS position FROM employees, station, position WHERE employees.id_station = station.s_id AND employees.id_position = position.p_id AND employees.e_id = {$id}";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_position($id) {
		$sql = "SELECT COUNT(*) AS jml FROM employees WHERE employees.id_position = '".$id."'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_station($id) {
		$sql = "SELECT COUNT(*) AS jml FROM employees WHERE employees.id_station = '".$id."'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE employees SET employee_name='" .$data['e_name'] ."', employee_code='" .$data['code'] ."', employee_gender='" .$data['gender'] ."', employee_tin='" .$data['tin'] ."', employee_phone='" .$data['phone'] ."', id_position='" .$data['position'] ."', id_station='" .$data['station'] ."' WHERE e_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM employees WHERE e_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO employees (employee_code,employee_name,employee_gender,employee_phone,employee_tin, id_position,id_station) VALUES('" .$data['code'] ."','" .$data['e_name'] ."','" .$data['gender'] ."','" .$data['phone'] ."','" .$data['tin'] ."','" .$data['position'] ."','" .$data['station'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('employees', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($name) {
		$this->db->where('employee_name', $name);
		$data = $this->db->get('employees');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('employees');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */