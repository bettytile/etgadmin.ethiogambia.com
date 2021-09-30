<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Machine extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_machine');
		$this->load->model('M_machineType');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataMachine'] = $this->M_machine->select_all();
		$data['dataMachineType'] = $this->M_machineType->select_all_machineType();

		$data['page'] = "machine";
		$data['judul'] = "Machine Data";
		$data['deskripsi'] = "Manage Machine Data";

		$data['modal_insert_machine'] = show_my_modal('modals/modal_insert_machine', 'insert-machine', $data);

		$this->template->views('machine/home', $data);
	}

	public function show() {
		$data['dataMachine'] = $this->M_machine->select_all();
		$this->load->view('machine/list_data', $data);
	}

	public function addMachine() {
		$this->form_validation->set_rules('m_code', 'Machine Code', 'trim|required');
		$this->form_validation->set_rules('m_name', 'Machine Name', 'trim|required');
		$this->form_validation->set_rules('m_type', 'Machine Type', 'trim|required');		
		
		

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_machine->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Successfully Added Machine', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Error Adding Machine', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataMachine'] = $this->M_machine->select_by_id($id);
		$data['dataMachineType'] = $this->M_machineType->select_all_machineType();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_machine', 'update-machine', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('m_code', 'Machine Code', 'trim|required');
		$this->form_validation->set_rules('m_name', 'Machine Name', 'trim|required');
		$this->form_validation->set_rules('m_status', 'Machine Name', 'trim|required');
        
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_machine->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Successfully Updated', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Failed to Update Data', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_machine->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Machine Deleted', '20px');
		} else {
			echo show_err_msg('Failed to Delete Machine', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_machine->select_all_machine();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Machine Name");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Machine code");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Machine Status");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "ID Machine");

		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->machine_name); 
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->machine_code); 
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->machine_status); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$rowCount, $value->id_machine, PHPExcel_Cell_DataType::TYPE_STRING);
		   
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Machine Data.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Machine Data.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_machine->check_name($value['B']);

						if ($check != 1) {
							$resultData[$index]['machine_code'] = $value['A'];
							$resultData[$index]['machine_name'] = ucwords($value['B']);
							$resultData[$index]['machine_status'] = $value['C'];
							$resultData[$index]['id_machine'] = $value['D'];
							
							
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_machine->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('Machine');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Machine');
				}

			}
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */