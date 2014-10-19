<?php
require_once('Classes/PHPExcel.php');

function option($field)
{
    $ci =& get_instance();
    $ci->db->select("value");
    $ci->db->where("key", $field);
    $ci->db->from("options");
    $result = $ci->db->get();
    $res = $result->result();
    return $res[0]->value;
}

function translate($key)
{
    $language = option("default_language");
    $ci =& get_instance();
    $ci->db->select($language);
    $ci->db->from("translation");
    $ci->db->where("key", strtolower($key));
    $arr_trans = $ci->db->get();
    $res = $arr_trans->result();
    return $res[0]->$language;

}

 function data_user($id){
     $ci =& get_instance();
    $query= $ci->db->query("select * from users where id=".$id." ");
    return  $query->row();
}


function data_class($id){
    $ci =& get_instance();
    $query= $ci->db->query("select * from class where class_id=".$id." ");
    return  $query->row();
}

function get_form_authority($group,$form){
    $ci =& get_instance();
    $ci->db->where("group_id",$group);
    $ci->db->where("form_id",$form);
    $ci->db->select("*");
    $ci->db->from("groups_forms");
    $r= $ci->db->get();
    $res=$r->row();
    if($res){
        return $res->h_r_w;
    }else{
        return "h";
    }

}


    function get_children_menu($parent){
        $ci =& get_instance();
        $ci->db->select("*");
        $ci->db->from("v_groups_forms_menu");
        $ci->db->where("parent",$parent);
        $ci->db->where("group_id",$ci->session->userdata("group_id"));
        $ci->db->where("h_r_w !='h'");
        $ci->db->order_by("sort","asc");
        $sub=$ci->db->get();
        // echo $ci->db->last_query();
        $submenu=$sub->result();
        return $submenu;
    }

        function get_parent_menu(){
            $ci =& get_instance();
            $ci->db->select("*");
            $ci->db->from("v_groups_forms_menu");
            $ci->db->where("group_id",$ci->session->userdata("group_id"));
            $ci->db->where("h_r_w !='h' ");
            $ci->db->where("parent =0 ");
            $ci->db->order_by("sort","asc");
            $m=$ci->db->get();
            $menu=$m->result();
            return $menu;
        }


if (!function_exists("getPersUserData")) {



    function  getPersUserData()
    {

        $ci =& get_instance();
        if (!$ci->session->userdata("user_id")) {

            redirect(option("site_url")."/security/login","refresh");
            exit;
        }

    }
}


function get_unread_messages(){
    $ci =& get_instance();
    $user_id=$ci->session->userdata('user_id');
    $ci->db->select("m_id");
    $ci->db->where('user_id', $ci->session->userdata('user_id'));
    $ci->db->from("message_read");
        $m_res = $ci->db->get();
        $messages_reads = $m_res->result();
        $_reads=array();
    $_reads[]=0;
    if(!empty($messages_reads)){
        foreach($messages_reads as $one){
            $_reads[]=$one->m_id;
        }
    }

    $res_ms = $ci->db->query("select * from messages where m_to=".$user_id."  and m_id not in (".implode(",",$_reads).") ");

    $ms = $res_ms->result();
    return  $ms;

}



?>