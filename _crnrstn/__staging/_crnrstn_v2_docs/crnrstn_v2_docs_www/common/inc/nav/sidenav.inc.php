<?php
$tmp_ROOT_HTTP = $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');

?>
<div id="left_nav_section_wrapper_outter">
    <div id="left_nav_section_wrapper_inner">
        <div class="cb_10"></div>
        <ul class="sidenav_ul">
            <li class="sidenav_li first_elem"><a class="sidenav_lnk_category_title" href="#" target="_self">Suite Methods by Purpose</a>
                <div class="cb_10"></div>
                <ul class="sidenav_sub_ul">
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Configuration File'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/" target="_self">Configuration File</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/crnrstn/" target="_self">crnrstn()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/addenvironment/" target="_self">addEnvironment()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/initlogging/" target="_self">initLogging()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/adddatabase/" target="_self">addDatabase()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/grantexclusiveaccess/" target="_self">grantExclusiveAccess()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/denyaccess/" target="_self">denyAccess()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/initsessionencryption/" target="_self">initSessionEncryption()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/initcookieencryption/" target="_self">initCookieEncryption()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/inittunnelencryption/" target="_self">initTunnelEncryption()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/requireddetectionmatches/" target="_self">requiredDetectionMatches()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/configuration_file/defineenvresource/" target="_self">defineEnvResource()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Logging'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/logging/" target="_self">Logging</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/logging/error_log/" target="_self">error_log()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/logging/capturenotice/" target="_self">captureNotice()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Basic Functionality'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/" target="_self">Basic Functionality</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/getenvresource/" target="_self">getEnvResource()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/return_ocrnrstn_env/" target="_self">return_oCRNRSTN_ENV()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/isset_server_param/" target="_self">isset_SERVER_param()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/get_server_param/" target="_self">get_SERVER_param()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/highlightcode/" target="_self">highlightCode()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/highlighttext/" target="_self">highlightText()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/generatenewkey/" target="_self">generateNewKey()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/create_adhocvar/" target="_self">create_AdHocVar()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/basic_functionality/get_adhocvar/" target="_self">get_AdHocVar()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Device Detection'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/" target="_self">Device Detection</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/isclientmobile/" target="_self">isClientMobile()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/isclienttablet/" target="_self">isClientTablet()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/isclientmobilecustom/" target="_self">isClientMobileCustom()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/setclientmobile/" target="_self">setClientMobile()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/setclienttablet/" target="_self">setClientTablet()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/setclientmobilecustom/" target="_self">setClientMobileCustom()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/device_detection/resetdevicedetect/" target="_self">resetDeviceDetect()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Web Services'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/" target="_self">Web Services</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returncontent/" target="_self">returnContent()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnfault/" target="_self">returnFault()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnerror/" target="_self">returnError()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnresult/" target="_self">returnResult()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnclientrequest/" target="_self">returnClientRequest()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnclientresponse/" target="_self">returnClientResponse()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/web_services/returnclientgetdebug/" target="_self">returnClientGetDebug()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Date Time'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/" target="_self">Date Time</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/elapsedtimemonitorfor/" target="_self">elapsedTimeMonitorFor()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/prettydeltatime/" target="_self">prettyDeltaTime()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/date_time/walltime/" target="_self">wallTime()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('IP Address'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/" target="_self">IP Address</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/returnclientip/" target="_self">returnClientIP()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/exclusiveaccess/" target="_self">exclusiveAccess()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/ip_address/denyipaccess/" target="_self">denyIPAccess()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('HTTP Management'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/" target="_self">HTTP Management</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/isset_transport_protocol/" target="_self">isset_transport_protocol()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/isset_http_param/" target="_self">isset_HTTP_param()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/extract_http_paramvalue/" target="_self">extract_HTTP_paramValue()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/http_management/return_http_headers/" target="_self">return_HTTP_headers()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Cookie Management'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/" target="_self">Cookie Management</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/addcookie/" target="_self">addCookie()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/addrawcookie/" target="_self">addRawCookie()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/getcookie/" target="_self">getCookie()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/deletecookie/" target="_self">deleteCookie()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/cookie_management/deleteallcookies/" target="_self">deleteAllCookies()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Session Management'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/" target="_self">Session Management</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/getsessionparam/" target="_self">getSessionParam()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/setsessionparam/" target="_self">setSessionParam()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/session_management/issetsessionparam/" target="_self">issetSessionParam()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('HTTP Encryption Tunneling'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/" target="_self">HTTP Encryption Tunneling</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/paramtunnelencrypt/" target="_self">paramTunnelEncrypt()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/paramtunneldecrypt/" target="_self">paramTunnelDecrypt()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/tunnel_encryption/istunnelencryptconfigured/" target="_self">isTunnelEncryptConfigured()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('MySQL Database Query/Response'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/" target="_self">MySQL Database Query/Response</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnconnection_mysqli/" target="_self">returnConnection_MySQLi()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnconnobject/" target="_self">returnConnObject()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnconnserial/" target="_self">returnConnSerial()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/new_crnrstn_query_profile_manager/" target="_self">crnrstn_query_profile_manager()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/loadqueryprofile/" target="_self">loadQueryProfile()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/adddatabasequery/" target="_self">addDatabaseQuery()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/processquery/" target="_self">processQuery()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returndatabasevalue/" target="_self">returnDatabaseValue()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/initlookupbyid/" target="_self">initLookupByID()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/addlookupfielddata/" target="_self">addLookupFieldData()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/loadpreviousrecordlookup/" target="_self">loadPreviousRecordLookup()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/retrievedatabyid/" target="_self">retrieveDataByID()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/pingvalueexistence/" target="_self">pingValueExistence()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/pingresultsetexistence/" target="_self">pingResultSetExistence()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/resultsetmerge/" target="_self">resultSetMerge()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/returnrecordcount/" target="_self">returnRecordCount()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/return_querydatetimestamp/" target="_self">return_queryDateTimeStamp()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/mysql_database/closeconnection_mysqli/" target="_self">closeConnection_MySQLi()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Form Handling'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/" target="_self">Form Handling</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/initfi_handle/" target="_self">initFI_handle()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/addfi_input_listener/" target="_self">addFI_Input_Listener()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/addfi_hiddeninput_listener/" target="_self">addFI_HiddenInput_Listener()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/redirectfi_onvalidation/" target="_self">redirectFI_OnValidation()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/errmsgfi_inputvalidation/" target="_self">errMsgFI_InputValidation()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/inputfi_prepopulateValue/" target="_self">inputFI_PrepopulateValue()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/injectfi_serializedpack/" target="_self">injectFI_SerializedPack()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/receivefi_packet/" target="_self">receiveFI_Packet()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/returnvalue_datafi_input/" target="_self">returnValue_dataFI_Input()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/isvalid_datafi_validcheck/" target="_self">isValid_dataFI_ValidCheck()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/form_handling/returnerr_datafi_validcheck/" target="_self">returnErr_dataFI_ValidCheck()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Pagination'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/" target="_self">Pagination</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/totalpgnate_results_increment/" target="_self">totalPGNATE_results_increment()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/setpgnate_max_result_count/" target="_self">setPGNATE_max_result_count()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/returnpgnate_serial/" target="_self">returnPGNATE_Serial()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/specifypgnate_httpvar/" target="_self">specifyPGNATE_HTTPVar()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/addpgnate_passthroughinputVal/" target="_self">addPGNATE_PassthroughInputVal()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/pagination/returnpgnate_currentpage/" target="_self">returnPGNATE_CurrentPage()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Email Messaging'); ?>"><a class="sidenav_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/" target="_self">Email Messaging</a>
                        <ul class="sidenav_sub_sub_ul">
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/initialize_ogabriel/" target="_self">initialize_oGabriel()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addhostservers/" target="_self">addHostServers()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addreplyto/" target="_self">addReplyTo()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addfrom/" target="_self">addFrom()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/wordwrap/" target="_self">wordWrap()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ishtml/" target="_self">isHTML()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addsubject/" target="_self">addSubject()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addmsgbody_htmlversion/" target="_self">addMsgBody_HTMLversion()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addmsgbody_textversion/" target="_self">addMsgBody_TEXTversion()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/suppressemailduplicates/" target="_self">suppressEmailDuplicates()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/optoutdonotsendemail/" target="_self">optOutDoNotSendEmail()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addaddress/" target="_self">addAddress()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addcc/" target="_self">addCC()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addbcc/" target="_self">addBCC()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_subject/" target="_self">addDynamicContent_SUBJECT()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_html/" target="_self">addDynamicContent_HTML()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_text/" target="_self">addDynamicContent_TEXT()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/adddynamiccontent_multipart/" target="_self">addDynamicContent_MULTIPART()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ogabriel_send/" target="_self">oGabriel_Send()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ogabriel_sendreport/" target="_self">oGabriel_SendReport()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/sendstatusreportemail/" target="_self">sendStatusReportEmail()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/ishtmlbulk/" target="_self">isHTMLBulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addaddressbulk/" target="_self">addAddressBulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addhtmlver_bulk/" target="_self">addHTMLver_Bulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addtextver_bulk/" target="_self">addTEXTver_Bulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addfrombulk/" target="_self">addFromBulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/wordwrapbulk/" target="_self">wordWrapBulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addreplytobulk/" target="_self">addReplyToBulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/addsubjectbulk/" target="_self">addSubjectBulk()</a></li>
                            <li class="sidenav_sub_sub_li"><a class="sidenav_sub_sub_lnk_title" href="<?php echo $tmp_ROOT_HTTP; ?>suite_methods/email_messaging/batchreadytosend/" target="_self">batchReadyToSend()</a></li>
                        </ul>
                    </li>
                    <div class="cb_5"></div>
                    <li class="sidenav_sub_li<?php echo $oSideBitch_Usr->navActiveState('Multi-Language Plug/Play'); ?>" style="border-bottom: 1px;"><a class="sidenav_sub_lnk_title" href="#" target="_self">Multi-Language Plug/Play</a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>