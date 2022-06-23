<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppModel extends CI_Model
{

	public function appSync_mod($data){

	     $this->db->select('*');
		 $this->db->from('tbl_syncdata');
		 $this->db->where($data);
		 $this->result = $this->db->get();
		 if($this->result->num_rows() > 0){
			return false;
		 }
		 else{
		 	$this->db->insert('tbl_syncdata', $data);		
		 	return true;
     	 }
		 
	}

	public function login_mod($username,$password){
		// var_dump($username, $password);
		 $this->db->select('*');
		 $this->db->from('e_parking.tbl_user as users');
		 $this->db->where('users.username',$username);
		 $this->db->where('users.password',md5($password));
		 $this->db->where('users.usertype','System User');
		 $this->db->where('users.status','1');
		 // $this->db->limit(1);
		 $query = $this->db->get();
     	 $res =  $query->row_array(); 
		 // if(!empty($res)){
		 //    echo $res[0]['name'];
		 // }
		 if($query->num_rows() == 1) {
		 	if($username == $res['username']){
				echo $res['emp_id'];
		 	}
		 }
	}

	public function getUserData_mod($userID){
		$result = array();
    	$this->db->select('*');
		$this->db->from('e_parking.tbl_user as users');
		$this->db->join('pis.employee3 as emp3', 'emp3.emp_id = users.emp_id','inner');
		$this->db->join('pis.applicant as appli', 'appli.app_id = users.emp_id','inner');
		$this->db->join('e_parking.tbl_location_user as location_user', 'location_user.emp_id = users.emp_id','inner');
		// $this->db->join('e_parking.tbl_location as location', 'location.location_id = location_user.location_id','inner');
		$this->db->where('users.emp_id', $userID);
		$this->db->group_by('users.emp_id');
		$query = $this->db->get();
        $data = $query->result_array();

        $post_data = array();
	 	foreach($data as $value){    

	 		$this->db->select('*');
			$this->db->from('e_parking.tbl_location_user as users');
			$this->db->join('e_parking.tbl_location as location', 'location.location_id = users.location_id','inner');
			$this->db->where('users.emp_id', $value['emp_id']);
			$query2 = $this->db->get();
        	$data2 	= $query2->result_array();

        	$loc = array();

        	foreach ($data2 as $value2) {
        		# code...
        		$loc[] = $value2['location'];
        	}

			$post_data[] = array(
			    'emp_id' => $value['emp_id'],
			    'emp_name' => $value['firstname'],
			    'emp_namefn' => $value['name'], //fullname
			    'location' => implode(',',$loc),
			    'user_image' => str_replace('../','','http://172.16.161.34:8080/hrms/'.$value['photo']),
			    //alisdan pohon sa server
			    // 'lname' => $value['t_user_Lname'],
			    // 'user_id' => $value['t_user_details']

		  );
		}
		$user = array("user_details"=>$post_data);
		echo json_encode($user);
	}

	public function olSaveTransaction_mod($data){
			$this->db->insert('tbl_transactions', $data);
	}

	public function appGetTransaction_mod($location){


			
			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_transactions as tbltrans');
			$this->db->join('pis.employee3 as emp3', 'emp3.emp_id = tbltrans.user','inner');
			$this->db->where('tbltrans.status','1');
			$this->db->where_in('tbltrans.location',$location);
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
				    'd_id' => $value['id'],
				    'd_uid' => $value['uid'],
				    'd_chkdigit' => $value['checkDigit'],
				    'd_Plate' => $value['plateNumber'],
				    'd_dateToday' => $value['dateToday'],
					'd_dateTimeToday' => $value['dateTimeToday'],
					'd_dateUntil' => $value['dateUntil'],
					'd_amount' => $value['amount'],
					'd_user' => $value['name'],
					'd_emp_id' => $value['user'],
					'd_location' => $value['location']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function appSaveToHistory_mod($data, $id){

		 	$this->db->insert('e_parking.tbl_syncdata', $data);		
		 	//updating e_parking.tbl_transactions statuss to 0
		    $this->db->set('status', '0');
  			$this->db->where('id', $id);
  			$this->db->update('e_parking.tbl_transactions'); 	
	}

	public function appUpdateTrans_mod($id,$plateNumber){
			$this->db->set('plateNumber' ,$plateNumber);
			$this->db->where('id' ,$id);
			$this->db->update('e_parking.tbl_transactions');
	}

	public function trapLocation_mod($emp_id){
			$this->db->select('*');
			$this->db->from('e_parking.tbl_location_user as locuser');
			$this->db->where('locuser.emp_id',$emp_id);
			$this->db->limit(1);
			$query = $this->db->get();
	     	$res = $query->result_array(); 
			if(!empty($res)){
			    echo 'true';
			}
			else{
				echo 'false';
			}
	}

	public function olFetchSearch_mod($text,$location){

			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_transactions as tbltrans');
			$this->db->join('pis.employee3 as emp3', 'emp3.emp_id = tbltrans.user','inner');
			$this->db->like('tbltrans.plateNumber', $text);
			$this->db->where('tbltrans.status','1');
			$this->db->where_in('tbltrans.location',$location);
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){
				$post_data[] = array(
				    'd_id' => $value['id'],
				    'd_uid' => $value['uid'],
				    'd_chkdigit' => $value['checkDigit'],
				    'd_Plate' => $value['plateNumber'],
				    'd_dateToday' => $value['dateToday'],
					'd_dateTimeToday' => $value['dateTimeToday'],
					'd_amount' => $value['amount'],
					'd_user' => $value['name'],
					'd_emp_id' => $value['user'],
					'd_location' => $value['location']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function olFetchSearchHistory_mod($text,$location){

			$result = array();
	    	$this->db->select('id,uid,checkDigit,plateNumber,dateTimeIn,dateTimeout,amount,penalty,user,outby,location,(select name from pis.employee3 e where e.emp_id = synctrans.user) as name_in,(select name from pis.employee3 e where e.emp_id = synctrans.outby) as name_out');
			$this->db->from('e_parking.tbl_syncdata as synctrans');
			$this->db->like('synctrans.plateNumber', $text);
			$this->db->where_in('synctrans.location',$location);
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
				    'd_id' => $value['id'],
				    'd_uid' => $value['uid'],
				    'd_Plate' => $value['plateNumber'],
				    'd_dateTimeIn' => $value['dateTimeIn'],
					'd_dateTimeout' => $value['dateTimeout'],
					'd_amount' => $value['amount'],
					'd_transcode' => $value['checkDigit'],
					'd_name_in' => $value['name_in'],
					'd_in_empid' => $value['user'],
					'd_penalty' => $value['penalty'],
					'd_name_out' => $value['name_out'],
					'out_empid' => $value['outby'],
					'd_location' => $value['location']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function olFetchHistory_mod($location){

			$result = array();
	    	$this->db->select('id,uid,checkDigit,plateNumber,dateTimeIn,dateTimeout,amount,penalty,user,outby,location,(select name from pis.employee3 e where e.emp_id = synctrans.user) as name_in,(select name from pis.employee3 e where e.emp_id = synctrans.outby) as name_out');
			$this->db->from('e_parking.tbl_syncdata as synctrans');
			// $this->db->like('synctrans.plateNumber', $text);
			$this->db->where_in('synctrans.location',$location);
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
				    'd_id' => $value['id'],
				    'd_uid' => $value['uid'],
				    'd_Plate' => $value['plateNumber'],
				    'd_dateTimeIn' => $value['dateTimeIn'],
					'd_dateTimeout' => $value['dateTimeout'],
					'd_amount' => $value['amount'],
					'd_transcode' => $value['checkDigit'],
					'd_name_in' => $value['name_in'],
					'd_in_empid' => $value['user'],
					'd_penalty' => $value['penalty'],
					'd_name_out' => $value['name_out'],
					'out_empid' => $value['outby'],
					'd_location' => $value['location']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function olSaveDelinquent_mod($data,$id){
			$this->db->insert('e_parking.tbl_delinquent', $data);		
		 	//updating e_parking.tbl_transactions statuss to 0
		    $this->db->set('status', '0');
  			$this->db->where('id', $id);
  			$this->db->update('e_parking.tbl_transactions'); 
	}

	public function olManagerKey_mod($username,$password){
		 $this->db->select('*');
		 $this->db->from('e_parking.tbl_manager as user');
		 $this->db->where('user.username',$username);
		 $this->db->where('user.password',md5($password));
		 $query = $this->db->get();
     	 $res =  $query->row_array(); 
		 if($query->num_rows() == 1) {
		 	echo "true";
		 }else{
		 	echo "false";
		 }
	}
	
	public function olSendTransType_mod($data){
		$this->db->insert('e_parking.tbl_user_req', $data);		
	}

	public function olSendReprint_mod($data){
		$this->db->insert('e_parking.tbl_reprint', $data);
	}

	public function olCancel_mod($id){
		$this->db->set('status', '0');
  		$this->db->where('id', $id);
  		$this->db->update('e_parking.tbl_transactions'); 
	}

	public function olPenaltyReprint_mod($data){
		$this->db->insert('e_parking.tbl_penaltyeprint', $data);
	}
	public function app_countDataDownload_mod(){
		$user = $this->db->count_all_results('tbl_user');
		echo $user;
	}
	public function app_countLocationUser_mod(){
		$location_user = $this->db->count_all_results('tbl_location_user');
		echo $location_user;
	}

	public function app_countLocation_mod(){
		$location = $this->db->count_all_results('tbl_location');
		echo $location;
	}
	public function app_countTblDelinquent_mod(){
		$delinquent = $this->db->count_all_results('tbl_delinquent');
		echo $delinquent;
	}

	public function app_downLoadUser_mod(){
			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_user as usr');
			$this->db->join('pis.employee3 as emp3', 'emp3.emp_id = usr.emp_id','inner');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
				   
					'd_user_id' => $value['user_id'],
					'd_emp_id' => $value['emp_id'],
					'd_full_name' => $value['name'],
					'd_username' => $value['username'],
					'd_password' =>$value['password'],
					'd_usertype' => $value['usertype'],
					'd_status' => $value['status']
					
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);


	}

	public function app_downLoadlocation_user_mod(){
			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_location_user');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
					'd_loc_user_id' => $value['loc_user_id'],
					'd_user_id' => $value['user_id'],
					'd_location_id' => $value['location_id'],
					'd_emp_id' => $value['emp_id']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function app_downLoadManager_mod(){
			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_user');
			$this->db->where('usertype','Supervisor');
			$this->db->where('status','1');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
					'd_emp_id' => $value['emp_id'],
					'd_username' => $value['username'],
					'd_password' => $value['password'],
					'd_usertype' => $value['usertype'],
					'd_status' => $value['status']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function app_downLoadlocation_mod(){
			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_location');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value){   
				$post_data[] = array(
					'd_location_id' => $value['location_id'],
					'd_location' => $value['location'],
					'd_location_address' => $value['location_address'],
					'd_status' => $value['status']
			    );
			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function app_downloadDelinquent_mod()
	{
			$result = array();
	    	$this->db->select('*');
			$this->db->from('e_parking.tbl_delinquent');
			$query = $this->db->get();
	        $data = $query->result_array();
	        $post_data = array();
		 	foreach($data as $value)
		 	{   
				$post_data[] = array(
					'd_uid' => $value['uid'],
					'd_plateno' => $value['plateno'],
					'd_dateToday' => $value['dateToday'],
					'd_empName' => $value['empName'], //app user
					'd_secNameC' => $value['secNameC'],
					'd_imgEmp' => $value['imgEmp'],
					'd_penaltyA' => $value['penaltyA'],
					'd_totCharge' => $value['totCharge'],
					'd_totAmt' => $value['totalAmt'],
					'dateEscaped' => $value['dateEscaped']
				); 

			}
			$item = array('user_details'=>$post_data);
			echo json_encode($item);
	}

	public function app_countTblManager_mod(){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('usertype','Supervisor');
		$this->db->where('status','1');
		$num_results = $this->db->count_all_results();
		echo $num_results;
	}

	// mae model
	 public function app_downloadDelinquent_mod2()
		{
				$result = array();
		    	$this->db->select('*');
				$this->db->from('e_parking.tbl_delinquent');
				$query = $this->db->get();
		        $data = $query->result_array();
		        $post_data = array();
			 	foreach($data as $value)
			 	{   
					$post_data[] = array(
						'd_uid' => $value['uid'],
						'd_plateno' => $value['plateno'],
						'd_vtype' => $value['vtype'],
						'd_transcode' => $value['transcode'], //app user
						'd_datetimein' => $value['datetimein']
					); 

				}
				$item = array('user_details'=>$post_data);
				echo json_encode($item);
		} 

	public function saveLogInData_mod($data){
		$this->db->insert('e_parking.tbl_login_data', $data);
	}

	public function saveLogOutData_mod($datelogout){
		$this->db->set('datelogout',$datelogout);
		$this->db->set('status', '1');
		$this->db->where('status','0');
		$this->db->update('e_parking.tbl_login_data');
	} 

		/*end mae model*/

}