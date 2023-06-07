<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');
		$currency = '';

		$this->$currency =  GeneralSettings();

	}

	public function index(){

		$currency = '';
		$data['currency'] = $this->$currency;
		$data['page'] = 'Facilities';
		$this->load->view('facilities/facilities-cart',$data);	
	}


	
	public function getcityByState(){
		$stateName = $this->input->post('stateCode');
		return GetCity($stateName);
	}

	public function facilitiesList(){
		$currency = '';
		$data['currency'] = $this->$currency;
		$data['page'] = 'Facilities';
		$this->load->view('facilities/facilities-cart',$data);	
	}

	public function addCart(){

		if($this->input->post())
		{
			$this->session->set_userdata('facilities_cart', $this->input->post());
		}
		$response = array('status' => '1', 'message' => "Success");
		echo json_encode($response);	
	}




	public function BookFacilities(){

		if ($this->session->userdata('logged_in') == 1) {
			$eventDetails = $this->input->post('eventDetails')[0];

			$cart_data = $this->session->userdata('facilities_cart');
			$facilitiesData = array();

			for ($i = 0; $i < count($cart_data['ids']); $i++) {
				$facilitiesData[] = array(
					"_id" => $cart_data['ids'][$i],
					"serviceName" => $cart_data['serviceName'][$i],
					"serviceCategory" => $cart_data['ctg'][$i],
					"serviceType" => $cart_data['serviceTypes'][$i],
					"serviceAmount" => $cart_data['serviceAmount'][$i],
					"costPerDay" => $cart_data['serviceAmount'][$i],
					"startDate" => @$cart_data['startDate'][$i],
					"qty" => $cart_data['qty'][$i],
					"time" => @$cart_data['startTime'][$i],
					"day" => ""
				);
			} 


			$facilitiesData = json_encode($facilitiesData);

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].addRentalServiceCart()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{

				\"productId\":\"".ApiBaseUrl()['productID']."\",
				\"clientId\":\"".ApiBaseUrl()['clientID']."\",
				\"memberId\":\"".$this->session->userdata('id')."\",
				\"memberName\":\"".$this->session->userdata('refDataName')."\",
				\"prsnEmail\":\"".$this->session->userdata('email')."\",
				\"prsnPhone\":\"".$this->session->userdata('phone')."\",
				\"eventDetail\":".json_encode($eventDetails).",
				\"deliveryDetails\":{},
				\"deliveryTime\":\"\",
				\"paymentType\":\"PENDING\",
				\"deliveryDate\":\"\",
				\"delivery\":\"\",
				\"etKitchenTIp\":\"\",
				\"pickupTime\":\"\",
				\"bankName\":\"\",
				\"chequeNo\":\"\",
				\"chequeAmount\":\"\",
				\"chequeDate\":\"\",
				\"source\":\"WEBSITE\",
				\"totalAmount\": ".$cart_data['totalPrice'].",
				\"transactionId\":\"\",
				\"stationName\":\"\",
				\"stationId\":\"\",
				\"userId\":\"".$this->session->userdata('refDataName')."\",
				\"data\":$facilitiesData

			}");

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			$response = json_decode($result);
			if ($response->statusCode == 1) {
				$this->session->unset_userdata('facilities_cart');
				echo json_encode($response);
			}
		}
	}

	public function ViewCart(){
		$currency = '';
		$data['currency'] = $this->$currency;
		$data['page'] = 'Facilities';
		$data['title'] = 'Facilities';
		$data['session_data'] = 'facilities_cart';
		$this->load->view('facilities/view-cart',$data);
	}

	public function delete_cart_row(){
		$row_id = $this->input->post('row_id');
		$cart_items = $this->session->userdata('facilities_cart');
		$total_price = $cart_items['totalPrice'];
		$row_price = 0;
		foreach($cart_items['ids'] as $key => $id){
			if($id == $row_id){
            // remove the row from the cart data
				$row_price = $cart_items['serviceAmount'][$key];
				unset($cart_items['ids'][$key]);
				unset($cart_items['serviceName'][$key]);
				unset($cart_items['description'][$key]);
				unset($cart_items['serviceAmount'][$key]);
				unset($cart_items['qty'][$key]);
				unset($cart_items['image'][$key]);
				break;
			}
		}
    // subtract the row amount from the total amount
		$total_price -= $row_price;
    // update the total price in the cart data
		$cart_items['totalPrice'] = $total_price;
    // save the updated cart data to session
		$this->session->set_userdata('facilities_cart', $cart_items);
    // send response to the client
		echo json_encode(array('status' => 'success'));
	}
}