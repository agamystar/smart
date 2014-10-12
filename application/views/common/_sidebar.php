
<div class="sidebar sidebar-fixe" id="sidebar">
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
    <a href="<?php echo SITE_LINK."/"."dashboard" ;?>" code="1" >
        <i class="icon-dashboard"></i>
        <span class="menu-text"> <?php echo translate("dashboard")?> </span>
    </a>
</li>

<li>
    <a href="<?php echo SITE_LINK."/"."settings" ;?>" code="2">
        <i class="icon-cog "></i>
        <span class="menu-text"> General Settings </span>

    </a>
</li>

<li>

    <a href="<?php echo SITE_LINK."/"."user/profile" ;?>"  class="dropdown-toggle" code="4">
        <i class="icon-user-md "></i>
        <span class="menu-text"> Profile</span>

    </a>
</li>
<li>
    <a href="" class="dropdown-toggle" code="3">
        <i class="icon-user"></i>
        <span class="menu-text"> Users </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."security" ;?>">

                All Users
            </a>
        </li>

        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."user_groups" ;?>">

                User Group
            </a>
        </li>


    </ul>
</li>
<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-archive "></i>
        <span class="menu-text"> Class </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."classes/all_classes" ;?>" code="8">

                All Classes
            </a>
        </li>


    </ul>
</li>
<li>
    <a href="#" class="dropdown-toggle" >
        <i class="icon-truck "></i>
        <span class="menu-text"> Bus </span>
        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."bus"."/all_buses" ;?>" code="5">

                All Buses
            </a>
        </li>


        <li>
            <a href="<?php echo SITE_LINK."/"."bus"."/bus_absence" ;?>" code="6">

                Bus Absence
            </a>
        </li>

        <li>
            <a href="<?php echo SITE_LINK."/"."bus"."/bus_registration" ;?>" code="7">

                Bus Registration
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="#" class="dropdown-toggle">
        <i class="icon-bar-chart "></i>
        <span class="menu-text"> Absence  </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">



        <li>
            <a href="<?php echo SITE_LINK."/"."user"."/student_absence" ;?>" code="9">

                Student
            </a>
        </li>

        <li>
            <a href="<?php echo SITE_LINK."/"."user"."/staff_absence" ;?>" code="16">

                Staff
            </a>
        </li>




    </ul>
</li>
<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-money "></i>
        <span class="menu-text"> Finical   </span>

        <b class="arrow icon-angle-down"></b>

    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."finance/expenses" ;?>" code="10">

                 Expenses
            </a>
        </li>

    </ul>
</li>

<li>
    <a href="#" class="dropdown-toggle">
        <i class="icon-calendar "></i>
        <span class="menu-text"> Time Line  </span>

        <b class="arrow icon-angle-down"></b>
    </a>

    <ul class="submenu">



        <li>
            <a href="#">

                Time Table
            </a>
        </li>

        <li>
            <a href="#">

                Exams Table
            </a>
        </li>

        <li>
            <a href="#">

                Events
            </a>
        </li>


    </ul>
</li>


<li>
    <a href="" class="dropdown-toggle">
        <i class="icon-book "></i>
        <span class="menu-text"> Teacher </span>

        <b class="arrow icon-angle-down"></b>

    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."teacher/distribute_teachers" ;?>" code="17">

                Distribute Teachers on Classes

            </a>
        </li>

        <li>
            <a href="<?php echo SITE_LINK."/"."teacher/homework" ;?>" code="12" >

                Home Work
            </a>
        </li>

    </ul>
</li>
<li>
    <a href="<?php echo SITE_LINK."/user/"."inbox" ;?>" class="dropdown-toggle" code="11">
        <i class="icon-envelope "></i>
        <span class="menu-text"> Inbox </span>


    </a>
</li>
<li>
    <a href="<?php echo SITE_LINK."/"."sms" ;?>" class="dropdown-toggle" code="13">
        <i class="icon-mail-forward "></i>
        <span class="menu-text"> SMS </span>


    </a>
</li>
<li>
    <a href="" class="dropdown-toggle" code="14">
        <i class="icon-cogs "></i>
        <span class="menu-text"> Setup </span>

        <b class="arrow icon-angle-down"></b>


    </a>

    <ul class="submenu">
        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."classes" ;?>">

                Classes
            </a>
        </li>
        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."buses" ;?>">

                Buses
            </a>
        </li>



        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."stages_levels" ;?>">

                Stages&Levels
            </a>
        </li>


        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."expenses" ;?>">

                Expenses
            </a>
        </li>


        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."subject" ;?>">

                Subjects
            </a>
        </li>

        <li>
            <a href="<?php echo SITE_LINK."/"."setup"."/"."book" ;?>">

                Books
            </a>
        </li>



    </ul>
</li>
<li>
    <a href=" <?php echo SITE_LINK."/"."translations" ;?>" class="dropdown-toggle" code="15">
        <i class="icon-tasks"></i>
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



</ul><!-- /.nav-list -->


<div class="sidebar-collapse" id="sidebar-collapse">
   <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
</div>



<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
</div>
