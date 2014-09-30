<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    const TABLE_NAME = "users";
    private  $image="not";
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
            $new_file_name=date("y-m-d-h-m-s")."_".rand(100000,90000000)."_".$fileName;
            $targetFile = $targetPath .$new_file_name;
            move_uploaded_file($tempFile, $targetFile);
            $this->db->where("id",$this->session->userdata("user_id"));
            $this->db->update('users',array('photo' => $new_file_name));

            $this->session->set_userdata("uploaded_image",$new_file_name);

        }
        exit;
    }

    public function profile()
    {
       $data=array();

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));

        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/profile.js";
        $data['main_url'] = SITE_LINK;
        $id=$this->session->userdata("user_id");
        $rs = $this->mymodel_model->select("users", 'id ='.$id.' ');

        $data['user_data']=$rs[0];

        if($action_post=="update_profile"){
         $this->session->userdata('uploaded_image');
       exit;
    }
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'profile', $data);

    }
    public function get_class_children($stage, $level_id)
    {
        $ar = array();
        $cl = array();
        $que = $this->db->query("select  class_id as id , name as text from v_stage_level_class where stage=" . $stage . " and level=" . $level_id . " ");

        foreach ($que->result() as $row) {
            $ar['id'] = $row->id;
            $ar['text'] = $row->text;
            $cl[] = $ar;
        }
        // echo json_encode($cl);
        return $cl;
    }

    public function get_level_children($stage_id)
    {
        $arrs = array();
        $stage_level = array();
        $quer = $this->db->query("select  level as id , level_name as text from v_stage_level_class where stage=" . $stage_id . " ");

        foreach ($quer->result() as $row) {
            //$arrs['id']=$row->id;
            $arrs['text'] = $row->text;
            $arrs['children'] = $this->get_class_children($stage_id, $row->id);
            $stage_level[] = $arrs;

        }
        // echo json_encode( $stage_level);
        return $stage_level;

    }
    public function student_absence($x=''){

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data= json_decode($this->input->post("data"));


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

        if($this->input->get('date')){
            $today=$this->input->get('date');
        }else{
        $today=date('m/d/Y') ;
        }
        $classes=$this->mymodel_model->select("class","1=1");
      /////////old code //////  $class_students=$this->mymodel_model->select("v_class_students","class_id=$class and  student_id not in(select user_id from v_user_absence where day='$today'  ) order by student_name");
        $class_students=$this->mymodel_model->select("v_class_students","class_id=$class  order by student_name");
        $absence=$this->mymodel_model->select("v_user_absence","groups='student' and class_id='$class' and day='$today' ");

        if ($action_get == "load_classes") {

            $arr = array();
            $stage_level_class = array();
            $query = $this->db->query('select distinct stage as id , stage_name as text from v_stage_level_class');

            foreach ($query->result() as $row) {
                //  $arr['id']="";
                $arr['text'] = $row->text;
                $arr['children'] = $this->get_level_children($row->id);
                $stage_level_class[] = $arr;
                //    print_r($arr);
            }


            echo  json_encode($stage_level_class);
            exit;
        }

        if($action_post=="set_student_absence"){

            $no="";
            $message="";
            $big_st_ids=array();
            foreach($ajax_data->student_absence as $st){
                $big_st_ids[]=array("day"=>$today,"user_id"=>$st);

            }
            $imp= implode(",",$ajax_data->student_absence) ;

            $this->db->trans_begin();

            $this->db->where("day",$today);
            $this->db->delete("absence");


            if(!empty($big_st_ids)){
                $this->db->insert_batch("absence",$big_st_ids);
                if($this->db->affected_rows()>0){
                    $no =$this->db->affected_rows();
                    $message="success";
                    $this->db->trans_commit();
                }else{
                    $message="failed  ";
                    $this->db->trans_rollback();
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
            'p_class' => $class,
            'absence' => $absence,

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