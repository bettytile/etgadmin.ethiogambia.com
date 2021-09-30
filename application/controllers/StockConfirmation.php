<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockConfirmation extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('M_stockConfirmation');
        $this->load->model('M_productionType');
        $this->load->model('M_product');
        $this->load->model('M_machine');
        $this->load->model('M_station');
		$this->load->model('M_employees');
		// $this->load->model('M_kota');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
        $data['dataStock'] = $this->M_stockConfirmation->select_all();        
		$data['dataProductionType'] = $this->M_productionType->select_all_ProductionType();
        $data['dataProduct'] = $this->M_product->select_all_product();
		$data['dataMachine'] = $this->M_machine->select_all_machine();
        $data['dataStation'] = $this->M_station->select_all_stations();
		$data['dataEmployees'] = $this->M_employees->select_all_employees();

		// $data['dataPosisi'] = $this->M_posisi->select_all();
		// $data['dataKota'] = $this->M_kota->select_all();

		$data['page'] = "stockconfirmation";
		$data['judul'] = "StockConfirmation";
		$data['deskripsi'] = "Manage StockConfirmation";

		$data['modal_add_customer'] = show_my_modal('modals/modal_add_customer', 'add-customer', $data);

		$this->template->views('stockconfirmation/home', $data);
    }
	public function showData() {
		$data['dataStock'] = $this->M_stockConfirmation->select_all();
		$this->load->view('stockconfirmation/list_data', $data);
	}
//    public function addProduction() {
// 	$id = trim($_POST['id']);
// 		if ($id != 0) {
// 			$result = $this->M_stockConfirmation->update($data);

// 			if ($result > 0) {
// 				$out['status'] = '';
// 				$out['msg'] = show_succ_msg('Successfully Added Production', '20px');
// 			} else {
// 				$out['status'] = '';
// 				$out['msg'] = show_err_msg('Error Adding Production', '20px');
// 			}
// 		} else {
// 			$out['status'] = 'form';
// 			$out['msg'] = show_err_msg(validation_errors());
// 		}

// 		echo json_encode($out);
// 	}

	// public function validateData() {
	// 	$this->form_validation->set_rules('nama', 'Name', 'trim|required');
	// 	$this->form_validation->set_rules('telp', 'Phone No', 'trim|required');
	// 	$this->form_validation->set_rules('tin', 'Tin No', 'trim|required');
	// 	// $this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

	// 	$data = $this->input->post();
	// 	if ($this->form_validation->run() == TRUE) {
	// 		$result = $this->M_customers->insert($data);

	// 		if ($result > 0) {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_succ_msg('Success!', '20px');
	// 		} else {
	// 			$out['status'] = '';
	// 			$out['msg'] = show_err_msg('ooops!', '20px');
	// 		}
	// 	} else {
	// 		$out['status'] = 'form';
	// 		$out['msg'] = show_err_msg(validation_errors());
	// 	}

	// 	echo json_encode($out);
    // }
    

	public function update() {
		$id = trim($_POST['id']);

        $data['dataStock'] = $this->M_stockConfirmation->select_by_id($id);
		$data['dataProductionType'] = $this->M_productionType->select_all_ProductionType();
        $data['dataProduct'] = $this->M_product->select_all_product();
		$data['dataMachine'] = $this->M_machine->select_all_machine();
        $data['dataStation'] = $this->M_station->select_all_stations();
		$data['dataEmployees'] = $this->M_employees->select_all_employees();
		// $data['dataPosisi'] = $this->M_posisi->select_all();
		// $data['dataKota'] = $this->M_kota->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_stockproduct.php', 'update-stockproduction', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('reference_no', 'Reference NO', 'trim|required');
        		

		// $this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_stockConfirmation->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('StockConfirmation Successfull!', '20px');
				}
			 else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Failed To Update!', '20px');
			}
		
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_stockConfirmation->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Deleted Successfully!', '20px');
		} else {
			echo show_err_msg('Failed To Delete!', '20px');
		}
	}
	public function confirm() {
		$id = $_POST['id'];
		$result = $this->M_stockConfirmation->directUpdate($id);
		if ($result > 0) {		
			
				echo show_succ_msg('Confirm Successfully!', '20px');
			
		} else {
			echo show_err_msg('Failed To Confirm!', '20px');
		}
	}
	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_stockConfirmation->select_all_inproduction();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Employee Name");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Product Code");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Preform Code");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Raw Material Code");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "Machine Code");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Reference NO");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Production Type ");
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "Produced Qty");
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "Damaged Qty");
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "Received Material");
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "Left Material");
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, "used Material");
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, "Damaged Material");
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, "Difference");
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, "Station");
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, "Shift");
		$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, "Activity Date");
		$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, "StockConfirmation Status");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->employee); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$rowCount, $value->code, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->preform, PHPExcel_Cell_DataType::TYPE_STRING); 
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->raw_material, PHPExcel_Cell_DataType::TYPE_STRING); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$rowCount, $value->machine, PHPExcel_Cell_DataType::TYPE_STRING);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$rowCount, $value->reference_no, PHPExcel_Cell_DataType::TYPE_STRING); 
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->production_type); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('H'.$rowCount, $value->qty_produced);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->qty_damaged); 
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->received_weight); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('K'.$rowCount, $value->left_weight);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $value->used_weight); 
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $value->damaged_weight); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('N'.$rowCount, $value->differences);
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $value->station); 
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $value->shift); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('Q'.$rowCount, $value->activity_date, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $value->StockConfirmation_status); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Production Data.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Production Data.xlsx', NULL);
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
						$check = $this->M_stockConfirmation->check_name($value['B'],$value['A'],$value['Q'],$value['H'],$value['I']);

						if ($check != 1) {
							// $resultData[$index]['id'] = $id;
							$resultData[$index]['id_production_type'] = ucwords($value['G']);
							$resultData[$index]['reference_no'] = $value['F'];
							$resultData[$index]['id_employee'] = $value['A'];
							$resultData[$index]['shift'] = $value['P'];
							$resultData[$index]['id_machine'] = $value['E'];
							$resultData[$index]['id_product'] = $value['B'];
							$resultData[$index]['id_preform'] = ucwords($value['C']);
							$resultData[$index]['qty_produced'] = $value['H'];
							$resultData[$index]['qty_damaged'] = $value['I'];
							$resultData[$index]['activity_date'] = $value['Q'];
							$resultData[$index]['StockConfirmation_status'] = $value['R'];
							$resultData[$index]['id_station'] = $value['O'];
							$resultData[$index]['id_raw_material'] = ucwords($value['D']);
							$resultData[$index]['received_weight'] = $value['J'];
							$resultData[$index]['left_weight'] = $value['K'];
							$resultData[$index]['differences'] = $value['N'];
							$resultData[$index]['used_weight'] = $value['L'];
							$resultData[$index]['damaged_weight'] = $value['M'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_stockConfirmation->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('StockConfirmation');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('StockConfirmation');
				}

			}
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */