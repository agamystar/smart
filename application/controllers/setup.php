<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library("excel");
    }
    public function index(){}
    function buses()
    {


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

        }


        $data = array();
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/setup_buses.js";
        $data['main_url'] = SITE_LINK;
        $data['use_big_model'] = "yes";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'setup_buses', $data);

    }

}