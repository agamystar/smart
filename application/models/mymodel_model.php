<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mymodel_model extends CI_Model
{
	//public $tables = array();



	public function __construct()
	{
		parent::__construct();
		$this->load->database();


    }


    public function select($tb,$arr){
        $query=$this->db->query("select * from ".$tb." where $arr ");

       // echo $this->db->last_query();
        return $query->result() ;
}
}

