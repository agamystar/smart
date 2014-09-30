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

$selected_class = $p_class[0];?>



<div class="row">


    <div class="col-xs-12">

        <form class="form-horizontal" id="sample-form">
            <div class="form-group" >
                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <span class="label label-info arrowed-right arrowed-in"> Select  Class </span>
                        <input id="select_class" required="true" value="<?php // echo $selected_class?>"
                               style="width:250px">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <a href="#" id="export_class" class=" label label-warning arrowed-right ">Export Absence
                            Sheet </a>
                        <a href="#" id="import_class" class=" label label-primary arrowed-left arrowed-in ">Import
                            Absence Sheet </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon">
																		<i class="icon-calendar bigger-110"></i>
																	</span>
                    </div>
                </div>
                </div>
                <hr/>
                <br/>
                <div class="form-group">
                    <div class="col-xs-12">
                        <ul>
                        <?php

                        if(isset($class_students[0])){
                            foreach($class_students[0] as $c_students){
                                $img_link="";
                                if($c_students->sex=="male"){
                                  $img_link= SITE_LINK . '/assets/avatars/avatar.png';
                            }
                                elseif($c_students->sex=="female"){
                                    $img_link= SITE_LINK . '/assets/avatars/avatar1.png';
                                }else{
                                    $img_link= SITE_LINK . '/assets/avatars/avatar2.png';
                                }
                                // echo "<option value=\"$absence->user_id\"  selected=\"selected\">".$absence->name."</option>";
                                echo ' <li style="height:60px;width:240px;display:inline-block;" class="itemdiv dialogdiv">
                                <div class="user" style="width:100% !important; cursor:pointer">
         <img alt="'.$c_students->student_name.'"  id="'.$c_students->student_id.'" src="'.$img_link.'" ><span style="margin-left:10px">'.$c_students->student_name.'</span></div></li>';

                            }
                        } ?>
                    </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 align-right">
                        <button type="button" id="add_to_class" class="btn btn-primary"> Submit</button>
                    </div>


                </div>


            </div>

            <div id="import_dialog" class=" ">

                <div class="modal-content" id="dialog_content">
                    <!-- dialog body -->
                    <div id="loading-indicator" style="display:none;"><img
                        src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
                        style="width:100px;height:50px;margin: 0px 30%; "/></div>
                    <div class="modal-body">

                        <div class="row">
                            <form class="form-horizontal" id="import_form" role="form" enctype="multipart/form-data"
                                  method="post" action="">

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