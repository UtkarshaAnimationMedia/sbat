<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payonline extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}


	public function index()
	{
		$data['page'] 		= 'Home';
		$data['pageTitle'] 	= 'Log in';

		// echo '<pre>'; print_r( $this->session->userdata('token')); die();

		$data['servicesDetail'] = array();
		if(/*$this->input->get('serviceId') &&*/ $this->session->userdata('logged_in') == 1)
		{
			$serviceId = $this->input->get('service_id');


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].getServiceDetailbyId()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{          
				\"_id\": \"".$serviceId."\",          
				\"productId\":\" ".ApiBaseUrl()['productID']."\",           
				\"clientId\": \"".ApiBaseUrl()['clientID']."\",           
				\"username\":\"asdf\"        
			}");

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);

			$response = json_decode($result);

			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}






			// $data['servicesDetail'] =  array(
			// 	'_id' => '633ea1f097a8b37c17bfd921',
			// 	'serviceCategoryTypes' => 'ARCHANA',
			// 	'serviceTypes' => 'IN-TEMPLE',
			// 	'sourceTypes' => 'KIOSK',
			// 	'refDataName' => 'Ganesh pooja',
			// 	'dayTypes' => 'TUESDAY',
			// 	'startDate' => '10/06/2022',
			// 	'endDate' => '10/06/2022',
			// 	'startTime' => '3:06 PM',
			// 	'endTime' => '6:06 PM',
			// 	'deity' => 'DURGA',
			// 	'moduleName' => 'Services',
			// 	'clientID' => '62cc02e44c25557a1fdbf9a6',
			// 	'productID' => '62c807133d9ee4045ab78d4d',
			// 	'aspectType' => 'ServiceSetup',
			// 	'recCreBy' => 'Harshna001',
			// 	'recCreDate' => '10/6/2022',
			// 	'recModBy' => '',
			// 	'recModDate' => '11/4/2022 11:40:27 AM',
			// 	'day' => '',
			// 	'qtyCounter' => 'YES',
			// 	'sequenceId' => '',
			// 	'serviceAmount' => '120',
			// 	'Image' => '/uploads/profile/image-1667562022730-42706064.jpeg',
			// );

		}


		if ($response->statusCode == 1 && !empty($response->data) ) {
			$data['servicesDetail'] = json_decode(json_encode($response->data[0]), true);
			$data['header_data'] = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');

			$this->load->view('payonline/login',$data);			
		}else{
			echo 'Sorry! This Service in not available.';
		}

	}

	
}
