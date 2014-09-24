<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    const TABLE_NAME = "users";
    private $user_frm_flag = "R";

    public function __construct() {
        parent::__construct();

        $this->load->library("excel");
    }

    public function upload() {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $targetPath ='./assets/uploads/';
            $targetFile = $targetPath . $fileName ;
            move_uploaded_file($tempFile, $targetFile);
            // if you want to save in db,where here
            // with out model just for example
            // $this->load->database(); // load database
            // $this->db->insert('file_table',array('file_name' => $fileName));
        }
    }

    public function profile()
    {
       $data=array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/profile.js";
        $data['main_url'] = SITE_LINK;
        $id=$this->session->userdata("user_id");
            $this->db->select('*');
            $this->db->from("users");
           $this->db->where("id", $id);
            $rs = $this->db->get();
          $data['user_data']=$rs->row();
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'profile', $data);

    }

    public function student_absence($x=''){

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));


        $data = array();

        if(empty($x)){
            $this->db->select("*");
            $this->db->from("class");
            $this->db->limit(1);
            $rr= $this->db->get();
            $r_class= $rr->row();
            $class=$r_class->class_id;
        }else{
            $class=$x;
        }

        $today=date('Y/m/d') ;
        $classes=$this->mymodel_model->select("class","1=1");
        $class_students=$this->mymodel_model->select("v_class_students","class_id=$class and  student_id not in(select user_id from v_user_absence where day='$today'  )");
        $absence=$this->mymodel_model->select("v_user_absence","groups='student' and class_id='$class' and day='$today' ");

        if($action_post=="distribute_students"){

            $no="";
            $message="";
            $big_st_ids=array();
            foreach($ajax_data->students_inclass as $st){
                $big_st_ids[]=array("day"=>$today,"user_id"=>$st);

            }
            $imp= implode(",",$ajax_data->students_inclass) ;
            $this->db->where("day",$today);
            $this->db->delete("absence");


            if(!empty($big_st_ids)){
                $this->db->insert_batch("absence",$big_st_ids);
                if($this->db->affected_rows()>0){
                    $no =$this->db->affected_rows();
                    $message="success";
                }else{
                    $message="failed  ";
                }
            }
           // print_r($big_st_ids);
          //   echo $this->db->last_query();

            echo  json_encode(array("message"=>$message,"no"=>$no));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['classes'][] = $classes;
        $data['absence'][] = $absence;
        $data['p_class'][] = $class;
        $data['class_students'][] = $class_students;
        $data['js'][] = "usage/student_absence.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'student_absence', $data);
    }
    public function staff_absence(){

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));


        $data = array();

        if(empty($x)){
            $this->db->select("*");
            $this->db->from("class");
            $this->db->limit(1);
            $rr= $this->db->get();
            $r_class= $rr->row();
            $class=$r_class->class_id;
        }else{
            $class=$x;
        }

        $today=date('Y/m/d') ;
        $classes=$this->mymodel_model->select("class","1=1");
        $all_users_in=$this->mymodel_model->select("users","groups not in ('student','not_defined','') and id not in(select user_id from v_user_absence where day='$today'  )");
        $absence=$this->mymodel_model->select("v_user_absence","groups not in ('student','not_defined','') and   day='$today' ");

        if($action_post=="distribute_students"){

            $no="";
            $message="";
            $big_st_ids=array();
            foreach($ajax_data->students_inclass as $st){
                $big_st_ids[]=array("day"=>$today,"user_id"=>$st);

            }
            $imp= implode(",",$ajax_data->students_inclass) ;
            $this->db->where("day",$today);
            $this->db->delete("absence");


            if(!empty($big_st_ids)){
                $this->db->insert_batch("absence",$big_st_ids);
                if($this->db->affected_rows()>0){
                    $no =$this->db->affected_rows();
                    $message="success";
                }else{
                    $message="failed  ";
                }
            }
           // print_r($big_st_ids);
          //   echo $this->db->last_query();

            echo  json_encode(array("message"=>$message,"no"=>$no));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['classes'][] = $classes;
        $data['absence'][] = $absence;
        $data['p_class'][] = $class;
        $data['all_users_in'][] = $all_users_in;
        $data['js'][] = "usage/staff_absence.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'staff_absence', $data);
    }
}