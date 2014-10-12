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
  <form class="form-horizontal" id="reset_form" role="form"  method="post" action="">
      <div class="row">
          <div class="col-sm-12">


    <div class="form-group">
        <div class="col-sm-4" >
    <label class="align-left col-sm-3 control-label"> Stage </label>
    <div class="col-sm-9" >
        <select id="stage"  class=" col-sm-12 FormElement ui-widget-content ui-corner-all">
            <?php
            if(isset($stages)){
                foreach($stages as $one){

                    echo "<option    value=\"$one->stage_id\" > " .$one->stage_name."</option>";

                }
            } ?>

    </select>
    </div>
    </div>
        <div class="col-sm-4" >
            <label class="align-left col-sm-3 control-label"> Level </label>
            <div class="col-sm-9" >
                <select id="level" class="col-sm-12 FormElement ui-widget-content ui-corner-all">
            </select>
            </div>
        </div>
        <div class="col-sm-4" >
            <label class="align-left col-sm-3 control-label"> Expenses </label>
            <div class="col-sm-9" >
                <select id="expenses"  class="col-sm-12 FormElement ui-widget-content ui-corner-all">

                </select>
            </div>
        </div>

   </div>


              <div class="form-group">
                  <div class="col-sm-4" >
                      <label class="align-right col-sm-3 control-label"> Installments </label>
                      <div class="col-sm-9 align-right" >
                          <select id="installments"class="col-sm-12 FormElement ui-widget-content ui-corner-all">
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-3" > <b class="label label-success arrowed-in arrowed-in-right">  Expenses  Value  : &nbsp;&nbsp; <span id="expenses_value"></span>    LE </b></div>
                  <div class="col-sm-3" > <b class="label label-success arrowed-in arrowed-in-right">  Installment Value  : &nbsp;&nbsp; <span id="installment_value"> </span>   LE</b></div>

                  <div class="col-sm-2 align-right" ><button class="btn btn-primary" type="button" id="filter"><i class="icon-beaker align-top bigger-125"></i> Filter </button> </div>
              </div>



          </div>
<hr>

<br/>
          <div class="col-sm-12" id="grid_container" style="visibility: hidden; " >
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


</div>


      </div>
  </form>


<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 50px 150px " /></div>

    <div class="">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" id="" role="form"  method="post" action="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input class="easyui-combogrid form-control col-sm-12" id="student_name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Amount</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="amount" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Discount</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="expenses_discount" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="align-left col-sm-2 control-label">Date</label>

                            <div class="col-sm-10">

                                <input id="paid_date" class="date"   value="" type="text">
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