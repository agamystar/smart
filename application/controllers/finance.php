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

    public function index()
    {
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'installments');
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