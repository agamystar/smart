<?php //print_r($row[0]);?>


<div class="row" id="details"  style="background-color: #F1F1F1;" >
    <div class="col-sm-6" >
        <div class="form-group">
            <label for="" class="text-left col-sm-3 control-label"> Birth day </label>
            <label for="" class="text-left col-sm-6 control-label"> &nbsp; <?php echo $row[0]['birthday']?>  </label>
        </div>
        <div class="form-group">
            <label for="" class="text-left col-sm-3 control-label"> Father Name </label>
            <label for="" class="text-left col-sm-6 control-label"> &nbsp;<?php echo  $row[0]['father_name']?>   </label>
        </div>
        <div class="form-group">
            <label for="" class="text-left col-sm-3 control-label"> Class </label>
            <label for="" class="text-left col-sm-6 control-label"> &nbsp; <?php echo $row[0]['class_id']?>   </label>
        </div>
    </div>
    <div class="col-sm-5" >
        <div class="form-group">
            <label for="" class="text-left col-sm-3 control-label"> Mother Name </label>
            <label for="" class="text-left col-sm-6 control-label"> &nbsp; <?php echo $row[0]['mother_name']?>   </label>
        </div>
        <div class="form-group">
            <label for="" class="text-left col-sm-3 control-label"> Roll </label>
            <label for="" class="text-left col-sm-6 control-label"> &nbsp; <?php  echo $row[0]['roll']?>   </label>
        </div>
    </div>
</div>