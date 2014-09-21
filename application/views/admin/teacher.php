<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>



<br/>
<div class="row" id="row">


    <div id="tb">

        <a href="#" id="open_new_dialog" class="easyui-linkbutton"  plain="true"> <img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt="Add"/> Add</a>
        <a href="#" id="import" name="imports" class="easyui-linkbutton" plain="true">
            <img src="<?php echo SITE_LINK."/assets" ?>/img/import-icon.png" alt="Import"/>Import</a>
            <a href="#" id="export" name="exports" >
            <img src="<?php echo SITE_LINK."/assets" ?>/img/export-icon.png" alt="Export"/>Export</a>
    </div>


    <table id="datagrid" toolbar="#tb"></table>


</div>


<div id="import_dialog" class=" ">

    <div class="modal-content" id="dialog_content">
        <!-- dialog body -->
        <div id="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:100px;height:50px;margin: 0px 30%; " /></div>
        <div class="modal-body">

            <div class="row">
                <form class="form-horizontal" id="import_form" role="form" enctype="multipart/form-data" method="post" action="<?php echo SITE_LINK."/teacher/"."import"?>">

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

<!-- set up the modal to start hidden and fade in and out -->
<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" >
        <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:100px;height:50px;margin: 200px 250px " /></div>

    <div class="modal-content">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" role="form">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="name" class="text-right col-sm-2 control-label align-left">Name</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-right col-sm-2 control-label align-left">Email</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="email" type="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-right col-sm-2 control-label align-left" >Birthday</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="birthday" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-right col-sm-2 control-label align-left">Address</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="address" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="text-right col-sm-2 control-label align-left">Phone</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="phone" type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="text-right col-sm-2 control-label align-left">Religion</label>

                            <div class="col-sm-10">
                                <select id="religion" class="text-left col-sm-8">
                                    <option id="muslim">Muslim</option>
                                    <option id="christian">Christian</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="text-right col-sm-2 control-label align-left">Sex</label>

                            <div class="col-sm-8">
                                <select class="text-left col-sm-10" id="sex">
                                    <option id="male">Male</option>
                                    <option id="female">Female</option>
                                </select>
                            </div>
                        </div>


                        <input type="hidden" id="kid">
                    </div>

            </form>
        </div>


    </div>

</div>

<div class="modal-footer">
    <button type="button" id="submit_add" style="display: none;" class="btn btn-primary">Submit</button>
    <button type="button" id="submit_edit" style="display: none;" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-danger " id="cancel">Cancel</button>

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