<?php

function create_list($item){
  $list = '';
  $arr = explode(',', $item);
  foreach ($arr as $key) {
    $list .= "<li><p>".$key."<p></li>";
  }
  return $list;
}

function to_money($number){
  return number_format($number) ;
}
?>
