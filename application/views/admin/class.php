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
$selected_class=$p_class[0] ;?>



<div class="row">
    <div class="col-xs-12">
    <form class="form-horizontal" id="sample-form">
    <div class="form-group">
        <div class="col-sm-6">
            <div class="col-sm-6">
                <span class="label label-info arrowed-right arrowed-in"> Select  Class </span>
                <select id="select_class" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">
                    <?php
                    if(isset($classes[0])){
                        foreach($classes[0] as $class){
                            if($selected_class==$class->class_id){
                                echo "<option    value=\"$class->class_id\" selected> " .$class->name."</option>";
                            }else{
                                echo "<option   value=\"$class->class_id\"> ".$class->name."</option>";
                            }
                        }
                    } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label> Use Filter :
                    <input id="id-pills-stacked" name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox">
                    <span class="lbl"></span>
                </label>
            </div>


            <div class="nav-pills col-sm-12" style="display: none;">
                <span class="label label-info arrowed-right arrowed-in"> No.Students in this(Class) </span>
                <select id="student_number"  class="FormElement ui-widget-content ui-corner-all">
                    <option value="20">20</option>
                    <option value="20">25</option>
                    <option value="20">30</option>
                    <option value="20">35</option>
                    <option value="20">40</option>
                    <option value="20">45</option>
                    <option value="20">50</option>
                </select>

                <span class="label label-info arrowed-right arrowed-in"> Sort Student By  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <select id="student_sort" style="min-width: 120px;" class="FormElement ui-widget-content ui-corner-all">
                    <option value="1">Random</option>
                    <option value="2">Name</option>
                    <option value="3">Sex</option>

                </select>

            </div>

        </div>


        <div class="col-sm-6">



            <div class="col-sm-12">
                <a  href="#" id="export_class"  class=" label label-warning arrowed-right ">Export This Class </a>
                <a  href="#" id="import_class"  class=" label label-primary arrowed-left arrowed-in ">Import Students to This Class </a>
            </div>
        </div>


    <div class="col-md-12">

        <select style="display: none;" multiple="multiple" size="10" name="class_students" class="class_students">
            <?php
            if(isset($students[0])){
                foreach($students[0] as $students){
                    echo "<option value=\"$students->id\">".$students->name."</option>";
                }
            } ?>

            <?php
            if(isset($class_students[0])){
                foreach($class_students[0] as $c_students){
                    echo "<option value=\"$c_students->student_id\"  selected=\"selected\">".$c_students->student_name."</option>";
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

    <div class="modal-content" id="dialog_content">
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