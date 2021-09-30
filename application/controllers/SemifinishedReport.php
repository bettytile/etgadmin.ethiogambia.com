<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SemifinishedReport extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model('M_productionreport');
        $this->load->model('M_semifinished');
        $this->load->model('M_preform');
        $this->load->model('M_machine');
        $this->load->model('M_station');
        $this->load->model('M_employees');
        
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		//$data['dataProduction'] = $this->M_productionreport->select_all_production();
		$data['dataSemifinished'] = $this->M_semifinished->select_all();
        $data['dataPreform'] = $this->M_preform->select_all_preform();
		$data['dataMachine'] = $this->M_machine->select_all_machine();
        $data['dataStation'] = $this->M_station->select_all_stations();
		$data['dataEmployees'] = $this->M_employees->select_all_employees();

		$data['page'] = "semifinishedreport";
		$data['judul'] = "Semi Finished Data";
		$data['deskripsi'] = "Manage v Data";

		$data['modal_production_report'] = show_my_modal('modals/modal_production_report', 'production-report', $data);

		$this->template->views('semifinishedreport/home', $data);
	}

	// public function show() {
	// 	$data['dataProduction'] = $this->M_productionreport->select_all();
	// 	$this->load->view('productionreport/list_data', $data);
	// }

	// public function addProduction() {
	// 	$this->form_validation->set_rules('reference_no', 'Reference NO', 'trim|required');
	// 	$this->form_validation->set_rules('production_type', 'Production Type', 'trim|required');
    //     $this->form_validation->set_rules('id_product', 'Product Code', 'trim|required');
	// 	$this->form_validation->set_rules('id_machine', 'Machine', 'trim|required');
    //     $this->form_validation->set_rules('id_station', 'Station', 'trim|required');
    //     $this->form_validation->set_rules('qty_produced', 'Product QTY', 'trim|required');
    //     $this->form_validation->set_rules('qty_damaged', 'Reference NO', 'trim|required');
	// 	$this->form_validation->set_rules('raw_material', 'Raw Material', 'trim|required');
	// 	$this->form_validation->set_rules('received_weight', 'Received Weight', 'trim|required');			
    //     $this->form_validation->set_rules('left_weight', 'Left Weight', 'trim|required');
    //     $this->form_validation->set_rules('activity_date', 'Date', 'trim|required');
    //     $this->form_validation->set_rules('shift', 'Shift', 'trim|required');		

	// 	$data = $this->input->post();
	// 	if ($this->form_validation->run() == TRUE) {
	// 		$result = $this->M_production->insert($data);

	// 		if ($result > 0) {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_succ_msg('Successfully Added Production', '20px');
	// 		} else {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_err_msg('Error Adding Production', '20px');
	// 		}
	// 	} else {
	// 		$out['status'] = 'form';
	// 		$out['msg'] = show_err_msg(validation_errors());
	// 	}

	// 	echo json_encode($out);
	// }

	// public function update() {
	// 	$id = trim($_POST['id']);

	// 	$data['dataProduction'] = $this->M_production->select_by_id($id);
	// 	$data['dataProductionType'] = $this->M_productionType->select_all_ProductionType();
	// 	$data['userdata'] = $this->userdata;

	// 	echo show_my_modal('modals/modal_update_Production', 'update-Production', $data);
	// }

	// public function prosesUpdate() {
	// 	$this->form_validation->set_rules('code', 'Production Code', 'trim|required');
	// 	$this->form_validation->set_rules('p_weight', 'Weight', 'trim|required');
	// 	$this->form_validation->set_rules('p_type', 'Production Type', 'trim|required');		
		
	// 	$data = $this->input->post();
	// 	if ($this->form_validation->run() == TRUE) {
	// 		$result = $this->M_production->update($data);

	// 		if ($result > 0) {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_succ_msg('Successfully Updated', '20px');
	// 		} else {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_succ_msg('Failed to Update Data', '20px');
	// 		}
	// 	} else {
	// 		$out['status'] = 'form';
	// 		$out['msg'] = show_err_msg(validation_errors());
	// 	}

	// 	echo json_encode($out);
	// }

	// public function delete() {
	// 	$id = $_POST['id'];
	// 	$result = $this->M_production->delete($id);

	// 	if ($result > 0) {
	// 		echo show_succ_msg('Production Deleted', '20px');
	// 	} else {
	// 		echo show_err_msg('Failed to Delete Production', '20px');
	// 	}
	// }

	// public function export() {
	// 	error_reporting(E_ALL);
    
	// 	include_once './assets/phpexcel/Classes/PHPExcel.php';
	// 	$objPHPExcel = new PHPExcel();

	// 	$data = $this->M_production->select_all();

	// 	$objPHPExcel = new PHPExcel(); 
	// 	$objPHPExcel->setActiveSheetIndex(0); 
	// 	$rowCount = 1; 

	// 	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Production Code");
	// 	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Production Weight");
	// 	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Production Type");
		
	// 	$rowCount++;

	// 	foreach($data as $value){
	// 	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->code); 
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->p_weight); 
	// 	    $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$rowCount, $value->p_type, PHPExcel_Cell_DataType::TYPE_STRING);
		     
	// 	    $rowCount++; 
	// 	} 

	// 	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	// 	$objWriter->save('./assets/excel/Production Data.xlsx'); 

	// 	$this->load->helper('download');
	// 	force_download('./assets/excel/Production Data.xlsx', NULL);
	// }

	// public function import() {
	// 	$this->form_validation->set_rules('excel', 'File', 'trim|required');

	// 	if ($_FILES['excel']['name'] == '') {
	// 		$this->session->set_flashdata('msg', 'File harus diisi');
	// 	} else {
	// 		$config['upload_path'] = './assets/excel/';
	// 		$config['allowed_types'] = 'xls|xlsx';
			
	// 		$this->load->library('upload', $config);
			
	// 		if ( ! $this->upload->do_upload('excel')){
	// 			$error = array('error' => $this->upload->display_errors());
	// 		}
	// 		else{
	// 			$data = $this->upload->data();
				
	// 			error_reporting(E_ALL);
	// 			date_default_timezone_set('Asia/Jakarta');

	// 			include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

	// 			$inputFileName = './assets/excel/' .$data['file_name'];
	// 			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	// 			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

	// 			$index = 0;
	// 			foreach ($sheetData as $key => $value) {
	// 				if ($key != 1) {
	// 					$id = md5(DATE('ymdhms').rand());
	// 					$check = $this->M_production->check_name($value['B']);

	// 					if ($check != 1) {
	// 						$resultData[$index]['Production_code'] = $code;
	// 						$resultData[$index]['Production_weight'] = ucwords($value['B']);
	// 						$resultData[$index]['id_type'] = $value['C'];
							
							
	// 					}
	// 				}
	// 				$index++;
	// 			}

	// 			unlink('./assets/excel/' .$data['file_name']);

	// 			if (count($resultData) != 0) {
	// 				$result = $this->M_production->insert_batch($resultData);
	// 				if ($result > 0) {
	// 					$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
	// 					redirect('Production');
	// 				}
	// 			} else {
	// 				$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
	// 				redirect('Production');
	// 			}

	// 		}
	// 	}
	// }
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */