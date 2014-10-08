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

    <div class="widget-box ">
        <div class="widget-header">
            <h4 class="lighter smaller">
                <i class="icon-comment blue"></i>
                Home Work
            </h4>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">
                <div style="position: relative; overflow: hidden; width: auto; height: 300px;" class="slimScrollDiv"><div style="overflow: hidden; width: auto; height: 300px;" class="dialogs">
                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Alexa's Avatar" src="assets/avatars/avatar1.png">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="green">4 sec</span>
                            </div>

                            <div class="name">
                                <a href="#">Alexa</a>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="John's Avatar" src="assets/avatars/avatar.png">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="blue">38 sec</span>
                            </div>

                            <div class="name">
                                <a href="#">John</a>
                            </div>
                            <div class="text">Raw denim you probably haven't heard of them jean shorts Austin.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Bob's Avatar" src="assets/avatars/user.jpg">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="orange">2 min</span>
                            </div>

                            <div class="name">
                                <a href="#">Bob</a>
                                <span class="label label-info arrowed arrowed-in-right">admin</span>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Jim's Avatar" src="assets/avatars/avatar4.png">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="grey">3 min</span>
                            </div>

                            <div class="name">
                                <a href="#">Jim</a>
                            </div>
                            <div class="text">Raw denim you probably haven't heard of them jean shorts Austin.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Alexa's Avatar" src="<?php echo SITE_LINK?>/assets/avatars/avatar1.png">
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="icon-time"></i>
                                <span class="green">4 min</span>
                            </div>

                            <div class="name">
                                <a href="#">Alexa</a>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only icon-share-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><div style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 74px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 225.564px;" class="slimScrollBar ui-draggable"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;" class="slimScrollRail"></div></div>

                <form>
                    <div class="form-actions">
                        <div class="input-group">
                            <input placeholder="Type your message here ..." class="form-control" name="message" type="text">
																<span class="input-group-btn">
																	<button class="btn btn-sm btn-info no-radius" type="button">
                                                                        <i class="icon-share-alt"></i>
                                                                        Send
                                                                    </button>
																</span>
                        </div>
                    </div>
                </form>
            </div><!-- /widget-main -->
        </div><!-- /widget-body -->
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