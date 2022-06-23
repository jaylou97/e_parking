	<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportViewModel extends CI_Model
{
	public function select_all_datas($table)
	{
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function select_all_datasv2($table, $data)
	{
		$result = $this->db->get_where($table, $data);
		return $result->result_array();
	}
	public function select_data($table, $data)
	{
		$result = $this->db->get_where($table, $data);
		return $result->row();
	}
	public function getEndOfShiftData($id, $dt, $dt2)
	{

		$result = $this->db->query("SELECT trans.uid as uid, trans.outby as outby, trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount, trans.penalty1 as penalty1, trans.amount as amount, trans.lost_of_ticket as lost_of_ticket  FROM tbl_syncdata as trans WHERE trans.status='0' and   trans.outby = '$id' and trans.dateTimeout >= '$dt' and trans.dateTimeout <= '$dt2' GROUP BY trans.amount");

		// die('111');
		return $result->result_array();
	}

	public function getEndOfShiftData2($month)
	{
		// echo "Select trans.user as user, trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount  FROM tbl_syncdata as trans WHERE trans.dateTimeIn >= '$dt' and trans.dateTimeIn <= '$dt2' GROUP BY trans.amount";
		// $result = $this->db->query("SELECT trans.user as user, trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount  FROM tbl_syncdata as trans WHERE trans.dateTimeIn >= '$dt' and trans.dateTimeIn <= '$dt2' GROUP BY trans.amount");
		$result = $this->db->query("SELECT trans.user as user, trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount  FROM tbl_syncdata as trans WHERE (trans.status='0' or trans.remarks='PAID') and trans.dateTimeout LIKE '%$month%' GROUP BY trans.amount");
		return $result->result_array();
	}

	public function getTransDataFromSync($id, $dt, $dt2, $amt)
	{
		$result = $this->db->query("SELECT COUNT(id) as trans_count, ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket FROM `tbl_syncdata` WHERE status='0' and outby = '$id' and dateTimeout >= '$dt' and dateTimeout <= '$dt2' and amount = '$amt'");
		return $result->row();
	}

	public function getTransDataFromSync2($month, $amt)
	{
		// $result = $this->db->query("SELECT COUNT(id) as trans_count, ifnull(sum(penalty), 0) as penalty FROM `tbl_syncdata` WHERE dateTimeIn >= '$dt' and dateTimeIn <= '$dt2' and amount = '$amt'");
		$result = $this->db->query("SELECT COUNT(id) as trans_count, ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket FROM `tbl_syncdata` WHERE dateTimeout LIKE '%$month%' and amount = '$amt' and (status='0' or remarks='PAID') ");
		return $result->row();
	}

	public function getEndOfShiftDatavs2($id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT trans.outby as outby,trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount  FROM tbl_syncdata as trans WHERE trans.status='0' and trans.outby = '$id' and trans.dateTimeout >= '$dt' and trans.dateTimeout <= '$dt2'");
		return $result->result_array();
	}

	/*jay code*/
	public function get_data_tblremittance($id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT r.1k as 1k, r.5h as 5h, r.1h as 1h, r.fifty as fifty, r.twenty as twenty, r.coins as coins, r.p_attendant as p_attendant, r.r_amount as r_amount, r.datetime_remit as r_time FROM tbl_remittance as r WHERE r.p_attendant = '$id' and r.datetime_remit >= '$dt' and r.datetime_remit <= '$dt2'");
		return $result->result_array();
	}

	public function get_data_tblremittance2($id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT ifnull(sum(r_amount), 0) as r_amount, ifnull(sum(1k), 0) as onek, ifnull(sum(5h), 0) as fiveh, ifnull(sum(1h), 0) as oneh, ifnull(sum(fifty), 0) as fifty, ifnull(sum(twenty), 0) as twenty, ifnull(sum(coins), 0) as coins  FROM `tbl_remittance` WHERE p_attendant = '$id' and datetime_remit >= '$dt' and datetime_remit <= '$dt2'");
		return $result->row();
	}
	/*end jay code*/

	public function getEndOfShiftDatavs3($month)
	{
		// $result = $this->db->query("SELECT trans.user as user,trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount  FROM tbl_syncdata as trans WHERE trans.dateTimeIn >= '$dt' and trans.dateTimeIn <= '$dt2'");
		$result = $this->db->query("SELECT trans.user as user,trans.amount as amount, COUNT(trans.checkDigit) as coupon, SUM(trans.amount) as coupon_amount  FROM tbl_syncdata as trans WHERE (trans.status='0' or trans.remarks='PAID') and trans.dateTimeout LIKE '$month'");
		return $result->result_array();
	}

	public function getTransDataFromSyncvs2($id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT COUNT(id) as trans_count, ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket FROM `tbl_syncdata` WHERE status='0' and outby = '$id' and dateTimeout >= '$dt' and dateTimeout <= '$dt2'");
		return $result->row();
	}

	public function getTransDataFromSyncvs3($month)
	{
		// $result = $this->db->query("SELECT COUNT(id) as trans_count, ifnull(sum(penalty), 0) as penalty FROM `tbl_syncdata` WHERE dateTimeIn >= '$dt' and dateTimeIn <= '$dt2'");
		$result = $this->db->query("SELECT COUNT(id) as trans_count, ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket FROM `tbl_syncdata` WHERE (status='0' or remarks='PAID') and dateTimeout LIKE '%$month%'");
		return $result->row();
	}

	public function getUsersData($dt, $dt2)
	{
		$data = $this->db->query("SELECT DISTINCT(outby) as outby FROM `tbl_syncdata` WHERE status=0 and dateTimeout >= '$dt' and dateTimeout <= '$dt2'");
		return $data->result_array();
	}
	public function getInchargeTransData($incharge_id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT t.uid as uid, t.checkDigit as checkDigit, t.dateTimeout as dateTimeToday, t.amount as amount, t.location as location, t.penalty1 as penalty1, t.lost_of_ticket as lost_of_ticket FROM tbl_syncdata t WHERE status='0' and  t.dateTimeout >= '$dt' and t.dateTimeout <= '$dt2' and t.outby = '$incharge_id' order by t.amount, t.dateTimeout");
		return $result->result_array();
	}
	public function getTotalAmount($table, $data)
	{
		$result = $this->db->select('ifnull(sum(penalty), 0) as penalty, ifnull(sum(penalty1), 0) as penalty1, ifnull(sum(lost_of_ticket), 0) as lost_of_ticket')
			->from($table)
			->where($data)
			->get();
// die(var_dump($data));
		// $result = $this->db->query("SELECT ")
		// 	->from($table)
		// 	->where($data)
		// 	->get();





		// die(var_dump($result->row()));
		return $result->row();
	}
	public function getTotal_penaltyByUser($incharge_id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT ifnull(sum(penalty), 0) as penalty  FROM tbl_syncdata as trans WHERE trans.user = '$incharge_id' and trans.dateTimeIn >= '$dt' and trans.dateTimeIn <= '$dt2'");
		return $result->row();
	}
	public function penalty_offset($incharge_id, $dt, $dt2, $param)
	{
		if ($param == 'true') {
			$result = $this->db->query("SELECT *  FROM e_parking.tbl_syncdata as trans, pis.employee3 as emp WHERE trans.user = emp.emp_id and trans.user != '$incharge_id' and trans.outby = '$incharge_id' and trans.dateTimeIn >= '$dt' and trans.dateTimeIn <= '$dt2' and trans.penalty != '0' order by trans.dateTimeIn");
			return $result->result_array();
		} else {
			$result = $this->db->query("SELECT *  FROM e_parking.tbl_syncdata as trans, pis.employee3 as emp WHERE trans.outby = emp.emp_id and trans.user = '$incharge_id' and trans.outby != '$incharge_id' and trans.dateTimeIn >= '$dt' and trans.dateTimeIn <= '$dt2' and trans.penalty != '0' order by trans.dateTimeIn");
			return $result->result_array();
		}
	}
	public function getInchargeTransLocation($incharge_id, $dt, $dt2)
	{
		$result = $this->db->query("SELECT GROUP_CONCAT(distinct(t.location)) as location FROM tbl_syncdata t WHERE t.dateTimeout >= '$dt' and t.dateTimeout <= '$dt2' and t.outby = '$incharge_id' group by outby");
		return $result->row();
	}

	public function getMonths($dt, $dt2)
	{
		// $data = $this->db->query("SELECT DISTINCT(DATE(dateTimeIn)) as months FROM `tbl_syncdata` WHERE dateTimeIn >= '$dt' and dateTimeIn <= '$dt2'");
		$data = $this->db->query("SELECT DISTINCT(CONCAT(MONTH(dateTimeout), '-', YEAR(dateTimeout))) as months FROM `tbl_syncdata` WHERE dateTimeout >= '$dt' and dateTimeout <= '$dt2' and (status=0 or remarks='PAID') ");
		return $data->result_array();
	}
}
