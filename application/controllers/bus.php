<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bus extends MY_Controller
{
    const TABLE_NAME = "users";
    private $user_frm_flag = "R";

    public function __construct() {
        parent::__construct();

        $this->load->library("excel");

    }
    public function index(){}
    public function all_buses($x=''){


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));


        $data = array();

        if(empty($x)){
            $this->db->select("*");
            $this->db->from("bus");
            $this->db->limit(1);
            $rr= $this->db->get();
             $r_bus= $rr->row();
            $bus=$r_bus->no;
        }else{

            $bus=$x;
        }

         $buses=$this->mymodel_model->select("bus","1=1");
        $students=$this->mymodel_model->select("users",'groups="student" and id not in (select student_id from bus_students) ');
       $bus_students=$this->mymodel_model->select("v_bus_students","bus_no='$bus' ");
      //  print_r($students);
     // print_r($bus_students);
        if($action_post=="distribute_students"){

             $no="";
            $message="";
            $big_st_ids=array();
            foreach($ajax_data->students_inbus as $st){
                $big_st_ids[]=array("bus_no"=>$ajax_data->bus,"student_id"=>$st);

            }
            $imp= implode(",",$ajax_data->students_inbus) ;

            $this->db->where("bus_no",$ajax_data->bus);
            $this->db->delete("bus_students");


            if(!empty($big_st_ids)){
            $this->db->insert_batch("bus_students",$big_st_ids);
            if($this->db->affected_rows()>0){
              $no =$this->db->affected_rows();
                    $message="success";
                }else{
                    $message="failed  ";
                }
        }
     //       echo $this->db->last_query();
            echo  json_encode(array("message"=>$message,"no"=>$no));
            exit;
        }


        $info=array(
        "bus_no"=>$this->input->post("bus_no"),
        "student_id"=>$this->input->post("student_id")
            );

        if($action_post=="register"){

            $this->db->insert("bus_students",$info);

            if($this->db->affected_rows()>0){
                $message="success";
            }else{
                $message="faileed";
            }

            echo json_encode(array("message"=>$message));
            exit;
        }
        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['buses'][] = $buses;
       $data['students'][] = $students;
        $data['p_bus'][] = $bus;
    $data['bus_students'][] = $bus_students;
        $data['js'][] = "usage/bus.js";
       $this->load->view('admin' . DIRECTORY_SEPARATOR . 'bus', $data);
    }
    public function export($x='') {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        $query = "select student_name as 'Name' from v_bus_students where no= $x ";
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
        header('Content-Disposition: attachment;filename="simple.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
    public function import($x) {

        //$inputFileName = './assets/simple.xlsx';
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
                    $one['no']=$x;
                }
                $table[]=$one;

            }


        }
        $this->db->insert_batch("bus_students",$table);

        echo $this->db->last_query();
        echo json_encode(array("rows"=>count($table)));
        exit;
    }
    public function bus_absence($x=''){


        $action_get = $this->input->get("action");
        $action_post = $this->input->post("action");
        $ajax_data = json_decode($this->input->post("data"));


        $data = array();

        if(empty($x)){
            $this->db->select("*");
            $this->db->from("bus");
            $this->db->limit(1);
            $rr= $this->db->get();
            $r_bus= $rr->row();
            $bus=$r_bus->no;
        }else{

            $bus=$x;
        }
        $today=date('Y/m/d');

        $buses=$this->mymodel_model->select("bus","1=1");
        $students=$this->mymodel_model->select("v_bus_absence","bus_no='$bus' and  day='$today'");// right - selected
        $bus_students=$this->mymodel_model->select("v_bus_students","bus_no='$bus' and student_id not in (select  student_id from v_bus_absence where  day='$today' ) ");//left
       //print_r($students);
       // print_r($bus_students);
        if($action_post=="distribute"){
            $no="";
            $message="";
            $big_st_ids=array();
            foreach($ajax_data->students_inbus as $st){
                $big_st_ids[]=array("day"=>$today,"student_id"=>$st);

            }


            $this->db->where("day",$today);
            $this->db->delete("bus_absence");


            if(!empty($big_st_ids)){
                $this->db->insert_batch("bus_absence",$big_st_ids);
                if($this->db->affected_rows()>0){
                    $no =$this->db->affected_rows();
                    $message="success";
                }else{
                    $message="failed  ";
                }
            }
            // echo $this->db->last_query();
            echo  json_encode(array("message"=>$message,"no"=>$no));
            exit;
        }


        $data["js_vars"] = json_encode(array(
            'current_link' => SITE_LINK . "/" . $this->uri->segments[1]. "/" . $this->uri->segments[2],
            'controller_link' => SITE_LINK . "/" . $this->uri->segments[1],
            'main_url' => SITE_LINK . "/" . "security/",

        ));
        $data['base_url'][] = SITE_LINK;
        $data['buses'][] = $buses;
        $data['students'][] = $students;
        $data['p_bus'][] = $bus;
        $data['bus_students'][] = $bus_students;
        $data['js'][] = "usage/bus_absence.js";
        $this->load->view('admin' . DIRECTORY_SEPARATOR . 'bus_absence', $data);
    }


}