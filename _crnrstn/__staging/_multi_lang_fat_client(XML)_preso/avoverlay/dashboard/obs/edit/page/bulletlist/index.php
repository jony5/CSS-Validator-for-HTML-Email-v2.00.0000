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
$tmp_bulletpoint_count = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_BULLETS');
$tmp_component_id = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'cid');

$tmp_output_HTML='';
if($tmp_component_id!=''){
    $tmp_action = 'Update';
    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST');

    $tmp_bulletlist_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'BULLET_LIST_ID');
    $tmp_bulletlist_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'COMPONENT_ID');
    $tmp_bulletlist_bullet_style_ordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'BULLET_STYLE_ORDERED');
    $tmp_bulletlist_bullet_style_unordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'BULLET_STYLE_NOT_ORDERED');
    $tmp_bulletlist_isordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'ISORDERED');

    if($tmp_bulletlist_isordered == 1 || $tmp_bulletlist_isordered == '1'){
        $tmp_output_HTML .= '<ol type="'.$tmp_bulletlist_bullet_style_ordered.'" style="padding-top:0;margin-top:0;">';
        $tmp_output_HTML_ELEM_CLOSE = '</ol>';

        $tmp_list_style = $tmp_bulletlist_bullet_style_ordered;

    }else{
        $tmp_output_HTML .= '<ul  style="list-style-type:'.$tmp_bulletlist_bullet_style_unordered.'; padding-top:0;margin-top:0;">';
        $tmp_output_HTML_ELEM_CLOSE = '</ul>';
        $tmp_list_style = $tmp_bulletlist_bullet_style_unordered;

    }

}else{

    $tmp_action = 'Insert';
    $tmp_bulletlist_id = '';
    $tmp_bulletlist_component_id = '';
    $tmp_bulletlist_bullet_style_ordered = '';
    $tmp_bulletlist_bullet_style_unordered = '';
    $tmp_bulletlist_isordered = '';

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
        $oMiniNav = new miniNav('bullet_list_manage');
        $oMiniNav->configureLink('bullet_ordered', '#popupMenuBulletOrder');
        $oMiniNav->configureLink('bullet_style', '#popupMenuBulletStyle');
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
            <form action="#" method="post" name="insert_bullet_element" id="insert_bullet_element"  enctype="multipart/form-data" data-ajax="false">
                <input type="hidden" name="postid" id="postid" value="insert_bullet_element">
                <input type="hidden" name="action_type" id="action_type" value="">
                <input type="hidden" name="component_type_key" id="component_type_key" value="BULLET_LIST">
                <input type="hidden" name="overlay_fullscrn_page_id" id="overlay_fullscrn_page_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid')); ?>">
                <input type="hidden" name="overlay_fullscrn_profile_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid')); ?>">
                <input type="hidden" name="overlay_fullscrn_component_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'cid')); ?>">
                <input type="hidden" name="overlay_fullscrn_bulletlist_id" id="overlay_fullscrn_bulletlist_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bulletlist_id); ?>">
                <input type="hidden" name="overlay_fullscrn_bulletlist_bullet_id" id="overlay_fullscrn_bulletlist_bullet_id" value="">
                <input type="hidden" name="bulletlist_bullet_element_id" id="bulletlist_bullet_element_id" value="">
                <input type="hidden" name="bulletlist_bullet_bullet_id" id="bulletlist_bullet_bullet_id" value="">
                <input type="hidden" name="bulletlist_bullet_copy" id="bulletlist_bullet_copy" value="">
                <input type="hidden" name="bulletlist_bullet_style" id="bulletlist_bullet_style" value="">
                <input type="hidden" name="bulletlist_bullet_sequence" id="bulletlist_bullet_sequence" value="<?php echo $tmp_bulletpoint_count; ?>">
                <input type="hidden" name="bulletlist_bullet_text_bold" id="bulletlist_bullet_text_bold" value="">
                <input type="hidden" name="bulletlist_isordered" id="bulletlist_isordered" value="<?php echo $tmp_bulletlist_isordered; ?>">
                <input type="hidden" name="page_current_component_count" id="page_current_component_count" value="<?php echo $tmp_component_count; ?>">
                <input type="hidden" name="new_elem_lang_id" id="new_elem_lang_id" value="<?php echo strtolower($tmp_my_lang); ?>">
                <input type="hidden" name="bulletlist_isordered_RESTORE" id="bulletlist_isordered_RESTORE" value="">
                <input type="hidden" name="bulletlist_bullet_style_RESTORE" id="bulletlist_bullet_style_RESTORE" value="">
                <input type="hidden" name="bulletlist_delete" id="bulletlist_delete" value="">
                <input type="hidden" name="bulletlist_bullet_point_delete" id="bulletlist_bullet_point_delete" value="">
            </form>

            <div data-role="popup" id="popupConfirmAction" data-theme="b" data-dismissible="false" class="ui-content" style="max-width:400px;">
                <div data-role="header" data-theme="b">
                    <h1 id="popupConfirmAction_title" style="margin-right: 10%; margin-left: 10%;">Update Overlay?</h1>
                </div>
                <div role="main" class="ui-content">
                    <h3 id="confirm_title" class="ui-title">Are you sure you want to delete this bullet?</h3>
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

            <div data-role="popup" id="popupMenuAddABullet" data-theme="a" class="ui-content" data-dismissible="false">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label id="add_bullet_title_label" for="bullet_description" class="input">Add a Bullet Point:</label>
                <textarea cols="40" rows="12" name="bullet_description" id="bullet_description" placeholder="Enter bullet text..."></textarea>
                <div class="frm_errstatus bullet_description_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus bullet_description_invalid" style="width:100%; display:none;">Invalid bullet point content</div>
                <input type="checkbox" name="checkbox_copy_bold" id="checkbox_copy_bold" data-mini="true">
                <label for="checkbox_copy_bold">Strengthen Font with Boldness</label>

                <div class="cb_20"></div>
                <div id="oops_processComponentMod_saveBullet"></div>
                <div class="frm_errstatus oops_processComponentMod_saveBullet_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processComponentMod_saveBullet_invalid" style="width:100%; display:none;">Invalid</div>
                <div>
                    <div style="float:left;"><a href="#" data-rel="back" class="ui-btn ui-btn-inline" >CANCEL</a></div>
                    <div style="float:right;"><a href="#" class="ui-shadow ui-btn ui-corner-all" id="new_bullet_submit" onclick="processNewBullet();">SAVE</a></div>
                    <div class="cb"></div>
                </div>


                <div class="cb_5"></div>
                <div id="bullet_point_delete_wrapper" style="border:2px solid #FF2C21; padding:5px;margin:5px;">
                    <input type="checkbox" name="checkbox_bullet_delete" id="checkbox_bullet_delete" data-mini="true">
                    <label for="checkbox_bullet_delete">Delete this Bullet</label>
                </div>
            </div>

            <div data-role="popup" id="popupMenuBulletOrder" data-theme="a" data-dismissible="false" class="ui-content" style="max-width:400px;">
                <div data-role="header" data-theme="a">
                    <h1 style="margin-right: 10%; margin-left: 10%;">Update Bullet List?</h1>
                </div>
                <div role="main" class="ui-content">

                    <fieldset data-role="controlgroup">
                        <input class="radio_bullet_order" type="radio" name="radio_bulletlist_ordered" id="radio_bullet_ordered1" value="1" onclick="updateInputValue('input#bulletlist_isordered', '1');" <?php echo $oUSER->returnRadioChecked('1', $tmp_bulletlist_isordered, 'radio_bullet_ordered1'); ?>>
                        <label for="radio_bullet_ordered1">Ordered List</label>
                        <input class="radio_bullet_order" type="radio" name="radio_bulletlist_ordered" id="radio_bullet_ordered2" value="0" onclick="updateInputValue('input#bulletlist_isordered', '0');" <?php echo $oUSER->returnRadioChecked('0', $tmp_bulletlist_isordered, 'radio_bullet_ordered2'); ?>>
                        <label for="radio_bullet_ordered2">Unordered List</label>
                    </fieldset>

                    <div>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="resetPopupState('popupMenuBulletOrder', '<?php echo $oUSER->active_radio_id[$oUSER->default_selected_radio_val];  ?>');">Cancel</a>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false">Apply</a>

                    </div>
                </div>
            </div>

            <div data-role="popup" id="popupMenuBulletStyle" data-theme="a" data-dismissible="false" class="ui-content" style="max-width:400px;">
                <div data-role="header" data-theme="a">
                    <h1 style="margin-right: 10%; margin-left: 10%;">Update Bullet Style?</h1>
                </div>
                <div role="main" class="ui-content">

                    <?php

                    if($tmp_bulletlist_isordered==1 || $tmp_bulletlist_isordered=='1'){

                        ?>
                        <fieldset data-role="controlgroup">
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled11" value="circle" onclick="updateInputValue('input#bulletlist_bullet_style', '1');" <?php echo $oUSER->returnRadioChecked('1', $tmp_bulletlist_bullet_style_ordered, 'radio_bullet_styled111'); ?>>
                            <label for="radio_bullet_styled11">Basic Numbers</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled22" value="square" onclick="updateInputValue('input#bulletlist_bullet_style', 'A');" <?php echo $oUSER->returnRadioChecked('A', $tmp_bulletlist_bullet_style_ordered, 'radio_bullet_styled22'); ?>>
                            <label for="radio_bullet_styled22">Uppercase Letters</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled33" value="disc" onclick="updateInputValue('input#bulletlist_bullet_style', 'a');" <?php echo $oUSER->returnRadioChecked('a', $tmp_bulletlist_bullet_style_ordered, 'radio_bullet_styled33'); ?>>
                            <label for="radio_bullet_styled33">Lowercase Letters</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled44" value="none" onclick="updateInputValue('input#bulletlist_bullet_style', 'I');" <?php echo $oUSER->returnRadioChecked('I', $tmp_bulletlist_bullet_style_ordered, 'radio_bullet_styled44'); ?>>
                            <label for="radio_bullet_styled44">Uppercase Roman Numerals</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled55" value="none" onclick="updateInputValue('input#bulletlist_bullet_style', 'i');" <?php echo $oUSER->returnRadioChecked('i', $tmp_bulletlist_bullet_style_ordered, 'radio_bullet_styled55'); ?>>
                            <label for="radio_bullet_styled55">Lowercase Roman Numerals</label>
                        </fieldset>
                        <?php
                    }else{

                        ?>
                        <fieldset data-role="controlgroup">
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled1" value="circle" onclick="updateInputValue('input#bulletlist_bullet_style', 'circle');" <?php echo $oUSER->returnRadioChecked('circle', $tmp_bulletlist_bullet_style_unordered, 'radio_bullet_styled1'); ?>>
                            <label for="radio_bullet_styled1">Circle</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled2" value="square" onclick="updateInputValue('input#bulletlist_bullet_style', 'square');" <?php echo $oUSER->returnRadioChecked('square', $tmp_bulletlist_bullet_style_unordered, 'radio_bullet_styled2'); ?>>
                            <label for="radio_bullet_styled2">Square</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled3" value="disc" onclick="updateInputValue('input#bulletlist_bullet_style', 'disc');" <?php echo $oUSER->returnRadioChecked('disc', $tmp_bulletlist_bullet_style_unordered, 'radio_bullet_styled3'); ?>>
                            <label for="radio_bullet_styled3">Disc</label>
                            <input class="radio_bullet_style" type="radio" name="radio_bulletlist_style" id="radio_bullet_styled4" value="none" onclick="updateInputValue('input#bulletlist_bullet_style', 'none');" <?php echo $oUSER->returnRadioChecked('none', $tmp_bulletlist_bullet_style_unordered, 'radio_bullet_styled4'); ?>>
                            <label for="radio_bullet_styled4">Hide bullets</label>
                        </fieldset>
                        <?php
                    }
                    ?>

                    <div>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="resetPopupState('popupMenuBulletStyle', '<?php echo $oUSER->active_radio_id[$oUSER->default_selected_radio_val];  ?>');">Cancel</a>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false">Apply</a>

                    </div>
                </div>
            </div>


            <h2 style=" padding-bottom:0px; margin-bottom:0px;"><?php echo $tmp_action; ?> Bullet List</h2>
            <div class="cb_10"></div>


            <div>
                <div style="float:left;"><a href="#" class="ui-btn ui-btn-inline" onclick="newBulletPoint();">Add a bullet point</a></div>
                <?php
                if($tmp_component_id!=''){
                ?>
                <div style="float:right;"><a href="#" class="ui-btn ui-btn-inline" onclick="apply_OBSClientUpdate_Confirm('delete_bulletlist_authorize','','');">Delete List</a></div>
                <?php
                }
                ?>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>
            <hr class="stream_hr_dsh">
            <?php
            # $db_resp_target_profiles = 'COMPONENT_TYPES|LANG_PACKS|DE_COLORES
            #                           |FULLSCRN_PAGE|LANG_ELEM|PAGE_COMPONENTS|PAGE_SCHEDULES
            #                           |PAGE_DAYS|PAGE_EVENTS|BULLET_LIST|BULLET_BULLETS';       # ALIGN TO SELECTS WITHIN MULTI QUERY. ORDER DOES NOT MATTER...BUT SHOULD BE PARALLEL TO FIELD CNTS.


            //
            // DO WE HAVE A COMPONENT?
            if($tmp_component_id!=''){
                $tmp_output_HTML = '';
                echo '<div>
                <div><h3 style="padding-bottom:0;margin-bottom:5px;float:left;">Manage List Bullet Points</h3></div>
                <div style="float:right;"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?pid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid').'&oid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid').'" class="ui-btn ui-btn-inline" data-ajax="false">Done</a></div>
                <div class="cb"></div>
                </div>';

                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST');
                $tmp_bulletpoints_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_BULLETS');

                for($iii=0; $iii<$tmp_loop_size; $iii++){
                    $tmp_bulletlist_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'COMPONENT_ID', $iii);
                    $tmp_bulletlist_bullet_style_ordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'BULLET_STYLE_ORDERED', $iii);
                    $tmp_bulletlist_bullet_style_unordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'BULLET_STYLE_NOT_ORDERED', $iii);
                    $tmp_bulletlist_isordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_LIST', 'ISORDERED', $iii);

                    if($tmp_bulletlist_isordered == 1 || $tmp_bulletlist_isordered == '1'){
                        $tmp_output_HTML .= '<ol type="'.$tmp_bulletlist_bullet_style_ordered.'" style="padding-top:0;margin-top:0;">';
                        $tmp_output_HTML_ELEM_CLOSE = '</ol>';

                    }else{
                        $tmp_output_HTML .= '<ul  style="list-style-type:'.$tmp_bulletlist_bullet_style_unordered.'; padding-top:0;margin-top:0;">';
                        $tmp_output_HTML_ELEM_CLOSE = '</ul>';

                    }
                    if($tmp_bulletlist_component_id == $tmp_component_id){

                        //
                        // OUTPUT ALL BULLETS FOR THIS LIST
                        // LANG_PACK_DATA
                        echo $tmp_output_HTML;
                        for($i=0;$i<$tmp_bulletpoints_loop_size;$i++){
                            $tmp_bullet_bullet_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_BULLETS', 'BULLET_ID', $i);
                            $tmp_bullet_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_BULLETS', 'COMPONENT_ID', $i);
                            $tmp_bullet_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_BULLETS', 'ELEMENT_ID', $i);
                            $tmp_bullet_desc_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'BULLET_BULLETS', 'DESCRIPTION_IS_BOLD', $i);

                            $tmp_bullet_description = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM', $tmp_bullet_element_id, 'ELEMENT_CONTENT_BLOB');

                            $tmp_bullet_description = htmlentities($tmp_bullet_description);

                            if($tmp_bullet_component_id == $tmp_bulletlist_component_id){
                                if($tmp_bullet_desc_is_bold=='1'){

                                    echo '<li><div style="float:right; height:20px;"><a href="#" onclick="editBulletPoint(\''.$tmp_bullet_component_id.'\',\''.$tmp_bullet_bullet_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'\');">edit</a></div><div style="width:220px;"><strong>'.html_entity_decode($tmp_bullet_description).'</strong></div><div class="hidden"><input type="hidden" name="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'"><input type="hidden" name="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_desc_is_bold.'"><input type="hidden" name="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" id="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_description.'"><input type="hidden" name="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_element_id).'"></div></li>';
                                }else{

                                    echo '<li><div style="float:right; height:20px;"><a href="#" onclick="editBulletPoint(\''.$tmp_bullet_component_id.'\',\''.$tmp_bullet_bullet_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'\');">edit</a></div><div style="width:220px;">'.html_entity_decode($tmp_bullet_description).'</div><div class="hidden"><input type="hidden" name="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'"><input type="hidden" name="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_desc_is_bold.'"><input type="hidden" name="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" id="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_description.'"><input type="hidden" name="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_element_id).'"></div></li>';
                                }
                            }

                        }
                        echo $tmp_output_HTML_ELEM_CLOSE;

                    }

                }

            }

            ?>

            <div class="cb_20"></div>

            <script type="application/javascript" language="javascript">
                $( "#insert_bullet_element" ).submit(function( event ) {
                    //
                    // VALIDATE FORM
                    return validateForm('insert_bullet_element');
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