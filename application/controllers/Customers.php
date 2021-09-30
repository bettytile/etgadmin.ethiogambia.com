<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_customers');
		// $this->load->model('M_posisi');
		// $this->load->model('M_kota');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataCustomers'] = $this->M_customers->select_all();
		// $data['dataPosisi'] = $this->M_posisi->select_all();
		// $data['dataKota'] = $this->M_kota->select_all();

		$data['page'] = "customers";
		$data['judul'] = "Customers";
		$data['deskripsi'] = "Manage Customers";

		$data['modal_add_customer'] = show_my_modal('modals/modal_add_customer', 'add-customer', $data);

		$this->template->views('customers/home', $data);
    }
	public function showData() {
		$data['dataCustomers'] = $this->M_customers->select_all();
		$this->load->view('customers/list_data', $data);
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
    

	public function update() {
		$id = trim($_POST['id']);

		$data['dataCustomers'] = $this->M_customers->select_by_id($id);
		// $data['dataPosisi'] = $this->M_posisi->select_all();
		// $data['dataKota'] = $this->M_kota->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_customer', 'update-customer', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('telp', 'Phone NO', 'trim|required');
		$this->form_validation->set_rules('tin', 'Tin NO', 'trim|required');
		// $this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_customers->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Customer Successfuly Updated!', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Failed To Update!', '20px');
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

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_customers->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Name");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Phone NO");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Tin NO");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->customer); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$rowCount, $value->phone, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->tin_no); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Customers Data.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Customers Data.xlsx', NULL);
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
						$check = $this->M_customers->check_name($value['A']);

						if ($check != 1) {
							// $resultData[$index]['id'] = $id;
							$resultData[$index]['customer_name'] = ucwords($value['A']);
							$resultData[$index]['phone_no'] = $value['B'];
							$resultData[$index]['tin_no'] = $value['C'];
							// $resultData[$index]['id_kelamin'] = $value['E'];
							// $resultData[$index]['id_posisi'] = $value['F'];
							// $resultData[$index]['status'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_customers->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('Customers');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Customers');
				}

			}
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */