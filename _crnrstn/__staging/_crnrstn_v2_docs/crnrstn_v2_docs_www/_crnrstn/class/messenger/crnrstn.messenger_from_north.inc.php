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
#  CLASS :: crnrstn_messenger_from_north
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: September 4, 2020 @ 2056hrs
class crnrstn_messenger_from_north {

	protected $oLogger;
	private static $oCRNRSTN_USR;

	private static $oCRNRSTN_PHPMailer_ARRAY = array();
	private static $oCRNRSTN_PROXYMailer_ARRAY = array();

    protected $PHPMailer_experience_tracker_ARRAY = array();
    protected $PHPMailer_single_or_bulk_ARRAY = array();
    protected $PROXYMailer_experience_tracker_ARRAY = array();
    protected $PROXYMailer_single_or_bulk_ARRAY = array();

    public $messenger_serial;
    protected $messenger_serial_raw;
	protected $mail_protocol;
    protected $username;
    protected $password;
    protected $port;

    protected $proxy_endpoint_uri;
    protected $proxy_endpoint_auth_key;
    protected $proxy_cipher_override;
    protected $proxy_secret_key_override;
    protected $proxy_hmac_algorithm_override;

    protected $mail_host_servers;

    protected $sender_email;
    protected $sender_name;
    protected $sender_Bulk = array();

    protected $priority = NULL;
    protected $priorityBulk = array();
    protected $word_wrap = 72;
    protected $word_wrapBulk = array();
    protected $is_HTML = false;
    protected $is_HTMLBulk = array();

    protected $subject_line = '';
    protected $subject_lineBulk = array();
    protected $html_message = NULL;
    protected $html_messageBulk = array();
    protected $text_message = NULL;
    protected $text_messageBulk = array();

    protected $dynamic_content_SUBJECT_ARRAY = array();
    protected $dynamic_content_HTML_ARRAY = array();
    protected $dynamic_content_TEXT_ARRAY = array();

    protected $suppress_duplicates = true;
    protected $replyto_email_ARRAY = array();
    protected $to_email_ARRAY = array();
    protected $cc_email_ARRAY = array();
    protected $bcc_email_ARRAY = array();
    protected $optout_suppression_ARRAY = array();
    protected $duplicate_suppression_ARRAY = array();

    protected $reporting_optout_suppression = array();
    protected $reporting_duplicate_suppression = array();
    protected $reporting_send_success = array();
    protected $reporting_send_error = array();

    protected $flag_PHPMailer_send_serial = array();

