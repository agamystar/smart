<?php
require_once('Classes/PHPExcel.php');

function option($field){
    $ci=& get_instance();
    $ci->db->select("value");
    $ci->db->where("key",$field);
    $ci->db->from("options");
    $result=$ci->db->get();
    $res=$result->result();
   return $res[0]->value;
}

	  function translate($key){
        $language=option("default_language");
        $ci=& get_instance();
        $ci->db->select($language);
        $ci->db->from("translation");
       $ci->db->where("key",strtolower($key));
       $arr_trans=$ci->db->get();
       $res=$arr_trans->result();
       return $res[0]->$language;

	}








?>