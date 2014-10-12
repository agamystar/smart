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

 function name_user($id){
     $ci =& get_instance();
    $query= $ci->db->query("select * from users where id=".$id." ");
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




?>