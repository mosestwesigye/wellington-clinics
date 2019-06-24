<?php
function getPay(){
  $username = "ce24baf5-3e7f8f29-df4dff60-f0c28ca0";
  $password = "AUxCKk7sDFUgE2iqWUHgZpyy4A1vkAcfd0Hk";
  $phone_number = $_POST['msisdn'];
  $patient_number = (isset($_POST['patient_number'])) ? $_POST['patient_number'] : null;
  $patient_id = (isset($_POST['patient_id'])) ? $_POST['patient_id'] : null;
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $amount = $_POST['amount'];
  $agent = (isset($_POST['agent'])) ? $_POST['agent'] : null;

  $description = "Patient ID:".$patient_id." Patient Name: ".$first_name." ".$last_name." Email:".$email." Phone Number: ".$patient_number." agent:".$agent;

  $request = array(
      "username" => $username,
     "password" => $password,
     "api" => "depositmobilemoney",
     "msisdn" => $phone_number,
     "amount" => (int)$amount,
     "narrative" => $description,
     "reference" => 'wellingtoncare',
  );
  $res = curlRequest($request);
  m_log($res);
  $json_decoded = json_decode($res, true);
  $status = array("status" => "error");
  if(!empty($json_decoded)){
    if(!$json_decoded['error']){
      if(isset($json_decoded['status']) && $json_decoded['status'] == "PENDING"){
        $status = array("status" => "ok", "response" => "PENDING");
      }
    }
  }

  $response = json_encode($status);

  echo $response;

}

function curlRequest($postData){

  $url = "https://payments-dev.blink.co.ug/api/";

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
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

//define function name
function m_log($arMsg)
{
	//define empty string
	$stEntry="";
	//get the event occur date time,when it will happened
	$arLogData['event_datetime']='['.date('D Y-m-d h:i:s A').'] [client '.$_SERVER['REMOTE_ADDR'].']';
	//if message is array type
	if(is_array($arMsg))
	{
	//concatenate msg with datetime
	foreach($arMsg as $msg)
	$stEntry.=$arLogData['event_datetime']." ".$msg."rn";
}
else
{   //concatenate msg with datetime

	$stEntry.=$arLogData['event_datetime']." ".$arMsg."rn";
}
//create file with current date name
$stCurLogFileName='log_'.date('Ymd').'.txt';
//open the file append mode,dats the log file will create day wise
$fHandler=fopen($stCurLogFileName,'a+');
//write the info into the file
fwrite($fHandler,$stEntry);
//close handler
fclose($fHandler);
}


getPay();
?>
