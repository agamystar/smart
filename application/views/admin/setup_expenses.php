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

        <a href="javascript:void(0);" id="open_new_dialog" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add Expenses </a>

    </div>


    <table id="datagrid" toolbar="#tb"></table>


<div id="dg2_container">
    <div id="tb_2">

        <a href="javascript:void(0);" id="open_new_dialog_2" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add Installments </a>

    </div>

    <table id="datagrid_2" toolbar="#tb_2"></table>
</div>

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
                            <label class="align-left col-sm-3 control-label">Stage</label>

                            <div class="col-sm-9">
                                <select class="form-control" id="stage" type="text"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Level</label>

                            <div class="col-sm-9">
                                <select class="form-control" id="level" type="text"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Value </label>

                            <div class="col-sm-9">
                                <input class="form-control" id="value" type="text">
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

<div id="mymodal_2" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 200px " /></div>

    <div class="">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" id="reset_form_2" role="form"  method="post" action="">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Name</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="name_2" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Value</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="value_2" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">End Date</label>

                            <div class="col-sm-9">
                                <input class="form-control date" id="end_date_2" type="text">
                            </div>
                        </div>



                        <div class="modal-footer">
                            <input class="form-control" id="kid_2" type="hidden">
                            <button type="button" id="submit_add_2" style="display: none;" class="btn btn-primary">Submit</button>
                            <button type="button" id="submit_edit_2" style="display: none;" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger " id="cancel_2">Cancel</button>
                            <button type="reset" class="btn btn-default " id="reset_btn_2">Reset</button>

                        </div>
                    </div>
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