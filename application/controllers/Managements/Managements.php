<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Managements extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

		if ($this->session->userdata('logged_in') != 1 && $this->session->userdata('userType') != 'Managements') {
			redirect(base_url());
		}
	}

	public function MyPayments(){


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
			$data['page'] = 'MY PAYMENTS';
			$data['title'] = 'MY PAYMENTS';
			$data['header'] = 'MY PAYMENTS';


			$this->load->view('managements/my-payments', $data);
		}
	}

	/// -----------------------------meetings -----------------------------



	public function getMeetingList(){


		$FilterDate = $this->input->post('FilterDate');


		if (isset($FilterDate)) {
			// code...
			$result = getMeetingData($FilterDate);
		}else{
			$result = getMeetingData();

		}
		$html = '';

		// print_r($result->data);

		if($result->statusCode == 1){
			

			$html .= '<table id="MeetingsList" class="table '.(!empty($result->data) ? 'table-expandable' : '').' bg-white p-4" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
			$html .= 		'<thead>';
			$html .= 			'<tr style="background-color:#008080;color:white">';

			$html .= 				'<th>Meeting&nbsp;Title</th>';
			$html .= 				'<th>Meeting&nbsp;Date</th>';
			$html .= 				'<th>Meeting&nbsp;Time</th>';
			$html .= 				'<th>Meeting&nbsp;Location</th>';

			$html .= 				'<th>Meeting&nbsp;Coordinator</th>';
			$html .=				'<th>Status</th>';
			$html .=				'<th>Action</th>';

			$html .= 			'</tr>';
			$html .=		'</thead>';
			$html .=		'<tbody>';

			if(!empty($result->data)){
				foreach ($result->data as $key => $item) {
					$html .= "<tr>";
					$html .= "<td>".camelCase($item->refDataName)."</td>";
					$html .= "<td>".$item->refDataName2."</td>";
					$html .= "<td>".$item->refDataName3."</td>";
					$html .= "<td>".camelCase($item->refDataName4)."</td>";
					$html .= "<td>".camelCase($item->refDataName5)."</td>";
					$html .= "<td>".$item->status."</td>";
					$html .= "<td><a href='".base_url('managements/meeting-details/'.base64_encode(getUserDetails()->data[0]->managementCategory).'/'.base64_encode($item->refDataName).'/'.base64_encode($item->insertedId))."'><i class='fa fa-eye'></i></a></td>";
					$html .= "</tr>";
				}}else{
					$html .= '<tr><td class="text-center" colspan="5">No Meetings Available.<td></tr>';
				}
				$html .= 	'</tbody>';
				$html .= 	'</table>';

				echo $html;
			}else{
				echo $html;
			}

		}
		public function Meetings(){

			$response = getMeetingData();


			// echo '<pre>';

			// die;

			if (is_object($response) && property_exists($response, 'statusCode') && $response->statusCode == 1) {
				$data['meeting_data'] = $response->data;
				$data['page'] = 'Meetings List';
				$data['title'] = 'Meetings List';
				$data['header'] = 'Meetings List';
				$this->load->view('managements/meetings', $data);
			}
		}


		public function getMemberDirectory(){


			$data['page'] = "MEMBER DIRECTORY";
			$data['title'] = 'MEMBER DIRECTORY';
			$data['header'] = 'MEMBER DIRECTORY';

			// $data['memberDirectory'] = json_decode(json_encode(getMemberDirectory()), true)['data'];
			// $data['ManagementGroup'] = json_decode(json_encode(ManagementGroup()), true)['data'];

			$this->load->view('managements/member-directory', $data);

		}

		public function FilterMemberDirectory() {
			$filterbyGroup = $this->input->post('selectedValue');
			$res = getMemberDirectory($filterbyGroup);


			$memberDirectory = json_decode(json_encode($res), true)['data'];

			$html = '<table id="DataTable" class="table table-hover table-responsive" style="width:100%">
			<thead>
			<tr style="background-color:#009688; color:white">
			<th style="width:200px">Name</th>
			<th style="width:150px">Designation</th>
			<th style="width:150px">Group</th>
			<th>Email</th>
			<th style="width:100px;text-align:center;">Phone</th>
			<th style="width:30px">Payment&nbsp;Status</th>
			<th style="width:30px">Good&nbsp;Standing</th>
			</tr>
			</thead><tbody>';

			// print_r($memberDirectory);
			foreach($memberDirectory as $key => $val){

				$html .= '<tr>';
				$html .= '<td>'.$val['refDataName'].'</td>';
				$html .= '<td>'.$val['managementCategory'].'</td>';
				$html .= '<td>'.$val['designation'].'</td>';
				$html .= '<td style="width:50px">'.base64_decode(@$val['email']).'</td>';
				$html .= '<td class="text-center">'.formatPhoneNumber(base64_decode(@$val['phone'])).'</td>';
				$html .= '<td class="text-center">'.(@$val['paymentStatus'] == 'PAID' ? $val['paymentStatus'] : $val['paymentStatus']).'</td>';
				$html .= '<td>'.@$val['goodStandings'].'</td>';
				$html .= '</tr>';
			}
			$html .= '</tbody></table>';
			echo $html;
		}
		public function MeetingCalendar(){


			$data['page'] = "Meeting Calendar";
			$data['title'] = 'Meeting Calendar';
			$data['header'] = 'Meeting Calendar';
			$res = json_encode(getMeetingData());

			$data['meeting_data'] = json_decode($res, true)['data'];


	// print_r($data['meeting_data']);

			$this->load->view('managements/meetingCalendar', $data);
		}

		public function Attendance($memberDirectory, $meetingname, $meetingId)
		{
			$memberDirectory =  base64_decode($memberDirectory);
			$meetingname =  base64_decode($meetingname);
			$meetingId =  base64_decode($meetingId);
			$data['meeting_data'] = json_decode(json_encode(GetMeetingsById($meetingId)), true);
			$data['page'] = 'Meeting Attendees';
			$data['title'] = 'Meeting Attendees';
			$data['header'] = 'Meeting Attendees';
			$data['attendance_data'] = GetAttendancedata($memberDirectory, $meetingname);
			$this->load->view('managements/attendance', $data);
		}

		public function meetingMinutes($memberDirectory, $meetingname, $meetingId){

			$memberDirectory =  base64_decode($memberDirectory);
			$meetingname =  base64_decode($meetingname);
			$meetingId =  base64_decode($meetingId);
			$data['meeting_data'] = json_decode(json_encode(GetMeetingsById($meetingId)), true);
			$data['page'] = 'Meeting Minutes';
			$data['title'] = 'Meeting Minutes';
			$data['header'] = 'Meeting Minutes';
			$data['meeting_minutes'] = GetMeetingMinutes($memberDirectory, $meetingname);
			$this->load->view('managements/meeting-minutes', $data);
		}


		public function meetingProfile($memberDirectory, $meetingname, $meetingId){
			$memberDirectory =  base64_decode($memberDirectory);
			$meetingname =  base64_decode($meetingname);
			$meetingId =  base64_decode($meetingId);
			$data['meeting_data'] = json_decode(json_encode(GetMeetingsById($meetingId)), true);
			$data['page'] = 'Meeting Profile';
			$data['title'] = 'Meeting Profile';
			$data['header'] = 'Meeting Profile';
			$data['meeting_minutes'] = GetMeetingMinutes($memberDirectory, $meetingname);
			$this->load->view('managements/meeting-profile', $data);
		}

		public function VotingDetailsRegister($memberDirectory, $meetingname, $meetingId){
			$memberDirectory =  base64_decode($memberDirectory);
			$meetingname =  base64_decode($meetingname);
			$meetingId =  base64_decode($meetingId);
			$data['meeting_data'] = json_decode(json_encode(GetMeetingsById($meetingId)), true);

			$data['page'] = "Voting Details Register";
			$data['title'] = 'Voting Details Register';
			$data['header'] = 'Voting Details Register';

			$data['votingDetails'] = GetVotingDetailsRegister($memberDirectory, $meetingname);

			$this->load->view('managements/voting-register', $data);
		}

		public function FilterMeeting(){
			$id =  $this->input->post('id');

			$result = GetMeetingsById($id);

			$res = $result->data;




			$response = getMeetingData(); 
			$meetingId = $response->data[0]->insertedId; 
			$meetData = GetAttendanceData($meetingId); 


			$timeIn = '';
			$timeOut = '';

			if (!empty($meetData->data)) {
				foreach($meetData->data as $key => $item){
					if ($item->memberTimeIn != '' && $item->memberTimeOut == '') {
						$timeIn = $item->memberTimeIn;
						$timeOut = '';
					}
				}
			}
	// print_r($res);

			$html = '<form action="'.base_url('Managements/Managements/submitAttendanceData').'" method="post">
			<fieldset class="border-2 bg-white">
			<legend  class="legend-outer  float-none w-auto"> Meeting Details </legend>
			<div class="row">
			'.($res[0]->refDataName ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Meeting Name</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->refDataName.'" name="refDataName" readonly></div></fieldset></div>' : '').'

			'.($res[0]->meetingMember ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Member</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingMember.'" name="meetingMember" readonly></div></fieldset></div>' : '').'

			'.($res[0]->meetingDate ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Date</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingDate.'" name="meetingDate" readonly></div></fieldset></div>' : '').'

			'.($res[0]->meetingTime ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Time</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingTime.'" name="meetingTime"  readonly></div></fieldset></div>' : '').'



			'.($res[0]->meetingLocation ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Location</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingLocation.'" name="meetingLocation"  readonly></div></fieldset></div>' : '').'


			'.($res[0]->meetingPurpose ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Purpose</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingPurpose.'" name="meetingPurpose"  readonly></div></fieldset></div>' : '').'

			'.($res[0]->meetingUrl ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Link</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingUrl.'" name="meetingUrl"  readonly></div></fieldset></div>' : '').'


			'.($res[0]->meetingSummaryNotes ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Summary Notes</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingSummaryNotes.'" name="meetingSummaryNotes"  readonly></div></fieldset></div>' : '').'

			<input type="hidden" value="'.base64_encode($res[0]->_id).'" name="MeetingId" >

			'.($res[0]->meetingOutcome ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Outcome</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingOutcome.'" name="meetingOutcome"  readonly></div></fieldset></div>' : '').'


			'.($res[0]->meetingCoordinator ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Coordinator</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->meetingCoordinator.'" name="meetingCoordinator"  readonly></div></fieldset></div>' : '').'


			'.($res[0]->contactEmail ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Email</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$res[0]->contactEmail.'" name="contactEmail"  readonly></div></fieldset></div>' : '').'

			'.($res[0]->contactPhone ? '<div class="col-md-4"><fieldset class="border"><legend  class="legend-inner float-none w-auto required">Phone</legend><div class="input-group"><input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.formatPhoneNumber($res[0]->contactPhone).'" name="contactPhone"  readonly></div></fieldset></div>' : '').'

			</div>
			</fieldset>


			<fieldset class="border-2 bg-white">
			<legend  class="legend-outer  float-none w-auto"> Time In/Out </legend>

			<div class="row">
			<div class="col-md-4">
			<fieldset class="border">
			<legend  class="legend-inner float-none w-auto required">Time In</legend>
			<div class="input-group">
			<i class="fa fa-user fa2"></i>
			<input type="text" class="form-control border-dark mb-1 " style="color:black!important;"  value="'.$timeIn.'" name="TimeIn" id="TimeIn" placeholder="00:00" readonly>
			</div>
			</fieldset>
			</div>


			<div class="col-md-4">
			<fieldset class="border">
			<legend  class="legend-inner float-none w-auto required">Time Out</legend>
			<div class="input-group">
			<i class="fa fa-user fa2"></i>
			<input type="text" class="form-control border-dark mb-1 " style="color:black!important;" value="'.$timeOut.'" name="TimeOut" id="TimeOut" placeholder="00:00" readonly>
			</div>
			</fieldset>
			</div>

			<div class="col-md-2">
			<div class="mx-auto d-block text-center my-3">
			<button type="submit" class="btn btn-outline-danger">Submit</button>
			</div>
			</div>

			<div class="col-md-2"></div>

			</div>
			</fieldset>
			</form>

			';
			print_r($html);
		}
		public function getAttendeneList(){

			$meetingId = $this->input->post('selectedValue');


			$tabledata = GetAttendanceData($meetingId);

	// print_r($tabledata);

			$html = '';

	// print_r($tabledata->data);

			if($tabledata->statusCode == 1){

				if(!empty($tabledata->data)){

					$html .= '<table id="MeetingsList" class="table '.(!empty($tabledata->data) ? 'table-expandable' : '').' bg-white p-4" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
					$html .= 		'<thead>';
					$html .= 			'<tr style="background-color:#F1F1F1">';

					$html .= 				'<th>Meeting&nbsp;Title</th>';
					$html .= 				'<th>Time&nbsp;In</th>';
					$html .= 				'<th>Time&nbsp;Out</th>';
					$html .= 				'<th>Status</th>';

					$html .= 			'</tr>';
					$html .=		'</thead>';
					$html .=		'<tbody>';

					foreach ($tabledata->data as $key => $item) {
						$html .= "<tr style='border-bottom:1px solid #80808061'><td>".camelCase($item->refDataName)."</td>";
						$html .= "<td id='TimeIn'>".$item->memberTimeIn."</td>";
						$html .= "<td style='display:inline-flex;border:0px'>".($item->memberTimeOut ? $item->memberTimeOut : '<input type="text" class="form-control border-dark mb-1 " style="color:black!important;padding: 0px!important;" name="AddTimeOut" id="AddTimeOut" placeholder="00:00"><span id="okBtn"></span>')."</td>";
						$html .= "<td>".$item->status."</td></tr>";
					}
					$html .= 	'</tbody>';
					$html .= 	'</table>';

				}else{


					if ($meetingId == 'PLEASE SELECT MEETINGS') {

						$html .= '<h3 class="text-center">Please Select Meeting!</h3>';
					}else{
						$html .= '<h3 class="text-center">No Attendance Captured Today!</h3>';

					}
				}
				echo $html;
			}else{
				echo $html;
			}


		}


		public function MeetingDetails($memberDirectory, $meetingname, $meetingId){

			$meetingId = base64_decode($meetingId);
			$data['meeting_data'] = json_decode(json_encode(GetMeetingsById($meetingId)), true);
			$data['page'] = 'Meeting Profile';
			$data['title'] = 'Meeting Profile';
			$data['header'] = 'Meeting Profile';
			$this->load->view('managements/meeting-profile', $data);

		}

	}