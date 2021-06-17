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
$tmp_serial_handle = 'OBS_FULLSCRN_PROFILE_DATA';
$oDB_RESP = $oUSER->getOBSFullScrnProfileData($tmp_serial_handle);

$tmp_profile_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'PROFILE_NAME');
$tmp_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULL_SCRN_PROFILE', 'PROFILE_ID');
$tmp_my_lang = 'en';

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
        $oMiniNav = new miniNav('overlay_type_edit');
        $oMiniNav->configureLink('back', '#popupMenuBackToOBSClients');

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
            <div data-role="popup" id="popupMenuBackToOBSClients" data-theme="a" class="ui-content">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                <label id="select_client_title" for="select_client">Select OBS Client:</label>
                <ul id="select_client" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Search clients..." data-icon="back">
                <?php
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT');

                for($iii=0; $iii<$tmp_loop_size; $iii++){
                    $tmp_obsid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBSCLIENT_ID', $iii);
                    $tmp_obs_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENT', 'OBS_ID_DISPLAY', $iii);

                     echo '<li><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/client/?obs_cid='.$tmp_obsid.'">'.$tmp_obs_name.'</a></li>';

                }

                ?>
                </ul>
            </div>

            <div data-role="popup" id="popupMenuSelectDesiredLang" data-theme="a" class="ui-content">
                <form action="#" method="post" name="update_desired_languages" id="update_desired_languages"  enctype="multipart/form-data" data-ajax="false">
                    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>

                    <label for="lang_packs_available" class="input">Select Desired Languages:</label>
                    <fieldset id="lang_packs_available" data-role="controlgroup">
                        <?php
                        $tmp_output_HTML = '';
                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');

                        for($iii=0; $iii<$tmp_loop_size; $iii++){
                            $tmp_langid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $iii);
                            $tmp_langname = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'NATIVE_NAME_BLOB', $iii);
                            $tmp_langname_en = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'NAME', $iii);

                            $tmp_checked = $oUSER->returnProfileLangRadioChecked($tmp_langid, $oDB_RESP, $tmp_serial_handle);

                            $tmp_output_HTML .= '<input type="checkbox" name="checkbox_desired_lang_'.$tmp_langid.'" id="checkbox_desired_lang_'.$iii.'" '.$tmp_checked.'>
                            <label for="checkbox_desired_lang_'.$iii.'">'.$tmp_langname.' <span style="font-weight: normal;">('.$tmp_langname_en.')</span></label>
                            <input type="hidden" id="checkbox_desired_lang_handle_'.$iii.'" name="checkbox_desired_lang_handle_'.$iii.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_langid).'">
                            
                            ';

                        }

                        echo $tmp_output_HTML;

                        ?>
                    </fieldset>
                    <div class="cb_10"></div>
                    <div>
                        <div style="float:left;"><a href="#" data-rel="back" class="ui-btn ui-btn-inline" >CANCEL</a></div>
                        <div style="float:right;"><a href="#" class="ui-shadow ui-btn ui-corner-all" onclick="processDesiredLangRequest('<?php echo $iii; ?>');">UPDATE</a></div>
                        <div class="cb"></div>
                    </div>
                    <input type="hidden" id="fullscrn_profile_id" name="fullscrn_profile_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_profile_id);  ?>">
                    <input type="hidden" id="mini_profile_id" name="mini_profile_id" value="">
                    <input type="hidden" id="lang_count" name="lang_count" value="">
                    <input type="hidden" id="lang_translation_profile" name="lang_translation_profile" value="">
                    <input type="hidden" name="postid" value="update_desired_languages">
                </form>
            </div>

            <h2 style="padding-bottom:0px; margin-bottom:0px;"><?php echo $tmp_profile_name; ?></h2>
            <div class="cb_10"></div>
            <div style="height:45px; overflow: hidden;">
                <div style="float:left;"><h3>Overlay Pages</h3></div>
                <div style="float:right; font-size:90%; padding-top: 22px;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/new/page/?pid='.$tmp_profile_id; ?>" data-ajax="false">new</a></div>
            </div>
            
            <div class="cb"></div>
            <ul data-role="listview" data-inset="true">
                <?php

                $tmp_output_HTML = '';
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGES');

                for($iii=0; $iii<$tmp_loop_size; $iii++){
                    $tmp_pageid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGES', 'PAGE_ID', $iii);
                    $tmp_pagename = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGES', 'PAGE_NAME', $iii);
                    $tmp_pagedate_created = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGES', 'DATECREATED', $iii);

                    $tmp_output_HTML .=  '<li id="elem_name_'.$tmp_pageid.'"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/?pid='.$tmp_pageid.'&oid='.$tmp_profile_id.'" data-ajax="false">'.$tmp_pagename.'</a></li>';

                }

                echo $tmp_output_HTML;
                ?>

            </ul>

            <div class="cb_10"></div>
            <div style="height:45px; overflow: hidden;">
                <div style="float:left;"><h3>Desired Languages</h3></div>
                <div style="float:right; font-size:90%; padding-top: 22px;"><a href="#popupMenuSelectDesiredLang" data-rel="popup" data-transition="slideup">edit</a></div>

            </div>

            <div class="cb"></div>
            <ul data-role="listview" data-inset="true">
            <?php

            $tmp_output_HTML = '';
            $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_REQUESTS');

            // $oDB_RESP->keyDataByID($oDB_RESP->return_serial(), 'LANG_PACKS', 'LANG_ID'); `cia00_lang_packs`.`NAME`,
            //                        `cia00_lang_packs`.`NATIVE_NAME`,
            //                        `cia00_lang_packs`.`NATIVE_NAME_BLOB`,

            for($iii=0; $iii<$tmp_loop_size; $iii++){
                $tmp_req_langid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_REQUESTS', 'LANG_ID', $iii);
                $tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $tmp_req_langid, 'NATIVE_NAME_BLOB');
                $tmp_name_en = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', $tmp_req_langid, 'NAME');

                    echo '<li>'.$tmp_name.' ('.$tmp_name_en.')</li>';


            }

            echo $tmp_output_HTML;
            ?>
            </ul>


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