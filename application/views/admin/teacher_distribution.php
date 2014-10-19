<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>


<div class="row" id="row">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 200px 30% " /></div>

    <div class="widget-box ">
        <div class="widget-header">
            <h4 class="lighter smaller">
                <i class="icon-comment blue"></i>
              Distribute Teacher on Classes .
            </h4>
            <div class="widget-toolbar">
                <a href="javascript:void(0);" id="submit_distribute"> Submit </a>
            </div>

            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">
                <div class="col-sm-12">
                <div class="col-sm-7">
                    <ul id="select_class" class="easyui-tree"  style="overflow: auto;overflow-x: hidden;height: 600px">
                </div>
                <div class="col-sm-5">
                    <div class="col-xs-12" style="overflow: auto;overflow-x: hidden; max-height: 600px">
                        <ul>

                            <?php

                            if(isset($set_users)){
                                foreach($set_users[0] as $c_students){
                                    $img_link="";
                                       echo '
                                       <label>
														<input name="teachers" class="ace" value="'.$c_students->id.'" type="radio" >
														<span class="lbl"> '.$c_students->name."&nbsp;&nbsp; (&nbsp;&nbsp;  ".$c_students->job ." &nbsp;&nbsp; )&nbsp;&nbsp;   ". '</span>
													</label><br/>';

                                    }
                            } ?>
                        </ul>
                    </div>
                </div>
                    </div>
            </div><!-- /widget-main -->
        </div><!-- /widget-body -->
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