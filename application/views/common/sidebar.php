
<div class="sidebar" id="sidebar">
<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
</script>

<div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <button class="btn btn-success">
            <i class="icon-signal"></i>
        </button>

        <button class="btn btn-info">
            <i class="icon-pencil"></i>
        </button>

        <button class="btn btn-warning">
            <i class="icon-group"></i>
        </button>

        <button class="btn btn-danger">
            <i class="icon-cogs"></i>
        </button>
    </div>

    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>

        <span class="btn btn-info"></span>

        <span class="btn btn-warning"></span>

        <span class="btn btn-danger"></span>
    </div>
</div><!-- #sidebar-shortcuts -->

<ul class="nav nav-list">
<li class="active">
    <a href="<?php echo SITE_LINK."/"."dashboard" ;?>">
        <i class="icon-dashboard"></i>
        <span class="menu-text"> <?php echo translate("dashboard")?> </span>
    </a>
</li>

<li>
    <a href="<?php echo SITE_LINK."/"."settings" ;?>">
        <i class="icon-cog "></i>
        <span class="menu-text"> General Settings </span>

    </a>
</li>

<li>
    <a href="<?php echo SITE_LINK."/"."user/profile" ;?>">
        <i class="icon-cog "></i>
        <span class="menu-text"> Profile</span>

    </a>
</li>

<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-desktop"></i>
        <span class="menu-text"> Users </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."security" ;?>">
                <i class="icon-double-angle-right"></i>
                All Users
            </a>
        </li>


        <li>
            <a href="jquery-ui.html">
                <i class="icon-double-angle-right"></i>
                Import
            </a>
        </li>

        <li>
            <a href="nestable-list.html">
                <i class="icon-double-angle-right"></i>
                Export
            </a>
        </li>

    </ul>
</li>


<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-exchange "></i>
        <span class="menu-text"> Class </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."classes/all_classes" ;?>">
                <i class="icon-double-angle-right"></i>
                All Classes
            </a>
        </li>


        <li>
            <a href="nestable-list.html">
                <i class="icon-double-angle-right"></i>
                Export
            </a>
        </li>

    </ul>
</li>

<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-exchange "></i>
        <span class="menu-text"> Bus </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."bus"."/all_buses" ;?>">
                <i class="icon-double-angle-right"></i>
                All Buses
            </a>
        </li>


        <li>
            <a href="<?php echo SITE_LINK."/"."bus"."/bus_absence" ;?>">
                <i class="icon-double-angle-right"></i>
                Bus Absence
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="#" class="dropdown-toggle">
        <i class="icon-edit "></i>
        <span class="menu-text"> Absence  </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">



        <li>
            <a href="<?php echo SITE_LINK."/"."user"."/student_absence" ;?>">
                <i class="icon-double-angle-right"></i>
                Student
            </a>
        </li>

        <li>
            <a href="<?php echo SITE_LINK."/"."user"."/staff_absence" ;?>">
                <i class="icon-double-angle-right"></i>
                Staff
            </a>
        </li>




    </ul>
</li>
<li>
    <a href="<?php echo SITE_LINK."/"."sms" ;?>" class="dropdown-toggle">
        <i class="icon-envelope "></i>
        <span class="menu-text"> SMS </span>


    </a>
</li>
<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-cogs "></i>
        <span class="menu-text"> Setup </span>

        <b class="arrow icon-angle-down"></b>


    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."class" ;?>">
                <i class="icon-double-angle-right"></i>
              Classes
            </a>
        </li>
        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."class" ;?>">
                <i class="icon-double-angle-right"></i>
                Buses
            </a>
        </li>
        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."subject" ;?>">
                <i class="icon-double-angle-right"></i>
                Subjects
            </a>
        </li>


        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."book" ;?>">
                <i class="icon-double-angle-right"></i>
             Books
            </a>
        </li>



    </ul>
</li>

<li>
    <a href="<?php echo SITE_LINK."/"."exams" ;?>" class="dropdown-toggle">
        <i class="icon-credit-card "></i>
        <span class="menu-text"> Finical   </span>

        <b class="arrow icon-angle-down"></b>

    </a>

    <ul class="submenu">
        <li>
            <a href="elements.html">
                <i class="icon-double-angle-right"></i>
                Expenses of Student
            </a>
        </li>

        <li>
            <a href="elements.html">
                <i class="icon-double-angle-right"></i>
              Paid/Up paid of Student
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="<?php echo SITE_LINK."/"."exams" ;?>" class="dropdown-toggle">
        <i class="icon-credit-card "></i>
        <span class="menu-text"> Exams </span>

        <b class="arrow icon-angle-down"></b>

    </a>

    <ul class="submenu">
        <li>
            <a href="elements.html">
                <i class="icon-double-angle-right"></i>
                ........
            </a>
        </li>


    </ul>
</li>

<li>
    <a href=" " class="dropdown-toggle">
        <i class="icon-globe"></i>
        <span class="menu-text"> Translations </span>

        <b class="arrow icon-angle-down"></b>

    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."translation" ;?>">
                <i class="icon-double-angle-right"></i>
                Translations
            </a>
        </li>


    </ul>
</li>

<li>
    <a href=" <?php echo SITE_LINK."/"."translations" ;?>" class="dropdown-toggle">
        <i class="icon-globe"></i>
        <span class="menu-text"> Chatting </span>

        <b class="arrow icon-angle-down"></b>

    </a>

    <ul class="submenu">
        <li>
            <a href="elements.html">
                <i class="icon-double-angle-right"></i>
                ........
            </a>
        </li>


    </ul>
</li>

</ul><!-- /.nav-list -->

<div class="sidebar-collapse" id="sidebar-collapse">
   <!-- <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
-->
</div>

<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
</div>
