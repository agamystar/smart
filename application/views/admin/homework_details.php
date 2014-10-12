<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>

<?php // print_r($h_details) ?>

<div id="id-message-item-navbar" class="message-navbar align-center ">
    <div class="message-bar">
        <div class="message-toolbar">
            <div class="inline position-relative align-left">
                <a href="#">
                    <span class="bigger-110"><?php if(isset($h_details->h_header)){
                        echo $h_details->h_header;
                    }?></span>

                </a>

            </div>


        </div>
    </div>

    <div>
        <div class="messagebar-item-left">
            <a href="#" class="btn-back-message-list">
                <span class="label label-warning">	Mr 	</span>
<?php if(isset($h_details->teacher_id)){
               echo name_user($h_details->teacher_id)->name ;
            }?>
            </a>
        </div>

        <div class="messagebar-item-right">
            <i class="icon-time bigger-110 orange middle"></i>
            <span class="time grey"><?php if(isset($h_details->h_date)){
                echo $h_details->h_date ;
            }?></span>
        </div>
    </div>



</div>


<div style="padding: 50px">
    <?php if(isset($h_details->h_body)){
    echo $h_details->h_body;
}?>

</div>


<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'footer.php');
?>