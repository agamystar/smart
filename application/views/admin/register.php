<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="<?php echo SITE_LINK."/assets" ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/font-awesome.min.css" />

    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/font-awesome-ie7.min.css" />


    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-fonts.css" />

    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-rtl.min.css" />


    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-ie.min.css" />

    <script src="<?php echo SITE_LINK."/assets" ?>/js/html5shiv.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/respond.min.js"></script>


</head>

<body class="login-layout">
<div class="main-container">
<div class="main-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<div class="login-container">
<div class="center">
    <h1>
        <i class="icon-leaf green"></i>
        <span class="red">Ace</span>
        <span class="white">Application</span>
    </h1>
    <h4 class="blue">&copy; Company Name</h4>
</div>

<div class="space-6"></div>

<div class="position-relative">
    <div id="login-box" class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header green lighter bigger">
                    <i class="icon-group blue"></i>
                    New User Registration

                </h4>
                <h4>
                    <?php if(isset($message)){
                    echo '<span style="color: red ">'.$message.'</span>';
                }?>

                </h4>

                <div class="space-6"></div>

                <form action="<?php echo SITE_LINK."/security/front_create_user"?>" method="post">
                    <fieldset>
                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select  class="form-control"  class="FormElement ui-widget-content ui-corner-all" id="r_group" name="r_group" >
                                                                <option value="student">Student</option>
                                                                <option value="student">Teacher</option>
                                                                <option value="student">Parents</option>
                                                            </select>

														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  id="r_name" name="r_name" placeholder="Name" />
															<i class=""></i>
														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  id="r_national_id" name="r_national_id" placeholder="Notional Number" />
															<i class=""></i>
														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  id="r_email" name="r_email" placeholder="Email" />
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
															<input type="password" id="r_password" name="r_password" class="form-control" placeholder="Password" />
															<i class="icon-lock"></i>
														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="r_r_password" name="r_r_password" class="form-control" placeholder="Repeat password" />
															<i class="icon-retweet"></i>
														</span>
                        </label>



                        <div class="space-24"></div>

                        <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                <i class="icon-refresh"></i>
                                Reset
                            </button>

                            <button type="submit"  name="submit_create_user"  id="submit_create_user" class="width-65 pull-right btn btn-sm btn-success">
                                Register
                                <i class="icon-arrow-right icon-on-right"></i>
                            </button>

                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="toolbar clearfix">
                <div>
                    <a href="<?php echo SITE_LINK."/security/login" ?>" style="color: #FFF" class="back-to-login-link">
                        <i class="icon-arrow-left"></i>
                        Back to login
                    </a>
                </div>

            </div>
        </div><!-- /widget-body -->
    </div><!-- /signup-box -->
    <div id="forgot-box" class="forgot-box widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header red lighter bigger">
                    <i class="icon-key"></i>
                    Retrieve Password
                </h4>

                <div class="space-6"></div>
                <p>
                    Enter your email and to receive instructions
                </p>

                <form>
                    <fieldset>
                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
															<i class="icon-envelope"></i>
														</span>
                        </label>

                        <div class="clearfix">
                            <button type="button" id="register"  name="register" class="width-35 pull-right btn btn-sm btn-danger">
                                <i class="icon-lightbulb"></i>
                                Send Me!
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div><!-- /widget-main -->

            <div class="toolbar center">
                <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                    Back to login
                    <i class="icon-arrow-right"></i>
                </a>
            </div>
        </div><!-- /widget-body -->
    </div><!-- /forgot-box -->


</div><!-- /position-relative -->
</div>
</div><!-- /.col -->
</div><!-- /.row -->
</div>
</div><!-- /.main-container -->


<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script type="text/javascript">
    function show_box(id) {
        jQuery('.widget-box.visible').removeClass('visible');
        jQuery('#'+id).addClass('visible');
    }
</script>
</body>
</html>
