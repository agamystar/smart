<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>

<?php // print_r($myhomework) ?>

<br/>
<div class="row" id="row">

    <?php if($this->session->userdata("groups")=="teacher"&&$this->session->userdata("user_id")==$teacher_id){?>
    <div class="">
        <span class="label label-info arrowed-right arrowed-in"> Select  Classes </span>
        <input id="select_class" required="true" value="<?php // echo $selected_class?>" style="width:700px">



    </div>
    <?php } ?>
    <div class="widget-box ">
        <div class="widget-header">
            <h4 class="lighter smaller">
                <i class="icon-comment blue"></i>
                Home Work  ---  <?php if($this->session->userdata("groups")=="teacher" )
            {echo  " Mr  [" . name_user($teacher_id)->name . "   ][ ".name_user($teacher_id)->job."]" ;  } ?> <span style="" class="widget-toolbar" >Speak With Your Students ☺</span>
            </h4>


        </div>
    </div>



    <div class="widget-body">
        <div class="widget-main no-padding">
            <div  class="slimScrollDiv">
                <div class="dialogs"  style="position: relative; overflow: auto; width: auto; min-height: 300px;max-height: 400px; overflow-x: hidden;" >

                    <?php foreach ($myhomework as $one) { ?>
                    <div class="itemdiv dialogdiv">
                        <div class="user">

                            <img alt="Alexa's Avatar"
                                 src="<?php echo SITE_LINK . "/assets/uploads/" . $this->session->userdata("photo"); ?>">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="green"> View Details </span>
                            </div>

                            <div class="name">
                                <a href="#"><?php echo $one->h_header ?></a>
                            </div>
                            <div class="text"> <?php echo $one->h_body ?>   </div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php }?>

                </div>
                <div    style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 74px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 225.564px;"
                    class="slimScrollBar ui-draggable"></div>
                <div
                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"
                    class="slimScrollRail">

                    </div>

            <br/>
            <hr>


                <?php if($this->session->userdata("groups")=="teacher"&&$this->session->userdata("user_id")==$teacher_id){?>

            <form class="form-horizontal " id="reset_form" role="form" method="post" action="">

                    <div class="col-sm-12" id="the_homework" style="padding-left: 20px;padding-top: 10px; background-color: #eeeeee;">
                        <div class="form-group">
                            <input placeholder="Homework Header ..." class="col-sm-4"  style="height: 35px !important;"
                                   id="h_header" name="message" type="text">

                            </input>
                        </div>

                        <div class="form-group">
                            <input placeholder="Type your Homework  Body  ..."  style="height: 35px !important;"
                                   class="col-sm-11" id="h_body" name="message" type="text">


																	<button class="btn btn-sm btn-info no-radius" id="send_homework"
                                                                            type="button">
                                                                        <i class="icon-share-alt"></i>
                                                                        Send
                                                                    </button>



                            </input>


                        </div>
                    </div>

            </form>
                <?php }?>
        </div>
        <!-- /widget-main -->
    </div>
    <!-- /widget-body -->
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