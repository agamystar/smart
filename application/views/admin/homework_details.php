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
               echo data_user($h_details->teacher_id)->name ;
            }?>
            </a>
        </div>

        <div class="messagebar-item-right">
            <i class="icon-time bigger-110 orange middle"></i>
            <span class="time grey"><?php if(isset($h_details->h_date)){
                echo $h_details->h_date ;
            }?></span>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($this->session->userdata("groups") == "teacher"){?>
            <span><a href="#" id="send_homework_reply">
                <i class="icon-reply green icon-only bigger-130"></i>   Replay
            </a></span>

        <?php }?>
        </div>
    </div>



</div>


<div style="padding: 50px">
    <?php if(isset($h_details->h_body)){
    echo $h_details->h_body;
}?>

</div>


<div id="id-message-item-navbar" class="message-navbar align-center ">

<?php

 if(strlen($h_details->attachment)>3){
 echo '<span class="attachment"><i class="icon-paper-clip"></i></span>
 <a href="'.SITE_LINK."/assets/uploads/".$h_details->attachment.'">'.'Download Attachment File '.'</a>';
 }
     ?>

</div>

      <div class="form-horizontal " id="homework_reply_form" >
     <div class="form-group">
        <div class="col-sm-8">
            <textarea rows="7" id="m_body" style="width:100%" placeholder="Type Reply Here Not (required) " cols=""></textarea>
        </div>
        <div class="col-sm-4">
            <form action="#" class="col-sm-12" method="post" enctype="multipart/form-data"
                  id="upload_form">

                <input multiple="" type="file" name="file" id="id-input-file-3"/>

                <button style="display: none;" class="btn btn-primary" type="submit"
                        id="submit_file">upload file
                </button>
                <input type="hidden" id="m_header" value="<?php echo $h_details->h_header ; ?>">
                <input type="hidden" id="m_to" value="<?php echo $h_details->teacher_id ; ?>">
            </form>
        </div>
    </div>
          <div class="form-group">
              <div class="col-sm-6"></div>
              <div class="col-sm-6">

                  <button class="btn btn-sm btn-info no-radius " id="submit_send_homework"
                          type="button">
                      <i class="icon-share-alt"></i>
                      Send
                  </button>

              </div>

          </div>
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