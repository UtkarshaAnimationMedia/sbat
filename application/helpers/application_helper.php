<?php

defined('BASEPATH') or exit('No direct script access allowed');

function ApiBaseUrl(){
	$data = array(
		'url'=>"https://aspgen.vaaptech.com:9000/",
		'productID'=>"62c807133d9ee4045ab78d4d",
		'clientID'=>"63b703d69b31c849cce1157f"
	);
	return $data;
}

function GetProjectName(){
	if (PROJECT_NAME !== null && PROJECT_NAME != '') {
		return PROJECT_NAME;
	}else{
		return 'Sri Bhaktha Anjaneya Temple';
	}
}

function customerLogin(){
	$data = array(
		'url'=>"api/customerDetails/customerLoginWeb",
		'moduleName'=>"Contacts"
	);
	return $data;
}


function addAnnualRegistrations(){
	$data = array(
		'url'=>"api/event/addAnnualRegistrations",
		'moduleName'=>"Annual Registration",
		'aspectType' => "annualRegistrations"
	);
	return $data;
}


function GetMeetings(){
	$data = array(
		'url'=>"api/appgen/filterAPI",
		'moduleName'=>"Meeting"
	);
	return $data;
}




function getMeetingData($FilterDate = ''){
	
	$CI = & get_instance();
	$email = $CI->session->userdata('email');
	$userName = $CI->session->userdata('refDataName');
	$response = getUserDetails();
	$managementCategory = @$response->data[0]->managementCategory;

	if (!empty($FilterDate)) {


		if ($FilterDate === 'currentMonth') {
		// Get the current month's start date
			$startDate = date('01/m/Y');

// Get the current month's end date
			$endDate = date('t/m/Y');


			$query = array(
				"refDataName1" => $managementCategory,
				"aspectType" => "meetingProfile",
				"refDataName2" => array(
					'$lte' => $endDate,
					'$gte' => $startDate
				)
			);


		}else{
			$query = array(
				"refDataName1" => $managementCategory,
				"aspectType" => "meetingProfile",
				"refDataName2" => array(
					'$lte' => $FilterDate,
					'$gte' => $FilterDate
				)
			);
		}


	}else{
		$query = array(
			"refDataName1" => $managementCategory,
			"aspectType" => "meetingProfile"
		);
	}

	$data = array(
		"componentConfig" => array(
			"query" => $query,
			"moduleName" => GetMeetings()['moduleName'],
			"aspectType" => "meetingProfile",
			"productID" => ApiBaseUrl()['productID'],
			"clientID" => ApiBaseUrl()['clientID'],
			"userName" => $userName,
			"skip" => 0,
			"next" => 20
		)
	);
	$data_string = json_encode($data);


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].GetMeetings()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	$token = $CI->session->userdata('token');
	$headers = array(
		'Authorization: Bearer '.$token,
		'Content-Type: application/json',
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	return $response = json_decode($result);

}



function getAllMeetingData(){
	$CI = & get_instance();
	$email = $CI->session->userdata('email');
	$userName = $CI->session->userdata('refDataName');
	$response = getUserDetails();
	$managementCategory = @$response->data[0]->managementCategory;



	$query = array(
		"refDataName1" => $managementCategory,
		"aspectType" => "meetingProfile"
	);


	$data = array(
		"componentConfig" => array(
			"query" => $query,
			"moduleName" => GetMeetings()['moduleName'],
			"aspectType" => "meetingProfile",
			"productID" => ApiBaseUrl()['productID'],
			"clientID" => ApiBaseUrl()['clientID'],
			"userName" => $userName,
			"skip" => 0,
			"next" => 20
		)
	);
	$data_string = json_encode($data);


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].GetMeetings()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	$token = $CI->session->userdata('token');
	$headers = array(
		'Authorization: Bearer '.$token,
		'Content-Type: application/json',
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	return $response = json_decode($result);


}


function GetMeetingsById($id){

	$CI = & get_instance();

	$id = $id;
	$response = getUserDetails();
	$managementCategory = @$response->data[0]->managementCategory;

	$query = array(
		"aspectType" => "meetingProfile",
		"insertedId" => $id,
		"refDataName1" => $managementCategory
	);
	$data = array(
		"componentConfig" => array(
			"query" => $query,
			"moduleName" => "Meeting",
			"aspectType" => "meetingProfile",
			"productID" => ApiBaseUrl()['productID'],
			"clientID" => ApiBaseUrl()['clientID'],
			"skip" => 0,
			"next" => 1020
		)
	);
	$data_string = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL,  ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	$token = $CI->session->userdata('token');
	$headers = array(
		'Authorization: Bearer '.$token,
		'Content-Type: application/json',
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$response = json_decode($result);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $response;

}



function getDeities(){

	$query = array(
		"aspectType" => "deity"
	);
	$data = array(
		"componentConfig" => array(
			"query" => $query,
			"moduleName" => "Master Data Management",
			"aspectType" => "deity",
			"productID" => ApiBaseUrl()['productID'],
			"clientID" => ApiBaseUrl()['clientID'],
			"skip" => 0,
			"next" => 1020
		)
	);
	$data_string = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL,  ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

	$headers = array();

	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


	$result = curl_exec($ch);
	$response = json_decode($result);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $response;
}



function GetAttendancedata($memberDirectory ,$meetingname){

	$CI = & get_instance();
	$email = $CI->session->userdata('email');
	$userName = $CI->session->userdata('refDataName');


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
		\"moduleName\": \"Meeting Attendance Register\",  
		\"productID\": \"".ApiBaseUrl()['productID']."\",   
		\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
		\"aspectType\": \"meetingAttendanceRegister\",     
		\"query\": {   \"aspectType\": \"meetingAttendanceRegister\", \"Parent.refDataName1\": \"".$memberDirectory."\", \"Parent.refDataName\": \"".$meetingname."\"},       
		\"skip\": 0,    
		\"next\": 1020} 
	}");

	$token = $CI->session->userdata('token');
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

	return $response;

}


function GetMeetingMinutes($memberDirectory ,$meetingname){

	$CI = & get_instance();
	$email = $CI->session->userdata('email');
	$userName = $CI->session->userdata('refDataName');


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
		\"moduleName\": \"Meeting Minutes\",  
		\"productID\": \"".ApiBaseUrl()['productID']."\",   
		\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
		\"aspectType\": \"meetingMinutes\",     
		\"query\": {   \"aspectType\": \"meetingMinutes\", \"Parent.refDataName1\": \"".$memberDirectory."\", \"Parent.refDataName\": \"".$meetingname."\"},       
		\"skip\": 0,    
		\"next\": 1020} 
	}");

	$token = $CI->session->userdata('token');
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

	return $response;

}

function getMemberDirectoryByGroup($group, $filterYear){
	
	if ($filterYear != '') {


		// Set start date to October 1st of the 
		$startDate = date('m/d/Y', strtotime("$filterYear-10-01")); 
		// Set end date to September 30th of the 
		$endDate = date('m/d/Y', strtotime("$filterYear-09-30 +1 year")); 


		$query = array(
			'aspectType' => 'managementDirectory',
			"managementCategory" => $group,

			'effDate' => array(
				'$lte' => $startDate,
				'$gte' => $endDate
			)
		);
	}else{

		$startDate = date('01/m/Y');
		$endDate = date('t/m/Y');

		$query = array(
			"aspectType" => "managementDirectory",
			"managementCategory" => $group,
			'effDate' => array(
				'$lte' => $endDate,
				'$gte' => $startDate
			)
		);
	}


	$data = array(
		"componentConfig" => array(
			"query" => $query,
			"moduleName" => "Management Directory",
			"aspectType" => "managementDirectory",
			"productID" => ApiBaseUrl()['productID'],
			"clientID" => ApiBaseUrl()['clientID'],
			"skip" => 0,
			"next" => 1020
		)
	);


	$data_string = json_encode($data);

	$CI = & get_instance();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string );

	$headers = array();

	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$response = json_decode($result);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $response;
}

function getMemberDirectory($filter = ''){

	if ($filter != '' &&  $filter != 'SELECT YEAR') {


		// Set start date to October 1st of the 
		$startDate = date('m/d/Y', strtotime("$filter-10-01 -1 year")); 
		// Set end date to September 30th of the 
		$endDate = date('m/d/Y', strtotime("$filter-09-30")); 


		$query = array(
			'aspectType' => 'managementDirectory',
			'effDate' => array(
				'$gte' => $startDate,
				'$lte' => $endDate
			)
		);
	}else{

		$startDate = date('01/m/Y');
		$endDate = date('t/m/Y');

		$query = array(
			"aspectType" => "managementDirectory",
			'effDate' => array(
				'$gte' => $startDate,
				'$lte' => $endDate
			)
		);
	}


	$data = array(
		"componentConfig" => array(
			"query" => $query,
			"moduleName" => "Management Directory",
			"aspectType" => "managementDirectory",
			"productID" => ApiBaseUrl()['productID'],
			"clientID" => ApiBaseUrl()['clientID'],
			"skip" => 0,
			"next" => 1020
		)
	);
	$data_string = json_encode($data);

	$CI = & get_instance();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string );

	$token = $CI->session->userdata('token');
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

	return $response;
}



function ManagementGroup(){
	$CI = & get_instance();
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {
		\"moduleName\": \"Master Data Management\", 
		\"aspectType\": \"managementCategory\",
		\"query\":{
			\"aspectType\": \"managementCategory\"},
			\"productID\": \"".ApiBaseUrl()['productID']."\", 
			\"clientID\": \"".ApiBaseUrl()['clientID']."\", 
			\"userName\": \"".$CI->session->userdata('refDataName')."\", 
			\"skip\": 0, 
			\"next\":1220
		}}"
	);


// \"managementCategory\":\"".@getUserDetails()->data[0]->managementCategory."\"

	$token = $CI->session->userdata('token');
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

	return $response;
}
// **************************************************************************************************
// **************************************************************************************************


function getPanchangamData($lat, $long, $tzone, $year, $month, $day, $hours, $minute){


	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://vedicrishi-horoscope-matching-v1.p.rapidapi.com/basic_panchang/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"day\": \"".$day."\",\n  \"month\": \"".$month."\",\n  \"year\": \"".$year."\",\n  \"hour\": \"".$hours."\",\n  \"min\": \"".$minute."\",\n  \"lat\": \"".$lat."\",\n  \"lon\": \"".$long."\",\n  \"tzone\": \"".$tzone."\"\n}");

	$headers = array();
	$headers[] = 'X-Rapidapi-Host: vedicrishi-horoscope-matching-v1.p.rapidapi.com';
	$headers[] = 'X-Rapidapi-Key: c134901be4mshe8183baaade0a64p1b5249jsnb1b2b8a71111';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$response = json_decode($result);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	return $response;

}



function addAPI(){
	$data = array(
		'url'=>"api/appgen/addAPI"
	);
	return $data;
}



function customerSignup(){

	$data = array(
		'url'=>"api/customerDetails/addCustomerDetailWeb",
		'moduleName'=>"Contacts"
	);
	return $data;
}

function sendEmailOTP()
{
	$data = array(
		'url'=>"api/auth/sendMemberAuthCode"
	);
	return $data;
}

function SubscribeNewsletter(){
	$data = array(
		'url'=>"api/home/addSubscription"
	);
	return $data;
}

function verifyEmailOTP()
{
	$data = array(
		'url'=>"api/auth/verifyMemberCode"
	);
	return $data;
}


function addServiceCart(){

	$data = array(
		'url'=>"api/bookingService/addServiceCart"
	);
	return $data;
}

function getServiceDetailbyId(){

	$data = array(
		'url'=>"api/bookingService/getServiceDetailbyId"
	);
	return $data;
}

function updateTransactionStatus(){

	$data = array(
		'url'=>"api/bookingService/updateTransactionStatus"
	);
	return $data;
}
function filterAPI(){
	$data = array(
		'url'=>"api/appgen/filterAPI"
	);
	return $data;
}

function postAPI(){
	$data = array(
		'url'=>"api/appgen/postAPI"
	);
	return $data;
}

function addServiceRequest(){
	$data = array(
		'url'=>"api/bookingService/addServiceRequest"
	);
	return $data;
}


function sendContactEmail(){
	$data = array(
		'url'=>"api/emailSend/sendContactEmail"
	);
	return $data;
}

function sendBookingDataPdfOnMail(){
	$data = array(
		'url'=>"api/emailSend/sendBookingDataPdfOnMail"
	);
	return $data;
}


function addVolunteer(){
	$data = array(
		'url'=>"api/home/addVolunteer"
	);
	return $data;
}

function getServiceAvailability(){
	$data = array(
		'url'=>"api/bookingService/getServiceAvailability"
	);
	return $data;
}


function settings()
{
	$data = array(
		'url'=>"api/appsettings/setting"
	);
	return $data;
}







// Custom Functions






function formatPhoneNumber($phoneNumber) {
	$phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

	if(strlen($phoneNumber) > 10) {
		$countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
		$areaCode = substr($phoneNumber, -10, 3);
		$nextThree = substr($phoneNumber, -7, 3);
		$lastFour = substr($phoneNumber, -4, 4);

		$phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
	}
	else if(strlen($phoneNumber) == 10) {
		$areaCode = substr($phoneNumber, 0, 3);
		$nextThree = substr($phoneNumber, 3, 3);
		$lastFour = substr($phoneNumber, 6, 4);

		$phoneNumber = ''.$areaCode.'-'.$nextThree.'-'.$lastFour;
	}
	else if(strlen($phoneNumber) == 7) {
		$nextThree = substr($phoneNumber, 0, 3);
		$lastFour = substr($phoneNumber, 3, 4);

		$phoneNumber = $nextThree.'-'.$lastFour;
	}

	return $phoneNumber;
}

function randString($length)
{
	$charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$str = '';
	$count = strlen($charset);
	while ($length--) {
		$str .= $charset[mt_rand(0, $count-1)];
	}

	return strtoupper($str);
}

function slugify($string)
{
	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}


function camelCase($str) {
	// $i = array("-","_");
	// $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
	// $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
	// $str = str_replace($i, ' ', $str);
	$str = ucwords(strtolower($str));
	return $str;
}



function CheckEmptyNullVar($val='')
{
	if ($val == '' || $val == 'null') {
		return '';
	}else{
		return $val;
	}
}


function dateFormat($value)
{
	return date("jS M, Y", strtotime($value));
}
function numberFormat($value='')
{
	$value = $value?$value:0;
	return number_format($value, 2);

}


function format_event_date($start_date = '', $end_date = '', $start_time = '', $end_time = '') {
  // Convert US date format to DateTime object

	if (!empty($start_date)) {
		$start_date = DateTime::createFromFormat('m/d/Y', $start_date);
	}else{
		$start_date = '';
	}
	if (!empty($end_date)) {
		$end_date = DateTime::createFromFormat('m/d/Y', $end_date);
	}else{
		$end_date = '';
	}
  // Convert start and end times to DateTime object

	if (!empty($start_time)) {
		$start_time = DateTime::createFromFormat('g:i A', $start_time);
	}else{
		$start_time = '';
	}
	if (!empty($end_time)) {
		$end_time = DateTime::createFromFormat('g:i A', $end_time);
	}else{
		$end_time = '';
	}

  // Format the date range string
	$date_range = "";
	if ($start_date && $end_date) {
    // If start and end dates are in the same month
		if ($start_date->format('m') == $end_date->format('m')) {
			if ($start_date->format('Y') == $end_date->format('Y')) {
				$date_range = $start_date->format('d') . ' - ' . $end_date->format('d M, y');
				
			}else{

				$date_range = $start_date->format('d') . ' - ' . $end_date->format('d M');
			}
		} else {
			if ($start_date->format('Y') == $end_date->format('Y')) {
				$date_range = $start_date->format('d M') . ' - ' . $end_date->format('d M, y');

			}else{

				$date_range = $start_date->format('d M, y') . ' - ' . $end_date->format('d M, y');
			}
		}
	} else {
    // If either start or end date is missing

		$date_range = ($start_date ? ($start_date ? $start_date->format('d M, y') : '') : ($end_date ? $end_date->format('d M, y') : '' ) ) ;
	}

  // Format the time range string


	if (($end_time ?$end_time->format('A'):'')==($start_time ?$start_time->format('A'):'')) {
		$time_range = ($start_time ? $start_time->format('g:i') : '') . ($end_time ?  ' - ' . $end_time->format('g:i A') : '' );

	}
	else{

		$time_range = ($start_time ? $start_time->format('g:i A') : '') . ($end_time ?  ' - ' . $end_time->format('g:i A') : '' );
	}



  // Combine date and time strings and return
	return ($date_range  ? $date_range : '' ) . ($time_range ? ($date_range ? ' | '.$time_range : $time_range) : '' );
}





function GeneralSettings(){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].settings()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"action\": \"getClientSetting\",   
		\"productId\":\"".ApiBaseUrl()['productID']."\",
		\"clientId\":\"".ApiBaseUrl()['clientID']."\"
	}");

		// $token = $this->session->userdata('token');
	$headers = array();
		// $headers[] = 'Authorization: Bearer '.$token.'';
	$headers[] = 'Content-Type: application/json';



	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);

	$response = json_decode($result, true);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);


	return $response['result']['data'][0]['generalSetting'];

}



function GetChildEventByParentEvent($ParentEvent,$serviceCategoryTypes, $session_data){
	$CI = & get_instance();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
		\"moduleName\": \"Temple Events\",  
		\"productID\": \"".ApiBaseUrl()['productID']."\",   
		\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
		\"aspectType\": \"ServiceSetup\",     
		\"query\": {        \"aspectType\": \"ServiceSetup\", \"parentService\": \"".$ParentEvent."\", \"serviceCategoryTypes\": \"".$serviceCategoryTypes."\" },   
		\"userName\": \"\",     
		\"skip\": 0,    
		\"next\": 1020    
	} }");
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$response = json_decode($result);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}

	curl_close($ch);




	$services = json_decode(json_encode($response->data), true);


	// print_r($services);



	$currency = GeneralSettings();

	$html = '';


	if ($services != array()) {
		$html .= '<table class="table border-0" >
		<thead>
		<tr class="table-primary">
		<th style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Service Name</th>
		<th class="text-end" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Unit&nbsp;Price</th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Total&nbsp;Amount</th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		</tr>
		</thead>
		<tbody>';
		foreach($services as $key => $item){ 

			$description = $item['description'];
		// print_r($item);

			$words = explode(" ", $description);
			if (count($words) > 30) {
				$limited_words = array_slice($words, 0, 30);
				$limited_string = implode(" ", $limited_words) . "...";

			} else {
				$limited_string = $description;
			}

			if ($item['qtyCounter'] == 'YES') {
				$quantityContainer_display = 'block';
			}else{
				$quantityContainer_display = 'none';
			}


			if ($item['serviceAmount'] != 0) { 

				$html .= '<tr style="border-top:2px solid #FFEFE2;border-bottom:2px solid #FFEFE2">
				<td class="p-0 col-7 " style="color:#fff!important">
				<div class="col-md-12 m-0 p-0">
				<div class="row m-0 p-0">
				<div class="col-md-2 m-0 p-0">
				<div class="crop-center img-responsive" style="background-image: url('.ApiBaseUrl()['url'].$item['Image'].');style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030; height: 100px;width:100%;"">
				</div>

				</div>
				<div class="col-md-10" style="background-color:#005d4b!important;">
				<label class="pt-2" style="font-size:18px!important;text-shadow:1px 1px 0px black!important;">'.$item['refDataName'].'</label>
				<br>


				<div class="row m-0 p-0">
				<div class="col-md-3 m-0 p-0">
				<div class="input-group">
				<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-calendar"></i></span>

				<input type="text" id="datepicker_'.$item['_id'].'"  class="datepicker-child-events form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;" placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly>
				</div>


				</div>
				<div class="col-md-3">

				<div class="input-group">
				<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-clock-o"></i></span>

				<input type="text" id="timepicker_'.$item['_id'].'"  class="form-control form-control-sm timepicker-child-events date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;" '.(isset($item['startTime']) && $item['startTime'] !='' ? 'value="'.$item['startTime'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startTime'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').'  placeholder="--:--">
				</div>
				</div>
				</div>

				<p class="text-white mb-0 pb-2" style="line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>

				</div>
				</div>
				</div>
				</td>


				<td class="text-end col-2 align-middle" style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">'.@$currency['currencySymbol'].' <span  id="price_'.$item['_id'].'">'. price_format( $item['serviceAmount'], 2).'</span></td>
				


				<td class="text-center col-2 align-middle" style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;">

				<div class="quantity-container" style="display:'.$quantityContainer_display.'">

				<button class="minus-btn" id="minus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityMinusFunction('."'".$item["_id"]."'".')">-</button>

				<input type="number" value="'. ((in_array($item['_id'], $session_data['ids']))?  ($session_data['qty'][array_search($item['_id'], $session_data['ids'])])  :'1') .'" min="1" class="quantity-input" id="quantity-input'.$item['_id'].'" readonly>

				<button class="plus-btn" id="plus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityPlusFunction('."'".$item["_id"]."'".')">+</button>

				</div>

				</td>


				<td class="text-end col-2 align-middle"  style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">'.(@$currency['currencySymbol'] != '' ? $currency['currencySymbol'] : '$' ).' <span id="Totalprice_'.$item['_id'].'">'.((in_array($item['_id'], $session_data['ids']))?  numberFormat(($session_data['qty'][array_search($item['_id'], $session_data['ids'])] * $item['serviceAmount']), 2)  :  price_format($item['serviceAmount'], 2)).'</span></td>
				<td class="text-center col-1 align-middle" style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;">


				<div class="form-check">
				<input type="checkbox" class="form-check-input"  value="'.$item['_id'].'" '. ((in_array($item['_id'], $session_data['ids']))?'checked':'').'  data-id="'.$item['_id'].'" data-category="'.$item['serviceCategoryTypes'].'" data-service-type="'.$item['serviceTypes'].'" data-start-time="'.$item['startTime'].'" data-start-date="'.$item['startDate'].'"  data-service-name="'.$item['refDataName'].'" data-price="'.$item['serviceAmount'].'" onchange="addTocart()" name="services_id[]">
				</div>

				</td>
				</tr>
				';
			}else{
				$html .= '<tr style="border-top:2px solid #FFEFE2;border-bottom:2px solid #FFEFE2">
				<td class="p-0 col-7 " style="color:#fff!important">
				<div class="col-md-12 m-0 p-0">
				<div class="row m-0 p-0">
				<div class="col-md-2 m-0 p-0">
				<div class="crop-center img-responsive" style="background-image: url('.ApiBaseUrl()['url'].$item['Image'].');style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030; height: 100px;width:100%;"">
				</div>

				</div>
				<div class="col-md-10" style="background-color:#005d4b!important;">
				<label class="pt-2" style="font-size:18px!important;text-shadow:1px 1px 0px black!important;">'.$item['refDataName'].'</label>
				<br>


				<div class="row m-0 p-0">
				<div class="col-md-3 m-0 p-0">
				<div class="input-group">
				<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-calendar"></i></span>

				<input type="text" id="datepicker_'.$item['_id'].'"  class="datepicker-child-events form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;" placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly>
				</div>


				</div>
				<div class="col-md-3">

				<div class="input-group">
				<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-clock-o"></i></span>

				<input type="text" id="timepicker_'.$item['_id'].'"  class="form-control form-control-sm timepicker-child-events date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;" '.(isset($item['startTime']) && $item['startTime'] !='' ? 'value="'.$item['startTime'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startTime'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').'  placeholder="--:--">
				</div>
				</div>
				</div>

				<p class="text-white mb-0 pb-2" style="line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>

				</div>
				</div>
				</div>
				</td>


				<td class="text-center col-2 align-middle" style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;"> <span></span></td>
				


				<td class="text-center col-2 align-middle" style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;">

				Please&nbsp;Contact&nbsp;to&nbsp;priest.

				</td>


				<td class="text-center col-2 align-middle"  style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;"><span></span></td>

				<td class="text-center col-1 align-middle" style="background-color:#FFFFFF;color:#000000!important;font-weight:bold;">

				</td>
				</tr>';
			}
		}
		$html .= '</tbody>

		</table>';

	}
	else
	{
		$html .= '';
	}

	return $html;

}


function getServiceTypes(){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$url = ApiBaseUrl()['url'].filterAPI()['url'];
	$data = array(
		'componentConfig' => array(
			'query' => array(
				'aspectType' => 'serviceTypes',
				'status' => 'ACTIVE',
				'$or' => array(
					array('refDataCode' => 'IN-TEMPLE'),
					array('refDataCode' => 'AWAY-TEMPLE')
				)
			),
			'moduleName' => 'Master Data Management',
			'aspectType' => 'serviceTypes',
			'collectionType' => 'Business',
			'productID' => ApiBaseUrl()['productID'],
			'clientID' => ApiBaseUrl()['clientID'],
			'skip' => 0,
			'next' => 1000
		)
	);

	$headers = array(
		'Content-Type: application/json'
	);

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);

	if (curl_errno($ch)) {
		echo 'Error: ' . curl_error($ch);
	}

	curl_close($ch);

	$response = json_decode($result);

	return json_decode(json_encode($response->data), true);
}


function GetServiceCatTypes()
{
	$CI = & get_instance();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {   
		\"moduleName\": \"Master Data Management\",  
		\"productID\": \"".ApiBaseUrl()['productID']."\",   
		\"clientID\": \"".ApiBaseUrl()['clientID']."\",       
		\"aspectType\": \"serviceCategoryTypes\",     
		\"query\": {        \"aspectType\": \"serviceCategoryTypes\",  \"status\": \"ACTIVE\"},   
		\"userName\": \"\",     
		\"skip\": 0,    
		\"next\": 1020    
	} }");
	$token = $CI->session->userdata('token');
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
	return json_decode(json_encode($response->data), true);
}

function getServicesByServiceType($serviceCategory,$serviceType, $session_data){

	$CI = & get_instance();
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"componentConfig\": {\"query\": {
			\"aspectType\": \"ServiceSetup\",
			\"serviceCategoryTypes\":\"".$serviceCategory."\", 
			\"serviceTypes\":\"".$serviceType."\", 
			\"sourceTypes\":\"WEBSITE\", 
			\"status\": \"ACTIVE\" }, 
			\"moduleName\": \"Temple Services\", 
			\"aspectType\": \"ServiceSetup\", 
			\"collectionType\": \"Business\", 
			\"productID\": \"".ApiBaseUrl()['productID']."\",   
			\"clientID\": \"".ApiBaseUrl()['clientID']."\", 
			\"skip\": 0, 
			\"next\": 1024}}");

	$token = $CI->session->userdata('token');
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
	$services = json_decode(json_encode($response->data), true);
	

	$currency = GeneralSettings();
	$currencySymbol = isset($currency['currencySymbol']) ? (CheckEmptyNullVar($currency['currencySymbol']) != '' ? $currency['currencySymbol'] : '$' ) : '$';

	$html = '';


	if ($services != array()) {
		$html .= '<table class="table border-0 servicesDataTable">
		<thead class="d-none">
		<tr class="table-primary">
		<th style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Service Name</th>
		<th class="text-end" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Amount</th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		</tr>
		</thead>
		<tbody id="table">';

		foreach($services as $key => $item){ 

			$description = $item['description'];

			$words = explode(" ", $description);
			if (count($words) > 30) {
				$limited_words = array_slice($words, 0, 30);
				$limited_string = implode(" ", $limited_words) . "...";

			} else {
				$limited_string = $description;
			}

			// echo $item['qtyCounter'];

			if ($item['qtyCounter'] == 'YES') {
				$quantityContainer_display = 'inline-flex';
			}else{
				$quantityContainer_display = 'none';
			}



			if (isset($item['Image']) && !empty($item['Image'])) {
				$src = ApiBaseUrl()['url'].$item['Image'];
			}else{
				$src = base_url('assets/img/')."services-listing.png";
			}



			if (isset($item['bookingType']) && CheckEmptyNullVar($item['bookingType']) != '') {

				if ($item['bookingType'] == 'PAY NOW'  &&  $item['serviceAmount'] > 0) {
					
					$payment_btn_check = 'PAY NOW';
				}else if($item['bookingType'] == 'PAY LATER'  &&  $item['serviceAmount'] > 0){
					$payment_btn_check = 'PAY LATER';
				}else{
					$payment_btn_check = 'SERVICE REQUEST';
				}
			}else{

				if ($item['serviceAmount'] > 0) {
					$payment_btn_check = 'PAY NOW';
				}else{
					$payment_btn_check = 'SERVICE REQUEST';
				}
			}




			if ($item['serviceAmount'] != 0) { 


				$limitPerdayFeature = '';
				$BookingLimitPerDay  = CheckEmptyNullVar(@$item['BookingLimitPerDay']);
				$BookingLimitPerDay = $BookingLimitPerDay?$BookingLimitPerDay:0;

				if($BookingLimitPerDay > 0)
				{

					$limitPerdayFeature 	.= '<input type="text"  id="datepicker_'.$item['_id'].'" onclick="availabelServiceList('."'".$item['_id']."'".');"  class=" form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important; " placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly>';
				}
				else
				{
					$limitPerdayFeature 	.= '<input type="text"  id="datepicker_'.$item['_id'].'"  class="datepicker-services form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important; " placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.(@$session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly dayType="'.(isset($item['dayTypes']) && !empty($item['dayTypes']) ? $item['dayTypes'] : '').'" >';
				}
				
				if (isset($item['isDTVisible']) && $item['isDTVisible'] == 'YES') {
					$dateTimeCode = '';
					$dateTimeCode = '<div class="row m-0 p-0">
					<div class="col-md-3 m-0 p-0">
					<div class="input-group">
					<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-calendar"></i></span>

					'.$limitPerdayFeature.'
					</div>
					</div>

					<div class="col-md-3">

					<div class="input-group">
					<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-clock-o"></i></span>

					<input type="text" id="timepicker_'.$item['_id'].'"  class="form-control form-control-sm timepicker-services date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important" '.(isset($item['startTime']) && $item['startTime'] !='' ? 'value="'.$item['startTime'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startTime'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').'  placeholder="--:--" >
					</div>

					</div>

					</div>';
				}else{
					$dateTimeCode = '';
				}


				$html .= '<tr style="border-top:2px solid #FFEFE2;border-bottom:2px solid #FFEFE2">
				<td class="p-0 col-8 " style="color:#fff!important">
				<div class="col-md-12 m-0 p-0">


				<div class="row m-0 p-0">
				<div class="col-md-2 m-0 p-0">
				<div class="crop-center img-responsive bg-light" style="background-image: url('.$src.');style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030; height: 100px;width:100%;"">
				</div>
				</div>


				<div class="col-md-10" style="background-color:#005d4b!important;">
				
				<label class="pt-2" style="padding-left: 12px;font-size:20px!important;text-shadow:1px 1px 0px black!important;">'.$item['refDataName'].'</label>
				<br>


				'.$dateTimeCode.'


				<p class="text-white mb-0 pb-2" style="padding-left: 12px;line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>

				</div>
				</div>
				</div>
				</td>


				<td class="text-end col-1 d-none align-middle" style="background-color:#005D4B;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">'.@$currency['currencySymbol'].'&nbsp;<span  id="price_'.$item['_id'].'">'.(price_format($item['serviceAmount'], 2)).'</span>
				</td>
				
				<td class="text-center col-2 align-middle" style="background-color:#005d4b;color:#fff!important;font-weight:bold;">

				<div class="quantity-container" style="display:'.$quantityContainer_display.'">

				<button class="minus-btn" id="minus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityMinusFunction('."'".$item["_id"]."'".')">-</button>

				<input type="number" value="'. ((in_array($item['_id'], $session_data['ids']))?  ($session_data['qty'][array_search($item['_id'], $session_data['ids'])])  :'1') .'" min="1" class="quantity-input" id="quantity-input'.$item['_id'].'" readonly>

				<button class="plus-btn" id="plus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityPlusFunction('."'".$item["_id"]."'".')">+</button>

				</div>

				</td>


				<td class="text-end col-2 align-middle"  style="background-color:#005d4b;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">

				<div class="row m-0" style="padding-right: 37px;">
				<div class="col-md-6">
				'. ($payment_btn_check == "PAY NOW" ?  "" : "<img src=".base_url('assets/img/pay-later.png')." style='height: 35px;  width: 35px;margin-left: 10px;'></img>" ).'
				</div>
				<div class="col-md-6" style="padding-top: 6px;">
				'.@$currencySymbol['currencySymbol'].'&nbsp;<span id="Totalprice_'.$item['_id'].'">'.((in_array($item['_id'], $session_data['ids']))?   price_format(($session_data['qty'][array_search($item['_id'], $session_data['ids'])] * $item['serviceAmount']), 2)  :  price_format($item['serviceAmount'], 2)).'</span>
				</div>
				</div>
				
				</td>

				<td class="text-center col-1 align-middle" style="background-color:#005d4b;color:#000000!important;font-weight:bold;">

				

				<div class="form-check">
				<input type="checkbox" class="form-check-input"  value="'.$item['_id'].'" '. ((in_array($item['_id'], $session_data['ids']))?'checked':'').'  data-id="'.$item['_id'].'" data-category="'.$item['serviceCategoryTypes'].'" cart_category="'.($item['serviceAmount'] != '' || $item['serviceAmount'] != 0 ? $item['serviceCategoryTypes'] : 'SERVICE-REQUEST').'" data-service-type="'.$item['serviceTypes'].'" data-start-time="'.$item['startTime'].'" data-start-date="'.$item['startDate'].'"  data-service-name="'.$item['refDataName'].'" data-price="'.$item['serviceAmount'].'" data-end-date="'.$item['endDate'].'" data-end-time="'.$item['endTime'].'" data-description="'.$item['description'].'" data-image="'.$item['Image'].'" payment-btn-check="'.$payment_btn_check.'" data-BookingLimitPerDay="'.@$BookingLimitPerDay.'" onchange="addTocart()" name="services_id[]">
				</div>

				</td>
				</tr>
				';
			}else{
				$html .= '<tr style="border-top:2px solid #FFEFE2;border-bottom:2px solid #FFEFE2">
				<td class="p-0 col-7 " style="color:#fff!important">
				<div class="col-md-12 m-0 p-0">
				<div class="row m-0 p-0">
				<div class="col-md-2 m-0 p-0">
				<div class="crop-center img-responsive bg-light" style="background-image: url('.$src.');style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030; height: 100px;width:100%;"">
				</div>

				</div>
				<div class="col-md-10" style="background-color:#005d4b!important;">
				<label class="pt-2" style="padding-left: 12px;font-size:20px!important;text-shadow:1px 1px 0px black!important;">'.$item['refDataName'].'</label>
				<br>


				<div class="row m-0 p-0">
				<div class="col-md-3 m-0 p-0">
				<div class="input-group">
				<div class="input-group-addon" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;padding-right: 10px;">
				<label class="fa fa-calendar" for="datepicker_'.$item['_id'].'"></label>
				</div>

				<input type="text" id="datepicker_'.$item['_id'].'"  class="datepicker-services form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding: 0px!important;" placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly>


				</div>
				</div>
				<div class="col-md-3">

				<div class="input-group">
				<div class="input-group-addon timepicker-services" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;padding-right: 10px;">
				<label class="fa fa-clock-o" for="timepicker_'.$item['_id'].'"></label>
				</div>

				<input type="text" id="timepicker_'.$item['_id'].'"  class="timepicker-services form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding: 0px!important;" '.(isset($item['startTime']) && $item['startTime'] !='' ? 'value="'.$item['startTime'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startTime'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').'  placeholder="--:--">
				</div>
				</div>
				</div>

				<p class="text-white mb-0 pb-2" style="line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>

				</div>
				</div>
				</div>
				</td>


				


				<td class="text-center col-2 align-middle"  style="background-color:#005d4b;"><span></span></td>

				<td colspan="2" class="text-end col-2 align-middle"  style="background-color:#005d4b;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">


				<span id="Totalprice_'.$item['_id'].'">Request A Service</span>
				</td>

				<td class="text-center col-1 align-middle" style="background-color:#005d4b;color:#000000!important;font-weight:bold;">
				<div class="form-check">
				<input type="checkbox" class="form-check-input"  value="'.$item['_id'].'" '. ((in_array($item['_id'], $session_data['ids']))?'checked':'').'  data-id="'.$item['_id'].'" data-category="'.$item['serviceCategoryTypes'].'" cart_category="'.($item['serviceAmount'] != '' || $item['serviceAmount'] != 0 ? $item['serviceCategoryTypes'] : 'SERVICE-REQUEST').'" data-service-type="'.$item['serviceTypes'].'" data-start-time="'.$item['startTime'].'" data-start-date="'.$item['startDate'].'"  data-service-name="'.$item['refDataName'].'" data-price="'.($item['serviceAmount'] != '' || $item['serviceAmount'] != 0 ? $item['serviceAmount'] : 0 ).'" data-end-date="'.$item['endDate'].'" data-end-time="'.$item['endTime'].'" payment-btn-check="'.$payment_btn_check.'" data-description="'.$item['description'].'" data-image="'.$item['Image'].'"  data-BookingLimitPerDay="'.@$BookingLimitPerDay.'" onchange="addTocart()" name="services_id[]">
				</div>
				</td>
				</tr>';
			}
		}
		$html .= '</tbody>

		</table>';


	}
	else
	{
		$html .= '<div class="text-center text-danger my-5">There are no Services in this category.</div>';
	}


	return $html;
}


function GetServiceById($id){

	$serviceId = $id;
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


	return $serviceDetails = json_decode(json_encode($response->data[0]), true);

}


function price_format($price, $zeroAfterPoint){

	return sprintf("%.".$zeroAfterPoint."f", $price );
}



function getServiceAvailibiltydata($startDate, $startTime, $serviceName, $endDate='', $endTime=''){


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].getServiceAvailability()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"clientId\": \"".ApiBaseUrl()['clientID']."\", 
		\"aspectType\": \"serviceBooking\", 
		\"ServiceSetup\": \"".$serviceName."\", 
		\"startDate\": \"".$startDate."\", 
		\"endDate\": \"".$endDate."\", 
		\"serviceTypes\": \"VADAMALA\"
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


	

	return json_decode(json_encode( $response), true);
}



function getManagementCategory(){

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
			\"aspectType\": \"managementCategory\",     
			\"query\": {        
				\"aspectType\": \"managementCategory\"     
				},       
				\"skip\": 0,    
				\"next\": 1020    } }");

	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);



	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $response = json_decode($result, true);
}

function getManagementDataByManagementCategory($category, $effDate, $expDate){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"componentConfig\": {
			\"query\": {
				\"aspectType\": \"managementDirectory\",
				\"membershipCategory\":\"".$category."\",
				\"effDate\":\"".$effDate."\",
				\"expiryDate\":\"".$expDate."\" }, 
				\"moduleName\": \"Management Directory\", 
				\"aspectType\": \"managementDirectory\", 
				\"collectionType\": \"managementdata\", 
				\"productID\": \"".ApiBaseUrl()['productID']."\", 
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",  
				\"skip\": 0, \"next\": 1000
			}}");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);


	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $response = json_decode($result, true);
}



function getUserDetails(){

	$CI   = & get_instance();

	if ($CI->session->userdata('logged_in') == 1) {

		$email = base64_decode($CI->session->userdata('email'));

		if(!empty($email))
		{
			$data=array('email'=>$email,'isMobile'=>false,'phone'=>'');
		}

		$postfield=json_encode($data);

		if ($CI->session->userdata('userType') == 'Managements') {
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
		return $response = json_decode($result);


		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
	}else{
		redirect(base_url());
	}

}


function getPriest(){
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
			\"skip\": 0,    
			\"next\": 1020    
		} 
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
	return $response;
}



function getServicesDisplayGroup(){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"componentConfig\": {
			\"query\": {
				\"aspectType\": \"servicesDisplayGroup\" 
				}, 
				\"moduleName\": \"Master Data Management\", 
				\"aspectType\": \"servicesDisplayGroup\", 
				\"productID\": \"".ApiBaseUrl()['productID']."\",
				\"clientID\": \"".ApiBaseUrl()['clientID']."\",   
				\"skip\": 0, 
				\"next\": 1000
			}}");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);


	return $result;
}


function getServicesByDisplayGroup(){

	

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"componentConfig\": {\"query\": {
			\"aspectType\": \"ServiceSetup\",
			\"sourceTypes\":\"WEBSITE\", 
			\"servicesDispayGroup\":\"Religious Services\", 
			\"status\": \"ACTIVE\" 
			}, 
			\"moduleName\": \"Temple Services\", 
			\"aspectType\": \"ServiceSetup\", 
			\"collectionType\": \"Business\", 
			\"productID\": \"".ApiBaseUrl()['productID']."\",   
			\"clientID\": \"".ApiBaseUrl()['clientID']."\",  
			\"skip\": 0, 
			\"next\": 1024}}");

	
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $result;
}
function getThithiNext90Days($tithi){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].'api/event/getThithiNext90Days');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\": {\"moduleName\": \"Annual Registration\", \"aspectType\": \"annualRegistrations\",\"productID\": \"".ApiBaseUrl()['productID']."\", \"clientID\": \"".ApiBaseUrl()['clientID']."\", \"tithi\": \"".$tithi."\"}}");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	$response = json_decode($result, true);


	return $response;

}






// **********************************Rentals Functions**************************



function GetRentalTypes()
{

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].'api/appgen/filterAPI');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{      
		\"componentConfig\": {        
			\"moduleName\": \"Master Data Management\",        
			\"aspectType\": \"rentalTypes\",        
			\"productID\":\"".ApiBaseUrl()['productID']."\",        
			\"clientID\": \"".ApiBaseUrl()['clientID']."\",        
			\"query\": {          
				\"aspectType\": \"rentalTypes\"        
				},        
				\"skip\":0,        
				\"next\":100  
			}}");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);


	return json_decode($result, true);


}




function getRentalServicesByRentalTypes($refDataCode, $refDataname, $session_data = '')
{
	$CI = & get_instance();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].'api/appgen/filterAPI');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{    
		\"componentConfig\": {      
			\"moduleName\": \"Rental Setup\",      
			\"aspectType\": \"rentalSetup\",      
			\"productID\":\"".ApiBaseUrl()['productID']."\",        
			\"clientID\": \"".ApiBaseUrl()['clientID']."\",      
			\"query\": {        \"aspectType\": \"rentalSetup\", \"rentalCategory\": \"".$refDataCode."\", \"refDataCode\": \"".$refDataname."\"      },      
			\"skip\":0,      
			\"next\":100    
		}}");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);


	$response = json_decode($result, true);


	$rentals = $response['data'];

	$currency = GeneralSettings();

	$currencySymbol = isset($currency['currencySymbol']) ? (CheckEmptyNullVar($currency['currencySymbol']) != '' ? $currency['currencySymbol'] : '$' ) : '$';

	$html = '';
	// echo '<pre>';
	// print_r($rentals); die();

	if ($rentals != array()) {
		$html .= '<table class="table border-0 servicesDataTable">
		<thead class="d-none">
		<tr class="table-primary">
		<th style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Service Name</th>
		<th class="text-end" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Amount</th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		</tr>
		</thead>
		<tbody id="table">';

		foreach($rentals as $key => $item){ 

			$description = $item['shortDescription'];

			$words = explode(" ", $description);
			if (count($words) > 30) {
				$limited_words = array_slice($words, 0, 30);
				$limited_string = implode(" ", $limited_words) . "...";

			} else {
				$limited_string = $description;
			}


			if ($item['qtyCounter'] == 'YES') {
				$quantityContainer_display='<div class="quantity-container">

				<button class="minus-btn" id="minus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityMinusFunction('."'".$item["_id"]."'".')">-</button>

				<input type="number" value="'. ((in_array($item['_id'], $session_data['ids']))?  ($session_data['qty'][array_search($item['_id'], $session_data['ids'])])  :'1') .'" min="1" class="quantity-input" id="quantity-input'.$item['_id'].'" readonly>

				<button class="plus-btn" id="plus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityPlusFunction('."'".$item["_id"]."'".')">+</button>

				</div>';

			}else{

				$quantityContainer_display='<div class="quantity-container px-5"></div>';



			}



			if (isset($item['image']) && !empty($item['image'])) {
				$src = ApiBaseUrl()['url'].$item['image'];
			}else{
				$src = base_url('assets/img/services-listing.png');
			}
			if (isset($item['costPerUnit']) && $item['costPerUnit'] != 0) { 
				$limitPerdayFeature = '';
				$BookingLimitPerDay  = CheckEmptyNullVar(@$item['BookingLimitPerDay']);
				$BookingLimitPerDay = $BookingLimitPerDay?$BookingLimitPerDay:0;

				if($BookingLimitPerDay > 0)
				{

					$limitPerdayFeature 	.= '<input type="text"  id="datepicker_'.$item['_id'].'" onclick="availabelServiceList('."'".$item['_id']."'".');"  class=" form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important; " placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly>';
				}
				else
				{
					$limitPerdayFeature 	.= '<input type="text"  id="datepicker_'.$item['_id'].'"  class="datepicker-services form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important; " placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.(@$session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly dayType="'.(isset($item['dayTypes']) && !empty($item['dayTypes']) ? $item['dayTypes'] : '').'" >';
				}

				
				if (isset($item['isDTVisible']) && $item['isDTVisible'] == 'YES') {
					$dateTimeCode = '';
					$dateTimeCode = '<div class="row m-0 p-0">
					<div class="col-md-3 m-0 p-0">
					<div class="input-group">
					<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-calendar"></i></span>

					'.$limitPerdayFeature.'
					</div>
					</div>

					<div class="col-md-3">

					<div class="input-group">
					<span class="input-group-text" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;" id="basic-addon1"><i class="fa fa-clock-o"></i></span>

					<input type="text" id="timepicker_'.$item['_id'].'"  class="form-control form-control-sm timepicker-services date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important" '.(isset($item['startTime']) && $item['startTime'] !='' ? 'value="'.$item['startTime'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startTime'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').'  placeholder="--:--" >
					</div>
					</div>
					</div>';
				}else{
					$dateTimeCode = '';
				}


				$html .= '<tr style="border-top:2px solid #FFEFE2;border-bottom:2px solid #FFEFE2">
				<td class="p-0 col-6 " style="color:#fff!important">
				<div class="col-md-12 m-0 p-0">


				<div class="row m-0 p-0">
				<div class="col-md-2 m-0 p-0">
				<div class="crop-center img-responsive bg-light" style="background-image: url('.$src.');style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030; height: 100px;width:100%;"">
				</div>
				</div>


				<div class="col-md-10" style="background-color:#005d4b!important;">
				
				<label class="pt-2" style="padding-left: 12px;font-size:20px!important;text-shadow:1px 1px 0px black!important;">'.$item['refDataName'].'</label>
				<br>


				'.$dateTimeCode.'


				<p class="text-white mb-0 pb-2" style="padding-left: 12px;line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>

				</div>
				</div>
				</div>
				</td>


				<td class="text-end col-2 align-middle" style="width: 20%;background-color:#005D4B;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;"><span style="display:inline">'.@$currencySymbol['currencySymbol'].'&nbsp;'.(price_format($item['costPerUnit'], 2)).' / '.$item['unitTypes'].'</span>
				</td>
				<span style="display:none" id="price_'.$item['_id'].'">'.@$currencySymbol['currencySymbol'].'&nbsp;'.(price_format($item['costPerUnit'], 2)).'</span>
				<td class="text-center col-2 align-middle" style="background-color:#005d4b;color:#fff!important;font-weight:bold;padding-left: 70px;">

				'.$quantityContainer_display.'

				</td>


				<td class="text-end col-2 align-middle"  style="background-color:#005d4b;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">

				
				<span id="Totalprice_'.$item['_id'].'">'.@$currencySymbol['currencySymbol'].'&nbsp;'.((in_array($item['_id'], $session_data['ids']))?   price_format(($session_data['qty'][array_search($item['_id'], $session_data['ids'])] * $item['costPerUnit']), 2)  :  price_format($item['costPerUnit'], 2)).'</span>
				
				</td>

				<td class="text-center col-1 align-middle" style="background-color:#005d4b;color:#000000!important;font-weight:bold;">

				<div class="form-check">
				<input type="checkbox" class="form-check-input"  value="'.$item['_id'].'" '. ((in_array($item['_id'], $session_data['ids']))?'checked':'').'  data-id="'.$item['_id'].'" data-category="'.$item['rentalCategory'].'" data-service-type="'.$item['refDataCode'].'" data-start-time="'.@$item['startTime'].'" data-start-date="'.@$item['startDate'].'"  data-service-name="'.$item['refDataName'].'" data-price="'.$item['costPerUnit'].'" data-end-date="'.@$item['endDate'].'" data-end-time="'.@$item['endTime'].'" data-description="'.$item['shortDescription'].'" data-image="'.@$item['image'].'" data-BookingLimitPerDay="'.@$BookingLimitPerDay.'" onchange="addTocart()" name="services_id[]">
				</div>
				</td>
				</tr>
				';
			}else{
				$html .= '<tr style="border-top:2px solid #FFEFE2;border-bottom:2px solid #FFEFE2">
				<td class="p-0 col-7 " style="color:#fff!important">
				<div class="col-md-12 m-0 p-0">
				<div class="row m-0 p-0">
				<div class="col-md-2 m-0 p-0">
				<div class="crop-center img-responsive bg-light" style="background-image: url('.$src.');style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030; height: 100px;width:100%;"">
				</div>

				</div>
				<div class="col-md-10" style="background-color:#005d4b!important;">
				<label class="pt-2" style="padding-left: 12px;font-size:20px!important;text-shadow:1px 1px 0px black!important;">'.$item['refDataName'].'</label>
				<br>


				<div class="row m-0 p-0">
				<div class="col-md-3 m-0 p-0">
				<div class="input-group">
				<div class="input-group-addon" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;padding-right: 10px;">
				<label class="fa fa-calendar" for="datepicker_'.$item['_id'].'"></label>
				</div>

				<input type="text" id="datepicker_'.$item['_id'].'"  class="datepicker-services form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding: 0px!important;" placeholder="Select Date" '.(isset($item['startDate']) && $item['startDate'] !='' ? 'value="'.$item['startDate'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startDate'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').' readonly>


				</div>
				</div>
				<div class="col-md-3">

				<div class="input-group">
				<div class="input-group-addon timepicker-services" style="color: #F9F61F;background-color: #e9ecef00;border: 1px solid #ced4da00;padding-right: 10px;">
				<label class="fa fa-clock-o" for="timepicker_'.$item['_id'].'"></label>
				</div>

				<input type="text" id="timepicker_'.$item['_id'].'"  class="timepicker-services form-control form-control-sm date-time-placeholder" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding: 0px!important;" '.(isset($item['startTime']) && $item['startTime'] !='' ? 'value="'.$item['startTime'].'" disabled' : ''. ((in_array($item['_id'], $session_data['ids']))?  'value="'.($session_data['startTime'][array_search($item['_id'], $session_data['ids'])]).'"'  :'') .'').'  placeholder="--:--">
				</div>
				</div>
				</div>
				<p class="text-white mb-0 pb-2" style="line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>
				</div>
				</div>
				</div>
				</td>
				<td class="text-center col-2 align-middle"  style="background-color:#005d4b;"><span></span></td>
				<td colspan="2" class="text-end col-2 align-middle"  style="background-color:#005d4b;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">
				<span id="Totalprice_'.$item['_id'].'">Request This Facility</span>
				</td>
				<td class="text-center col-1 align-middle" style="background-color:#005d4b;color:#000000!important;font-weight:bold;">
				<div class="form-check">
				<input type="checkbox" class="form-check-input"  value="'.$item['_id'].'" '. ((in_array($item['_id'], $session_data['ids']))?'checked':'').'  data-id="'.$item['_id'].'" data-category="'.$item['rentalCategory'].'" data-service-type="'.$item['refDataCode'].'" data-start-time="'.@$item['startTime'].'" data-start-date="'.@$item['startDate'].'"  data-service-name="'.$item['refDataName'].'" data-price="'.(@$item['costPerUnit'] != '' || @$item['costPerUnit'] != 0 ? @$item['costPerUnit'] : 0 ).'" data-end-date="'.@$item['endDate'].'" data-end-time="'.@$item['endTime'].'" data-description="'.$item['shortDescription'].'" data-image="'.$item['image'].'"  data-BookingLimitPerDay="'.@$BookingLimitPerDay.'" onchange="addTocart()" name="services_id[]">
				</div>
				</td>
				</tr>';
			}
		}
		$html .= '</tbody>

		</table>';


	}
	else
	{
		$html .= '<div class="text-center text-danger my-5">There are no Services in this category.</div>';
	}


	return $html;
}


function addRentalServiceCart(){

	$data = array(
		'url'=>"api/bookingService/addRentalServiceCart"
	);
	return $data;
}

function GetCity($stateName)
{
	$CI = & get_instance();
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
		\"skip\": 0,      
		\"next\": 700    }    }");

	$headers = array();

	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);

	$response = json_decode($result);

	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	$option = '<option value="" selected disabled>Select City</option>';


	$keys = array_column($response->data, 'refDataName'); 
	array_multisort($keys, SORT_ASC, $response->data);

	foreach($response->data as $item){

		$option .= '<option value="'.$item->refDataName.'">'.$item->refDataName.'</option>';
	}

	echo $option;
}

function GetState()
{
	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"componentConfig\":    {      \"moduleName\": \"Master Data Management\",      \"productID\":\"".ApiBaseUrl()['productID']."\",      \"clientID\": \"".ApiBaseUrl()['clientID']."\",      \"aspectType\":\"stateTypes\",      \"query\": {        \"aspectType\": \"stateTypes\"      },  \"skip\": 0,      \"next\": 700    }    }");

	$headers = array();

	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);

	$response = json_decode($result);

	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $response->data;
}


function getPreferredLanguage(){
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
				\"skip\": 0,    
				\"next\": 1020    } }");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	$response = json_decode($result);

	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	return 	$response->data;
}

function GetVotingDetailsRegister($memberDirectory, $meetingname){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"componentConfig\": {
			\"moduleName\": \"Voting Detail Register\",
			\"aspectType\": \"votingDetailRegister\",
			\"productID\":\"".ApiBaseUrl()['productID']."\",
			\"clientID\": \"".ApiBaseUrl()['clientID']."\",
			\"query\": {
				\"aspectType\": \"votingDetailRegister\",
				\"Parent.refDataName1\":\"".$memberDirectory."\",
				\"Parent.refDataName\":\"".$meetingname."\"
				},
				\"skip\":0,
				\"next\":100
			}}");

	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return json_decode($result, true);

}
