<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookChildEvents extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}
	public function index(){
		$data['page'] = 'Services';
		$data['service_cat_types'] = array_reverse(GetServiceCatTypes());

		// echo '<pre>';
		//  print_r($data['service_types']); die();

		$this->load->view('services-cart.php',$data);
	}

	public function addCart(){

		if($this->input->post())
		{
			$this->session->set_userdata('child_events', $this->input->post());
		}
		$response = array('status' => '1', 'message' => "Success");
		echo json_encode($response);
	}




	public function AddToCart(){

		$cart_data = json_decode($this->input->post('cart_data'), true);
		
		$data = array();

		for($i = 0; $i < count($cart_data['ids']); $i++) {
			$data[] = array(
				"_id" => $cart_data['ids'][$i],
				"serviceName" => $cart_data['serviceName'][$i],
				"serviceCategory" => $cart_data['ctg'][$i],
				"serviceType" => $cart_data['serviceTypes'][$i],
				"serviceAmount" => $cart_data['serviceAmount'][$i],
				"startDate" => $cart_data['startDate'][$i],
				"qty" => $cart_data['qty'][$i],
				"time" => $cart_data['startTime'][$i],
				"day" => "",
				"serviceAddress" => ""
			);
		}

		$data = json_encode($data);


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].addServiceCart()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{         
			\"productId\": \"".ApiBaseUrl()['productID']."\",
			\"clientId\": \"".ApiBaseUrl()['clientID']."\",      
			\"memberId\":\"".$this->session->userdata('id')."\",      
			\"memberName\":\"".$this->session->userdata('refDataName')."\",      
			\"prsnEmail\": \"".$this->session->userdata('email')."\",      
			\"prsnPhone\": \"".$this->session->userdata('phone')."\", 

			\"data\": $data, 

			\"paymentType\": \"CREDIT CARD\", 
			\"bankName\":\"\" ,
			\"chequeNo\":\"\" , 
			\"chequeAmount\":\"\" , 
			\"chequeDate\": \"\", 
			\"totalAmount\": ".$this->input->post('totalPrice').", 
			\"transactionId\":\"".$this->input->post('transaction_id')."\",
			\"source\":\"WEBSITE\"

		}     
		");
		$token = $this->session->userdata('token');
		$headers = array();


		$headers[] = 'Authorization: Bearer '.$token.'';

		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);


		// print_r($result);


		$response2 = json_decode($result);

		if ($response2->statusCode == 1) {
			$response3 = $this->updateTransactionStatus($response2->data[0]->_id, $response2->data[0]->invoiceNo, $this->input->post('transaction_id'));


			if ($response3->statusCode == 1) {

				$this->session->unset_userdata('child_events');
				echo json_encode($response2);
			}
		}


		// ====================================================


	}


	public function updateTransactionStatus($id, $invoiceNo, $transactionId){

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].updateTransactionStatus()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{         
			\"productId\": \"".ApiBaseUrl()['productID']."\",
			\"clientId\": \"".ApiBaseUrl()['clientID']."\",  

			\"_id\":\"".$id."\",      
			\"invoiceNo\":\"".$invoiceNo."\",      
			\"paymentStatus\": \"COMPLETED\",      
			\"transactionId\": \"".$transactionId."\"

		}     
		");

		$token = $this->session->userdata('token');

		$headers = array();

		$headers[] = 'Authorization: Bearer '.$token.'';

		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return $response = json_decode($result);

	}




}