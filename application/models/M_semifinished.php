<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_semifinished extends CI_Model {
	public function select_all() {
		$sql = "SELECT * FROM stock_semifinished";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all_instock() {
		$sql = " SELECT stock_semifinished.rstock_id AS id, stock_semifinished.raw_material_type AS code, stock_semifinished.id_employee AS employee,stock_semifinished.received_qty AS received_qty,stock_semifinished.issued_qty AS issued_qty,stock_semifinished.id_station AS station, stock_semifinished.available_qtys AS available_qty, stock_semifinished.reference_no AS reference_no, stock_semifinished.id_station AS station, stock_semifinished.activity_date AS activity_date, stock_semifinished.rstatus AS rstatus,stock_semifinished.input_type AS input_type,stock_semifinished.warehouse AS warehouse,stock_semifinished.store_location AS store_location, preform.preform_code AS code , station.station_name AS station FROM stock_semifinished, preform, station WHERE  stock_semifinished.raw_material_type =preform.pre_id AND stock_semifinished.id_station=station.s_id  AND stock_semifinished.confirmation_status = '0'";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
	$sql = " SELECT stock_semifinished.rstock_id AS id, stock_semifinished.raw_material_type AS raw_material_type, stock_semifinished.id_employee AS employee,stock_semifinished.received_qty AS received_qty,stock_semifinished.issued_qty AS issued_qty,stock_semifinished.id_station AS id_station, stock_semifinished.available_qtys AS available_qty, stock_semifinished.reference_no AS reference_no, stock_semifinished.activity_date AS activity_date, stock_semifinished.rstatus AS rstatus,stock_semifinished.input_type AS input_type,stock_semifinished.warehouse AS warehouse,stock_semifinished.store_location AS store_location, preform.preform_code AS code, station.station_name AS station FROM stock_semifinished, preform, station WHERE  stock_semifinished.raw_material_type =preform.pre_id AND stock_semifinished.id_station=station.s_id AND stock_semifinished.rstock_id = '{$id}'";
		// $sql = "SELECT pegawai.id AS id_pegawai, pegawai.nama AS nama_pegawai, pegawai.id_kota, pegawai.id_kelamin, pegawai.id_posisi, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kota = kota.id AND pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
    
    public function select_all_rawmaterial() {
		$sql = " SELECT stock.prod_id AS id, stock.stock_code AS code, stock.stock_weight AS p_weight, stock.id_type AS p_type, stock_type.stock_name AS p_type FROM stock, stock_type WHERE stock.id_type = stock_type.p_id AND stock_type.stock_name='Raw Material'";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function update($data) {

		$p_code_n_id = $data['id_product'];
		$resultexp = explode('|',$p_code_n_id);
		$id_products = $resultexp[1];
		$sql = "UPDATE stock_semifinished SET available_qtys= '".$data['available_qty']."', received_qty= '".$data['received_qty']."', issued_qty= '".$data['issued_qty']."', rstatus= '".$data['rstatus']."', reference_no= '".$data['reference_no']."', activity_date= '".$data['activity_date']."', id_station= '".$data['station']."', raw_material_type= '$id_products' WHERE rstock_id ='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
    }
    public function inserIssued($data) {
		// $id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO issued (rmaterial_type,employee_name,r_weight,reference_no,activity_date,rstatus,input_type,warehouse,store_location)
		 VALUES('" .$data['rawm_type'] ."','" .$data['employee'] ."','" .$data['ir_weight'] ."','" .$data['reference_no'] ."','" .$data['activity_date'] ."','" .$data['rstatus'] ."','" .$data['typeRadio'] ."','" .$data['warehouse'] ."','" .$data['storelocation'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    
	public function updatestock($data) {
		$sql = "UPDATE stock SET available_qtys= '".$data['available_qty']."', rstatus = '" .$data['rstatus'] ."' WHERE stock_id ='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
	    
		$sql = "DELETE FROM stock_semifinished WHERE rstock_id='" .$id ."'";
       
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function updateStockcopy($id){
	    $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
	    $sqls= "SELECT * FROM stock_semifinished WHERE rstock_id =(select max(rstock_id) from stock_semifinished where rstock_id < '" .$id ."')";
	    $run = mysqli_query($con, $sqls) or die("Error: ".mysqli_error($con));
        $row= mysqli_fetch_array($run);
        $query = "UPDATE stock_semifinished_copy SET available_qty = '".$row['available_qtys']."'WHERE id_product ='" .$row['raw_material_type'] ."' AND id_station='".$row['store_location']."'";
        $this->db->query($query);
        return $this->db->affected_rows();
	}

	public function insert($data) {
        // $id = md5(DATE('ymdhms').rand());
        $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
        $activity_date = DATE('dmyhms');
        $rawm_type = $data['rawm_type'];
		$sql = "SELECT * FROM stock_semifinished WHERE raw_material_type= '".$rawm_type."'";
        $run = mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
        $row= mysqli_fetch_array($run);
        $rstatus = $data['rstatus'];
        $previous_qty = $row['available_qty'];
        $qty = $data['quantity'];
        $p_weight = $row['r_weight'];
        $new_weight = $data['ir_weight'];
        $total = ($previous_qty) + ($qty);
        $total_weight = ($p_weight) + ($new_weight);
        $iweight = ($p_weight) - ($new_weight);
        $itotal = ($previous_qty) - ($qty);
        if ($row > 0 && $rstatus == "received") {
            $sqlU = "UPDATE stock_semifinished SET available_qtys = '".$total."', r_weight = '".$total_weight."' WHERE raw_material_type ='".$rawm_type."'";

		$this->db->query($sqlU);
        }
        elseif ($row > 0 && $rstatus == "issued") {
            $sqlU = "UPDATE stock_semifinished SET available_qtys = '".$itotal."', r_weight = '".$iweight."' WHERE raw_material_type ='".$rawm_type."'";
            $sqlIn = "INSERT INTO issued (rmaterial_type,employee_name,i_weight,quantity,station,reference_no,activity_date,i_status) VALUES('" .$data['rawm_type'] ."','" .$data['employee'] ."','" .$iweight ."','" .$itotal ."','" .$data['station'] ."','" .$data['reference_no'] ."','" .$data['activity_date'] ."','" .$rstatus ."')";

        $this->db->query($sqlU);
        $this->db->query($sqlIn);
        }
        else{
            $sqlI = "INSERT INTO stock_semifinished (id_employee,raw_material_type,r_weight,available_qty,reference_no,station,activity_date,rstatus) 
            VALUES('" .$data['employee'] ."','" .$rawm_type."','" .$new_weight ."','" .$qty."','" .$data['reference_no'] ."','" .$data['station'] ."','" .$data['activity_date'] ."','" .$data['rstatus'] ."')";

            $this->db->query($sqlI);
        }
		return $this->db->affected_rows();
	}
		public function confirmationrm($id) {
		$sql = "UPDATE stock_semifinished SET confirmation_status='1' WHERE rstock_id='".$id."'";

		$this->db->query($sql);

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