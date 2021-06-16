<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN';
$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR|TEXT_REQUIRED';
$tmp_lang_elem .= '|FINITE_EXP_YEAR|FINITE_EXP_YEARS|FINITE_EXP_Y|FINITE_EXP_WEEK|FINITE_EXP_WEEKS|FINITE_EXP_W|FINITE_EXP_DAY|FINITE_EXP_DAYS|FINITE_EXP_D|FINITE_EXP_HOUR|FINITE_EXP_HOURS|FINITE_EXP_H|FINITE_EXP_MINUTE|FINITE_EXP_MINUTES|FINITE_EXP_M|FINITE_EXP_SECOND|FINITE_EXP_SECONDS|FINITE_EXP_S|FINITE_EXP_AND|FINITE_EXP_AGO';
$oUSER->prepLangElem($tmp_lang_elem);

$oCRNRSTN_ENV->oFINITE_EXPRESS->configure_language($oUSER);       // THERE SHOULD BE NO DATABASE HIT INCURRED HERE. EITHER PASS IN OBJECT, ARRAY, OR STRING WITH NEEDED DATA.

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE RESPONSE OBJECT
$tmp_serial_handle = 'OBS_CLIENT_PROFILE_DATA';
$oDB_RESP = $oUSER->getOBSClientProfileData($tmp_serial_handle);

$tmp_obsclientid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBSCLIENT_ID');

$tmp_obs_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBS_ID');
$tmp_obs_id_display = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBS_ID_DISPLAY');
$tmp_obs_lastcontact = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'LAST_CONTACT');

$tmp_format_override = 'm.d.Y @ H:i:s';
$tmp_obsclient_lastcontact = $oCRNRSTN_ENV->oFINITE_EXPRESS->incarnate('ELAPSED', $tmp_obs_lastcontact, $tmp_format_override);

$tmp_curr_mini_display_mode = 'SLEEP Alternate';
$tmp_lang_pack_fs = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'CURRENT_LANG_PACK_FULLSCRN');
$tmp_lang_pack_m = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'CURRENT_LANG_PACK_MINI');

$tmp_lang_pack_fs = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $tmp_lang_pack_fs, 'NATIVE_NAME_BLOB');
$tmp_lang_pack_m = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $tmp_lang_pack_m, 'NATIVE_NAME_BLOB');

$tmp_fullscrn_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'FULLSCRN_PROFILE_ID');
$tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'MINI_PROFILE_ID');

$tmp_fullscrn_profile_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', $tmp_fullscrn_profile_id, 'PROFILE_NAME');
$tmp_mini_profile_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', $tmp_mini_profile_id, 'PROFILE_NAME');

$tmp_fullscrn_viewstate = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'FULLSCRN_VIEW_STATE');
$tmp_mini_viewstate = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'MINI_VIEW_STATE');

$tmp_timer_copy = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'CURRENT_WALL_TIME');

$tmp_timer_copy = $oUSER->bufferOverlayTime($tmp_timer_copy, $tmp_obs_lastcontact);

$tmp_fullscrn_visible = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'ISVISIBLE_FULLSCRN');
$tmp_mini_visible =  $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'ISVISIBLE_MINI');

$tmp_mini_display_mode =  $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'MINI_DISPLAY_MODE');

// $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', $tmp_fullscrn_profile_id, ''); 
// $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', $tmp_mini_profile_id, '');

if($tmp_fullscrn_viewstate=='false' || $tmp_fullscrn_viewstate==false){

    $tmp_copy_fullscrn_viewstate = 'hidden';

}else{

    $tmp_copy_fullscrn_viewstate = 'visible';

}

// temp_profile_param_array['master_overlay_visible_BOOL']+'|'+temp_profile_param_array['timer_overlay_visible_BOOL']+'|'+
// temp_profile_param_array['overlay_mode']+'|'+temp_profile_param_array['timer_mode'];
// true|true|FULL|RESET
list($tmp_mini_visible_viewstate, $tmp_mini_timer_visible_viewstate, $tmp_mini_overlaymode_viewstate, $tmp_mini_timermode_viewstate) = explode("|", $tmp_mini_viewstate);

if($tmp_mini_visible_viewstate=='false' || $tmp_mini_visible_viewstate==false){

    $tmp_copy_mini_visible_viewstate = 'hidden';

}else{

    $tmp_copy_mini_visible_viewstate = 'visible';

}

