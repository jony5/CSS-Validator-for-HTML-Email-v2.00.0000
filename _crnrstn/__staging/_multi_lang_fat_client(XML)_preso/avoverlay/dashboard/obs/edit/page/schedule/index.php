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
$tmp_serial_handle = 'OBS_FULLSCRN_PAGE_DATA';
$oDB_RESP = $oUSER->getOBSFullScrnPageData($tmp_serial_handle);

$tmp_component_count = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_COMPONENTS');
$tmp_component_id = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'cid');

if($tmp_component_id!=''){
    $tmp_action = 'Update';

    $tmp_event_date_format = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_SCHEDULES', 'DATE_FORMAT');
    $tmp_event_time_format = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_SCHEDULES', 'TIME_FORMAT');

    switch($tmp_event_time_format){
        case 'H:i':
        case 'Hi':
            $tmp_time_format = '24';
        break;
        default:
            $tmp_time_format = '12';
        break;

    }

}else{

    $tmp_action = 'Insert';
    $tmp_event_date_format = '';
    $tmp_event_time_format = '';
    $tmp_time_format = '';

}

$tmp_my_lang = strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE"));

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
        //$oMiniNav->configureLink('page_bgcolor', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
        //$oMiniNav->configureLink('page_bgopacity', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'),true);
        //$oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/logs/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
        $oMiniNav->configureLink('back', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?pid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid').'&oid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid'));

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
            <form action="#" method="post" name="insert_schedule_element" id="insert_schedule_element"  enctype="multipart/form-data" data-ajax="false">
                <input type="hidden" name="postid" id="postid" value="insert_schedule_element">
                <input type="hidden" name="action_type" id="action_type" value="">
                <input type="hidden" name="component_type_key" id="component_type_key" value="SCHEDULE">
                <input type="hidden" name="overlay_fullscrn_page_id" id="overlay_fullscrn_page_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid')); ?>">
                <input type="hidden" name="overlay_fullscrn_profile_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid')); ?>">
                <input type="hidden" name="overlay_fullscrn_schedule_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_SCHEDULES', $tmp_component_id, 'SCHEDULE_ID')); ?>">
                <input type="hidden" name="overlay_fullscrn_component_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'cid')); ?>">
                <input type="hidden" name="overlay_fullscrn_schedule_day_id" id="overlay_fullscrn_schedule_day_id" value="">
                <input type="hidden" name="overlay_fullscrn_schedule_event_id" id="overlay_fullscrn_schedule_event_id" value="">
                <input type="hidden" name="schedule_date_format_en" id="schedule_date_format_en" value="">
                <input type="hidden" name="schedule_date_format" id="schedule_date_format" value="">
                <input type="hidden" name="schedule_time_format" id="schedule_time_format" value="">
                <input type="hidden" name="schedule_time_format_en" id="schedule_time_format_en" value="">
                <input type="hidden" name="schedule_date_day" id="schedule_date_day" value="">
                <input type="hidden" name="schedule_date_month" id="schedule_date_month" value="">
                <input type="hidden" name="schedule_date_year" id="schedule_date_year" value="">
                <input type="hidden" name="schedule_event_hour" id="schedule_event_hour" value="">
                <input type="hidden" name="schedule_event_minute" id="schedule_event_minute" value="">
                <input type="hidden" name="schedule_event_ampm" id="schedule_event_ampm" value="">
                <input type="hidden" name="schedule_event_element_id" id="schedule_event_element_id" value="">
                <input type="hidden" name="schedule_event_description" id="schedule_event_description" value="">
                <input type="hidden" name="schedule_event_description_bold" id="schedule_event_description_bold" value="">
                <input type="hidden" name="schedule_event_delete" id="schedule_event_delete" value="">
                <input type="hidden" name="schedule_day_delete" id="schedule_day_delete" value="">
                <input type="hidden" name="page_current_component_count" id="page_current_component_count" value="<?php echo $tmp_component_count; ?>">
                <input type="hidden" name="new_elem_lang_id" id="new_elem_lang_id" value="<?php echo strtolower($tmp_my_lang); ?>">
            </form>
            <div data-role="popup" id="popupConfirmAction" data-theme="b" data-dismissible="false" class="ui-content" style="max-width:400px;">
                <div data-role="header" data-theme="b">
                    <h1 id="popupConfirmAction_title" style="margin-right: 10%; margin-left: 10%;">Update Overlay?</h1>
                </div>
                <div role="main" class="ui-content">
                    <h3 id="confirm_title" class="ui-title">Are you sure you want to delete this page?</h3>
                    <p id="confirm_apply_copy">This action will be applied immediately.</p>
                    <div id="confirm_anchors">
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>

                        <form action="#" method="post" name="post_proxy_form" id="post_proxy_form"  enctype="multipart/form-data" data-ajax="false">
                            <input type="hidden" id="mini_display_mode" name="mini_display_mode" value="">
                            <input type="hidden" id="fullscrn_isvisible" name="fullscrn_isvisible" value="">
                            <input type="hidden" id="mini_isvisible" name="mini_isvisible" value="">
                            <input type="hidden" id="obs_id" name="obs_id" value="">
                            <input type="hidden" id="obsclient_id" name="obsclient_id" value="">
                            <input type="hidden" id="fullscrn_profile_id" name="fullscrn_profile_id" value="">
                            <input type="hidden" id="mini_profile_id" name="mini_profile_id" value="">
                            <input type="hidden" id="postid" name="postid" value="">

                        </form>

                    </div>
                </div>
            </div>
            <div data-role="popup" id="popupMenuDateFormat" data-theme="b" class="ui-content">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label for="select_choice_date_format" class="select">Select Date Format:</label>
                <select name="select_choice_date_format" id="select_choice_date_format" data-mini="true" data-inline="true" onblur="updateScheduleDateFormat(this);">
                    <option value="l, F j, Y" <?php echo $oUSER->returnDropDownSelected('l, F j, Y', $tmp_event_date_format); ?>><?php echo date('l, F j, Y'); ?></option>
                    <option value="l, M j, Y" <?php echo $oUSER->returnDropDownSelected('l, M j, Y', $tmp_event_date_format); ?>><?php echo date('l, M j, Y'); ?></option>
                    <option value="D, F j, Y" <?php echo $oUSER->returnDropDownSelected('D, F j, Y', $tmp_event_date_format); ?>><?php echo date('D, F j, Y'); ?></option>
                    <option value="D, M j, Y" <?php echo $oUSER->returnDropDownSelected('D, M j, Y', $tmp_event_date_format); ?>><?php echo date('D, M j, Y'); ?></option>
                    <option value="l, F j" <?php echo $oUSER->returnDropDownSelected('l, F j', $tmp_event_date_format); ?>><?php echo date('l, F j'); ?></option>
                    <option value="D, F j" <?php echo $oUSER->returnDropDownSelected('D, F j', $tmp_event_date_format); ?>><?php echo date('D, F j'); ?></option>
                    <option value="F j, Y" <?php echo $oUSER->returnDropDownSelected('F j, Y', $tmp_event_date_format); ?>><?php echo date('F j, Y'); ?></option>
                    <option value="M j, Y" <?php echo $oUSER->returnDropDownSelected('M j, Y', $tmp_event_date_format); ?>><?php echo date('M j, Y'); ?></option>
                    <option value="F j" <?php echo $oUSER->returnDropDownSelected('F j', $tmp_event_date_format); ?>><?php echo date('F j'); ?></option>
                    <option value="M j" <?php echo $oUSER->returnDropDownSelected('M j', $tmp_event_date_format); ?>><?php echo date('M j'); ?></option>
                </select>
                <div class="cb"></div>
                <div id="oops_processComponentMod_dateform"></div>
                <div class="frm_errstatus oops_processComponentMod_dateform_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processComponentMod_dateform_invalid" style="width:100%; display:none;">Invalid</div>
                <div class="cb_5"></div>
            </div>

            <div data-role="popup" id="popupMenuTimeFormat" data-theme="b" class="ui-content">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label for="select_choice_time_format" class="select">Select Time Format:</label>
                <select name="select_choice_time_format" id="select_choice_time_format" data-mini="true" data-inline="true" onblur="updateScheduleTimeFormat(this);">
                    <option value="g:i A" <?php echo $oUSER->returnDropDownSelected('g:i A', $tmp_event_time_format); ?>><?php echo $oUSER->returnFormattedTimeCopy('g:i A', date('Y-m-d H:i:s', time())); ?></option>
                    <option value="g:i A.." <?php echo $oUSER->returnDropDownSelected('g:i A..', $tmp_event_time_format); ?>><?php echo $oUSER->returnFormattedTimeCopy('g:i A..', date('Y-m-d H:i:s', time())); ?></option>
                    <option value="g:i a" <?php echo $oUSER->returnDropDownSelected('g:i a', $tmp_event_time_format); ?>><?php echo $oUSER->returnFormattedTimeCopy('g:i a', date('Y-m-d H:i:s', time())); ?></option>
                    <option value="g:i a.." <?php echo $oUSER->returnDropDownSelected('g:i a..', $tmp_event_time_format); ?>><?php echo $oUSER->returnFormattedTimeCopy('g:i a..', date('Y-m-d H:i:s', time())); ?></option>
                    <option value="H:i" <?php echo $oUSER->returnDropDownSelected('H:i', $tmp_event_time_format); ?>><?php echo $oUSER->returnFormattedTimeCopy('H:i', date('Y-m-d H:i:s', time())); ?></option>
                    <option value="Hi" <?php echo $oUSER->returnDropDownSelected('Hi', $tmp_event_time_format); ?>><?php echo $oUSER->returnFormattedTimeCopy('Hi', date('Y-m-d H:i:s', time())); ?></option>
                </select>
                <div class="cb"></div>
                <div id="oops_processComponentMod_timeform"></div>
                <div class="frm_errstatus oops_processComponentMod_timeform_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processComponentMod_timeform_invalid" style="width:100%; display:none;">Invalid</div>
                <div class="cb_5"></div>

            </div>

            <div data-role="popup" id="popupMenuAddADay" data-theme="b" class="ui-content">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label id="add_day_title_label" for="select-choice-year" class="select">Add a Day:</label>
                <select name="select-choice-year" id="select-choice-year" data-mini="true" data-inline="true" onblur="scheduleSelectDateElem('YEAR', this);">
                    <option value="">Select Year</option>
                    <?php

                    $tmp_year = date('Y');

                    $tmp_year -= 4;

                    for($i=0;$i<15;$i++){
                        $tmp_year += 1;
                        echo '<option value="'.$tmp_year.'">'.$tmp_year.'</option>';

                    }

                    ?>
                </select>

                <div class="cb_10"></div>
                <div style="float:left; padding-top: 5px;"><select name="select-choice-month" id="select-choice-month" data-mini="true" data-inline="true" onblur="scheduleSelectDateElem('MONTH', this);">
                    <option value="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select></div>
                <div style="float:left; padding-top: 5px;">
                    <select name="select-choice-day" id="select-choice-day" data-mini="true" data-inline="true" onblur="scheduleSelectDateElem('DAY', this);">
                        <option value="">Select Day</option>
                        <?php
                        for($i=1;$i<32;$i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';

                        }

                        ?>
                    </select></div>
                <div class="cb_10"></div><div id="oops_processComponentMod"></div>
                <div class="frm_errstatus oops_processComponentMod_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processComponentMod_invalid" style="width:100%; display:none;">Invalid</div>
                <div class="cb"></div>
                <div style="min-width:220px;">

                    <div style="float:left; padding-left: 10px;"><a href="#" data-rel="back" class="ui-btn ui-btn-inline" >CANCEL</a></div>

                    <div style="float:right; padding-right: 10px;"><a href="#" id="add_schedule_day_ui_btn" class="ui-btn ui-btn-inline ui-state-disabled" onclick="processComponentMod('insert_schedule_element',this);">ADD</a></div>



                    <div class="cb_5"></div>
                    <div id="schedule_day_delete_wrapper" style="border:2px solid #FF2C21; padding:5px;margin:5px;">
                        <input type="checkbox" name="checkbox_day_delete" id="checkbox_day_delete" data-mini="true">
                        <label for="checkbox_day_delete">Delete this Day</label>
                    </div>
                </div>
            </div>

            <div data-role="popup" id="popupMenuAddAnEvent" data-theme="a" class="ui-content" data-dismissible="false">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label for="slider_hour">Hour of day for this event:</label>
                <?php
                if($tmp_time_format == '24'){

                    echo '<input type="range" name="slider_hour" id="slider_hour" data-highlight="true" min="1" max="24" value="16">';

                }else{

                    echo '<input type="range" name="slider_hour" id="slider_hour" data-highlight="true" min="1" max="12" value="4">';

                }
                ?>

                <label for="slider_minute">Minute:</label>
                <input type="range" name="slider_minute" id="slider_minute" data-highlight="true" min="0" max="59" value="20">

                <?php
                if($tmp_time_format == '12') {
                    ?>
                    <select name="sliderAMPM" id="sliderAMPM" data-role="slider">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <?php
                }
                ?>

                <textarea cols="40" rows="8" name="event_description" id="event_description" placeholder="Enter event description..."></textarea>
                <div class="frm_errstatus event_description_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus event_description_invalid" style="width:100%; display:none;">Invalid description content</div>
                <input type="checkbox" name="checkbox_copy_bold" id="checkbox_copy_bold" data-mini="true">
                <label for="checkbox_copy_bold">Strengthen Font with Boldness</label>

                <div class="cb_20"></div>

                <div id="oops_processComponentMod_saveEvent"></div>
                <div class="frm_errstatus oops_processComponentMod_saveEvent_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processComponentMod_saveEvent_invalid" style="width:100%; display:none;">Invalid</div>
                <div class="cb"></div>
                <a href="#" class="ui-shadow ui-btn ui-corner-all" id="new_event_submit" onclick="processNewEvent();">SAVE</a>


                <div class="cb_5"></div>
                <div id="schedule_event_delete_wrapper" style="border:2px solid #FF2C21; padding:5px;margin:5px;">
                    <input type="checkbox" name="checkbox_event_delete" id="checkbox_event_delete" data-mini="true" onclick="apply_OBSClientUpdate_Confirm('chkbx_delete_schedule_event', 'checkbox_event_delete', this)">
                    <label for="checkbox_event_delete">Delete this Event</label>
                </div>


                <?php

                $tmp_output_HTML = '';
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');

                for($iii=0; $iii<$tmp_loop_size; $iii++){
                    $tmp_langid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $iii);
                    $tmp_langname = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'NATIVE_NAME_BLOB', $iii);
                    $tmp_langname_en = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'NAME', $iii);

                    $tmp_checked = $oUSER->returnRadioChecked($tmp_langid, $tmp_my_lang);

                    if($tmp_langid==$tmp_my_lang){
                        $tmp_my_langid = $tmp_langid;
                        $tmp_my_langname = $tmp_langname;
                        $tmp_my_langname_en = $tmp_langname_en;

                        $tmp_output_HTML .= '<option value="'.$tmp_langid.'" checked="checked">'.$tmp_langname.'</option>';

                    }else{
                        $tmp_output_HTML .= '<option value="'.$tmp_langid.'">'.$tmp_langname.'</option>';

                    }


                }

                $tmp_prefix = '<div>
                <div style="float:left; padding-top:10px;"><label for="select_lang_id" class="select">Change:</label></div>
                <div style="float:left;"><select name="select_lang_id" id="select_lang_id" data-mini="true" data-inline="true" onchange="updateLangInputValue(\'input#new_elem_lang_id\', this.value);">
                ';

                $tmp_output_HTML = $tmp_prefix.$tmp_output_HTML.'</select></div><div class="cb"></div>
                </div>';

                ?>
                <p>The language that I entered<br>above is <span id="lang_input_to_copy_value"><strong><?php echo $tmp_my_langname; ?></strong> (<?php echo $tmp_my_langname_en; ?>)</span>.
                <?php
                echo $tmp_output_HTML;
                ?>

            </div>

            <h2 style=" padding-bottom:0px; margin-bottom:0px;"><?php echo $tmp_action; ?> Schedule</h2>
            <div class="cb_10"></div>


            <div>
                <div style="float:left;"><a href="#" class="ui-btn ui-btn-inline" onclick="newScheduleDay();">Add a day</a></div>
                <?php
                if($tmp_component_id!=''){
                ?>
                <div style="float:right;"><a href="#" class="ui-btn ui-btn-inline" onclick="apply_OBSClientUpdate_Confirm('delete_schedule_authorize','','');">Delete Schedule</a></div>
                <?php
                }
                ?>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>
            <hr class="stream_hr_dsh">
            <?php
            # $db_resp_target_profiles = 'FULLSCRN_PAGE|LANG_PACKS|DE_COLORES|RAW_ELEM_COPY|
            #                           PAGE_COMPONENTS|PAGE_SCHEDULES|PAGE_DAYS|PAGE_EVENTS|
            #                           COMPONENT_TYPES|LANG_PACK_DATA';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.


            // DO WE HAVE A SCHEDULE?
            if($tmp_component_id!=''){
                echo '
                <p>Date Format:<br/>
                    <strong><span id="curr_date_display_format">'.date($tmp_event_date_format, time()).'</span></strong>&nbsp;&nbsp;<a href="#popupMenuDateFormat" data-rel="popup" data-transition="slideup">edit</a>
                </p>
    
                <p>Time Format:<br/>
                    <strong><span id="curr_time_display_format">'.$oUSER->returnFormattedTimeCopy($tmp_event_time_format, date("Y-m-d H:i:s", time())).'</span></strong>&nbsp;&nbsp;<a href="#popupMenuTimeFormat" data-rel="popup" data-transition="slideup">edit</a>
                </p>
                
                <div>
                    <div><h3 style="padding-bottom:0;margin-bottom:5px;float:left;">Manage Days in Schedule</h3></div>
                    <div style="float:right;"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?pid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid').'&oid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid').'" class="ui-btn ui-btn-inline" data-ajax="false">Done</a></div>
                    <div class="cb"></div>
                </div>
                
                ';

                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS');
                $tmp_events_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS');

                for($iii=0; $iii<$tmp_loop_size; $iii++){
                    $tmp_day_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS', 'COMPONENT_ID', $iii);
                    $tmp_day_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS', 'DAY_ID', $iii);
                    $tmp_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS', 'DATE', $iii);
                    $tmp_day = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS', 'DAY_DAY', $iii);
                    $tmp_month = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS', 'DAY_MONTH', $iii);
                    $tmp_year = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_DAYS', 'DAY_YEAR', $iii);

                    if($tmp_day_component_id==$tmp_component_id){


                        if($iii==0){

                            $tmp_day_padding_top = 'padding-top:0;';
                        }else{

                            $tmp_day_padding_top = 'padding-top:10px;';
                        }

                        echo '<div><div style="float:left;"><h4 style="'.$tmp_day_padding_top.'margin-top:0;padding-bottom:0;margin-bottom:0;">'.date($tmp_event_date_format, strtotime($tmp_date)).'</h4></div><div style="float:left; padding-left: 10px;'.$tmp_day_padding_top.'"><a href="#" onclick="editScheduleDay(\''.$tmp_day_component_id.'\',\''.$tmp_day_id.'\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_day_id).'\');">edit</a></div><div class="hidden"><input type="hidden" id="silent_event_select_year_'.$tmp_day_id.'" value="'.$tmp_year.'"><input type="hidden" id="silent_event_select_month_'.$tmp_day_id.'" value="'.$tmp_month.'"><input type="hidden" id="silent_event_select_day_'.$tmp_day_id.'" value="'.$tmp_day.'"></div><div class="cb"></div></div><a href="#" data-rel="popup" data-transition="slideup" onclick="setScheduleDayFocus(\'new_schedule_event\',\''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_day_id).'\')">Add an event</a>';

                        //
                        // OUTPUT ALL EVENTS FOR THIS DAY
                        // LANG_PACK_DATA
                        echo '<div>';
                        for($i=0;$i<$tmp_events_loop_size;$i++){
                            $tmp_event_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS', 'COMPONENT_ID', $i);
                            $tmp_event_event_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS', 'EVENT_ID', $i);
                            $tmp_event_day_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS', 'DAY_ID', $i);
                            $tmp_event_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS', 'ELEMENT_ID', $i);
                            $tmp_event_desc_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS', 'DESCRIPTION_IS_BOLD', $i);
                            $tmp_event_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PAGE_EVENTS', 'DATE', $i);

                            $tmp_ampm = date('A', strtotime($tmp_event_date));

                            if($tmp_time_format=='12'){
                                $tmp_hour = date('g', strtotime($tmp_event_date));

                            }else{
                                $tmp_hour = date('G', strtotime($tmp_event_date));

                            }

                            $tmp_minute = date('i', strtotime($tmp_event_date));

                            $tmp_event_description = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM', $tmp_event_element_id, 'ELEMENT_CONTENT_BLOB');

                            if($tmp_event_day_id==$tmp_day_id){
                                if($tmp_event_desc_is_bold=='1'){

                                    echo '<div style="float:left; padding-right: 10px; min-width:70px;"><strong>'.$oUSER->returnFormattedTimeCopy($tmp_event_time_format, $tmp_event_date).'</strong></div><div style="float:left; padding-right:10px; width:180px;"><strong>'.$tmp_event_description.'</strong></div><div style="float:left;"><a href="#" onclick="setScheduleDayFocus(\'edit_schedule_event\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_event_day_id).'\'); editScheduleEvent(\''.$tmp_event_component_id.'\', \''.$tmp_event_event_id.'\');">edit</a></div><div class="hidden"><input type="hidden" name="silent_event_element_id_'.$tmp_event_event_id.'" id="silent_event_element_id_'.$tmp_event_event_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_event_element_id).'"><input type="hidden" name="silent_event_bold_'.$tmp_event_event_id.'" id="silent_event_bold_'.$tmp_event_event_id.'" value="'.$tmp_event_desc_is_bold.'"><input type="hidden" name="silent_event_ampm_'.$tmp_event_event_id.'" id="silent_event_ampm_'.$tmp_event_event_id.'" value="'.$tmp_ampm.'"><input type="hidden" name="silent_event_description_'.$tmp_event_event_id.'" id="silent_event_description_'.$tmp_event_event_id.'" value="'.$tmp_event_description.'"></div><div id="event_minute_'.$tmp_event_event_id.'" class="hidden">'.$tmp_minute.'</div><div id="event_hour_'.$tmp_event_event_id.'" class="hidden">'.$tmp_hour.'</div><div class="cb"></div>';
                                }else{

                                    echo '<div style="float:left; padding-right: 10px; min-width:70px;"><strong>'.$oUSER->returnFormattedTimeCopy($tmp_event_time_format, $tmp_event_date).'</strong></div><div style="float:left; padding-right:10px; width:180px;">'.$tmp_event_description.'</div><div style="float:left;"><a href="#" onclick="setScheduleDayFocus(\'edit_schedule_event\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_event_day_id).'\'); editScheduleEvent(\''.$tmp_event_component_id.'\',  \''.$tmp_event_event_id.'\');">edit</a></div><div class="hidden"><input type="hidden" name="silent_event_element_id_'.$tmp_event_event_id.'" id="silent_event_element_id_'.$tmp_event_event_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_event_element_id).'"><input type="hidden" name="silent_event_bold_'.$tmp_event_event_id.'" id="silent_event_bold_'.$tmp_event_event_id.'" value="'.$tmp_event_desc_is_bold.'"><input type="hidden" name="silent_event_ampm_'.$tmp_event_event_id.'" id="silent_event_ampm_'.$tmp_event_event_id.'" value="'.$tmp_ampm.'"><input type="hidden" name="silent_event_description_'.$tmp_event_event_id.'" id="silent_event_description_'.$tmp_event_event_id.'" value="'.$tmp_event_description.'"></div><div id="event_minute_'.$tmp_event_event_id.'" class="hidden">'.$tmp_minute.'</div><div id="event_hour_'.$tmp_event_event_id.'" class="hidden">'.$tmp_hour.'</div><div class="cb"></div>';
                                }
                            }

                        }
                        echo '</div>';


                    }


                }

            }

            ?>

            <div class="cb_20"></div>


            <div class="cb_20"></div>

            <script type="application/javascript" language="javascript">
                $( "#insert_schedule_element" ).submit(function( event ) {
                    //
                    // VALIDATE FORM
                    return validateForm('insert_schedule_element');
                });

            </script>

            <script type="application/javascript" language="javascript">
                $( "#insert_schedule_element" ).submit(function( event ) {
                    //
                    // VALIDATE FORM
                    return validateForm('insert_schedule_element');
                });

            </script>


            <script type="application/javascript" language="javascript">
                $( "#new_schedule_element" ).submit(function( event ) {
                    //
                    // VALIDATE FORM
                    return validateForm('new_schedule_element');
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