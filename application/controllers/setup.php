<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller
{
    const TABLE_NAME_SUBJECT= "subject";
    private $user_frm_flag = "R";

    public function index()
    {
        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $id = $this->input->post("id");
        $key = $this->input->post("key");
        $english = $this->input->post("english");
        $arabic = $this->input->post("arabic");
        $p_id = $this->input->post("p_id");
        $row = json_decode($this->input->post("row"));



        if ($action_get == "get_data") {

            $back = array();
            $serial = $this->session->userdata('user_serial');
            $do_filter = false;


            $this->db->select('*');

            $this->db->start_cache();
            $this->db->from(self::TABLE_NAME_SUBJECT);
            //User filter
// subject_id 	name 	class_id 	id
            $flds_array = array(
                'subject_id' => array('where' => "subject_id", 'order' => "subject_id", 'val_template' => '', 'lower' => false),
                'name' => array('where' => "name", 'order' => "name", 'val_template' => '', 'lower' => true),
                'class_id' => array('where' => "class_id", 'order' => "class_id", 'val_template' => '', 'lower' => true),
                'id' => array('where' => "id", 'order' => "id", 'val_template' => '', 'lower' => true),
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

            if ($rs->num_rows() > 0) {
                $back = array('total' => $this->db->count_all_results(), 'rows' => $rs->result_array());

            }
            // echo $this->db->last_query();

            echo json_encode($back);
            exit;
        }

        if ($action_post == "add") {
            $fields = array(
                'key' => $key,
                'english' => $english,
                'arabic' => $arabic
            );
            $this->db->insert(self::TABLE_NAME, $fields);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" => "failed"));
            }
            exit;
        }
        if ($action_post == "edit") {


            $fields = array(
                //'id' => $row->id,
                'key' =>$row->key,
                'english' => $row->english,
                'arabic' => $row->arabic
            );
            $this->db->where("id", $p_id);
            $this->db->update(self::TABLE_NAME_SUBJECT, $fields);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" => "failed"));
            }

       //  echo $this->db->last_query();
            exit;
        }
        if ($action_post == "delete") {
            $this->db->where("id", $p_id);
            $this->db->delete(self::TABLE_NAME_SUBJECT);
            if ($this->db->affected_rows()> 0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" => "failed"));
            }
           // echo $this->db->last_query();
            exit;
        }
        $data = array();
        $data["js_vars"] = json_encode(array(
            "user_frm_flag" => $this->user_frm_flag,
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1],

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/student.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'student', $data);

    }
}