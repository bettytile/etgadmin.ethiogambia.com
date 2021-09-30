<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_customers extends CI_Model {
	public function select_all_customers() {
		$sql = "SELECT * FROM customers";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT customers.customer_id AS id, customers.customer_name AS customer, customers.phone_no AS phone, customers.tin_no AS tin_no FROM customers";
        // $sql = "SELECT * FROM employees";
		$data = $this->db->query($sql);

		return $data->result();
    }
    public function select_by_id($id) {
	$sql = "SELECT customers.customer_id AS id, customers.customer_name AS customer, customers.phone_no AS phone, customers.tin_no AS tin_no FROM customers WHERE customers.customer_id = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	// public function select_by_posisi($id) {
	// 	$sql = "SELECT COUNT(*) AS jml FROM pegawai WHERE id_posisi = {$id}";

	// 	$data = $this->db->query($sql);

	// 	return $data->row();
	// }

	// public function select_by_kota($id) {
	// 	$sql = "SELECT COUNT(*) AS jml FROM pegawai WHERE id_kota = {$id}";

	// 	$data = $this->db->query($sql);

	// 	return $data->row();
	// }

	public function update($data) {
		$sql = "UPDATE customers SET customer_name='" .$data['nama'] ."', phone_no='" .$data['telp'] ."', tin_no='" .$data['tin'] ."' WHERE customer_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM customers WHERE customer_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO customers (customer_name,phone_no,tin_no) VALUES('" .$data['nama'] ."','" .$data['telp'] ."','" .$data['tin'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('customers', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($nama) {
		$this->db->where('customer_name', $nama);
		$data = $this->db->get('customers');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('customers');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */