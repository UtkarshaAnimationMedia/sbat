<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsornow extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}


	

	public function index(){
		$data['page'] = 'SPONSORSHIP';
		$serviceCategory = 'SPONSORSHIP';
		$data['service_types'] = getServiceTypes($serviceCategory);
		$this->load->view('sponsor-now.php',$data);
	}

	public function addCart(){
		
		if($this->input->post())
		{
			$this->session->set_userdata('sponsor_cart', $this->input->post());
		}
		$response = array('status' => '1', 'message' => "Success");
		echo json_encode($response);
	}

}
