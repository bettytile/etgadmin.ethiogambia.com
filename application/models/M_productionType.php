<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_productionType extends CI_Model{
    public function select_all_productionType() {
	$sql = "SELECT * FROM production_type ";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all() {
		$sql = "SELECT * FROM production_type";
	
			$data = $this->db->query($sql);
	
			return $data->result();
		}
}
?>