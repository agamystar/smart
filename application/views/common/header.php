<?php
if (!$this->session->userdata("user_id")) {

    redirect(option("site_url")."/security/login","refresh");
    exit;
}?>

<?php
$your_messages=get_unread_messages();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Smart School </title>

    <link href="<?php echo SITE_LINK."/assets" ?>/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/jquery-ui-1.10.3.full.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-fonts.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/css/ace-ie.min.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/module/multi_select_list/bootstrap-duallistbox.css"/>
    <link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/module/jq_widgets/jqx.base.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_LINK . "/assets/module/css"; ?>/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_LINK . "/assets/module/css"; ?>/icons.css">



    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>

    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>
    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src='<?php echo SITE_LINK."/assets" ?>/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>


    <script src="<?php echo SITE_LINK."/assets" ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/typeahead-bs2.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/bootbox.min.js"></script>




    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/globalize.js"></script>
    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jqxcalendar.js"></script>
    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jqxdatetimeinput.js"></script>


    <script type="text/javascript" src="<?php echo SITE_LINK."/assets" ?>/easyui/jquery.easyui.min.js"></script>




    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/multi_select_list/jquery.bootstrap-duallistbox.js"; ?>"></script>


    <script type="text/javascript" src="<?php echo SITE_LINK . "/assets/toastr"; ?>/toastr.min.js"></script>
    <link href="<?php echo SITE_LINK . "/assets/toastr"; ?>/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_LINK . "/assets/toastr"; ?>/toastr.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo SITE_LINK."/assets" ?>/js/ace-elements.min.js"></script>
    <script src="<?php echo SITE_LINK."/assets" ?>/js/ace.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_LINK."/assets" ?>/module/js/filter.js"></script>

    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>


    <?php  if (isset($js_vars) || isset($js_lang)) {
    ?>
    <script type="text/javascript">

        var  js_site_url="<?php echo $base_url[0];?>";

            <?php
            if (isset($js_vars)) {
                if (!empty($js_vars)) {
                    ?>
                var js_var_object = <?php echo $js_vars; ?>;
                var js_site_link = "<?php echo SITE_LINK; ?>";
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

        $(function(){


        });
    </script>
    <?php
} ?>

    <?php  if (isset($js)) {
        foreach ($js as $js_file) {
            if (file_exists("./assets" . DIRECTORY_SEPARATOR . "module" . DIRECTORY_SEPARATOR . $js_file)) {
                ?>
                <script type="text/javascript"
                        src="<?php echo SITE_LINK?>/assets/module/<?php echo $js_file; ?>"></script>
                <?php
            }
        }
    } ?>








    <style type="text/css">



        .loading-indicator {
            position: absolute;
            z-index: 2000;
            vertical-align: middle;
            height: 98%;
            width:98%;
            background: none repeat scroll 0% 0% #CCC;
            opacity: 0.2;
            font-size: 1px;
            overflow: hidden;
        }
             .datagrid-htable{height:35px !important;}
            .datagrid-header td ,.datagrid-htable td{border:0px}
            .datagrid-header-inner{
                background-color: #87B87F !important;
            }

        .datagrid-view .datagrid-editable-input,.datagrid-toolbar,.datagrid-row,.datagrid-header-row{
            height: 35px !important;
        }

        .datagrid-header{
            height: 72px !important;
        }


       .datagrid-filter-row {
           width: 100%;
            background: linear-gradient(to bottom, #FFF 0px, rgba(219, 246, 185, 1) 100%) repeat-x scroll 0% 0% #F7F7F7 !important;
            width: 100% !important;
        }
        .datagrid-header .datagrid-cell span {
            font-size: 16px !important;
            color: #FFF !important;
        }
        .datagrid-row,.datagrid-htable {
            height: 35px !important;
        }


        .datagrid-pager, .datagrid-footer-inner {
            background: linear-gradient(to bottom, #FFF 0px, rgba(195, 222, 162, 1) 100%) repeat-x scroll 0% 0% #F7F7F7 !important;
        }

        .modal-header{
            background-color: #87B87F !important;
        }
        .l-btn-plain{
            margin-top: 5px !important;
        }


        .window .window-header{
            height: 40px !important;
        }

        .modal-body{
                padding: 8px 20px !important;
                padding-bottom: 1px !important;
            }

        .check_person{
           border:5px solid red !important;
       }

        .datagrid-header-over{
            background-color: #87B87F !important;
        }
        .bootstrap-duallistbox-container .info{
            font-size: 21px;
            text-decoration: underline;
        }
        .tree li {
            white-space: normal !important;
        }


        .menu-text{
        font-size: 14px  !important;
        padding-top: 8px !important;
            padding-left: 8px!important;

        }


        .form-horizontal , .panel-body, .panel-body-noborder ,.window-body{
            _overflow-x: hidden !important;
        }

        .tabs,.tabs-wrap,.tabs li{
            height: 45 !important;
        }
    </style>






</head>


<body class="">

<div class="navbar navbar-default navbar-fixe-top" id="navbar">


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


<!--get all home work of all teachers that in student's class   -->
<?php if($this->session->userdata("groups")=="student"){?>

    <?php

    $st_teachers = $this->mymodel_model->select("teacher_classes", 'class_id in (select class_id from class_students where student_id="'.$this->session->userdata("user_id").'" ) ');
    $st=array();
    foreach($st_teachers as $one){
        $st[]=$one->teacher_id;
    }

    $this->db->select("*");
    $this->db->from("homework");
    $this->db->where('teacher_id in ('.implode(",",$st).') and h_id
    in (select h_id from class_homeworks where class_id in (select class_id from class_students where student_id="'.$this->session->userdata("user_id").'" ) and h_id not in (select h_id from homework_read where user_id='.$this->session->userdata('user_id').' )) ');
    $res=$this->db->get();
    $result=$res->result();
    ?>


<li class="grey">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-tasks"></i>
        <span class="badge badge-grey" id="no_tasks"><?php echo count($result)?></span>
    </a>


    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">


        <li class="dropdown-header">
            <i class="icon-ok"></i>
              Homeworks
        </li>

  <?php foreach($result as $li){?>
        <li>
            <a href="<?php echo SITE_LINK."/teacher/homework_details/".$li->h_id ?>">
                <div class="clearfix">
                    <span class="pull-left"></span>
                    <span class="pull-right"><?php echo data_user($li->teacher_id)->name ?></span>
                </div>

                <div >
                  <i class="icon-edit "></i>  <?php echo $li->h_header ?>
                </div>
            </a>
        </li>

        <?php }?>
        <li>
            <a href="<?php echo SITE_LINK."/teacher/homework"?>">
                See tasks with details
                <i class="icon-arrow-right"></i>
            </a>
      </li>
      </ul>
</li>
<?php } ?>
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
        <span class="badge badge-success"> <?php echo sizeof($your_messages)?></span>
    </a>



    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">

        <li class="dropdown-header">
            <i class="icon-envelope-alt"></i>
           <?php echo sizeof($your_messages)?>Messages


        </li>

        <?php foreach($your_messages  as $one_m){?>
        <li style="width: 100%; display: block;">
            <a href="<?php echo SITE_LINK."/user/inbox/".$one_m->m_id ?>">
                <img src="<?php echo SITE_LINK."/assets/uploads/".data_user($one_m->m_from)->photo ?>" class="msg-photo" alt="Alex's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue"> <?php echo data_user($one_m->m_from)->name ?></span>
                                                <?php echo $one_m->m_header ?>
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span> <?php echo $one_m->m_date ?></span>
											</span>
										</span>
            </a>
        </li>
         <?php }?>
        <li class="dropdown-header">
            <a href="<?php echo SITE_LINK."/user/inbox";?>" >
                <i class="icon-envelope-alt"></i>
        See all Messages </a>


        </li>

    </ul>
</li>

<li class="light-blue">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <?php if($this->session->userdata("photo")>3 ){?>
        <img class="nav-user-photo" src="<?php echo SITE_LINK."/assets/uploads/".$this->session->userdata("photo")?>" alt="Jason's Photo"/>
            <?php }else{?>
        <img class="nav-user-photo" src="<?php echo SITE_LINK?>/assets/avatars/user.jpg" alt="Jason's Photo"/>
    <?php }?>
								<span class="user-info">
									<small>Welcome , </small>
									<?php echo $this->session->userdata("name") ;?>
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
            <a href="<?php echo SITE_LINK."/user/profile"?>">
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
                        <a href="#"><?php if(isset($first_title)){echo $first_title ;}?></a>
                    </li>
                    <li class="active"><?php if(isset($second_title)){echo $second_title ;}?></li>
                </ul>
                <!-- .breadcrumb -->

                <!-- #nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header">
                  <h1>
                      <?php if(isset($third_title)){echo $third_title ;}?>

                  </h1>
              </div>
