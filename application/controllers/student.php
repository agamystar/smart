<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller
{
    const TABLE_NAME = "users";
    private $user_frm_flag = "R";

    public function __construct() {
        parent::__construct();

        $this->load->library("excel");
        $this->load->model("mymodel_model");
        if (IS_USER_LOGIN)
        {
            redirect(SITE_LINK.'/security/login', 'refresh');
            exit;
        }
    }

    public function index()
    {}
    public function classes($x=''){

        $data = array();
        $data["js_vars"] = json_encode(array(
            "user_frm_flag" => $this->user_frm_flag,
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],

        ));
        $class="";
        if(empty($x)){
            $this->db->select("name");
            $this->db->from("class");
            $this->db->limit(1);
            $rr= $this->db->get();
             $r_class= $rr->row();
             //print_r($x);
            $class=$r_class->name;
        }else{

            $class=$x;
        }

         $classes=$this->mymodel_model->select("class",array());
         $classes=$this->mymodel_model->select("class",array());
         $students=$this->mymodel_model->select("users",array("group"=>"student","got_class"=>""));
         $class_students=$this->mymodel_model->select("users",array("group"=>"student","got_class"=>$class));


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
       $data['classes'][] = $classes;
        $data['students'][] = $students;
        $data['class_students'][] = $class_students;
        $data['js'][] = "usage/class.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'class', $data);
    }



}