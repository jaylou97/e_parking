<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{

	function __construct(){
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }	

	public function getEmpName_typehead($table, $data, $q){
		// $db2 = $this->load->database("pis", TRUE);
		$result = $this->db->select('name, emp_id, emp_no')
		->from($table)
		->where($data)
		->like('name', $q, 'both')
		->limit(10)
		->get();
		return $result->result();
	}

		// blacklist
	// ================================================
	public function get_blacklist($table,$data){
		$result = $this->db->get_where($table, $data);
		return $result->row_array();

	}

	public function get_blacklist3($dtstart,$dtend)
	{
				// $data=array('tbl_transactions.dateToday'=>$dtstart,'tbl_transactions.dateToday'=>$dtend);

				$this->db->order_by('tbl_delinquent.id','DESC');
				$this->db->join('tbl_syncdata','tbl_syncdata.uid = tbl_delinquent.uid','inner');
				$this->db->where('tbl_delinquent.dateEscaped2 >=',$dtstart);
				$this->db->where('tbl_delinquent.dateEscaped2 <=',$dtend);
				$this->db->where('tbl_delinquent.status !=','PAID');
				$res=$this->db->get('tbl_delinquent');

				return $res->result_array();
	}


				/*jay code*/
	public function get_blaclisted_admodel($id)
    {

    	$query = $this->db->query("SELECT s.plateNumber as plateNumber, s.dateTimeIn as dateTimeIn, s.amount as amount, d.dateEscaped as dateEscaped, d.totalHrs as totalHrs, d.excessHrs as excessHrs, d.penaltyA as penaltyA, d.totCharge as totCharge, d.totalAmt as totalAmt, s.checkDigit as checkDigit, d.uid as uid FROM tbl_delinquent d, tbl_syncdata s WHERE d.uid = s.uid and s.id = '$id' ");

    	return $query->result_array();
    }

    public function get_unblocklist_model($dtstart,$dtend)
	{
				$this->db->order_by('tbl_delinquent.id','DESC');
				$this->db->join('tbl_syncdata','tbl_syncdata.uid = tbl_delinquent.uid','inner');
				$this->db->where('tbl_delinquent.date_paid2 >=',$dtstart);
				$this->db->where('tbl_delinquent.date_paid2 <=',$dtend);
				$this->db->where('tbl_delinquent.status =','PAID');
				$res=$this->db->get('tbl_delinquent');

				return $res->result_array();
	}

	 public function get_loginlogoutlist_model($dtstart,$dtend)
	{
				$this->db->order_by('tbl_login_data.datelogin','ASC');
				// $this->db->join('tbl_syncdata','tbl_syncdata.uid = tbl_delinquent.uid','inner');
				$this->db->where('tbl_login_data.datelogin >=',$dtstart);
				$this->db->where('tbl_login_data.datelogin <=',$dtend);
				// $this->db->where('tbl_login_data.status =','PAID');
				$res=$this->db->get('tbl_login_data');

				return $res->result_array();
	}

	public function getprint_unblockdata_model($dtstart, $dtend)
	{
		
		$data = $this->db->query("SELECT s.user as user, s.plateNumber as plateNumber, s.amount as amount, s.dateTimeIn as dateTimeIn, d.dateEscaped as dateEscaped, d.date_paid as date_paid, d.totalHrs as totalHrs, d.excessHrs as excessHrs, d.penaltyA as penaltyA, d.totCharge as totCharge, d.totalAmt as totalAmt, s.checkDigit as checkDigit, s.uid as uid FROM tbl_delinquent d, tbl_syncdata s WHERE d.uid = s.uid and d.date_paid >= '$dtstart' and d.date_paid <= '$dtend' and d.status = 'PAID' ORDER BY s.amount");

		return $data->result_array();
	}

	public function getprint_loginlogout_model($dtstart, $dtend)
	{
		
		$data = $this->db->query("SELECT l.emp_id as emp_id, l.datelogin as datelogin, l.datelogout as datelogout, l.status as status FROM tbl_login_data l WHERE l.datelogin >= '$dtstart' and l.datelogin <= '$dtend' ORDER BY l.datelogin ASC");

		return $data->result_array();
	}

     public function unblock_model($uid,$status,$datepaid)
    {
       
      $this->db->query(" 

            UPDATE tbl_delinquent d, tbl_syncdata s
            
            SET d.status = '".$status."', s.remarks = '".$status."', d.date_paid = '".$datepaid."', d.date_paid2 = '".$datepaid."', s.dateTimeout = '".$datepaid."'

            WHERE d.uid = '".trim($uid)."' and s.uid = '".trim($uid)."'
            
         				");  

    }

    public function get_remittance_incharge_admodel($id)
    {

    	$query = $this->db->query("SELECT s.emp_id as id FROM tbl_user s WHERE s.user_id = '$id' ");

    	return $query->result_array();
    }

    public function save_remittance_model($p_attendant,$amount,$datepaid,$onek,$fiveh,$oneh,$fifty,$twenty,$coins)
    {
             
	    $data = array(
				'p_attendant'		=> $this->security->xss_clean(trim($p_attendant)),			
				'r_amount'			=> $this->security->xss_clean(trim($amount)),
				'datetime_remit'	=> $this->security->xss_clean($datepaid),
				'1k'				=> $this->security->xss_clean(trim($onek)),
				'5h'				=> $this->security->xss_clean(trim($fiveh)),
				'1h'				=> $this->security->xss_clean(trim($oneh)),
				'fifty'				=> $this->security->xss_clean(trim($fifty)),
				'twenty'			=> $this->security->xss_clean(trim($twenty)),
				'coins'				=> $this->security->xss_clean(trim($coins))
		 	);

		  $this->db->insert('tbl_remittance', $data);

    }
    			/*end jay code*/


	public function get_blacklist2($table,$uid,$dtstart,$dtend){
	$result = $this->db->query("SELECT * FROM `$table`  WHERE 'uid' ='$uid' and dateToday >= '$dtstart' and dateToday <= '$dtend'");
		return $result->row_array();

	}
	//end blacklist
	//=====================================================

	public function getData_pis($table, $data){
		// $db2 = $this->load->database("pis", TRUE);
		$result = $this->db2->get_where($table, $data);
		return $result->row();
	}

	// public function months($table, $data){
	public function months($month){
		// $db2 = $this->load->database("pis", TRUE);
		/*$result = $this->db->get_where($table, $data);
		return $result->row();*/
		// echo "Select * FROM tbl_syncdata WHERE dateTimeIn LIKE '%$month%'";
		$result = $this->db->query("Select * FROM tbl_syncdata WHERE dateTimeout LIKE '%$month%'");

		return $result->row();
	}

	public function getDatas_e_parking($table, $data){
		$result = $this->db->get_where($table, $data);
		return $result->result_array();
	}
	public function getData_e_parking($table, $data){
		$result = $this->db->get_where($table, $data);
		return $result->row();
	}
	public function getData_num($table, $data){
		$result = $this->db->get_where($table, $data);
		return $result->num_rows();
	}
	public function count_row($table){
		$result = $this->db->get($table);
		return $result->num_rows();
	}
	public function getDatas($table){
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function getSum_data_from_tbl($table, $data){

		$result = $this->db->select('ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket')
						   ->from($table)
						   ->where($data)
						   ->group_start()
						   ->where('status',0)
						   ->or_where('remarks','PAID')
						   ->group_end()
						   ->get();
			return $result->row();
	
	}
	public function insert_data($table, $data){
		$this->db->insert($table, $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			return 'success';
		}else{
			return 'error';
		}
	}
	public function getNumData($table, $data){
		$result = $this->db->get_where($table, $data);
		return $result->num_rows();
	}
	public function update_data($table, $ins_update, $ins){
		$result = $this->db->where($ins)
		->update($table, $ins_update);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return 'success';
		}else{
			return 'error'; 
		}
	}
	public function getSyncData()
	{
		$this->db->join('tbl_tabusers', 'tbl_tabusers.t_user_id = tbl_syncdata.app_id','inner');
		$result=$this->db->get('tbl_syncdata');
		return $result->result_array();
	}
	public function deletedata($table, $data){
		$this->db->where($data);
		$this->db->delete($table);
		$this->db->trans_complete();

		if($this->db->trans_status()==TRUE)
		{
			return "success";
		}
		else
		{
			return "error";
		}
	}
	public function get_data_for_v_monitoring($dt){
		$data = $this->db->query("SELECT dateToday, user, location FROM `tbl_transactions` where dateToday = '$dt' GROUP BY tbl_transactions.user");
		return $data->result_array();
	}
	public function get_data_for_vs2_monitoring($dtstart, $dtend){
		$data = $this->db->query("SELECT DISTINCT(dateToday) as dateToday FROM tbl_transactions WHERE dateToday >= '$dtstart' AND dateToday <= ' $dtend' GROUP BY dateToday");
		return $data->result_array();
	}
	public function getCollectionData($dtstart, $dtend){
		$data = $this->db->query("SELECT dateTimeout, outby, location, sum(amount) as amount, sum(penalty) as penalty FROM `tbl_syncdata` WHERE dateTimeout >= '$dtstart' and dateTimeout <= '$dtend' GROUP BY outby");
		return $data->result_array();
	}
	public function getDatacollectionByDates($dtstart, $dtend){
		$data = $this->db->query("SELECT CAST(dateTimeout AS DATE) as DateField FROM tbl_syncdata where dateTimeout >= '$dtstart' and dateTimeout <= '$dtend' GROUP BY CAST(dateTimeout AS DATE)");
		return $data->result_array();
	}
	public function get_incharge_collected($dtstart, $dtend, $outby){
		$data = $this->db->query("SELECT * FROM `tbl_syncdata` WHERE dateTimeout >= '$dtstart' and dateTimeout <= '$dtend' and outby = '$outby'");
		return $data->result_array();
	}

	public function get_days_data($dtstart, $dtend){
		$data = $this->db->query("SELECT date(dateTimeout) as dateTimeout FROM `tbl_syncdata` WHERE dateTimeout >= '$dtstart' AND dateTimeout <= '$dtend' and status='0' GROUP BY date(dateTimeout)");
		return $data->result_array();
	}
	public function get_data_records($dtstart, $dtend){
		$data = $this->db->query("SELECT count(id) as park_log, ifnull(SUM(amount),0) as amount, ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket FROM `tbl_syncdata` WHERE dateTimeout >= '$dtstart' and dateTimeout <= '$dtend' and location != '' and (status = '0' OR remarks = 'PAID') ");
		return $data->row();
	}
	public function getAllPenaltyRecordsAmount($dtstart, $dtend, $location){
		$data = $this->db->query("SELECT ifnull(sum(penalty),0) as penalty FROM `tbl_syncdata` WHERE DATE_FORMAT(dateTimeout, '%Y-%m-%d') >= '$dtstart' and DATE_FORMAT(dateTimeout, '%Y-%m-%d') <= '$dtend' and trim(location) = '$location'");
		return $data->row();
	}
	public function get_sample_data($table, $data){
		$result = $this->db->get_where($table, $data);
		return $result->result();
	}
	public function getNumofW($dt, $ta, $tb, $amt){
		$data = $this->db->query("SELECT COUNT(id) as num FROM `tbl_transactions` WHERE dateToday = '$dt' and dateTimeToday >= '$ta' and dateTimeToday <= '$tb' and amount = $amt");
		return $data->row();
	}
	public function getNumOfWheelsOut($ta2, $tb2, $amt){
		$data = $this->db->query("SELECT count(id) as num, sum(penalty) as penalty, sum(penalty1) as penalty1, sum(lost_of_ticket) as lost_of_ticket FROM `tbl_syncdata` WHERE dateTimeout >= '$ta2' and dateTimeout <= '$tb2' and amount = $amt and (status = '0' or remarks = 'PAID') ");
		return $data->row();
	}

	/*jay code*/
	public function getNumOfWheelsOut2($ta2, $tb2, $amt){
		$data = $this->db->query("SELECT count(id) as num FROM `tbl_syncdata` WHERE dateTimeout >= '$ta2' and dateTimeout <= '$tb2' and amount = $amt ");
		return $data->row();
	}

	public function getNumOfWheelsIn($ta2, $tb2, $amt){
		$data = $this->db->query("SELECT count(id) as num FROM `tbl_syncdata` WHERE dateTimeIn >= '$ta2' and dateTimeIn <= '$tb2' and amount = $amt");
		return $data->row();
	}
	/*end jay code*/

	public function getNumofWVS2($dt_s,$dt_l, $ta, $tb, $amt){
			$data = $this->db->query("SELECT COUNT(id) as num FROM `tbl_transactions` WHERE dateToday >= '$dt_s' and dateToday <= '$dt_l'  and dateTimeToday >= '$ta' and dateTimeToday <= '$tb' and amount = $amt");
		return $data->row();
	}
	public function getNumOfWheelsOutV2($ta2, $tb2, $amt, $ta, $tb){
		$data = $this->db->query("SELECT count(id) as num, sum(penalty) as penalty FROM `tbl_syncdata` WHERE dateTimeout >= '$ta2' and dateTimeout <= '$tb2' and DATE_FORMAT(dateTimeout,'%H:%i:%s') >= '$ta' AND DATE_FORMAT(dateTimeout,'%H:%i:%s') <= '$tb'  and amount = $amt");
		return $data->row();
	}
	public function getNumDataByDate($ta2, $tb2, $amt, $ta, $tb){
		$data->db->query("SELECT DATE_FORMAT(dateTimeIn,'%Y-%m-%d') as dateTimeIn FROM `tbl_syncdata` WHERE dateTimeout >= '$ta2' and dateTimeout <= '$tb2' and DATE_FORMAT(dateTimeout,'%H:%i:%s') >= '$ta' AND DATE_FORMAT(dateTimeout,'%H:%i:%s') <= '$tb' and amount = $amt GROUP BY DATE_FORMAT(dateTimeIn,'%Y-%m-%d')");
		return $data->num_rows();
	}
	public function get_blacklist10z($dtstart, $dtend){
		// $data = $this->db->query("SELECT t.plateNumber as plateNumber, t.amount as amount, t.dateToday as dateToday, t.dateTimeToday as dateTimeToday, t.checkDigit as checkDigit, t.uid as uid FROM tbl_delinquent d, tbl_transactions t WHERE d.uid = t.uid and d.dateToday >= '$dtstart' AND d.dateToday <= '$dtend' ORDER BY t.amount");

		$data = $this->db->query("SELECT s.plateNumber as plateNumber, s.amount as amount, s.dateTimeIn as dateTimeIn, d.dateEscaped as dateEscaped, d.totalHrs as totalHrs, d.excessHrs as excessHrs, d.penaltyA as penaltyA, d.totCharge as totCharge, d.totalAmt as totalAmt, s.checkDigit as checkDigit, s.uid as uid FROM tbl_delinquent d, tbl_syncdata s WHERE d.uid = s.uid and d.dateEscaped >= '$dtstart' AND d.dateEscaped <= '$dtend' and d.status != 'PAID' ORDER BY s.amount");

		return $data->result_array();
	}
	public function getSumParkingFee($dt1, $dt2){
		$result = $this->db->query("SELECT SUM(amount) as amount FROM `tbl_syncdata` WHERE dateTimeIn >= '2020-03-01' and dateTimeIn <= '2020-03-31 23:59:59' and location != ''");
		return $result->row();
	}
}