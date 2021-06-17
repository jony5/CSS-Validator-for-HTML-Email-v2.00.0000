<?php

$mobileBOOL = $oCRNRSTN_USR->isClientMobile();
if($mobileBOOL){
    //
    // MOBILE DEVICE SPECIFIC CONTENT
    ?>

    <div data-role="footer" data-theme="a" data-content-theme="a">
        <h4>&copy; <?php  echo date("Y"); ?> All Rights Reserved.</h4>

    </div><!-- /footer -->
    <div class="hidden">
        <!-- GLOBAL XHR SUPPORT CONTAINERS -->

        <?php
        //if($xcp==true){
        ?>
        <form action="#" method="post" name="xhr_sync_proxy" id="xhr_sync_proxy"  enctype="multipart/form-data">
            <input type="hidden" name="postid" value="xhr_sync_proxy">
            <input type="hidden" id="xcp_json_serial_js_handle" name="xcp_json_serial_js_handle" value="">
            <input type="hidden" id="xcp_json_object_type" name="xcp_json_object_type" value="">
            <input type="hidden" id="xcp_input_dom_element_type" name="xcp_input_dom_element_type" value="">
            <input type="hidden" id="xcp_input_dom_element_id" name="xcp_input_dom_element_id" value="">
            <input type="hidden" id="xcp_element_id" name="xcp_element_id" value="">
            <input type="hidden" id="xcp_element_id_translation" name="xcp_element_id_translation" value="">
            <input type="hidden" id="xcp_copy_id" name="xcp_copy_id" value="">
            <input type="hidden" id="xcp_component_id" name="xcp_component_id" value="">
            <input type="hidden" id="xcp_page_id" name="xcp_page_id" value="">
            <input type="hidden" id="xcp_profile_id" name="xcp_profile_id" value="">
            <input type="hidden" id="xcp_copy_hash" name="xcp_copy_hash" value="">
            <input type="hidden" id="xcp_lang_id" name="xcp_lang_id" value="">
            <input type="hidden" id="xcp_lang_id_translator" name="xcp_lang_id_translator" value="">
            <input type="hidden" id="xcp_profile_type" name="xcp_profile_type" value="">
            <input type="hidden" id="xcp_component_type" name="xcp_component_type" value="">
            <input type="hidden" id="xcp_element_copy" name="xcp_element_copy" value="">
            <input type="hidden" id="xcp_completion_state" name="xcp_completion_state" value="">
            <input type="hidden" id="xcp_draft_owner" name="xcp_draft_owner" value="">
            <input type="hidden" id="xcp_date_translation_drafted" name="xcp_date_translation_drafted" value="">
            <input type="hidden" id="xcp_lock" name="xcp_lock" value="">
            <input type="hidden" id="xcp_isactive" name="xcp_isactive" value="">
            <input type="hidden" id="xcp_date_translation_published" name="xcp_date_translation_published" value="">
        </form>
        <?php
        //}
        ?>

        <div id="ajax_root"><?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>
        <div id="timer_copy_persist">0:00:00</div>
        <div id="cache_bust">12345</div>

    </div>

    <?php

}else{
    //
    // DESKTOP DEVICE SPECIFIC CONTENT

    ?>
<div class="cb_3"></div>
<div class="crnrstn_footer_wrapper">
    <div class="crnrstn_footer_copy_wrapper">
        <div class="crnrstn_footer_copyright">&copy; <?php echo date('Y'); ?> Jonathan 'J5' Harris :: All Rights Reserved.</div>
        <div class="crnrstn_s5_footer"><a href="http://jony5.com" target="_blank"><img src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/5.gif" width="16" height="16" alt="J5" title="J5" /></a></div>
    </div>
</div>
<div class="hidden">
    <div id="ajax_root"><?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>
    <div id="timer_copy_persist">0:00:00</div>
    <div id="timer_lck">OFF</div>
    <div id="cache_bust">12345</div>
    <div id="curr_search_profile"></div>
</div>
<?php

    if($oCRNRSTN_USR->isTunnelEncryptConfigured()){

        //echo "<div style='padding:40px; font-size: 20px; color: #0066CC;'>Tunnel up!</div>";

    }else{

        //echo "<div style='color:#FF0000; padding:40px; font-size: 20px; font-weight: bold;'>Tunnel down...</div>";

    }
}

