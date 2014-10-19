<?php
include_once(
    APPPATH . DIRECTORY_SEPARATOR .
        'views' . DIRECTORY_SEPARATOR .
        DIRECTORY_SEPARATOR .
        'common' . DIRECTORY_SEPARATOR .
        'header.php');
?>

<?php

$reads=array();
foreach($messages_read as $one){
 $reads[]=$one->m_id;
}
?>


<br/>
<div class="row" id="row">
<div id="tt" class="easyui-tabs" style="width:100%">
    <div title="Inbox" style="padding:20px;">
    <div class="col-xs-12">

    <div class="message-container">
    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">Inbox</span>
                <span class="grey bigger-110"></span>
            </div>

            <div class="message-toolbar hide">


            </div>
        </div>

        <div>
            <div class="messagebar-item-left">
                <label class="inline middle">
                    <input id="id-toggle-all" class="ace" type="checkbox">
                    <span class="lbl"></span>
                </label>

                &nbsp;
                <div class="inline position-relative">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="icon-caret-down bigger-125 middle"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-100">
                        <li>
                            <a id="id-select-message-all" href="#">All</a>
                        </li>

                        <li>
                            <a id="id-select-message-none" href="#">None</a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a id="id-select-message-unread" href="#">Unread</a>
                        </li>

                        <li>
                            <a id="id-select-message-read" href="#">Read</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="messagebar-item-right">
                <div class="inline position-relative">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        Sort &nbsp;
                        <i class="icon-caret-down bigger-125"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter pull-right dropdown-100">
                        <li>
                            <a href="#">
                                <i class="icon-ok green"></i>
                                Date
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-ok invisible"></i>
                                From
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-ok invisible"></i>
                                Subject
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="nav-search minimized">
                <form class="form-search">
																		<span class="input-icon">
																			<input autocomplete="off" class="input-small nav-search-input" placeholder="Search inbox ..." type="text">
																			<i class="icon-search nav-search-icon"></i>
																		</span>
                </form>
            </div>
        </div>
    </div>

    <div id="id-message-item-navbar" class="message-navbar align-center clearfix hide">
        <div class="message-bar">
            <div class="message-toolbar">
                <div class="inline position-relative align-left">
                    <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="bigger-110">Action</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
                        <li>
                            <a href="#">
                                <i class="icon-mail-reply blue"></i>
                                &nbsp; Reply
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-mail-forward green"></i>
                                &nbsp; Forward
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-folder-open orange"></i>
                                &nbsp; Archive
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#">
                                <i class="icon-eye-open blue"></i>
                                &nbsp; Mark as read
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-eye-close green"></i>
                                &nbsp; Mark unread
                            </a>
                        </li>


                    </ul>
                </div>


            </div>
        </div>

        <div>
            <div class="messagebar-item-left">
                <a href="#" class="btn-back-message-list">
                    <i class="icon-arrow-left blue bigger-110 middle"></i>
                    <b class="bigger-110 middle">Back</b>
                </a>
            </div>

            <div class="messagebar-item-right">
                <i class="icon-time bigger-110 orange middle"></i>
                <span class="time grey">Today, 7:15 pm</span>
            </div>
        </div>
    </div>

    <div id="id-message-new-navbar" class="hide message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-toolbar">
                <a href="#" class="btn btn-xs btn-message">
                    <i class="icon-save bigger-125"></i>
                    <span class="bigger-110">Save Draft</span>
                </a>

                <a href="#" class="btn btn-xs btn-message">
                    <i class="icon-remove bigger-125"></i>
                    <span class="bigger-110">Discard</span>
                </a>
            </div>
        </div>

        <div class="message-item-bar">
            <div class="messagebar-item-left">
                <a href="#" class="btn-back-message-list no-hover-underline">
                    <i class="icon-arrow-left blue bigger-110 middle"></i>
                    <b class="middle bigger-110">Back</b>
                </a>
            </div>

            <div class="messagebar-item-right">
																	<span class="inline btn-send-message">
																		<button type="button" class="btn btn-sm btn-primary no-border">
                                                                            <span class="bigger-110">Send</span>

                                                                            <i class="icon-arrow-right icon-on-right"></i>
                                                                        </button>
																	</span>
            </div>
        </div>
    </div>

    <div class="message-list-container">
        <div class="message-list" id="message-list">
            <?php foreach($messages as $m){?>
            <div  class="<?php if(in_array($m->m_id,$reads)){echo 'message-item ';} else{ echo 'message-item message-unread' ;} ?> ">
                <label class="inline">
                    <input class="ace" type="checkbox">
                    <span class="lbl"></span>
                </label>

                <i class="message-star icon-star orange2"></i>
                <span class="sender" title=""><?php echo data_user($m->m_from)->name; ?></span>
                <span class="time"><?php echo $m->m_date ?></span>

																	<span class="summary" >
																		<span class="text select_message"
                                                                              m_id="<?php echo $m->m_id ?>"
                                                                              m_header="<?php echo $m->m_header ?>"
                                                                              m_body="<?php echo $m->m_body ?>"
                                                                              m_from="<?php echo data_user($m->m_from)->name ?>"
                                                                              m_photo="<?php echo data_user($m->m_from)->photo ?>"
                                                                              m_attachment="<?php echo $m->m_attachment ?>"
                                                                              m_date='<?php echo $m->m_date ; ?>'

                                                                            >
																		<?php echo $m->m_header ?>
																		</span>
																	</span>
            </div>

            <?php } ?>

        </div>

        <div class="message-content hide" id="id-message-content">
            <div class="message-header clearfix">
                <div class="pull-left">


                    <div class="space-4"></div>

                    <i class="icon-star orange2 mark-star"></i>

                    &nbsp;
                    <img class="middle" alt=" " src="" width="32" id="m_photo">
                    &nbsp;
                    <a href="#" class="sender" id="m_from"><?php echo data_user($m->m_from)->name; ?></a>

                    &nbsp;
                    <i class="icon-time bigger-110 orange middle"></i>
                    <span class="time" id="m_date"><?php echo $m->m_date ?></span>
                </div>

                <div class="action-buttons pull-right">
                    <a href="#">
                        <i class="icon-reply green icon-only bigger-130"></i>
                    </a>

                    <a href="#">
                        <i class="icon-mail-forward blue icon-only bigger-130"></i>
                    </a>

                    <a href="#">
                        <i class="icon-trash red icon-only bigger-130"></i>
                    </a>
                </div>
            </div>

            <div class="hr hr-double"></div>

            <div style="position: relative; overflow: hidden; width: auto; height: 200px;" class="slimScrollDiv">
                <div style="overflow: hidden; width: auto; height: 200px;" class="message-body">
                    <p>
                        <span class="blue bigger-125"> </span>

                    </p>
                </div>



                </p>


                <div style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;
        height: 200px;" class="slimScrollBar ui-draggable"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px;
        display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90;
        right: 1px;" class="slimScrollRail"></div></div>

            <div class="hr hr-double"></div>

            <div class="message-attachment clearfix">
                <div class="attachment-title">
                    <span class="blue bolder bigger-110">Attachments</span>

                </div>

                &nbsp;
                <ul class="attachment-list pull-left list-unstyled">
                    <li>
                        <a href="#" class="attached-file inline" id="download_link2">
                            <i class="icon-file-alt bigger-110 middle"></i>
                            <span class="attached-name middle" id="m_attachment"></span>
                        </a>

                        <div class="action-buttons inline">
                            <a href="#" id="download_link1">
                                <i class="icon-download-alt bigger-125 blue"></i>
                            </a>


                        </div>
                    </li>


                </ul>

            </div>
        </div>
    </div><!-- /.message-list-container -->

    <div class="message-footer clearfix">
        <div class="pull-left"> 151 messages total </div>

        <div class="pull-right">
            <div class="inline middle"> page 1 of 16 </div>

            &nbsp; &nbsp;
            <ul class="pagination middle">
                <li class="disabled">
																		<span>
																			<i class="icon-step-backward middle"></i>
																		</span>
                </li>

                <li class="disabled">
																		<span>
																			<i class="icon-caret-left bigger-140 middle"></i>
																		</span>
                </li>

                <li>
																		<span>
																			<input value="1" maxlength="3" type="text">
																		</span>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-caret-right bigger-140 middle"></i>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-step-forward middle"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="message-footer message-footer-style2 clearfix hide">
        <div class="pull-left"> simpler footer </div>

        <div class="pull-right">
            <div class="inline middle"> message 1 of 151 </div>

            &nbsp; &nbsp;
            <ul class="pagination middle">
                <li class="disabled">
																		<span>
																			<i class="icon-angle-left bigger-150"></i>
																		</span>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-angle-right bigger-150"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div><!-- /.message-container -->
    </div><!-- /.tab-pane -->
    </div>

    <div title="Sent" style="padding:20px;">
    <div class="col-xs-12">

    <div class="message-container">
    <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-infobar" id="id-message-infobar">
                <span class="blue bigger-150">Inbox</span>
                <span class="grey bigger-110"></span>
            </div>

            <div class="message-toolbar hide">


            </div>
        </div>

        <div>
            <div class="messagebar-item-left">
                <label class="inline middle">
                    <input id="id-toggle-all" class="ace" type="checkbox">
                    <span class="lbl"></span>
                </label>

                &nbsp;
                <div class="inline position-relative">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        <i class="icon-caret-down bigger-125 middle"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-100">
                        <li>
                            <a id="id-select-message-all" href="#">All</a>
                        </li>

                        <li>
                            <a id="s_id-select-message-none" href="#">None</a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a id="s_id-select-message-unread" href="#">Unread</a>
                        </li>

                        <li>
                            <a id="s_id-select-message-read" href="#">Read</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="messagebar-item-right">
                <div class="inline position-relative">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        Sort &nbsp;
                        <i class="icon-caret-down bigger-125"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter pull-right dropdown-100">
                        <li>
                            <a href="#">
                                <i class="icon-ok green"></i>
                                Date
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-ok invisible"></i>
                                From
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-ok invisible"></i>
                                Subject
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="nav-search minimized">
                <form class="form-search">
																		<span class="input-icon">
																			<input autocomplete="off" class="input-small nav-search-input" placeholder="Search inbox ..." type="text">
																			<i class="icon-search nav-search-icon"></i>
																		</span>
                </form>
            </div>
        </div>
    </div>

    <div id="s_id-message-item-navbar" class="message-navbar align-center clearfix hide">
        <div class="message-bar">
            <div class="message-toolbar">
                <div class="inline position-relative align-left">
                    <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="bigger-110">Action</span>

                        <i class="icon-caret-down icon-on-right"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
                        <li>
                            <a href="#">
                                <i class="icon-mail-reply blue"></i>
                                &nbsp; Reply
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-mail-forward green"></i>
                                &nbsp; Forward
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-folder-open orange"></i>
                                &nbsp; Archive
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#">
                                <i class="icon-eye-open blue"></i>
                                &nbsp; Mark as read
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-eye-close green"></i>
                                &nbsp; Mark unread
                            </a>
                        </li>


                    </ul>
                </div>


            </div>
        </div>

        <div>
            <div class="messagebar-item-left">
                <a href="#" class="btn-back-message-list">
                    <i class="icon-arrow-left blue bigger-110 middle"></i>
                    <b class="bigger-110 middle">Back</b>
                </a>
            </div>

            <div class="messagebar-item-right">
                <i class="icon-time bigger-110 orange middle"></i>
                <span class="time grey">Today, 7:15 pm</span>
            </div>
        </div>
    </div>

    <div id="s_id-message-new-navbar" class="hide message-navbar align-center clearfix">
        <div class="message-bar">
            <div class="message-toolbar">
                <a href="#" class="btn btn-xs btn-message">
                    <i class="icon-save bigger-125"></i>
                    <span class="bigger-110">Save Draft</span>
                </a>

                <a href="#" class="btn btn-xs btn-message">
                    <i class="icon-remove bigger-125"></i>
                    <span class="bigger-110">Discard</span>
                </a>
            </div>
        </div>

        <div class="message-item-bar">
            <div class="messagebar-item-left">
                <a href="#" class="btn-back-message-list no-hover-underline">
                    <i class="icon-arrow-left blue bigger-110 middle"></i>
                    <b class="middle bigger-110">Back</b>
                </a>
            </div>

            <div class="messagebar-item-right">
																	<span class="inline btn-send-message">
																		<button type="button" class="btn btn-sm btn-primary no-border">
                                                                            <span class="bigger-110">Send</span>

                                                                            <i class="icon-arrow-right icon-on-right"></i>
                                                                        </button>
																	</span>
            </div>
        </div>
    </div>

    <div class="message-list-container">
        <div class="message-list" id="s_message-list">
            <?php foreach($messages_sent as $m){?>
            <div class="message-item ">
                <label class="inline">
                    <input class="ace" type="checkbox">
                    <span class="lbl"></span>
                </label>

                <i class="message-star icon-star orange2"></i>
                <span class="sender" title=""><?php echo data_user($m->m_to)->name; ?></span>
                <span class="time"><?php echo $m->m_date ?></span>

																	<span class="summary" >
																		<span class="text select_message"
                                                                              m_id="<?php echo $m->m_id ?>"
                                                                              m_header="<?php echo $m->m_header ?>"
                                                                              m_body="<?php echo $m->m_body ?>"
                                                                              m_from="<?php echo data_user($m->m_from)->name ?>"
                                                                              m_photo="<?php echo data_user($m->m_from)->photo ?>"
                                                                              m_attachment="<?php echo $m->m_attachment ?>"
                                                                              m_date='<?php echo $m->m_date ; ?>'

                                                                            >
																		<?php echo $m->m_header ?>
																		</span>
																	</span>
            </div>

            <?php } ?>

        </div>

        <div class="message-content hide" id="s_id-message-content">
            <div class="message-header clearfix">
                <div class="pull-left">


                    <div class="space-4"></div>

                    <i class="icon-star orange2 mark-star"></i>

                    &nbsp;
                    <img class="middle" alt="" src="" width="32" id="s_m_photo">
                    &nbsp;
                    <a href="#" class="sender" id="s_m_from"><?php echo data_user($m->m_from)->name; ?></a>

                    &nbsp;
                    <i class="icon-time bigger-110 orange middle"></i>
                    <span class="time" id="s_m_date"><?php echo $m->m_date ?></span>
                </div>

                <div class="action-buttons pull-right">
                    <a href="#">
                        <i class="icon-reply green icon-only bigger-130"></i>
                    </a>

                    <a href="#">
                        <i class="icon-mail-forward blue icon-only bigger-130"></i>
                    </a>

                    <a href="#">
                        <i class="icon-trash red icon-only bigger-130"></i>
                    </a>
                </div>
            </div>

            <div class="hr hr-double"></div>

            <div style="position: relative; overflow: hidden; width: auto; height: 200px;" class="slimScrollDiv">
                <div style="overflow: hidden; width: auto; height: 200px;" class="message-body">
                    <p>
                        <span class="blue bigger-125"> </span>

                    </p>
                </div>



                </p>


                <div style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;
        height: 200px;" class="slimScrollBar ui-draggable"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px;
        display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90;
        right: 1px;" class="slimScrollRail"></div></div>

            <div class="hr hr-double"></div>

            <div class="message-attachment clearfix">
                <div class="attachment-title">
                    <span class="blue bolder bigger-110">Attachments</span>

                </div>

                &nbsp;
                <ul class="attachment-list pull-left list-unstyled">
                    <li>
                        <a href="#" class="attached-file inline" id="s_download_link2">
                            <i class="icon-file-alt bigger-110 middle"></i>
                            <span class="attached-name middle" id="s_m_attachment"></span>
                        </a>

                        <div class="action-buttons inline">
                            <a href="#" id="s_download_link1">
                                <i class="icon-download-alt bigger-125 blue"></i>
                            </a>


                        </div>
                    </li>


                </ul>

            </div>
        </div>
    </div><!-- /.message-list-container -->

    <div class="message-footer clearfix">
        <div class="pull-left"> 151 messages total </div>

        <div class="pull-right">
            <div class="inline middle"> page 1 of 16 </div>

            &nbsp; &nbsp;
            <ul class="pagination middle">
                <li class="disabled">
																		<span>
																			<i class="icon-step-backward middle"></i>
																		</span>
                </li>

                <li class="disabled">
																		<span>
																			<i class="icon-caret-left bigger-140 middle"></i>
																		</span>
                </li>

                <li>
																		<span>
																			<input value="1" maxlength="3" type="text">
																		</span>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-caret-right bigger-140 middle"></i>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-step-forward middle"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="message-footer message-footer-style2 clearfix hide">
        <div class="pull-left"> simpler footer </div>

        <div class="pull-right">
            <div class="inline middle"> message 1 of 151 </div>

            &nbsp; &nbsp;
            <ul class="pagination middle">
                <li class="disabled">
																		<span>
																			<i class="icon-angle-left bigger-150"></i>
																		</span>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-angle-right bigger-150"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div><!-- /.message-container -->
    </div><!-- /.tab-pane -->
    </div>

    <div title="New Message" style="padding:20px;">

        <div class="form-horizontal " id="homework_form" >
            <div class="loading-indicator" style="display:none;" > <img src="<?php echo SITE_LINK."/assets" ?>/img/page-loader.gif" style="width:180px;height:180px;margin: 100px 200px " /></div>

            <div class="col-sm-12" id="the_message">
                <br/>

                <div class="form-group">
                    <div class="col-sm-8">

                        <div class="form-group">

                            <div class="col-sm-12">
                                <input  placeholder="To ...example( mohamed.gomah ) " class="col-sm-12 required " style="height: 35px !important;"
                                       id="m_to" name="message" type="text">
                                </input>

                            </div>
                            </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input placeholder="Title " class="col-sm-12 required" style="height: 35px !important;"
                                       id="m_header" name="message" type="text">
                                </input>

                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea rows="25" placeholder="  Message    ..." style="height: 300px !important;"
                                          class="col-sm-12 " id="m_body" name="message" type="text"></textarea>


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

                        <button class="btn btn-sm btn-info no-radius col-sm-3" id="send_message"    type="button">
                            <i class="icon-share-alt"></i>
                            Send
                        </button>

                    </div>

                </div>
            </div>

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