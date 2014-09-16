<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mainmenu extends MY_Controller
{
    const TABLE_NAME = "student";
    private $user_frm_flag = "R";

    public function __construct() {
        parent::__construct();

    }

    public function index()
    {
        $this->load->view('admin/index');
    }
}