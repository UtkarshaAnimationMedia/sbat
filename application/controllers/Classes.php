<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}

	public function satPreparation()
	{
		$data['page'] = 'SAT-PREPARATION';
		$data['title'] = 'SAT-PREPARATION';
		$this->load->view('classes/sat-preparation',$data);
	}

	public function About_committee()
	{
		$data['page'] = 'ABOUT-COMMITTEE';
		$data['title'] = 'ABOUT-COMMITTEE';
		$this->load->view('about_committee',$data);
	}
	public function About_deity()
	{
		$data['deities_data'] = $this->mongo_db2->where(['aspectType'=>'Diety Directory'])->get('persondata');
		// echo '<pre>';
		// print_r($data['dieties_data']);

		$data['page'] = 'ABOUT-DEITY';
		$data['title'] = 'ABOUT-DEITY';
		$this->load->view('about_deity',$data);
	}

	public function About_priest()
	{
		$data['page'] = 'ABOUT-PRIEST';
		$data['title'] = 'ABOUT-PRIEST';
		$this->load->view('about_priest',$data);
	}

	public function General_reference()
	{
		$data['page'] = 'GENERAL-REFERENCE';
		$data['title'] = 'ABOUT-REFERENCE';
		$this->load->view('general_reference',$data);
	}

		public function Financial_statements()
	{
		$data['page'] = 'FINANCIAL-STATEMENTS';
		$data['title'] = 'ABOUT-STATEMENTS';
		$this->load->view('financial_statements',$data);
	}
}
?>