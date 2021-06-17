<?php
/* 
// J5
// Code is Poetry */

# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_soa_endpoint_request_manager
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 2.0.0
#  CLASS DATE :: September 22, 2020 @ 1501hrs
#  NUMBERS 20:17 - PLEASE LET US PASS THROUGH YOUR LAND. WE WILL NOT PASS THROUGH
#  FIELD OR THROUGH VINEYARD, NOR WILL WE WATER FROM ANY WELL; WE WILL GO ALONG
#  THE KING'S HIGHWAY, NOT TURNING ASIDE TO THE RIGHT OR TO THE LEFT, UNTIL WE
#  PASS THROUGH YOUR TERRITORY.
class crnrstn_soa_endpoint_request_manager {

	public $soapResponse_ARRAY = array();
	
	protected $oLogger;
    private static $oCRNRSTN_USR;
    private static $oSoapRequest;

    protected $SOAP_request_isEncrypted = false;
    protected $SOAP_request_sendSuppression = true;
    protected $SOAP_request_flag_sendSuppression_ARRAY = array();
    protected $SOAP_startTime;
	
	public function __construct($oCRNRSTN_USR) {

	    self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER  CLASS OBJECT
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

	}

	public function takeTheKingsHighway($oSoapRequest){

	    self::$oSoapRequest = $oSoapRequest;

        //$tmp_CRNRSTN_PACKET_ENCRYPTED = $this->return_requestParam('CRNRSTN_PACKET_ENCRYPTED', __METHOD__);
        //$this->SOAP_request_isEncrypted = trim(strtolower($tmp_CRNRSTN_PACKET_ENCRYPTED));
        $tmp_key = self::$oCRNRSTN_USR->paramTunnelDecrypt(self::$oSoapRequest['CRNRSTN_PROXY_AUTH_KEY'], true);
        error_log('42 - S.E.R.M. Connectivity Test - CRNRSTN_PROXY_AUTH_KEY='.self::$oSoapRequest['CRNRSTN_PROXY_AUTH_KEY']);
        error_log('43 - S.E.R.M. Connectivity Test - CRNRSTN_PROXY_AUTH_KEY='.$tmp_key);
        //error_log('44 - S.E.R.M. Connectivity Test - CRNRSTN_PROXY_AUTH_KEY='.$tmp_key);

	    //
        // RECEIVE SOAP DATA PACK WITH BATCH DATA FOR STRAIGHT EMAIL OUT
        $tmp_array = array(
             'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_key),
             'TOTAL_EMAILS_RECEIVED' => '0',
             'TOTAL_EMAILS_SENT' => '0',
             'TOTAL_EMAILS_ERROR' => '0'
        );

        return $tmp_array;

    }

    private function SOAP_monitor_time($monitor_key){

	    if(!isset($this->SOAP_startTime)){

            $this->SOAP_startTime = self::$oCRNRSTN_USR->getMicroTime();

        }

	    return self::$oCRNRSTN_USR->elapsedDeltaTimeFor($monitor_key);

    }

    public function send_electrumPerformanceReport($oSoapRequest){

	    $this->SOAP_monitor_time('ELECTRUM_PERFORMANCE');
        self::$oSoapRequest = $oSoapRequest;

        //
        // PROCESS ELECTRUM NOTICE
        $SOAP_server_response = $this->SOAPserver_processElectrumReportRequest();

        /*
        $tmp_key = self::$oCRNRSTN_USR->paramTunnelDecrypt(self::$oSoapRequest['CRNRSTN_PROXY_AUTH_KEY']);
        $tmp_RECIPIENT = self::$oSoapRequest['RECIPIENT'];

        $tmp_size = sizeof($tmp_RECIPIENT);
        $tmp_status_report_ARRAY = array();

        for($i=0;$i<$tmp_size;$i++){
            $tmp_EMAIL_PROXY_SERIAL = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_RECIPIENT[$i]['EMAIL_PROXY_SERIAL']);
            $tmp_EMAILADDRESS = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_RECIPIENT[$i]['EMAILADDRESS']);
            error_log('69 - S.E.R.M. Connectivity Test - EMAIL['.$i.']='.$tmp_EMAILADDRESS.' EMAIL_PROXY_SERIAL='.$tmp_EMAIL_PROXY_SERIAL);

            array_push($tmp_status_report_ARRAY, array(
                'EMAIL_PROXY_SERIAL' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_EMAIL_PROXY_SERIAL),
                'SEND_STATUS' => self::$oCRNRSTN_USR->paramTunnelEncrypt('Send success.'),
                'STATUS_DETAIL' =>self::$oCRNRSTN_USR->paramTunnelEncrypt('1')
            ));
        }

        $tmp_SYS_MESSAGE_TITLE_TEXT = self::$oCRNRSTN_USR->paramTunnelDecrypt(self::$oSoapRequest['SYS_MESSAGE_TITLE_TEXT']);

        error_log('67 - S.E.R.M. Connectivity Test - SYS_MESSAGE_TITLE_TEXT='.$tmp_SYS_MESSAGE_TITLE_TEXT);

        //
        // RECEIVE SOAP DATA PACK WITH BATCH DATA FOR STRAIGHT EMAIL OUT
        $tmp_array = array(
            'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_key),
            'TOTAL_EMAILS_RECEIVED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('2'),
            'TOTAL_EMAILS_SENT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('2'),
            'TOTAL_EMAILS_ERROR' => self::$oCRNRSTN_USR->paramTunnelEncrypt('0'),
            'oACTIVITY_STATUS_REPORT' => $tmp_status_report_ARRAY
        );
        */

        return $SOAP_server_response;

    }

