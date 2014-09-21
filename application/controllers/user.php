<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    const TABLE_NAME = "users";
    private $user_frm_flag = "R";

    public function __construct() {
        parent::__construct();

        $this->load->library("excel");
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
}