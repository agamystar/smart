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

        <a href="#" id="open_new_dialog" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add </a>
        <a href="#" id="import" name="imports" class="easyui-linkbutton" plain="true">
            <img src="<?php echo SITE_LINK."/assets" ?>/img/import-icon.png" alt="Import"/>
        <span id="import_text"></span>
        </a>
        <a href="#" id="export" name="exports" >
            <img src="<?php echo SITE_LINK."/assets" ?>/img/export-icon.png" alt="Export"/>
            <span id="export_text"></span></a>
    <span class="widget-toolbar">

    </div>


    <table id="datagrid" toolbar="#tb"></table>

<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 200px " /></div>

    <div class="modal-content">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" id="reset_form" role="form"  method="post" action="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="student_name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Value</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="value" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Discount</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="student_discount" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Date</label>

                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon">
																		<i class="icon-calendar bigger-110"></i>
																	</span>
                                </div>
                                
                                <input class="easyui-datebox "  id="paid_date" value="" type="text">
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

    <div class="modal-content" id="dialog_content">
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