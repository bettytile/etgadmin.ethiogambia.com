<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rawmaterials extends CI_Model {
	public function select_all_rawmaterial() {
		$sql = "SELECT * FROM raw_material";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT raw_material.rm_id AS id, raw_material.rawmaterial_code AS code, raw_material.rawmaterial_name AS p_name, raw_material.rawmaterial_weight AS p_weight, raw_material.id_ptype AS p_type, product_type.product_name AS p_type FROM raw_material, product_type WHERE raw_material.id_ptype = product_type.p_id";
		$data = $this->db->query($sql);

		return $data->result();
	}
// 	public function select_all_rawmaterial() {
// 		$sql = " SELECT * FROM raw_material WHERE id_ptype= '4' OR raw_material_code LIKE 'P%'";
// 		$data = $this->db->query($sql);

// 		return $data->result();
// 	}
	public function select_by_id($id) {
	$sql = "SELECT raw_material.rm_id AS id, raw_material.rawmaterial_code AS code, raw_material.rawmaterial_name AS p_name, raw_material.rawmaterial_weight AS p_weight, raw_material.id_ptype AS p_type, product_type.product_name AS p_type FROM raw_material, product_type WHERE raw_material.id_ptype = product_type.p_id AND raw_material.rm_id = '{$id}'";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE raw_material SET rawmaterial_code='" .$data['code'] ."', rawmaterial_name='" .$data['p_name'] ."', id_ptype='" .$data['p_type'] ."', rawmaterial_weight='" .$data['p_weight'] ."' WHERE rm_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM raw_material WHERE rm_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO raw_material (rawmaterial_code,rawmaterial_name,id_ptype,rawmaterial_weight) VALUES('" .$data['p_code'] ."','" .$data['p_name'] ."','" .$data['p_type'] ."','" .$data['p_weight'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('raw_material', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($code) {
		$this->db->where('rawmaterial_code', $code);
		$data = $this->db->get('raw_material');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('raw_material');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */