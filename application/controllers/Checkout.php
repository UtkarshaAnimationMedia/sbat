<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}
	public function index($page = ''){



		$data['GeneralSettings'] = GeneralSettings();


		// print_r($data['GeneralSettings']); die();
		if (!empty($this->session->userdata('logged_in')) && $this->session->userdata('logged_in') == 1) {
			
			$data['page'] = 'Services';
			$data['title'] = 'Checkout';



				if ($page == 'sponsor') {
					$data['session_data'] = 'sponsor_cart';
					$data['redirect_url'] = 'puja-sponsorship';
				}else if($page == 'service'){
					$data['session_data'] = 'service_cart';
					$data['redirect_url'] = 'services';
				}else if ($page == 'events'){
					$data['session_data'] = 'child_events';
				}





			$this->load->view('checkout.php',$data);


		}else{
			redirect(base_url());
		}
	}

}
