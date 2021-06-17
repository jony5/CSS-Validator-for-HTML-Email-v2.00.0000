<?php
$tmp_ROOT_HTTP = $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');

?>
<div data-role="panel" id="leftpanel_nav">
    <a href="#close_lnk" data-rel="close" data-icon="delete" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini ui-btn-icon-right">Close</a>
    <p><strong>Welcome, friend ::</strong></p>
    <div data-role="collapsibleset" data-theme="a" data-content-theme="a">
        <div>
            <h3>Suite Methods by Purpose</h3>
            <ul data-role="listview" data-theme="a">
                <li><a href="#popupConfigFile" data-rel="popup" data-transition="slideup">Configuration File</a></li>
                <li><a href="#popupLogging" data-rel="popup" data-transition="slideup">Logging</a></li>
                <li><a href="#popupBasicFunctionality" data-rel="popup" data-transition="slideup">Basic Functionality</a></li>
                <li><a href="#popupMobiDetect" data-rel="popup" data-transition="slideup">Device Detection</a></li>
                <li><a href="#popupWebServices" data-rel="popup" data-transition="slideup">Web Services</a></li>
                <li><a href="#popupDateTime" data-rel="popup" data-transition="slideup">Date Time</a></li>
                <li><a href="#popupIPAddress" data-rel="popup" data-transition="slideup">IP Address</a></li>
                <li><a href="#popupHTTPMgmt" data-rel="popup" data-transition="slideup">HTTP Management</a></li>
                <li><a href="#popupCookieMgmt" data-rel="popup" data-transition="slideup">Cookie Management</a></li>
                <li><a href="#popupSessionMgmt" data-rel="popup" data-transition="slideup">Session Management</a></li>
                <li><a href="#popupHTTPTunnel" data-rel="popup" data-transition="slideup">HTTP Encryption Tunneling</a></li>
                <li><a href="#popupMySQLDB" data-rel="popup" data-transition="slideup">MySQL Database Query/Response</a></li>
                <li><a href="#popupFormHandling" data-rel="popup" data-transition="slideup">Form Handling</a></li>
                <li><a href="#popupPagination" data-rel="popup" data-transition="slideup">Pagination</a></li>
                <li><a href="#popupEmailMessaging" data-rel="popup" data-transition="slideup">Email Messaging</a></li>
                <li><a href="#popupMultiLang" data-rel="popup" data-transition="slideup">Multi-Language Plug/Play</a></li>
            </ul>
        </div>
    </div>

    <div data-role="popup" id="popupConfigFile" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/crnrstn/" target="_self" data-ajax="false">crnrstn()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/addenvironment/" target="_self" data-ajax="false">addEnvironment()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/initlogging/" target="_self" data-ajax="false">initLogging()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/adddatabase/" target="_self" data-ajax="false">addDatabase()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/grantexclusiveaccess/" target="_self" data-ajax="false">grantExclusiveAccess()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/denyaccess/" target="_self" data-ajax="false">denyAccess()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/initsessionencryption/" target="_self" data-ajax="false">initSessionEncryption()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/initcookieencryption/" target="_self" data-ajax="false">initCookieEncryption()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/inittunnelencryption/" target="_self" data-ajax="false">initTunnelEncryption()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/requireddetectionmatches/" target="_self" data-ajax="false">requiredDetectionMatches()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/defineenvresource/" target="_self" data-ajax="false">defineEnvResource()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupLogging" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/logging/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/logging/error_log/" target="_self" data-ajax="false">error_log()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/logging/capturenotice/" target="_self" data-ajax="false">captureNotice()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupBasicFunctionality" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/getenvresource/" target="_self" data-ajax="false">getEnvResource()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/return_ocrnrstn_env/" target="_self" data-ajax="false">return_oCRNRSTN_ENV()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/isset_server_param/" target="_self" data-ajax="false">isset_SERVER_param()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/get_server_param/" target="_self" data-ajax="false">get_SERVER_param()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/highlightcode/" target="_self" data-ajax="false">highlightCode()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/highlighttext/" target="_self" data-ajax="false">highlightText()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/generatenewkey/" target="_self" data-ajax="false">generateNewKey()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/create_adhocvar/" target="_self" data-ajax="false">create_AdHocVar()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/get_adhocvar/" target="_self" data-ajax="false">get_AdHocVar()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupMobiDetect" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/isclientmobile/" target="_self" data-ajax="false">isClientMobile()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/isclienttablet/" target="_self" data-ajax="false">isClientTablet()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/isclientmobilecustom/" target="_self" data-ajax="false">isClientMobileCustom()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/setclientmobile/" target="_self" data-ajax="false">setClientMobile()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/setclienttablet/" target="_self" data-ajax="false">setClientTablet()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/setclientmobilecustom/" target="_self" data-ajax="false">setClientMobileCustom()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/resetdevicedetect/" target="_self" data-ajax="false">resetDeviceDetect()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupWebServices" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returncontent/" target="_self" data-ajax="false">returnContent()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnfault/" target="_self" data-ajax="false">returnFault()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnerror/" target="_self" data-ajax="false">returnError()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnresult/" target="_self" data-ajax="false">returnResult()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnclientrequest/" target="_self" data-ajax="false">returnClientRequest()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnclientresponse/" target="_self" data-ajax="false">returnClientResponse()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnclientgetdebug/" target="_self" data-ajax="false">returnClientGetDebug()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupDateTime" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/elapsedtimemonitorfor/" target="_self" data-ajax="false">elapsedTimeMonitorFor()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/prettydeltatime/" target="_self" data-ajax="false">prettyDeltaTime()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/walltime/" target="_self" data-ajax="false">wallTime()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupIPAddress" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/returnclientip/" target="_self" data-ajax="false">returnClientIP()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/exclusiveaccess/" target="_self" data-ajax="false">exclusiveAccess()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/denyipaccess/" target="_self" data-ajax="false">denyIPAccess()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupHTTPMgmt" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/isset_transport_protocol/" target="_self" data-ajax="false">isset_transport_protocol()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/isset_http_param/" target="_self" data-ajax="false">isset_HTTP_param()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/extract_http_paramvalue/" target="_self" data-ajax="false">extract_HTTP_paramValue()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/return_http_headers/" target="_self" data-ajax="false">return_HTTP_headers()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupCookieMgmt" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/addcookie/" target="_self" data-ajax="false">addCookie()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/addrawcookie/" target="_self" data-ajax="false">addRawCookie()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/getcookie/" target="_self" data-ajax="false">getCookie()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/deletecookie/" target="_self" data-ajax="false">deleteCookie()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/deleteallcookies/" target="_self" data-ajax="false">deleteAllCookies()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupSessionMgmt" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/getsessionparam/" target="_self" data-ajax="false">getSessionParam()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/setsessionparam/" target="_self" data-ajax="false">setSessionParam()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/issetsessionparam/" target="_self" data-ajax="false">issetSessionParam()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupHTTPTunnel" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/paramtunnelencrypt/">paramTunnelEncrypt()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/paramtunneldecrypt/">paramTunnelDecrypt()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/istunnelencryptconfigured/">isTunnelEncryptConfigured()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupMySQLDB" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnconnection_mysqli/" target="_self" data-ajax="false">returnConnection_MySQLi()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnconnobject/" target="_self" data-ajax="false">returnConnObject()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnconnserial/" target="_self" data-ajax="false">returnConnSerial()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/new_crnrstn_query_profile_manager/" target="_self" data-ajax="false">crnrstn_query_profile_manager()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/loadqueryprofile/" target="_self" data-ajax="false">loadQueryProfile()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/adddatabasequery/" target="_self" data-ajax="false">addDatabaseQuery()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/processquery/" target="_self" data-ajax="false">processQuery()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returndatabasevalue/" target="_self" data-ajax="false">returnDatabaseValue()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/initlookupbyid/" target="_self" data-ajax="false">initLookupByID()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/addlookupfielddata/" target="_self" data-ajax="false">addLookupFieldData()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/loadpreviousrecordlookup/" target="_self" data-ajax="false">loadPreviousRecordLookup()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/retrievedatabyid/" target="_self" data-ajax="false">retrieveDataByID()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/pingvalueexistence/" target="_self" data-ajax="false">pingValueExistence()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/pingresultsetexistence/" target="_self" data-ajax="false">pingResultSetExistence()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/resultsetmerge/" target="_self" data-ajax="false">resultSetMerge()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnrecordcount/" target="_self" data-ajax="false">returnRecordCount()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/return_querydatetimestamp/" target="_self" data-ajax="false">return_queryDateTimeStamp()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/closeconnection_mysqli/" target="_self" data-ajax="false">closeConnection_MySQLi()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupFormHandling" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/initfi_handle/" target="_self" data-ajax="false">initFI_handle()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/addfi_input_listener/" target="_self" data-ajax="false">addFI_Input_Listener()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/addfi_hiddeninput_listener/" target="_self" data-ajax="false">addFI_HiddenInput_Listener()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/redirectfi_onvalidation/" target="_self" data-ajax="false">redirectFI_OnValidation()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/errmsgfi_inputvalidation/" target="_self" data-ajax="false">errMsgFI_InputValidation()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/inputfi_prepopulateValue/" target="_self" data-ajax="false">inputFI_PrepopulateValue()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/injectfi_serializedpack/" target="_self" data-ajax="false">injectFI_SerializedPack()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/receivefi_packet/" target="_self" data-ajax="false">receiveFI_Packet()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/returnvalue_datafi_input/" target="_self" data-ajax="false">returnValue_dataFI_Input()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/isvalid_datafi_validcheck/" target="_self" data-ajax="false">isValid_dataFI_ValidCheck()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/returnerr_datafi_validcheck/" target="_self" data-ajax="false">returnErr_dataFI_ValidCheck()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupPagination" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/totalpgnate_results_increment/" target="_self" data-ajax="false">totalPGNATE_results_increment()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/setpgnate_max_result_count/" target="_self" data-ajax="false">setPGNATE_max_result_count()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/returnpgnate_serial/" target="_self" data-ajax="false">returnPGNATE_Serial()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/specifypgnate_httpvar/" target="_self" data-ajax="false">specifyPGNATE_HTTPVar()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/addpgnate_passthroughinputVal/" target="_self" data-ajax="false">addPGNATE_PassthroughInputVal()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/returnpgnate_currentpage/" target="_self" data-ajax="false">returnPGNATE_CurrentPage()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupEmailMessaging" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/initialize_ogabriel/" target="_self" data-ajax="false">initialize_oGabriel()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addhostservers/" target="_self" data-ajax="false">addHostServers()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addreplyto/" target="_self" data-ajax="false">addReplyTo()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addfrom/" target="_self" data-ajax="false">addFrom()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/wordwrap/" target="_self" data-ajax="false">wordWrap()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ishtml/" target="_self" data-ajax="false">isHTML()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addsubject/" target="_self" data-ajax="false">addSubject()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addmsgbody_htmlversion/" target="_self" data-ajax="false">addMsgBody_HTMLversion()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addmsgbody_textversion/" target="_self" data-ajax="false">addMsgBody_TEXTversion()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/suppressemailduplicates/" target="_self" data-ajax="false">suppressEmailDuplicates()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/optoutdonotsendemail/" target="_self" data-ajax="false">optOutDoNotSendEmail()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addaddress/" target="_self" data-ajax="false">addAddress()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addcc/" target="_self" data-ajax="false">addCC()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addbcc/" target="_self" data-ajax="false">addBCC()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_subject/" target="_self" data-ajax="false">addDynamicContent_SUBJECT()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_html/" target="_self" data-ajax="false">addDynamicContent_HTML()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_text/" target="_self" data-ajax="false">addDynamicContent_TEXT()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_multipart/" target="_self" data-ajax="false">addDynamicContent_MULTIPART()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ogabriel_send/" target="_self" data-ajax="false">oGabriel_Send()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ogabriel_sendreport/" target="_self" data-ajax="false">oGabriel_SendReport()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ishtmlbulk/" target="_self" data-ajax="false">isHTMLBulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addaddressbulk/" target="_self" data-ajax="false">addAddressBulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addhtmlver_bulk/" target="_self" data-ajax="false">addHTMLver_Bulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addtextver_bulk/" target="_self" data-ajax="false">addTEXTver_Bulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addfrombulk/" target="_self" data-ajax="false">addFromBulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/wordwrapbulk/" target="_self" data-ajax="false">wordWrapBulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addreplytobulk/" target="_self" data-ajax="false">addReplyToBulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addsubjectbulk/" target="_self" data-ajax="false">addSubjectBulk()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/batchreadytosend/" target="_self" data-ajax="false">batchReadyToSend()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/sendstatusreportemail/" target="_self" data-ajax="false">sendStatusReportEmail()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupMultiLang" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/multi_language/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/multi_language/isclientmobile/" target="_self" data-ajax="false">isClientMobile()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/multi_language/isclientmobile/" target="_self" data-ajax="false">isClientMobile()</a></li>
            <li><a href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/multi_language/isclientmobile/" target="_self" data-ajax="false">isClientMobile()</a></li>
        </ul>
    </div>

</div><!-- /panel -->