    private function SOAPserver_sendEmail($tmp_oRECIPIENT){

	    $tmp_status_ARRAY = array();

        if($this->SOAP_request_sendSuppression){

            if(isset($this->SOAP_request_flag_sendSuppression_ARRAY[$tmp_oRECIPIENT['EMAIL_PROXY_SERIAL']])){

                error_log('129 SOAP SERVER SENT SUPPRESS FOR '.$tmp_oRECIPIENT['EMAIL_PROXY_SERIAL']);
                //
                // SEND SUPPRESS
                $tmp_status_ARRAY = array(
                    'EMAIL_PROXY_SERIAL' => $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL'],
                    'IS_SENT' => 'FALSE',
                    'SEND_TIMESTAMP' => '',
                    'SEND_STATUS' => 'SEND SUPPRESSED',
                    'STATUS_DETAIL' => 'The email send was duplicate suppressed by the CRNRSTN :: SOAP services layer.'
                );

            }else{
                error_log('140 SOAP SERVER - PROCESS SEND TO '.$tmp_oRECIPIENT['EMAILADDRESS']);
                $this->SOAP_request_flag_sendSuppression_ARRAY[$tmp_oRECIPIENT['EMAIL_PROXY_SERIAL']] = 1;

                //
                // OK TO SEND
                $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL = $this->return_requestParam('CRNRSTN_PROXY_EMAIL_PROTOCOL', __METHOD__);
                $tmp_oSENDER = $this->return_requestParam('oSENDER', __METHOD__, true, 'oEmail');
                $tmp_oREPLYTO = $this->return_requestParam('oREPLYTO', __METHOD__, true, 'oEmail');
                $tmp_oCC = $this->return_requestParam('oCC', __METHOD__, true, 'oEmail');
                $tmp_oBCC = $this->return_requestParam('oBCC', __METHOD__, true, 'oEmail');

                $tmp_size_oSENDER = sizeof($tmp_oSENDER);
                $tmp_size_oREPLYTO = sizeof($tmp_oREPLYTO);
                $tmp_size_oCC = sizeof($tmp_oCC);
                $tmp_size_oBCC = sizeof($tmp_oBCC);

                //
                // EXTRACT EMAIL PROTOCOL [SMTP, QMAIL, SENDMAIL, MAIL] FROM WCR
                if($tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL == ''){

                    $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL = trim(strtoupper(self::$oCRNRSTN_USR->getEnvResource('EMAIL_PROTOCOL')));
                    $tmp_SMTP_AUTH = false;

                }

                if($tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL == 'SMTP'){

                    $tmp_SMTP_AUTH = self::$oCRNRSTN_USR->getEnvResource('SYS_SMTP_AUTH', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_SMTP_SERVER = self::$oCRNRSTN_USR->getEnvResource('SYS_SMTP_SERVER', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_SMTP_PORT_OUTGOING = self::$oCRNRSTN_USR->getEnvResource('SYS_SMTP_PORT_OUTGOING', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_SMTP_USERNAME = self::$oCRNRSTN_USR->getEnvResource('SYS_SMTP_USERNAME', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_SMTP_PASSWORD = self::$oCRNRSTN_USR->getEnvResource('SYS_SMTP_PASSWORD', 'CRNRSTN_SMTP_COMM_PROFILE');

                }

                $tmp_oGabriel_serial = self::$oCRNRSTN_USR->generateNewKey(50);

                if($tmp_SMTP_AUTH){

                    //
                    // SMTP AUTH
                    $CRNRSTN_oGabriel = self::$oCRNRSTN_USR->initialize_oGabriel($tmp_oGabriel_serial, $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING);

                }else{

                    //
                    // ANY NON-AUTH
                    $CRNRSTN_oGabriel = self::$oCRNRSTN_USR->initialize_oGabriel($tmp_oGabriel_serial, $tmp_CRNRSTN_PROXY_EMAIL_PROTOCOL);

                }

                if(isset($tmp_SMTP_SERVER)){
                    if($tmp_SMTP_SERVER!=''){

                        self::$oCRNRSTN_USR->addHostServers($CRNRSTN_oGabriel, $tmp_SMTP_SERVER);

                    }
                }

                //
                // PASS RECIPIENT TO oMESSENGER FROM THE NORTH FOR BUILD OUT
                // ADD AS BULK EMAIL FOR SINGULARITY OF DELIVERY AND CUSTOMIZATION
                if(isset($tmp_oRECIPIENT['FIRSTNAME'])){

                    $tmp_name = trim($tmp_oRECIPIENT['FIRSTNAME']);

                    if(isset($tmp_oRECIPIENT['LASTNAME'])){

                        $tmp_name .= ' '.trim($tmp_oRECIPIENT['LASTNAME']);

                    }

                }else{

                    $tmp_name = '';

                }

                error_log('219 - SERVER addAddressBulk=[name::'.$tmp_name.']'.$tmp_oRECIPIENT['EMAILADDRESS'].' to CRNRSTN_oGabriel['.$CRNRSTN_oGabriel->messenger_serial.']');
                $email_experience_tracker = self::$oCRNRSTN_USR->addAddressBulk($CRNRSTN_oGabriel, $tmp_oRECIPIENT['EMAILADDRESS'], $tmp_name);

                //
                // LOAD REMAINING SYSTEM MESSAGING META FROM SOAP (OR WCR @ PROXY)
                if($tmp_size_oSENDER<1){

                    $tmp_FROM_EMAIL = self::$oCRNRSTN_USR->getEnvResource('SYS_FROM_EMAIL', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_FROM_NAME = self::$oCRNRSTN_USR->getEnvResource('SYS_FROM_NAME', 'CRNRSTN_SMTP_COMM_PROFILE');

                    self::$oCRNRSTN_USR->addFromBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_FROM_EMAIL, $tmp_FROM_NAME);

                }else{

                    if(isset($tmp_oSENDER[0]['FIRSTNAME'])){

                        $tmp_name = trim($tmp_oSENDER[0]['FIRSTNAME']);

                        if(isset($tmp_oSENDER[0]['LASTNAME'])){

                            $tmp_name .= ' '.trim($tmp_oSENDER[0]['LASTNAME']);

                        }

                    }else{

                        $tmp_name = '';

                    }

                    error_log('249 - SERVER SENDER name['.$tmp_name.'] email['.$tmp_oSENDER[0]['EMAILADDRESS'].']');
                    self::$oCRNRSTN_USR->addFromBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_oSENDER[0]['EMAILADDRESS'], $tmp_name);

                }

                if($tmp_size_oREPLYTO<1){

                    $tmp_REPLYTO_EMAIL = self::$oCRNRSTN_USR->getEnvResource('SYS_REPLYTO_EMAIL', 'CRNRSTN_SMTP_COMM_PROFILE');
                    $tmp_REPLYTO_NAME = self::$oCRNRSTN_USR->getEnvResource('SYS_REPLYTO_NAME', 'CRNRSTN_SMTP_COMM_PROFILE');
                    error_log('258 - SERVER SYS_REPLYTO_EMAIL name['.$tmp_REPLYTO_NAME.'] email['.$tmp_REPLYTO_EMAIL.']');

                    self::$oCRNRSTN_USR->addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_REPLYTO_EMAIL, $tmp_REPLYTO_NAME);

                }else{

                    for($i=0; $i<$tmp_size_oREPLYTO; $i++){

                        if(isset($tmp_oREPLYTO[$i]['FIRSTNAME'])){

                            $tmp_name = trim($tmp_oREPLYTO[$i]['FIRSTNAME']);

                            if(isset($tmp_oREPLYTO[$i]['LASTNAME'])){

                                $tmp_name .= ' '.trim($tmp_oREPLYTO[$i]['LASTNAME']);

                            }

                        }else{

                            $tmp_name = '';

                        }
                        error_log('258 - SERVER SYS_REPLYTO_EMAIL name['.$tmp_name.'] email['.$tmp_oREPLYTO[$i]['EMAILADDRESS'].']');
                        self::$oCRNRSTN_USR->addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_oREPLYTO[$i]['EMAILADDRESS'], $tmp_name);

                    }
                }

                if($tmp_size_oCC>0){

                    for($i=0; $i<$tmp_size_oCC; $i++) {

                        if(isset($tmp_oCC[$i]['FIRSTNAME'])){

                            $tmp_name = trim($tmp_oCC[$i]['FIRSTNAME']);

                            if(isset($tmp_oCC[$i]['LASTNAME'])){

                                $tmp_name .= ' '.trim($tmp_oCC[$i]['LASTNAME']);

                            }

                        }else{

                            $tmp_name = '';

                        }

                        self::$oCRNRSTN_USR->addCCBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_oCC[$i]['EMAILADDRESS'], $tmp_name);

                    }
                }

                if($tmp_size_oBCC>0){

                    for($i=0; $i<$tmp_size_oBCC; $i++) {

                        if(isset($tmp_oBCC[$i]['FIRSTNAME'])){

                            $tmp_name = trim($tmp_oBCC[$i]['FIRSTNAME']);

                            if(isset($tmp_oBCC[$i]['LASTNAME'])){

                                $tmp_name .= ' '.trim($tmp_oBCC[$i]['LASTNAME']);

                            }

                        }else{

                            $tmp_name = '';

                        }

                        self::$oCRNRSTN_USR->addBCCBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_oBCC[$i]['EMAILADDRESS'], $tmp_name);

                    }
                }

                $tmp_is_html = trim(strtoupper($this->return_requestParam('IS_HTML', __METHOD__)));
                if($tmp_is_html != ''){

                    if($tmp_is_html == 'TRUE'){

                        $tmp_DEFAULT_ISHTML = true;

                    }else{

                        $tmp_DEFAULT_ISHTML = false;

                    }

                }else{

                    $tmp_DEFAULT_ISHTML = self::$oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_ISHTML', 'CRNRSTN_SMTP_COMM_PROFILE');

                }

                self::$oCRNRSTN_USR->isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_ISHTML);

                $tmp_priority = trim(strtoupper($this->return_requestParam('PRIORITY', __METHOD__)));
                if($tmp_priority != ''){

                    $tmp_DEFAULT_PRIORITY = $tmp_priority;

                }else{

                    $tmp_DEFAULT_PRIORITY = self::$oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_PRIORITY', 'CRNRSTN_SMTP_COMM_PROFILE');

                }
                self::$oCRNRSTN_USR->setPriorityBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_PRIORITY);


