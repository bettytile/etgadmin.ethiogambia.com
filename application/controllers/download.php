<?php
include_once './assets/phpexcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

$data = $this->('#list-data');

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
$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, "Confirmation Status");
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
    $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $value->confirmation_status); 
    $rowCount++; 
} 

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('./assets/excel/Production Data.xlsx'); 

$this->load->helper('download');
force_download('./assets/excel/Production Data.xlsx', NULL);

?>