	public function __construct($messenger_serial, $mail_protocol, $username, $password, $port, $oCRNRSTN_USR) {

	    /*

        CONSIDERATIONS ::
        - SUPPORT FOR DATABASE DRIVEN MULTI-BATCH AND BLAST
            * SINGLE MESSAGE TO MANY EMAIL
            * MANY MESSAGES (I.E. DYNAMIC CONTENT) TO MANY EMAIL
            * MESSAGE PERSONALIZATION HOOKS
            * EMAIL DEDUPLICATION (FORCE UNIQUE) WITHIN SINGLE SENDING PROCESS RUN
            * STRAIGHT SEND TO ALL (NO DEDUPLICATION)
            * SERIALIZED PER RECIPIENT EMAIL FOR SEND SUCCESS/ERR FEEDBACK
        - SUPPORT FOR ONE-OFF-EMAIL MULTI-PART MESSAGE WITH ON-ERR-BACKUP TEXT ONLY
        - END GAME SUPPORT = UNIVERSAL PROXY ENDPOINT WITHIN CRNRSTN FOR MESSAGE TRIGGER VIA HTTP POST (OR SOAP REQUEST)

	    */

        try{

            self::$oCRNRSTN_USR = $oCRNRSTN_USR;

            //
            // INSTANTIATE LOGGER
            $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

            $this->messenger_serial_raw = $messenger_serial;
            $this->messenger_serial = crc32($messenger_serial);

            $tmp_mail_protocol = trim(strtoupper($mail_protocol));
            error_log('107 gabriel - mail_protocol='.$tmp_mail_protocol);

            switch($tmp_mail_protocol){
                case 'SMTP':
                case 'MAIL':
                case 'SENDMAIL':
                case 'QMAIL':

                    $this->mail_protocol = $tmp_mail_protocol;
                    $this->username = $username;
                    $this->password = $password;
                    $this->port = $port;

                break;
                case 'CRNRSTN_PROXY':
                    //
                    //
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown mail protocol of "'.$mail_protocol.'" has been provided. The options which are available include "SMTP", "MAIL", "SENDMAIL" and "QMAIL".');

                break;
            }

        }catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }
	}

	public function return_CRNRSTN_SysMsgBody($msgFormat='TEXT', $msgType='EXCEPTION_NOTIFICATION'){

	    $tmp_format = trim(strtoupper($msgFormat));

	    switch($tmp_format){
            case 'HTML':
                return $this->return_CRNRSTN_SysMsgHTMLBody($msgType);

            break;
            default:
                return $this->return_CRNRSTN_SysMsgTEXTBody($msgType);
            break;

        }

    }

    public function addHostServers($mail_host_servers){

        $this->mail_host_servers = $mail_host_servers;

    }

    public function addReplyTo($reply_to_email, $reply_to_recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($reply_to_email, ",");
            $pos_comma_name = stripos($reply_to_recipient_name, ",");

            if($pos_comma_email !== false){
                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $reply_to_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $reply_to_recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided CC emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided CC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->replyto_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->replyto_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->replyto_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->replyto_email_ARRAY['name'][] = trim($reply_to_recipient_name);

                        //
                        // FOR REPORTING
                        $this->replyto_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->replyto_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->replyto_email_ARRAY['name'][] = trim($reply_to_recipient_name);

                //
                // FOR REPORTING
                $this->replyto_email_ARRAY['email'][] = trim($reply_to_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->replyto_email_ARRAY['sys_email'][] = $this->clean_system_email($reply_to_email);

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addFrom($sender_email, $sender_name){

        $sender_email = $this->clean_system_email($sender_email);

        $this->sender_email = $sender_email;
        $this->sender_name = $sender_name;

    }

    public function wordWrap($max_char_column_cnt){

        $this->word_wrap = $max_char_column_cnt;

    }

    public function isHTML($bool_isHTML){

        $this->is_HTML = $bool_isHTML;

    }

    public function setPriority($priority){

	    try{

            $tmp_priority = trim(strtoupper($priority));

            switch($tmp_priority){
                case 1:
                case 'HIGH':
                    $this->priority = 1;
                break;
                case 3:
                case 'NORMAL':
                    $this->priority = 3;
                break;
                case 5:
                case 'LOW':
                    $this->priority = 5;
                break;
                default:

                    $this->priority = 3;

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The provided priority level of "'.$priority.'" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.');

                break;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addSubject($subject_line){

        $this->subject_line = $subject_line;

    }

    public function addMsgBody_HTMLversion($html_message){

        $this->html_message = $html_message;

    }

    public function addMsgBody_TEXTversion($text_message){

        $this->text_message = $text_message;

    }

    public function suppressEmailDuplicates($bool_suppress_dups){

        $this->suppress_duplicates = $bool_suppress_dups;

    }

    public function optOutDoNotSendEmail($optout_emails){

        $this->optout_suppression_ARRAY = $this->clean_system_email_comma_delimited($optout_emails, true, false);

    }

    public function addAddress($recipient_email, $recipient_name){

        $email_experience_tracker = self::$oCRNRSTN_USR->generateNewKey(70);

	    try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                            $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                            $this->to_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->to_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER
                            $this->to_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                        $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                        $this->to_email_ARRAY['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->to_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->to_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                $this->to_email_ARRAY['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->to_email_ARRAY['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->to_email_ARRAY['sys_email'][] = $this->clean_system_email($recipient_email);

            }

            return $email_experience_tracker;

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }

    }

    public function addCC($recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){
                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided CC emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided CC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->cc_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->cc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->cc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->cc_email_ARRAY['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->cc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->cc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->cc_email_ARRAY['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->cc_email_ARRAY['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->cc_email_ARRAY['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addBCC($recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided BCC emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided BCC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->bcc_email_ARRAY['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->bcc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->bcc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->bcc_email_ARRAY['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->bcc_email_ARRAY['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->bcc_email_ARRAY['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->bcc_email_ARRAY['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->bcc_email_ARRAY['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->bcc_email_ARRAY['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addDynamicContent_SUBJECT($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic HTML experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addDynamicContent_HTML($email_experience_tracker, $content_place_holder, $dynamic_content){

	    try{

	        if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

	            $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic HTML experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addDynamicContent_TEXT($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic TEXT experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addDynamicContent_MULTIPART($email_experience_tracker, $content_place_holder, $dynamic_content){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;
                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'][] = $content_place_holder;
                $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'][] = $dynamic_content;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this dynamic MULTIPART experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function isHTMLBulk($email_experience_tracker, $bool_isHTML){

	    try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->is_HTMLBulk[$email_experience_tracker] = $bool_isHTML;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this boolean flag for isHTML experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return true;

    }

    public function setPriorityBulk($email_experience_tracker, $priority){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $tmp_priority = trim(strtoupper($priority));

                switch($tmp_priority){
                    case 1:
                    case 'HIGH':
                        $this->priorityBulk[$email_experience_tracker] = 1;
                    break;
                    case 3:
                    case 'NORMAL':
                        $this->priorityBulk[$email_experience_tracker] = 3;
                    break;
                    case 5:
                    case 'LOW':
                        $this->priorityBulk[$email_experience_tracker] = 5;
                    break;
                    default:

                        $this->priorityBulk[$email_experience_tracker] = 3;

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The provided priority level of "'.$priority.'" is invalid; NORMAL priority has been applied for this recipient experience. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.');

                    break;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of the "'.$priority.'" priority flag for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addFromBulk($email_experience_tracker, $sender_email, $sender_name){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->sender_Bulk[$email_experience_tracker]['email'] = $sender_email;
                $this->sender_Bulk[$email_experience_tracker]['name'] = $sender_name;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this sender email/"from" email experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return true;

    }

    public function addAddressBulk($email_experience_tracker, $recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                            $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                            $this->to_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->to_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER
                            $this->to_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                        $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                        $this->to_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->to_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->to_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->to_email_ARRAY['experience_tracker'][] = $email_experience_tracker;
                $this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker] = 1;

                $this->to_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->to_email_ARRAY[$email_experience_tracker]['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->to_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($recipient_email);
                self::$oCRNRSTN_USR->error_log('Adding BULK email '.self::$oCRNRSTN_USR->stringSanitize($recipient_email, 'email_private').' to to_email_ARRAY['.substr($email_experience_tracker, 0, 5).'...][ ].', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }
    }


    public function addCCBulk($email_experience_tracker,$recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){
                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided CC emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided CC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->cc_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->cc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->cc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->cc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->cc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->cc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->cc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->cc_email_ARRAY[$email_experience_tracker]['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->cc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addBCCBulk($email_experience_tracker, $recipient_email, $recipient_name){

        try {

            //
            // CHECK FOR COMMA DELIMITED
            $pos_comma_email = stripos($recipient_email, ",");
            $pos_comma_name = stripos($recipient_name, ",");

            if($pos_comma_email !== false){

                //
                // WE HAVE COMMA DELIM EMAIL
                $tmp_email_ARRAY = explode(',', $recipient_email);

                if($pos_comma_name !== false) {

                    //
                    // WE HAVE COMMA DELIM NAME
                    $tmp_name_ARRAY = explode(',', $recipient_name);

                    $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    if($tmp_name_cnt != $tmp_email_cnt){

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided BCC emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided BCC names].');

                    }else{

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->bcc_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                            //
                            // FOR REPORTING
                            $this->bcc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->bcc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                    for($i=0; $i<$tmp_email_cnt; $i++){

                        $this->bcc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                        //
                        // FOR REPORTING
                        $this->bcc_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                        //
                        // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                        $this->bcc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                    }

                }

            }else{

                $this->bcc_email_ARRAY[$email_experience_tracker]['name'][] = trim($recipient_name);

                //
                // FOR REPORTING
                $this->bcc_email_ARRAY[$email_experience_tracker]['email'][] = trim($recipient_email);

                //
                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                $this->bcc_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($recipient_email);

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function wordWrapBulk($email_experience_tracker, $max_char_column_cnt){

        $this->word_wrapBulk[$email_experience_tracker] = $max_char_column_cnt;

    }

    public function addReplyToBulk($email_experience_tracker, $reply_to_email, $reply_to_recipient_name){

        try {

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                //
                // CHECK FOR COMMA DELIMITED
                $pos_comma_email = stripos($reply_to_email, ",");
                $pos_comma_name = stripos($reply_to_recipient_name, ",");

                if($pos_comma_email !== false){
                    //
                    // WE HAVE COMMA DELIM EMAIL
                    $tmp_email_ARRAY = explode(',', $reply_to_email);

                    if($pos_comma_name !== false) {

                        //
                        // WE HAVE COMMA DELIM NAME
                        $tmp_name_ARRAY = explode(',', $reply_to_recipient_name);

                        $tmp_name_cnt = sizeof($tmp_name_ARRAY);
                        $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                        if($tmp_name_cnt != $tmp_email_cnt){

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('There is a mismatch between the number of comma delimited recipient email addresses ['.$tmp_email_cnt.' provided CC emails] and the number of associated recipient names ['.$tmp_name_cnt.' provided CC names].');

                        }else{

                            for($i=0; $i<$tmp_email_cnt; $i++){

                                $this->replyto_email_ARRAY[$email_experience_tracker]['name'][] = trim($tmp_name_ARRAY[$i]);

                                //
                                // FOR REPORTING
                                $this->replyto_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                                //
                                // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                                $this->replyto_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                            }

                        }

                    }else{

                        $tmp_email_cnt = sizeof($tmp_email_ARRAY);

                        for($i=0; $i<$tmp_email_cnt; $i++){

                            $this->replyto_email_ARRAY[$email_experience_tracker]['name'][] = trim($reply_to_recipient_name);

                            //
                            // FOR REPORTING
                            $this->replyto_email_ARRAY[$email_experience_tracker]['email'][] = trim($tmp_email_ARRAY[$i]);

                            //
                            // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                            $this->replyto_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($tmp_email_ARRAY[$i]);

                        }

                    }

                }else{

                    $this->replyto_email_ARRAY[$email_experience_tracker]['name'][] = trim($reply_to_recipient_name);

                    //
                    // FOR REPORTING
                    $this->replyto_email_ARRAY[$email_experience_tracker]['email'][] = trim($reply_to_email);

                    //
                    // FOR CRNRSTN SUPPRESSION FILTER AND SEND
                    $this->replyto_email_ARRAY[$email_experience_tracker]['sys_email'][] = $this->clean_system_email($reply_to_email);

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of this replyTo email experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function addSubjectBulk($email_experience_tracker, $subject_line){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->subject_lineBulk[$email_experience_tracker] = $subject_line;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of a subject line for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return true;

    }

    public function addHTMLver_Bulk($email_experience_tracker, $html_message){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->html_messageBulk[$email_experience_tracker] = $html_message;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of the HTML body for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }

        return true;

    }

    public function addTEXTver_Bulk($email_experience_tracker, $text_message){

        try{

            if(isset($this->to_email_ARRAY['experience_tracker_flag'][$email_experience_tracker])){

                $this->text_messageBulk[$email_experience_tracker] = $text_message;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any email assigned to Gabriel (out of the '.sizeof($this->to_email_ARRAY['sys_email']).' email addresses in his possession) for the application of the TEXT body for this email experience.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return true;

    }

    public function batchReadyToSend($max_batch_count){

	    if(sizeof($this->to_email_ARRAY) > $max_batch_count){

            return true;

        }else{

	        return false;

        }

    }

    public function initProxySend($proxy_endpoint_uri, $proxy_auth_key){

        /*
            protected $proxy_endpoint_uri;
            protected $proxy_endpoint_auth_key;
            protected $proxy_cipher_override;
            protected $proxy_secret_key_override;
            protected $proxy_hmac_algorithm_override;
        */

        $this->proxy_endpoint_uri = $proxy_endpoint_uri;
        $this->proxy_endpoint_auth_key = $proxy_auth_key;


    }

    public function proxyEncrypt_setAlgorithmOverride($proxy_encrypt_hmac_algorithm){

        $this->proxy_hmac_algorithm_override = $proxy_encrypt_hmac_algorithm;

        return NULL;

    }

    public function proxyEncrypt_setSecretKeyOverride($proxy_secret_key){

        $this->proxy_secret_key_override = $proxy_secret_key;

        return NULL;

    }

    public function proxyEncrypt_setCipherOverride($proxy_cipher){

        $this->proxy_cipher_override = $proxy_cipher;

        return NULL;

    }

    public function proxySend(){

	    try{

            $tmp_email_experience_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);
            if($tmp_email_experience_cnt>0){

                //
                // MESSAGE ASSEMBLY
                $this->spool_proxy_message();
                //
                // MESSAGE DELIVERY
                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PROXYMailer_ARRAY);
                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    error_log('1229 - proxySend['.$tmp_mailer_cnt.']['.$tmp_email_experience_cnt.']');

                    $oCRNRSTN_PROXYMailer = self::$oCRNRSTN_PROXYMailer_ARRAY[$i];
                    //self::$oCRNRSTN_USR->error_log($i.' <--sending mailer in this position AltBody=->'.$oCRNRSTN_PHPMailer->AltBody, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    //
                    // CONSIDER ADDING SOME KIND OF THROTTLING??
                    $tmp_send_auth = self::$oCRNRSTN_USR->getEnvResource('EMAIL_TEST_AUTH');
                    $tmp_ip_auth = self::$oCRNRSTN_USR->exclusiveAccess('73.54.221.217');
                    if($tmp_send_auth){

                        self::$oCRNRSTN_USR->error_log('seeennd it! [PROXY] [EMAIL QUEUE POS #'.$i.']['.sizeof(self::$oCRNRSTN_PROXYMailer_ARRAY).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                        $proxy_response = $oCRNRSTN_PROXYMailer->send($this->proxy_endpoint_uri, $this->proxy_endpoint_auth_key, $this->proxy_cipher_override, $this->proxy_secret_key_override, $this->proxy_hmac_algorithm_override);
                        error_log('1235 - PROXY RESPONSE='.$proxy_response);
                    }
                }
            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }

        return true;

    }

    public function send(){

	    try{

            $tmp_email_experience_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);
            if($tmp_email_experience_cnt>0){

                //
                // MESSAGE ASSEMBLY
                $this->spool_message();

                //
                // MESSAGE DELIVERY
                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PHPMailer_ARRAY);

                self::$oCRNRSTN_USR->error_log($tmp_mailer_cnt.' <--How many mailer to send after spooling??', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                $tmp_send_result_ARRAY = array();

                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    //error_log('1158 - send('.$i.') = oCRNRSTN_PHPMailer_ARRAY['.$i.']');
                    $oCRNRSTN_PHPMailer = self::$oCRNRSTN_PHPMailer_ARRAY[$i];
                    //self::$oCRNRSTN_USR->error_log($i.' <--sending mailer in this position AltBody=->'.$oCRNRSTN_PHPMailer->AltBody, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    //
                    // CONSIDER ADDING SOME KIND OF THROTTLING??
                    $tmp_send_auth = self::$oCRNRSTN_USR->getEnvResource('EMAIL_TEST_AUTH');
                    $tmp_ip_auth = self::$oCRNRSTN_USR->exclusiveAccess('73.54.221.217');
                    if($tmp_send_auth){

                        self::$oCRNRSTN_USR->error_log('seeennd it! [EMAIL QUEUE POS #'.$i.']['.sizeof(self::$oCRNRSTN_PHPMailer_ARRAY).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                        $tmp_send_result_ARRAY['is_success'][] = $oCRNRSTN_PHPMailer->send();
                        $tmp_send_result_ARRAY['status_msg'][] = $oCRNRSTN_PHPMailer->ErrorInfo;

                    }
                }

                //
                // CLEAR oCRNRSTN_PHPMailer_ARRAY ARRAY
                array_splice(self::$oCRNRSTN_PHPMailer_ARRAY, 0);

                return $tmp_send_result_ARRAY;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }

        return true;

    }

    private function spool_proxy_message(){

        try{

            //
            // SENDER AND RECIPIENT DATA (TO, CC, BCC, REPLYTO, FROM)
            $this->initialize_proxy_sender_recipient();

            //
            // MESSAGE DETAIL (HTML, TEXT, WRAP, ISHTML, SUBJECT)
            $this->initialize_proxy_message_content();


        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

        return false;


    }

    private function spool_message(){

	    try{

            //
            // SENDER AND RECIPIENT DATA (TO, CC, BCC, REPLYTO, FROM)
            $this->initialize_sender_recipient();

            //
            // CONNECTIVITY (SMTP, SENDMAIL, QMAIL, PHPMAIL, SERVER, PORT, USERNAME, PASSWORD)
            $this->initialize_connectivity();

            //
            // MESSAGE DETAIL (HTML, TEXT, WRAP, ISHTML, SUBJECT)
            $this->initialize_message_content();


        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

        return false;

    }

    private function initialize_proxy_sender_recipient(){

        $tmp_to_email_cnt = 0;
        $tmp_experience_tracker_cnt = 0;
        $tmp_replyto_email_cnt = 0;
        $tmp_cc_email_cnt = 0;
        $tmp_bcc_email_cnt = 0;
        $tmp_to_email_bulk_cnt = 0;
        $tmp_replyto_email_bulk_cnt = 0;
        $tmp_cc_email_bulk_cnt = 0;
        $tmp_bcc_email_bulk_cnt = 0;
        $tmp_from_email_bulk_cnt = 0;

        //
        // PROCESS ANY SINGLE SERVING EMAIL
        if(isset($this->to_email_ARRAY['sys_email'])){

            $tmp_to_email_cnt = sizeof($this->to_email_ARRAY['sys_email']);

        }

        if(isset($this->cc_email_ARRAY['sys_email'])){

            $tmp_cc_email_cnt = sizeof($this->cc_email_ARRAY['sys_email']);

        }

        if(isset($this->replyto_email_ARRAY['sys_email'])){

            $tmp_replyto_email_cnt = sizeof($this->replyto_email_ARRAY['sys_email']);

        }

        if(isset($this->bcc_email_ARRAY['sys_email'])){

            $tmp_bcc_email_cnt = sizeof($this->bcc_email_ARRAY['sys_email']);

        }

        if($tmp_to_email_cnt>0){

            //$oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_USR);
            $oCRNRSTN_PROXYMailer = new crnrstn_highway_of_the_king(self::$oCRNRSTN_USR);

            //
            // INITIALIZE SENDER/FROM
            $oCRNRSTN_PROXYMailer->setFrom($this->sender_email, $this->sender_name);
            self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] INITIALIZE SENDER/FROM setFrom['.self::$oCRNRSTN_USR->stringSanitize($this->sender_email, 'email_private').' - '.$this->sender_name.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

            //
            // INITIALIZE TO
            for($i=0; $i<$tmp_to_email_cnt; $i++){

                if(isset($this->optout_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                    //
                    // OPT OUT SUPPRESSION
                    $this->reporting_optout_suppression[] = $this->to_email_ARRAY['email'][$i];

                }else{

                    if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]) && $this->suppress_duplicates){

                        //
                        // DUPLICATE SUPPRESSION
                        $this->reporting_duplicate_suppression[] = $this->to_email_ARRAY['email'][$i];

                    }else{

                        if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                            //
                            // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]++;

                        }else{

                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]] = 1;

                        }

                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] addAddress['.self::$oCRNRSTN_USR->stringSanitize($this->to_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->to_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                        //$oCRNRSTN_PHPMailer->addAddress($this->to_email_ARRAY['sys_email'][$i], $this->to_email_ARRAY['name'][$i]);
                        $oCRNRSTN_PROXYMailer->addAddress($this->to_email_ARRAY['sys_email'][$i], $this->to_email_ARRAY['name'][$i]);

                    }
                }
            }

            //
            // INITIALIZE REPLYTO
            if($tmp_replyto_email_cnt>0){

                for($i=0; $i<$tmp_replyto_email_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] addReplyTo['.self::$oCRNRSTN_USR->stringSanitize($this->replyto_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->replyto_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    //$oCRNRSTN_PHPMailer->addReplyTo($this->replyto_email_ARRAY['sys_email'][$i], $this->replyto_email_ARRAY['name'][$i]);
                    $oCRNRSTN_PROXYMailer->addReplyTo($this->replyto_email_ARRAY['sys_email'][$i], $this->replyto_email_ARRAY['name'][$i]);
                }
            }

            //
            // INITIALIZE CC
            if($tmp_cc_email_cnt>0){

                for($i=0; $i<$tmp_cc_email_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] addCC['.self::$oCRNRSTN_USR->stringSanitize($this->cc_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->cc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    //$oCRNRSTN_PHPMailer->addCC($this->cc_email_ARRAY['sys_email'][$i], $this->cc_email_ARRAY['name'][$i]);
                    $oCRNRSTN_PROXYMailer->addCC($this->cc_email_ARRAY['sys_email'][$i], $this->cc_email_ARRAY['name'][$i]);
                }
            }

            //
            // INITIALIZE BCC
            if($tmp_bcc_email_cnt>0){

                for($i=0; $i<$tmp_bcc_email_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] addBCC['.self::$oCRNRSTN_USR->stringSanitize($this->bcc_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->bcc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    //$oCRNRSTN_PHPMailer->addBCC($this->bcc_email_ARRAY['sys_email'][$i], $this->bcc_email_ARRAY['name'][$i]);
                    $oCRNRSTN_PROXYMailer->addBCC($this->bcc_email_ARRAY['sys_email'][$i], $this->bcc_email_ARRAY['name'][$i]);
                }
            }
        }

        if(isset($oCRNRSTN_PROXYMailer)){

            self::$oCRNRSTN_PROXYMailer_ARRAY[] = $oCRNRSTN_PROXYMailer;
            $this->PROXYMailer_experience_tracker_ARRAY[] = $this->to_email_ARRAY['experience_tracker'][0];
            $this->PROXYMailer_single_or_bulk_ARRAY[] = 'single';

            self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] SINGLE ADD of address pushed to oCRNRSTN_PHPMailer_ARRAY', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

        }

        //
        // PROCESS ANY BULK EMAIL
        if(isset($this->to_email_ARRAY['experience_tracker'])){

            $tmp_experience_tracker_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);

        }

        if($tmp_experience_tracker_cnt > 0){

            for($i=0; $i<$tmp_experience_tracker_cnt; $i++){

                $tmp_exp_tracker = $this->to_email_ARRAY['experience_tracker'][$i];

                if(isset($this->to_email_ARRAY[$tmp_exp_tracker])){

                    //$oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_USR);
                    $oCRNRSTN_PROXYMailer = new crnrstn_highway_of_the_king(self::$oCRNRSTN_USR);

                    //
                    // WE HAVE FOUND BULK EMAIL
                    $tmp_to_email_bulk_cnt = sizeof($this->to_email_ARRAY[$tmp_exp_tracker]['sys_email']);
                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] WE HAVE COUNT OF '.$tmp_to_email_bulk_cnt.' TO PERFORM BULK OPERATION.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    if(isset($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_replyto_email_bulk_cnt = sizeof($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_cc_email_bulk_cnt = sizeof($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_bcc_email_bulk_cnt = sizeof($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->sender_Bulk[$tmp_exp_tracker]['email'])){
                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] WE HAVE BULK SENDER/FROM sender_Bulk('.self::$oCRNRSTN_USR->stringSanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').' '.$this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    }

                    //
                    // INITIALIZE TO
                    for($ii=0; $ii<$tmp_to_email_bulk_cnt; $ii++){

                        $tmp_to_email = $this->to_email_ARRAY[$tmp_exp_tracker]['email'][$ii];
                        $tmp_to_sys_email = $this->to_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii];
                        $tmp_to_name = $this->to_email_ARRAY[$tmp_exp_tracker]['name'][$ii];

                        if(isset($this->optout_suppression_ARRAY[$tmp_to_sys_email])){

                            //
                            // OPT OUT SUPPRESSION
                            $this->reporting_optout_suppression[] = $tmp_to_sys_email;

                        }else{

                            if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email]) && $this->suppress_duplicates){

                                //
                                // DUPLICATE SUPPRESSION
                                $this->reporting_duplicate_suppression[] = $tmp_to_email;

                            }else{

                                if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email])){

                                    //
                                    // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email]++;

                                }else{

                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email] = 1;

                                }

                                $oCRNRSTN_PROXYMailer->addAddress($tmp_to_sys_email, $tmp_to_name);
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] WE HAVE BULK RECIPIENT addAddress('.self::$oCRNRSTN_USR->stringSanitize($tmp_to_sys_email, 'email_private').', '.$tmp_to_name.')...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }
                        }
                    }

                    //
                    // INITIALIZE SENDER/FROM
                    $tmp_from_email_bulk_cnt = 1;

                    $oCRNRSTN_PROXYMailer->setFrom($this->sender_Bulk[$tmp_exp_tracker]['email'], $this->sender_Bulk[$tmp_exp_tracker]['name']);
                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] setFrom('.self::$oCRNRSTN_USR->stringSanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').', '.$this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    //
                    // INITIALIZE REPLYTO
                    if($tmp_replyto_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_replyto_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PROXYMailer->addReplyTo($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->replyto_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE CC
                    if($tmp_cc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_cc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PROXYMailer->addCC($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->cc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE BCC
                    if($tmp_bcc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_bcc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PROXYMailer->addBCC($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->bcc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    if(isset($oCRNRSTN_PROXYMailer)){

                        self::$oCRNRSTN_PROXYMailer_ARRAY[] = $oCRNRSTN_PROXYMailer;
                        $this->PROXYMailer_experience_tracker_ARRAY[] = $tmp_exp_tracker;
                        $this->PROXYMailer_single_or_bulk_ARRAY[] = 'bulk';

                    }

                    $oCRNRSTN_PROXYMailer = NULL;
                    unset($oCRNRSTN_PROXYMailer);

                }

            }

        }else{

            self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] WE HAVE NO BULK EMAIL TO PROCESS...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

        }

    }

    private function initialize_sender_recipient(){

        $tmp_to_email_cnt = 0;
        $tmp_experience_tracker_cnt = 0;
        $tmp_replyto_email_cnt = 0;
        $tmp_cc_email_cnt = 0;
        $tmp_bcc_email_cnt = 0;
        $tmp_to_email_bulk_cnt = 0;
        $tmp_replyto_email_bulk_cnt = 0;
        $tmp_cc_email_bulk_cnt = 0;
        $tmp_bcc_email_bulk_cnt = 0;
        $tmp_from_email_bulk_cnt = 0;

        //
        // PROCESS ANY SINGLE SERVING EMAIL
        if(isset($this->to_email_ARRAY['sys_email'])){

            $tmp_to_email_cnt = sizeof($this->to_email_ARRAY['sys_email']);

        }

        if(isset($this->cc_email_ARRAY['sys_email'])){

            $tmp_cc_email_cnt = sizeof($this->cc_email_ARRAY['sys_email']);

        }

        if(isset($this->replyto_email_ARRAY['sys_email'])){

            $tmp_replyto_email_cnt = sizeof($this->replyto_email_ARRAY['sys_email']);

        }

        if(isset($this->bcc_email_ARRAY['sys_email'])){

            $tmp_bcc_email_cnt = sizeof($this->bcc_email_ARRAY['sys_email']);

        }

        if($tmp_to_email_cnt>0){

            $oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_USR);

            //
            // INITIALIZE SENDER/FROM
            $oCRNRSTN_PHPMailer->setFrom($this->sender_email, $this->sender_name);
            self::$oCRNRSTN_USR->error_log('oGabriel INITIALIZE SENDER/FROM setFrom['.self::$oCRNRSTN_USR->stringSanitize($this->sender_email, 'email_private').' - '.$this->sender_name.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

            //
            // INITIALIZE TO
            for($i=0; $i<$tmp_to_email_cnt; $i++){

                if(isset($this->optout_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                    //
                    // OPT OUT SUPPRESSION
                    $this->reporting_optout_suppression[] = $this->to_email_ARRAY['email'][$i];

                }else{

                    if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]) && $this->suppress_duplicates){

                        //
                        // DUPLICATE SUPPRESSION
                        $this->reporting_duplicate_suppression[] = $this->to_email_ARRAY['email'][$i];

                    }else{

                        if(isset($this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]])){

                            //
                            // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]]++;

                        }else{

                            $this->duplicate_suppression_ARRAY[$this->to_email_ARRAY['sys_email'][$i]] = 1;

                        }

                        self::$oCRNRSTN_USR->error_log('oGabriel addAddress['.self::$oCRNRSTN_USR->stringSanitize($this->to_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->to_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                        $oCRNRSTN_PHPMailer->addAddress($this->to_email_ARRAY['sys_email'][$i], $this->to_email_ARRAY['name'][$i]);

                    }
                }
            }

            //
            // INITIALIZE REPLYTO
            if($tmp_replyto_email_cnt>0){

                for($i=0; $i<$tmp_replyto_email_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel addReplyTo['.self::$oCRNRSTN_USR->stringSanitize($this->replyto_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->replyto_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    $oCRNRSTN_PHPMailer->addReplyTo($this->replyto_email_ARRAY['sys_email'][$i], $this->replyto_email_ARRAY['name'][$i]);

                }
            }

            //
            // INITIALIZE CC
            if($tmp_cc_email_cnt>0){

                for($i=0; $i<$tmp_cc_email_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel addCC['.self::$oCRNRSTN_USR->stringSanitize($this->cc_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->cc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    $oCRNRSTN_PHPMailer->addCC($this->cc_email_ARRAY['sys_email'][$i], $this->cc_email_ARRAY['name'][$i]);

                }
            }

            //
            // INITIALIZE BCC
            if($tmp_bcc_email_cnt>0){

                for($i=0; $i<$tmp_bcc_email_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel addBCC['.self::$oCRNRSTN_USR->stringSanitize($this->bcc_email_ARRAY['sys_email'][$i], 'email_private').' - '.$this->bcc_email_ARRAY['name'][$i].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    $oCRNRSTN_PHPMailer->addBCC($this->bcc_email_ARRAY['sys_email'][$i], $this->bcc_email_ARRAY['name'][$i]);

                }
            }
        }

        if(isset($oCRNRSTN_PHPMailer)){

            self::$oCRNRSTN_PHPMailer_ARRAY[] = $oCRNRSTN_PHPMailer;
            $this->PHPMailer_experience_tracker_ARRAY[] = $this->to_email_ARRAY['experience_tracker'][0];
            $this->PHPMailer_single_or_bulk_ARRAY[] = 'single';

            self::$oCRNRSTN_USR->error_log('oGabriel SINGLE ADD of address pushed to oCRNRSTN_PHPMailer_ARRAY', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');


        }

        //
        // PROCESS ANY BULK EMAIL
        if(isset($this->to_email_ARRAY['experience_tracker'])){

            $tmp_experience_tracker_cnt = sizeof($this->to_email_ARRAY['experience_tracker']);

        }

        if($tmp_experience_tracker_cnt > 0){

            for($i=0; $i<$tmp_experience_tracker_cnt; $i++){

                $tmp_exp_tracker = $this->to_email_ARRAY['experience_tracker'][$i];

                if(isset($this->to_email_ARRAY[$tmp_exp_tracker])){

                    $oCRNRSTN_PHPMailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer(self::$oCRNRSTN_USR);

                    //
                    // WE HAVE FOUND BULK EMAIL
                    $tmp_to_email_bulk_cnt = sizeof($this->to_email_ARRAY[$tmp_exp_tracker]['sys_email']);
                    self::$oCRNRSTN_USR->error_log('oGabriel WE HAVE COUNT OF '.$tmp_to_email_bulk_cnt.' TO PERFORM BULK OPERATION.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    if(isset($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_replyto_email_bulk_cnt = sizeof($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_cc_email_bulk_cnt = sizeof($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'])){

                        $tmp_bcc_email_bulk_cnt = sizeof($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email']);

                    }

                    if(isset($this->sender_Bulk[$tmp_exp_tracker]['email'])){
                        self::$oCRNRSTN_USR->error_log('oGabriel WE HAVE BULK SENDER/FROM sender_Bulk('.self::$oCRNRSTN_USR->stringSanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').' '.$this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    }

                    //
                    // INITIALIZE TO
                    for($ii=0; $ii<$tmp_to_email_bulk_cnt; $ii++){

                        $tmp_to_email = $this->to_email_ARRAY[$tmp_exp_tracker]['email'][$ii];
                        $tmp_to_sys_email = $this->to_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii];
                        $tmp_to_name = $this->to_email_ARRAY[$tmp_exp_tracker]['name'][$ii];

                        if(isset($this->optout_suppression_ARRAY[$tmp_to_sys_email])){

                            //
                            // OPT OUT SUPPRESSION
                            $this->reporting_optout_suppression[] = $tmp_to_sys_email;

                        }else{

                            if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email]) && $this->suppress_duplicates){

                                //
                                // DUPLICATE SUPPRESSION
                                $this->reporting_duplicate_suppression[] = $tmp_to_email;

                            }else{

                                if(isset($this->duplicate_suppression_ARRAY[$tmp_to_sys_email])){

                                    //
                                    // TRACK INSTANCES OF DUPLICATE SEND FOR REPORTING META
                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email]++;

                                }else{

                                    $this->duplicate_suppression_ARRAY[$tmp_to_sys_email] = 1;

                                }

                                $oCRNRSTN_PHPMailer->addAddress($tmp_to_sys_email, $tmp_to_name);
                                self::$oCRNRSTN_USR->error_log('oGabriel WE HAVE BULK RECIPIENT addAddress('.self::$oCRNRSTN_USR->stringSanitize($tmp_to_sys_email, 'email_private').', '.$tmp_to_name.')...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }
                        }
                    }

                    //
                    // INITIALIZE SENDER/FROM
                    $tmp_from_email_bulk_cnt = 1;

                    $oCRNRSTN_PHPMailer->setFrom($this->sender_Bulk[$tmp_exp_tracker]['email'], $this->sender_Bulk[$tmp_exp_tracker]['name']);
                    self::$oCRNRSTN_USR->error_log('oGabriel setFrom('.self::$oCRNRSTN_USR->stringSanitize($this->sender_Bulk[$tmp_exp_tracker]['email'], 'email_private').', '.$this->sender_Bulk[$tmp_exp_tracker]['name'].')...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    //
                    // INITIALIZE REPLYTO
                    if($tmp_replyto_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_replyto_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PHPMailer->addReplyTo($this->replyto_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->replyto_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE CC
                    if($tmp_cc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_cc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PHPMailer->addCC($this->cc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->cc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    //
                    // INITIALIZE BCC
                    if($tmp_bcc_email_bulk_cnt>0){

                        for($ii=0; $ii<$tmp_bcc_email_bulk_cnt; $ii++){

                            $oCRNRSTN_PHPMailer->addBCC($this->bcc_email_ARRAY[$tmp_exp_tracker]['sys_email'][$ii], $this->bcc_email_ARRAY[$tmp_exp_tracker]['name'][$ii]);

                        }
                    }

                    if(isset($oCRNRSTN_PHPMailer)){

                        self::$oCRNRSTN_PHPMailer_ARRAY[] = $oCRNRSTN_PHPMailer;
                        $this->PHPMailer_experience_tracker_ARRAY[] = $tmp_exp_tracker;
                        $this->PHPMailer_single_or_bulk_ARRAY[] = 'bulk';

                    }

                    $oCRNRSTN_PHPMailer = NULL;
                    unset($oCRNRSTN_PHPMailer);

                }

            }

        }else{
            self::$oCRNRSTN_USR->error_log('oGabriel WE HAVE NO BULK EMAIL TO PROCESS...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
        }

    }

    private function initialize_connectivity(){

        try{

            if(isset(self::$oCRNRSTN_PHPMailer_ARRAY)){

                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PHPMailer_ARRAY);

                for($i=0; $i<$tmp_mailer_cnt; $i++){

                    $oCRNRSTN_PHPMailer = self::$oCRNRSTN_PHPMailer_ARRAY[$i];

                    if(isset($this->mail_host_servers)){

                        //
                        // SPECIFY MAIN AND BACKUP SERVER
                        $oCRNRSTN_PHPMailer->Host = $this->mail_host_servers;
                        self::$oCRNRSTN_USR->error_log('oGabriel Host=['.$this->mail_host_servers.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    }

                    if(isset($this->port)){

                        //
                        // SPECIFY PORT
                        $oCRNRSTN_PHPMailer->Port = $this->port;
                        self::$oCRNRSTN_USR->error_log('oGabriel Port=['.$this->port.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    }

                    switch($this->mail_protocol){
                        case 'SMTP':
                            self::$oCRNRSTN_USR->error_log('oGabriel IsSMTP()', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                            $oCRNRSTN_PHPMailer->IsSMTP();

                            if(isset($this->username)){

                                //
                                // ACTIVATE SMTP AUTHENTICATION
                                $oCRNRSTN_PHPMailer->SMTPAuth = true;
                                $oCRNRSTN_PHPMailer->Username = $this->username;    // SMTP USERNAME
                                $oCRNRSTN_PHPMailer->Password = $this->password;    // SMTP PASSWORD
                                self::$oCRNRSTN_USR->error_log('oGabriel '.$this->mail_protocol.' - ACTIVATE SMTP SMTPAuth=TRUE [UN='.self::$oCRNRSTN_USR->stringSanitize($oCRNRSTN_PHPMailer->Username, 'email_private').']['.$oCRNRSTN_PHPMailer->Host.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }else{

                                $oCRNRSTN_PHPMailer->SMTPAuth = false;
                                $oCRNRSTN_PHPMailer->Username = '';
                                $oCRNRSTN_PHPMailer->Password = '';
                                self::$oCRNRSTN_USR->error_log('oGabriel ' . $this->mail_protocol.' - NO SMTP SMTPAuth=FALSE [UN='.self::$oCRNRSTN_USR->stringSanitize($oCRNRSTN_PHPMailer->Username, 'email_private').']['.$oCRNRSTN_PHPMailer->Host.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            //
                            // WORK AROUND FOR PHPMAILER SSL CERT VERIFICATION *ERRORS INTRODUCED
                            // THROUGH THE STRICTER SSL BEHAVIOR THAT CAME WITH THE RELEASE OF PHP 5.6
                            // SOURCE :: https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
                            // AUTHOR :: https://pepipost.com/tutorials/author/dibya-sahoo/
                            // DETAIL :: https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#certificate-verification-failure
                            // * You may not see this error; In implicit encryption mode (SMTPS) it may be
                            // hidden because there isn't a way for the channel to show messages - SMTP+STARTTLS
                            // is generally easier to debug because of this.
                            $oCRNRSTN_PHPMailer->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                            );

                        break;
                        case 'MAIL':
                            self::$oCRNRSTN_USR->error_log('oGabriel isMail()', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                            $oCRNRSTN_PHPMailer->isMail();

                        break;
                        case 'SENDMAIL':
                            self::$oCRNRSTN_USR->error_log('oGabriel isSendmail()', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                            $oCRNRSTN_PHPMailer->isSendmail();

                        break;
                        case 'QMAIL':
                            self::$oCRNRSTN_USR->error_log('oGabriel isQmail()', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                            $oCRNRSTN_PHPMailer->isQmail();

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unknown mail protocol of "'.$this->mail_protocol.'" has been provided. The options which are available include "SMTP", "MAIL", "SENDMAIL" and "QMAIL".');

                        break;

                    }

                    self::$oCRNRSTN_PHPMailer_ARRAY[$i] = $oCRNRSTN_PHPMailer;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No instances of the oCRNRSTN_PHPMailer class object could be found for their connectivity initialization.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }

        return true;

    }

    private function initialize_proxy_message_content(){

        try{

            if(isset(self::$oCRNRSTN_PROXYMailer_ARRAY)){

                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PROXYMailer_ARRAY);
                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] initialize_message_content for ['.$tmp_mailer_cnt.'] EMAIL', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] initialize_message_content() RUNNING for ['.$i.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    $oCRNRSTN_PROXYMailer = self::$oCRNRSTN_PROXYMailer_ARRAY[$i];
                    $email_experience_tracker = $this->PROXYMailer_experience_tracker_ARRAY[$i];
                    $bulk_single_indicator = $this->PROXYMailer_single_or_bulk_ARRAY[$i];

                    switch($bulk_single_indicator){
                        case 'single':

                            if(isset($this->priority)){

                                $oCRNRSTN_PROXYMailer->Priority = $this->priority;
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] Priority = '.$oCRNRSTN_PROXYMailer->Priority, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            if(isset($this->word_wrap)){

                                $oCRNRSTN_PROXYMailer->WordWrap = $this->word_wrap;
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] WordWrap = '.$oCRNRSTN_PROXYMailer->WordWrap, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            $oCRNRSTN_PROXYMailer->is_HTML = $this->is_HTML;

                            if($this->is_HTML){

                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->html_message) && strlen($this->html_message)>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_message = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_message);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->html_message;

                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PROXYMailer->AltBody = $this->text_message;

                                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PROXYMailer->AltBody), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PROXYMailer->Body = $this->text_message;

                                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->text_message)){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->text_message;

                                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] [TEXT VERSION] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_line)){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_line = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_line);

                                }

                                $oCRNRSTN_PROXYMailer->Subject = trim($this->subject_line);

                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] Subject = '.$oCRNRSTN_PROXYMailer->Subject, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                        break;
                        case 'bulk':

                            //self::$oCRNRSTN_USR->error_log('oGabriel SWITCH() ENTRY CASE="bulk"', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            if(isset($this->priorityBulk[$email_experience_tracker])){

                                $oCRNRSTN_PROXYMailer->Priority = $this->priorityBulk[$email_experience_tracker];
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK Priority = '.$oCRNRSTN_PROXYMailer->Priority, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            if(isset($this->word_wrapBulk[$email_experience_tracker])){

                                $oCRNRSTN_PROXYMailer->WordWrap = $this->word_wrapBulk[$email_experience_tracker];
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK WordWrap = '.$oCRNRSTN_PROXYMailer->WordWrap, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            $oCRNRSTN_PROXYMailer->is_HTML = $this->is_HTMLBulk[$email_experience_tracker];

                            if($this->is_HTMLBulk[$email_experience_tracker]){

                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->html_messageBulk[$email_experience_tracker]) && strlen($this->html_messageBulk[$email_experience_tracker])>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->html_messageBulk[$email_experience_tracker];

                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PROXYMailer->AltBody = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PROXYMailer->AltBody), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PROXYMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK Body (text version) LENGTH = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->text_messageBulk[$email_experience_tracker])){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PROXYMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                    self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK [TEXT VERSION] Body = '.strlen($oCRNRSTN_PROXYMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_lineBulk[$email_experience_tracker])){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_lineBulk[$email_experience_tracker] = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_lineBulk[$email_experience_tracker]);

                                }

                                $oCRNRSTN_PROXYMailer->Subject = trim($this->subject_lineBulk[$email_experience_tracker]);

                                self::$oCRNRSTN_USR->error_log('oGabriel [PROXY] BULK Subject ['.$i.'] = '.$oCRNRSTN_PROXYMailer->Subject, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unknown bulk or single indicator,"'.$bulk_single_indicator.'" received.');

                            break;
                    }

                    self::$oCRNRSTN_USR->error_log('['.$i.'] oGabriel [PROXY] BULK - Returning FULLY EMAIL, CONNECTION and CONTENT CHARGED oCRNRSTN_PHPMailer to the oArray().', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    self::$oCRNRSTN_PROXYMailer_ARRAY[$i] = $oCRNRSTN_PROXYMailer;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No instances of the oCRNRSTN_PHPMailer class object could be found for their connectivity initialization.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return true;

    }

    private function initialize_message_content(){

        try{

            if(isset(self::$oCRNRSTN_PHPMailer_ARRAY)){

                $tmp_mailer_cnt = sizeof(self::$oCRNRSTN_PHPMailer_ARRAY);
                self::$oCRNRSTN_USR->error_log('oGabriel initialize_message_content for ['.$tmp_mailer_cnt.'] EMAIL', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                for($i=0; $i<$tmp_mailer_cnt; $i++){
                    self::$oCRNRSTN_USR->error_log('oGabriel initialize_message_content() RUNNING for ['.$i.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                    $oCRNRSTN_PHPMailer = self::$oCRNRSTN_PHPMailer_ARRAY[$i];
                    $email_experience_tracker = $this->PHPMailer_experience_tracker_ARRAY[$i];
                    $bulk_single_indicator = $this->PHPMailer_single_or_bulk_ARRAY[$i];

                    switch($bulk_single_indicator){
                        case 'single':

                            if(isset($this->priority)){

                                $oCRNRSTN_PHPMailer->Priority = $this->priority;
                                self::$oCRNRSTN_USR->error_log('oGabriel Priority = '.$oCRNRSTN_PHPMailer->Priority, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            if(isset($this->word_wrap)){

                                $oCRNRSTN_PHPMailer->WordWrap = $this->word_wrap;
                                self::$oCRNRSTN_USR->error_log('oGabriel WordWrap = '.$oCRNRSTN_PHPMailer->WordWrap, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            $oCRNRSTN_PHPMailer->IsHTML($this->is_HTML);

                            if($this->is_HTML){

                                self::$oCRNRSTN_USR->error_log('oGabriel IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->html_message) && strlen($this->html_message)>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_message = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_message);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->html_message;

                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PHPMailer->AltBody = $this->text_message;

                                        self::$oCRNRSTN_USR->error_log('oGabriel [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PHPMailer->AltBody), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        self::$oCRNRSTN_USR->error_log('oGabriel [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_message)){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                        }

                                        $oCRNRSTN_PHPMailer->Body = $this->text_message;

                                        self::$oCRNRSTN_USR->error_log('oGabriel Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_USR->error_log('oGabriel IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->text_message)){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_message = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_message);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->text_message;

                                    self::$oCRNRSTN_USR->error_log('oGabriel [TEXT VERSION] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_line)){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_line = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_line);

                                }

                                $oCRNRSTN_PHPMailer->Subject = trim($this->subject_line);

                                self::$oCRNRSTN_USR->error_log('oGabriel Subject = '.$oCRNRSTN_PHPMailer->Subject, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                        break;
                        case 'bulk':

                            //self::$oCRNRSTN_USR->error_log('oGabriel SWITCH() ENTRY CASE="bulk"', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            if(isset($this->priorityBulk[$email_experience_tracker])){

                                $oCRNRSTN_PHPMailer->Priority = $this->priorityBulk[$email_experience_tracker];
                                self::$oCRNRSTN_USR->error_log('oGabriel BULK Priority = '.$oCRNRSTN_PHPMailer->Priority, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            if(isset($this->word_wrapBulk[$email_experience_tracker])){

                                $oCRNRSTN_PHPMailer->WordWrap = $this->word_wrapBulk[$email_experience_tracker];
                                self::$oCRNRSTN_USR->error_log('oGabriel BULK WordWrap = '.$oCRNRSTN_PHPMailer->WordWrap, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                            $oCRNRSTN_PHPMailer->IsHTML($this->is_HTMLBulk[$email_experience_tracker]);

                            if($this->is_HTMLBulk[$email_experience_tracker]){

                                self::$oCRNRSTN_USR->error_log('oGabriel BULK IsHTML = TRUE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->html_messageBulk[$email_experience_tracker]) && strlen($this->html_messageBulk[$email_experience_tracker])>0){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_HTML_ARRAY[$email_experience_tracker])){

                                        $this->html_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_HTML_ARRAY[$email_experience_tracker]['content'], $this->html_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->html_messageBulk[$email_experience_tracker];

                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PHPMailer->AltBody = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_USR->error_log('oGabriel BULK [MULTIPART] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body).'| AltBody(text version) LENGTH = '.strlen($oCRNRSTN_PHPMailer->AltBody), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        self::$oCRNRSTN_USR->error_log('oGabriel BULK [HTML ONLY] Body LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }

                                }else{

                                    //
                                    // NO HTML BODY. ATTEMPT GRACEFUL DEGRADATION TO TEXT VERSION (AltBody).
                                    if(isset($this->text_messageBulk[$email_experience_tracker])){

                                        //
                                        // PROCESS DYNAMIC CONTENT
                                        if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                            $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                        }

                                        $oCRNRSTN_PHPMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                        self::$oCRNRSTN_USR->error_log('oGabriel BULK Body (text version) LENGTH = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                    }else{

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                    }

                                }

                            }else{

                                //
                                // isHTML = FALSE
                                self::$oCRNRSTN_USR->error_log('oGabriel BULK IsHTML = FALSE', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                if(isset($this->text_messageBulk[$email_experience_tracker])){

                                    //
                                    // PROCESS DYNAMIC CONTENT
                                    if(isset($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker])){

                                        $this->text_messageBulk[$email_experience_tracker] = str_replace($this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_TEXT_ARRAY[$email_experience_tracker]['content'], $this->text_messageBulk[$email_experience_tracker]);

                                    }

                                    $oCRNRSTN_PHPMailer->Body = $this->text_messageBulk[$email_experience_tracker];

                                    self::$oCRNRSTN_USR->error_log('oGabriel BULK [TEXT VERSION] Body = '.strlen($oCRNRSTN_PHPMailer->Body), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                                }else{

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('No message body has been provided via either oCRNRSTN_USR->addBody() or oCRNRSTN_USR->addAltBody().');

                                }
                            }

                            if(isset($this->subject_lineBulk[$email_experience_tracker])){

                                //
                                // PROCESS DYNAMIC CONTENT
                                if(isset($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker])){

                                    $this->subject_lineBulk[$email_experience_tracker] = str_replace($this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['placeholder'], $this->dynamic_content_SUBJECT_ARRAY[$email_experience_tracker]['content'], $this->subject_lineBulk[$email_experience_tracker]);

                                }

                                $oCRNRSTN_PHPMailer->Subject = trim($this->subject_lineBulk[$email_experience_tracker]);

                                self::$oCRNRSTN_USR->error_log('oGabriel BULK Subject ['.$i.'] = '.$oCRNRSTN_PHPMailer->Subject, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

                            }

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unknown bulk or single indicator,"'.$bulk_single_indicator.'" received.');

                        break;
                    }

                    self::$oCRNRSTN_USR->error_log('['.$i.'] oGabriel BULK - Returning FULLY EMAIL, CONNECTION and CONTENT CHARGED oCRNRSTN_PHPMailer to the oArray().', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');
                    self::$oCRNRSTN_PHPMailer_ARRAY[$i] = $oCRNRSTN_PHPMailer;

                }

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No instances of the oCRNRSTN_PHPMailer class object could be found for their connectivity initialization.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return true;

    }

    public function sendStatusReportEmail($recipient_email, $recipient_name){

	    self::$oCRNRSTN_USR->error_log('Trigger status report email to '.$recipient_name.' at '.self::$oCRNRSTN_USR->stringSanitize($recipient_email, 'email_private').'.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oGABRIEL');

	}

    private function clean_system_email($email_str){

        $email_str = trim(strtolower($email_str));

	    return $email_str;

    }

    private function clean_system_email_comma_delimited($email_str, $key_by_index = false, $keep_raw = true){

        $output_email_array = array();

        $tmp_array = explode(',', $email_str);
        $tmp_email_cnt = sizeof($tmp_array);

        if($keep_raw){

            if($key_by_index){

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    //
                    // THIS WILL REMOVE ALL DUPLICATES
                    $output_email_array['RAW'][trim($tmp_array[$i])] = 1;
                    $output_email_array['SYS_FORMATTED'][trim(strtolower($tmp_array[$i]))] = 1;

                }

            }else{

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    $output_email_array['RAW'][] = trim($tmp_array[$i]);
                    $output_email_array['SYS_FORMATTED'][] = trim(strtolower($tmp_array[$i]));

                }

            }

        }else{

            if($key_by_index){

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    //
                    // THIS WILL REMOVE ALL DUPLICATES
                    $output_email_array['SYS_FORMATTED'][trim(strtolower($tmp_array[$i]))] = 1;

                }

            }else{

                for($i=0; $i<$tmp_email_cnt; $i++) {

                    $output_email_array['SYS_FORMATTED'][] = trim(strtolower($tmp_array[$i]));

                }

            }

        }

        return $output_email_array;

    }

    private function return_CRNRSTN_SysMsgHTMLBody($msgType){

	    try{

            switch($msgType){
                case 'ELECTRUM_PERFORMANCE_REPORT':

                    $tmp_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="'.self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'favicon.ico?v=420" />
    <title>CRNRSTN ::</title>
</head>

<body style="background-color: #FFF; width:100%; text-align: center; margin:0px auto;">
<table cellpadding="0" cellspacing="0" border="0" width="810" style="width:810px; text-align: center; margin:0px auto;">
    <tr>
        <td><div style="line-height:13px; font-size:12px;">&nbsp;<br>&nbsp;</div></td>
    </tr>
    <tr>
        <td>

            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; background-color: #FFF; text-align: center; margin:0px auto;">
                <tr><td style="text-align: left;"><div style="border-top: 10px solid #FFF;border-left: 15px solid #FFF;border-bottom: 10px solid #FFF;">{SYS_LOG_INTEGER_CONSTANT}</div></td></tr>
                <tr><td>

                    <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; border:2px solid #D2D2D2;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:180px;"><div style="border-top: 10px solid #FFF;border-left: 10px solid #FFF;"><img src="http://v2.crnrstn.evifweb.com/common/imgs/email/logo_wht_medium.gif" width="160" height="100" alt="CRNRSTN ::" title="CRNRSTN ::" /></div></td>
                                                    <td valign="top" align="right" style="text-align:right;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="610" style="border-bottom:10px solid #FFF; border-right: 10px solid #FFF; text-align: right;">
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:15px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:25px; text-align:right;font-weight: bold;">{SYS_MESSAGE_TITLE_HTML}</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-align:right; font-weight: bold;">Sending IP Address<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYS_REMOTE_ADDR} (<a href="http://{SYS_SERVER_NAME}" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">{SYS_SERVER_NAME}</a>)</div></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:right; font-weight: bold;">System Timestamp / Process Runtime<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYS_SYSTEM_TIME} / {PROCESS_RUN_TIME} seconds</div></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:2px solid #FF0000;" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:19px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:15px solid #FFF; border-right:15px solid #FFF; line-height:30px;">
                                                            {SYS_MESSAGE_HTML}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #F0F0F0;">
                                            <div style="border-left:15px solid #F0F0F0; border-top:15px solid #F0F0F0; border-bottom:15px solid #F0F0F0; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Electrum - Performance Overview</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Start Time :: {START_TIME}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">End Time :: {END_TIME}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Total Run Time :: {PRETTY_RUN_TIME}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of files transferred :: {TOTAL_COUNT_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of files skipped :: {TOTAL_COUNT_FILES_SKIPPED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Total file size of transferred data :: {TOTAL_FILESIZE_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of file transfer errors experienced :: {TOTAL_ERRORS_FILES_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Number of endpoint connection errors experienced :: {TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="border-left:15px solid #FFF; border-top:10px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">Percentage of files successfully transferred :: {PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}</div>
                                        </td>
                                    </tr>
                                    <tr><td><div style="font-size: 12px; line-height: 14px;">&nbsp;</div></td></tr>
                                    <tr>
                                        <td style="background-color: #F0F0F0;">
                                            <div style="border-left:15px solid #F0F0F0; border-top:15px solid #F0F0F0; border-bottom:15px solid #F0F0F0;  font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Data Sources</div>
                                        </td>
                                    </tr>
                                    {ELECTRUM_DATA_SOURCE_HTML}
                                    <tr><td><div style="font-size: 12px; line-height: 14px;">&nbsp;</div></td></tr>
                                    <tr>
                                        <td style="background-color: #F0F0F0">
                                            <div style="border-left:15px solid #F0F0F0; border-top:15px solid #F0F0F0; border-bottom:15px solid #F0F0F0; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Data Destinations</div>
                                        </td>
                                    </tr>
                                    {ELECTRUM_DATA_DESTINATION_HTML}
                                    <tr><td><div style="font-size: 12px; line-height: 14px;">&nbsp;</div></td></tr>
                                    <tr>
                                        <td style="background-color: #F0F0F0;">
                                            <div style="border-left:15px solid #F0F0F0; border-top:15px solid #F0F0F0; border-bottom:15px solid #F0F0F0;  font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">Electrum - Data Handling Profile </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {ELECTRUM_DATA_HANDLING_PROFILE_HTML}
                                        </td>
                                    </tr>
                                    {ELECTRUM_ERRORS_TRACE_HTML}
                                    <tr>
                                        <td><span style="font-size: 5px; line-height: 8px;">&nbsp;</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border-top:2px solid #D2D2D2; border-bottom:2px solid #D2D2D2;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td align="center"><div style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:12px; text-align:center; margin:0px auto; line-height: 18px; border-top:10px solid #FFF; border-bottom:10px solid #FFF;">&copy; 2020 Jonathan J5 Harris,<br><em>All Rights Reserved in accordance with the most recent version of the MIT License.</em></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" align="left" style="text-align: left; width: 600px;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; border-left:20px solid #FFF; border-top:30px solid #FFF;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">Please note that this information may<br>
                                                            not have been saved anywhere. For this reason, it<br>
                                                            may be good to maintain a copy of this email.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">This email was sent to {EMAIL}.<br>
                                                            If you wish to unsubscribe from future<br>
                                                            system notifications, please contact the<br>
                                                            website administrator.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;"><a href="http://jony5.com" target="_blank"><img src="http://v2.crnrstn.evifweb.com/common/imgs/email/5.gif" width="16" height="16" alt="5" title="5" border="0"></a></div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br></div>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                        <td align="right" style="text-align:right; border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;"><img src="http://v2.crnrstn.evifweb.com/common/imgs/email/j5_wolf_pup.jpg" width="167" height="200" alt="J5 wolf pup" title="J5 wolf pup" /></td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>

                </td></tr>
            </table>

        </td>
    </tr>
    <tr>

        <td><div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div></td>
    </tr>
</table>
</body>
</html>';

                break;
                case 'EXCEPTION_NOTIFICATION':

                    $tmp_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="'.self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'favicon.ico?v=420" />
    <title>CRNRSTN ::</title>
</head>

<body style="background-color: #FFF; width:100%; text-align: center; margin:0px auto;">
<table cellpadding="0" cellspacing="0" border="0" width="810" style="width:810px; text-align: center; margin:0px auto;">
    <tr>
        <td><div style="line-height:13px; font-size:12px;">&nbsp;<br>&nbsp;</div></td>
    </tr>
    <tr>
        <td>

            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; background-color: #FFF; text-align: center; margin:0px auto;">
                <tr><td style="text-align: left;"><div style="border-top: 10px solid #FFF;border-left: 15px solid #FFF;border-bottom: 10px solid #FFF;">{SYSTEM_LOG_INTEGER_CONSTANT}</div></td></tr>
                <tr><td>

                    <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:800px; border:2px solid #D2D2D2;">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td style="width:180px;"><div style="border-top: 10px solid #FFF;border-left: 10px solid #FFF;"><img src="http://v2.crnrstn.evifweb.com/common/imgs/email/logo_wht_medium.gif" width="160" height="100" alt="CRNRSTN ::" title="CRNRSTN ::" /></div></td>
                                                    <td valign="top" align="right" style="text-align:right;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="610" style="border-bottom:10px solid #FFF; border-right: 10px solid #FFF; text-align: right;">
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                <div style="border-top:15px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:25px; text-align:right;font-weight: bold;">C<span style="font-family:Arial, Helvetica, sans-serif; font-size:25px; color:#FF0000;">R</span>NRSTN :: Exception Notification</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;text-align:right; font-weight: bold;">Sending IP Address<br><div style="font-weight: normal; border-top: 4px solid #FFF;">'.$_SERVER['REMOTE_ADDR'].' (<a href="http://'.$_SERVER['SERVER_NAME'].'" target="_blank" style="text-decoration: none; color:#0066CC; text-decoration: underline;">'.$_SERVER['SERVER_NAME'].'</a>)</div></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="text-align: right;">
                                                                    <div style="border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:right; font-weight: bold;">System Timestamp / Process Runtime<br><div style="font-weight: normal; border-top: 4px solid #FFF;">{SYSTEM_TIME} / {PROCESS_RUN_TIME} seconds</div></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border:2px solid #FF0000;" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:19px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:15px solid #FFF; border-right:15px solid #FFF; line-height:30px;">
                                                        {MESSAGE}
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-bottom: 3px solid #A7C2E6; width:100%;"><br></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>Class::Method (or file):</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{METHOD}</div>
                                                        
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; border-top:10px solid #FFF;"><strong>Line Number:</strong></div>
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">{LINE_NUM}</div>
                                                        
                                                    </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-left:5px solid #FFF; border-right:5px solid #FFF;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td align="left" style="text-align: left;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; border-top:10px solid #FFF; border-bottom:10px solid #FFF; border-left:15px solid #FFF; border-right:15px solid #FFF; line-height:18px;">
                                                            &nbsp;<br>
                                                            <span style="color: #FF0000; font-weight: bold;">LOG TRACE</span><br><br>
                                                            <div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px;">
                                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            {LOG_TRACE}
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span style="font-size: 5px; line-height: 8px;">&nbsp;</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border-top:2px solid #D2D2D2; border-bottom:2px solid #D2D2D2;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td align="center"><div style="font-family:Arial, Helvetica, sans-serif; color:#333; font-size:12px; text-align:center; margin:0px auto; line-height: 18px; border-top:10px solid #FFF; border-bottom:10px solid #FFF;">&copy; 2020 Jonathan J5 Harris,<br><em>All Rights Reserved in accordance with the most recent version of the MIT License.</em></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" align="left" style="text-align: left; width: 600px;">

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td style="text-align: left; border-left:20px solid #FFF; border-top:30px solid #FFF;">
                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">Please note that this information may<br>
                                                            not have been saved anywhere. For this reason, it<br>
                                                            may be good to maintain a copy of this email.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal; line-height: 20px;">This email was sent to {EMAIL}.<br>
                                                            If you wish to unsubscribe from future<br>
                                                            system notifications, please contact the<br>
                                                            website administrator.</div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br></div>

                                                        <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;"><a href="http://jony5.com" target="_blank"><img src="http://v2.crnrstn.evifweb.com/common/imgs/email/5.gif" width="16" height="16" alt="5" title="5" border="0"></a></div>

                                                        <div style="font-size:14px; line-height: 16px;">&nbsp;<br></div>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                        <td align="right" style="text-align:right; border-top:10px solid #FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;"><img src="http://v2.crnrstn.evifweb.com/common/imgs/email/j5_wolf_pup.jpg" width="167" height="200" alt="J5 wolf pup" title="J5 wolf pup" /></td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>

                </td></tr>
            </table>

        </td>
    </tr>
    <tr>

        <td><div style="font-size:14px; line-height: 16px;">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div></td>
    </tr>
</table>
</body>
</html>';
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown HTML message body, "'.$msgType.'", requested.');

                break;
            }

            return $tmp_body;

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }


    }

    private function return_CRNRSTN_SysMsgTEXTBody($msgType){

	    try{
	        
	        switch($msgType){
                case 'ELECTRUM_PERFORMANCE_REPORT':

                    $tmp_body = '{SYS_MESSAGE_TITLE_TEXT}
= = = = = = = = = = = = = = = = = = = = = = = = =
{SYS_LOG_INTEGER_CONSTANT}

SYSTEM MESSAGE ::
{SYS_MESSAGE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = =
Sending IP Address ::
{SYS_REMOTE_ADDR} ({SYS_SERVER_NAME})

System Timestamp ::
{SYS_SYSTEM_TIME}

Process Runtime ::
{PROCESS_RUN_TIME} seconds

= = = = = = = = = = = = = = = = = = = = = = = = =
Electrum - Performance Overview
Start Time :: {START_TIME}
End Time :: {END_TIME}
Total Run Time :: {PRETTY_RUN_TIME}
Number of files transferred :: {TOTAL_COUNT_FILES_TRANSFERRED}
Number of files skipped :: {TOTAL_COUNT_FILES_SKIPPED}
Total file size of transferred data :: {TOTAL_FILESIZE_FILES_TRANSFERRED}
Number of file transfer errors experienced :: {TOTAL_ERRORS_FILES_TRANSFERRED}
Number of endpoint connection errors experienced :: {TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR}
Percentage of files successfully transferred :: {PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED}

= = = = = = = = = = = = = = = = = = = = = = = = =
Data Sources
{ELECTRUM_DATA_SOURCE_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = =
Data Destinations
{ELECTRUM_DATA_DESTINATION_TEXT}

= = = = = = = = = = = = = = = = = = = = = = = = =
Electrum - Data Handling Profile
{ELECTRUM_DATA_HANDLING_PROFILE_TEXT}

{ELECTRUM_ERRORS_TRACE_TITLE_TEXT}
{ELECTRUM_ERRORS_TRACE_TEXT}
= = = = = = = = = = = = = = = = = = = = = = = = =
(c) 2020 Jonathan J5 Harris,
All Rights Reserved in accordance with the most
recent version of the MIT License.

= = = = = = = = = = = = = = = = = = = = = = = = =
Please note that this information may
not have been saved anywhere. For this reason, it
may be good to maintain a copy of this email.


This email was sent to {EMAIL}.
If you wish to unsubscribe from future
system notifications, please contact the
website administrator.
';

                break;
                case 'EXCEPTION_NOTIFICATION':

                    $tmp_body = 'CRNRSTN :: Exception Notification
= = = = = = = = = = = = = = = = = = = = = = = = =
{SYSTEM_LOG_INTEGER_CONSTANT}

SYSTEM MESSAGE  ::
{MESSAGE}

LINE NUMBER ::
{LINE_NUM}

CLASS::METHOD (or file) ::
{METHOD}

= = = = = = = = = = = = = = = = = = = = = = = = =
Sending IP Address ::
'.$_SERVER['REMOTE_ADDR'].' ('.$_SERVER['SERVER_NAME'].')

System Timestamp ::
{SYSTEM_TIME}

Process Runtime ::
{PROCESS_RUN_TIME} seconds

= = = = = = = = = = = = = = = = = = = = = = = = =
(c) 2020 Jonathan J5 Harris,
All Rights Reserved in accordance with the most
recent version of the MIT License.

= = = = = = = = = = = = = = = = = = = = = = = = =
Please note that this information may
not have been saved anywhere. For this reason, it
may be good to maintain a copy of this email.


This email was sent to {EMAIL}.
If you wish to unsubscribe from future
system notifications, please contact the
website administrator.

= = = = = = = = = = = = = = = = = = = = = = = = =
LOG TRACE

{LOG_TRACE}

';
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown TEXT message body, "'.$msgType.'", requested.');

                break;

            }

            return $tmp_body;

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

	public function __destruct() {

	}
}


# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_highway_of_the_king
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: September 21, 2020 @ 2230hrs
class crnrstn_highway_of_the_king{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $proxy_cipher_override;
    protected $proxy_secret_key_override;
    protected $proxy_hmac_algorithm_override;
    protected $proxy_options_bitwise_override;

    protected $sender_email;
    protected $sender_name;
    protected $recipient_email;
    protected $recipient_name;

    protected $replyto_email_ARRAY = array();
    protected $replyto_name_ARRAY = array();
    protected $cc_email_ARRAY = array();
    protected $cc_name_ARRAY = array();
    protected $bcc_email_ARRAY = array();
    protected $bcc_name_ARRAY = array();

    public $Priority = 3;
    public $WordWrap = 72;
    public $is_HTML = false;
    public $Body;
    public $AltBody;
    public $Subject;

    public function __construct($oCRNRSTN_USR){

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

    }

    public function setFrom($sender_email, $sender_name){

        $this->sender_email = $sender_email;
        $this->sender_name = $sender_name;

    }

    #1428
    public function addAddress($email, $name){

        $this->recipient_email = $email;
        $this->recipient_name = $name;

    }

    public function addReplyTo($replyto_email, $replyto_name){

        $this->replyto_email_ARRAY[] = $replyto_email;
        $this->replyto_name_ARRAY[] = $replyto_name;

    }

    #1450
    public function addCC($cc_email, $cc_name){

        $this->cc_email_ARRAY[] = $cc_email;
        $this->cc_name_ARRAY[] = $cc_name;

    }

    public function addBCC($bcc_email, $bcc_name){

        $this->bcc_email_ARRAY[] = $bcc_email;
        $this->bcc_name_ARRAY[] = $bcc_name;

    }

    public function return_cipher(){

        return $this->proxy_cipher_override;

    }

    public function return_secret_key(){

        return $this->proxy_secret_key_override;

    }

    public function return_hmac_algorithm(){

        return $this->proxy_hmac_algorithm_override;

    }

    public function return_options_bitwise(){

        return $this->proxy_options_bitwise_override;

    }

    /*
    public function send($proxy_endpoint_uri, $proxy_endpoint_auth_key, $proxy_cipher_override=NULL, $proxy_secret_key_override=NULL, $proxy_hmac_algorithm_override=NULL, $proxy_options_bitwise_override=NULL){

        $this->proxy_cipher_override = $proxy_cipher_override;
        $this->proxy_secret_key_override = $proxy_secret_key_override;
        $this->proxy_hmac_algorithm_override = $proxy_hmac_algorithm_override;
        $this->proxy_options_bitwise_override = $proxy_options_bitwise_override;

        //
        // ASSEMBLE REQUEST AND SEND
        $cc_email_str = '';
        $cc_name_str = '';
        $bcc_email_str = '';
        $bcc_name_str = '';
        $replyto_email_str = '';
        $replyto_name_str = '';

        if(isset($this->cc_email_ARRAY)){
            $tmp_cnt = sizeof($this->cc_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $cc_email_str .= $this->cc_email_ARRAY[$i].',';
                $cc_name_str .= $this->cc_name_ARRAY[$i].',';

            }

            $cc_email_str = rtrim($cc_email_str, ',');
            $cc_name_str = rtrim($cc_name_str, ',');

        }

        if(isset($this->bcc_email_ARRAY)){
            $tmp_cnt = sizeof($this->bcc_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $bcc_email_str .= $this->bcc_email_ARRAY[$i].',';
                $bcc_name_str .= $this->bcc_name_ARRAY[$i].',';

            }

            $bcc_email_str = rtrim($bcc_email_str, ',');
            $bcc_name_str = rtrim($bcc_name_str, ',');

        }

        if(isset($this->replyto_email_ARRAY)){
            $tmp_cnt = sizeof($this->replyto_email_ARRAY);
            for($i=0; $i<$tmp_cnt; $i++){

                $replyto_email_str .= $this->replyto_email_ARRAY[$i].',';
                $replyto_name_str .= $this->replyto_name_ARRAY[$i].',';

            }

            $replyto_email_str = rtrim($replyto_email_str, ',');
            $replyto_name_str = rtrim($replyto_name_str, ',');

        }

        //
        // NEW WILD CARD RESOURCE - FTP
        $oWCR = self::$oCRNRSTN_USR->defineWildCardResource('THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION');
        $oWCR->addAttribute('CRNRSTN_PROXY_AUTH_KEY', $proxy_endpoint_auth_key);
        $oWCR->addAttribute('CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/');
        $oWCR->addAttribute('RECIPIENT_EMAIL_COMMA_DELIM', $this->recipient_email);
        $oWCR->addAttribute('RECIPIENT_NAME_COMMA_DELIM', $this->recipient_name);
        $oWCR->addAttribute('FROM_EMAIL', $this->sender_email);
        $oWCR->addAttribute('FROM_NAME', $this->sender_name);
        $oWCR->addAttribute('REPLY_TO_EMAIL_COMMA_DELIM', $replyto_email_str);
        $oWCR->addAttribute('REPLY_TO_NAME_COMMA_DELIM', $replyto_name_str);
        $oWCR->addAttribute('CC_EMAIL_COMMA_DELIM', $cc_email_str);
        $oWCR->addAttribute('CC_NAME_COMMA_DELIM', $cc_name_str);
        $oWCR->addAttribute('BCC_EMAIL_COMMA_DELIM', $bcc_email_str);
        $oWCR->addAttribute('BCC_NAME_COMMA_DELIM', $bcc_name_str);
        $oWCR->addAttribute('MESSAGE_SUBJECT', $this->Subject);
        $oWCR->addAttribute('MESSAGE_BODY_HTML', $this->Body);
        $oWCR->addAttribute('MESSAGE_BODY_TEXT', $this->AltBody);
        $oWCR->addAttribute('WORD_WRAP', $this->WordWrap);
        $oWCR->addAttribute('PRIORITY', $this->Priority);
        if($this->is_HTML){

            $oWCR->addAttribute('IS_HTML', 'true');

        }else{

            $oWCR->addAttribute('IS_HTML', 'false');

        }

        self::$oCRNRSTN_USR->saveWildCardResource($oWCR);

        $endpoint_URI = self::$oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_WSDL_ENDPOINT');
        return self::$oCRNRSTN_USR->proxyEmailFire('THE_KINGS_HIGHWAY_oGABRIEL_NOTIFICATION', $endpoint_URI, $this);

    }
    */

    public function __destruct(){

    }
}
