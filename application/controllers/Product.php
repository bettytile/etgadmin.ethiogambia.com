<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_product');
		$this->load->model('M_productType');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataProduct'] = $this->M_product->select_all();
		$data['dataProductType'] = $this->M_productType->select_all_productType();

		$data['page'] = "product";
		$data['judul'] = "Product Data";
		$data['deskripsi'] = "Manage Product Data";

		$data['modal_insert_product'] = show_my_modal('modals/modal_insert_product', 'insert-product', $data);

		$this->template->views('product/home', $data);
	}

	public function show() {
		$data['dataProduct'] = $this->M_product->select_all();
		$this->load->view('product/list_data', $data);
	}

	public function addProduct() {
		$this->form_validation->set_rules('p_code', 'Product Code', 'trim|required');
		$this->form_validation->set_rules('p_weight', 'Weight', 'trim|required');
		$this->form_validation->set_rules('p_type', 'Product Type', 'trim|required');		
		
		

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_product->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Successfully Added Product', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Error Adding Product', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataProduct'] = $this->M_product->select_by_id($id);
		$data['dataProductType'] = $this->M_productType->select_all_productType();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_product', 'update-product', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('code', 'Product Code', 'trim|required');
		$this->form_validation->set_rules('p_weight', 'Weight', 'trim|required');
		$this->form_validation->set_rules('p_type', 'Product Type', 'trim|required');		
		
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_product->update($data);

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
		$result = $this->M_product->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Product Deleted', '20px');
		} else {
			echo show_err_msg('Failed to Delete Product', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_product->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "Product Code");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Product Name");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Product Weight");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Product Type");
		
		$rowCount++;

		foreach($data as $value){
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->code);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->p_name); 
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->p_weight); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$rowCount, $value->p_type, PHPExcel_Cell_DataType::TYPE_STRING);
		     
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Product Data.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Product Data.xlsx', NULL);
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
						$check = $this->M_product->check_name($value['A']);

						if ($check != 1) {
							$resultData[$index]['product_code'] = $value['A'];
							$resultData[$index]['product_name'] =ucwords($value['B']);
							$resultData[$index]['product_weight'] = $value['C'];
							$resultData[$index]['id_type'] = $value['D'];
							
							
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_product->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('Product');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Product');
				}

			}
		}
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */