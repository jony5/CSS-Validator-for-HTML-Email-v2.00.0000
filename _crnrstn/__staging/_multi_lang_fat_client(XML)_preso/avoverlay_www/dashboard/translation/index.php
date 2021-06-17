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
$tmp_serial_handle = 'TRANSLATION_DATA_SELECT';
$oDB_RESP = $oUSER->getTranslationSelectData($tmp_serial_handle);

$tmp_lang_pack_nomen = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $oDB_RESP->getStaticParam('LANG_ID_TRANSLATOR'), 'NATIVE_NAME_BLOB');
$tmp_lang_pack_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $oDB_RESP->getStaticParam('LANG_ID_TRANSLATOR'), 'NAME');

$tmp_lang_pack_nomen_src = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $oUSER->retrieve_Form_Data("LANG_ID_TRANSLATION"), 'NATIVE_NAME_BLOB');
$tmp_lang_pack_name_src = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $oUSER->retrieve_Form_Data("LANG_ID_TRANSLATION"), 'NAME');

$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_TRANSLATION');

$tmp_element_copy_translation = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_TRANSLATION', $oDB_RESP->getStaticParam('LANG_ID_TRANSLATOR'), 'ELEMENT_CONTENT_BLOB');
$tmp_element_id_translation = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_TRANSLATION', $oDB_RESP->getStaticParam('LANG_ID_TRANSLATOR'), 'ELEMENT_ID');

$tmp_datepublished = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'DATEPUBLISHED');
$tmp_datedrafted = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'DATEDRAFTED');

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
        $oMiniNav->configureLink('back', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');
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

            <?php
            /*
            $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $oUser->retrieve_Form_Data("TRANSLATOR_LANG_ID"), 'LANG_ID');
            $oUser->retrieve_Form_Data("TRANSLATOR_LANG_ID");
            LANG_PACKS|LANG_REQUESTS|MINISTRY_LANG_ELEMENTS|TRANSLATOR_LANGS

            */

            ?>
            <h2 style=" padding-bottom:0px; margin-bottom:0px;">Translation into <?php echo $tmp_lang_pack_nomen; ?></h2>
            <div class="cb_20"></div>

            <div class="ui-shadow ui-corner-all custom-corners" style="border-top-left-radius:.3125em; border-top-right-radius:.3125em;border-bottom-left-radius:.3125em; border-bottom-right-radius:.3125em;">
                <div class="ui-bar ui-bar-a" style="border-top-left-radius:.3125em; border-top-right-radius:.3125em;">
                    <h3><?php echo $tmp_lang_pack_nomen_src; ?> for translation</h3>
                </div>
                <div class="ui-body ui-body-a" style="border-bottom-left-radius:.3125em; border-bottom-right-radius:.3125em;">
                    <div class="cb_5"></div>
                    <p style="padding-top: 0; margin-top: 0;"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'ELEMENT_CONTENT_BLOB'); ?></p>
                </div>
            </div>

            <div class="cb_20"></div>
            <form action="#" method="post" name="language_translation_user_submit_capture" id="language_translation_user_submit_capture"  enctype="multipart/form-data" data-ajax="false">
                <div>
                    <div style="float:left;"><label id="translation_copy_label" for="translation_copy" class="input">Enter <?php echo $tmp_lang_pack_nomen; ?> below:</label></div>
                    <div id="xhr_activity_state" style="float:right; font-size:70%; padding-top:4px;"></div>
                    <div class="cb"></div>
                </div>
                <textarea cols="40" rows="12" name="translation_copy" id="translation_copy" placeholder="Enter <?php echo $tmp_lang_pack_nomen; ?> translation..."><?php echo $tmp_element_copy_translation; ?></textarea>
                <input type="hidden" id="xhr_input_state_monitor_translation_copy" value="<?php echo $tmp_element_copy_translation; ?>">
                <input type="hidden" id="xhr_server_state_monitor_translation_copy" value="<?php echo $tmp_element_copy_translation; ?>">
                <div class="frm_errstatus translation_copy_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus translation_copy_invalid" style="width:100%; display:none;">Invalid translation content</div>

                <div class="cb_20"></div>
                <div id="oops_processElementMod_saveTranslation"></div>
                <div class="frm_errstatus oops_processElementMod_saveTranslation_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processElementMod_saveTranslation_invalid" style="width:100%; display:none;">Invalid translation content</div>
                <div>
                    <div style="float:left;"><a href="#" data-rel="back" class="ui-shadow ui-btn ui-corner-all" >CANCEL</a></div>
                    <div style="float:right;"><a href="#" class="ui-shadow ui-btn ui-corner-all" id="new_bullet_submit" onclick="processTranslationSave();">SAVE</a></div>
                    <div class="cb"></div>
                </div>

                <input type="hidden" name="component_type" id="component_type" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'COMPONENT_TYPE')); ?>">
                <input type="hidden" name="component_id" id="component_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'COMPONENT_ID')); ?>">
                <input type="hidden" name="page_id" id="page_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'PAGE_ID')); ?>">
                <input type="hidden" name="profile_id" id="profile_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'PROFILE_ID')); ?>">
                <input type="hidden" name="profile_type" id="profile_type" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'PROFILE_TYPE')); ?>">
                <input type="hidden" name="element_reference_key" id="element_reference_key" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->retrieve_Form_Data("REFERENCE_KEY")); ?>">
                <input type="hidden" name="element_id" id="element_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->retrieve_Form_Data("ELEMENT_ID")); ?>">
                <input type="hidden" name="element_id_translation" id="element_id_translation" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_element_id_translation); ?>">
                <input type="hidden" name="copy_id" id="copy_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->retrieve_Form_Data("COPY_ID")); ?>">
                <input type="hidden" name="lang_id" id="lang_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->retrieve_Form_Data("LANG_ID_TRANSLATION")); ?>">
                <input type="hidden" name="lang_id_translator" id="lang_id_translator" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->getStaticParam('LANG_ID_TRANSLATOR')); ?>">
                <input type="hidden" name="isactive" id="isactive" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'ISACTIVE')); ?>">
                <input type="hidden" name="draft_owner" id="draft_owner" value="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'DRAFT_OWNER'); ?>">
                <input type="hidden" name="copy_hash" id="copy_hash" value="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'COPY_HASH'); ?>">
                <input type="hidden" name="completion_state" id="completion_state" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINISTRY_LANG_ELEMENTS_FOR_PUBLISH', 'COMPLETION_STATE')); ?>">

                <input type="hidden" name="date_translation_published" id="date_translation_published" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_datepublished); ?>">
                <input type="hidden" name="date_translation_drafted" id="date_translation_drafted" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_datedrafted); ?>">

                <input type="hidden" name="postid" id="postid" value="language_translation_user_submit_capture">
            </form>

            <div class="cb_20"></div>

        </div><!-- /content -->

        <script type="application/javascript" language="javascript">

            setInterval(function(){ saveCurrentProgress("textarea","translation_copy"); }, 1000);

            $( "#language_translation_user_submit_capture" ).submit(function( event ) {
                //
                // VALIDATE FORM
                return validateForm('language_translation_user_submit_capture');
            });

        </script>

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