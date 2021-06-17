<?php
/*
// J5
// Code is Poetry */
//echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
//echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
//echo "SERVER_PORT: ".$_SERVER['SERVER_PORT']."<br>";
//echo "SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."<br>";
//echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br>";

//
// CHECK FOR SSL AND UPDATE URI TO ALIGN TO CRNRSTN CONFIG
if($oCRNRSTN_ENV->getEnvParam('SSL_ENABLED')){

    //
    // SSL_ENABLED - FORCE SSL

}else{

    //
    // NO SSL_ENABLED - NO SSL ALLOWED
    if($oUSER->is_ssl()){

        //
        // REDIRECT HTTPS TO HTTP
        header("Location: http://avoverlay.jony5.com/");
        die();

    }

}

//
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)) {


    switch($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'rt')){
        case 'currentstatus':

            $tmp_serial_handle = 'OBS_CLIENT_PROFILE_DATA';
            $tmp_HTML = $oUSER->returnCurrentStatus($tmp_serial_handle);

            echo $tmp_HTML;
            die();

        break;
        case 'xhr_sync':

            $oUSER = $oUSER->processXHRSubmit('xhr_sync');

            header('Content-Type: application/json; charset=UTF-8');
            echo $oUSER->xhr_response_json;

        break;
        default:

            //
            // WHAT DO WE HAVE
            switch ($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'xml')) {
                case 'i':

                    $tmp_filename_DIR_PATH = '';

                    //
                    // CAPTURE AND PROCESS ALL URI PARAMS
                    $tmp_filename_DIR_PATH = $oUSER->syncServerToClient();

                    if($tmp_filename_DIR_PATH=='demo'){

                        $tmp_filename_index = 'profile_index.xml';
                        $tmp_path_profile_index_xml = 'common/xml/';
                        $tmp_filename_DIR_PATH = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR') . '/' . $tmp_path_profile_index_xml . $tmp_filename_index;

                        header("Content-Type: text/xml");
                        header('Content-Disposition: inline; filename="overlay_demo_index.xml"');

                        $oUSER->readfile_chunked($tmp_filename_DIR_PATH);

                        die();

                    }else{

                        $tmp_filename_DIR_PATH = $oUSER->getEnvParam('DOCUMENT_ROOT') . $oUSER->getEnvParam('DOCUMENT_ROOT_DIR') . $tmp_filename_DIR_PATH;

                        header("Content-Type: text/xml");
                        header('Content-Disposition: inline; filename="overlay_index.xml"');

                        $oUSER->readfile_chunked($tmp_filename_DIR_PATH);

                        die();
                    }

                break;
            }

        break;

    }


}

