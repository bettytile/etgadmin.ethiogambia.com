<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product extends CI_Model {
	public function select_all_product() {
		$sql = "SELECT * FROM product";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT product.prod_id AS id, product.product_code AS code, product.product_name AS p_name, product.product_weight AS p_weight, product.unit_price AS unit_price, product.id_type AS p_type, product_type.product_name AS p_type FROM product, product_type WHERE product.id_type = product_type.p_id";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all_products() {
		$sql = "SELECT product.prod_id AS id, product.product_code AS code, product.product_weight AS p_weight, product.unit_price AS unit_price, product.id_type AS p_type, product_type.product_name AS p_type FROM product, product_type WHERE product.id_type = product_type.p_id AND id_type != '4'";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all_rawmaterial() {
		$sql = " SELECT * FROM product WHERE id_type= '4'";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all_preform() {
		$sql = " SELECT * FROM product WHERE product_code LIKE 'P%'";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_by_id($id) {
	$sql = "SELECT product.prod_id AS id, product.product_code AS code, product.product_name AS p_name, product.product_weight AS p_weight, product.unit_price AS unit_price, product.id_type AS p_type, product_type.product_name AS p_type FROM product, product_type WHERE product.id_type = product_type.p_id AND product.prod_id = {$id}";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE product SET product_code='" .$data['code'] ."', product_name='" .$data['p_name'] ."', id_type='" .$data['p_type'] ."', product_weight='" .$data['p_weight'] ."', unit_price='".$data['unit_price']."' WHERE prod_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM product WHERE prod_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO product (product_code,product_name,id_type,product_weight,unit_price) VALUES('" .$data['p_code'] ."','" .$data['p_name'] ."','" .$data['p_type'] ."','" .$data['p_weight'] ."','" .$data['unit_price'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('product', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($code) {
		$this->db->where('product_code', $code);
		$data = $this->db->get('product');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('product');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */