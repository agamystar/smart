<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * this Controller is used for login and logout
 *
 * @package Security
 * @copyright MFH for Consulting and constructing
 * @version 1.0.0
 * @website http://www.mfhconsultants.com
 */


class Login extends MY_Controller {


    public  function __construct(){
        parent::__construct();
/*
        $this->load->model('login_model');
        $this->load->helper('cookie');*/
    }

    public function index()
    {
           $this->load->view("admin/login");
    }
    public function iindex()
    {
      if($this->login_model->doAutoLogin()){
          redirect(SITE_LINK."/student");
       }
        if($this->session->userdata('logged_in')){
            redirect(SITE_LINK."/student");
        }
        $data = array();
        if(isset($_POST["submit"])){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember_password = $this->input->post('remember_password');
            $this->login_model->setUsername($username);
            $this->login_model->setPassword($password);
            if($remember_password==1){
                $this->login_model->setRememberMe(true);
            }else{
                $this->login_model->setRememberMe(false);
            }
            if($this->login_model->doLogin()){
                redirect(SITE_LINK."/student");
                exit;
            }
            $data["errors"] = $this->login_model->getErrors();
        }

        $this->load->view("admin/login",$data);
    }

    public function logout(){
        $this->login_model->doLogout();
        redirect(SITE_LINK."/login");
        exit;
    }
}