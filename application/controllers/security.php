<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');

    }

    //redirect if needed, otherwise display the user list



    function index()
    {


        if (!$this->ion_auth->logged_in()) {
            redirect(SITE_LINK . "/security/login", 'refresh');
        }

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $id = $this->input->get("id");
        $group = $this->input->get("user_group");
        $row_add = json_decode($this->input->post("row_add"));
        $row = json_decode($this->input->post("row"));
        $ajax_data = json_decode($this->input->post("data"));

        if ($this->session->userdata("groups") != "admin") {
        redirect(SITE_LINK . '/security/login', 'refresh');
        }


        else {

            $stages=$this->mymodel_model->select("stages",'1=1');
            $levels=$this->mymodel_model->select("levels",'1=1');

            if ($action_get == "get_data") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("users");
                if ($id) {
                    $this->db->where("id", $id);
                }
                elseif ($group) {
                    $this->db->where("groups", $group);
                }
                //User filter

                $flds_array = array(
                    'id' => array('where' => "id", 'order' => "id", 'val_template' => '', 'lower' => false),
                    'name' => array('where' => "name", 'order' => "name", 'val_template' => '', 'lower' => true),
                    'birthday' => array('where' => "birthday", 'order' => "birthday", 'val_template' => '', 'lower' => true),
                    'email' => array('where' => "email", 'order' => "email", 'val_template' => '', 'lower' => true),
                    'sex' => array('where' => "sex", 'order' => "sex", 'val_template' => '', 'lower' => true),
                    'religion' => array('where' => "religion", 'order' => "religion", 'val_template' => '', 'lower' => true),
                    'address' => array('where' => "address", 'order' => "address", 'val_template' => '', 'lower' => true),
                    'phone' => array('where' => "phone", 'order' => "phone", 'val_template' => '', 'lower' => true),
                );
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
                if (empty($rows)) {
                    $rows = 10;
                }
                if (empty($page)) {
                    $page = 1;
                }
                $offset = (($page - 1) * $rows) + 1;
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
                $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
                $filterRules = json_decode($this->input->get('filterRules'));
                $sorting_array = explode(',', $sort);
                $order_array = explode(',', $order);
                if (is_array($filterRules)) {
                    if (count($filterRules) > 0) {
                        foreach ($filterRules as $value) {
                            $where = "where";
                            $op = $value->op;
                            $f = $value->field;
                            $v = $value->value;
                            if (in_array($op, array('contains', 'beginwith', 'endwith'))) {
                                $is_like = true;
                                $where = 'like';
                                if ($op == "beginwith") {
                                    $like_p = 'after';
                                } elseif ($op == "endwith") {
                                    $like_p = 'before';
                                } else {
                                    $like_p = 'both';
                                }
                            } elseif (in_array($op, array('notcontains', 'notbeginwith', 'notendwith'))) {
                                $is_like = true;
                                $where = 'not_like';
                                if ($op == "notbeginwith") {
                                    $like_p = 'after';
                                } elseif ($op == "notendwith") {
                                    $like_p = 'before';
                                } else {
                                    $like_p = 'both';
                                }
                            } else {
                                $is_like = false;
                                if ($op == "notequal") {
                                    $like_p = ' != ';
                                } elseif ($op == "less") {
                                    $like_p = ' < ';
                                } elseif ($op == "lessorequal") {
                                    $like_p = ' <= ';
                                } elseif ($op == "greater") {
                                    $like_p = ' > ';
                                } elseif ($op == "greaterorequal") {
                                    $like_p = ' >= ';
                                } else {
                                    $like_p = '';
                                }
                            }

                            if (array_key_exists($f, $flds_array)) {
                                if ($is_like) {
                                    if (empty($flds_array[$f]["val_template"])) {
                                        if ($flds_array[$f]["lower"]) {
                                            $v = strtolower($v);
                                        }
                                        $this->db->$where($flds_array[$f]["where"], $v, $like_p);
                                    } else {
                                        if ($flds_array[$f]["lower"]) {
                                            $v = strtolower($v);
                                        }
                                        $m = str_replace('{the_value}', $v, $flds_array[$f]["val_template"]);
                                        if ($like_p == "after") {
                                            $this->db->$where("{$flds_array[$f]["where"]} LIKE '%$m''");
                                        } elseif ($like_p == "before") {
                                            $this->db->$where("{$flds_array[$f]["where"]} LIKE '$m%'");
                                        } else {
                                            $this->db->$where("{$flds_array[$f]["where"]} LIKE '%$m%'");
                                        }
                                    }
                                } else {
                                    if ($flds_array[$f]["lower"]) {
                                        $v = strtolower($v);
                                    }
                                    if (empty($like_p)) {
                                        $like_p = "=";
                                    }
                                    if (empty($flds_array[$f]["val_template"])) {
                                        if ($like_p == "=") {
                                            $this->db->$where($flds_array[$f]["where"] . " $like_p '$v'");
                                        } else {
                                            $this->db->$where("{$flds_array[$f]["where"]} $like_p", $v);
                                        }
                                    } else {
                                        $m = str_replace('{the_value}', $v, $flds_array[$f]["val_template"]);
                                        $this->db->$where("{$flds_array[$f]["where"]} $like_p $m");
                                    }
                                }
                            }
                        }
                    }
                }
                // End user filter
                $this->db->stop_cache();
                // start filter
                if (is_array($sorting_array)) {
                    foreach ($sorting_array as $key => $sort) {
                        if (array_key_exists($sort, $flds_array)) {
                            $ord = 'ASC';
                            if (isset($order_array[$key])) {
                                $ord = ($order_array[$key] == 'desc') ? 'DESC' : 'ASC';
                            }
                            $this->db->order_by($flds_array[$sort]["order"], $ord);
                        }
                    }
                }
                //Make limit
                $this->db->limit($rows, $offset - 1);
                $rs = $this->db->get();
                //  echo $this->db->last_query();

                if ($rs->num_rows() > 0) {
                    $back = array('total' => $this->db->count_all_results(), 'rows' => $rs->result_array());

                }

                echo json_encode($back);
                exit;
            }

            if ($action_post == "create_user") {

                $bus_fees = '';
                $salt = '';
                $password = $this->ion_auth->hash_password($row_add->password, $salt);

                if($row_add->stage){
                   $the_stage=$row_add->stage;
                   }
                else{$the_stage=0;
                }
                if($row_add->level){
                    $the_level=$row_add->level;
                }
                else{$the_level=0;
                }

                $dat = array(
                    'name' => $row_add->name,
                    'address' => $row_add->address,
                    'national_id' => $row_add->national_id,
                    'sex' => $row_add->sex,
                    'religion' => $row_add->religion,
                    'birthday' => $row_add->birthday,
                    'blood_group' => $row_add->blood_group,
                    'photo' => $row_add->photo,
                    'phone' => $row_add->phone,
                    'username' => $row_add->username,
                    'groups' => $row_add->groups,
                    'email' => strtolower($row_add->email),
                    'password ' => $password,
                    'bus_fees' => $row_add->bus_fees,
                    'last_login' => date('Y/m/d h:m:s'),
                    'stage' => $the_stage,
                    'level' => $the_level
                );

                $this->db->where('national_id',$row_add->national_id);
                $num = $this->db->count_all_results("users");//table name from drowp down

                if($num>0){
                    $this->db->where("national_id", $row_add->national_id);
                    $this->db->update("users", $dat);

                }else{
                    $this->db->insert("users", $dat);
                }

                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }

             //   echo $this->db->last_query();
                exit;
            }

            if ($action_post == "edit_user") {


                if (!$this->ion_auth->logged_in()) {
                    redirect(SITE_LINK . "/security/login", 'refresh');
                }


                $salt = '';
                $password = $this->ion_auth->hash_password($row_add->password, $salt);

                if($row_add->stage){
                    $the_stage=$row_add->stage;
                }
                else{$the_stage=0;
                }
                if($row_add->level){
                    $the_level=$row_add->level;
                }
                else{$the_level=0;
                }
                $dat = array(
                    'name' => $row_add->name,
                    'address' => $row_add->address,
                    'national_id' => $row_add->national_id,
                    'sex' => $row_add->sex,
                    'religion' => $row_add->religion,
                    'birthday' => $row_add->birthday,
                    'blood_group' => $row_add->blood_group,
                    'photo' => $row_add->photo,
                    'phone' => $row_add->phone,
                    'username' => $row_add->username,
                    'groups' => $row_add->groups,
                    'email' => strtolower($row_add->email),
                    'password ' => $password,
                    'bus_fees' => $row_add->bus_fees,
                    'last_login' => date('Y/m/d h:m:s'),
                    'stage' => $the_stage,
                    'level' => $the_level
                );

                $this->db->where("id", $row_add->id);
                $this->db->update("users", $dat);

                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                }
                elseif( $this->db->affected_rows()==0){
                    echo json_encode(array("result" => "Nothing updated"));
                }
                else {
                    echo json_encode(array("result" =>"failed"));
                }

                // print_r($res);

                //echo $this->db->last_query();
                exit;
            }

            if ($action_post == "delete") {
                $this->db->where("id", $row->id);
                $this->db->delete("users");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }

            if ($action_post == "change_password") {
                $this->form_validation->set_rules('username','username', 'required');
                $this->form_validation->set_rules('password','password' , 'required|min_length[3]|max_length[15]|matches[con_password]');

                if ($this->form_validation->run() == false) {
                   $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                    $password = $this->ion_auth->hash_password($ajax_data->password,'');
                    $new_data=array(
                        "identity"=>$ajax_data->username,
                        "password"=>$password,

                    );
                    $this->db->where("id",$id);
                    $this->db->update("users",$new_data);
                    echo json_encode($this->data['message']);
                }
                else {
                    echo json_encode("Password Changes Successfully ");
                }
                echo json_encode("Password Changes Successfully ");
                exit;
            }

            //forgot password
            if ($action_get == "forgot_password") {
                $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
                if ($this->form_validation->run() == false) {
                    //setup the input
                    $this->data['email'] = array('name' => 'email',
                        'id' => 'email',
                    );

                    if ($this->config->item('identity', 'ion_auth') == 'username') {
                        $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
                    }
                    else {
                        $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
                    }

                    //set any errors and display the form
                    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                    $this->_render_page('security/forgot_password', $this->data);
                }
                else {
                    // get identity from username or email
                    if ($this->config->item('identity', 'ion_auth') == 'username') {
                        $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
                    }
                    else {
                        $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
                    }
                    if (empty($identity)) {
                        $this->ion_auth->set_message('forgot_password_email_not_found');
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect(SITE_LINK . "/security/login", 'refresh');
                    }

                    //run the forgotten password method to email an activation code to the user
                    $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

                    if ($forgotten) {
                        //if there were no errors
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect(SITE_LINK . "/security/login", 'refresh'); //we should display a confirmation page here instead of the login page
                    }
                    else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect(SITE_LINK . "/security/forgot_password", 'refresh');
                    }
                }
            }

            //reset password - final step for forgotten password
            if ($action_post == "reset_password") {

            }
            //activate the user
            function activate($id, $code = false)
            {
            }

            //deactivate the user
            function deactivate($id = NULL)
            {
            }

            //create a new user

        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'stages' => $stages,
            'levels' =>$levels

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/user.js";
        $data['main_url'] = SITE_LINK;
        $data['stages'] = $stages;
        $data['levels'] = $levels;
        $data['use_big_model'] = "yes";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'user', $data);

    }

    //log the user in
    function login()
    {


        $this->data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(SITE_LINK . '/mainmenu', 'refresh');
            }
            else {
                //if the login was un-successful
                //redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(SITE_LINK . "/security/login", 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        else {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->_render_page('admin/login', $this->data);
        }
    }


    function front_create_user()
    {
       $data="";
        $message = "";
        if(isset($_POST['submit_create_user'])){

        $salt = '';
            $this->form_validation->set_rules('r_name', 'r_name', 'required|xss_clean');
            $this->form_validation->set_rules('r_identity', 'r_identity', 'required|trim|xss_clean');
            $this->form_validation->set_rules('r_national_id', 'r_national_id', 'required|xss_clean|max_length[15]');
            $this->form_validation->set_rules('r_email', 'r_email', 'required|trim|xss_clean|valid_email');



            if ($this->form_validation->run() == FALSE) // validation hasn't been passed
            {
              $message="Full Fill all fields ";
            }
            else // passed validation proceed to post success logic
            {


                $password = $this->ion_auth->hash_password($this->input->post('r_password'), $salt);



                $dat = array(
                    'name' => $this->input->post('r_name'),
                    'national_id' => $this->input->post('r_national_id'),
                    'username' => $this->input->post('r_identity'),
                    'groups' => $this->input->post('r_group'),
                    'email' => strtolower($this->input->post('r_email')),
                    'password ' => $password,
                    'created_on' => date('y/m/d h:m:s'),
                    'last_login' => date('y/m/d h:m:s'),
                    'active' => 1
                );

                $this->db->where('national_id',$this->input->post('r_national_id'));
                $num = $this->db->count_all_results("users");//table name from drowp down

                if($num>0){
                    $this->db->where("national_id", $this->input->post('r_national_id'));
                    $this->db->update("users", $dat);
                    if ($this->db->affected_rows() > 0||$this->db->affected_rows() == 0) {
                        $message = "Registration Success . ";
                        redirect(SITE_LINK."/security/login","refresh");
                    }
                    else {
                        $message = "Registration Failed Try Again . ";
                    }

                }else{

                    $message ="National No.  Not Exist in Your  School Database";
                }


            }

  }

        $data = array(
            "message" => $message
        );


        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'register', $data);
    }

    //log the user out
    function logout()
    {
        $this->data['title'] = "Logout";

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect(SITE_LINK . '/security/login', 'refresh');
    }

    //change password



    function _render_page($view, $data = null, $render = false)
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }

    public function export($x='') {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        $query = "select name ,email, national_id,phone,address from users where groups='".$x."' ";

        $result = mysql_query($query) or die(mysql_error());
        $column = 'A';
        for ($i =0; $i < mysql_num_fields($result); $i++)
        {
            $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, mysql_field_name($result,$i));
            $column++;
        }
        $rowCount = 2;
        while($row = mysql_fetch_row($result))
        {
            $column = 'A';
            for($j=0; $j<mysql_num_fields($result);$j++)
            {
                if(!isset($row[$j]))
                    $value = NULL;
                elseif ($row[$j] != "")
                    $value = strip_tags($row[$j]);
                else
                    $value = "";

                $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
                $column++;
            }
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="file.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public  function import($group="") {

        $inputFileName =$_FILES['file']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

            $cols=array();
            $vals=array();

            $worksheetTitle     = $worksheet->getTitle();
            $highestRow         = $worksheet->getHighestRow();
            $highestColumn      = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
            for ($row = 1; $row <= 1; ++ $row) {

                for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    $cols[]=$val;
                }
            }
            $table=array();
            $one=array();
            for ($row = 2; $row <= $highestRow; ++ $row) {

                for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    $one[$cols[$col]]=$val;
                    $one["groups"]=$group;
                }
                $table[]=$one;

            }


        }
        $this->db->insert_batch("users",$table);
        echo json_encode(array("rows"=>count($table)));
        exit;
    }

}