if($tmp_mini_timer_visible_viewstate=='false' || $tmp_mini_timer_visible_viewstate==false){

    $tmp_copy_mini_timer_visible_viewstate = 'hidden';

}else{

    $tmp_copy_mini_timer_visible_viewstate = 'visible';

}

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE") == "m" || $oCRNRSTN_ENV->getEnvParam('MOBILE_ONLY') == true){

    ?>

    <!DOCTYPE html>
    <html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
    <head>
        <?php
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
        ?>
    </head>

    <body>

    <div data-role="page" id="myPage">
        <?php
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');
        $oMiniNav = new miniNav('back');
        $oMiniNav->configureLink('back', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'/dashboard/obs/');
        //$oMiniNav->configureLink('streams', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'),true);
        //$oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/logs/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
        //$oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));

        $tmp_formUnique = $oUSER->generateNewKey(4);
        #$tmp_clientName_Header = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', 'COMPANYNAME_BLOB');
        #$tmp_clientName_Header = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'CLIENTS', $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'KIVOTOS', 'CLIENT_ID'), 'COMPANYNAME_BLOB');
        //$tmp_clientName_Header = "Atlanta";
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
        ?>

        <!--
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content">
            <div data-role="popup" id="popupEditFullScrnMenu" data-theme="a" class="ui-content">
                <input data-type="search" id="filterControlgroup-input-fullprofile">

                    <ul data-role="listview" data-inset="true" data-filter="true" data-input="#filterControlgroup-input-fullprofile" style="min-width:210px;">
                        <li data-role="list-divider">Select an overlay</li>

                            <?php

                            $tmp_ouput_HTML = '';
                            $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE');

                            for($iii=0; $iii<$tmp_loop_size; $iii++){
                                $tmp_profileid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'PROFILE_ID', $iii);
                                $tmp_profilename = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'PROFILE_NAME_BLOB', $iii);
                                $tmp_profiledate_created = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'DATECREATED', $iii);

                                if($tmp_profileid==$tmp_fullscrn_profile_id){
                                    //$tmp_checked = 'checked="checked"';

                                    $tmp_ouput_HTML = '<li id="elem_name_'.$tmp_profileid.'"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/fullscrn/?pid='.$tmp_profileid.'" style="color:#D91415;" data-ajax="false">'.$tmp_profilename.'</a></li>'.$tmp_ouput_HTML;

                                }else{
                                    //$tmp_checked = '';

                                    $tmp_ouput_HTML .=  '<li id="elem_name_'.$tmp_profileid.'"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/fullscrn/?pid='.$tmp_profileid.'" data-ajax="false">'.$tmp_profilename.'</a></li>';

                                }

                            ?>

                            <?php

                            }

                            echo $tmp_ouput_HTML;
                            ?>

                    </ul>
            </div>

            <div data-role="popup" id="popupEditMiniMenu" data-theme="a" class="ui-content">
                <input data-type="search" id="filterControlgroup-input-miniprofile">

                    <ul data-role="listview" data-inset="true" data-filter="true" data-input="#filterControlgroup-input-miniprofile" style="min-width:210px;">
                        <li data-role="list-divider">Select an overlay</li>

                            <?php

                            $tmp_ouput_HTML = '';
                            $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE');

                            for($iii=0; $iii<$tmp_loop_size; $iii++){
                                $tmp_profileid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_ID', $iii);
                                $tmp_profilename = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_NAME_BLOB', $iii);
                                $tmp_profiledate_created = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'DATECREATED', $iii);

                                if($tmp_profileid==$tmp_mini_profile_id){
                                    //$tmp_checked = 'checked="checked"';

                                    $tmp_ouput_HTML = '<li id="elem_name_'.$tmp_profileid.'"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/mini/?pid='.$tmp_profileid.'" style="color:#D91415;" data-ajax="false">'.$tmp_profilename.'</a></li>'.$tmp_ouput_HTML;

                                }else{
                                    //$tmp_checked = '';

                                    $tmp_ouput_HTML .=  '<li id="elem_name_'.$tmp_profileid.'"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/mini/?pid='.$tmp_profileid.'" data-ajax="false">'.$tmp_profilename.'</a></li>';

                                }

                            }

                            echo $tmp_ouput_HTML;
                            ?>

                    </ul>
            </div>

            <div id="obs_id" class="hidden"><?php echo $tmp_obs_id; ?></div>
            <h2 style=" padding-bottom:0px; margin-bottom:0px;"><?php echo $tmp_obs_id_display; ?></h2>
            <div class="cb_10"></div>
                <div data-role="collapsibleset" data-inset="true" id="collapsiblesetForProfiles">
                    <fieldset data-role="collapsible" <?php echo $oUSER->returnSectionOpenStatus('default'); ?>>
                        <legend>Current Status <span style="color:#FF0000; font-style:italic;">(LIVE)</span></legend>
                        <div id="admin_curr_status_content_wrapper">
                        <p>Last contact received <?php echo $tmp_obsclient_lastcontact;  ?></p>
                        <p>The full screen overlay is <?php echo $tmp_copy_fullscrn_viewstate;  ?>, and its
                            selected overlay profile is: <strong><i><?php echo $tmp_fullscrn_profile_name; ?></i></strong>.
                            It is showing <?php echo $tmp_lang_pack_fs; ?> content.</p>
                        <p>The mini overlay is <?php echo $tmp_copy_mini_visible_viewstate;  ?>. <strong><span id="timer_copy_admin"><?php echo $tmp_timer_copy;  ?></span></strong> is the
                            current time, and this is <?php echo $tmp_copy_mini_timer_visible_viewstate;  ?>. The selected mini overlay
                            profile is: <strong><i><?php echo $tmp_mini_profile_name; ?></i></strong>. It is loaded with <?php echo $tmp_lang_pack_m; ?> content,
                             is in <strong><?php echo $tmp_mini_overlaymode_viewstate; ?> mode</strong>, and is set to <strong><?php echo $tmp_curr_mini_display_mode; ?></strong>.</p>
                        </div>
                    </fieldset>
                    <fieldset data-role="collapsible" <?php echo $oUSER->returnSectionOpenStatus('manage_visibility_mode'); ?>>
                        <legend>Basic Controls</legend>

                        <?php
                        switch($tmp_fullscrn_visible){
                            case 1:
                            case '1':

                                echo '<input type="button" data-mini="true" value="Hide Full Screen Overlay" onclick="apply_OBSClientUpdate_Confirm(\'btn_hide_fullscrn_overlay\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_obsclientid).'\', this.value);">';

                            break;
                            default:

                                echo '<input type="button" data-mini="true" value="Show Full Screen Overlay" onclick="apply_OBSClientUpdate_Confirm(\'btn_show_fullscrn_overlay\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_obsclientid).'\', this.value);">';

                            break;

                        }

                        switch($tmp_mini_visible){
                            case 1:
                            case '1':

                                echo '<input type="button" data-mini="true" value="Hide Mini Overlay" onclick="apply_OBSClientUpdate_Confirm(\'btn_hide_mini_overlay\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_obsclientid).'\', this.value);">';

                            break;
                            default:

                                echo '<input type="button" data-mini="true" value="Show Mini Overlay" onclick="apply_OBSClientUpdate_Confirm(\'btn_show_mini_overlay\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_obsclientid).'\', this.value);">';

                            break;

                        }

                        ?>
                        <div class="cb_10"></div>
                        <div class="agg_element_hr"></div>
                        <div class="cb_10"></div>
                        <fieldset>
                            <legend>Select Mini Overlay Mode</legend>
                            <fieldset data-role="controlgroup">
                                <?php
                                // $tmp_mini_display_mode

                                ?>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0a" value="SCROLL" <?php echo $oUSER->returnRadioChecked('SCROLL', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('SCROLL',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0a">Horizontal Scrolling</label>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0b" value="FULL" <?php echo $oUSER->returnRadioChecked('FULL', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('FULL',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0b">Full Copy Display</label>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0c" value="SLEEP" <?php echo $oUSER->returnRadioChecked('SLEEP', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('SLEEP',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0c">SLEEP</label>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0d" value="SLEEP_ALT" <?php echo $oUSER->returnRadioChecked('SLEEP_ALT', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('SLEEP_ALT',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0d">SLEEP Alternating</label>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0e" value="SLEEP_SCROLL" <?php echo $oUSER->returnRadioChecked('SLEEP_SCROLL', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('SLEEP_SCROLL',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0e">SLEEP / Scrolling</label>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0f" value="SLEEP_FULL" <?php echo $oUSER->returnRadioChecked('SLEEP_FULL', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('SLEEP_FULL',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0f">SLEEP / Full Copy Display</label>
                                <input type="radio" name="radio-choice-v-0" id="radio-choice-v-0g" value="HIDDEN" <?php echo $oUSER->returnRadioChecked('HIDDEN', $tmp_mini_display_mode); ?> <?php echo $oUSER->returnConfirmOnclick('HIDDEN',$tmp_mini_display_mode,'radio_select_mini_display_mode', $tmp_obsclientid); ?>>
                                <label for="radio-choice-v-0g">Hidden</label>
                            </fieldset>
                        </fieldset>
                    </fieldset>

                    <?php
                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE');
                    $tmp_component_HTML = '';
                    $tmp_curr_profile = '';

                    for($iii=0; $iii<$tmp_loop_size; $iii++){
                        $tmp_profileid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'PROFILE_ID', $iii);
                        $tmp_profilename = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'PROFILE_NAME', $iii);
                        $tmp_profiledate_created = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'DATECREATED', $iii);

                        if($tmp_profileid==$tmp_fullscrn_profile_id){
                            //$tmp_checked = 'checked="checked"'

                            $tmp_component_HTML .= '<input class="full_screen_profile_selection" type="radio" name="radio_select_fullscrn_overlay_profile" id="radio-choice-v-'.$iii.'" value="'.$tmp_profileid.'" '.$oUSER->returnRadioChecked($tmp_profileid, $tmp_fullscrn_profile_id, 'radio-choice-v-'.$iii).'>
                            <label id="elem_name_'.$tmp_profileid.'" for="radio-choice-v-'.$iii.'">'.$tmp_profilename.'</label>';

                            $tmp_curr_profile = $tmp_profilename;

                        }else{
                            //$tmp_checked = '';

                            $tmp_component_HTML .= '<input class="full_screen_profile_selection" type="radio" name="radio_select_fullscrn_overlay_profile" id="radio-choice-v-'.$iii.'" value="'.$tmp_profileid.'" '.$oUSER->returnRadioChecked($tmp_profileid, $tmp_fullscrn_profile_id, "radio-choice-v-".$iii).' onclick="apply_OBSClientUpdate_Confirm(\'radio_select_fullscrn_overlay_profile\', \''.$tmp_obsclientid.'\', this.value);"> <label id="elem_name_'.$tmp_profileid.'" for="radio-choice-v-'.$iii.'">'.$tmp_profilename.'</label>';

                        }

                    }
                    ?>
                    <fieldset data-role="collapsible" <?php echo $oUSER->returnSectionOpenStatus('obs_client_profile_update_fullscrn'); ?>>
                        <legend>Full Screen :: <?php echo $tmp_curr_profile; ?></legend>
                        <div style="text-align: right;font-size:80%;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/new/fullscrn/?obs_cid='.$tmp_obsclientid; ?>" data-ajax="false">new</a>&nbsp;&nbsp; <a href="#popupEditFullScrnMenu" data-rel="popup" data-transition="slideup">edit</a></div>
                        <input data-type="search" id="filterControlgroup-input-full">

                            <fieldset data-role="controlgroup" data-filter="true" data-input="#filterControlgroup-input-full">
                                <?php

                                echo $tmp_component_HTML;
                                $tmp_component_HTML = '';

                                ?>

                            </fieldset>
                    </fieldset>
                    <fieldset data-role="collapsible" <?php echo $oUSER->returnSectionOpenStatus('obs_client_profile_update_mini'); ?>>
                        <legend>Mini :: []</legend>
                        <div style="text-align: right;font-size:80%;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/new/mini/?obs_cid='.$tmp_obsclientid; ?>" data-ajax="false">new</a>&nbsp;&nbsp; <a href="#popupEditMiniMenu" data-rel="popup" data-transition="slideup">edit</a></div>
                        <input data-type="search" id="filterControlgroup-input-mini">
                            <fieldset data-role="controlgroup" data-filter="true" data-input="#filterControlgroup-input-mini">
                                <?php

                                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE');

                                for($iii=0; $iii<$tmp_loop_size; $iii++){
                                    $tmp_profileid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_ID', $iii);
                                    $tmp_profilename = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'PROFILE_NAME', $iii);
                                    $tmp_profiledate_created = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_PROFILE', 'DATECREATED', $iii);

                                    if($tmp_profileid==$tmp_mini_profile_id){
                                        $tmp_checked = 'checked="checked"';
                                        ?>

                                        <input type="radio" name="radio_select_mini_overlay_profile" id="radio-choice-mini-<?php echo $iii; ?>" value="<?php echo $tmp_profileid;  ?>" <?php echo $tmp_checked;  ?>>
                                        <label id="elem_name_<?php echo $tmp_profileid;  ?>" for="radio-choice-mini-<?php echo $iii; ?>"><?php echo $tmp_profilename; ?></label>

                                        <?php
                                    }else{
                                        $tmp_checked = '';
                                        ?>

                                        <input type="radio" name="radio_select_mini_overlay_profile" id="radio-choice-mini-<?php echo $iii; ?>" value="<?php echo $tmp_profileid;  ?>" <?php echo $tmp_checked;  ?> onclick="apply_OBSClientUpdate_Confirm('radio_select_mini_overlay_profile', '<?php echo $tmp_obsclientid; ?>', this.value);">
                                        <label id="elem_name_<?php echo $tmp_profileid;  ?>" for="radio-choice-mini-<?php echo $iii; ?>"><?php echo $tmp_profilename; ?></label>

                                        <?php

                                    }

                                    ?>

                                    <?php

                                }
                                ?>
                            </fieldset>
                    </fieldset>
                    <fieldset data-role="collapsible">
                        <legend>Overlay Content Management</legend>
                        <p><strong>Current profile:</strong> Full Screen Overlay Content</p>
                        <p>Active language packs.</p>
                        <div class="cb_10"></div>
                        <div class="agg_element_hr"></div>
                        <div class="cb_10"></div>
                        <h5>Mini Overlay Content</h5>
                        <p>Active language packs.</p>

                    </fieldset>
                    <fieldset data-role="collapsible">
                        <legend>Full Screen :: Configuration</legend>
                        <p>Hello full screen config.</p>
                    </fieldset>
                    <fieldset data-role="collapsible">
                        <legend>Mini Overlay :: Configuration</legend>
                        <p>Hello mini config.</p>
                    </fieldset>

                </div>

            <div class="cb_20"></div>
            <div data-role="popup" id="popupConfirmAction" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
                <div data-role="header" data-theme="a">
                    <h1>Update Overlay?</h1>
                </div>
                <div role="main" class="ui-content">
                    <h3 id="confirm_title" class="ui-title">Are you sure you want to delete this page?</h3>
                    <p>This action will be applied immediately.</p>
                    <p id="popup_fullscrn_state_copy">Current full screen overlay visibility state :: <strong><?php echo strtoupper($tmp_copy_fullscrn_viewstate);  ?></strong></p>
                    <p id="popup_mini_state_copy">Current mini overlay visibility state :: <strong><?php echo strtoupper($tmp_copy_mini_visible_viewstate);  ?></strong></p>
                    <div id="confirm_anchors">
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" onclick="resetClientDashboardUIState('full_screen_profile_selection', '<?php echo $oUSER->active_radio_id[$oUSER->default_selected_radio_val];  ?>');">Cancel</a>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>
                    </div>
                    <div>
                        <form action="#" method="post" name="post_proxy_form" id="post_proxy_form"  enctype="multipart/form-data" data-ajax="false">
                            <input type="hidden" id="mini_display_mode" name="mini_display_mode" value="">
                            <input type="hidden" id="fullscrn_isvisible" name="fullscrn_isvisible" value="">
                            <input type="hidden" id="mini_isvisible" name="mini_isvisible" value="">
                            <input type="hidden" id="obs_id" name="obs_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_obs_id); ?>">
                            <input type="hidden" id="obsclient_id" name="obsclient_id" value="">
                            <input type="hidden" id="fullscrn_profile_id" name="fullscrn_profile_id" value="">
                            <input type="hidden" id="mini_profile_id" name="mini_profile_id" value="">
                            <input type="hidden" id="postid" name="postid" value="">
                            <input type="hidden" id="action_type" name="action_type" value="">

                        </form>

                    </div>
                </div>
            </div>

            <script>
                // popup examples
                $( document ).on( "pagecreate", function() {
                    // The window width and height are decreased by 30 to take the tolerance of 15 pixels at each side into account
                    function scale( width, height, padding, border ) {
                        var scrWidth = $( window ).width() - 30,
                            scrHeight = $( window ).height() - 30,
                            ifrPadding = 2 * padding,
                            ifrBorder = 2 * border,
                            ifrWidth = width + ifrPadding + ifrBorder,
                            ifrHeight = height + ifrPadding + ifrBorder,
                            h, w;
                        if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
                            w = ifrWidth;
                            h = ifrHeight;
                        } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
                            w = scrWidth;
                            h = ( scrWidth / ifrWidth ) * ifrHeight;
                        } else {
                            h = scrHeight;
                            w = ( scrHeight / ifrHeight ) * ifrWidth;
                        }
                        return {
                            'width': w - ( ifrPadding + ifrBorder ),
                            'height': h - ( ifrPadding + ifrBorder )
                        };
                    };

                    $( ".ui-popup iframe" )
                        .attr( "width", 0 )
                        .attr( "height", "auto" );

                });

            </script>


        </div><!-- /content -->


        <?php
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');

        ?>

    </div><!-- /page -->

    </body>
    </html>

    <?php
}else{
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
        ?>
    </head>

    <body>

    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
    ?>

    <main id="content">
        <div id="dashboard_content_shell">
            <div id="dashboard_page_title"><?php echo $oUSER->getLangElem('PAGE_TITLE_USER_SETTINGS'); ?></div>
            <div class="cb_10"></div>
            <div><?php echo $oUSER->getLangElem('PAGE_USER_SETTINGS_DESCR'); ?></div>
            <div class="cb_10"></div>
            <table>
                <tr>
                    <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/";  ?>" data-ajax="false">Back to Users</a></td>
                    <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/pwdreset/?uid=".$tmp_userData['USERID']; ?>">Reset Password</a></td>

                    <?php
                    if($tmp_userData['ISACTIVE']==6){
                        ?>
                        <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntunlock/?uid=".$tmp_userData['USERID']; ?>">Unlock Account</a></td>

                        <?php
                    }else{
                        ?>
                        <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/accntlock/?uid=".$tmp_userData['USERID']; ?>">Lock Account</a></td>

                        <?php
                    }
                    ?>
                    <td style="padding-right:10px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/delete/?uid=".$tmp_userData['USERID']; ?>" style="background-color:#F00; color:#FFF; padding:5px;">Delete Account</a></td>

                </tr>
            </table>
            <!--
            //
            // BEGIN MAIN CONTENT -->
            <div role="main" class="ui-content">
                <div class="ui-corner-all custom-corners">
                    <div class="ui-bar ui-bar-a">
                        <h4>Account Type</h4>
                    </div>
                    <div class="ui-body ui-body-a">
                        <p>
                            <?php
                            $tmp_userPermissionTypeArray = array('Basic Client Account' => 50,'Client Admin' => 100,
                                'Media' => 200,'Creative' => 300,'Technology' => 320, 'eCRM' => 325,
                                'Account Services' => 350,'Admin - Accnt Services' =>380,
                                'Finance' => 390, 'HR' => 395,
                                'Translation' => 405,'System Admin' => 410,'System Admin 420' => 420
                            );

                            ?>
                        <form action="#" method="post" name="edit_permissionType" id="edit_permissionType"  enctype="multipart/form-data" >
                            <select name="permissions_id" onChange="mycrnrstn_fhandler.evifweb_accountTypeSelect();">
                                <?php
                                foreach($tmp_userPermissionTypeArray as $tmp_type=>$tmp_id){
                                    if($tmp_id==$tmp_userData['USER_PERMISSIONS_ID']){
                                        $tmp_sel = "selected";
                                    }else{
                                        $tmp_sel = NULL;
                                    }
                                    ?>
                                    <option value="<?php echo $tmp_id; ?>" <?php echo $tmp_sel; ?>><?php echo $tmp_type; ?></option>

                                    <?php
                                }
                                ?>

                            </select>
                            <input type="hidden" name="postid" value="edit_permissionType">
                            <input type="hidden" name="uid" id="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                            <input type="hidden" name="fname" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                            <input type="hidden" name="lname" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
                        </form>

                        </p>

                    </div>
                </div>


                <div class="ui-corner-all custom-corners">
                    <div class="ui-bar ui-bar-a">
                        <h4>Account Information</h4>
                    </div>
                    <div class="ui-body ui-body-a">
                        <div class="copy"><strong><?php echo $oUSER->getLangElem('LABEL_LAST_LOGIN'); ?></strong> <span style="font-weight:normal;"><?php echo date("m.d.Y H:i:s", strtotime($tmp_userData['LASTLOGIN'])); ?></span></div>
                        <div class="copy"><strong>IP:</strong> <span style="font-weight:normal;"><?php echo $tmp_userData['LASTLOGIN_IP']; ?></span></div>

                        <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_FIRST_NAME'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['FIRSTNAME_BLOB']; ?></span></a></div>
                        <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_LAST_NAME'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['LASTNAME_BLOB']; ?></span></a></div>
                        <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_JOB_TITLE'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['JOBTITLE_BLOB']; ?></span></a></div>
                        <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_EMAIL'); ?>:</strong>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/edit/?uid=".$tmp_userData['USERID'];  ?>"><span style="font-weight:normal;"><?php echo $tmp_userData['EMAIL']; ?></span></a></div>
                        <div class="copy"><strong><?php echo $oUSER->getLangElem('INPUT_TITLE_ISO_CODE'); ?></strong>:&nbsp;<span style="font-weight:normal;"><?php echo $tmp_userData['LANGCODE']; ?></span></div>
                        <?php
                        if($tmp_userData['ISACTIVE']==5){
                            ?>
                            <div class="copy"><strong>Status:</strong> <span style="font-weight:normal;"><span class="the_R">Account not email verified.</span></div>

                            <?php
                        }

                        if(sizeof($tmp_clientData)>0){
                            ?>
                            <div class="copy"><strong>Approved Client Access</strong></div>

                            <?php
                        }
                        if(sizeof($tmp_clientData)>0){
                            $tmp_loop_size11 = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size11;$i++){
                                if($tmp_userClient[$tmp_clientData[$i]['CLIENT_ID']]==1){
                                    $tmp_clientFlag = 1;
                                    ?>
                                    <div class="copy"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?>&nbsp;<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/users/settings/accessdelete/?uid=".$tmp_userData['USERID']."&cid=".$tmp_clientData[$i]['CLIENT_ID'];  ?>" data-ajax="false">(remove access)</a></div>

                                    <?php
                                }
                            }
                        }

                        if(!isset($tmp_clientFlag)){
                            switch($tmp_userData['USER_PERMISSIONS_ID']){
                                case 420:
                                case 410:
                                case 380:
                                case 350:
                                case 320:
                                case 300:
                                case 200:
                                    echo '<div class="copy">Access to all clients.</div>';


                                    break;
                                default:
                                    echo '<div class="copy">No client access.</div>';

                                    break;

                            }

                        }


                        ?>

                        <div class="copy"><h4>Add Client Access</h4></div>
                        <form action="#" method="post" name="add_clientAccess" id="add_clientAccess"  enctype="multipart/form-data" >
                            <select name="clientToAccess" onChange="mycrnrstn_fhandler.evifweb_clientAccess_ADD();">
                                <option value="" selected>Select Client</option>
                                <option value="ALL">All Clients</option>

                                <?php
                                if(sizeof($tmp_clientData)>0){
                                    $tmp_loop_size35 = sizeof($tmp_clientData);
                                    for($i=0;$i<$tmp_loop_size35;$i++){
                                        ?>
                                        <option value="<?php echo $tmp_clientData[$i]['CLIENT_ID'];  ?>"><?php echo $tmp_clientData[$i]['COMPANYNAME_BLOB']; ?></option>
                                        <?php
                                    }
                                }

                                ?>
                            </select>
                            <input type="hidden" name="postid" value="add_clientAccess">
                            <input type="hidden" name="uid" value="<?php echo $tmp_userData['USERID']; ?>">
                            <input type="hidden" name="user_permissions_id" value="<?php echo $tmp_userData['USER_PERMISSIONS_ID']; ?>">
                            <input type="hidden" name="fname" value="<?php echo $tmp_userData['FIRSTNAME_BLOB']; ?>">
                            <input type="hidden" name="lname" value="<?php echo $tmp_userData['LASTNAME_BLOB']; ?>">
                        </form>
                        <div class="cb_20"></div>

                    </div>
                </div>

            </div><!-- /content -->

        </div>
    </main>

    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
    ?>
    </body>
    </html>
    <?php
}
?>