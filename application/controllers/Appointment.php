<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Controller {

	public function index($pid=null)
	{
		$this->service($pid=null);
  }

	public function service($pid=null){
		if($pid){
			$url = "https://api.cliniko.com/v1/appointment_types/";
			$res = $this->curlRequest($url);
			$json_decoded = json_decode($res, true);
			$wc = array();
			$practitioner = array();
			foreach ($json_decoded['appointment_types'] as $key => $value) {
				if (strpos($value['category'], 'Wellington Care Cover') !== false){
					array_push($wc, $value);
					//array_push($practitioner, $this->get_practioner($value['practitioners']['links']['self']));
				}
			}
			$data['scripts'] = TRUE;
			$data['service_obj'] = $wc;
			$data['pid'] = $pid;
			$this->template->set('title', 'Home');
			$this->template->load('template', 'contents' , 'booking/service',  $data);
		}else{
			redirect('/home');
		}
	}

	function practioner($pid, $service){
		$url = "https://api.cliniko.com/v1/appointment_types/".$service."/practitioners";

		$res = $this->curlRequest($url);
		$json_decoded = json_decode($res, true);

		$data['practitioner_obj'] = $json_decoded;
		$data['appointment_type'] = $service;
		$data['pid'] = $pid;
		$this->template->set('title', 'Home');
		$this->template->load('template', 'contents' , 'booking/practitioner',  $data);
	}

	function time($pid, $practitioner, $apt){

		// $url = "api.cliniko.com/v1/businesses/28776/practitioners/".$practitioner."/appointment_types/".$apt."/available_times?from=2019-05-23&to=2019-05-29";
		// $res = $this->curlRequest($url);
		// $json_decoded = json_decode($res, true);
		// $data['appointment_obj'] = $json_decoded;
		$data['calender_script'] = TRUE;
		$data['practitioners'] = $practitioner;
		$data['appointment_types'] = $apt;

		$this->load->library('cryptor');
		$encid=str_replace(array('-', '_', '~'), array('+', '/', '='), $pid);
		$token =  $this->cryptor->decrypt($pid);

		$data['pid'] = $token;
		$prt = $this->get_practioner($practitioner);
		$data['the_practn'] = $prt['title']." ".$prt['first_name']." ".$prt['last_name'];
		$this->template->set('title', 'Home');
		$this->template->load('template', 'contents' , 'booking/time',  $data);
	}

	function book($practitioner, $apt, $pid, $datetime){
		log_message('debug', "Get Date ".$datetime);
		$time = str_replace('T', ' ', urldecode($datetime));
		$the_date = strtotime($time);
		date_default_timezone_set('UTC');
		$datetime = date("Y-m-d\Tg:i:s\Z", $the_date);
		// $the_date = strtotime($datetime);
		// date_default_timezone_set('UTC');
		// $datetime=date("Y-m-d g:i:s", $the_date);
		log_message('debug', "Saving Date ".$datetime);
		$params = array(
			"starts_at"=> $datetime,
			"patient_id"=> $pid,
			"practitioner_id"=> $practitioner,
			"appointment_type_id"=> $apt,
			"business_id"=> "28776",
		);
			$to_json = json_encode($params);
			$url = "https://api.cliniko.com/v1/individual_appointments";
      log_message('debug', "Requesting Cliniko ".$url);
      $reg_req = $this->curlClinikoRequestPost($url, $to_json);

      log_message('debug', "Response from Cliniko ".$reg_req);
      $json_decoded = json_decode($reg_req, true);
			if(isset($json_decoded['id'])){
				$patient = json_decode($this->getPatient($pid));
				$pract = json_decode($this->getPractitioner($practitioner));

				$pname = $pract->title." ".$pract->first_name." ".$pract->last_name;
				$phone_number = $patient->phone_number;
				$name = $patient->first_name." ".$patient->last_name;
				//$booked = preg_replace('/T|Z/', ' ',  $json_decoded['starts_at']);
				$the_date = strtotime($json_decoded['starts_at']);
				log_message('debug', $json_decoded['starts_at']);
				date_default_timezone_set('Africa/Kampala');
				$booked =  date("F j, Y, g:i a", $the_date);
				log_message('debug', $booked);
				$message = "Dear ".$name.", You have booked an appointment for ".$booked." with ".$pname.". See you then. Thank You.";
				$this->sendSMS($phone_number, $message);
				log_message('debug', "Message Sent to ".$phone_number);
			}
			echo json_encode(array("status"=>"ok", "message"=>"Okay"));
	}

	function get_date($practitioner, $apt){
		date_default_timezone_set('Africa/Kampala');
		$offsetnow = strtotime("+0 day");
		$offset6 = strtotime("+6 day");
		$now = date("Y-m-d");
		$day_seven = date("Y-m-d", $offset6);
		$dates = array();
		$st = 0;
		for ($i=0; $i < 12; $i++) {
			$st += 1;
			if($i>0){
				$st = $st+6;
			}
			$p6 = $st+6;
			$offsetnow = strtotime("+".$st." day");
			$offset6 = strtotime("+".$p6." day");
			$now = date("Y-m-d", $offsetnow);
			$day_seven = date("Y-m-d", $offset6);
			$url = "http://api.cliniko.com/v1/businesses/28776/practitioners/".$practitioner."/appointment_types/".$apt."/available_times?from=".$now."&to=".$day_seven;
			$res = $this->curlRequest($url);

			log_message("debug", "Calender Data ".$res);

			$json_decoded = json_decode($res, true);

			foreach ($json_decoded['available_times'] as $value) {
				$sdate = explode("T", $value['appointment_start']);

				if(!in_array($sdate[0], $dates)){
					array_push($dates, $sdate[0]);
				}
			}
		}

		$uniq_date = array_unique($dates);
		$response = json_encode(array("default_date"=>$now, "appt_date"=>$dates));
		echo $response;

	}

	function get_time($practitioner, $apt, $date){

		$time = array();
		$url = "http://api.cliniko.com/v1/businesses/28776/practitioners/".$practitioner."/appointment_types/".$apt."/available_times?from=".$date."&to=".$date;
		$res = $this->curlRequest($url);

			log_message("debug", "Calender Data ".$res);

			$json_decoded = json_decode($res, true);

			foreach ($json_decoded['available_times'] as $value) {
				$the_date = strtotime($value['appointment_start']);
				date_default_timezone_get();
				//$app_date = date("Y-d-mTG:i:sz", $the_date);
				$app_date = date("g:i a", $the_date);
				//$sdate = explode("T", $app_date);
				array_push($time, $app_date);
			}
		$response = json_encode($time);
		echo $response;

	}

	function get_practioner($id){
		$url = "https://api.cliniko.com/v1/practitioners/".$id;
		$res = $this->curlRequest($url);
		$json_decoded = json_decode($res, true);
		return $json_decoded;
	}

	function testd(){
		$time = str_replace('T', ' ', urldecode("2019-05-31T9:30%20am"));

		echo date("Y-m-d g:i:s a", strtotime($time));
		$the_date = strtotime($time);

		date_default_timezone_set('UTC');
		echo date("Y-m-d\Tg:i:s\Z", $the_date);


		$time = str_replace('T', ' ', urldecode("2019-05-31T9:00%20am"));
		$the_date = strtotime($time);
		date_default_timezone_set('UTC');
		$datetime = date("Y-m-d\Tg:i:s\Z", $the_date);

		echo $datetime;

	}

	function test(){
		$st = 0;
		for ($i=0; $i < 7; $i++) {
			$st += 1;
			if($i>0){
				$st = $st+6;
			}
			print $st."<br>";
			$p6 = $st+6;
			$offsetnow = strtotime("+".$st." day");
			$offset6 = strtotime("+".$p6." day");
			$now = date("Y-m-d", $offsetnow);
			$day_seven = date("Y-m-d", $offset6);

			echo $now." <=>".$day_seven." <br>";
		}
	}

	function curlRequest($url){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Basic ".base64_encode("MS0xNTQyOC1COTRCMVhtNUo0bGlUb0MyTlYwU1BQVUE5VllGdDVscw"),
        "User-Agent: WELLINGTON CARE (wellingtoncare@wellingtonclinics.com)",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }
  }
}
?>
