<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Time_table extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("excel");
    }

    public function index()
    {
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

    function classes_table($x = '')
    {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $class="";
        if($this->session->userdata("groups")=="teacher"){

            $table_cl=$this->db->query("select table_id ,class_id,day,section,subject, teacher
             from  table_classes where  teacher =".$this->session->userdata("user_id")." ");
            $table_classes=array();
            foreach($table_cl->result() as $row){
                $table_classes[]=array(
                    "table_id" =>$row->table_id,
                    "class_id"=>$row->class_id,
                    "class"=>data_class($row->class_id)->name,
                    "day" =>$row->day,
                    "section"=>$row->section,
                    "subject"=>$row->subject,
                    "teacher"=>data_user($row->teacher)->name,
                    "teacher_id"=>$row->teacher,
                );
            }

        }
       else{
        $class = "";
        if (empty($x)) {
            $this->db->select("*");
            $this->db->from("class");
            $this->db->limit(1);
            $rr = $this->db->get();
            $r_class = $rr->row();
            $class = $r_class->class_id;
        } else {

            $class = $x;
        }

        $st_teachers = $this->mymodel_model->select("teacher_classes", 'class_id =' . $class . ' ');

        if (isset($st_teachers[0])) {
            $data['student_teachers'] = $st_teachers;
        }

           if($this->session->userdata("groups")=="student"){
            $table_cl=$this->db->query('select table_id ,class_id,day,section,subject,
             teacher  from  table_classes where  class_id in (select class_id
              from class_students where student_id="'.$this->session->userdata("user_id").'" )  ');
           }elseif($this->session->userdata("groups")=="admin"){
               $table_cl=$this->db->query('select table_id ,class_id,day,section,subject,
             teacher  from  table_classes where  class_id ='.$class.' ');
           }

            $table_classes=array();
            foreach($table_cl->result() as $row){
                $table_classes[]=array(
                    "table_id" =>$row->table_id,
                    "class_id"=>$row->class_id,
                    "day" =>$row->day,
                    "section"=>$row->section,
                    "subject"=>$row->subject,
                    "teacher"=>data_user($row->teacher)->name,
                    "teacher_id"=>$row->teacher,
                );
            }
        $st_stage = $this->db->query('select stage from v_stage_level_class where class_id =' . $class . '');
        $result = $st_stage->result();

        $st_subjects = $this->db->query('select * from subjects where stage_id =' . $result[0]->stage . '');
        $subjects = $st_subjects->result();

        if (isset($subjects[0])) {
            $data['subjects'] = $subjects;
        }
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
        }
        if ($action_post == "create_table") {
            $class_id = $this->input->post("class_id");
            $time_table = json_decode($this->input->post("table"));

            $big_arr = array();
            $this->db->trans_begin();
            $this->db->where("class_id", $class_id);
            $this->db->delete("table_classes");
            foreach ($time_table as $tab) {
               if (empty($tab->teacher)||trim($tab->teacher)=="undefined"||trim($tab->subject)=="undefined"||empty($tab->subject)) {

                }else{
                $big_arr[] = array(
                    "class_id" => $class_id,
                    "section" => $tab->section,
                    "day" => $tab->day,
                    "subject" =>$tab->subject,
                    "teacher" =>$tab->teacher,
                );
            }
            }
            $message = "";
            $this->db->insert_batch("table_classes", $big_arr);
            if ($this->db->affected_rows() > 0) {
                $message = "success";
                $this->db->trans_commit();
            } else {
                $message = "failed";
                $this->db->trans_rollback();

            }
            echo json_encode(array("message" => $message));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'p_class' => $class,
            'table_classes' => $table_classes,
        ));

        $data['base_url'][] = SITE_LINK;
        if($this->session->userdata("groups")=="teacher"){
        $data['js'][] = "usage/classes_table_teacher.js";}else{
            $data['js'][] = "usage/classes_table.js";
        }


        $data['main_url'] = SITE_LINK;
        $data['use_big_model'] = "yes";
        $data['first_title'] = "Home";
        $data['second_title'] = "Timetable";
        $data['third_title'] = " Table Classes ";
        if($this->session->userdata("groups")=="teacher"){
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'classes_table_teacher', $data);
        }else{
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'classes_table', $data);
        }

    }

}