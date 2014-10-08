<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>
<style type="text/css">
    .profile-info-row {
        height: 50px !important;
    }
</style>



<br/>

<?php

//print_r($absence);

$selected_class=$p_class[0] ;?>



<div class="row">

    <div class="col-xs-12">
        <div class="col-xs-2"></div>
        <div class="col-xs-4"><img src="<?php echo SITE_LINK."/assets/img/arrows.png"?>" style=" height: 80px"/></div>
        <div class="col-xs-4"></div>
    </div>
    <div class="col-xs-12">

    <form class="form-horizontal" id="sample-form">
    <div class="form-group">
        <div class="col-sm-6">
            <div class="col-sm-12">
                <span class="label label-info arrowed-right arrowed-in"> Select  Class </span>
                <input id="select_class"  required="true"  value="<?php // echo $selected_class?>" style="width:250px">


            </div>


        </div>


        <div class="col-sm-6">



            <div class="col-sm-12">
                <a  href="#" id="export_class"  class=" label label-warning arrowed-right ">Export Absence Sheet </a>
                <a  href="#" id="import_class"  class=" label label-primary arrowed-left arrowed-in ">Import Absence Sheet </a>
            </div>
        </div>


    <div class="col-md-12">

        <select style="display: none;" multiple="multiple" size="10" name="class_students" class="class_students">


            <?php

            if(isset($class_students[0])){
                foreach($class_students[0] as $c_students){
                    echo "<option value=\"$c_students->student_id\" >".$c_students->student_name."</option>";
                }
            } ?>

            <?php
          if(isset($absence[0])){
                foreach($absence[0] as $absence){
                    echo "<option value=\"$absence->user_id\"  selected=\"selected\">".$absence->name."</option>";
                }
            } ?>
        </select>
    </div>


    </div>

    <div class="form-group">

        <div class="col-sm-3"> <button type="button" id="add_to_class" class="btn btn-primary"> Submit </button></div>



    </div>



   </form>
        </div>


</div>


</div>
<div id="import_dialog" class=" ">

    <div class="" id="dialog_content">
        <!-- dialog body -->
        <div id="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:100px;height:50px;margin: 0px 30%; " /></div>
        <div class="modal-body">

            <div class="row">
                <form class="form-horizontal" id="import_form" role="form" enctype="multipart/form-data" method="post" action="">

                    <div class="col-sm-9">
                        <input class="form-control" name="file" id="file" type="file">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" id="submit_import" class="btn btn-primary"> Import</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'footer.php');
?>