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

//print_r($all_users_in);

$selected_class=$p_class[0] ;?>



<div class="row">
    <div class="col-xs-12">
    <form class="form-horizontal" id="sample-form">
    <div class="form-group">
        <div class="col-sm-6">





        </div>


        <div class="col-sm-6">



            <div class="col-sm-12">
                <a  href="#" id="export_class"  class=" label label-warning arrowed-right ">Export Absence Sheet </a>
                <a  href="#" id="import_class"  class=" label label-primary arrowed-left arrowed-in ">Import Absence Sheet  </a>
            </div>
        </div>


    <div class="col-md-12">

        <select style="display: none;" multiple="multiple" size="10" name="class_students" class="class_students">


            <?php
            if(isset($all_users_in[0])){
                foreach($all_users_in[0] as $users_in){
                    echo "<option value=\"$users_in->id\" >".$users_in->name."</option>";
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