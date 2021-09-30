<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_machine extends CI_Model {
	public function select_all_machine() {
		$sql = "SELECT * FROM machine";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		// $sql = " SELECT product.prod_id AS id, product.product_code AS code, product.product_weight AS p_weight, product.id_type AS p_type, product_type.product_name AS p_type FROM product, product_type WHERE product.id_type = product_type.p_id";

		$sql = " SELECT machine.mach_id AS id, machine.machine_name AS m_name, machine.machine_code AS m_code, machine.machine_status AS m_status, machine.id_machine AS m_type, machine_type.machine_type AS m_type FROM machine, machine_type WHERE machine.id_machine = machine_type.m_id";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
	$sql = "SELECT machine.mach_id AS id, machine.machine_name AS m_name, machine.machine_code AS m_code, machine.machine_status AS m_status, machine.id_machine AS m_type, machine_type.machine_type AS m_type FROM machine, machine_type WHERE machine.id_machine = machine_type.m_id AND machine.mach_id = '{$id}'";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE machine SET machine_name='" .$data['m_name'] ."', machine_code='" .$data['m_code'] ."', id_machine='" .$data['m_type'] ."',machine_status='" .$data['m_status'] ."' WHERE mach_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM machine WHERE mach_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO machine (machine_code,machine_name,machine_status,id_machine) VALUES('" .$data['m_code'] ."','" .$data['m_name'] ."','1','" .$data['m_type'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('machine', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($name) {
		$this->db->where('machine_name', $name);
		$data = $this->db->get('machine');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('machine');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */