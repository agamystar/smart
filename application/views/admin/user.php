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
            <img src="./assets/img/import.png" alt=""/>Change Password</a>
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
                            Change Password
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

            <form>
                <fieldset>
                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select class="form-control"  id="r_company" name="r_company" >
                                                                <option value="admin">Admin</option>
                                                                <option value="student">Student</option>
                                                                <option value="student">Teacher</option>
                                                                <option value="student">Parents</option>
                                                            </select>

														</span>
                    </label>

                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control"  id="r_name" name="r_name" placeholder="Email" />
															<i class="icon-envelope"></i>
														</span>
                    </label>

                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control"  id="r_email" name="r_email" placeholder="Email" />
															<i class="icon-envelope"></i>
														</span>
                    </label>


                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="r_identity" name="r_identity" class="form-control" placeholder="Username" />
															<i class="icon-user"></i>
														</span>
                    </label>


                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="r_ssn" name="r_ssn" class="form-control" placeholder="Username" />
															<i class="icon-user"></i>
														</span>
                    </label>

                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="r_password" class="form-control" placeholder="Password" />
															<i class="icon-lock"></i>
														</span>
                    </label>

                    <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="r_r_password"  class="form-control" placeholder="Repeat password" />
															<i class="icon-retweet"></i>
														</span>
                    </label>



                    <div class="space-24"></div>

                    <div class="clearfix">
                        <button type="button" id="submit_add" style="display: none;" class="btn btn-primary">Submit</button>
                        <button type="button" id="submit_edit" style="display: none;" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger " id="cancel">Cancel</button>
                    </div>
                </fieldset>
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