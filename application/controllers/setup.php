<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library("excel");
    }
    public function index(){}

    function buses()  {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $id = $this->input->get("id");
        $group = $this->input->get("user_group");
        $row_add = json_decode($this->input->post("row_add"));
        $row = json_decode($this->input->post("row"));
        $ajax_data = json_decode($this->input->post("data"));
        $teachers=$this->mymodel_model->select("users",'groups="teacher"');
        if ($this->session->userdata("groups") != "admin") {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }


        else {

            if ($action_get == "get_data") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("bus");


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
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'no';
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

            if ($action_post == "add") {

                $dat = array(
                    'no' => $row_add->no,
                    'driver' => $row_add->driver,
                    'supervisor' => $row_add->supervisor,
                    'path' => $row_add->path,
                    'student_fees' => $row_add->student_fees,
                    'school_fees' => $row_add->school_fees,

                );
                    $this->db->insert("bus", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit") {

                $dat = array(
                    'no' => $row_add->no,
                    'driver' => $row_add->driver,
                    'supervisor' => $row_add->supervisor,
                    'path' => $row_add->path,
                    'student_fees' => $row_add->student_fees,
                    'school_fees' => $row_add->school_fees,

                );
                    $this->db->where("no", $row_add->id);
                    $this->db->update("bus", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }

            if ($action_post == "delete") {
                $this->db->where("no", $this->input->post('id'));
                $this->db->delete("bus");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }
        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'teachers' => $teachers,

        ));
        $data['teachers'] = $teachers;
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/setup_buses.js";
        $data['main_url'] = SITE_LINK;
        $data['use_big_model'] = "yes";
        $data['first_title'] = "Home";
        $data['second_title'] = "Setup";
        $data['third_title'] = " Buses ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'setup_buses', $data);

    }
    function subjects()  {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $subject_name= $this->input->post("subject_name");
        $subject_id= $this->input->post("subject_id");
        $stage_id= $this->input->post("stage_id");

        $stages=$this->mymodel_model->select("stages",'1=1 order by stage_id ');
        if ($this->session->userdata("groups") != "admin") {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }


        else {

            if ($action_get == "get_data") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("subjects");

                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
                if (empty($rows)) {
                    $rows = 10;
                }
                if (empty($page)) {
                    $page = 1;
                }
                $offset = (($page - 1) * $rows) + 1;
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'no';
                $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
                $filterRules = json_decode($this->input->get('filterRules'));
                $sorting_array = explode(',', $sort);
                $order_array = explode(',', $order);
                $flds_array=array();
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

            if ($action_post == "add") {

                $dat = array(

                    'name' => $subject_name,
                    'stage_id' => $stage_id

                );
                $this->db->insert("subjects", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit") {

                $dat = array(

                    'name' => $subject_name,
                    'stage_id' => $stage_id

                );
                $this->db->where("subject_id", $this->input->post("subject_id"));
                $this->db->update("subjects", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }

            if ($action_post == "delete") {
                $this->db->where("subject_id", $this->input->post("subject_id"));
                $this->db->delete("subjects");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }
        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],

            'stages' => $stages,

        ));
        $data['stages'] = $stages;
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/subjects.js";
        $data['main_url'] = SITE_LINK;
        $data['first_title'] = "Home";
        $data['second_title'] = "Setup";
        $data['third_title'] = " Subjects ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'subjects', $data);

    }
    function classes()  {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $id = $this->input->get("id");
        $group = $this->input->get("user_group");
        $row_add = json_decode($this->input->post("row_add"));
        $row = json_decode($this->input->post("row"));
        $ajax_data = json_decode($this->input->post("data"));


        $stages=$this->mymodel_model->select("stages",'1=1');
        $levels=$this->mymodel_model->select("levels",'1=1');
        $teachers=$this->mymodel_model->select("users",'groups="teacher"');

        if ($this->session->userdata("groups") != "admin") {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }


        else {

            if ($action_get == "get_data") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("class");


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
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'class_id';
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

            if ($action_post == "add") {

                $dat = array(
                    'name' => $row_add->name,
                    'name_numeric' => $row_add->name_numeric,
                    'stage' => $row_add->stage,
                    'level' => $row_add->level,
                    'teacher_id' => $row_add->teacher_id
                );
                    $this->db->insert("class", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit") {

                $dat = array(
                    'name' => $row_add->name,
                    'name_numeric' => $row_add->name_numeric,
                    'stage' => $row_add->stage,
                    'level' => $row_add->level,
                    'teacher_id' => $row_add->teacher_id
                );
                    $this->db->where("class_id", $row_add->id);
                    $this->db->update("class", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }



            if ($action_post == "delete") {
                $this->db->where("class_id", $this->input->post('id'));
                $this->db->delete("class");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }


        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'stages' => $stages,
            'levels' => $levels,
            'teachers' => $teachers,

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/setup_classes.js";
        $data['main_url'] = SITE_LINK;
        $data['stages'] = $stages;
        $data['levels'] = $levels;
        $data['teachers'] = $teachers;
        $data['use_big_model'] = "yes";

        $data['first_title'] = "Home";
        $data['second_title'] = "Setup";
        $data['third_title'] = " Classes ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'setup_classes', $data);

    }
    function expenses()  {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $id = $this->input->get("id");
        $group = $this->input->get("user_group");
        $row_add = json_decode($this->input->post("row_add"));
        $row = json_decode($this->input->post("row"));
        $ajax_data = json_decode($this->input->post("data"));


        $stages=$this->mymodel_model->select("stages",'1=1');
        $levels=$this->mymodel_model->select("levels",'1=1');

        if ($this->session->userdata("groups") != "admin") {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }


        else {

            if ($action_get == "get_data_1") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("expenses");


                $flds_array = array(
                    'stage_id' => array('where' => "id", 'order' => "id", 'val_template' => '', 'lower' => false),
                    'stage_name' => array('where' => "name", 'order' => "name", 'val_template' => '', 'lower' => true),
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
            if ($action_post == "add_1") {

                $dat = array(
                    'expenses_name' => $row_add->name,
                    'expenses_stage' => $row_add->stage,
                    'expenses_level' => $row_add->level,
                    'expenses_value' => $row_add->value

                );
                $this->db->insert("expenses", $dat);

                  $in_data=array("expenses_id"=>$this->db->insert_id() ,
                      "name"=>"installment 1 ",
                      "value"=>$row_add->value ,
                      "end_date"=>date("d/m/Y")
                  );

                if ($this->db->affected_rows() > 0 ) {
                    $this->db->insert("installments",$in_data );
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit_1") {

                $dat = array(
                    'expenses_name' => $row_add->name,
                    'expenses_stage' => $row_add->stage,
                    'expenses_level' => $row_add->level,
                    'expenses_value' => $row_add->value

                );
                $this->db->where("expenses_id", $row_add->id);
                $this->db->update("expenses", $dat);
                if ($this->db->affected_rows() > 0 ) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "delete_1") {
                $this->db->where("expenses_id", $this->input->post('id'));
                $this->db->delete("expenses");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }
            if ($action_get == "get_data_2") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("installments");
                $this->db->where("expenses_id",$this->input->get("expenses_id"));


                $flds_array = array(
                    'stage_id' => array('where' => "id", 'order' => "id", 'val_template' => '', 'lower' => false),
                    'stage_name' => array('where' => "name", 'order' => "name", 'val_template' => '', 'lower' => true),
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
            if ($action_post == "add_2") {

                $dat = array(
                    'expenses_id'=>$row_add->expenses_id,
                    'name' => $row_add->name,
                    'value' => $row_add->value,
                    'end_date' => $row_add->end_date,


                );
                $this->db->insert("installments", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit_2") {

                $dat = array(

                    'expenses_id'=>$row_add->expenses_id,
                    'name' => $row_add->name,
                    'value' => $row_add->value,
                    'end_date' => $row_add->end_date,


                );
                $this->db->where("installment_id", $row_add->installment_id);
                $this->db->update("installments", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "delete_2") {
                $this->db->where("installment_id", $this->input->post('id'));
                $this->db->delete("installments");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }
        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'stages' => $stages,
            'levels' => $levels,

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/setup_expenses.js";
        $data['main_url'] = SITE_LINK;
        $data['use_big_model'] = "yes";
        $data['first_title'] = "Home";
        $data['second_title'] = "Setup";
        $data['third_title'] = " Expenses And Installments ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'setup_expenses', $data);

    }
    function stages_levels()  {
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

            if ($action_get == "get_data_s") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("stages");


                $flds_array = array(
                    'stage_id' => array('where' => "id", 'order' => "id", 'val_template' => '', 'lower' => false),
                    'stage_name' => array('where' => "name", 'order' => "name", 'val_template' => '', 'lower' => true),
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
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'no';
                $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
                $filterRules = json_decode($this->input->get('filterRules'));
                $sorting_array = explode(',', $sort);
                $order_array = explode(',', $order);

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
            if ($action_get == "get_data_l") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("levels");
                $this->db->where("stage_id",$this->input->get("stage_id"));


                $flds_array = array(
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
                $sort = isset($_GET['sort']) ? $_GET['sort'] : 'no';
                $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
                $filterRules = json_decode($this->input->get('filterRules'));
                $sorting_array = explode(',', $sort);
                $order_array = explode(',', $order);
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
            if ($action_post == "add_s") {

                $dat = array(
                    'stage_name' => $this->input->post('stage_name')

                );
                $this->db->insert("stages", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit_s") {

                $dat = array(
                    'stage_name' => $this->input->post('stage_name')
                );
                $this->db->where("stage_id",$this->input->post('id'));
                $this->db->update("stages", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "delete_s") {
                $this->db->where("stage_id",$this->input->post('id'));
                $this->db->delete("stages");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                    exit;
                } else {
                    echo json_encode(array("result" => "failed"));
                    exit;
                }
                echo $this->db->last_query();
                exit;
            }
            if ($action_post == "add_l"){
                $dat = array(
                    'stage_id' =>$this->input->post("stage_id") ,
                    'level_id' =>$this->input->post("id_l") ,
                    'level_name' =>$this->input->post("level_name")
                );
                $this->db->insert("levels", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit_l") {

                $dat = array(
                   // 'stage_id' =>$this->input->post("stage_id") ,
                   // 'level_id' =>$this->input->post("id_l") ,
                    'level_name' =>$this->input->post("level_name")
                );
                $this->db->where("stage_id",$this->input->post("stage_id"));
                $this->db->where("level_id",$this->input->post("id_l"));
                $this->db->update("levels", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
                }
             //   echo $this->db->last_query();
                exit;
            }
            if ($action_post == "delete_l") {
                $this->db->where("stage_id", $this->input->post('stage_id'));
                $this->db->where("level_id", $this->input->post('level_id'));
                $this->db->delete("levels");
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => "failed"));
                }
                // echo $this->db->last_query();
                exit;
            }
        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/setup_stages_levels.js";
        $data['main_url'] = SITE_LINK;
        $data['use_big_model'] = "yes";

        $data['first_title'] = "Home";
        $data['second_title'] = "Setup";
        $data['third_title'] = " Stages And Levels  ";

        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'setup_stages_levels', $data);

    }

}