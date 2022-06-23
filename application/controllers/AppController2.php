<?php
class AppController2 extends CI_Controller {

        public function __construct(){
			parent::__construct();
	        $this->load->model('AppModel2');
		}

		public function print_ticket()
		{
			$data['get_items'] = $this->AppModel2->print_ticket_mod();
			$this->load->view('json_index1',$data);
		}

		public function print_penalty()
		{
			$data['get_penalty'] = $this->AppModel2->print_penalty_mod();
			$this->load->view('json_index2',$data);
		}

		public function get_transaction_type()
		{
			$data['get_transaction'] = $this->AppModel2->get_transaction_mod();
			$this->load->view('json_index3',$data);
		}

		public function reprint_ticket()
		{
			$data['get_reprinted_ticket'] = $this->AppModel2->reprint_ticket_mod();
			$this->load->view('json_index4',$data);
		}

		public function reprint_penalty()
		{
			$data['get_reprinted_penalty'] = $this->AppModel2->reprint_penalty_mod();
			$this->load->view('json_index5',$data);
		}

}