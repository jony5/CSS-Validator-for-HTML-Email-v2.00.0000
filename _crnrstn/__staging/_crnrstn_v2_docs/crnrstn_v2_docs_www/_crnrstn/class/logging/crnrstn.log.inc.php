<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2020 eVifweb development
#  VERSION :: 2.0.0 on Sun May 31, 2020 at 1259
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#		application from one environment to the next without having to change your code-base to account for environmentally 
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::

#  MIT LICENSE :: Copyright 2018 Jonathan J5 Harris
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:

#		The above copyright notice and this permission notice shall be included in all copies or substantial portions 
#		of the Software.

#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS 
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.ncluding without limitation the rights to use, copy, 
#			  modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
#			  Software is furnished to do so, subject to the following conditions:

#			  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

#			  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#			  WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
#			  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
#			  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


# syslog() Priorities (in descending order)
# Constant		Description
# LOG_EMERG		system is unusable. 
# LOG_ALERT		action must be taken immediately
# LOG_CRIT		critical conditions
# LOG_ERR		error conditions
# LOG_WARNING	warning conditions
# LOG_NOTICE	normal, but significant, condition
# LOG_INFO		informational message
# LOG_DEBUG		debug-level message

#		$errortype = array (
#			E_ERROR              => 'Error',
#			E_WARNING            => 'Warning',
#			E_PARSE              => 'Parsing Error',
#			E_NOTICE             => 'Notice',
#			E_CORE_ERROR         => 'Core Error',
#			E_CORE_WARNING       => 'Core Warning',
#			E_COMPILE_ERROR      => 'Compile Error',
#			E_COMPILE_WARNING    => 'Compile Warning',
#			E_USER_ERROR         => 'User Error',
#			E_USER_WARNING       => 'User Warning',
#			E_USER_NOTICE        => 'User Notice',
#			E_STRICT             => 'Runtime Notice',
#			E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
#		);

