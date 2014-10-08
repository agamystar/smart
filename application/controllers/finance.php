<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Finance extends MY_Controller
{
    const TABLE_NAME = "users";
    private $user_frm_flag = "R";

    public function __construct()
    {
        parent::__construct();

        $this->load->library("excel");

    }


    function expenses()
    {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $stage = $this->input->get("stage");
        $level = $this->input->get("level");

        $row_add = json_decode($this->input->post("row_add"));
        $expense =$this->input->get("expense");
        $installment =$this->input->get("installment");


        $stages = $this->mymodel_model->select("stages", '1=1');
        $levels = $this->mymodel_model->select("levels", '1=1');
        $installments = $this->mymodel_model->select("installments", '1=1');
        $teachers = $this->mymodel_model->select("users", 'groups="teacher"');
        $expenses = $this->mymodel_model->select("expenses", '1=1 ');
        if ($this->session->userdata("groups") != "admin") {
            redirect(SITE_LINK . '/security/login', 'refresh');
        }


        else {

            if ($action_get == "get_data") {

                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("v_student_expenses");
                $this->db->where("stage",$stage);
                $this->db->where("level",$level);
                $this->db->where("expenses_id",$expense);
                $this->db->where("installment_id",$installment);

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
            if ($action_get == "get_students") {
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
                if (empty($rows)) {
                    $rows = 10;
                }
                if (empty($page)) {
                    $page = 1;
                }
                $offset = (($page - 1) * $rows) + 1;
                $back = array();
                $this->db->select('*');
                $this->db->start_cache();
                $this->db->from("users");
                $this->db->where("groups","student");
                $this->db->where("stage",$stage);
                $this->db->where("level",$level);
                $this->db->limit($rows, $offset - 1);
                $rs = $this->db->get();
                // echo $this->db->last_query();

                if ($rs->num_rows() > 0) {
                    $back = array('total' => $this->db->count_all_results(), 'rows' => $rs->result_array());

                }

                echo json_encode($back);
                exit;
            }
            if ($action_post == "add") {
                $dat = array(
                    'student_id' => $row_add->student_id,

                    'installment_id' => $row_add->installment_id,
                    'paid_date' => $row_add->paid_date,
                    'amount' => $row_add->amount,
                    'expenses_discount' => $row_add->expenses_discount
                );
                $this->db->insert("student_installments", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows() == 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => $this->db->_error_number() . " * " . $this->db->_error_message()));
                }
                exit;
            }
            if ($action_post == "edit") {

                $dat = array(
                   // 'student_id' => $row_add->student_id,

                   // 'installment_id' => $row_add->installment_id,
                    'paid_date' => $row_add->paid_date,
                    'amount' => $row_add->amount,
                    'expenses_discount' => $row_add->expenses_discount
                );
                $this->db->where("student_id", $row_add->student_id);
                $this->db->where("installment_id", $row_add->installment_id);
                $this->db->update("student_installments", $dat);
                if ($this->db->affected_rows() > 0 || $this->db->affected_rows() == 0) {
                    echo json_encode(array("result" => "success"));
                } else {
                    echo json_encode(array("result" => $this->db->_error_number() . " * " . $this->db->_error_message()));
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
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'stages' => $stages,
            'levels' => $levels,
            'expenses' => $expenses,
            'installments' => $installments

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/student_expenses.js";
        $data['main_url'] = SITE_LINK;
        $data['stages'] = $stages;
        $data['levels'] = $levels;
        $data['teachers'] = $teachers;
        $data['expenses'] = $expenses;
        $data['use_big_model'] = "yes";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'student_expenses', $data);

    }


    public function get_class_children($stage, $level_id)
    {
        $ar = array();
        $cl = array();
        $que = $this->db->query("select  class_id as id , name as text from v_stage_level_class where stage=" . $stage . " and level=" . $level_id . " ");

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
        $quer = $this->db->query("select  level as id , level_name as text from v_stage_level_class where stage=" . $stage_id . " ");

        foreach ($quer->result() as $row) {
            //$arrs['id']=$row->id;
            $arrs['text'] = $row->text;
            $arrs['children'] = $this->get_class_children($stage_id, $row->id);
            $stage_level[] = $arrs;

        }
        // echo json_encode( $stage_level);
        return $stage_level;

    }

    public function installments($x = '')
    {


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));


        $data = array();

        if (empty($x)) {
            $this->db->select("*");
            $this->db->from("class");
            $this->db->limit(1);
            $rr = $this->db->get();
            $r_class = $rr->row();
            $class = $r_class->class_id;
        } else {

            $class = $x;
        }


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


        $classes = $this->mymodel_model->select("class", "1=1");

        $students = $this->mymodel_model->select("users", 'groups="student" and id not in (select student_id from class_students) ');
        $class_students = $this->mymodel_model->select("v_class_students", "class_id=$class");
        //  print_r($students);
        // print_r($class_students);
        if ($action_post == "distribute_students") {

            $no = "";
            $message = "";
            $big_st_ids = array();
            foreach ($ajax_data->students_inclass as $st) {
                $big_st_ids[] = array("class_id" => $ajax_data->class, "student_id" => $st);

            }
            $imp = implode(",", $ajax_data->students_inclass);

            $this->db->where("class_id", $ajax_data->class);
            $this->db->delete("class_students");


            if (!empty($big_st_ids)) {
                $this->db->insert_batch("class_students", $big_st_ids);
                if ($this->db->affected_rows() > 0) {
                    $no = $this->db->affected_rows();
                    $message = "success";
                } else {
                    $message = "failed  ";
                }
            }
            // echo $this->db->last_query();

            echo  json_encode(array("message" => $message, "no" => $no));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1] . "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "security/",
            'p_class' => $class,


        ));

        $data['base_url'][] = SITE_LINK;
        $data['classes'][] = $classes;
        $data['students'][] = $students;
        $data['p_class'][] = $class;
        $data['class_students'][] = $class_students;
        // $data['stage_level_class'][] = $stage_level_class;
        $data['js'][] = "usage/installments.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'installments', $data);
    }

    public function export($x = '')
    {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        $query = "select student_name as 'Name' from v_class_students where class_id= $x ";
        $result = mysql_query($query) or die(mysql_error());
        $column = 'A';
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, mysql_field_name($result, $i));
            $column++;
        }
        $rowCount = 2;
        while ($row = mysql_fetch_row($result)) {
            $column = 'A';
            for ($j = 0; $j < mysql_num_fields($result); $j++) {
                if (!isset($row[$j]))
                    $value = NULL;
                elseif ($row[$j] != "")
                    $value = strip_tags($row[$j]);
                else
                    $value = "";

                $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $value);
                $column++;
            }
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="simple.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function import($x)
    {

        //$inputFileName = './assets/simple.xlsx';
        $inputFileName = $_FILES['file']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

            $cols = array();
            $vals = array();

            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
            for ($row = 1; $row <= 1; ++$row) {

                for ($col = 0; $col < $highestColumnIndex; ++$col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    $cols[] = $val;
                }
            }
            $table = array();
            $one = array();
            for ($row = 2; $row <= $highestRow; ++$row) {

                for ($col = 0; $col < $highestColumnIndex; ++$col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    $one[$cols[$col]] = $val;
                    $one['class_id'] = $x;
                }
                $table[] = $one;

            }


        }
        $this->db->insert_batch("class_students", $table);

        echo $this->db->last_query();
        echo json_encode(array("rows" => count($table)));
        exit;
    }


}