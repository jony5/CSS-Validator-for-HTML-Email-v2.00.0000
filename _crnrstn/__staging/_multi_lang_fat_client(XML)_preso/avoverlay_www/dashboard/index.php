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
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP';
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE RESPONSE OBJECT
$tmp_serial_handle = 'TRANSLATION_DATA';
$oDB_RESP = $oUSER->getTranslationData($tmp_serial_handle);

//
// PROCESS USERS AND USER-ACCESS INTO USABLE DATA FORMAT
// MODIFY KEYDATABYID TO PERFORM N+1 DIM KEYING...
#$oDB_RESP->keyDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID');

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE") == "m" ||  $oCRNRSTN_ENV->getEnvParam('MOBILE_ONLY') == true){
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

	switch($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')){
        case '420':
            //
            // AV SERVICE SAINT
            $oMiniNav = new miniNav('avservice_saint');
            //$oMiniNav->configureLink('streams', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
            $oMiniNav->configureLink('obs clients', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/');
            $oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/logs/');
            $oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');

        break;
        case '320':
            //
            // SAINT SERVING TRANSLATION
            $oMiniNav = new miniNav('translation_saint');
            //$oMiniNav->configureLink('streams', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/streams/?kid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid'));
            $oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/logs/');
            $oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');

            break;

    }

	$tmp_formUnique = $oUSER->generateNewKey(4);
    $tmp_clientName_Header = '<a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/?uid=" data-ajax="false" style="text-decoration:none;">'.$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FIRSTNAME').' '.$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('LASTNAME').'</a>';
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');

	$cnt_MAX_MINISTRY_ELEM_4_TRANSLATE = 0;
    $cnt_MAX_CMS_ELEM_4_TRANSLATE = 0;
    $cnt_MAX_DRAFT_ELEM_4_APPROVE = 0;

    $tmp_userid = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID');
    $tmp_max_loop_size_MINISTRY_ELEMENTS = $oCRNRSTN_ENV->getEnvParam('MAX_MINISTRY_ELEM_4_TRANSLATE');
    $tmp_max_loop_size_CMS_ELEMENTS = $oCRNRSTN_ENV->getEnvParam('MAX_CMS_ELEM_4_TRANSLATE');
    $tmp_max_loop_size_DRAFT_ELEMENTS = $oCRNRSTN_ENV->getEnvParam('MAX_DRAFT_ELEM_4_APPROVE');

    $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED');
    $tmp_loop_size_MINISTRY_LANG_ELEMENTS_PUBLISHED = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED');
    $tmp_loop_size_LANG_PACKS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');

    ?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content" id="myPage">
        <h3 style="padding-bottom:0px; margin-bottom:0px;">Hello, <?php echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('FIRSTNAME'); ?>!</h3>
        <p style="padding-top:10px; margin-top:0px;padding-bottom:10px; margin-bottom:0px;">Welcome to the Audio/Video Service overlay and content management web site.</p>

        <?php
        if($tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED>0) {

            ?>
            <h3 style="padding-bottom:0px; margin-bottom:0px;">Content Ready for Publish</h3>
            <ul data-role="listview" data-inset="true" data-divider-theme="a">
            <li data-role="list-divider">Ministry Content</li>
            <?php
            // MINISTRY_LANG_ELEMENTS_SAINT_SAVED

            for ($i = 0; $i < $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED; $i++) {

                //
                // DO WE HAVE A MATCH = USER KNOWS DRAFT LANG AND AT LEAST 1 OTHER PUBLISHED LANGUAGE WITH SAME COPY_ID

                // USER KNOWS DRAFT LANG?
                $tmp_content_good_for_publish_review = false;

                if ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i), 'LANG_ID') != "") {

                    $tmp_draft_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);
                    $tmp_draft_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                    //error_log('121 dashboard userid = '.$tmp_userid.'| saint saved draft lang id = '.$tmp_draft_lang_id);
                    // 'LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS_PUBLISHED|SITE_LANG_ELEMENTS_EN|TRANSLATOR_LANGS|SITE_LANG_ELEMENTS|MINISTRY_LANG_ELEMENTS_SAINT_SAVED';

                    //
                    // USER KNOWS AT LEAST ONE PUBLISHED PARENT LANG? THEN CAN CHECK AGAINST ANY APPROVED...AND APPROVE...OR EDIT.
                    // FOR EACH OTHER PUBLISHED LANG...IS THERE TRANSLATOR MATCH? IF SO...DISPLAY PUBLISHED ORIGINAL.
                    //
                    // FOR EACH AVAILABLE SYSTEM LANG_ID..
                    for ($ii = 0; $ii < $tmp_loop_size_LANG_PACKS; $ii++) {
                        # if((TRANSLATOR_LANGS[$tmp_userid|$tmp_lplid]) == TRUE AND (PUBLISHED_LANGID[COPY_ID|$tmp_lplid]) == TRUE)){
                        # MINISTRY_LANG_ELEMENTS_PUBLISHED.[copy_id|lplid]!=''
                        $tmp_lplid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $ii);
                        //error_log('121 dashboard userid = '.$tmp_userid.'| saint saved Draft LANG_ID=['.$tmp_draft_lang_id.']'.$tmp_lplid);
                        //error_log('133 :: Test for ready for publish...draft lid-['.$tmp_draft_lang_id.'] LANG_PACK lid-['.$tmp_lplid.']');
                        // if(($tmp_draft_lang_id != $tmp_lplid) && ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid.'|'.$tmp_lplid, 'LANG_ID')!="") && (($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', $tmp_draft_copy_id.'|'.$tmp_lplid, 'LANG_ID')!="") || (($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', $tmp_draft_copy_id.'|'.$tmp_lplid, 'LANG_ID')!="") && ($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USER_PERMISSIONS_ID")>399)))) {
                        if ((($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $tmp_lplid, 'LANG_ID') != "") && ($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', $tmp_draft_copy_id . '|' . $tmp_lplid, 'LANG_ID') != "")) || ((($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', $tmp_draft_copy_id . '|' . $tmp_lplid, 'LANG_ID') != "") && ($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USER_PERMISSIONS_ID") > 399)))) {
                            // DISPLAY THIS PUBLISHED CONTENT FOR REVIEW OF DRAFT
                            $tmp_content_good_for_publish_review = true;
                            //error_log('138 :: SOMETHING IS recognized - Ready for publish...draft lid-['.$tmp_draft_lang_id.'] LANG_PACK lid-['.$tmp_lplid.']');
                        }

                    }

                    if ($tmp_content_good_for_publish_review) {

                        $tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'PROFILE_ID', $i);
                        $tmp_mle_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i);
                        $tmp_mle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'ELEMENT_ID', $i);
                        $tmp_mle_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'COPY_ID', $i);

                        /*
                            if(self::$oEnv->oHTTP_MGR->issetParam($_GET, 'eid')){

            self::$http_param_handle["REFERENCE_KEY"] = '';
            //error_log('791 Encrypt URI Output-->'.self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'));
            //error_log('792 _GET[eid] Output-->'.$_GET['eid']);
            self::$http_param_handle["ELEMENT_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'eid'), true);
            //error_log('793 Decrypt URI Output-->'.self::$http_param_handle["TRANSLATION_ELEMENT_ID"]);
            self::$http_param_handle["COPY_ID"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'cpyid'), true);

        }

        self::$http_param_handle["LANG_ID_TRANSLATION"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lang_id'), true);
        self::$http_param_handle["LANG_ID_TRANSLATOR"] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'lit'), true);
                         * */

                        $tmp_mle_element_id_ENCRYPT = $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_mle_element_id);
                        echo '<li><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/translation/publish/?eid='.$tmp_mle_element_id_ENCRYPT.'&cpyid='.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_mle_copy_id).'&lang_id='.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_mle_lang_id).'&lit='.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'LANG_ID', $i)).'" data-ajax="false">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_SAINT_SAVED', 'ELEMENT_CONTENT_BLOB', $i).'</a></li>';
                        $cnt_MAX_DRAFT_ELEM_4_APPROVE++;
                        //error_log('155 :: SOMETHING recognized - Ready for publish...mle_lang_id-['.$tmp_mle_lang_id.']');

                    }

                    if ($cnt_MAX_DRAFT_ELEM_4_APPROVE > $tmp_max_loop_size_DRAFT_ELEMENTS - 1) {
                        //
                        // JUMP LOOP
                        $i = $tmp_loop_size_MINISTRY_LANG_ELEMENTS_SAINT_SAVED + 1;
                    }

                }
            }


            if ($cnt_MAX_DRAFT_ELEM_4_APPROVE < 1) {

                echo '<p style="padding:15px 20px 20px 20px; margin-top:0px; margin-bottom:0px;">No content needs to be reviewed and published at this time.</p>';

            }


            ?>
            </ul>
            <div class="cb_10"></div>

            <?php

        }

        ?>

        <h3 style="padding-bottom:0px; margin-bottom:0px;">Content for Translation</h3>
        <ul data-role="listview" data-inset="true" data-divider-theme="a">
            <li data-role="list-divider">Ministry Content</li>
            <?php
            // $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAX_MINISTRY_ELEM_4_TRANSLATE', 4);
            // $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAX_CMS_ELEM_4_TRANSLATE', 2);
            // $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'MAX_DRAFT_ELEM_4_APPROVE', 3);

            // LANG_REQUESTS
            //`cia00_profile_lang_requests`.`REQUEST_ID`,
            // `cia00_profile_lang_requests`.`FULLSCRN_PROFILE_ID`,
            // `cia00_profile_lang_requests`.`MINI_PROFILE_ID`,
            // `cia00_profile_lang_requests`.`LANG_ID`,
            // `cia00_profile_lang_requests`.`ISACTIVE`,
            // `cia00_profile_lang_requests`.`CREATOR_ID`,
            // `cia00_profile_lang_requests`.`CREATOR_IP`,
            // `cia00_profile_lang_requests`.`CREATOR_SESSION_ID`,
            // `cia00_profile_lang_requests`.`MODIFIER_ID`,
            // `cia00_profile_lang_requests`.`MODIFIER_IP`,
            // `cia00_profile_lang_requests`.`MODIFIER_SESSION_ID`,
            // `cia00_profile_lang_requests`.`DATEMODIFIED`,
            // `cia00_profile_lang_requests`.`DATECREATED`

            // LANG_REQUESTS
            // LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS_PUBLISHED|SITE_LANG_ELEMENTS|TRANSLATOR_LANGS

            // $tmp_loop_size_LANG_ELEMENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED');

            for($i=0; $i<$tmp_loop_size_MINISTRY_LANG_ELEMENTS_PUBLISHED; $i++){

                //
                // DO WE HAVE A MATCH AGAINST ORIGINAL LANG AND SAINT'S LANG?
                if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid.'|'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'LANG_ID', $i), 'LANG_ID')!="") {

                    //
                    // WE KNOW TRANSLATOR CAN HANDLE THIS PUBLISHED CONTENT. DO WE NEED THE LANGUAGE(S) TRANSLATOR CAN PROVIDE? OR HAS TRANSLATION ALREADY BEEN PUBLISHED?

                    //
                    // IF DRAFT IS SAINT_SAVED, SHOW TRANSLATION DRAFT AS READY FOR PUBLISH. HIDE ORIGINAL LANGUAGE "READY FOR TRANSLATION" ENTRY.
                    $tmp_mle_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'PROFILE_ID', $i);
                    $tmp_mle_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'LANG_ID', $i);
                    $tmp_mle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'ELEMENT_ID', $i);
                    $tmp_mle_copy_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'COPY_ID', $i);

                    //
                    // FOR EACH AVAILABLE SYSTEM LANG_ID..
                    for ($ii = 0; $ii < $tmp_loop_size_LANG_PACKS; $ii++) {

                        $tmp_lplid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $ii);

                        // DOES THE LANG_ID MATCH ORIGINAL ELEMENT CONTENT LANG?  ...IF SO, IGNORE.
                        // DOES THE SAINT KNOW THIS LANGUAGE? ...OTHERWISE, IGNORE.
                        // IS THIS LANGUAGE ACTUALLY REQUESTED FOR THIS PROFILE_ID (FULL AND MINI JOINED TOGETHER, HERE...) ...OTHERWISE, IGNORE.
                        if($tmp_lplid!=$tmp_mle_lang_id && $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $tmp_lplid, 'LANG_ID') != "" && $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_REQUESTS', $tmp_mle_profile_id.'|'.$tmp_lplid, 'LANG_ID')!=""){

                            //
                            // DOES THIS LANGUAGE HAVE A "SAINT_SAVED" OR "PUBLISHED" OR "CHECKED_OUT" LANGUAGE ELEMENT OF THIS LANG_ID?  ...IF SO, IGNORE.
                            if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_TRANSLATION_EXCLUDE', $tmp_mle_copy_id . '|' . $tmp_lplid, 'LANG_ID') == ""){

                                $tmp_mle_element_id_ENCRYPT = $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_mle_element_id);
                                echo '<li><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/translation/?eid='.$tmp_mle_element_id_ENCRYPT.'&cpyid='.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_mle_copy_id).'&lang_id='.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_mle_lang_id).'&lit='.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', $tmp_userid . '|' . $tmp_lplid, 'LANG_ID')).'" data-ajax="false">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_PUBLISHED', 'ELEMENT_CONTENT_BLOB', $i).'</a></li>';
                                $cnt_MAX_MINISTRY_ELEM_4_TRANSLATE++;

                            }

                        }

                    }

                }

                if($cnt_MAX_MINISTRY_ELEM_4_TRANSLATE>$tmp_max_loop_size_MINISTRY_ELEMENTS-1){
                    //
                    // JUMP LOOP
                    $i = $tmp_loop_size_MINISTRY_LANG_ELEMENTS_PUBLISHED + 1;
                }

            }

            if($cnt_MAX_MINISTRY_ELEM_4_TRANSLATE<1){

                echo '<p style="padding:15px 20px 20px 20px; margin-top:0px; margin-bottom:0px;">No content is available for translation at this time.</p>';

            }

            ?>
            <li data-role="list-divider">CMS Components</li>

            <?php
            $tmp_translator_lang_id_ARRAY = array();
            //
            // SITE_LANG_ELEMENTS
            $tmp_loop_size_TRANSLATOR_LANGS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS');

            for($i=0;$i<$tmp_loop_size_TRANSLATOR_LANGS;$i++){
                $tmp_translator_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'TRANSLATOR_LANGS', 'LANG_ID', $i);

                if($tmp_translator_lang_id!='en'){

                    //
                    // FOR EACH OF THE TRANSLATORS NON-ENGLISH LANGUAGES
                    $tmp_loop_size_SITE_LANG_ELEMENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'SITE_LANG_ELEMENTS_EN');

                    for($ii=0; $ii<$tmp_loop_size_SITE_LANG_ELEMENTS; $ii++){

                        $tmp_elem_reference_key = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'SITE_LANG_ELEMENTS_EN', 'ELEMENT_REF_KEY', $ii);

                        if($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'SITE_LANG_ELEMENTS', $tmp_elem_reference_key.'|'.$tmp_translator_lang_id, 'LANG_ID')=="") {

                            echo '<li><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/translation/?rk='.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_elem_reference_key).'&lang_id='.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_translator_lang_id).'">'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'SITE_LANG_ELEMENTS_EN', 'ELEMENT_CONTENT_BLOB', $ii).'</a></li>';
                            $cnt_MAX_CMS_ELEM_4_TRANSLATE++;

                        }

                        if($cnt_MAX_CMS_ELEM_4_TRANSLATE>$tmp_max_loop_size_CMS_ELEMENTS-1){
                            //
                            // JUMP LOOP
                            $ii = $tmp_loop_size_SITE_LANG_ELEMENTS + 1;
                        }

                    }

                }

            }

            if($cnt_MAX_CMS_ELEM_4_TRANSLATE<1){

                echo '<p style="padding:15px 20px 20px 20px; margin-top:0px; margin-bottom:0px;">No content is available for translation at this time.</p>';

            }

            ?>

            <!-- <li><a href="#">Firstname is required.</a></li> -->

        </ul>

        <h3 style="padding-bottom:0px; margin-bottom:0px;">Your Recent Activity</h3>
        <?php
        $tmp_loop_size = 0;
        //$oHTML_generator = new html_generator($oCRNRSTN_ENV,$oUSER);
        //$tmp_loop_size = $oDB_RESP->return_sizeof_aggregate('CUMM_ACTIVITY_DATA');

        if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID')==$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'uid')){
            $show_user_name = false;
        }else{
            $show_user_name = true;
        }

        switch($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")){
            case 'm':
                $tmp_max_recent_activity = $oCRNRSTN_ENV->getEnvParam('MOBILE_WEB_MAX_RECENT_ACTIVITY');
            break;
            default:
                $tmp_max_recent_activity = $oCRNRSTN_ENV->getEnvParam('DESKTOP_WEB_MAX_RECENT_ACTIVITY');
            break;

        }

        if($tmp_max_recent_activity<$tmp_loop_size){
            $tmp_loop_size = $tmp_max_recent_activity;
        }

        if($tmp_loop_size<1){
            echo '<p style="padding-top:5px; margin-top:0px;padding-bottom:10px; margin-bottom:0px;">No content is available.</p>';

        }else {
            # TODO THINK ABOUT CREATING A SPRITE FOR THESE ICONS
        ?>
        <!--<div class="agg_element_wrapper">
            <div class="icon_wrapper"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_kivotos.png" width="20" height="20" alt="kivotos" title="kivotos" style="border: 2px solid #FFDA3F;"></div>
            <div class="element_detail_wrapper">
                <div class="element_title"><a href="#" style="text-decoration: none; font-weight: normal;">Title here here...</a></div>
                <div class="cb"></div>
                <div class="element_date">4h 3m 12s ago</div>
                <div class="element_owner">by <a href="#" style="text-decoration: none; font-weight: normal;">User Name</a></div>
                <div class="cb"></div>
            </div>
        </div>
        <div class="cb_5"></div>-->
        <?php
            # $oDB_RESP->return_data_element($oDB_RESP->return_serial('USER_DATA'), 'KIVOTOS', 'NAME',5)
            #$tmp_loop_size =1;
            #for($i=0;$i<$tmp_loop_size;$i++){
                # $oDB_RESP->return_aggregate_element('CUMM_ACTIVITY_DATA', $i);
                # where return $tmp_aggregate_elem_ARRAY[0] = PROFILE...e.g. KIVOTOS
                # where return $tmp_aggregate_elem_ARRAY[1] = ARRAY[FIELD1=VALUE, FIELD2=VALUE, FIELD3=VALUE,...]
                # OR where $tmp_aggregate_elem_ARRAY[1] = POSITION
               // echo $oHTML_generator->returnHTML($oDB_RESP->return_aggregate_element('CUMM_ACTIVITY_DATA', $i), $show_user_name);

            #}
        }
        ?>
        <div class="agg_element_hr"></div>
        <div class="cb_5"></div>
        <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/recent/?uid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'uid'); ?>" data-ajax="false">View all</a>
        <h3>@mentions</h3>
        <a href="#" data-ajax="false" style="text-decoration:none;">View all</a>

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
						$tmp_loop_size13 = sizeof($tmp_clientData);
						for($i=0;$i<$tmp_loop_size13;$i++){
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
							$tmp_loop_size37 = sizeof($tmp_clientData);
                            for($i=0;$i<$tmp_loop_size37;$i++){
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