<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reschedule extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');
		$this->load->library('form_validation');


	}


	public function index()
	{
		$data['page'] 		= 'Home';
		$data['pageTitle'] 	= 'Log in';


		

		$data['servicesDetail'] = array();
		if($this->input->get('serviceId') && $this->session->userdata('logged_in') != 1)
		{
			$this->session->set_userdata('reschedule_user', $this->input->get());
			$data['header_data'] = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
			// echo '<pre>'; print_r($data); die();
			$this->load->view('payonline/login',$data);
		}
		else
		{

			 // echo '<pre>'; print_r($this->input->get());die();

			 	if(empty($this->session->userdata('reschedule_user')) || $this->input->get()!= $this->session->userdata('reschedule_user'))
			 	{
			 		$this->session->set_userdata('reschedule_user', $this->input->get());
			 	}
				redirect(base_url('Reschedule/RescheduleProcess'));
		}

	}



	public function RescheduleProcess()
	{


		// echo '<pre>'; print_r($this->session->userdata());die();

		$data['servicesDetail'] = array();
		if($this->session->userdata('logged_in') == 1 && !empty($this->session->userdata('reschedule_user')))
		{
			$data['page'] 				= 'Home';
			$data['pageTitle'] 			= 'Reschedule Process';
			$data['rescheduleUser'] 	=  $this->session->userdata('reschedule_user');
			$data['loginUserDetails'] 	=  $this->session->userdata();

			$rescheduleUserDetail = $this->session->userdata('reschedule_user');
			$serviceStatus  	  = $rescheduleUserDetail['status'];
			$serviceId  		  = $rescheduleUserDetail['serviceId'];

			error_reporting(0);

			$ch = curl_init();
			/* USE FOR: IT IS USE FOR REMOVE THE ERROR OF SSL & HOST    */
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].'api/bookingService/getServiceRequestDetail');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{
				\n          \"_id\": \"".$serviceId."\",
				\n          \"productId\":\" ".ApiBaseUrl()['productID']."\",
				\n           \"clientId\": \"".ApiBaseUrl()['clientID']."\",
				\n           \"username\":\"".$this->session->userdata('refDataName')."\"\n        }");

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			$result = json_decode($result);
			$data['serviceDetails'] = $result->data[0];


			// echo '<pre>'; print_r($data['serviceDetails']); die();


			$data['header_data'] = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
		
			$this->load->view('payonline/reSedule',$data);
		}
		else
		{
			redirect(base_url('Reschedule'));
		}

	}


	public function saveReschedule()
	{
		if($this->session->userdata('logged_in') == 1 && $this->input->post())
		{
			// echo 'correct';

			$this->form_validation->set_rules('clientmessage', 'Note', 'trim|required');
			if ($this->form_validation->run() == TRUE)
			{	
					$in_data = $this->input->post();

					$rescheduleUserDetail = $this->session->userdata('reschedule_user');
					$clientmessage 		  = ucfirst(trim($in_data['clientmessage']));
					$serviceStatus  	  = $rescheduleUserDetail['status'];
					$serviceId  		  = $rescheduleUserDetail['serviceId'];
					$loginUserDetails  	  = $this->session->userdata();




					$ch = curl_init();
					/* USE FOR: IT IS USE FOR REMOVE THE ERROR OF SSL & HOST    */
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

					curl_setopt($ch, CURLOPT_URL, ApiBaseUrl()['url'].'api/bookingService/serviceConfirmation');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, "{
						\n          \"_id\": \"".$serviceId."\",
						\n          \"productId\":\" ".ApiBaseUrl()['productID']."\",
						\n          \"clientmessage\": \"".$clientmessage."\",
						\n          \"serviceStatus\": \"".$serviceStatus."\",
						\n          \"email\": \"".$loginUserDetails['email']."\",
						\n          \"clientId\": \"".ApiBaseUrl()['clientID']."\"\n        }");

					//	\n          \"email\": \"".$loginUserDetails['email']."\",

					$headers = array();
					$headers[] = 'Content-Type: application/json';
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

					$result = curl_exec($ch);

					if (curl_errno($ch)) {
						echo 'Error:' . curl_error($ch);
					}
					curl_close($ch);

					$result = json_decode($result);

					if($result->statusCode > 0)
					{
						$response = array('status' => 1,
							'message' => $result->message
						);
					}
					else
					{
						$response = array('status' => 0,
							'message' => $result->message
						);
					}

				
			}	
			else
			{
				$response = array('status' => 0,
					'message' => validation_errors()
				);
			}

			echo  json_encode($response);
		}

	}



	
}
