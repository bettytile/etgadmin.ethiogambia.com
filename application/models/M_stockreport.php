<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stockreport extends CI_Model {
	public function select_all_stock() {
		$sql = "SELECT * FROM stock";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = " SELECT stock.stock_id AS id, stock.id_product AS code, stock.product_type AS p_type,stock.product_name AS p_name,stock.id_station AS station,stock.to_station AS station,station.station_name AS station, stock.available_product AS available_product, stock.reference_no AS reference_no, stock.received_qty AS received_qty, stock.issued_qty AS issued_qty, stock.s_status AS s_status, stock.activity_date AS activity_date, product.product_code AS code FROM stock, product,station WHERE product.prod_id=stock.id_product AND station.s_id=stock.id_station  ";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_all_confirmation() {
		$sql = " SELECT stock.stock_id AS id, stock.id_product AS code, stock.product_type AS p_type,stock.product_name AS p_name,stock.id_station AS station,stock.to_station AS station,station.station_name AS station, stock.available_product AS available_product, stock.reference_no AS reference_no, stock.received_qty AS received_qty, stock.issued_qty AS issued_qty, stock.s_status AS s_status, stock.activity_date AS activity_date, product.product_code AS code FROM stock, product, station WHERE product.prod_id=stock.id_product AND station.s_id=stock.id_station AND stock.confirmation_status ='0'";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT stock.stock_id AS id, stock.id_product AS id_product, stock.product_type AS p_type,stock.product_name AS p_name,stock.id_station AS id_station,stock.to_station AS station,station.station_name AS station, stock.available_product AS available_product, stock.reference_no AS reference_no, stock.received_qty AS received_qty, stock.issued_qty AS issued_qty, stock.s_status AS s_status, stock.activity_date AS activity_date, product.product_code AS code FROM stock, product,station WHERE product.prod_id=stock.id_product AND station.s_id=stock.id_station AND stock.stock_id = '{$id}'";
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
		$id_products = $data['p_code_n_id'];
		$resultexpl = explode('|', $id_products);
		$product = $resultexpl[1];
		$code = $resultexpl[0];
		$sql = "UPDATE stock SET id_product = '".$product."',product_code='".$code."', available_product= '".$data['available_product']."',id_station= '".$data['station']."',activity_date= '".$data['activity_date']."',reference_no= '".$data['reference_no']."',s_status= '".$data['s_status']."',issued_qty= '".$data['issued_qty']."',received_qty= '".$data['received_qty']."' WHERE stock.stock_id ='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function sdelete($id) {
		$sql = "DELETE FROM stock WHERE stock_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
		public function confirmation($id) {
		$sql = "UPDATE stock SET stock.confirmation_status = '1' WHERE stock.stock_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function updateStockcopy($id){
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
	    $sqls= "SELECT stock_id, available_product,id_station,id_product FROM stock WHERE stock.stock_id = '".$id."'";
	    $run = mysqli_query($con, $sqls) or die("Error: ".mysqli_error($con));
        $row= mysqli_fetch_array($run);
        if($row > 0){
          $sql= "SELECT MAX(stock_id), available_product,id_station,id_product FROM stock WHERE stock.id_product = '".$row['id_product']."' AND stock.id_station = '".$row['id_station']."' AND stock.stock_id < '".$row['stock_id']."'";  
          $runs = mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
        $rows= mysqli_fetch_array($runs);
        if ($rows > 0){
        $query = "UPDATE stock_copy SET available_qty = '".$row['available_product']."'WHERE id_products ='" .$row['id_product'] ."' AND id_station='".$row['id_station']."'";
        $this->db->query($query);
        }
        } else{
            $sql = "DELETE FROM stock_copy  WHERE id_products ='" .$row['id_product'] ."' AND id_station='".$row['id_station']."'";

		$this->db->query($sql);
        }
        return $this->db->affected_rows();
	}

	public function insert($data) {
        // $id = md5(DATE('ymdhms').rand());
        $activity_date = DATE('ymdhms');
		$sql = "INSERT INTO delivery (employee_id,customer_id,reference_no,id_product,product_type,id_station,activity_date,qty) VALUES('" .$data['employee'] ."','" .$data['customer'] ."','" .$data['reference_no'] ."','" .$data['code'] ."','" .$data['p_type'] ."','" .$data['station'] ."','$activity_date','" .$data['delivered_qty'] ."')";

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