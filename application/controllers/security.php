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

        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $id = $this->input->get("id");
        $row_add = json_decode($this->input->post("row_add"));


        if (USER_GROUP != "admin") {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }


        if (!$this->ion_auth->logged_in()) {
            //echo SITE_LINK;
            //  exit;
            //redirect them to the login page
            redirect(SITE_LINK . '/security/login', 'refresh');
        }

        else {

            if ($action_get == "get_data") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("users");
                if ($id) {
                    $this->db->where("id", $id);
                }

                //User filter

                $flds_array = array(
                    'student_id' => array('where' => "student_id", 'order' => "student_id", 'val_template' => '', 'lower' => false),
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
                //   echo $this->db->last_query();

                if ($rs->num_rows() > 0) {
                    $back = array('total' => $this->db->count_all_results(), 'rows' => $rs->result_array());

                }

                echo json_encode($back);
                exit;
            }
            if ($action_post == "change_password") {
                $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
                $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
                $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

                if (!$this->ion_auth->logged_in()) {
                    redirect(SITE_LINK . "/security/login", 'refresh');
                }

                $user = $this->ion_auth->user()->row();

                if ($this->form_validation->run() == false) {
                    //display the form
                    //set the flash data error message if there is one
                    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                    $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                    $this->data['old_password'] = array(
                        'name' => 'old',
                        'id' => 'old',
                        'type' => 'password',
                    );
                    $this->data['new_password'] = array(
                        'name' => 'new',
                        'id' => 'new',
                        'type' => 'password',
                        'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                    );
                    $this->data['new_password_confirm'] = array(
                        'name' => 'new_confirm',
                        'id' => 'new_confirm',
                        'type' => 'password',
                        'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                    );
                    $this->data['user_id'] = array(
                        'name' => 'user_id',
                        'id' => 'user_id',
                        'type' => 'hidden',
                        'value' => $user->id,
                    );

                    //render
                    $this->_render_page('security/change_password', $this->data);
                }
                else {
                    $identity = $this->session->userdata('identity');

                    $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    }
                    else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect(SITE_LINK . "/security/change_password", 'refresh');
                    }
                }
                echo json_encode("user created successfully ");
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
                        redirect("auth/forgot_password", 'refresh');
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
            if ($action_post == "create_user") {
                $this->data['title'] = "Create User";

                if (!$this->ion_auth->logged_in()) {
                    redirect('auth', 'refresh');
                }

                //   $tables = $this->config->item('tables','ion_auth');

                // echo $row_add->username;
                //  exit;
                $ip_address = '';
                $salt = '';
                $password = $this->ion_auth->hash_password($row_add->password, $salt);

                $dat = array(
                    'name' => $row_add->name,
                    ///'ssn' =>$row_add->ssn,
                    'username' => $row_add->username,
                    'company' => $row_add->company,
                    'email' => strtolower($row_add->email),
                    'password ' => $password,
                    'ip_address' => $ip_address,
                    'created_on' => time(),
                    'last_login' => time(),
                    'active' => 1
                );
                $this->db->insert("users", $dat);
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                    exit;
                }
                else {

                    echo json_encode(array("result" => "failed"));
                    exit;
                }
                exit;
            }

            //edit a user
            if ($action_post == "edit_user") {
                $id = $this->input->post("id");
                $this->data['title'] = "Edit User";

                if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
                    redirect('security', 'refresh');
                }

                $user = $this->ion_auth->user($id)->row();
                $groups = $this->ion_auth->groups()->result_array();
                $currentGroups = $this->ion_auth->get_users_groups($id)->result();

                //validate form input
                $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
                $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
                $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
                $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required|xss_clean');
                $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

                if (isset($_POST) && !empty($_POST)) {
                    // do we have a valid request?
                    if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                        show_error($this->lang->line('error_csrf'));
                    }

                    $data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'company' => $this->input->post('company'),
                        'phone' => $this->input->post('phone'),
                    );

                    // Only allow updating groups if user is admin
                    if ($this->ion_auth->is_admin()) {
                        //Update the groups user belongs to
                        $groupData = $this->input->post('groups');

                        if (isset($groupData) && !empty($groupData)) {

                            $this->ion_auth->remove_from_group('', $id);

                            foreach ($groupData as $grp) {
                                $this->ion_auth->add_to_group($grp, $id);
                            }

                        }
                    }

                    //update the password if it was posted
                    if ($this->input->post('password')) {
                        $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                        $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

                        $data['password'] = $this->input->post('password');
                    }

                    if ($this->form_validation->run() === TRUE) {
                        $this->ion_auth->update($user->id, $data);

                        //check to see if we are creating the user
                        //redirect them back to the admin page
                        $this->session->set_flashdata('message', "User Saved");
                        if ($this->ion_auth->is_admin()) {
                            redirect('security', 'refresh');
                        }
                        else {
                            redirect('/', 'refresh');
                        }
                    }
                }

                //display the edit user form
                $this->data['csrf'] = $this->_get_csrf_nonce();

                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                //pass the user to the view
                $this->data['user'] = $user;
                $this->data['groups'] = $groups;
                $this->data['currentGroups'] = $currentGroups;

                $this->data['first_name'] = array(
                    'name' => 'first_name',
                    'id' => 'first_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('first_name', $user->first_name),
                );
                $this->data['last_name'] = array(
                    'name' => 'last_name',
                    'id' => 'last_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('last_name', $user->last_name),
                );
                $this->data['company'] = array(
                    'name' => 'company',
                    'id' => 'company',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('company', $user->company),
                );
                $this->data['phone'] = array(
                    'name' => 'phone',
                    'id' => 'phone',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('phone', $user->phone),
                );
                $this->data['password'] = array(
                    'name' => 'password',
                    'id' => 'password',
                    'type' => 'password'
                );
                $this->data['password_confirm'] = array(
                    'name' => 'password_confirm',
                    'id' => 'password_confirm',
                    'type' => 'password'
                );

                $this->_render_page('security/edit_user', $this->data);
            }
        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/user.js";
        $data['main_url'] = SITE_LINK;
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
        {
            $this->data['title'] = "Create User";

            if (!$this->ion_auth->logged_in()) {
                redirect('auth', 'refresh');
            }


            $ip_address = '';
            $salt = '';
            $password = $this->ion_auth->hash_password($this->input->post('r_password'), $salt);

            $dat = array(
                'name' => $this->input->post('r_name'),
                 'ssn' =>$this->input->post('r_ssn'),
                'username' =>$this->input->post('r_identity'),
                'company' =>$this->input->post('r_company'),
                'email' => strtolower($this->input->post('r_email')),
                'password ' => $password,
                'ip_address' => $ip_address,
                'created_on' => time(),
                'last_login' => time(),
                'active' => 1
            );
            $this->db->insert("users", $dat);
            if ($this->db->affected_rows() > 0) {

                redirect(SITE_LINK."/mainmenu");
            }
            else {


            }

        }
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


    // create a new group
    function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(SITE_LINK . '/security/login', 'refresh');
            }
        }
        else {
            //display the create group form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            $this->_render_page('security/create_group', $this->data);
        }
    }

    //edit a group
    function edit_group($id)
    {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('security', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('security', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                }
                else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("security", 'refresh');
            }
        }

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['group'] = $group;

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->_render_page('security/edit_group', $this->data);
    }


    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')
        ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false)
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }

}
