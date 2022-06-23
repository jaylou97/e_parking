<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('LoginModel');
	}
	// About
	public function About()
	{

		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		/*$result2 = array();
		$location = $this->AdminModel->getDatas('tbl_location');
		foreach ($location as $key => $value) {
			$dtendz = (strtotime(date('Y-m-d')) + (23 * 60 * 60)) + (59 * 60) + 59;
			$inx = array('trim(location)' => trim($value['location']), 'date(dateTimeIn) >=' => date('Y-m-d'), 'date(dateTimeIn) <=' => date('Y-m-d H:i:s', $dtendz));
			$amt = $this->AdminModel->getSum_data_from_tbl('tbl_syncdata', $inx);
			 $result2[] = ['location' => $value['location'], 'amount' => number_format($amt->amount, 2)];
		}*/
		$data['page_title'] = 'E-Parking System | About';
		// $data['location'] = $result2;
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/about/about', $data);
		$this->load->view('admin/template/footer');
		$this->load->view('admin/action/main_action', $data);
		// $this->load->view('admin/action/dashboard_action', $data);
	}
	public function dashboard_index()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Dashboard';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/template/footer');
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/dashboard_action', $data);
	}
	public function LogOut()
	{
		$array_data = array('name', 'usertype', 'profile_pic', 'logged_in');
		$this->session->unset_userdata($array_data);
		redirect('login2');
	}
	public function user_setup_admin()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
		$ins = array('status' => 1);
		$data['usertype'] = $this->AdminModel->getDatas_e_parking('tbl_usertype', $ins);
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
		$data['page_title'] = 'E-Parking System | User Setup';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar');
		$this->load->view('admin/user_setup', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/user_setup_action', $data);
	}
	public function getEmpNames_usersetup_admin()
	{
		$q = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('query')))));
		$ins = array('current_status' => 'Active');
		$data = $this->AdminModel->getEmpName_typehead('pis.employee3', $ins, $q);
		foreach ($data as $key => $value) {
			$result[] = ['id' => $value->emp_id, 'label' => $value->name, 'pass' => $value->emp_no];
		}
		echo json_encode($result);
	}
	public function save_user_admin()
	{
		$name_id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('name_id')))));
		$username = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('username')))));
		$password = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('password')))));
		$usertype = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('usertype')))));
		$insz = array('name' => $name_id);
		$num = $this->AdminModel->getNumData('tbl_user', $insz);
		if ($num > 0) {
			echo json_encode('Employee already have an account.');
		} else {
			$pp = '';
			if ($usertype == 'Admin') {
				$pp = 'user1.png';
			} else {
				$pp = 'userz.png';
			}
			$ins = array(
				'name' => $name_id,
				'username' => $username,
				'password' => md5($password),
				'usertype' => $usertype,
				'profile_pic' => $pp,
				'status' => 1
			);
			$res = $this->AdminModel->insert_data('tbl_user', $ins);
			if ($res == 'success') {
				echo json_encode('success');
			} else {
				echo json_encode('Oops, something went wrong...');
			}
		}
	}
	public function getUserlist_tbl_admin()
	{
		$result = array('data' => []);
		$data = $this->AdminModel->getDatas('tbl_user');
		foreach ($data as $key => $value) {
			$inz = array('emp_id' => $value['emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$inz2 = array('company_code' => $emp_data->company_code, 'bunit_code' => $emp_data->bunit_code);
			$bu_data = $this->AdminModel->getData_pis('pis.locate_business_unit', $inz2);
			$b_style = '';
			$stat = '';
			if ($value['status'] == 1) {
				$stat = 'Active';
				$b_style = 'btn-info';
			} else {
				$stat = 'Inactive';
				$b_style = 'btn-danger';
			}
			$btn = '<button type="button" class="btn btn-outline-info btn-sm btn-rounded" onclick="btn_view(\'' . $value['emp_id'] . '\', \'' . $value['usertype'] . '\')"><i class=" icon-camrecorder"></i></button>';
			$btn2 = '                                      
			<div class="btn-group">
			<button type="button" class="btn ' . $b_style . ' btn-sm">' . $stat . '</button>
			<button type="button" class="btn ' . $b_style . ' btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item btn" onclick="btn_action(\'' . "1" . '\', \'' . $value['user_id'] . '\', \'' . $value['usertype'] . '\')" style="color:#3399ff;">Active</a>
			<a class="dropdown-item btn" onclick="btn_action(\'' . "0" . '\', \'' . $value['user_id'] . '\', \'' . $value['usertype'] . '\')" style="color:red;">Inactive</a>
			</div>
			</div>';
			$dd = '';
			if ($value['usertype'] == 'Admin') {
				$dd = 'disabled';
			}
			$btn3 = '<button type="button" class="btn btn-success btn-sm" onclick="setup_location(\'' . $value['user_id'] . '\', \'' . $value['emp_id'] . '\')" ' . $dd . '><i class="icon-location-pin"></i></button>';
			$pp = '';
			$ins = array('app_id' => $value['emp_id']);
			$emp_pic = $this->AdminModel->getData_pis('pis.applicant', $ins);
			if ($emp_pic != NULL) {
				$pp = 'http://172.16.161.34:8080/hrms/employee/' . $emp_pic->photo . '';
			}
			$imgz = '<img src="' . $pp . '" alt="user" width="40" class="img-circle" style="margin-right:10px;">';
			$result['data'][] = [$imgz . $emp_data->name, $emp_data->position, $bu_data->business_unit, $value['usertype'], $btn, $btn2 . ' ' . $btn3];
		}
		$data = $this->AdminModel->getDatas('tbl_manager');
		foreach ($data as $key => $value) {
			$inz = array('emp_id' => $value['emp_id']);
			$emp_data = $this->AdminModel->getData_pis('pis.employee3', $inz);
			$inz2 = array('company_code' => $emp_data->company_code, 'bunit_code' => $emp_data->bunit_code);
			$bu_data = $this->AdminModel->getData_pis('pis.locate_business_unit', $inz2);
			$b_style = '';
			$stat = '';
			if ($value['status'] == 1) {
				$stat = 'Active';
				$b_style = 'btn-info';
			} else {
				$stat = 'Inactive';
				$b_style = 'btn-danger';
			}
			$btn = '<button type="button" class="btn btn-outline-info btn-sm btn-rounded" onclick="btn_view(\'' . $value['emp_id'] . '\', \'' . $value['usertype'] . '\')"><i class=" icon-camrecorder"></i></button>';
			$btn2 = '                                      
			<div class="btn-group">
			<button type="button" class="btn ' . $b_style . ' btn-sm">' . $stat . '</button>
			<button type="button" class="btn ' . $b_style . ' btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item btn" onclick="btn_action(\'' . "1" . '\', \'' . $value['manager_id'] . '\', \'' . $value['usertype'] . '\')" style="color:#3399ff;">Active</a>
			<a class="dropdown-item btn" onclick="btn_action(\'' . "0" . '\', \'' . $value['manager_id'] . '\', \'' . $value['usertype'] . '\')" style="color:red;">Inactive</a>
			</div>
			</div>';
			$dd = '';
			if ($value['usertype'] == 'Manager') {
				$dd = 'disabled';
			}
			$btn3 = '<button type="button" class="btn btn-success btn-sm" onclick="setup_location(\'' . $value['manager_id'] . '\', \'' . $value['emp_id'] . '\')" ' . $dd . '><i class="icon-location-pin"></i></button>';
			$pp = '';
			$ins = array('app_id' => $value['emp_id']);
			$emp_pic = $this->AdminModel->getData_pis('pis.applicant', $ins);
			if ($emp_pic != NULL) {
				$pp = 'http://172.16.161.34:8080/hrms/employee/' . $emp_pic->photo . '';
			}
			$imgz = '<img src="' . $pp . '" alt="user" width="40" class="img-circle" style="margin-right:10px;">';
			$result['data'][] = [$imgz . $emp_data->name, $emp_data->position, $bu_data->business_unit, $value['usertype'], $btn, $btn2 . ' ' . $btn3];
		}
		echo json_encode($result);
	}
	public function update_user_stat_admin()
	{
		$ut  = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('ut')))));
		$x  = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('x')))));
		$id  = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('id')))));
		$ins_update = array('status' => $x);

		if ($ut == 'Manager') {
			$ins = array('manager_id' => $id);
			$res = $this->AdminModel->update_data('tbl_manager', $ins_update, $ins);
		} else {
			$ins = array('user_id' => $id);
			$res = $this->AdminModel->update_data('tbl_user', $ins_update, $ins);
		}
		if ($res == 'success') {
			echo json_encode($res);
		} else {
			echo json_encode('Oops, something went wrong...');
		}
	}
	public function getuser_info_admin()
	{
		$ut = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('ut')))));
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('id')))));
		$ins = array('emp_id' => $id);
		$ins2 = array('emp_id' => $id);
		$emp = $this->AdminModel->getData_pis('pis.employee3', $ins);
		if (trim($ut) == 'Manager') {
			$user_data = $this->AdminModel->getData_e_parking('tbl_manager', $ins2);
		} else {
			$user_data = $this->AdminModel->getData_e_parking('tbl_user', $ins2);
		}
		$pp = '';
		$ins = array('app_id' => $id);
		$emp_pic = $this->AdminModel->getData_pis('pis.applicant', $ins);
		if ($emp_pic != NULL) {
			$pp = 'http://172.16.161.34:8080/hrms/employee/' . $emp_pic->photo . '';
		}
		$inzert = array('company_code' => $emp->company_code, 'bunit_code' => $emp->bunit_code, 'dept_code' => $emp->dept_code);
		$department = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$result[] = ['emp_no' => $emp->emp_no, 'emp_id' => $emp->emp_id, 'payroll_no' => $emp->payroll_no, 'name' => $emp->name, 'emp_type' => $emp->emp_type, 'position' => $emp->position, 'current_status' => $emp->current_status, 'profile_pic' => $pp, 'department' => $department->dept_name];
		echo json_encode($result);
	}
	public function coupon_list()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Coupon List';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/report_coupon_list', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/coupon_list_action', $data);
	}
	public function ticket_list()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Ticket List';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/report_ticket_list', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/ticket_list_action', $data);
	}
	public function billing_statement()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Billing Statement';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/report_billing_statement', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/billing_statement_action', $data);
	}
	public function collection()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Collection';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/report_collection', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/collection_action', $data);
	}
	public function overall_collection()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Overall Collection';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/report_overall_collection', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/overall_collection_action', $data);
	}
	public function vehicle_monitoring()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Vehicle Monitoring';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/report_vehicle_monitoring', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/vehicle_monitoring_action', $data);
	}
	public function parking_log()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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

		
	    /*$data['page_title2'] = '<h2><center>Plaza Marcela</center></h2>
		<center>Corner Pamaong & Belderol Street
    	Cogon District Tagbilaran City Philippines <br></center>
    	<h3><center>Parking Logbook</center><h3><br>';*/
    	$data['page_title'] = 'E-Parking System | Parking Log';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/parking_log', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/parking_log_action', $data);
	}
	public function change_username()
	{
		$id = $this->session->userdata('user_id');
		$user = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('user')))));
		$ins = array('username' => $user);
		$ins_id = array('user_id' => $id);
		$num = $this->AdminModel->getNumData('tbl_user', $ins);
		if ($num > 0) {
			echo "duplicate";
		} else {
			$res = $this->AdminModel->update_data('tbl_user', $ins, $ins_id);
			if ($res == 'success') {
				echo "success";
			} else {
				echo "Oops, something went wrong...";
			}
		}
	}
	public function change_password()
	{
		$id = $this->session->userdata('user_id');
		$paz  = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('paz')))));
		$op  = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('op')))));
		$np  = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('np')))));
		if ($paz != md5($op)) {
			echo "error";
		} else {

			$ins = array('password' => md5($np));
			$ins_id = array('user_id' => $id);
			$res = $this->AdminModel->update_data('tbl_user', $ins, $ins_id);
			if ($res == 'success') {
				echo "success";
			} else {
				echo "Oops, something went wrong...";
			}
		}
	}
	public function save_user_pp()
	{
		$config['upload_path'] =	 FCPATH . "assets/images/profile/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '5048000';
		$config['max_width'] = '5000';
		$config['max_height'] = '5000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$error = $this->upload->display_errors();
			echo $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			$image = $_FILES['userfile']['name'];
			$id = $this->session->userdata('user_id');
			$prof_insert = array('profile_pic' => $image);
			$ins = array('user_id' => $id);
			$res = $this->AdminModel->update_data('tbl_user', $prof_insert, $ins);
			if ($res == 'success') {
				$this->session->unset_userdata('profile_pic');
				$set_pp = array('profile_pic' => $image);
				$this->session->set_userdata($set_pp);
				echo "success";
			} else {
				echo "Oops, something went wrong...";
			}
		}
	}
	public function location_setup_admin()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Location Setup';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/location_setup', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/location_setup_action', $data);
	}
	public function add_location_admin()
	{
		$loc = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('location')))));
		$loc_add = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('location_address')))));
		$count_data = $this->AdminModel->count_row('tbl_location');
		if ($count_data >= 5) {
			echo json_encode('Data input has been reach the limit of 5 data entries only.');
		} else {
			$inzx = array('location' => ucwords($loc), 'location_address' => ucwords($loc_add));
			$numz = $this->AdminModel->count_row('tbl_location', $inzx);
			if ($numz > 0) {
				echo json_encode('Data is already exist...');
			} else {
				$ins = array('location' => ucwords($loc), 'location_address' => ucwords($loc_add), 'status' => 1);
				$result = $this->AdminModel->insert_data('tbl_location', $ins);
				if ($result == 'success') {
					echo json_encode($result);
				} else {
					echo json_encode('Oops, something went wrong...');
				}
			}
		}
	}
	public function getLocationData()
	{
		$result = array('data' => []);
		$dataz = $this->AdminModel->getDatas('tbl_location');
		foreach ($dataz as $key => $value) {
			$b_style = '';
			$stat = '';
			if ($value['status'] == 1) {
				$stat = 'Active';
				$b_style = 'btn-info';
			} else {
				$stat = 'Inactive';
				$b_style = 'btn-danger';
			}
			$btn2 = '                                      
			<div class="btn-group">
			<button type="button" class="btn ' . $b_style . ' btn-sm">' . $stat . '</button>
			<button type="button" class="btn ' . $b_style . ' btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item btn" onclick="btn_action(\'' . "1" . '\', \'' . $value['location_id'] . '\')" style="color:#3399ff;">Active</a>
			<a class="dropdown-item btn" onclick="btn_action(\'' . "0" . '\', \'' . $value['location_id'] . '\')" style="color:red;">Inactive</a>
			</div>
			</div>';
			$btn = '<button type="button" class="btn waves-effect waves-light btn-sm btn-success" onclick="edit_location(\'' . $value['location_id'] . '\', \'' . $value['location'] . '\', \'' . $value['location_address'] . '\')"><i class="icon-pencil"></i></button>';
			$result['data'][] = [$value['location'], $value['location_address'], $btn2 . ' ' . $btn];
		}
		echo json_encode($result);
	}
	public function edit_location_admin()
	{
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('id')))));
		$loc = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('location')))));
		$loc_add = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('location_address')))));
		$ins = array('location' => ucwords($loc), 'location_address' => ucwords($loc_add));
		$numz = $this->AdminModel->getData_num('tbl_location', $ins);
		if ($numz > 0) {
			echo json_encode("Data is already exist/doesn't change...");
		} else {
			$ins_id = array('location_id' => $id);
			$ins_loc = array('location' => ucwords($loc), 'location_address' => ucwords($loc_add));
			$result = $this->AdminModel->update_data('tbl_location', $ins_loc, $ins_id);
			if ($result == 'success') {
				echo json_encode($result);
			} else {
				echo json_encode('Oops, something went wrong...');
			}
		}
	}
	public function activate_location_admin()
	{
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('id')))));
		$par = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('par')))));

		$ins = array('status' => $par);
		$ins_id = array('location_id' => $id);
		$result = $this->AdminModel->update_data('tbl_location', $ins, $ins_id);
		if ($result == 'success') {
			if ($par == 1) {
				echo 'Location is successfully Activate';
			} else {
				echo 'Location is successfully Inactivate';
			}
		} else {
			echo 'error';
		}
	}
	public function get_emp_location()
	{
		$result = array('data' => []);
		$id = $this->uri->segment(2);
		$ins = array('user_id' => $id);
		$data = $this->AdminModel->getDatas_e_parking('tbl_location_user', $ins);
		foreach ($data as $key => $value) {
			$ins2 = array('location_id' => $value['location_id']);
			$ll = $this->AdminModel->getData_e_parking('tbl_location', $ins2);
			$btn = '<button class="btn btn-sm btn-danger" onclick="delete_loc(\'' . $value['loc_user_id'] . '\')"><i class=" icon-trash"></i></button>';
			$result['data'][] = [$ll->location, $btn];
		}
		echo json_encode($result);
	}
	public function set_emp_location()
	{
		$result = array('data' => []);
		$id = $this->uri->segment(2);
		$ins = array('status' => 1);
		$data = $this->AdminModel->getDatas_e_parking('tbl_location', $ins);
		foreach ($data as $key => $value) {
			$ins2 = array('user_id' => $id, 'location_id' => $value['location_id']);
			$num = $this->AdminModel->getNumData('tbl_location_user', $ins2);
			$gg = '';
			if ($num > 0) {
				$gg = 'checked disabled';
			}
			$cc = '<input type="checkbox" name="check_box" class="check_box" id="check_box' . $value['location_id'] . '" value="' . $value['location_id'] . '" onclick="showDSinput(' . $value['location_id'] . ')" ' . $gg . '> ';
			$result['data'][] = [$cc, $value['location']];
		}
		echo json_encode($result);
	}
	public function SetupUserLocationz()
	{
		$x = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('x')))));
		$uid = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('uid')))));
		$eid = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('eid')))));
		$ins = array('user_id' => $uid, 'location_id' => $x, 'emp_id' => $eid);
		$num = $this->AdminModel->getNumData('tbl_location_user', $ins);
		if ($num > 0) {
			echo json_encode('error2');
		} else {
			$res = $this->AdminModel->insert_data('tbl_location_user', $ins);
			if ($res == 'success') {
				echo json_encode('Location successfully setup.');
			} else {
				echo json_encode('error');
			}
		}
	}
	public function delete_loc_user()
	{
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('id')))));
		$ins = array('loc_user_id' => $id);
		$res = $this->AdminModel->deletedata('tbl_location_user', $ins);
		if ($res == 'success') {
			echo json_encode($res);
		} else {
			echo json_encode('Oops, something went wrong...');
		}
	}
	public function save_user_adminv2()
	{
		$name = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('hiddenInputElement')))));
		$username = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('username')))));
		$password = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('password')))));
		$usertype = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('usertype')))));
		if ($name == '' || $username == '' || $password == '' || $usertype == '') {
			echo json_encode('error1');
		} else {
			if (trim($usertype) == 'Manager') {
				$insz = array('emp_id' => $name);
				$num = $this->AdminModel->getNumData('tbl_manager', $insz);
				if ($num > 0) {
					echo json_encode('Employee Already Exist');
				} else {
					$numz = $this->AdminModel->getNumData('tbl_user', $insz);
					if ($numz > 0) {
						echo json_encode('Employee Already Exist');
					} else {
						$inzert = array('username' => $username, 'password' => md5($password));
						$numv2 = $this->AdminModel->getNumData('tbl_manager', $inzert);
						if ($numv2 > 0) {
							echo json_encode('error2');
						} else {
							$ins = array(
								'emp_id' => $name,
								'username' => $username,
								'password' => md5($password),
								'usertype' => $usertype,
								'status' => 1
							);
							$res = $this->AdminModel->insert_data('tbl_manager', $ins);
							if ($res == 'success') {
								echo json_encode($res);
							} else {
								echo json_encode("Oops, something went wrong...");
							}
						}
					}
				}
			} else {
				$insz = array('emp_id' => $name);
				$num = $this->AdminModel->getNumData('tbl_user', $insz);
				if ($num > 0) {
					echo json_encode('Employee Already Exist');
				} else {
					$numz = $this->AdminModel->getNumData('tbl_manager', $insz);
					if ($numz > 0) {
						echo json_encode('Employee Already Exist');
					} else {
						$inzert = array('username' => $username, 'password' => md5($password));
						$numv2 = $this->AdminModel->getNumData('tbl_user', $inzert);
						if ($numv2 > 0) {
							echo json_encode('error2');
						} else {
							$ins = array(
								'emp_id' => $name,
								'username' => $username,
								'password' => md5($password),
								'usertype' => $usertype,
								'status' => 1
							);
							$res = $this->AdminModel->insert_data('tbl_user', $ins);
							if ($res == 'success') {
								echo json_encode($res);
							} else {
								echo json_encode("Oops, something went wrong...");
							}
						}
					}
				}
			}
		}
	}
	public function get_daily_trans()
	{
		$result = array('data' => []);
		date_default_timezone_set('Asia/Manila');
		$dtendz = (strtotime(date('Y-m-d')) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateTimeIn >=' => date('Y-m-d'), 'dateTimeIn <=' => date('Y-m-d H:i:s', $dtendz));
		$data = $this->AdminModel->getDatas_e_parking('tbl_syncdata', $ins);

		foreach ($data as $key => $value) {
			$inz  = array('emp_id' => $value['user']);
			$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);
				/*jay code*/
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}

			$timeout = $value['dateTimeout'];
			if ($value['status'] == 0 || $value['remarks'] == 'PAID') 
			{
				if($value['penalty'] == 0 && $value['penalty1'] == 0 && $value['lost_of_ticket'] == 0)
				{
					$status = 'FREE';
					
					$result['data'][] = [date('M-d-Y g:i:s A', strtotime($value['dateTimeIn'])), date('M-d-Y g:i:s A', strtotime($timeout)), $nn->name, $value['location'], $value['plateNumber'], $ww, $status];
				}
				else
				{
					$status = 'PAID';

					$result['data'][] = [date('M-d-Y g:i:s A', strtotime($value['dateTimeIn'])), date('M-d-Y g:i:s A', strtotime($timeout)), $nn->name, $value['location'], $value['plateNumber'], $ww, $status];
				}
			} 
			else 
			{
				$status = 'UNPAID';
				$timeout = 'NO TIME OUT';

			$result['data'][] = [date('M-d-Y g:i:s A', strtotime($value['dateTimeIn'])), $timeout, $nn->name, $value['location'], $value['plateNumber'], $ww, $status];
			}
				/*end jay code*/
		}
		echo json_encode($result);
	}
	public function get_daily_trans_2()
	{
		$result = array('data' => []);
		$dt = $this->uri->segment(2);
		$dt2 = $this->uri->segment(3);
		$dtendz = (strtotime($dt2) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateTimeIn >=' => $dt, 'dateTimeIn <=' => date('Y-m-d H:i:s', $dtendz));
		$data = $this->AdminModel->getDatas_e_parking('tbl_syncdata', $ins);

		foreach ($data as $key => $value) {
			$inz  = array('emp_id' => $value['user']);
			$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);
				/*jay code*/
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}

			$timeout = $value['dateTimeout'];
			if ($value['status'] == 0 || $value['remarks'] == 'PAID') 
			{
				if($value['penalty'] == 0 && $value['penalty1'] == 0 && $value['lost_of_ticket'] == 0)
				{
					$status = 'FREE';

					$result['data'][] = [date('M-d-Y g:i:s A', strtotime($value['dateTimeIn'])), date('M-d-Y g:i:s A', strtotime($timeout)), $nn->name, $value['location'], $value['plateNumber'], $ww, $status];
				}
				else
				{
					$status = 'PAID';

					$result['data'][] = [date('M-d-Y g:i:s A', strtotime($value['dateTimeIn'])), date('M-d-Y g:i:s A', strtotime($timeout)), $nn->name, $value['location'], $value['plateNumber'], $ww, $status];
				}

			} 
			else 
			{
				$status = 'UNPAID';
				$timeout = 'NO TIME OUT';

			$result['data'][] = [date('M-d-Y g:i:s A', strtotime($value['dateTimeIn'])), $timeout, $nn->name, $value['location'], $value['plateNumber'], $ww, $status];
			}
				/*end jay code*/
			
		}
		echo json_encode($result);
	}
	public function get_ticket_list_data()
	{
		date_default_timezone_set('Asia/Manila');
		$result = array('data' => []);
		$dt = array('dateToday' => date('Y-m-d'));
		$data = $this->AdminModel->getDatas_e_parking('tbl_transactions', $dt);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$result['data'][] = [date('M-d-Y', strtotime($value['dateToday'])), $user->name, $value['location'], sprintf('%06d', $value['id']), $value['plateNumber'], $ww, number_format($value['amount'], 2)];
		}
		echo json_encode($result);
	}
	public function get_coupon_list_data()
	{
		date_default_timezone_set('Asia/Manila');
		$result = array('data' => []);
		$dt = array('dateToday' => date('Y-m-d'));
		$data = $this->AdminModel->getDatas_e_parking('tbl_transactions', $dt);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$result['data'][] = [date('M-d-Y', strtotime($value['dateToday'])), $user->name, $value['location'], sprintf('%06d', $value['id']), $value['plateNumber'], $ww, number_format($value['amount'], 2), date('M-d-Y', strtotime($value['dateUntil']))];
		}
		echo json_encode($result);
	}
	public function get_v_monitoring_list_data()
	{
		date_default_timezone_set('Asia/Manila');
		$result = array('data' => []);
		$dt = date('Y-m-d');
		$data = $this->AdminModel->get_data_for_v_monitoring($dt);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			$ins_data = array('amount' => 50, 'user' => $value['user'], 'dateToday' => $dt);
			$twow = $this->AdminModel->getData_num('tbl_transactions', $ins_data);
			$ins_data2 = array('amount' => 100, 'user' => $value['user'], 'dateToday' => $dt);
			$fourw = $this->AdminModel->getData_num('tbl_transactions', $ins_data2);
			$result['data'][] = [date('M-d-Y', strtotime($value['dateToday'])), $user->name, $value['location'], $twow, $fourw];
		}
		echo json_encode($result);
	}
	public function genTicketDataByList()
	{
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$result = array('data' => []);
		$dt = array('dateToday >=' => $dtstart, 'dateToday <=' => $dtend);
		$data = $this->AdminModel->getDatas_e_parking('tbl_transactions', $dt);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$result['data'][] = [date('M-d-Y', strtotime($value['dateToday'])), $user->name, $value['location'], sprintf('%06d', $value['id']), $value['plateNumber'], $ww, number_format($value['amount'], 2)];
		}
		echo json_encode($result);
	}

	public function genCouponDataByList()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dt = array('dateToday >=' => $dtstart, 'dateToday <=' => $dtend);
		$data = $this->AdminModel->getDatas_e_parking('tbl_transactions', $dt);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$result['data'][] = [date('M-d-Y', strtotime($value['dateToday'])), $user->name, $value['location'], sprintf('%06d', $value['id']), $value['plateNumber'], $ww, number_format($value['amount'], 2), date('M-d-Y', strtotime($value['dateUntil']))];
		}
		echo json_encode($result);
	}
	public function gen_v_monitoring_data()
	{
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$result = array('data' => []);
		$data101 = $this->AdminModel->get_data_for_vs2_monitoring($dtstart, $dtend);
		foreach ($data101 as $key => $valuez) {
			$data = $this->AdminModel->get_data_for_v_monitoring($valuez['dateToday']);
			foreach ($data as $key => $value) {
				$ins = array('emp_id' => $value['user']);
				$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
				$ins_data = array('amount' => 50, 'user' => $value['user'], 'dateToday' => $value['dateToday']);
				$twow = $this->AdminModel->getData_num('tbl_transactions', $ins_data);
				$ins_data2 = array('amount' => 100, 'user' => $value['user'], 'dateToday' => $value['dateToday']);
				$fourw = $this->AdminModel->getData_num('tbl_transactions', $ins_data2);
				$result['data'][] = [date('M-d-Y', strtotime($value['dateToday'])), $user->name, $value['location'], $twow, $fourw];
			}
		}

		echo json_encode($result);
	}
	public function get_billing_statement_data()
	{
		date_default_timezone_set('Asia/Manila');
		$result = array('data' => []);
		$dt = date('Y-m-d');
		$dtend = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateTimeIn >=' => $dt, 'dateTimeIn <=' => date('Y-m-d H:i:s', $dtend));
		$data = $this->AdminModel->getDatas_e_parking('tbl_syncdata', $ins);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$start_t = new DateTime($value['dateTimeIn']);
			$current_t = new DateTime($value['dateTimeout']);
			$difference = $start_t->diff($current_t);
			$return_time = $difference->format('%d | %H:%I:%S');
			$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeIn'])), $user->name, $value['location'], $value['plateNumber'], $ww, $return_time, number_format($value['penalty'], 2)];
		}
		echo json_encode($result);
	}
	public function get_billing_statement_datavs2()
	{
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dt = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$result = array('data' => []);
		$ins = array('dateTimeIn >=' => $dtstart, 'dateTimeIn <=' => date('Y-m-d H:i:s', $dt));
		$data = $this->AdminModel->getDatas_e_parking('tbl_syncdata', $ins);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$start_t = new DateTime($value['dateTimeIn']);
			$current_t = new DateTime($value['dateTimeout']);
			$difference = $start_t->diff($current_t);
			$return_time = $difference->format('%d | %H:%I:%S');
			$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeIn'])), $user->name, $value['location'], $value['plateNumber'], $ww, $return_time, number_format($value['penalty'], 2)];
		}
		echo json_encode($result);
	}
	public function get_collection_list_data()
	{
		$result = array('data' => []);
		date_default_timezone_set('Asia/Manila');
		$dt = date('Y-m-d');
		$dtend = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->getCollectionData($dt, date('Y-m-d H:i:s', $dtend));
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['outby']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			$tot_amt = $value['amount'] + $value['penalty'];
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_collection_list(\'' . $dt . '\',\'' . date('Y-m-d H:i:s', $dtend) . '\',\'' . $value['outby'] . '\')">View</button>';
			$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeout'])), $user->name, $value['location'], number_format($tot_amt, 2), $btn];
		}
		echo json_encode($result);
	}
	public function get_collection_list_datavs2()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtv2 = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$datavs2 = $this->AdminModel->getDatacollectionByDates($dtstart,  date('Y-m-d H:i:s', $dtv2));
		foreach ($datavs2 as $key => $valuez) {
			$dtendz = (strtotime($valuez['DateField']) + (23 * 60 * 60)) + (59 * 60) + 59;
			$data = $this->AdminModel->getCollectionData($valuez['DateField'], date('Y-m-d H:i:s', $dtendz));
			foreach ($data as $key => $value) {
				$ins = array('emp_id' => $value['outby']);
				$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
				$tot_amt = $value['amount'] + $value['penalty'];
				$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_collection_list(\'' . $valuez['DateField'] . '\',\'' . date('Y-m-d H:i:s', $dtendz) . '\',\'' . $value['outby'] . '\')">View</button>';

				$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeout'])), $user->name, $value['location'], number_format($tot_amt, 2), $btn];
			}
		}
		echo json_encode($result);
	}
	public function get_overallcollection_list_data()
	{
		$result = array('data' => []);
		date_default_timezone_set('Asia/Manila');
		$dt = date('Y-m-d');
		$dtend = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->getCollectionData($dt, date('Y-m-d H:i:s', $dtend));
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['outby']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			$tot_amt = $value['amount'] + $value['penalty'];
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_collection_list(\'' . $dt . '\',\'' . date('Y-m-d H:i:s', $dtend) . '\',\'' . $value['outby'] . '\')">View</button>';
			$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeout'])), $user->name, $value['location'], number_format($value['amount'], 2), number_format($value['penalty'], 2), number_format($tot_amt, 2), $btn];
		}
		echo json_encode($result);
	}
	public function get_overallcollection_list_datavs2()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtv2 = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$datavs2 = $this->AdminModel->getDatacollectionByDates($dtstart,  date('Y-m-d H:i:s', $dtv2));
		foreach ($datavs2 as $key => $valuez) {
			$dtendz = (strtotime($valuez['DateField']) + (23 * 60 * 60)) + (59 * 60) + 59;
			$data = $this->AdminModel->getCollectionData($valuez['DateField'], date('Y-m-d H:i:s', $dtendz));
			foreach ($data as $key => $value) {
				$ins = array('emp_id' => $value['outby']);
				$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
				$tot_amt = $value['amount'] + $value['penalty'];
				$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_collection_list(\'' . $valuez['DateField'] . '\',\'' . date('Y-m-d H:i:s', $dtendz) . '\',\'' . $value['outby'] . '\')">View</button>';
				$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeout'])), $user->name, $value['location'], number_format($value['amount'], 2), number_format($value['penalty'], 2), number_format($tot_amt, 2), $btn];
			}
		}
		echo json_encode($result);
	}

	public function end_of_shift_report()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | End Of Shift Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/end_of_shift', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/end_of_shift_action', $data);
	}
	public function end_of_day_report()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | End Of Day Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/end_of_day', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/end_of_day_action', $data);
	}
	public function daily_statistics_report()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Daily Statistics Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/daily_statistics_report', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/daily_statistics_report_action', $data);
	}
	public function weekly_statistics_report()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Weekly Statistics Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/weekly_statistics_report', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/weekly_statistics_report_action', $data);
	}
	public function monthly_statistics_report()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Monthly Statistics Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/monthly_statistics_report', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/monthly_statistics_report_action', $data);
	}
	public function black_listed_report()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$dtfrom = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtto = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtto) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data['page_title'] = 'Blacklisted Report';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/black_listed', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/black_listed_action', $data);
	}

	public function get_blacklist_data()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_blacklist3($dtstart, $dtend);
		$i = 1;
		foreach ($data as $key => $var) {
			$id = $var['id'];
			$uid = $var['uid'];
			$pn = $var['plateNumber'];
			$dn = $var['dateTimeIn'];
			$dt = $var['dateEscaped'];
			$tid = $var['uid']; 
			$totalhrs = $var['totalHrs']; 
			$excesshrs = $var['excessHrs']; 
			$pen = number_format($var['penaltyA'], 2);
			$totC = number_format($var['totCharge'], 2);
			$totAmt = number_format($var['totalAmt'], 2);
			$checkDigit = $var['checkDigit'];
			if ($var['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}

			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="viewmodal_blacklisted_js('.trim($id).')">View</button>';

			$result['data'][] = [$i++, 
				$pn, 
				$ww, 
				date('M-d-Y g:i A', strtotime($dn)), 
				date('M-d-Y', strtotime($dt)),
				$checkDigit,
				$tid,
				$totalhrs,
				$excesshrs,
				$pen,
				$totC,
				$totAmt,
				$btn
				];
		}
		echo json_encode($result);
	}


					/*jay code*/

	public function get_blacklisted_adminctrl()
	{
		$id=$this->input->get('id');
		 $query=$this->AdminModel->get_blaclisted_admodel($id);

    	  $html="";
    	  foreach ($query as $q)
    	   {

    	   	if ($q['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
					echo '
					        <div class="col-sm-6 form-inline">
                                <div class="col-sm-6">
                                    <label>Plate Number</label>
                                     <input disabled="true" type="text" id="platenumber" value=" '.$q['plateNumber'].' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Vehicle Type</label>
                                     <input disabled="true" type="text" id="vehicletype" value=" '.$ww.' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date Time In</label>
                                     <input disabled="true" type="text" id="timein" value=" '.$q['dateTimeIn'].' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date Escaped</label>
                                     <input disabled="true" type="text" id="dateescaped" value=" '.date('M-d-Y', strtotime($q['dateEscaped'])).' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Ticket No.</label>
                                     <input disabled="true" type="text" id="ticketno" value=" '.$q['checkDigit'].' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Transaction No.</label>
                                     <input disabled="true" type="text" id="transactionno" value=" '.$q['uid'].' ">
                                </div>
                            </div>

                            <div class="col-sm-6 form-inline">
                                 <div class="col-sm-6">
                                    <label>Total Hours</label>
                                     <input disabled="true" type="text" id="totalhrs" value=" '.$q['totalHrs'].' ">
                                </div>
                                 <div class="col-sm-6">
                                    <label>Excess Hours</label>
                                     <input disabled="true" type="text" id="excesshrs" value=" '.$q['excessHrs'].' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Charge Amount</label>
                                     <input disabled="true" type="text" id="chargeamount" value=" '.number_format($q['totCharge'], 2).' ">
                                </div>
                                <div class="col-sm-6">
                                    <label>Penalty</label>
                                     <input disabled="true" type="text" id="penalty" value=" '.number_format($q['penaltyA'], 2).' ">
                                </div>
                                <div class="col-sm-6" id="div_totamount">
                                    <label>Total Amount</label>
                                     <input disabled="true" type="text" id="totalamount" value=" '.number_format($q['totalAmt'], 2).' ">
                                </div>
                             </div>
                        ';
    	  }
	}

	public function unblock_adminctrl()
	{
		$unblock=array("success");
		$this->AdminModel->unblock_model($_POST['uid'],$_POST['status'],$_POST['datepaid']);	

		echo json_encode($unblock);
	}

	public function admin_unblock_report_ctrl()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$dtfrom = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtto = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtto) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data['page_title'] = 'Unblock Report';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/unblock_list', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/unblock_list_action', $data);
	}

	public function loginlogout_history_ctrl()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$dtfrom = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtto = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtto) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data['page_title'] = 'Parking Attendant Login/Logout History';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/loginlogout_history', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/loginlogout_history_action', $data);
	}

	public function get_unblock_data_ctrl()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_unblocklist_model($dtstart, $dtend);
		$i = 1;
		foreach ($data as $key => $var) {

		$inz  = array('emp_id' => $var['outby']);
		$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);

			//$userid = $var['user'];
			$pn = $var['plateNumber'];
			$dn = $var['dateTimeIn'];
			$de = $var['dateEscaped'];
			$dp = $var['date_paid'];
			$tid = $var['uid']; 
			$totalhrs = $var['totalHrs']; 
			$excesshrs = $var['excessHrs']; 
			$pen = number_format($var['penaltyA'], 2);
			$totC = number_format($var['totCharge'], 2);
			$totAmt = number_format($var['totalAmt'], 2);
			$checkDigit = $var['checkDigit'];
			if ($var['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}

			$result['data'][] = [$i++, 
				$nn->name, 
				$pn, 
				$ww, 
				date('M-d-Y g:i A', strtotime($dn)), 
				date('M-d-Y', strtotime($de)),
				$checkDigit,
				$tid,
				$totalhrs,
				$excesshrs,
				$pen,
				$totC,
				$totAmt,
				date('M-d-Y g:i A', strtotime($dp))
				];
		}
		echo json_encode($result);
	}

	public function get_loginlogout_data_ctrl()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_loginlogoutlist_model($dtstart, date('Y-m-d H:i:s', $dtendz));
		$i = 1;

		foreach ($data as $key => $var) {

		$inz  = array('emp_id' => $var['emp_id']);
		$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);

			$di = $var['datelogin'];
			if ($var['status'] == 0) {
				$st = 'PENDING';
			} else {
				$st = 'LOGOUT';
			}

			if ($var['datelogout'] == '0000-00-00 00:00:00') {
				$do = 'PENDING';
			} else {
				$do = date('M-d-Y g:i A', strtotime($var['datelogout']));
			}
		
			$result['data'][] = [$i++, 
				$nn->name,
				date('M-d-Y g:i A', strtotime($di)),
				$do,
				$st
				];
		}
		echo json_encode($result);
	}

	public function getprint_unblockdata_ctrl()
	{
		$result = array();
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->getprint_unblockdata_model($dtstart, date('Y-m-d H:i:s', $dtendz));
		$i = 1;
		foreach ($data as $key => $var) {

		$inz  = array('emp_id' => $var['outby']);
		$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);

			if ($var['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}

			$result[] = ['num' => $i++, 
			'outby' => $nn->name, 
			'plateNumber' => $var['plateNumber'], 
			'v_type' => $ww, 
			'time_date_in' =>  date('M-d-Y g:i A', strtotime($var['dateTimeIn'])), 
			'date_listed' => date('M-d-Y', strtotime($var['dateEscaped'])), 
			'ticket_num' =>  $var['checkDigit'], 
			'trans_num' => $var['uid'], 
			'totalHrs' => $var['totalHrs'], 
			'excessHrs' => $var['excessHrs'], 
			'penaltyA' => number_format($var['penaltyA'], 2), 
			'totCharge' => number_format($var['totCharge'], 2), 
			'totalAmt' => number_format($var['totalAmt'], 2), 
			'date_paid' =>  date('M-d-Y g:i A', strtotime($var['date_paid'])) 
			];
		}
		echo json_encode($result);
	}

	public function getprint_loginlogout_ctrl()
	{
		$result = array();
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->getprint_loginlogout_model($dtstart, date('Y-m-d H:i:s', $dtendz));
		$i = 1;
		foreach ($data as $key => $var) {

		$inz  = array('emp_id' => $var['emp_id']);
		$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);

			if ($var['status'] == 0) {
				$st = 'PENDING';
			} else {
				$st = 'LOGOUT';
			}

			if ($var['datelogout'] == '0000-00-00 00:00:00') {
				$do = 'PENDING';
			} else {
				$do = date('M-d-Y g:i A', strtotime($var['datelogout']));
			}

			$result[] = ['num' => $i++, 
			'emp_id' => $nn->name,
			'login' =>  date('M-d-Y g:i A', strtotime($var['datelogin'])), 
			'logout' => $do, 
			'status' =>  $st
			];
		}
		echo json_encode($result);
	}

	public function count_unblocklist_ctrl()
	{
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('date_paid >=' => $dtstart, 'date_paid <=' => date('Y-m-d H:i:s', $dtendz));
		$num = $this->AdminModel->getData_num('tbl_delinquent', $ins);
		if ($num > 0) {
			echo "success";
		} else {
			echo "none";
		}
	}

	public function count_loginlogoutlist_ctrl()
	{
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('datelogin >=' => $dtstart, 'datelogin <=' => date('Y-m-d H:i:s', $dtendz));
		$num = $this->AdminModel->getData_num('tbl_login_data', $ins);
		if ($num > 0) {
			echo "success";
		} else {
			echo "none";
		}
	}

	public function remittance_ctrl()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Remittance';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/remittance', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/remittance_action', $data);
	}

	public function display_remittance_incharge_ctrl()
	{
		$result = array('data' => []);
		$ins2 = array('usertype' => 'Parking Attendant');
		$data = $this->AdminModel->getDatas_e_parking('tbl_user', $ins2);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['emp_id']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			$stat = '';
			$id = $value['user_id'];

			if ($value['status'] == 1) {
				$stat = '<span class="badge badge-info">Active</span>';
			} else {
				$stat = '<span class="badge badge-danger">Inactive</span>';
			}
			/*$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_EndOfShift_Data(\'' . $value['emp_id'] . '\')">Remit</button>';*/
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="get_incharge('.$id.')">Remit</button>';

			$result['data'][] = [$user->name, $stat, $btn];
		}
		echo json_encode($result);
	}

	public function get_remittance_incharge_ctrl()
	{
		$id=$this->input->get('id');
		 $query=$this->AdminModel->get_remittance_incharge_admodel($id);
		 // echo $id;

    	  $html="";
    	  foreach ($query as $q)
    	   {

    	   	$inz  = array('emp_id' => $q['id']);
			$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);

			echo '
					  <span style="margin-top: -23px; margin-right: -12px;"><label>Breakdown</label></span>

					<div class="col-sm-6 form-inline" style="margin-left: -205px;">
		                <label style="margin-left: 31px;">₱1,000</label>
		                 <input type="number" class="text-center" id="1k" style="width: 50px;" onchange="calculate_breakdown_js()">

		                <label style="margin-left: 28px;">₱500</label>
		                 <input type="number" class="text-center" id="5h" style="width: 50px;" onchange="calculate_breakdown_js()">

		                <label style="margin-left: 45px;">₱100</label>
		                 <input type="number" class="text-center" id="1h" style="width: 50px;" onchange="calculate_breakdown_js()">

		                <label style="margin-left: 36px;">₱50</label>
		                 <input type="number" class="text-center" id="fifty" style="width: 50px;" onchange="calculate_breakdown_js()">

		                <label style="margin-left: 54px;">₱20</label>
		                 <input type="number" class="text-center" id="twenty" style="width: 50px;" onchange="calculate_breakdown_js()">

		                <label style="margin-left: 22px;">coins</label>
		                 <input type="number" class="text-center" id="coins" style="width: 50px;" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()">
	                </div><br><br>

	                <div class="col-sm-6 form-inline" style="margin-left: 70px;">
	                	<label>Parking Attendant</label>
	                     <input disabled="true" type="text" style=" margin-left: -40px;" id="parkingattendant" value=" '.$nn->name.' ">
	                     <input disabled="true" type="hidden" style=" margin-left: -40px;" id="parkingattendant_hide" value=" '.$q['id'].' ">

	                    <label style="margin-left: 20px;">Total Amount Remit</label>
	                     <input disabled type="number" class="text-center" id="amountremit" value="">
	                     
	                </div>

	            ';

            echo '
            	<script>
            		$("#1k, #5h, #1h, #fifty, #twenty").keypress(function (evt) {
					    evt.preventDefault();
					});
            	</script>
            		';

    	}
	}

	public function save_remittance_ctrl()
	{
		$save=array("success");
		$this->AdminModel->save_remittance_model(
			$_POST['p_attendant'],
			$_POST['amount'],
			$_POST['datepaid'],
			$_POST['onek'],
			$_POST['fiveh'],
			$_POST['oneh'],
			$_POST['fifty'],
			$_POST['twenty'],
			$_POST['coins']
		);	

		echo json_encode($save);
	}

	public function generate_texfile_ctrl()
	{
		$success=array("successfully generated");
		$textfile = fopen("assets/blacklisted_textfile/".date("M-d-Y")."_"."PlazaMarcela_Blacklisted.txt", "w+");

		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_blacklist3($dtstart, $dtend);
		$i = 1;
		foreach ($data as $key => $var) {
			$id = $var['id'];
			$uid = $var['uid'];
			$pn = $var['plateNumber'];
			$dn = $var['dateTimeIn'];
			$dt = $var['dateEscaped'];
			$tid = $var['uid']; 
			$totalhrs = $var['totalHrs']; 
			$excesshrs = $var['excessHrs']; 
			$pen = $var['penaltyA'];
			$totC = $var['totCharge'];
			$totAmt = $var['totalAmt'];
			$checkDigit = $var['checkDigit'];
			if ($var['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}

			fwrite($textfile,$pn.",".$ww.",".$dn.",".$dt.",".$checkDigit.$tid.",".$totalhrs.",".$excesshrs.",".$pen.",".$totC.",".$totAmt."\r\n");

		}
		  fclose($textfile); 
		  echo json_encode($success);
	}

	public function generate_unblocktexfile_ctrl()
	{
		$success=array("successfully generated");
		$textfile = fopen("assets/unblocklist_textfile/".date("M-d-Y")."_"."PlazaMarcela_UnblockList.txt", "w+");

		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_unblocklist_model($dtstart, $dtend);
		$i = 1;
		foreach ($data as $key => $var) {

		$inz  = array('emp_id' => $var['outby']);
		$nn = $this->AdminModel->getData_pis('pis.employee3', $inz);

			$pn = $var['plateNumber'];
			$dn = $var['dateTimeIn'];
			$de = $var['dateEscaped'];
			$dp = $var['date_paid'];
			$tid = $var['uid']; 
			$totalhrs = $var['totalHrs']; 
			$excesshrs = $var['excessHrs']; 
			$pen = $var['penaltyA'];
			$totC = $var['totCharge'];
			$totAmt = $var['totalAmt'];
			$checkDigit = $var['checkDigit'];
			if ($var['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
/*
			$result['data'][] = [$i++, 
				$nn->name, 
				$pn, 
				$ww, 
				date('M-d-Y g:i A', strtotime($dn)), 
				date('M-d-Y', strtotime($de)),
				$checkDigit,
				$tid,
				$totalhrs,
				$excesshrs,
				$pen,
				$totC,
				$totAmt,
				date('M-d-Y g:i A', strtotime($dp))
				];*/

			fwrite($textfile,$pn.",".$ww.",".$dn.",".$de.",".$checkDigit.$tid.",".$totalhrs.",".$excesshrs.",".$pen.",".$totC.",".$totAmt.",".$dp."\r\n");

		}
		  fclose($textfile); 
		  echo json_encode($success);
	}

							/*end jay code*/


	public function count_blacklisted_list()
	{
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateEscaped >=' => $dtstart, 'dateEscaped <=' => date('Y-m-d H:i:s', $dtendz));
		$num = $this->AdminModel->getData_num('tbl_delinquent', $ins);
		if ($num > 0) {
			echo "success";
		} else {
			echo "none";
		}
	}

	public function get_blacklist_data_list()
	{
		$result = array();
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtstart')))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dtend')))));
		$dtendz = (strtotime($dtend) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_blacklist10z($dtstart, date('Y-m-d H:i:s', $dtendz));
		$i = 1;
		foreach ($data as $key => $var) {
			if ($var['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$result[] = ['num' => $i++, 
			'plateNumber' => $var['plateNumber'], 
			'v_type' => $ww, 
			'time_date_in' =>  date('M-d-Y g:i A', strtotime($var['dateTimeIn'])), 
			'date_listed' => date('M-d-Y', strtotime($var['dateEscaped'])),
			'ticket_num' =>  $var['checkDigit'], 
			'trans_num' => $var['uid'], 
			'totalHrs' => $var['totalHrs'], 
			'excessHrs' => $var['excessHrs'], 
			'penaltyA' => number_format($var['penaltyA'], 2), 
			'totCharge' => number_format($var['totCharge'], 2), 
			'totalAmt' => number_format($var['totalAmt'], 2)
			];

			// $result[] = ['num' => $i++, 'plateNumber'=> $var['plateNumber'], 'v_type' => $ww,'time_date_in' => date('m-d-Y', strtotime($var['dateToday'])),'time_in' => date('g:i:s a', strtotime($var['dateTimeToday'])), 'ticket_num' =>  $var['checkDigit'], 'trans_num' => $var['uid']];
		}
		echo json_encode($result);
	}
	public function get_incharge_collection_list()
	{
		$result = array('data' => []);
		$dtstart = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$dtend = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$outby = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(4)))));
		$data = $this->AdminModel->get_incharge_collected($dtstart, $dtend, $outby);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['user']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			$ins2 = array('emp_id' => $value['outby']);
			$user2 = $this->AdminModel->getData_pis('pis.employee3', $ins2);
			if ($value['amount'] == 50) {
				$ww = '2-wheeled';
			} else {
				$ww = '4-wheeled';
			}
			$result['data'][] = [date('M-d-Y H:i:s', strtotime($value['dateTimeIn'])), 
			date('M-d-Y H:i:s', strtotime($value['dateTimeout'])), 
			$user->name, 
			$user2->name, 
			$value['plateNumber'], 
			$ww, 
			number_format($value['amount'], 2), 
			number_format($value['penalty'], 2)
			];
		}
		echo json_encode($result);
	}
	public function get_EndOfShift_by_incharge()
	{
		$result = array('data' => []);
		$ins2 = array('usertype' => 'Parking Attendant');
		$data = $this->AdminModel->getDatas_e_parking('tbl_user', $ins2);
		foreach ($data as $key => $value) {
			$ins = array('emp_id' => $value['emp_id']);
			$user = $this->AdminModel->getData_pis('pis.employee3', $ins);
			$stat = '';
			if ($value['status'] == 1) {
				$stat = '<span class="badge badge-info">Active</span>';
			} else {
				$stat = '<span class="badge badge-danger">Inactive</span>';
			}
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_EndOfShift_Data(\'' . $value['emp_id'] . '\')">View</button>';
			$result['data'][] = [$user->name, $stat, $btn];
		}
		echo json_encode($result);
	}
	public function search_endofshift_data()
	{
		$id = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('id')))));
		$dt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dt')))));
		$inz = array('emp_id' => $id);
		$dtendz = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;


		$stat = $this->AdminModel->getData_e_parking('tbl_user', $inz);
		if ($stat->status == 1) {
			$ins = array('dateTimeout >=' => $dt, 'dateTimeout <=' => date('Y-m-d H:i:s', $dtendz), 'outby' => $id,'status'=>'0');
			$num = $this->AdminModel->getData_num('tbl_syncdata', $ins);
			if ($num > 0) {
				echo $num;
			} else {
				echo "no_data";

			}
		} else {
			echo "inactive";
		}
	}
	public function get_months_data()
	{
		$month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		for ($i = 0; $i < 12; $i++) {
			$result[] = ['date_val' => $i + 1, 'month_name' => $month[$i]];
		}
		echo json_encode($result);
	}
	public function get_days_data()
	{
		date_default_timezone_set('Asia/Manila');
		$days = date('d');
		$alldays = date('t');
		$month = date('m');
		for ($i = $alldays; $i >= 0; $i--) {
			$result[] = ['my_dy' => (intval($alldays)) - $i];
		}
		echo json_encode($result);
	}
	public function get_years_data()
	{
		date_default_timezone_set('Asia/Manila');
		$year = date('Y');
		for ($i = 4; $i >= 0; $i--) {
			$result[] = ['my_yr' => intval($year) - $i];
		}
		echo json_encode($result);
	}
	public function get_end_of_day_data()
	{
		date_default_timezone_set('Asia/Manila');
		$result = array('data' => []);
		$user = $this->session->userdata('name');
		$dtendz = (strtotime(date('Y-m-t')) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_days_data(date('Y-m-1'), date('Y-m-d H:i:s', $dtendz));
		foreach ($data as $key => $value) {
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_EndOfday_Data(\'' . $value['dateTimeout'] . '\',\'' . $user . '\')">View</button>';
			$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeout'])), $btn];
		}
		echo json_encode($result);
	}
	public function getendofdaydata()
	{
		$result = array('data' => []);
		$user = $this->session->userdata('name');
		$m = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$start_day = $y . '-' . $m . '-' . '1';
		$date1 = $y . '-' . $m;
		$d = date_create_from_format('Y-m', $date1);
		$lday = date_format($d, 't');
		$last_day = $y . '-' . $m . '-' . $lday;
		$dtendz = (strtotime($last_day) + (23 * 60 * 60)) + (59 * 60) + 59;
		$data = $this->AdminModel->get_days_data($start_day,  date('Y-m-d H:i:s', $dtendz));
		foreach ($data as $key => $value) {
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" onclick="view_EndOfday_Data(\'' . $value['dateTimeout'] . '\',\'' . $user . '\')">View</button>';
			$result['data'][] = [date('M-d-Y', strtotime($value['dateTimeout'])), $btn];
		}
		echo json_encode($result);
	}
	public function get_alldata_for_wedget()
	{
		$yrstart = date('Y-m-1');
		$yrend = (strtotime(date('Y-m-t')) + (23 * 60 * 60)) + (59 * 60) + 59;
		$result2 = array();
		$data = $this->AdminModel->get_data_records($yrstart, date('Y-m-d H:i:s', $yrend));
		$result[] = ['p_log' => $data->park_log, 'p_fee' => '₱ ' . number_format($data->penalty, 2), 'penalty' => '₱ ' . number_format($data->penalty1 + $data->lost_of_ticket, 2), 'total' => '₱ ' . number_format($data->penalty + $data->penalty1 + $data->lost_of_ticket, 2)];
		echo json_encode($result);
	}
	public function all_users_views()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$result2 = array();
		$user_datax = $this->AdminModel->getDatas('tbl_user');
		foreach ($user_datax as $key => $value) {
			$insz = array('emp_id' => $value['emp_id']);
			$userdatas = $this->AdminModel->getData_pis('pis.employee3', $insz);
			$inzert = array('company_code' => $userdatas->company_code, 'bunit_code' => $userdatas->bunit_code, 'dept_code' => $userdatas->dept_code);
			$dept_data = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
			if ($value['status'] == 1) {
				$stat = 'Active';
				$label = 'info';
			} else {
				$stat = 'Inactive';
				$label = 'danger';
			}
			$pp = '';
			$ins = array('app_id' => $value['emp_id']);
			$emp_pic = $this->AdminModel->getData_pis('pis.applicant', $ins);
			if ($emp_pic != NULL) {
				$pp = 'http://172.16.161.34:8080/hrms/employee/' . $emp_pic->photo . '';
			}
			$result2[] = ['profile_pic' => $pp, 'emp_name' => $userdatas->name, 'emp_id' => $userdatas->emp_id, 'department' => $dept_data->dept_name, 'position' => $userdatas->position, 'stat' => $stat, 'label' => $label, 'usertype' => $value['usertype'], 'status' => $value['status']];
		}
		$user_datax2 = $this->AdminModel->getDatas('tbl_manager');
		foreach ($user_datax2 as $key => $value) {
			$insz = array('emp_id' => $value['emp_id']);
			$userdatas = $this->AdminModel->getData_pis('pis.employee3', $insz);
			$inzert = array('company_code' => $userdatas->company_code, 'bunit_code' => $userdatas->bunit_code, 'dept_code' => $userdatas->dept_code);
			$dept_data = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
			if ($value['status'] == 1) {
				$stat = 'Active';
				$label = 'info';
			} else {
				$stat = 'Inactive';
				$label = 'danger';
			}
			$pp = '';
			$ins = array('app_id' => $value['emp_id']);
			$emp_pic = $this->AdminModel->getData_pis('pis.applicant', $ins);
			if ($emp_pic != NULL) {
				$pp = 'http://172.16.161.34:8080/hrms/employee/' . $emp_pic->photo . '';
			}
			$result2[] = ['profile_pic' => $pp, 'emp_name' => $userdatas->name, 'emp_id' => $userdatas->emp_id, 'department' => $dept_data->dept_name, 'position' => $userdatas->position, 'stat' => $stat, 'label' => $label, 'usertype' => $value['usertype'], 'status' => $value['status']];
		}
		$data['userdata'] = $result2;
		$data['page_title'] = 'E-Parking System | All Users List';
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/all_users', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/all_users_action', $data);
	}
	public function get_data_for_pie_chart()
	{
		$m = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('mm')))));
		$y = date('Y');
		$date1 = $y . '-' . $m;
		$d = date_create_from_format('Y-m', $date1);
		$start_day = $d->format('Y-m-1');
		$last_dayz = $d->format('Y-m-t');
		$dtendz = (strtotime($last_dayz) + (23 * 60 * 60)) + (59 * 60) + 59;
		$result2 = array();
		$ins = array('status' => 1);
		$location = $this->AdminModel->getDatas_e_parking('tbl_location', $ins);
		foreach ($location as $key => $value) {
			$inx = array('trim(location)' => trim($value['location']), 'date(dateTimeout) >=' => $start_day, 'date(dateTimeout)<=' =>  date('Y-m-d H:i:s', $dtendz));
			$amt = $this->AdminModel->getSum_data_from_tbl('tbl_syncdata', $inx);
			$result2[] = ['value' => $amt->penalty + $amt->penalty1 + $amt->lost_of_ticket, 'name' => $value['location']];
		}
		echo json_encode($result2);
	}
	public function getThePreviewsData()
	{
		$mm = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('month')))));
		date_default_timezone_set('Asia/Manila');
		$ddd = strtotime(date('Y-m-d'));
		$m = date('m', $ddd);
		$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$val_m = 1;
		for ($i = 0; $i < $mm; $i++) {
			$result[] = ['month_val' => $val_m, 'month' => $months[$i]];
			$val_m++;
		}
		echo json_encode($result);
	}
	public function sample_data()
	{
		$result = array();
		$ins = array('status' => 1);
		$data = $this->AdminModel->get_sample_data('tbl_location', $ins);
		foreach ($data as $key => $value) {
			$result[] = $value->location;
		}
		echo json_encode($result);
	}
	public function get_weekly_stat_data()
	{
		$result = array('data' => []);
		$dt = date('Y-m-t');
		$num = ceil(date('j', strtotime($dt)) / 7);
		for ($i = 0; $i < $num; $i++) {
			$num_week = date('W', strtotime(date('Y-m-1')));
			$ddy = date('D', strtotime(date('Y-m-1')));
			$year_number = date('Y');
			if ($ddy === 'Sun') {
				$week_number = $num_week + $i + 1;
			} else {
				$week_number = $num_week + $i;
			}
			$today = new DateTime('today');
			$fdt = clone $today->setISODate($year_number, $week_number, 0);
			$ldt = clone $today->setISODate($year_number, $week_number, 6);
			$vars_f['date'] = $fdt->format("Y-m-d");
			$vars_l['date'] = $ldt->format("Y-m-d");
			$first_dt = date('M-d-Y', strtotime($vars_f['date']));
			$second_dt = date('M-d-Y', strtotime($vars_l['date']));
			$first_day = "";
			$last_day = "";
			$nn = $i + 1;
			switch ($nn) {
				case '1':
					$ss = 'st ';
					$dtz = date('M-d-Y', strtotime(date('Y-m-1'))) . ' - ' . $second_dt;
					$first_day = date('Y-m-1');
					$last_day = date('Y-m-d', strtotime($vars_l['date']));
					break;
				case '2':
					$ss = 'nd ';
					$dtz = $first_dt . ' - ' . $second_dt;
					$first_day = date('Y-m-d', strtotime($vars_f['date']));
					$last_day = date('Y-m-d', strtotime($vars_l['date']));
					break;
				case '3':
					$ss = 'rd ';
					$dtz = $first_dt . ' - ' . $second_dt;
					$first_day = date('Y-m-d', strtotime($vars_f['date']));
					$last_day = date('Y-m-d', strtotime($vars_l['date']));
					break;
				default:
					if ($vars_l['date'] > date('Y-m-t')) {
						$ss = 'th ';
						$dtz = $first_dt . ' - ' . date('M-d-Y', strtotime(date('Y-m-t')));
						$first_day = date('Y-m-d', strtotime($vars_f['date']));
						$last_day = date('Y-m-d', strtotime(date('Y-m-t')));
					} else {
						$ss = 'th ';
						$dtz = $first_dt . ' - ' . $second_dt;
						$first_day = date('Y-m-d', strtotime($vars_f['date']));
						$last_day = date('Y-m-d', strtotime($vars_l['date']));
					}
					if (intval($nn) === intval($num)) {
						if ($vars_l['date'] < date('Y-m-d', strtotime(date('Y-m-t')))) {
							$num++;
						}
					}
					break;
			}
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" 
			onclick="view_WeeklyStat_Data(\'' . $first_day . '\', \'' . $last_day . '\')">View</button>';
			$result['data'][] = [$nn . $ss, $dtz, $btn];
		}

		echo json_encode($result);
	}
	public function get_WeeklyStatData()
	{
		$result  = array('data' => []);
		$m = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(3)))));
		$start_day = $y . '-' . $m . '-' . '1';
		$date1 = $y . '-' . $m;
		$d = date_create_from_format('Y-m', $date1);
		$lday = date_format($d, 't');
		$last_dayz = $y . '-' . $m . '-' . $lday;
		$num = ceil(date('j', strtotime($last_dayz)) / 7);
		for ($i = 0; $i < $num; $i++) {
			$today = new DateTime('today');
			$num_week = date('W', strtotime($start_day));
			$ddy = date('D', strtotime($start_day));
			$year_number = $y;
			if ($ddy === 'Sun') {
				$week_number = $num_week + $i + 1;
			} else {
				$week_number = $num_week + $i;
			}
			$fdt = clone $today->setISODate($year_number, $week_number, 0);
			$ldt = clone $today->setISODate($year_number, $week_number, 6);
			$vars_f['date'] = $fdt->format("Y-m-d");
			$vars_l['date'] = $ldt->format("Y-m-d");
			$first_dt = date('M-d-Y', strtotime($vars_f['date']));
			$second_dt = date('M-d-Y', strtotime($vars_l['date']));
			$first_day = "";
			$last_day = "";
			$nn = $i + 1;
			switch ($nn) {
				case '1':
					$ss = 'st ';
					$dtz = date('M-d-Y', strtotime($start_day)) . ' - ' . $second_dt;
					$first_day = $start_day;
					$last_day = date('Y-m-d', strtotime($vars_l['date']));
					break;
				case '2':
					$ss = 'nd ';
					$dtz = $first_dt . ' - ' . $second_dt;
					$first_day = date('Y-m-d', strtotime($vars_f['date']));
					$last_day = date('Y-m-d', strtotime($vars_l['date']));
					break;
				case '3':
					$ss = 'rd ';
					$dtz = $first_dt . ' - ' . $second_dt;
					$first_day = date('Y-m-d', strtotime($vars_f['date']));
					$last_day = date('Y-m-d', strtotime($vars_l['date']));
					break;
				default:
					$ss = 'th ';
					if ($vars_l['date'] > date('Y-m-d', strtotime($last_dayz))) {
						$dtz = $first_dt . ' - ' . date('M-d-Y', strtotime($last_dayz));
						$first_day = date('Y-m-d', strtotime($vars_f['date']));
						$last_day = date('Y-m-d', strtotime($last_dayz));
					} else {
						$dtz = $first_dt . ' - ' . $second_dt;
						$first_day = date('Y-m-d', strtotime($vars_f['date']));
						$last_day = date('Y-m-d', strtotime($vars_l['date']));
					}
					if (intval($nn) === intval($num)) {
						if ($vars_l['date'] < date('Y-m-d', strtotime($last_dayz))) {
							$num++;
						}
					}
					break;
			}
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" 
			onclick="view_WeeklyStat_Data(\'' . $first_day . '\', \'' . $last_day . '\')">View</button>';
			$result['data'][] = [$nn . $ss, $dtz, $btn];
		}
		echo json_encode($result);
	}
	public function getNumOfWeeklyData()
	{
		$lday = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('l_dt')))));
		$fday = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('f_dt')))));
		$dtendz = (strtotime($lday) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateTimeIn >=' => $fday, 'dateTimeIn <=' => date('Y-m-d H:i:s', $dtendz));
		$num = $this->AdminModel->getData_num('tbl_syncdata', $ins);
		echo $num;
	}
	public function get_monthly_byMonth_data()
	{
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$result = array('data' => []);
		$month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		for ($i = 0; $i < 12; $i++) {
			$num = $i + 1;
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" 
			onclick="view_monthly_Datas(\'' . $num . '\',\'' . $y . '\')">View</button>';
			$result['data'][] = [$num . '. ', $month[$i], $btn];
		}
		echo json_encode($result);
	}
	public function get_monthly_data()
	{
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->uri->segment(2)))));
		$result = array('data' => []);
		$month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		for ($i = 0; $i < 12; $i++) {
			$num = $i + 1;
			$btn = '<button type="button" class="btn waves-effect waves-light btn-rounded btn-xs btn-success" 
			onclick="view_monthly_data(\'' . $num . '\',\'' . $y . '\')">View</button>';
			$result['data'][] = [$num . '. ', $month[$i], $btn];
		}
		echo json_encode($result);
	}
	public function get_num_data_byMonth()
	{
		$m = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('month_dt')))));
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('year_dt')))));
		$date1 = $y . '-' . $m;
		$d = date_create_from_format('Y-m', $date1);
		$first_day = $d->format('Y-m-1');
		$last_day = $d->format('Y-m-t');
		$dtendz = (strtotime($last_day) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateTimeIn >=' => $first_day, 'dateTimeIn <=' =>  date('Y-m-d H:i:s', $dtendz));
		$num = $this->AdminModel->getData_num('tbl_syncdata', $ins);
		echo $num;
	}
	public function get_numdata_by_month()
	{
		$m = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('month_dt')))));
		$y = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('year_dt')))));
		$date1 = $y . '-' . $m;
		$d = date_create_from_format('Y-m', $date1);
		$first_day = $d->format('Y-m-1');
		$last_day = $d->format('Y-m-t');
		$dtendz = (strtotime($last_day) + (23 * 60 * 60)) + (59 * 60) + 59;
		$ins = array('dateTimeIn >=' => $first_day, 'dateTimeIn <=' =>  date('Y-m-d H:i:s', $dtendz));
		$num = $this->AdminModel->getData_num('tbl_syncdata', $ins);
		echo $num;
	}
	public function location_datas_by_dt()
	{
		$dt = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('dt_now')))));
		$ins_stat = array('status' => 1);
		$location = $this->AdminModel->getDatas_e_parking('tbl_location', $ins_stat);
		foreach ($location as $key => $value) {
			$dtendz = (strtotime($dt) + (23 * 60 * 60)) + (59 * 60) + 59;
			$inx = array('trim(location)' => trim($value['location']), 'date(dateTimeout) >=' => $dt, 'dateTimeout <=' => date('Y-m-d H:i:s', $dtendz));
			$amt = $this->AdminModel->getSum_data_from_tbl('tbl_syncdata', $inx);
			$result2[] = ['location' => $value['location'] . ' -  ( ' . $value['location_address'] . ' )', 'penalty' => number_format($amt->penalty + $amt->penalty1 + $amt->lost_of_ticket, 2)];
		}
		echo json_encode($result2);
	}
	public function ReportMonthlyData()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Monthly Data Report';
		$data['content_header'] = 'Monthly Data Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/monthly_data_report', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/monthly_data_report_action', $data);
	}
	public function ReportRangeMonthlyData()
	{
		if (!isset($_SESSION['logged_in'])) {
			redirect('login2');
		}
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
		$data['page_title'] = 'E-Parking System | Monthly Range Data Report';
		$data['content_header'] = 'Monthly Range Data Report';
		$data['department'] = $this->AdminModel->getData_pis('pis.locate_department', $inzert);
		$data['page_route'] = $this->uri->segment(1);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/monthly_range_data_report', $data);
		$this->load->view('admin/template/footer', $data);
		$this->load->view('admin/action/main_action', $data);
		$this->load->view('admin/action/monthly_range_data_report_action', $data);
	}
}
