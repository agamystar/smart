<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login Page - Ace Admin</title>

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
    <h4 class="blue">&copy; </h4>
</div>

<div class="space-6"></div>

<div class="position-relative">
    <div id="login-box" class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="icon-coffee green"></i>
                    Please Enter Your Information

                </h4>

                <div class="space-6"></div>

                <form action="" method="post">
                    <fieldset>
                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" id="identity" name="identity" placeholder="Username" />
															<i class="icon-user"></i>
														</span>
                        </label>

                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
															<i class="icon-lock"></i>
														</span>
                        </label>

                        <div class="space"></div>

                        <div class="clearfix">
                            <label class="inline">
                                <input type="checkbox" id="remember_password" name="remember_password" class="ace" />
                                <span class="lbl"> Remember Me</span>
                            </label>

                            <button type="submit"  id="login"  name="login" class="width-35 pull-right btn btn-sm btn-primary">
                                <i class="icon-key"></i>
                                Login
                            </button>
                        </div>

                        <div class="space-4"></div>
                    </fieldset>
                </form>

                <div class="social-or-login center">
                    <span class="bigger-110">Or Login Using</span>
                </div>

                <div class="social-login center">
                    <a class="btn btn-primary">
                        <i class="icon-facebook"></i>
                    </a>

                    <a class="btn btn-info">
                        <i class="icon-twitter"></i>
                    </a>

                    <a class="btn btn-danger">
                        <i class="icon-google-plus"></i>
                    </a>
                </div>
            </div><!-- /widget-main -->

            <div class="toolbar clearfix">
                <div>
                    <a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
                        <i class="icon-arrow-left"></i>
                        I forgot my password
                    </a>
                </div>

                <div>
                    <a href="<?php echo SITE_LINK."/security/front_create_user" ?>"  class="user-signup-link">
                        I want to register
                        <i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div><!-- /widget-body -->
    </div><!-- /login-box -->

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
