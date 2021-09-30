<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAdmin extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_productType');
		$this->load->model('M_position');
        $this->load->model('M_productionType');
        $this->load->model('M_machineType');
        $this->load->model('M_station');
	}

	public function index() {
		$data['dataProductType'] 	= $this->M_productType->select_all_productType();
		$data['dataPosition'] 	= $this->M_position->select_all_positions();
        $data['dataProductionType'] 		= $this->M_productionType->select_all();
        $data['dataMachineType'] 	= $this->M_machineType->select_all();
		$data['dataStation'] 		= $this->M_station->select_all_stations();
		$data['userdata'] 		= $this->userdata;

		$data['page'] 			= "manageadmin";
		$data['judul'] 			= "Ethio-Gambia";
		$data['deskripsi'] 		= "Dashboard";

		$data['modal_add_position'] = show_my_modal('modals/modal_add_position', 'add-position', $data);
		$data['modal_add_station'] = show_my_modal('modals/modal_add_station', 'add-station', $data);
		$data['modal_add_productiontype'] = show_my_modal('modals/modal_add_productiontype', 'add-productionType', $data);
		$data['modal_add_producttype'] = show_my_modal('modals/modal_add_producttype', 'add-productType', $data);
		$data['modal_add_machinetype'] = show_my_modal('modals/modal_add_machinetype', 'add-machineType', $data);

		$this->template->views('manageadmin', $data);
	}
	public function showData() {
		$data['dataPosition'] = $this->M_position->select_all_positions();
		$this->load->view('manageadmin/list_data', $data);
	}

	public function validateData() {
		$this->form_validation->set_rules('nama', 'Name', 'trim|required');
		$this->form_validation->set_rules('telp', 'Phone No', 'trim|required');
		$this->form_validation->set_rules('tin', 'Tin No', 'trim|required');
		// $this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_customers->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Success!', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('ooops!', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
    }
    

	
	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_customers->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Deleted Successfully!', '20px');
		} else {
			echo show_err_msg('Failed To Delete!', '20px');
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */