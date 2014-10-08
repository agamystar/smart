<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>
<br/>

 <div class="widget-box ">
 <div class="widget-header">
     <h4 class="lighter smaller">
         <i class="icon-user blue"></i>
         Users
     </h4>
 </div>

 <div class="widget-body">
 <div class="widget-main no-padding">
<div id="tb">
    <a href="javascript:void(0);" id="open_new_dialog" class="easyui-linkbutton" plain="true">
        <img src="<?php echo SITE_LINK . "/assets" ?>/img/add-icon.png" alt=""/> <span id="add_text"></span> </a>
    <a href="javascript:void(0);" id="reset_password" class="easyui-linkbutton" plain="true">
        <img src="<?php echo SITE_LINK . "/assets" ?>/img/reset-icon.png" alt=""/> Reset Account</a>
    <a href="javascript:void(0);" id="import" name="imports" class="easyui-linkbutton" plain="true">
        <img src="<?php echo SITE_LINK . "/assets" ?>/img/import-icon.png" alt="Import"/>
        <span id="import_text"></span>
    </a>
    &nbsp;&nbsp;
    <a href="javascript:void(0);" id="export" name="exports" class="easyui-linkbutton" plain="true">
        <img src="<?php echo SITE_LINK . "/assets" ?>/img/export-icon.png" alt="Export"/>
        <span id="export_text"></span></a>
    &nbsp;&nbsp;
    <a href="javascript:void(0);" id="activation" class="easyui-linkbutton" plain="true">
          <span id="active_span" style="display: none;">
               <i class="icon-ok bigger-130 green"></i>
               <span id="activation_text">Active</span>
          </span>

           <span id="disactive_span">
               <i class="icon-remove bigger-130 red"></i>
               <span id="disactivation_text">Disactive</span>
          </span>
    </a>

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
    <div class="loading-indicator" style="display:none;"><img
        src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
        style="width:180px;height:180px;margin: 100px 350px "/></div>

    <div class="">
        <!-- dialog body -->
        <div class="modal-body">

            <div class="form-horizontal" role="form">
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="name" class="align-left col-sm-4 control-label ">Name</label>

                            <div class="col-sm-8">
                                <input class="form-control required" id="name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label ">Email</label>

                            <div class="col-sm-8">
                                <input class="form-control " id="email" type="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="align-left col-sm-4 control-label ">Birthday</label>

                            <div class="col-sm-8">
                                <input class="form-control date " id="birthday" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">Address</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="address" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="align-left col-sm-4 control-label ">Phone</label>

                            <div class="col-sm-8">
                                <input class="form-control required" id="phone" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-4 control-label">National Number</label>

                            <div class="col-sm-8">
                                <input class="form-control required" id="national_id" type="text">
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

                            <div class="col-sm-12">

                                <div class="" id="loading" style="display: none;  position: absolute;  z-index: 2000;background-color: #ccc ;opacity: 0.5 ;width:100%;height: 120px !important">
                                    <img src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
                                         style="width:50px;height:50px;margin:50px 50% ">
                                </div>
                                <div id="my_photo" class="col-sm-12">
                                    <a class="col-sm-9 btn btn-link" id="change_photo" href="#">

                                        Change Photo
                                    </a>
                                    <img src="" class="col-sm-3" style="width:100px;height:120px" alt="">


                                </div>

                                <form action="" class="col-sm-12" method="post" enctype="multipart/form-data" id="upload_form">

                                    <input multiple="" type="file" name="file" id="id-input-file-3"/>

                                    <button style="display: none;" class="btn btn-primary" type="submit"
                                            id="submit_file">upload file
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="align-left col-sm-3 control-label">Username</label>

                            <div class="col-sm-9">
                                <input class="form-control required" id="username" type="text">
                            </div>
                        </div>

                        <div class="form-group" id="password_section">
                            <label for="email" class="align-left col-sm-3 control-label">Password</label>

                            <div class="col-sm-9">
                                <input class="form-control" id="password" type="password">
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

                            <div class="col-sm-9">
                                <select id="stage" style="min-width: 125px;"
                                        class="FormElement ui-widget-content ui-corner-all">
                                    <?php
                                    if (isset($stages)) {
                                        foreach ($stages as $one) {

                                            echo "<option    value=\"$one->stage_id\" > " . $one->stage_name . "</option>";

                                        }
                                    } ?>
                                </select>
                                &nbsp;
                                /
                                &nbsp; <select id="level" style="min-width: 125px;"
                                               class="FormElement ui-widget-content ui-corner-all">

                            </select>
                            </div>
                        </div>

                        <div class="form-group" id="div_for_other" style="display: none;">
                            <label for="email" class="align-left col-sm-3 control-label"><span id="job_text">  </span></label>

                            <div class="col-sm-9">
                                <input class="form-control" id="job" type="text">
                            </div>
                        </div>
                        <input type="hidden" id="kid">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="submit_add" style="display: none;" class="btn btn-primary">Submit</button>
                    <button type="button" id="submit_edit" style="display: none;" class="btn btn-primary">Submit
                    </button>
                    <button type="button" class="btn btn-danger " id="cancel">Cancel</button>
                    <button type="reset" class="btn btn-default " id="reset_btn">Reset</button>

                </div>
            </div>
        </div>


    </div>

</div>

<div id="import_dialog" class=" ">

    <div class="" id="dialog_content">
        <!-- dialog body -->
        <div id="loading-indicator" style="display:none;"><img
            src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
            style="width:100px;height:50px;margin: 0px 30%; "/></div>
        <div class="modal-body">

            <div class="row">
                <form class="form-horizontal" id="import_form" role="form" enctype="multipart/form-data" method="post"
                      action="<?php echo $main_url . "import"?>">

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
    <div class="" id="loading_reset" style="display: none;  position: absolute;  z-index: 2000;background-color: #ccc ;opacity: 0.5 ;width:100%;height: 160px !important">
        <img src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
             style="width:50px;height:70px;margin:50px 50% ">
    </div>
    <div class="">
        <!-- dialog body -->
        <div id="" class="loading-indicator" style="display:none;">
            <img src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
                 style="width:100px;height:50px;margin: 0px 30%; "/></div>
        <div class="modal-body">


            <form class="form-horizontal" id="reset_form" role="form" method="post" action="">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="name" class="align-left col-sm-4 control-label">Password</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="res_password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="align-left col-sm-4 control-label">Re-Password</label>

                            <div class="col-sm-8">
                                <input class="form-control" id="con_res_password" type="password">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-10"></div>
                            <button type="button" id="submit_reset" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
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