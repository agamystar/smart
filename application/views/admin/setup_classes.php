<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>



<br/>
<?php //print_r($stages); ?>

    <div id="tb">

        <a href="javascript:void(0);" id="open_new_dialog" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add </a>

    <span class="widget-toolbar">

    </div>


    <table id="datagrid" toolbar="#tb"></table>

<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 200px " /></div>

    <div class="">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" id="reset_form" role="form"  method="post" action="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Name Numeric</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="name_numeric" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Stage</label>

                            <div class="col-sm-9">
                                <select id="stage" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">
                                    <?php
                                    if(isset($stages)){
                                        foreach($stages as $one){

                                                echo "<option    value=\"$one->stage_id\" > " .$one->stage_name."</option>";

                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">level</label>

                            <div class="col-sm-9">
                                <select id="level" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Teacher</label>

                            <div class="col-sm-9">
                                <select id="teacher_id" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">
                                    <?php
                                    if(isset($teachers)){
                                        foreach($teachers as $one){

                                            echo "<option    value=\"$one->id\" > " .$one->name."</option>";

                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input class="form-control" id="kid" type="hidden">
                            <button type="button" id="submit_add" style="display: none;" class="btn btn-primary">Submit</button>
                            <button type="button" id="submit_edit" style="display: none;" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger " id="cancel">Cancel</button>
                            <button type="reset" class="btn btn-default " id="reset_btn">Reset</button>

                        </div>
                    </div>
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
                <form class="form-horizontal" id="import_form" role="form" enctype="multipart/form-data" method="post" action="<?php echo $main_url . "import"?>">

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