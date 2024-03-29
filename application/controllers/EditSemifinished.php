<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditSemifinished extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_semifinished');
        $this->load->model('M_productionType');
        $this->load->model('M_preform');
        $this->load->model('M_customers');
        $this->load->model('M_station');
		$this->load->model('M_employees');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataSemiFinished'] = $this->M_semifinished->select_all_instock();
		$data['dataProductionType'] = $this->M_productionType->select_all();
        $data['dataPreform'] = $this->M_preform->select_all_preform();
		$data['dataCustomer'] = $this->M_customers->select_all();
        $data['dataStation'] = $this->M_station->select_all_stations();
		$data['dataEmployees'] = $this->M_employees->select_all_employees();

		$data['page'] = "editsemifinished";
		$data['judul'] = "Semi Finished Data";
		$data['deskripsi'] = "Manage Semi Finished Data";

		$data['modal_production_report'] = show_my_modal('modals/modal_production_report', 'stock-report', $data);

		$this->template->views('editsemifinished/home', $data);
	}

	public function show() {
		$data['dataSemiFinished'] = $this->M_semifinished->select_all_instock();
		$this->load->view('editsemifinished/list-data', $data);
	}

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
	// 		$result = $this->M_semifinished->insert($data);

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

	public function update() {
		$id = trim($_POST['id']);

		$data['dataSemiFinished'] = $this->M_semifinished->select_by_id($id);
        $data['dataProductionType'] = $this->M_productionType->select_all();
        $data['dataPreform'] = $this->M_preform->select_all_preform();
		$data['dataCustomer'] = $this->M_customers->select_all();
        $data['dataStation'] = $this->M_station->select_all_stations();
		$data['dataEmployees'] = $this->M_employees->select_all_employees();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_semifinished', 'update-semifinished', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('id_product', 'Product Code', 'trim|required');
			
		
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_semifinished->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Successfully Updated', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Failed to Update Data', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
	$id = $_POST['id'];
		$result = $this->M_semifinished->updateStockcopy($id);

		if ($result > 0) {
		   $resultU = $this->M_semifinished->smdelete($id);
		    if($resultU > 0){
			echo show_succ_msg('Product Deleted', '20px');
		}} else {
			echo show_err_msg('Failed to Delete Product', '20px');
			echo show_err_msg(error_reporting(E_ALL));
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_semifinished->select_all_instock();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Product Code");
        
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Available Product");
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Received QTY");
        
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Issued QTY");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Station");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Status");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Activity Date");
		
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->code); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$rowCount, $value->available_qty);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->received_qty); 
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->issued_qty); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$rowCount, $value->station, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->s_status); 
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->activity_date); 
		  
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Stock Data.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Stock Data.xlsx', NULL);
	}

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