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

			$response = getUserDetails();
			$data['userDetails'] = $response->data[0];
			$data['GetState'] = GetState();
			$data['preferredLanguage'] = getPreferredLanguage();
			$data['page'] = 'Facilities';
			$data['title'] = 'Checkout';
			$data['session_data'] = 'facilities_cart';
			

			$this->load->view('facilities/checkout.php',$data);

		}else{
			redirect(base_url());
		}
	}

}
