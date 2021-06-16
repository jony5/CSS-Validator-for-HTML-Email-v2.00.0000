<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

$oLogger = new crnrstn_logging();

//
// RETRIEVE OVERLAY STATE FROM DB
// DATABASE REQUEST/RESPONSE PROCESSING
//$tmp_serial_handle = 'OVERLAY_DATUM';
//$oDB_RESP = $oUSER->getOverlayStateDatum($tmp_serial_handle);

?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
    <link rel="icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="distribution" content="Global" />
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

    <title>AV Service - OBS Meeting Overlay</title>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery/3.4.1/jquery-3.4.1.min.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.js" ></script>
    <script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/main.js" ></script>

    <style>
        *									{ border:0; padding:0; margin:0; }   /*font-family:Arial, Helvetica, sans-serif;*/
        /*body 								{ background-color: transparent; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;} width:620px; */
        body 								{ background-repeat: no-repeat; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;}
        p									{ padding-top:5px; padding-bottom:5px; font-size:16px; line-height:23px;}
        blockquote							{ padding-left:15px; font-size:13px;}
        li									{ margin-left:20px;}
        a                                   { color:#0066CC;}

        /* TIMER ONLY STYLE VALUES
        #mini_overlay_handle                { position: absolute; top:0; }
        #mini_overlay_bg                    { position: absolute; z-index: 4; top:700px; width:175px; height: 75px; border:3px solid #9499A6; background-color: #FFF; border-left: 0;opacity: 0.7;}
        #mini_overlay_content               { position: absolute; z-index: 5; top:700px;}
        */

        /* SCROLL MODE STYLE VALUES - SAME AS TIMER BUT WIDER
        #mini_overlay_handle                { position: absolute; top:0; }
        #mini_overlay_bg                    { position: absolute; z-index: 4; top:700px; width:575px; height: 75px; border:3px solid #9499A6; background-color: #FFF; border-left: 0;}
        #mini_overlay_content               { position: absolute; z-index: 5; top:700px; width:575px;}
        */

        /* MAX-MINI MODE STYLE VALUES
        #mini_overlay_handle                { position: absolute; }
        #mini_overlay_bg                    { position: absolute; z-index: 4; top:575px; width:575px; height: 200px; border:3px solid #9499A6; background-color: #FFF; border-left: 0; opacity: 0.7;}
        #mini_overlay_content               { position: absolute; z-index: 5; top:575px; width:575px; }
        */

        #mini_overlay_handle                { position: absolute; top:0; left:0; }
        #mini_overlay_bg                    { position: absolute; z-index: 4; top:550px; width:175px; height: 75px; border:3px solid #9499A6; background-color: #FFF; border-left: 0; opacity: 0.7; }
        #mini_overlay_content               { position: absolute; z-index: 5; top:550px;}

        .fullscrn_overlay_handle            { position: absolute; z-index:30; width:100%; }
        .fullscrn_overlay_bg_wrapper        { position: absolute; width:100%; height:4000px; background-color: #F9F6F9; opacity: 0; }
        .fullscrn_content_wrapper           { position: absolute; width:100%; padding: 10px; color:#000; text-align: center; margin: 0px auto;}
        .fullscrn_content_shell             { position: relative; width:700px; text-align: center; margin: 0px auto; }
        .fullscrn_content                   { position: absolute; text-align: center; margin: 0px auto; width:100%;}

        .fullscrn_page_header               { text-align: center;  width:100%; }
        .fullscrn_document_title            { text-align: center;  width:100%; }
        .fullscrn_page_code                 { text-align: left; width:100%; height:700px; overflow-y: scroll; padding-left: 75px; }

        .timer_copy                         { position:absolute; z-index: 15; font-size:36px; font-weight: bold; padding-top:20px; padding-left:20px; padding-right:0px; opacity:0;}
        #timer_copy                         { padding-top:21px;  opacity:1.0;}

        #minimax_primary_copy_sectA_handle  { position:absolute; width:100%;}
        .minimax_primary_copy_sectA         { position:relative; z-index: 8; font-size:24px; font-weight: bold; color:#5B5870; padding:20px; padding-right:40px; padding-left: 15px; overflow: hidden;}
        .minimax_hr                         { width:94%; border-bottom: 2px solid #757B8D; text-align: center; margin: 0px auto; opacity: 0.6;}
        .minimax_primary_copy_sectB         { font-size:24px; font-weight: bold; float: right; text-align: right; width:80%; padding-right: 27px; padding-top: 26px; }

        #gate_wrapper                       { position: absolute; z-index: 10; width:575px;}
        #scroll_gate_left                   { height:65px; width:33px; margin-top: 8px; margin-left: 148px; overflow: hidden; float: left; background-image: url('<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/avoverlay_fade_50_left.png'); opacity: 0.0;}
        #scroll_gate_right                  { height:65px; width:33px; margin-top: 8px; margin-right: 10px; overflow: hidden; float: right; background-image: url('<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/avoverlay_fade_50_right.png'); opacity: 0.0;}

        .full_gate_left                     { position: absolute; z-index: 15; width:33px; margin-left:5px; height:600px; opacity: 0.0; background-repeat: no-repeat; }

        .view_window                        { position: relative; overflow: hidden; margin-left: 20px;}
        .scroll_view_window_append_handle   { position: absolute; overflow: hidden; width:385px; left:164px; margin-top: 15px; height: 50px; }
        .scrolling_content_container        { position: absolute; width:6000px; padding-top:14px; padding-left:385px; z-index: 5;}  /*adjust paddingLeft:385px per new width of SCROLL mode to keep edge of text out of view...just.  */

        #activity_log                       { position: absolute;  z-index:35; opacity: 0;}
        .log_output_wrapper                 { background-color: #000; border:3px solid #9F9393; padding:30px; margin:20px; margin-top:10px; padding-top:10px; width:1350px; height:140px; overflow:scroll;}
        .log_output                         { width:100%;}
        .log_entry                          { display:block; clear:both; text-align: left; color:#34E02A; font-size:11px; font-family: "Courier New", Courier, monospace;}

        #login_lnk                          { position: absolute; z-index:40; padding: 30px; margin: 30px; color:#000; width:200px; height:100px; border: 3px solid #FF0000; background-color: #FFF; cursor: pointer; opacity: 0.8;}
        #login_lnk a                        { text-decoration: none; text-decoration: underline; color: #0066CC; }
        #login_lnk_tmr                      { padding-top: 5px; text-align: center; margin: 0px auto; width:100%;}

        .message_meta                       { float: left; font-weight: bold; font-size:19px; color:#1A182D; padding-right:10px;}
        .message_title                      { float: left; font-size:19px; color:#000; padding-right:30px;}
        .conference_date                    { float: left; font-weight: bold; font-size:19px; color:#1A182D; padding-right:30px;}
        .conference_title                   { float: left; font-weight: bold; font-size:19px; color:#1A182D; padding-right:30px;}
        .lang_pack_buffer                   { float: left; font-weight: bold; font-size:19px; color:#FFF; padding-top: 10px; padding-right:60px;}
        .langpack_mini_full_shell           { position: absolute; opacity: 0.0;}

        .schedule_day_title                 { padding:20px 0 20px 0; font-weight: bold;}
        .schedule_element_wrapper           { padding:0px 0 8px 0;}
        .schedule_element_time              { float: left; padding:0 0px 0 30px; width:155px;}
        .schedule_element_activity          { float: left;}

        /*UTILITY*/
        .hidden								{ width:0px; height:0px; position:absolute; left:-2000px; overflow:hidden;}
        .cb 								{ display:block; clear:both; height:0px; line-height:0px; overflow:hidden; width:100%; font-size:1px;}
        .cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_200								{ display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}


    </style>

</head>

<body id="overlay_body">
<div id="login_lnk"><a href="#" target="_self">Saints, by clicking here, we will be able to to sign in for overlay management and translation submission &amp; management. </a><div id="login_lnk_tmr">(5)</div></div>
<div id="activity_log" class="log_output_wrapper"><div id="activity_log_output" class="log_output"></div></div>

<div id="fullscrn_overlay_handle" class="fullscrn_overlay_handle">
    <div id="fullscrn_overlay_bg_wrapper" class="fullscrn_overlay_bg_wrapper"></div>
    <div class="fullscrn_content_wrapper">
        <div id="fullscrn_content_shell" class="fullscrn_content_shell">
            <div id="fullscrn_content" class="fullscrn_content">

            </div>
        </div>
    </div>
</div>

<div id="mini_overlay_handle">
    <div id="mini_overlay_bg"></div>
    <div id="mini_overlay_content">
        <!-- START DYNAMIC INJECT CONTENT  -->
        <div id="timer_copy" class="timer_copy">0:00:00</div>

            <!-- END DYNAMIC INJECT CONTENT  -->
    </div>
</div>

<!-- TIMER ONLY ::
<div id="mini_overlay_handle">
    <div id="mini_overlay_bg"></div>
    <div id="mini_overlay_content">
        <div id="timer_copy">0:00:00</div>

    </div>
</div>

-->


<!-- MINI MAX ::
 <div id="mini_overlay_handle">
    <div id="mini_overlay_bg"></div>
    <div id="mini_overlay_content">
        <div class="langpack_mini_full_shell">
            <div id="minimax_primary_copy_sectA">The Ultimate Revelation of Jesus
                Christ and the Vision of the Enthroned Christ as
                the Administrator in God's Universal Government</div>
            <div class="cb"></div>
            <div id="minimax_hr"></div>
            <div id="timer_copy">0:00:00</div>
            <div id="minimax_primary_copy_sectB">Message 1</div>
        </div>
    </div>
</div>


 -->

<!-- SCROLL ::
<div id="mini_overlay_handle">
    <div id="mini_overlay_bg"></div>
    <div id="mini_overlay_content">
        <div id="timer_copy">0:00:00</div>
        <div id="gate_wrapper">
            <div id="scroll_gate_left"></div>
            <div id="scroll_gate_right"></div>
        </div>
        <div id="scroll_view_window_append_handle">
            <div class="scrolling_content_container">
                <div class="scroll_copy_msgtitle">The Ultimate Revelation of Jesus
                    Christ and the Vision of the Enthroned Christ as
                    the Administrator in God's Universal Government</div>
            </div>
        </div>
    </div>
</div>

-->
<div class="hidden">
    <div id="cache_bust"><?php echo $oUSER->generateNewKey(25); ?></div>
    <div id="timer_lck">OFF</div>
    <div id="om">TIMER</div>
    <div id="ajax_root"><?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>
    <div id="overlay_dyn_flags_container"></div>
    <div id="mov">true</div>
    <div id="tov">true</div>
    <div id="cov">true</div>
    <div id="hmm">DYNAMIC</div>
    <div id="full_mov">true</div>
    <div id="full_cov">true</div>
    <div id="timer_copy_persist">0:00:00</div>
    <div id="ui_retardation_handle">0</div>
    <div id="ui_retardation_handle_duo">0</div>
    <div id="nxt_langpack"></div>
    <div id="curr_mini_lang_pack"></div>
    <div id="curr_full_lang_pack"></div>
    <div id="scroll_copy_height"></div>
    <div id="msm">0</div>
</div>
</body>
</html>