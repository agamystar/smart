<?php

//echo SITE_LINK;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>jqGrid - Ace Admin</title>

    <link href="<?php echo SITE_LINK."/assets" ?>/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/font-awesome.min.css"/>

    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/font-awesome-ie7.min.css"/>


    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/jquery-ui-1.10.3.full.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/datepicker.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ui.jqgrid.css"/>

    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-fonts.css"/>

    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-ie.min.css"/>
    <?php
    if (isset($css)) {
        foreach ($css as $css_file) {
            if (file_exists("./assets" . DIRECTORY_SEPARATOR . "module" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . $css_file)) {
                ?>
                <link href="<?php //echo SITE_LINK?>/assets/module/css/<?php echo $css_file; ?>" rel="stylesheet"
                      type="text/css">

                <?php
            }
        }
    }?>

    <script src="<?php echo SITE_LINK."/assets" ?>/js/ace-extra.min.js"></script>

    <script src="<?php echo SITE_LINK."/assets" ?>/js/html5shiv.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/respond.min.js"></script>
   

    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>


    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>" + "<" + "/script>");
    </script>


    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>



    <script  type="text/javascript" src="<?php echo SITE_LINK."/assets" ?>/js/bootstrap.min.js"></script>
    <script  type="text/javascript" src="<?php echo SITE_LINK."/assets" ?>/model/assets/prettify/run_prettify.js"></script>

    <!-- page specific plugin scripts -->

    <script src="<?php echo SITE_LINK."/assets" ?>/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/jqGrid/jquery.jqGrid.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/jqGrid/i18n/grid.locale-en.js"></script>


    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/js"; ?>/jquery-1.10.2.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/ace-elements.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/ace.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo SITE_LINK . "/assets/module/css"; ?>/easyui.css">



    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/js"; ?>/jquery-1.10.2.min.js"></script>

    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>

    <?php

    if (isset($js_vars) || isset($js_lang)) {
        ?>
        <script type="text/javascript">


                <?php
                if (isset($js_vars)) {
                    if (!empty($js_vars)) {
                        ?>
                    var js_var_object = <?php echo $js_vars; ?>;
                    //alert(js_var_object.current_link);
                        <?php
                    }
                }
                if (isset($js_lang)) {
                    if (!empty($js_lang)) {
                        ?>
                    var js_lang_object = <?php echo $js_lang; ?>;
                        <?php
                    }
                }
                ?>
        </script>
        <?php
    }
    ?>

    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/toastr"; ?>/toastr.min.js"></script>
    <link href="<?php echo SITE_LINK . "/assets/toastr"; ?>/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_LINK . "/assets/toastr"; ?>/toastr.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/js"; ?>/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/js"; ?>/jquery-ui.js"></script>


    <?php
    if (isset($js)) {
        foreach ($js as $js_file) {
            if (file_exists("./assets" . DIRECTORY_SEPARATOR . "module" . DIRECTORY_SEPARATOR . $js_file)) {
                ?>
                <script type="text/javascript"
                        src="<?php echo SITE_LINK?>/assets/module/<?php echo $js_file; ?>"></script>
                <?php
            }
        }
    }

    ?>
    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/js"; ?>/filter.js"></script>



    <style type="text/css">


        .panel.datagrid {
            /*  width: 1050px !important;
       /* border: 0px solid #CCC !important;*/
        }

        .loading-indicator {
            position: absolute;
            z-index: 2000;
            vertical-align: middle;
            background-color: #000;
            height: 100%;
            width:100%;
            opacity: 0.4
        }



        .datagrid-view .datagrid-editable-input,.datagrid-toolbar{
            height: 35px !important;
        }
        .modal-header{
            background-color: #87B87F !important;
        }
        .l-btn-plain{
            margin-top: 5px !important;
        }
        <?php
        if($use_big_model=="yes"){
            echo 'div.modal-dialog{ width:950px !important;}';
        }
        ?>
        .datagrid-header,.datagrid-htable{height:35px !important;}
        .datagrid-header td ,.datagrid-htable td{border:0px}
        .datagrid-header-inner{
            background-color: #438EB9  !important;
        }

        .datagrid-header .datagrid-cell span {
            font-size: 16px !important;
            color: #FFF !important;
        }
        .datagrid-row {
            height: 35px !important;
        }
        .window .window-header{
            height: 50px !important;
        }
        .ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix.ui-draggable-handle{
            height: 50px !important;
        }
        .panel-title {padding: 10px !important;}
        .datagrid-wrap.panel-body.panel-body-noheader{
            width: auto !important;

        }
    </style>





