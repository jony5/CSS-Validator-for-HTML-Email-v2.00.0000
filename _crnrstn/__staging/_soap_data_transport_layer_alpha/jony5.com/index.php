<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// CUSTOM CONSTANTS
include_once(CRNRSTN_ROOT . '/common/inc/constants/custom.constants_initialize.inc.php');
include_once(CRNRSTN_ROOT . '/common/inc/constants/custom.constants_load.inc.php');
include_once(CRNRSTN_ROOT . '/common/class/user_jony5_dot_com.php');

$oUSER = new user_jony5_dot_com($oCRNRSTN_USR);

//error_log(__LINE__.' index die() '.$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/footer/footer.inc.php');
//die();

if($oCRNRSTN_USR->is_client_mobile(true)){

    //
    // MOBILE/TABLET DEVICE EXPERIENCE
    include_once($oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/head/head.inc.php');

    $tmp_HTML = 'HELLO TEMP HTML.';

    $tmp_formUnique = $oCRNRSTN_USR->generate_new_key(4);
    $tmp_pageName_Header =  'Page Header ::';
    require($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
    require($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/nav/sidenav.mobi.inc.php');
    require($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');

    $oUSER->init_mobile_ui_resources();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php

        $oUSER->output_content(JONY5_CONTENT_MOBILE_HEAD);

        ?>
    </head>
    <body>

    <div data-role="page" id="myPage">
        <?php

        $oUSER->output_content(JONY5_CONTENT_MOBILE_SEARCH_INPUT);
        $oUSER->output_content(JONY5_CONTENT_MOBILE_SIDE_NAV);
        $oUSER->output_content(JONY5_CONTENT_MOBILE_PAGE_HEADER);

        ?>

        <!--
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content" id="myPage">
            <?php
            echo $tmp_HTML;
            ?>
        </div><!-- /content -->

        <?php
        require($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
        ?>

    </div><!-- /page -->

    </body>
    </html>
    <?php
}else{
    //
    // DESKTOP EXPERIENCE
    $oCRNRSTN_USR->print_r($oUSER->request_ui_data_sync_packet(), NULL, NULL, __LINE__, __METHOD__, __FILE__);

    //
    // CONTENT GEN
    include_once($oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/head/head.inc.php');
    include_once($oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/search/search.inc.php');
    include_once($oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/footer/footer.inc.php');

    $oUSER->init_desktop_ui_resources();
    $oUSER->output_content(JONY5_CONTENT_SOAP_DATA_TUNNEL);

    echo '<div style="padding-left:47px;">';
    $oUSER->output_content(JONY5_CONTENT_SOAP_DATA_TUNNEL, 'ALPHA_TESTING');
    echo '</div>';

    $oCRNRSTN_USR->print_r('END. die()', NULL, NULL, __LINE__, __METHOD__, __FILE__);
    die();
    ?><!DOCTYPE html>
    <html lang="en">
    <head>
        <?php

        $oUSER->output_content(JONY5_CONTENT_DESKTOP_HEAD);

        ?>
    </head>
    <body>
    <div class="body_wrapper">
        <div id="body_shell" class="body_shell">
            <div class="cb"></div>

            <div class="top_nav_wrapper_outer">
                <div class="top_nav_wrapper">

                    <div class="top_nav_content">
                        <div class="cb_20"></div>

                        <div class="j5_logo_wrapper">
                            <div id="j5_logo">
                                <div class="j5_logo_inner_bdr">
                                    <div class="j5_logo_content">

                                        <div class="j5_logo_copy"><a href="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self">J5</a></div>
                                        <div class="stache"><a href="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/stache.gif" width="66" height="21" alt="J5" title="J5"></a></div>

                                    </div>
                                </div>
                            </div>
                            <div class="cb" style="width:66px;"></div>
                        </div>

                        <div class="tnav_lnk_search_wrapper">
                            <div class="tnav_search_wrapper" >
                                <?php

                                $oUSER->output_content(JONY5_CONTENT_DESKTOP_SEARCH_INPUT);

                                ?>

                                <div style="float: right; width:1px; height: 1px;">
                                    <div style="position: relative;">
                                        <div id="shortcut_lnk_side_nav" class="shortcut_lnk_side_nav" onmouseover="mouse_over_social_lnk_array(this);" onmouseout="mouse_out_social_lnk_array(this);">
                                            <div class="cb_20"></div>
                                            <div class="shortcut_lnk_side_nav_lnk"><a href="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/crnrstn_logo_sm.png" width="100" height="61" alt="CRNRSTN" title="CRNRSTN"></a></div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="wethrbug_nav_btn" onclick="launch_popup('http://wethrbug.jony5.com/','350','575','wthbg');">WETHRBUG</div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="lsm_daily_podcast_btn" onClick="launch_popup('<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/podcast/listen.php','500','340','lsm_aud');"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/lsm_logo_sm.gif" alt="Living Stream Ministry" title="Listen to a Daily LSM Podcast" width="42" height="35"></div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <!-- VALIDATOR START-->

                                                <div style='text-align:center; margin:0 auto; width:94px; overflow: hidden; padding: 0; text-align: center; cursor: pointer; color: #6885C3; font-weight: normal; border: 2px solid #A5B9D8; background-color: #D9DEEA; font-family:"Courier New", Courier, monospace;'  onClick="launch_popup('http://css.validate.jony5.com/','1000','630','css_val');">
                                                    <div style='float:left; width:38px; overflow: hidden; height: 18px; background-color: #D9DEEA; margin: 5px 0 0 2px;'>

                                                        <div style='width:60px; font-family: "Courier New", Courier, monospace; font-size: 15px; color: #6986C3;'>

                                                            <div style="position: relative; height:14px; overflow: visible;">
                                                                <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:24px; color: #FFF; top:-5px; ">@</div>
                                                                <div style="position: absolute; z-index:2; left:0; top:-2px; width:40px; height: 23px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">
                                                                    <div style="float:left; color:#FF0000; font-size: 21px; line-height: 14px; font-weight:bold; padding-top: 1px;">&lt;</div>
                                                                    <div style='float:left; width:15px; font-family: "Courier New", Courier, monospace;  color: #6986C3;'>HTML</div>
                                                                </div>
                                                            </div>

                                                            <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                                        </div>

                                                    </div>

                                                    <div style="float:right; background-color: #6885C3; width:51px; height:23px; overflow: hidden;">
                                                        <div style="position: relative; height:14px; overflow: visible;">
                                                            <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:-17px; top:0px; color: #94AAD5;">@</div>
                                                            <div style="position: absolute; z-index:2; left:7px; top:2px; width:38px; overflow:hidden;font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #FFF; font-size: 18px;">CSS</div>
                                                        </div>
                                                    </div>

                                                    <div style="float: right; width:3px; line-height: 10px; background-color: #FFF; height: 23px; overflow: hidden;">
                                                        &nbsp;
                                                    </div>

                                                    <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>

                                                    <div style="width:100%; background-color: #FBFBFB; text-align:center; padding: 5px 3px 5px 3px; overflow: hidden;">
                                                        <div style="position: relative; height:14px; overflow: visible;">
                                                            <div style="position: absolute; z-index:1; font-size: 35px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; left:23px; top:-28px; color: #E2E2E2;">@</div>
                                                            <div style='position: absolute; z-index:2; left:4px; font-size: 15px; font-family: "Courier New", Courier, monospace; font-weight: bold; color: #6986C3;'>validator</div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div style="height:0; width:100%; clear:both; display: block; overflow: hidden;"></div>


                                                <!-- VALIDATOR END-->
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="social_link facebook" onclick="launch_newwindow('https://www.facebook.com/j00000101'); return false;" style="background-image:url(<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_sprite.gif)"></div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="social_link instagram" onclick="launch_newwindow('https://www.instagram.com/j00000101/?hl=en'); return false;" style="background-image:url(<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_sprite.gif)"></div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="social_link linkedin" onclick="launch_newwindow('https://www.linkedin.com/in/jonathan-harris-6397143'); return false;" style="background-image:url(<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_sprite.gif)"></div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="social_link twitter" onclick="launch_newwindow('https://twitter.com/j00000101'); return false;" style="background-image:url(<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_sprite.gif)"></div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="social_link twitter" onclick="launch_newwindow('https://twitter.com/jony5'); return false;" style="background-image:url(<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/social_sprite.gif)"></div>
                                            </div>

                                            <div class="shortcut_lnk_side_nav_lnk">
                                                <div class="legalize_leaf"><a href="http://norml.org/" target="_blank"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/legalize_leaf.jpg" width="64" height="67" alt="Legalize" title="Legalize" /></a></div>
                                                <div class="legalize_copy_wrapper">
                                                    <div class="legalize_title">Legalize.</div>
                                                    <div class="legalize_copy">Click <a href="http://norml.org/" target="_blank">here</a><br />for more.</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="top_nav_global_lnk_wrapper">
                                <div class="top_nav_global_lnk j5_first_top_nav_global_lnk">projects</div>
                                <div class="top_nav_global_lnk">about</div>
                                <div class="top_nav_global_lnk">media</div>
                                <div class="top_nav_global_lnk">blog</div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>

            <div class="cb_20"></div>

            <div class="container_row">
                <div class="banner_lifestyle_wrapper">
                    <div class="banner_lifestyle_img_window_wrap">
                        <div class="banner_lifestyle_img_window">
                            <div class="banner_lifestyle_img_shell">
                                <img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/20190627_104658_HDRd.jpg" width="1180" height="250" alt="J5 in Atlanta" title="J5 in Atlanta">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cb_10"></div>
            <div class="bassdrive_section_wrapper">

                <div class="bassdrive_section">
                    <div class="bassdrive_section_inner">
                        <div id="bassdrive_show_title" class="bassdrive_show_title"><h2>DrumObsession 8 YEAR ANNIVERSARY LIVE with Alegria :: fb.com/DrumObsession</h2></div>
                        <div id="bassdrive_show_hosted_meta" class="bassdrive_show_hosted_meta">hosted by Alegria</div>

                        <div>
                            <div style="float: left;">

                                <div id="bassdrive_integrated_play_wrapper" class="bassdrive_integrated_play_wrapper">
                                    <div class="bassdrive_integrated_play_control">PLAY</div>
                                    <div class="bassdrive_integrated_play_control_lvl_on"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_on"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_on"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="bassdrive_integrated_play_control_lvl_off"></div>
                                    <div class="cb"></div>
                                </div>
                                <div class="bassdrive_stream_options_wrapper">
                                    <div class="bassdrive_stream_option">AAC+</div>
                                    <div class="bassdrive_stream_option">56K</div>
                                    <div class="bassdrive_stream_option">128K</div>
                                    <div class="bassdrive_stream_option">WEB PLAYER</div>
                                    <div class="bassdrive_stream_option">CHAT</div>
                                    <div class="cb"></div>
                                </div>

                                <div class="cb"></div>
                            </div>

                            <div style="float: right;">
                                <div class="bassdrive_logo"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/basdrive_logo_md.png" width="283" height="140" alt="Bassdrive" title="Bassdrive. Worldwide Drum and Bass"></div>
                                <div class="bassdrive_broadcast_colors"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/bassdrive_component_creative/flag_united_kingdom.gif" width="64" height="32" alt="United Kingdom" title="Broadcasting LIVE from the United Kingdom"></div>

                                <div class="cb"></div>
                            </div>

                            <div class="cb"></div>
                        </div>
                        <div class="cb"></div>

                        <div class="bassdrive_stats_connections_wrapper">
                            <div class="bassdrive_stats_data">420</div>
                            <div class="bassdrive_superscript_units">connections</div>
                        </div>

                        <div class="bassdrive_stats_throughput_wrapper">
                            <div class="bassdrive_stats_data">56.87 MiB</div>
                            <div class="bassdrive_superscript_units">MiB / sec of<br>the Funky Business</div>
                        </div>

                        <div class="bassdrive_stats_last_update_wrapper">
                            <div>
                                <div class="bassdrive_superscript_units">last update</div>
                                <div class="bassdrive_stats_data">1 min 3 secs ago</div>
                            </div>
                        </div>



                        <div class="cb"></div>
                    </div>
                </div>

            </div>

            <div class="cb_10"></div>
            <div class="wethrbug_section_wrapper">

                <div class="wethrbug_section">
                    <div class="wethrbug_section_inner">

                        <div class="wethrbug_section_head">
                            <div class="wethrbug_title"><h2>WETHRBUG</h2></div>
                            <div class="wethrbug_description"><p>Pulling real-time weather forecasts through a <a href="https://www.weather.gov/" target="_blank">National Weather Services</a> Web API for fast and accurate results.</p></div>
                            <div class="cb"></div>
                        </div>

                        <div class="wethrbug_input_wrapper">
                            <input type="text" id="wethrbug_zip_or_city" name="wethrbug_zip_or_city" value="" placeholder="30071">
                            <button type="submit" name="submit">zip or city</button>
                        </div>
                        <div class="wethrbug_results_description"><p>Results (<a href="#">view</a>) for Norcross, GA 30071 requested on Wednesday, Apr. 21, 2021 at 0:16:09 EDT.</p></div>

                        <div class="wethrbug_results_set_wrapper">

                            <div class="wethrbug_result_wrapper">
                                <div class="wethrbug_result_day_title">The Lord's Day</div>
                                <div class="wethrbug_result_temp">69&deg;F</div>
                                <div class="wethrbug_result_details_lnk"><p>Mostly Sunny
                                        Windage 5 to 10 mph in South-Easternly direction. (<a href="#">details</a>)</p></div>
                                <div class="wethrbug_result_wethr_icon wethr_night"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wethrbug_night_icon.gif" width="86" height="86" alt="Night" title="Night"></div>

                            </div>

                            <div class="wethrbug_result_wrapper">
                                <div class="wethrbug_result_day_title">The Lord's Day</div>
                                <div class="wethrbug_result_temp">69&deg;F</div>
                                <div class="wethrbug_result_details_lnk"><p>Mostly Sunny
                                        Windage 5 to 10 mph in South-Easternly direction. (<a href="#">details</a>)</p></div>
                                <div class="wethrbug_result_wethr_icon wethr_night"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wethrbug_night_icon.gif" width="86" height="86" alt="Night" title="Night"></div>

                            </div>

                            <div class="wethrbug_result_wrapper">
                                <div class="wethrbug_result_day_title">The Lord's Day</div>
                                <div class="wethrbug_result_temp">69&deg;F</div>
                                <div class="wethrbug_result_details_lnk"><p>Mostly Sunny
                                        Windage 5 to 10 mph in South-Easternly direction. (<a href="#">details</a>)</p></div>
                                <div class="wethrbug_result_wethr_icon wethr_night"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wethrbug_night_icon.gif" width="86" height="86" alt="Night" title="Night"></div>

                            </div>

                            <div class="wethrbug_result_wrapper">
                                <div class="wethrbug_result_day_title">The Lord's Day</div>
                                <div class="wethrbug_result_temp">69&deg;F</div>
                                <div class="wethrbug_result_details_lnk">Mostly Sunny
                                    Windage 5 to 10 mph in South-Easternly direction. (<a href="#">details</a>)</div>
                                <div class="wethrbug_result_wethr_icon wethr_night"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wethrbug_night_icon.gif" width="86" height="86" alt="Night" title="Night"></div>

                            </div>

                            <div class="wethrbug_result_wrapper">
                                <div class="wethrbug_result_day_title">The Lord's Day</div>
                                <div class="wethrbug_result_temp">69&deg;F</div>
                                <div class="wethrbug_result_details_lnk"><p>Mostly Sunny
                                        Windage 5 to 10 mph in South-Easternly direction. (<a href="#">details</a>)</p></div>
                                <div class="wethrbug_result_wethr_icon wethr_night"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wethrbug_night_icon.gif" width="86" height="86" alt="Night" title="Night"></div>

                            </div>

                            <div class="wethrbug_result_wrapper">
                                <div class="wethrbug_result_day_title">The Lord's Day</div>
                                <div class="wethrbug_result_temp">69&deg;F</div>
                                <div class="wethrbug_result_details_lnk"><p>Mostly Sunny
                                        Windage 5 to 10 mph in South-Easternly direction. (<a href="#">details</a>)</p></div>
                                <div class="wethrbug_result_wethr_icon wethr_night"><img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/wethrbug_night_icon.gif" width="86" height="86" alt="Night" title="Night"></div>

                            </div>
                            <div class="cb"></div>
                        </div>

                        <div class="wethrbug_change_period_lnk"><a href="#">View Daytime Forecast</a></div>

                    </div>

                </div>

            </div>

            <div class="cb_10"></div>
            <div class="custom_content_section_wrapper">

                <div class="custom_content_section">
                    <div class="custom_content_section_inner" >
                        <div class="custom_content_title">
                            <h2>Living on this earth as an overcoming [normal] Christian according to the Truth of the gospel of our Lord Jesus Christ</h2>
                        </div>
                        <div class="custom_content_paragraph">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices porta lectus ac efficitur. Pellentesque pretium neque in risus efficitur, ut vehicula ante sodales. Aenean nulla quam, pharetra eu neque at, consequat interdum nisi. Fusce eu tristique nisi. Vestibulum vitae congue justo. Nulla et diam eu tellus vehicula dapibus sit amet sit amet diam. Donec pretium...<a href="#" target="_self">continue</a>.</p>
                        </div>

                        <div class="cb_5"></div>
                    </div>
                </div>

            </div>

            <div class="cb_10"></div>
            <div class="custom_content_section_wrapper">

                <div class="custom_content_section">
                    <div class="custom_content_section_inner" >
                        <div class="custom_content_title">
                            <h2>How did the idea for &quot;J5&quot; come about?</h2>
                        </div>
                        <div class="custom_content_paragraph">
                            <p>This is an excellent question! You see, back in the days of dial up (late 90's), I was quite new to the world of the interwebs. I didn't even have an email address. Realizing that I needed to get some kind of messaging account called an email address, I went to the folks at Juno.  <img src="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/jony5_no_disassemble.jpg" width="296" height="197" alt="No disassemble...Johnny number 5" title="Johnny number 5"> They hooked me up with a free email account and dial-up internet access!</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices porta lectus ac efficitur. Pellentesque pretium neque in risus efficitur, ut vehicula ante sodales. Aenean nulla quam, pharetra eu neque at, consequat interdum nisi. Fusce eu tristique nisi. Vestibulum vitae congue justo. Nulla et diam eu tellus vehicula dapibus sit amet sit amet diam. Donec pretium volutpat lorem id...<a href="#" target="_self">continue</a>.</p>
                            <div class="cb"></div>
                        </div>
                        <div class="cb_5"></div>
                    </div>
                </div>

            </div>

            <div class="cb_10"></div>
            <div class="footer_section_wrapper">

                <div class="footer_section">
                    <div class="footer_section_inner">
                        <div class="footer_section_copyright"><p>&copy; <?php echo date('Y'); ?> Jonathan 'J5' Harris :: All Rights Reserved.</p></div>

                        <div class="footer_site_map_wrapper">
                            <div class="footer_site_map">

                                <div class="footer_lnk_section_array_wrapper first_footer_lnk_section">

                                    <div class="footer_lnk_section_wrapper">
                                        <div class="footer_lnk_section_title">bio</div>
                                        <div class="footer_lnk_section_lnk">professional</div>
                                        <div class="footer_lnk_section_lnk">personal</div>
                                        <div class="footer_lnk_section_lnk">heavenly</div>
                                    </div>

                                    <div class="footer_lnk_section_wrapper">
                                        <div class="footer_lnk_section_title">work</div>
                                        <div class="footer_lnk_section_lnk">highlights</div>
                                        <div class="footer_lnk_section_lnk">experience</div>
                                        <div class="footer_lnk_section_lnk">skills</div>
                                        <div class="footer_lnk_section_lnk">resume</div>
                                    </div>

                                </div>

                                <div class="footer_lnk_section_array_wrapper">

                                    <div class="footer_lnk_section_wrapper">

                                        <div class="footer_lnk_section_title">social</div>
                                        <div class="cb"></div>
                                        <div class="footer_lnk_section_column">
                                            <div class="footer_lnk_section_lnk">facebook</div>
                                            <div class="footer_lnk_section_lnk">instagram</div>
                                            <div class="footer_lnk_section_lnk">pandora</div>
                                        </div>

                                        <div class="footer_lnk_section_column">
                                            <div class="footer_lnk_section_lnk">google+</div>
                                            <div class="footer_lnk_section_lnk">linkedin</div>
                                            <div class="footer_lnk_section_lnk">twitter</div>
                                        </div>

                                        <div class="cb"></div>
                                    </div>

                                    <div class="footer_lnk_section_wrapper">
                                        <div class="footer_lnk_section_title">fellowship</div>
                                        <div class="footer_lnk_section_lnk">podcast</div>
                                        <div class="footer_lnk_section_lnk">conferences</div>
                                        <div class="footer_lnk_section_lnk">your free Bible</div>
                                        <div class="footer_lnk_section_lnk">we can fly!</div>
                                    </div>

                                </div>


                                <div class="footer_lnk_section_array_wrapper">

                                    <div class="footer_lnk_section_wrapper">
                                        <div class="footer_lnk_section_title">C<span class="the_R">R</span>NRSTN ::</div>
                                        <div class="footer_lnk_section_lnk">about</div>
                                        <div class="footer_lnk_section_lnk">documentation</div>
                                        <div class="footer_lnk_section_lnk">license</div>
                                        <div class="footer_lnk_section_lnk">download</div>
                                        <div class="footer_lnk_section_lnk">donate</div>
                                        <div class="footer_lnk_section_lnk">github/C<span class="the_R">R</span>NRSTN</div>
                                    </div>

                                    <div class="footer_lnk_section_wrapper">

                                        <div class="footer_lnk_section_title">polar bear</div>
                                        <div class="cb"></div>
                                        <div class="footer_lnk_section_column">
                                            <div class="footer_lnk_section_lnk">factory</div>
                                            <div class="footer_lnk_section_lnk">audio</div>
                                            <div class="footer_lnk_section_lnk">exhaust</div>
                                            <div class="footer_lnk_section_lnk">HOONIGAN</div>
                                        </div>

                                        <div class="footer_lnk_section_column">
                                            <div class="footer_lnk_section_lnk">tint</div>
                                            <div class="footer_lnk_section_lnk">performance</div>
                                            <div class="footer_lnk_section_lnk">wrap</div>
                                            <div class="footer_lnk_section_lnk">perspicuum</div>
                                        </div>

                                        <div class="cb"></div>
                                    </div>

                                    <div class="footer_lnk_section_wrapper">
                                        <div class="footer_lnk_section_title">cannabis grow op telemetry</div>
                                        <div class="footer_lnk_section_lnk">atmospheric</div>
                                        <div class="footer_lnk_section_lnk">life support</div>
                                        <div class="footer_lnk_section_lnk">automation</div>
                                        <div class="footer_lnk_section_lnk">diagram</div>
                                    </div>

                                </div>


                                <div class="footer_lnk_section_array_wrapper">

                                    <div class="footer_lnk_section_wrapper">
                                        <div class="footer_lnk_section_title">blog</div>
<!--                                        <div class="footer_lnk_section_lnk">professional</div>-->
<!--                                        <div class="footer_lnk_section_lnk">personal</div>-->
<!--                                        <div class="footer_lnk_section_lnk">heavenly</div>-->
                                    </div>
<!---->
<!--                                    <div class="footer_lnk_section_wrapper">-->
<!--                                        <div class="footer_lnk_section_title">work</div>-->
<!--                                        <div class="footer_lnk_section_lnk">highlights</div>-->
<!--                                        <div class="footer_lnk_section_lnk">experience</div>-->
<!--                                        <div class="footer_lnk_section_lnk">skills</div>-->
<!--                                        <div class="footer_lnk_section_lnk">resume</div>-->
<!--                                    </div>-->

                                </div>

                                <div class="cb_10"></div>
                                <div class="evifweb_logo"><?php echo $oCRNRSTN_USR->return_email_creative('5'); ?></div>
                            </div>
                        </div>
                        <div class="cb_20"></div>
                        <div class="hidden">
                            <div id="ajax_root"><?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="cb"></div>
        </div>
    </div>





        <div class="pillar_wrapper">

            <div class="pillar_boaz_locate pillar_boaz">
                <div class="bg_boaz_wrapper">
                    <div class="pillar_outer_border_boaz">
                        <div id="bg_effect_boaz" class="bg_effect_boaz bg_effect_pillar"></div>
                    </div>
                    <div class="cb"></div>
                </div>
            </div>

            <div class="pillar_jachin_locate pillar_jachin">
                <div class="bg_jachin_wrapper">
                    <div class="pillar_outer_border_jachin">
                        <div id="bg_effect_jachin" class="bg_effect_jachin bg_effect_pillar"></div>
                        <div class="cb"></div>
                    </div>
                    <div class="cb"></div>
                </div>
            </div>

        </div>

    </body>
    </html>

    <?php
}
?>