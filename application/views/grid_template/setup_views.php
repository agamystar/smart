<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>

<?php $this->load->view("grid_template" . DIRECTORY_SEPARATOR . "setup_template");
?>

</div>
<div class="well body">
    <table class="table" style="" id="datagrid"></table>
</div>
</div>

<div id="my_dialog">
    <div id="mytool_bar" class="row-fluid"></div>
    <table id="grid"></table>
</div>

<br/>
<br/>
<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'footer.php');
?>