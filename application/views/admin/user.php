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
        <a href="#" id="open_new_dialog" class="easyui-linkbutton" plain="true">
            <img src="<?php echo SITE_LINK."/assets" ?>/img/add-icon.png" alt=""/>  <span id="add_text"></span> </a>
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
  <span class="label label-danger  arrowed-right arrowed-in"> Select  User Group </span>
        <select id="select_group">
         <!--  <option value="0">All Users</option>-->
            <option value="student" selected>Student</option>
            <option value="teacher">Teacher</option>
            <option value="parent">Parent</option>
            <option value="admin">Admin</option>
            <option value="not_defined">Not Defined</option>
        </select>
	</span>
    </div>


    <table id="datagrid" toolbar="#tb"></table>

<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 350px " /></div>

    <div class="modal-content">
        <!-- dialog body -->
        <div class="modal-body">

            <form class="form-horizontal" role="form">
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="name" class="align-left col-sm-4 control-label">Name</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">Email</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="email" type="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">Birthday</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="birthday" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">Address</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="address" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="align-left col-sm-4 control-label">Phone</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="phone" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">National Number</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="national_id" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">Religion</label>

                            <div class="col-sm-8">
                                <select id="religion" class="align-left col-sm-12">
                                    <option id="muslim">Muslim</option>
                                    <option id="christian">Christian</option>
                                </select>
                            </div>
                        </div>

                    <div class="form-group" id="div_bus_fees">
                        <label for="email" class="align-left col-sm-4 control-label">Bus fees </label>

                        <div class="col-sm-8">
                            <input class="form-control" id="bus_fees" type="text">
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">

                        <div class="form-group align-right">
                            <label for="email" class="align-left col-sm-2 control-label"> &nbsp;</label>

                            <div class="col-sm-10">
                               <img src="<?php echo SITE_LINK."/assets" ?>/avatars/avatar4.png" width="100" height="130" alt="user_img">
                                <input type="hidden" name="photo" id="photo" value="static">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-3 control-label">Username</label>

                            <div class="col-sm-9">
                                <input class="form-control"  id="username" type="text">
                            </div>
                        </div>

                        <div class="form-group" id="password_section">
                            <label for="email" class="align-left col-sm-3 control-label">Password</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="password" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-3 control-label">Blood Group</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="blood_group" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="align-left col-sm-3 control-label">Sex</label>

                            <div class="col-sm-9">
                                <select class="align-left col-sm-12" id="sex">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                    <div class="form-group" id="div_for_student">
                        <label class="align-left col-sm-3 control-label">Stage/Level</label>

                        <div class="col-sm-9" >
                            <select id="stage" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">
                                <?php
                                if(isset($stages)){
                                    foreach($stages as $one){

                                        echo "<option    value=\"$one->stage_id\" > " .$one->stage_name."</option>";

                                    }
                                } ?>
                            </select>
                            &nbsp;
                            /
                              &nbsp; <select id="level" style="min-width: 125px;" class="FormElement ui-widget-content ui-corner-all">

                        </select>
                        </div>
                    </div>

                        <input type="hidden" id="kid">
                    </div>
               </div>

                <div class="modal-footer">
                    <button type="button" id="submit_add" style="display: none;" class="btn btn-primary">Submit</button>
                    <button type="button" id="submit_edit" style="display: none;" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger " id="cancel">Cancel</button>
                    <button type="reset" class="btn btn-default " id="reset_btn">Reset</button>

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

<div id="reset_dialog" class=" ">

    <div class="modal-content" >
        <!-- dialog body -->
        <div id="" class="loading-indicator" style="display:none;"  >
            <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:100px;height:50px;margin: 0px 30%; " /></div>
        <div class="modal-body">


                <form class="form-horizontal" id="reset_form" role="form"  method="post" action="">
                    <div class="row">
                        <div class="col-sm-11">
                    <div class="form-group">
                        <label for="name" class="align-left col-sm-4 control-label">Username</label>

                        <div class="col-sm-8">
                            <input class="form-control" id="old_username" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="align-left col-sm-4 control-label">Password</label>

                        <div class="col-sm-8">
                            <input class="form-control" id="old_password" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="align-left col-sm-4 control-label">Re-Password</label>

                        <div class="col-sm-8">
                            <input class="form-control" id="re_password" type="text">
                        </div>
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