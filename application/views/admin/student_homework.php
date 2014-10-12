<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>

<?php  //print($filter) ?>

<br/>
<div class="row" id="row">

    <div class="">
        <span class="label label-info arrowed-right arrowed-in"> Select  Teacher </span>
        <select id="select_teacher" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all ">
            <?php
            if(isset($teachers)){
                foreach($teachers as $one){

                    if($one->teacher_id==$filter){
                        echo "<option   selected  value=\"$one->teacher_id\" > " . name_user($one->teacher_id)->name."</option>";
                    }else{
                    echo "<option    value=\"$one->teacher_id\" > " .name_user($one->teacher_id)->name."</option>";
                    }
                }
            } ?>
        </select>

    </div>

    <div class="widget-box ">
        <div class="widget-header">
            <h4 class="lighter smaller">
                <i class="icon-comment blue"></i>
                Home Work
            </h4>


        </div>
    </div>



    <div class="widget-body">
        <div class="widget-main no-padding">
            <div  class="slimScrollDiv">
                <div class="dialogs"  style="position: relative; overflow: auto; width: auto; min-height: 300px;max-height: 400px; overflow-x: hidden;" >

                    <?php foreach ($myhomework as $one) { ?>
                    <div class="itemdiv dialogdiv">
                        <div class="user">

                            <img alt="Alexa's Avatar"
                                 src="<?php echo SITE_LINK . "/assets/uploads/" . name_user($one->teacher_id)->photo ?>">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="green"> <?php echo $one->h_date ?></span>
                            </div>

                            <div class="name">
                                <a href="#"><?php echo $one->h_header ?></a>
                            </div>
                            <div class="text"> <?php echo $one->h_body ?>   </div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php }?>

                </div>
                <div    style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 74px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 225.564px;"
                    class="slimScrollBar ui-draggable"></div>
                <div
                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"
                    class="slimScrollRail">

                    </div>

            <br/>
            <hr>


        </div>
        <!-- /widget-main -->
    </div>
    <!-- /widget-body -->
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