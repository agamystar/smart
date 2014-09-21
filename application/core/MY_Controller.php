<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {


    public function  __construct(){
        parent::__construct();

        $this->load->helper("options");
        $this->load->library('ion_auth');
       define("SITE_LINK",option('site_url'));
        if (!$this->ion_auth->logged_in()){
            define("IS_USER_LOGIN",true);
        }else{
            define("IS_USER_LOGIN",false);
        }


        $identity = $this->session->userdata('identity');
        $this->db->where("username", $identity);
        $this->db->where('active', 1);
        $this->db->from("users");
        $user= $this->db->get()->row();
        if ($user)
        {
            if($user->group){
                define("USER_GROUP",$user->group);
            }
        }

    }


}


