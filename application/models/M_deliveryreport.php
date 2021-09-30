<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_deliveryreport extends CI_Model {
	public function select_all_delivery() {
		$sql = "SELECT * FROM delivery";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT delivery.d_id AS id, delivery.id_product AS code, delivery.employee_id AS employee, delivery.id_customer AS customer, customers.customer_name AS customer, delivery.product_type AS p_type, delivery.qty AS qty, delivery.reference_no AS reference_no, delivery.activity_date AS activity_date, delivery.id_station AS station, station.station_name AS station, production_type.production_type_name AS p_type, product.product_code AS code FROM delivery, product, production_type,customers,employees, station WHERE delivery.id_station= station.s_id AND delivery.product_type = production_type.production_type_id AND delivery.id_customer = customers.customer_id AND delivery.id_product =product.prod_id";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
	$sql = " SELECT delivery.d_id AS id, delivery.id_product AS code, delivery.employee_id AS employee, delivery.id_customer AS customer, customers.customer_name AS customer, delivery.product_type AS p_type, delivery.qty AS qty, delivery.reference_no AS reference_no, delivery.activity_date AS activity_date, delivery.id_station AS station, station.station_name AS station, production_type.production_type_name AS p_type, product.product_code AS code FROM delivery, product, production_type,customers,employees, station WHERE delivery.id_station= station.s_id AND delivery.product_type = production_type.production_type_id AND delivery.id_customer = customers.customer_id AND delivery.id_product =product.prod_id AND delivery.d_id = '{$id}'";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}	

	public function select_by_employee($id) {
		$sql = "SELECT COUNT(*) AS jml FROM delivery WHERE employee_id = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}
	public function total_rows() {
		$data = $this->db->get('delivery');

		return $data->num_rows();
	}

	
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */