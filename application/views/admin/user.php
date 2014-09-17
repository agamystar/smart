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
<span class="col-sm-5">

    <div id="tb">

        <a href="#" id="open_new_dialog" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>
        <a href="#" id="import" name="imports" class="easyui-linkbutton" plain="true">
            <img src="./assets/img/import.png" alt=""/>Reset  Password</a>
        <a href="#" id="export" name="exports" class="easyui-linkbutton" plain="true">
            <img src="./assets/img/export.png" alt=""/>Export</a>
    </div>


    <table id="datagrid" toolbar="#tb"></table>


</div>


<div id="change_dialog" class=" ">

    <div class="modal-content" id="dialog_content">
        <!-- dialog body -->
        <div id="loading-indicator" style="display:none;" > <img src="./assets/img/page-loader.gif" style="width:100px;height:50px;margin: 0px 30%; " /></div>
        <div class="modal-body">

            <div class="row">
                <form class="form-horizontal" id="change_form" role="form" enctype="multipart/form-data" method="post" action="<?php echo $main_url . "change"?>">
                    <fieldset>
                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="username"  class="form-control" placeholder="Username" />
															<i class="icon-user"></i>
														</span>
                    </label>

                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="password"  class="form-control" placeholder="Password" />
															<i class="icon-lock"></i>
														</span>
                    </label>

                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="con_password"  class="form-control" placeholder="Repeat password" />
															<i class="icon-retweet"></i>
														</span>
                    </label>



                    <div class="space-24"></div>

                    <div class="clearfix">


                        <button type="button" class="width-35 pull-right btn btn-sm btn-success">
                            Reset Password
                            <i class="icon-arrow-right icon-on-right"></i>
                        </button>
                    </div>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- set up the modal to start hidden and fade in and out -->
<div id="mymodal" class=" ">
    <div class="loading-indicator" style="display:none;" > <img src="./assets/img/page-loader.gif" style="width:100px;height:50px;margin: 150px 200px " /></div>

    <div class="modal-content">
        <!-- dialog body -->
        <div class="modal-body">
<div class="row">
    <div class="col-sm-12">
            <form class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-3"> Account  </div>
														<div class="col-sm-9 ">
															<select class="form-control"  id="r_company" name="r_company" >
                                                                <option value="admin">Admin</option>
                                                                <option value="student">Student</option>
                                                                <option value="student">Teacher</option>
                                                                <option value="student">Parents</option>
                                                            </select>

														</div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-3"> Name </div>
														<div class="col-sm-9  ">
															<input type="email" class="form-control"  id="r_name" name="r_name" />

														</div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-3"> Email </div>
                        <div class="col-sm-9  ">
                            <input type="email" class="form-control"  id="r_email" name="r_email" />

                        </div>

                    </div>


                    <div class="form-group">
                        <div class="col-sm-3"> Username </div>
														<div class="col-sm-9   ">
															<input type="text" id="r_identity" name="r_identity" class="form-control"  />

														</div>
                    </div>



                    <div class="form-group" id="password_section">
                        <div class="col-sm-3"> Password </div>
														<div class="col-sm-9  ">
															<input type="password" id="r_password" class="form-control" />

														</div>
                    </div>
                    <div class="form-group" id="r_password_section" >
                        <div class="col-sm-3"> Re-Password </div>
														<div class="col-sm-9  ">
															<input type="password" id="r_r_password"  class="form-control"  />

														</div>
                        <input type="hidden" id="user_id"/>
                    </div>

                    <div class="clearfix align-right">
                        <button type="button" id="submit_add" style="display: none;" class="btn btn-primary">Submit</button>
                        <button type="button" id="submit_edit" style="display: none;" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default " id="cancel">Cancel</button>
                        <button type="reset"  class="btn btn-danger " id="reset" value="Reset">Reset</button>
                    </div>
                </fieldset>
            </form>
        </div>
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