<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_confirmation extends CI_Model {
	public function select_all_production() {
		$sql = "SELECT * FROM production WHERE production.confirmation_status='0'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = "SELECT production_id,product_code, preform_code, rawmaterial_code,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,station_name,activity_date FROM (SELECT production_id,id_product,id_preform,product_code,id_raw_material,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,id_station,activity_date,confirmation_status FROM production WHERE confirmation_status='0') p LEFT JOIN (SELECT prod_id, product_name FROM product) f ON p.id_product = f.prod_id LEFT JOIN (SELECT pre_id, preform_code, preform_name FROM preform) pr ON p.id_preform = pr.pre_id LEFT JOIN (SELECT rm_id,rawmaterial_code, rawmaterial_name FROM raw_material) r ON p.id_raw_material = r.rm_id LEFT JOiN (SELECT s_id,station_name FROM station) s ON p.id_station=s.s_id";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all_inproduction() {
		$sql = "SELECT production_id,product_code, preform_code, rawmaterial_code,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,station_name,activity_date FROM (SELECT production_id,id_product,id_preform,product_code,id_raw_material,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,id_station,activity_date FROM production) p LEFT JOIN (SELECT prod_id, product_name FROM product) f ON p.id_product = f.prod_id LEFT JOIN (SELECT pre_id, preform_code, preform_name FROM preform) pr ON p.id_preform = pr.pre_id LEFT JOIN (SELECT rm_id,rawmaterial_code, rawmaterial_name FROM raw_material) r ON p.id_raw_material = r.rm_id LEFT JOiN (SELECT s_id,station_name FROM station) s ON p.id_station=s.s_id";
		$data = $this->db->query($sql);

		return $data->result();
	}

		public function select_by_id($id) {
	$sql = "SELECT id,id_employee,product_code,id_product,id_preform,id_production_type,id_machine, preform_code, machine_code,production_type_name, rawmaterial_code,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,station_name,id_station,activity_date,id_raw_material FROM (SELECT production_id AS id,id_employee ,id_product,id_preform,id_raw_material,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,id_station,activity_date,id_production_type,id_machine FROM production) p LEFT JOIN (SELECT prod_id,product_code, product_name FROM product) f ON p.id_product = f.prod_id LEFT JOIN (SELECT pre_id, preform_code, preform_name FROM preform) pr ON p.id_preform = pr.pre_id LEFT JOIN (SELECT rm_id,rawmaterial_code, rawmaterial_name FROM raw_material) r ON p.id_raw_material = r.rm_id LEFT JOiN (SELECT s_id,station_name FROM station) s ON p.id_station=s.s_id LEFT JOIN (SELECT e_id,employee_name FROM employees) e ON p.id_employee = e.employee_name LEFT JOIN(SELECT production_type_id,production_type_name FROM production_type) t ON p.id_production_type = t.production_type_id LEFT JOIN (SELECT mach_id,machine_code FROM machine) m ON p.id_machine = m.mach_id WHERE p.id= {$id}";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
	public function select_all_rawmaterial() {
		$sql = " SELECT product.prod_id AS id, product.product_code AS code, product.product_weight AS p_weight, product.id_type AS p_type, product_type.product_name AS p_type FROM product, product_type WHERE product.id_type = product_type.p_id AND product_type.product_name='Raw Material'";
		$data = $this->db->query($sql);

		return $data->result();
	}

	
	public function update($data) {
				
		$p_code_n_id = $data['id_product'];
		$resultexp = explode('|',$p_code_n_id);
		$id_products = $resultexp[1];
		
		$m_code_n_id = $data['id_machine'];
		$resultexpmchn = explode('|',$m_code_n_id);
		$machine = $resultexpmchn[1];
		
		$pre_code_n_id = $data['id_preform'];
		$resultexppre = explode('|',$pre_code_n_id);
		$preform = $resultexppre[1];
		
		$rm_code_n_id = $data['raw_material'];
		$resultexppre = explode('|',$rm_code_n_id);
		$raw_material = $resultexppre[1];
		
		$p_type_n_id = $data['production_type'];
		
		
		$sql = "UPDATE production SET id_production_type='$p_type_n_id', reference_no='" .$data['reference_no'] ."', id_employee='" .$data['id_employee'] ."',
		shift='" .$data['shift'] ."', id_machine='$machine', id_product='$id_products',
		id_preform='$preform', qty_produced='" .$data['qty_produced'] ."', qty_damaged='" .$data['qty_damaged'] ."',
		activity_date='" .$data['activity_date'] ."', id_station='" .$data['id_station'] ."', 
		received_weight='" .$data['received_weight'] ."', left_weight='" .$data['left_weight'] ."', id_raw_material = '$raw_material', confirmation_status='1' WHERE production.production_id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function pdelete($id) {
		$sql = "DELETE FROM production WHERE production_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insertStock($data) {
		// $id = md5(DATE('ymdhms').rand());
		$p_code_n_id = $data['id_product'];
		$resultexp = explode('|',$p_code_n_id);
		$id_products = $resultexp[1];
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
		$select = "SELECT * FROM stock WHERE stock.id_product='" .$id_products ."'";
		$run = mysqli_query($con,$select);
  		$row= mysqli_fetch_array($run);
		
		$activity_date = DATE('ymdhms');
		
		$previous_qty = $row['available_product'];
		
		$qty_produced = $data['qty_produced'];
		$received_qty= $row['received_qty'];
		$re_total = $received_qty + $qty_produced;
		$total = $previous_qty + $qty_produced;
		if ($row > 0) {
			$sqlU = "UPDATE stock SET available_product = '$total', received_qty='$re_total', activity_date='$activity_date'  WHERE stock.id_product ='".$id_products."' AND stock.station = '" .$data['id_station'] ."'";

			$this->db->query($sqlU);
		}
		else {
			$sql = "INSERT INTO stock (id_product,product_type,available_product,received_qty,station,activity_date,s_status) VALUES
			('$id_products','" .$data['production_type'] ."','" .$data['qty_produced'] ."','" .$data['qty_produced'] ."','" .$data['id_station'] ."','$activity_date','received')";

			$this->db->query($sql);

		}

        
		return $this->db->affected_rows();
	}
	public function updateStoke($id) {
		//$id = $_POST['id'];
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
		$select = "SELECT * FROM production WHERE production_id ='" .$id ."'";
		$run = mysqli_query($con,$select);
		$row=mysqli_fetch_array($run);
		$sel = "SELECT * FROM stock WHERE stock.reference_no = '".$row['reference_no']."'";
		$runs = mysqli_query($con,$sel);
		$rows=mysqli_fetch_array($runs);
		if($rows > 0){
		    $query = "SELECT * FROM stock_copy WHERE stock_copy.id_product= '".$rows['id_product']."' AND stock_copy.id_station ='".$rows['id_station']."'";
		    $excute_query = mysqli_query($con,$query);
		    $datas = mysqli_fetch_array($excute_query);
		    $previous_qty = $rows['recieved_qty'];
		    $current_qty = $query['available_qty'];
		    $update_qty = $current_qty - $previous_qty;
		    
		    if($datas > 0){
		        $update = "UPDATE stock_copy SET available_qty='".$update_qty."'";
		        $this->db->query($update);
		        $del = "DELETE FROM stock  WHERE stock.reference_no='".$rows['reference_no']."'";
		        $this->db->query($del);
		        
		    }
		    }
		


		return $this->db->affected_rows();
	}
	public function updateStokeRm($id) {
		//$id = $_POST['id'];
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
		$select = "SELECT * FROM production WHERE production_id ='" .$id ."'";
		$sel = "SELECT * FROM stock_rawmaterial WHERE stock_rawmaterial.reference_no = production.reference_no";
		$run = mysqli_query($con,$select);
		$runs = mysqli_query($con,$sel);
		$rows=mysqli_fetch_array($runs);
		$row=mysqli_fetch_array($run);
		if($rows > 0){
		    $query = "SELECT * FROM stock_rawmaterial_copy WHERE stock_rawmaterial_copy.id_product= '".$rows['id_product']."' AND stock_rawmaterial_copy.id_station ='".$rows['id_station']."'";
		    $excute_query = mysqli_query($con,$query);
		    $datas = mysqli_fetch_array($excute_query);
		    $previous_qty = $rows['issued_qty'];
		    $current_qty = $query['available_qty'];
		    $update_qty = $current_qty + $previous_qty;
		    
		    if($datas > 0){
		        $update = "UPDATE stock_rawmaterial_copy SET available_qty='".$update_qty."' WHERE stock_rawmaterial.reference_no='".$rows['reference_no']."'";
		        $this->db->query($update);
		        $del = "DELETE FROM stock_rawmaterial WHERE stock_rawmaterial.reference_no='".$rows['reference_no']."'";
		        $this->db->query($del);
		        
		    }
		    }
		


		return $this->db->affected_rows();
	}
	public function directUpdate($id) {
		$sql = "UPDATE production SET confirmation_status='1' WHERE production.production_id ='".$id."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function insert_batch($data) {
		$this->db->insert_batch('production', $data);
		
		return $this->db->affected_rows();
	}

	public function check_name($code,$name,$activty_date,$produced,$damaged) {
		$this->db->where('id_product', $code);
		$this->db->where('id_employee', $name);
		$this->db->where('activity_date', $activty_date);
		$this->db->where('qty_produced', $produced);
		$this->db->where('qty_damaged', $damaged);
		$data = $this->db->get('production');

		return $data->num_rows();
	}
		public function updateStockcopy($id){
			$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
	    
	    $sqls= "SELECT production_id,reference_no, produced_qty,id_station,id_product FROM production WHERE production.production_id = '".$id."'";
	    $run = mysqli_query($con, $sqls) or die("Error: ".mysqli_error($con));
        $row= mysqli_fetch_array($run);
        if($row > 0){
          $sqlt= "SELECT MAX(stock_id),reference_no, available_product,id_station,id_product FROM stock WHERE stock.id_product = '".$row['id_product']."' AND stock.id_station = '".$row['id_station']."' AND stock.reference_no = '".$row['reference_no']."' AND stock.stock_id < stock_id"; 
          $sqlts= "SELECT MAX(rstock_id),reference_no, available_qtys,store_location,raw_material_type FROM stock_rawmaterial WHERE stock_rawmaterial.raw_material_type = '".$row['id_product']."' AND stock_rawmaterial.store_location = '".$row['id_station']."' AND stock_rawmaterial.reference_no = '".$row['reference_no']."' AND stock_rawmaterial.rstock_id < rstock_id"; 
          $runts = mysqli_query($con, $sqlts) or die("Error: ".mysqli_error($con));
        $rowts= mysqli_fetch_array($runts);
          $runs = mysqli_query($con, $sqlt) or die("Error: ".mysqli_error($con));
        $rows= mysqli_fetch_array($runs);
        if ($rows > 0 && $rowts > 0){
        $query = "UPDATE stock_copy SET available_product = '".$row['available_product']."'WHERE id_products ='" .$row['id_product'] ."' AND id_station='".$row['id_station']."'";
        $querys = "UPDATE stock_rawmaterial_copy SET available_qty = '".$row['available_qty']."'WHERE id_product ='" .$row['id_product'] ."' AND id_station='".$row['id_station']."'";
        $this->db->query($query);
        $this->db->query($querys);
        }
        } else{
            $sql = "DELETE FROM stock_copy  WHERE id_products ='" .$row['id_product'] ."' AND id_station='".$row['id_station']."' ";

		$this->db->query($sql);
		$sqlss = "DELETE FROM stock_rawmaterial_copy  WHERE id_product ='" .$row['id_product'] ."' AND id_station='".$row['id_station']."'";

		$this->db->query($sqlss);
        }
        return $this->db->affected_rows();
	}


	public function total_rows() {
		$data = $this->db->get('production');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */