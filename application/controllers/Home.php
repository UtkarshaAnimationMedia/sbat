<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

		$currency = '';

		$this->$currency =  GeneralSettings();

	}


	public function index()
	{
		$data['page'] = 'Home';
		$data['slider_image'] = $this->mongo_db2->where(['aspectType'=>'bannerImages'])->get('wesiteSettings');

		$this->mongo_db2->sort("eventDate", 'DESC');
		$data['upcoming_events'] = $this->mongo_db2->where(['aspectType'=>'ServiceSetup','serviceCategoryTypes'=>'EVENTS', 'sourceTypes'=>'WEBSITE'])->get('businessdata');
		$this->load->view('home',$data);
	}


	public function GetUpcomingEventById($eventName, $eventId){

		$data['page'] = 'Event';
		$serviceId = $eventId;
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
		$data['serviceDetails'] = json_decode(json_encode($response->data[0]), true);

		$this->load->view('event-details',$data);

	}




	public function getpanchangamData(){
		$lat = $this->input->post('lat');
		$long = $this->input->post('long');
		$tzone = $this->input->post('tzone');

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$hours = date('H');
		$minute = date('i');

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

		$panchangam = json_decode(json_encode($response), true);
		$html = '';
		$html .= '<table class="table table-responsive table-bordered table-striped" style="border-color:#642318">
		<tbody>
		<tr>
		<td>Day</td>
		<td>'.$panchangam['day'].'</td>
		</tr>
		<tr>
		<td>Tithi</td>
		<td>'.$panchangam['tithi'].'</td>
		</tr>
		<tr>
		<td>Nakshatra</td>
		<td>'.$panchangam['nakshatra'].'</td>
		</tr>
		<tr>
		<td>Yog</td>
		<td>'.$panchangam['yog'].'</td>
		</tr>
		<tr>
		<td>Karan</td>
		<td>'.$panchangam['karan'].'</td>
		</tr>
		<tr>
		<td>Sunrise</td>
		<td>'.$panchangam['sunrise'].'</td>
		</tr>
		<tr>
		<td>Sunset</td>
		<td>'.$panchangam['sunset'].'</td>
		</tr>
		<tr>
		<td>Vedic Sunrise</td>
		<td>'.$panchangam['vedic_sunrise'].'</td>
		</tr>
		<tr>
		<td>Vedic Sunset</td>
		<td>'.$panchangam['vedic_sunset'].'</td>
		</tr>
		</tbody>
		</table>';
		echo json_encode($html);

	}

	public function Calendar()
	{
		$data['title'] = 'Calendar';
		$data['page'] = 'Calendar';
		$data['calendar_events'] = $this->mongo_db2->where(['aspectType'=>'templeCalendar'])->get('calendarCollection');

		// echo '<pre>';
		// print_r($data['calendar_events']);

		$this->load->view('calendar', $data);
	}

	public function Gallery()
	{
		$data['page'] = 'Gallery';
		$data['title'] = 'Gallery';
		$data['gallery_data'] = $this->mongo_db2->where(['aspectType'=>'gallerySettings'])->get('wesiteSettings');

		// echo '<pre>';
		// print_r($data['gallery_data']);
		$this->load->view('gallery',$data);
	}

	public function FilterGalleryBy($refDataname,$id)
	{
		$data['page'] = 'Gallery';
		$res = $this->mongo_db2->where(['aspectType'=>'gallerySettings'])->get('wesiteSettings');
		// print_r($res);
		foreach($res as $item){
			// echo '<pre>';
			if ($item['_id'] == $id) {

				// print_r($item['Parent']);

				$data['parent_data'] = $item['Parent'];
				$data['Child_Grid'] = $item['Child Grid'];
			}
		}

		$this->load->view('filtered-gallery',$data);
	}


