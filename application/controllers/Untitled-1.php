<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_employees');
		$this->load->model('M_station');
		$this->load->model('M_position');
	}

	public function index() {
		$data['jml_pegawai'] 	= $this->M_employees->total_rows();
		$data['jml_posisi'] 	= $this->M_station->total_rows();
		$data['jml_kota'] 		= $this->M_position->total_rows();
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$posisi 				= $this->M_position->select_all_positions();
		$index = 0;
		foreach ($posisi as $value) {
		    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

			$pegawai_by_posisi = $this->M_employees->select_by_position($value->id);

			$data_posisi[$index]['value'] = $pegawai_by_posisi->jml;
			$data_posisi[$index]['color'] = $color;
			$data_posisi[$index]['highlight'] = $color;
			$data_posisi[$index]['label'] = $value->employee_name;
			
			$index++;
		}

		$kota 				= $this->M_station->select_all();
		$index = 0;
		foreach ($kota as $value) {
		    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

			$pegawai_by_kota = $this->M_employees->select_by_station($value->id);

			$data_kota[$index]['value'] = $pegawai_by_kota->jml;
			$data_kota[$index]['color'] = $color;
			$data_kota[$index]['highlight'] = $color;
			$data_kota[$index]['label'] = $value->employee_name;
			
			$index++;
		}

		$data['data_posisi'] = json_encode($data_posisi);
		$data['data_kota'] = json_encode($data_kota);

		$data['page'] 			= "home";
		$data['judul'] 			= "Ethio-Gambia";
		$data['deskripsi'] 		= "Dashboard";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */