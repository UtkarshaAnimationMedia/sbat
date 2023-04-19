<?php

defined('BASEPATH') or exit('No direct script access allowed');

function ApiBaseUrl(){
	$data = array(
		'url'=>"https://aspgen.vaaptech.com:9000/",
		'productID'=>"62c807133d9ee4045ab78d4d",

			// Development Mode
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

		$phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
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

				$html .= '<tr style="border-top:10px solid #FFEFE2;border-bottom:10px solid #FFEFE2">
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
				$html .= '<tr style="border-top:10px solid #FFEFE2;border-bottom:10px solid #FFEFE2">
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






function getServiceTypes($serviceCategory){

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].filterAPI()['url']);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		\"componentConfig\": {\"query\": {
			\"aspectType\": \"serviceTypes\",
			\"refDataCode\":\"".$serviceCategory."\", 
			\"status\": \"ACTIVE\" }, 
			\"moduleName\": \"Master Data Management\", 
			\"aspectType\": \"serviceTypes\", 
			\"collectionType\": \"Business\", 
			\"productID\": \"".ApiBaseUrl()['productID']."\",   
			\"clientID\": \"".ApiBaseUrl()['clientID']."\",  
			\"userName\": \"ravi0390\", 
			\"skip\": 0, 
			\"next\": 220}}");

	// $token = $this->session->userdata('token');
	// $headers = array();
	// $headers[] = 'Authorization: Bearer '.$token.'';

	$headers = array();
	$headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiaGFyc2huYS5iYWpwYWk3OEBnbWFpbC5jb20iLCJleHAiOjE2NjgxMTE1NTUsImlhdCI6MTY2ODEwNzk1NX0.ZYRe7ROH6PNGWowcMmFJ1iKSwYgn461KZ8P-2edqBdo';

	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$response = json_decode($result);


			// print_r($response->data);

	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}

	curl_close($ch);
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


			// print_r($response->data);

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
			\"userName\": \"ravi6905\", 
			\"skip\": 0, 
			\"next\": 1024}}");

	$token = $CI->session->userdata('token');
	$headers = array();
	$headers[] = 'Authorization: Bearer '.$token.'';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	$response = json_decode($result);


	// print_r($response); die();

	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}

	curl_close($ch);
	$services = json_decode(json_encode($response->data), true);
	

	$currency = GeneralSettings();

	$html = '';


	if ($services != array()) {
		$html .= '<table class="table border-0 servicesDataTable">
		<thead>
		<tr class="table-primary">
		<th style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Service Name</th>
		<th class="text-end" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important">Amount</th>
		<th class="text-center" style="padding: 15px 20x;font-size: 18px;background-color:#3a4047!important;color:#fff!important"></th>
		</tr>
		</thead>
		<tbody id="table">';
		// echo '<pre>'; print_r($services); die();
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


			if ($item['serviceAmount'] != 0) { 


				$limitPerdayFeature = '';
				$BookingLimitPerDay  = CheckEmptyNullVar(@$item['BookingLimitPerDay']);
				$BookingLimitPerDay = @$BookingLimitPerDay?@$BookingLimitPerDay:0;

				if($BookingLimitPerDay > 0)
				{
					//	$limitPerdayFeature = '<a href="javascript:void(0)" id="selectDate'.$item['_id'].'" onclick="availabelServiceList('."'".$item['_id']."'".');" class="form-control form-control-sm" style="color: #ffffff;background-color: #ffffff00;opacity: 1;border: 0;padding:0px!important">Select Date </a>';
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



				$html .= '<tr style="border-top:10px solid #FFEFE2;border-bottom:10px solid #FFEFE2">
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


				<p class="text-white mb-0 pb-2" style="line-height:20px;font-size:13px!important">
				'.$limited_string.'
				</p>

				</div>
				</div>
				</div>
				</td>


				<td class="text-end col-1 align-middle" style="background-color:#005D4B;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;"><span  id="price_'.$item['_id'].'"></span>
				</td>
				


				<td class="text-center col-2 align-middle" style="background-color:#005d4b;color:#fff!important;font-weight:bold;">

				<div class="quantity-container" style="display:'.$quantityContainer_display.'">

				<button class="minus-btn" id="minus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityMinusFunction('."'".$item["_id"]."'".')">-</button>

				<input type="number" value="'. ((in_array($item['_id'], $session_data['ids']))?  ($session_data['qty'][array_search($item['_id'], $session_data['ids'])])  :'1') .'" min="1" class="quantity-input" id="quantity-input'.$item['_id'].'" readonly>

				<button class="plus-btn" id="plus-btn'.$item['_id'].'" type="button" style="background-color: #005D4B;color:white" onclick="quantityPlusFunction('."'".$item["_id"]."'".')">+</button>

				</div>

				</td>


				<td class="text-end col-2 align-middle"  style="background-color:#005d4b;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;">
				<span id="Totalprice_'.$item['_id'].'">'.@$currency['currencySymbol'].' '.((in_array($item['_id'], $session_data['ids']))?   price_format(($session_data['qty'][array_search($item['_id'], $session_data['ids'])] * $item['serviceAmount']), 2)  :  price_format($item['serviceAmount'], 2)).'</span>
				</td>

				<td class="text-center col-1 align-middle" style="background-color:#005d4b;color:#000000!important;font-weight:bold;">


				<div class="form-check">
				<input type="checkbox" class="form-check-input"  value="'.$item['_id'].'" '. ((in_array($item['_id'], $session_data['ids']))?'checked':'').'  data-id="'.$item['_id'].'" data-category="'.$item['serviceCategoryTypes'].'" data-service-type="'.$item['serviceTypes'].'" data-start-time="'.$item['startTime'].'" data-start-date="'.$item['startDate'].'"  data-service-name="'.$item['refDataName'].'" data-price="'.$item['serviceAmount'].'" data-end-date="'.$item['endDate'].'" data-end-time="'.$item['endTime'].'" data-description="'.$item['description'].'" data-image="'.$item['Image'].'"  data-BookingLimitPerDay="'.$BookingLimitPerDay.'" onchange="addTocart()" name="services_id[]">
				</div>

				</td>
				</tr>
				';
			}else{
				$html .= '<tr style="border-top:10px solid #FFEFE2;border-bottom:10px solid #FFEFE2">
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


				<td class="text-center col-2 align-middle" style="background-color:#005d4b;color:#fff!important;font-weight:bold;font-size:18px!important;padding: 5px 5px!important;"> <span></span></td>
				


				<td class="text-center col-2 align-middle" style="background-color:#005d4b;color:#fff!important;font-weight:bold;">

				Please&nbsp;Contact&nbsp;to&nbsp;priest.

				</td>


				<td class="text-center col-2 align-middle"  style="background-color:#005d4b;"><span></span></td>

				<td class="text-center col-1 align-middle" style="background-color:#005d4b;">

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