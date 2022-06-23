<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AppModel');
	}

	public function appSync_ctrl()
	{

		// if(isset($_POST['uid']) &&
		//        isset($_POST['checkDigit']) &&
		//        isset($_POST['plateNumber']) &&
		//        isset($_POST['dateTimeIn']) &&
		//        isset($_POST['dateTimeout']) &&
		//        isset($_POST['amount']) &&
		//        isset($_POST['penalty']) &&
		//        isset($_POST['user']) &&
		//        isset($_POST['outBy']) &&
		//        isset($_POST['location'])){

		//   }
		$data = array(
			'uid' => $_POST['uid'],
			'checkDigit' => $_POST['checkDigit'],
			'plateNumber' => $_POST['plateNumber'],
			'dateTimeIn' =>  $_POST['dateTimeIn'],
			'dateTimeout' => $_POST['dateTimeout'],
			'amount' => $_POST['amount'],
			'penalty' => $_POST['penalty'],
			'user' =>  $_POST['user'],
			'outby' => $_POST['outBy'],
			'location' => $_POST['location'],
			'penalty1' => $_POST['penalty1'],
			'status' => $_POST['status'],
			'lost_of_ticket' => $_POST['lost_of_ticket']
		);
		$this->AppModel->appSync_mod($data);
	}

	public function appLogin_ctrl()
	{
		// $this->load->view('errors/html/error_404_not_found');
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('username')))));
			$password = $this->security->xss_clean(trim(addslashes(htmlspecialchars($this->input->post('password')))));
			// $username = "noel";
			// $password = "12345";
			$this->AppModel->login_mod($username, $password);
		}
	}
	// 
	public function getUserData_ctrl()
	{
		if (isset($_POST['userId'])) {
			$userID = $_POST['userId'];
			$this->AppModel->getUserData_mod($userID);
		}
	}

	public function olSaveTransaction_ctrl()
	{
		if (
			isset($_POST['uid']) &&
			isset($_POST['checkDigitResult']) &&
			isset($_POST['plateNumber']) &&
			isset($_POST['dateToday']) &&
			isset($_POST['dateTimeToday']) &&
			isset($_POST['dateUntil']) &&
			isset($_POST['amount']) &&
			isset($_POST['user']) &&
			isset($_POST['stat']) &&
			isset($_POST['location'])
		) {
			$data = array(
				'uid' => $_POST['uid'],
				'checkDigit' => $_POST['checkDigitResult'],
				'plateNumber' => $_POST['plateNumber'],
				'dateToday' => $_POST['dateToday'],
				'dateTimeToday' => $_POST['dateTimeToday'],
				'dateUntil' => $_POST['dateUntil'],
				'amount' => $_POST['amount'],
				'user' => $_POST['user'],
				'status' => $_POST['stat'],
				'location' => $_POST['location']
			);
			$this->AppModel->olSaveTransaction_mod($data);
		}
	}

	public function appGetTransaction_ctrl()
	{
		if (isset($_POST['location'])) {
			$loc = explode(',', $_POST['location']);
			$this->AppModel->appGetTransaction_mod($loc);
		}
	}

	public function appSaveToHistory_ctrl()
	{

		if (
			isset($_POST['id']) &&
			isset($_POST['uid']) &&
			isset($_POST['checkDigit']) &&
			isset($_POST['plateNumber']) &&
			isset($_POST['dateIn']) &&
			isset($_POST['dateNow']) &&
			isset($_POST['amountPay']) &&
			isset($_POST['penalty']) &&
			isset($_POST['user']) &&
			isset($_POST['outBy']) &&
			isset($_POST['location'])
		) {
			$data = array(
				'uid' => $_POST['uid'],
				'checkDigit' => $_POST['checkDigit'],
				'plateNumber' => $_POST['plateNumber'],
				'dateTimeIn' => $_POST['dateIn'],
				'dateTimeout' => $_POST['dateNow'],
				'amount' => $_POST['amountPay'],
				'penalty' => $_POST['penalty'],
				'user' => $_POST['user'],
				'outby' => $_POST['outBy'],
				'location' => $_POST['location']

			);
			$this->AppModel->appSaveToHistory_mod($data, $_POST['id']);
		}
	}

	public function appUpdateTrans_ctrl()
	{

		if (
			isset($_POST['id']) &&
			isset($_POST['plateNumber'])
		) {
			$this->AppModel->appUpdateTrans_mod($_POST['id'], $_POST['plateNumber']);
		}
	}

	public function trapLocation_ctrl()
	{
		if (isset($_POST['id'])) {
			$this->AppModel->trapLocation_mod($_POST['id']);
		}
	}

	public function olFetchSearch_ctrl()
	{
		if (isset($_POST['text']) && isset($_POST['location'])) {
			$this->AppModel->olFetchSearch_mod($_POST['text'], explode(',', $_POST['location']));
		}
	}

	public function olFetchSearchHistory_ctrl()
	{
		if (isset($_POST['text']) && isset($_POST['location'])) {
			$this->AppModel->olFetchSearchHistory_mod($_POST['text'], explode(',', $_POST['location']));
		}
	}

	public function olSaveDelinquent_ctrl()
	{
		if ( isset($_POST['id']) &&
		    isset($_POST['uid']) &&
			isset($_POST['plateNo']) &&
			isset($_POST['dateToday']) &&
			isset($_POST['fullName']) &&
			isset($_POST['secNameC']) &&
			isset($_POST['imgEmp']) &&
			isset($_POST['imgGuard'])&&
			isset($_POST['penaltyA'])&&
			isset($_POST['totCharge'])&&
			isset($_POST['totAmt'])&&
			isset($_POST['dateEscaped'])&&
			isset($_POST['status']) &&
			isset($_POST['vtype']) &&
			isset($_POST['transcode']) &&
			isset($_POST['datetime']) &&
			isset($_POST['totalHrs']) &&
			isset($_POST['excessHrs'])
		   )

		{

			$data = array(
					'uid' => $_POST['uid'],
			   		'plateno' => $_POST['plateNo'],
			   		'dateToday' => $_POST['dateToday'],
			   		'empName' => $_POST['fullName'],
			   		'secNameC' => $_POST['secNameC'],
			   		'imgEmp' => $_POST['imgEmp'],
			   		'imgGuard' => $_POST['imgGuard'],			
			   		'penaltyA' => $_POST['penaltyA'],			
			   		'totCharge' => $_POST['totCharge'],			
			   		'totalAmt' => $_POST['totAmt'],
					'dateEscaped' => $_POST['dateEscaped'],
					'dateEscaped2' => $_POST['dateEscaped'],
					'status' => $_POST['status'],
					'vtype' => $_POST['vtype'],
			   		'transcode' => $_POST['transcode'],
			   		'datetimein' => $_POST['datetime'],
			   		'totalHrs' => $_POST['totalHrs'],
			   		'excessHrs' => $_POST['excessHrs']
				);

			$this->AppModel->olSaveDelinquent_mod($data, $_POST['id']);
		}
	}

	public function olManagerKey_ctrl()
	{
		if (
			isset($_POST['username']) &&
			isset($_POST['password'])
		) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			// $username = 'dons';
			// $password = "12345";
			$this->AppModel->olManagerKey_mod($username, $password);
		}
	}

	public function olSendTransType_ctrl()
	{
		if (
			isset($_POST['empId']) &&
			isset($_POST['type'])
		) {
			$data =  array(
				'user' => $_POST['empId'],
				'transaction' => $_POST['type']
			);
			$this->AppModel->olSendTransType_mod($data);
		}
	}

	public function olReprintCouponTicket_ctrl()
	{
		if (
			isset($_POST['uid']) &&
			isset($_POST['checkDigit']) &&
			isset($_POST['plateNo']) &&
			isset($_POST['dateToday']) &&
			isset($_POST['dateTimeToday']) &&
			isset($_POST['dateUntil']) &&
			isset($_POST['amount']) &&
			isset($_POST['empId']) &&
			isset($_POST['location'])
		) {
			$data = array(
				'uid' => $_POST['uid'],
				'checkDigit' => $_POST['checkDigit'],
				'plateNumber' => $_POST['plateNo'],
				'dateToday' => $_POST['dateToday'],
				'dateTimeToday' => $_POST['dateTimeToday'],
				'dateUntil' => $_POST['dateUntil'],
				'amount' => $_POST['amount'],
				'empId' => $_POST['empId'],
				'location' => $_POST['location']

			);
			$this->AppModel->olSendReprint_mod($data);
		}
	}

	public function olCancel_ctrl()
	{
		if (isset($_POST['id'])) {
			$this->AppModel->olCancel_mod($_POST['id']);
		}
	}



	public function olFetchHistory_ctrl()
	{
		if (isset($_POST['location'])) {
			$this->AppModel->olFetchHistory_mod(explode(',', $_POST['location']));
		}
	}

	public function olPenaltyReprint_ctrl()
	{
		if (
			isset($_POST['uId']) &&
			isset($_POST['transCode']) &&
			isset($_POST['plate']) &&
			isset($_POST['dateTimeIn']) &&
			isset($_POST['dateTimeout']) &&
			isset($_POST['amount']) &&
			isset($_POST['penalty']) &&
			isset($_POST['inEmpId']) &&
			isset($_POST['outEmpId']) &&
			isset($_POST['location'])
		) {
			$data = array(
				'uId' => $_POST['uId'],
				'transCode' => $_POST['transCode'],
				'plate' => $_POST['plate'],
				'dateTimeIn' => $_POST['dateTimeIn'],
				'dateTimeout' => $_POST['dateTimeout'],
				'amount' => $_POST['amount'],
				'penalty' => $_POST['penalty'],
				'inEmpId' => $_POST['inEmpId'],
				'outEmpId' => $_POST['outEmpId'],
				'location' => $_POST['location'],
			);
			$this->AppModel->olPenaltyReprint_mod($data);
		}
	}

	// mae controller
	public function app_downloadDelinquent_ctrl2()
	{
		//if(isset($_POST['tohide'])){
		$this->AppModel->app_downloadDelinquent_mod2();
		//}
	}
	public function saveLogInData_ctrl(){
		// if(
		// 	isset($_POST['empid'])&&
		// 	isset($_POST['emp_name'])&&
		// 	isset($_POST['datelogin'])&&
		// 	isset($_POST['timelogin'])
		// 	)	
		// {
				$data = array(
				'emp_id' 		=> $_POST['emp_id'],
				'emp_name' 		=> $_POST['emp_name'],
				'datelogin' 	=> $_POST['datelogin'],
				'status' 		=> $_POST['status']
			);
			$this->AppModel->saveLogInData_mod($data);
	//	}

	}

	public function saveLogOutData_ctrl(){
		$datelogout = $_POST['datelogout']; 
		
		$this->AppModel->saveLogOutData_mod($datelogout);
	} 
 
	// end mae controller

	public function app_downLoadManager_ctrl()
	{
		//	if(isset($_POST['tohide'])){
		$this->AppModel->app_downLoadManager_mod();
		//	}
	}

	public function app_countDataDownload_ctrl()
	{
		$this->AppModel->app_countDataDownload_mod();
	}

	public function app_countLocationUser_ctrl()
	{
		$this->AppModel->app_countLocationUser_mod();
	}
	public function app_countLocation_ctrl()
	{
		$this->AppModel->app_countLocation_mod();
	}

	public function app_countTblManager_ctrl()
	{
		$this->AppModel->app_countTblManager_mod();
	}

	public function app_downLoadUser_ctrl()
	{
		//if(isset($_POST['tohide'])){
		$this->AppModel->app_downLoadUser_mod();
		//}
	}

	public function app_downLoadlocation_user_ctrl()
	{
		//if(isset($_POST['tohide'])){
		$this->AppModel->app_downLoadlocation_user_mod();
		//}
	}

	public function app_downLoadlocation_ctrl()
	{
		//if(isset($_POST['tohide'])){
		$this->AppModel->app_downLoadlocation_mod();
		//}
	}

	public function app_downloadDelinquent_ctrl()
	{
		//if(isset($_POST['tohide'])){
		$this->AppModel->app_downloadDelinquent_mod();
		//}
	}

	public function app_countTblDelinquent_ctrl()
	{

		$this->AppModel->app_countTblDelinquent_mod();
	}
}
