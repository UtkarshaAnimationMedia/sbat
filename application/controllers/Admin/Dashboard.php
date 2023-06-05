<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}
	public function index(){

		if ($this->session->userdata('logged_in') == 1) {

			$response = getUserDetails();
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

	public function getTithi(){

		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$tzone = $this->input->post('tzone');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$day = $this->input->post('day');
		$hour = $this->input->post('hour');
		$minute = $this->input->post('minute');

		$response = getPanchangamData($latitude, $longitude, $tzone, $year, $month, $day, $hour, $minute);
		echo json_encode($response);

	}
 
	public function getEventData(){

		$userName = $this->session->userdata('refDataName');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
			\"componentConfig\": {   
				\"moduleName\": \"Master Data Management\",  
				\"productID\": \"".ApiBaseUrl()['productID']."\",   
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
				\"aspectType\": \"Annual Registration types\",     
				\"query\": {        
					\"aspectType\": \"Annual Registration types\"     
					},   
					\"userName\": \"".$userName."\",     
					\"skip\": 0,    
					\"next\": 1020    } }");

		$token = $this->session->userdata('token');
		$headers = array();
		$headers[] = 'Authorization: Bearer '.$token.'';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		// print_r($result);

		return	 $response = json_decode($result);
		


		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);

	}

	public function MyAnnualEventsList(){

		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'MY-ANNUAL-EVENTS';
			$data['title'] = 'MY-ANNUAL-EVENTS';
			$data['header'] = 'MY-ANNUAL-EVENTS';
			$data['EventData'] = $this->getEventData();
			$this->load->view('admin/my-annual-events',$data);
		}else{
			redirect(base_url());
		}
	}

	public function getAnnualEvent(){

		$filter = $this->input->post('selectedValue');



		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);

		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
			\"componentConfig\": {\"query\": {
				\"aspectType\": \"annualRegistrations\"}, 
				\"moduleName\": \"Annual Registration\", 
				\"aspectType\": \"annualRegistrations\", 
				\"refDataName\": \"".$filter."\", 
				\"memberId\": \"".$this->session->userdata('id')."\", 
				\"collectionType\": \"Business\", 
				\"productID\": \"".ApiBaseUrl()['productID']."\",   
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",  
				\"userName\": \"".$this->session->userdata('refDataName')."\", 
				\"skip\": 0, 
				\"next\": 220}}");

		$token = $this->session->userdata('token');
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Bearer '.$token.'';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$response = json_decode($result);


		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}

		curl_close($ch);

		json_encode($response);

		// print_r($response);
		$html = '';
		if($response != ''){

			$annualEventData  = json_decode(json_encode($response->data), true);



			$html .= '<table id="myBookings" class="table bg-white my-3">';
			$html .= 		'<thead style="background-color: #70011D; color: white;">';
			$html .= 			'<tr>';

			$html .= 				'<th class="text-center">#</th>';
			$html .= 				'<th class="text-center">Name</th>';
			$html .= 				'<th class="text-center">Event&nbspType</th>';
			$html .= 				'<th class="text-center">Event&nbspDate</th>';

			$html .= 				'<th class="text-center">Event&nbspTime</th>';
			$html .=				'<th class="text-center">Tithi</th>';
			$html .=				'<th class="text-center">Status</th>';

			$html .= 			'</tr>';
			$html .=		'</thead>';
			$html .=		'<tbody>';
			foreach($annualEventData as $key => $val){


				$html .= '<tr><td class="text-center">'.($key+1).'</td>';
				$html .= '<td class="text-center">'.$val['nameOfPerson'].'</td>';
				$html .= '<td class="text-center">'.$val['refDataName'].'</td>';
				$html .= '<td class="text-center">'.$val['eventDate'].'</td>';
				$html .= '<td class="text-center">'.$val['eventTime'].'</td>';

				$html .= '<td class="text-center">'.$val['tithi'].'</td>';
				$html .= '<td class="text-center">'.$val['status'].'</td></tr>';

			}
			$html .= 		'</tbody>';
			$html .= 	'</table>';

			echo $html;
		}else{
			echo $html;
		}



	}


	public function AddAnnualEventsPage()
	{
		if ($this->session->userdata('logged_in') == 1) {

			$response = getUserDetails();
			if ($response->statusCode == 1) {
				$data['page'] = 'ADD-ANNUAL-EVENTS';
				$data['title'] = 'ADD-ANNUAL-EVENTS';
				$data['header'] = 'ADD-ANNUAL-EVENTS';
				$data['GetState'] = $this->GetState();
				$data['Events'] = $this->getEventData()->data;
				$data['userDetails'] = $response->data[0];
				$this->load->view('admin/add-annual-events',$data);
			}else{
				echo json_encode('User not found!!');
				$this->session->unset_userdata('logged_in');
				redirect(base_url());
			}
		}else{
			redirect(base_url());
		}

	}

	public function AddAnnualEvent()
	{
		

		
		if ($this->session->userdata('logged_in') == 1) {
			$userName = $this->session->userdata('refDataName');

			$data['memberId'] = $this->session->userdata('id');
			$data['memberEmail'] = base64_decode($this->session->userdata('email'));
			$data['refDataName'] = $this->input->post('eventType');
			$data['eventDate'] = $this->input->post('eventDate');
			$data['eventTime'] = $this->input->post('eventTime');
			$data['eventLocation'] = $this->input->post('eventLocation');

			$data['latitude'] = $this->input->post('latitude');
			$data['longitude'] = $this->input->post('longitude');
			$data['dob'] = $this->input->post('dob');
			$data['nameOfPerson'] = $this->input->post('nameOfPerson');

			$data['eventNakshtra'] = $this->input->post('eventNakshtra');
			$data['eventGotra'] = $this->input->post('eventGotra');
			$data['tithi'] = $this->input->post('eventTithi');

			$data['startDate'] = $this->input->post('startDate');
			$data['endDate'] = $this->input->post('endDate');
			$data['status'] = 'ACTIVE';
			$data['reminderType'] = $this->input->post('reminderType');

			$data['beforeDayReminder'] = $this->input->post('beforeDayReminder');

			$data['isTithiReminder'] = $this->input->post('isTithiReminder') == 'on' ? true : false;
			$data['isEmailReminder'] = $this->input->post('isEmailReminder') == 'on' ? true : false;
			$data['isSmsReminder'] = $this->input->post('isSmsReminder') == 'on' ? true : false;

			$emailArray = array();
			$emailArray[] = base64_decode($this->session->userdata('email'));

			if (!empty($this->input->post('emailOnMember'))) {
				$emailArray[] = $this->input->post('emailOnMember');
			}

			$data['emailto'] = $emailArray;

			$dataJson=json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].addAnnualRegistrations()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{    
				\"componentConfig\": {        
					\"moduleName\": \"".addAnnualRegistrations()['moduleName']."\",        
					\"aspectType\": \"".addAnnualRegistrations()['aspectType']."\",        
					\"productID\": \"".ApiBaseUrl()['productID']."\",        
					\"clientID\": \"".ApiBaseUrl()['clientID']."\",        
					\"userName\": \"".$userName."\"    
					},    
					\"dataJson\": ".$dataJson."
				}");

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			$response =json_decode($result, true);

			// print_r($response);
			// die();
			if ($response['statusCode'] == 1) {
				$this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show text-center"><strong>Event Registeration Created Successful..</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect(base_url('admin/my-annual-events'));
			}else{
				$this->session->set_flashdata('failure', '<div class="alert alert-danger alert-dismissible fade show text-center"><strong>Something went wrong please contact Adminstrator.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect(base_url('admin/my-annual-events'));
			}
		}else{
			redirect(base_url());
		}
	}

	

	


	public function FacilitiesBooking(){

		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'MY-FACILITIES-BOOKINGS';
			$data['title'] = 'MY FACILITIES BOOKINGS';
			$data['header'] = 'MY FACILITIES BOOKINGS';

			$this->load->view('admin/my-facilities-bookings',$data);
		}else{
			redirect(base_url());
		}
	}

	public function filterFacilitiesBookingData(){
		if ($this->session->userdata('logged_in') == 1) {

			$serviceTypes = $this->input->post('aspectType');

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
				\"query\": {        
					\"aspectType\": \"Rental Request Form\",
					\"customerEmail\":\"".$email."\",
					\"serviceTypes\":\"".$serviceTypes."\"      
					},   
					\"userName\": \"".$userName."\",     
					\"skip\": 0,    \"next\": 1020    
				} }");

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



				$html .= '<table id="myBookings" class="table bg-white  my-3">';
				$html .= 		'<thead  style="background-color: #70011D; color: white;">';
				$html .= 			'<tr>';
				$html .= 				'<th class="text-center">Order No.</th>';
				$html .= 				'<th>Items Name</th>';
				$html .= 				'<th style="text-align:right">Price</th>';

				$html .= 				'<th class="text-center">Order&nbsp;Date</th>';
				$html .=				'<th class="text-center">Status</th>';
				$html .=				'<th class="text-center">Cancel&nbspOrder</th>';
				// $html .=				'<th class="text-center">View&nbsp;Receipt</th>';
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

					$html .= '<td class="text-center">'.$val['recCreDate'].'</td>';
					$html .= '<td class="text-center">'.$status.'</td>';
					$html .= '<td class="text-center"><a href="javascript:void(0)" onclick="CancelBooking('."'".trim($val['_id'])."'".')"><img src="'.base_url('admin_assets/img/icons/booking-cancel-icon.png').'" height="35"width="35" style="vertical-align: middle!important;"></a></td>';

					// $html .= '<td class="text-center"><a href="'.base_url("admin/download-reciept/".base64_encode($val["tokenNumber"])."/".$serviceTypes).'" id="btnExport" target="_blank"><i class="fa fa-eye text-blue" style="font-size:22px"></i></a></td></tr>';
				}
				$html .= 		'</tbody>';
				$html .= 	'</table>';

				echo $html;
			}else{
				echo $html;
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



					$html .= '<table id="myBookings" class="table bg-white my-3">';
					$html .= 		'<thead  style="background-color: #70011D; color: white;">';
					$html .= 			'<tr>';
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

			if ($this->session->userdata('userType') == 'Managements') {
				$moduleName = 'Management Directory';
			}else{
				$moduleName = customerLogin()['moduleName'];
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
				\"componentConfig\": {        \"moduleName\": \"".$moduleName."\",        \"productID\": \"".ApiBaseUrl()['productID']."\",        \"clientID\": \"".ApiBaseUrl()['clientID']."\"    }}");
			$headers = array();
			$headers[] = 'Content-Type:application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);

			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			return $response = json_decode($result);
		}else{
			redirect(base_url());
		}

	}

	public function MyProfile(){

		if ($this->session->userdata('logged_in') == 1) {

			$response = getUserDetails();
			if ($response->statusCode == 1) {
				$data['page'] = 'MY-PROFILE';
				$data['title'] = 'MY PROFILE';
				$data['header'] = 'MY PROFILE';
				$data['userDetails'] = $response->data[0];


				if ($this->session->userdata('userType') == 'Managements') {
					$this->load->view('admin/managements/my-profile',$data);
				}else{
					$this->load->view('admin/my-profile',$data);
				}
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


			if ($this->session->userdata('userType') == 'Managements') {
				$moduleName = 'Management Directory';
			}else{
				$moduleName = customerLogin()['moduleName'];
			}


			$postfield=json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
				\"componentConfig\": {        \"moduleName\": \"".$moduleName."\",        \"productID\": \"".ApiBaseUrl()['productID']."\",        \"clientID\": \"".ApiBaseUrl()['clientID']."\"    }}");
			$headers = array();
			$headers[] = 'Content-Type:application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			$response = json_decode($result);


			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			if ($response->statusCode == 1) {
				$data['page'] = 'MY-PROFILE';
				$data['title'] = 'MY PROFILE';
				$data['header'] = 'EDIT PROFILE';
				$data['GetState'] = $this->GetState();

				
				$data['userDetails'] = $response->data[0];


				if ($this->session->userdata('userType') == 'Managements') {
					$this->load->view('admin/managements/edit-profile',$data);
				}else{
					$this->load->view('admin/edit-profile',$data);
				}
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
			$dob = $this->input->post('dob'); 



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




			if ($this->session->userdata('userType') == 'Managements') {
				$moduleName = 'Management Directory';
			}else{
				$moduleName = customerLogin()['moduleName'];
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
					\"dob\": \"".$dob."\",  

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
					\"componentConfig\": {        \"moduleName\": \"".$moduleName."\",        \"productID\": \"".ApiBaseUrl()['productID']."\",        \"clientID\": \"".ApiBaseUrl()['clientID']."\"    }}");
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

					


					if ($this->session->userdata('userType') == 'Managements') {
						$this->load->view('admin/managements/my-profile',$data);
					}else{
						$this->load->view('admin/my-profile',$data);
					}


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


				if ($this->session->userdata('userType') == 'Managements') {
					$this->load->view('admin/managements/my-payments', $data);
				}else{
					$this->load->view('admin/my-payments', $data);
				}


				
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
				\"userName\": \"".@$this->session->userdata('refDataName')."\"    }
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