//
// PROCESS POST METHOD REQUEST TYPE
if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){

    //
    // WHAT DO WE HAVE
    $tmp_postid = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'postid');

    switch($tmp_postid){
        case 'content_publish_proxy':
            $oUSER = $oUSER->processDraftAction($tmp_postid);
            error_log("AV Overlay session.inc.php (116) content_publish_proxy response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "content_publish_skip=success":
                case "content_publish_edit=success":
                case "content_publish_publish=success":

                    // http://172.16.225.128/avoverlay/dashboard/translation/publish/
                    // ?eid=vfKVRGiSgkTHw3xzVkisUAr3cu5MmUkQmOcQudmgi65LM%2BAgTjAzoUtzT3we57Ah%2FUYEqXiW8A1xGk5YM4wj41T5468VuZ7p90ePt%2FEoKQ7g3BJ5aUtM3Wmk%2FL6TXMelkx%2F2BsBjFsy6CE7hO16bcF8KcyIg3A%3D%3D
                    // &cpyid=AzSRplT6nLKPbgWT%2BVDq%2BOwpLmCelHBY2iNKBEtj2F3baH%2B6OhCBxRcMYSZ0rrseEggddHZZQUgD7wn4PDcJxKGP6cs5nVhKxAeUxNwrzH9LIf4V3xrl3AnzaXG1UPErqqAIdVt5y7ZsyQbWIi0jaYzL2BAH9A%3D%3D
                    // &lang_id=izJEz5YJkjQAabtLmqN2pui7Pr2pcNAaOsjqPz9RlWl8nUaVskJmj35ZTajqj4FlCeQ%3D
                    // &lit=9qY%2FTXHN52a6WpNBY6HL8%2BmCccaB00s2EKy4p2mQJ9d1%2FR8FDXwY1iZmJROz%2B9wkUDU%3D

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/translation/publish/?eid=".$oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->returnNewElementID('ELEMENT_ID'))."&cpyid=".$oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->returnNewElementID('COPY_ID'))."&lang_id=".$oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->returnNewElementID('LANG_ID'))."&lit=".$oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->returnNewElementID('LANG_ID_TRANSLATOR'))."&element_sps=".$oCRNRSTN_ENV->paramTunnelEncrypt($oUSER->returnNewElementID('ELEMENT_SKIP_PIPE_STR')));
                    exit();

                break;
                case 'content_publish_publish=success_null':
                case 'content_publish_skip=success_null':
                    $tmp_skipped_array = array();
                    $oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("USER_CONTENT_SKIPPED", $tmp_skipped_array);

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','content_publish_proxy');
                break;
            }

        break;
        case 'language_translation_user_submit_capture':
            $oUSER = $oUSER->processTranslationUserSubmit($tmp_postid);

            switch($oUSER->responseString){
                case "language_translation_user_submit_capture=success":

                    if($oUSER->returnNewElementID('NEXT_TRANSLATION_COPY_ID')!=''){
                        header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/translation/?eid=".$oUSER->returnNewElementID('NEXT_TRANSLATION_ELEMENT_ID')."&cpyid=".$oUSER->returnNewElementID('NEXT_TRANSLATION_COPY_ID')."&lang_id=".$oUSER->returnNewElementID('NEXT_TRANSLATION_LANG_ID'));
                        exit();

                    }else{

                        header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
                        exit();
                    }

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','update_desired_languages');
                break;
            }

        break;
        case 'update_desired_languages':
            $oUSER = $oUSER->processDesiredLangRequest($tmp_postid);

            switch($oUSER->responseString){
                case "update_desired_languages=success":

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/fullscrn/?pid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','update_desired_languages');
                break;
            }

        break;
        case 'update_schedule_time_format':
        case 'update_schedule_date_format':
            $oUSER = $oUSER->processComponentMod($tmp_postid);
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "update_schedule_time_format=success":
                case "update_schedule_date_format=success":

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/schedule/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID')."&cid=".$oUSER->returnNewElementID('COMPONENT_ID'));
                    exit();

                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','insert_schedule_element');
                    break;
            }

        break;
        case 'sys_add_new_user_type':
            $oUSER->responseString = $oUSER->addNewUserType();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "sys_add_new_component=success":

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','sys_component_action');
                break;
            }
        break;
        case 'sys_add_new_component':
            $oUSER->responseString = $oUSER->addNewSystemComponent();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "sys_add_new_component=success":

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','sys_component_action');
                break;
            }

        break;
        case 'insert_subtitle_element':
            $oUSER = $oUSER->processComponentMod($tmp_postid);

            switch($oUSER->responseString){
                case 'delete_subtitle=success':

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                break;
                case 'edit_subtitle=success':
                case "insert_subtitle_element=success":

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/subtitle/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID')."&cid=".$oUSER->returnNewElementID('COMPONENT_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','insert_subtitle_element');
                break;
            }
        break;
        case 'insert_paragraph_element':
            $oUSER = $oUSER->processComponentMod($tmp_postid);

            switch($oUSER->responseString){
                case 'delete_paragraph=success':

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                break;
                case 'edit_paragraph=success':
                case "insert_paragraph_element=success":

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/paragraph/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID')."&cid=".$oUSER->returnNewElementID('COMPONENT_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','insert_paragraph_element');
                break;
            }

        break;
        case 'insert_bullet_element':
            $oUSER = $oUSER->processComponentMod($tmp_postid);

            switch($oUSER->responseString){
                case 'delete_bulletlist=success':

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                break;
                case 'delete_bulletlist_bullet=success':
                case 'edit_bulletlist_bullet=success':
                case "insert_bullet_element=success":

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/bulletlist/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID')."&cid=".$oUSER->returnNewElementID('COMPONENT_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','insert_bullet_element');
                break;
            }

        break;
        case 'insert_schedule_element':
            $oUSER = $oUSER->processComponentMod($tmp_postid);
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case 'delete_schedule=success':

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                break;
                case 'edit_schedule_event=success':
                case "insert_schedule_element=success":

                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/schedule/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID')."&cid=".$oUSER->returnNewElementID('COMPONENT_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','insert_schedule_element');
                break;
            }

        break;
        case 'sys_add_new_color':
            $oUSER->responseString = $oUSER->addNewSystemColor();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "sys_add_new_color=success":

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','obs_edit_fullscrn_page_meta_simple');
                    break;
            }

        break;
        case 'update_page_bg_color':
            $oUSER->responseString = $oUSER->updatePageBGColor();

            switch($oUSER->responseString){
                case "update_page_bg_color=success":
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();
                break;
                default:
                    $oUSER->transactionStatusUpdate('error','obs_edit_fullscrn_page_meta_simple');
                break;
            }

        break;
        case 'update_page_bg_opacity':
            $oUSER->responseString = $oUSER->updatePageBGOpacity();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "update_page_bg_opacity=success":

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','obs_edit_fullscrn_page_meta_simple');
                break;
            }
        break;
        case 'edit_page_title':
            $oUSER->responseString = $oUSER->editPageTitle();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "edit_page_title=success":
                    //$oUSER->transactionStatusUpdate('success','create_fullscrn_overlay_page');
                    //$oUser->collectNewElementID('PAGE_ID', '');
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','edit_page_title');
                    break;
            }
        break;
        case 'new_page_title':
            $oUSER->responseString = $oUSER->addNewPageTitle();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "new_page_title=success":
                    //$oUSER->transactionStatusUpdate('success','create_fullscrn_overlay_page');
                    //$oUser->collectNewElementID('PAGE_ID', '');
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','new_page_title');
                    break;
            }
        break;
        case 'edit_page_header':
            $oUSER->responseString = $oUSER->editPageHeader();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "edit_page_header=success":
                    //$oUSER->transactionStatusUpdate('success','create_fullscrn_overlay_page');
                    //$oUser->collectNewElementID('PAGE_ID', '');
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','new_page_header');
                    break;
            }
        break;
        case 'new_page_header':
            $oUSER->responseString = $oUSER->addNewPageHeader();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "new_page_header=success":
                    //$oUSER->transactionStatusUpdate('success','create_fullscrn_overlay_page');
                    //$oUser->collectNewElementID('PAGE_ID', '');
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID')."&oid=".$oUSER->returnNewElementID('PROFILE_ID'));
                    exit();

                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','new_page_header');
                break;
            }
        break;
        case 'create_fullscrn_overlay_page':
            
            $oUSER->responseString = $oUSER->createFullScrnOverlayPage();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "create_fullscrn_overlay_page=success":
                    //$oUSER->transactionStatusUpdate('success','create_fullscrn_overlay_page');
                    //$oUser->collectNewElementID('PAGE_ID', '');
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/page/?pid=".$oUSER->returnNewElementID('PAGE_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','create_fullscrn_overlay_page');
                break;
            }

        break;
        case 'radio_select_mini_display_mode':

            $oUSER->responseString = $oUSER->obs_client_mini_display_mode();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "radio_select_mini_display_mode=success":
                    //$oUSER->transactionStatusUpdate('success','radio_select_fullscrn_overlay_profile');
                    //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
                    //exit();

                    //
                    // REOPEN THIS UI SECTION ON PAGE LOAD
                    $oUSER->section_open_onload = 'manage_visibility_mode';

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','manage_visibility_mode');

                break;
            }

        break;
        case 'btn_show_fullscrn_overlay':
        case 'btn_hide_fullscrn_overlay':

            $oUSER->responseString = $oUSER->obs_client_fullscrn_overlay_visibility();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "btn_show_fullscrn_overlay=success":
                case "btn_hide_fullscrn_overlay=success":
                    //$oUSER->transactionStatusUpdate('success','radio_select_fullscrn_overlay_profile');
                    //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
                    //exit();

                    //
                    // REOPEN THIS UI SECTION ON PAGE LOAD
                    $oUSER->section_open_onload = 'manage_visibility_mode';

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','manage_visibility_mode');

                break;
            }

        break;
        case 'btn_show_mini_overlay':
        case 'btn_hide_mini_overlay':

            $oUSER->responseString = $oUSER->obs_client_mini_overlay_visibility();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "btn_show_mini_overlay=success":
                case "btn_hide_mini_overlay=success":
                    //$oUSER->transactionStatusUpdate('success','radio_select_fullscrn_overlay_profile');
                    //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
                    //exit();

                    //
                    // REOPEN THIS UI SECTION ON PAGE LOAD
                    $oUSER->section_open_onload = 'manage_visibility_mode';

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','manage_visibility_mode');

                break;
            }

        break;
        case 'radio_select_fullscrn_overlay_profile':

            $oUSER->responseString = $oUSER->obs_client_profile_update_fullscrn();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "obs_client_profile_update_fullscrn=success":
                    //$oUSER->transactionStatusUpdate('success','radio_select_fullscrn_overlay_profile');
                    //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
                    //exit();

                    //
                    // REOPEN THIS UI SECTION ON PAGE LOAD
                    $oUSER->section_open_onload = 'obs_client_profile_update_fullscrn';

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','obs_client_profile_update_fullscrn');

                break;
            }

        break;
        case 'radio_select_mini_overlay_profile':

            $oUSER->responseString = $oUSER->obs_client_profile_update_mini();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "obs_client_profile_update_mini=success":
                    //$oUSER->transactionStatusUpdate('success','radio_select_mini_overlay_profile');
                    //header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
                    //exit();

                    //
                    // REOPEN THIS UI SECTION ON PAGE LOAD
                    $oUSER->section_open_onload = 'obs_client_profile_update_mini';

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','obs_client_profile_update_mini');
                break;
            }

        break;
        case 'create_fullscrn_overlay':
            $oUSER->responseString = $oUSER->createFullScrnOverlay();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "create_fullscrn_overlay=success":
                    $oUSER->transactionStatusUpdate('success','create_fullscrn_overlay');
                    //$oUser->collectNewElementID('PAGE_ID', '');
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/obs/edit/fullscrn/?pid=".$oUSER->returnNewElementID('FULLSCRN_PROFILE_ID'));
                    exit();

                break;
                default:
                    $oUSER->transactionStatusUpdate('error','create_fullscrn_overlay');
                break;
            }

        break;
        case 'accnt_activate_resend':
            $oUSER->responseString = $oUSER->processResendActivation();
            //error_log("AV Overlay session.inc.php (43) accnt_activate_resend response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "accnt_activate_resend=success":
                    $oUSER->transactionStatusUpdate('success','accnt_activate_resend');
                break;
                case "accnt_activate_resend=unknown":
                    $oUSER->transactionStatusUpdate('error','accnt_activate_resend_unknown');
                break;
                default:
                    $oUSER->transactionStatusUpdate('error','accnt_activate_resend');
                break;
            }

        break;
        case 'email_unsub':
            $oUSER->responseString = $oUSER->processEmailUnsub();
            //error_log("evifweb session (76) email_unsub response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "unsub=success":
                    $oUSER->transactionStatusUpdate('success','email_unsub');
                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','email_unsub');
                    break;
            }
        break;
        case 'pwd_reset':
            $oUSER->responseString = $oUSER->processPasswordReset();

            //error_log("evifweb session (88) pwd_reset response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "pwd_reset=success":
                    $oUSER->transactionStatusUpdate('success','pwd_reset');
                break;
                default:
                    $oUSER->errorMessage_ARRAY['mobile'] = "Error :: Oops...there was an error processing your password reset request. Please try again later (also make sure you use the email address on file for your account).";
                    $oUSER->transactionStatusUpdate('error','pwd_reset');
                break;
            }
        break;
        case 'pwd_update':
            $oUSER->responseString = $oUSER->processPasswordUpdate();
            //error_log("evifweb session (88) pwd_reset response->".$oUSER->responseString);

            switch($oUSER->responseString){
                case "pwd_update=success":
                    //
                    // REDIRECT TO LOGIN PAGE
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/signin/?reset=true");
                    exit();

                    break;
                default:
                    $oUSER->errorMessage_ARRAY['mobile'] = "Error :: Oops...I couldn\'t update your password. Please try again later. No changes were able to be made.";
                    $oUSER->transactionStatusUpdate('error','pwd_update');
                    break;
            }

        break;
        case 'contact_home':

            switch($oUSER->processHomeContact()){
                case 'success':
                    $oUSER->transactionStatusUpdate('success','contact_home');
                    break;
                default:
                    $oUSER->transactionStatusUpdate('error','contact_home');
                    break;

            }

        break;
        case 'signup_main':
            $oUSER->responseString = $oUSER->processNewSignup();

            error_log('44 session responseString ->'.$oUSER->responseString);

            switch($oUSER->responseString){
                case 'newuser=success':
                    //
                    // SEND TO CONFIRMATION PAGE
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."account/confirm/");
                    exit();

                break;
                case 'newuser=err_dup_email':
                    $oUSER->transactionStatusUpdate('error','signup_main_dup');
                break;
                default:
                    $oUSER->transactionStatusUpdate('error','signup_main');
                break;

            }

        break;
        case 'signin_main':
            $oUSER->responseString = $oUSER->processUserSignin();
            #error_log("evifweb session (48) ->".$oUSER->responseString);
            switch($oUSER->responseString){
                case 'signin=success':
                    //
                    // SEND TO CONFIRMATION PAGE
                    header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/");
                    exit();

                break;
                default:
                    #$oUSER->transactionStatusUpdate('error','signup_main');
                break;

            }

        break;
    }
}