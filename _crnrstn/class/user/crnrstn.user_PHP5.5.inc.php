<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_user
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: We put a hood on CRNRSTN ::,...complete with seats and a steering wheel...for the user.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_user{


    protected $oLogger;
    private static $oCRNRSTN_ENV;
    private static $oDB_CRNRSTN;
    private static $oRedirectCntrlr;
    private static $oMySQLi_ARRAY = array();
    private static $oMySQLi_hash_ARRAY = array();
    private static $oSqlSilo;
    private static $oPaginator;
    private static $oCommRichMediaProvider;
    private static $oSoapClient;
    private static $oCRNRSTN_CSS_VALIDATOR;
    public $oCRNRSTN_BITFLIP_MGR;
    protected $ini_set_ARRAY = array();
    
    public $configSerial;
    private static $resourceKey;

    private static $oLog_ProfileManager;
    private static $sys_logging_profile_ARRAY = array();
    private static $sys_logging_endpoint_ARRAY = array();
    private static $sys_logging_wcr_ARRAY = array();
    private static $sys_logging_update_profile_ARRAY = array();
    private static $sys_logging_update_endpoint_ARRAY = array();

    public $cache_ttl_default = 80;
    public $useCURL_default = true;
    protected $secret_key_override_ARRAY = array();
    protected $cipher_override_ARRAY = array();
    protected $hmac_algorithm_override_ARRAY = array();
    protected $options_bitwise_override_ARRAY = array();
    protected $WSDL_cache_ttl_ARRAY = array();
    protected $nusoap_useCURL_ARRAY = array();

    public $mobi_detect;
    public $isMobile;
    public $isTablet;

    public $customClientDevice = array();

    private static $form_handle_ARRAY = array();
    private static $form_input_general_ARRAY = array();
    private static $form_input_hidden_ARRAY = array();
    private static $formIntegrationPacket_ARRAY = array();
    private static $formIntegrationPacketReceived_ARRAY = array();
    private static $http_param_handle_ARRAY = array();
    private static $formIntegrationValid_ARRAY = array();
    private static $formIntegrationErr_ARRAY = array();
    private static $adHocVariable_ARRAY = array();

    public $query_ttl;
    public $oLog_output_ARRAY = array();
    public $starttime;
    public $CRNRSTN_debugMode;
    public $PHPMAILER_debugMode;
    public $log_silo_profile;
    public $env_cleartext_name;
    public $tmp_wcr_config_envKey;
    public $sys_notices_creative_mode;
    public $sys_notice_creative_http_path;

    protected $oMessenger_ARRAY = array();
    private static $bitwise_serialization_cnt = 0;
    protected $destruct_output = '';
    public $colorScheme;

    private static $lang_content_ARRAY = array();
    public $version_crnrstn;
    public $version_apache;
    public $version_apache_sysimg;
    public $version_php;
    public $version_mysqli;

    public function __construct($oCRNRSTN_ENV){

        //
        // STORE CRNRSTN :: ENVIRONMENTALS
        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->configSerial = self::$oCRNRSTN_ENV->configSerial;
        $this->oCRNRSTN_BITFLIP_MGR = self::$oCRNRSTN_ENV->oCRNRSTN_BITFLIP_MGR;
        self::$resourceKey = self::$oCRNRSTN_ENV->returnResourceKey();
        $this->oLog_output_ARRAY = $oCRNRSTN_ENV->oLog_output_ARRAY;
        $this->starttime = $oCRNRSTN_ENV->starttime;
        $this->CRNRSTN_debugMode = $oCRNRSTN_ENV->CRNRSTN_debugMode;
        $this->PHPMAILER_debugMode = $oCRNRSTN_ENV->PHPMAILER_debugMode;
        $this->colorScheme = $oCRNRSTN_ENV->colorScheme;
        $this->version_crnrstn = $oCRNRSTN_ENV->version_crnrstn;
        $this->version_apache = $oCRNRSTN_ENV->version_apache;
        $this->version_apache_sysimg = $oCRNRSTN_ENV->version_apache_sysimg;
        $this->version_php = $oCRNRSTN_ENV->version_php;

        $this->log_silo_profile = $oCRNRSTN_ENV->log_silo_profile;
        $this->tmp_wcr_config_envKey = $this->env_cleartext_name = $oCRNRSTN_ENV->env_cleartext_name;
        $this->sys_notices_creative_mode = $oCRNRSTN_ENV->sys_notices_creative_mode;
        $this->sys_notice_creative_http_path = $oCRNRSTN_ENV->sys_notice_creative_http_path;
        self::$oLog_ProfileManager = $oCRNRSTN_ENV->return_oLog_ProfileManager();
        self::$oLog_ProfileManager->sync_to_environment(NULL, $oCRNRSTN_ENV, $this);

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($this->CRNRSTN_debugMode, __CLASS__, $this->log_silo_profile, $this);

        //
        // INITIALIZE CRNRSTN :: ERROR HANDLING
        $this->initializeErrorHandling();

        //
        // CLEAR ENV oLOG OUTPUT ARRAY TO FREE MEMORY
        array_splice($oCRNRSTN_ENV->oLog_output_ARRAY, 0);

        self::$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->initialize_oCRNRSTN_USR($this);
        self::$oCRNRSTN_ENV->oCOOKIE_MGR->initialize_oCRNRSTN_USR($this);
        self::$oCRNRSTN_ENV->oSESSION_MGR->initialize_oCRNRSTN_USR($this);

        //
        // INSTANTIATE CRNRSTN :: SYSTEM EMAIL CONTENT HELPER CLASS
        self::$oCommRichMediaProvider = new crnrstn_image_v_html_content_manager($this);

        //
        // INSTANTIATE QUERY SILO
        self::$oSqlSilo = new crnrstn_database_sql_silo($this);

        //
        // INSTANTIATE DATABASE CONNECTION/QUERY/RESPONSE HANDLING INTEGRATIONS CRNRSTN
        self::$oDB_CRNRSTN = new crnrstn_database_crnrstn($this);

        //
        // INSTANTIATE REDIRECT CONTROLLER
        self::$oRedirectCntrlr = new crnrstn_redirect_controller($this);

        //
        // INSTANTIATE PAGINATOR
        self::$oPaginator = new crnrstn_results_paginator($this);

        self::$lang_content_ARRAY = self::$oCRNRSTN_ENV->return_lang_content_ARRAY();

    }

    public function __SOAP_service_listen(){

        if(!$this->isset_HTTPSuper('GET')){
            error_log(__LINE__.' '.__METHOD__.' WE HAVE NO _GET....');
            //if($oCRNRSTN_USR->exclusiveAccess('184.173.96.66, 50.87.249.11, 172.16.110.130, 172.16.*')){

            //$server->service(file_get_contents('php://input'));

            //}else{

            //    $oCRNRSTN_USR->returnSrvrRespStatus(403);

            //}

            //$this->print_r(file_get_contents('php://input'));


        }else{
            error_log(__LINE__.' '.__METHOD__.' WE HAVE _GET....');

            if($this->http){


            }

            $this->print_r(file_get_contents('php://input'),'SOAP LISTENER TEST',NULL, __LINE__,__METHOD__,__FILE__);
            //$server->service(file_get_contents('php://input'));

        }

        //$this->print_r("die();");
        error_log(__LINE__.' '.__METHOD__.' WE HAVE die()....');

        //die();
    }

    public function return_active_log_silo_keys($output_type = 'string'){

        $output_type = trim(strtolower($output_type));

        $active_log_silo_flag_ARRAY = $this->oLogger->return_active_log_silo_keys();

        switch($output_type){
            case 'print_r':

                $this->print_r($active_log_silo_flag_ARRAY, '', NULL, __LINE__, __METHOD__, __FILE__);

            break;
            case 'array':

                return $active_log_silo_flag_ARRAY;

            break;
            default:

                $tmp_str = '';

                foreach($active_log_silo_flag_ARRAY as $siloKey => $flagset){

                    $tmp_str .= $siloKey.', ';

                }

                $tmp_str = rtrim($tmp_str,', ');

                return $tmp_str;

            break;

        }

    }

    public function return_SOAP_SVC_debugMode(){

        return self::$oCRNRSTN_ENV->return_SOAP_SVC_debugMode();

    }

    public function returnResourceKey(){

        return self::$resourceKey;

    }

    public function return_sys_logging_profile_pack(){

        $tmp_array = array();

        $tmp_array['sys_logging_profile'] = self::$sys_logging_profile_ARRAY[crc32($this->configSerial)][self::$resourceKey];
        $tmp_array['sys_logging_endpoint'] = self::$sys_logging_endpoint_ARRAY[crc32($this->configSerial)][self::$resourceKey];
        $tmp_array['sys_logging_wcr'] = self::$sys_logging_wcr_ARRAY[crc32($this->configSerial)][self::$resourceKey];
        $tmp_array['sys_logging_update_profile'] = self::$sys_logging_update_profile_ARRAY[crc32($this->configSerial)][self::$resourceKey];
        $tmp_array['sys_logging_update_endpoint'] = self::$sys_logging_update_endpoint_ARRAY[crc32($this->configSerial)][self::$resourceKey];

        return $tmp_array;

    }

    public function return_oLog_ProfileManager(){

        return self::$oLog_ProfileManager;

    }

    public function append_destruct_outputStr($str){

        $this->destruct_output = $str;

    }

    private function initializeErrorHandling(){

        $tmp_envKey = self::$oCRNRSTN_ENV->getEnvKey();
        $this->error_log('Error handling at this server envKey='.$tmp_envKey, __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

        if(isset(self::$oCRNRSTN_ENV->crnrstn_as_error_handler_ARRAY[crc32($this->configSerial)][$tmp_envKey])){

            if(self::$oCRNRSTN_ENV->crnrstn_as_error_handler_ARRAY[crc32($this->configSerial)][$tmp_envKey]){

                $this->error_log('Resetting error handling at this server to the PHP defaults.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                restore_error_handler();

                if (isset(self::$oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[crc32($this->configSerial)][$tmp_envKey])) {

                    $this->error_log('Initializing CRNRSTN :: to handle errors at this server per a custom error level constants reporting profile represented as an aggregate by the integer value, ' . self::$oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[crc32($this->configSerial)][$tmp_envKey] . '.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    $this->set_CRNRSTN_asErrorHandler($tmp_envKey);

                } else {

                    $this->error_log('Initializing CRNRSTN :: to handle errors at this server per the default PHP error level constants reporting profile. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    $this->set_CRNRSTN_asErrorHandler($tmp_envKey);

                }

            } else {

                $this->error_log('Resetting error handling at this server to the PHP defaults. For PHP 5.3 or later, the default is E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                restore_error_handler();

            }
        }
    }

    private function set_CRNRSTN_asErrorHandler($envKey_crc){

            if(isset(self::$oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[crc32($this->configSerial)][$envKey_crc])){

                //
                // SOURCE :: https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
                // AUTHOR :: https://stackoverflow.com/users/117260/philippe-gerber
                // SET TO THE USER DEFINED ERROR HANDLER
                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                    try{

                        // error was suppressed with the @-operator
                        if (0 === error_reporting()) {
                            return false;
                        }

                        $errstr = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                        $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                    } catch (Exception $e) {

                        //
                        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                        $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                        return false;

                    }

                }, (int) self::$oCRNRSTN_ENV->crnrstn_as_error_handler_constants_ARRAY[crc32($this->configSerial)][$envKey_crc]);

            }else{

                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {

                    try{

                        // error was suppressed with the @-operator
                        if (0 === error_reporting()) {
                            return false;
                        }

                        $errstr = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                        $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                    } catch (Exception $e) {

                        //
                        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                        $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                        return false;

                    }

                });

            }

        return true;

    }

    /*
    public function proxyEmailFire($WCR_key_email_packet, $endpoint_uri=NULL, $oKingsHighway=NULL){

        if(!isset($endpoint_uri)){

            $endpoint_uri = $this->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT');

            if($endpoint_uri==''){

                $endpoint_uri = $this->get_resource('CRNRSTN_PROXY_WSDL_ENDPOINT', $WCR_key_email_packet);

            }

        }

        //
        // SOAP
        $tmp_SOAP_request = $this->return_oKingsHighwaySOAP();

        $soapClient = new crnrstn_soap_client_manager($this,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');

        $response = $soapClient->sendRequest_SOAP('takeTheKingsHighway', $tmp_SOAP_request);

        $tmp_key_raw = urldecode($response['CRNRSTN_SOAP_SVC_AUTH_KEY']);
        $this->error_log('TOTAL_EMAILS_RECEIVED='.$response['TOTAL_EMAILS_RECEIVED'], __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $this->error_log('CRNRSTN_SOAP_SVC_AUTH_KEY='.$tmp_key_raw, __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);
        $this->error_log('paramTunnelDecrypt/true-CRNRSTN_SOAP_SVC_AUTH_KEY='.$this->paramTunnelDecrypt($tmp_key_raw, true), __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $this->error_log('377 - returnResult='.$soapClient->returnResult(), __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $tmp_serial = $this->generateNewKey(10);
        $packet_delimiter = '[CRNRSTN200_'.$tmp_serial.']';

        $tmp_email_packet_datum = $this->return_emailProxyIntegrationPacket($WCR_key_email_packet, $packet_delimiter);

        if(isset($oKingsHighway)){

            $tmp_cipher_override = $oKingsHighway->return_cipher();
            $tmp_secret_key_override = $oKingsHighway->return_secret_key();
            $tmp_hmac_algorithm_override = $oKingsHighway->return_hmac_algorithm();
            $tmp_options_bitwise_override = $oKingsHighway->return_options_bitwise();

        }else{

            $tmp_cipher_override = NULL;
            $tmp_secret_key_override = NULL;
            $tmp_hmac_algorithm_override = NULL;
            $tmp_options_bitwise_override = NULL;

        }

        //
        // ENCRYPT DATA PACKET
        if($this->isTunnelEncryptConfigured($tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override)){

            $is_encrypted = 'true';
            $tmp_email_packet_datum = $this->paramTunnelEncrypt($tmp_email_packet_datum, $tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override);
            $packet_delimiter = $this->paramTunnelEncrypt($packet_delimiter, $tmp_cipher_override, $tmp_secret_key_override, $tmp_hmac_algorithm_override, $tmp_options_bitwise_override);

        }else{

            $is_encrypted = 'false';

        }

        //
        // BUILD CURL POST EXPERIENCE
        $proxy_packet_datum = array("CRNRSTN_COMM_PROXY_PACKET" => 'v2.0.0',
        "CRNRSTN_PACKET_ENCRYPTED" => $is_encrypted,
            "CRNRSTN_PACKET_DELIMITER" => $packet_delimiter,
            "CRNRSTN_PACKET_DATUM" => $tmp_email_packet_datum);

        //$tmp_curl_response = $this->curl_post($endpoint_uri, $proxy_packet_datum);

        $this->error_log('The CRNRSTN :: Electrum process notification SOAP has been sent.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

    }


    private function return_oKingsHighwaySOAP(){

        $this->soapRequest_ARRAY = array('oKingsHighwayNotification' =>
            array(
                'CRNRSTN_PACKET_ENCRYPTED' => 'TRUE',
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->paramTunnelEncrypt($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'))
            ));

        return $this->soapRequest_ARRAY;

    }
  */

    public function ini_set($ini_setting, $ini_value){

        $this->ini_set_ARRAY[$ini_setting] = $ini_value;

        return ini_set($ini_setting, $ini_value);

    }

    public function clientSend_CRNRSTN_SOAP_REQUEST($SOAP_method, $SOAP_request, $SOAP_endpoint=NULL){

        if(!isset($SOAP_endpoint)){

            $SOAP_endpoint = $this->get_resource('WSDL_URI');

        }

        if(isset($this->WSDL_cache_ttl_ARRAY[crc32($SOAP_endpoint)])){

            $WSDL_cache_ttl = $this->WSDL_cache_ttl_ARRAY[crc32($SOAP_endpoint)];

        }else{

            $WSDL_cache_ttl = $this->get_resource('WSDL_CACHE_TTL');

        }

        if(isset($this->nusoap_useCURL_ARRAY[crc32($SOAP_endpoint)])){

            $nusoap_useCURL = $this->nusoap_useCURL_ARRAY[crc32($SOAP_endpoint)];

        }else{

            $nusoap_useCURL = $this->get_resource('NUSOAP_USECURL');

        }

        //
        // INSTANTIATE SOAP CLIENT
        $this->oSoapClient = new crnrstn_soap_client_manager($this, $SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);

        return $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);

    }

    public function return_oEmailArraySOAP_struct($email_pipe_delim, $name_pipe_delim=NULL, $cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        $tmp_email_ARRAY = array();

        if(!isset($name_pipe_delim)){

            $pos_pipe = strpos($email_pipe_delim, '|');

            if($pos_pipe === false){

                //
                // SINGLE NAME-EMAIL
                $email_pipe_delim = trim($email_pipe_delim);
                $pos_space = strpos($email_pipe_delim, ' ');

                if($pos_space === false){

                    array_push($tmp_email_ARRAY, array(
                        'EMAIL_PROXY_SERIAL' => $this->paramTunnelEncrypt(md5($email_pipe_delim), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'EMAILADDRESS' => $this->paramTunnelEncrypt($email_pipe_delim, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                      ));

                }else{

                    $tmp_email = '';
                    $tmp_firstname = '';
                    $tmp_lastname = '';

                    $tmp_name_email_ARRAY = explode(' ', $email_pipe_delim);
                    $tmp_content_cnt = sizeof($tmp_name_email_ARRAY);
                    for($i=0; $i<$tmp_content_cnt; $i++){

                        $pos_at = strpos($tmp_name_email_ARRAY[$i], '@');
                        $pos_dot = strpos($tmp_name_email_ARRAY[$i], '.');

                        if($pos_at !== false && $pos_dot !== false && $tmp_email==''){

                            //
                            // TAKE EMAIL ADDRESS
                            $tmp_email = $tmp_name_email_ARRAY[$i];

                        }else{

                            //
                            // TAKE NAME ELEMENT
                            if($tmp_firstname==''){

                                $tmp_firstname .= $tmp_name_email_ARRAY[$i];

                            }else{

                                $tmp_lastname .= $tmp_name_email_ARRAY[$i].' ';

                            }

                        }

                    }

                    $tmp_lastname = rtrim($tmp_lastname, ' ');
                    array_push($tmp_email_ARRAY, array(
                        'EMAIL_PROXY_SERIAL' => $this->paramTunnelEncrypt(md5($tmp_email), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'EMAILADDRESS' => $this->paramTunnelEncrypt($tmp_email, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'FIRSTNAME' => $this->paramTunnelEncrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                        'LASTNAME' => $this->paramTunnelEncrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                    ));

                }

            }else{

                //
                // MULTIPLE NAME-EMAIL
                $tmp_name_email_ARRAY = explode('|', $email_pipe_delim);

                $tmp_email_cnt = sizeof($tmp_name_email_ARRAY);
                for($i=0; $i<$tmp_email_cnt; $i++){

                    $pos_space = strpos($tmp_name_email_ARRAY[$i], ' ');

                    if($pos_space === false){

                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->paramTunnelEncrypt(md5($tmp_name_email_ARRAY[$i]), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->paramTunnelEncrypt($tmp_name_email_ARRAY[$i], $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                             ));

                    }else{

                        $tmp_email = '';
                        $tmp_firstname = '';
                        $tmp_lastname = '';

                        $tmp_name_check_ARRAY = explode(' ', $tmp_name_email_ARRAY[$i]);
                        $tmp_content_cnt = sizeof($tmp_name_check_ARRAY);
                        for($ii=0; $ii<$tmp_content_cnt; $ii++){

                            $pos_at = strpos($tmp_name_check_ARRAY[$ii], '@');
                            $pos_dot = strpos($tmp_name_check_ARRAY[$ii], '.');

                            if($pos_at !== false && $pos_dot !== false && $tmp_email==''){

                                //
                                // TAKE EMAIL ADDRESS
                                $tmp_email = $tmp_name_check_ARRAY[$ii];

                            }else{

                                //
                                // TAKE NAME ELEMENT
                                if($tmp_firstname == ''){

                                    $tmp_firstname .= $tmp_name_check_ARRAY[$ii];

                                }else{

                                    $tmp_lastname .= $tmp_name_check_ARRAY[$ii].' ';

                                }

                            }

                        }

                        $tmp_lastname = rtrim($tmp_lastname, ' ');
                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->paramTunnelEncrypt(md5($tmp_email), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->paramTunnelEncrypt($tmp_email, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'FIRSTNAME' => $this->paramTunnelEncrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'LASTNAME' => $this->paramTunnelEncrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                        ));

                    }

                }

            }

        }else{

            $tmp_email = '';
            $tmp_firstname = '';
            $tmp_lastname = '';

            //
            // PROCESS NAMES AS SEPARATE pipe DELIM
            // $email_pipe_delim, $name_pipe_delim
            $pos_pipe = strpos($email_pipe_delim, '|');
            if($pos_pipe !== false){

                //
                // MULTIPLE EMAIL
                $tmp_email_breakout_ARRAY = explode('|', $email_pipe_delim);
                $tmp_name_breakout_ARRAY = explode('|', $name_pipe_delim);

                $tmp_email_breakout_cnt = sizeof($tmp_email_breakout_ARRAY);
                $tmp_name_breakout_cnt = sizeof($tmp_name_breakout_ARRAY);

                if($tmp_email_breakout_cnt == $tmp_name_breakout_cnt){

                    for($i=0; $i<$tmp_email_breakout_cnt; $i++){

                        $tmp_email = trim($tmp_email_breakout_ARRAY[$i]);
                        $tmp_name = trim($tmp_name_breakout_ARRAY[$i]);

                        $tmp_space = strpos($tmp_name, ' ');
                        if($tmp_space!==false){
                            $tmp_name_bo_ARRAY = explode(' ', $tmp_name);
                            $tmp_name_bo_cnt = sizeof($tmp_name_bo_ARRAY);
                            for($ii=0; $ii<$tmp_name_bo_cnt; $ii++){

                                //
                                // TAKE NAME ELEMENT
                                if($tmp_firstname == ''){

                                    $tmp_firstname .= $tmp_name_bo_ARRAY[$ii];

                                }else{

                                    $tmp_lastname .= $tmp_name_bo_ARRAY[$ii].' ';

                                }

                            }

                        }else{

                            $tmp_firstname = $tmp_name;

                        }

                        $tmp_lastname = rtrim($tmp_lastname, ' ');
                        array_push($tmp_email_ARRAY, array(
                            'EMAIL_PROXY_SERIAL' => $this->paramTunnelEncrypt(md5($tmp_email), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'EMAILADDRESS' => $this->paramTunnelEncrypt($tmp_email, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'FIRSTNAME' => $this->paramTunnelEncrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                            'LASTNAME' => $this->paramTunnelEncrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                        ));
                    }

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: has received a mismatch between the number of email addresses provided and the number of names...'.$tmp_email_breakout_cnt.' to '.$tmp_name_breakout_cnt.', respectively.');

                }

            }else{

                //
                // SINGLE EMAIL
                $pos_space = strpos($name_pipe_delim, ' ');
                if($pos_space !== false){

                    $tmp_name_sep_ARRAY = explode(' ', $name_pipe_delim);
                    $tmp_name_element_cnt = sizeof($tmp_name_sep_ARRAY);

                    for($i=0; $i<$tmp_name_element_cnt; $i++){

                        //
                        // TAKE NAME ELEMENT
                        if($tmp_firstname == ''){

                            $tmp_firstname .= $tmp_name_sep_ARRAY[$i];

                        }else{

                            $tmp_lastname .= $tmp_name_sep_ARRAY[$i].' ';

                        }

                    }

                }else{

                    //
                    // ONLY "FIRST" NAME
                    $tmp_firstname = $name_pipe_delim;

                }

                $tmp_lastname = rtrim($tmp_lastname, ' ');
                array_push($tmp_email_ARRAY, array(
                    'EMAIL_PROXY_SERIAL' => $this->paramTunnelEncrypt(md5($email_pipe_delim), $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'EMAILADDRESS' => $this->paramTunnelEncrypt($email_pipe_delim, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'FIRSTNAME' => $this->paramTunnelEncrypt($tmp_firstname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override),
                    'LASTNAME' => $this->paramTunnelEncrypt($tmp_lastname, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override)
                ));

            }

        }

        return $tmp_email_ARRAY;

    }

    /*
    private function return_emailProxyIntegrationPacket($WCR_key_email_packet, $packet_delimiter){

        $tmp_str = '';
        switch($WCR_key_email_packet){
            case 'THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION':

                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('WORDWRAP', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('PRIORITY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('IS_HTML', $WCR_key_email_packet), $packet_delimiter);

            break;
            case 'ELECTRUM_NOTIFICATION_DETAIL':
                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_LOG_INTEGER_CONSTANT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_REMOTE_ADDR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SERVER_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SYSTEM_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_PROCESS_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_TITLE', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY'), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_START_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_END_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PRETTY_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', $WCR_key_email_packet), $packet_delimiter);

            break;
            default:

                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('BCC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('WORDWRAP', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('PRIORITY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('IS_HTML', $WCR_key_email_packet), $packet_delimiter);

                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('REPLY_TO_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TITLE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_LOG_INTEGER_CONSTANT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_MESSAGE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_REMOTE_ADDR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SERVER_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_SYSTEM_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_PROCESS_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_TITLE', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('SYS_ACTIVITY_TRACE_CONTENT_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('CRNRSTN_CRNRSTN_SOAP_SVC_AUTH_KEY'), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_START_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_END_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PRETTY_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_SOURCE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_DESTINATION_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->get_resource('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', $WCR_key_email_packet), $packet_delimiter);

            break;

        }

        //$tmp_str = rtrim($tmp_str, $packet_delimiter);
        return $tmp_str;
    }

    */

    public function return_secret_key_override($SOAP_endpoint){

        if(isset($this->secret_key_override_ARRAY[crc32($SOAP_endpoint)])){

            return $this->secret_key_override_ARRAY[crc32($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_cipher_override($SOAP_endpoint){

        if(isset($this->cipher_override_ARRAY[crc32($SOAP_endpoint)])){

            return $this->cipher_override_ARRAY[crc32($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_hmac_algorithm_override($SOAP_endpoint){

        if(isset($this->hmac_algorithm_override_ARRAY[crc32($SOAP_endpoint)])){

            return $this->hmac_algorithm_override_ARRAY[crc32($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function return_options_bitwise_override($SOAP_endpoint){

        if(isset($this->options_bitwise_override_ARRAY[crc32($SOAP_endpoint)])){

            return $this->options_bitwise_override_ARRAY[crc32($SOAP_endpoint)];

        }else{

            return NULL;

        }

    }

    public function initSOAP_WSDL_connectionProfile($SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL){

        $this->WSDL_cache_ttl_ARRAY[crc32($SOAP_endpoint)] = $WSDL_cache_ttl;
        $this->nusoap_useCURL_ARRAY[crc32($SOAP_endpoint)] = $nusoap_useCURL;

    }

    public function initSOAP_tunnelEncryptProfile($SOAP_endpoint, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

        $this->secret_key_override_ARRAY[crc32($SOAP_endpoint)] = $secret_key_override;
        $this->cipher_override_ARRAY[crc32($SOAP_endpoint)] = $cipher_override;
        $this->hmac_algorithm_override_ARRAY[crc32($SOAP_endpoint)] = $hmac_algorithm_override;
        $this->options_bitwise_override_ARRAY[crc32($SOAP_endpoint)] = $options_bitwise_override;

    }

    public function SOAP_returnClientRequest(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientRequest();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a client request.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_returnClientResponse(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientResponse();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a client response.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_returnResult(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnResult();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return a result from a SOAP server.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_returnClientGetDebug(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnClientGetDebug();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return any SOAP client debug information.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function SOAP_returnError(){

        try{

            if(isset($this->oSoapClient)){

                return $this->oSoapClient->returnError();

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No SOAP request has been sent, leaving the oSoapClient object uninstantiated and, therefore, unable to return any SOAP request error information.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        return self::$oCRNRSTN_ENV->isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE);

    }

    public function electrum_initNotifications($CRNRSTN_oELECTRUM, $email_pipe_delim, $notificationProfile='EMAIL', $SOAP_endpoint=NULL, $email_protocol='SMTP'){

        $CRNRSTN_oELECTRUM->initNotifications($email_pipe_delim, $notificationProfile, $SOAP_endpoint, $email_protocol);

        return $CRNRSTN_oELECTRUM;

    }

    public function return_configSerial(){

        return $this->configSerial;

    }

    public function define_wildcard_resource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    public function save_wildcard_resource($oWildCardResource){

        self::$oCRNRSTN_ENV->augmentWCR_array($oWildCardResource);

    }

    public function initElectrum_FileCopy($FtpToFtp_tmp_dirPath, $directoryDateName_versioning_pattern=NULL){

        $this->error_log('Initialize new Electrum operation.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $oELECTRUM = new crnrstn_wind_cloud_fire($this, $FtpToFtp_tmp_dirPath, $directoryDateName_versioning_pattern);

        return $oELECTRUM;

    }

    public function electrum_copyFilesToFolder($CRNRSTN_oELECTRUM, $custom_folder_name){

        $CRNRSTN_oELECTRUM->copyFilesToFolder($custom_folder_name);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_moveContentWithinSourceDir($CRNRSTN_oELECTRUM, $excludeContainingDir=true){

        $CRNRSTN_oELECTRUM->moveContentInSourceDirOnly($excludeContainingDir);

        return $CRNRSTN_oELECTRUM;
    }

    public function electrum_doNotPassDiskUsagePercent($CRNRSTN_oELECTRUM, $maxStorageUse){

        $this->error_log('Maximum storage usage at ANY destination LOCAL (FTP is not monitored) directory for this CRNRSTN :: Electrum process is being set to '.$maxStorageUse.'%.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->localStorageUse_doNotPassUsagePercent($maxStorageUse);

        return $CRNRSTN_oELECTRUM;
    }


    public function electrum_deleteSourceData_OnSuccess($CRNRSTN_oELECTRUM, $WCR_key_Or_DirPath, $require_ALL_destination_success=true){

        $this->error_log('On SUCCESS, remove all "processed-to-destination" files at the SOURCE endpoint, '.$WCR_key_Or_DirPath, __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->deleteSourceData_OnSuccess($WCR_key_Or_DirPath, $require_ALL_destination_success);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] source['.$this->get_resource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSource_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] destination['.$this->get_resource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestination_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] FLATTEN ALL FILES TO SAME Directory DESTINATION ['.$this->get_resource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationFTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL($CRNRSTN_oELECTRUM, $dirPath){

        $this->error_log('Add new Directory source['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSourceLOCAL($dirPath);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] source['.$this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addSourceLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new DIR ['.$WildCardResource_key.'] destination['.$tmp_path.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->get_resource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->get_resource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory ['.$WildCardResource_key.'] destination['.$tmp_path.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode=777){

        $this->error_log('Add new Directory destination['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode=777){

        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory destination['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_DIR($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new DIR Exclusion of "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_DIR($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_FILE($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion of "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_FILE($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE > '.$bytes.' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_fileSizeGreaterThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE < '.$bytes.' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_fileSizeLessThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of ACCESSED OLDER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_accessedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of ACCESSED NEWER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_accessedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of MODIFIED OLDER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_modifiedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of MODIFIED NEWER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_modifiedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of FILE OWNER USER ID "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_assetUserID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of FILE OWNER GROUP ID "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->exclude_assetGroupID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_EXECUTE($CRNRSTN_oELECTRUM){

        $this->error_log('Begin execution of CRNRSTN :: Electrum operation.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $tmp_execution_serial = $this->generateNewKey(100);

        $CRNRSTN_oELECTRUM->execute($tmp_execution_serial);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_closeConnections($CRNRSTN_oELECTRUM){

        $this->error_log('Close all connections associated with this electrum operation.', __LINE__, __METHOD__, __FILE__,CRNRSTN_ELECTRUM);

        $CRNRSTN_oELECTRUM->terminate_all_ftp();

        return $CRNRSTN_oELECTRUM;

    }

    public function isCurrentEnvironment($envKey){

        $tmp_envKey_crc = crc32($envKey);
        $tmp_envKey = self::$oCRNRSTN_ENV->getEnvKey();
        if($tmp_envKey_crc == $tmp_envKey){

            return true;

        }else{

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function initialize_oGabriel($messenger_serial, $mail_protocol='SMTP', $username=NULL, $password=NULL, $port=NULL){

        //
        // BRING IN THE MESSENGER
        // Luke 1:19, 26; Daniel 8:16; 9:21-22
        $CRNRSTN_oGabriel = new crnrstn_messenger_from_north($messenger_serial, $mail_protocol, $username, $password, $port, $this);

        $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial] = $CRNRSTN_oGabriel;

        return $CRNRSTN_oGabriel;

    }

    public function initProxySend($CRNRSTN_oGabriel, $proxy_endpoint_uri, $proxy_auth_key){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->initProxySend($proxy_endpoint_uri, $proxy_auth_key);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setCipherOverride($CRNRSTN_oGabriel, $cipher){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->proxyEncrypt_setCipherOverride($cipher);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setSecretKeyOverride($CRNRSTN_oGabriel, $proxy_secret_key){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->proxyEncrypt_setSecretKeyOverride($proxy_secret_key);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function proxyEncrypt_setAlgorithmOverride($CRNRSTN_oGabriel, $proxy_encrypt_hmac_algorithm){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->proxyEncrypt_setAlgorithmOverride($proxy_encrypt_hmac_algorithm);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addHostServers($CRNRSTN_oGabriel, $mail_host_servers){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addHostServers($mail_host_servers);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addReplyTo($CRNRSTN_oGabriel, $reply_to_email, $reply_to_recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addReplyTo($reply_to_email, $reply_to_recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addFrom($CRNRSTN_oGabriel, $sender_email, $sender_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addFrom($sender_email, $sender_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function wordWrap($CRNRSTN_oGabriel, $max_char_column_cnt=72){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->wordWrap($max_char_column_cnt);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function isHTML($CRNRSTN_oGabriel, $bool_isHTML){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->isHTML($bool_isHTML);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function setPriority($CRNRSTN_oGabriel, $priority = 'NORMAL'){
        // 1 = HIGH, 3 = NORMAL, 5 = LOW, null (default)
        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->setPriority($priority);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addSubject($CRNRSTN_oGabriel, $subject_line = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addSubject($subject_line);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addMsgBody_HTMLversion($CRNRSTN_oGabriel, $html_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addMsgBody_HTMLversion($html_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addMsgBody_TEXTversion($CRNRSTN_oGabriel, $text_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addMsgBody_TEXTversion($text_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;
    }

    public function suppressEmailDuplicates($CRNRSTN_oGabriel, $bool_suppress_dups=true){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->suppressEmailDuplicates($bool_suppress_dups);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function optOutDoNotSendEmail($CRNRSTN_oGabriel, $optout_emails){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->optOutDoNotSendEmail($optout_emails);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addAddress($CRNRSTN_oGabriel, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $email_experience_tracker = $oGabriel->addAddress($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

        return $email_experience_tracker;

    }

    public function addCC($CRNRSTN_oGabriel, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addCC($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addBCC($CRNRSTN_oGabriel, $recipient_email, $recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addBCC($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_SUBJECT($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_SUBJECT($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_HTML($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_TEXT($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, $content_place_holder, $dynamic_content){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addDynamicContent_MULTIPART($email_experience_tracker, $content_place_holder, $dynamic_content);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function oGabriel_ProxySend($CRNRSTN_oGabriel=NULL){

        $tmp_flag_messenger_send_ARRAY = array();
        if(!isset($CRNRSTN_oGabriel)){

            //
            // FIRE EVERYTHING!
            foreach($this->oMessenger_ARRAY as $serial => $oGabriel){
                if(!isset($tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial])){

                    $tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial] = 1;

                    $oGabriel->proxySend();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel_ProxySend('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

                }
            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

            $oGabriel->proxySend();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel_ProxySend('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

        }

    }

    public function oGabriel_Send($CRNRSTN_oGabriel=NULL){

        $tmp_flag_messenger_send_ARRAY = array();
        if(!isset($CRNRSTN_oGabriel)){

            //
            // FIRE EVERYTHING!
            foreach($this->oMessenger_ARRAY as $serial => $oGabriel){
                if(!isset($tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial])){

                    $tmp_flag_messenger_send_ARRAY[$oGabriel->messenger_serial] = 1;

                    $send_result_array[] = $oGabriel->send();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel->send('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);

                }
            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

            $send_result_array[] = $oGabriel->send();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel->send('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,CRNRSTN_GABRIEL);


        }

        return $send_result_array;

    }

    public function oGabriel_SendReport($CRNRSTN_oGabriel){

        $this->error_log('Trigger oGabriel_SendReport().', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

        // where $emailSendReport_ARRAY = array['0'=>['email@email.com'=>'success'], '1'=>['test@test.com'=>'duplicate_suppressed'], test2@test.com'=>'error']
        /*
                foreach($emailSendReport_ARRAY as $index=>$emailReport){
                    foreach($emailReport as $email=>$sendStatus){

                        'UPDATE table where 'EMAIL'= $email SET...;'

                    }
                }
         * */

        return true;

    }

    public function addAddressBulk($CRNRSTN_oGabriel, $recipient_email, $recipient_name = '', $email_experience_tracker = NULL){

        if(!isset($email_experience_tracker)){

            $email_experience_tracker = $this->generateNewKey(70);

        }

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addAddressBulk($email_experience_tracker, $recipient_email, $recipient_name);

        //
        // DEFAULT ISHTML TO FALSE...JUST LIKE SINGLE EMAIL
        $oGabriel->isHTMLBulk($email_experience_tracker, false);

        //
        // DEFAULT WORDWRAP...JUST LIKE SINGLE EMAIL
        $oGabriel->wordWrapBulk($email_experience_tracker, 72);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

        return $email_experience_tracker;

    }

    public function isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, $bool_isHTML){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->isHTMLBulk($email_experience_tracker, $bool_isHTML);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function setPriorityBulk($CRNRSTN_oGabriel, $email_experience_tracker, $priority = 'NORMAL'){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->setPriorityBulk($email_experience_tracker, $priority);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addFromBulk($CRNRSTN_oGabriel, $email_experience_tracker, $sender_email, $sender_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addFromBulk($email_experience_tracker, $sender_email, $sender_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function wordWrapBulk($CRNRSTN_oGabriel, $email_experience_tracker, $max_char_column_cnt=72){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->wordWrapBulk($email_experience_tracker, $max_char_column_cnt);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $reply_to_email, $reply_to_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addReplyToBulk($email_experience_tracker, $reply_to_email, $reply_to_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addCCBulk($CRNRSTN_oGabriel, $email_experience_tracker, $cc_email, $cc_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addCCBulk($email_experience_tracker, $cc_email, $cc_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addBCCBulk($CRNRSTN_oGabriel, $email_experience_tracker, $bcc_email, $bcc_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addBCCBulk($email_experience_tracker, $bcc_email, $bcc_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addSubjectBulk($CRNRSTN_oGabriel, $email_experience_tracker, $subject_line = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addSubjectBulk($email_experience_tracker, $subject_line);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addHTMLver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $html_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addHTMLver_Bulk($email_experience_tracker, $html_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    public function addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $text_message = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addTEXTver_Bulk($email_experience_tracker, $text_message);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    //
    // BATCH MANAGEMENT TO LIMIT RESOURCE CONSUMPTION - where here, it is 25 email messages per batch
    public function batchReadyToSend($CRNRSTN_oGabriel, $max_batch_count = 0){

        // USE LIKE THIS
        //if($oCRNRSTN_USR->batchReadyToSend($CRNRSTN_oGabriel, 25)){

        //}
        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        return $oGabriel->batchReadyToSend($max_batch_count);

    }

    public function sendStatusReportEmail($CRNRSTN_oGabriel, $recipient_email, $recipient_name){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->sendStatusReportEmail($recipient_email, $recipient_name);

        $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_oCRNRSTN_ENV(){

        return self::$oCRNRSTN_ENV;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_resource($resourceKey, $wildCardResourceKey=NULL){

        return self::$oCRNRSTN_ENV->getEnvParam($resourceKey, $wildCardResourceKey);

    }

    public function return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD){
        
        return self::$oCRNRSTN_ENV->return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_SOAP_svc_config_param($param_key){

        return self::$oCRNRSTN_ENV->return_SOAP_svc_config_param($param_key);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isClientMobile($tabletIsMobile = false){

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');
        $tmp_ismobile = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('isMobile');  // BOOLEAN
        $tmp_istablet = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('isTablet');  // BOOLEAN

        //
        // MAY USE FALSE vs NULL TO CLEAR ISMOBILE IN SESSION. CRNRSTN :: ONLY SETS THIS TO TRUE.
        if (isset($tmp_ismobile)) {
            if ($tmp_ismobile) {

                return 'isMobile';

            }

        }

        //
        // MAY USE FALSE vs NULL TO CLEAR ISTABLET IN SESSION. CRNRSTN :: ONLY SETS THIS TO TRUE.
        if (isset($tmp_istablet)) {
            if ($tmp_istablet && $tabletIsMobile) {

                return 'isTablet';

            }

        }

        if ($tmp_custom_device != '') {

            # NOTE :: $tmp_custom_device HAS BOTH MOBILE AND TABLET OPPORTUNITIES

            //
            // MOBILE HAS BEEN PERSISTED IN SESSION. STICK WITH IT.
            return $tmp_custom_device;

        } else {

            //
            // SESSION PROVIDES NO CONFIRMATION OF MOBILE STATE. LET'S DO THE WORK TO ANSWER THE QUESTION.
            if (!isset($this->isMobile)) {

                //
                // NEED TO DETERMINE DEVICE TYPE.
                if (!isset($this->mobi_detect)) {

                    //
                    //  INITIALIZE MOBILE DETECT 3RD PARTY SERVICE.
                    $this->mobi_detect = new crnrstn_Mobile_Detect();

                }

                if ($tabletIsMobile) {

                    //
                    // HANDLE TABLETS AS MOBILE
                    if ($this->mobi_detect->isMobile() || $this->mobi_detect->isTablet()) {

                        $this->isMobile = true;

                    } else {

                        $this->isMobile = false;

                    }

                } else {

                    //
                    // EXCLUDE TABLETS FROM POSITIVE MOBILE IDENTIFICATION
                    if ($this->mobi_detect->isMobile() && !$this->mobi_detect->isTablet()) {

                        $this->isMobile = true;

                    } else {

                        $this->isMobile = false;
                    }

                }

            }

        }

        if ($this->isMobile) {

            return 'isMobile';

        } else {

            return false;
        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isClientTablet($mobileIsTablet = false){

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');
        $tmp_ismobile = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('isMobile');  // BOOLEAN
        $tmp_istablet = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('isTablet');  // BOOLEAN

        //
        // MAY USE FALSE vs NULL TO CLEAR ISTABLET IN SESSION. CRNRSTN ONLY SETS THIS TO TRUE.
        if (isset($tmp_istablet)) {
            if ($tmp_istablet) {

                return 'isTablet';

            }

        }

        //
        // MAY USE FALSE vs NULL TO CLEAR ISMOBILE IN SESSION. CRNRSTN ONLY SETS THIS TO TRUE.
        if (isset($tmp_ismobile)) {
            if ($tmp_ismobile && $mobileIsTablet) {

                return 'isMobile';

            }

        }

        if ($tmp_custom_device != '') {

            # NOTE :: $tmp_custom_device HAS BOTH MOBILE AND TABLET OPPORTUNITIES

            //
            // MOBILE/TABLET HAS BEEN PERSISTED IN SESSION. STICK WITH IT. RETURN STRING FOR DEVICE TYPE.
            return $tmp_custom_device;

        } else {

            if (!isset($this->isTablet)) {

                //
                // NEED TO DETERMINE DEVICE TYPE.
                if (!isset($this->mobi_detect)) {

                    //
                    //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
                    $this->mobi_detect = new crnrstn_Mobile_Detect();
                }

                if ($mobileIsTablet) {
                    if ($this->mobi_detect->isMobile() || $this->mobi_detect->isTablet()) {

                        $this->isTablet = true;

                    } else {

                        $this->isTablet = false;

                    }

                } else {

                    if (!$this->mobi_detect->isMobile() && $this->mobi_detect->isTablet()) {

                        $this->isTablet = true;

                    } else {

                        $this->isTablet = false;

                    }

                }

            } else {

                if ($this->isTablet) {

                    return 'isTablet';

                } else {

                    return false;
                }

            }

        }

        if ($this->isTablet) {

            return 'isTablet';

        } else {

            return false;
        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isClientMobileCustom($target_device = NULL){

        //
        // NULL $target_device EVOKES BASIC SESSION CHECK ONLY.
        if (!isset($target_device)) {

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');

            if ($tmp_custom_device != '') {

                //
                // WILL RETURN DEVICE STRING IF SESSION IS CONFIGURED WITH CUSTOM DEVICE AND NO
                // TARGET_DEVICE PROVIDED.
                return $tmp_custom_device;

            } else {

                //
                // NO CUSTOM CONFIGURATION AVAILABLE
                return false;

            }

        } else {

            //
            // CHECK THE PROVIDED TARGET DEVICE AGAINST SESSION...AND THEN, DO WORK IF NO MATCH.
            $tmp_detection_algorithm = trim(strtolower($target_device));
            $tmp_detection_algorithm = $this->stringSanitize($tmp_detection_algorithm, 'custom_mobi_detect_alg');

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');
            $tmp_custom_device = strtolower($tmp_custom_device);

            //
            // IF DEVICE PROVIDED, WILL CHECK FOR SESSION MATCH AND RETURN STRING REPRESENTING
            // THE SUCCESSFULLY DETECTED ALGORITHM IF SO.
            if ($tmp_custom_device != '' && $tmp_custom_device == $tmp_detection_algorithm) {

                return $tmp_custom_device;

            } else {

                //
                // NO SESSION MATCH. FURTHER DISCOVERY NEEDED.
                if (!isset($this->mobi_detect)) {

                    //
                    //  INITIALIZE MOBILE DETECT (3RD PARTY OPEN SOURCE).
                    $this->mobi_detect = new crnrstn_Mobile_Detect();

                }

                try {

                    switch ($tmp_detection_algorithm) {
                        case 'ismobile':

                            if (!isset($this->customClientDevice['isMobile'])) {

                                if ($this->mobi_detect->isMobile()) {

                                    $this->customClientDevice['isMobile'] = true;

                                } else {

                                    $this->customClientDevice['isMobile'] = false;
                                }

                            }

                            return $this->customClientDevice['isMobile'];

                            break;
                        case 'istablet':

                            if (!isset($this->customClientDevice['isTablet'])) {

                                if ($this->mobi_detect->isTablet()) {

                                    $this->customClientDevice['isTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTablet'];

                            break;
                        case 'isiphone':

                            if (!isset($this->customClientDevice['isiPhone'])) {

                                if ($this->mobi_detect->isiPhone()) {

                                    $this->customClientDevice['isiPhone'] = true;

                                } else {

                                    $this->customClientDevice['isiPhone'] = false;
                                }

                            }

                            return $this->customClientDevice['isiPhone'];

                            break;
                        case 'isblackberry':

                            if (!isset($this->customClientDevice['isBlackBerry'])) {

                                if ($this->mobi_detect->isBlackBerry()) {

                                    $this->customClientDevice['isBlackBerry'] = true;

                                } else {

                                    $this->customClientDevice['isBlackBerry'] = false;
                                }
                            }

                            return $this->customClientDevice['isBlackBerry'];

                            break;
                        case 'ishtc':

                            if (!isset($this->customClientDevice['isHTC'])) {

                                if ($this->mobi_detect->isHTC()) {

                                    $this->customClientDevice['isHTC'] = true;

                                } else {

                                    $this->customClientDevice['isHTC'] = false;
                                }

                            }

                            return $this->customClientDevice['isHTC'];

                            break;
                        case 'isnexus':

                            if (!isset($this->customClientDevice['isNexus'])) {

                                if ($this->mobi_detect->isNexus()) {

                                    $this->customClientDevice['isNexus'] = true;

                                } else {

                                    $this->customClientDevice['isNexus'] = false;
                                }

                            }

                            return $this->customClientDevice['isNexus'];

                            break;
                        case 'isdell':

                            if (!isset($this->customClientDevice['isDell'])) {

                                if ($this->mobi_detect->isDell()) {

                                    $this->customClientDevice['isDell'] = true;

                                } else {

                                    $this->customClientDevice['isDell'] = false;
                                }

                            }

                            return $this->customClientDevice['isDell'];

                            break;
                        case 'ismotorola':

                            if (!isset($this->customClientDevice['isMotorola'])) {

                                if ($this->mobi_detect->isMotorola()) {

                                    $this->customClientDevice['isMotorola'] = true;

                                } else {

                                    $this->customClientDevice['isMotorola'] = false;
                                }

                            }

                            return $this->customClientDevice['isMotorola'];

                            break;
                        case 'issamsung':

                            if (!isset($this->customClientDevice['isSamsung'])) {

                                if ($this->mobi_detect->isSamsung()) {

                                    $this->customClientDevice['isSamsung'] = true;

                                } else {

                                    $this->customClientDevice['isSamsung'] = false;
                                }

                            }

                            return $this->customClientDevice['isSamsung'];

                            break;
                        case 'islg':

                            if (!isset($this->customClientDevice['isLG'])) {

                                if ($this->mobi_detect->isLG()) {

                                    $this->customClientDevice['isLG'] = true;

                                } else {

                                    $this->customClientDevice['isLG'] = false;
                                }

                            }

                            return $this->customClientDevice['isLG'];

                            break;
                        case 'issony':

                            if (!isset($this->customClientDevice['isSony'])) {

                                if ($this->mobi_detect->isSony()) {

                                    $this->customClientDevice['isSony'] = true;

                                } else {

                                    $this->customClientDevice['isSony'] = false;
                                }

                            }

                            return $this->customClientDevice['isSony'];

                            break;
                        case 'isasus':

                            if (!isset($this->customClientDevice['isAsus'])) {

                                if ($this->mobi_detect->isAsus()) {

                                    $this->customClientDevice['isAsus'] = true;

                                } else {

                                    $this->customClientDevice['isAsus'] = false;
                                }

                            }

                            return $this->customClientDevice['isAsus'];

                            break;
                        case 'isnokialumia':

                            if (!isset($this->customClientDevice['isNokiaLumia'])) {

                                if ($this->mobi_detect->isNokiaLumia()) {

                                    $this->customClientDevice['isNokiaLumia'] = true;

                                } else {

                                    $this->customClientDevice['isNokiaLumia'] = false;
                                }

                            }

                            return $this->customClientDevice['isNokiaLumia'];

                            break;
                        case 'ismicromax':

                            if (!isset($this->customClientDevice['isMicromax'])) {

                                if ($this->mobi_detect->isMicromax()) {

                                    $this->customClientDevice['isMicromax'] = true;

                                } else {

                                    $this->customClientDevice['isMicromax'] = false;
                                }

                            }

                            return $this->customClientDevice['isMicromax'];

                            break;
                        case 'ispalm':

                            if (!isset($this->customClientDevice['isPalm'])) {

                                if ($this->mobi_detect->isPalm()) {

                                    $this->customClientDevice['isPalm'] = true;

                                } else {

                                    $this->customClientDevice['isPalm'] = false;
                                }

                            }

                            return $this->customClientDevice['isPalm'];

                            break;
                        case 'isvertu':

                            if (!isset($this->customClientDevice['isVertu'])) {

                                if ($this->mobi_detect->isVertu()) {

                                    $this->customClientDevice['isVertu'] = true;

                                } else {

                                    $this->customClientDevice['isVertu'] = false;
                                }

                            }

                            return $this->customClientDevice['isVertu'];

                            break;
                        case 'ispantech':

                            if (!isset($this->customClientDevice['isPantech'])) {

                                if ($this->mobi_detect->isPantech()) {

                                    $this->customClientDevice['isPantech'] = true;

                                } else {

                                    $this->customClientDevice['isPantech'] = false;
                                }

                            }

                            return $this->customClientDevice['isPantech'];

                            break;
                        case 'isfly':

                            if (!isset($this->customClientDevice['isFly'])) {

                                if ($this->mobi_detect->isFly()) {

                                    $this->customClientDevice['isFly'] = true;

                                } else {

                                    $this->customClientDevice['isFly'] = false;
                                }

                            }

                            return $this->customClientDevice['isFly'];

                            break;
                        case 'iswiko':

                            if (!isset($this->customClientDevice['isWiko'])) {

                                if ($this->mobi_detect->isWiko()) {

                                    $this->customClientDevice['isWiko'] = true;

                                } else {

                                    $this->customClientDevice['isWiko'] = false;
                                }

                            }

                            return $this->customClientDevice['isWiko'];

                            break;
                        case 'isimobile':

                            if (!isset($this->customClientDevice['isiMobile'])) {

                                if ($this->mobi_detect->isiMobile()) {

                                    $this->customClientDevice['isiMobile'] = true;

                                } else {

                                    $this->customClientDevice['isiMobile'] = false;
                                }

                            }

                            return $this->customClientDevice['isiMobile'];

                            break;
                        case 'issimvalley':

                            if (!isset($this->customClientDevice['isSimValley'])) {

                                if ($this->mobi_detect->isSimValley()) {

                                    $this->customClientDevice['isSimValley'] = true;

                                } else {

                                    $this->customClientDevice['isSimValley'] = false;
                                }

                            }

                            return $this->customClientDevice['isSimValley'];

                            break;
                        case 'iswolfgang':

                            if (!isset($this->customClientDevice['isWolfgang'])) {

                                if ($this->mobi_detect->isWolfgang()) {

                                    $this->customClientDevice['isWolfgang'] = true;

                                } else {

                                    $this->customClientDevice['isWolfgang'] = false;
                                }

                            }

                            return $this->customClientDevice['isWolfgang'];

                            break;
                        case 'isalcatel':

                            if (!isset($this->customClientDevice['isAlcatel'])) {

                                if ($this->mobi_detect->isAlcatel()) {

                                    $this->customClientDevice['isAlcatel'] = true;

                                } else {

                                    $this->customClientDevice['isAlcatel'] = false;
                                }

                            }

                            return $this->customClientDevice['isAlcatel'];

                            break;
                        case 'isnintendo':

                            if (!isset($this->customClientDevice['isNintendo'])) {

                                if ($this->mobi_detect->isNintendo()) {

                                    $this->customClientDevice['isNintendo'] = true;

                                } else {

                                    $this->customClientDevice['isNintendo'] = false;
                                }
                            }

                            return $this->customClientDevice['isNintendo'];

                            break;
                        case 'isamoi':

                            if (!isset($this->customClientDevice['isAmoi'])) {

                                if ($this->mobi_detect->isAmoi()) {

                                    $this->customClientDevice['isAmoi'] = true;

                                } else {

                                    $this->customClientDevice['isAmoi'] = false;
                                }

                            }

                            return $this->customClientDevice['isAmoi'];

                            break;
                        case 'isinq':

                            if (!isset($this->customClientDevice['isINQ'])) {

                                if ($this->mobi_detect->isINQ()) {

                                    $this->customClientDevice['isINQ'] = true;

                                } else {

                                    $this->customClientDevice['isINQ'] = false;
                                }

                            }

                            return $this->customClientDevice['isINQ'];

                            break;
                        case 'isoneplus':

                            if (!isset($this->customClientDevice['isOnePlus'])) {

                                if ($this->mobi_detect->isOnePlus()) {

                                    $this->customClientDevice['isOnePlus'] = true;

                                } else {

                                    $this->customClientDevice['isOnePlus'] = false;
                                }

                            }

                            return $this->customClientDevice['isOnePlus'];

                            break;
                        case 'isgenericphone':

                            if (!isset($this->customClientDevice['isGenericPhone'])) {

                                if ($this->mobi_detect->isGenericPhone()) {

                                    $this->customClientDevice['isGenericPhone'] = true;

                                } else {

                                    $this->customClientDevice['isGenericPhone'] = false;
                                }
                            }

                            return $this->customClientDevice['isGenericPhone'];

                            break;
                        case 'isipad':

                            if (!isset($this->customClientDevice['isiPad'])) {

                                if ($this->mobi_detect->isiPad()) {

                                    $this->customClientDevice['isiPad'] = true;

                                } else {

                                    $this->customClientDevice['isiPad'] = false;
                                }
                            }

                            return $this->customClientDevice['isiPad'];

                            break;
                        case 'isnexustablet':

                            if (!isset($this->customClientDevice['isNexusTablet'])) {

                                if ($this->mobi_detect->isNexusTablet()) {

                                    $this->customClientDevice['isNexusTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNexusTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNexusTablet'];

                            break;
                        case 'isgoogletablet':

                            if (!isset($this->customClientDevice['isGoogleTablet'])) {

                                if ($this->mobi_detect->isGoogleTablet()) {

                                    $this->customClientDevice['isGoogleTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGoogleTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isGoogleTablet'];

                            break;
                        case 'issamsungtablet':

                            if (!isset($this->customClientDevice['isSamsungTablet'])) {

                                if ($this->mobi_detect->isSamsungTablet()) {

                                    $this->customClientDevice['isSamsungTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSamsungTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isSamsungTablet'];

                            break;
                        case 'iskindle':

                            if (!isset($this->customClientDevice['isKindle'])) {

                                if ($this->mobi_detect->isKindle()) {

                                    $this->customClientDevice['isKindle'] = true;

                                } else {

                                    $this->customClientDevice['isKindle'] = false;
                                }

                            }

                            return $this->customClientDevice['isKindle'];

                            break;
                        case 'issurfacetablet':

                            if (!isset($this->customClientDevice['isSurfaceTablet'])) {

                                if ($this->mobi_detect->isSurfaceTablet()) {

                                    $this->customClientDevice['isSurfaceTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSurfaceTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isSurfaceTablet'];

                            break;
                        case 'ishptablet':

                            if (!isset($this->customClientDevice['isHPTablet'])) {

                                if ($this->mobi_detect->isHPTablet()) {

                                    $this->customClientDevice['isHPTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHPTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHPTablet'];

                            break;
                        case 'isasustablet':

                            if (!isset($this->customClientDevice['isAsusTablet'])) {

                                if ($this->mobi_detect->isAsusTablet()) {

                                    $this->customClientDevice['isAsusTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAsusTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isAsusTablet'];

                            break;
                        case 'isblackberrytablet':

                            if (!isset($this->customClientDevice['isBlackBerryTablet'])) {

                                if ($this->mobi_detect->isBlackBerryTablet()) {

                                    $this->customClientDevice['isBlackBerryTablet'] = true;

                                } else {

                                    $this->customClientDevice['isBlackBerryTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isBlackBerryTablet'];

                            break;
                        case 'ishtctablet':

                            if (!isset($this->customClientDevice['isHTCtablet'])) {

                                if ($this->mobi_detect->isHTCtablet()) {

                                    $this->customClientDevice['isHTCtablet'] = true;

                                } else {

                                    $this->customClientDevice['isHTCtablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHTCtablet'];

                            break;
                        case 'ismotorolatablet':

                            if (!isset($this->customClientDevice['isMotorolaTablet'])) {

                                if ($this->mobi_detect->isMotorolaTablet()) {

                                    $this->customClientDevice['isMotorolaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMotorolaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMotorolaTablet'];

                            break;
                        case 'isnooktablet':

                            if (!isset($this->customClientDevice['isNookTablet'])) {

                                if ($this->mobi_detect->isNookTablet()) {

                                    $this->customClientDevice['isNookTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNookTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isNookTablet'];

                            break;
                        case 'isacertablet':

                            if (!isset($this->customClientDevice['isAcerTablet'])) {

                                if ($this->mobi_detect->isAcerTablet()) {

                                    $this->customClientDevice['isAcerTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAcerTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAcerTablet'];

                            break;
                        case 'istoshibatablet':

                            if (!isset($this->customClientDevice['isToshibaTablet'])) {

                                if ($this->mobi_detect->isToshibaTablet()) {

                                    $this->customClientDevice['isToshibaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isToshibaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isToshibaTablet'];

                            break;
                        case 'islgtablet':

                            if (!isset($this->customClientDevice['isLGTablet'])) {

                                if ($this->mobi_detect->isLGTablet()) {

                                    $this->customClientDevice['isLGTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLGTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLGTablet'];

                            break;
                        case 'isfujitsutablet':

                            if (!isset($this->customClientDevice['isFujitsuTablet'])) {

                                if ($this->mobi_detect->isFujitsuTablet()) {

                                    $this->customClientDevice['isFujitsuTablet'] = true;

                                } else {

                                    $this->customClientDevice['isFujitsuTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isFujitsuTablet'];

                            break;
                        case 'isprestigiotablet':

                            if (!isset($this->customClientDevice['isPrestigioTablet'])) {

                                if ($this->mobi_detect->isPrestigioTablet()) {

                                    $this->customClientDevice['isPrestigioTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPrestigioTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPrestigioTablet'];

                            break;
                        case 'islenovotablet':

                            if (!isset($this->customClientDevice['isLenovoTablet'])) {

                                if ($this->mobi_detect->isLenovoTablet()) {

                                    $this->customClientDevice['isLenovoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLenovoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLenovoTablet'];

                            break;
                        case 'isdelltablet':

                            if (!isset($this->customClientDevice['isDellTablet'])) {

                                if ($this->mobi_detect->isDellTablet()) {

                                    $this->customClientDevice['isDellTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDellTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isDellTablet'];

                            break;
                        case 'isyarviktablet':

                            if (!isset($this->customClientDevice['isYarvikTablet'])) {

                                if ($this->mobi_detect->isYarvikTablet()) {

                                    $this->customClientDevice['isYarvikTablet'] = true;

                                } else {

                                    $this->customClientDevice['isYarvikTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isYarvikTablet'];

                            break;
                        case 'ismediontablet':

                            if (!isset($this->customClientDevice['isMedionTablet'])) {

                                if ($this->mobi_detect->isMedionTablet()) {

                                    $this->customClientDevice['isMedionTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMedionTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMedionTablet'];

                            break;
                        case 'isarnovatablet':

                            if (!isset($this->customClientDevice['isArnovaTablet'])) {

                                if ($this->mobi_detect->isArnovaTablet()) {

                                    $this->customClientDevice['isArnovaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isArnovaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isArnovaTablet'];

                            break;
                        case 'isintensotablet':

                            if (!isset($this->customClientDevice['isIntensoTablet'])) {

                                if ($this->mobi_detect->isIntensoTablet()) {

                                    $this->customClientDevice['isIntensoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isIntensoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isIntensoTablet'];

                            break;
                        case 'isirutablet':

                            if (!isset($this->customClientDevice['isIRUTablet'])) {

                                if ($this->mobi_detect->isIRUTablet()) {

                                    $this->customClientDevice['isIRUTablet'] = true;

                                } else {

                                    $this->customClientDevice['isIRUTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isIRUTablet'];

                            break;
                        case 'ismegafontablet':

                            if (!isset($this->customClientDevice['isMegafonTablet'])) {

                                if ($this->mobi_detect->isMegafonTablet()) {

                                    $this->customClientDevice['isMegafonTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMegafonTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMegafonTablet'];

                            break;
                        case 'isebodatablet':

                            if (!isset($this->customClientDevice['isEbodaTablet'])) {

                                if ($this->mobi_detect->isEbodaTablet()) {

                                    $this->customClientDevice['isEbodaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isEbodaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isEbodaTablet'];

                            break;
                        case 'isallviewtablet':

                            if (!isset($this->customClientDevice['isAllViewTablet'])) {

                                if ($this->mobi_detect->isAllViewTablet()) {

                                    $this->customClientDevice['isAllViewTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAllViewTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAllViewTablet'];

                            break;
                        case 'isarchostablet':

                            if (!isset($this->customClientDevice['isArchosTablet'])) {

                                if ($this->mobi_detect->isArchosTablet()) {

                                    $this->customClientDevice['isArchosTablet'] = true;

                                } else {

                                    $this->customClientDevice['isArchosTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isArchosTablet'];

                            break;
                        case 'isainoltablet':

                            if (!isset($this->customClientDevice['isAinolTablet'])) {

                                if ($this->mobi_detect->isAinolTablet()) {

                                    $this->customClientDevice['isAinolTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAinolTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAinolTablet'];

                            break;
                        case 'isnokialumiatablet':

                            if (!isset($this->customClientDevice['isNokiaLumiaTablet'])) {

                                if ($this->mobi_detect->isNokiaLumiaTablet()) {

                                    $this->customClientDevice['isNokiaLumiaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNokiaLumiaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNokiaLumiaTablet'];

                            break;
                        case 'issonytablet':

                            if (!isset($this->customClientDevice['isSonyTablet'])) {

                                if ($this->mobi_detect->isSonyTablet()) {

                                    $this->customClientDevice['isSonyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSonyTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isSonyTablet'];

                            break;
                        case 'isphilipstablet':

                            if (!isset($this->customClientDevice['isPhilipsTablet'])) {

                                if ($this->mobi_detect->isPhilipsTablet()) {

                                    $this->customClientDevice['isPhilipsTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPhilipsTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPhilipsTablet'];

                            break;
                        case 'iscubetablet':

                            if (!isset($this->customClientDevice['isCubeTablet'])) {

                                if ($this->mobi_detect->isCubeTablet()) {

                                    $this->customClientDevice['isCubeTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCubeTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isCubeTablet'];

                            break;
                        case 'iscobytablet':

                            if (!isset($this->customClientDevice['isCobyTablet'])) {

                                if ($this->mobi_detect->isCobyTablet()) {

                                    $this->customClientDevice['isCobyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCobyTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isCobyTablet'];

                            break;
                        case 'ismidtablet':

                            if (!isset($this->customClientDevice['isMIDTablet'])) {

                                if ($this->mobi_detect->isMIDTablet()) {

                                    $this->customClientDevice['isMIDTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMIDTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMIDTablet'];

                            break;
                        case 'ismsitablet':

                            if (!isset($this->customClientDevice['isMSITablet'])) {

                                if ($this->mobi_detect->isMSITablet()) {

                                    $this->customClientDevice['isMSITablet'] = true;

                                } else {

                                    $this->customClientDevice['isMSITablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMSITablet'];

                            break;
                        case 'issmittablet':

                            if (!isset($this->customClientDevice['isSMiTTablet'])) {

                                if ($this->mobi_detect->isSMiTTablet()) {

                                    $this->customClientDevice['isSMiTTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSMiTTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isSMiTTablet'];

                            break;
                        case 'isrockchiptablet':

                            if (!isset($this->customClientDevice['isRockChipTablet'])) {

                                if ($this->mobi_detect->isRockChipTablet()) {

                                    $this->customClientDevice['isRockChipTablet'] = true;

                                } else {

                                    $this->customClientDevice['isRockChipTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isRockChipTablet'];

                            break;
                        case 'isflytablet':

                            if (!isset($this->customClientDevice['isFlyTablet'])) {

                                if ($this->mobi_detect->isFlyTablet()) {

                                    $this->customClientDevice['isFlyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isFlyTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isFlyTablet'];

                            break;
                        case 'isbqtablet':

                            if (!isset($this->customClientDevice['isbqTablet'])) {

                                if ($this->mobi_detect->isbqTablet()) {

                                    $this->customClientDevice['isbqTablet'] = true;

                                } else {

                                    $this->customClientDevice['isbqTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isbqTablet'];

                            break;
                        case 'ishuaweitablet':

                            if (!isset($this->customClientDevice['isHuaweiTablet'])) {

                                if ($this->mobi_detect->isHuaweiTablet()) {

                                    $this->customClientDevice['isHuaweiTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHuaweiTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHuaweiTablet'];

                            break;
                        case 'isnectablet':

                            if (!isset($this->customClientDevice['isNecTablet'])) {

                                if ($this->mobi_detect->isNecTablet()) {

                                    $this->customClientDevice['isNecTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNecTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNecTablet'];

                            break;
                        case 'ispantechtablet':

                            if (!isset($this->customClientDevice['isPantechTablet'])) {

                                if ($this->mobi_detect->isPantechTablet()) {

                                    $this->customClientDevice['isPantechTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPantechTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPantechTablet'];

                            break;
                        case 'isbronchotablet':

                            if (!isset($this->customClientDevice['isBronchoTablet'])) {

                                if ($this->mobi_detect->isBronchoTablet()) {

                                    $this->customClientDevice['isBronchoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isBronchoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isBronchoTablet'];

                            break;
                        case 'isversustablet':

                            if (!isset($this->customClientDevice['isVersusTablet'])) {

                                if ($this->mobi_detect->isVersusTablet()) {

                                    $this->customClientDevice['isVersusTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVersusTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isVersusTablet'];

                            break;
                        case 'iszynctablet':

                            if (!isset($this->customClientDevice['isZyncTablet'])) {

                                if ($this->mobi_detect->isZyncTablet()) {

                                    $this->customClientDevice['isZyncTablet'] = true;

                                } else {

                                    $this->customClientDevice['isZyncTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isZyncTablet'];

                            break;
                        case 'ispositivotablet':

                            if (!isset($this->customClientDevice['isPositivoTablet'])) {

                                if ($this->mobi_detect->isPositivoTablet()) {

                                    $this->customClientDevice['isPositivoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPositivoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isPositivoTablet'];

                            break;
                        case 'isnabitablet':

                            if (!isset($this->customClientDevice['isNabiTablet'])) {

                                if ($this->mobi_detect->isNabiTablet()) {

                                    $this->customClientDevice['isNabiTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNabiTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isNabiTablet'];

                            break;
                        case 'iskobotablet':

                            if (!isset($this->customClientDevice['isKoboTablet'])) {

                                if ($this->mobi_detect->isKoboTablet()) {

                                    $this->customClientDevice['isKoboTablet'] = true;

                                } else {

                                    $this->customClientDevice['isKoboTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isKoboTablet'];

                            break;
                        case 'isdanewtablet':

                            if (!isset($this->customClientDevice['isDanewTablet'])) {

                                if ($this->mobi_detect->isDanewTablet()) {

                                    $this->customClientDevice['isDanewTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDanewTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isDanewTablet'];

                            break;
                        case 'istexettablet':

                            if (!isset($this->customClientDevice['isTexetTablet'])) {

                                if ($this->mobi_detect->isTexetTablet()) {

                                    $this->customClientDevice['isTexetTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTexetTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTexetTablet'];

                            break;
                        case 'isplaystationtablet':

                            if (!isset($this->customClientDevice['isPlaystationTablet'])) {

                                if ($this->mobi_detect->isPlaystationTablet()) {

                                    $this->customClientDevice['isPlaystationTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPlaystationTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isPlaystationTablet'];

                            break;
                        case 'istrekstortablet':

                            if (!isset($this->customClientDevice['isTrekstorTablet'])) {

                                if ($this->mobi_detect->isTrekstorTablet()) {

                                    $this->customClientDevice['isTrekstorTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTrekstorTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTrekstorTablet'];

                            break;
                        case 'ispyleaudiotablet':

                            if (!isset($this->customClientDevice['isPyleAudioTablet'])) {

                                if ($this->mobi_detect->isPyleAudioTablet()) {

                                    $this->customClientDevice['isPyleAudioTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPyleAudioTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPyleAudioTablet'];

                            break;
                        case 'isadvantablet':

                            if (!isset($this->customClientDevice['isAdvanTablet'])) {

                                if ($this->mobi_detect->isAdvanTablet()) {

                                    $this->customClientDevice['isAdvanTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAdvanTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAdvanTablet'];

                            break;
                        case 'isdanytechtablet':

                            if (!isset($this->customClientDevice['isDanyTechTablet'])) {

                                if ($this->mobi_detect->isDanyTechTablet()) {

                                    $this->customClientDevice['isDanyTechTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDanyTechTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isDanyTechTablet'];

                            break;
                        case 'isgalapadtablet':

                            if (!isset($this->customClientDevice['isGalapadTablet'])) {

                                if ($this->mobi_detect->isGalapadTablet()) {

                                    $this->customClientDevice['isGalapadTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGalapadTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isGalapadTablet'];

                            break;
                        case 'ismicromaxtablet':

                            if (!isset($this->customClientDevice['isMicromaxTablet'])) {

                                if ($this->mobi_detect->isMicromaxTablet()) {

                                    $this->customClientDevice['isMicromaxTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMicromaxTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMicromaxTablet'];

                            break;
                        case 'iskarbonntablet':

                            if (!isset($this->customClientDevice['isKarbonnTablet'])) {

                                if ($this->mobi_detect->isKarbonnTablet()) {

                                    $this->customClientDevice['isKarbonnTablet'] = true;

                                } else {

                                    $this->customClientDevice['isKarbonnTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isKarbonnTablet'];

                            break;
                        case 'isallfinetablet':

                            if (!isset($this->customClientDevice['isAllFineTablet'])) {

                                if ($this->mobi_detect->isAllFineTablet()) {

                                    $this->customClientDevice['isAllFineTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAllFineTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAllFineTablet'];

                            break;
                        case 'isproscantablet':

                            if (!isset($this->customClientDevice['isPROSCANTablet'])) {

                                if ($this->mobi_detect->isPROSCANTablet()) {

                                    $this->customClientDevice['isPROSCANTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPROSCANTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isPROSCANTablet'];

                            break;
                        case 'isyonestablet':

                            if (!isset($this->customClientDevice['isYONESTablet'])) {

                                if ($this->mobi_detect->isYONESTablet()) {

                                    $this->customClientDevice['isYONESTablet'] = true;

                                } else {

                                    $this->customClientDevice['isYONESTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isYONESTablet'];

                            break;
                        case 'ischangjiatablet':

                            if (!isset($this->customClientDevice['isChangJiaTablet'])) {

                                if ($this->mobi_detect->isChangJiaTablet()) {

                                    $this->customClientDevice['isChangJiaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isChangJiaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isChangJiaTablet'];

                            break;
                        case 'isgutablet':

                            if (!isset($this->customClientDevice['isGUTablet'])) {

                                if ($this->mobi_detect->isGUTablet()) {

                                    $this->customClientDevice['isGUTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGUTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isGUTablet'];

                            break;
                        case 'ispointofviewtablet':

                            if (!isset($this->customClientDevice['isPointOfViewTablet'])) {

                                if ($this->mobi_detect->isPointOfViewTablet()) {

                                    $this->customClientDevice['isPointOfViewTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPointOfViewTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPointOfViewTablet'];

                            break;
                        case 'isovermaxtablet':

                            if (!isset($this->customClientDevice['isOvermaxTablet'])) {

                                if ($this->mobi_detect->isOvermaxTablet()) {

                                    $this->customClientDevice['isOvermaxTablet'] = true;

                                } else {

                                    $this->customClientDevice['isOvermaxTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isOvermaxTablet'];

                            break;
                        case 'ishcltablet':

                            if (!isset($this->customClientDevice['isHCLTablet'])) {

                                if ($this->mobi_detect->isHCLTablet()) {

                                    $this->customClientDevice['isHCLTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHCLTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHCLTablet'];

                            break;
                        case 'isdpstablet':

                            if (!isset($this->customClientDevice['isDPSTablet'])) {

                                if ($this->mobi_detect->isDPSTablet()) {

                                    $this->customClientDevice['isDPSTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDPSTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isDPSTablet'];

                            break;
                        case 'isvisturetablet':

                            if (!isset($this->customClientDevice['isVistureTablet'])) {

                                if ($this->mobi_detect->isVistureTablet()) {

                                    $this->customClientDevice['isVistureTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVistureTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isVistureTablet'];

                            break;
                        case 'iscrestatablet':

                            if (!isset($this->customClientDevice['isCrestaTablet'])) {

                                if ($this->mobi_detect->isCrestaTablet()) {

                                    $this->customClientDevice['isCrestaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCrestaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isCrestaTablet'];

                            break;
                        case 'ismediatektablet':

                            if (!isset($this->customClientDevice['isMediatekTablet'])) {

                                if ($this->mobi_detect->isMediatekTablet()) {

                                    $this->customClientDevice['isMediatekTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMediatekTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMediatekTablet'];

                            break;
                        case 'isconcordetablet':

                            if (!isset($this->customClientDevice['isConcordeTablet'])) {

                                if ($this->mobi_detect->isConcordeTablet()) {

                                    $this->customClientDevice['isConcordeTablet'] = true;

                                } else {

                                    $this->customClientDevice['isConcordeTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isConcordeTablet'];

                            break;
                        case 'isgoclevertablet':

                            if (!isset($this->customClientDevice['isGoCleverTablet'])) {

                                if ($this->mobi_detect->isGoCleverTablet()) {

                                    $this->customClientDevice['isGoCleverTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGoCleverTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isGoCleverTablet'];

                            break;
                        case 'ismodecomtablet':

                            if (!isset($this->customClientDevice['isModecomTablet'])) {

                                if ($this->mobi_detect->isModecomTablet()) {

                                    $this->customClientDevice['isModecomTablet'] = true;

                                } else {

                                    $this->customClientDevice['isModecomTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isModecomTablet'];

                            break;
                        case 'isvoninotablet':

                            if (!isset($this->customClientDevice['isVoninoTablet'])) {

                                if ($this->mobi_detect->isVoninoTablet()) {

                                    $this->customClientDevice['isVoninoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVoninoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isVoninoTablet'];

                            break;
                        case 'isecstablet':

                            if (!isset($this->customClientDevice['isECSTablet'])) {

                                if ($this->mobi_detect->isECSTablet()) {

                                    $this->customClientDevice['isECSTablet'] = true;

                                } else {

                                    $this->customClientDevice['isECSTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isECSTablet'];

                            break;
                        case 'isstorextablet':

                            if (!isset($this->customClientDevice['isStorexTablet'])) {

                                if ($this->mobi_detect->isStorexTablet()) {

                                    $this->customClientDevice['isStorexTablet'] = true;

                                } else {

                                    $this->customClientDevice['isStorexTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isStorexTablet'];

                            break;
                        case 'isvodafonetablet':

                            if (!isset($this->customClientDevice['isVodafoneTablet'])) {

                                if ($this->mobi_detect->isVodafoneTablet()) {

                                    $this->customClientDevice['isVodafoneTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVodafoneTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isVodafoneTablet'];

                            break;
                        case 'isessentielbtablet':

                            if (!isset($this->customClientDevice['isEssentielBTablet'])) {

                                if ($this->mobi_detect->isEssentielBTablet()) {

                                    $this->customClientDevice['isEssentielBTablet'] = true;

                                } else {

                                    $this->customClientDevice['isEssentielBTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isEssentielBTablet'];

                            break;
                        case 'isrossmoortablet':

                            if (!isset($this->customClientDevice['isRossMoorTablet'])) {

                                if ($this->mobi_detect->isRossMoorTablet()) {

                                    $this->customClientDevice['isRossMoorTablet'] = true;

                                } else {

                                    $this->customClientDevice['isRossMoorTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isRossMoorTablet'];

                            break;
                        case 'isimobiletablet':

                            if (!isset($this->customClientDevice['isiMobileTablet'])) {

                                if ($this->mobi_detect->isiMobileTablet()) {

                                    $this->customClientDevice['isiMobileTablet'] = true;

                                } else {

                                    $this->customClientDevice['isiMobileTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isiMobileTablet'];

                            break;
                        case 'istolinotablet':

                            if (!isset($this->customClientDevice['isTolinoTablet'])) {

                                if ($this->mobi_detect->isTolinoTablet()) {

                                    $this->customClientDevice['isTolinoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTolinoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isTolinoTablet'];

                            break;
                        case 'isaudiosonictablet':

                            if (!isset($this->customClientDevice['isAudioSonicTablet'])) {

                                if ($this->mobi_detect->isAudioSonicTablet()) {

                                    $this->customClientDevice['isAudioSonicTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAudioSonicTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAudioSonicTablet'];

                            break;
                        case 'isampetablet':

                            if (!isset($this->customClientDevice['isAMPETablet'])) {

                                if ($this->mobi_detect->isAMPETablet()) {

                                    $this->customClientDevice['isAMPETablet'] = true;

                                } else {

                                    $this->customClientDevice['isAMPETablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAMPETablet'];

                            break;
                        case 'isskktablet':

                            if (!isset($this->customClientDevice['isSkkTablet'])) {

                                if ($this->mobi_detect->isSkkTablet()) {

                                    $this->customClientDevice['isSkkTablet'] = true;

                                } else {

                                    $this->customClientDevice['isSkkTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isSkkTablet'];

                            break;
                        case 'istecnotablet':

                            if (!isset($this->customClientDevice['isTecnoTablet'])) {

                                if ($this->mobi_detect->isTecnoTablet()) {

                                    $this->customClientDevice['isTecnoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTecnoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isTecnoTablet'];

                            break;
                        case 'isjxdtablet':

                            if (!isset($this->customClientDevice['isJXDTablet'])) {

                                if ($this->mobi_detect->isJXDTablet()) {

                                    $this->customClientDevice['isJXDTablet'] = true;

                                } else {

                                    $this->customClientDevice['isJXDTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isJXDTablet'];

                            break;
                        case 'isijoytablet':

                            if (!isset($this->customClientDevice['isiJoyTablet'])) {

                                if ($this->mobi_detect->isiJoyTablet()) {

                                    $this->customClientDevice['isiJoyTablet'] = true;

                                } else {

                                    $this->customClientDevice['isiJoyTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isiJoyTablet'];

                            break;
                        case 'isfx2tablet':

                            if (!isset($this->customClientDevice['isFX2Tablet'])) {

                                if ($this->mobi_detect->isFX2Tablet()) {

                                    $this->customClientDevice['isFX2Tablet'] = true;

                                } else {

                                    $this->customClientDevice['isFX2Tablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isFX2Tablet'];

                            break;
                        case 'isxorotablet':

                            if (!isset($this->customClientDevice['isXoroTablet'])) {

                                if ($this->mobi_detect->isXoroTablet()) {

                                    $this->customClientDevice['isXoroTablet'] = true;

                                } else {

                                    $this->customClientDevice['isXoroTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isXoroTablet'];

                            break;
                        case 'isviewsonictablet':

                            if (!isset($this->customClientDevice['isViewsonicTablet'])) {

                                if ($this->mobi_detect->isViewsonicTablet()) {

                                    $this->customClientDevice['isViewsonicTablet'] = true;

                                } else {

                                    $this->customClientDevice['isViewsonicTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isViewsonicTablet'];

                            break;
                        case 'isverizontablet':

                            if (!isset($this->customClientDevice['isVerizonTablet'])) {

                                if ($this->mobi_detect->isVerizonTablet()) {

                                    $this->customClientDevice['isVerizonTablet'] = true;

                                } else {

                                    $this->customClientDevice['isVerizonTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isVerizonTablet'];

                            break;
                        case 'isodystablet':

                            if (!isset($this->customClientDevice['isOdysTablet'])) {

                                if ($this->mobi_detect->isOdysTablet()) {

                                    $this->customClientDevice['isOdysTablet'] = true;

                                } else {

                                    $this->customClientDevice['isOdysTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isOdysTablet'];

                            break;
                        case 'iscaptivatablet':

                            if (!isset($this->customClientDevice['isCaptivaTablet'])) {

                                if ($this->mobi_detect->isCaptivaTablet()) {

                                    $this->customClientDevice['isCaptivaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCaptivaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isCaptivaTablet'];

                            break;
                        case 'isiconbittablet':

                            if (!isset($this->customClientDevice['isIconbitTablet'])) {

                                if ($this->mobi_detect->isIconbitTablet()) {

                                    $this->customClientDevice['isIconbitTablet'] = true;

                                } else {

                                    $this->customClientDevice['isIconbitTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isIconbitTablet'];

                            break;
                        case 'isteclasttablet':

                            if (!isset($this->customClientDevice['isTeclastTablet'])) {

                                if ($this->mobi_detect->isTeclastTablet()) {

                                    $this->customClientDevice['isTeclastTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTeclastTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isTeclastTablet'];

                            break;
                        case 'isondatablet':

                            if (!isset($this->customClientDevice['isOndaTablet'])) {

                                if ($this->mobi_detect->isOndaTablet()) {

                                    $this->customClientDevice['isOndaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isOndaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isOndaTablet'];

                            break;
                        case 'isjaytechtablet':

                            if (!isset($this->customClientDevice['isJaytechTablet'])) {

                                if ($this->mobi_detect->isJaytechTablet()) {

                                    $this->customClientDevice['isJaytechTablet'] = true;

                                } else {

                                    $this->customClientDevice['isJaytechTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isJaytechTablet'];

                            break;
                        case 'isblaupunkttablet':

                            if (!isset($this->customClientDevice['isBlaupunktTablet'])) {

                                if ($this->mobi_detect->isBlaupunktTablet()) {

                                    $this->customClientDevice['isBlaupunktTablet'] = true;

                                } else {

                                    $this->customClientDevice['isBlaupunktTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isBlaupunktTablet'];

                            break;
                        case 'isdigmatablet':

                            if (!isset($this->customClientDevice['isDigmaTablet'])) {

                                if ($this->mobi_detect->isDigmaTablet()) {

                                    $this->customClientDevice['isDigmaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isDigmaTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isDigmaTablet'];

                            break;
                        case 'isevoliotablet':

                            if (!isset($this->customClientDevice['isEvolioTablet'])) {

                                if ($this->mobi_detect->isEvolioTablet()) {

                                    $this->customClientDevice['isEvolioTablet'] = true;

                                } else {

                                    $this->customClientDevice['isEvolioTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isEvolioTablet'];

                            break;
                        case 'islavatablet':

                            if (!isset($this->customClientDevice['isLavaTablet'])) {

                                if ($this->mobi_detect->isLavaTablet()) {

                                    $this->customClientDevice['isLavaTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLavaTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLavaTablet'];

                            break;
                        case 'isaoctablet':

                            if (!isset($this->customClientDevice['isAocTablet'])) {

                                if ($this->mobi_detect->isAocTablet()) {

                                    $this->customClientDevice['isAocTablet'] = true;

                                } else {

                                    $this->customClientDevice['isAocTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isAocTablet'];

                            break;
                        case 'ismpmantablet':

                            if (!isset($this->customClientDevice['isMpmanTablet'])) {

                                if ($this->mobi_detect->isMpmanTablet()) {

                                    $this->customClientDevice['isMpmanTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMpmanTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMpmanTablet'];

                            break;
                        case 'iscelkontablet':

                            if (!isset($this->customClientDevice['isCelkonTablet'])) {

                                if ($this->mobi_detect->isCelkonTablet()) {

                                    $this->customClientDevice['isCelkonTablet'] = true;

                                } else {

                                    $this->customClientDevice['isCelkonTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isCelkonTablet'];

                            break;
                        case 'iswoldertablet':

                            if (!isset($this->customClientDevice['isWolderTablet'])) {

                                if ($this->mobi_detect->isWolderTablet()) {

                                    $this->customClientDevice['isWolderTablet'] = true;

                                } else {

                                    $this->customClientDevice['isWolderTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isWolderTablet'];

                            break;
                        case 'ismediacomtablet':

                            if (!isset($this->customClientDevice['isMediacomTablet'])) {

                                if ($this->mobi_detect->isMediacomTablet()) {

                                    $this->customClientDevice['isMediacomTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMediacomTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isMediacomTablet'];

                            break;
                        case 'ismitablet':

                            if (!isset($this->customClientDevice['isMiTablet'])) {

                                if ($this->mobi_detect->isMiTablet()) {

                                    $this->customClientDevice['isMiTablet'] = true;

                                } else {

                                    $this->customClientDevice['isMiTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isMiTablet'];

                            break;
                        case 'isnibirutablet':

                            if (!isset($this->customClientDevice['isNibiruTablet'])) {

                                if ($this->mobi_detect->isNibiruTablet()) {

                                    $this->customClientDevice['isNibiruTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNibiruTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNibiruTablet'];

                            break;
                        case 'isnexotablet':

                            if (!isset($this->customClientDevice['isNexoTablet'])) {

                                if ($this->mobi_detect->isNexoTablet()) {

                                    $this->customClientDevice['isNexoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isNexoTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isNexoTablet'];

                            break;
                        case 'isleadertablet':

                            if (!isset($this->customClientDevice['isLeaderTablet'])) {

                                if ($this->mobi_detect->isLeaderTablet()) {

                                    $this->customClientDevice['isLeaderTablet'] = true;

                                } else {

                                    $this->customClientDevice['isLeaderTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isLeaderTablet'];

                            break;
                        case 'isubislatetablet':

                            if (!isset($this->customClientDevice['isUbislateTablet'])) {

                                if ($this->mobi_detect->isUbislateTablet()) {

                                    $this->customClientDevice['isUbislateTablet'] = true;

                                } else {

                                    $this->customClientDevice['isUbislateTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isUbislateTablet'];

                            break;
                        case 'ispocketbooktablet':

                            if (!isset($this->customClientDevice['isPocketBookTablet'])) {

                                if ($this->mobi_detect->isPocketBookTablet()) {

                                    $this->customClientDevice['isPocketBookTablet'] = true;

                                } else {

                                    $this->customClientDevice['isPocketBookTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isPocketBookTablet'];

                            break;
                        case 'iskocasotablet':

                            if (!isset($this->customClientDevice['isKocasoTablet'])) {

                                if ($this->mobi_detect->isKocasoTablet()) {

                                    $this->customClientDevice['isKocasoTablet'] = true;

                                } else {

                                    $this->customClientDevice['isKocasoTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isKocasoTablet'];

                            break;
                        case 'ishisensetablet':

                            if (!isset($this->customClientDevice['isHisenseTablet'])) {

                                if ($this->mobi_detect->isHisenseTablet()) {

                                    $this->customClientDevice['isHisenseTablet'] = true;

                                } else {

                                    $this->customClientDevice['isHisenseTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isHisenseTablet'];

                            break;
                        case 'ishudl':

                            if (!isset($this->customClientDevice['isHudl'])) {

                                if ($this->mobi_detect->isHudl()) {

                                    $this->customClientDevice['isHudl'] = true;

                                } else {

                                    $this->customClientDevice['isHudl'] = false;
                                }

                            }

                            return $this->customClientDevice['isHudl'];

                            break;
                        case 'istelstratablet':

                            if (!isset($this->customClientDevice['isTelstraTablet'])) {

                                if ($this->mobi_detect->isTelstraTablet()) {

                                    $this->customClientDevice['isTelstraTablet'] = true;

                                } else {

                                    $this->customClientDevice['isTelstraTablet'] = false;
                                }

                            }

                            return $this->customClientDevice['isTelstraTablet'];

                            break;
                        case 'isgenerictablet':

                            if (!isset($this->customClientDevice['isGenericTablet'])) {

                                if ($this->mobi_detect->isGenericTablet()) {

                                    $this->customClientDevice['isGenericTablet'] = true;

                                } else {

                                    $this->customClientDevice['isGenericTablet'] = false;
                                }
                            }

                            return $this->customClientDevice['isGenericTablet'];

                            break;
                        case 'isandroidos':

                            if (!isset($this->customClientDevice['isAndroidOS'])) {

                                if ($this->mobi_detect->isAndroidOS()) {

                                    $this->customClientDevice['isAndroidOS'] = true;

                                } else {

                                    $this->customClientDevice['isAndroidOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isAndroidOS'];

                            break;
                        case 'isblackberryos':

                            if (!isset($this->customClientDevice['isBlackBerryOS'])) {

                                if ($this->mobi_detect->isBlackBerryOS()) {

                                    $this->customClientDevice['isBlackBerryOS'] = true;

                                } else {

                                    $this->customClientDevice['isBlackBerryOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isBlackBerryOS'];

                            break;
                        case 'ispalmos':

                            if (!isset($this->customClientDevice['isPalmOS'])) {

                                if ($this->mobi_detect->isPalmOS()) {

                                    $this->customClientDevice['isPalmOS'] = true;

                                } else {

                                    $this->customClientDevice['isPalmOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isPalmOS'];

                            break;
                        case 'issymbianos':

                            if (!isset($this->customClientDevice['isSymbianOS'])) {

                                if ($this->mobi_detect->isSymbianOS()) {

                                    $this->customClientDevice['isSymbianOS'] = true;

                                } else {

                                    $this->customClientDevice['isSymbianOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isSymbianOS'];

                            break;
                        case 'iswindowsmobileos':

                            if (!isset($this->customClientDevice['isWindowsMobileOS'])) {

                                if ($this->mobi_detect->isWindowsMobileOS()) {

                                    $this->customClientDevice['isWindowsMobileOS'] = true;

                                } else {

                                    $this->customClientDevice['isWindowsMobileOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isWindowsMobileOS'];

                            break;
                        case 'iswindowsphoneos':

                            if (!isset($this->customClientDevice['isWindowsPhoneOS'])) {

                                if ($this->mobi_detect->isWindowsPhoneOS()) {

                                    $this->customClientDevice['isWindowsPhoneOS'] = true;

                                } else {

                                    $this->customClientDevice['isWindowsPhoneOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isWindowsPhoneOS'];

                            break;
                        case 'isios':

                            if (!isset($this->customClientDevice['isiOS'])) {

                                if ($this->mobi_detect->isiOS()) {

                                    $this->customClientDevice['isiOS'] = true;

                                } else {

                                    $this->customClientDevice['isiOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isiOS'];

                            break;
                        case 'isipados':

                            if (!isset($this->customClientDevice['isiPadOS'])) {

                                if ($this->mobi_detect->isiPadOS()) {

                                    $this->customClientDevice['isiPadOS'] = true;

                                } else {

                                    $this->customClientDevice['isiPadOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isiPadOS'];

                            break;
                        case 'ismeegoos':

                            if (!isset($this->customClientDevice['isMeeGoOS'])) {

                                if ($this->mobi_detect->isMeeGoOS()) {

                                    $this->customClientDevice['isMeeGoOS'] = true;

                                } else {

                                    $this->customClientDevice['isMeeGoOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isMeeGoOS'];

                            break;
                        case 'ismaemoos':

                            if (!isset($this->customClientDevice['isMaemoOS'])) {

                                if ($this->mobi_detect->isMaemoOS()) {

                                    $this->customClientDevice['isMaemoOS'] = true;

                                } else {

                                    $this->customClientDevice['isMaemoOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isMaemoOS'];

                            break;
                        case 'isjavaos':

                            if (!isset($this->customClientDevice['isJavaOS'])) {

                                if ($this->mobi_detect->isJavaOS()) {

                                    $this->customClientDevice['isJavaOS'] = true;

                                } else {

                                    $this->customClientDevice['isJavaOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isJavaOS'];

                            break;
                        case 'iswebos':

                            if (!isset($this->customClientDevice['iswebOS'])) {

                                if ($this->mobi_detect->iswebOS()) {

                                    $this->customClientDevice['iswebOS'] = true;

                                } else {

                                    $this->customClientDevice['iswebOS'] = false;
                                }

                            }

                            return $this->customClientDevice['iswebOS'];

                            break;
                        case 'isbadaos':

                            if (!isset($this->customClientDevice['isbadaOS'])) {

                                if ($this->mobi_detect->isbadaOS()) {

                                    $this->customClientDevice['isbadaOS'] = true;

                                } else {

                                    $this->customClientDevice['isbadaOS'] = false;
                                }

                            }

                            return $this->customClientDevice['isbadaOS'];

                            break;
                        case 'isbrewos':

                            if (!isset($this->customClientDevice['isBREWOS'])) {

                                if ($this->mobi_detect->isBREWOS()) {

                                    $this->customClientDevice['isBREWOS'] = true;

                                } else {

                                    $this->customClientDevice['isBREWOS'] = false;
                                }
                            }

                            return $this->customClientDevice['isBREWOS'];

                            break;
                        case 'ischrome':

                            if (!isset($this->customClientDevice['isChrome'])) {

                                if ($this->mobi_detect->isChrome()) {

                                    $this->customClientDevice['isChrome'] = true;

                                } else {

                                    $this->customClientDevice['isChrome'] = false;
                                }

                            }

                            return $this->customClientDevice['isChrome'];

                            break;
                        case 'isdolfin':

                            if (!isset($this->customClientDevice['isDolfin'])) {

                                if ($this->mobi_detect->isDolfin()) {

                                    $this->customClientDevice['isDolfin'] = true;

                                } else {

                                    $this->customClientDevice['isDolfin'] = false;
                                }

                            }

                            return $this->customClientDevice['isDolfin'];

                            break;
                        case 'isopera':

                            if (!isset($this->customClientDevice['isOpera'])) {

                                if ($this->mobi_detect->isOpera()) {

                                    $this->customClientDevice['isOpera'] = true;

                                } else {

                                    $this->customClientDevice['isOpera'] = false;
                                }

                            }

                            return $this->customClientDevice['isOpera'];

                            break;
                        case 'isskyfire':

                            if (!isset($this->customClientDevice['isSkyfire'])) {

                                if ($this->mobi_detect->isSkyfire()) {

                                    $this->customClientDevice['isSkyfire'] = true;

                                } else {

                                    $this->customClientDevice['isSkyfire'] = false;
                                }

                            }

                            return $this->customClientDevice['isSkyfire'];

                            break;
                        case 'isedge':

                            if (!isset($this->customClientDevice['isEdge'])) {

                                if ($this->mobi_detect->isEdge()) {

                                    $this->customClientDevice['isEdge'] = true;

                                } else {

                                    $this->customClientDevice['isEdge'] = false;
                                }
                            }

                            return $this->customClientDevice['isEdge'];

                            break;
                        case 'isie':

                            if (!isset($this->customClientDevice['isIE'])) {

                                if ($this->mobi_detect->isIE()) {

                                    $this->customClientDevice['isIE'] = true;

                                } else {

                                    $this->customClientDevice['isIE'] = false;
                                }
                            }

                            return $this->customClientDevice['isIE'];

                            break;
                        case 'isfirefox':

                            if (!isset($this->customClientDevice['isFirefox'])) {

                                if ($this->mobi_detect->isFirefox()) {

                                    $this->customClientDevice['isFirefox'] = true;

                                } else {

                                    $this->customClientDevice['isFirefox'] = false;
                                }

                            }

                            return $this->customClientDevice['isFirefox'];

                            break;
                        case 'isbolt':

                            if (!isset($this->customClientDevice['isBolt'])) {

                                if ($this->mobi_detect->isBolt()) {

                                    $this->customClientDevice['isBolt'] = true;

                                } else {

                                    $this->customClientDevice['isBolt'] = false;
                                }

                            }

                            return $this->customClientDevice['isBolt'];

                            break;
                        case 'isteashark':

                            if (!isset($this->customClientDevice['isTeaShark'])) {

                                if ($this->mobi_detect->isTeaShark()) {

                                    $this->customClientDevice['isTeaShark'] = true;

                                } else {

                                    $this->customClientDevice['isTeaShark'] = false;
                                }

                            }

                            return $this->customClientDevice['isTeaShark'];

                            break;
                        case 'isblazer':

                            if (!isset($this->customClientDevice['isBlazer'])) {

                                if ($this->mobi_detect->isBlazer()) {

                                    $this->customClientDevice['isBlazer'] = true;

                                } else {

                                    $this->customClientDevice['isBlazer'] = false;
                                }
                            }

                            return $this->customClientDevice['isBlazer'];

                            break;
                        case 'issafari':

                            if (!isset($this->customClientDevice['isSafari'])) {

                                if ($this->mobi_detect->isSafari()) {

                                    $this->customClientDevice['isSafari'] = true;

                                } else {

                                    $this->customClientDevice['isSafari'] = false;
                                }
                            }

                            return $this->customClientDevice['isSafari'];

                            break;
                        case 'iswechat':

                            if (!isset($this->customClientDevice['isWeChat'])) {

                                if ($this->mobi_detect->isWeChat()) {

                                    $this->customClientDevice['isWeChat'] = true;

                                } else {

                                    $this->customClientDevice['isWeChat'] = false;
                                }
                            }

                            return $this->customClientDevice['isWeChat'];

                            break;
                        case 'isucbrowser':

                            if (!isset($this->customClientDevice['isUCBrowser'])) {

                                if ($this->mobi_detect->isUCBrowser()) {

                                    $this->customClientDevice['isUCBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isUCBrowser'] = false;
                                }
                            }

                            return $this->customClientDevice['isUCBrowser'];

                            break;
                        case 'isbaiduboxapp':

                            if (!isset($this->customClientDevice['isbaiduboxapp'])) {

                                if ($this->mobi_detect->isbaiduboxapp()) {

                                    $this->customClientDevice['isbaiduboxapp'] = true;

                                } else {

                                    $this->customClientDevice['isbaiduboxapp'] = false;
                                }
                            }

                            return $this->customClientDevice['isbaiduboxapp'];

                            break;
                        case 'isbaidubrowser':

                            if (!isset($this->customClientDevice['isbaidubrowser'])) {

                                if ($this->mobi_detect->isbaidubrowser()) {

                                    $this->customClientDevice['isbaidubrowser'] = true;

                                } else {

                                    $this->customClientDevice['isbaidubrowser'] = false;
                                }
                            }

                            return $this->customClientDevice['isbaidubrowser'];

                            break;
                        case 'isdiigobrowser':

                            if (!isset($this->customClientDevice['isDiigoBrowser'])) {

                                if ($this->mobi_detect->isDiigoBrowser()) {

                                    $this->customClientDevice['isDiigoBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isDiigoBrowser'] = false;
                                }

                            }

                            return $this->customClientDevice['isDiigoBrowser'];

                            break;
                        case 'ismercury':

                            if (!isset($this->customClientDevice['isMercury'])) {

                                if ($this->mobi_detect->isMercury()) {

                                    $this->customClientDevice['isMercury'] = true;

                                } else {

                                    $this->customClientDevice['isMercury'] = false;
                                }
                            }

                            return $this->customClientDevice['isMercury'];

                            break;
                        case 'isobigobrowser':

                            if (!isset($this->customClientDevice['isObigoBrowser'])) {

                                if ($this->mobi_detect->isObigoBrowser()) {

                                    $this->customClientDevice['isObigoBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isObigoBrowser'] = false;
                                }
                            }

                            return $this->customClientDevice['isObigoBrowser'];

                            break;
                        case 'isnetfront':

                            if (!isset($this->customClientDevice['isNetFront'])) {

                                if ($this->mobi_detect->isNetFront()) {

                                    $this->customClientDevice['isNetFront'] = true;

                                } else {

                                    $this->customClientDevice['isNetFront'] = false;
                                }

                            }

                            return $this->customClientDevice['isNetFront'];

                            break;
                        case 'isgenericbrowser':

                            if (!isset($this->customClientDevice['isGenericBrowser'])) {

                                if ($this->mobi_detect->isGenericBrowser()) {

                                    $this->customClientDevice['isGenericBrowser'] = true;

                                } else {

                                    $this->customClientDevice['isGenericBrowser'] = false;
                                }

                            }

                            return $this->customClientDevice['isGenericBrowser'];

                            break;
                        case 'ispalemoon':

                            if (!isset($this->customClientDevice['isPaleMoon'])) {

                                if ($this->mobi_detect->isPaleMoon()) {

                                    $this->customClientDevice['isPaleMoon'] = true;

                                } else {

                                    $this->customClientDevice['isPaleMoon'] = false;
                                }
                            }

                            return $this->customClientDevice['isPaleMoon'];

                            break;
                        default:

                            //
                            // NO CUSTOM DEVICE CONFIG MATCH.
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Method setClientMobileCustom() found no detection method string matching the provided input of [' . $target_device . ']. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');

                            break;

                    }

                } catch (Exception $e) {

                    //
                    // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                    $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                    return false;

                }
            }
        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function setClientMobile(){

        self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('isMobile', true);
        return true;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function setClientTablet(){

        self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('isTablet', true);
        return true;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function setClientMobileCustom($target_device = NULL){

        try {

            if (isset($target_device)) {

                $target_device = trim($target_device);
                $target_device = $this->stringSanitize($target_device, 'custom_mobi_detect_alg');

                self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('CUSTOM_DEVICE', $target_device);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Method setClientMobileCustom() requires a detection method string; it cannot be NULL. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return true;
    }

    //
    // REVERT MOBILE STATE...WITH RESPECT TO SESSION CONFIG...FOR IT TO BE
    // DRIVEN BY ANY EXISTING PAGE LOAD DETECTION ONCE AGAIN.
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function resetDeviceDetect(){

        //
        // STANDARD DETECTION RESET
        self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('isMobile', false);
        self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('isTablet', false);

        //
        // CUSTOM DETECTION RESET
        self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam('CUSTOM_DEVICE', '');

        return true;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function initFormHandling($crnrstn_form_handle, $transport_protocol = 'POST'){

        try {

            if (!isset($crnrstn_form_handle) || !isset($transport_protocol)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN_USR->initFormHandling() configuration error :: unable to detect form_handle or transport_protocol.');

            } else {

                $http_transport_protocol = strtoupper($transport_protocol);
                $http_transport_protocol = $this->stringSanitize($http_transport_protocol, 'http_protocol_simple');

                if ($http_transport_protocol != 'GET' && $http_transport_protocol != 'POST') {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN_USR->initFormHandling() configuration error :: unable to detect transport_protocol[POST/GET] from the provided value of ' . $transport_protocol . '.');

                } else {

                    if (isset(self::$form_handle_ARRAY[$crnrstn_form_handle])) {

                        if ($http_transport_protocol != self::$form_handle_ARRAY[$crnrstn_form_handle]) {

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('CRNRSTN_USR->initFormHandling() configuration error :: duplicate CRNRSTN :: form handle detected upon receiving the provided value of ' . $crnrstn_form_handle . '.');

                        } else {

                            self::$form_handle_ARRAY[$crnrstn_form_handle] = $http_transport_protocol;

                        }

                    } else {

                        self::$form_handle_ARRAY[$crnrstn_form_handle] = $http_transport_protocol;

                    }

                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addFormInputParamListener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $is_required = false){

        try {

            if (!isset($crnrstn_form_handle) || !isset($html_dom_form_input_name)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN_USR->addFormInputParamListener() configuration error :: unable to detect form_handle from [' . $crnrstn_form_handle . '] or html_dom_form_input_name from [' . $html_dom_form_input_name . '].');

            } else {

                if (isset(self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name])) {

                    if ($is_required == self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name]) {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN_USR->addFormInputParamListener() configuration error :: duplicate and conflicting CRNRSTN :: form input detected upon receiving the provided value of ' . $html_dom_form_input_name . '.');

                    } else {

                        //
                        // TECHNICALLY, DOES NOT NEED TO RUN. WILL JUST OVERWRITE WITH THE SAME.
                        self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name] = $is_required;

                    }

                } else {

                    self::$form_input_general_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name] = $is_required;

                    if ($is_required) {
                        $tmp_validatation = 'is_required';
                    } else {

                        $tmp_validatation = NULL;
                    }

                    $this->compileFormIntegrationPacket($crnrstn_form_handle, $html_dom_form_input_name, false, $tmp_validatation);
                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addHiddenFormInputParamListener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $html_dom_form_input_id = '{crnrstn2.0.0_nullEmpty}', $is_required = false, $default_val = NULL){

        if ($is_required) {

            $tmp_required = 'true';

        } else {

            $tmp_required = 'false';

        }

        try {

            if (!isset($crnrstn_form_handle) || !isset($html_dom_form_input_name)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN_USR->addHiddenFormInputParamListener() configuration error :: unable to detect form_handle from [' . $crnrstn_form_handle . '] or html_dom_form_input_name from [' . $html_dom_form_input_name . '].');

            } else {

                if (isset(self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id])) {

                    //
                    // FORM FIELD HAS BEEN DEFINED ALREADY. IF NOT A PERFECT MATCH...THROW DUPLICATE ERROR.
                    if (isset(self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required])) {

                        if (self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required] != $default_val) {

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('CRNRSTN_USR->addHiddenFormInputParamListener() configuration error :: duplicate and conflicting CRNRSTN :: form input detected upon receiving the provided value of ' . $html_dom_form_input_name . '.');

                        } else {

                            self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required] = $default_val;

                        }

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN_USR->addHiddenFormInputParamListener() configuration error :: duplicate and conflicting CRNRSTN :: form input detected upon receiving the provided value of ' . $html_dom_form_input_name . '.');

                    }

                } else {

                    self::$form_input_hidden_ARRAY[$crnrstn_form_handle][$html_dom_form_input_name][$html_dom_form_input_id][$tmp_required] = $default_val;

                }

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addValidationRedirect($crnrstn_form_handle = NULL, $html_dom_form_input_name_pipe_delim = NULL, $validation_key_pipe_delim = NULL, $on_error_redirect_uri = NULL, $on_success_redirect_uri = NULL){


        return NULL;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function formPrepopulateInputValue($crnrstn_form_handle, $html_dom_form_input_name, $force_default = false, $default_value = NULL){


        return NULL;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function outputValidationErrMsg($crnrstn_form_handle, $html_dom_form_input_name, $err_msg){


        return NULL;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function injectInputSerialization($crnrstn_form_handle = NULL, $tunnel_encrypt_hidden_input_data = true){

        $tmp_input_name_ARRAY = array();
        $tmp_input_id_ARRAY = array();
        $tmp_input_isrequired_ARRAY = array();
        $tmp_input_value_ARRAY = array();

        try {

            if (!is_bool($tunnel_encrypt_hidden_input_data)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR->injectInputSerialization() configuration error :: CRNRSTN :: encrypt_hidden_input_data is a required BOOLEAN parameter.');

            }

            if (!isset($crnrstn_form_handle)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR->injectInputSerialization() configuration error :: CRNRSTN :: form handle is a required parameter.');

            } else {

                foreach (self::$form_input_hidden_ARRAY as $zeroKey => $zeroArray_val) {

                    if ($zeroKey == $crnrstn_form_handle) {
                        foreach ($zeroArray_val as $inputName_key => $oneArray_val) {

                            //
                            // STORE INPUT NAME
                            $tmp_input_name_ARRAY[] = $inputName_key;

                            foreach ($oneArray_val as $inputID_key => $twoArray_val) {
                                //
                                // STORE INPUT ID
                                $tmp_input_id_ARRAY[] = $inputID_key;

                                foreach ($twoArray_val as $inputRequired => $val) {
                                    //
                                    // STORE INPUT REQUIRED_STATE & DEFAULT VALUE
                                    $tmp_input_isrequired_ARRAY[] = $inputRequired;
                                    $tmp_input_value_ARRAY[] = $val;

                                    if ($inputRequired == 'true' && $val == '') {

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('CRNRSTN_USR->injectInputSerialization() configuration error :: CRNRSTN :: A default value is required for the hidden input ' . $inputName_key . ' on the form with handle ' . $zeroKey . '.');

                                    }
                                }
                            }
                        }
                    }
                }

                //
                // BUILD OUTPUT HTML
                $tmp_html_out = '';
                $tmp_loop_size = sizeof($tmp_input_name_ARRAY);

                if ($tunnel_encrypt_hidden_input_data) {

                    //
                    // NEED TO VERIFY TUNNEL ENCRYPTION SETTINGS OR DO NOT ENCRYPT PARAMS.
                    $tmp_tunnelEncryptionState = $this->isTunnelEncryptConfigured();

                    if (!$tmp_tunnelEncryptionState) {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('CRNRSTN_USR->injectInputSerialization() configuration error :: CRNRSTN :: It has been requested that hidden input fields be tunnel encrypted, however the current configuration of CRNRSTN Suite :: v2.0.0 has failed to successfully execute encrypt/decrypt. Please reconfigure and try again, or pass a second parameter...FALSE...to injectInputSerialization().');

                    }

                    //
                    // APPROVED TO ENCRYPT CRNRSTN FORM INTEGRATION PACKET
                    self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] = 'true';

                    //
                    // READY TO BUILD OUTPUT AND SEND VIA CRNRSTN TUNNEL ENCRYPTION
                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        if ($tmp_input_id_ARRAY[$i] != '{crnrstn2.0.0_nullEmpty}') {

                            $tmp_html_out .= '<input type="hidden" id="' . $tmp_input_id_ARRAY[$i] . '" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $this->paramTunnelEncrypt($tmp_input_value_ARRAY[$i]) . '">';

                        } else {

                            $tmp_html_out .= '<input type="hidden" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $this->paramTunnelEncrypt($tmp_input_value_ARRAY[$i]) . '">';

                        }

                        if ($tmp_input_isrequired_ARRAY[$i]) {
                            $tmp_validatation = 'is_required';
                        } else {

                            $tmp_validatation = NULL;
                        }

                        $this->compileFormIntegrationPacket($crnrstn_form_handle, $tmp_input_name_ARRAY[$i], true, $tmp_validatation);

                    }

                } else {

                    //
                    // NOT APPROVED TO ENCRYPT CRNRSTN FORM INTEGRATION PACKET
                    self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] = 'false';

                    for ($i = 0; $i < $tmp_loop_size; $i++) {

                        //
                        // NO TUNNEL ENCRYPTION IS DESIRED FOR HIDDEN INPUT DATA
                        if ($tmp_input_id_ARRAY[$i] != '{crnrstn2.0.0_nullEmpty}') {

                            $tmp_html_out .= '<input type="hidden" id="' . $tmp_input_id_ARRAY[$i] . '" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $tmp_input_value_ARRAY[$i] . '">';

                        } else {

                            $tmp_html_out .= '<input type="hidden" name="' . $tmp_input_name_ARRAY[$i] . '" value="' . $tmp_input_value_ARRAY[$i] . '">';

                        }

                        if ($tmp_input_isrequired_ARRAY[$i]) {
                            $tmp_validatation = 'is_required';
                        } else {

                            $tmp_validatation = NULL;
                        }

                        $this->compileFormIntegrationPacket($crnrstn_form_handle, $tmp_input_name_ARRAY[$i], false, $tmp_validatation);

                    }
                }
            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        $tmp_html_out .= $this->returnFormIntegrationPacket($crnrstn_form_handle);

        return $tmp_html_out;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnConnection_MySQLi($host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL){

        if (!isset($host)) {

            $tmp_host_hashable = md5('{empty}');

        } else {

            $tmp_host_hashable = md5($host);

        }

        if (!isset($db)) {

            $tmp_db_hashable = md5('{empty}');

        } else {

            $tmp_db_hashable = md5($db);

        }

        if (!isset($un)) {

            $tmp_un_hashable = md5('{empty}');

        } else {

            $tmp_un_hashable = md5($un);

        }

        if (!isset($port)) {

            $tmp_port_hashable = md5('{empty}');

        } else {

            $tmp_port_hashable = md5($port);

        }

        if (!isset($pwd)) {

            $tmp_pwd_hashable = md5('{empty}');

        } else {

            $tmp_pwd_hashable = md5($pwd);

        }

        $tmp_mysqli_serial = crc32($tmp_host_hashable . $tmp_db_hashable . $tmp_un_hashable . $tmp_port_hashable . $tmp_pwd_hashable);

        if (isset(self::$oMySQLi_ARRAY[$tmp_mysqli_serial])) {

            if (is_resource(self::$oMySQLi_ARRAY[$tmp_mysqli_serial])) {

                if (self::$oMySQLi_ARRAY[$tmp_mysqli_serial]->ping()) {

                    //error_log("4106 crnrstn_usr - Please RECYCLE...our connection is OK!");

                } else {

                    //error_log("4110 crnrstn_usr - mysqli existed at one time, but as ping()==FALSE...I must open a new connection now!");

                    //
                    // OPEN CONNECTION
                    self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = self::$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);

                }

            } else {

                //error_log("4120 crnrstn_usr - I will open a new connection now! ...mysqli existed at one time, but has been closed.");

                //
                // OPEN CONNECTION
                self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = self::$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
                self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

            }

        } else {

            //error_log("4131 crnrstn_usr - I will open a new connection now! ...mysqli not set");

            //
            // OPEN CONNECTION
            self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = self::$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
            self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

        }

        //
        // RETURN CRNRSTN MYSQLI CONNECTION OBJECT
        $oCRNRSTN_MySQLi = new crnrstn_db_conn_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($tmp_mysqli_serial);
        $oCRNRSTN_MySQLi->load_connection_obj(self::$oMySQLi_ARRAY[$tmp_mysqli_serial]);

        $this->version_mysqli = $oCRNRSTN_MySQLi->version_mysqli;
        self::$oCRNRSTN_ENV->version_mysqli = $this->version_mysqli;

        return $oCRNRSTN_MySQLi;

    }

    public function pushFakeyDBConn($fakey_mysqli_serial, $mysqli){

        self::$oMySQLi_ARRAY[$fakey_mysqli_serial] = $mysqli;
        self::$oMySQLi_hash_ARRAY[] = $fakey_mysqli_serial;

        return $mysqli;

    }

    public function return_oCRNRSTN_MySQLi_Fakey($fakey_mysqli_serial){

        $oCRNRSTN_MySQLi = new crnrstn_db_conn_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($fakey_mysqli_serial);

        return $oCRNRSTN_MySQLi;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function closeConnection_MySQLi($mysqli){

        //error_log("4122 user - I will manually close connection now!");
        self::$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnHTTP_FormIntegration_InputVal($getpost_input_name, $transport_protocol = NULL){

        try {

            if (!isset($transport_protocol)) {

                //
                // AUTO DETECTION CHECKING POST FIRST.
                if (isset(self::$http_param_handle_ARRAY['POST'][$getpost_input_name])) {

                    return self::$http_param_handle_ARRAY['POST'][$getpost_input_name];

                } else {

                    if (isset(self::$http_param_handle_ARRAY['GET'][$getpost_input_name])) {

                        return self::$http_param_handle_ARRAY['GET'][$getpost_input_name];

                    } else {

                        //error_log('4144 user - NO DATA IN '.$getpost_input_name);
                        return NULL;
                    }
                }

            } else {

                $http_protocol = strtoupper($transport_protocol);
                $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

                switch ($http_protocol) {
                    case 'POST':
                    case 'GET':

                        if (isset(self::$http_param_handle_ARRAY[$http_protocol][$getpost_input_name])) {

                            return self::$http_param_handle_ARRAY[$http_protocol][$getpost_input_name];

                        } else {

                            //error_log('4163 - NO '.$http_protocol.' DATA IN '.$getpost_input_name);
                            return NULL;
                        }

                        break;
                    default:

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to determine HTTP protocol from provided value of [' . $transport_protocol . '].');

                        break;

                }

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function paramTunnelEncrypt($data = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        return self::$oCRNRSTN_ENV->paramTunnelEncrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    public function openssl_get_cipher_methods(){

        return self::$oCRNRSTN_ENV->openssl_get_cipher_methods();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function paramTunnelDecrypt($data = NULL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        return self::$oCRNRSTN_ENV->paramTunnelDecrypt($data, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isTunnelEncryptConfigured($cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

        $tmp_test_str = 'The quick brown fox jumped over the lazy dog.';
        $tmp_encryptedVal = $this->paramTunnelEncrypt($tmp_test_str, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('5936 user - Fire Decrypt TEST...['.$tmp_test_str.']==['.$tmp_encryptedVal.']');
        $tmp_decryptedVal = $this->paramTunnelDecrypt($tmp_encryptedVal, true, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('5938 user - Fire Decrypt TEST...['.$tmp_test_str.']==['.$tmp_decryptedVal.']');

        if ($tmp_test_str == $tmp_decryptedVal) {

            return true;

        } else {

            return false;

        }
    }

    private function compileFormIntegrationPacket($crnrstn_form_handle, $html_dom_form_input_name, $encryption_status = TRUE, $server_side_validation = NULL){

        //
        // DATA PROFILE FOR SUCCESSFUL CRNRSTN FORM CAPTURE INTEGRATION
        # COMPILE TIMESTAMP (SERVER) 1 - 1
        # FORM HANDLE 1 - 1              $crnrstn_form_handle
        # FORM TRANSPORT PROTOCOL 1 - 1  self::$form_handle_ARRAY[$crnrstn_form_handle]
        # ALL INPUT NAME 1 - n
        # INPUT ENCRYPTION STATUS FOR HIDDEN FIELDS 1 - n
        # SERVER-SIDE VALIDATION STRING FOR DATA TREATMENT 1 - n

        // self::$formIntegrationPacket_ARRAY['timestamp']
        // self::$formIntegrationPacket_ARRAY['crnrstn_form_handle'] = $crnrstn_form_handle;
        // self::$formIntegrationPacket_ARRAY['transport_protocol'] = self::$form_handle_ARRAY[$crnrstn_form_handle]
        // self::$formIntegrationPacket_ARRAY['input_name'][n] =
        // self::$formIntegrationPacket_ARRAY['input_encrypt'][n] =
        // self::$formIntegrationPacket_ARRAY['input_validation'][n] =

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp'] = $this->oLogger->returnMicroTime();

        }

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle'] = $crnrstn_form_handle;

        }

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol'] = self::$form_handle_ARRAY[$crnrstn_form_handle];

        }

        if (!isset(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['integration_packet_encrypt'])) {

            self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['integration_packet_encrypt'] = 'true';

        }

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][] = $html_dom_form_input_name;

        if ($encryption_status) {

            $encryption_status = 'true';

        } else {

            $encryption_status = 'false';

        }

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][] = $encryption_status;

        if (!isset($server_side_validation)) {

            $server_side_validation = 'false';

        }

        self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][] = $server_side_validation;

    }

    private function returnFormIntegrationPacket($crnrstn_form_handle){

        $tmp_html_out = '';
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['timestamp']);
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['crnrstn_form_handle']);
        $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['transport_protocol']);

        $tmp_input_cnt = sizeof(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name']);
        for ($i = 0; $i < $tmp_input_cnt; $i++) {

            $tmp_html_out .= $this->concatIntegrationPacketDatum($i, ":");
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_name'][$i], ":");
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_encrypt'][$i], ":");
            $tmp_html_out .= $this->concatIntegrationPacketDatum(self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['input_validation'][$i], ":");

            $tmp_html_out = rtrim($tmp_html_out, ':');

            //self::$formIntegrationPacket_ARRAY['input_name']
            //self::$formIntegrationPacket_ARRAY['input_encrypt']
            //self::$formIntegrationPacket_ARRAY['input_validation']

            $tmp_html_out = $this->concatIntegrationPacketDatum($tmp_html_out);

            # <input type="hidden" name="CRNRSTN_INTEGRATION_PACKET" value="">
            /*

            value="TIMESTAMP[CRNRSTN::2.0.0]FORM_HANDLE[CRNRSTN::2.0.0]TRANSPORT_PROTOCOL[CRNRSTN::2.0.0]
            0:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            1:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            2:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            3:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            n:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]"

             * */

        }

        $tmp_encrypted_flag = false;
        $tmp_html_out = rtrim($tmp_html_out, '[CRNRSTN::2.0.0]');
        if (self::$formIntegrationPacket_ARRAY[$crnrstn_form_handle]['packet_encryption_status'] == 'true') {

            $tmp_html_out = $this->paramTunnelEncrypt($tmp_html_out);

            if ($tmp_html_out != "") {

                $tmp_encrypted_flag = true;

            }

        }

        $tmp_html_out = '<input type="hidden" name="CRNRSTN_INTEGRATION_PACKET" value="' . $tmp_html_out . '">';

        if ($tmp_encrypted_flag) {
            $tmp_html_out .= '<input type="hidden" name="CRNRSTN_INTEGRATION_PACKET_ENCRYPTED" value="true">';

        }

        return $tmp_html_out;

    }

    public function receiveFormIntegrationPacket($uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL){

        $tmp_has_getpost_data = false;

        //
        // DO WE HAVE POST DATA?
        if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)) {

            //
            // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
            if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET')) {
                $tmp_has_getpost_data = true;

                $tmp_isEncrypted = '';
                if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                    $tmp_isEncrypted = strtolower(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                }

                if ($tmp_isEncrypted == 'true') {

                    $uri_passthrough = true;
                    $this->consumeFormIntegrationPacket($this->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET'), $uri_passthrough, $cipher_override, $secret_key_override), 'POST');

                } else {

                    $this->consumeFormIntegrationPacket(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET'), 'POST');

                }

            }

            //
            // DO WE HAVE GET DATA?
            if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)) {

                //
                // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET')) {

                    $tmp_has_getpost_data = true;

                    $tmp_isEncrypted = '';
                    if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                        $tmp_isEncrypted = strtolower(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                    }

                    if ($tmp_isEncrypted == 'true') {

                        $this->consumeFormIntegrationPacket($this->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), false, $cipher_override, $secret_key_override), 'GET');

                    } else {

                        $this->consumeFormIntegrationPacket(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), 'GET');

                    }

                }

            }

        } else {

            //
            // DO WE HAVE GET DATA?
            if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)) {

                //
                // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET')) {
                    //error_log('4418 user - process CRNRSTN_INTEGRATION_PACKET @ _GET');
                    $tmp_has_getpost_data = true;

                    $tmp_isEncrypted = '';
                    if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                        $tmp_isEncrypted = strtolower(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                    }

                    if ($tmp_isEncrypted == 'true') {
                        //error_log('4429 user - decrypt CRNRSTN_INTEGRATION_PACKET @ _GET');

                        $this->consumeFormIntegrationPacket($this->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), false, $cipher_override, $secret_key_override), 'GET');

                    } else {
                        //error_log('4434 user - decrypt CRNRSTN_INTEGRATION_PACKET @ _GET');

                        $this->consumeFormIntegrationPacket(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), 'GET');

                    }

                }

            }

        }

        return $tmp_has_getpost_data;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isValid_dataValidationCheck($transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        if (isset(self::$formIntegrationValid_ARRAY[$http_protocol])) {

            return self::$formIntegrationValid_ARRAY[$http_protocol];

        } else {

            return NULL;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnErr_dataValidationCheck($transport_protocol = 'POST'){

        $tmp_null_array = array();

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        if (isset(self::$formIntegrationErr_ARRAY[$http_protocol])) {

            if (sizeof(self::$formIntegrationErr_ARRAY[$http_protocol]) > 0) {

                return self::$formIntegrationErr_ARRAY[$http_protocol];

            } else {

                return $tmp_null_array;

            }

        } else {

            return $tmp_null_array;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addDatabaseQuery($oQueryProfileMgr, $result_set_key, $query_override = NULL){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);
            $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
            $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $connection_serial = $oCRNRSTN_MySQLi->returnConnSerial();

                if (isset($query_override)) {

                    //
                    // LOAD QUERY - OVERRIDE
                    // DATABASE QUERY/CONNECTION CRNRSTN CONTACT POINT
                    return self::$oDB_CRNRSTN->load_databaseQuery($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query_override);

                } else {

                    //
                    // PROCESS QUERY VIA CENTRALIZED DATABASE RESOURCES
                    $query = self::$oSqlSilo->returnDatabaseQuery($this, $oCRNRSTN_MySQLi, $result_set_key);

                    if (strlen($query) > 0) {

                        //
                        // DATABASE QUERY/CONNECTION CRNRSTN CONTACT POINT
                        return self::$oDB_CRNRSTN->load_databaseQuery($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('No query was able to be loaded from the provided handle and keys [' . $result_handle . '|' . $batch_key . '|' . $result_set_key . '].');

                    }

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function processQuery($application_acceleration = true, $oCRNRSTN_MySQLi = NULL, $batch_key = NULL, $result_set_key = NULL, $result_handle = NULL, $query_override = NULL){

        if (is_bool($application_acceleration)) {

            $tmp_request_serial = $this->generateNewKey(50);

            //
            // TRACK ON THIS AND KEY OFF OF IT TO ACTIVATE APPLICATION ACCELERATION
            // THROUGH REUSE OF RESULT SET ARRAY DATA vs FORCE REFRESH OF THE SAME.
            self::$oDB_CRNRSTN->receive_processQueryParam('sql_accelerate_FLAG', $application_acceleration, $tmp_request_serial);

            if (isset($oCRNRSTN_MySQLi)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('oCRNRSTN_MySQLi', $oCRNRSTN_MySQLi, $tmp_request_serial);

            }

            if (isset($batch_key)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('batch_key', $batch_key, $tmp_request_serial);

            }

            if (isset($result_set_key)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('result_set_key', $result_set_key, $tmp_request_serial);

            }

            if (isset($result_handle)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('result_handle', $result_handle, $tmp_request_serial);

            }

            if (isset($query_override)) {

                self::$oDB_CRNRSTN->receive_processQueryParam('query_override', $query_override, $tmp_request_serial);

            }

            //
            // PROCESS
            return self::$oDB_CRNRSTN->processQuery($tmp_request_serial);

        } else {

            //
            // HOOOSTON...VE HAF PROBLEM!
            $this->error_log('CRNRSTN :: ERROR :: No Database query processed. Please indicate (BOOLEAN) desire for application acceleration...as CRNRSTN :: prepares to touch database with SQL.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_DATABASE');

        }

        return false;

    }

    private function consumeFormIntegrationPacket($str, $transport_protocol){

        try {

            //
            // CHECK INTEGRITY OF DATA
            if ($str == '') {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Received ' . $transport_protocol . ' data is NULL or decryption of data has failed.');

            }

            //
            // PARSE OUT ALL INPUT PARAMETERS.
            /*
            value="TIMESTAMP[CRNRSTN::2.0.0]FORM_HANDLE[CRNRSTN::2.0.0]TRANSPORT_PROTOCOL[CRNRSTN::2.0.0]
            0:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            1:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            2:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            3:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]
            n:input_name:input_encrypt:input_validation[CRNRSTN::2.0.0]"

            self::$http_param_handle["FORM_TIMESTAMP"]
            self::$http_param_handle["TRANSACTION_TIMESTAMP"]
            self::$http_param_handle["FORM_HANDLE"]
            self::$http_param_handle["TRANSPORT_PROTOCOL"]
            */

            $tmp_packet_explode_ARRAY = explode("[CRNRSTN::2.0.0]", $str);

            $input_element_cnt = sizeof($tmp_packet_explode_ARRAY);

            //
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED.
            for ($i = 0; $i < $input_element_cnt; $i++) {

                switch ($i) {
                    case 0:
                        //
                        // FORM_TIMESTAMP
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['FORM_TIMESTAMP'] = $tmp_packet_explode_ARRAY[$i];
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['SUBMIT_TIMESTAMP'] = $this->oLogger->returnMicroTime();

                        break;
                    case 1:
                        //
                        // FORM_HANDLE
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['FORM_HANDLE'] = $tmp_packet_explode_ARRAY[$i];

                        break;
                    case 2:
                        //
                        // TRANSPORT_PROTOCOL
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['TRANSPORT_PROTOCOL'] = $tmp_packet_explode_ARRAY[$i];
                        self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['ACTIVE_TRANSPORT_PROTOCOL'] = $transport_protocol;

                        break;
                    default:

                        //
                        // EXTRACT INPUT DATA VIA EXPLODE
                        $tmp_input_meta_explode_ARRAY = explode(":", $tmp_packet_explode_ARRAY[$i]);
                        $tmp_input_meta_cnt = sizeof($tmp_input_meta_explode_ARRAY);

                        for ($ii = 0; $ii < $tmp_input_meta_cnt; $ii++) {

                            if ($ii == 0) {

                                $tmp_queue_position = $tmp_input_meta_explode_ARRAY[$ii];

                            }

                            switch ($ii) {
                                case 0:
                                    //
                                    // INPUT_POSITION
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_POSITION'] = $tmp_input_meta_explode_ARRAY[$ii];

                                    break;
                                case 1:
                                    //
                                    // INPUT_NAME
                                    //error_log('4656 user - processing ['.$transport_protocol.']input param :: '.$tmp_input_meta_explode_ARRAY[$ii]);
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_NAME'] = $tmp_input_meta_explode_ARRAY[$ii];

                                    break;
                                case 2:
                                    //
                                    // INPUT_ENCRYPT
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_ENCRYPT'] = $tmp_input_meta_explode_ARRAY[$ii];

                                    break;
                                case 3:
                                    //
                                    // INPUT_VALIDATION
                                    self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$tmp_queue_position]['INPUT_VALIDATION'] = $tmp_input_meta_explode_ARRAY[$ii];

                                    break;

                            }

                        }

                        break;

                }

            }

            //
            // META EXTRACTION FROM CRNRSTN INTEGRATION PACKET COMPLETE.
            // EXTRACT INPUT PARAMS FROM HTTP POST/GET NOW.
            // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED.
            $tmp_input_cnt = sizeof(self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META']);
            for ($i = 0; $i < $tmp_input_cnt; $i++) {

                $this->buildHTTP_ParamHandle(self::$formIntegrationPacketReceived_ARRAY[$transport_protocol]['INPUT_META'][$i], $transport_protocol);

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

        return NULL;

    }

    private function buildHTTP_ParamHandle($packet_received_array, $transport_protocol){

        try {

            if (!isset(self::$formIntegrationValid_ARRAY[$transport_protocol])) {

                self::$formIntegrationValid_ARRAY[$transport_protocol] = true;

            }

            switch ($transport_protocol) {
                case 'POST':
                    //
                    // VALIDATE DATA PER CRNRSTN FORM INTEGRATION REQUIREMENTS.
                    if ($packet_received_array['INPUT_VALIDATION'] != '') {

                        switch ($packet_received_array['INPUT_VALIDATION']) {
                            case 'is_FILE':
                                //
                                // TODO :: SERVER-SIDE INPUT VALIDATION
                            case 'is_DOCUMENT':
                            case 'is_COMPRESSED':
                            case 'is_ZIP':
                            case 'is_TAR':
                            case 'is_AUDIO':
                            case 'is_MP3':
                            case 'is_WAVE':
                            case 'is_MIDI':
                            case 'is_VIDEO':
                            case 'is_MP4':
                            case 'is_MOV':
                            case 'is_FLV':
                            case 'is_MKV':
                            case 'is_IMAGE':
                            case 'is_JPEG':
                            case 'is_GIF':
                            case 'is_PNG':
                            case 'is_TIFF':
                            case 'is_PDF':

                                break;
                            case 'is_integer':
                                //
                                // TODO :: is_integer SERVER-SIDE INPUT VALIDATION
                                break;
                            case 'is_string':
                                //
                                // TODO :: is_string SERVER-SIDE INPUT VALIDATION
                                break;
                            case 'is_email':
                                //
                                // TODO :: is_email SERVER-SIDE INPUT VALIDATION
                                break;
                            case 'is_required':

                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                                }

                                //error_log('4445 - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$packet_received_array['INPUT_NAME']]);

                                if (self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] == '') {

                                    self::$formIntegrationValid_ARRAY[$transport_protocol] = false;
                                    self::$formIntegrationErr_ARRAY[$transport_protocol][] = 'A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].');

                                }

                                break;
                            case 'false':
                                //
                                // NOTHING TO DO. JUST KIDDING...
                                // error_log('4790 user - I think that I have nothing to do.');
                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                                }

                                break;
                            default:
                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('The requested server-side input validation [' . $packet_received_array['INPUT_VALIDATION'] . '] is not available.');

                                break;

                        }

                    } else {

                        //
                        // NO SERVER-SIDE VALIDATION. PROCESS.
                        if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                        } else {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

                        }

                        // error_log('4483 - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                    }

                    break;
                default:

                    //
                    // VALIDATE DATA PER CRNRSTN FORM INTEGRATION REQUIREMENTS.
                    if ($packet_received_array['INPUT_VALIDATION'] != '') {

                        switch ($packet_received_array['INPUT_VALIDATION']) {
                            case 'is_FILE':
                            case 'is_DOCUMENT':
                            case 'is_COMPRESSED':
                            case 'is_ZIP':
                            case 'is_TAR':

                            case 'is_AUDIO':
                            case 'is_MP3':
                            case 'is_WAVE':
                            case 'is_MIDI':

                            case 'is_VIDEO':
                            case 'is_MP4':
                            case 'is_MOV':
                            case 'is_FLV':
                            case 'is_MKV':

                            case 'is_IMAGE':
                            case 'is_JPEG':
                            case 'is_GIF':
                            case 'is_PNG':
                            case 'is_TIFF':
                            case 'is_PDF':

                                break;
                            case 'is_integer':
                                //
                                // TODO :: is_integer SERVER-SIDE INPUT VALIDATION
                                break;
                            case 'is_string':
                                //
                                // TODO :: is_string SERVER-SIDE INPUT VALIDATION
                                break;
                            case 'is_email':
                                //
                                // TODO :: is_email SERVER-SIDE INPUT VALIDATION
                                break;
                            case 'is_required':

                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                                }

                                if (self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] == '') {

                                    self::$formIntegrationValid_ARRAY[$transport_protocol] = false;
                                    self::$formIntegrationErr_ARRAY[$transport_protocol][] = 'A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].';

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('A ' . $transport_protocol . ' parameter [' . $packet_received_array['INPUT_NAME'] . '] has failed server-side validation [' . $packet_received_array['INPUT_VALIDATION'] . '].');

                                }

                                // error_log('4514 - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                                break;
                            case 'false':
                                //
                                // NOTHING TO DO. JUST KIDDING...
                                // error_log('4790 user - I think that I have nothing to do.');
                                if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                                }

                                break;
                            default:
                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('The requested server-side input validation [' . $packet_received_array['INPUT_VALIDATION'] . '] is not available.');

                                break;

                        }

                    } else {

                        //
                        // NO SERVER-SIDE VALIDATION. PROCESS.
                        if ($packet_received_array['INPUT_ENCRYPT'] == 'true') {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->paramTunnelDecrypt(self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                        } else {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                        }

                        //error_log('4913 user - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                    }

                    break;

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    private function concatIntegrationPacketDatum($str, $delim = NULL){

        if (!isset($delim)) {

            return $str . '[CRNRSTN::2.0.0]';

        } else {

            return $str . $delim;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){

        return self::$oCRNRSTN_ENV->oCOOKIE_MGR->addCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addRawCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL){

        return self::$oCRNRSTN_ENV->oCOOKIE_MGR->addRawCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function getCookie($name){

        return self::$oCRNRSTN_ENV->oCOOKIE_MGR->getCookie($name);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function deleteCookie($name, $path = NULL){

        return self::$oCRNRSTN_ENV->oCOOKIE_MGR->deleteCookie($name, $path);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function deleteAllCookies($path = NULL){

        return self::$oCRNRSTN_ENV->oCOOKIE_MGR->deleteAllCookies($path);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnHeaders($returnType = NULL){

        return self::$oCRNRSTN_ENV->oHTTP_MGR->getHeaders($returnType);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_HTTP_Param($param, $transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':

                    if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, $param)) {
                        if (strlen($_POST[$param]) > 0) {

                            return true;

                        } else {

                            return false;

                        }

                    } else {

                        return false;

                    }

                default:

                    //
                    // $_GET
                    if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, $param)) {
                        if (strlen($_GET[$param]) > 0) {

                            return true;

                        } else {

                            return false;

                        }

                    } else {

                        return false;

                    }
            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function extractData_HTTP($param, $transport_protocol = 'GET'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':
                    if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST, $param)) {

                        return self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, $param);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.');

                    }

                    break;
                default:

                    //
                    // $_GET
                    if (self::$oCRNRSTN_ENV->oHTTP_MGR->issetParam($_GET, $param)) {

                        return self::$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, $param);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //throw new Exception('The desired HTTP _'.$http_protocol.' parameter, '.$param.', is not available.');
                        $this->error_log('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.', __LINE__, __METHOD__, __FILE__,CRNRSTN_SETTINGS_CRNRSTN);

                        return false;
                    }

                    break;
            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_SERVER_param($param){

        return self::$oCRNRSTN_ENV->isset_ServerArrayVar($param);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function wallTime(){

        return self::$oCRNRSTN_ENV->wallTime();

    }

    public function getMicroTime(){

        return $this->oLogger->returnMicroTime();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function return_queryDateTimeStamp(){

        //$ts = date("Y-m-d H:i:s", time());

        return date("Y-m-d H:i:s", time());

    }

    public function return_prettyElapsedTime($secs, $mode='ELAPSED_VERBOSE'){

        switch($mode){
            case 'ELAPSED':

                $this->elapsed_from_current($secs);

            break;
            case 'ELAPSED_VERBOSE':

                $tmp_output = $this->elapsed_verbose_from_current($secs);

            break;

        }

        return $tmp_output;

    }

    public function return_prettyDeltaTime($delta_secs, $microsecs=0, $mode='ELAPSED_VERBOSE'){

        $microsecs = '0.'.$microsecs;
        switch($mode){
            case 'ELAPSED':

                $tmp_output = $this->elapsed($delta_secs, $microsecs);

            break;
            case 'ELAPSED_VERBOSE':

                $tmp_output = $this->elapsed_verbose($delta_secs, $microsecs);

            break;

        }

        return $tmp_output;

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_from_current($secs){
        $ts = time();
        $delta_secs = $ts-$secs;

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => $delta_secs % 60
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date("m.d.Y @ H:i:s", $secs);
                    }

                }else{
                    $ret[] = $v . $k;
                }
            }
        }

        if(!isset($ret)){
            $ret[] = 'just now.';
        }else{
            if(sizeof($ret)==0){

                $ret[] = 'just now.';
            }else{
                $ret[] = self::$lang_content_ARRAY['AGO'];
            }
        }

        return join(' ', $ret);

    }

    private function elapsed($delta_secs, $microsecs=0){

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => ($delta_secs % 60) + $microsecs
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $delta_secs);

                    }else{

                        return date("m.d.Y @ H:i:s", $delta_secs);
                    }

                }else{
                    $ret[] = $v . $k;
                }
            }
        }

        if(!isset($ret)){
            $ret[] = 'just now.';
        }else{
            if(sizeof($ret)==0){

                $ret[] = 'just now.';
            }else{
                $ret[] = self::$lang_content_ARRAY['AGO'];
            }
        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($delta_secs, $microsecs=0){

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => ($delta_secs % 60) + $microsecs
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        if(isset($ret)){

            array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);

            $tmp_output = trim(join(' ', $ret));

            $tmp_output = ltrim($tmp_output, 'and');

        }else{

            $tmp_output = $this->wallTime();

            $tmp_output .= ' secs';

        }

        return $tmp_output;

    }

    private function elapsed_verbose_from_current($secs){
        $ts = time();
        $delta_secs = $ts-$secs;

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => $delta_secs % 60
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function isDateOlderThan($duration_seconds, $start_time_seconds=NULL, $qualification_pattern=NULL){

        if(!isset($qualification_pattern)){

            //
            // PROVIDED DATE ($seconds) OLDER THAN NOW?
            //if(strtotime("now") > (double) $seconds){
            if(isset($start_time_seconds)){



            }else{

                if(strtotime("now") > (double) $duration_seconds){

                    return true;

                }else{

                    return false;

                }

            }


        }else{

            //
            // DO WE HAVE PROPER DATE...OR A TIME PERIOD REPRESENTATION
            $pos_day = stripos($qualification_pattern, 'day');
            $pos_week = stripos($qualification_pattern, 'week');
            $pos_month = stripos($qualification_pattern, 'month');
            $pos_year = stripos($qualification_pattern, 'year');
            $pos_sec = stripos($qualification_pattern, 'sec');
            $pos_min = stripos($qualification_pattern, 'min');
            $pos_hour = stripos($qualification_pattern, 'hour');

            if($pos_year === false && $pos_month === false && $pos_week === false && $pos_day === false && $pos_hour === false && $pos_min === false && $pos_sec === false){

                //
                // PROVIDED DATE ($seconds) OLDER THAN DATE PATTERN?
                if(strtotime($qualification_pattern) > $duration_seconds){

                    return true;

                }else{

                    return false;

                }

            }else{

                //
                // IF TIME PERIOD...IS THERE ANY INDICATION OF FORE(+) OR AFT(-)?
                $pos_yesterday = stripos($qualification_pattern, 'yesterday');
                $pos_tomorrow = stripos($qualification_pattern, 'tomorrow');
                $pos_next = stripos($qualification_pattern, 'next');
                $pos_last = stripos($qualification_pattern, 'last');
                $pos_plus = stripos($qualification_pattern, '+');
                $pos_minus = stripos($qualification_pattern, '-');

                if ($pos_yesterday === false && $pos_tomorrow === false && $pos_next === false && $pos_last === false && $pos_plus === false && $pos_minus === false) {

                    //
                    // PREFIX A MINUS TO PATTERN, AND THEN CHECK IF PROVIDED DATE ($seconds) OLDER
                    // THAN MODIFIED DATE PATTERN?
                    $qualification_pattern = '- '.$qualification_pattern;
                    if(strtotime($qualification_pattern) > $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    //
                    // PROVIDED DATE ($seconds) OLDER THAN DATE PATTERN?
                    if(strtotime($qualification_pattern) > $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }
                }
            }
        }
    }

    public function isDateNewerThan($duration_seconds, $qualification_pattern=NULL){

        if(!isset($qualification_pattern)){

            //
            // PROVIDED DATE ($seconds) NEWER THAN NOW?
            if(strtotime('now') < $duration_seconds){

                return true;

            }else{

                return false;

            }

        }else{

            //
            // DO WE HAVE PROPER DATE...OR A TIME PERIOD REPRESENTATION
            $pos_day = stripos($qualification_pattern, 'day');
            $pos_week = stripos($qualification_pattern, 'week');
            $pos_month = stripos($qualification_pattern, 'month');
            $pos_year = stripos($qualification_pattern, 'year');
            $pos_sec = stripos($qualification_pattern, 'sec');
            $pos_min = stripos($qualification_pattern, 'min');
            $pos_hour = stripos($qualification_pattern, 'hour');

            if($pos_year === false && $pos_month === false && $pos_week === false && $pos_day === false && $pos_hour === false && $pos_min === false && $pos_sec === false){

                //
                // PROVIDED DATE ($seconds) NEWER THAN DATE PATTERN?
                if(strtotime($qualification_pattern) < $duration_seconds){

                    return true;

                }else{

                    return false;

                }

            }else{

                //
                // IF TIME PERIOD...IS THERE ANY INDICATION OF FORE(+) OR AFT(-)?
                $pos_yesterday = stripos($qualification_pattern, 'yesterday');
                $pos_tomorrow = stripos($qualification_pattern, 'tomorrow');
                $pos_next = stripos($qualification_pattern, 'next');
                $pos_last = stripos($qualification_pattern, 'last');
                $pos_plus = stripos($qualification_pattern, '+');
                $pos_minus = stripos($qualification_pattern, '-');

                if ($pos_yesterday === false && $pos_tomorrow === false && $pos_next === false && $pos_last === false && $pos_plus === false && $pos_minus === false) {

                    //
                    // PREFIX A MINUS TO PATTERN, AND THEN CHECK IF PROVIDED DATE ($seconds) NEWER
                    // THAN MODIFIED DATE PATTERN?
                    $qualification_pattern = '- '.$qualification_pattern;
                    if(strtotime($qualification_pattern) < $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    //
                    // PROVIDED DATE ($seconds) NEWER THAN DATE PATTERN?
                    if(strtotime($qualification_pattern) < $duration_seconds){

                        return true;

                    }else{

                        return false;

                    }
                }
            }
        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function elapsedDeltaTimeFor($watchKey, $decimal = 8){

        return self::$oCRNRSTN_ENV->monitoringDeltaTimeFor($watchKey, $decimal);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_SERVER_param($param = NULL){

        try {

            if (!isset($param)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('A value has not been provided to indicate which _SERVER parameter should be retrieved.');

            } else {

                return self::$oCRNRSTN_ENV->getServerArrayVar($param, $this);

            }

        } catch (Exception $e) {

            # ['COMM_EXCEPTION', 'COMM_NOTICE']
            /*
            [DEFAULT, GOOGLE_ANALYTICS,
            SCREEN|SCREEN_HTML, SCREEN_TEXT,
            SCREEN_HTML_HIDDEN, SOAP_ENDPOINT,
            EMAIL, SPLUNK, MISC_THIRD_PARTY_ENDPOINT]
            */

            # {CUSTOM ON LOCATION CALL STRING}
            # {ERROR_OBJECT..e.g. $e}
            # {oCRNRSTN_USR}
            # INCIDENT LOCATION META (LINE, METHOD, FILE, NAMESPACE)
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function getSessionParam($name){
        try {

            if (isset($name)) {

                return self::$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam($name);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the requested session parameter.');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function setSessionParam($name, $value = ''){

        try {

            if (isset($name)) {

                return self::$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam($name, $value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the session parameter that is to be saved.');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function issetSessionParam($name){

        try {

            if (isset($name)) {

                return self::$oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam($name);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the session parameter that is to be checked to determine if it is currently set with a value.');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function isset_HTTPSuper($transport_protocol = 'POST'){

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        return self::$oCRNRSTN_ENV->issetHTTP($http_protocol);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnRecordCount($oQueryProfileMgr, $result_set_key){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                if (!is_object($oCRNRSTN_MySQLi) || !isset($result_handle) || !isset($batch_key) || !isset($result_set_key)) {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Missing input parameter(s) for this method.');

                } else {

                    return self::$oDB_CRNRSTN->returnRecordCount($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function loadPreviousRecordLookup($oQueryProfileMgr, $result_set_key, $lookupSerial){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                self::$oDB_CRNRSTN->loadPreviousRecordLookup($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookupSerial);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function initLookupByID($oQueryProfileMgr, $result_set_key){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                self::$oDB_CRNRSTN->initLookupByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            //$this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__, CRNRSTN_LOG_EMAIL, 'j5@jony5.com');

            return false;

        }


    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addLookupFieldData($oQueryProfileMgr, $result_set_key, $field_name, $field_value){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                return self::$oDB_CRNRSTN->addLookupFieldData($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function retrieveDataByID($oQueryProfileMgr, $result_set_key, $lookup_fieldname, $piped_primary_id_fields = NULL, $piped_lookup_id_data = NULL){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                self::$oDB_CRNRSTN->keyDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields);

                return self::$oDB_CRNRSTN->retrieveDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_fieldname, $piped_lookup_id_data);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function pingValueExistence($oQueryProfileMgr, $result_set_key, $fieldname, $value){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                return self::$oDB_CRNRSTN->pingValueExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function pingResultSetExistence($oQueryProfileMgr, $result_set_key){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                return self::$oDB_CRNRSTN->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function resultSetMerge($oQueryProfileMgr, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val = true, $sequence_fields_piped = null, $sequence_fields_datatype_piped = null){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);

                if (isset($result_handle) && isset($batch_key) && isset($result_set_key) && isset($target_result_set_key) && isset($merge_fields_piped)) {

                    return self::$oDB_CRNRSTN->resultSetMerge($oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped);

                } else {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the requested MySQL data due to missing param(s)...result handle[' . $result_handle . '], batch key[' . $batch_key . '], result_set_key[' . $result_set_key . '], target_result_set_key[' . $target_result_set_key . '] and/or the desired merge field(s)[' . $merge_fields_piped . '].');

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnDatabaseValue($oQueryProfileMgr, $result_set_key, $fieldname, $pos = 0){

        try {

            $oCRNRSTN_MySQLi = $oQueryProfileMgr->return_MySQLi($result_set_key);

            if (is_object($oCRNRSTN_MySQLi)) {

                $result_handle = $oQueryProfileMgr->return_resultHandle($result_set_key);
                $batch_key = $oQueryProfileMgr->return_batchKey($result_set_key);
                if (isset($result_handle) && isset($batch_key) && isset($result_set_key) && isset($fieldname)) {

                    return self::$oDB_CRNRSTN->returnDatabaseValue($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos);

                } else {

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to return the requested MySQL data due to missing param(s)...result handle[' . $result_handle . '], batch key[' . $batch_key . '], result_set_key[' . $result_set_key . '] and/or the desired database field name[' . $fieldname . '].');

                }

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the database connection associated with the result set key [' . $result_set_key . '].');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function create_AdHocVar($key, $var = NULL){

        self::$adHocVariable_ARRAY[$key] = $var;

        return NULL;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function get_AdHocVar($key){

        if (isset(self::$adHocVariable_ARRAY[$key])) {

            return self::$adHocVariable_ARRAY[$key];

        } else {

            return NULL;
        }
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function specifyPaginationVariableName($variable_name, $pagination_serial = NULL){

        self::$oPaginator->specify_pagination_variable_name($variable_name, $pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function getPaginationVariableName($pagination_serial = NULL){

        return self::$oPaginator->get_pagination_variable_name($pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function addPaginationPassthroughInputVal($input_name, $input_value, $pagination_serial){

        self::$oPaginator->add_pagination_passthrough_input_val($input_name, $input_value, $pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnCurrentPaginationPos($pagination_serial = NULL){

        $tmp_var_name = $this->getPaginationVariableName($pagination_serial);
        $tmp_pos = $this->returnHTTP_FormIntegration_InputVal($tmp_var_name);

        if ($tmp_pos == '') {

            $tmp_pos = 1;

        }

        return $tmp_pos;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnPaginationSerial(){

        return self::$oPaginator->return_pagination_serial();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnPaginationStateHTML($pagination_serial = NULL){

        return self::$oPaginator->return_pagination_state_HTML($pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function increment_results_count_total($result_count = 1, $pagination_serial = NULL){

        //error_log('5531 user - increment_results_count_total ['.$result_count.']');
        self::$oPaginator->increment_results_count_total($result_count, $pagination_serial);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function set_maximum_display_result_count($maximum_display_count, $pagination_serial = NULL){

        self::$oPaginator->set_maximum_display_result_count($maximum_display_count, $pagination_serial);

    }

    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function generateNewKey($len = 32, $char_selection = NULL){

        $token = "";

        if(isset($char_selection)){

            $codeAlphabet = $char_selection;

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }else{

            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }

        return $token;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    private function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    //
    // SOURCE :: https://stackoverflow.com/questions/5100189/use-php-to-check-if-page-was-accessed-with-ssl
    // AUTHOR :: https://stackoverflow.com/users/887067/saeven
    public function isSSL(){

        if( !empty( $_SERVER['HTTPS'] ) && ($_SERVER['HTTPS'] != 'off') )
            return true;

        if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
            return true;

        return false;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php#118550
    // AUTHOR :: stanislav dot eckert at vizson dot de
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function highlightText($text, $colorScheme = CRNRSTN_PHPNIGHT)   // [EDIT] CRNRSTN v2.0.0 FOR PHPNIGHT :: J5
    {
        //$colorScheme = trim(strtolower($colorScheme));              // [EDIT] CRNRSTN v2.0.0 :: J5

        if ($colorScheme == CRNRSTN_UI_PHP) {

            ini_set('highlight.comment', '#008000');
            ini_set('highlight.default', '#000');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#00B; font-weight: bold');
            ini_set('highlight.string', '#D00');

        } else if ($colorScheme == CRNRSTN_HTML) {

            ini_set('highlight.comment', 'green');
            ini_set('highlight.default', '#C00');
            ini_set('highlight.html', '#000');
            ini_set('highlight.keyword', 'black; font-weight: bold');
            ini_set('highlight.string', '#00F');

        } else if ($colorScheme == CRNRSTN_UI_PHPNIGHT)                        // [EDIT] CRNRSTN v2.0.0 :: J5
        {
            ini_set('highlight.comment', '#FC0');
            ini_set('highlight.default', '#DEDECB');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#8FE28F; font-weight: normal');
            ini_set('highlight.string', '#F66');

        }
        // ...

        $text = trim($text);
        $text = highlight_string("<?php " . $text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;
    }

    //
    // METHOD DERIVED FROM CODE WRITTEN BY stanislav dot eckert at vizson dot de ON PHP.NET
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function highlightCode($filepath, $colorScheme = CRNRSTN_PHPNIGHT){

        //$colorScheme = trim(strtolower($colorScheme));

        if ($colorScheme == CRNRSTN_UI_PHP) {
            ini_set('highlight.comment', '#008000');
            ini_set('highlight.default', '#000000');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#0000BB; font-weight: bold');
            ini_set('highlight.string', '#DD0000');
        } else if ($colorScheme == CRNRSTN_UI_HTML) {
            ini_set('highlight.comment', 'green');
            ini_set('highlight.default', '#CC0000');
            ini_set('highlight.html', '#000000');
            ini_set('highlight.keyword', 'black; font-weight: bold');
            ini_set('highlight.string', '#0000FF');
        } else if ($colorScheme == CRNRSTN_UI_PHPNIGHT)                        // [EDIT] CRNRSTN v2.0.0 :: J5
        {
            ini_set('highlight.comment', '#FFCC00');
            ini_set('highlight.default', '#DEDECB');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#8FE28F; font-weight: normal');
            ini_set('highlight.string', '#FF6666');
        }
        // ...

        $text = highlight_file($filepath, true);
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;
    }

    public function currentEnvironment(){

        return $this->env_cleartext_name;

    }

    public function currentLocation(){

        return self::$oCRNRSTN_ENV->currentLocation();

    }

    public function return_endpointProfile(){

        return self::$oCRNRSTN_ENV->return_endpointProfile();

    }

    public function return_loggingProfile(){

        return self::$oCRNRSTN_ENV->return_loggingProfile();

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function get_errorLogTrace($output_profile, $log_silo_profile = CRNRSTN_LOG_ALL, $line_num = NULL, $method = NULL, $file = NULL, $output_profile_override_meta = NULL){

        try{

            if($this->CRNRSTN_debugMode<2){

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('Unable to retrieve log trace data due to CRNRSTN being in configuration of CRNRSTN_debugMode="'.$this->CRNRSTN_debugMode.'"...which setting does not authorize resource allocation enabling aggregation of error log data in server memory.');

            }else{

                if(!isset($method)){

                    $method = __METHOD__;

                }

                if(!isset($line_num)){

                    $line_num = __LINE__;

                }

                if(!isset($output_profile)){

                    $output_profile = $this->return_loggingProfile();

                }else{

                    $output_profile = trim(strtoupper($output_profile));
                    switch($output_profile){
                        case CRNRSTN_LOG_EMAIL:
                        case CRNRSTN_LOG_EMAIL_PROXY:
                        case CRNRSTN_LOG_FILE:
                        case CRNRSTN_LOG_SCREEN_TEXT:
                        case CRNRSTN_LOG_SCREEN:
                        case CRNRSTN_LOG_SCREEN_HTML:
                        case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:
                        case CRNRSTN_LOG_DEFAULT:
                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The provided logging output profile, "'.$output_profile.'", is not supported by CRNRSTN ::. Please choose between the following options :: [EMAIL, FILE, SCREEN_TEXT, SCREEN, SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]');

                        break;

                    }

                }

                $this->oLogger->get_errorLogTrace($output_profile, $output_profile_override_meta, $log_silo_profile, $line_num, $method, $file, $this);

            }

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function return_logPriorityPretty($logPriority, $format='TEXT'){

        $tmp_output_format = trim(strtoupper($format));

        if($tmp_output_format == 'HTML'){
            //'LOG_EMERG</span>:: system is unusable.</span>'

            switch($logPriority){
                case 0:
                    $tmp_priority_const = 'LOG_EMERG';
                    $tmp_priority_msg = ':: system is unusable.';
                break;
                case 1:
                    $tmp_priority_const = 'LOG_ALERT';
                    $tmp_priority_msg = ':: action must be taken immediately.';
                    break;
                case 2:
                    $tmp_priority_const = 'LOG_CRIT';
                    $tmp_priority_msg = ':: critical conditions encountered.';
                    break;
                case 3:
                    $tmp_priority_const = 'LOG_ERR';
                    $tmp_priority_msg = ':: error conditions encountered.';
                    break;
                case 4:
                    $tmp_priority_const = 'LOG_WARNING';
                    $tmp_priority_msg = ':: warning conditions encountered.';
                    break;
                case 5:
                    $tmp_priority_const = 'LOG_NOTICE';
                    $tmp_priority_msg = ':: normal, but significant, condition encountered.';
                    break;
                case 6:
                    $tmp_priority_const = 'LOG_INFO';
                    $tmp_priority_msg = ':: informational message.';
                    break;
                case 7:
                    $tmp_priority_const = 'LOG_DEBUG';
                    $tmp_priority_msg = ':: debug-level message.';
                    break;
                default:
                    $tmp_priority_const = 'UNKNOWN';
                    $tmp_priority_msg = '';
                    break;
            }

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#FF0000; font-weight: bold;">'.$tmp_priority_const.'</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">'.$tmp_priority_msg.'</span>';

        }else{

            switch($logPriority){
                case 0:
                    $tmp_priority = 'LOG_EMERG :: system is unusable.';
                    break;
                case 1:
                    $tmp_priority = 'LOG_ALERT :: action must be taken immediately';
                    break;
                case 2:
                    $tmp_priority = 'LOG_CRIT :: critical conditions encountered';
                    break;
                case 3:
                    $tmp_priority = 'LOG_ERR :: error conditions encountered';
                    break;
                case 4:
                    $tmp_priority = 'LOG_WARNING :: warning conditions encountered';
                    break;
                case 5:
                    $tmp_priority = 'LOG_NOTICE :: normal, but significant, condition encountered';
                    break;
                case 6:
                    $tmp_priority = 'LOG_INFO :: informational message';
                    break;
                case 7:
                    $tmp_priority = 'LOG_DEBUG :: debug-level message';
                    break;
                default:
                    $tmp_priority = 'UNKNOWN';
                    break;
            }

        }

        return $tmp_priority;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function returnClientIP(){

        return self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress();

    }

    public function exclusiveAccess($ip='*.*'){

        return self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip);

    }

    public function denyIPAccess($ip='*.*'){

        return self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip);

    }

    public function stringSanitize($str, $type){

        return $this->strSanitize($str, $type);

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.str-split.php
    // AUTHOR :: https://www.php.net/manual/en/function.str-split.php#113274
    public function str_split_unicode($str, $length = 1) {

        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);

        if ($length > 1) {
            $chunks = array_chunk($tmp, $length);
            foreach ($chunks as $i => $chunk) {
                $chunks[$i] = join('', (array) $chunk);
            }
            $tmp = $chunks;
        }

        return $tmp;

    }

    public function number_format_keep_precision($number, $dec_places=0, $dec_point = '.', $thou_separate = ','){

        if($dec_places>0){

            return number_format($number , $dec_places , $dec_point, $thou_separate);

        }else{

            //
            // SOURCE :: https://www.php.net/manual/en/function.number-format.php
            // AUTHOR :: https://www.php.net/manual/en/function.number-format.php#52311
            $broken_number = explode($dec_point,$number);
            if(isset($broken_number[1])){

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate).$dec_point.$broken_number[1];

            }else{

                return number_format($broken_number[0] , 0 , $dec_point, $thou_separate);

            }

        }

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    public function formatBytes($bytes, $precision = 2, $SI_output=false) {

        //
        // CRNRSTN v2.0.0 :: MODS
        // SEE :: https://en.wikipedia.org/wiki/Binary_prefix
        // SEE ALSO :: ISO/IEC 80000 family of standards (November 1, 2009)
        // https://en.wikipedia.org/wiki/ISO/IEC_80000#Information_science_and_technology
        // SEE COMMENT BY DEVATOR [https://stackoverflow.com/users/659731/devator] JUST
        // BENEATH THE METHOD [formatBytes()] AUTHOR'S RESPONSE AT SOURCE LINK. THIS IS MY
        // IMPETUS TO INCLUDE THE ABOVE LINKS TO ADDITIONAL MATERIAL FROM WIKIPEDIA.
        if($SI_output){

            // SI :: metric prefix
            $units = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $units_power = 1000;

        }else{

            // IEC :: ISO 80000 or IEC 80000
            $units = array('bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
            $units_power = 1024;

        }

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log($units_power));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow($units_power, $pow);

        $tmp_number = round($bytes, $precision);
        $tmp_number = $this->number_format_keep_precision($tmp_number);

        return  $tmp_number. ' ' . $units[$pow];

    }

    public function return_email_creative($creative_element_key, $image_output_mode = CRNRSTN_UI_IMG_URI_HTML_WRAPPED){

        return self::$oCommRichMediaProvider->return_creative($creative_element_key, $image_output_mode);

    }

    public function shortenColorHex($color_hex){

        $tmp_hex_array = str_split($color_hex);

        if($tmp_hex_array[1]==$tmp_hex_array[2] && $tmp_hex_array[3]==$tmp_hex_array[4] && $tmp_hex_array[5]==$tmp_hex_array[6]){

            $color_hex = '#'.$tmp_hex_array[1].$tmp_hex_array[3].$tmp_hex_array[5];

        }

        return $color_hex;

    }

    private function return_image_to_html_str($width, $height, $table_row_HTML){

        $str = '';
        $str .= '
<table cellpadding="0" cellspacing="0" border="0" width="'.$width.'" style="width:'.$width.'px; height:'.$height.'px;">';
        $str .= $table_row_HTML;
        $str .= '</table>
';

        return $str;

    }

    private function return_styled_row_HTML($table_col_HTML){

        $str = '<tr>';
        $str .= $table_col_HTML;
        $str .= '</tr>';

        return $str;

    }

    private function return_styled_column_HTML($color_hex){

        //$str = '<td style="width:1px; height:1px; overflow: hidden; padding: 0; margin: 0; background-color: '.$color_hex.';"><div style="width: 1px; height: 1px; overflow: hidden;">&nbsp;</div></td>';

        $str = '<td style="background-color:'.$color_hex.';"><div style="width:1px;height:1px;overflow:hidden;">&nbsp;</div></td>';

        return $str;

    }

    private function return_pixelHex($x, $y, $oImageMagi){

        $pixel = $oImageMagi->getImagePixelColor($x, $y);

        $tmp_color_str = $pixel->getColorAsString();
        $tmp_color_str = $this->properReplace('%','', $tmp_color_str);
        $tmp_color_str = $this->properReplace('srgb','', $tmp_color_str);
        $tmp_color_str = $this->properReplace('(','', $tmp_color_str);
        $tmp_color_str = $this->properReplace(')','', $tmp_color_str);

        $tmp_color_explode = explode(',', $tmp_color_str);

        //
        // SOURCE :: https://stackoverflow.com/questions/32962624/convert-rgb-to-hex-color-values-in-php
        // AUTHOR :: https://stackoverflow.com/users/3942918/user3942918
        $color_hex = sprintf('#%02x%02x%02x', $tmp_color_explode[0], $tmp_color_explode[1], $tmp_color_explode[2]);

        $color_hex = strtoupper($color_hex);

        $color_hex = $this->shortenColorHex($color_hex);

        return $color_hex;

    }

    public function return_image_as_table_HTML($filePath){

        $tmp_image_to_html_str = '';

        if(is_file($filePath)){

            $oImageMagi = new Imagick($filePath);

            $height = $oImageMagi->getImageHeight();
            $width = $oImageMagi->getImageWidth();
            $x = 0;

            $table_row_HTML = '';
            for($y=0; $y<=$height; $y++){

                $table_col_HTML = '';
                for($x=0; $x<=$width; $x++){

                    $tmp_pixel_color_hex = $this->return_pixelHex($x, $y, $oImageMagi);

                    $table_col_HTML .= $this->return_styled_column_HTML($tmp_pixel_color_hex);

                }

                $table_row_HTML .= $this->return_styled_row_HTML($table_col_HTML);

            }

            $tmp_image_to_html_str = $this->return_image_to_html_str($width, $height, $table_row_HTML);

            $this->error_log('IMAGE['.$filePath.']_HTML='.$tmp_image_to_html_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_CREATIVE_EMBED);


        }else{

            $tmp_image_to_html_str = 'Path to file ['.$filePath.'] is not recognized as a file.';

        }

        return $tmp_image_to_html_str;

    }

    public function isMatchedStrPattern($str, $condition_pattern, $case_insensitive=false){

        if($case_insensitive){

            $tmp_str = strtolower($str);
            $tmp_pattern = strtolower($condition_pattern);

            if (fnmatch($tmp_pattern, $tmp_str)) {

                return true;

            }else{

                return false;

            }

        }else{

            if (fnmatch($condition_pattern, $str)) {

                return true;

            }else{

                return false;

            }

        }

    }

    private function strSanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try {

            switch ($type) {
                case 'max_storage_utilization':

                    $patterns[0] = '%';
                    $patterns[1] = 'percent';
                    $patterns[2] = ' ';
                    $patterns[3] = '!';

                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';

                break;
                case 'email_private':
                    $tmp_new_post_at_ARRAY = array();
                    $clean_str = '';
                    $last_dot_flag = false;
                    $tmp_at_split_ARRAY = explode('@', $str);
                    $tmp_post_at_len = strlen($tmp_at_split_ARRAY[1]);
                    $tmp_str_ARRAY = $this->str_split_unicode($str);
                    $tmp_post_at_str_ARRAY = $this->str_split_unicode($tmp_at_split_ARRAY[1]);
                    $tmp_post_at_str_rev_ARRAY = array_reverse($tmp_post_at_str_ARRAY);

                    //
                    // PREP POST @ SITUATION
                    for($i=0;$i<$tmp_post_at_len;$i++){

                        if(!$last_dot_flag){
                            if($tmp_post_at_str_rev_ARRAY[$i]=='.'){
                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag){

                                $i = $tmp_post_at_len+420;
                                $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                            }
                        }
                    }

                    $tmp_str_len = sizeof($tmp_str_ARRAY);
                    for($i=0; $i<$tmp_str_len; $i++){
                        if($i==0){

                            $clean_str .= $tmp_str_ARRAY[$i].'*****';

                        }else{

                            if($tmp_str_ARRAY[$i] == '@'){

                                $at_flag = true;
                                $tmp_plus_one = $i+1;
                                $clean_str .= $tmp_str_ARRAY[$i].$tmp_str_ARRAY[$tmp_plus_one].'*****';
                                $clean_str .= implode($tmp_new_post_at_ARRAY);
                                $i = $tmp_str_len + 420;
                            }
                        }
                    }

                    return $clean_str;

                break;
                case 'custom_mobi_detect_alg':

                    $patterns[0] = '(';
                    $patterns[1] = ')';
                    $replacements[0] = '';
                    $replacements[1] = '';

                break;
                case 'http_protocol_simple':

                    $patterns[0] = '_';
                    $patterns[1] = '$';
                    $patterns[2] = ' ';
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';

                break;
                case 'select_statement':

                    $patterns[0] = "`";
                    $replacements[0] = '';

                break;
                case 'select_field_name':

                    $patterns[0] = "
";
                    $patterns[1] = '"';
                    $patterns[2] = '=';
                    $patterns[3] = '{';
                    $patterns[4] = '}';
                    $patterns[5] = '(';
                    $patterns[6] = ')';
                    $patterns[7] = ' ';
                    $patterns[8] = '	';
                    $patterns[9] = ',';
                    $patterns[10] = '\n';
                    $patterns[11] = '\r';
                    $patterns[12] = '\'';
                    $patterns[13] = '/';
                    $patterns[14] = '#';
                    $patterns[15] = ';';
                    $patterns[16] = ':';
                    $patterns[17] = '>';

                    $replacements = array();
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';
                    $replacements[4] = '';
                    $replacements[5] = '';
                    $replacements[6] = '';
                    $replacements[7] = '';
                    $replacements[8] = '';
                    $replacements[9] = '';
                    $replacements[10] = '';
                    $replacements[11] = '';
                    $replacements[12] = '';
                    $replacements[13] = '';
                    $replacements[14] = '';
                    $replacements[15] = '';
                    $replacements[16] = '';
                    $replacements[17] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str . '].');

                break;
            }

            $str = str_replace($patterns, $replacements, $str);

            return $str;


        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function properReplace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function chunkPageData($tmp_page_content, $max_len){

        return self::$oCRNRSTN_ENV->chunkPageData($tmp_page_content, $max_len);

    }

    /**
     * Send a POST requst using cURL
     * @param string $url to request
     * @param array $post values to send
     * @param array $options for cURL
     * @return string
     * SOURCE :: https://www.php.net/manual/en/function.curl-exec.php
     * AUTHOR :: https://www.php.net/manual/en/function.curl-exec.php#98628
     */
    public function curl_post($url, array $post = NULL, array $options = array()){

        try{

            $defaults = array(
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_URL => $url,
                CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FORBID_REUSE => 1,
                CURLOPT_TIMEOUT => 4,
                CURLOPT_POSTFIELDS => http_build_query($post)
            );

            /*
            If you are doing a POST, and the content length is 1,025 or greater, then curl exploits
            a feature of http 1.1: 100 (Continue) Status.

            See http://www.w3.org/Protocols/rfc2616/rfc2616-sec8.html#sec8.2.3

            * it adds a header, "Expect: 100-continue".
            * it then sends the request head, waits for a 100 response code, then sends the content

            Not all web servers support this though.  Various errors are returned depending on the
            server.  If this happens to you, suppress the "Expect" header with this command:

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            */

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            if(!$result = curl_exec($ch)) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: CURL [POST] ERROR experienced :: '.curl_error($ch));

            }

            curl_close($ch);

            return $result;

        } catch (Exception $e) {

            curl_close($ch);

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * Send a GET requst using cURL
     * @param string $url to request
     * @param array $get values to send
     * @param array $options for cURL
     * @return string
     * SOURCE :: https://www.php.net/manual/en/function.curl-exec.php
     * AUTHOR :: https://www.php.net/manual/en/function.curl-exec.php#98628
     */
    public function curl_get($url, array $get = NULL, array $options = array()){

        try{

            $defaults = array(
                CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 4
            );

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            if(!$result = curl_exec($ch)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: CURL [GET] ERROR experienced :: '.curl_error($ch));

            }

            curl_close($ch);

            return $result;

        } catch (Exception $e) {

            curl_close($ch);

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.password-hash.php
    public function benchmark_bestPasswordHashCost(){

        /**
         * This code will benchmark your server to determine how high of a cost you can
         * afford. You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
         * which is a good baseline for systems handling interactive logins.
         */
        $timeTarget = 0.05; // 50 milliseconds

        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);

        $this->error_log('Load Test Complete for Password Hash Option Strength :: Appropriate Cost = '.$cost, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

    }

    public function validate_pwdHash_LOGIN_storage($user_submitted_password, $database_result_pwdHash){

        $user_password_md5 = md5($user_submitted_password);

        if(password_verify($user_password_md5, $database_result_pwdHash)){

            return true;

        }else{

            return false;

        }

    }

    public function returnSrvrRespStatus($status_code){

        $tmp_burn = $this->return_CRNRSTN_ASCII_ART();

        return self::$oCRNRSTN_ENV->returnSrvrRespStatus($status_code, $tmp_burn);

    }

    public function create_pwdHash_for_storage($user_submitted_password){

        /**
         * CONSIDER RUNNING benchmark_bestPasswordHashCost() AND THEN UPDATE
         * THIS METHOD, ACCORDINGLY FOR 'cost' => ???
         * You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. benchmark_bestPasswordHashCost() aims for ≤ 50 milliseconds
         * stretching time, which is a good baseline for systems handling interactive logins.
         */

        $options = [
            'cost' => 9,
        ];

        $user_password_md5 = md5($user_submitted_password);

        $user_password_strong_hash = password_hash($user_password_md5, PASSWORD_BCRYPT, $options);

        return $user_password_strong_hash;

    }

    public function print_r($expression,  $title=NULL, $colorScheme = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($colorScheme)){

            if(isset($this->colorScheme)){

                $colorScheme = $this->colorScheme;

            }else{

                //$this->colorScheme = 'phpnight';
                //$colorScheme = 'phpnight';

                $this->colorScheme = CRNRSTN_PHPNIGHT;
                $colorScheme = CRNRSTN_PHPNIGHT;


            }

        }

        $tmp_meta = '['.$this->getMicroTime().' '.date('T').'] [rtime '. $this->wallTime().' secs]';

        if(!isset($method) || $method==''){

            if(isset($file)){

                $tmp_meta .= ' [file '.$file.']';

            }

        }else{

            $tmp_meta .= ' [methd '.$method.']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum '.$line_num.']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->properReplace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; width:25px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">'.$lineHTML.'</div>';

        if(isset($title)){

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= $title;
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }else{

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= 'Begin print_r() output by C<span style="color:#F00;">R</span>NRSTN ::';
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }

        $tmp_hash = $this->generateNewKey(10);

        switch($colorScheme){
            case CRNRSTN_PHP:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#E6E6E6; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;

        }

        echo '<div style="background-color: #FFF; padding: 10px 20px 10px 20px;">';
        echo $tmp_out;

        $output = $this->highlightText($tmp_print_r, $colorScheme);
        $output = $this->properReplace('<br />', '
', $output);

        if($output == '<span style="color: #DEDECB"></span>' || $output == '<span style="color: #000000"></span>' || $output == '<span style="color: #CC0000"></span>'){

            $output = '<span style="color: #DEDECB">&nbsp;</span>';

        }

        echo '<pre>';
        print_r($output);
        echo '</pre>';

        $component_crnrstn_title = self::$oCRNRSTN_ENV->return_component_branding_creative();

        echo '</code></div></div>
        <div style="width:100%;">
            <div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>

            '.$component_crnrstn_title.'

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">'.$tmp_meta.'</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div>';

        echo '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>';

    }

    public function return_branding_creative($strip_formatting = false, $output_mode = CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED){

        return self::$oCRNRSTN_ENV->return_component_branding_creative($strip_formatting, $output_mode);

    }

    public function crcINT($value){

        $value = crc32($value);
        // return hash("crc32b", $value);
        return sprintf("%u", $value);

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image ($filename, $filetype) {

        error_log(__LINE__.' base64_encode_image-- '.$filename);

        if (is_file($filename) || (is_string($filename) && (strlen($filename) > 0))) {

            $imgbinary = fread(fopen($filename, "r"), $this->find_filesize($filename));

            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);

        }else{


            if(!is_file($filename)){

                error_log(__LINE__.'base64_encode_image() NOT IS_FILE!!');

            }

            if(!is_string($filename) && (strlen($filename) > 0)){

                error_log(__LINE__.'base64_encode_image() NOT IS_STRING!!');

            }

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: https://www.php.net/manual/en/function.filesize.php#119435
    private function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == "WIN"){

            exec('for %I in ("'.$file.'") do @echo %~zI', $output);
            $return = $output[0];

        }else{

            $return = filesize($file);

            // SOURCE :: https://www.php.net/manual/en/function.filesize.php
            // AUTHOR :: https://www.php.net/manual/en/function.filesize.php#121437
            //$fsobj = new COM("Scripting.FileSystemObject");
            //$f = $fsobj->GetFile($file);
            //$return = $f->Size;

        }

        return $return;

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key=NULL){

        $tmp_oLog = $this->oLogger->error_log($str, $line_num, $method, $file, $log_silo_key, $this);

        if(is_object($tmp_oLog)){

            $this->oLog_output_ARRAY[] = $tmp_oLog;

        }

        return true;

    }

    public function return_PHPExceptionTracePretty($exception_obj_trace_str, $format = 'ERROR_LOG'){

        switch($format){
            case 'HTML':

                $exception_obj_trace_str = $this->properReplace('\n', '<br>', $exception_obj_trace_str);
                $exception_obj_trace_str = $this->properReplace('
', '<br>', $exception_obj_trace_str);

            break;
            case 'TEXT':

                $exception_obj_trace_str = $this->properReplace('\n', '
', $exception_obj_trace_str);

            break;
            default:

                //
                // DO NOTHING :: STRAIGHT UNPROCESSED PHP NATIVE OUT


            break;

        }

        return $exception_obj_trace_str;

    }
    public function return_bit_constant($const_nom){

        return self::$oCRNRSTN_ENV->return_bit_constant($const_nom);

    }

    public function serialized_isBitSet($const_nom, $integer_const){

        return self::$oCRNRSTN_ENV->serialized_isBitSet($const_nom, $integer_const);

    }

    //define('CRNRSTN_PHP', (int) $this->initialize_constant('CRNRSTN_PHP'));
    public function initialize_serialized_bit($const_nom, $integer_const, $default_state = true){

        return self::$oCRNRSTN_ENV->initialize_serialized_bit($const_nom, $integer_const, $default_state);

    }

    public function initialize_bit($integer_constant, $default_state = true){

        $tmp_bitwise_object_array_index_serial = 'CRNRSTN_USER_GENERIC_BITS';

        if(!@constant($integer_constant)){

            //
            // DEFINE LOCAL CONSTANT
            define($integer_constant, self::$bitwise_serialization_cnt);

            self::$bitwise_serialization_cnt = self::$bitwise_serialization_cnt + 1;

            //error_log(__LINE__.' user $integer_constant='.print_r($integer_constant).' bitwise_serialization_cnt='.self::$bitwise_serialization_cnt);
            $tmp_val = self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bitwise_object_array_index_serial, self::$bitwise_serialization_cnt, $default_state);

            return $tmp_val;

        }else{

            //error_log(__LINE__.' user previously defined integer_constant = '.$integer_constant);

            if(!is_int($integer_constant)){

                $integer_constant = constant($integer_constant);

            }

            return self::$oCRNRSTN_ENV->initialize_serialized_bit($tmp_bitwise_object_array_index_serial, $integer_constant, $default_state);

        }

        //return self::$oCRNRSTN_ENV->initialize_bit($const_nom, $default_state);

    }

    public function isBitSet($const){

        return self::$oCRNRSTN_ENV->isBitSet($const);

    }

    public function catchException($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHPExceptionTracePretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str)>0){

            $this->error_log('PHP native exception output log trace received ::'.$tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_LOG_ALL);

        }

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $tmp_return = $this->oLogger->catchException($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

        if(is_array($tmp_return)){

            return $tmp_return;

        }

    }

    # #
    # SOURCE
    # http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
    public function return_CRNRSTN_ASCII_ART($index=NULL){

        $tmp_crnrstnART[0] = '      ___           <span style="color:#F00;">___</span>           ___           ___           ___                         ___              
     /\__\         <span style="color:#F00;">/\  \</span>         /\  \         /\  \         /\__\                       /\  \             
    /:/  /        <span style="color:#F00;">/::\  \</span>        \:\  \       /::\  \       /:/ _/_         ___          \:\  \            
   /:/  /        <span style="color:#F00;">/:/\:\__\</span>        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \      ::::::  ::::::           
  /:/  /  ___   <span style="color:#F00;">/:/ /:/  /</span>    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \     ::::::  ::::::          
 /:/__/  /\__\ <span style="color:#F00;">/:/_/:/__/</span>___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\         
 \:\  \ /:/  / <span style="color:#F00;">\:\/:::::/  / </span>\:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/         
  \:\  /:/  /   <span style="color:#F00;">\::/~~/~~~~</span>   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \          ::::::  ::::::         
   \:\/:/  /     <span style="color:#F00;">\:\~~\</span>        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \         ::::::  ::::::          
    \::/  /       <span style="color:#F00;">\:\__\</span>        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\             
     \/__/         <span style="color:#F00;">\/__/</span>         \/__/         \/__/         \/__/           \/__/       \/__/      
	 

';

        $tmp_crnrstnART[4] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">___</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/::\&nbsp;&nbsp;\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;_/_&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/:/\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;___&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">/:/&nbsp;/:/&nbsp;&nbsp;/</span>&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;/:/__/&nbsp;&nbsp;/\__\&nbsp;<span&nbsp;style="color:#F00;">/:/_/:/__/</span>___&nbsp;/::::::::\__\&nbsp;/:/_/:/__/___&nbsp;/:/_/:/\:\__\&nbsp;&nbsp;&nbsp;/:/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/::::::::\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;\:\&nbsp;&nbsp;\&nbsp;/:/&nbsp;&nbsp;/&nbsp;<span&nbsp;style="color:#F00;">\:\/:::::/&nbsp;&nbsp;/&nbsp;</span>\:\~~\~~\/__/&nbsp;\:\/:::::/&nbsp;&nbsp;/&nbsp;\:\/:/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/::\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\~~\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;\:\&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\::/~~/~~~~</span>&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\::/~~/~~~~&nbsp;&nbsp;&nbsp;\::/&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;/:/\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;\:\/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\:\~~\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\~~\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/_/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;\/__\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;\::/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\:\__\</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/:/&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\:\__\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">\/__/</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\/__/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
	&nbsp;<br>
<br>
';

        $tmp_crnrstnART[1] = '        CCCCCCCCCCCCC<span style="color:#F00;">RRRRRRRRRRRRRRRRR</span>   NNNNNNNN        NNNNNNNNRRRRRRRRRRRRRRRRR      SSSSSSSSSSSSSSS TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN        NNNNNNNN
     CCC::::::::::::C<span style="color:#F00;">R::::::::::::::::R</span>  N:::::::N       N::::::NR::::::::::::::::R   SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N       N::::::N
   CC:::::::::::::::C<span style="color:#F00;">R::::::RRRRRR:::::R</span> N::::::::N      N::::::NR::::::RRRRRR:::::R S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N      N::::::N
  C:::::CCCCCCCC::::C<span style="color:#F00;">RR:::::R     R:::::R</span>N:::::::::N     N::::::NRR:::::R     R:::::RS:::::S     SSSSSSST:::::TT:::::::TT:::::TN:::::::::N     N::::::N
 C:::::C       CCCCCC  <span style="color:#F00;">R::::R     R:::::R</span>N::::::::::N    N::::::N  R::::R     R:::::RS:::::S            TTTTTT  T:::::T  TTTTTTN::::::::::N    N::::::N
C:::::C                <span style="color:#F00;">R::::R     R:::::R</span>N:::::::::::N   N::::::N  R::::R     R:::::RS:::::S                    T:::::T        N:::::::::::N   N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R::::RRRRRR:::::R</span> N:::::::N::::N  N::::::N  R::::RRRRRR:::::R  S::::SSSS                 T:::::T        N:::::::N::::N  N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R:::::::::::::RR</span>  N::::::N N::::N N::::::N  R:::::::::::::RR    SS::::::SSSSS            T:::::T        N::::::N N::::N N::::::N      ::::::  ::::::
C:::::C                <span style="color:#F00;">R::::RRRRRR:::::R</span> N::::::N  N::::N:::::::N  R::::RRRRRR:::::R     SSS::::::::SS          T:::::T        N::::::N  N::::N:::::::N
C:::::C                <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N   N:::::::::::N  R::::R     R:::::R       SSSSSS::::S         T:::::T        N::::::N   N:::::::::::N
C:::::C                <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N    N::::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N    N::::::::::N
 C:::::C       CCCCCC  <span style="color:#F00;">R::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N     N:::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N     N:::::::::N      ::::::  ::::::
  C:::::CCCCCCCC::::C<span style="color:#F00;">RR:::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N      N::::::::NRR:::::R     R:::::RSSSSSSS     S:::::S      TT:::::::TT      N::::::N      N::::::::N      ::::::  ::::::
   CC:::::::::::::::C<span style="color:#F00;">R::::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N       N:::::::NR::::::R     R:::::RS::::::SSSSSS:::::S      T:::::::::T      N::::::N       N:::::::N      ::::::  ::::::
     CCC::::::::::::C<span style="color:#F00;">R::::::R</span>     <span style="color:#F00;">R:::::R</span>N::::::N        N::::::NR::::::R     R:::::RS:::::::::::::::SS       T:::::::::T      N::::::N        N::::::N
        CCCCCCCCCCCCC<span style="color:#F00;">RRRRRRRR</span>     <span style="color:#F00;">RRRRRRR</span>NNNNNNNN         NNNNNNNRRRRRRRR     RRRRRRR SSSSSSSSSSSSSSS         TTTTTTTTTTT      NNNNNNNN         NNNNNNN
                                                                                                                                                       

';

        $tmp_crnrstnART[5] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F00;">RRRRRRRRRRRRRRRRR</span>&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNNRRRRRRRRRRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSSSSSSSSSS&nbsp;TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F00;">R::::::::::::::::R</span>&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::::::::::::R&nbsp;&nbsp;&nbsp;SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F00;">R::::::RRRRRR:::::R</span>&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::RRRRRR:::::R&nbsp;S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F00;">RR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSSST:::::TT:::::::TT:::::TN:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTT&nbsp;&nbsp;T:::::T&nbsp;&nbsp;TTTTTTN::::::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R</span>N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::RRRRRR:::::R</span>&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;S::::SSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N::::N&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::::::::::RR</span>&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;R:::::::::::::RR&nbsp;&nbsp;&nbsp;&nbsp;SS::::::SSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;N::::N&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::RRRRRR:::::R</span>&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N&nbsp;&nbsp;R::::RRRRRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSS::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;N::::N:::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSSSSS::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;N:::::::::::N<br>
C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;N::::::::::N<br>
&nbsp;C:::::C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCC&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;R::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;C:::::CCCCCCCC::::C<span&nbsp;style="color:#F00;">RR:::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::NRR:::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TT:::::::TT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;CC:::::::::::::::C<span&nbsp;style="color:#F00;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS::::::SSSSSS:::::S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N:::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;::::::&nbsp;&nbsp;::::::<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC::::::::::::C<span&nbsp;style="color:#F00;">R::::::R</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">R:::::R</span>N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::NR::::::R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R:::::RS:::::::::::::::SS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T:::::::::T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N::::::N<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCCCCCCCCCCCC<span&nbsp;style="color:#F00;">RRRRRRRR</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">RRRRRRR</span>NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNRRRRRRRR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RRRRRRR&nbsp;SSSSSSSSSSSSSSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TTTTTTTTTTT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNNN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NNNNNNN<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
';

        $tmp_crnrstnART[2]= '

 ######  <span style="color:#F00;">########</span>  ##    ## ########   ######  ######## ##    ##     ##   ##  
##    ## <span style="color:#F00;">##     ##</span> ###   ## ##     ## ##    ##    ##    ###   ##    #### #### 
##       <span style="color:#F00;">##     ##</span> ####  ## ##     ## ##          ##    ####  ##     ##   ##  
##       <span style="color:#F00;">########</span>  ## ## ## ########   ######     ##    ## ## ##              
##       <span style="color:#F00;">##   ##</span>   ##  #### ##   ##         ##    ##    ##  ####     ##   ##  
##    ## <span style="color:#F00;">##    ##</span>  ##   ### ##    ##  ##    ##    ##    ##   ###    #### #### 
 ######  <span style="color:#F00;">##     ##</span> ##    ## ##     ##  ######     ##    ##    ##     ##   ##  


';

        $tmp_crnrstnART[6] = '<br>
<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F00;">########</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;########&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;####&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">########</span>&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;########&nbsp;&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;###&nbsp;&nbsp;&nbsp;&nbsp;####&nbsp;####&nbsp;<br>
&nbsp;######&nbsp;&nbsp;<span&nbsp;style="color:#F00;">##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##</span>&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;######&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;&nbsp;##&nbsp;&nbsp;<br>
<br>
<br>
';

        $tmp_crnrstnART[3] = '

                                                                                         
   _|_|_|  <span style="color:#F00;">_|_|_|</span>    _|      _|  _|_|_|      _|_|_|  _|_|_|_|_|  _|      _|              
 _|        <span style="color:#F00;">_|    _|</span>  _|_|    _|  _|    _|  _|            _|      _|_|    _|      _|  _|  
 _|        <span style="color:#F00;">_|_|_|</span>    _|  _|  _|  _|_|_|      _|_|        _|      _|  _|  _|              
 _|        <span style="color:#F00;">_|    _|</span>  _|    _|_|  _|    _|        _|      _|      _|    _|_|              
   _|_|_|  <span style="color:#F00;">_|    _|</span>  _|      _|  _|    _|  _|_|_|        _|      _|      _|      _|  _|  
                                                                                         
                                                                                         

';

        $tmp_crnrstnART[7] = '<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;_|_|_|_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|_|_|</span>&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;<span&nbsp;style="color:#F00;">_|&nbsp;&nbsp;&nbsp;&nbsp;_|</span>&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|_|_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_|&nbsp;&nbsp;_|&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<br>
';

        if(!isset($index)){

            return $tmp_crnrstnART[rand ( 0 , 3)];

        }else{

            return $tmp_crnrstnART[$index];

        }

    }

    //
    // SOURCE :: https://aloneonahill.com/blog/if-php-were-british/
    // AUTHOR :: https://aloneonahill.com/blog/about-dave/
    public function hello_world($is_bastard = false){

        //
        // SESSION IS SET
        try{

            if($is_bastard){

                $str = 'Hello World.';  // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__.' '.get_class().' exception! '.$str);
            throw new Exception('CRNRSTN '.$this->version_crnrstn.' :: '.$str.' This is an exception handling test from '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

            return self::$oCRNRSTN_ENV->hello_world($is_bastard);

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function output_agg_destruct_str(){

        if($this->destruct_output != ''){

            $colorScheme = $this->colorScheme;

            $this->oLog_output_ARRAY[] = $this->error_log('Process __destruct initiated output of error log trace data.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

            $this->print_r($this->destruct_output, 'C<span style="color:#F00;">R</span>NRSTN Debug Mode 2 :: Error Log Trace Debug Output ::', $colorScheme, __LINE__, __METHOD__, __FILE__);

        }

    }

    public function tidy_boolean($val){

        if(is_bool($val) === true){

            return $val;

        }else{

            if(!isset($val)){

                return false;

            }else{

                return self::$oCRNRSTN_ENV->boolean_conversion($val);

            }

        }

    }

    public function output_css_algorithm_profile(){

        if(!isset(self::$oCRNRSTN_CSS_VALIDATOR)) {

            self::$oCRNRSTN_CSS_VALIDATOR = new crnrstn_communications_css_standard($this);

        }

        $tmp_html_output = self::$oCRNRSTN_CSS_VALIDATOR->return_css_algorithm_profile();

        return $tmp_html_output;

    }

    public function return_form_html($form_key){

        try{

            switch($form_key){
                case 'CSS_VALIDATION_EMAIL_HTML_INPUT':

                    if(!isset(self::$oCRNRSTN_CSS_VALIDATOR)) {

                        self::$oCRNRSTN_CSS_VALIDATOR = new crnrstn_communications_css_standard($this);

                    }

                    //return_css_validator_input_form_HTML
                    $tmp_html_output = self::$oCRNRSTN_CSS_VALIDATOR->return_css_validator_input_form_HTML();

                    return $tmp_html_output;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An unknown form HTML key "'.$form_key.'" has been provided. The options which are available currently include: CSS_VALIDATION_EMAIL_MESSAGE.');

                break;

            }

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function validate_css($raw_html_data){

        try{

            if(!isset(self::$oCRNRSTN_CSS_VALIDATOR)){

                self::$oCRNRSTN_CSS_VALIDATOR = new crnrstn_communications_css_standard($this, $raw_html_data);

            }

            return self::$oCRNRSTN_CSS_VALIDATOR->return_validation_results();

        } catch (Exception $e) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct(){

        $this->output_agg_destruct_str();

        $this->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn :: usr __destruct called.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

    }
}