<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller
{
    const TABLE_NAME = "users";
    private $user_frm_flag = "R";

    public function __construct() {
        parent::__construct();

        $this->load->library("excel");

        if (IS_USER_LOGIN)
        {
            redirect(SITE_LINK.'/security/login', 'refresh');
            exit;
        }
    }

    public function index()
    {
        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");

        $index = $this->input->get("index");
        $row = json_decode($this->input->post("row"));
        $row_add = json_decode($this->input->post("row_add"));
        $id = $this->input->post("id");
        $dataa = $this->input->post("data");

        if ($action_get == "get_data") {

            $back = array();
            $serial = $this->session->userdata('user_serial');
            $do_filter = false;


            $this->db->select('*');

            $this->db->start_cache();
            $this->db->where('group','student');
            $this->db->from(self::TABLE_NAME);
            if ($index) {
                $this->db->where("id", $index);
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
            //   echo $this->db->last_query();

            if ($rs->num_rows() > 0) {
                $back = array('total' => $this->db->count_all_results(), 'rows' => $rs->result_array());

            }

            echo json_encode($back);
            exit;
        }

        if ($action_post == "add") {

            $fields = array(
                'name' => $row_add->name,
                'birthday' => $row_add->birthday,
                'sex' => $row_add->sex,
                'religion' => $row_add->religion,
                'address' => $row_add->address,
                'phone' => $row_add->phone,
                'email' => $row_add->email,
                'class_id' => $row_add->class,
                'roll' => $row_add->roll,
                'father_name' => $row_add->father_name,
                'mother_name' => $row_add->mother_name,
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
                'name' => $row_add->name,
                'birthday' => $row_add->birthday,
                'sex' => $row_add->sex,
                'religion' => $row_add->religion,
                'address' => $row_add->address,
                'phone' => $row_add->phone,
                'email' => $row_add->email,
                'class_id' => $row_add->class,
                'roll' => $row_add->roll,
                'father_name' => $row_add->father_name,
                'mother_name' => $row_add->mother_name,
            );
            $this->db->where("id", $row_add->id);
            $this->db->update(self::TABLE_NAME, $fields);
            if ($this->db->affected_rows() > 0 || $this->db->affected_rows()==0) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" =>$this->db->_error_number()." * ". $this->db->_error_message()));
            }

            //  echo $this->db->last_query();
            exit;
        }
        if ($action_post == "delete") {
            $this->db->where("id", $row->id);
            $this->db->delete(self::TABLE_NAME);
            if ($this->db->affected_rows() > 0) {
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
            'details' => SITE_LINK . "/" . "student/" . "details/",
            'main_url' => SITE_LINK . "/" . "student/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['js'][] = "usage/student.js";
        $data['main_url'] =  SITE_LINK . "/" . "student/";
        $data['use_big_model'] = "yes";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'student', $data);

    }

    function import() {

        //$inputFileName = '<?php echo SITE_LINK."/assets" ?>/simple.xlsx';
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
            //    echo "<br>The worksheet ".$worksheetTitle." has ";
            //    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';

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
                }
                $table[]=$one;

            }

            //  echo '</table>';
        }
//print_r($cols);
//print_r($vals);
        $this->db->insert_batch("student",$table);

        echo json_encode(array("rows"=>count($table)));
        exit;
    }

  public function export() {
      // Instantiate a new PHPExcel object
      $objPHPExcel = new PHPExcel();
// Set the active Excel worksheet to sheet 0
      $objPHPExcel->setActiveSheetIndex(0);
// Initialise the Excel row number
      $rowCount = 1;
      $query = "select * from student ";

// Execute the database query
      $result = mysql_query($query) or die(mysql_error());

//start of printing column names as names of MySQL fields
      $column = 'A';
      for ($i = 0; $i < mysql_num_fields($result); $i++)
      {
          $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, mysql_field_name($result,$i));
          $column++;
      }
//end of adding column names

//start while loop to get data
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


// Redirect output to a client’s web browser (Excel5)
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="simple.xls"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
    // echo "thanks .. ";
    }

}