<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {


    public function  __construct(){
        parent::__construct();
        $data=array();
        $this->load->helper("options");

        $this->load->library('ion_auth');
       define("SITE_LINK",option('site_url'));
        $data['base_url'] = SITE_LINK;


    }




}


