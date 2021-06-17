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

$tmp_profile_opacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'OPACITY');
$tmp_profile_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'BGCOLOR_HEX');
$tmp_preview_lang_id = strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE"));

$tmp_has_page_header_BOOL = $oUSER->pageElementExists_BOOL($oDB_RESP, 'PAGE_HEADER', $tmp_preview_lang_id);
$tmp_has_page_title_BOOL = $oUSER->pageElementExists_BOOL($oDB_RESP, 'PAGE_TITLE', $tmp_preview_lang_id);
$tmp_has_datetime_BOOL = $oUSER->pageElementExists_BOOL($oDB_RESP, 'PAGE_DATETIME', $tmp_preview_lang_id);

$tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES');
for($iii=0; $iii<$tmp_loop_size; $iii++){
    $tmp_color_hex = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES', 'COLOR_HEX', $iii);
    $tmp_color_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES', 'COLOR_NAME_BLOB', $iii);

    if($tmp_color_hex==$tmp_profile_bgcolor){
        $tmp_curr_color_name = $tmp_color_name;

    }

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
        $oMiniNav = new miniNav('fullscrn_overlay_page');
        $oMiniNav->configureLink('page_bgcolor', '#popupMenuBGColor');
        $oMiniNav->configureLink('page_bgopacity', '#popupMenuBGOpacity');
        $oMiniNav->configureLink('back', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/fullscrn/?pid='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'oid'));

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
            <form action="#" method="post" name="update_page_meta_simple" id="update_page_meta_simple"  enctype="multipart/form-data" data-ajax="false">
                <input type="hidden" name="postid" id="postid" value="update_page_meta_simple">
                <input type="hidden" name="overlay_fullscrn_page_id" id="overlay_fullscrn_page_id" value="">
                <input type="hidden" name="overlay_fullscrn_page_opacity" id="overlay_fullscrn_page_opacity" value="">
                <input type="hidden" name="overlay_elem_bg_color" id="overlay_fullscrn_page_bg_color" value="">
                <input type="hidden" name="overlay_fullscrn_profile_id" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PROFILE_ID')); ?>">
            </form>
            <div data-role="popup" id="popupMenuPageActions" data-theme="b">
                    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                    <ul data-role="listview" data-inset="true" style="min-width:210px;">
                        <li data-role="list-divider">Choose an action</li>
                        <?php
                        if($tmp_has_page_header_BOOL){
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/editheader/?pid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID'); ?>&oid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PROFILE_ID'); ?>" data-ajax="false">Edit page header</a></li>
                            <?php
                        }else{
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/newheader/?pid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID'); ?>&oid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PROFILE_ID'); ?>" data-ajax="false">Add page header</a></li>
                            <?php

                        }

                        if($tmp_has_page_title_BOOL){
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/edittitle/?pid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID'); ?>&oid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PROFILE_ID'); ?>" data-ajax="false">Edit page title</a></li>
                            <?php
                        }else{
                            ?>
                            <li><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/newtitle/?pid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID'); ?>&oid=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PROFILE_ID'); ?>" data-ajax="false">Add page title</a></li>
                            <?php

                        }

                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'COMPONENT_TYPES');

                        for($iii=0; $iii<$tmp_loop_size; $iii++){
                            $tmp_type_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'COMPONENT_TYPES', 'NAME', $iii);
                            $tmp_type_new_uri = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'COMPONENT_TYPES', 'URI_PATH_NEW', $iii);


                            echo '<li><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$tmp_type_new_uri.'?pid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID').'&oid='.$oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PROFILE_ID').'" data-ajax="false">Insert '.strtolower($tmp_type_name).'</a></li>';
                        }

                        ?>


                        <!--
                        <li>Insert copy block</li>
                        <li>Insert bullet point list</li>
                        <li>Insert image</li>
                        <li>Insert audio</li>
                        -->
                        <?php
                            if($tmp_has_datetime_BOOL){
                                ?>
                                <li>Remove date time stamp</li>
                                <?php
                            }else{
                                ?>
                                <li>Insert date time stamp</li>
                                <?php
                            }

                        ?>

                    </ul>
            </div>

            <div data-role="popup" id="popupMenuBGColor" data-theme="a" class="ui-content">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                <fieldset data-role="controlgroup">
                    <legend>Select Background Color:</legend>
                    <?php

                    $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES');

                    for($iii=0; $iii<$tmp_loop_size; $iii++){
                        $tmp_color_hex = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES', 'COLOR_HEX', $iii);
                        $tmp_color_name = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES', 'COLOR_NAME_BLOB', $iii);
                        $tmp_color_type = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'DE_COLORES', 'COLOR_APPLICATION_KEY', $iii);

                        if($tmp_color_type=="BACKGROUND"){

                            echo '<input type="radio" name="bg_color" id="bg_color_'.$iii.'" value="'.$tmp_color_hex.'" '.$oUSER->returnRadioChecked($tmp_color_hex, $tmp_profile_bgcolor).' onclick="updatePageBGColor(\''.$oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID')).'\',\''.$tmp_color_hex.'\')">
                            <label for="bg_color_'.$iii.'">'.$tmp_color_name.'</label>';
                        }

                        if($tmp_color_hex==$tmp_profile_bgcolor){
                            $tmp_curr_color_name = $tmp_color_name;

                        }

                    }
                    ?>

                </fieldset>
            </div>

            <div style="touch-action:none;" data-role="popup" id="popupMenuBGOpacity" data-theme="a" class="ui-content">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                <form  style="touch-action:none;" action="#" method="post" name="update_page_opacity" id="update_page_opacity"  enctype="multipart/form-data" data-ajax="false">
                    <legend>Set Opacity:<br>(where 1 = No transparency)</legend>
                    <input style="touch-action:none;" type="range" name="bg_opacity" id="bg_opacity" data-track-theme="b" data-highlight="true" data-theme="b" min="0" max="1" step=".1" value="<?php echo $tmp_profile_opacity; ?>">
                    <div class="cb_15"></div>
                    <button class="ui-btn ui-btn-b" onclick="updatePageBGOpacity('<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_ID')); ?>','FULLSCRN_PAGE','bg_opacity');">SAVE</button>
                </form>
            </div>

            <div style="float:right; font-size:90%; padding-top: 0;"><a href="#" data-ajax="false">edit page</a>&nbsp; &nbsp; <a href="#popupMenuPageActions" data-rel="popup" data-transition="slideup">page components</a></div>

            <div><h2 style=" padding-bottom:0px; margin-bottom:0px;"><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PAGE', 'PAGE_NAME_BLOB'); ?></h2></div>
            <div class="cb_10"></div>
            <!-- BEGIN PAGE CONTENT -->

            <!-- HEADER CONTENT -->
            <?php
            $tmp_content_HTML = $oUSER->buildHTMLOutput($oDB_RESP, $tmp_serial_handle, 'ADMIN_PREVIEW','PAGE_HEADER', $tmp_preview_lang_id);
            if($tmp_content_HTML!='') {
                echo $tmp_content_HTML;
                //echo '<div class="cb_10"></div>';
            }
            ?>

            <!-- TITLE CONTENT -->
            <?php
            $tmp_content_HTML = $oUSER->buildHTMLOutput($oDB_RESP, $tmp_serial_handle, 'ADMIN_PREVIEW','PAGE_TITLE', $tmp_preview_lang_id);
            if($tmp_content_HTML!='') {
                echo $tmp_content_HTML;
                //echo '<div class="cb_10"></div>';
            }
            ?>

            <!-- DYNAMIC SECTION CONTENT - 00 -->
            <!-- DYNAMIC SECTION CONTENT - 01 -->
            <!-- DYNAMIC SECTION CONTENT - n -->
            <?php
            $tmp_content_HTML = $oUSER->buildHTMLOutput($oDB_RESP, $tmp_serial_handle, 'ADMIN_PREVIEW','DYNAMIC_CONTENT', $tmp_preview_lang_id);
            if($tmp_content_HTML!='') {
                echo $tmp_content_HTML;
            }
            ?>

            <!-- END PAGE CONTENT -->
            <div class="cb_20"></div>

            <div>Belongs to full screen profile: <strong><?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial('DATA_AUG_00'), 'FULLSCRN_PROFILE_0', 'PROFILE_NAME_BLOB'); ?></strong></div>
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