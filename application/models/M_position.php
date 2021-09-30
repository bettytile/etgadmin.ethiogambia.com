<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_position extends CI_Model{
    public function select_all_positions() {
		$sql = "SELECT * FROM position";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function total_rows() {
		$data = $this->db->get('position');

		return $data->num_rows();
	}
}
?>