<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2020 eVifweb development
#  CRNRSTN Suite :: v2.0.0 on Sun May 31, 2020 at 1259hrs
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.v2.jony5.com/
#  CLASS :: crnrstn_user
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 4, 2020 @ 1620hrs

class crnrstn_user{

    protected $oLogger;
    private static $oEnv;
    private static $oDB_CRNRSTN;
    private static $oRedirectCntrlr;
    private static $oMySQLi_ARRAY = array();
    private static $oMySQLi_hash_ARRAY = array();
    private static $oSqlSilo;
    private static $oPaginator;

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

    private static $databaseQuery_ARRAY = array();
    public $query_ttl;
    public $oLog_output_ARRAY = array();
    public $starttime;
    public $debugMode;
    public $PHPMAILER_debugMode;
    public $log_silo_key_piped;
    public $env_cleartext_name;
    public $tmp_wcr_config_envKey;

    protected $oMessenger_ARRAY = array();

    public function __construct($oCRNRSTN_ENV){

        $this->oLog_output_ARRAY = $oCRNRSTN_ENV->oLog_output_ARRAY;
        $this->starttime = $oCRNRSTN_ENV->starttime;
        $this->debugMode = $oCRNRSTN_ENV->debugMode;
        $this->PHPMAILER_debugMode = $oCRNRSTN_ENV->PHPMAILER_debugMode;

        $this->log_silo_key_piped = $oCRNRSTN_ENV->log_silo_key_piped;
        $this->tmp_wcr_config_envKey = $this->env_cleartext_name = $oCRNRSTN_ENV->env_cleartext_name;

        //
        // CLEAR ENV oLOG OUTPUT ARRAY TO FREE MEMORY
        array_splice($oCRNRSTN_ENV->oLog_output_ARRAY, 0);

        //
        // STORE CRNRSTN ENVIRONMENTALS
        self::$oEnv = $oCRNRSTN_ENV;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oEnv->debugMode, __CLASS__, self::$oEnv->log_silo_key_piped);

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

    }

    private function triggerProxyMessaging($CRNRSTN_PACKET_DELIMITER, $CRNRSTN_PACKET_DATUM){

        try{

            if($CRNRSTN_PACKET_DATUM!=''){

                $tmp_packet_ARRAY = explode($CRNRSTN_PACKET_DELIMITER, $CRNRSTN_PACKET_DATUM);
                $tmp_WCR_KEY = $tmp_packet_ARRAY[0];

                switch($tmp_WCR_KEY){
                    case 'THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION':

                    break;
                    case 'ELECTRUM_NOTIFICATION_DETAIL':

                    break;

                }




                $tmp_RECIPIENT_EMAIL_COMMA_DELIM = $tmp_packet_ARRAY[1];
                $tmp_RECIPIENT_NAME_COMMA_DELIM = $tmp_packet_ARRAY[2];
                $tmp_FROM_EMAIL = $tmp_packet_ARRAY[3];
                $tmp_FROM_NAME = $tmp_packet_ARRAY[4];
                $tmp_REPLYTO_EMAIL = $tmp_packet_ARRAY[5];
                $tmp_REPLYTO_NAME = $tmp_packet_ARRAY[6];
                $tmp_MESSAGE_SUBJECT = $tmp_packet_ARRAY[7];

                //
                // COMPLETE MESSAGE CONTENT - OVERRIDES
                $tmp_MESSAGE_BODY_HTML = $tmp_packet_ARRAY[8];
                $tmp_MESSAGE_BODY_TEXT = $tmp_packet_ARRAY[9];

                $tmp_SYS_MESSAGE_TITLE_HTML = $tmp_packet_ARRAY[10];
                $tmp_SYS_MESSAGE_TITLE_TEXT = $tmp_packet_ARRAY[11];
                $tmp_SYS_LOG_INTEGER_CONSTANT = $tmp_packet_ARRAY[12];
                $tmp_SYS_MESSAGE_HTML = $tmp_packet_ARRAY[13];
                $tmp_SYS_MESSAGE_TEXT = $tmp_packet_ARRAY[14];
                $tmp_SYS_REMOTE_ADDR = $tmp_packet_ARRAY[15];
                $tmp_SYS_SERVER_NAME = $tmp_packet_ARRAY[16];
                $tmp_SYS_SYSTEM_TIME = $tmp_packet_ARRAY[17];
                $tmp_SYS_PROCESS_RUN_TIME = $tmp_packet_ARRAY[18];
                $tmp_SYS_ACTIVITY_TRACE_TITLE = $tmp_packet_ARRAY[19];
                $tmp_SYS_ACTIVITY_TRACE_CONTENT_HTML = $tmp_packet_ARRAY[20];
                $tmp_SYS_ACTIVITY_TRACE_CONTENT_TEXT = $tmp_packet_ARRAY[21];
                $tmp_CRNRSTN_PROXY_AUTH_KEY = $tmp_packet_ARRAY[22];
                $tmp_ELECTRUM_START_TIME = $tmp_packet_ARRAY[23];
                $tmp_ELECTRUM_END_TIME = $tmp_packet_ARRAY[24];
                $tmp_ELECTRUM_PRETTY_RUN_TIME = $tmp_packet_ARRAY[25];
                $tmp_ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED = $tmp_packet_ARRAY[26];
                $tmp_ELECTRUM_TOTAL_COUNT_FILES_SKIPPED = $tmp_packet_ARRAY[27];
                $tmp_ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED = $tmp_packet_ARRAY[28];
                $tmp_ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED = $tmp_packet_ARRAY[29];
                $tmp_ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR = $tmp_packet_ARRAY[30];
                $tmp_ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED = $tmp_packet_ARRAY[31];
                $tmp_ELECTRUM_DATA_SOURCE_HTML = $tmp_packet_ARRAY[32];
                $tmp_ELECTRUM_DATA_DESTINATION_HTML = $tmp_packet_ARRAY[33];
                $tmp_ELECTRUM_DATA_HANDLING_PROFILE_HTML = $tmp_packet_ARRAY[34];
                $tmp_ELECTRUM_DATA_SOURCE_TEXT = $tmp_packet_ARRAY[35];
                $tmp_ELECTRUM_DATA_DESTINATION_TEXT = $tmp_packet_ARRAY[36];
                $tmp_ELECTRUM_DATA_HANDLING_PROFILE_TEXT = $tmp_packet_ARRAY[37];

                error_log('145 - SYS_MESSAGE_TITLE_HTML = '.$tmp_SYS_MESSAGE_TITLE_HTML);
                $tmp_AUTH_KEY = $this->getEnvResource('CRNRSTN_PROXY_AUTH_KEY');

                if($tmp_CRNRSTN_PROXY_AUTH_KEY == $tmp_AUTH_KEY){

                    //
                    // EXTRACT EMAIL PROTOCOL [SMTP, QMAIL, SENDMAIL, MAIL] FROM WCR
                    $tmp_protocol = trim(strtoupper($this->getEnvResource('EMAIL_PROTOCOL', 'CRNRSTN_SMTP_COMM_PROFILE')));
                    $tmp_SMTP_AUTH = false;

                    if($tmp_protocol=='SMTP'){

                        $tmp_SMTP_AUTH = $this->getEnvResource('SYS_SMTP_AUTH', 'CRNRSTN_SMTP_COMM_PROFILE');
                        $tmp_SMTP_SERVER = $this->getEnvResource('SYS_SMTP_SERVER', 'CRNRSTN_SMTP_COMM_PROFILE');
                        $tmp_SMTP_PORT_OUTGOING = $this->getEnvResource('SYS_SMTP_PORT_OUTGOING', 'CRNRSTN_SMTP_COMM_PROFILE');
                        $tmp_SMTP_USERNAME = $this->getEnvResource('SYS_SMTP_USERNAME', 'CRNRSTN_SMTP_COMM_PROFILE');
                        $tmp_SMTP_PASSWORD = $this->getEnvResource('SYS_SMTP_PASSWORD', 'CRNRSTN_SMTP_COMM_PROFILE');

                    }

                    $tmp_oGabriel_serial = $this->generateNewKey(50);
                    if($tmp_SMTP_AUTH){

                        //
                        // SMTP AUTH
                        $CRNRSTN_oGabriel = $this->initialize_oGabriel($tmp_oGabriel_serial, $tmp_protocol, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING);

                    }else{

                        //
                        // ANY NON-AUTH
                        $CRNRSTN_oGabriel = $this->initialize_oGabriel($tmp_oGabriel_serial, $tmp_protocol);

                    }

                    if(isset($tmp_SMTP_SERVER)){
                        if($tmp_SMTP_SERVER!=''){

                            $this->addHostServers($CRNRSTN_oGabriel, $tmp_SMTP_SERVER);

                        }
                    }

                    //
                    // EXTRACT REMAINING SYSTEM MESSAGING META FROM WCR
                    if($tmp_FROM_EMAIL==''){

                        $tmp_FROM_EMAIL = $this->getEnvResource('SYS_FROM_EMAIL', 'CRNRSTN_SMTP_COMM_PROFILE');
                        $tmp_FROM_NAME = $this->getEnvResource('SYS_FROM_NAME', 'CRNRSTN_SMTP_COMM_PROFILE');

                        $tmp_REPLYTO_EMAIL = $this->getEnvResource('SYS_REPLYTO_EMAIL', 'CRNRSTN_SMTP_COMM_PROFILE');
                        $tmp_REPLYTO_NAME = $this->getEnvResource('SYS_REPLYTO_NAME', 'CRNRSTN_SMTP_COMM_PROFILE');

                    }

                    $tmp_DEFAULT_LINE_WRAP = $this->getEnvResource('SYS_MSG_DEFAULT_WORD_WRAP', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_DEFAULT_PRIORITY = $this->getEnvResource('SYS_MSG_DEFAULT_PRIORITY', 'CRNRSTN_SMTP_COMM_PROFILE');

                    $tmp_DEFAULT_DUP_SUPPRESS = $this->getEnvResource('SYS_MSG_DEFAULT_DUP_SUPPRESS', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $this->suppressEmailDuplicates($CRNRSTN_oGabriel, $tmp_DEFAULT_DUP_SUPPRESS);

                    //
                    // PROCESS BATCH TRIGGERS
                    $tmp_recipient_email_ARRAY = explode(',', $tmp_RECIPIENT_EMAIL_COMMA_DELIM);
                    $tmp_recipient_name_ARRAY = explode(',', $tmp_RECIPIENT_NAME_COMMA_DELIM);

                    $tmp_email_cnt = sizeof($tmp_recipient_email_ARRAY);
                    $tmp_name_cnt = sizeof($tmp_recipient_name_ARRAY);

                    if($tmp_name_cnt == $tmp_email_cnt){

                        for($i=0;$i<$tmp_email_cnt;$i++){

                            //
                            // ADD BULK EMAIL FOR SINGULARITY OF DELIVERY AND CUSTOMIZATION
                            $email_experience_tracker = $this->addAddressBulk($CRNRSTN_oGabriel, $tmp_recipient_email_ARRAY[$i], $tmp_recipient_name_ARRAY[$i]);

                            $this->addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_REPLYTO_EMAIL, $tmp_REPLYTO_NAME);
                            $this->addFromBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_FROM_EMAIL, $tmp_FROM_NAME);
                            $this->wordWrapBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_LINE_WRAP);
                            $this->setPriorityBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_PRIORITY);

                            $this->addSubjectBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_MESSAGE_SUBJECT);

                            if($tmp_MESSAGE_BODY_HTML!=''){
                                $this->isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, true);
                                $this->addHTMLver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_MESSAGE_BODY_HTML);

                                if($tmp_MESSAGE_BODY_TEXT!=''){

                                    $this->addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_MESSAGE_BODY_TEXT);

                                }

                            }else{

                                if($tmp_MESSAGE_BODY_TEXT!=''){

                                    $this->addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_MESSAGE_BODY_TEXT);
                                    $this->isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, false);

                                }else{

                                    $this->addHTMLver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('HTML', 'ELECTRUM_PERFORMANCE_REPORT'));
                                    $this->addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('TEXT', 'ELECTRUM_PERFORMANCE_REPORT'));
                                    $this->isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, true);

                                }

                            }

                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{MESSAGE_TITLE}', $tmp_SYS_MESSAGE_TITLE_HTML);
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{MESSAGE_TITLE}', $tmp_SYS_MESSAGE_TITLE_TEXT);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{MESSAGE}', $tmp_SYS_MESSAGE_HTML);
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{MESSAGE}', $tmp_SYS_MESSAGE_TEXT);
                            $this->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{SYSTEM_TIME}', $tmp_SYS_SYSTEM_TIME);

                            $this->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{REMOTE_ADDR}', $tmp_SYS_REMOTE_ADDR);
                            $this->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{SERVER_NAME}', $tmp_SYS_SERVER_NAME);

                            $this->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{PROCESS_RUN_TIME}', $tmp_SYS_PROCESS_RUN_TIME);
                            $this->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{EMAIL}', $tmp_recipient_email_ARRAY[$i]);

                            //
                            // TO HANDLE DYNAMIC CONTENT FOR HTML AND TEXT SEPARATELY
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{SYSTEM_LOG_INTEGER_CONSTANT}', $this->return_logPriorityPretty($tmp_SYS_LOG_INTEGER_CONSTANT, 'HTML'));
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{SYSTEM_LOG_INTEGER_CONSTANT}',  $this->return_logPriorityPretty($tmp_SYS_LOG_INTEGER_CONSTANT));

                            $this->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{LOG_TRACE_TITLE}', $tmp_SYS_ACTIVITY_TRACE_TITLE);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{LOG_TRACE}', $tmp_SYS_ACTIVITY_TRACE_CONTENT_HTML);
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{LOG_TRACE}', $tmp_SYS_ACTIVITY_TRACE_CONTENT_TEXT);

                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{START_TIME}', $tmp_ELECTRUM_START_TIME);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{END_TIME}', $tmp_ELECTRUM_END_TIME);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{PRETTY_RUN_TIME}', $tmp_ELECTRUM_PRETTY_RUN_TIME);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_COUNT_FILES_TRANSFERRED}', $tmp_ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_COUNT_FILES_SKIPPED}', $tmp_ELECTRUM_TOTAL_COUNT_FILES_SKIPPED);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_FILESIZE_FILES_TRANSFERRED}', $tmp_ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_ERRORS_FILES_TRANSFERRED}', $tmp_ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}', $tmp_ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}', $tmp_ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED);

                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_SOURCE_HTML}', $tmp_ELECTRUM_DATA_SOURCE_HTML);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_DESTINATION_HTML}', $tmp_ELECTRUM_DATA_DESTINATION_HTML);
                            $this->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_HANDLING_PROFILE_HTML}', $tmp_ELECTRUM_DATA_HANDLING_PROFILE_HTML);
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_SOURCE_TEXT}', $tmp_ELECTRUM_DATA_SOURCE_TEXT);
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_DESTINATION_TEXT}', $tmp_ELECTRUM_DATA_DESTINATION_TEXT);
                            $this->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}', $tmp_ELECTRUM_DATA_HANDLING_PROFILE_TEXT);

                        }

                        $this->oGabriel_Send($CRNRSTN_oGabriel);


                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The CRNRSTN :: proxy email notification layer has received a data packet having a misalignment in count between comma delimited recipient email addresses['.$tmp_email_cnt.'] and the associated names['.$tmp_name_cnt.'].');

                    }

                    return 'success['.$tmp_email_cnt.'] ->['.$tmp_SYS_ACTIVITY_TRACE_TITLE.']->['.$tmp_ELECTRUM_DATA_DESTINATION_HTML.']';

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('ERROR 403 :: Unauthorized proxy request received.');

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An empty CRNRSTN :: proxy email messaging data packet has been received.');

            }

        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function proxyEmailFire($WCR_key_email_packet, $endpoint_uri=NULL, $oKingsHighway=NULL){

        if(!isset($endpoint_uri)){

            $endpoint_uri = $this->getEnvResource('CRNRSTN_PROXY_WSDL_ENDPOINT');

            if($endpoint_uri==''){

                $endpoint_uri = $this->getEnvResource('CRNRSTN_PROXY_WSDL_ENDPOINT', $WCR_key_email_packet);

            }

        }

        //
        // SOAP
        $tmp_SOAP_request = $this->return_oKingsHighwaySOAP();

        $soapClient = new crnrstn_soap_client_manager($this,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');

        $response = $soapClient->sendRequest_SOAP('takeTheKingsHighway', $tmp_SOAP_request);

        $tmp_key_raw = urldecode($response['CRNRSTN_PROXY_AUTH_KEY']);
        $this->error_log('TOTAL_EMAILS_RECEIVED='.$response['TOTAL_EMAILS_RECEIVED'], __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM_COMM');

        $this->error_log('CRNRSTN_PROXY_AUTH_KEY='.$tmp_key_raw, __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM_COMM');
        $this->error_log('paramTunnelDecrypt/true-CRNRSTN_PROXY_AUTH_KEY='.$this->paramTunnelDecrypt($tmp_key_raw, true), __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM_COMM');

        $this->error_log('377 - returnResult='.$soapClient->returnResult(), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
        
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

        $this->error_log('The CRNRSTN :: Electrum process notification SOAP has been sent.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

    }

    private function return_oKingsHighwaySOAP(){

        $this->soapRequest_ARRAY = array('oKingsHighwayNotification' =>
            array(
                'CRNRSTN_PACKET_ENCRYPTED' => 'TRUE',
                'CRNRSTN_PROXY_AUTH_KEY' => $this->paramTunnelEncrypt($this->getEnvResource('CRNRSTN_PROXY_AUTH_KEY'))
            ));

        return $this->soapRequest_ARRAY;

    }

    private function return_emailProxyIntegrationPacket($WCR_key_email_packet, $packet_delimiter){

        $tmp_str = '';
        switch($WCR_key_email_packet){
            case 'THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION':

                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CRNRSTN_PROXY_AUTH_KEY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('BCC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('BCC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('WORD_WRAP', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('PRIORITY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('IS_HTML', $WCR_key_email_packet), $packet_delimiter);

            break;
            case 'ELECTRUM_NOTIFICATION_DETAIL':
                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_TITLE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_TITLE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_LOG_INTEGER_CONSTANT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_REMOTE_ADDR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_SERVER_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_SYSTEM_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_PROCESS_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_ACTIVITY_TRACE_TITLE', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_ACTIVITY_TRACE_CONTENT_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_ACTIVITY_TRACE_CONTENT_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CRNRSTN_PROXY_AUTH_KEY'), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_START_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_END_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_PRETTY_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_SOURCE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_DESTINATION_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_HANDLING_PROFILE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_SOURCE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_DESTINATION_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', $WCR_key_email_packet), $packet_delimiter);

            break;
            default:

                $tmp_str .= $this->concatIntegrationPacketDatum($WCR_key_email_packet, $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CRNRSTN_PROXY_AUTH_KEY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('RECIPIENT_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('RECIPIENT_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('FROM_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('FROM_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('BCC_EMAIL_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('BCC_NAME_COMMA_DELIM', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_SUBJECT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_BODY_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('MESSAGE_BODY_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('WORD_WRAP', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('PRIORITY', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('IS_HTML', $WCR_key_email_packet), $packet_delimiter);

                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_EMAIL', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('REPLY_TO_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_TITLE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_TITLE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_LOG_INTEGER_CONSTANT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_MESSAGE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_REMOTE_ADDR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_SERVER_NAME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_SYSTEM_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_PROCESS_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_ACTIVITY_TRACE_TITLE', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_ACTIVITY_TRACE_CONTENT_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('SYS_ACTIVITY_TRACE_CONTENT_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('CRNRSTN_CRNRSTN_PROXY_AUTH_KEY'), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_START_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_END_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_PRETTY_RUN_TIME', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_SOURCE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_DESTINATION_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_HANDLING_PROFILE_HTML', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_SOURCE_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_DESTINATION_TEXT', $WCR_key_email_packet), $packet_delimiter);
                $tmp_str .= $this->concatIntegrationPacketDatum($this->getEnvResource('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', $WCR_key_email_packet), $packet_delimiter);

            break;

        }

        //$tmp_str = rtrim($tmp_str, $packet_delimiter);
        return $tmp_str;
    }

    public function initProxyCommListener(){

        if(self::$oEnv->oHTTP_MGR->issetHTTP($_POST)) {

            //
            // CHECK FOR PRESENCE OF COMMUNICATIONS PROXY PACKET DATA
            if(self::$oEnv->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_COMM_PROXY_PACKET')) {

                $this->error_log('COMM PROXY DATA RECEIVED.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM_COMM');

                $tmp_packet_version = $this->extractData_HTTP('CRNRSTN_COMM_PROXY_PACKET','POST');
                $tmp_CRNRSTN_PACKET_ENCRYPTED = $this->extractData_HTTP('CRNRSTN_PACKET_ENCRYPTED','POST');

                switch($tmp_packet_version){
                    case 'v2.0.0':
                        $tmp_CRNRSTN_PACKET_ENCRYPTED = trim(strtolower($tmp_CRNRSTN_PACKET_ENCRYPTED));

                        if($tmp_CRNRSTN_PACKET_ENCRYPTED=='true'){

                            $tmp_CRNRSTN_PACKET_DELIMITER = $this->paramTunnelDecrypt($this->extractData_HTTP('CRNRSTN_PACKET_DELIMITER','POST'));
                            $tmp_CRNRSTN_PACKET_DATUM = $this->paramTunnelDecrypt($this->extractData_HTTP('CRNRSTN_PACKET_DATUM','POST'));

                            $tmp_trigger_result = $this->triggerProxyMessaging($tmp_CRNRSTN_PACKET_DELIMITER, $tmp_CRNRSTN_PACKET_DATUM);

                            return 'TUNNEL ENCRYPTED DATA REQUEST [POST] RECEIVED FROM '.$this->returnClientIP().' at '.$this->getMicroTime().' trigger result=['.$tmp_trigger_result.']';

                        }else{

                            $tmp_CRNRSTN_PACKET_DELIMITER = $this->extractData_HTTP('CRNRSTN_PACKET_DELIMITER','POST');
                            $tmp_CRNRSTN_PACKET_DATUM = $this->extractData_HTTP('CRNRSTN_PACKET_DATUM','POST');

                            $tmp_trigger_result = $this->triggerProxyMessaging($tmp_CRNRSTN_PACKET_DELIMITER, $tmp_CRNRSTN_PACKET_DATUM);

                            return 'CLEAR TEXT DATA REQUEST [POST] RECEIVED FROM '.$this->returnClientIP().' at '.$this->getMicroTime().' trigger result=['.$tmp_trigger_result.']';

                        }

                    break;
                    default:

                        return $this->returnSrvrRespStatus('403');

                    break;

                }

            }

        }

    }

    public function electrum_initNotifications($CRNRSTN_oELECTRUM, $notificationProfilePipe=NULL, $noticeEndpointPipe=NULL, $wcrProfilePipe=NULL){

        $CRNRSTN_oELECTRUM->initNotifications($notificationProfilePipe, $noticeEndpointPipe, $wcrProfilePipe);

        return $CRNRSTN_oELECTRUM;

    }

    public function return_configSerial(){

        return self::$oEnv->configSerial;

    }

    public function defineWildCardResource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    public function saveWildCardResource($oWildCardResource){

        self::$oEnv->augmentWCR_array($oWildCardResource);

    }

    public function initElectrum_FileCopy($FtpToFtp_tmp_dirPath, $directoryDateName_versioning_pattern=NULL){

        $this->error_log('Initialize new Electrum operation.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $oELECTRUM = new crnrstn_wind_cloud_fire($this, $FtpToFtp_tmp_dirPath, $directoryDateName_versioning_pattern);

        return $oELECTRUM;

    }

    public function electrum_doNotPassDiskUsagePercent($CRNRSTN_oELECTRUM, $maxStorageUse){

        $this->error_log('Maximum storage usage at ANY destination LOCAL (FTP is not monitored) directory for this CRNRSTN :: Electrum process is being set to '.$maxStorageUse.'%.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->localStorageUse_doNotPassUsagePercent($maxStorageUse);

        return $CRNRSTN_oELECTRUM;
    }

    public function electrum_deleteSourceData_OnSuccess($CRNRSTN_oELECTRUM, $WCR_key_Or_DirPath, $require_ALL_destination_success=true){

        $this->error_log('On SUCCESS, remove all "processed-to-destination" files at the SOURCE endpoint, '.$WCR_key_Or_DirPath, __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->deleteSourceData_OnSuccess($WCR_key_Or_DirPath, $require_ALL_destination_success);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] source['.$this->getEnvResource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addSource_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] destination['.$this->getEnvResource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addDestination_FTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationFTP_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] FLATTEN ALL FILES TO SAME Directory DESTINATION ['.$this->getEnvResource('FTP_SERVER', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addFlattenedDestinationFTP_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL($CRNRSTN_oELECTRUM, $dirPath){

        $this->error_log('Add new Directory source['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addSourceLOCAL($dirPath);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addSourceLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $this->error_log('Add new WCR['.$WildCardResource_key.'] source['.$this->getEnvResource('LOCAL_DIR_PATH', $WildCardResource_key).'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addSourceLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->getEnvResource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->getEnvResource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new DIR ['.$WildCardResource_key.'] destination['.$tmp_path.'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL_WCR($CRNRSTN_oELECTRUM, $WildCardResource_key){

        $tmp_path = $this->getEnvResource('LOCAL_DIR_PATH', $WildCardResource_key);
        //$tmp_mode = $this->getEnvResource('LOCAL_MKDIR_MODE', $WildCardResource_key);
        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory ['.$WildCardResource_key.'] destination['.$tmp_path.'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL_WCR($WildCardResource_key);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode=777){

        $this->error_log('Add new Directory destination['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_addFlattenedDestinationLOCAL($CRNRSTN_oELECTRUM, $dirPath, $mkdir_permissons_mode=777){

        $this->error_log('Add new FLATTEN ALL FILES TO SAME Directory destination['.$dirPath.'] to this electrum.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->addFlattenedDestinationLOCAL($dirPath, $mkdir_permissons_mode);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_DIR($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new DIR Exclusion of "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_DIR($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_FILE($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion of "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_FILE($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE > '.$bytes.' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_fileSizeGreaterThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, $bytes, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new FILE Exclusion where FILE SIZE < '.$bytes.' bytes to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_fileSizeLessThan($bytes, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of ACCESSED OLDER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_accessedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of ACCESSED NEWER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_accessedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of MODIFIED OLDER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_modifiedOlderThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of MODIFIED NEWER THAN "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_modifiedNewerThan($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of FILE OWNER USER ID "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_assetUserID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, $pattern, $WCRkey_or_DIRPATH=NULL){

        $this->error_log('Add new exclusion of FILE OWNER GROUP ID "'.$pattern.'" to this electrum.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->exclude_assetGroupID($pattern, $WCRkey_or_DIRPATH);

        return $CRNRSTN_oELECTRUM;

    }

    public function electrum_EXECUTE($CRNRSTN_oELECTRUM){

        $this->error_log('Begin execution of CRNRSTN :: Electrum operation.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $tmp_execution_serial = $this->generateNewKey(100);

        $CRNRSTN_oELECTRUM->execute($tmp_execution_serial);

        return $CRNRSTN_oELECTRUM;

    }


    public function electrum_closeConnections($CRNRSTN_oELECTRUM){

        $this->error_log('Close all connections associated with this electrum operation.', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oELECTRUM');

        $CRNRSTN_oELECTRUM->terminate_all_ftp();

        return $CRNRSTN_oELECTRUM;

    }

    public function isCurrentEnvironment($envKey){

        $tmp_envKey_crc = crc32($envKey);
        $tmp_envKey = self::$oEnv->getEnvKey();
        if($tmp_envKey_crc == $tmp_envKey){

            return true;

        }else{

            return false;

        }

    }

    public function crnrstn_error_ownership($isActive = true, $errorTypesProfile=NULL){

        if($isActive){

            if(isset($errorTypesProfile)){

                //
                // SOURCE :: https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
                // AUTHOR :: https://stackoverflow.com/users/117260/philippe-gerber
                // SET TO THE USER DEFINED ERROR HANDLER
                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
                    // error was suppressed with the @-operator
                    if (0 === error_reporting()) {
                        return false;
                    }

                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                }, (int) $errorTypesProfile);

            }else{

                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
                    // error was suppressed with the @-operator
                    if (0 === error_reporting()) {
                        return false;
                    }

                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                });

            }

        }else{

            //
            // RESTORE ERROR HANDLING TO NATIVE PHP
            restore_error_handler();

        }

    }

    public function catchException($exception_obj, $syslog_constant=LOG_DEBUG, $method=NULL, $namespace=NULL, $profile_override_pipe=NULL, $endpoint_override_pipe=NULL, $wcr_override_pipe=NULL){

        //
        // LOG THE EXCEPTION
        $this->oLogger->catchException($exception_obj, $syslog_constant, $method, $namespace, $profile_override_pipe, $endpoint_override_pipe, $wcr_override_pipe, $this);

    }

    public function exclusiveAccess($ip='*.*'){

        return self::$oEnv->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip);

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

                    $this->error_log('Finished Triggering oGabriel_ProxySend('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oGABRIEL');

                }
            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

            $oGabriel->proxySend();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel_ProxySend('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oGABRIEL');

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

                    $oGabriel->send();

                    $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

                    $this->error_log('Finished Triggering oGabriel->send('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oGABRIEL');

                }
            }

        }else{

            $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

            $oGabriel->send();

            $this->oMessenger_ARRAY[$oGabriel->messenger_serial] = $oGabriel;

            $this->error_log('Finished Trigger oGabriel->send('.$oGabriel->messenger_serial.').', __LINE__, __METHOD__, __FILE__,'CRNRSTN_oGABRIEL');

        }

    }

    public function oGabriel_SendReport($CRNRSTN_oGabriel){

        $this->error_log('Trigger oGabriel_SendReport().', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

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

    public function addAddressBulk($CRNRSTN_oGabriel, $recipient_email, $recipient_name, $email_experience_tracker = NULL){

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

    public function addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $reply_to_email, $reply_to_recipient_name = ''){

        $oGabriel = $this->oMessenger_ARRAY[$CRNRSTN_oGabriel->messenger_serial];

        $oGabriel->addReplyToBulk($email_experience_tracker, $reply_to_email, $reply_to_recipient_name);

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

        return self::$oEnv;

    }

    public function returnDbConnArray(){

        try {

            if (sizeof(self::$oMySQLi_ARRAY) < 1) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No database connections have been opened to the CRNRSTN Suite ::.');

            } else {

                return self::$oMySQLi_ARRAY;

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;

        }
    }

    public function returnDbQueryArray(){

        try {

            if (sizeof(self::$databaseQuery_ARRAY) < 1) {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No query have been communicated to the CRNRSTN Suite ::.');

            } else {

                return self::$databaseQuery_ARRAY;

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function getEnvResource($resourceKey, $wildCardResourceKey=NULL){

        return self::$oEnv->getEnvParam($resourceKey, $wildCardResourceKey);

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
    public function isClientMobile($tabletIsMobile = false)
    {

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = self::$oEnv->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');
        $tmp_ismobile = self::$oEnv->oSESSION_MGR->getSessionParam('isMobile');  // BOOLEAN
        $tmp_istablet = self::$oEnv->oSESSION_MGR->getSessionParam('isTablet');  // BOOLEAN

        //
        // MAY USE FALSE vs NULL TO CLEAR ISMOBILE IN SESSION. CRNRSTN ONLY SETS THIS TO TRUE.
        if (isset($tmp_ismobile)) {
            if ($tmp_ismobile) {

                return 'isMobile';

            }

        }

        //
        // MAY USE FALSE vs NULL TO CLEAR ISTABLET IN SESSION. CRNRSTN ONLY SETS THIS TO TRUE.
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
    public function isClientTablet($mobileIsTablet = false)
    {

        //
        // CHECK SESSION FOR EXISTING CONFIGURATION
        $tmp_custom_device = self::$oEnv->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');
        $tmp_ismobile = self::$oEnv->oSESSION_MGR->getSessionParam('isMobile');  // BOOLEAN
        $tmp_istablet = self::$oEnv->oSESSION_MGR->getSessionParam('isTablet');  // BOOLEAN

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
    public function isClientMobileCustom($target_device = NULL)
    {

        //
        // NULL $target_device EVOKES BASIC SESSION CHECK ONLY.
        if (!isset($target_device)) {

            //
            // CHECK SESSION FOR EXISTING CONFIGURATION
            $tmp_custom_device = self::$oEnv->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');

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
            $tmp_custom_device = self::$oEnv->oSESSION_MGR->getSessionParam('CUSTOM_DEVICE');
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

                    //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function setClientMobile()
    {

        self::$oEnv->oSESSION_MGR->setSessionParam('isMobile', true);
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
    public function setClientTablet()
    {

        self::$oEnv->oSESSION_MGR->setSessionParam('isTablet', true);
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
    public function setClientMobileCustom($target_device = NULL)
    {

        try {

            if (isset($target_device)) {

                $target_device = trim($target_device);
                $target_device = $this->stringSanitize($target_device, 'custom_mobi_detect_alg');

                self::$oEnv->oSESSION_MGR->setSessionParam('CUSTOM_DEVICE', $target_device);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Method setClientMobileCustom() requires a detection method string; it cannot be NULL. See http://demo.mobiledetect.net/ for a current list of custom detection methods.');

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function resetDeviceDetect()
    {

        //
        // STANDARD DETECTION RESET
        self::$oEnv->oSESSION_MGR->setSessionParam('isMobile', false);
        self::$oEnv->oSESSION_MGR->setSessionParam('isTablet', false);

        //
        // CUSTOM DETECTION RESET
        self::$oEnv->oSESSION_MGR->setSessionParam('CUSTOM_DEVICE', '');

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
    //,
    public function paramTunnelEncrypt($data = NULL, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL)
    {

        return self::$oEnv->paramTunnelEncrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

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
    public function paramTunnelDecrypt($data = NULL, $uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL)
    {

        return self::$oEnv->paramTunnelDecrypt($data, $uri_passthrough, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

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
    public function initFormHandling($crnrstn_form_handle, $transport_protocol = 'POST')
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function addFormInputParamListener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $is_required = false)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function addHiddenFormInputParamListener($crnrstn_form_handle = NULL, $html_dom_form_input_name = NULL, $html_dom_form_input_id = '{crnrstn2.0.0_nullEmpty}', $is_required = false, $default_val = NULL)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function addValidationRedirect($crnrstn_form_handle = NULL, $html_dom_form_input_name_pipe_delim = NULL, $validation_key_pipe_delim = NULL, $on_error_redirect_uri = NULL, $on_success_redirect_uri = NULL)
    {


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
    public function formPrepopulateInputValue($crnrstn_form_handle, $html_dom_form_input_name, $force_default = false, $default_value = NULL)
    {


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
    public function outputValidationErrMsg($crnrstn_form_handle, $html_dom_form_input_name, $err_msg)
    {


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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function returnConnection_MySQLi($host = NULL, $db = NULL, $un = NULL, $port = NULL, $pwd = NULL)
    {

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
                    self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = self::$oEnv->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);

                }

            } else {

                //error_log("4120 crnrstn_usr - I will open a new connection now! ...mysqli existed at one time, but has been closed.");

                //
                // OPEN CONNECTION
                self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = self::$oEnv->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
                self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

            }

        } else {

            //error_log("4131 crnrstn_usr - I will open a new connection now! ...mysqli not set");

            //
            // OPEN CONNECTION
            self::$oMySQLi_ARRAY[$tmp_mysqli_serial] = self::$oEnv->oMYSQLI_CONN_MGR->returnConnection($host, $db, $un, $port, $pwd);
            self::$oMySQLi_hash_ARRAY[] = $tmp_mysqli_serial;

        }

        //
        // RETURN CRNRSTN MYSQLI CONNECTION OBJECT
        $oCRNRSTN_MySQLi = new crnrstn_db_conn_handle($this);
        $oCRNRSTN_MySQLi->load_connection_serial($tmp_mysqli_serial);
        $oCRNRSTN_MySQLi->load_connection_obj(self::$oMySQLi_ARRAY[$tmp_mysqli_serial]);

        return $oCRNRSTN_MySQLi;

    }

    public function pushFakeyDBConn($fakey_mysqli_serial, $mysqli)
    {

        self::$oMySQLi_ARRAY[$fakey_mysqli_serial] = $mysqli;
        self::$oMySQLi_hash_ARRAY[] = $fakey_mysqli_serial;

        return $mysqli;

    }

    public function return_oCRNRSTN_MySQLi_Fakey($fakey_mysqli_serial)
    {

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
    public function closeConnection_MySQLi($mysqli)
    {

        //error_log("4122 user - I will manually close connection now!");
        self::$oEnv->oMYSQLI_CONN_MGR->closeConnection($mysqli);

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
    public function returnHTTP_FormIntegration_InputVal($getpost_input_name, $transport_protocol = NULL)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function isTunnelEncryptConfigured($cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL)
    {

        $tmp_test_str = 'The quick brown fox jumped over the lazy dog.';
        $tmp_encryptedVal = $this->paramTunnelEncrypt($tmp_test_str, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('4194 user - Fire Decrypt TEST...['.$tmp_test_str.']==['.$tmp_encryptedVal.']');
        $tmp_decryptedVal = $this->paramTunnelDecrypt($tmp_encryptedVal, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);
        //error_log('4196 user - Fire Decrypt TEST...['.$tmp_test_str.']==['.$tmp_decryptedVal.']');

        if ($tmp_test_str == $tmp_decryptedVal) {

            return true;

        } else {

            return false;

        }
    }

    private function compileFormIntegrationPacket($crnrstn_form_handle, $html_dom_form_input_name, $encryption_status = TRUE, $server_side_validation = NULL)
    {

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

    private function returnFormIntegrationPacket($crnrstn_form_handle)
    {

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

    public function receiveFormIntegrationPacket($uri_passthrough = false, $cipher_override = NULL, $secret_key_override = NULL)
    {

        $tmp_has_getpost_data = false;

        //
        // DO WE HAVE POST DATA?
        if (self::$oEnv->oHTTP_MGR->issetHTTP($_POST)) {

            //
            // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
            if (self::$oEnv->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET')) {
                $tmp_has_getpost_data = true;

                $tmp_isEncrypted = '';
                if (self::$oEnv->oHTTP_MGR->issetParam($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                    $tmp_isEncrypted = strtolower(self::$oEnv->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                }

                if ($tmp_isEncrypted == 'true') {

                    $this->consumeFormIntegrationPacket($this->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET'), $uri_passthrough, $cipher_override, $secret_key_override), 'POST');

                } else {

                    $this->consumeFormIntegrationPacket(self::$oEnv->oHTTP_MGR->extractData($_POST, 'CRNRSTN_INTEGRATION_PACKET'), 'POST');

                }

            }

            //
            // DO WE HAVE GET DATA?
            if (self::$oEnv->oHTTP_MGR->issetHTTP($_GET)) {

                //
                // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                if (self::$oEnv->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET')) {

                    $tmp_has_getpost_data = true;

                    $tmp_isEncrypted = '';
                    if (self::$oEnv->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                        $tmp_isEncrypted = strtolower(self::$oEnv->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                    }

                    if ($tmp_isEncrypted == 'true') {

                        $this->consumeFormIntegrationPacket($this->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), false, $cipher_override, $secret_key_override), 'GET');

                    } else {

                        $this->consumeFormIntegrationPacket(self::$oEnv->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), 'GET');

                    }

                }

            }

        } else {

            //
            // DO WE HAVE GET DATA?
            if (self::$oEnv->oHTTP_MGR->issetHTTP($_GET)) {

                //
                // CHECK FOR PRESENCE OF FORM INTEGRATION PACKET DATA
                if (self::$oEnv->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET')) {
                    //error_log('4418 user - process CRNRSTN_INTEGRATION_PACKET @ _GET');
                    $tmp_has_getpost_data = true;

                    $tmp_isEncrypted = '';
                    if (self::$oEnv->oHTTP_MGR->issetParam($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED')) {

                        $tmp_isEncrypted = strtolower(self::$oEnv->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET_ENCRYPTED'));

                    }

                    if ($tmp_isEncrypted == 'true') {
                        //error_log('4429 user - decrypt CRNRSTN_INTEGRATION_PACKET @ _GET');

                        $this->consumeFormIntegrationPacket($this->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), false, $cipher_override, $secret_key_override), 'GET');

                    } else {
                        //error_log('4434 user - decrypt CRNRSTN_INTEGRATION_PACKET @ _GET');

                        $this->consumeFormIntegrationPacket(self::$oEnv->oHTTP_MGR->extractData($_GET, 'CRNRSTN_INTEGRATION_PACKET'), 'GET');

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
    public function isValid_dataValidationCheck($transport_protocol = 'POST')
    {

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
    public function returnErr_dataValidationCheck($transport_protocol = 'POST')
    {

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
    public function addDatabaseQuery($oQueryProfileMgr, $result_set_key, $query_override = NULL)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function processQuery($application_acceleration = true, $oCRNRSTN_MySQLi = NULL, $batch_key = NULL, $result_set_key = NULL, $result_handle = NULL, $query_override = NULL)
    {

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
            $this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, 'Please indicate (BOOLEAN) desire for application acceleration...as CRNRSTN :: prepares to touch database with SQL.', $this->oLog_output_ARRAY);

        }

        return false;

    }

    private function consumeFormIntegrationPacket($str, $transport_protocol)
    {

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

            $this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);

            return false;
        }

        return NULL;

    }

    private function buildHTTP_ParamHandle($packet_received_array, $transport_protocol)
    {

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

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

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

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

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

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']));

                        } else {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->oHTTP_MGR->extractData($_POST, $packet_received_array['INPUT_NAME']);

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

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

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

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                                } else {

                                    self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

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

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']));

                        } else {

                            self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']] = self::$oEnv->oHTTP_MGR->extractData($_GET, $packet_received_array['INPUT_NAME']);

                        }

                        //error_log('4913 user - '.$packet_received_array['INPUT_NAME'].'='.self::$http_param_handle_ARRAY[$transport_protocol][$packet_received_array['INPUT_NAME']]);

                    }

                    break;

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;
        }

        return NULL;

    }

    private function concatIntegrationPacketDatum($str, $delim = NULL)
    {

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
    public function addCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL)
    {

        return self::$oEnv->oCOOKIE_MGR->addCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

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
    public function addRawCookie($name, $value = NULL, $expire = NULL, $path = NULL, $domain = NULL, $secure = NULL, $httponly = NULL)
    {

        return self::$oEnv->oCOOKIE_MGR->addRawCookie($name, $value, $expire, $path, $domain, $secure, $httponly);

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
    public function getCookie($name)
    {

        return self::$oEnv->oCOOKIE_MGR->getCookie($name);

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
    public function deleteCookie($name, $path = NULL)
    {

        return self::$oEnv->oCOOKIE_MGR->deleteCookie($name, $path);

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
    public function deleteAllCookies($path = NULL)
    {

        return self::$oEnv->oCOOKIE_MGR->deleteAllCookies($path);

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
    public function returnHeaders($returnType = NULL)
    {

        return self::$oEnv->oHTTP_MGR->getHeaders($returnType);

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
    public function isset_HTTP_Param($param, $transport_protocol = 'POST')
    {

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':

                    if (self::$oEnv->oHTTP_MGR->issetParam($_POST, $param)) {
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
                    if (self::$oEnv->oHTTP_MGR->issetParam($_GET, $param)) {
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

            //$this->oLogger->captureNotice(__METHOD__ . ' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function extractData_HTTP($param, $transport_protocol = 'GET')
    {

        //$transport_protocol = trim(strtoupper($transport_protocol));
        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        try {

            switch ($http_protocol) {
                case 'POST':
                    if (self::$oEnv->oHTTP_MGR->issetParam($_POST, $param)) {

                        return self::$oEnv->oHTTP_MGR->extractData($_POST, $param);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.');

                    }

                    break;
                default:

                    //
                    // $_GET
                    if (self::$oEnv->oHTTP_MGR->issetParam($_GET, $param)) {

                        return self::$oEnv->oHTTP_MGR->extractData($_GET, $param);

                    } else {

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        //throw new Exception('The desired HTTP _'.$http_protocol.' parameter, '.$param.', is not available.');
                        $this->oLogger->logDebug('The desired HTTP _' . $http_protocol . ' parameter, ' . $param . ', is not available.');

                        return false;
                    }

                    break;
            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__ . ' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function isset_SERVER_param($param)
    {

        return self::$oEnv->isset_ServerArrayVar($param);

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
    public function wallTime()
    {

        return self::$oEnv->wallTime();

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

    public function isDateOlderThan($seconds, $qualification_pattern=NULL){

        if(!isset($qualification_pattern)){

            //
            // PROVIDED DATE ($seconds) OLDER THAN NOW?
            if(strtotime("now") > $seconds){

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
                // PROVIDED DATE ($seconds) OLDER THAN DATE PATTERN?
                if(strtotime($qualification_pattern) > $seconds){

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
                    if(strtotime($qualification_pattern) > $seconds){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    //
                    // PROVIDED DATE ($seconds) OLDER THAN DATE PATTERN?
                    if(strtotime($qualification_pattern) > $seconds){

                        return true;

                    }else{

                        return false;

                    }
                }
            }
        }
    }

    public function isDateNewerThan($seconds, $qualification_pattern=NULL){

        if(!isset($qualification_pattern)){

            //
            // PROVIDED DATE ($seconds) NEWER THAN NOW?
            if(strtotime("now") < $seconds){

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
                if(strtotime($qualification_pattern) < $seconds){

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
                    if(strtotime($qualification_pattern) < $seconds){

                        return true;

                    }else{

                        return false;

                    }

                }else{

                    //
                    // PROVIDED DATE ($seconds) NEWER THAN DATE PATTERN?
                    if(strtotime($qualification_pattern) < $seconds){

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

        return self::$oEnv->monitorDeltaTimeFor($watchKey, $decimal);

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

                return self::$oEnv->getServerArrayVar($param, $this);

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);

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
    public function getSessionParam($name)
    {
        try {

            if (isset($name)) {

                return self::$oEnv->oSESSION_MGR->getSessionParam($name);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the requested session parameter.');

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function setSessionParam($name, $value = '')
    {

        try {

            if (isset($name)) {

                return self::$oEnv->oSESSION_MGR->setSessionParam($name, $value);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the session parameter that is to be saved.');

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function issetSessionParam($name)
    {

        try {

            if (isset($name)) {

                return self::$oEnv->oSESSION_MGR->issetSessionParam($name);

            } else {

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No variable name has been provided for the session parameter that is to be checked to determine if it is currently set with a value.');

            }

        } catch (Exception $e) {

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function isset_HTTPSuper($transport_protocol = 'POST')
    {

        $http_protocol = strtoupper($transport_protocol);
        $http_protocol = $this->stringSanitize($http_protocol, 'http_protocol_simple');

        return self::$oEnv->issetHTTP($http_protocol);

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
    public function returnRecordCount($oQueryProfileMgr, $result_set_key)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function loadPreviousRecordLookup($oQueryProfileMgr, $result_set_key, $lookupSerial)
    {

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
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function initLookupByID($oQueryProfileMgr, $result_set_key)
    {

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
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function addLookupFieldData($oQueryProfileMgr, $result_set_key, $field_name, $field_value)
    {

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
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function retrieveDataByID($oQueryProfileMgr, $result_set_key, $lookup_fieldname, $piped_primary_id_fields = NULL, $piped_lookup_id_data = NULL)
    {

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
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function pingValueExistence($oQueryProfileMgr, $result_set_key, $fieldname, $value)
    {

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
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function pingResultSetExistence($oQueryProfileMgr, $result_set_key)
    {

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
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function resultSetMerge($oQueryProfileMgr, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val = true, $sequence_fields_piped = null, $sequence_fields_datatype_piped = null)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function returnDatabaseValue($oQueryProfileMgr, $result_set_key, $fieldname, $pos = 0)
    {

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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);
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
    public function create_AdHocVar($key, $var = NULL)
    {

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
    public function get_AdHocVar($key)
    {

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
    public function specifyPaginationVariableName($variable_name, $pagination_serial = NULL)
    {

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
    public function getPaginationVariableName($pagination_serial = NULL)
    {

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
    public function addPaginationPassthroughInputVal($input_name, $input_value, $pagination_serial)
    {

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
    public function returnCurrentPaginationPos($pagination_serial = NULL)
    {

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
    public function returnPaginationSerial()
    {

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
    public function returnPaginationStateHTML($pagination_serial = NULL)
    {

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
    public function increment_results_count_total($result_count = 1, $pagination_serial = NULL)
    {

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
    public function set_maximum_display_result_count($maximum_display_count, $pagination_serial = NULL)
    {

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
    public function generateNewKey($len = 32)
    {
        $token = "";
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

        return $token;

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
    private function crypto_rand_secure($min, $max)
    {
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
    public function highlightText($text, $colorScheme = "phpnight")   // [EDIT] CRNRSTN v2.0.0 FOR PHPNIGHT :: J5
    {
        $colorScheme = trim(strtolower($colorScheme));              // [EDIT] CRNRSTN v2.0.0 :: J5

        if ($colorScheme == "php") {
            ini_set("highlight.comment", "#008000");
            ini_set("highlight.default", "#000000");
            ini_set("highlight.html", "#808080");
            ini_set("highlight.keyword", "#0000BB; font-weight: bold");
            ini_set("highlight.string", "#DD0000");
        } else if ($colorScheme == "html") {
            ini_set("highlight.comment", "green");
            ini_set("highlight.default", "#CC0000");
            ini_set("highlight.html", "#000000");
            ini_set("highlight.keyword", "black; font-weight: bold");
            ini_set("highlight.string", "#0000FF");
        } else if ($colorScheme == "phpnight")                        // [EDIT] CRNRSTN v2.0.0 :: J5
        {
            ini_set("highlight.comment", "#FFCC00");
            ini_set("highlight.default", "#DEDECB");
            ini_set("highlight.html", "#808080");
            ini_set("highlight.keyword", "#8FE28F; font-weight: normal");
            ini_set("highlight.string", "#FF6666");
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
    public function highlightCode($filepath, $colorScheme = "phpnight")
    {

        $colorScheme = trim(strtolower($colorScheme));

        if ($colorScheme == "php") {
            ini_set("highlight.comment", "#008000");
            ini_set("highlight.default", "#000000");
            ini_set("highlight.html", "#808080");
            ini_set("highlight.keyword", "#0000BB; font-weight: bold");
            ini_set("highlight.string", "#DD0000");
        } else if ($colorScheme == "html") {
            ini_set("highlight.comment", "green");
            ini_set("highlight.default", "#CC0000");
            ini_set("highlight.html", "#000000");
            ini_set("highlight.keyword", "black; font-weight: bold");
            ini_set("highlight.string", "#0000FF");
        } else if ($colorScheme == "phpnight")                        // [EDIT] CRNRSTN v2.0.0 :: J5
        {
            ini_set("highlight.comment", "#FFCC00");
            ini_set("highlight.default", "#DEDECB");
            ini_set("highlight.html", "#808080");
            ini_set("highlight.keyword", "#8FE28F; font-weight: normal");
            ini_set("highlight.string", "#FF6666");
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
    public function captureNotice($calling_source, $priority, $message){

        $this->oLogger->captureNotice($calling_source, $priority, $message, $this->oLog_output_ARRAY);

        return NULL;

    }

    /*
     * LOGGING USE-CASE ::
    A) error_log on steroids [live wire/1-to-1 out to server error log].
        - No long-term storage on 1.
        - Aggregation of data on 2...Output per initLogging() profile.
        - crnrstn(xxx, $debugMode = 0 = OFF)
        - crnrstn(xxx, $debugMode = 1|2 = ON)
    B) [A] (above) live wire/1-to-1 out to designated output location [DEFAULT (read as error_log...i.e. [A]), SCREEN, EMAIL?? or FILE]
        - Silo storage available.
        - crnrstn(xxx, $debugMode = 0 = OFF)
        - crnrstn(xxx, $debugMode = 1|2 = ON)
    C) [A|B] (above) aggregated and sent to designated output location [DEFAULT (read as error_log...i.e. [A]), SCREEN, EMAIL or FILE]
        - Silo storage available.
        - crnrstn(xxx, $debugMode = 0 = OFF)
        - crnrstn(xxx, $debugMode = 1|2 = ON)
    D) Straight-line (carbon copy of format) live wire debug output sent to oCRNRSTN_ENV for manual continuation of CRNRSTN activity logging
        - Obey configuration file log profile settings...e.g. crnrstn(xxx, $debugMode = 0 = OFF)
    E) Fire aggregate of [D] (above) to designated output location [DEFAULT (read as error_log), SCREEN, EMAIL or FILE]
        - Obey configuration file log profile settings
        - e.g. crnrstn(xxx, $debugMode = 0 = OFF)
        - e.g. crnrstn(xxx, $debugMode = 1|2 = ON)

     # $debugMode = 0
       * LOGGING OFF
       * MINIMAL MEMORY AND PROCESSING OVERHEAD

     # $debugMode = 1
       * REAL-TIME FULL LOG TRACE ERROR_LOG() OUTPUT
       * LOG SILOS IGNORED UNLESS SPECIFIED TO CRNRSTN CONSTRUCTOR
       * MINIMAL MEMORY OVERHEAD WITH SOME PROCESSING

     # $debugMode = 2
       * 100% LOG TRACE ROLLING AGGREGATION
       * ACCESS TO AGGREGATED (AND ALWAYS LINEARLY SPLICED VIA POINTER DRIVEN
         OUTPUT ASSEMBLY WITH RESPECT TO CHRONOLOGICALLY COLLECTED METADATA) LOG DATA
         TRACE FOR ANY PIPED LOG SILO KEY/KEYS PASSED TO CALL OF get_errorLogTrace() OR
         INCLUDED IN PIPED SILO WATCH STRING PASSED INTO CRNRSTN CONSTRUCTOR
       * MAXIMUM MEMORY AND PROCESSING OVERHEAD

    LOG OUTPUT PATTERN ::
    {DATE TIME + MICROSEC - OMIT IN error_log() CALLS}
    {RUN TIME + MICROSEC}
    {FILE or CLASS::METHOD}
    {LINE NUM}
    {LOG STRING}

     * */

    public function currentLocation(){

        return self::$oEnv->currentLocation();

    }

    private function return_loggingProfile(){

        return self::$oEnv->return_loggingProfile();

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
    public function get_errorLogTrace($loggingProfile=NULL, $log_silo_keys_pipe='*', $line_num=NULL, $method=NULL, $file=NULL, $filePath_or_email_override=NULL){

        try{

            if($this->debugMode<2){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to retrieve log trace data due to CRNRSTN being in configuration of debugMode="'.$this->debugMode.'"...which setting does not authorize resource allocation enabling aggregation of error log data in server memory.');

            }else{

                if(!isset($method)){

                    $method = __METHOD__;

                }

                if(!isset($line_num)){

                    $line_num = __LINE__;

                }

                if(!isset($loggingProfile)){

                    $loggingProfile = $this->return_loggingProfile();

                }else{

                    $loggingProfile = trim(strtoupper($loggingProfile));
                    switch($loggingProfile){
                        case 'EMAIL':
                        case 'FILE':
                        case 'SCREEN_TEXT':
                        case 'SCREEN':
                        case 'SCREEN_HTML':
                        case 'SCREEN_HTML_HIDDEN':
                        case 'DEFAULT':
                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The provided logging profile, "'.$loggingProfile.'", is not supported by CRNRSTN. Please choose between the following options :: [EMAIL, FILE, SCREEN_TEXT, SCREEN, SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]');

                        break;

                    }

                }

                $this->oLogger->get_errorLogTrace($loggingProfile, $filePath_or_email_override, $log_silo_keys_pipe, $line_num, $method, $file, $this);

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ALERT, $e->getMessage(), $this->oLog_output_ARRAY);
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
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key=NULL){

        $this->oLog_output_ARRAY[] = $this->oLogger->error_log($str, $line_num, $method, $file, $log_silo_key, $this);

        return null;

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
    public function return_error_log(){

        //
        // FINISH SILO FUNCTIONALITY...THIS WILL RELATE...

        // <!-- {LOGS OUTPUT} -->                               HTML_HIDDEN
        // <span style="xxx">{LOGS OUTPUT}</span><br>           HTML_OPEN
        // {LOGS OUTPUT}                                        RAW_STRING_OUTPUT
        // mail({LOGS OUTPUT});                                 EMAIL
        // APPEND {LOGS OUTPUT} TO FILE                         FILE
        // NATIVE ERROR_LOG() CALL                              DEFAULT

        //return $this->log_output;

        return NULL;

    }

    public function return_logPriorityPretty($logPriority, $format='TEXT'){

        $tmp_output_format = trim(strtoupper($format));

        if($tmp_output_format == 'HTML'){
            //'LOG_EMERG</span>:: system is unusable.</span>'

            switch($logPriority){
                case 0:
                    $tmp_priority_const = "LOG_EMERG";
                    $tmp_priority_msg = ':: system is unusable.';
                break;
                case 1:
                    $tmp_priority_const = "LOG_ALERT";
                    $tmp_priority_msg = ':: action must be taken immediately.';
                    break;
                case 2:
                    $tmp_priority_const = "LOG_CRIT";
                    $tmp_priority_msg = ':: critical conditions encountered.';
                    break;
                case 3:
                    $tmp_priority_const = "LOG_ERR";
                    $tmp_priority_msg = ':: error conditions encountered.';
                    break;
                case 4:
                    $tmp_priority_const = "LOG_WARNING";
                    $tmp_priority_msg = ':: warning conditions encountered.';
                    break;
                case 5:
                    $tmp_priority_const = "LOG_NOTICE";
                    $tmp_priority_msg = ':: normal, but significant, condition encountered.';
                    break;
                case 6:
                    $tmp_priority_const = "LOG_INFO";
                    $tmp_priority_msg = ':: informational message.';
                    break;
                case 7:
                    $tmp_priority_const = "LOG_DEBUG";
                    $tmp_priority_msg = ':: debug-level message.';
                    break;
                default:
                    $tmp_priority_const = "UNKNOWN";
                    $tmp_priority_msg = '';
                    break;
            }

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#FF0000; font-weight: bold;">'.$tmp_priority_const.'</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">'.$tmp_priority_msg.'</span>';

        }else{

            switch($logPriority){
                case 0:
                    $tmp_priority = "LOG_EMERG :: system is unusable.";
                    break;
                case 1:
                    $tmp_priority = "LOG_ALERT :: action must be taken immediately";
                    break;
                case 2:
                    $tmp_priority = "LOG_CRIT :: critical conditions encountered";
                    break;
                case 3:
                    $tmp_priority = "LOG_ERR :: error conditions encountered";
                    break;
                case 4:
                    $tmp_priority = "LOG_WARNING :: warning conditions encountered";
                    break;
                case 5:
                    $tmp_priority = "LOG_NOTICE :: normal, but significant, condition encountered";
                    break;
                case 6:
                    $tmp_priority = "LOG_INFO :: informational message";
                    break;
                case 7:
                    $tmp_priority = "LOG_DEBUG :: debug-level message";
                    break;
                default:
                    $tmp_priority = "UNKNOWN";
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

        return self::$oEnv->oCRNRSTN_IPSECURITY_MGR->clientIpAddress();

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

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    public function formatBytes($bytes, $precision = 2) {

        //
        // CRNRSTN v2.0.0 :: MODS
        // SEE :: https://en.wikipedia.org/wiki/Binary_prefix
        // SEE ALSO :: ISO/IEC 80000 family of standards (November 1, 2009)
        // https://en.wikipedia.org/wiki/ISO/IEC_80000#Information_science_and_technology
        $units = array('bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];

    }

    public function shortFileSizeFormat($data_format){
        $format = '';

        switch($data_format){
            case 'kilabit':
                $format = 'KiB';

            break;
            case 'megabit':
                $format = 'MiB';

            break;
            case 'gigabit':
                $format = 'GiB';

            break;
            default:
                $format = '?iB';

            break;

        }

        return $format;
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

            //$this->oLogger->captureNotice(__METHOD__.' on server ' . $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ')', LOG_NOTICE, $e->getMessage(), $this->oLog_output_ARRAY);
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;

        }

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
    private function curl_post($url, array $post = NULL, array $options = array()){

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
    private function curl_get($url, array $get = NULL, array $options = array()){

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

        $this->error_log('Load Test Complete for Password Hash Option Strength :: Appropriate Cost = '.$cost, __LINE__, __METHOD__, __FILE__, '*');

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

        return self::$oEnv->returnSrvrRespStatus($status_code);

    }

    public function get_pwdHash_LOGIN_storage($user_submitted_password){

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

    public function __destruct(){

        //$tmp_soapManager = new crnrstn_soap_manager(self::$oEnv,'WSDL_URI','WSDL_CACHE_TTL','NUSOAP_USECURL');
        //$tmp_soap_data = $tmp_soapManager->returnContent('getToolTip', array('ELEMENTID' => 'd3b3ef3a4ad62b6d8bdc&rnd=269770362j000001011'));

        $this->oLog_output_ARRAY[] = $this->error_log('goodbye crnrstn error_log', __LINE__, __METHOD__, __FILE__, 'CERTAIN_DESTRUCTION');

        if (sizeof($this->oLog_output_ARRAY) > 0 && self::$oEnv->debugMode == 2) {

            // SCREEN_HTML_HIDDEN
            //$this->get_errorLogTrace('EMAIL', '*', __LINE__, __METHOD__, __FILE__);
            //$this->get_errorLogTrace('SCREEN_HTML_HIDDEN', '*', __LINE__, __METHOD__, __FILE__);
        }
    }
}