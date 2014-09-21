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
        $this->db->select("*");
        $this->db->from($tb);
        if($arr){
            $this->db->where($arr);
        }
        $rs= $this->db->get();

        return $rs->result();
}
}

