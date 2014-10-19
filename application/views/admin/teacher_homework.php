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


    <div class="widget-box ">
        <div class="widget-header">


            <h4 class="lighter smaller">
                <i class="icon-comment blue"></i>
                Home Work ---  <?php if ($this->session->userdata("groups") == "teacher") {
                echo  " Mr  [" . data_user($teacher_id)->name . "   ][ " . data_user($teacher_id)->job . "]";
            } ?>


                <span style="" class="widget-toolbar">  <?php if ($this->session->userdata("groups") == "teacher" && $this->session->userdata("user_id") == $teacher_id) { ?>
                    <span><a href="javascript:void(0);" id="add_homework">
                        <i class="icon-book  green icon-only bigger-130"></i>   Add Homework
                    </a></span>
                    <?php }?>  </span>


            </h4>



        </div>
    </div>


    <div class="widget-body">
        <div class="widget-main no-padding">
            <div class="slimScrollDiv">
                <div class="dialogs"
                     style="position: relative; overflow: auto; width: auto; min-height: 300px;max-height: 400px; overflow-x: hidden;">

                    <?php foreach ($myhomework as $one) { ?>
                    <div class="itemdiv dialogdiv">
                        <div class="user">

                            <img alt=" <?php echo data_user($one->teacher_id)->name ?> "
                                 src="<?php echo SITE_LINK . "/assets/uploads/" . $this->session->userdata("photo"); ?>">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="green"><?php echo $one->h_date ?></span>
                                <?php if(strlen($one->attachment)>3){ ?>
                                <span class="attachment"><i class="icon-paper-clip"></i></span> <?php } ?>


                            </div>

                            <div class="name">
                                <a href="<?php echo SITE_LINK . "/teacher/homework_details/" . $one->h_id; ?>"><?php echo $one->h_header ?></a>
                            </div>
                            <div class="text"> <?php echo $one->h_body ?>   </div>

                            <div class="tools">
                                <a href="<?php echo SITE_LINK . "/teacher/homework_details/" . $one->h_id; ?>" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php }?>

                </div>
                <div
                    style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 74px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 225.564px;"
                    class="slimScrollBar ui-draggable"></div>
                <div
                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"
                    class="slimScrollRail">

                </div>

                <br/>

                <div class="form-horizontal " id="homework_form" >
                    <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 200px " /></div>

                    <div class="col-sm-12" id="the_homework">
                         <br/>

                        <div class="form-group">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <span class="col-sm-3 "> Select  Classes </span>
                                        <input id="select_class" required="true"  style="width:73% "/>
                                    </div>
                                    <br/>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">
                                    <input placeholder="Title " class="col-sm-12" style="height: 35px !important;"
                                           id="h_header" name="message" type="text">

                                    </input>

                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea rows="8" placeholder="  Homework    ..." style="height: 75px !important;"
                                               class="col-sm-12" id="h_body" name="message" type="text"></textarea>


                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <form action="#" class="col-sm-12" method="post" enctype="multipart/form-data"
                                      id="upload_form">

                                    <input multiple="" type="file" name="file" id="id-input-file-3"/>

                                    <button style="display: none;" class="btn btn-primary" type="submit"
                                            id="submit_file">upload file
                                    </button>
                                </form>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">

                                <button class="btn btn-sm btn-info no-radius col-sm-3" id="send_homework"
                                        type="button">
                                    <i class="icon-share-alt"></i>
                                    Submit
                                </button>

                            </div>

</div>
                    </div>

                </div>

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