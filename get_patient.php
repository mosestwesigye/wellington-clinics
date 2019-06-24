<?php

function getPatient($id){
  $patient = array("status" => "empty");
  if($id != ""){
    $res = curlRequest($id);
    $json_decoded = json_decode($res, true);

    if(!empty($json_decoded)){
        $patient = array_merge($patient, array(
          "status" => "ok",
          "first_name" => $json_decoded['first_name'],
          "last_name" => $json_decoded['last_name'],
          "email" => $json_decoded['email'],
          "phone_number" => $json_decoded['patient_phone_numbers'][0]['number'],
          )
        );
      }
    }

    $response = json_encode($patient);

    echo $response;
}

function registerPatient(){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone_number = (isset($_POST['patient_number'])) ? $_POST['patient_number'] : null;
  $number = array("number" => $phone_number, "phone_type" => "Mobile");

  $request = array(
    "first_name" => $phone_number,
    "last_name" => (int)$amount,
    "email" => $description,
    "patient_phone_numbers" => $number,
  );
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

  $response = json_encode($status);

  echo $response;
}

function curlRequest($id){
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.cliniko.com/v1/patients/".$id,
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

$request = $_GET['request'];
if($request == "checkRegister"){
  $id = $_GET['id'];
  getPatient($id);
}

if($request == "createPatient"){
  registerPatient();
}

?>
