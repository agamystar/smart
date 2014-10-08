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

//print_r($set_users[0]);
$selected_bus=$p_bus[0] ;?>



<div class="row">
    <div class="col-xs-12">
    <form class="form-horizontal" id="sample-form">

    <div class="form-group">

            <div class="col-sm-4">
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
            <div class="col-sm-4">
                <div class="input-group">
                    <div id='content'>

                        <input class="date" type="text"/>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">



            <div class="col-sm-12">
                <a  href="#" id="export_class"  class=" label label-warning arrowed-right ">Export This Bus </a>
                <a  href="#" id="import_class"  class=" label label-primary arrowed-left arrowed-in ">Import Students to This Bus </a>
            </div>
        </div>


    </div>

        <div class="form-group">
            <div class="form-group" id="the_work_area" style="max-height: 600px; overflow:auto;overflow-x:hidden;">
                <div class="col-xs-12">
                    <ul>
                        <?php


                        if(isset($set_users)){
                            foreach($set_users[0] as $c_students){
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
         <img alt="'.$c_students->name.'"  id="'.$c_students->student_id.'" src="'.$img_link.'" ><span style="margin-left:10px">'.$c_students->name.'</span></div></li>';

                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>


    <div class="form-group">

        <div class="col-sm-3"> <button type="button" id="add" class="btn btn-primary"> Submit </button></div>



    </div>
   </form>
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