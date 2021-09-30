<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_preform extends CI_Model {
	public function select_all_preform() {
		$sql = "SELECT * FROM preform";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT preform.pre_id AS id, preform.preform_code AS code, preform.preform_name AS p_name, preform.preform_weight AS p_weight, preform.id_ptype AS p_type, product_type.product_name AS p_type FROM preform, product_type WHERE preform.id_ptype = product_type.p_id";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all_rawmaterial() {
		$sql = " SELECT * FROM preform WHERE id_ptype= '4' OR preform_code LIKE 'P%'";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_by_id($id) {
	$sql = "SELECT preform.pre_id AS id, preform.preform_code AS code, preform.preform_name AS p_name, preform.preform_weight AS p_weight, preform.id_ptype AS p_type, product_type.product_name AS p_type FROM preform, product_type WHERE preform.id_ptype = product_type.p_id AND preform.pre_id = {$id}";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE preform SET preform_code='" .$data['code'] ."', preform_name='" .$data['p_name'] ."', id_ptype='" .$data['p_type'] ."', preform_weight='" .$data['p_weight'] ."' WHERE pre_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM preform WHERE pre_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO preform (preform_code,preform_name,id_ptype,preform_weight) VALUES('" .$data['p_code'] ."','" .$data['p_name'] ."','" .$data['p_type'] ."','" .$data['p_weight'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('preform', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($code) {
		$this->db->where('preform_code', $code);
		$data = $this->db->get('preform');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('preform');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */