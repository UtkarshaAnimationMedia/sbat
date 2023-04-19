<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/Dashboard.php");

class ServiceRequest extends Dashboard {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

		$currency = '';

		$this->$currency =  GeneralSettings();

	}

	public function index(){

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
				\"moduleName\": \"Service Inquiry\",  
				\"productID\": \"".ApiBaseUrl()['productID']."\",   
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
				\"aspectType\": \"Request Form\",     
				\"query\": {   \"aspectType\": \"Request Form\", \"prsnEmail\":\"".$email."\"      },   
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


			// print_r($response);


			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);
			if ($response->statusCode == 1) {

				$data['myServiceRequests_data'] = $response->data;
				$data['page'] = 'MY-SERVICE-REQUEST';
				$data['title'] = 'MY SERVICE REQUEST';
				$data['header'] = 'MY SERVICE REQUEST';
				$this->load->view('admin/my-service-request',$data);
			}else{

				$data['err_msg'] = $response->message;
				$data['page'] = 'MY-SERVICE-REQUEST';
				$data['title'] = 'MY SERVICE REQUEST';
				$data['header'] = 'MY SERVICE REQUEST';
				$this->load->view('admin/my-service-request',$data);
			}

		}else{
			redirect(base_url());
		}
	}

	public function getPreferredLanguage(){
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
				\"aspectType\": \"languageTypes\",     
				\"query\": {        
					\"aspectType\": \"languageTypes\"     
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
		return $response = json_decode($result);
		print_r($response->data);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}

	public function getPreferredLocations(){

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
				\"aspectType\": \"locationTypes\",     
				\"query\": {        
					\"aspectType\": \"locationTypes\"     
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
		return	 $response = json_decode($result);
		


		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}


	public function getPriestData(){
		$userName = $this->session->userdata('refDataName');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
			\"componentConfig\": {   
				\"moduleName\": \"Contacts\",  
				\"productID\": \"".ApiBaseUrl()['productID']."\",
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
				\"aspectType\": \"Member Directory\",     
				\"query\": {        \"aspectType\": \"Member Directory\",      \"memberTypes\": \"PRIEST\"      },   
				\"userName\": \"".$userName."\",     
				\"skip\": 0,    
				\"next\": 1020    
			} 
		}");

		$token = $this->session->userdata('token');
		$headers = array();
		$headers[] = 'Authorization: Bearer '.$token.'';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		return $response = json_decode($result);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);




	}

	public function GetServicesByCategory(){

		$currency = '';
		$currencySymbol = $this->$currency;




		$currency = isset($currencySymbol['currencySymbol']) ? ( $currencySymbol['currencySymbol'] != '' || $currencySymbol['currencySymbol'] != 'null' ?  $currencySymbol['currencySymbol'] : '$' ) : '$' ;


		$serviceCatTypes = $this->input->post('param');

		
		$data = $this->mongo_db2->where(['aspectType'=>'ServiceSetup', 'serviceCategoryTypes'=> $serviceCatTypes, 'sourceTypes' => 'WEBSITE', 'status' => 'ACTIVE'])->get('businessdata');

		// print_r($data);die();

		$html = '';
		$html .= '<option value=" " selected disabled>Please Select Service</option>';
		foreach($data as $item){
			$html .= '<option value="'.$item['refDataName'].'"  serviceId="'.$item['_id'].'" startDate="'.$item['startDate'].'" startTime="'.$item['startTime'].'" serviceType="'.$item['serviceTypes'].'" serviceAmount="'.$item['serviceAmount'].'">'.$item['refDataName'].'('.@$currency['currencySymbol'].' '.$item['serviceAmount'].')'.'</option>';
		}
		echo $html;
	}

	public function ServiceRequest()
	{		
		if ($this->session->userdata('logged_in') == 1) {
			$data['page'] = 'Service-Request';
			$data['header'] = 'REQUEST A SERVICE';
			$data['GetState'] = $this->GetState();
			$userDetails = $this->getUserDetails();
			$preferredLanguage = $this->getPreferredLanguage();
			$preferredLocations = $this->getPreferredLocations();
			$PriestData = $this->getPriestData();

			if ($preferredLanguage->statusCode == 1 && $userDetails->statusCode == 1 && $preferredLocations->statusCode == 1 && $PriestData->statusCode == 1 && $PriestData->statusCode == 1) {
				$data['userDetails'] = $userDetails->data[0];
				$data['preferredLanguage'] = $preferredLanguage->data;
				$data['preferredLocations'] = $preferredLocations->data;
				$data['PriestData'] = $PriestData->data;


				$this->mongo_db2->where(['aspectType'=>'ServiceSetup','serviceCategoryTypes'=>'IN-TEMPLE', 'sourceTypes' => 'WEBSITE', 'status' => 'ACTIVE']);
				$array1 = $this->mongo_db2->get('businessdata');

				$this->mongo_db2->where(['aspectType'=>'ServiceSetup','serviceCategoryTypes'=>'AWAY-TEMPLE', 'sourceTypes' => 'WEBSITE', 'status' => 'ACTIVE']);
				$array2 = $this->mongo_db2->get('businessdata');

				$data['services'] = array_merge($array1, $array2);

				$this->load->view('admin/service-a-request',$data);
			}else{
				echo json_encode('User not found!!');
				$this->session->unset_userdata('logged_in');
				redirect(base_url());
			}

		}else{
			redirect(base_url());
		}
	}

	public function addServiceRequest(){

		if ($this->session->userdata('logged_in') == 1) {
		// print_r($this->input->post());die();

			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phoneNumber = $this->input->post('phoneNumber');
			$streetAddress = $this->input->post('streetAddress');
			$priestName = $this->input->post('priestName');
			$priestEmail = $this->input->post('priestEmail');
			$priestPhone = $this->input->post('priestPhone');
			$state = $this->input->post('state');
			$zipcode = $this->input->post('zipcode');
			$serviceDate = $this->input->post('serviceDate');
			$serviceTime = $this->input->post('serviceTime');
			$preferredLanguage = $this->input->post('preferredLanguage');
			$preferredLocation = $this->input->post('preferredLocation');
			$serviceName = $this->input->post('serviceName');
			$priestName = $this->input->post('priestName');
			$adults = $this->input->post('adults');
			$children = $this->input->post('children');
			$addtionalInfo = $this->input->post('addtionalInfo');
			$serviceType = $this->input->post('serviceType');
			$serviceAmount = $this->input->post('serviceAmount');
			$serviceId = $this->input->post('serviceId');

			$awayTempleAddress = $this->input->post('awayTempleAddress');

			if ($awayTempleAddress != '') {
				$awayTempleAddress = $this->input->post('awayTempleAddress');
			}else{
				$awayTempleAddress == '';
			}

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
				\"prsnEmail\": \"".base64_encode($email)."\",      
				\"prsnPhone\": \"".base64_encode($phoneNumber)."\",      
				\"clientId\": \"".ApiBaseUrl()['clientID']."\",      
				\"serviceDate\": \"".$serviceDate."\",      
				\"serviceTime\": \"".$serviceTime."\",      
				\"serviceLocationName\": \"".$preferredLocation."\",      
				\"adults\": \"".$adults."\",      
				\"children\": \"".$children."\",      
				\"serviceAddress\": \"".$awayTempleAddress."\",  

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
			if ($response->statusCode == 1) {
				$this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show"><strong>Success!</strong> Your Service Request has been successful.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect(base_url('admin/my-service-request'));
			}

		}else{
			redirect(base_url());
		}
	}
}
?>