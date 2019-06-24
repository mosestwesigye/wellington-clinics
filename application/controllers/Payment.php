<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

	var $username;
	var $password;
	var $url;
	var $production = false;

	function __construct(){

		parent::__construct();

		$this->load->model('Payment_model');

		// $this->username = "ce24baf5-3e7f8f29-df4dff60-f0c28ca0";
		// $this->password = "AUxCKk7sDFUgE2iqWUHgZpyy4A1vkAcfd0Hk";
		// $this->url = "https://payments-dev.blink.co.ug/api/";

		$this->production = true;
		$this->username = "55ebbf7d-57bbdf60-01b0ef7e-ee549795";
	  $this->password = "9TuxrskTNIVh4kr00eWaytRo4oHu2EvUGh1G";
		$this->url = "https://payments.blink.co.ug/api/";
	}

	public function index($id=null)
	{

    $data['script'] = TRUE;
    $this->template->set('title', 'Payment');
    $this->template->load('template', 'contents' , 'payment', $data);
  }

	public function process($ref)
	{
		$this->load->model('Payment_model');
		$plan = $this->Payment_model->get_plan_by_reference($ref);
		$data['agent'] = $this->Payment_model->get_agent();
		$total = $this->input->post("amount");
		$visit = $this->input->post("visit");

		$visit = $this->input->post("visit");
		$data['total_amount'] = $total;
		$data['visit'] = $visit;
		$data['script'] = TRUE;
		$data['plan'] = $plan;
		$this->template->set('title', 'Payment');
		$this->template->load('template', 'contents' , 'payment', $data);
	}


	public function process_mobile_money(){

		$encryption_key = 'A3EWDITGHFDEREDFHT5EHDSHER596IHMNLOKIF4';
		$params = array('key' => $encryption_key);
		$this->load->library('cryptor');

	  $phone_number = $this->input->post('msisdn');
	  $patient_number = $this->input->post('patient_number');
	  $patient_id = $this->input->post('patient_id');
	  $first_name = $this->input->post('first_name');
	  $last_name = $this->input->post('last_name');
	  $email = $this->input->post('email');
	  $amount = $this->input->post('amount');
	  $agent = $this->input->post('agent');
	  $plan_reference = $this->input->post('reference');
	  $visit = $this->input->post('visit');
		$mvisit = "";

	  $description = "Patient ID:".$patient_id." Patient Name: ".$first_name." ".$last_name." Email:".$email." Phone Number: ".$patient_number." agent:".$agent;

	  $params = array(
	     "username" => $this->username,
	     "password" => $this->password,
	     "api" => "depositmobilemoney",
	     "msisdn" => $phone_number,
	     "amount" => (int)$amount,
	     "narrative" => $description,
	     "reference" => 'wellingtoncare',
	  );
		log_message('debug', "Requesting Mobile Money ".$description);
	  $res = $this->curlRequest($this->url, $params);
	  log_message('debug', "Serve Response ".$res);

	  $json_decoded = json_decode($res, true);
	  $status = array("status" => "error");

	  if(!empty($json_decoded)){
	    if(!$json_decoded['error']){
	      if(isset($json_decoded['status']) && $json_decoded['status'] == "PENDING"){
					$reference = $json_decoded['reference_code'];
	        // $status = array("status" => "ok", "response" => "PENDING");
					$mstatus = $this->checkStatus($reference);
					if($this->production){
						while ($mstatus == "PENDING") {
							$mstatus = $this->checkStatus($reference);
							sleep(5);
						}
					}else {
						log_message('debug', "Development .....");
						$mstatus = 'SUCCESSFUL';
					}
					if($mstatus == 'SUCCESSFUL'){
						$create_user_url = base_url()."patient/registerPatient/";
						$user_data = array(
							"patient_id" => $patient_id,
							"first_name" => $first_name,
							"last_name" => $last_name,
							"email" => $email,
							"patient_number" => $patient_number,
						);

						// $regstatus = $this->curlRequest($create_user_url, $user_data);
						$regstatus = $this->registerPatient(json_encode($user_data));
						$j = json_decode($regstatus, true);
						log_message('debug', "Patient Created ".$regstatus);
						$plan = $this->Payment_model->get_plan_by_reference($plan_reference);

						if($visit){
							$mvisit = "Home Care ".$visit." & ";
						}
						// $msg = "Thankyou ".$first_name.", ".$amount." received .You've been registered for WellingtonCare's 12 Homecare visits & Diabetes 1 or 2 , Hypetension & Thyroid treatment .Your ID is".$j['id'].
						$msg = "Thankyou ".$first_name.", ".to_money($amount)."/- received .You've been registered for WellingtonCare's ".$mvisit." ".$plan->plan_description." treatment. Your Patient ID is ".$j['id'];
						// $msg = "Hello ".$first_name.", you have been registered for Wellington Care. Your payment of ugx '.$amount.' has been received. Your patient id number is ".$j['id']." Thank you.";
						$this->sendSMS($patient_number, $msg);
						$encid = $this->cryptor->encrypt($j['id']);
						$encid=str_replace(array('+', '/', '='), array('-', '_', '~'), $encid);

					}

				  $status = array("status" => "ok", "response" => array("id"=> $j['id'], "cipher"=> $encid));
	      }
	    }
	  }

	  $response = json_encode($status);

	  echo $response;
	}

	function test($reference){
		$plan = $this->Payment_model->get_plan_by_reference($reference);
		print_r($plan);
	}

	function checkStatus($reference){
		// $username = "55ebbf7d-57bbdf60-01b0ef7e-ee549795";
	  // $password = "9TuxrskTNIVh4kr00eWaytRo4oHu2EvUGh1G";
		// $url = "https://payments.blink.co.ug/api/";
		log_message('debug', "Checking MM Status ".$reference);
		$status = "FAILED";

		$params = array(
	     "username" => $this->username,
	     "password" => $this->password,
	     "api" => "checktransactionstatus",
	     "reference_code" => $reference,
	  );

		$res = $this->curlRequest($this->url, $params);
		log_message('debug', "Checking MM Status ".$res);
		$json_decoded = json_decode($res, true);
		if(!empty($json_decoded)){
	    if(!$json_decoded['error']){
	      if(isset($json_decoded['status'])){
					$status = $json_decoded['status'];
				}
			}
		}
		return $status;
	}

	function testEncrypt(){

		$this->load->library('cryptor');
		$encid = $this->cryptor->encrypt('1234567');
		$encid=str_replace(array('+', '/', '='), array('-', '_', '~'), $encid);
		echo $encid;
		$encid=str_replace(array('-', '_', '~'), array('+', '/', '='), $encid);

		$token =  $this->cryptor->decrypt($encid);
		echo $token;
	}

	function curlRequest($url, $postData){
		log_message('debug', 'Curl Message'.json_encode($postData));
	  $curl = curl_init();

	  curl_setopt_array($curl, array(
	    CURLOPT_URL => $url,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_POST => TRUE,
	    CURLOPT_RETURNTRANSFER => TRUE,
	    CURLOPT_HTTPHEADER => array(
	        "Content-Type: application/json",
					"User-Agent: PostmanRuntime/7.13.0"
	    ),
	    CURLOPT_POSTFIELDS => json_encode($postData)
	  ));

	  $response = curl_exec($curl);

	  $err = curl_error($curl);

	  curl_close($curl);

	  if ($err) {
			log_message('debug', "cURL Error #:" . $err);
	    return "cURL Error #:" . $err;
	  } else {
				log_message('debug', "cURL Success #:");
	    return $response;
	  }
	}

}
?>
