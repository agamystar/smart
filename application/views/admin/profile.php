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
    .dropzone .dz-default.dz-message{
        background:url("") no-repeat !important;
        margin: 0px !important;
        position: relative;
        top:0px;
        left:0px;
        width: 428px;
        height: 200px;

    }
    .dropzone {
        content: 'Click to Change Image ';
         min-height: 250px !important;
    }
    .dropzone .dz-default.dz-message{
        display :none;
    }
</style>

<?php //print_r($user_data)?>

<br/>
<div id="user-profile-1" class="user-profile row">
<div class="col-xs-12 col-sm-3 center">
    <div>
        <form class="dropzone" action="<?php echo SITE_LINK."/user/upload" ?>"  id="my-awesome-dropzone"></form>
        <!--
        <form action="<?php echo SITE_LINK."/user/upload" ?>" id="my-dropzone" style="" class="dropzone"  >
            <span class="profile-picture">
													<img id="avatar"
                                                         class="editable img-responsive editable-click editable-empty"
                                                         alt="Alex's Avatar" src="<?php //echo SITE_LINK ?>/assets/avatars/profile-pic.jpg"></img>
												</span>
        </form>

-->
<!--

-->
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
            <a class="btn btn-link" href="#">
                <i class="icon-plus-sign bigger-120 green"></i>
                Add as a friend
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
    <div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> 1,411 </span>

													<br>
													<span class="line-height-1 smaller-90"> Views </span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> 32 </span>

													<br>
													<span class="line-height-1 smaller-90"> Followers </span>
												</span>

												<span class="btn btn-app btn-sm btn-pink no-hover">
													<span class="line-height-1 bigger-170"> 4 </span>

													<br>
													<span class="line-height-1 smaller-90"> Projects </span>
												</span>

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"> 23 </span>

													<br>
													<span class="line-height-1 smaller-90"> Reviews </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 7 </span>

													<br>
													<span class="line-height-1 smaller-90"> Albums </span>
												</span>

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> 55 </span>

													<br>
													<span class="line-height-1 smaller-90"> Contacts </span>
												</span>
    </div>

    <div class="space-12"></div>

    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name align-center"> Username</div>

            <div class="profile-info-value">
                <span class="editable editable-click" id="username"> <?php echo $user_data->username ?> </span>
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
                <span class="editable editable-click" id="national_id"> <?php echo $user_data->national_id ?> </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name align-center">Birthday</div>

            <div class="profile-info-value">
                <span class="editable editable-click" id="birthday"> <?php echo $user_data->birthday ?> </span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name align-center">Religion</div>

            <div class="profile-info-value">
                <span class="editable editable-click" id="religion"> <?php echo $user_data->religion ?> </span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name align-center">Sex</div>

            <div class="profile-info-value">
                <span class="editable editable-click" id="sex"> <?php echo $user_data->sex ?> </span>
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

        <a href="#" id="update_profile" style="display: none" class="btn btn-sm btn-primary">
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