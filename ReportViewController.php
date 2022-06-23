<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportViewController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('ReportViewModel');
	}

	public function report_incharge_endofshift()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		// die('2323');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$incharge_id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));

		

		$dt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data['dtendz']=$dtendz;


		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$ddt = date('F d, Y', strtotime($dt));
		$inz = array('emp_id' => $incharge_id);
		$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "End of Shift: Cashier's Accountability Report (CAR)", 'cashier' => strtoupper($emp_data->name), 'date_end' => $ddt, 'page_theme' => "End Of Shift Report");
		$result2 = array();
		$res = $this->ReportViewModel->getEndOfShiftData($incharge_id, $dt, date('Y-m-d H:i:s', $dtendz));
		foreach ($res as $key => $value) {

			if ($value['amount'] == 50) {
				$ww = '2-w';
			} else {
				$ww = '4-w';
			}
			$trans_data = $this->ReportViewModel->getTransDataFromSync($value['user'], $dt,  date('Y-m-d H:i:s', $dtendz), $value['amount']);
			$result2[] = [
				'v_type' => $ww,
				'coupon' => $value['coupon'],
				'coupon_amt' => number_format($value['coupon_amount'], 2),
				'trans_count' => $trans_data->trans_count,
				'penalty' => number_format($trans_data->penalty, 2),
				'penalty1' =>  $value['penalty1'],
				'lost_of_ticket' =>  $value['lost_of_ticket']
			];
		}
		// var_dump('dsaa');
		$result3 = array();
		$res2 = $this->ReportViewModel->getEndOfShiftDatavs2($incharge_id, $dt, date('Y-m-d H:i:s', $dtendz));
		foreach ($res2 as $key => $value) {
			$trans_data = $this->ReportViewModel->getTransDataFromSyncvs2($value['user'], $dt,  date('Y-m-d H:i:s', $dtendz));
			$totz = $trans_data->penalty;
			// $totz = $value['coupon_amount'] + $trans_data->penalty;
			$result3[] = [
				'coupon' => $value['coupon'], 
				'coupon_amt' => number_format($value['coupon_amount'], 2), 
				'trans_count' => $trans_data->trans_count, 
				'penalty' => $trans_data->penalty, 
				'penalty1' => $trans_data->penalty1, 
				'lost_of_ticket' => $trans_data->lost_of_ticket, 
				'tot_amt' => number_format($totz, 2)
			];
		}
		$result4 = array();
		$rezdata = $this->ReportViewModel->getInchargeTransData($incharge_id, $dt, date('Y-m-d H:i:s', $dtendz));
		$w2z = 0;
		$w4z = 0;
		foreach ($rezdata as $key => $value) {

			if ($value['amount'] == 50) {
				$ww = '2-w';
				$w2z += 1;
			} else {
				$ww = '4-w';
				$w4z += 1;
			}
			$inzs = array('uid' => $value['uid']);
			$p_data = $this->ReportViewModel->getTotalAmount('tbl_syncdata', $inzs);
			$result4[] = [
				'v_type' => $value['amount'] == 50 ? $w2z . ".) " . $ww : $w4z . ".) " . $ww,
				'trans_num' => $value['checkDigit'],
				'coupon_no' => $value['checkDigit'],
				'coupon_amt' => number_format($value['amount'], 2),
				'time_trans' => date('m-d-Y g:i:s a', strtotime($value['dateTimeToday'])),
				'charges' => number_format($p_data->penalty, 2),
				'amt' => $value['amount'],
				'penalty1' => $value['penalty1'],
				'lost_of_ticket' => $value['lost_of_ticket']
			];
		}




		$over_offset = $this->ReportViewModel->penalty_offset($incharge_id, $dt, date('Y-m-d H:i:s', $dtendz), true);
		$short_offset = $this->ReportViewModel->penalty_offset($incharge_id, $dt, date('Y-m-d H:i:s', $dtendz), false);

		$data['location_data'] =  $this->ReportViewModel->getInchargeTransLocation($incharge_id, $dt, date('Y-m-d H:i:s', $dtendz));
		$data['short_over_data'] =  ['over_offset' => $over_offset, 'short_offset' => $short_offset];
		$data['data_result4'] = $result4;
		$data['data_result'] = $result2;
		$data['data_result2'] = $result3;
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['page_title_'] = 'E-Parking System | Dashboard';
		$data['page_route'] = $this->uri->segment(1);

		// var_dump($data['user_data']);
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_end_of_shift', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_end_of_shift_action');
	}




	public function report_incharge_endofday()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$dt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$ddt = date('F d, Y', strtotime($dt));
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "End of Day: Cashiers' Accountability Summary (CAS)", 'date_end' => $ddt, 'page_theme' => "End Of Day Report");
		$result101 = array();
		$userdata = $this->ReportViewModel->getUsersData($dt, date('Y-m-d H:i:s', $dtendz));
		foreach ($userdata as $key => $valuex) {
			$inz = array('emp_id' => $valuex['user']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result2 = array();
			$location = $this->ReportViewModel->getInchargeTransLocation($valuex['user'], $dt, date('Y-m-d H:i:s', $dtendz));
			$res = $this->ReportViewModel->getEndOfShiftData($valuex['user'], $dt, date('Y-m-d H:i:s', $dtendz));

			foreach ($res as $key => $value) {
				if ($value['amount'] == 50) {
					$ww = '2-w';
				} else {
					$ww = '4-w';
				}
				$trans_data = $this->ReportViewModel->getTransDataFromSync($value['user'], $dt,  date('Y-m-d H:i:s', $dtendz), $value['amount']);

				$inzs = array('uid' => $value['uid']);

				$p_data = $this->ReportViewModel->getTotalAmount('tbl_syncdata', $inzs);

				$result2[] = [
					'charges' => number_format($p_data->penalty, 2), 
					'v_type' => $ww, 
					'coupon' => $value['coupon'],
					'amount' => $value['amount'], 
					'coupon_amt' => number_format($value['coupon_amount'], 2), 
					'trans_count' => $trans_data->trans_count, 
					'penalty' => number_format($trans_data->penalty, 2),
					//'penalty1' => number_format($trans_data->penalty1, 2)
							/*jay code*/
					'penalty1' => number_format($trans_data->penalty1, 2, '.', ''),
					'lost_of_ticket' => number_format($trans_data->lost_of_ticket, 2, '.', '')
							/*end of jay code*/
				];
			}

			// die(var_dump($result2));

			$result3 = array();
			$res2 = $this->ReportViewModel->getEndOfShiftDatavs2($valuex['user'], $dt, date('Y-m-d H:i:s', $dtendz));
			foreach ($res2 as $key => $value) {
				$trans_data = $this->ReportViewModel->getTransDataFromSyncvs2($value['user'], $dt,  date('Y-m-d H:i:s', $dtendz));
				$totz = $value['coupon_amount'] + $trans_data->penalty;
				// $totz = $value['coupon_amount'] + $trans_data->penalty;
				
				$result3[] = [
					'coupon' => $value['coupon'], 
					'coupon_amt' => number_format($value['coupon_amount'], 2), 
					'trans_count' => $trans_data->trans_count, 
					'penalty' => number_format($trans_data->penalty, 2), 
					//'penalty1' => number_format($trans_data->penalty1, 2), 
							/*jay code*/
					'penalty1' => number_format($trans_data->penalty1, 2, '.', ','),
					'lost_of_ticket' => number_format($trans_data->lost_of_ticket, 2, '.', ','),
							/*end of jay code*/
					'tot_amt' => number_format($totz, 2)
				];
			}
			$result101[] = ['cashier' => strtoupper($emp_data->name), 'data_result' => $result2, 'data_result2' => $result3, 'location' => $location];
		}

		// die(var_dump($result101));
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['data_result101'] = $result101;
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_end_of_day', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_end_of_day_action');
	}


	public function report_incharge_daily()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$dt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$ddt = date('F d, Y', strtotime($dt));
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "Pay Parking Daily Statistics Report", 'date_end' => $ddt, 'page_theme' => "Daily Statistics Report");
		$result101 = array();
		$time_a = '7:00 am';
		$time_b = '8:30 am';
		for ($i = 1; $i <= 17; $i++) {
			$ta = date('H:i:s', strtotime($time_a));
			$tb = date('H:i:s', strtotime($time_b));
			$w2 = $this->AdminModel->getNumofW($dt, $ta, $tb, '50');
			$w4 = $this->AdminModel->getNumofW($dt, $ta, $tb, '100');
			$ta2 = date('Y-m-d H:i:s', strtotime($dt . ' ' . $ta));
			$tb2 =  date('Y-m-d H:i:s', strtotime($dt . ' ' . $tb));
			$w2o = $this->AdminModel->getNumOfWheelsOut($ta2, $tb2, '50');
			$w4o = $this->AdminModel->getNumOfWheelsOut($ta2, $tb2, '100');

			/*jay code*/
			$w2i = $this->AdminModel->getNumOfWheelsIn($ta2, $tb2, '50');
			$w4i = $this->AdminModel->getNumOfWheelsIn($ta2, $tb2, '100');
			$w2o2 = $this->AdminModel->getNumOfWheelsOut2($ta2, $tb2, '50');
			$w4o2 = $this->AdminModel->getNumOfWheelsOut2($ta2, $tb2, '100');
			//$totz = $w2o->penalty + $w4o->penalty;
			/*jay additional code*/
			$totz = $w2o->penalty + $w2o->penalty1 + $w2o->lost_of_ticket + $w4o->penalty + $w4o->penalty1 + $w4o->lost_of_ticket;
			$result101[] = ['dtime' =>  $time_a . ' - ' . $time_b, 'w2in' => $w2i->num, 'w4in' => $w4i->num, 'w2out' => $w2o2->num, 'w4out' => $w4o2->num, 'pw2' => number_format($w2o->penalty + $w2o->penalty1 + $w2o->lost_of_ticket, 2), 'pw4' => number_format($w4o->penalty + $w4o->penalty1 + $w4o->lost_of_ticket, 2), 's_tot' => number_format($totz, 2)];

			if ($i === 1) {
				$t_a =  date("g:i a", strtotime("+1 hour +31 minutes", strtotime($time_a)));
				$t_b =  date("g:i a", strtotime("+1 hour", strtotime($time_b)));
			} else {
				$t_a =  date("g:i a", strtotime("+1 hour ", strtotime($time_a)));
				$t_b =  date("g:i a", strtotime("+1 hour", strtotime($time_b)));
			}

			$time_a = $t_a;
			$time_b = $t_b;
		}
		$data['data_result101'] = $result101;
		$t_a = '7:00 am';
		$t_b = '11:59 pm';
		$ta = date('H:i:s', strtotime($t_a));
		$tb = date('H:i:s', strtotime($t_b));
		$w2 = $this->AdminModel->getNumofW($dt, $ta, $tb, '50');
		$w4 = $this->AdminModel->getNumofW($dt, $ta, $tb, '100');
		$ta2 = date('Y-m-d H:i:s', strtotime($dt . ' ' . $ta));
		$tb2 =  date('Y-m-d H:i:s', strtotime($dt . ' ' . $tb));
		$w2o = $this->AdminModel->getNumOfWheelsOut($ta2, $tb2, '50');
		$w4o = $this->AdminModel->getNumOfWheelsOut($ta2, $tb2, '100');

		/*jay code*/
		$w2i = $this->AdminModel->getNumOfWheelsIn($ta2, $tb2, '50');
		$w4i = $this->AdminModel->getNumOfWheelsIn($ta2, $tb2, '100');
		$w2o2 = $this->AdminModel->getNumOfWheelsOut2($ta2, $tb2, '50');
		$w4o2 = $this->AdminModel->getNumOfWheelsOut2($ta2, $tb2, '100');
		//$totz = $w2o->penalty + $w4o->penalty;
		/*jay additional code*/
		$totz = $w2o->penalty + $w2o->penalty1 + $w2o->lost_of_ticket + $w4o->penalty + $w4o->penalty1 + $w4o->lost_of_ticket;
		$data['g_total'] = array('w2in' => $w2i->num, 'w4in' => $w4i->num, 'w2out' => $w2o2->num, 'w4out' => $w4o2->num, 'pw2' => number_format($w2o->penalty + $w2o->penalty1 + $w2o->lost_of_ticket, 2), 'pw4' => number_format($w4o->penalty + $w4o->penalty1 + $w4o->lost_of_ticket, 2), 's_tot' => number_format($totz, 2));

		$data['page_route'] = $this->uri->segment(1);
		$data['page_title'] = 'E-Parking System | Dashboard';
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_daily_statistics', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_daily_statistics_action');
	}

	public function report_incharge_weekly()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$fdt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$ldt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		// $dtendz = (strtotime($fdt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$f_dt = date('F d, Y', strtotime($fdt));
		$l_dt = date('F d, Y', strtotime($ldt));
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "Pay Parking Weekly Statistics Report", 'date_start' => $f_dt, 'date_end' => $l_dt, 'page_theme' => "Weekly Statistics Report");
		$time_a = '7:00 am';
		$time_b = '8:30 am';
		for ($i = 1; $i <= 17; $i++) {
			$ta = date('H:i:s', strtotime($time_a));
			$tb = date('H:i:s', strtotime($time_b));
			$w2 = $this->AdminModel->getNumofWVS2($fdt, $ldt, $ta, $tb, '50');
			$w4 = $this->AdminModel->getNumofWVS2($fdt, $ldt, $ta, $tb, '100');
			$ta2 = date('Y-m-d H:i:s', strtotime($fdt . ' ' . $ta));
			$tb2 =  date('Y-m-d H:i:s', strtotime($ldt . ' ' . $tb));
			$w2o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '50', $ta, $tb);
			$w4o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '100', $ta, $tb);
			$totz = $w2o->penalty + $w4o->penalty;
			$result101[] = ['dtime' =>  $time_a . ' - ' . $time_b, 'w2in' => $w2->num, 'w4in' => $w4->num, 'w2out' =>  $w2o->num, 'w4out' => $w4o->num, 'pw2' => number_format($w2o->penalty, 2), 'pw4' => number_format($w4o->penalty, 2), 's_tot' => number_format($totz, 2)];
			if ($i === 1) {
				$t_a =  date("g:i a", strtotime("+1 hour +31 minutes", strtotime($time_a)));
				$t_b =  date("g:i a", strtotime("+1 hour", strtotime($time_b)));
			} else {
				$t_a =  date("g:i a", strtotime("+1 hour ", strtotime($time_a)));
				$t_b =  date("g:i a", strtotime("+1 hour", strtotime($time_b)));
			}

			$time_a = $t_a;
			$time_b = $t_b;
		}
		$datediff = strtotime($ldt) - strtotime($fdt);
		$day_num = round($datediff / (60 * 60 * 24));
		$dt_num = $day_num + 1;
		$data['data_result101'] = $result101;
		$t_a = '7:00 am';
		$t_b = '11:59 pm';
		$ta = date('H:i:s', strtotime($t_a));
		$tb = date('H:i:s', strtotime($t_b));
		$w2 = $this->AdminModel->getNumofWVS2($fdt, $ldt, $ta, $tb, '50');
		$w4 = $this->AdminModel->getNumofWVS2($fdt, $ldt, $ta, $tb, '100');
		$ta2 = date('Y-m-d H:i:s', strtotime($fdt . ' ' . $ta));
		$tb2 =  date('Y-m-d H:i:s', strtotime($ldt . ' ' . $tb));
		$w2o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '50', $ta, $tb);
		$w4o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '100', $ta, $tb);
		$totz = $w2o->penalty + $w4o->penalty;
		$data['g_total'] = array('w2in' => $w2->num, 'w4in' => $w4->num, 'w2out' =>  $w2o->num, 'w4out' => $w4o->num, 'pw2' => number_format($w2o->penalty, 2), 'pw4' => number_format($w4o->penalty, 2), 's_tot' => number_format($totz, 2));
		$w2t =  intval($w2->num) / $dt_num;
		$w4t =  intval($w4->num) / $dt_num;
		$w2ot = intval($w2o->num) / $dt_num;
		$w4ot = intval($w4o->num) / $dt_num;
		$pw2t = $w2o->penalty / $dt_num;
		$pw4t = $w4o->penalty / $dt_num;
		$totalz = $totz / $dt_num;
		$data['d_average'] = array('w2in' => round($w2t), 'w4in' => round($w4t), 'w2out' =>  round($w2ot), 'w4out' => round($w4ot), 'pw2' => number_format($pw2t, 2), 'pw4' => number_format($pw4t, 2), 's_tot' => number_format($totalz, 2));
		$resultv2  = array();
		$dateFrom = strtotime($fdt);
		$dateto = strtotime($ldt);
		for ($i = $dateFrom; $i <= $dateto; $i += 86400) {
			$dt = date('Y-m-d', $i);
			$t_a = '7:00 am';
			$t_b = '11:59 pm';
			$ta = date('H:i:s', strtotime($t_a));
			$tb = date('H:i:s', strtotime($t_b));
			$w2 = $this->AdminModel->getNumofW($dt, $ta, $tb, '50');
			$w4 = $this->AdminModel->getNumofW($dt, $ta, $tb, '100');
			$ta2 = date('Y-m-d H:i:s', strtotime($dt . ' ' . $ta));
			$tb2 =  date('Y-m-d H:i:s', strtotime($dt . ' ' . $tb));
			$w2o = $this->AdminModel->getNumOfWheelsOut($ta2, $tb2, '50');
			$w4o = $this->AdminModel->getNumOfWheelsOut($ta2, $tb2, '100');
			$totz = $w2o->penalty + $w4o->penalty;
			$resultv2[] = ['date_time' =>  date('m-d-Y', $i), 'date_day' => date('D', $i), 'w2in' => $w2->num, 'w4in' => $w4->num, 'w2out' => $w2o->num, 'w4out' => $w4o->num, 'pw2' => number_format($w2o->penalty, 2), 'pw4' => number_format($w4o->penalty, 2), 's_tot' => number_format($totz, 2)];
		}
		$data['average_data'] = $resultv2;
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_weekly_statistics', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_weekly_statistics');
	}

	public function report_incharge_monthly()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$m = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$date1 = $y . '-' . $m;
		$d = date_create_from_format('Y-m', $date1);
		// $lday = date_format($d, 't');
		$first_day = date_format($d, 'Y-m-1');
		$last_day = date_format($d, 'Y-m-t');
		// $dtendz = (strtotime($first_day) + (23 * 60 * 60)) + (59 * 60) + 59;
		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$m = date('F', strtotime($first_day));
		$d = date('d', strtotime($first_day));
		$y = date('Y', strtotime($first_day));
		$fdt = $m . ' ' . $d . ', ' . $y;
		$m = date('F', strtotime($last_day));
		$d = date('d', strtotime($last_day));
		$y = date('Y', strtotime($last_day));
		$ldt = $m . ' ' . $d . ', ' . $y;
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "Pay Parking Monthly Statistics Report", 'date_first' => $fdt, 'date_end' => $ldt, 'page_theme' => "Monthly Statistics Report");
		$time_a = '7:00 am';
		$time_b = '8:30 am';
		for ($i = 1; $i <= 17; $i++) {
			$ta = date('H:i:s', strtotime($time_a));
			$tb = date('H:i:s', strtotime($time_b));
			$w2 = $this->AdminModel->getNumofWVS2(date('Y-m-d', strtotime($fdt)), date('Y-m-d', strtotime($ldt)), $ta, $tb, '50');
			$w4 = $this->AdminModel->getNumofWVS2(date('Y-m-d', strtotime($fdt)), date('Y-m-d', strtotime($ldt)), $ta, $tb, '100');
			$ta2 = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($fdt)) . ' ' . $ta));
			$tb2 =  date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($ldt)) . ' ' . $tb));
			$w2o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '50', $ta, $tb);
			$w4o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '100', $ta, $tb);
			$totz = $w2o->penalty + $w4o->penalty;
			$result101[] = ['dtime' =>  $time_a . ' - ' . $time_b, 'w2in' => $w2->num, 'w4in' => $w4->num, 'w2out' =>  $w2o->num, 'w4out' => $w4o->num, 'pw2' => number_format($w2o->penalty, 2), 'pw4' => number_format($w4o->penalty, 2), 's_tot' => number_format($totz, 2)];
			if ($i === 1) {
				$t_a =  date("g:i a", strtotime("+1 hour +31 minutes", strtotime($time_a)));
				$t_b =  date("g:i a", strtotime("+1 hour", strtotime($time_b)));
			} else {
				$t_a =  date("g:i a", strtotime("+1 hour ", strtotime($time_a)));
				$t_b =  date("g:i a", strtotime("+1 hour", strtotime($time_b)));
			}

			$time_a = $t_a;
			$time_b = $t_b;
		}

		$data['data_result101'] = $result101;
		$t_a = '7:00 am';
		$t_b = '11:59 pm';
		$ta = date('H:i:s', strtotime($t_a));
		$tb = date('H:i:s', strtotime($t_b));
		$w2 = $this->AdminModel->getNumofWVS2(date('Y-m-d', strtotime($fdt)), date('Y-m-d', strtotime($ldt)), $ta, $tb, '50');
		$w4 = $this->AdminModel->getNumofWVS2(date('Y-m-d', strtotime($fdt)), date('Y-m-d', strtotime($ldt)), $ta, $tb, '100');
		$ta2 = date('Y-m-d H:i:s', strtotime($fdt . ' ' . $ta));
		$tb2 =  date('Y-m-d H:i:s', strtotime($ldt . ' ' . $tb));
		$w2o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '50', $ta, $tb);
		$w4o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '100', $ta, $tb);
		$totz = $w2o->penalty + $w4o->penalty;
		$data['g_total'] = array('w2in' => $w2->num, 'w4in' => $w4->num, 'w2out' =>  $w2o->num, 'w4out' => $w4o->num, 'pw2' => number_format($w2o->penalty, 2), 'pw4' => number_format($w4o->penalty, 2), 's_tot' => number_format($totz, 2));
		$num = ceil(date('j', strtotime($ldt)) / 7);
		$w2t =  intval($w2->num) / $num;
		$w4t =  intval($w4->num) / $num;
		$w2ot = intval($w2o->num) / $num;
		$w4ot = intval($w4o->num) / $num;
		$pw2t = $w2o->penalty / $num;
		$pw4t = $w4o->penalty / $num;
		$totalz = $totz / $num;
		$data['w_average'] = array('w2in' => round($w2t), 'w4in' => round($w4t), 'w2out' =>  round($w2ot), 'w4out' => round($w4ot), 'pw2' => number_format($pw2t, 2), 'pw4' => number_format($pw4t, 2), 's_tot' => number_format($totalz, 2));
		$w2t2 =  intval($w2t) / 7;
		$w4t2 =  intval($w4t) / 7;
		$w2ot2 = intval($w2ot) / 7;
		$w4ot2 = intval($w4ot) / 7;
		$pw2t2 = $pw2t / 7;
		$pw4t2 = $pw4t / 7;
		$totalz2 = $totalz / 7;
		$data['d_average'] = array('w2in' => round($w2t2), 'w4in' => round($w4t2), 'w2out' =>  round($w2ot2), 'w4out' => round($w4ot2), 'pw2' => number_format($pw2t2, 2), 'pw4' => number_format($pw4t2, 2), 's_tot' => number_format($totalz2, 2));

		$resultv2  = array();
		for ($i = 0; $i < $num; $i++) {
			$today = new DateTime('today');
			$num_week = date('W', strtotime($first_day));
			$ddy = date('D', strtotime($first_day));
			$year_number = $y;
			if ($ddy === 'Sun') {
				$week_number = $num_week + $i + 1;
			} else {
				$week_number = $num_week + $i;
			}
			$fdt = clone $today->setISODate($year_number, $week_number, 0);
			$ldt = clone $today->setISODate($year_number, $week_number, 6);
			// var_dump($fdt->format("Y-m-d"), $ldt->format("Y-m-d"));
			// $vars_f = get_object_vars($fdt);
			$vars_f['date'] = $fdt->format("Y-m-d");
			$vars_l['date'] = $ldt->format("Y-m-d");
			// $vars_l = get_object_vars($ldt);
			$first_dt = date('m-d-Y', strtotime($vars_f['date']));
			$first_dt = $first_dt = date('m-d-Y', strtotime($vars_f['date']));
			$second_dt = date('m-d-Y', strtotime($vars_l['date']));
			$first_dayx = "";
			$last_dayx = "";
			$nn = $i + 1;
			switch ($nn) {
				case '1':
					$ss = 'st ';
					$dtz = date('m-d-Y', strtotime($first_day)) . ' - ' . $second_dt;
					$first_dayx = date('Y-m-d', strtotime($first_day));
					$last_dayx = date('Y-m-d', strtotime($vars_l['date']));
					break;
				case '2':
					$ss = 'nd ';
					$dtz = $first_dt . ' - ' . $second_dt;
					$first_dayx = date('Y-m-d', strtotime($vars_f['date']));
					$last_dayx = date('Y-m-d', strtotime($vars_l['date']));
					break;
				case '3':
					$ss = 'rd ';
					$dtz = $first_dt . ' - ' . $second_dt;
					$first_dayx = date('Y-m-d', strtotime($vars_f['date']));
					$last_dayx = date('Y-m-d', strtotime($vars_l['date']));
					break;
				default:
					$ss = 'th ';
					if ($vars_l['date'] > date('Y-m-d', strtotime($last_day))) {
						$dtz = $first_dt . ' - ' . date('m-d-Y', strtotime($last_day));
						$first_dayx = date('Y-m-d', strtotime($vars_f['date']));
						$last_dayx = date('Y-m-d', strtotime($last_day));
					} else {
						$dtz = $first_dt . ' - ' . $second_dt;
						$first_dayx = date('Y-m-d', strtotime($vars_f['date']));
						$last_dayx = date('Y-m-d', strtotime($vars_l['date']));
					}
					if (intval($nn) === intval($num)) {
						if ($vars_l['date'] < date('Y-m-d', strtotime($last_day))) {
							$num++;
						}
					}
					break;
			}
			$datediff = strtotime($last_dayx) - strtotime($first_dayx);
			$day_num = round($datediff / (60 * 60 * 24));
			$dt_num = $day_num + 1;
			$data['data_result101'] = $result101;
			$t_a = '7:00 am';
			$t_b = '11:59 pm';
			$ta = date('H:i:s', strtotime($t_a));
			$tb = date('H:i:s', strtotime($t_b));
			$w2 = $this->AdminModel->getNumofWVS2($first_dayx, $last_dayx, $ta, $tb, '50');
			$w4 = $this->AdminModel->getNumofWVS2($first_dayx, $last_dayx, $ta, $tb, '100');
			$ta2 = date('Y-m-d H:i:s', strtotime($first_dayx . ' ' . $ta));
			$tb2 =  date('Y-m-d H:i:s', strtotime($last_dayx . ' ' . $tb));
			$w2o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '50', $ta, $tb);
			$w4o = $this->AdminModel->getNumOfWheelsOutV2($ta2, $tb2, '100', $ta, $tb);
			$totz = $w2o->penalty + $w4o->penalty;
			$w2t =  intval($w2->num) / $num;
			$w4t =  intval($w4->num) / $num;
			$w2ot = intval($w2o->num) / $num;
			$w4ot = intval($w4o->num) / $num;
			$pw2t = $w2o->penalty / $num;
			$pw4t = $w4o->penalty / $num;
			$totalz = $totz / $num;
			$resultv2[] = ['week_num' => $nn . $ss . ' WEEK', 'w2in' => round($w2t), 'w4in' => round($w4t), 'w2out' =>  round($w2ot), 'w4out' => round($w4ot), 'pw2' => number_format($pw2t, 2), 'pw4' => number_format($pw4t, 2), 's_tot' => number_format($totalz, 2)];
		}
		$data['average_data'] = $resultv2;
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_monthly_statistics', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_monthly_statistics');
	}
	public function report_snyc_monthly_data()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$mm = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$yy = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dt = date_create_from_format('Y-m', $yy . "-" . $mm);
		$dtendz = (strtotime($dt->format('Y-m-t')) + (23 * 60 * 60)) + (59 * 60) + 59;
		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$ddt = date('F d, Y', strtotime($dt->format('Y-m-1'))) . " - " . date('F d, Y', strtotime($dt->format('Y-m-t')));
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "End of Day: Cashiers' Accountability Summary (CAS)", 'date_end' => $ddt, 'page_theme' => "Monthly Data Report");
		$result101 = array();
		$userdata = $this->ReportViewModel->getUsersData($dt->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
		$gtotals['2-w'] = ['coupon' => 0, 'coupon_amt' => 0, 'trans_count' => 0, 'penalty' => 0];
		$gtotals['4-w'] = ['coupon' => 0, 'coupon_amt' => 0, 'trans_count' => 0, 'penalty' => 0];
		foreach ($userdata as $key => $valuex) {
			if ($valuex['user']) {
				$inz = array('emp_id' => $valuex['user']);
				$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);

				$result2 = array();
				$location = $this->ReportViewModel->getInchargeTransLocation($valuex['user'], $dt->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
				$res = $this->ReportViewModel->getEndOfShiftData($valuex['user'], $dt->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
				foreach ($res as $key => $value) {
					if ($value['amount'] == 50) {
						$ww = '2-w';
					} else {
						$ww = '4-w';
					}
					$trans_data = $this->ReportViewModel->getTransDataFromSync($value['user'], $dt->format('Y-m-1'),  date('Y-m-d H:i:s', $dtendz), $value['amount']);
					$result2[] = ['v_type' => $ww, 'coupon' => $value['coupon'], 'coupon_amt' => number_format($value['coupon_amount'], 2), 'trans_count' => $trans_data->trans_count, 'penalty' => number_format($trans_data->penalty, 2)];
					$gtotals[$ww] = [
						'coupon' => floatval($gtotals[$ww]['coupon']) + floatval($value['coupon']),
						'coupon_amt' => floatval($gtotals[$ww]['coupon_amt']) + floatval($value['coupon_amount']),
						'trans_count' => floatval($gtotals[$ww]['trans_count']) + floatval($trans_data->trans_count),
						'penalty' => floatval($gtotals[$ww]['penalty']) + floatval($trans_data->penalty)
					];
				}
				$result3 = array();
				$res2 = $this->ReportViewModel->getEndOfShiftDatavs2($valuex['user'], $dt->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));

				foreach ($res2 as $key => $value) {
					if ($value['user']) {
						$trans_data = $this->ReportViewModel->getTransDataFromSyncvs2($value['user'], $dt->format('Y-m-1'),  date('Y-m-d H:i:s', $dtendz));
						$totz = $value['coupon_amount'] + $trans_data->penalty;
						$result3[] = ['coupon' => $value['coupon'], 'coupon_amt' => number_format($value['coupon_amount'], 2), 'trans_count' => $trans_data->trans_count, 'penalty' => number_format($trans_data->penalty, 2), 'tot_amt' => number_format($totz, 2)];
					}
				}
				$result101[] = ['cashier' => $emp_data ? strtoupper($emp_data->name) : '', 'data_result' => $result2, 'data_result2' => $result3, 'location' => $location];
			}
		}
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['data_result101'] = $result101;
		$data['page_route'] = $this->uri->segment(1);
		$data['g_totals'] = $gtotals;
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_monthly_data', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_monthly_data_action');
	}
	public function report_MonthlyRangeData()
	{

		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		date_default_timezone_set('Asia/Manila');
		$result = array();
		$persons = $this->AdminModel->getDatas('tbl_persons');
		$i = 1;
		foreach ($persons as $key => $value) {
			$inz = array('emp_id' => $value['p_emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$result[] = ['picture' => $value['p_image'], 'name' => $emp_data->name, 'position' => $emp_data->position, 'current_status' => $emp_data->current_status, 'index' => $i];
			$i++;
		}
		$data['persons'] = $result;
		$empid = $this->session->userdata('name');
		$inx = array('emp_id' => $empid);
		$user_data = $this->AdminModel->getData_pis('pis.employee3', $inx);
		$data['user_data'] = $user_data;
		$inzert = array('company_code' => $user_data->company_code, 'bunit_code' => $user_data->bunit_code, 'dept_code' => $user_data->dept_code);
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		// unique code for this page
		$data_input = explode("-", $this->uri->segment(2));
		$data_input2 = explode("-", $this->uri->segment(3));
		// var_dump($data_input, $data_input2);
		// var_dump($data_input[1] . "-" . $data_input[0]);
		// die("end");
		// $dt_from = date_create_from_format('Y-m', $data_input[2] . "-" . $data_input[0]);
		$dt_from = date_create_from_format('Y-m', $data_input[1] . "-" . $data_input[0]);
		// $dt_to = date_create_from_format('Y-m', $data_input[2] . "-" . $data_input[1]);
		$dt_to = date_create_from_format('Y-m', $data_input2[1] . "-" . $data_input2[0]);
		$dtendz = (strtotime($dt_to->format('Y-m-t')) + (23 * 60 * 60)) + (59 * 60) + 59;
		$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$ddt = date('F d, Y', strtotime($dt_from->format('Y-m-1'))) . " - " . date('F d, Y', strtotime($dt_to->format('Y-m-t')));
		$data['mm_data'] = array('mall_name' => "Plaza Marcela", 'address' => "Corner Pamaong & Belderol Streets
		Cogon District Tagbilaran City Philippines", 'title' => "End of Day: Cashiers' Accountability Summary (CAS)", 'date_end' => $ddt, 'page_theme' => "Monthly Data Report");
		$result101 = array();
		// $userdata = $this->ReportViewModel->getUsersData($dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
		$gtotals['2-w'] = ['coupon' => 0, 'coupon_amt' => 0, 'trans_count' => 0, 'penalty' => 0, 'penalty1' => 0, 'lost_of_ticket' => 0];
		$gtotals['4-w'] = ['coupon' => 0, 'coupon_amt' => 0, 'trans_count' => 0, 'penalty' => 0, 'penalty1' => 0, 'lost_of_ticket' => 0];
		

		$userdata = $this->ReportViewModel->getMonths($dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));

		// var_dump($userdata);
		foreach ($userdata as $key => $valuex) {
			// var_dump($valuex['months']);
			$data_date = explode('-', $valuex['months']);
			if(strlen($data_date[0]) > 1):
				$final_month = $data_date[0];
			else:
			 	$final_month = '0'.$data_date[0];
			endif;
			// var_dump($data_date);
			// var_dump(strtotime($valuex['months']));
			// if ($valuex['user']) {
				// $inz = array('emp_id' => $valuex['user']);
				// $inz = array('DATE(dateTimeIn)' => date($data_date[1].'-'.$data_date[0]));
				// var_dump($final_month);
				// var_dump($inz);
				// $emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
				// $month = $this->AdminModel->months('tbl_syncdata', $inz);
				$month = $this->AdminModel->months(date($data_date[1].'-'.$final_month));
				// var_dump($month);

				$result2 = array();
				// $location = $this->ReportViewModel->getInchargeTransLocation($valuex['user'], $dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
				// $res = $this->ReportViewModel->getEndOfShiftData($valuex['user'], $dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
				// $res = $this->ReportViewModel->getEndOfShiftData2($dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
				$res = $this->ReportViewModel->getEndOfShiftData2(date($data_date[1].'-'.$final_month));
				foreach ($res as $key => $value) {
					if ($value['amount'] == 50) {
						$ww = '2-w';
					} else {
						$ww = '4-w';
					}
					// $trans_data = $this->ReportViewModel->getTransDataFromSync($value['user'], $dt_from->format('Y-m-1'),  date('Y-m-d H:i:s', $dtendz), $value['amount']);
					$trans_data = $this->ReportViewModel->getTransDataFromSync2(date($data_date[1].'-'.$final_month), $value['amount']);
					$result2[] = ['v_type' => $ww, 
					'coupon' => $value['coupon'], 
					'coupon_amt' => number_format($value['coupon_amount'], 2), 
					'trans_count' => $trans_data->trans_count, 
					'penalty' => number_format($trans_data->penalty, 2), 
					'penalty1' => number_format($trans_data->penalty1, 2),
					'lost_of_ticket' => number_format($trans_data->lost_of_ticket, 2)
					];

					$gtotals[$ww] = [
						'coupon' => floatval($gtotals[$ww]['coupon']) + floatval($value['coupon']),
						'coupon_amt' => floatval($gtotals[$ww]['coupon_amt']) + floatval($value['coupon_amount']),
						'trans_count' => floatval($gtotals[$ww]['trans_count']) + floatval($trans_data->trans_count),
						'penalty' => floatval($gtotals[$ww]['penalty']) + floatval($trans_data->penalty),
						'penalty1' => floatval($gtotals[$ww]['penalty1']) + floatval($trans_data->penalty1),
						'lost_of_ticket' => floatval($gtotals[$ww]['lost_of_ticket']) + floatval($trans_data->lost_of_ticket)
					];
				}
				$result3 = array();
				// $res2 = $this->ReportViewModel->getEndOfShiftDatavs2($valuex['user'], $dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
				$res2 = $this->ReportViewModel->getEndOfShiftDatavs3(date($data_date[1].'-'.$final_month));

				foreach ($res2 as $key => $value) {
					if ($value['user']) {
						// $trans_data = $this->ReportViewModel->getTransDataFromSyncvs2($value['user'], $dt_from->format('Y-m-1'),  date('Y-m-d H:i:s', $dtendz));
						$trans_data = $this->ReportViewModel->getTransDataFromSyncvs3(date($data_date[1].'-'.$final_month));
						$totz = $value['coupon_amount'] + $trans_data->penalty;
						$result3[] = ['coupon' => $value['coupon'], 
						'coupon_amt' => number_format($value['coupon_amount'], 2), 
						'trans_count' => $trans_data->trans_count, 
						'penalty' => number_format($trans_data->penalty, 2), 
						'penalty1' => number_format($trans_data->penalty1, 2), 
						'lost_of_ticket' => number_format($trans_data->lost_of_ticket, 2), 
						'tot_amt' => number_format($totz, 2)];

					}
				}
				$result101[] = ['month' => date('F, Y', strtotime($month->dateTimeout)), 'data_result' => $result2, 'data_result2' => $result3];
				// $result101[] = ['month' => date('Y-m-d', strtotime($month->dateTimeIn))];
				// $result101[] = NULL;
			// }
		}


		// foreach ($userdata as $key => $valuex) {
		// 	if ($valuex['user']) {
		// 		$inz = array('emp_id' => $valuex['user']);
		// 		$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);

		// 		$result2 = array();
		// 		$location = $this->ReportViewModel->getInchargeTransLocation($valuex['user'], $dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
		// 		$res = $this->ReportViewModel->getEndOfShiftData($valuex['user'], $dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
		// 		foreach ($res as $key => $value) {
		// 			if ($value['amount'] == 50) {
		// 				$ww = '2-w';
		// 			} else {
		// 				$ww = '4-w';
		// 			}
		// 			$trans_data = $this->ReportViewModel->getTransDataFromSync($value['user'], $dt_from->format('Y-m-1'),  date('Y-m-d H:i:s', $dtendz), $value['amount']);
		// 			$result2[] = ['v_type' => $ww, 'coupon' => $value['coupon'], 'coupon_amt' => number_format($value['coupon_amount'], 2), 'trans_count' => $trans_data->trans_count, 'penalty' => number_format($trans_data->penalty, 2)];
		// 			$gtotals[$ww] = [
		// 				'coupon' => floatval($gtotals[$ww]['coupon']) + floatval($value['coupon']),
		// 				'coupon_amt' => floatval($gtotals[$ww]['coupon_amt']) + floatval($value['coupon_amount']),
		// 				'trans_count' => floatval($gtotals[$ww]['trans_count']) + floatval($trans_data->trans_count),
		// 				'penalty' => floatval($gtotals[$ww]['penalty']) + floatval($trans_data->penalty)
		// 			];
		// 		}
		// 		$result3 = array();
		// 		$res2 = $this->ReportViewModel->getEndOfShiftDatavs2($valuex['user'], $dt_from->format('Y-m-1'), date('Y-m-d H:i:s', $dtendz));

		// 		foreach ($res2 as $key => $value) {
		// 			if ($value['user']) {
		// 				$trans_data = $this->ReportViewModel->getTransDataFromSyncvs2($value['user'], $dt_from->format('Y-m-1'),  date('Y-m-d H:i:s', $dtendz));
		// 				$totz = $value['coupon_amount'] + $trans_data->penalty;
		// 				$result3[] = ['coupon' => $value['coupon'], 'coupon_amt' => number_format($value['coupon_amount'], 2), 'trans_count' => $trans_data->trans_count, 'penalty' => number_format($trans_data->penalty, 2), 'tot_amt' => number_format($totz, 2)];
		// 			}
		// 		}
		// 		$result101[] = ['cashier' => $emp_data ? strtoupper($emp_data->name) : '', 'data_result' => $result2, 'data_result2' => $result3, 'location' => $location];
		// 	}
		// }
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['data_result101'] = $result101;
		$data['page_route'] = $this->uri->segment(1);
		$data['g_totals'] = $gtotals;
		$this->load->view('admin/reports/template/header', $data);
		$this->load->view('admin/reports/template/sidebar', $data);
		$this->load->view('admin/reports/report_monthly_data', $data);
		$this->load->view('admin/reports/template/footer', $data);
		$this->load->view('admin/reports/action/main_action');
		$this->load->view('admin/reports/action/report_monthly_data_action');
	}
}
