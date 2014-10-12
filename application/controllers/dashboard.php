<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{


    public function __construct() {
        parent::__construct();

    }

    public function index()
    {
        $data=array();
        $data['first_title'] = "Home";
        $data['second_title'] = "Security";
        $data['third_title'] = "Dashboard ";
        $this->load->view('admin/index',$data);
    }
}