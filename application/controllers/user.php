<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    const TABLE_NAME = "users";
    private $image = "not";
    private $user_frm_flag = "R";

    public function __construct()
    {
        parent::__construct();

        $this->load->library("excel");
    }



    public function upload($id='')
    {
        if (!empty($_FILES)) {

            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];

            $ext = explode('.', $fileName);
            $ext = array_pop($ext);
            $file_ext=strtolower($ext);


            $allowed_ext = array('jpg','jpeg','png','gif');
            if(!in_array($file_ext,$allowed_ext)){
             $message = 'Only '.implode(',',$allowed_ext).' files are allowed!';
                echo json_encode(array("message"=>$message));
                exit;
            }else{

                if($this->sesstion->userdata("user_id")){

                    $this->db->select("photo");
                    $this->db->from("users");
                    $this->db->where("id",$id);
                    $pho=$this->db->get();
                    $res_pho=$pho->row();
                    if(file_exists(SITE_LINK.'/assets/uploads/'.$res_pho->photo)){
                        unlink(SITE_LINK.'/assets/uploads/'.$res_pho->photo);
                    }
                }


            $targetPath = './assets/uploads/';
            $new_file_name = date("y-m-d-h-m-s") . "_" . rand(100000, 90000000) . "_" . $fileName;
            $targetFile = $targetPath . $new_file_name;
            move_uploaded_file($tempFile, $targetFile);
                if($id){
                    $this->db->where("id",$id);
                }else{
                    $this->db->where("id", $this->session->userdata("user_id"));
                }

            $this->db->update('users', array('photo' => $new_file_name));
            $this->session->set_userdata("uploaded_image", $new_file_name);
            echo json_encode(array("message"=>"success"));
            exit;
        }

    }


        exit;
    }

    public function profile()
    {
        $data = array();

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("row"));

        if ($action_post == "edit") {

            $dat = array(

                'email' => $ajax_data->email,
                'phone' => $ajax_data->phone,
                'address' => $ajax_data->address
            );
            $this->db->where("id", $this->session->userdata("user_id"));
            $this->db->update("users", $dat);
            if ($this->db->affected_rows() > 0 || $this->db->affected_rows() == 0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" => $this->db->_error_number() . " * " . $this->db->_error_message()));
            }
            exit;
        }
        $id = $this->session->userdata("user_id");
        $rs = $this->mymodel_model->select("users", 'id =' . $id . ' ');
        $data['user_data'] = $rs[0];



        if ($this->session->userdata("groups") == "student") {
            $vcs = $this->mymodel_model->select("v_class_students", 'student_id =' . $id . ' ');
            if (isset($vcs[0])) {
                $data['student_data'] = $vcs[0];
            }

                $stb = $this->mymodel_model->select("v_bus_students", 'student_id =' . $id . ' ');
            if (isset($stb[0])) {
                $data['student_bus'] = $stb[0];
            }
        }

        $this->db->select("count(*) as count");
        $this->db->where('user_id', $id);
        $this->db->from("v_user_absence");
        $res_cont = $this->db->get();
        $cont = $res_cont->result();
        if (isset($cont[0])) {
        $data['user_absence'] = $cont[0]->count;
        }

        if ($action_post == "update_profile") {
            $this->session->userdata('uploaded_image');
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/profile.js";
        $data['main_url'] = SITE_LINK;

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'profile', $data);

    }

    public function inbox(){
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],

            'main_url' => SITE_LINK . "/" . "security/",


        ));
        $data['base_url'][] = SITE_LINK;

        $data['js'][] = "usage/inbox.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'inbox', $data);
    }

    public function get_class_children($stage, $level_id)
    {
        $ar = array();
        $cl = array();
        $que = $this->db->query("select  distinct class_id as id , name as text from v_stage_level_class where stage=" . $stage . " and level=" . $level_id . " ");

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
        $quer = $this->db->query("select  distinct level as id , level_name as text from v_stage_level_class where stage=" . $stage_id . " ");

        foreach ($quer->result() as $row) {
            //$arrs['id']=$row->id;
            $arrs['text'] = $row->text;
            $arrs['children'] = $this->get_class_children($stage_id, $row->id);
            $stage_level[] = $arrs;

        }
        // echo json_encode( $stage_level);
        return $stage_level;

    }

    public function student_absence()
    {
        $action_get = $this->input->get("action");
        $class = $this->input->get("class");
        $p_date = $this->input->get("date");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));
        $data = array();
        if (empty($class)) {
            $this->db->select("*");
            $this->db->from("class");
            $this->db->limit(1);
            $rr = $this->db->get();
            $r_class = $rr->row();
            $p_class = $r_class->class_id;
        } else {
            $p_class = $class;
        }

        if ($p_date) {
            $today = $p_date;
        } else {
            $today = date('d/m/Y');
        }
        $classes = $this->mymodel_model->select("class", "1=1");
        $class_students = $this->mymodel_model->select("v_class_students", "class_id=$p_class  order by student_name");
        $absence = $this->mymodel_model->select("v_user_absence", "groups='student' and class_id='$p_class' and day='$today' ");


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

        if ($action_post == "set_student_absence") {
            $day = $this->input->post("date");
            $js_class = $this->input->post("class");
            $absece = $this->input->post('student_absence');
            $no = "";
            $message = "";
            $big_st_ids = array();
            foreach ($absece as $st) {
                $big_st_ids[] = array("day" => $day, "user_id" => $st, "class" => $js_class);

            }

            $this->db->trans_begin();

            $this->db->where("day", $day);
            $this->db->where("class", $js_class);
            $this->db->delete("absence");

            if (!empty($big_st_ids)) {
                $this->db->insert_batch("absence", $big_st_ids);
                if ($this->db->affected_rows() > 0) {
                    $no = $this->db->affected_rows();
                    $message = "success";
                    $this->db->trans_commit();
                } else {
                    $message = "failed  ";
                    $this->db->trans_rollback();
                }
            }

            echo  json_encode(array("message" => $message, "no" => $no));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'p_class' => $p_class,
            'absence' => $absence,
            'p_date' => $today,

        ));
        $data['base_url'][] = SITE_LINK;
        $data['classes'][] = $classes;
        $data['absence'][] = $absence;
        $data['p_class'][] = $p_class;
        $data['class_students'][] = $class_students;
        $data['js'][] = "usage/student_absence.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'student_absence', $data);
    }

    public function staff_absence()
    {

        $action_get = $this->input->get("action");
        $date = $this->input->get("date");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));

        if ($date) {
            $today = $date;
        } else {
            $today = date("d/m/Y");
        }

        $data = array();

        $set_users = $this->mymodel_model->select("users", "groups not  in ('student','not_defined','')"); //$class_students=staff_absence
        $absence = $this->mymodel_model->select("v_user_absence", "groups not in ('student','not_defined','') and   day='$today' ");

        if ($action_post == "add") { // take absence
            $no = "";
            $message = "";
            $big_st_ids = array();
            foreach ($ajax_data->selection as $st) {
                $big_st_ids[] = array("day" => $ajax_data->date, "user_id" => $st);

            }
            $imp = implode(",", $ajax_data->selection);
            $this->db->where("day", $ajax_data->date);
            $this->db->delete("absence");


            if (!empty($big_st_ids)) {
                $this->db->insert_batch("absence", $big_st_ids);
                if ($this->db->affected_rows() > 0) {
                    $no = $this->db->affected_rows();
                    $message = "success";
                } else {
                    $message = "failed  ";
                }
            }
            echo  json_encode(array("message" => $message, "no" => $no));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'set_users' => $set_users,
            'absence' => $absence,
            'p_date' => $today,

        ));
        $data['base_url'][] = SITE_LINK;

        $data['absence'][] = $absence;
        $data['set_users'][] = $set_users;
        $data['js'][] = "usage/staff_absence.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'staff_absence', $data);
    }
}