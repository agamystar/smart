<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>
<style type="text/css">
    .profile-info-row {
        height: 50px !important;
    }

    .dropzone .dz-default.dz-message {
        background: url("") no-repeat !important;
        margin: 0px !important;
        position: relative;
        top: 0px;
        left: 0px;
        width: 428px;
        height: 200px;

    }

    .dropzone {
        content: 'Click to Change Image ';
        min-height: 250px !important;
    }

    .dropzone .dz-default.dz-message {
        display: none;
    }
</style>



<br/>
<div id="user-profile-1" class="user-profile row">
<div class="col-xs-12 col-sm-3 center">
    <div>
        <div class="loading-indicator" style="display:none;width:260px;height: 225px !important">
            <img src="<?php echo SITE_LINK . "/assets" ?>/img/page-loader.gif"
                 style="width:50px;height:50px;margin: 50px 50px ">
        </div>


        <img  id="my_photo" <?php if(strlen($user_data->photo)<5){ echo 'style="display: none;" '; }?>
              src="<?php echo SITE_LINK . "/assets/uploads/".$user_data->photo?>" style="width:200px;height:200px" alt="">

        <form action="" <?php  if(strlen($user_data->photo)>5){ echo 'style="display: none;" '; }?>
              method="post" enctype="multipart/form-data" id="upload_form">

            <input multiple="" type="file" name="file" id="id-input-file-3"/>

            <button style="display: none;" class="btn btn-primary" type="submit" id="submit_file">upload file</button>
        </form>


        <div class="space-4"></div>

        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
            <div class="inline position-relative">
                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-circle light-green middle"></i>
                    &nbsp;
                    <span class="white"><?php echo $user_data->name ?>   </span>
                </a>

                <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                    <li class="dropdown-header"> Change Status</li>

                    <li>
                        <a href="#">
                            <i class="icon-circle green"></i>
                            &nbsp;
                            <span class="green">Available</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="icon-circle red"></i>
                            &nbsp;
                            <span class="red">Busy</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="icon-circle grey"></i>
                            &nbsp;
                            <span class="grey">Invisible</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="space-6"></div>

    <div class="profile-contact-info">
        <div class="profile-contact-links align-left">
            <a class="btn btn-link" id="change_photo" href="#">

                Change Photo
            </a>

            <a class="btn btn-link" href="#">
                <i class="icon-envelope bigger-120 pink"></i>
                Send a message
            </a>

            <a class="btn btn-link" href="#">
                <i class="icon-globe bigger-125 blue"></i>
                www.alexdoe.com
            </a>
        </div>

        <div class="space-6"></div>

        <div class="profile-social-links center">
            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                <i class="middle icon-facebook-sign icon-2x blue"></i>
            </a>

            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                <i class="middle icon-twitter-sign icon-2x light-blue"></i>
            </a>

            <a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
                <i class="middle icon-pinterest-sign icon-2x red"></i>
            </a>
        </div>
    </div>

    <div class="hr hr12 dotted"></div>

    <div class="clearfix">
        <div class="grid2">
            <span class="bigger-175 blue">25</span>

            <br>
            Followers
        </div>

        <div class="grid2">
            <span class="bigger-175 blue">12</span>

            <br>
            Following
        </div>
    </div>

    <div class="hr hr16 dotted"></div>
</div>

<div class="col-xs-12 col-sm-9">
  <?php

    if($this->session->userdata("groups")=="student"){?>
    <div class="center">

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 small-90 ">  <?php  if(isset($student_data->class_name)){ echo $student_data->class_name ; } ?>  </span>

													<br>
													<span class="line-height-1 smaller-90 "> class  </span>
												</span>

												<span class="btn btn-app btn-sm btn-blue ">
													<span class="line-height-1 smaller-90 white "> <?php if(isset($student_data->level_name)){echo $student_data->level_name ; } ?>  </span>

													<br>
													<span class="line-height-1 smaller-90 "> Level </span>
												</span>

												<span class="btn btn-app btn-sm btn-pink ">
													<span class="line-height-1 smaller-90 "> <?php if(isset($student_data->stage_name)){ echo $student_data->stage_name ;}?>  </span>

													<br>
													<span class="line-height-1 smaller-90"> Stage </span>
												</span>

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 smaller-90"> <?php if(isset($student_bus->bus_no)){ echo $student_bus->bus_no ; } ?>  </span>

													<br>
													<span class="line-height-1 smaller-90"> Bus </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> <?php if(isset($user_absence)){ echo $user_absence ;} ?>   </span>

													<br>
													<span class="line-height-1 smaller-90"> Absence </span>
												</span>


    </div>
<?php }?>
    <div class="space-12"></div>

    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name align-center"> Username</div>

            <div class="profile-info-value">
                <span class=" editable-click" id="username"> <?php echo $user_data->username ?> </span>
            </div>
        </div>


        <div class="profile-info-row">
            <div class="profile-info-name align-center"> Email</div>

            <div class="profile-info-value">
                <span class="editable editable-click" id="email"> <?php echo $user_data->email ?> </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name align-center"> Phone</div>

            <div class="profile-info-value">
                <span class="editable editable-click" id="phone"> <?php echo $user_data->phone ?> </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name align-center"> National No</div>

            <div class="profile-info-value">
                <span class=" editable-click" id="national_id"> <?php echo $user_data->national_id ?> </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name align-center">Birthday</div>

            <div class="profile-info-value">
                <span class=" editable-click" id="birthday"> <?php echo $user_data->birthday ?> </span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name align-center">Religion</div>

            <div class="profile-info-value">
                <span class=" editable-click" id="religion"> <?php echo $user_data->religion ?> </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name align-center">Sex</div>

            <div class="profile-info-value">
                <span class=" editable-click" id="sex"> <?php echo $user_data->sex ?> </span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name align-center"> Address</div>

            <div class="profile-info-value">
                <i class="icon-map-marker light-orange bigger-110"></i>
          <span class="editable editable-click" id="address">
            <?php echo $user_data->address ?>
         </span>
            </div>
        </div>


        <div class="profile-info-row">
            <div class="profile-info-name align-center"> Last Online</div>

            <div class="profile-info-value">
                <span class=" editable-click" id="login"> <?php echo $user_data->last_login ?> </span>
            </div>
        </div>

    </div>

    <div class="space-20"></div>


    <div class="hr hr2 hr-double"></div>

    <div class="space-6"></div>

    <div class="center">
        <a href="#" id="edit_profile" class="btn btn-sm btn-primary">
            <i class="icon-rss bigger-150 middle"></i>
            <span class="bigger-110">Edit Profile </span>

            <i class="icon-on-right icon-arrow-right"></i>
        </a>

        <a href="javascript:void(0);" id="update_profile" style="display: none" class="btn btn-sm btn-primary">
            <i class="icon-rss bigger-150 middle"></i>
            <span class="bigger-110">Update Profile </span>

            <i class="icon-on-right icon-arrow-right"></i>
        </a>

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