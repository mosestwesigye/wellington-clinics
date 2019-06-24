<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->load->model('Payment_model');
		$data['object_list_y'] = $this->Payment_model->get_plan_by_time('YEARLY');
		$data['object_list_b'] = $this->Payment_model->get_plan_by_time('BI');
		$data['object_list_q'] = $this->Payment_model->get_plan_by_time('QUARTERLY');
		$data['object_list_m'] = $this->Payment_model->get_plan_by_time('MONTHLY');
		$data['script'] = TRUE;
    $this->template->set('title', 'Home');
		$this->template->load('template', 'contents' , 'home', $data);
	}

  public function detail($ref)
	{
		$this->load->model('Payment_model');
		$plan = $this->Payment_model->get_plan_by_reference($ref);
		$data['plan_array'] = explode("+", $plan->plan);
		$data['cs'] =  $this->Payment_model->get_services();
		$data['medications'] =  $this->Payment_model->get_medication();
		$data['script'] = TRUE;
		$data['plan'] = $plan;
    $this->template->set('title', 'Detail');
		$this->template->load('template', 'contents' , 'detail', $data);
	}


	public function msisdn($x){
		echo $this->sendSMS($x, "Test Message");
	}
}
