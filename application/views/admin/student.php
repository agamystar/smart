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

        <a href="#" id="open_new_dialog" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>
        <a href="#" id="import" name="imports" class="easyui-linkbutton" plain="true">
            <img src="./assets/img/import.png" alt=""/>Import</a>
        <a href="#" id="export" name="exports" class="easyui-linkbutton" plain="true">
            <img src="./assets/img/export.png" alt=""/>Export</a>
    </div>


    <table id="datagrid" toolbar="#tb"></table>


</div>


<div id="import_dialog" class=" ">

    <div class="modal-content" id="dialog_content">
        <!-- dialog body -->
        <div id="loading-indicator" style="display:none;" > <img src="./assets/img/page-loader.gif" style="width:100px;height:50px;margin: 0px 30%; " /></div>
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

<!-- set up the modal to start hidden and fade in and out -->
<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="./assets/img/page-loader.gif" style="width:100px;height:50px;margin: 200px 450px " /></div>

    <div class="modal-content">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" role="form">
                <div class="row">
                    <div class="col-sm-5">

                        <div class="form-group">
                            <label for="name" class="text-left col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-left col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="email" type="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-left col-sm-2 control-label">Birthday</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="birthday" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-left col-sm-2 control-label">Address</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="address" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="text-left col-sm-2 control-label">Phone</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="phone" type="text">
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-7">

                        <div class="form-group">
                            <label for="email" class="text-left col-sm-4 control-label">Father Name</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="father_name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-left col-sm-4 control-label">Mother Name</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="mother_name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-left col-sm-4 control-label">Roll</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="roll" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-left col-sm-4 control-label">Class</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="class" type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="text-left col-sm-4 control-label">Religion</label>

                            <div class="col-sm-8">
                                <select id="religion" class="text-left col-sm-8">
                                    <option id="muslim">Muslim</option>
                                    <option id="christian">Christian</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="text-left col-sm-4 control-label">Sex</label>

                            <div class="col-sm-8">
                                <select class="text-left col-sm-8" id="sex">
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