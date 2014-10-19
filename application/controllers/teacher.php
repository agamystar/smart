<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Teacher  extends MY_Controller
{

    public function __construct() {
        parent::__construct();

    }
    public function get_class_children($stage, $level_id)
    {
        $ar = array();
        $cl = array();
        $que = $this->db->query("select distinct class_id as id , name as text from v_stage_level_class where stage=" . $stage . " and level=" . $level_id . " ");

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
        $quer = $this->db->query("select distinct level as id , level_name as text from v_stage_level_class where stage=" . $stage_id . " ");

        foreach ($quer->result() as $row) {
            //$arrs['id']=$row->id;
            $arrs['text'] = $row->text;
            $arrs['children'] = $this->get_class_children($stage_id, $row->id);
            $stage_level[] = $arrs;

        }
        // echo json_encode( $stage_level);
        return $stage_level;

    }


    public function get_class_children_t($stage, $level_id)
    {
        $ar = array();
        $cl = array();

        $set_users= $this->mymodel_model->select("teacher_classes", "teacher_id=".$this->session->userdata("user_id")."  ");

        $arr=array();
        foreach ($set_users as $one) {
            $arr[]=$one->class_id;
        }

        $my_classes=implode(",",$arr);
        $que = $this->db->query("select distinct class_id as id ,
          name as text from v_stage_level_class
         where stage=" . $stage . " and level=" . $level_id . "
         and class_id in($my_classes)
         ");

        foreach ($que->result() as $row) {
            $ar['id'] = $row->id;
            $ar['text'] = $row->text;
            $cl[] = $ar;
        }
        // echo json_encode($cl);
        return $cl;
    }
    public function get_level_children_t($stage_id)
    {
        $arrs = array();
        $stage_level = array();
        $quer = $this->db->query("select distinct level as id , level_name as text from v_stage_level_class where stage=" . $stage_id . " ");

        foreach ($quer->result() as $row) {
            //$arrs['id']=$row->id;
            $arrs['text'] = $row->text;
            $arrs['children'] = $this->get_class_children_t($stage_id, $row->id);
            $stage_level[] = $arrs;

        }
        // echo json_encode( $stage_level);
        return $stage_level;

    }

    public function homework($id='')
    {
     //  echo  data_user(616);

        $data = array();
         $st_teachers=array();
        $filter="";
        $form_id=12;
       $hrw=get_form_authority($this->session->userdata('group_id'),$form_id);

       if($hrw=="h"){
           echo "     No privilege ...    . Contact System Administrator ";
           redirect(SITE_LINK."/security/login","refresh");
       }

       $action_get = $this->input->get("action");
       $action_post = $this->input->post("action");
       $h_header= $this->input->post("h_header");
       $h_body= $this->input->post("h_body");


        if($id){
            $t=$id;
        }else{
            $t=$this->session->userdata("user_id");
        }

        if($this->session->userdata("groups")=="teacher"){


        $this->db->select("*");
        $this->db->where("teacher_id",$t);
        $this->db->from("homework");

        $this->db->order_by("h_id","desc");
        $this->db->limit("30");
        $res=$this->db->get();
        $myhomework=$res->result();
        }

       elseif($this->session->userdata("groups")=="student" || $this->session->userdata("groups")=="admin"){

           if($this->session->userdata("groups")=="admin"){

               $this->db->select("id as teacher_id , name , photo ");
               $this->db->where('groups',"teacher");
               $this->db->from("users");
               $result=$this->db->get();
               $st_teachers=$result->result();
               if (isset($st_teachers[0])) {
                   $st=array();
                   foreach($st_teachers as $one){
                       $st[]=$one->teacher_id;
                   }
                   if($id){
                       $filter=$id;
                   }else{
                       $filter=$st[0];
                   }
                   $myhomework = $this->mymodel_model->select("homework","teacher_id in(".$filter.") order by h_id desc limit 30");
                   /// echo  $this->db->last_query();
               }

           }else{


               $st_teachers = $this->mymodel_model->select("teacher_classes",
                   'class_id in (select class_id from class_students where student_id="'.$this->session->userdata("user_id").'" ) ');
               $st=array();
               foreach($st_teachers as $one){
                   $st[]=$one->teacher_id;
               }
               if($id){
                   $filter=$id;
               }else{
                   $filter=$st[0];
               }
               $this->db->select("*");
               $this->db->from("homework");
               $this->db->where('teacher_id in('.$filter.') and h_id in (select h_id from class_homeworks where class_id in (select class_id from class_students where student_id="'.$this->session->userdata("user_id").'" )) ');
               $this->db->order_by("h_id","desc");
               $res=$this->db->get();
               /// echo  $this->db->last_query();
               $myhomework=$res->result();


           }



       }

        else{

        }
        if ($action_get == "load_classes") {

           $arr = array();
           $stage_level_class = array();
           $query = $this->db->query('select distinct stage as id , stage_name as text from v_stage_level_class');

           foreach ($query->result() as $row) {
               //  $arr['id']="";
               $arr['text'] = $row->text;
               $arr['children'] = $this->get_level_children_t($row->id);
               $stage_level_class[] = $arr;
               //    print_r($arr);
           }


           echo  json_encode($stage_level_class);
           exit;
       }
        if ($action_post == "add") {

            $dat = array(
                'h_header' => $h_header,
                'h_body' => $h_body,
                'teacher_id' =>$this->session->userdata("user_id"),
                'h_date' =>date("d/m/Y"),
                'attachment' =>  $this->session->userdata("file_upload"),

            );
            $this->db->insert("homework", $dat);

            $big_st_ids=array();
            $classes=json_decode($this->input->post("classes"));

            foreach ($classes as $one) {
                if(array_key_exists("id",$one)){
                    $big_st_ids[] = array( "h_id" =>$this->db->insert_id(),"class_id"=>$one->id);
                }

            }
            //   print_r($classes);
            //  print_r($big_st_ids);
          if(!empty($big_st_ids)){
            $this->db->insert_batch("class_homeworks", $big_st_ids);

          }

            if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
            }


            $this->session->unset_userdata('file_upload');
            exit;
        }

      //  print_r($st_teachers);
       $data["js_vars"] = json_encode(array(
           'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
           'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
           'details' => SITE_LINK . "/" . "student/" . "details/",
           'main_url' => SITE_LINK . "/" . "security/",
           'hrw' =>$hrw,
           'filter' =>$filter,
           'myhomework' =>$myhomework,
           'teachers' =>$st_teachers,//yes it is used
       ));
       $data['hrw'] = $hrw;
       $data['base_url'][] = SITE_LINK;
       $data['myhomework'] = $myhomework;
       $data['teachers']=$st_teachers;
       $data['filter']=$filter;
       $data['js'][] = "usage/teacher_homework.js";

        $data['first_title'] = "Home";
        $data['teacher_id'] = $t;
        $data['second_title'] = "Teacher";
        $data['third_title'] = "Home Work ";

        if( $this->session->userdata('groups')=="teacher"){
            $this->load->view("admin/teacher_homework",$data);
        }else{
            $this->load->view("admin/student_homework",$data);
        }
    }

    public function distribute_teachers()
    {
        $form_id=17;

        $data = array();
        $hrw=get_form_authority($this->session->userdata('group_id'),$form_id);
        if($hrw=="h"){
            echo "        No privilege ...   . Contact System Administrator ";
            redirect(SITE_LINK."/security/login","refresh");
        }
        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $classes = json_decode($this->input->post("classes"));
        $teacher = $this->input->post("teacher");
        $set_users = $this->mymodel_model->select("users", "groups not  in ('student','not_defined','parent','admin')"); //$class_students=staff_absence
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

        if ($action_post == "get_teacher_classes") {
            $g_classes = $this->mymodel_model->select("teacher_classes", "teacher_id=".$teacher." ");
            echo json_encode($g_classes);
            exit;
        }

        if ($action_post == "distribute"){


            $no = "";
            $message = "";
            $big_st_ids = array();


            $this->db->trans_begin();

            $this->db->where("teacher_id",$teacher);
            $this->db->delete("teacher_classes");



            foreach ($classes as $one) {
                if(array_key_exists("id",$one)){
                $big_st_ids[] = array("class_id"=>$one->id, "teacher_id" => $teacher);
                }

            }

            if (!empty($big_st_ids)) {
                $this->db->insert_batch("teacher_classes", $big_st_ids);
                if ($this->db->affected_rows() > 0) {
                    $no = $this->db->affected_rows();
                    $message = "success";
                    $this->db->trans_commit();
                } else {
                    $message = "failed  ";
                    $this->db->trans_rollback();
                }
            }

          //  echo $this->db->last_query();
            echo  json_encode(array("message" => $message, "no" => $no));
            exit;

        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'hrw' =>$hrw
        ));
        $data['hrw'] = $hrw;
        $data['set_users'][] = $set_users;
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/teacher_distribution.js";
        $data['first_title'] = "Home";
        $data['second_title'] = "Teacher";
        $data['third_title'] = "Distribute Classes on Teachers  ";
        $this->load->view("admin/teacher_distribution",$data);

    }

    public function homework_details($id=''){
        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $m_header= $this->input->post("m_header");
        $m_body= $this->input->post("m_body");
        $m_to= $this->input->post("m_to");

        $data = array();
         $m_h="";
        if($id){
            $h_details= $this->mymodel_model->select("homework", "h_id=".$id."  ");
            $data['h_details'] = $h_details[0];

            $this->db->insert("homework_read",array("h_id"=>$id,"user_id"=>$this->session->userdata("user_id")));
        }

        if ($action_post == "add") {

            $dat = array(
                'm_header' => "RE ".$m_header,
                'm_body' => $m_body,
                'm_from' =>$this->session->userdata("user_id"),
                'm_to' =>$m_to,
                'm_date' =>date("d/m/Y    h:m:s "),
                'm_attachment' =>  $this->session->userdata("file_upload"),

            );
            $this->db->insert("messages", $dat);

            if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
            }
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1]
        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/teacher_homework.js";
        $data['first_title'] = "Home";
        $data['second_title'] = "HomeWork";
        $data['third_title'] = "HomeWork Details ";
        $this->load->view("admin/homework_details",$data);
    }

}