//*************  Donations Funtions start  *************

	public function Donations()
	{
		$data['page'] = 'Donations';
		$data['title'] = 'Donations';
		$data['service_cat_types'] = $this->getDonationsCatTypes();
		// print_r($data);

		

		$this->load->view('donations',$data);
	}

	public function getDonationsByCategory($cat=''){

		return $res = $this->mongo_db2->where(['aspectType'=>'ServiceSetup','serviceTypes'=>$cat, 'status' => 'ACTIVE'])->get('businessdata');

	}
	public function getDonationsCatTypes(){

		

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
			\"aspectType\": \"serviceTypes\",     
			\"query\": {        \"aspectType\": \"serviceTypes\", \"refDataCode\": \"DONATIONS\", \"status\": \"ACTIVE\" },   
			\"userName\": \"\",     
			\"skip\": 0,    
			\"next\": 1020    
		} }");
		$headers = array();
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


	public function getDonations()
	{

		$currency = '';
		$currencySymbol = $this->$currency;


		$serviceTypes = $this->input->post('param');

		$data = $this->mongo_db2->where(['aspectType'=>'ServiceSetup','serviceTypes'=>$serviceTypes, 'status' => 'ACTIVE', 'sourceTypes' => 'WEBSITE' ])->get('businessdata');

		

		// echo json_encode($data);
		//  die();

		$html = '';

		$i = 1;

		if ($data != array()) {

			foreach($data as $skey => $item){




				if (isset($item['Image']) && !empty($item['Image'])) {
					$src = ApiBaseUrl()['url'].$item['Image'];
				}else{
					$src = base_url('assets/img/')."srihanuman-watermark.png";
				}

				if(strlen($item['refDataName']) > 100){
					$serviceName =  substr($item['refDataName'],0,100).'.....'; 
				}
				else{ 
					$serviceName = $item['refDataName'];
				}

				$ServicePrice = str_replace("$","",$item['serviceAmount']);

				$html .= '<div class="col-md-6 col-xl-6 my-3">
				<div class="card shadow-0 border rounded-3 p-0" style="background:#FDF295">
				<div class="card-body">
				<div class="row m-0 p-0">
				<div class="col-md-12 col-lg-3 col-xl-2 mb-4 mb-lg-0">
				<div class="bg-image hover-zoom ripple rounded ripple-surface">

				<a href="javascript:void(0)"65 data-bs-toggle="modal" data-bs-target="#service_deatils'.$i.'">
				<img class="center-cropped" src="'.$src.'" style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030;height:70px;width="100%" />
				</a>

				<a href="#!">
				<div class="hover-overlay">
				<div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
				</div>
				</a>
				</div>
				</div>
				<div class="col-md-6 col-lg-6 col-xl-6">
				<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#service_deatils'.$i.'">
				<h4 style="font-size: 18px;font-weight:bold;color:#ce0000!important;1px 0px 0px #f1ff0b!important;" data-nokey="'.$skey.'">'.camelCase($serviceName).'</h4>
				</a>

				<div class="modal fade" id="service_deatils'.$i.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title bottomborder mx-auto d-block fw-bold text-uppercase" id="staticBackdropLabel">Detailed Information</h5>
				<button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">  
				<div class="example-card-img-responsive mb-2">
				<img src="'.$src.'" class="img-responsive mx-auto d-block img-thumbnail" style="    border-radius: 50%;height: 195px;width: 195px;" ></img>
				</div>
				<table class="table table-responsive table-bordered table-striped">
				<tbody>
				'.($item['refDataName'] ? "<tr><th>Service Name</th><td>".$item['refDataName']."</td></tr>" : "").'
				'.($item['serviceTypes'] ? "<tr><th>Service Type</th><td>".$item['serviceTypes']."</td></tr>" : "").'
				'.($item['serviceCategoryTypes'] ? "<tr><th>Service Category</th><td>".$item['serviceCategoryTypes']."</td></tr>" : "").'
				'.($item['dayTypes'] ? "<tr><th>Day</th><td>".$item['dayTypes']."</td></tr>" : "").'
				'.($item['startDate'] ? "<tr><th>Start Date</th><td>".$item['startDate']."</td></tr>" : "").'
				'.($item['startTime'] ? "<tr><th>Start Time</th><td>".$item['startTime']."</td></tr>" : "").'
				'.($item['serviceAmount'] ? "<tr><th>Service Amount</th><td>".@$currencySymbol['currencySymbol'].' '.sprintf("%.2f", $item['serviceAmount'])."</td></tr>" : "").'
				</tbody>
				</table>
				</div>
				</div>
				</div>
				</div>

				<div class="mt-1 mb-0 text-muted small">
				<span>'.($item["startTime"] ? '<i class="fa fa-calendar" style="color:#ce0000"></i> '.$item["startDate"] : '').'</span><br>
				<span>'.($item["startTime"] ? '<i class="fa fa-clock-o" style="color:#ce0000"></i> '.$item["startTime"] : '').'</span>

				</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-4 border-sm-start-none border-start">
				<div class="d-flex flex-row align-items-center mt-1">
				<h4 style="font-size: 22px;font-weight:bold;color:#ce0000!important" class="mb-1 me-1">'.($ServicePrice != 0.00 ? $currencySymbol['currencySymbol'].' '.sprintf("%.2f", $ServicePrice) : "&nbsp;").'</h4>
				</div>
				<div class="d-flex flex-column" >

				'. "<a href='javascript:void(0)' class='btn btn-primary btn-sm checkoutbtn' style='float: right;background: #910301; border: 1px solid yellow;' onclick='checkLoginStatus(".'"'.$ServicePrice.'"'.", ".'"'.str_replace("'", "`", $item['refDataName']).'"'.", ".'"'.$item["_id"].'"'.", ".'"'.$item["serviceCategoryTypes"].'"'.",".'"'.$item["serviceTypes"].'"'.",".'"'.$item["dayTypes"].'"'.", ".'"'.$item["startDate"].'"'.", ".'"'.$item["startTime"].'"'.")'>DONATE NOW</a>".'
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>';
				$i++;

			}
		}else{
			$html = '<span class="fw-bold text-muted text-center mt-5 mb-3" style="font-size:20px">No Donations Available In This Category.</span>';
		}
		echo json_encode($html);

	}

	//*************  Donations Funtions End  *************



	//*************  Services Funtions Start  *************
	public function Services()
	{
		
		
		$data['page'] = 'Services';
		$data['title'] = 'Services';
		$data['service_cat_types'] = $this->GetServiceCatTypes();
		$this->load->view('services',$data);
	}


	public function GetServiceCatTypes()
	{
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
		return json_decode(json_encode($response->data), true);
	}

	public function getServiceDetailsById()
	{
		$this->session->unset_userdata('serviceDetails');

		$serviceId = $this->input->post('serviceId');
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
		$serviceDeails = json_decode(json_encode($response->data[0]), true);

		echo json_encode($serviceDeails);
	}



	public function getServices(){

		$serviceTypes = $this->input->post('param');

		$data = $this->mongo_db2->where(['aspectType'=>'ServiceSetup', 'serviceCategoryTypes'=> $serviceTypes, 'sourceTypes' => 'WEBSITE', 'status' => 'ACTIVE'])->get('businessdata');


		$html = '';

		if ($data != array()) {
			$i = 1;
			foreach($data as $skey => $item){
				if (isset($item['Image']) && !empty($item['Image'])) {
					$src = ApiBaseUrl()['url'].$item['Image'];
				}else{
					$src = base_url('assets/img/')."srihanuman-watermark.png";
				}

				$ServicePrice = str_replace("$","",$item['serviceAmount']);


				if(sprintf("%.2f", $ServicePrice) == 0.00 ){


					$serviceName = $item['refDataName'];


					$html .= '<div class="col-md-6 col-xl-6 my-3">
					<div class="card shadow-0 border rounded-3 p-0">
					<div class="card-body">
					<div class="row m-0 p-0">
					<div class="col-md-12 col-lg-4 col-xl-4 mb-4 mb-lg-0">
					<div class="bg-image hover-zoom ripple rounded ripple-surface">

					<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#service_deatils'.$i.'">
					<img  src="'.$src.'" style="height:auto;width:120px;border-radius: 9px;box-shadow: 2px 2px 10px #00000030;" />
					</a>

					<a href="#!">
					<div class="hover-overlay">
					<div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
					</div>
					</a>
					</div>
					</div>
					<div class="col-md-6 col-lg-8 col-xl-8 py-3">
					<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#service_deatils'.$i.'">
					<h4 style="font-size: 18px;font-weight:bold;" data-nokey="'.$skey.'" class="title">'.camelCase($serviceName).'</h4>
					</a>
					<a href="'.base_url('contact-us').'">
					<span style="background-color: #f6e54c!important;color: black;padding: 9px 18px;font-size:14px"> Please contact the priest for more details</span>
					</a>

					<div class="modal fade" id="service_deatils'.$i.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title bottomborder mx-auto d-block fw-bold text-uppercase" id="staticBackdropLabel">Detailed Information</h5>
					<button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">  
					<div class="example-card-img-responsive mb-2">
					<img src="'.$src.'" class="img-responsive mx-auto d-block img-thumbnail" style="    border-radius: 50%;height: 195px;width: 195px;" ></img>
					</div>
					<table class="table table-responsive table-bordered table-striped">
					<tbody>
					'.($item['refDataName'] ? "<tr><th>Service Name</th><td>".$item['refDataName']."</td></tr>" : "").'
					'.($item['serviceTypes'] ? "<tr><th>Service Type</th><td>".$item['serviceTypes']."</td></tr>" : "").'
					'.($item['serviceCategoryTypes'] ? "<tr><th>Service Category</th><td>".$item['serviceCategoryTypes']."</td></tr>" : "").'
					'.($item['dayTypes'] ? "<tr><th>Day</th><td>".$item['dayTypes']."</td></tr>" : "").'
					'.($item['startDate'] ? "<tr><th>Start Date</th><td>".$item['startDate']."</td></tr>" : "").'
					'.($item['startTime'] ? "<tr><th>Start Time</th><td>".$item['startTime']."</td></tr>" : "").'
					'.($item['serviceAmount'] ? "<tr><th>Service Amount</th><td>$".sprintf("%.2f", $item['serviceAmount'])."</td></tr>" : "").'
					</tbody>
					</table>
					</div>
					</div>
					</div>
					</div>

					<div class="mt-1 mb-0 text-muted small">
					<span>'.($item["startTime"] ? '<i class="fa fa-calendar" style="color:#910301"></i> '.$item["startDate"] : '').'</span><br>
					<span>'.($item["startTime"] ? '<i class="fa fa-clock-o" style="color:#910301"></i> '.$item["startTime"] : '').'</span>

					</div>
					</div>
					</div>
					</div>
					</div>
					</div>';
				}else{
					if(strlen($item['refDataName']) > 100)
						{$serviceName =  substr($item['refDataName'],0,100).'.....'; }
					else{ $serviceName = $item['refDataName'];}
					$html .= '<div class="col-md-6 col-xl-6 my-3">
					<div class="card shadow-0 border rounded-3 p-0">
					<div class="card-body">
					<div class="row m-0 p-0">
					<div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
					<div class="bg-image hover-zoom ripple rounded ripple-surface">

					<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#service_deatils'.$i.'">
					<img class="center-cropped" src="'.$src.'" style="border-radius: 9px;box-shadow: 2px 2px 10px #00000030;" />
					</a>

					<a href="#!">
					<div class="hover-overlay">
					<div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
					</div>
					</a>
					</div>
					</div>
					<div class="col-md-6 col-lg-6 col-xl-6">
					<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#service_deatils'.$i.'">
					<h4 style="font-size: 18px;font-weight:bold;" data-nokey="'.$skey.'" class="title">'.camelCase($serviceName).'</h4>
					</a>

					<div class="modal fade" id="service_deatils'.$i.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title bottomborder mx-auto d-block fw-bold text-uppercase" id="staticBackdropLabel">Detailed Information</h5>
					<button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">  
					<div class="example-card-img-responsive mb-2">
					<img src="'.$src.'" class="img-responsive mx-auto d-block img-thumbnail" style="    border-radius: 50%;height: 195px;width: 195px;" ></img>
					</div>
					<table class="table table-responsive table-bordered table-striped">
					<tbody>
					'.($item['refDataName'] ? "<tr><th>Service Name</th><td>".$item['refDataName']."</td></tr>" : "").'
					'.($item['serviceTypes'] ? "<tr><th>Service Type</th><td>".$item['serviceTypes']."</td></tr>" : "").'
					'.($item['serviceCategoryTypes'] ? "<tr><th>Service Category</th><td>".$item['serviceCategoryTypes']."</td></tr>" : "").'
					'.($item['dayTypes'] ? "<tr><th>Day</th><td>".$item['dayTypes']."</td></tr>" : "").'
					'.($item['startDate'] ? "<tr><th>Start Date</th><td>".$item['startDate']."</td></tr>" : "").'
					'.($item['startTime'] ? "<tr><th>Start Time</th><td>".$item['startTime']."</td></tr>" : "").'
					'.($item['serviceAmount'] ? "<tr><th>Service Amount</th><td>$".sprintf("%.2f", $item['serviceAmount'])."</td></tr>" : "").'
					</tbody>
					</table>
					</div>
					</div>
					</div>
					</div>

					<div class="mt-1 mb-0 text-muted small">
					<span>'.($item["startTime"] ? '<i class="fa fa-calendar" style="color:#910301"></i> '.$item["startDate"] : '').'</span><br>
					<span>'.($item["startTime"] ? '<i class="fa fa-clock-o" style="color:#910301"></i> '.$item["startTime"] : '').'</span>

					</div>
					</div>
					<div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
					<div class="d-flex flex-row align-items-center my-3">
					<h4 style="font-size: 22px;font-weight:bold;" class="me-1">'.($ServicePrice ? '$ '.sprintf("%.2f", $ServicePrice) : '$0.00').'</h4>
					</div>
					<div class="d-flex flex-column mt-1">

					'. "<a href='javascript:void(0)' class='btn btn-primary btn-sm checkoutbtn' style='float: right;background: #910301; border: 1px solid white;' onclick='checkLoginStatus(".'"'.$ServicePrice.'"'.", ".'"'.str_replace("'", "`", $item['refDataName']).'"'.", ".'"'.$item["_id"].'"'.", ".'"'.$item["serviceCategoryTypes"].'"'.",".'"'.$item["serviceTypes"].'"'.",".'"'.$item["dayTypes"].'"'.", ".'"'.$item["startDate"].'"'.", ".'"'.$item["startTime"].'"'.")'>BOOK NOW</a>".'
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>';
				}

				$i++;

			}
		}else{
			$html .= '<span class="fw-bold text-muted text-center mt-5 mb-3" style="font-size:20px">No Services Available In This Category.</span>';
		}
		echo json_encode($html);
	}

