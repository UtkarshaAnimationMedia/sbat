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

		// $this->output->cache(1);

		$currency = '';
		$data['currency'] = $this->$currency;


		$data['page'] = 'Services';
		$data['service_cat_types'] = array_reverse(GetServiceCatTypes());
		$this->load->view('services-cart.php',$data);	
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
					<button class="nav-link '.(($key==0)?'serviceTypes1 active':'').'" id="home-tab'.$val['_id'].'" data-bs-toggle="tab" data-bs-target="#home-tab-pane'.$val['_id'].'" type="button" role="tab" aria-controls="home-tab-pane'.$val['_id'].'" aria-selected="true" style="padding: 9px 6px!important;font-size: 14px!important;">'.$val['refDataName'].'</button>
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

			if($this->input->post())
			{
				$this->session->set_userdata('service_cart', $this->input->post());
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
					"startDate" => @$cart_data['startDate'][$i],
					"qty" => $cart_data['qty'][$i],
					"time" => @$cart_data['startTime'][$i],
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


		// print_r($result);


			$response2 = json_decode($result);




			if ($response2->statusCode == 1) {
				$response3 = $this->updateTransactionStatus($response2->data[0]->_id, $response2->data[0]->invoiceNo, $this->input->post('transaction_id'));


				if ($response3->statusCode == 1) {

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





		public function AddServiceRequest(){


			if ($this->session->userdata('logged_in') == 1) {

				$cart_data =  $this->session->userdata('service_cart');

				$data = array();

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


				foreach($data as $item){


					$name_parts = explode(" ", $this->session->userdata('refDataName'));
					$first_name = $name_parts[0];
					$last_name = $name_parts[1];


					$fname = $first_name;
					$lname = $last_name;
					$email = $this->session->userdata('email');
					$phoneNumber = $this->session->userdata('phone');

					$streetAddress = $this->session->userdata('address');
					$priestName = '';
					$priestEmail = '';
					$priestPhone = '';
					$state = '';
					$zipcode = '';
					$serviceDate = $item['startDate'];

					$serviceTime = $item['time'];
					$preferredLanguage = '';
					$preferredLocation = '';
					$serviceName = $item['serviceName'];
					$adults = '';
					$children = '';
					$addtionalInfo = '';
					$serviceType = $item['serviceType'];;
					$serviceAmount = $item['serviceAmount'];;
					$serviceId = $item['_id'];;


					$ch = curl_init();
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

					curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].addServiceRequest()['url']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, "{      
						\"memberId\": \"".$this->session->userdata('id')."\", 
						\"serviceId\": \"".$serviceId."\", 

						\"serviceRequestName\":\"".$fname." ".$lname."\",      
						\"prsnEmail\": \"".$email."\",      
						\"prsnPhone\": \"".$phoneNumber."\",      
						\"clientId\": \"".ApiBaseUrl()['clientID']."\",      
						\"serviceDate\": \"".$serviceDate."\",      
						\"serviceTime\": \"".$serviceTime."\",      
						\"serviceLocationName\": \"".$preferredLocation."\",      
						\"adults\": \"".$adults."\",      
						\"children\": \"".$children."\",      
						\"serviceAddress\": \"".$streetAddress."\",  

						\"foodType\": \"\",      
						\"package\": \"\",      
						\"extraFood\": \"\",    

						\"serviceName\": \"".$serviceName."\",      
						\"serviceCategoryTypes\": \"".$preferredLocation."\",  

						\"serviceTypes\": \"".$serviceType."\",    
						\"serviceAmount\":".$serviceAmount.",    


						\"notes\": \"".$addtionalInfo."\",      
						\"languagePreferenceName\": \"".$preferredLanguage."\",      
						\"requestForPriestName\": \"".$priestName."\",  

						\"priestEmail\": \"".base64_encode($priestEmail)."\",      
						\"priestPhone\": \"".base64_encode($priestPhone)."\", 

						\"etShraadhamFor\": \"\",      
						\"ettithiDetail\": \"\",     

						\"source\": \"WEBSITE\",      
						\"notificationEmailName\": \"YES\"    
					}");

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

				if($response->statusCode == 1){
					$this->session->unset_userdata('service_cart');
				}
				echo json_encode($response);

			}

		}

		public function ViewCart(){
			$currency = '';
			$data['currency'] = $this->$currency;
			$data['page'] = 'Cart';
			$data['title'] = 'Cart';
			$data['session_data'] = 'service_cart';
			$this->load->view('view-cart',$data);
		}

	}