                $tmp_word_wrap = trim($this->return_requestParam('WORD_WRAP', __METHOD__));

                if($tmp_word_wrap != ''){

                    $tmp_DEFAULT_WORD_WRAP = $tmp_word_wrap;

                }else{

                    $tmp_DEFAULT_WORD_WRAP = self::$oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_WORD_WRAP', 'CRNRSTN_SMTP_COMM_PROFILE');

                }
                self::$oCRNRSTN_USR->wordWrapBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_WORD_WRAP);

                self::$oCRNRSTN_USR->addSubjectBulk($CRNRSTN_oGabriel, $email_experience_tracker, $this->return_requestParam('MESSAGE_SUBJECT', __METHOD__));

                error_log('386 - SERVER ADD BODY HTML/TEXT ['.strlen($CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('HTML', 'ELECTRUM_PERFORMANCE_REPORT')).']['.strlen($CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('TEXT', 'ELECTRUM_PERFORMANCE_REPORT')).']');
                self::$oCRNRSTN_USR->addHTMLver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('HTML', 'ELECTRUM_PERFORMANCE_REPORT'));
                self::$oCRNRSTN_USR->addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('TEXT', 'ELECTRUM_PERFORMANCE_REPORT'));

                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_REMOTE_ADDR}', $this->return_requestParam('SYS_REMOTE_ADDR', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_SERVER_NAME}', $this->return_requestParam('SYS_SERVER_NAME', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_SYSTEM_TIME}', $this->return_requestParam('SYS_SYSTEM_TIME', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{PROCESS_RUN_TIME}', $this->return_requestParam('SYS_PROCESS_RUN_TIME', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{START_TIME}', $this->return_requestParam('ELECTRUM_START_TIME', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{END_TIME}', $this->return_requestParam('ELECTRUM_END_TIME', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{PRETTY_RUN_TIME}', $this->return_requestParam('ELECTRUM_PRETTY_RUN_TIME', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_COUNT_FILES_TRANSFERRED}', '{TOTAL_COUNT_FILES_TRANSFERRED_}');
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_COUNT_FILES_SKIPPED}', '{TOTAL_COUNT_FILES_SKIPPED_}');
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_FILESIZE_FILES_TRANSFERRED}', '{TOTAL_FILESIZE_FILES_TRANSFERRED_}');
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_ERRORS_FILES_TRANSFERRED}', '{TOTAL_ERRORS_FILES_TRANSFERRED_}');
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}', '{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR_}');
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}', '{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED_}');
                self::$oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{EMAIL}', $tmp_oRECIPIENT['EMAILADDRESS']);

                //
                // TO HANDLE DYNAMIC CONTENT FOR HTML AND TEXT SEPARATELY
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_MESSAGE_TITLE_HTML}', $this->return_requestParam('SYS_MESSAGE_TITLE_HTML', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_MESSAGE_HTML}', $this->return_requestParam('SYS_MESSAGE_HTML', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_LOG_INTEGER_CONSTANT}', self::$oCRNRSTN_USR->return_logPriorityPretty(LOG_NOTICE, 'HTML'));
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_SOURCE_HTML}', $this->return_requestParam('ELECTRUM_DATA_SOURCE_HTML', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_DESTINATION_HTML}', $this->return_requestParam('ELECTRUM_DATA_DESTINATION_HTML', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_HANDLING_PROFILE_HTML}', $this->return_requestParam('ELECTRUM_DATA_HANDLING_PROFILE_HTML', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_ERRORS_TRACE_HTML}', $this->return_requestParam('ELECTRUM_ERRORS_TRACE_HTML', __METHOD__));

                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_MESSAGE_TITLE_TEXT}', $this->return_requestParam('SYS_MESSAGE_TITLE_TEXT', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_MESSAGE_TEXT}', $this->return_requestParam('SYS_MESSAGE_TEXT', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{SYS_LOG_INTEGER_CONSTANT}', self::$oCRNRSTN_USR->return_logPriorityPretty(LOG_NOTICE));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_SOURCE_TEXT}', $this->return_requestParam('ELECTRUM_DATA_SOURCE_TEXT', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_DESTINATION_TEXT}', $this->return_requestParam('ELECTRUM_DATA_DESTINATION_TEXT', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}', $this->return_requestParam('ELECTRUM_DATA_HANDLING_PROFILE_TEXT', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_ERRORS_TRACE_TITLE_TEXT}',  $this->return_requestParam('ELECTRUM_ERRORS_TRACE_TITLE_TEXT', __METHOD__));
                self::$oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{ELECTRUM_ERRORS_TRACE_TEXT}', $this->return_requestParam('ELECTRUM_ERRORS_TRACE_TEXT', __METHOD__));


                /*
                {MESSAGE_TITLE}
{SYSTEM_LOG_INTEGER_CONSTANT}
SYSTEM MESSAGE ::
{MESSAGE}
Sending IP Address ::
{REMOTE_ADDR} ({SERVER_NAME})
System Timestamp ::
{SYSTEM_TIME}
Process Runtime ::
{PROCESS_RUN_TIME} seconds
Start Time :: {START_TIME}
End Time :: {END_TIME}
Total Run Time :: {PRETTY_RUN_TIME}
Number of files transferred :: {TOTAL_COUNT_FILES_TRANSFERRED}
Number of files skipped :: {TOTAL_COUNT_FILES_SKIPPED}
Total file size of transferred data :: {TOTAL_FILESIZE_FILES_TRANSFERRED}
Number of file transfer errors experienced :: {TOTAL_ERRORS_FILES_TRANSFERRED}
Number of endpoint connection errors experienced :: {TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}
Percentage of files successfully transferred :: {PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}


{ELECTRUM_DATA_SOURCE_TEXT}
{ELECTRUM_DATA_DESTINATION_TEXT}
{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = = {ELECTRUM_ERRORS_TRACE_TITLE_TEXT}
{ELECTRUM_ERRORS_TRACE_TEXT}
This email was sent to {}.

                 * */

                //
                // STRAIGHT SEND
                error_log('469 SOAP SERVER - HOOKED UP EMAIL SEND CRNRSTN_oGabriel['.$CRNRSTN_oGabriel->messenger_serial.']');
                $send_result_array = self::$oCRNRSTN_USR->oGabriel_Send($CRNRSTN_oGabriel);        // SEND ALL READY EMAIL (AND CLEAR SENT EMAIL MESSAGE DATA)
                $send_ts = self::$oCRNRSTN_USR->getMicroTime();

                $tmp_ogabriel_cnt = sizeof($send_result_array);
                for($i=0; $i<$tmp_ogabriel_cnt; $i++){

                    $tmp_attempt_send_cnt = sizeof($send_result_array[$i]['is_success']);
                    for($send_cnt=0; $send_cnt<$tmp_attempt_send_cnt; $send_cnt++){

                        if($send_result_array[$i]['is_success'][$send_cnt]){

                            $tmp_status_ARRAY = array(
                                'EMAIL_PROXY_SERIAL' => $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL'],
                                'IS_SENT' => 'TRUE',
                                'SEND_TIMESTAMP' => $send_ts,
                                'SEND_STATUS' => 'SEND SUCCESS',
                                'STATUS_DETAIL' => 'The CRNRSTN :: SOAP services layer has registered successful email send along with the following PHPMailer status message :: '.$send_result_array[$i]['status_msg'][$send_cnt]
                            );

                        }else{

                            $tmp_status_ARRAY = array(
                                'EMAIL_PROXY_SERIAL' => $tmp_oRECIPIENT['EMAIL_PROXY_SERIAL'],
                                'IS_SENT' => 'FALSE',
                                'SEND_TIMESTAMP' => '',
                                'SEND_STATUS' => 'SEND ERROR',
                                'STATUS_DETAIL' => 'The CRNRSTN :: SOAP services layer has captured a PHPMailer send error for this email address with detail as follows :: '.$send_result_array[$i]['status_msg'][$send_cnt]
                            );

                        }

                    }

                }

            }

        }else{

            //
            // STRAIGHT SEND
            error_log('395 SOAP SERVER - HOOK UP STRAIGHT EMAIL SEND.');

        }

        return $tmp_status_ARRAY;