$oCRNRSTN_USR->error_log('hello crnrstn error_log',__LINE__, __METHOD__, __FILE__);

$tmp_electrum_auth_BOOL = $oCRNRSTN_USR->getEnvResource('ELECTRUM_TEST_AUTH');
$tmp_ip_auth_BOOL = $oCRNRSTN_USR->exclusiveAccess('73.184.64.182,172.16.195.1');
$tmp_curr_env_BOOL = $oCRNRSTN_USR->isCurrentEnvironment('LOCALHOST_PRO');

if($tmp_ip_auth_BOOL && $tmp_electrum_auth_BOOL && $tmp_curr_env_BOOL){

    if($tmp_curr_env_BOOL){

        $ftp_server = '';
        $username = '';
        $password = '';
        $port = 21;
        $timeout = 90;

        $local_dir_path_SOURCE00 = '/var/www/html/_backup_test/crnrstn_v2/';
        $local_dir_path_SOURCE01 = '/var/www/html/_backup_test/source01/';
        $local_dir_path_DEST00 = '/var/www/html/_backup_test/dest00/';
        $local_dir_path_DEST01 = '/var/www/html/_backup_test/dest01/';
        $local_dir_path_DEST_FLAT = '/var/www/html/_backup_test/dest01FLAT/';

        $FtpToFtp_tmp_dirPath = '/var/www/html/_backup_test/_tmp/';

        //
        // NEW WILD CARD RESOURCE - FTP
        $oWCR = $oCRNRSTN_USR->defineWildCardResource('ELECTRUM_DESTINATION_FTP420');
        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', true);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->addAttribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420_FTP_WCR/');
        $oWCR->addAttribute('FTP_MKDIR_MODE', 777);

        $oCRNRSTN_USR->saveWildCardResource($oWCR);

        //
        // NEW WILD CARD RESOURCE - FTP
        $oWCR = $oCRNRSTN_USR->defineWildCardResource('ELECTRUM_NOTIFICATIONS');
        $oWCR->addAttribute('EMAIL', 'email@DOMAIN.com, jharris@eVifweb.com');
        $oWCR->addAttribute('NAME', 'Jonathan J5 Harris, Jonathan Harris');

        $oCRNRSTN_USR->saveWildCardResource($oWCR);

        //
        // BLUEHOST
        $cipher_override = 'AES-256-CTR';
        $secret_key_override = 'this-Is-the-encryption-key';
        $hmac_algorithm_override = 'ripemd256';
        $options_bitwise_override = OPENSSL_RAW_DATA;

        //
        // MAC
        //$cipher_override = 'AES-192-OFB';
        //$secret_key_override = 'hello-there-mr-encryption-key';
        //$hmac_algorithm_override = 'sha256';
        //$options_bitwise_override = OPENSSL_RAW_DATA;
        $WSDL_cache_ttl = 80;
        $nusoap_useCURL = true;

        //$SOAP_endpoint = 'http://172.16.195.132/crnrstn_v2/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl';
        $SOAP_endpoint = $oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_WSDL_ENDPOINT');
        $oCRNRSTN_USR->SOAP_tunnelEncryptProfile($SOAP_endpoint, $secret_key_override, $cipher_override, $hmac_algorithm_override, $options_bitwise_override);
        $oCRNRSTN_USR->SOAP_WSDL_connectionProfile($SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);
        $oCRNRSTN_USR->ini_set('max_execution_time', 0);

        //
        // BEGIN ELECTRUM USE CASE TESTING
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->initElectrum_FileCopy($FtpToFtp_tmp_dirPath, 'Ymd_H-i-s');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->initElectrum_FileCopy($FtpToFtp_tmp_dirPath);
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_doNotPassDiskUsagePercent($CRNRSTN_oELECTRUM, 92);

        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_initNotifications($CRNRSTN_oELECTRUM,'Jonathan Harris c00000101@gmail.com|j5@jony5.com|Jonathan J5 Harris jharris@eVifweb.com|Jonathan Suppress Harris j5@jony5.com', 'EMAIL_PROXY', $SOAP_endpoint);

        //
        // USE CUSTOM/IN-LINE ENTRY
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_FTP00');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addSourceLOCAL($CRNRSTN_oELECTRUM, $local_dir_path_SOURCE00);
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addSourceLOCAL_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_DIR01');

        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_deleteSourceData_OnSuccess($CRNRSTN_oELECTRUM, $local_dir_path_SOURCE00, true);

        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_DIR($CRNRSTN_oELECTRUM, '*ment/*', 'ELECTRUM_SOURCE_FTP00');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_FILE($CRNRSTN_oELECTRUM, '.DS_Store');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_DIR($CRNRSTN_oELECTRUM, '*ing/*');

        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, '1 month');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, '12 hours');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, '1 month');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, '10 days');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, 'jony5');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, 'jony5');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, 40000);
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, 150);

        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addDestinationFTP_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_FTP420');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addDestinationLOCAL($CRNRSTN_oELECTRUM, $local_dir_path_DEST00, 777);
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_DIR420');

        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addFlattenedDestinationLOCAL($CRNRSTN_oELECTRUM, $local_dir_path_DEST_FLAT, 777);
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addFlattenedDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_DIR420FLAT');
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addFlattenedDestinationFTP_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_FTP420FLAT');


        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_EXECUTE($CRNRSTN_oELECTRUM);