//*************  Services Funtions end  *************


	public function checkLoginStatus(){
		if ($this->session->userdata('logged_in') == 1) {
			echo json_encode(1);
		}else{
			echo json_encode(0);
		}
	}



	public function SignUp(){

		if (!empty($this->input->post('fname')) || !empty($this->input->post('email')) || !empty($this->input->post('email'))) {
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$countryCode = $this->input->post('countryCode');
			$data=array('refDataName'=>$fname.' '.$lname,'email'=>$email,'phone'=>$phone,'countryCode'=>$countryCode);
			$postfield=json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerSignup()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
				\n      \"componentConfig\": {\n        \"moduleName\": \"".customerSignup()['moduleName']."\",\n        \"productID\": \"".ApiBaseUrl()['productID']."\",\n        \"clientID\": \"".ApiBaseUrl()['clientID']."\"\n    }}");

			$headers = array();
			$headers[] = 'Content-Type:application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);

			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);
			echo json_encode($result);

		}else {
			echo 'Something Went Wrong!!';
		}

	}

	public function Login(){


		if (!empty($this->input->post('email')) || !empty($this->input->post('phone'))) {


			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$LoginTabName = $this->input->post('LoginTabName');


			if ($LoginTabName == 'Management') {
				$moduleName = 'Management Directory';
			}else{
				$moduleName = customerLogin()['moduleName'];
			}

			if(!empty($email))
			{
				$data=array('email'=>$email,'isMobile'=>false,'phone'=>$phone);
			}
			else
			{
				$data=array('email'=>$email,'isMobile'=>true,'phone'=>$phone);
			}

			$postfield=json_encode($data);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
				\n      \"componentConfig\": {\n        \"moduleName\": \"".$moduleName."\",\n        \"productID\": \"".ApiBaseUrl()['productID']."\",\n        \"clientID\": \"".ApiBaseUrl()['clientID']."\"\n    }}");
			$headers = array();
			$headers[] = 'Content-Type:application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			$response = json_decode($result);


			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}

			// $response->statusCode == 1;
			if ($response->statusCode == 1) {
				if($email!="" || $this->input->post('sessionCreate') == 1){

					$logged_in_sess = array(
						'id'           => $response->data[0]->_id,
						'refDataName'         => $response->data[0]->refDataName,
						'email'         => $response->data[0]->email,
						'phone'       => $response->data[0]->phone,
						'logged_in'    => 1,
						'token' => $response->data[0]->token,
						'memberTypes' => $response->data[0]->memberTypes,
						'address' => @$response->data[0]->address

					);
					$this->session->set_userdata($logged_in_sess);
				}
				$response->statusCode = 1;
				echo json_encode($response);
			}else{
				echo json_encode('User not found!!');
			}

		}else {
			echo json_encode('Something Went Wrong!!');
		}
	}


	public function sendEmailOTP()
	{



		$email = $this->input->post('email'); 


		$data=array('email'=>$email,'isMobile'=>false,'phone'=>'');



		$postfield=json_encode($data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].customerLogin()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"dataJson\": $postfield,
			\n      \"componentConfig\": {\n        \"moduleName\": \"".customerLogin()['moduleName']."\",\n        \"productID\": \"".ApiBaseUrl()['productID']."\",\n        \"clientID\": \"".ApiBaseUrl()['clientID']."\"\n    }}");
		$headers = array();
		$headers[] = 'Content-Type:application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		$response = json_decode($result);




		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}

			// $response->statusCode == 1;
		if ($response->statusCode == 1) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].sendEmailOTP()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"emailID\":\"".$email."\",\"clientID\":\"".ApiBaseUrl()['clientID']."\"}");

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			$response = json_decode($result);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			if($response->user->statusCode==0)
			{
				$response->user->statusCode = '2';
			}

			echo json_encode($response->user);
		}
		else
		{
			echo json_encode($response);
		}



		/*--------------------------*/




	}

	public function verifyEmailOTP(){

		$otp = $this->input->post('otp');
		$email = $this->input->post('email');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].verifyEmailOTP()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"emailID\":\"".$email."\",\"code\":\"".$otp."\"}");

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$response = json_decode($result);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		echo json_encode($response->user);

	}




	///MOBILE NUMBER AUTH
	public function sendMobileOTP()
	{
		$phone = $this->input->post('phone'); 
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].sendEmailOTP()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"emailID\": \"".$phone."\"}");

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$response = json_decode($result);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);


		echo json_encode($response->user);
	}



	public function addServiceCart(){
		//Post data
		$email 			= 			$this->input->post('email');
		$fname 			= 			$this->input->post('fname');
		$lname 			= 			$this->input->post('lname');
		$transactionId 	= 			$this->input->post('transaction_id');
		$serviceAmount 	= 			$this->input->post('serviceAmount');
		$totalAmount 	= 			$this->input->post('serviceAmount');

		$service_Id 	= 			$this->input->post('service_Id');
		$service_name 	= 			$this->input->post('serviceName');

		$serviceCategoryTypes 	= 			$this->input->post('serviceCategoryTypes');
		$serviceTypes 	= 			$this->input->post('serviceTypes');

		$start_date 	= 			$this->input->post('startDate');
		$qty 			= 			$this->input->post('qty');
		$time 			= 			$this->input->post('startTime');
		$day 			= 			$this->input->post('dayTypes');

		$serviceAddress 			= 			$this->input->post('serviceAddress');

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

			\"data\": [{              
				\"_id\": \"".$service_Id."\", 
				\"serviceName\": \"".$service_name."\", 
				\"serviceCategory\": \"".$serviceCategoryTypes."\", 
				\"serviceType\": \"".$serviceTypes."\", 
				\"serviceAmount\": ".$serviceAmount.", 
				\"startDate\":\"".$start_date."\" , 
				\"qty\": ".$qty.", 
				\"time\": \"".$time."\", 
				\"day\":\"".$day."\" , 
				\"serviceAddress\":\"".$serviceAddress."\"  
				}], 

				\"paymentType\": \"CREDIT CARD\", 
				\"bankName\":\"\" ,
				\"chequeNo\":\"\" , 
				\"chequeAmount\":\"\" , 
				\"chequeDate\": \"\", 
				\"totalAmount\": ".$totalAmount.", 
				\"transactionId\":\"".$transactionId."\",
				\"source\":\"WEBSITE\",
				\"stationName\":\"WEBSITE\",
				\"userId\":\"\",
				\"stationId\":\"WEBSITE\"

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
			$this->updateTransactionStatus($response2->data[0]->_id, $response2->data[0]->invoiceNo, $transactionId);
		}

		echo json_encode($response2);
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
		// $headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiaGFyc2huYS5iYWpwYWk3OEBnbWFpbC5jb20iLCJleHAiOjE2NzEzNTIyNjEsImlhdCI6MTY2ODc2MDI2MX0.6_HS79UUye5MGWTdgZ13UDTBm4UEyErCY9Cy64Wsn54';

		$headers[] = 'Authorization: Bearer '.$token.'';

		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$response = json_decode($result);

	}
	public function contact_us(){
		$data['page'] = 'CONTACT-US';
		$data['title'] = 'CONTACT-US';
		$this->load->view('contact_us',$data);
	}


	public function submitContactForm(){
		$to = $this->input->post('email');
		$subject = 'Boston Sri Kalikambal Shiva Temple';
		$msg = $this->input->post('message');


		$phone = $this->input->post('phone');

		$new_phone = str_replace('-', '', $phone);

		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$purpose = $this->input->post('purpose');


		$captcha_response = trim($this->input->post('g-recaptcha-response'));

		if($captcha_response != ''){

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].sendContactEmail()['url']);


			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{        
				\"firstName\":\"".$fname."\",        
				\"lastName\": \"".$lname."\",        
				\"phone\": \"".$new_phone."\",        
				\"email\": \"".$to."\",        
				\"purpose\":\"".$purpose."\",        
				\"message\":\"".$msg."\",        
				\"clientID\":\"".ApiBaseUrl()['clientID']."\"      
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


			// print_r($response);


			if ($response->statusCode == 1) {
				$this->session->set_flashdata('success','We will contact you as soon as possible.');
				redirect(base_url('contact-us'),'refresh');
			}else{
				$this->session->set_flashdata('failure','Something went wrong!');
				redirect(base_url('contact-us'),'refresh');
			}
		}else{
			$this->session->set_flashdata('failure','Captcha Validation Failed');
			redirect(base_url('contact-us'),'refresh');
		}

	}

	public function Logout(){
		$this->session->sess_destroy();
		$this->session->unset_userdata('logged_in');
		redirect(base_url());
	}



		// *************************++++++++++++++++++++****************************



	public function allUpcomingEvents(){
		$data['page'] = 'Upcoming Events';
		$data['title'] = 'Upcoming Events';
		$data['upcoming_events'] = $this->mongo_db2->where(['aspectType'=>'ServiceSetup','serviceCategoryTypes'=>'EVENTS', 'sourceTypes'=>'WEBSITE'])->get('businessdata');

		// echo '<pre>';
		// print_r($data['upcoming_events']);


		$this->load->view('all-upcoming-events', $data);
	}


	public function AddServicetoSession()
	{


		if($this->input->post('id'))
		{	
			$data = $this->input->post();

			$array = array();
			foreach ($this->input->post('id') as $key => $value) {

				$array[] = array(
					'_id' => $data['id'][$key],
					'serviceName' => $data['serviceName'][$key],

					// 'serviceCategory' => $data['serviceCategory'][$key],
					// 'serviceType' => $data['serviceType'][$key],

					'serviceAmount' => $data['serviceAmount'][$key],
					'startDate' => $data['startDate'][$key],


					'qty' => $data['qty'][$key],

					'time' => $data['startTime'][$key],
					// 'day' => $data['day'][$key],

					// 'serviceAddress' => $data['serviceAddress'][$key],

				);
			}

			$newArray = array(
				'totalPrice' => sprintf("%.2f", $this->input->post('totalPrice')),
				'itemList' => $array,
			);

			$this->session->set_userdata('service_cart', $newArray);
		}


		print_r($newArray);

		$response = array('status' => '1', 'message' => "Success");
		echo json_encode($response);


	}


	public function SubscribeNewsletter(){

		// print_r($this->session->userdata());

		if ($this->session->userdata('logged_in') == 1) {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].SubscribeNewsletter()['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{
				\"dataJson\": {
					\"MemberId\": \"".$this->session->userdata('id')."\",
					\"Email\": \"".base64_decode($this->session->userdata('email'))."\",
					\"DOB\": \"\",
					\"Name\": \"".$this->session->userdata('refDataName')."\",
					\"Mobile\": \"".$this->session->userdata('phone')."\",
					\"City\": \"\",
					\"State\": \"\",
					\"Nakshatram\": \"\",
					\"Gothram\": \"\",
					\"ZipCode\": \"\",
					\"SpouseName\": \"\",
					\"ChildrenDetails\": \"\",
					\"recCreDate\": \"\",
					\"menberType\": \"".$this->session->userdata('memberTypes')."\"
					},
					\"clientId\": \"".ApiBaseUrl()['clientID']."\"
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

			// print_r($response);

			if (isset($response)) {
				if ($response->statusCode == 1) {
					echo json_encode('Yo have successfully subscribed our newsletter.');
				}elseif($response->statusCode == -1){
					echo json_encode('You are already subscribed our newsletter!');
				}
			}
			else{
				echo 	'Something went wrong! Please contact to Administration or Admin.';
			}

		}else{
			redirect(base_url());
		}


	}




	public function getServiceAvailability(){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].getServiceAvailability()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
			\"clientId\": \"".ApiBaseUrl()['clientID']."\",
			\"aspectType\": \"serviceBooking\",
			\"ServiceSetup\": \"Vadamala Pooja (108 Vadas)\",
			\"startDate\": \"2023-02-01\",
			\"endDate\": \"2023-02-31\",
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


		print_r($response);
	}

}
