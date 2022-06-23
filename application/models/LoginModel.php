<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{

	

	public function getdata($table, $ins){
	
			$data = $this->db->get_where($table, $ins);
			return $data->row();
	}
	// public function getData_pis($table, $data){
	// 	$db2 = $this->load->database("pis", TRUE);
	// 	$result = $db2->get_where($table, $data);
	// 	return $result->row();
	// }
}