/*
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_clearExclusions($CRNRSTN_oELECTRUM);

        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_FTP00');
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addDestinationDIR_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_DIR00');
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addDestinationFTP_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_FTP420');


        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_EXECUTE($CRNRSTN_oELECTRUM);
        //$CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_closeConnections($CRNRSTN_oELECTRUM);

        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_FTP01');
        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_addDestinationDIR_WCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_DIR01');

        $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_EXECUTE($CRNRSTN_oELECTRUM);
        //$oCRNRSTN_USR->electrum_closeConnections($CRNRSTN_oELECTRUM);
*/

        // [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
        echo '<div style="width:1200px; overflow-x: scroll;"><div style="width:3000px;">';
        $oCRNRSTN_USR->get_errorLogTrace('SCREEN_HTML', 'CRNRSTN_oELECTRUM_COMM', __LINE__, __METHOD__, __FILE__);
        echo '</div></div>';

        //$oCRNRSTN_USR->get_errorLogTrace();

    }

}

/**
*
//
// MODIFY CUSTOM/GLOBAL HANDLING OF ERROR IN SPECIFIC ENVIRONMENT
$tmp_curr_env = $oCRNRSTN_USR->isCurrentEnvironment('CYEXX_SYSTEMS');
if($tmp_curr_env){

    // NATIVE PHP ERROR HANDLING FOR ALL ERROR
    $oCRNRSTN_USR->crnrstn_error_ownership(false);

    // CRNRSTN HANDLES ALL ERROR
    // $oCRNRSTN_USR->crnrstn_error_ownership();

    // CRNRSTN HANDLES ALL ERROR, BUT SAVES E_NOTICE && E_WARNING FOR NATIVE PHP TO HANDLE
    // $oCRNRSTN_USR->crnrstn_error_ownership(true, ~E_NOTICE && ~E_WARNING);

    // THROW SOME SILLY ERRORS
    $tmp_ = $oCRNRSTN_USR->get_SERVER_param('CLOWN_TOWN');

}
*
*/

?>