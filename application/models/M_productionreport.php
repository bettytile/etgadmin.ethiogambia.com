<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_productionreport extends CI_Model {
	public function select_all_production() {
		$sql = "SELECT * FROM production";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
        $p_type = $_POST['p_type'];
        $station = $_POST['station'];
        $p_code = $_POST['code'];
		$sql = " SELECT production.production_id AS id, production.id_production_type AS production_type, production_type.production_type_name AS production_type, 
        production.reference_no AS reference_no, production.id_employee AS employee, employees.employee_name AS employee, 
        production.shift AS shift, production.id_machine AS machine, machine.machine_name AS machine, machine.machine_code AS machine, production.id_product AS id_product, product.product_code AS code, product.product_weight AS p_weight, production.id_preform AS preform,production.qty_produced AS qty_produced,production.qty_damaged AS qty_damaged, 
        production.activity_date AS activity_date,production.confirmation_status AS confirmation_status, 
        production.id_station AS station, station.station_name AS station, production.id_raw_material AS raw_material, 
        production.received_weight AS received_weight,production.left_weight AS left_weight, production.differences AS differences,
        production.overall_weight AS overall_weight, production.used_weight AS used_weight, production.damaged_weight AS damaged_weight,production.edit_status AS edit_status, 
        production.edit_date AS edit_date,production.editor_name AS editor_name FROM product, production, station,
        production_type, employees, machine WHERE  production.id_production_type = $p_type AND production.id_product=$p_code AND production.id_station = $station AND production.id_employee = employees.employee_name";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
	$sql = "SELECT production.production_id AS id, production.id_production_type AS production_type, 
    production_type.production_type_name AS production_type, production.reference_no AS reference_no, 
    production.id_employee AS employee, employees.employee_name AS employee, production.shift AS shift, 
    production.id_machine AS machine, machine.machine_name AS machine, machine.machine_code AS machine, production.id_product AS code, product.product_code AS code, product.product_weight AS p_weight, production.id_preform AS preform, 
    production.qty_produced AS qty_produced,production.qty_damaged AS qty_damaged, 
    production.activity_date AS activity_date,production.confirmation_status AS confirmation_status, 
    production.id_station AS station, station.station_name AS station, production.id_raw_material AS raw_material, 
    production.received_weight AS received_weight,production.left_weight AS left_weight, production.differences AS differences,
    production.overall_weight AS overall_weight, production.used_weight AS used_weight, production.damaged_weight AS damaged_weight, production.edit_status AS edit_status, 
    production.edit_date AS edit_date,production.editor_name AS editor_name FROM product, production, station,
    production_type, employees, machine WHERE  production.id_production_type = production_type.production_type_id 
    AND production.id_product = product.prod_id AND production.id_machine = machine.mach_id  AND production.id_employee = employees.employee_name AND production.id_station = station.s_id AND production.production_id= '{$id}'";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
	
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */