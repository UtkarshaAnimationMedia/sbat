<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}
	public function index(){

		if ($this->session->userdata('logged_in') == 1) {

			$response = $this->getUserDetails();
			if ($response->statusCode == 1) {
				$data['page'] = 'MY-PROFILE';
				$data['title'] = 'MY PROFILE';
				$data['header'] = 'UPDATE_PROFILE';
				$data['userDetails'] = $response->data[0];
				$this->load->view('admin/UpdateProfile',$data);
			}else{
				echo json_encode('User not found!!');
				$this->session->unset_userdata('logged_in');
				redirect(base_url());
			}


		}else{
			redirect(base_url());
		}
	}

	public function In_Temple_Bookings(){

		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'MY-BOOKINGS';
			$data['title'] = 'MY BOOKINGS';
			$data['header'] = 'MY BOOKINGS';

			$this->load->view('admin/my-bookings',$data);
		}else{
			redirect(base_url());
		}
	}

	public function FilterBookingData(){



		if ($this->session->userdata('logged_in') == 1) {

			$serviceCategoryTypes = $this->input->post('aspectType');

			if ($this->session->userdata('logged_in') == 1) {
				$data['page'] =  'MY-BOOKINGS';
				$data['header'] =  'MY BOOKINGS';

				$userName = $this->session->userdata('refDataName');
				$email = $this->session->userdata('email');


				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

				curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
					\"moduleName\": \"Calendar\",  
					\"productID\": \"".ApiBaseUrl()['productID']."\",   
					\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
					\"aspectType\": \"Service Schedules\",     
					\"query\": {        \"aspectType\": \"serviceBooking\",\"customerEmail\":\"".$email."\",\"serviceCategoryTypes\":\"".$serviceCategoryTypes."\"      },   
					\"userName\": \"".$userName."\",     
					\"skip\": 0,    \"next\": 1020    } }");
				$token = $this->session->userdata('token');
				$headers = array();
				$headers[] = 'Authorization: Bearer '.$token.'';
				$headers[] = 'Content-Type: application/json';
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

				$result = curl_exec($ch);
				$response = json_decode($result);


			// print_r($response->data);

				if (curl_errno($ch)) {
					echo 'Error:' . curl_error($ch);
				}

				curl_close($ch);
				$html = '';
				if($response != ''){

					$booking_data  = json_decode(json_encode($response->data), true);



					$html .= '<table id="myBookings" class="table  my-3">';
					$html .= 		'<thead>';
					$html .= 			'<tr  style="background-color:#F1F1F1">';
					$html .= 				'<th class="text-center">Token</th>';
					$html .= 				'<th>Service Name</th>';
					$html .= 				'<th style="text-align:right">Amount</th>';
					$html .= 				'<th class="text-center">Booking&nbsp;Date</th>';
					$html .= 				'<th class="text-center">Service&nbsp;Date</th>';
					$html .=				'<th class="text-center">Status</th>';
					$html .=				'<th class="text-center">Cancel&nbspBooking</th>';
					$html .=				'<th class="text-center">View&nbsp;Receipt</th>';
					$html .= 			'</tr>';
					$html .=		'</thead>';
					$html .=		'<tbody>';
					foreach($booking_data as $val){

						if (isset($val['status']) && $val['status'] != '') {
							$status = $val['status'];
						}else{
							$status = $val['statusName'];
						}

						if ($status == 'SCHEDULED') {
							$status = '<img src="'.base_url('admin_assets/img/icons/booking-confirmed-icon.png').'" height="35"width="35" style="vertical-align: middle!important;">';
						}else{
							$status = '<span class="badge">'.camelCase($status).'</span>';
						}
						$html .= '<tr><td class="text-center">'.$val['tokenNumber'].'</td>';
						$html .= '<td>'.camelCase($val['ServiceSetup']).'</td>';
						$html .= '<td style="text-align:right;padding-right:25px">$ '.sprintf("%.2f",$val['serviceAmount']).'</td>';
						$html .= '<td class="text-center">'.$val['serviceDate'].'</td>';
						$html .= '<td class="text-center">'.$val['recCreDate'].'</td>';
						$html .= '<td class="text-center">'.$status.'</td>';
						$html .= '<td class="text-center"><a href="javascript:void(0)" onclick="CancelBooking('."'".trim($val['_id'])."'".')"><img src="'.base_url('admin_assets/img/icons/booking-cancel-icon.png').'" height="35"width="35" style="vertical-align: middle!important;"></a></td>';

						$html .= '<td class="text-center"><a href="'.base_url("admin/download-reciept/".base64_encode($val["tokenNumber"])."/".$serviceCategoryTypes).'" id="btnExport" target="_blank"><i class="fa fa-eye text-blue" style="font-size:22px"></i></a></td></tr>';
					}
					$html .= 		'</tbody>';
					$html .= 	'</table>';

					echo $html;
				}else{
					echo $html;
				}


			}else{
				echo json_encode('please login first for access this menu.');
			}

		}else{
			redirect(base_url());
		}
	}

	
	public function MyOrders(){

		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'MY-ORDERS';
			$data['title'] = 'MY ORDERS';
			$data['header'] = 'MY ORDERS';

			$this->load->view('admin/my-orders',$data);
		}else{
			redirect(base_url());
		}
	}

	

	public function MyDonations(){

		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'MY-DONATIONS';
			$data['title'] = 'MY DONATIONS';
			$data['header'] = 'MY DONATIONS';

			$userName = $this->session->userdata('refDataName');
			$email = $this->session->userdata('email');


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   \"moduleName\": \"Calendar\",  \"productID\": \"".ApiBaseUrl()['productID']."\",   \"clientID\": \"".ApiBaseUrl()['clientID']."\",       \"aspectType\": \"Service Schedules\",     \"query\": {        \"aspectType\": \"serviceBooking\",\"customerEmail\":\"".$email."\",\"serviceCategoryTypes\":\"DONATIONS\"      },   \"userName\": \"".$userName."\",     \"skip\": 0,    \"next\": 1020    } }");

			$token = $this->session->userdata('token');
			$headers = array();
			$headers[] = 'Authorization: Bearer '.$token.'';
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			$response = json_decode($result);
			// print_r($response->data);
			
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			$data['donations_data']  = json_decode(json_encode($response->data), true);
			$this->load->view('admin/my-donations',$data);
		}else{
			redirect(base_url());
		}
	}



	public function getUserDetails(){


		if ($this->session->userdata('logged_in') == 1) {

			$email = base64_decode($this->session->userdata('email'));

			if(!empty($email))
			{
				$data=array('email'=>$email,'isMobile'=>false,'phone'=>'');
			}

			$postfield=json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
				\"componentConfig\": {        \"moduleName\": \"".customerLogin()['moduleName']."\",        \"productID\": \"".ApiBaseUrl()['productID']."\",        \"clientID\": \"".ApiBaseUrl()['clientID']."\"    }}");
			$headers = array();
			$headers[] = 'Content-Type:application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			return $response = json_decode($result);


			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);
		}else{
			redirect(base_url());
		}

	}

	public function MyProfile(){

		if ($this->session->userdata('logged_in') == 1) {

			$response = $this->getUserDetails();
			if ($response->statusCode == 1) {
				$data['page'] = 'MY-PROFILE';
				$data['title'] = 'MY PROFILE';
				$data['header'] = 'MY PROFILE';
				$data['userDetails'] = $response->data[0];
				$this->load->view('admin/my-profile',$data);
			}else{
				echo json_encode('User not found!!');
				$this->session->unset_userdata('logged_in');
				redirect(base_url());
			}


		}else{
			redirect(base_url());
		}
	}
	public function GetState()
	{
		if ($this->session->userdata('logged_in') == 1) {

			$userName = $this->session->userdata('refDataName');

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\":    {      \"moduleName\": \"Master Data Management\",      \"productID\":\"".ApiBaseUrl()['productID']."\",      \"clientID\": \"".ApiBaseUrl()['clientID']."\",      \"aspectType\":\"stateTypes\",      \"query\": {        \"aspectType\": \"stateTypes\"      },      \"userName\": \"".$userName."\",      \"skip\": 0,      \"next\": 700    }    }");

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

			return $response->data;
		}else{
			redirect(base_url());
		}
	}

	public function GetCity()
	{

		if ($this->session->userdata('logged_in') == 1) {

			$stateName = $this->input->post('stateCode');
			$userName = $this->session->userdata('refDataName');
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\":    {      
				\"moduleName\": \"Master Data Management\",      
				\"productID\":\"".ApiBaseUrl()['productID']."\",      
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",      
				\"aspectType\":\"cityTypes\",      

				\"query\": {        \"aspectType\": \"cityTypes\",   \"refDataCode\" : \"".$stateName."\"   },

				\"userName\": \"".$userName."\",      
				\"skip\": 0,      
				\"next\": 700    }    }");

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

			$option = '<option value="" selected disabled>Select City</option>';


			$keys = array_column($response->data, 'refDataName'); /// Multidiamensional array sort by key
			array_multisort($keys, SORT_ASC, $response->data);

			foreach($response->data as $item){

				$option .= '<option value="'.$item->refDataName.'">'.$item->refDataName.'</option>';
			}

			echo $option;

		}else{
			redirect(base_url());
		}
	}

	public function EditProfile(){

		if ($this->session->userdata('logged_in') == 1) {


			$email = base64_decode($this->session->userdata('email'));

			if(!empty($email))
			{
				$data=array('email'=>$email,'isMobile'=>false,'phone'=>'');
			}


			$postfield=json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
				\"componentConfig\": {        \"moduleName\": \"".customerLogin()['moduleName']."\",        \"productID\": \"".ApiBaseUrl()['productID']."\",        \"clientID\": \"".ApiBaseUrl()['clientID']."\"    }}");
			$headers = array();
			$headers[] = 'Content-Type:application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			$response = json_decode($result);


			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);
			$response->statusCode == 1;
			if ($response->statusCode == 1) {
				$data['page'] = 'MY-PROFILE';
				$data['title'] = 'MY PROFILE';
				$data['header'] = 'EDIT PROFILE';
				$data['GetState'] = $this->GetState();
				$data['userDetails'] = $response->data[0];

				$this->load->view('admin/edit-profile',$data);
			}else{
				echo json_encode('User not found!!');
				$this->session->unset_userdata('logged_in');
				redirect(base_url());
			}

		}else{
			redirect(base_url());
		}
	}


	public function UpdateProfile(){




		// print_r($this->input->post()); die();

		if ($this->session->userdata('logged_in') == 1) {


			$userName = $this->session->userdata('refDataName');

			$fname = $this->input->post('fname'); 
			$lname = $this->input->post('lname'); 
			$gothram = $this->input->post('gothram'); 
			$stars = $this->input->post('stars'); 
			$rashi = $this->input->post('rashi'); 
			$address_line1 = $this->input->post('address_line1'); 
			$address_line2 = $this->input->post('address_line2');

			$spouseName = $this->input->post('spouseName'); 
			$spousePhone = $this->input->post('spousePhone'); 
			$spouseEmail = $this->input->post('spouseEmail'); 
			$spouseGothram = $this->input->post('spouseGothram'); 
			$spouseStars = $this->input->post('spouseStars'); 
			$spouseRashi = $this->input->post('spouseRashi'); 



			$email = base64_encode($this->input->post('main_email'));  

			$phone = $this->input->post('main_phone');

			$phone = base64_encode(str_replace([' ', '(', ')', '-'], '', $phone));

			$full_address = $this->input->post('full_address'); 
			$state = $this->input->post('state'); 
			$city = $this->input->post('city'); 
			$zipcode = $this->input->post('zipcode'); 
			$company_name = $this->input->post('company_name'); 
			$company_email = $this->input->post('company_email'); 
			$company_phone = $this->input->post('company_phone');

			$company_phone = str_replace([' ', '(', ')', '-'], '', $company_phone);


			$company_website = $this->input->post('company_website'); 
			$Id = $this->session->userdata('id');


			$family_member_name = $this->input->post('family_member_name');
			$family_member_rashi = $this->input->post('family_member_rashi');
			$family_member_stars = $this->input->post('family_member_stars');

			$dateofbirth = $this->input->post('dateofbirth');
			$anniversary = $this->input->post('anniversary');
			$relationship = $this->input->post('relationship');



			$emailNoti = $this->input->post('emailNotification');
			$phoneSms = $this->input->post('phoneNotification');
			$phoneCallPref = $this->input->post('phoneCallPref');

			$emailSubscription = $emailNoti == 'on' ? 'true' : 'false'; 
			$phoneSubscription = $phoneSms == 'on' ? 'true' : 'false'; 
			$phoneCallSubscription = $phoneCallPref == 'on' ? 'true' : 'false'; 

			// print_r($emailSubscription); 
			// print_r($phoneSubscription); 
			// print_r($phoneCallSubscription); 




			// die();


			$jsonArray = array();

			foreach($family_member_name as $key => $val ){
				$jsonArray[] = array(
					'memberName' => $family_member_name[$key],
					'rashi' => $family_member_rashi[$key],
					'nakshatra' => $family_member_stars[$key],

					'relationship' => $relationship[$key],
					'dob' => $dateofbirth[$key],
					'anniversaryDate' => $anniversary[$key],
				);
			}







			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].postAPI()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{  
				\"_id\":\"".$Id."\",    
				\"dataJson\": {        
					\"refDataName\": \"".$fname." ".$lname."\",
					\"zip\": \"".$zipcode."\",        
					\"cityTypes\": \"".$city."\",     
					\"stateTypes\": \"".$state."\",        
					\"addressLine1\": \"".$address_line1."\",        
					\"addressLine2\": \"".$address_line2."\",        
					\"rashi\": \"".$rashi."\",        
					\"gotra\": \"".$gothram."\",        
					\"Nakshtra\": \"".$stars."\",  

					\"spouseName\": \"".$spouseName."\",  
					\"spousePhone\": \"".base64_encode($spousePhone)."\",  
					\"spouseEmail\": \"".base64_encode($spouseEmail)."\",  
					\"spouseGotra\": \"".$spouseGothram."\",  
					\"spouseNakshtra\": \"".$spouseStars."\",  
					\"spouseRashi\": \"".$spouseRashi."\",  

					\"companyName\": \"".$company_name."\",        
					\"companyEmail\": \"".base64_encode($company_email)."\",        
					\"companyPhone\": \"".base64_encode($company_phone)."\",        
					\"website\": \"".$company_website."\",        
					\"emailPref\": ".$emailSubscription.",        
					\"smsPref\": ".$phoneSubscription.",
					\"phoneCallPref\": ".$phoneCallSubscription.", 

					\"memberDetail\":".json_encode($jsonArray)."
					},
					\"componentConfig\": {\"moduleName\":\"Contacts\",        
					\"productID\": \"".ApiBaseUrl()['productID']."\",        
					\"clientID\": \"".ApiBaseUrl()['clientID']."\",        
					\"userName\": \"".$userName."\"    }}");

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

			if ($response->statusCode == 1) {
				$this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show text-center"><strong>Updated!</strong> Your profile has been updated.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect(base_url('admin/my-profile'));
			}else{
				$email = base64_decode($this->session->userdata('email'));

				if(!empty($email))
				{
					$data=array('email'=>$email,'isMobile'=>false,'phone'=>'');
				}

				$postfield=json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

				curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
					\"componentConfig\": {        \"moduleName\": \"".customerLogin()['moduleName']."\",        \"productID\": \"".ApiBaseUrl()['productID']."\",        \"clientID\": \"".ApiBaseUrl()['clientID']."\"    }}");
				$headers = array();
				$headers[] = 'Content-Type:application/json';
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				$result = curl_exec($ch);
				$response = json_decode($result);


				if (curl_errno($ch)) {
					echo 'Error:' . curl_error($ch);
				}
				curl_close($ch);
				$response->statusCode == 1;
				if ($response->statusCode == 1) {
					$data['page'] = 'MY PROFILE';
					$data['title'] = 'MY PROFILE';
					$data['header'] = 'MY PROFILE';
					$data['GetState'] = $this->GetState();
					$data['userDetails'] = $response->data[0];

					$this->load->view('admin/my-profile',$data);
				}else{
					echo json_encode('User not found!!');
					$this->session->unset_userdata('logged_in');
					redirect(base_url());
				}
			}

		}else{
			redirect(base_url());
		}

	}


	public function MyPayments(){

		if ($this->session->userdata('logged_in') == 1) {

			$email = $this->session->userdata('email');
			$userName = $this->session->userdata('refDataName');


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
				\"moduleName\": \"Payments\",  
				\"productID\": \"".ApiBaseUrl()['productID']."\",   
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
				\"aspectType\": \"Payments\",     
				\"query\": {   \"aspectType\": \"Payments\", \"prsnEmail\":\"".$email."\"      },   
				\"userName\": \"".$userName."\",     
				\"skip\": 0,    
				\"next\": 1020} 
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


			if ($response->statusCode == 1) {
				$data['payments_data'] = $response->data;

			// 	echo '<pre>';
			// print_r($data); die();	
				$data['page'] = 'MY-PAYMENTS';
				$data['title'] = 'MY PAYMENTS';
				$data['header'] = 'MY PAYMENTS';
				$this->load->view('admin/my-payments', $data);
			}

		}else{
			redirect(base_url());
		}
	}


	function download_reciept($token_number, $param)
	{


		$invoice_token_decoded = base64_decode($token_number);
		$param = urldecode($param);

		if ($this->session->userdata('logged_in') == 1) {

			$userName = $this->session->userdata('refDataName');
			$email = $this->session->userdata('email');


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);



			if ($param == 'PAYMENTS') {
				curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
					\"moduleName\": \"Payments\",  
					\"productID\": \"".ApiBaseUrl()['productID']."\",   
					\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
					\"aspectType\": \"Payments\",     
					\"query\": {   \"aspectType\": \"Payments\", \"prsnEmail\":\"".$email."\", \"tokenNumber\": ".$invoice_token_decoded."       },   
					\"userName\": \"".$userName."\",     
					\"skip\": 0,    
					\"next\": 1020} 
				}");
			}else{

				curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
					\"moduleName\": \"Calendar\",  
					\"productID\": \"".ApiBaseUrl()['productID']."\",   
					\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
					\"aspectType\": \"Service Schedules\",     

					\"query\": {        \"aspectType\": \"serviceBooking\", \"customerEmail\":\"".$email."\", \"serviceCategoryTypes\":\"".$param."\" , 
					\"tokenNumber\": ".$invoice_token_decoded."     }, 

					\"userName\": \"".$userName."\",     
					\"skip\": 0,    
					\"next\": 1020    } }");
			}

			$token = $this->session->userdata('token');
			$headers = array();
			$headers[] = 'Authorization: Bearer '.$token.'';
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			$response = json_decode($result);

			// print_r($response->data);

			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			$data['envoice_data']  = json_decode(json_encode($response->data), true);


			if ($param == 'PAYMENTS') {
				$data['page'] = 'MY-PAYMENTS';
				$data['title'] = 'MY PAYMENTS';
				$data['header'] = 'MY PAYMENTS';
				$this->load->view('admin/PaymentReceipt', $data);

			}else{

				$data['page'] = 'MY-BOOKINGS';
				$data['title'] = 'MY BOOKINGS';
				$data['header'] = 'MY BOOKINGS';

				$this->load->view('admin/BookingReceipt', $data);
			}


		}else{
			redirect(base_url());
		}

	}

	public function YearlyTaxLetter(){

		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'YEARLY-TAX-LETTER';
			$data['title'] = 'YEARLY TAX LETTER';
			$data['header'] = 'YEARLY TAX LETTER';
			$this->load->view('admin/YearlyTaxLetter',$data);
		}else{
			redirect(base_url());
		}
	}

	function DownlaodTaxLetter(){

		if ($this->session->userdata('logged_in') == 1) {
			$year = $this->input->post('Year');

			if ($year != "") {

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

				curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].sendBookingDataPdfOnMail()['url']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "{        
					\"userID\": \"asdf\",        
					\"memberId\": \"".$this->session->userdata('id')."\",        
					\"emailId\": \"".base64_decode($this->session->userdata('email'))."\",        
					\"clientId\": \"".ApiBaseUrl()['clientID']."\",        
					\"year\":\"".$year."\"      
				}");

				$headers = array();
				$headers[] = 'Content-Type: application/json';
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

				$result = curl_exec($ch);
				$response = json_decode($result);

				if (curl_errno($ch)) {
					echo 'Error:' . curl_error($ch);
				}
				curl_close($ch);

				if ($response->statusCode == 1) {
					$this->session->set_flashdata('success',camelCase(' Your Yearly Tax Letter PDF Has Been Sent On Your Registered Email ID.'));
					redirect(base_url('admin/yearly/Tax-Letter'),'refresh');
				}else{
					$this->session->set_flashdata('failure',camelCase(' Something went wrong!'));
					redirect(base_url('admin/yearly/Tax-Letter'),'refresh');
				}
			}else{
				$this->session->set_flashdata('failure',camelCase(' Please Choose Year!'));
				redirect(base_url('admin/yearly/Tax-Letter'),'refresh');
			}
		}else{
			redirect(base_url());
		}
	}




	public function CancelBooking($id)
	{


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].postAPI()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{  
			\"_id\":\"".$id."\",   
			\"dataJson\": {\"status\":\"CANCLED\"},  
			\"componentConfig\": {        
				\"moduleName\":\"Calendar\",        
				\"productID\": \"".ApiBaseUrl()['productID']."\",        
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",        
				\"userName\": \"weefefef\"    }
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
		

		echo json_encode($response);

	}
}
