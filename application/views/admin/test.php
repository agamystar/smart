<html>
<head>
<link rel="stylesheet" href="<?php echo SITE_LINK."/assets" ?>/module/jq_widgets/jqx.base.css"/>

<script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/globalize.js"></script>
<script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jqxcore.js"></script>
<script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jqxcalendar.js"></script>
<script type="text/javascript" src="<?php echo SITE_LINK . "/assets/module/jq_widgets"; ?>/jqxdatetimeinput.js"></script>

<script type="text/javascript">
    $(function () {
        // Create a jqxDateTimeInput
       $("#jqxWidget").jqxDateTimeInput({ animationType: 'fade', width: '150px', height: '25px',
           dropDownHorizontalAlignment: 'right'});


    });
    </script>
    </head>

<body>
oooooooooooooooooooooooooooo
<div id="jqxWidget"></div>
</body>
</html>