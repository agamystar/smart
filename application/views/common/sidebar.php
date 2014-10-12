
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


<?php

        $menus=get_parent_menu();
   foreach($menus as $one){ ?>

    <li >
        <a href="<?php echo SITE_LINK."/".$one->link ?>"
            <?php  if(get_children_menu($one->form_id)){?> class="dropdown-toggle"  <?php }?> >
            <i class="<?php echo $one->icon ?>"></i>
        <span class="menu-text"> <?php echo $one->name ?> </span>

            <?php if(get_children_menu($one->form_id)){?>
            <b class="arrow icon-angle-down"></b>
                <?php }?>
        </a>

        <ul class="submenu">
            <?php $submenu=get_children_menu($one->form_id);
       foreach($submenu as $two){

           ?>
            <li>
                <a href="<?php echo SITE_LINK."/".$two->link ?>">
                       <?php echo  $two->name ?>

                </a>
            </li>
            <?php }?>
         </ul>


    </li>

   <?php  }
?>

</ul><!-- /.nav-list -->


<div class="sidebar-collapse" id="sidebar-collapse">
   <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
</div>



<script type="text/javascript">
    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>
</div>
