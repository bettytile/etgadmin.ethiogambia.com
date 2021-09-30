<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stockConfirmation extends CI_Model {
	public function select_all_stock() {
		$sql = "SELECT * FROM stock";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		
		$sql = " SELECT stock.stock_id AS id, stock.id_product AS code, stock.product_type AS p_type,stock.product_name AS p_name,stock.id_station AS station,stock.to_station AS station,station.station_name AS station, stock.available_product AS available_product, stock.reference_no AS reference_no, stock.received_qty AS received_qty, stock.issued_qty AS issued_qty, stock.s_status AS s_status, stock.activity_date AS activity_date, product.product_code AS code FROM stock, product, station WHERE stock.id_product =product.prod_id AND stock.id_station = station.s_id";
		$data = $this->db->query($sql);
		return $data->result();
		
		
		 
	}

	public function select_by_id($id) {
	$sql = " SELECT stock.stock_id AS id, stock.id_product AS id_product, stock.product_type AS p_type,stock.product_name AS p_name,stock.id_station AS id_station,stock.to_station AS to_station,station.station_name AS station, stock.available_product AS available_product, stock.reference_no AS reference_no, stock.received_qty AS received_qty, stock.issued_qty AS issued_qty, stock.s_status AS s_status, stock.activity_date AS activity_date, product.product_code AS code FROM stock, product, station WHERE stock.id_product =product.prod_id AND stock.id_station = station.s_id  AND stock.stock_id = '{$id}'";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
	public function select_by_sid($id) {
		$sql = " SELECT stock_copy.sc_id AS id, stock_copy.id_products AS id_products, stock_copy.id_station AS id_station,station.station_name AS station, stock_copy.available_qty AS available_qty, product.product_code AS code FROM stock_copy, product, station WHERE stock_copy.id_products =product.prod_id AND stock_copy.id_station = station.s_id  AND stock_copy.sc_id = '{$id}'";
			// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";
	
			$data = $this->db->query($sql);
	
			return $data->row();
		}
		public function select_by_stock_copy($station) {
			$sql = " SELECT stock_copy.sc_id AS id, stock_copy.id_products AS code, stock_copy.id_station AS station,station.station_name AS station, stock_copy.available_qty AS available_qty, product.product_code AS code FROM stock_copy, product, station WHERE stock_copy.id_products =product.prod_id AND stock_copy.id_station = station.s_id AND stock_copy.id_station = '{$station}'";
				// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";
		
				$data = $this->db->query($sql);
		
				return $data->row();
			}
	public function select_all_rawmaterial($data) {
		$station = $data['station'];
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");

		$sql = "SELECT * FROM stock WHERE stock.id_station = '".$station."' ";

		$data = $this->db->query($sql);

		return $data->result();
		
		// $sql = " SELECT stock.stock_id AS id, stock.id_product AS code, stock.product_type AS p_type,stock.product_name AS p_name,stock.station AS station,station.station_name AS station, stock.available_product AS available_product, stock.reference_no AS reference_no, stock.received_qty AS received_qty, stock.issued_qty AS issued_qty, stock.s_status AS s_status, stock.activity_date AS activity_date, product.product_code AS code FROM stock, product, station WHERE stock.id_product =product.prod_id AND stock.station = station.s_id";
		// $data = $this->db->query($sql);
		//return $data->result();
	}

	public function update($data) {
		
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
		$id_products = $data['id_product'];
		$station = $data['station'];	
		$select = "SELECT * FROM stock_copy WHERE stock_copy.id_products ='" .$id_products ."' AND stock_copy.id_station='".$station."'";
        $run = mysqli_query($con,$select);
        $row= mysqli_fetch_array($run);
            
        $activity_date = $data['activity_date'];
        
        $previous_qty = $row['available_qty'];
            
        $received_qty = $data['received_qty'];
            
		$total = $previous_qty + $received_qty;
			if ($row > 0) {
				$sql = "UPDATE stock_copy SET available_qty= '$total' WHERE stock_copy.id_products ='" .$id_products."' AND stock_copy.id_station='".$station."' ";

				$this->db->query($sql);
			}else {
				$sql = "INSERT INTO stock_copy (id_products,available_qty,id_station) VALUES
                ('$id_products','$received_qty','$station')";
				$this->db->query($sql);
			}
			return $this->db->affected_rows();
	}
	public function updateIssue($data) {
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
		$p_code_n_id = $data['p_code_n_id'];
		$resultexpl = explode('|', $p_code_n_id);
		$products = $resultexpl[1];
		$station = $data['station'];
		$select = "SELECT * FROM stock_copy WHERE stock_copy.id_products ='" .$products."' AND id_station='".$station."'";
        $run = mysqli_query($con,$select);
        $row= mysqli_fetch_array($run);
            
        $activity_date = $data['activity_date'];
            
        $previous_qty = $data['available_product'];
            
        $issued_qty = $data['issued_qty'];
				
		$dtotal = $previous_qty - $issued_qty;
			if ($row > 0) {
				$sql = "UPDATE stock_copy SET available_qty= '$dtotal' WHERE stock_copy.id_products ='" .$products."' AND stock_copy.id_station='".$station."'";

				$this->db->query($sql);
			}
		
			return $this->db->affected_rows();
	}

	public function delete($id) {
		 $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
    $query ="SELECT * FROM pending WHERE pending.stock_id='".$id."'";
    
    
    $run  = mysqli_query($con,$query);
    
    $row= mysqli_fetch_array($run);
    if($row > 0){
        if($row['confirmation_status']==1){
            $selStock= "SELECT * FROM stock WHERE stock.reference_no='".$row['reference_no']."'";
            $runStock=mysqli_query($con, $selStock);
            $rowStock=mysqli_fetch_array($runStock);
            if($rowStock>0){
                $querys = "SELECT * FROM stock WHERE stock.id_product='".$rowStock['id_product']."' AND stock.id_station ='".$rowStock['id_station']."' ORDER BY stock.stock_id DESC LIMIT 1";
                    $runquery=mysqli_query($con,$querys);
                    $rowquery=mysqli_fetch_array($runquery);
                    $availableqty=($rowStock['available_product'] - $rowStock['received_qty']);
                    if($rowquery>0){
                         $updates = "UPDATE stock SET available_product='".$availableqty."' WHERE stock.stock_id = '".$rowquery['stock_id']."' ";
                          $sele = "SELECT * FROM stock_copy WHERE stock_copy.id_products = '".$rowStock['id_product']."' AND stock_copy.id_station='".$rowStock['id_station']."'";
                $runsele = mysqli_query($con,$sele);
                $rowsele = mysqli_fetch_array($runsele);
                $this->db->query($updates);
                if($rowsele> 0){
                    
                    $updatesc= "UPDATE stock_copy SET available_qty='".$availableqty."' WHERE stock_copy.id_products = '".$rowStock['id_product']."' AND stock_copy.id_station='".$rowStock['id_station']."'";
                    $this->db->query($updatesc);
                }
                $deletes="DELETE FROM stock WHERE stock.reference_no = '".$row['reference_no']."'";
                $this->db->query($deletes);
                    }
                    
            }
            else{
                $sel = "SELECT * FROM stock_semifinished WHERE stock_semifinished.reference_no = '".$row['reference_no']."'";
                $runsel = mysqli_query($con,$sel);
                $rowsel = mysqli_fetch_array($runsel);
                if($rowsel>0){ 
                    $querys = "SELECT * FROM stock_semifinished WHERE stock_semifinished.raw_material_type='".$rowsel['raw_material_type']."' AND stock_semifinished.store_location ='".$rowsel['store_location']."' ORDER BY stock_semifinished.rstock_id DESC LIMIT 1";
                    $runquery=mysqli_query($con,$querys);
                    $rowquery=mysqli_fetch_array($runquery);
                    $availableqty=($rowsel['available_qtys'] - $rowsel['received_qty']);
                   
                    if($rowquery>0){
                    $updatesm = "UPDATE stock_semifinished SET available_qtys='".$availableqty."' WHERE stock_semifinished.rstock_id = '".$rowquery['rstock_id']."' ";
                    $sele = "SELECT * FROM stock_semifinished_copy WHERE stock_semifinished_copy.id_product = '".$rowsel['raw_material_type']."' AND stock_semifinished_copy.id_station='".$rowsel['store_location']."'";
                $runsele = mysqli_query($con,$sele);
                $rowsele = mysqli_fetch_array($runsele);
                $this->db->query($updatesm);
                if($rowsele> 0){
                    $available_qty = ($rowsele['available_qty'] - $rowsel['received_qty']) ;
                    $updatesmc= "UPDATE stock_semifinished_copy SET available_qty='".$available_qty."' WHERE stock_semifinished_copy.id_product = '".$rowsel['raw_material_type']."' AND stock_semifinished_copy.id_station='".$rowsel['store_location']."'";
                    $this->db->query($updatesmc);
                }
                $deletes="DELETE FROM stock_semifinished WHERE stock_semifinished.reference_no = '".$row['reference_no']."'";
                $this->db->query($deletes);
                }
                
                }
                }
            
        }
        
        $select = "SELECT * FROM production WHERE production.reference_no = '".$row['reference_no']."'";
        $runselect = mysqli_query($con,$select);
        $rowselect = mysqli_fetch_array($runselect);
        if($rowselect > 0){
            
            if($rowselect['id_production_type']=='1'){
                $sel = "SELECT * FROM stock_semifinished WHERE stock_semifinished.reference_no = '".$rowselect['reference_no']."'";
                $runsel = mysqli_query($con,$sel);
                $rowsel = mysqli_fetch_array($runsel);
                if($rowsel>0){ 
                    $querys = "SELECT * FROM stock_semifinished WHERE stock_semifinished.raw_material_type='".$rowsel['raw_material_type']."' AND stock_semifinished.store_location ='".$rowsel['store_location']."' ORDER BY stock_semifinished.rstock_id DESC LIMIT 1";
                    $runquery=mysqli_query($con,$querys);
                    $rowquery=mysqli_fetch_array($runquery);
                    $availableqty=($rowsel['available_qtys'] + $rowselect['received_weight']) - $rowselect['left_weight'];
                    $issued_qty=$rowsel['issued_qty'] - $rowselect['received_weight'];
                    if($rowquery>0){
                    $updatesm = "UPDATE stock_semifinished SET available_qtys='".$availableqty."', issued_qty='".$issued_qty."' WHERE stock_semifinished.rstock_id = '".$rowquery['rstock_id']."' ";
                    $sele = "SELECT * FROM stock_semifinished_copy WHERE stock_semifinished_copy.id_product = '".$rowsel['raw_material_type']."' AND stock_semifinished_copy.id_station='".$rowsel['store_location']."'";
                $runsele = mysqli_query($con,$sele);
                $rowsele = mysqli_fetch_array($runsele);
                $this->db->query($updatesm);
                if($rowsele> 0){
                    $available_qty = ($rowsele['available_qty'] + $rowselect['received_weight']) - $rowselect['left_weight'];
                    $updatesmc= "UPDATE stock_semifinished_copy SET available_qty='".$available_qty."' WHERE stock_semifinished_copy.id_product = '".$rowsel['raw_material_type']."' AND stock_semifinished_copy.id_station='".$rowsel['store_location']."'";
                    $this->db->query($updatesmc);
                }
                }
                }
                
            }else{
                $sel = "SELECT * FROM stock_rawmaterial WHERE stock_rawmaterial.reference_no = '".$rowselect['reference_no']."'";
                $runsel = mysqli_query($con,$sel);
                $rowsel = mysqli_fetch_array($runsel);
                if($rowsel>0){
                    $querys = "SELECT * FROM stock_rawmaterial WHERE stock_rawmaterial.raw_material_type='".$rowsel['raw_material_type']."' AND stock_rawmaterial.store_location ='".$rowsel['store_location']."' ORDER BY stock_rawmaterial.rstock_id DESC LIMIT 1";
                    $runquery=mysqli_query($con,$querys);
                    $rowquery=mysqli_fetch_array($runquery);
                    $availableqty=($rowsel['available_qtys'] + $rowselect['received_weight']) - $rowselect['left_weight'];
                    $issued_qty=$rowsel['issued_qty'] - $rowselect['received_weight'];
                    if($rowquery>0){
                    $updatesm = "UPDATE stock_rawmaterial SET available_qtys='".$availableqty."', issued_qty='".$issued_qty."' WHERE stock_rawmaterial.rstock_id = '".$rowquery['rstock_id']."'";
                    $sele = "SELECT * FROM stock_rawmaterial_copy WHERE stock_rawmaterial_copy.id_product = '".$rowsel['raw_material_type']."' AND stock_rawmaterial_copy.id_station='".$rowsel['store_location']."'";
                $runsele = mysqli_query($con,$sele);
                $rowsele = mysqli_fetch_array($runsele);
                $this->db->query($updatesm);
                if($rowsele> 0){
                    $available_qty = ($rowsele['available_qty'] + $rowselect['received_weight']) - $rowselect['left_weight'];
                    $updatesmc= "UPDATE stock_rawmaterial_copy SET available_qty='".$available_qty."' WHERE stock_rawmaterial_copy.id_product = '".$rowsel['raw_material_type']."' AND stock_rawmaterial_copy.id_station='".$rowsel['store_location']."'";
                    $this->db->query($updatesmc);
                }
                }
                }
            }
            $deletesm="DELETE FROM stock_semifinished WHERE stock_semifinished.reference_no = '".$row['reference_no']."'";
            $deletesr="DELETE FROM stock_rawmaterial WHERE stock_rawmaterial.reference_no = '".$row['reference_no']."'";
            $querydel="DELETE FROM production WHERE production.reference_no = '".$row['reference_no']."'";
            $sql ="DELETE FROM pending WHERE pending.stock_id = '".$id."'";
            $this->db->query($deletesr);
            $this->db->query($deletesm);
            $this->db->query($querydel);
            $this->db->query($sql);
            
        }
        
    }
    $this->db->query($querydel);

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

public function directUpdate($id) {
    
    $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
    $query ="SELECT * FROM pending WHERE pending.stock_id='".$id."'";
    
    
    $run  = mysqli_query($con,$query);
    
    $row= mysqli_fetch_array($run);
    
    $sel = "SELECT * FROM product";
    $runsel = mysqli_query($con,$sel);
    $rowsel=mysqli_fetch_array($runsel);
    if($row>0){
        $myselect = "SELECT * FROM preform WHERE preform.pre_id='".$row['id_product']."'";
    $runselect = mysqli_query($con,$myselect);
    $rowsele = mysqli_fetch_array($runselect);
        $a= $row['product_code'];
        $b= $rowsele['preform_code'];
    if($a==$b){
		    $sqlU = "UPDATE pending SET confirmation_status = '1' WHERE stock_id='" .$id ."'";
		    $sqlI="INSERT INTO stock_semifinished (raw_material_type,product_code,available_qtys,received_qty,store_location,reference_no,activity_date,rstatus,confirmation_status) VALUES('".$row['id_product']."','".$row['product_code']."','".$row['available_product']."','" .$row['received_qty']."','".$row['id_station']."','" .$row['reference_no'] ."', '" .$row['activity_date']."','recieved','1')";

		$selects = "SELECT * FROM stock_semifinished_copy WHERE stock_semifinished_copy.id_product ='" .$row['id_product'] ."' AND stock_semifinished_copy.id_station='" .$row['id_station'] ."'";
		$runss = mysqli_query($con,$selects);
		$rowss= mysqli_fetch_array($runss);
		$previous_qty = $rowss['available_qty'];
		$received_qty = $row['received_qty'];
		$total = $previous_qty + $received_qty;
			$this->db->query($sqlU);
		$this->db->query($sqlI);
			if ($rowss > 0) {
		$sql = "UPDATE stock_semifinished_copy SET available_qty= '$total' WHERE stock_semifinished_copy.id_product ='" .$row['id_product']."' AND stock_semifinished_copy.product_code ='" .$row['product_code']."' AND stock_semifinished_copy.id_station='".$row['id_station']."' ";
	 
	
	$this->db->query($sql);
	}else {
		$sqlIn = "INSERT INTO stock_semifinished_copy (id_product,product_code,available_qty,id_station) VALUES ('".$row['id_product']."','".$row['product_code']."','$received_qty','".$row['id_station']."')";
		$this->db->query($sqlIn);
		
	}

	
	
}
else{

    $received_qty = $row['received_qty'];
    $sqlU = "UPDATE pending SET confirmation_status = '1' WHERE stock_id='" .$id ."'";
		$sqlI="INSERT INTO stock (id_product,product_code,available_product,received_qty,id_station,reference_no,activity_date,s_status,confirmation_status) VALUES('" .$row['id_product']."', '" .$row['product_code']."','".$row['available_product']."','" .$received_qty."','" .$row['id_station']."','" .$row['reference_no'] ."', '" .$row['activity_date']."', 'recieved','1')";
		$selectn = "SELECT * FROM stock_copy WHERE stock_copy.id_products ='" .$row['id_product'] ."' AND stock_copy.id_station='".$row['id_station']."'";
		$runss = mysqli_query($con,$selectn);
		$rowss= mysqli_fetch_array($runss);
		$previous_qty = $rowss['available_qty'];
		$received_qty = $row['received_qty'];
		$total = $previous_qty + $received_qty;
		
			if ($rowss > 0) {
		$sql = "UPDATE stock_copy SET available_qty= '$total' WHERE stock_copy.id_products ='" .$row['id_product']."' AND stock_copy.product_code ='" .$row['product_code']."' AND stock_copy.id_station='".$row['id_station']."' ";
	 
	
	$this->db->query($sql);
	}else {
		$sqlIn = "INSERT INTO stock_copy (id_products,product_code,available_qty,id_station) VALUES ('".$row['id_product']."', '" .$row['product_code']."','$received_qty','".$row['id_station']."')";
		$this->db->query($sqlIn);
		
	}

		$this->db->query($sqlU);
		$this->db->query($sqlI);
}
}		return $this->db->affected_rows();
	}
	public function insert($data) {
        // $id = md5(DATE('ymdhms').rand());
        $product_status = $data['rstatus'];
        $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
        if ($product_status == "received") {
            $id_products = $data['id_product'];
			$station = $data['station'];
            $select = "SELECT * FROM stock WHERE stock.id_product ='" .$id_products ."' AND stock.id_station='".$station."' ORDER BY stock_id DESC LIMIT 1";
            $run = mysqli_query($con,$select);
            $row= mysqli_fetch_array($run);
            
            $activity_date = $data['activity_date'];
            
            $previous_qty = $row['available_product'];
            
            $received_qty = $data['received_qty'];
            
            $total = $previous_qty + $received_qty;
            if ($row > 0) {
    
                $sql = "INSERT INTO stock (id_product,available_product,received_qty,id_station,reference_no,activity_date,s_status) VALUES
                ('$id_products','$total','" .$data['received_qty'] ."','$station','" .$data['reference_no'] ."','$activity_date','$product_status')";
    
                $this->db->query($sql);
            }
            else {
    
                $sql = "INSERT INTO stock (id_product,available_product,received_qty,id_station,reference_no,activity_date,s_status) VALUES
                ('$id_products','$total','" .$data['received_qty'] ."','$station','" .$data['reference_no'] ."','$activity_date','$product_status')";
    
                $this->db->query($sql);
            }
        }
       
		return $this->db->affected_rows();
	}
	public function insertIssued($data) {
		// $id = md5(DATE('ymdhms').rand());
		
        $product_status = $data['rstatus'];
        $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
        if ($product_status == "issued") {
			$p_code_n_id = $data['p_code_n_id'];
			$resultexp = explode('|',$p_code_n_id);
			$product = $resultexp[1];
		$select = "SELECT * FROM stock WHERE stock.id_product='" .$product ."' ORDER BY stock_id DESC LIMIT 1";
		$run = mysqli_query($con,$select);
		$row= mysqli_fetch_array($run);
		
		//$activity_date = DATE('ymdhms');
		
		$previous_qty = $row['available_product'];
		
		$issued_qty = $data['issued_qty'];
		
		//$received_qty= $row['received_qty'];
		$dtotal = $previous_qty - $issued_qty;
		
			$sql = "INSERT INTO stock (id_product,available_product,issued_qty,id_station,reference_no,activity_date,s_status,to_station) VALUES
			('$product','$dtotal','" .$data['issued_qty'] ."','" .$data['station'] ."','" .$data['reference_no'] ."','".$data['activity_date']."','$product_status','".$data['tostation']."')";

			

			$sqld = "INSERT INTO delivery (id_customer,reference_no,id_product,id_station,activity_date,qty,to_station) 
			VALUES('" .$data['customer']."','" .$data['reference_no']."','$product','" .$data['station'] ."','".$data['activity_date']."','$issued_qty','".$data['tostation']."')";
			
			$this->db->query($sql);
			
			$this->db->query($sqld);
		
		
	}
	return $this->db->affected_rows();
}

	public function insert_batch($data) {
		$this->db->insert_batch('stock', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($code) {
		$this->db->where('stock_code', $code);
		$data = $this->db->get('stock');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('stock');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */