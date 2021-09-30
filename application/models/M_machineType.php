<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_machineType extends CI_Model{
    public function select_all_machineType() {
		$sql = "SELECT * FROM machine_type";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all() {
		$sql = " SELECT machine_type.m_id AS id, machine_type.machine_type AS machine_type FROM machine_type";
		   // $sql = "SELECT * FROM machine";
		   $data = $this->db->query($sql);
   
		   return $data->result();
	   }
	public function total_rows() {
		$data = $this->db->get('machine_type');

		return $data->num_rows();
	}
}
?>
