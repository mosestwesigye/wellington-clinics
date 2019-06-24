<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {

	public function index()
	{
  }

  public function get($id){
		echo $this->getPatient($id);
	}

  // $request = $_GET['request'];
  // if($request == "checkRegister"){
  //   $id = $_GET['id'];
  //   getPatient($id);
  // }
  //
  // if($request == "createPatient"){
  //   registerPatient();
  // }
}
?>
