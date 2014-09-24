<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>



<br/>


    <div id="tb">

        <a href="#" id="open_new_dialog" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add </a>
        <a href="#" id="reset_password" class="easyui-linkbutton" plain="true">
        <img src="<?php echo SITE_LINK."/assets" ?>/img/reset-icon.png" alt=""/>  Reset  password</a>
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
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 350px " /></div>

    <div class="modal-content">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" id="reset_form" role="form"  method="post" action="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Bus NO</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="bus_no" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Driver</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="driver" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Supervisor</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="supervisor" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Path</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="path" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Student Fees</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="student_fees" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">School Fees</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="school_fees" type="text">
                            </div>
                        </div>
                        <div class="modal-footer">
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