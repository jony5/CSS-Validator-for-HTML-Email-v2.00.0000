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
$tmp_paragraph_alignment = '';

$tmp_output_HTML='';
if($tmp_component_id!=''){
    $tmp_action = 'Update';

    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH');
    for($i=0;$i<$tmp_loop_size;$i++){
        $tmp_para_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'COMPONENT_ID', $i);

        if($tmp_para_component_id==$tmp_component_id){

            $tmp_paragraph_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'PARAGRAPH_ID', $i);
            $tmp_paragraph_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'COMPONENT_ID', $i);
            $tmp_paragraph_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'ELEMENT_ID', $i);
            $tmp_paragraph_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'IS_BOLD', $i);
            $tmp_paragraph_is_blockquote = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'IS_BLOCKQUOTE', $i);
            $tmp_paragraph_alignment = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'PARAGRAPH', 'COPY_ALIGNMENT', $i);
            $tmp_paragraph_copy = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM', $tmp_paragraph_element_id, 'ELEMENT_CONTENT_BLOB', $i);
            $tmp_modify_ip = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_ELEM', $tmp_paragraph_element_id, 'MODIFIER_IP_V6', $i);
        }

    }

}else{
    $tmp_paragraph_id = '';
    $tmp_action = 'Insert';

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
        $oMiniNav = new miniNav('paragraph_manage');
        $oMiniNav->configureLink('paragraph_style', '#popupMenuParagraphStyle');
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
            <form action="#" method="post" name="insert_paragraph_element" id="insert_paragraph_element"  enctype="multipart/form-data" data-ajax="false">
                <input type="hidden" name="postid" id="postid" value="insert_paragraph_element">
                <input type="hidden" name="action_type" id="action_type" value="">
                <input type="hidden" name="component_type_key" id="component_type_key" value="PARAGRAPH">
                <input type="hidden" name="overlay_fullscrn_page_id" id="overlay_fullscrn_page_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid')); ?>">
                <input type="hidden" name="overlay_fullscrn_profile_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid')); ?>">
                <input type="hidden" name="overlay_fullscrn_component_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'cid')); ?>">
                <input type="hidden" name="overlay_fullscrn_paragraph_id" id="overlay_fullscrn_paragraph_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_paragraph_id); ?>">
                <input type="hidden" name="paragraph_element_id" id="paragraph_element_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_paragraph_element_id); ?>">
                <input type="hidden" name="paragraph_content" id="paragraph_content" value="<?php echo $tmp_paragraph_copy; ?>">
                <input type="hidden" name="paragraph_content_is_bold" id="paragraph_content_is_bold" value="<?php echo $tmp_paragraph_is_bold; ?>">
                <input type="hidden" name="paragraph_content_is_blockquote" id="paragraph_content_is_blockquote" value="<?php echo $tmp_paragraph_is_blockquote; ?>">
                <input type="hidden" name="paragraph_alignment" id="paragraph_alignment" value="<?php echo $tmp_paragraph_alignment; ?>">

                <input type="hidden" name="paragraph_delete" id="paragraph_delete" value="">
                <input type="hidden" name="page_current_component_count" id="page_current_component_count" value="<?php echo $tmp_component_count; ?>">
                <input type="hidden" name="new_elem_lang_id" id="new_elem_lang_id" value="<?php echo strtolower($tmp_my_lang); ?>">
            </form>

            <div data-role="popup" id="popupConfirmAction" data-theme="b" data-dismissible="false" class="ui-content" style="max-width:400px;">
                <div data-role="header" data-theme="b">
                    <h1 id="popupConfirmAction_title" style="margin-right: 10%; margin-left: 10%;">Update Paragraph?</h1>
                </div>
                <div role="main" class="ui-content">
                    <h3 id="confirm_title" class="ui-title">Are you sure you want to delete this paragraph?</h3>
                    <p id="confirm_apply_copy">This action will be applied upon form submission.</p>
                    <div id="confirm_anchors">
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>

                    </div>
                </div>
            </div>

            <div data-role="popup" id="popupMenuAddAParagraph" data-theme="a" class="ui-content" data-dismissible="false">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label id="add_paragraph_title_label" for="paragraph_copy" class="input">Add a Paragraph:</label>
                <textarea cols="40" rows="12" name="paragraph_copy" id="paragraph_copy" placeholder="Enter text..."></textarea>
                <div class="frm_errstatus paragraph_copy_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus paragraph_copy_invalid" style="width:100%; display:none;">Invalid paragraph content</div>

                <input type="checkbox" name="checkbox_copy_bold" id="checkbox_copy_bold" data-mini="true">
                <label for="checkbox_copy_bold">Strengthen Font with Boldness</label>

                <div class="cb_20"></div>
                <div id="oops_processComponentMod_savePara"></div>
                <div class="frm_errstatus oops_processComponentMod_savePara_req" style="width:100%; display:none;">Required</div>
                <div class="frm_errstatus oops_processComponentMod_savePara_invalid" style="width:100%; display:none;">Invalid</div>

                <div>
                    <div style="float:left;"><a href="#" data-rel="back" class="ui-btn ui-btn-inline" >CANCEL</a></div>
                    <div style="float:right;"><a href="#" class="ui-shadow ui-btn ui-corner-all" id="new_paragraph_submit" onclick="processParagraphData();">SAVE</a></div>
                    <div class="cb"></div>
                </div>

            </div>

            <div data-role="popup" id="popupMenuParagraphStyle" data-theme="a" data-dismissible="false" class="ui-content" style="max-width:400px;">
                <div data-role="header" data-theme="a">
                    <h1 style="margin-right: 10%; margin-left: 10%;">Update Style?</h1>
                </div>
                <div role="main" class="ui-content">

                    <fieldset data-role="controlgroup">
                        <input type="checkbox" name="checkbox_paragraph_bold" id="checkbox_paragraph_bold">
                        <label for="checkbox_paragraph_bold">Make Bold</label>
                        <input type="checkbox" name="checkbox_paragraph_blockquote" id="checkbox_paragraph_blockquote">
                        <label for="checkbox_paragraph_blockquote">Make Blockquote</label>
                    </fieldset>

                    <div class="cb_10"></div>
                    <fieldset data-role="controlgroup">
                        <input type="radio" name="radio_paragraph_align" id="radio_paragraph_align1" value="left" <?php echo $oUSER->returnRadioChecked('left', $tmp_paragraph_alignment, 'radio_paragraph_align1'); ?>>
                        <label for="radio_paragraph_align1">Align Left</label>
                        <input type="radio" name="radio_paragraph_align" id="radio_paragraph_align2" value="right"<?php echo $oUSER->returnRadioChecked('right', $tmp_paragraph_alignment, 'radio_paragraph_align2'); ?>>
                        <label for="radio_paragraph_align2">Align Center</label>
                        <input type="radio" name="radio_paragraph_align" id="radio_paragraph_align3" value="center"<?php echo $oUSER->returnRadioChecked('center', $tmp_paragraph_alignment, 'radio_paragraph_align3'); ?>>
                        <label for="radio_paragraph_align3">Align Right</label>
                    </fieldset>

                    <div>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="resetPopupState('popupMenuParagraphStyle', '<?php echo $oUSER->active_radio_id[$oUSER->default_selected_radio_val];  ?>');">Cancel</a>
                        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false">Apply</a>

                    </div>
                </div>
            </div>

            <h2 style=" padding-bottom:0px; margin-bottom:0px;"><?php echo $tmp_action; ?> Paragraph</h2>
            <div class="cb_10"></div>


            <div>
                <?php
                if($tmp_component_id!=''){
                ?>
                    <div style="float:left;"><a href="#" class="ui-btn ui-btn-inline" onclick="editParagraph();">Edit Paragraph</a></div>

                    <div style="float:right;"><a href="#" class="ui-btn ui-btn-inline" onclick="apply_OBSClientUpdate_Confirm('delete_paragraph_authorize', 'button_event_delete', 'nothing');">Delete</a></div>
                <?php
                }else{
                    //<div style="float:right; height:20px;"><a href="#" onclick="editParagraph(\''.$tmp_paragraph_component_id.'\',\''.$tmp_paragraph_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_paragraph_id).'\');">edit</a></div>
                ?>
                    <div style="float:left;"><a href="#" class="ui-btn ui-btn-inline" onclick="newParagraph();">Add a paragraph</a></div>
                <?php
                }
                ?>
                <div class="cb"></div>
            </div>
            <div class="cb_10"></div>
            <hr class="stream_hr_dsh">
            <?php

            //
            // DO WE HAVE A COMPONENT?
            if($tmp_component_id!=''){
                $tmp_output_HTML = '';
                echo '<div>
                <div><h3 style="padding-bottom:0;margin-bottom:5px;float:left;">Review Paragraph</h3></div>
                <div style="float:right;"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?pid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'pid').'&oid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid').'" class="ui-btn ui-btn-inline" data-ajax="false">Done</a></div>
                <div class="cb"></div>
                </div>';

                if($tmp_paragraph_is_blockquote == 1 || $tmp_paragraph_is_blockquote == '1'){
                    $tmp_output_HTML .= '<blockquote>';
                    $tmp_output_HTML_ELEM_CLOSE = '</blockquote>';

                }else{
                    $tmp_output_HTML .= '<p style="align:'.$tmp_paragraph_alignment.';">';
                    $tmp_output_HTML_ELEM_CLOSE = '</p>';

                }

                //
                // OUTPUT PARAGRAPH
                echo $tmp_output_HTML;

                if($tmp_paragraph_is_bold=='1'){
                    echo '<strong>'.html_entity_decode($tmp_paragraph_copy).'</strong>';
                    //echo '<li><div style="float:right; height:20px;"><a href="#" onclick="editBulletPoint(\''.$tmp_bullet_component_id.'\',\''.$tmp_bullet_bullet_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'\');">edit</a></div><div style="width:220px;"><strong>'.$tmp_bullet_description.'</strong></div><div class="hidden"><input type="hidden" name="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'"><input type="hidden" name="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_desc_is_bold.'"><input type="hidden" name="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" id="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_description.'"><input type="hidden" name="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_element_id).'"></div></li>';
                }else{
                    echo html_entity_decode($tmp_paragraph_copy);
                    //echo '<li><div style="float:right; height:20px;"><a href="#" onclick="editBulletPoint(\''.$tmp_bullet_component_id.'\',\''.$tmp_bullet_bullet_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'\');">edit</a></div><div style="width:220px;">'.$tmp_bullet_description.'</div><div class="hidden"><input type="hidden" name="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'"><input type="hidden" name="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_desc_is_bold.'"><input type="hidden" name="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" id="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_description.'"><input type="hidden" name="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_element_id).'"></div></li>';
                }

                echo $tmp_output_HTML_ELEM_CLOSE;

            }

            ?>

            <div class="cb_20"></div>

            <script type="application/javascript" language="javascript">
                $( "#insert_paragraph_element" ).submit(function( event ) {
                    //
                    // VALIDATE FORM
                    return validateForm('insert_paragraph_element');
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