</head>


<body class="">

<div class="navbar navbar-default" id="navbar">


<div class="navbar-container" id="navbar-container">
<div class="navbar-header pull-left">
    <a href="#" class="navbar-brand">
        <small>
            <i class="icon-leaf"></i>
            Ace Admin
        </small>
    </a><!-- /.brand -->
</div>
<!-- /.navbar-header -->

<div class="navbar-header pull-right" role="navigation">
<ul class="nav ace-nav">
<li class="grey">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-tasks"></i>
        <span class="badge badge-grey">4</span>
    </a>

    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
        <li class="dropdown-header">
            <i class="icon-ok"></i>
            4 Tasks to complete
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Software Update</span>
                    <span class="pull-right">65%</span>
                </div>

                <div class="progress progress-mini ">
                    <div style="width:65%" class="progress-bar "></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Hardware Upgrade</span>
                    <span class="pull-right">35%</span>
                </div>

                <div class="progress progress-mini ">
                    <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Unit Testing</span>
                    <span class="pull-right">15%</span>
                </div>

                <div class="progress progress-mini ">
                    <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
                    <span class="pull-left">Bug Fixes</span>
                    <span class="pull-right">90%</span>
                </div>

                <div class="progress progress-mini progress-striped active">
                    <div style="width:90%" class="progress-bar progress-bar-success"></div>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                See tasks with details
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>

<li class="purple">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-bell-alt icon-animated-bell"></i>
        <span class="badge badge-important">8</span>
    </a>

    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
        <li class="dropdown-header">
            <i class="icon-warning-sign"></i>
            8 Notifications
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												New Comments
											</span>
                    <span class="pull-right badge badge-info">+12</span>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="btn btn-xs btn-primary icon-user"></i>
                Bob just signed up as an editor ...
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												New Orders
											</span>
                    <span class="pull-right badge badge-success">+8</span>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												Followers
											</span>
                    <span class="pull-right badge badge-info">+11</span>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                See all notifications
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>

<li class="green">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-envelope icon-animated-vertical"></i>
        <span class="badge badge-success">5</span>
    </a>

    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
        <li class="dropdown-header">
            <i class="icon-envelope-alt"></i>
            5 Messages
        </li>

        <li>
            <a href="#">
                <img src="<?php echo SITE_LINK?>/assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												Ciao sociis natoque penatibus et auctor ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>a moment ago</span>
											</span>
										</span>
            </a>
        </li>

        <li>
            <a href="#">
                <img src="<?php echo SITE_LINK?>/assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Susan:</span>
												Vestibulum id ligula porta felis euismod ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>20 minutes ago</span>
											</span>
										</span>
            </a>
        </li>

        <li>
            <a href="#">
                <img src="<?php echo SITE_LINK?>/assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Bob:</span>
												Nullam quis risus eget urna mollis ornare ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>3:15 pm</span>
											</span>
										</span>
            </a>
        </li>

        <li>
            <a href="inbox.html">
                See all messages
                <i class="icon-arrow-right"></i>
            </a>
        </li>
    </ul>
</li>

<li class="light-blue">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img class="nav-user-photo" src="<?php echo SITE_LINK?>/assets/avatars/user.jpg" alt="Jason's Photo"/>
								<span class="user-info">
									<small>Welcome,</small>
									Jason
								</span>

        <i class="icon-caret-down"></i>
    </a>

    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
        <li>
            <a href="#">
                <i class="icon-cog"></i>
                Settings
            </a>
        </li>

        <li>
            <a href="#">
                <i class="icon-user"></i>
                Profile
            </a>
        </li>

        <li class="divider"></li>

        <li>
            <a href="<?php echo SITE_LINK."/security/logout"?>">
                <i class="icon-off"></i>
                Logout
            </a>
        </li>
    </ul>
</li>
</ul>
<!-- /.ace-nav -->
</div>
<!-- /.navbar-header -->
</div>
<!-- /.container -->
</div>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <?php require_once("sidebar.php");?>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                </ul>
                <!-- .breadcrumb -->

                <!-- #nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        Dashboard
                        <small>
                            <i class="icon-double-angle-right"></i>
                            overview &amp; stats
                        </small>
                    </h1>
                </div>
                <!-- /.page-header -->