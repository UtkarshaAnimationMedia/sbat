<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');
		$currency = '';

		$this->$currency =  GeneralSettings();

	}
	public function index(){

		$currency = '';
		$data['currency'] = $this->$currency;
		$data['page'] = 'Services';
		// $data['service_cat_types'] = array_reverse(GetServiceCatTypes());
		$this->load->view('services-cart',$data);	
	}


	function getServicesDataByAjax(){

		$cartList = $this->session->userdata('service_cart');
  // echo '<pre>';
		if(empty($cartList['ids']))
		{
			$cartList = array('totalPrice' => 0.00, 'ids' => array());

		}


		$cat =  $this->input->post('category');

		$serviceCatTypes = array_reverse(GetServiceCatTypes());

		$services = '';

		$html = '';


		if (isset($cat) && $cat!= '') {  


			$serviceCatTypes = array_values(array_filter($serviceCatTypes, function($data) use ($cat) {
				return $data['refDataName'] === $cat;
			}));


			foreach ($serviceCatTypes as $key => $item) {
				if ($cat == 'IN-TEMPLE' || $cat == 'AWAY-TEMPLE' || $cat == 'SHRADAM') { 

					$serivce_Types = getServiceTypes($cat);
					if(!empty($serivce_Types)){ foreach ($serivce_Types as $key => $val) {


						$aaa = getServicesByServiceType($val['refDataCode'], $val['refDataName'], $cartList);

						$services .= '<div class="tab-pane table-responsive fade shadow panettttttttt '.$val['_id'].' '.(($key==0)?"active show":"").'" id="home-tab-pane'.$val['_id'].'" role="tabpanel" aria-labelledby="home-tab'.$val['_id'].'" tabindex="0">

						'.$aaa.'

						</div>';
					};
				}

				$serviceTypeTabs = '';


				if(!empty($serivce_Types)){ foreach ($serivce_Types as $key => $val) { 

					$serviceTypeTabs .= '<style type="text/css">
					.nav-link.active {
						color: #fff!important;
						background-color: #005d4b!important;
					}
					.nav-link {
						color: #000!important;
						background-color: #E9ECEF!important;
						margin-right: 5px;
						border: 0;
					}

					</style>
					<li class="nav-item" role="presentation">
					<button class="nav-link '.(($key==0)?'serviceTypes1 active':'').'" id="home-tab'.$val['_id'].'" data-bs-toggle="tab" data-bs-target="#home-tab-pane'.$val['_id'].'" type="button" role="tab" aria-controls="home-tab-pane'.$val['_id'].'" aria-selected="true" style="padding: 9px 6px!important;font-size: 14px!important;">'.(@$val['display'] ? @$val['display'] : $val['refDataName']).'</button>
					</li>';

				} }


				$html .= ' <div class="tab-pane fade show active" id="home'.$key.'" role="tabpanel" aria-labelledby="home-tab">

				<ul class="nav nav-tabs" id="myTab" role="tablist">
				'.$serviceTypeTabs.'

				</ul>
				<div  class="tab-content" id="myTabContent">

				'.$services.'

				</div>
				</div>';
			} } }

			echo  $html;


		}
		public function addCart(){


			print_r($this->input->post());


			if($this->input->post())
			{
				$this->session->set_userdata('service_cart', $this->input->post());
			}
			$response = array('status' => '1', 'message' => "Success");
			echo json_encode($response);
		}




		public function AddToCart(){


			if ($this->session->userdata('logged_in') == 1) {

				$cart_data = json_decode($this->input->post('cart_data'), true);

				$dataWithAmount = array();
				$serviceRequest = array();

				for ($i = 0; $i < count($cart_data['ids']); $i++) {

					if ($cart_data['payment_btn_check'][$i] == 'SERVICE-REQUEST') {
						$payment_type_check = 'SERVICE REQUEST';
					}else if( $cart_data['payment_btn_check'][$i] == 'PAY-LATER'){
						$payment_type_check = 'PAY-LATER';
					}else if( $cart_data['payment_btn_check'][$i] == 'PAY-NOW'){
						$payment_type_check = 'PAY NOW';
					}


					if ($payment_type_check != 'SERVICE REQUEST') {
						$dataWithAmount[] = array(
							"_id" => $cart_data['ids'][$i],
							"serviceName" => $cart_data['serviceName'][$i],
							"serviceCategory" => $cart_data['ctg'][$i],
							"serviceType" => $cart_data['serviceTypes'][$i],
							"serviceAmount" => $cart_data['serviceAmount'][$i],
							"startDate" => @$cart_data['startDate'][$i],
							"qty" => $cart_data['qty'][$i],
							"time" => @$cart_data['startTime'][$i],
							"payment_btn_check" => @$payment_type_check,
							"day" => "",
							"serviceAddress" => ""
						);
					} else {
						$serviceRequest[] = array(
							"_id" => $cart_data['ids'][$i],
							"serviceName" => $cart_data['serviceName'][$i],
							"serviceCategory" => $cart_data['ctg'][$i],
							"serviceType" => $cart_data['serviceTypes'][$i],
							"serviceAmount" => $cart_data['serviceAmount'][$i],
							"startDate" => @$cart_data['startDate'][$i],
							"qty" => $cart_data['qty'][$i],
							"time" => @$cart_data['startTime'][$i],
							"payment_btn_check" => @$payment_type_check,
							"day" => "",
							"serviceAddress" => ""
						);
					}
				}


				$dataWithAmount = json_encode($dataWithAmount);
				$dataWithoutAmount = json_encode($serviceRequest);


				if (!empty($dataWithAmount)) {


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

						\"data\": $dataWithAmount, 

						\"paymentType\": \"CREDIT CARD\", 
						\"bankName\":\"\" ,
						\"chequeNo\":\"\" , 
						\"chequeAmount\":\"\" , 
						\"chequeDate\": \"\", 
						\"acharyasanbhavana\": ".$this->input->post('acharya_sambhavana').", 
						\"generaldonations\": ".$this->input->post('general_donation').", 

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


					$response2 = json_decode($result);




					if ($response2->statusCode == 1) {
						$response3 = $this->updateTransactionStatus($response2->data[0]->_id, $response2->data[0]->invoiceNo, $this->input->post('transaction_id'));
					}

				}

				if(!empty($dataWithoutAmount)){
					$res = $this->AddServiceRequest($dataWithoutAmount);
				}

				if ($response3->statusCode == 1 && $res->statusCode == 1) {

					if (@$cart_data['cart_type'] == 'SPONSORSHIP') {
						$this->session->unset_userdata('sponsor_cart');
					}
					else if(@$cart_data['cart_type'] == 'SERVICES'){

						$this->session->unset_userdata('service_cart');
					}

					else if(@$cart_data['cart_type'] == 'DONATIONS'){
						$this->session->unset_userdata('donation_cart');
					}

					echo json_encode($response2);
				}
			}


		}


		public function AddServiceRequest($serviceRequest = ''){

			if ($this->session->userdata('logged_in') == 1) {

				$cart_data =  $this->session->userdata('service_cart');


				
				if ($serviceRequest == '') {


					if (isset($cart_data)) {
						
						for($i = 0; $i < count($cart_data['ids']); $i++) {
							$data[] = array(
								"_id" => $cart_data['ids'][$i],
								"serviceName" => $cart_data['serviceName'][$i],
								"serviceCategory" => $cart_data['ctg'][$i],
								"serviceType" => $cart_data['serviceTypes'][$i],
								"serviceAmount" => $cart_data['serviceAmount'][$i],
								"startDate" => @$cart_data['startDate'][$i],
								"qty" => $cart_data['qty'][$i],
								"time" => @$cart_data['startTime'][$i],
								"day" => "",
								"serviceAddress" => ""
							);
						}
					}else{

						$id = $this->input->post('serviceId');
						$serviceName = $this->input->post('serviceName');
						$serviceCategory = $this->input->post('serviceCategory');
						$serviceTypes = $this->input->post('serviceTypes');
						$startDate = $this->input->post('startDate');
						$serviceAmt = $this->input->post('serviceAmt');
						$startTime = $this->input->post('startTime');

						$data[] = array(
							"_id" => $id,
							"serviceName" => $serviceName,
							"serviceCategory" => $serviceCategory,
							"serviceType" => $serviceTypes,
							"serviceAmount" => $serviceAmt,
							"startDate" => @$startDate,
							"qty" => 1,
							"time" => @$startTime,
							"day" => "",
							"serviceAddress" => ""
						);
					}

				}else{
					$data = json_decode($serviceRequest, true);
				}


				foreach($data as $item){

					$name_parts = explode(" ", $this->session->userdata('refDataName'));
					$first_name = $name_parts[0];
					$last_name = $name_parts[1];
					$fname = $first_name;
					$lname = $last_name;

					$newData = array(); 

					$newData['memberId'] = $this->session->userdata('id');
					$newData['serviceId'] = $item['_id'];
					$newData['serviceRequestName'] = $fname.' '.$lname;
					$newData['prsnEmail'] = $this->session->userdata('email');
					$newData['prsnPhone'] = $this->session->userdata('phone');
					$newData['clientId'] = ApiBaseUrl()['clientID'];
					$newData['serviceDate'] = $item['startDate'];
					$newData['serviceTime'] = $item['time'];
					$newData['serviceLocationName'] = $item['serviceCategory'];
					$newData['adults'] = '';
					$newData['children'] = '';
					$newData['serviceAddress'] = $this->session->userdata('address');
					$newData['foodType'] = '';
					$newData['package'] = '';
					$newData['extraFood'] = '';
					$newData['serviceName'] = $item['serviceName'];
					$newData['serviceCategoryTypes'] = $item['serviceCategory'];
					$newData['serviceTypes'] = $item['serviceType'];
					$newData['serviceAmount'] = $item['serviceAmount'];;
					$newData['notes'] = '';
					$newData['languagePreferenceName'] = '';
					$newData['requestForPriestName'] = '';

					$newData['priestEmail'] = '';
					$newData['priestPhone'] = '';
					$newData['etShraadhamFor'] = '';
					$newData['ettithiDetail'] = '';
					$newData['source'] = 'WEBSITE';
					$newData['notificationEmailName'] = 'YES';



					$dataPost = json_encode($newData);

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

					curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].addServiceRequest()['url']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);

					$token = $this->session->userdata('token');
					$headers = array();
					$headers[] = 'Authorization: Bearer '.$token.'';

					$headers[] = 'Content-Type: application/json';
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

					$result = curl_exec($ch);

					$response = json_decode($result);
					if (curl_errno($ch)) {
						echo 'Error:' . curl_error($ch);
					}
					curl_close($ch);



				}

				if ($serviceRequest == '') {

					if($response->statusCode == 1){
						$this->session->unset_userdata('service_cart');
					}
					
					echo json_encode($response);
				}else{
					return $response;
				}
			}

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

		public function ViewCart(){
			$currency = '';
			$data['currency'] = $this->$currency;
			$data['page'] = 'Cart';
			$data['title'] = 'Cart';
			$data['session_data'] = 'service_cart';
			$this->load->view('view-cart',$data);
		}


		public function checkServiceAvailibilty(){



			$no_days = 30;


			if($this->input->post())
			{
				$formData = $this->input->post();

				$startDate 	 = $formData['startDate']?$formData['startDate']:(date('m/d/Y'));
				$endDate 	 = $formData['endDate']?$formData['endDate']:(date('m/d/Y', strtotime("+".$no_days." days")));


				$startTime = $formData['startTime'];
				$serviceName = $formData['serviceName'];
				$endTime 	 = $formData['endTime'];

				$BookingLimitPerDay 	 = $formData['BookingLimitPerDay'];
				$serviceID 				 = $formData['serviceID'];

			// $details = array('statusCode' =>'1' ); //getServiceAvailibiltydata($startDate, $startTime, $serviceName, $endDate, $endTime);
				$details = getServiceAvailibiltydata($startDate, $startTime, $serviceName, $endDate, $endTime);



				$html = '';
				for ($i=0; $i < $no_days; $i++) { 
					$newDate = date('m/d/Y', strtotime("+".$i." days"));
					$BookingLimitPerDay 	 = $formData['BookingLimitPerDay'];

					if(!empty($details['data']))
					{
						if(in_array($newDate, array_column($details['data'], '_id')))
						{
							$BookingLimitPerDay = $BookingLimitPerDay - $details['data'][array_search($newDate, array_column($details['data'], '_id'))]['count'];
						}
					}


					$html .= '<tr>';
					$html .= '<td style="vertical-align: middle;padding: 20px;"> <strong> '.$newDate.' </strong></td>';
					$html .= '<td> <a href="javascript:void(0);" onclick="serviceAvailabilitybook(this);" class="btn btn-primary availability-btn" data-date="'.$newDate.'" data-service-id="'.$serviceID.'"  data-availability="'.$BookingLimitPerDay.'"> Availability ('.$BookingLimitPerDay.')</a>   </td>';
					$html .= '</tr>';
				}


				$month1 = date('M', strtotime($startDate));
				$month2 = date('M', strtotime($endDate));

				if ($month1 == $month2) {
					$details['headerMonths'] = ' ( '.$month1.' )';
				} else {
					$details['headerMonths'] = ' ( '.$month1 . '-' . $month2.' )';
				}

				$details['servicesList'] = $html;
				
				echo json_encode($details);
			}

		}






		public function delete_cart_row(){
			$row_id = $this->input->post('row_id');
			$cart_items = $this->session->userdata('service_cart');
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
			$total_price -= $row_price;
			$cart_items['totalPrice'] = $total_price;
			$this->session->set_userdata('service_cart', $cart_items);
			echo json_encode(array('status' => 'success'));
		}


		public function getThithiNext90Days(){

			$tithi = $this->input->post('tithi');
			$datesArray = getThithiNext90Days($tithi);


			if (!empty($datesArray['data'])) {
				$dates = array();
				foreach ($datesArray['data'] as $key => $value) {

					$newDate = str_replace("T00:00:00.000Z", "", $value['startDate']);

					array_push($dates, $newDate);
					// $dates =  $newDate;
				}
				echo json_encode($dates);
				// echo '<pre>';
				// print_r($datesArray);
				// die();

			}else{
				echo json_encode($datesArray);
			}
		}




		
	}