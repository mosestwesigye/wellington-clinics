<?php
class Payment_model extends CI_model{

  public function get_plan_by_time($tp){
    $query = $this->db->get_where('plan', array('time_period'=> $tp));
    return $query->result();
  }

  public function get_plan_by_reference($ref){
    $query = $this->db->get_where('plan', array('reference'=> $ref));
    return $query->row();
  }

  public function get_services(){
    $query = $this->db->get('care_structure');
    return $query->result();
  }

  public function get_medication(){
    $query = $this->db->get('drugs');
    return $query->result();
  }

  public function get_visit($reference=null){
    $query = $this->db->get('home_visit');
    if($reference){
      $query = $this->db->get_where('home_visit', array('reference'=> $reference));
    }
    return $query->result();
  }

  public function get_agent($reference=null){
    $query = $this->db->get('care_adviser');
    if($reference){
      $query = $this->db->get_where('care_adviser', array('reference'=> $reference));
    }
    return $query->result();
  }
}
?>
