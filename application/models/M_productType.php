<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_productType extends CI_Model{
	public function select_all($id) {
		$sql = "SELECT * FROM product_type  WHERE product_type.p_id = {$id}";
	
			$data = $this->db->query($sql);
	
			return $data->result();
		}
    public function select_all_productType() {
		$sql = "SELECT * FROM product_type";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function total_rows() {
		$data = $this->db->get('product_type');

		return $data->num_rows();
	}
}
?>