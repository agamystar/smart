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
</style>

<?php //print_r($user_data)?>

<br/>


<div class="">
Select  Class
    <select id="select_class">
        <?php
        if(isset($classes[0])){
        foreach($classes[0] as $class){
            echo "<option value=\"$class->class_id\">".$class->name."</option>";
        }
    } ?>
    </select>

</div>


<div class="row">

    <div class="col-md-12">

        <select style="display: none;" multiple="multiple" size="10" name="duallistbox_demo2" class="demo2">
            <?php
            if(isset($students[0])){
                foreach($students[0] as $students){
                    echo "<option value=\"$students->id\">".$students->name."</option>";
                }
            } ?>

            <?php
            if(isset($class_students[0])){
                foreach($class_students[0] as $c_students){
                    echo "<option value=\"$c_students->id\"  selected=\"selected\">".$c_students->name."</option>";
                }
            } ?>

        </select>
        <script>
            var demo2 = $('.demo2').bootstrapDualListbox({
                nonSelectedListLabel:'Non-selected',
                selectedListLabel:'Selected',
                preserveSelectionOnMove:'moved',
                moveOnSelect:false
                //  nonSelectedFilter:'ion ([7-9]|[1][0-2])'
            });
        </script>
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