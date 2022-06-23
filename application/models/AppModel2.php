<?php
class AppModel2 extends CI_Model {

    public function __construct(){
		parent::__construct();
	}

	public function print_ticket_mod()
	{	
		$result = array();
		$this->db->select('*');
		$this->db->from('e_parking.tbl_transactions');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);  
		$query = $this->db->get();
	    $data = $query->result_array();

	    $arr = Array();
	 	foreach($data as $value)
	 	{
		 	$arr_data= Array();
			$arr_data[] = trim($value['id']);
			$arr_data[] = trim($value['uid']);
			$arr_data[] = trim($value['checkDigit']);
			$arr_data[] = trim($value['plateNumber']);
			$arr_data[] = trim($value['dateToday']);
			$arr_data[] = trim($value['dateTimeToday']);
			$arr_data[] = trim($value['dateUntil']);
			$arr_data[] = trim($value['amount']);
			$arr_data[] = trim($value['user']);
			$arr_data[] = trim($value['status']);
			$arr_data[] = trim($value['location']);

			array_push($arr,$arr_data);
		}
		echo json_encode($arr);
	}

	public function reprint_ticket_mod()
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('e_parking.tbl_reprint');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);  
		$query = $this->db->get();
	    $data = $query->result_array();

	    $arr = Array();
	 	foreach($data as $value)
	 	{
		 	$arr_data= Array();
			$arr_data[] = trim($value['id']);
			$arr_data[] = trim($value['uid']);
			$arr_data[] = trim($value['checkDigit']);
			$arr_data[] = trim($value['plateNumber']);
			$arr_data[] = trim($value['dateToday']);
			$arr_data[] = trim($value['dateTimeToday']);
			$arr_data[] = trim($value['dateUntil']);
			$arr_data[] = trim($value['amount']);
			$arr_data[] = trim($value['empId']);
			$arr_data[] = trim($value['location']);

			array_push($arr,$arr_data);
		}
		echo json_encode($arr);
	}

	public function print_penalty_mod()
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('e_parking.tbl_syncdata as tbl_sd');
		$this->db->join('tbl_user_req as tbl_ur','tbl_ur.user = tbl_sd.user','inner');
		$this->db->order_by('tbl_sd.id', 'desc');
		$this->db->limit(1);  
		$query = $this->db->get();
	    $data = $query->result_array();

	    $arr = Array();
	 	foreach($data as $value)
	 	{
		 	$arr_data= Array();
			$arr_data[] = trim($value['id']);
			$arr_data[] = trim($value['uid']);
			$arr_data[] = trim($value['plateNumber']);
			$arr_data[] = trim($value['dateTimeIn']);
			$arr_data[] = trim($value['dateTimeout']);
			$arr_data[] = trim($value['amount']);
			$arr_data[] = trim($value['penalty']);
			$arr_data[] = trim($value['user']);
			$arr_data[] = trim($value['outby']);
			

			$arr_data[] = trim($value['location']);
			$arr_data[] = trim($value['user']);
			array_push($arr,$arr_data);
		}
		echo json_encode($arr);
	}

	public function reprint_penalty_mod()
	{
		$result = array();
		//$this->db->select('tbl_sd.id','tbl_sd.uId','tbl_sd.transCode','tbl_sd.plate','tbl_sd.dateTimeIn','tbl_sd.dateTimeout','tbl_sd.amount','tbl_sd.penalty','tbl_sd.inEmpId','tbl_sd.outEmpId','tbl_sd.location');
		$this->db->select('*');
		$this->db->from('e_parking.tbl_penaltyeprint as tbl_sd');
		$this->db->join('tbl_user_req as tbl_ur','tbl_ur.user = tbl_sd.inEmpId','inner');
		$this->db->order_by('tbl_sd.id', 'desc');
		$this->db->limit(1);  
		$query = $this->db->get();
	    $data = $query->result_array();

	    $arr = Array();
	 	foreach($data as $value)
	 	{
		 	$arr_data= Array();
			$arr_data[] = trim($value['id']);
			$arr_data[] = trim($value['uId']);
			$arr_data[] = trim($value['transCode']);
			$arr_data[] = trim($value['plate']);
			$arr_data[] = trim($value['dateTimeIn']);
			$arr_data[] = trim($value['dateTimeout']);
			$arr_data[] = trim($value['amount']);
			$arr_data[] = trim($value['penalty']);
			$arr_data[] = trim($value['inEmpId']);
			$arr_data[] = trim($value['outEmpId']);
			$arr_data[] = trim($value['location']);
			array_push($arr,$arr_data);
		}
		echo json_encode($arr);
	}

	public function get_transaction_mod()
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('e_parking.tbl_user_req');
		$this->db->order_by('idr', 'desc');
		$this->db->limit(1);  
		$query = $this->db->get();
	    $data = $query->result_array();

	    $arr = Array();
	 	foreach($data as $value)
	 	{
		 	$arr_data= Array();
			$arr_data[] = trim($value['idr']);
			$arr_data[] = trim($value['user']);
			$arr_data[] = trim($value['transaction']);
			array_push($arr,$arr_data);
		}
		echo json_encode($arr);
	}

}