/*
// CLASS :: crnrstn_logging
// AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn_logging {

    protected $oLog_output_manager;
	public $emailDataElements = array();
	public $msg_delivery_status;

	protected $debugMode=0;
    protected $starttime;
    public $objectOwner_key;
    public $log_output = '';

	protected $piped_log_silo_key;
	protected $active_silo_ARRAY = array();

	public function __construct($debugMode=NULL, $objectOwner_key='crnrstn_logging', $piped_log_silo_key='*') {

		if(isset($debugMode)){
			$this->debugMode = (int) $debugMode;
		}

		$this->objectOwner_key = $objectOwner_key;
		$this->piped_log_silo_key = $piped_log_silo_key;

        $tmp_log_silo_array = explode('|', $this->piped_log_silo_key);

        $tmp_log_silo_cnt = sizeof($tmp_log_silo_array);

        for($i=0;$i<$tmp_log_silo_cnt;$i++){

            if($tmp_log_silo_array[$i] == '*' || $tmp_log_silo_array[$i]==''){

                //
                // TRACE ALL LOG DATA
                $tmp_silo_checksum = crc32('*');
                $this->active_silo_ARRAY[$tmp_silo_checksum] = 1;

                $i = $tmp_log_silo_cnt + 5;

            }else{

                $tmp_silo_checksum = crc32($tmp_log_silo_array[$i]);
                $this->active_silo_ARRAY[$tmp_silo_checksum] = 1;

            }

        }

	}

	private function load_log_output_mgr($oCRNRSTN_USR){

        $this->oLog_output_manager = new crnrstn_log_output_manager($oCRNRSTN_USR);

    }

	public function catchException($exception_obj, $syslog_constant, $exception_method, $namespace, $profile_override_pipe, $endpoint_override_pipe, $wcr_override_pipe, $oCRNRSTN_USR){

	    /*
        # syslog() Priorities (in descending order)
        # Constant		Description
        # LOG_EMERG		system is unusable.
        # LOG_ALERT		action must be taken immediately
        # LOG_CRIT		critical conditions
        # LOG_ERR		error conditions
        # LOG_WARNING	warning conditions
        # LOG_NOTICE	normal, but significant, condition
        # LOG_INFO		informational message
        # LOG_DEBUG		debug-level message

        Exception $e
        final public getMessage ( void ) : string
        final public getPrevious ( void ) : Throwable
        final public getCode ( void ) : mixed
        final public getFile ( void ) : string
        final public getLine ( void ) : int
        final public getTrace ( void ) : array
        final public getTraceAsString ( void ) : string
        public __toString ( void ) : string
        final private __clone ( void ) : void

        $this->error_log('121 - getMessage='.$exception_obj->getMessage());
        $this->error_log('122 - getPrevious='.$exception_obj->getPrevious());
        $this->error_log('123 - getCode='.$exception_obj->getCode());
        $this->error_log('124 - getFile='.$exception_obj->getFile());
        $this->error_log('125 - getLine='.$exception_obj->getLine());
        $this->error_log('126 - getTraceAsString='.$exception_obj->getTraceAsString());

        121 - getMessage=The requested _SERVER super global parameter [CLOWN_TOWN] cannot be found.
        122 - getPrevious=
        123 - getCode=0
        124 - getFile=/var/www/html/crnrstn_v2/_crnrstn/class/environmentals/crnrstn.env.inc.php
        125 - getLine=403
        126 - getTraceAsString=#0 /var/www/html/crnrstn_v2/_crnrstn/class/user/crnrstn.user.inc.php(6063): crnrstn_environmentals->getServerArrayVar('CLOWN_TOWN', Object(crnrstn_user))\n#1 /var/www/html/crnrstn_v2/common/inc/footer/footer.inc.php(591): crnrstn_user->get_SERVER_param('CLOWN_TOWN')\n#2 /var/www/html/crnrstn_v2/index.php(132): include_once('/var/www/html/c...')\n#3 {main}

        */
        
        $oEnv = $oCRNRSTN_USR->return_oCRNRSTN_ENV();

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();
        $tmp_exception_runtime = $oCRNRSTN_USR->wallTime();
        $tmp_exception_systemtime = $oCRNRSTN_USR->getMicroTime();

        $tmp_exception_method = '';
        $method = trim($exception_method);
        if(isset($method)){

            if($method==''){

                $tmp_exception_method = $exception_obj->getFile();
                $method = 'file';

            }else{

                $tmp_exception_method = $method.'()';
                $method = 'method';

            }

        }else{

            $tmp_exception_method = $exception_obj->getFile();
            $method = 'file';

        }
        
        if(isset($profile_override_pipe)){

            $output_profile_pipe = trim(strtoupper($profile_override_pipe));

        }else{

            //
            // EXTRACT OUTPUT CHANNEL FROM ENVIRONMENTALLY SPECIFIC CONFIGURATION
            $output_profile_pipe = $oEnv->return_loggingProfile();

        }

        if(isset($endpoint_override_pipe)){

            $output_endpoint_pipe = $endpoint_override_pipe;

        }else{

            //
            // EXTRACT OUTPUT ENDPOINT FROM ENVIRONMENTALLY SPECIFIC CONFIGURATION
            $output_endpoint_pipe = $oEnv->return_endpointProfile();

        }

        if(isset($wcr_override_pipe)){

            $output_wcr_pipe = $wcr_override_pipe;

        }else{

            //
            // EXTRACT OUTPUT WCR FROM ENVIRONMENTALLY SPECIFIC CONFIGURATION
            $output_wcr_pipe = $oEnv->return_WCRProfile();

        }

        //
        // WE HAVE ALL "PIPE" DATA, AND WE ARE READY TO SEEENND IT!
        $profile_pipe_pos = strpos($output_profile_pipe, "|");
        $endpoint_pipe_pos = strpos($output_endpoint_pipe, "|");
        $wcr_pipe_pos = strpos($output_wcr_pipe, "|");

        if ($profile_pipe_pos !== false) {

            $tmp_e_profile_ARRAY = explode('|', $output_profile_pipe);


        }else{

            $tmp_e_profile_ARRAY[0] = $output_profile_pipe;

        }

        if ($endpoint_pipe_pos !== false) {

            $tmp_e_endpoint_ARRAY = explode('|', $output_endpoint_pipe);

        }else{

            $tmp_e_endpoint_ARRAY[0] = $output_endpoint_pipe;

        }

        if ($wcr_pipe_pos !== false) {

            $tmp_e_wcr_ARRAY = explode('|', $output_wcr_pipe);


        }else{

            $tmp_e_wcr_ARRAY[0] = $output_wcr_pipe;

        }

        //
        // INSTANTIATE LOG TRACE OUTPUT MANAGER
        $this->load_log_output_mgr($oCRNRSTN_USR);

        $tmp_cnt_profile = sizeof($tmp_e_profile_ARRAY);
        $tmp_cnt_endpoint = sizeof($tmp_e_endpoint_ARRAY);
        $tmp_cnt_wcr = sizeof($tmp_e_wcr_ARRAY);

        //
        // WCR CAN HOLD ENDPOINT DATA (E.G. FOR EMAIL)...SO CHECK WCR FOR '' IF PROFILE_CNT!=ENDPOINT_CNT TO CONFIRM ERROR
        if($tmp_cnt_profile != $tmp_cnt_wcr || (($tmp_cnt_profile != $tmp_cnt_endpoint && ($tmp_cnt_wcr[0]=='')))){

            error_log('CRNRSTN configuration error due to PIPE MISMATCH between output PROFILE[cnt='.$tmp_cnt_profile.'], ENDPOINT[cnt='.$tmp_cnt_endpoint.'] AND WCR[cnt='.$tmp_cnt_wcr.'].');
            $oCRNRSTN_USR->error_log('[runtime '.$tmp_exception_runtime.' secs] ['.$method.' '.$tmp_exception_method.'] [linenum '.$tmp_exception_linenum.'] '.$tmp_exception_msg, __LINE__, __METHOD__,__FILE__, '*');

        }else{

            for($i=0; $i<$tmp_cnt_profile; $i++){

                switch($tmp_e_profile_ARRAY[$i]){
                    case 'EMAIL':

                        //
                        // DEFAULT CRNRSTN CONFIGURATION - RECOMMENDATION FOR CONFIG PRIORITY ::
                        // EMAIL_PRIMARY = SMTP WITH CRNRSTN WILDCARD RESOURCE (WCR) CONFIG AUTHENTICATION
                        // EMAIL_SECONDARY = SENDMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                        // EMAIL_TERTIARY = MAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                        // *EMAIL_QUATIARY = QMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                        // *EMAIL_PENTIARY = UNAUTHENTICATED SMTP WITH CRNRSTN WCR CONFIGURATION
                        // * NO SUCCESS IN TESTING THIS DUE TO CONFIGURATION LIMITATIONS WITHIN PRODUCTION

                        //
                        // ESTABLISH RECIPIENTS AND CONNECT TO oMESSENGER FROM THE NORTH
                        if($tmp_e_endpoint_ARRAY[0]==''){
                            $tmp_e_recipient_email_ARRAY = array();
                            $tmp_e_recipient_name_ARRAY = array();

                            //
                            // ATTEMPT TO EXTRACT EMAIL RECIPIENTS FROM WCR
                            // EMAIL CAN BE IN FORM 'email@email.com, firstname lastname|email@email.com, firstname lastname|...'
                            // EMAIL CAN ALSO BE IN FORM WHERE ::
                            //          email = 'email1@email.com|email2@email.com|email3@email.com|email4@email.com|5...'
                            //          name = 'firstname1 lastname|firstname2 lastname|firstname3 lastname|firstname4 lastname|5'
                            $tmp_recipient_email_pipe = $oCRNRSTN_USR->getEnvResource('SYS_RECIPIENT_EMAIL', $tmp_e_wcr_ARRAY[$i]);
                            $tmp_comma_delim_pos = strpos($tmp_recipient_email_pipe, ",");
                            if ($tmp_comma_delim_pos !== false || $tmp_recipient_email_pipe!='') {

                                $tmp_e_recipientFULL_ARRAY = explode('|', $tmp_recipient_email_pipe);
                                $tmp_recipent_cnt = sizeof($tmp_e_recipientFULL_ARRAY);
                                for($iii=0;$iii<$tmp_recipent_cnt;$iii++){
                                    $tmp_r_array = explode(',', $tmp_e_recipientFULL_ARRAY[$iii]);
                                    // IS EMAIL FIRST?
                                    $at_pos = strpos($tmp_r_array[0], "@");
                                    if ($at_pos !== false) {
                                        $tmp_e_recipient_email_ARRAY[] = $tmp_r_array[0];
                                        $tmp_e_recipient_name_ARRAY[] = $tmp_r_array[1];
                                    }else{
                                        $tmp_e_recipient_name_ARRAY[] = $tmp_r_array[0];
                                        $tmp_e_recipient_email_ARRAY[] = $tmp_r_array[1];
                                    }

                                }

                                $tmp_email_cnt = sizeof($tmp_e_recipient_email_ARRAY);
                                $tmp_name_cnt = sizeof($tmp_e_recipient_name_ARRAY);

                            }else{

                                //
                                // EMAIL AND NAME IN SEPARATE WCR ATTRIBUTES
                                $tmp_e_recipient_email_ARRAY = explode('|', $tmp_recipient_email_pipe);
                                $tmp_wcr_recipient_name_pipe = $oCRNRSTN_USR->getEnvResource('SYS_RECIPIENT_NAME', $tmp_e_wcr_ARRAY[$i]);
                                $tmp_e_recipient_name_ARRAY = explode('|', $tmp_wcr_recipient_name_pipe);

                                $tmp_email_cnt = sizeof($tmp_e_recipient_email_ARRAY);
                                $tmp_name_cnt = sizeof($tmp_e_recipient_name_ARRAY);
                                if($tmp_email_cnt != $tmp_name_cnt){

                                    error_log('251 user - LOG TO DEFAULT - ERROR OF PIPE MISMATCH BETWEEN RECIPIENT EMAIL[cnt='.$tmp_email_cnt.'] AND RESPECTIVE NAMES[cnt='.$tmp_name_cnt.'].');

                                }

                            }

                        }else{

                            //
                            // SIMPLIFIED EMAIL ENDPOINT INTEGRATION DIRECT FROM CRNRSTN CONFIG FILE
                            // where email = 'email1@email.com, email2@email.com, email3@email.com, email4@email.com,...'
                            // name = ...no names supported by CRNRSTN v1.0.1...
                            $tmp_recipient_delim_pos = strpos($tmp_e_endpoint_ARRAY[$i], ",");
                            if ($tmp_recipient_delim_pos !== false) {

                                $tmp_e_recipient_email_ARRAY = explode(',', $tmp_e_endpoint_ARRAY[$i]);


                            }else{

                                //
                                // STILL SUPPORTING SINGLE EMAIL ENTRY FROM CRNRSTN CONFIGURATION FILE
                                $tmp_e_recipient_email_ARRAY[0] = $tmp_e_endpoint_ARRAY[$i];

                            }

                        }

                        //
                        // EXTRACT EMAIL PROTOCOL [SMTP, QMAIL, SENDMAIL, MAIL] FROM WCR
                        $tmp_protocol = trim(strtoupper($oCRNRSTN_USR->getEnvResource('EMAIL_PROTOCOL', $tmp_e_wcr_ARRAY[$i])));
                        $tmp_SMTP_AUTH = false;

                        if($oCRNRSTN_USR->getEnvResource('PROXY_SEND_ENABLED')){

                            $tmp_protocol = 'CRNRSTN_PROXY';

                        }

                        if($tmp_protocol=='SMTP'){

                            $tmp_SMTP_AUTH = $oCRNRSTN_USR->getEnvResource('SYS_SMTP_AUTH', $tmp_e_wcr_ARRAY[$i]);
                            $tmp_SMTP_SERVER = $oCRNRSTN_USR->getEnvResource('SYS_SMTP_SERVER', $tmp_e_wcr_ARRAY[$i]);
                            $tmp_SMTP_PORT_OUTGOING = $oCRNRSTN_USR->getEnvResource('SYS_SMTP_PORT_OUTGOING', $tmp_e_wcr_ARRAY[$i]);
                            $tmp_SMTP_USERNAME = $oCRNRSTN_USR->getEnvResource('SYS_SMTP_USERNAME', $tmp_e_wcr_ARRAY[$i]);
                            $tmp_SMTP_PASSWORD = $oCRNRSTN_USR->getEnvResource('SYS_SMTP_PASSWORD', $tmp_e_wcr_ARRAY[$i]);

                        }

                        $tmp_oGabriel_serial = $oCRNRSTN_USR->generateNewKey(50);

                        if($tmp_SMTP_AUTH && !$oCRNRSTN_USR->getEnvResource('PROXY_SEND_ENABLED')){

                            //
                            // SMTP AUTH
                            $CRNRSTN_oGabriel = $oCRNRSTN_USR->initialize_oGabriel($tmp_oGabriel_serial, $tmp_protocol, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING);

                        }else{

                            //
                            // ANY NON-AUTH
                            $CRNRSTN_oGabriel = $oCRNRSTN_USR->initialize_oGabriel($tmp_oGabriel_serial, $tmp_protocol);

                        }

                        if(isset($tmp_SMTP_SERVER)){
                            if($tmp_SMTP_SERVER!=''){

                                $oCRNRSTN_USR->addHostServers($CRNRSTN_oGabriel, $tmp_SMTP_SERVER);

                            }
                        }

                        //
                        // EXTRACT REMAINING SYSTEM MESSAGING META FROM WCR
                        $tmp_FROM_EMAIL = $oCRNRSTN_USR->getEnvResource('SYS_FROM_EMAIL', $tmp_e_wcr_ARRAY[$i]);
                        $tmp_FROM_NAME = $oCRNRSTN_USR->getEnvResource('SYS_FROM_NAME', $tmp_e_wcr_ARRAY[$i]);

                        $tmp_REPLYTO_EMAIL = $oCRNRSTN_USR->getEnvResource('SYS_REPLYTO_EMAIL', $tmp_e_wcr_ARRAY[$i]);
                        $tmp_REPLYTO_NAME = $oCRNRSTN_USR->getEnvResource('SYS_REPLYTO_NAME', $tmp_e_wcr_ARRAY[$i]);

                        $tmp_DEFAULT_LINE_WRAP = $oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_WORD_WRAP', $tmp_e_wcr_ARRAY[$i]);
                        $tmp_DEFAULT_ISHTML = $oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_ISHTML', $tmp_e_wcr_ARRAY[$i]);
                        $tmp_DEFAULT_PRIORITY = $oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_PRIORITY', $tmp_e_wcr_ARRAY[$i]);

                        $tmp_DEFAULT_DUP_SUPPRESS = $oCRNRSTN_USR->getEnvResource('SYS_MSG_DEFAULT_DUP_SUPPRESS', $tmp_e_wcr_ARRAY[$i]);

                        //
                        // PASS EACH RECIPIENT TO oMESSENGER FROM THE NORTH FOR BUILD OUT
                        $tmp_cnt_recipient = sizeof($tmp_e_recipient_email_ARRAY);
                        for($ii=0; $ii<$tmp_cnt_recipient; $ii++){

                            if(!isset($tmp_e_recipient_name_ARRAY[$ii])){

                                $tmp_e_recipient_name_ARRAY[$ii] = 'System Support Personnel';

                            }else {

                                if($tmp_e_recipient_name_ARRAY[$ii]==''){

                                    $tmp_e_recipient_name_ARRAY[$ii] = 'System Support Personnel';

                                }
                            }

                            $oCRNRSTN_USR->suppressEmailDuplicates($CRNRSTN_oGabriel, $tmp_DEFAULT_DUP_SUPPRESS);

                            //
                            // ADD BULK EMAIL FOR SINGULARITY OF DELIVERY AND CUSTOMIZATION
                            //$oCRNRSTN_USR->error_log('447 add email - '.$tmp_e_recipient_email_ARRAY[$ii],__LINE__,__METHOD__,__FILE__);
                            //$oCRNRSTN_USR->error_log('448 add name - '.$tmp_e_recipient_name_ARRAY[$ii],__LINE__,__METHOD__,__FILE__);
                            $email_experience_tracker = $oCRNRSTN_USR->addAddressBulk($CRNRSTN_oGabriel, $tmp_e_recipient_email_ARRAY[$ii], $tmp_e_recipient_name_ARRAY[$ii]);

                            $oCRNRSTN_USR->addReplyToBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_REPLYTO_EMAIL, $tmp_REPLYTO_NAME);
                            $oCRNRSTN_USR->addFromBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_FROM_EMAIL, $tmp_FROM_NAME);
                            $oCRNRSTN_USR->wordWrapBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_LINE_WRAP);
                            $oCRNRSTN_USR->isHTMLBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_ISHTML);
                            $oCRNRSTN_USR->setPriorityBulk($CRNRSTN_oGabriel, $email_experience_tracker, $tmp_DEFAULT_PRIORITY);

                            $oCRNRSTN_USR->addSubjectBulk($CRNRSTN_oGabriel, $email_experience_tracker, 'Exception Notification {SUBJECT_LINE} by CRNRSTN ::');
                            $oCRNRSTN_USR->addHTMLver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody('HTML'));
                            $oCRNRSTN_USR->addTEXTver_Bulk($CRNRSTN_oGabriel, $email_experience_tracker, $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgBody());

                            $oCRNRSTN_USR->addDynamicContent_SUBJECT($CRNRSTN_oGabriel, $email_experience_tracker, '{SUBJECT_LINE}', '('.$_SERVER['SERVER_NAME'].')');

                            $oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{MESSAGE}', $tmp_exception_msg);
                            $oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{SYSTEM_TIME}', $tmp_exception_systemtime);

                            $oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{PROCESS_RUN_TIME}', $tmp_exception_runtime);
                            $oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{EMAIL}', $tmp_e_recipient_email_ARRAY[$ii]);

                            $oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{LINE_NUM}',  $tmp_exception_linenum);

                            $oCRNRSTN_USR->addDynamicContent_MULTIPART($CRNRSTN_oGabriel, $email_experience_tracker, '{METHOD}', $tmp_exception_method);

                            //
                            // TO HANDLE DYNAMIC CONTENT FOR HTML AND TEXT SEPARATELY
                            $oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{SYSTEM_LOG_INTEGER_CONSTANT}', $oCRNRSTN_USR->return_logPriorityPretty($syslog_constant, 'HTML'));
                            $oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{SYSTEM_LOG_INTEGER_CONSTANT}',  $oCRNRSTN_USR->return_logPriorityPretty($syslog_constant));
                            $oCRNRSTN_USR->addDynamicContent_HTML($CRNRSTN_oGabriel, $email_experience_tracker, '{LOG_TRACE}', $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML'));
                            $oCRNRSTN_USR->addDynamicContent_TEXT($CRNRSTN_oGabriel, $email_experience_tracker, '{LOG_TRACE}', $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT'));

                        }

                        if($oCRNRSTN_USR->getEnvResource('PROXY_SEND_ENABLED')){

                            $proxy_endpoint_uri = $oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_WSDL_ENDPOINT');
                            $proxy_auth_key = $oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_AUTH_KEY');

                            $oCRNRSTN_USR->initProxySend($CRNRSTN_oGabriel, $proxy_endpoint_uri, $proxy_auth_key);

                            //
                            // PROXY - TUNNEL ENCRYPTION SETTINGS
                            $cipher = 'AES-256-CTR';
                            $proxy_secret_key = 'this-Is-the-encryption-key';
                            $proxy_encrypt_algorithm = 'ripemd256';

                            $oCRNRSTN_USR->proxyEncrypt_setCipherOverride($CRNRSTN_oGabriel, $cipher);
                            $oCRNRSTN_USR->proxyEncrypt_setSecretKeyOverride($CRNRSTN_oGabriel, $proxy_secret_key);
                            $oCRNRSTN_USR->proxyEncrypt_setAlgorithmOverride($CRNRSTN_oGabriel, $proxy_encrypt_algorithm);

                            $oCRNRSTN_USR->oGabriel_ProxySend($CRNRSTN_oGabriel);

                        }else{

                            $oCRNRSTN_USR->oGabriel_Send($CRNRSTN_oGabriel);        // SEND ALL READY EMAIL (AND CLEAR SENT EMAIL MESSAGE DATA)

                        }

                    break;
                    case 'SCREEN':
                    case 'SCREEN_HTML':
                        $oCRNRSTN_USR->error_log('**Exception output ['.$tmp_e_profile_ARRAY[$i].'] :: IMPLEMENTATION PENDING**', __LINE__, __METHOD__,__FILE__, 'CRNRSTN_CONFIGURATION');
                        break;
                    case 'SCREEN_HTML_HIDDEN':
                        $oCRNRSTN_USR->error_log('**Exception output ['.$tmp_e_profile_ARRAY[$i].'] :: IMPLEMENTATION PENDING**', __LINE__, __METHOD__,__FILE__, 'CRNRSTN_CONFIGURATION');

                        break;
                    case 'SCREEN_TEXT':
                        $oCRNRSTN_USR->error_log('**Exception output ['.$tmp_e_profile_ARRAY[$i].'] :: IMPLEMENTATION PENDING**', __LINE__, __METHOD__,__FILE__, 'CRNRSTN_CONFIGURATION');

                        break;
                    case 'FILE':
                        $oCRNRSTN_USR->error_log('**Exception output ['.$tmp_e_profile_ARRAY[$i].'] :: IMPLEMENTATION PENDING**', __LINE__, __METHOD__,__FILE__, 'CRNRSTN_CONFIGURATION');

                        break;
                    case 'SPLUNK':
                        $oCRNRSTN_USR->error_log('**Exception output ['.$tmp_e_profile_ARRAY[$i].'] :: IMPLEMENTATION PENDING**', __LINE__, __METHOD__,__FILE__, 'CRNRSTN_CONFIGURATION');

                        break;
                    case 'GOOGLE_ANALYTICS':
                        $oCRNRSTN_USR->error_log('**Exception output ['.$tmp_e_profile_ARRAY[$i].'] :: IMPLEMENTATION PENDING**', __LINE__, __METHOD__,__FILE__, 'CRNRSTN_CONFIGURATION');

                        break;
                    default:

                        $oCRNRSTN_USR->error_log('[runtime '.$tmp_exception_runtime.' secs] ['.$method.' '.$tmp_exception_method.'] [linenum '.$tmp_exception_linenum.'] '.$tmp_exception_msg, __LINE__, __METHOD__,__FILE__, '*');

                    break;

                }

            }
        }

    }

    public function error_log($str, $line_num, $method, $file, $log_silo_key, $oCRNRSTN_USR){

        switch($this->debugMode){
            case 1:
                // LIVE OUTPUT
                $tmp_silo_all = '*';

                if(!isset($log_silo_key) || $log_silo_key==''){

                    $log_silo_key = '*';

                }

                $tmp_silo_checksum = crc32($log_silo_key);

                if (isset($this->active_silo_ARRAY[crc32($tmp_silo_all)]) || isset($this->active_silo_ARRAY[$tmp_silo_checksum]) || $log_silo_key == '*'){

                    if($method != 'crnrstn_logging::catchException'){

                        $tmp_str = "[runtime ". $oCRNRSTN_USR->wallTime().' secs]';

                        if(!isset($method) || $method==''){

                            if(isset($file)){

                                $tmp_str .= ' [file '.$file.']';

                            }

                        }else{

                            $tmp_str .= ' [method '.$method.']';

                        }

                        if(isset($line_num)){

                            $tmp_str .= ' [linenum '.$line_num.']';

                        }

                        $tmp_str .= ' '.$str;

                    }else{

                        $tmp_str = $str;

                    }

                    error_log($tmp_str);

                }

            break;
            case 2:
                //
                // LOG AGGREGATION WITHIN CRNRSTN + PASSIVE SILO SUPPORT (MUST CALL METHOD TO ACCESS LOG SILO)
                // RETURN LOG DATA FOR AGGREGATION WITHIN oCRNRSTN_USR AND
                // TO BE EXPOSED UPON EXCEPTION OR MANUALLY THROUGH
                // $output_mode [DEFAULT, SCREEN, EMAIL or FILE]

                /*

                 # $debugMode = 2
                   * 100% LOG TRACE ROLLING AGGREGATION
                   * ACCESS TO AGGREGATED (AND ALWAYS LINEARLY SPLICED VIA POINTER DRIVEN
                     OUTPUT ASSEMBLY WITH RESPECT TO CHRONOLOGICALLY COLLECTED METADATA) LOG DATA
                     TRACE FOR ANY PIPED LOG SILO KEY/KEYS PASSED TO CALL OF xxxxx() OR
                     INCLUDED IN PIPED SILO WATCH STRING PASSED INTO CRNRSTN CONSTRUCTOR
                   * MAXIMUM MEMORY AND PROCESSING OVERHEAD

                */

                if(!isset($log_silo_key)){

                    $log_silo_key = '*';

                }

                $tmp_silo_checksum = crc32($log_silo_key);

                if (isset($this->active_silo_ARRAY[$tmp_silo_checksum]) || $this->piped_log_silo_key=='*'){

                    $tmp_oLog = new crnrstn_log($this->getmicrotime(), $log_silo_key);

                    if(is_object($oCRNRSTN_USR)){

                        $this->starttime = $oCRNRSTN_USR->starttime;

                        $tmp_oLog->set_runTime($oCRNRSTN_USR->wallTime());

                    }

                    $tmp_oLog->set_runFile($file);

                    $tmp_oLog->set_classMethod($method);

                    $tmp_oLog->set_lineNumber($line_num);

                    $tmp_str = $str . '';

                    $tmp_oLog->set_logMsg($tmp_str);

                    return $tmp_oLog;

                }

            break;
            default:
                // 0

            break;

        }

        return NULL;

    }

    public function logDebug($str, $line_num=NULL, $method=NULL, $file=NULL, $log_silo_key=NULL, $oCRNRSTN=NULL){

        switch($this->debugMode) {
            case 1:
                //
                // REAL-TIME OUTPUT TO DEFAULT ERROR LOG - SANS SILO SUPPORT
                // NO EXCEPTION LOG TRACE
                $tmp_silo_all = '*';

                if(!isset($log_silo_key) || $log_silo_key == ''){

                    $log_silo_key = '*';

                }

                $tmp_silo_checksum = crc32($log_silo_key);

                if (isset($this->active_silo_ARRAY[crc32($tmp_silo_all)]) || isset($this->active_silo_ARRAY[$tmp_silo_checksum]) || $log_silo_key == '*') {

                    if(is_object($oCRNRSTN)){

                        $tmp_str = "[runtime ". $oCRNRSTN->wallTime().' secs]';

                    }else{

                        $tmp_str = '';

                    }

                    if(!isset($method) || $method==''){

                        if(isset($file)){

                            $tmp_str .= ' [file '.$file.']';

                        }

                    }else{

                        $tmp_str .= ' [method '.$method.']';

                    }

                    if(isset($line_num)){

                        $tmp_str .= ' [linenum '.$line_num.']';

                    }

                    $tmp_str .= ' '.$str;

                    error_log($tmp_str);

                }

            break;
            case 2:
                //
                // LOG AGGREGATION WITHIN CRNRSTN + PASSIVE SILO SUPPORT (MUST CALL METHOD TO ACCESS LOG SILO)
                // RETURN LOG DATA FOR AGGREGATION WITHIN oCRNRSTN_USR AND
                // TO BE EXPOSED UPON EXCEPTION OR MANUALLY THROUGH
                // $output_mode [DEFAULT, SCREEN, EMAIL or FILE]

                /*

                 # $debugMode = 2
                   * 100% LOG TRACE ROLLING AGGREGATION
                   * ACCESS TO AGGREGATED (AND ALWAYS LINEARLY SPLICED VIA POINTER DRIVEN
                     OUTPUT ASSEMBLY WITH RESPECT TO CHRONOLOGICALLY COLLECTED METADATA) LOG DATA
                     TRACE FOR ANY PIPED LOG SILO KEY/KEYS PASSED TO CALL OF xxxxx() OR
                     INCLUDED IN PIPED SILO WATCH STRING PASSED INTO CRNRSTN CONSTRUCTOR
                   * MAXIMUM MEMORY AND PROCESSING OVERHEAD

                */

                if(!isset($log_silo_key)){

                    $log_silo_key = '*';

                }

                $tmp_silo_checksum = crc32($log_silo_key);

                if (isset($this->active_silo_ARRAY[$tmp_silo_checksum]) || $this->piped_log_silo_key=='*'){

                    $tmp_oLog = new crnrstn_log($this->getmicrotime(), $log_silo_key);

                    if(is_object($oCRNRSTN)){

                        $this->starttime = $oCRNRSTN->starttime;

                        $tmp_oLog->set_runTime($oCRNRSTN->wallTime());

                    }

                    $tmp_oLog->set_runFile($file);
                    $tmp_oLog->set_classMethod($method);
                    $tmp_oLog->set_lineNumber($line_num);

                    $tmp_str = $str. '';

                    $tmp_oLog->set_logMsg($tmp_str);

                    return $tmp_oLog;

                }

            break;
            default:
                //
                // 0 = LOGGING DEACTIVATED

            break;

        }

        return NULL;

    }

    public function captureNotice($logSource, $logPriority, $msg, $oLog_output_ARRAY=NULL){
		$tmp_priority = "UNKNOWN";
		$tmp_configserial = "";
		$tmp_key = "";
		if(isset($_SESSION['CRNRSTN_CONFIG_SERIAL'])){
			$tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
			$tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL'];

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

		if(isset($_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"])){
			switch($_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"]){
				case 'EMAIL':
					$tmp_email_ARRAY = explode(",", $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"]);
					$this->emailDataElements['logSource'] = $logSource;
					$this->emailDataElements['logPriority'] = $tmp_priority;
					$this->emailDataElements['msg'] = $msg;

					foreach($tmp_email_ARRAY as $value){
						$this->emailDataElements['addAddressEmail'] = trim($value);

						if($this->buildSimpleMessage($oLog_output_ARRAY, $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_PROFILE"], $logSource)){
							$this->msg_delivery_status = $this->sendSimpleMessage();
						}

						switch($this->msg_delivery_status){
							case 'success':

								//
								// GOOD JOB
							break;
							default:

								//
								// ERROR SENDING EMAIL. LOG TO DEFAULT SYS.
								error_log('Email send to '.$this->emailDataElements['addAddressEmail'].' :: FAIL. Email output dump-> Source: '.$this->emailDataElements['logSource'].'|| Priority: '.$this->emailDataElements['logPriority'].'|| Message: '.$this->emailDataElements['msg']);

                            break;

						}

						unset($this->msg_delivery_status);

					}

				break;
                case 'SCREEN':
				case 'SCREEN_HTML':
					print "<br><div style=\"font-family: Arial,Helvetica,sans-serif; font-size: 11px; font-weight: bold;\">".$this->getmicrotime()." secs<br>";
					print $logSource;
					print "<br>";
					print $tmp_priority;
					print "<br>";
					print $msg;
                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'SCREEN_HTML', $logSource);
                    print "</div>";
				break;
                case 'SCREEN_HTML_HIDDEN':
                    print "<!-- 
                    ".$this->getmicrotime()." secs
";
                    print $logSource;
                    print "
";
                    print $tmp_priority;
                    print "
";
                    print $msg;
                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'SCREEN_HTML_HIDDEN',$logSource);

                break;
                case 'SCREEN_TEXT':
                    print $this->getmicrotime()." secs
";
                    print $logSource;
                    print "
";
                    print $tmp_priority;
                    print "
";
                    print $msg;
                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'SCREEN_TEXT', $logSource);

                break;
                case 'FILE':
                    if(isset($oLog_output_ARRAY)){

                        $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'FILE', $logSource);

                    }

					$tmp_file_path = $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];

					//
					// YOU CAN CUSTOMIZE THE FORMAT OF THIS LOGGING OUTPUT
					$logDataToWrite = $this->getmicrotime().' [runtime '.$this->wallTime().']'.' [method '.$logSource.'] [priority '.$tmp_priority.'] '.$msg.'
';

					$fp = fopen($tmp_file_path, 'a');
					fwrite($fp, $logDataToWrite);
					fclose($fp);

                break;
				default:

                    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'DEFAULT', $logSource);
                    error_log('[runtime '.$this->wallTime().']'.' [owner '.$this->objectOwner_key.']'.' [method '.$logSource.'] [priority '.$tmp_priority.'] '.$msg);

                break;
			}

		}else{

			//
			// PROBABLY CRNRSTN INITIALIZATION ERROR. JUST LOG.
            $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, 'DEFAULT', $logSource);
            error_log('[runtime '.$this->wallTime().'] [owner '.$this->objectOwner_key.']'.' [method '.$logSource.'] [priority '.$tmp_priority.'] '.$msg);

		}

		return true;

	}

	private function return_requestSourceStr($line_num, $method, $file, $logSource){

        $str = '';

        if(isset($logSource) && $logSource!=''){

            $str .= $logSource;

        }else{

            # class::method at line ###
            # line ### within /filepath/

            if(isset($method) && $method!=''){

                $str .= $method;

                if(isset($line_num) && $line_num!=''){

                    $str .= ' at line number '.$line_num;

                }else{

                    if(isset($file) && $file!=''){

                        $str .= ' within the file ['.$file.']';

                    }

                }

            }else{

                if(isset($file) && $file!=''){

                    if(isset($line_num) && $line_num!=''){

                        $str .= 'Line number '.$line_num.' within the file ['.$file.']';

                    }else{

                        $str .= 'The file ['.$file.']';

                    }

                }else{

                    if(isset($line_num) && $line_num!=''){

                        $str .= 'Line number '.$line_num.' of an unknown script on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')';

                    }else{

                        $str .= 'An unknown script source on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')';

                    }

                }

            }

        }

        return $str;

    }

    private function return_auth_oLog($tmp_full_out, $tmp_silo_auth_ARRAY, $oCRNRSTN_USR){

        $oLog_possible_output_ARRAY = $oCRNRSTN_USR->oLog_output_ARRAY;

        if($tmp_full_out || $tmp_silo_auth_ARRAY==NULL){

            $tmp_oLog_authorized_ARRAY = $oLog_possible_output_ARRAY;

        }else{

            $tmp_oLog_authorized_ARRAY = array();
            $tmp_oLog_cnt = sizeof($oLog_possible_output_ARRAY);

            for($i=0; $i<$tmp_oLog_cnt; $i++){

                $tmp_oLog = $oLog_possible_output_ARRAY[$i];

                if(is_object($tmp_oLog)){

                    $tmp_oLog_silo_key = $tmp_oLog->get_siloKey();

                    if(isset($tmp_silo_auth_ARRAY[$tmp_oLog_silo_key])){

                        $tmp_oLog_authorized_ARRAY[] = $tmp_oLog;

                    }
                }
            }
        }

        return $tmp_oLog_authorized_ARRAY;

    }

	private function prepare_oLogOut($channel, $log_silo_keys_pipe, $line_num, $method, $file, $logSource, $oLog_output_ARRAY, $oCRNRSTN_USR){

        $tmp_request_source = $this->return_requestSourceStr($line_num, $method, $file, $logSource);

        if(isset($oLog_output_ARRAY)){

            $tmp_auth_oLog_ARRAY = $oLog_output_ARRAY;

        }else{

            $tmp_silo_ARRAY = explode('|', $log_silo_keys_pipe);
            $tmp_authorized_silo_cnt = sizeof($tmp_silo_ARRAY);
            if(in_array('*', $tmp_silo_ARRAY) || ($tmp_authorized_silo_cnt == 1 && $tmp_silo_ARRAY[0] == '') || $tmp_authorized_silo_cnt == 0){
                //
                // OUTPUT ALL oLog
                $tmp_full_out = true;
                $tmp_silo_auth_ARRAY = NULL;

            }else{

                $tmp_full_out = false;

                //
                // LOOK TO OUTPUT SUBSET OF SILO DATA
                for($i=0; $i<$tmp_authorized_silo_cnt; $i++){

                    $tmp_silo_auth_ARRAY[$tmp_silo_ARRAY[$i]] = 1;

                }
            }

            $tmp_auth_oLog_ARRAY = $this->return_auth_oLog($tmp_full_out, $tmp_silo_auth_ARRAY, $oCRNRSTN_USR);

        }

        switch($channel){
            case 'EMAIL':

                $tmp_log_to_email_array = array();
                $tmp_log_to_email_array['text'] = '';
                $tmp_log_to_email_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';
                $tmp_log_to_email_array['html'] = '';
                $tmp_log_to_email_array['html'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'<br>';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){

                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKey();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;
                        $tmp_transactionTime_ARRAY['html'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [runtime '.$tmp_runTime.']';
                        $tmp_runTime_ARRAY['html'] = ' [runtime '.$tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [method '.$tmp_classMethod_raw.']';
                                $tmp_classMethodFile_ARRAY['html'] = ' [method '.$tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';
                                        $tmp_classMethodFile_ARRAY['html'] = ' [file '.$tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';
                                        $tmp_classMethodFile_ARRAY['html'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';
                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }
                            }

                        }else{

                            if(isset($tmp_runFile_raw)){
                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';
                                    $tmp_classMethodFile_ARRAY['html'] = ' [file '.$tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';
                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';
                                $tmp_classMethodFile_ARRAY['html'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [linenum '.$tmp_lineNumber_raw.']';
                                $tmp_lineNumber_ARRAY['html'] = ' [linenum '.$tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';
                                $tmp_lineNumber_ARRAY['html'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';
                            $tmp_lineNumber_ARRAY['html'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' '.$tmp_logMsg_raw.'
';
                            $tmp_logMsg_ARRAY['html'] = ' '.$tmp_logMsg_raw.'<br>';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';
                            $tmp_logMsg_ARRAY['html'] = '<br>';

                        }

                        $tmp_log_to_email_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                        $tmp_log_to_email_array['html'] .= '<span style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; padding-left:10px;">'.
                            $tmp_transactionTime_ARRAY['html'].
                            $tmp_runTime_ARRAY['html'].
                            $tmp_classMethodFile_ARRAY['html'].
                            $tmp_lineNumber_ARRAY['html'].
                            $tmp_logMsg_ARRAY['html'].'</span>';

                    }
                }

                $tmp_log_to_email_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';
                $tmp_log_to_email_array['html'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'<br>';

                return $tmp_log_to_email_array;

            break;
            case 'FILE':

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);

                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKey();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [runtime '.$tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [method '.$tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){

                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [linenum '.$tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' '.$tmp_logMsg_raw.'
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                    }
                }

                $tmp_log_to_errorlog_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                return $tmp_log_to_errorlog_array;

            break;
            case 'SCREEN_TEXT':

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = '';
                $tmp_log_to_errorlog_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKey();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [runtime '.$tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){

                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [method '.$tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }
                            }

                        }else{

                            if(isset($tmp_runFile_raw)){

                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [linenum '.$tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' '.$tmp_logMsg_raw.'
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                    }
                }

                $tmp_log_to_errorlog_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                return $tmp_log_to_errorlog_array;

            break;
            case 'SCREEN':
            case 'SCREEN_HTML':

                $tmp_log_to_screen_array = array();
                $tmp_log_to_screen_array['html'] = '';
                $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; padding:10px 0 0 5px; line-height: 15px;">BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'</div>';
                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKey();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['html'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['html'] = ' [runtime '.$tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['html'] = ' [method '.$tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['html'] = ' [file '.$tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['html'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }
                            }

                        }else{

                            if(isset($tmp_runFile_raw)){
                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['html'] = ' [file '.$tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['html'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['html'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['html'] = ' [linenum '.$tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['html'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['html'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['html'] = ' '.$tmp_logMsg_raw.'<br>';

                        }else{

                            $tmp_logMsg_ARRAY['html'] = '<br>';

                        }

                        $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; padding-left:10px; line-height: 17px;">'.
                            $tmp_transactionTime_ARRAY['html'].
                            $tmp_runTime_ARRAY['html'].
                            $tmp_classMethodFile_ARRAY['html'].
                            $tmp_lineNumber_ARRAY['html'].
                            $tmp_logMsg_ARRAY['html'].'</div>';

                    }
                }

                $tmp_log_to_screen_array['html'] .= '<div style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; padding:0 0 5px 5px; line-height: 15px;">END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'</div>';
                return $tmp_log_to_screen_array;

            break;
            case 'SCREEN_HTML_HIDDEN':

                $tmp_log_to_html_hidden_array = array();
                $tmp_log_to_html_hidden_array['text'] = '';
                $tmp_log_to_html_hidden_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKey();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [runtime '.$tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [method '.$tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }

                        }else{

                            if(isset($tmp_runFile_raw)){
                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [linenum '.$tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }
                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' '.$tmp_logMsg_raw.'
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_html_hidden_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];

                    }
                }

                $tmp_log_to_html_hidden_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                 return $tmp_log_to_html_hidden_array;

            break;
            default:
                //
                // DEFAULT
                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                if($tmp_log_cnt<1){

                    return NULL;

                }

                $tmp_log_to_errorlog_array = array();
                $tmp_log_to_errorlog_array['text'] = '';
                $tmp_log_to_errorlog_array['text'] .= 'BEGIN LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';

                $tmp_log_cnt = sizeof($tmp_auth_oLog_ARRAY);
                for($i=0; $i<$tmp_log_cnt; $i++) {

                    $tmp_oLog = $tmp_auth_oLog_ARRAY[$i];

                    if(is_object($tmp_oLog)){
                        //
                        // WE HAVE A VALID LOG FOR WHICH TO PREPARE OUTPUT
                        //$tmp_silo_key = $tmp_oLog->get_siloKey();
                        $tmp_transactionTime = $tmp_oLog->get_transactionTime();
                        $tmp_runTime = $tmp_oLog->get_runTime();

                        $tmp_runFile_raw = $tmp_oLog->get_runFile();
                        $tmp_classMethod_raw = $tmp_oLog->get_classMethod();
                        $tmp_lineNumber_raw = $tmp_oLog->get_lineNumber();
                        $tmp_logMsg_raw = $tmp_oLog->get_logMsg();

                        $tmp_transactionTime_ARRAY = array();
                        $tmp_runTime_ARRAY = array();
                        $tmp_classMethodFile_ARRAY = array();
                        $tmp_lineNumber_ARRAY = array();
                        $tmp_logMsg_ARRAY = array();

                        $tmp_transactionTime_ARRAY['text'] = $tmp_transactionTime;

                        $tmp_runTime_ARRAY['text'] = ' [runtime '.$tmp_runTime.']';

                        if(isset($tmp_classMethod_raw)){
                            if($tmp_classMethod_raw != ''){

                                $tmp_classMethodFile_ARRAY['text'] = ' [method '.$tmp_classMethod_raw.']';

                            }else{

                                if(isset($tmp_runFile_raw)){
                                    if($tmp_runFile_raw != ''){

                                        $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                    }else{

                                        $tmp_classMethodFile_ARRAY['text'] = '';

                                    }

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }
                            }

                        }else{

                            if(isset($tmp_runFile_raw)){
                                if($tmp_runFile_raw != ''){

                                    $tmp_classMethodFile_ARRAY['text'] = ' [file '.$tmp_runFile_raw.']';

                                }else{

                                    $tmp_classMethodFile_ARRAY['text'] = '';

                                }

                            }else{

                                $tmp_classMethodFile_ARRAY['text'] = '';

                            }

                        }

                        if(isset($tmp_lineNumber_raw)){

                            if($tmp_lineNumber_raw != ''){

                                $tmp_lineNumber_ARRAY['text'] = ' [linenum '.$tmp_lineNumber_raw.']';

                            }else{

                                $tmp_lineNumber_ARRAY['text'] = '';

                            }

                        }else{

                            $tmp_lineNumber_ARRAY['text'] = '';

                        }

                        if(isset($tmp_logMsg_raw)){

                            $tmp_logMsg_ARRAY['text'] = ' '.$tmp_logMsg_raw.'
';

                        }else{

                            $tmp_logMsg_ARRAY['text'] = '
';

                        }

                        $tmp_log_to_errorlog_array['text'] .= $tmp_transactionTime_ARRAY['text'].
                            $tmp_runTime_ARRAY['text'].
                            $tmp_classMethodFile_ARRAY['text'].
                            $tmp_lineNumber_ARRAY['text'].
                            $tmp_logMsg_ARRAY['text'];


                    }
                }
                $tmp_log_to_errorlog_array['text'] .= 'END LOG OUTPUT OF ACTIVITY FROM REQUESTING SOURCE :: '.$tmp_request_source.'
';
                return $tmp_log_to_errorlog_array;

            break;

        }

    }

	public function get_errorLogTrace($loggingProfile, $filePath_or_email_override, $log_silo_keys_pipe, $line_num, $method, $file, $oCRNRSTN_USR){

        # IF CRNRSTN CONSTRUCT HAS SILO LIMITS...POSSIBLE THIS METHOD COULD REQUEST NON-EXISTENT
        # SILO LOG DATA..JUST SEND THIS REALIZATION AS PART OF THE OUTPUT TO CHANNEL
        # [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
        try{

            $tmp_output_log_ARRAY = $this->prepare_oLogOut($loggingProfile, $log_silo_keys_pipe, $line_num, $method, $file, NULL, NULL, $oCRNRSTN_USR);

            switch($loggingProfile){
                case 'EMAIL':
                    # $tmp_output_log_ARRAY['text']
                    # $tmp_output_log_ARRAY['html']

                break;
                case 'FILE':
                    # $tmp_output_log_ARRAY['text']

                    if(isset($filePath_or_email_override)){
                        //
                        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                        if($fp = fopen($filePath_or_email_override, 'a')){

                            fwrite($fp, $tmp_output_log_ARRAY['text']);
                            fclose($fp);

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to locate the provided path or open/create file for writing only (i.e. append) at filepath="'.$filePath_or_email_override.'".');

                        }

                    }else{

                        $tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
                        $tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL'];

                        $tmp_file_path = $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];

                        //
                        // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                        if($fp = fopen($tmp_file_path, 'a')){

                            fwrite($fp, $tmp_output_log_ARRAY['text']);
                            fclose($fp);

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to locate the provided path or open/create file for writing (i.e. append) at filepath="'.$tmp_file_path.'".');

                        }
                    }

                break;
                case 'SCREEN_TEXT':
                    # $tmp_output_log_ARRAY['text']

                    print_r($tmp_output_log_ARRAY['text']);

                break;
                case 'SCREEN':
                case 'SCREEN_HTML':
                    # $tmp_output_log_ARRAY['html']

                    //echo htmlspecialchars(print_r($tmp_output_log_ARRAY['html']));
                    print_r($tmp_output_log_ARRAY['html']);


                break;
                case 'SCREEN_HTML_HIDDEN':
                    # $tmp_output_log_ARRAY['text']

                    print_r('
<!--
                     
'.$tmp_output_log_ARRAY['text'].'
-->
');
                break;
                default:
                    //
                    // DEFAULT
                    # $tmp_output_log_ARRAY['text']
                    if(isset($tmp_output_log_ARRAY['text']) && $tmp_output_log_ARRAY['text']!=''){

                        error_log($tmp_output_log_ARRAY['text']);

                    }

                break;
            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_WARNING, $e->getMessage(), $oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

	private function compile_log_output($oLog_output_ARRAY, $loggingProfile, $logSource){

        $tmp_output_log_ARRAY = $this->prepare_oLogOut($loggingProfile, NULL, NULL, NULL, NULL, $logSource, $oLog_output_ARRAY, NULL);

        switch($loggingProfile){
            case 'EMAIL':
                # $tmp_output_log_ARRAY['text']
                # $tmp_output_log_ARRAY['html']

                return $tmp_output_log_ARRAY;

            break;
            case 'FILE':
                # $tmp_output_log_ARRAY['text']

                if(isset($filePath_or_email_override)){
                    //
                    // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                    if($fp = fopen($filePath_or_email_override, 'a')){

                        fwrite($fp, $tmp_output_log_ARRAY['text']);
                        fclose($fp);

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to locate the provided path or open/create file for writing only (i.e. append) at filepath="'.$filePath_or_email_override.'".');

                    }

                }else{

                    $tmp_key = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_RESOURCE_KEY'];
                    $tmp_configserial = $_SESSION['CRNRSTN_CONFIG_SERIAL'];

                    $tmp_file_path = $_SESSION["CRNRSTN_".crc32($tmp_configserial)]["CRNRSTN_".$tmp_key]["_CRNRSTN_LOG_ENDPOINT"];

                    //
                    // VALIDATE FILE PATH ON FILE OPEN FOR APPEND
                    if($fp = fopen($tmp_file_path, 'a')){

                        fwrite($fp, $tmp_output_log_ARRAY['text']);
                        fclose($fp);

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to locate the provided path or open/create file for writing (i.e. append) at filepath="'.$tmp_file_path.'".');

                    }
                }

            break;
            case 'SCREEN_TEXT':
                # $tmp_output_log_ARRAY['text']

                print_r($tmp_output_log_ARRAY['text']);

            break;
            case 'SCREEN':
            case 'SCREEN_HTML':
                # $tmp_output_log_ARRAY['html']

                echo htmlspecialchars(print_r($tmp_output_log_ARRAY['html']));

            break;
            case 'SCREEN_HTML_HIDDEN':
                # $tmp_output_log_ARRAY['text']

                echo htmlspecialchars(print_r('<!-- 
'.$tmp_output_log_ARRAY['text'].'
-->'));
            break;
            default:
                //
                // DEFAULT
                # $tmp_output_log_ARRAY['text']
                if(isset($tmp_output_log_ARRAY['text']) && $tmp_output_log_ARRAY['text']!=''){

                    error_log($tmp_output_log_ARRAY['text']);

                }

            break;
            }

        return NULL;

    }

	private function buildSimpleMessage($oLog_output_ARRAY, $loggingProfile, $logSource){

	    if($this->log_output == ''){

            $this->log_output = '** The CRNRSTN configuration file debug mode of "'.$this->debugMode.'" prevents aggregation of log trace data. **';

        }

	    $tmp_log_output_ARRAY = $this->compile_log_output($oLog_output_ARRAY, $loggingProfile, $logSource);

		$this->emailDataElements['subject'] = 'CRNRSTN Suite :: logging notification captured on '.$_SERVER['SERVER_NAME'];
		$this->emailDataElements['text'] = 'This is a triggered logging notification from the CRNRSTN Suite ::.

Information about this notice:
- - - - - - - - - - - - - - - - - - - -
Source: '.$this->emailDataElements['logSource'].'
Priority: '.$this->emailDataElements['logPriority'].'
Message: 
'.$this->emailDataElements['msg'].'

- - - - - - - - - - - - - - - - - - - - START LOG TRACE
'.$tmp_log_output_ARRAY['text'].'
- - - - - - - - - - - - - - - - - - - - END LOG TRACE

Sending IP Address: '.$_SERVER['REMOTE_ADDR'].' ('.$_SERVER['SERVER_NAME'].')
System Timestamp: '.$this->getmicrotime().' 
Runtime: '.$this->wallTime().' seconds

Please note that this information has 
not been saved anywhere. You may want 
to keep this email for your records.

This email was sent to '.$this->emailDataElements['addAddressEmail'].'. 
If you wish to unsubscribe from future 
system notifications, please contact the 
website administrator.

';

		$this->emailDataElements['headers']  = "From: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME']." >\n";
		$this->emailDataElements['headers'] .= "X-Sender: System Notice < crnrstn_noreply@".$_SERVER['SERVER_NAME']." >\n";
		$this->emailDataElements['headers'] .= 'X-Mailer: PHP/' . phpversion();
		$this->emailDataElements['headers'] .= "X-Priority: 1\n"; // Urgent message!
		$this->emailDataElements['headers'] .= "Return-Path: crnrstn_noreply@".$_SERVER['SERVER_NAME']."\n";
		$this->emailDataElements['headers'] .= "Reply-To: crnrstn_noreply@".$_SERVER['SERVER_NAME']."\n";// Return path for errors
		$this->emailDataElements['headers'] .= "MIME-Version: 1.0\r\n";
		$this->emailDataElements['headers'] .= "Content-Type: text/plain; charset=UTF-8\n";

		return true;

	}

	private function sendSimpleMessage(){
		if(mail($this->emailDataElements['addAddressEmail'], $this->emailDataElements['subject'], $this->emailDataElements['text'], $this->emailDataElements['headers'])){

			return "success";
		}else{

			return "mailsend error";
		}

	}

	public function returnMicroTime(){

        return $this->getmicrotime();

    }

	//
	// METHOD TAKEN FROM NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
	/**
    * returns the time in ODBC canonical form with microseconds
    *
    * @return string The time in ODBC canonical form with microseconds
    * @access public
    */
	private function getmicrotime() {
		if (function_exists('gettimeofday')) {
			$tod = gettimeofday();
			$sec = $tod['sec'];
			$usec = $tod['usec'];
		} else {
			$sec = time();
			$usec = 0;
		}
		return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);
	}

    private function wallTime(){

	    if(isset($_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_START_TIME'])){

            $this->starttime = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_START_TIME'];

        }

        $timediff = $this->microtime_float() - $this->starttime;

        //return substr($timediff,0,-8);
        return $timediff;

    }

    //
    // SOURCE :: http://www.php.net/manual/en/function.microtime.php
    private function microtime_float(){

        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);

    }

	public function __destruct() {

	}
}



# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_log_output_manager
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: Mon September 9, 2020 @ 2340hrs

class crnrstn_log_output_manager {

    protected $oLogger;
    private static $oCRNRSTN_USR;

    public function __construct($oCRNRSTN_USR) {

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

    }

    public function return_log_trace_output_str($outputProfile){

        //
        // RETURN LOG TRACE STRING
        switch($outputProfile) {
            case 'EMAIL_HTML':

                return $this->return_log_str_EMAIL_HTML();

            break;
            case 'EMAIL_TEXT':

                return $this->return_log_str_EMAIL_TEXT();

            break;
            case 'FILE':

                return $this->return_log_str_FILE();

            break;
            case 'SCREEN_TEXT':

                return $this->return_log_str_SCREEN_TEXT();

            break;
            case 'SCREEN':
            case 'SCREEN_HTML':

                return $this->return_log_str_SCREEN_HTML();

            break;
            case 'SCREEN_HTML_HIDDEN':

                return $this->return_log_str_SCREEN_HTML(false);

            break;
            default:

                return $this->return_log_str_ERROR_LOG();

            break;
        }

    }

    private function chunkStringData($str, $max_len){

        //
        // SOURCE :: https://www.php.net/manual/en/function.preg-split.php
        // AUTHOR :: (canadian dot in dot exile at gmail dot com) https://www.php.net/manual/en/function.preg-split.php#118326
        // "word-wrap" at, for example, 60 characters or less

        // this regular expression will split $long_string on any sub-string of
        // 1-or-more non-word characters (spaces or punctuation)
        if(preg_match_all("/.{1,{$max_len}}(?=\W+)/", $str, $lines) !== False) {

            return $lines[0];

        }

        return false;

    }

    private function return_HTML_EMAIL_chunk_ARRAY($str, $chunkSize){

        $tmp_str_array = array();
        $tmp_str_array[1] = '';
        $tmp_str_out_array = $this->chunkStringData($str, $chunkSize);

        $tmp_out_str_1 = '';

        //
        // RETURN ARRAY[0] = CHUNK SIZE AND ARRAY[1] = EVERYTHING ELSE
        $tmp_chunk_cnt = sizeof($tmp_str_out_array);
        for($i=0; $i<$tmp_chunk_cnt; $i++){

            if($i == 0){

                $tmp_out_str_0 = $tmp_str_out_array[$i];

            }else{

                $tmp_out_str_1 .= $tmp_str_out_array[$i];

            }

        }

        $tmp_str_array[0] = $tmp_out_str_0;
        $tmp_str_array[1] = $tmp_out_str_1;

        return $tmp_str_array;

    }

    private function return_log_str_EMAIL_HTML(){

        //
        // BUILD LOG TRACE STRING FOR HTML EMAIL
        $tmp_msg = '';
        foreach(self::$oCRNRSTN_USR->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)){

                //
                // GET LOG DATA - FIXED LENGTH
                $tmp_transactionTime = $oLog->get_transactionTime();

                $tmp_runTime = $oLog->get_runTime();
                $tmp_runTime = '[runtime '.$tmp_runTime.' secs]';

                //
                // GET LOG DATA - VARIABLE LENGTH (CHUNK TO EMAIL MAX CHAR WIDTH)
                $tmp_chunkstr_raw = '';
                $tmp_classMethod_raw = trim($oLog->get_classMethod());

                if($tmp_classMethod_raw == ''){

                    $tmp_runFile_raw = $oLog->get_runFile();
                    if($tmp_runFile_raw!=''){

                        $tmp_chunkstr_raw .= '[file '.$tmp_runFile_raw.']';

                    }

                }else{
                    if($tmp_classMethod_raw!='') {

                        $tmp_chunkstr_raw .= '[method ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                if($tmp_lineNumber_raw!='') {

                    $tmp_chunkstr_raw .= ' [linenum ' . $tmp_lineNumber_raw . '] ';

                }

                $tmp_logMsg_raw = $oLog->get_logMsg();
                $tmp_chunkstr_raw .= $tmp_logMsg_raw;


                //
                //  PREP CHUNK AND MAIN
                $tmp_HTML_chunk_output_ARRAY = $this->return_HTML_EMAIL_chunk_ARRAY($tmp_chunkstr_raw, 50);

                //self::$oCRNRSTN_USR->error_log('2294 - '.$tmp_HTML_chunk_output_ARRAY[0]);
                //self::$oCRNRSTN_USR->error_log('2295 - '.$tmp_HTML_chunk_output_ARRAY[1]);

                //
                // ADD OBJECT DATA TO OUTPUT STR
                $tmp_msg .= '<tr>
                                <td align="left" style="text-align: left;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:20px; border-top: 2px solid #FFF;"><span style="color: #000; font-weight: bold;">'.$tmp_transactionTime.'</span></div></td>
                                <td align="left" style="text-align: left;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:18px; border-bottom: 0px solid #FFF;"><span style="color: #FF0000; line-height: 20px;">'.$tmp_runTime.'</span></div></td>
                                <td align="left" style="text-align: left;"><div style="text-align: left; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:18px; border-bottom: 0px solid #FFF;"><span style="line-height: 20px;">'.$tmp_HTML_chunk_output_ARRAY[0].'</span></div></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="left" style="text-align: left;"><div style="text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:16px; border-bottom: 6px solid #FFF;"><span style="line-height: 20px;">'.$tmp_HTML_chunk_output_ARRAY[1].'</span></div></td>
                            </tr>';

            }

        }

        $tmp_condition='';
        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (self::$oCRNRSTN_USR->log_silo_key_piped != '') {

                $pipe_pos = stripos(self::$oCRNRSTN_USR->log_silo_key_piped, "|");

                if ($pipe_pos !== false) {

                    $tmp_silo_str = '';
                    $tmp_silo_array = explode('|', self::$oCRNRSTN_USR->log_silo_key_piped);
                    $tmp_cnt = sizeof($tmp_silo_array);
                    for ($i = 0; $i < $tmp_cnt; $i++) {
                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
                    }

                    //
                    // STRIP TRAILING AND
                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');

                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo of "' . self::$oCRNRSTN_USR->log_silo_key_piped . '" seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                }

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#FF0000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_USR->debugMode < 2) {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

            $tmp_msg = '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px;">'.$tmp_msg.'</div>';

        }

        //
        // RETURN LOG TRACE STRING FOR HTML EMAIL
        return $tmp_msg;

    }

    private function return_log_str_EMAIL_TEXT(){

        //
        // BUILD LOG TRACE STRING FOR TEXT EMAIL
        $tmp_msg = '';
        foreach(self::$oCRNRSTN_USR->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)) {

                //
                // GET LOG DATA - FIXED LENGTH
                $tmp_msg .=  $oLog->get_transactionTime();

                $tmp_runTime = $oLog->get_runTime();
                $tmp_msg .= ' [runtime '.$tmp_runTime.' secs]';

                //
                // GET LOG DATA - VARIABLE LENGTH
                $tmp_classMethod_raw = trim($oLog->get_classMethod());

                if($tmp_classMethod_raw == ''){

                    $tmp_runFile_raw = $oLog->get_runFile();
                    if($tmp_runFile_raw!=''){

                        $tmp_msg .= ' [file '.$tmp_runFile_raw.']';

                    }

                }else{

                    if($tmp_classMethod_raw!='') {

                        $tmp_msg .= ' [method ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                if($tmp_lineNumber_raw!='') {

                    $tmp_msg .= ' [linenum ' . $tmp_lineNumber_raw . '] ';

                }

                $tmp_logMsg_raw = $oLog->get_logMsg();
                $tmp_msg .= $tmp_logMsg_raw . '

';
            }
        }

        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (self::$oCRNRSTN_USR->log_silo_key_piped != '') {

                $pipe_pos = stripos(self::$oCRNRSTN_USR->log_silo_key_piped, "|");

                if ($pipe_pos !== false) {
                    $tmp_silo_str = '';
                    $tmp_silo_array = explode('|', self::$oCRNRSTN_USR->log_silo_key_piped);
                    $tmp_cnt = sizeof($tmp_silo_array);
                    for ($i = 0; $i < $tmp_cnt; $i++) {
                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
                    }

                    //
                    // STRIP TRAILING AND
                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');

                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced CRNRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo of "' . self::$oCRNRSTN_USR->log_silo_key_piped . '" seems to have reduced CRNRSTN :: trace output activity to NULL';

                }

            } else {

                $tmp_condition = ' but, there appears to be no CRNRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_USR->debugMode < 2) {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }
        }

        //
        // RETURN LOG TRACE STRING FOR TEXT EMAIL
        return $tmp_msg;

    }

    private function return_log_str_SCREEN_HTML($visible=true){

        //
        // RETURN LOG TRACE STRING FOR SCREEN|SCREEN_HTML|SCREEN_HTML_HIDDEN HTML OUTPUT

        $tmp_msg = '';

        foreach(self::$oCRNRSTN_USR->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)){

                //
                // GET LOG DATA
                $tmp_transactionTime = $oLog->get_transactionTime();
                $tmp_runTime = $oLog->get_runTime();

                $tmp_runFile_raw = $oLog->get_runFile();
                $tmp_classMethod_raw = $oLog->get_classMethod();
                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                $tmp_logMsg_raw = $oLog->get_logMsg();

                //
                // BUILD OUTPUT


                $tmp_msg .= $tmp_logMsg_raw.'<br>';

            }

        }

        $tmp_condition='';
        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (self::$oCRNRSTN_USR->log_silo_key_piped != '') {

                $pipe_pos = stripos(self::$oCRNRSTN_USR->log_silo_key_piped, "|");

                if ($pipe_pos !== false) {

                    $tmp_silo_str = '';
                    $tmp_silo_array = explode('|', self::$oCRNRSTN_USR->log_silo_key_piped);
                    $tmp_cnt = sizeof($tmp_silo_array);
                    for ($i = 0; $i < $tmp_cnt; $i++) {
                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
                    }

                    //
                    // STRIP TRAILING AND
                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');

                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo of "' . self::$oCRNRSTN_USR->log_silo_key_piped . '" seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                }

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#FF0000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_USR->debugMode < 2) {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

        }

        //
        // RETURN LOG TRACE STRING FOR HTML EMAIL
        return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px;">'.$tmp_msg.'</div>';


    }

    private function return_log_str_SCREEN_TEXT(){

        //
        // RETURN LOG TRACE STRING FOR BASIC SCREEN TEXT OUTPUT

        $tmp_msg = '';

        foreach(self::$oCRNRSTN_USR->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)){

                //
                // GET LOG DATA
                $tmp_transactionTime = $oLog->get_transactionTime();
                $tmp_runTime = $oLog->get_runTime();

                $tmp_runFile_raw = $oLog->get_runFile();
                $tmp_classMethod_raw = $oLog->get_classMethod();
                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                $tmp_logMsg_raw = $oLog->get_logMsg();

                //
                // BUILD OUTPUT


                $tmp_msg .= $tmp_logMsg_raw.'<br>';

            }

        }

        $tmp_condition='';
        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (self::$oCRNRSTN_USR->log_silo_key_piped != '') {

                $pipe_pos = stripos(self::$oCRNRSTN_USR->log_silo_key_piped, "|");

                if ($pipe_pos !== false) {

                    $tmp_silo_str = '';
                    $tmp_silo_array = explode('|', self::$oCRNRSTN_USR->log_silo_key_piped);
                    $tmp_cnt = sizeof($tmp_silo_array);
                    for ($i = 0; $i < $tmp_cnt; $i++) {
                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
                    }

                    //
                    // STRIP TRAILING AND
                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');

                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo of "' . self::$oCRNRSTN_USR->log_silo_key_piped . '" seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                }

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#FF0000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_USR->debugMode < 2) {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

        }

        //
        // RETURN LOG TRACE STRING FOR HTML EMAIL
        return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px;">'.$tmp_msg.'</div>';


    }

    private function return_log_str_ERROR_LOG(){

        //
        // RETURN LOG TRACE STRING FOR PHP ERROR_LOG PARAMETER
        $tmp_msg = '';
        foreach(self::$oCRNRSTN_USR->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)) {

                //
                // GET LOG DATA - FIXED LENGTH
                $tmp_msg .=  $oLog->get_transactionTime();

                $tmp_runTime = $oLog->get_runTime();
                $tmp_msg .= ' [runtime '.$tmp_runTime.' secs]';

                //
                // GET LOG DATA - VARIABLE LENGTH
                $tmp_classMethod_raw = trim($oLog->get_classMethod());

                if($tmp_classMethod_raw == ''){

                    $tmp_runFile_raw = $oLog->get_runFile();
                    if($tmp_runFile_raw!=''){

                        $tmp_msg .= ' [file '.$tmp_runFile_raw.']';

                    }

                }else{

                    if($tmp_classMethod_raw!='') {

                        $tmp_msg .= ' [method ' . $tmp_classMethod_raw . ']';

                    }

                }

                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                if($tmp_lineNumber_raw!='') {

                    $tmp_msg .= ' [linenum ' . $tmp_lineNumber_raw . '] ';

                }

                $tmp_logMsg_raw = $oLog->get_logMsg();
                $tmp_msg .= $tmp_logMsg_raw . '

';
            }
        }

        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (self::$oCRNRSTN_USR->log_silo_key_piped != '') {

                $pipe_pos = stripos(self::$oCRNRSTN_USR->log_silo_key_piped, "|");

                if ($pipe_pos !== false) {
                    $tmp_silo_str = '';
                    $tmp_silo_array = explode('|', self::$oCRNRSTN_USR->log_silo_key_piped);
                    $tmp_cnt = sizeof($tmp_silo_array);
                    for ($i = 0; $i < $tmp_cnt; $i++) {
                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
                    }

                    //
                    // STRIP TRAILING AND
                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');

                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced CRNRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo of "' . self::$oCRNRSTN_USR->log_silo_key_piped . '" seems to have reduced CRNRSTN :: trace output activity to NULL';

                }

            } else {

                $tmp_condition = ' but, there appears to be no CRNRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_USR->debugMode < 2) {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }
        }

        //
        // RETURN LOG TRACE STRING FOR TEXT EMAIL
        return $tmp_msg;

    }

    private function return_log_str_FILE(){

        //
        // RETURN LOG TRACE STRING FOR CUSTOM FILE OUTPUT

        $tmp_msg = '';

        foreach(self::$oCRNRSTN_USR->oLog_output_ARRAY as $key=>$oLog){

            if(is_object($oLog)){

                //
                // GET LOG DATA
                $tmp_transactionTime = $oLog->get_transactionTime();
                $tmp_runTime = $oLog->get_runTime();

                $tmp_runFile_raw = $oLog->get_runFile();
                $tmp_classMethod_raw = $oLog->get_classMethod();
                $tmp_lineNumber_raw = $oLog->get_lineNumber();
                $tmp_logMsg_raw = $oLog->get_logMsg();

                //
                // BUILD OUTPUT
                $tmp_msg .= $tmp_logMsg_raw.'<br>';

            }

        }

        $tmp_condition='';
        $tmp_msg = trim($tmp_msg);
        if(strlen($tmp_msg)<5) {

            if (self::$oCRNRSTN_USR->log_silo_key_piped != '') {

                $pipe_pos = stripos(self::$oCRNRSTN_USR->log_silo_key_piped, "|");

                if ($pipe_pos !== false) {

                    $tmp_silo_str = '';
                    $tmp_silo_array = explode('|', self::$oCRNRSTN_USR->log_silo_key_piped);
                    $tmp_cnt = sizeof($tmp_silo_array);
                    for ($i = 0; $i < $tmp_cnt; $i++) {
                        $tmp_silo_str .= $tmp_silo_array[$i] . ' and ';
                    }

                    //
                    // STRIP TRAILING AND
                    $tmp_silo_str = rtrim($tmp_silo_str, ' and ');

                    $tmp_condition = ' but, the restriction of log recording to the silos of ' . $tmp_silo_str . ' seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                } else {

                    $tmp_condition = ' but, the restriction of log recording to the silo of "' . self::$oCRNRSTN_USR->log_silo_key_piped . '" seems to have reduced C<span style="color:#FF0000;">R</span>NRSTN :: trace output activity to NULL';

                }

            } else {

                $tmp_condition = ' but, there appears to be no C<span style="color:#FF0000;">R</span>NRSTN :: trace output log data activity';

            }

            if (self::$oCRNRSTN_USR->debugMode < 2) {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" prevents aggregation of log trace data. **';

            } else {

                $tmp_msg = '** The CRNRSTN configuration file debug mode of "' . self::$oCRNRSTN_USR->debugMode . '" allows aggregation of log trace data' . $tmp_condition . '. **';

            }

        }

        //
        // RETURN LOG TRACE STRING FOR HTML EMAIL
        return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:23px;">'.$tmp_msg.'</div>';

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_log
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: Mon August 31, 2020 @ 0246hrs

class crnrstn_log {

    protected $transaction_time;
    protected $silo_key;
    protected $run_time;
    protected $run_file;
    protected $class_method;
    protected $line_number;
    protected $message;

    public function __construct($transactionTime, $log_silo_key='*') {

        $this->transaction_time = $transactionTime;
        $this->silo_key = $log_silo_key;

    }

    public function get_siloKey(){

        return $this->silo_key;

    }

    public function get_transactionTime(){

        return $this->transaction_time;

    }

    public function set_runTime($str){

        $this->run_time = $str;

    }

    public function get_runTime(){

        if(isset($this->run_time)){

            return $this->run_time;

        }else{

            return NULL;

        }

    }

    public function set_runFile($str=NULL){

        if(isset($str)){

            $this->run_file = $str;

        }

    }

    public function get_runFile(){

        if(isset($this->run_file)){

            return $this->run_file;

        }else{

            return NULL;

        }

    }

    public function set_classMethod($str=NULL){

        if(isset($str)){

            $this->class_method = $str;

        }
    }

    public function get_classMethod(){

        if(isset($this->class_method)){

            return $this->class_method;

        }else{

            return NULL;

        }

    }

    public function set_lineNumber($str=NULL){

        if(isset($str)){

            $this->line_number = $str;

        }

    }

    public function get_lineNumber(){

        if(isset($this->line_number)){

            return $this->line_number;

        }else{

            return NULL;

        }

    }

    public function set_logMsg($str=''){

        $this->message = $str;

    }

    public function get_logMsg(){

        if(isset($this->message)){

            return $this->message;

        }else{

            return NULL;

        }

    }

    public function __destruct() {

    }

}