<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_station extends CI_Model{
    public function select_all_stations() {
		$sql = "SELECT * FROM station";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all() {
		$sql = " SELECT station.s_id AS id, station.station_name AS station FROM station";
        // $sql = "SELECT * FROM employees";
		$data = $this->db->query($sql);

		return $data->result();
    }
	public function total_rows() {
		$data = $this->db->get('station');

		return $data->num_rows();
	}
}
?>