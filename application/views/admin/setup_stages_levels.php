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

        <a href="javascript:void(0);" id="open_new_dialog" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add </a>

    <span class="widget-toolbar">

    </div>


    <table id="datagrid" toolbar="#tb"></table>

<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 20px 100px " /></div>

    <div class="">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" id="reset_form" role="form"  method="post" action="">
                <div class="row">
                    <div class="col-sm-12">


                        <div class="form-group">
                            <label class="align-left col-sm-3 control-label">Stage Name </label>

                            <div class="col-sm-9">
                                <input class="form-control" id="stage_name" type="text">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input class="form-control" id="kid_s" type="hidden">
                            <button type="button" id="submit_add_s" style="display: none;" class="btn btn-primary">Submit</button>
                            <button type="button" id="submit_edit_s" style="display: none;" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger " id="cancel_s">Cancel</button>
                            <button type="reset" class="btn btn-default " id="reset_btn_s">Reset</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>

</div>


<div id="second_model" class=" ">


    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin:20px 100px " /></div>

    <div id="tb_2">

        <a href="javascript:void(0);" id="open_new_dialog_2" class="easyui-linkbutton" plain="true"><img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/> Add </a>

    <span class="widget-toolbar">

    </div>

    <table id="datagrid_2"  toolbar="#tb_2"></table>

</div>

 <div id="level_dialog">
     <div class="">
         <!-- dialog body -->
         <div class="modal-body">

             <form class="form-horizontal" id="level_form" role="form"  method="post" action="">
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label class="align-left col-sm-3 control-label">Level id </label>

                             <div class="col-sm-9">
                                 <input class="form-control" placeholder="example(3)" id="level_id" type="text">
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="align-left col-sm-3 control-label">Level Name </label>

                             <div class="col-sm-9">
                                 <input class="form-control" id="level_name" type="text"  placeholder="example(level three )" >
                             </div>
                         </div>

                         <div class="modal-footer">
                             <input class="form-control" id="kid_l" type="hidden">
                             <button type="button" id="submit_add_l" style="display: none;" class="btn btn-primary">Submit</button>
                             <button type="button" id="submit_edit_l" style="display: none;" class="btn btn-primary">Submit</button>
                             <button type="button" class="btn btn-danger " id="cancel_l">Cancel</button>
                             <button type="reset" class="btn btn-default " id="reset_btn_l">Reset</button>

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