<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');

	}

	public function Volunteers()
	{
		$data['page'] = 'Volunteers-Form';
		$data['title'] = 'Volunteers Form';
		$this->load->view('volunteers',$data);
	}


	public function AddVolunteers(){


		$name = $this->input->post('vol_name');
		$phone = $this->input->post('vol_phone');
		$new_phone = str_replace('-', '', $phone);
		$email = $this->input->post('vol_email');
		$city = $this->input->post('vol_city');
		$state = $this->input->post('vol_state');
		$country = $this->input->post('vol_country');
		$zipcode = $this->input->post('vol_zipcode');
		$VolunteerArea = $this->input->post('VolunteerArea');
		$address = $this->input->post('vol_address');


		// print_r($this->input->post()); die();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].addVolunteer()['url']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
				\"clientId\": \"".ApiBaseUrl()['clientID']."\",
				\"dataJson\": {
				\"Name\": \"".$name."\",
				\"Mobile\": \"".$new_phone."\",
				\"Email\": \"".$email."\",
				\"City\": \"".$city."\",
				\"State\": \"".$state."\",
				\"Country\": \"".$country."\",
				\"Zipcode\": \"".$zipcode."\",
				\"VolunteerArea\": \"".$VolunteerArea."\",
				\"Address\": \"".$address."\"
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

		// print_r($response); die();

		if ($response->statusCode == 1) {
			$this->session->set_flashdata('success','<div class="alert alert-success alert-dismissible fade show text-center">Volunteer Details Added Successfully!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect(base_url('volunteer'));
		}
		else{
			$this->session->set_flashdata('failure','<div class="alert alert-warning alert-dismissible fade show text-center">Something Went Wrong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect(base_url('volunteer', 'refresh'));
		}
	}



	public function Membership()
	{
		$data['page'] = 'Membership-Form';
		$data['title'] = 'Membership Form';
		$this->load->view('membership',$data);
	}

}
?>