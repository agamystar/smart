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

    <div class="col-xs-12 col-sm-12 widget-container-span ui-sortable" id="head_menu">
        <div class="widget-box" style="opacity: 1; z-index: 0;">
            <div class="widget-header header-color-blue">
                <h5 class="bigger lighter">
                    <i class="icon-table"></i>
                    Translations
                </h5>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse" id="open_new_dialog">
                        <img src="./assets/img/new.png" alt="New">
                    </a>

                    </a>
                </div>
            </div>
            <table id="datagrid"></table>


        </div>


    </div>


</div>


<div class="row" id="new_dialog" style="visibility: hidden"">

        <!-- PAGE CONTENT BEGINS -->

        <form class="form-horizontal" role="form">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-left"> Key</label>

                <div class="col-sm-9">
                    <input type="text" id="key" class="col-xs-12 col-sm-12">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-sm-3 control-label ">English </label>

                <div class="col-sm-9">
                    <input type="text" id="english"  class="col-xs-12 col-sm-12">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-sm-3 control-label ">Arabic</label>

                <div class="col-sm-9">
                    <input type="text" id="arabic"  class="col-xs-12 col-sm-12">
                </div>
            </div>

        </form>

</div>


<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'footer.php');
?>