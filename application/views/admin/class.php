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



<br/>

<?php
$selected_class=$p_class[0] ;?>
<div class="">
  <span class="label label-info arrowed-right arrowed-in"> Select  Class </span>
    <select id="select_class" class="FormElement ui-widget-content ui-corner-all">
        <?php
        if(isset($classes[0])){
        foreach($classes[0] as $class){
            if($selected_class==$class->class_id){
            echo "<option    value=\"$class->class_id\" selected> " .$class->name."</option>";
            }else{
                echo "<option   value=\"$class->class_id\"> ".$class->name."</option>";
            }
        }
    } ?>
    </select>

</div>


<div class="row">

    <div class="col-md-12">

        <div>
        <select style="display: none;" multiple="multiple" size="10" name="class_students" class="class_students">
            <?php
            if(isset($students[0])){
                foreach($students[0] as $students){
                    echo "<option value=\"$students->id\">".$students->name."</option>";
                }
            } ?>

            <?php
            if(isset($class_students[0])){
                foreach($class_students[0] as $c_students){
                    echo "<option value=\"$c_students->student_id\"  selected=\"selected\">".$c_students->student_name."</option>";
                }
            } ?>

        </select>
    </div>
        <br/>
        <div>

            <button type="submit" id="add_to_class" class="btn btn-primary"> Submit </button>
        </div>
        <script>
            var demo2 = $('.class_students').bootstrapDualListbox({
                nonSelectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Students That not have classes </span>',
                selectedListLabel:'<span class="label label-success arrowed-in arrowed-in-right">All Student in This Class</span> ',
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