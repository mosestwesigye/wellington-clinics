<?php

class MY_Controller extends CI_Controller {


  public function getPatient($id){

    //$id = $this->input->get('id');

    $url = "https://api.cliniko.com/v1/patients/".$id;

    $patient = array("status" => "empty");

    if($id != ""){

      $res = $this->curlClinikoRequest($url);
      $json_decoded = json_decode($res, true);

      if(!empty($json_decoded)){
          $patient = array_merge($patient, array(
            "status" => "ok",
            "id" => $json_decoded['id'],
            "first_name" => $json_decoded['first_name'],
            "last_name" => $json_decoded['last_name'],
            "email" => $json_decoded['email'],
            "phone_number" => $json_decoded['patient_phone_numbers'][0]['number'],
            )
          );
        }
      }
      $response = json_encode($patient);
      return $response;
  }

  public function getPractitioner($id){

    //$id = $this->input->get('id');

    $url = "https://api.cliniko.com/v1/practitioners/".$id;

    $patient = array("status" => "empty");

    if($id != ""){

      $res = $this->curlClinikoRequest($url);
      $json_decoded = json_decode($res, true);

      if(!empty($json_decoded)){
          $patient = array_merge($patient, array(
            "status" => "ok",
            "id" => $json_decoded['id'],
            "first_name" => $json_decoded['first_name'],
            "last_name" => $json_decoded['last_name'],
            "title" => $json_decoded['title'],
            )
          );
        }
      }
      $response = json_encode($patient);
      return $response;
  }

  public function registerPatient($json){

    $response = array("status" => "pending", "message" => "message");
    // $json = $this->input->raw_input_stream;
    $json = json_decode($json);

    $patient_id = $json->patient_id;
    $first_name = $json->first_name;
    $last_name = $json->last_name;
    $email = $json->email;
    $phone_number = $json->patient_number;

    $number = array("number" => $phone_number, "phone_type" => "Mobile");

    $patient = array();

    if($patient_id){
      $patient = json_decode($this->getPatient($patient_id));
      log_message('debug', "Patient Found by ID".$patient_id);
    }
    // else{
    //   if($phone_number){
    //     $patient = $this->get_patient_by_phonenumber($phone_number);
    //     log_message('info', "Patient Found by phone number".$phone_number);
    //   }
    // }

    if(sizeof($patient) > 0){
      if(isset($patient->status) && $patient->status=="ok"){
        $response = array('id' => $patient->id);
      }
    }

    if(!isset($patient->id)){
      log_message('info', "Saving Patient Details");
      $req = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "patient_phone_numbers" => array($number)
      );

      $to_json = json_encode($req);


      $url = "https://api.cliniko.com/v1/patients/";
      log_message('debug', "Requesting Cliniko ".$url);
      $reg_req = $this->curlClinikoRequestPost($url, $to_json);

      log_message('debug', "Response from Cliniko ".$reg_req);
      $json_decoded = json_decode($reg_req, true);

      $response = array('id' => $json_decoded['id']);
    }

    // $res = curlRequest($request);
    // $json_decoded = json_decode($res, true);
    // $status = array("status" => "error");
    //
    // if(!empty($json_decoded)){
    //   if($json_decoded['error'] == "false"){
    //     if($json_decoded['message'] == "PENDING"){
    //       $status = array("status" => "ok", "response" => "PENDING");
    //     }
    //   }
    //}
    $response = json_encode($response);
    log_message("debug", "Response ".$response);
    return $response;
  }

  public function get_patient_by_phonenumber($phone_number){
    // $phone_number = $this->input->get('phone_number');
    $patient_arr = array();

    $url = "https://api.cliniko.com/v1/patients/";
    $patient = array("status" => "empty");

    $res = $this->curlRequest($url);
    $json_decoded = json_decode($res, true);
    print_r($json_decoded);
    foreach ($json_decoded['patients'] as $key => $value) {
      foreach ($value['patient_phone_numbers'] as $key2 => $value2) {
        if ($value2['number'] == $phone_number){
          $patient_arr = $value;
        }
      }
    }

    return $patient_arr;
  }

  function curlClinikoRequest($url){
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

  function curlClinikoRequestPost($url, $post_data){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $post_data,
      CURLOPT_HTTPHEADER => array(
        "Authorization: Basic ".base64_encode("MS0xNTQyOC1COTRCMVhtNUo0bGlUb0MyTlYwU1BQVUE5VllGdDVscw"),
        "Content-Type: application/json",
        "User-Agent: WELLINGTON CARE (wellingtoncare@wellingtonclinics.com)",
        ),
      )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);



    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }
  }

  function internationalize($msisdn){
    $ptn = "/^0|256/";  // Regex
    $str = $msisdn; //Your input, perhaps $_POST['textbox'] or whatever
    $rpltxt = "256";  // Replacement string
    $match = preg_replace($ptn, $rpltxt, $str);
    if($match){
      $m = $match;
    }else{
      $m = "256".$msisdn;
    }
    return $m;
  }

  function sendSMS($msisdn, $message){
    $patt = "/^2567[5087619][0-9]{7}$/i";
    $msisdn = $this->internationalize($msisdn);
    if(preg_match($patt, $msisdn, $match)){
      $message = urlencode($message);
      $url = "http://sms.raffsoft.com/api/sendsms/?message=".$message."&recipient=".$msisdn."&account=454&authorization=928b966ceff28ce2c0e791eedbe7860f";
      $sms = $this->curlGetRequest($url);
      log_message('debug', "SMS Sent: ".$sms);
    }else{
      log_message('debug', "SMS Not Sent Invalid Phone Number: ".$msisdn);
    }
  }

  function curlGetRequest($url){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
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
