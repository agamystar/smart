<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    const TABLE_NAME = "users";

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

                if(strlen($this->session->userdata("photo"))>3){

                    if(file_exists(SITE_LINK.'/assets/uploads/'.data_user($this->session->userdata("user_id"))->photo)){
                        unlink(SITE_LINK.'/assets/uploads/'.data_user($this->session->userdata("user_id"))->photo);
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
        $form_id=4;
        $hrw=get_form_authority($this->session->userdata('group_id'),$form_id);

        if($hrw=="h"){
            echo "     No privilege ...    . Contact System Administrator ";
            redirect(SITE_LINK."/security/login","refresh");
        }

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

           // print_r($vcs[0] );
            $st_teachers = $this->mymodel_model->select("teacher_classes", 'class_id =' . $vcs[0]->class_id . ' ');
            if (isset($st_teachers[0])) {
                $data['student_teachers'] = $st_teachers;
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
            'hrw' =>$hrw
        ));

        $data['first_title'] = "Home";
        $data['second_title'] = "Profile";
        $data['third_title'] = "All User Information  ";
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/profile.js";
        $data['main_url'] = SITE_LINK;
        $data['hrw'] = $hrw;
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'profile', $data);



    }

    public function inbox($p_m_id=''){

        $form_id=11;
        $hrw=get_form_authority($this->session->userdata('group_id'),$form_id);

        if($hrw=="h"){
            echo "    No privilege ... . Contact System Administrator ";
            redirect(SITE_LINK."/security/login","refresh");
        }

        $this->db->select("m_id");
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->from("message_read");
        $read = $this->db->get();
        $messages_read = $read->result();



        $this->db->select("*");
        $this->db->where('m_to', $this->session->userdata('user_id'));
        $this->db->from("messages");
        $this->db->order_by("m_id","desc");
        $res_c = $this->db->get();
        $messages = $res_c->result();

        $this->db->select("*");
        $this->db->where('m_from', $this->session->userdata('user_id'));
        $this->db->from("messages");
        $res_sent = $this->db->get();
        $messages_sent = $res_sent->result();

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $m_id = $this->input->post("m_id");
        $m_to = $this->input->post("m_to");
        $m_header = $this->input->post("m_header");
        $m_body = $this->input->post("m_body");
        $m_id = $this->input->post("m_id");


        if ($action_post == "read") {

            $this->db->insert("message_read",array("m_id"=>$m_id,"user_id"=>$this->session->userdata('user_id')));
        }


        elseif ($action_post == "add") {

            $arr_rec=explode(',',$m_to);
            $receiver=array();
            foreach($arr_rec as $ar){
                $resa=$this->db->query("select id from users where username='".$ar."' ");
                $u_id=$resa->row();
                if($u_id){
                    $receiver[] =$u_id ;
                }
            }

            if($receiver){
                $big_arr=array();
                foreach($receiver as $r){

                    $arr=array("m_from"=>$this->session->userdata('user_id'),
                        "m_to"=>$r->id,
                        "m_header"=>$m_header,
                        "m_body"=>$m_body,
                        "m_attachment"=>$this->session->userdata("file_upload"),
                        "m_date"=>date("d/m/Y   h:m:s "),
                    ) ;
                    $big_arr[]=$arr;
                }

            $this->db->insert_batch("messages",$big_arr);
            $messages="";
            if($this->db->affected_rows()>0){
                $messages="success";
            }else{
                $messages="failed";
            }

            }else{
                $messages="This username not Correct  ";
            }
            $this->session->unset_userdata('file_upload');
            echo json_encode(array("message"=>$messages));
            exit;
        }

        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'main_url' => SITE_LINK . "/" . "security/",
            'hrw' =>$hrw,
            'messages' =>$messages,
            'p_m_id' =>$p_m_id,

        ));
        $data['base_url'][] = SITE_LINK;
        $data['hrw'] = $hrw;
        $data['messages'] = $messages;
        $data['messages_sent'] = $messages_sent;
        $data['js'][] = "usage/mails.js";

        $data['first_title'] = "Home";
        $data['messages_read'] = $messages_read;
        $data['second_title'] = "Inbox ";
        $data['third_title'] = " Messages   ";
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
        $form_id=9;
        $hrw=get_form_authority($this->session->userdata('group_id'),$form_id);

        if($hrw=="h"){
            echo "      No privilege ...   . Contact System Administrator ";
            redirect(SITE_LINK."/security/login","refresh");
        }
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
            'hrw' =>$hrw
        ));
        $data['hrw'] = $hrw;
        $data['base_url'][] = SITE_LINK;
        $data['classes'][] = $classes;
        $data['absence'][] = $absence;
        $data['p_class'][] = $p_class;
        $data['class_students'][] = $class_students;
        $data['js'][] = "usage/student_absence.js";
        $data['first_title'] = "Home";
        $data['second_title'] = "Absence";
        $data['third_title'] = "Student  Absence  ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'student_absence', $data);



    }

    public function staff_absence()
    {


        $form_id=16;
        $hrw=get_form_authority($this->session->userdata('group_id'),$form_id);

        if($hrw=="h"){
            echo "       No privilege ...   . Contact System Administrator ";
            redirect(SITE_LINK."/security/login","refresh");
        }
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

        $set_users = $this->mymodel_model->select("users", "groups not  in ('student','not_defined','parent')"); //$class_students=staff_absence
        $absence = $this->mymodel_model->select("v_user_absence", "groups not in ('student','not_defined','parent') and   day='$today' ");

        if ($action_post == "add") { // take absence
            $no = "";
            $message = "";
            $big_st_ids = array();


            $this->db->trans_begin();

            foreach ($ajax_data->selection as $st) {
                $big_st_ids[] = array("day" => $ajax_data->date, "user_id" => $st);

            }

            $this->db->where("day", $ajax_data->date);
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
            'set_users' => $set_users,
            'absence' => $absence,
            'p_date' => $today,
            'hrw' =>$hrw
        ));
        $data['hrw'] = $hrw;
        $data['base_url'][] = SITE_LINK;

        $data['absence'][] = $absence;
        $data['set_users'][] = $set_users;
        $data['js'][] = "usage/staff_absence.js";

        $data['first_title'] = "Home";
        $data['second_title'] = "Absence";
        $data['third_title'] = "Staff Absence  ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'staff_absence', $data);

    }
}