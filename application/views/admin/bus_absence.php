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


$selected_bus=$p_bus[0] ;?>



<div class="row">
    <div class="col-xs-12">
    <form class="form-horizontal" id="sample-form">
    <div class="form-group">
        <div class="col-sm-6">
            <div class="col-sm-6">
                <span class="label label-info arrowed-right arrowed-in"> Select  Bus </span>
                <select id="select_bus" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">
                    <?php
                    if(isset($buses[0])){
                        foreach($buses[0] as $bus){
                            if($selected_bus==$bus->no){
                                echo "<option    value=\"$bus->no\" selected> " .$bus->no."</option>";
                            }else{
                                echo "<option   value=\"$bus->no\"> ".$bus->no."</option>";
                            }
                        }
                    } ?>
                </select>
            </div>
            <div class="col-sm-6">

            </div>




        </div>


        <div class="col-sm-6">



            <div class="col-sm-12">
                <a  href="#" id="export_class"  class=" label label-warning arrowed-right ">Export This Bus </a>
                <a  href="#" id="import_class"  class=" label label-primary arrowed-left arrowed-in ">Import Students to This Bus </a>
            </div>
        </div>


    <div class="col-md-12">

        <select style="display: none;" multiple="multiple" size="10" name="bus_students" class="bus_students">


            <?php
            if(isset($bus_students[0])){
                foreach($bus_students[0] as $c_students){
                    echo "<option value=\"$c_students->student_id\"  >".$c_students->name."</option>";
                }
            } ?>
            <?php
            if(isset($students[0])){
                foreach($students[0] as $students){
                    echo "<option value=\"$students->student_id\" selected=\"selected\">".$students->name."</option>";
                }
            } ?>
        </select>
    </div>


    </div>

    <div class="form-group">

        <div class="col-sm-3"> <button type="button" id="add_to_bus" class="btn btn-primary"> Submit </button></div>



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