/*
        array_push($tmp_status_report_ARRAY, array(
            'EMAIL_PROXY_SERIAL' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_EMAIL_PROXY_SERIAL),
            'IS_SENT'
            'SEND_TIMESTAMP' =>
            'SEND_STATUS' => self::$oCRNRSTN_USR->paramTunnelEncrypt('SEND SUCCESS'),
            'STATUS_DETAIL' =>self::$oCRNRSTN_USR->paramTunnelEncrypt('')
        ));
*/

    }

    private function encrypt_email_oStatusReport($oStatusReport){

        $oStatusReport['EMAIL_PROXY_SERIAL'] = self::$oCRNRSTN_USR->paramTunnelEncrypt($oStatusReport['EMAIL_PROXY_SERIAL']);
        $oStatusReport['IS_SENT'] = self::$oCRNRSTN_USR->paramTunnelEncrypt($oStatusReport['IS_SENT']);
        $oStatusReport['SEND_TIMESTAMP'] = self::$oCRNRSTN_USR->paramTunnelEncrypt($oStatusReport['SEND_TIMESTAMP']);
        $oStatusReport['SEND_STATUS'] = self::$oCRNRSTN_USR->paramTunnelEncrypt($oStatusReport['SEND_STATUS']);
        $oStatusReport['STATUS_DETAIL'] = self::$oCRNRSTN_USR->paramTunnelEncrypt($oStatusReport['STATUS_DETAIL']);

        return $oStatusReport;

    }

    private function SOAPserver_processElectrumReportRequest(){

	    //
        // WE ARE AT THE SERVER [PROXY]. HANDLE THE REQUEST.
        $SOAP_server_response = array();
        $SOAP_send_success_cnt = 0;
        $SOAP_send_error_cnt = 0;
        $SOAP_send_suppress_cnt = 0;

        //
        //  oGABRIEL HERE. EXECUTE ELECTRUM PERFORMANCE REPORT HERE.
        $tmp_isEncrypted = trim(strtolower(self::$oSoapRequest['CRNRSTN_PACKET_IS_ENCRYPTED']));
        //error_log('447 - SOAP SERVER IS ENCRYPTED='.$tmp_isEncrypted);
        if($tmp_isEncrypted == 'true'){

            $this->SOAP_request_isEncrypted = true;
            error_log('552 SOAP SERVER - CRNRSTN_PROXY_AUTH_KEY='.self::$oSoapRequest['CRNRSTN_PROXY_AUTH_KEY']);
            $tmp_auth_key = self::$oCRNRSTN_USR->paramTunnelDecrypt(self::$oSoapRequest['CRNRSTN_PROXY_AUTH_KEY'], true);

        }else{

            $this->SOAP_request_isEncrypted = false;
            $tmp_auth_key = self::$oSoapRequest['CRNRSTN_PROXY_AUTH_KEY'];

        }

        $crnrstn_proxy_auth_key = self::$oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_AUTH_KEY');

        if($crnrstn_proxy_auth_key == $tmp_auth_key){
            //error_log('463 SOAP SERVER KEY MATCH SUCCESS['.$tmp_auth_key.']');
            $tmp_status_report_ARRAY = array();

            $tmp_oRECIPIENT = $this->return_requestParam('oRECIPIENT', __METHOD__, true, 'oEmail');
            $tmp_size_oRECIPIENT = sizeof($tmp_oRECIPIENT);
            //error_log('468 SOAP SERVER oRECIPIENT[0-'.self::$oSoapRequest['oRECIPIENT'][0]['EMAILADDRESS'].'] COUNT['.$tmp_size_oRECIPIENT.'] EMAIL POS[0]='.$tmp_size_oRECIPIENT[0]['EMAILADDRESS']);

            if($tmp_size_oRECIPIENT<1){

                if($this->SOAP_request_isEncrypted){

                    //
                    // OBJECT :: oEmailSendReport
                    array_push($tmp_status_report_ARRAY, array(
                        'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_auth_key),
                        'TOTAL_EMAILS_RECEIVED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('0'),
                        'TOTAL_EMAILS_SENT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('0'),
                        'ACTIVITY_STATUS_MESSAGE' => self::$oCRNRSTN_USR->paramTunnelEncrypt('The email recipient node of the SOAP request received by the CRNRSTN :: SOAP Services layer contains '.$tmp_size_oRECIPIENT.' records.')
                    ));

                }else{

                    //
                    // OBJECT :: oEmailSendReport
                    array_push($tmp_status_report_ARRAY, array(
                        'CRNRSTN_PROXY_AUTH_KEY' => $tmp_auth_key,
                        'TOTAL_EMAILS_RECEIVED' => '0',
                        'TOTAL_EMAILS_SENT' => '0',
                        'ACTIVITY_STATUS_MESSAGE' => 'The email recipient node of the SOAP request received by the CRNRSTN :: SOAP Services layer contains '.$tmp_size_oRECIPIENT.' records.'
                    ));

                }

            }else{

                $tmp_SUPPRESS_DUPLICATE_RECIPIENT = trim(strtolower($this->return_requestParam('SUPPRESS_DUPLICATE_RECIPIENT', __METHOD__)));

                if($tmp_SUPPRESS_DUPLICATE_RECIPIENT==''){

                    $this->SOAP_request_sendSuppression = true;

                }else{

                    $this->SOAP_request_sendSuppression = $tmp_SUPPRESS_DUPLICATE_RECIPIENT;

                }

                if($tmp_SUPPRESS_DUPLICATE_RECIPIENT == 'true' || $tmp_SUPPRESS_DUPLICATE_RECIPIENT == ''){

                    //
                    // WE HAVE RECIPIENTS TO WHICH TO SEND COMMUNICATIONS
                    for($i=0; $i<$tmp_size_oRECIPIENT; $i++){

                        //
                        // OBJECT :: oStatusReport
                        //error_log('556 - SOAP SERVER SEND['.$tmp_size_oRECIPIENT.'|'.$i.'] TO '.$tmp_oRECIPIENT[$i]['EMAILADDRESS']);
                        $tmp_oStatusReport = $this->SOAPserver_sendEmail($tmp_oRECIPIENT[$i]);
                        
                        if($tmp_oStatusReport['IS_SENT'] == 'TRUE'){
                            
                            $SOAP_send_success_cnt++;
                            
                        }else{

                            if($tmp_oStatusReport['SEND_STATUS'] == 'SEND SUPPRESSED'){

                                $SOAP_send_suppress_cnt++;

                            }else{

                                $SOAP_send_error_cnt++;

                            }
                            
                        }

                        if($this->SOAP_request_isEncrypted){

                            $tmp_oStatusReport = $this->encrypt_email_oStatusReport($tmp_oStatusReport);

                        }

                        array_push($tmp_status_report_ARRAY, $tmp_oStatusReport);

                    }

                }else{

                    $this->SOAP_request_sendSuppression = false;

                    //
                    // WE HAVE RECIPIENTS TO WHICH TO SEND COMMUNICATIONS
                    for($i=0; $i<$tmp_size_oRECIPIENT; $i++){

                        //
                        // OBJECT :: oStatusReport
                        //error_log('596 - SOAP SERVER SEND TO '.$tmp_oRECIPIENT[$i]['EMAILADDRESS']);
                        $tmp_oStatusReport = $this->SOAPserver_sendEmail($tmp_oRECIPIENT[$i]);

                        if($tmp_oStatusReport['IS_SENT'] == 'TRUE'){

                            $SOAP_send_success_cnt++;

                        }else{

                            $SOAP_send_error_cnt++;

                        }

                        if($this->SOAP_request_isEncrypted){

                            $tmp_oStatusReport = $this->encrypt_email_oStatusReport($tmp_oStatusReport);

                        }

                        array_push($tmp_status_report_ARRAY, $tmp_oStatusReport);

                    }

                }

            }

            /*
            for($i=0;$i<$tmp_size_oRECIPIENT;$i++){
                $tmp_EMAIL_PROXY_SERIAL = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_RECIPIENT[$i]['EMAIL_PROXY_SERIAL']);
                $tmp_EMAILADDRESS = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_RECIPIENT[$i]['EMAILADDRESS']);
                error_log('69 - S.E.R.M. Connectivity Test - EMAIL['.$i.']='.$tmp_EMAILADDRESS.' EMAIL_PROXY_SERIAL='.$tmp_EMAIL_PROXY_SERIAL);

                array_push($tmp_status_report_ARRAY, array(
                    'EMAIL_PROXY_SERIAL' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_EMAIL_PROXY_SERIAL),
                    'IS_SENT'
                    'SEND_TIMESTAMP'
                    'SEND_STATUS' => self::$oCRNRSTN_USR->paramTunnelEncrypt('Send success.'),
                    'STATUS_DETAIL' =>self::$oCRNRSTN_USR->paramTunnelEncrypt('1')
                ));
            }
            */

            if($this->SOAP_request_isEncrypted){

                //
                // OBJECT :: oEmailSendReport
                $SOAP_server_response = array(
                    'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_auth_key),
                    'REQUEST_RECEIVED_TIMESTAMP' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->SOAP_startTime),
                    'REQUEST_COMPLETED_TIMESTAMP' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->getMicroTime()),
                    'REQUEST_RUNTIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->SOAP_monitor_time('ELECTRUM_PERFORMANCE')),
                    'TOTAL_EMAILS_RECEIVED' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_size_oRECIPIENT),
                    'TOTAL_EMAILS_SENT' => self::$oCRNRSTN_USR->paramTunnelEncrypt($SOAP_send_success_cnt),
                    'TOTAL_EMAILS_SUPPRESSED' => self::$oCRNRSTN_USR->paramTunnelEncrypt($SOAP_send_suppress_cnt),
                    'TOTAL_EMAILS_ERROR' => self::$oCRNRSTN_USR->paramTunnelEncrypt($SOAP_send_error_cnt),
                    'ACTIVITY_STATUS_MESSAGE' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: Electrum performance notification send processing completed successfully.'),
                    'oACTIVITY_STATUS_REPORT' => $tmp_status_report_ARRAY);

            }else{

                //
                // OBJECT :: oEmailSendReport
                $SOAP_server_response = array(
                    'CRNRSTN_PROXY_AUTH_KEY' => $tmp_auth_key,
                    'REQUEST_RECEIVED_TIMESTAMP' => $this->SOAP_startTime,
                    'REQUEST_COMPLETED_TIMESTAMP' => self::$oCRNRSTN_USR->getMicroTime(),
                    'REQUEST_RUNTIME' => $this->SOAP_monitor_time('ELECTRUM_PERFORMANCE'),
                    'TOTAL_EMAILS_RECEIVED' => $tmp_size_oRECIPIENT,
                    'TOTAL_EMAILS_SENT' => $SOAP_send_success_cnt,
                    'TOTAL_EMAILS_SUPPRESSED' => $SOAP_send_suppress_cnt,
                    'TOTAL_EMAILS_ERROR' => $SOAP_send_error_cnt,
                    'ACTIVITY_STATUS_MESSAGE' => 'CRNRSTN :: Electrum performance notification send processing completed successfully.',
                    'oACTIVITY_STATUS_REPORT' => $tmp_status_report_ARRAY);

            }

        }else{

            /*
            'oEmailSendReport'
            'CRNRSTN_PROXY_AUTH_KEY' => array( 'name' => 'CRNRSTN_PROXY_AUTH_KEY',  'type' => 'xsd:string' ),
            'REQUEST_RECEIVED_TIMESTAMP' => array( 'name' => 'REQUEST_RECEIVED_TIMESTAMP',  'type' => 'xsd:string' ),
            'REQUEST_COMPLETED_TIMESTAMP' => array( 'name' => 'REQUEST_COMPLETED_TIMESTAMP',  'type' => 'xsd:string' ),
            'REQUEST_RUNTIME' => array( 'name' => 'REQUEST_RUNTIME',  'type' => 'xsd:string' ),
            'TOTAL_EMAILS_RECEIVED' => array( 'name' => 'TOTAL_EMAILS_RECEIVED',  'type' => 'xsd:string' ),
            'TOTAL_EMAILS_SENT' => array( 'name' => 'TOTAL_EMAILS_SENT',  'type' => 'xsd:string' ),
            'TOTAL_EMAILS_ERROR' => array( 'name' => 'TOTAL_EMAILS_ERROR',  'type' => 'xsd:string' ),
            'ACTIVITY_STATUS_MESSAGE' => array( 'name' => 'TOTAL_EMAILS_ERROR',  'type' => 'xsd:string' ),
            'oACTIVITY_STATUS_REPORT' => array( 'name' => 'ACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray' )

            'oStatusReport'
            'EMAIL_PROXY_SERIAL' => array( 'name' => 'EMAIL_PROXY_SERIAL',  'type' => 'xsd:string' ),
            'IS_SENT'
            'SEND_TIMESTAMP'
            'SEND_STATUS' => array( 'name' => 'SEND_STATUS',  'type' => 'xsd:string' ),
            'STATUS_DETAIL' => array( 'name' => 'STATUS_DETAIL',  'type' => 'xsd:string' )
            */

            //
            // OBJECT :: oEmailSendReport
            array_push($SOAP_server_response, array(
                'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_auth_key),
                'ACTIVITY_STATUS_MESSAGE' => '403 :: Unauthorized request received by the CRNRSTN :: SOAP Services layer.'
            ));

        }


        /*
        self::$oSoapRequest;
        self::$oSoapRequest['CRNRSTN_PACKET_IS_ENCRYPTED'] => 'TRUE',

        PHPMAILER REQS
        'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_AUTH_KEY'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'RECIPIENT' => $tmp_RECIPIENT_ARRAY,
        'SENDER' => $tmp_SENDER_ARRAY,
        'REPLYTO' => $tmp_REPLYTO_ARRAY,
        'CC' => $tmp_CC_ARRAY,
        'BCC' => $tmp_BCC_ARRAY,
        'MESSAGE_SUBJECT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: Electrum performance report from '.$_SERVER['REMOTE_ADDR'].' ('.$_SERVER['SERVER_NAME'].')', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'WORD_WRAP' => self::$oCRNRSTN_USR->paramTunnelEncrypt('72', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'PRIORITY' => self::$oCRNRSTN_USR->paramTunnelEncrypt('3', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'IS_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('true', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),

        DYN CONTENT
        'SYS_MESSAGE_TITLE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('C<span style="color: #FF0000;">R</span>NRSTN :: Electrum Performance Notification', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_MESSAGE_TITLE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: Electrum Performance Notification', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_LOG_INTEGER_CONSTANT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('LOG_INFO', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_MESSAGE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('<div style="font-weight: bold;">C<span style="color: #FF0000;">R</span>NRSTN :: Electrum process has completed successfully.</div>', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_MESSAGE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: Electrum process has completed successfully.', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_REMOTE_ADDR' => self::$oCRNRSTN_USR->paramTunnelEncrypt($_SERVER['REMOTE_ADDR'], $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_SERVER_NAME' => self::$oCRNRSTN_USR->paramTunnelEncrypt($_SERVER['SERVER_NAME'], $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_SYSTEM_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->return_queryDateTimeStamp(), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_PROCESS_RUN_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->wallTime(), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_ACTIVITY_TRACE_TITLE' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: ELECTRUM EXCEPTION LOG TRACE', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_ACTIVITY_TRACE_CONTENT_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('<div style="font-weight: bold;">Begin C<span style="color: #FF0000;">R</span>NRSTN :: Electrum error log trace...</div>', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'SYS_ACTIVITY_TRACE_CONTENT_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('Begin CRNRSTN :: Electrum error log trace...', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_START_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{START_TIME_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_END_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{END_TIME_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_PRETTY_RUN_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{PRETTY_RUN_TIME_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_COUNT_FILES_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_COUNT_FILES_SKIPPED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_FILESIZE_FILES_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_ERRORS_FILES_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_SOURCE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{ELECTRUM_DATA_SOURCE_HTML_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_DESTINATION_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{ELECTRUM_DATA_DESTINATION_HTML_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_HANDLING_PROFILE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{ELECTRUM_DATA_HANDLING_PROFILE_HTML_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_SOURCE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{ELECTRUM_DATA_SOURCE_TEXT_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_DESTINATION_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{ELECTRUM_DATA_DESTINATION_TEXT_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
        'ELECTRUM_DATA_HANDLING_PROFILE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{ELECTRUM_DATA_HANDLING_PROFILE_TEXT_}')
	     */

        return $SOAP_server_response;
    }

    public function return_requestParam($key, $method, $isArray=false, $SOAP_object_type=NULL){

	    try{

	        if(isset(self::$oSoapRequest[$key])){

	            if($isArray){

                    $tmp_array = self::$oSoapRequest[$key];

                    $SOAP_object_type = trim(strtoupper($SOAP_object_type));
	                switch($SOAP_object_type){
	                    case 'OEMAIL':
                            $tmp_array = self::$oSoapRequest[$key];
                            $tmp_array_size = sizeof($tmp_array);
                            for($i_pos=0; $i_pos<$tmp_array_size; $i_pos++){

                                if($this->SOAP_request_isEncrypted == 'true'){
                                    //error_log('709 - SOAP SERVER['.$tmp_array_size.']['.$i_pos.'] - '.$tmp_array[$i_pos]['EMAILADDRESS']);
                                    $tmp_array[$i_pos]['EMAIL_PROXY_SERIAL'] = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_array[$i_pos]['EMAIL_PROXY_SERIAL'], true);
                                    $tmp_array[$i_pos]['EMAILADDRESS'] = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_array[$i_pos]['EMAILADDRESS'], true);

                                    if(isset($tmp_array[$i_pos]['FIRSTNAME'])){

                                        $tmp_array[$i_pos]['FIRSTNAME'] = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_array[$i_pos]['FIRSTNAME'], true);

                                    }

                                    if(isset($tmp_array[$i_pos]['LASTNAME'])){

                                        $tmp_array[$i_pos]['LASTNAME'] = self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_array[$i_pos]['LASTNAME'], true);

                                    }

                                    //error_log('715 - SOAP SERVER['.$tmp_array_size.']['.$i_pos.'] - '.$tmp_array[$i_pos]['EMAILADDRESS']);
                                }else{
                                    //error_log('717 - SOAP RETURN FOR NOT IS ENCRYPTED....');
                                    return $tmp_array;

                                }

                            }

                        break;

                    }

                    return $tmp_array;

                }else{

                    if($this->SOAP_request_isEncrypted == 'true'){

                        $tmp_request_param =  self::$oSoapRequest[$key];

                        return self::$oCRNRSTN_USR->paramTunnelDecrypt($tmp_request_param, true);

                    }else{

                        return self::$oSoapRequest[$key];

                    }

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('The CRNRSTN :: SOAP service request manager was unable to find the "'.$key.'" parameter while running the '.$method.'() method.');

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }
	
	public function __destruct() {

	}
}