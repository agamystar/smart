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




<div class="row">


    <div class="col-xs-12">

        <form class="form-horizontal" id="sample-form">
            <div class="form-group" >

                <div class="col-sm-12">
                    <div class="input-group">
                        <div id='content'>

                            <input class="date" type="text"/>
                        </div>
                    </div>
                </div>


            </div>
            <hr/>
            <br/>
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
         <img alt="'.$c_students->name.'"  id="'.$c_students->id.'" src="'.$img_link.'" ><span style="margin-left:10px">'.$c_students->name.'</span></div></li>';

                            }
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 align-right">
                    <button type="button" id="add" class="btn btn-primary"> Submit</button>
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