<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('AdminModel');
	}
	public function login()
	{
		$this->load->view('login');
	}

	public function login2()
	{
		if (isset($_SESSION['logged_in'])) {
?>
			<script>
				window.history.back();
			</script>
<?php
		}
		$this->load->view('login2');
	}
	public function validate_login()
	{
		$username = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('username')))));
		$password = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('password')))));
		$ins = array('username' => $username, 'password' => md5($password), 'status' => 1);
		$result = $this->LoginModel->getdata('tbl_user', $ins);
		if ($result != NULL) {
			if ($result->usertype == 'Admin' || $result->usertype == 'Supervisor' || $result->usertype == 'Accounting-IAD') {
				$pp = '';
				$ins = array('app_id' => $result->emp_id);
				$emp_pic = $this->AdminModel->getData_pis('pis.applicant', $ins);
				if ($emp_pic != NULL) {
					$pp = 'http://172.16.161.34:8080/hrms/employee/' . $emp_pic->photo . '';
				}
				$newUserdata = array(
					'user_id' => $result->user_id,
					'name' => $result->emp_id,
					'password' => 	$result->password,
					'usertype' => $result->usertype,
					'profile_pic' => $pp,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($newUserdata);
				echo json_encode('dashboard_index');
			} else {
				echo json_encode('invalid');
			}
		} else {
			echo json_encode('invalid');
		}
	}
}
