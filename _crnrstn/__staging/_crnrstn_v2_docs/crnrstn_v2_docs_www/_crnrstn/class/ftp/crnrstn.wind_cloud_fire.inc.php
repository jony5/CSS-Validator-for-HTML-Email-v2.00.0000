<?php
/*
// J5
// Code is Poetry */

# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_wind_cloud_fire
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 2.0.0
#  CLASS DATE :: September 12, 2020 @ 0646hrs
#  EZEKIEL 1:4 - AND I LOOKED, AND THERE CAME A STORM WIND FROM THE NORTH, A GREAT CLOUD AND A FIRE
#  FLASHING INCESSANTLY; AND THERE WAS A BRIGHTNESS AROUND IT, AND FROM THE MIDST OF IT
#  THERE WAS SOMETHING LIKE THE SIGHT OF ELECTRUM, FROM THE MIDST OF THE FIRE.
class crnrstn_wind_cloud_fire {

    protected $oLogger;
    private static $oCRNRSTN_USR;
    private static $oFourLivingCreatures_FTP;
    protected $oLighting_bolt_ARRAY = array();
    protected $oWheel_high_awesome_ARRAY = array();

    public $electrum_process_id;
    protected $preload_spoiled_ARRAY = array();
    protected $asset_transfer_suppression_ARRAY = array();
    protected $processed_source_ARRAY = array();
    protected $processed_destination_ARRAY = array();

    protected $execute_to_destination_authorization;
    protected $execute_from_source_authorization;

    protected $queued_endpoint_ARRAY = array();
    protected $source_total_filesize_ARRAY = array();

    protected $FtpToFtp_tmp_dirPath;
    protected $timestamp_nom_pattern;
    protected $global_execute_authorization = true;
    protected $global_execute_authorization_reason = '';

    protected $directory_content_ARRAY = array();

    protected $source_file_size_at_path_ARRAY = array();
    protected $source_file_lastaccess_at_path_ARRAY = array();
    protected $source_file_lastmodify_at_path_ARRAY = array();
    protected $source_file_blocksize_at_path_ARRAY = array();
    protected $source_file_blockallocate_at_path_ARRAY = array();
    protected $source_file_fullpermissions_at_path_ARRAY = array();
    protected $source_file_octalpermissions_at_path_ARRAY = array();
    protected $source_file_uid_STRING_at_path_ARRAY = array();
    protected $source_file_gid_STRING_at_path_ARRAY = array();
    protected $source_file_uid_INT_at_path_ARRAY = array();
    protected $source_file_gid_INT_at_path_ARRAY = array();

    protected $max_storage_utilization = 90;

    protected $ftp_recursive_sniffed_directory_ARRAY = array();

    protected $execution_batch_serial;

    protected $notifications_email_pipe_delim;
    protected $notifications_sender;
    protected $notifications_replyto_pipe_delim;
    protected $notifications_cc_pipe_delim;
    protected $notifications_bcc_pipe_delim;

    protected $notifications_profile;
    protected $notifications_SOAP_endpoint;
    protected $notifications_email_protocol;

    protected $secret_key_override;
    protected $cipher_override;
    protected $hmac_algorithm_override;
    protected $options_bitwise_override;

    protected $startTime;
    protected $endTime;
    protected $elapsedTime;

    public function __construct($oCRNRSTN_USR, $FtpToFtp_tmp_dirPath, $timestamp_versioning_pattern){

        try{

            //
            // INSTANTIATE CRNRSTN_USR CLASS OBJECT
            self::$oCRNRSTN_USR = $oCRNRSTN_USR;

            //
            // INSTANTIATE LOGGER  CLASS OBJECT
            $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

            $this->electrum_process_id = self::$oCRNRSTN_USR->generateNewKey(100);  // START_ELECTRUM_PROCESS_ID

            $this->startTime = self::$oCRNRSTN_USR->getMicroTime();
            $this->elapsedTime = self::$oCRNRSTN_USR->elapsedDeltaTimeFor('ELECTRUM_PERFORMANCE_CLIENT');

            //
            // BATCH EXECUTION SERIALIZATION
            $this->execution_batch_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            $this->FtpToFtp_tmp_dirPath = $FtpToFtp_tmp_dirPath;
            $this->timestamp_nom_pattern = $timestamp_versioning_pattern;

            if($this->validate_DIR_Endpoint('DESTINATION', $this->FtpToFtp_tmp_dirPath)){

                if($this->validate_DIR_Endpoint('SOURCE', $this->FtpToFtp_tmp_dirPath)){


                }else{

                    $this->global_execute_authorization = false;
                    $this->global_execute_authorization_reason = 'ERR420.5 - Invalid read permissions at _tmp directory path passed to oCRNRSTN_USR->initElectrum_FileCopy().';

                    if(is_dir($this->FtpToFtp_tmp_dirPath)){

                        $tmp_current_perms = substr(decoct( fileperms($this->FtpToFtp_tmp_dirPath) ), 2);

                    }else{

                        $tmp_current_perms = 'invalid path';

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum constructor failed due to the provided temporary directory endpoint ('.$this->FtpToFtp_tmp_dirPath.') being an invalid source ('.$tmp_current_perms.') for temporary asset retrieval.');

                }

            }else{

                $this->global_execute_authorization = false;
                $this->global_execute_authorization_reason = 'ERR420.0 - Invalid write permissions at _tmp directory path passed to oCRNRSTN_USR->initElectrum_FileCopy().';

                if(is_dir($this->FtpToFtp_tmp_dirPath)){

                    $tmp_current_perms = substr(decoct( fileperms($this->FtpToFtp_tmp_dirPath) ), 2);

                }else{

                    $tmp_current_perms = 'invalid path';

                }

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The CRNRSTN :: Electrum constructor failed due to the provided temporary directory endpoint ('.$this->FtpToFtp_tmp_dirPath.') being an invalid destination ('.$tmp_current_perms.') for temporary asset storage.');

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    private function return_oElectrumPerfReportSOAP($execution_serial, $batch_serial){

        $this->secret_key_override = self::$oCRNRSTN_USR->return_secret_key_override($this->notifications_SOAP_endpoint);
        $this->cipher_override = self::$oCRNRSTN_USR->return_cipher_override($this->notifications_SOAP_endpoint);
        $this->hmac_algorithm_override = self::$oCRNRSTN_USR->return_hmac_algorithm_override($this->notifications_SOAP_endpoint);
        $this->options_bitwise_override = self::$oCRNRSTN_USR->return_options_bitwise_override($this->notifications_SOAP_endpoint);

        //error_log('155 - electrum notifications_email_pipe_delim='.$this->notifications_email_pipe_delim);
        $tmp_RECIPIENT_ARRAY = self::$oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_email_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);
        //error_log('157 electrum email array size = '.sizeof($tmp_RECIPIENT_ARRAY));
        if(isset($this->notifications_sender)){

            $tmp_SENDER_ARRAY = self::$oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_sender, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{
            $tmp_SENDER_ARRAY = array();
        }

        if(isset($this->notifications_replyto_pipe_delim)){

            $tmp_REPLYTO_ARRAY = self::$oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_replyto_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{
            $tmp_REPLYTO_ARRAY = array();
        }

        if(isset($this->notifications_cc_pipe_delim)){

            $tmp_CC_ARRAY = self::$oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_cc_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{
            $tmp_CC_ARRAY = array();
        }

        if(isset($this->notifications_bcc_pipe_delim)){

            $tmp_BCC_ARRAY = self::$oCRNRSTN_USR->return_oEmailArraySOAP_struct($this->notifications_bcc_pipe_delim, NULL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override);

        }else{
            $tmp_BCC_ARRAY = array();
        }

        $tmp_runtime = self::$oCRNRSTN_USR->wallTime();
        $tmp_microsecs_explode = explode(".", $tmp_runtime);

        $this->soapRequest_ARRAY = array('oElectrumPerformanceReport' =>
            array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                'CRNRSTN_PROXY_AUTH_KEY' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->getEnvResource('CRNRSTN_PROXY_AUTH_KEY'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_PROXY_EMAIL_PROTOCOL' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->notifications_email_protocol, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'oRECIPIENT' => $tmp_RECIPIENT_ARRAY,
                'oSENDER' => $tmp_SENDER_ARRAY,
                'oREPLYTO' => $tmp_REPLYTO_ARRAY,
                'oCC' => $tmp_CC_ARRAY,
                'oBCC' => $tmp_BCC_ARRAY,
                'SUPPRESS_DUPLICATE_RECIPIENT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('true', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'MESSAGE_SUBJECT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: Electrum performance report from '.$_SERVER['REMOTE_ADDR'].' ('.$_SERVER['SERVER_NAME'].')', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'WORD_WRAP' => self::$oCRNRSTN_USR->paramTunnelEncrypt('72', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'PRIORITY' => self::$oCRNRSTN_USR->paramTunnelEncrypt('3', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'IS_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('true', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_TITLE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('C<span style="color: #FF0000;">R</span>NRSTN :: Electrum Performance Notification', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_TITLE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: Electrum Performance Notification', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_LOG_INTEGER_CONSTANT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('LOG_INFO', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt('The <span style="font-weight: normal;">C<span style="color: #FF0000;">R</span>NRSTN :: Electrum process has completed successfully.</span>', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_MESSAGE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('The CRNRSTN :: Electrum process has completed successfully.', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_REMOTE_ADDR' => self::$oCRNRSTN_USR->paramTunnelEncrypt($_SERVER['REMOTE_ADDR'], $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_SERVER_NAME' => self::$oCRNRSTN_USR->paramTunnelEncrypt($_SERVER['SERVER_NAME'], $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_SYSTEM_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->return_queryDateTimeStamp(), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SYS_PROCESS_RUN_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt($tmp_runtime, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_START_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->startTime, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_END_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->endTime, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_PRETTY_RUN_TIME' => self::$oCRNRSTN_USR->paramTunnelEncrypt(self::$oCRNRSTN_USR->return_prettyDeltaTime($this->elapsedTime, $tmp_microsecs_explode[1]), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_COUNT_FILES_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_COUNT_FILES_SKIPPED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_FILESIZE_FILES_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_ERRORS_FILES_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED' => self::$oCRNRSTN_USR->paramTunnelEncrypt('{PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED_}', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_SOURCE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_SOURCE_HTML','HTML'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_DESTINATION_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_DESTINATION_HTML','HTML'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_HANDLING_PROFILE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_HANDLING_PROFILE_HTML', 'HTML'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_SOURCE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_SOURCE_TEXT','HTML'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_DESTINATION_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_DESTINATION_TEXT', 'HTML'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_DATA_HANDLING_PROFILE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT_','HTML'),$this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_TITLE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt('CRNRSTN :: ELECTRUM ERRORS LOG TRACE', $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_HTML' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_ERRORS_TRACE_HTML', 'HTML'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_TEXT' => self::$oCRNRSTN_USR->paramTunnelEncrypt($this->return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, 'ELECTRUM_ERRORS_TRACE_TEXT'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override)

            ));

        return $this->soapRequest_ARRAY;

    }

    public function fire_reportingNotification($execution_serial, $batch_serial){

        try{

            /*
            $this->notifications_email_pipe_delim = $email_comma_delim;
            $this->notifications_profile = $notificationProfile;
            $this->notifications_SOAP_endpoint = $SOAP_endpoint;

    public function return_secret_key_override($SOAP_endpoint){

    public function return_cipher_override($SOAP_endpoint){

    public function return_hmac_algorithm_override($SOAP_endpoint){

    public function return_options_bitwise_override($SOAP_endpoint){

            $this->secret_key_override = self::$oCRNRSTN_USR->return_secret_key_override($this->notifications_SOAP_endpoint);
        $this->cipher_override = self::$oCRNRSTN_USR->return_cipher_override($this->notifications_SOAP_endpoint);
        $this->hmac_algorithm_override = self::$oCRNRSTN_USR->return_hmac_algorithm_override($this->notifications_SOAP_endpoint);
        $this->options_bitwise_override = self::$oCRNRSTN_USR->return_options_bitwise_override($this->notifications_SOAP_endpoint);

            */

            if(isset($this->notifications_profile)){

                if($this->notifications_email_pipe_delim!=''){

                    switch($this->notifications_profile){
                        case 'EMAIL_PROXY':

                            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process notification report profile is '.$this->notifications_profile, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

                            //
                            // BUILD SOAP REQUEST OBJECT
                            $SOAP_request = $this->return_oElectrumPerfReportSOAP($execution_serial, $batch_serial);

                            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process notification SOAP endpoint='.$this->notifications_SOAP_endpoint, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

                            if(isset($this->notifications_SOAP_endpoint)){

                                $response = self::$oCRNRSTN_USR->clientSend_CRNRSTN_SOAP_REQUEST('send_electrumPerformanceReport', $SOAP_request, $this->notifications_SOAP_endpoint);

                            }else{

                                $response = self::$oCRNRSTN_USR->clientSend_CRNRSTN_SOAP_REQUEST('send_electrumPerformanceReport', $SOAP_request);

                            }

                            //self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response [RAW DATA] CRNRSTN_PROXY_AUTH_KEY=['.$response['CRNRSTN_PROXY_AUTH_KEY'].'] REQUEST_RUNTIME=['.$response['REQUEST_RUNTIME'].'] TOTAL_EMAILS_RECEIVED=['.$response['TOTAL_EMAILS_RECEIVED'].'] TOTAL_EMAILS_SENT=['.$response['TOTAL_EMAILS_SENT'].'] TOTAL_EMAILS_ERROR=['.$response['TOTAL_EMAILS_ERROR'].'] TOTAL_EMAILS_SUPPRESSED=['.$response['TOTAL_EMAILS_SUPPRESSED'].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
                            //self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response [RAW DATA] REQUEST_RECEIVED_TIMESTAMP=['.$response['REQUEST_RECEIVED_TIMESTAMP'].'] REQUEST_COMPLETED_TIMESTAMP=['.$response['REQUEST_COMPLETED_TIMESTAMP'].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

                            //error_log('297 electrum - PROD DECRYPT SETTINGS='.$this->cipher_override.', '.$this->secret_key_override.', '.$this->hmac_algorithm_override.', '.$this->options_bitwise_override);
                            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process ran for '.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['REQUEST_RUNTIME'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).' seconds to produce the following SOAP response with '.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['TOTAL_EMAILS_ERROR'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).' send errors and '.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['TOTAL_EMAILS_SUPPRESSED'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).' suppressions [RAW DATA] REQUEST_RECEIVED_TIMESTAMP=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['REQUEST_RECEIVED_TIMESTAMP'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] REQUEST_COMPLETED_TIMESTAMP=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['REQUEST_COMPLETED_TIMESTAMP'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

                            foreach($response['oACTIVITY_STATUS_REPORT'] as $key=>$statusArray){

                                self::$oCRNRSTN_USR->error_log('['.self::$oCRNRSTN_USR->paramTunnelDecrypt($statusArray['EMAIL_PROXY_SERIAL'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
                                self::$oCRNRSTN_USR->error_log('['.self::$oCRNRSTN_USR->paramTunnelDecrypt($statusArray['IS_SENT'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
                                self::$oCRNRSTN_USR->error_log('['.self::$oCRNRSTN_USR->paramTunnelDecrypt($statusArray['SEND_TIMESTAMP'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
                                self::$oCRNRSTN_USR->error_log('['.self::$oCRNRSTN_USR->paramTunnelDecrypt($statusArray['SEND_STATUS'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
                                self::$oCRNRSTN_USR->error_log('['.self::$oCRNRSTN_USR->paramTunnelDecrypt($statusArray['STATUS_DETAIL'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

                            }

                            //self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response CRNRSTN_PROXY_AUTH_KEY=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['CRNRSTN_PROXY_AUTH_KEY'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] TOTAL_EMAILS_RECEIVED=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['TOTAL_EMAILS_RECEIVED'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] TOTAL_EMAILS_SENT=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['TOTAL_EMAILS_SENT'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] TOTAL_EMAILS_ERROR=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['TOTAL_EMAILS_ERROR'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
                            //self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process SOAP response EMAIL_PROXY_SERIAL[0]=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['oACTIVITY_STATUS_REPORT'][0]['EMAIL_PROXY_SERIAL'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] SEND_STATUS[0]=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['oACTIVITY_STATUS_REPORT'][0]['SEND_STATUS'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] EMAIL_PROXY_SERIAL[1]=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['oACTIVITY_STATUS_REPORT'][1]['EMAIL_PROXY_SERIAL'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).'] SEND_STATUS[1]=['.self::$oCRNRSTN_USR->paramTunnelDecrypt($response['oACTIVITY_STATUS_REPORT'][1]['SEND_STATUS'], true, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override).']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

                        break;
                        case 'EMAIL':



                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum communications notifications profile which has been provided is not supported.');

                        break;

                    }


                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum performance report request has not received any email address to which to send a report.');

                }

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function initNotifications($email_comma_delim, $notificationProfile, $SOAP_endpoint, $email_protocol){

        try{

            $notificationProfile = trim(strtoupper($notificationProfile));

            switch($notificationProfile){
                case 'EMAIL_PROXY':

                    $this->notifications_email_pipe_delim = $email_comma_delim;
                    $this->notifications_profile = trim(strtoupper($notificationProfile));
                    $this->notifications_SOAP_endpoint = $SOAP_endpoint;
                    $this->notifications_email_protocol = trim(strtoupper($email_protocol));

                break;
                case 'EMAIL':

                    $this->notifications_email_pipe_delim = $email_comma_delim;
                    $this->notifications_profile = trim(strtoupper($notificationProfile));
                    $this->notifications_SOAP_endpoint = NULL;
                    $this->notifications_email_protocol = NULL;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum initialization of its\' notification profile has failed due to unknown profile type, "'.$notificationProfile.'". Only "EMAIL" and "EMAIL_PROXY" are available options within CRNRSTN :: v2.0.0.');

                break;

            }

            return NULL;

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function isNotExluded_asset($filePath, $execution_batch_serial, $asset_transfer_suppression_ARRAY, $FIREHOT_oEndpoint_SOURCE){

        try{
            /*

            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_DIR($CRNRSTN_oELECTRUM, '*ment', 'ELECTRUM_SOURCE_FTP00');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_DIR($CRNRSTN_oELECTRUM, 'Projects', $local_dir_path_SOURCE00);
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_FILE($CRNRSTN_oELECTRUM, '*.pdf');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_FILE($CRNRSTN_oELECTRUM, '*crnrstn*.*');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_modifiedOlderThan($CRNRSTN_oELECTRUM, '30 days');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_modifiedNewerThan($CRNRSTN_oELECTRUM, '2 months');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_accessedOlderThan($CRNRSTN_oELECTRUM, '30 days');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_accessedNewerThan($CRNRSTN_oELECTRUM, '2 months');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_assetUserID($CRNRSTN_oELECTRUM, 'jony5');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_assetGroupID($CRNRSTN_oELECTRUM, 'root');
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_fileSizeGreaterThan($CRNRSTN_oELECTRUM, 1024);
            $CRNRSTN_oELECTRUM = $oCRNRSTN_USR->electrum_exclude_fileSizeLessThan($CRNRSTN_oELECTRUM, 150);

            */

            //
            // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
            $oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();
            $oEndpoint_connection_type = $FIREHOT_oEndpoint_SOURCE->return_connection_type();
            $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

            $exclusion_check_result = array();
            $exclusion_check_result['not_excluded'] = true;
            $exclusion_check_result['pattern'] = '';
            $exclusion_check_result['asset_meta'] = '';
            $exclusion_check_result['wcr_path_specified'] = '';
            $exclusion_check_result['pattern_type'] = '';

            $exclusion_profile_exclude_ARRAY = array();
            $all_excludes_open = true;

            if(isset($asset_transfer_suppression_ARRAY[$this->electrum_process_id])){

                foreach($asset_transfer_suppression_ARRAY[$this->electrum_process_id][$execution_batch_serial] as $key => $exclusion_profile_ARRAY) {

                    $exclusion_serial = $exclusion_profile_ARRAY['exclusion_serial'];
                    $exclusion_type = $exclusion_profile_ARRAY['exclusion_type'];
                    $WCRkey_or_DIRPATH = $exclusion_profile_ARRAY['WCR_or_path'];
                    $qualification_pattern = $exclusion_profile_ARRAY['pattern'];

                    $exclusion_check_result['wcr_path_specified'] = '';
                    $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern] = true;

                    if (isset($WCRkey_or_DIRPATH)) {
                        $all_excludes_open = false;

                        if ($oEndpoint_WCRkey_or_path != $WCRkey_or_DIRPATH && $WCRkey_or_DIRPATH != '' && $WCRkey_or_DIRPATH != NULL) {

                            $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern] = false;

                        }else{

                            $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern] = true;
                            $exclusion_check_result['wcr_path_specified'] = $WCRkey_or_DIRPATH;
                        }

                    }

                    //
                    // APPLY THIS EXCLUSION TO THIS ENDPOINT (SOURCE) ASSET
                    $exclusion_check_result['not_excluded'] = true;
                    $exclusion_check_result['pattern'] = '';
                    $exclusion_check_result['asset_meta'] = '';
                    $exclusion_check_result['exclusion_meta'] = '';
                    //self::$oCRNRSTN_USR->error_log('PROCESS EXCLUSION [' . $exclusion_type . '][' . $key . '][' . $filePath . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                    switch ($exclusion_type) {
                        case 'DIRECTORY':
                            #['DIRECTORY']['NOMINATION'][] = $WCRkey_or_DIRPATH;
                            #['DIRECTORY']['NOMINATION'][] = $qualification_pattern;

                            //
                            // USED FOR DIRECTORY CHECK IN ELECTRUM v1.0.0
                            //$tmp_exclude_pos = strpos($filePath, $condition_pattern);
                            //if(fnmatch($condition_pattern, $filePath) || ($tmp_exclude_pos !== false)){
                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(self::$oCRNRSTN_USR->isMatchedStrPattern($filePath, $qualification_pattern, false)){

                                    $exclusion_check_result['not_excluded'] = false;
                                    $exclusion_check_result['pattern'] = $qualification_pattern;
                                    $exclusion_check_result['asset_meta'] = $filePath;
                                    $exclusion_check_result['pattern_type'] = $exclusion_type;

                                    return $exclusion_check_result;

                                }

                            }

                        break;
                        case 'FILE':
                            #['FILE']['NOMINATION'][] = $qualification_pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                $tmp_filename = basename($filePath);
                                // basename() operates naively on the input string
                                if(self::$oCRNRSTN_USR->isMatchedStrPattern($tmp_filename, $qualification_pattern, false)){

                                    $exclusion_check_result['not_excluded'] = false;
                                    $exclusion_check_result['pattern'] = $qualification_pattern;
                                    $exclusion_check_result['asset_meta'] = $tmp_filename;
                                    $exclusion_check_result['pattern_type'] = $exclusion_type;

                                    return $exclusion_check_result;

                                }

                            }

                        break;
                        case 'OWNER_GROUP':
                            #['OWNER_GROUP']['GROUP_ID'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){
                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] OWNER_GROUP='.$this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].' *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED_NT ['.$this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');
                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        if($this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern || $this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'<->'.$this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'OWNER_USER':
                            #['OWNER_USER']['USER_ID'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] OWNER_USER ['.$this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');
                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        if($this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern || $this->source_file_uid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath] == $qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath].'<->'.$this->source_file_uid_INT_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'MODIFIED_NT':
                            #['MODIFIED_NT']['NEWER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED_NT ['.$this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');
                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        if(self::$oCRNRSTN_USR->isDateNewerThan($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'MODIFIED_OT':
                            #['MODIFIED_OT']['OLDER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED_OT ['.$this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');
                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] MODIFIED TIMESTAMP=['.date('D M j G:i:s T Y', $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath]).'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        if(self::$oCRNRSTN_USR->isDateOlderThan($this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'ACCESSED_NT':
                            #['ACCESSED_NT']['NEWER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] ACCESSED_NT ['.$this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        if(self::$oCRNRSTN_USR->isDateNewerThan($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'ACCESSED_OT':
                            #['ACCESSED_OT']['OLDER_THAN'][] = $pattern;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                if(isset($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum ['.$oEndpoint_connection_type.'] ACCESSED_OT ['.$this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath].'] *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                        if(self::$oCRNRSTN_USR->isDateOlderThan($this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath], $qualification_pattern)){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;
                                        }
                                    }
                                }
                            }

                        break;
                        case 'FILE_SIZE_GT':
                            #['FILE_SIZE_GT']['GREATER_THAN'][] = $bytes;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FILE_SIZE_GT EXCLUSION *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]>$qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;

                                        }

                                    }

                                }

                            }

                        break;
                        case 'FILE_SIZE_LT':
                            #['FILE_SIZE_LT']['LESS_THAN'][] = $bytes;

                            if($all_excludes_open || $exclusion_profile_exclude_ARRAY[$exclusion_serial][$exclusion_type][$qualification_pattern]){

                                //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FILE_SIZE_GT EXCLUSION *****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                                if(isset($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath])){

                                    if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]!=-1){

                                        if($this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath]<$qualification_pattern){

                                            $exclusion_check_result['not_excluded'] = false;
                                            $exclusion_check_result['pattern'] = $qualification_pattern;
                                            $exclusion_check_result['asset_meta'] = $filePath;
                                            $exclusion_check_result['pattern_type'] = $exclusion_type;
                                            $exclusion_check_result['exclusion_meta'] = $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath];

                                            return $exclusion_check_result;

                                        }

                                    }

                                }

                            }


                            break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum exclusion type,"' . $exclusion_type . '", has not yet been configured to be applied to any asset.');

                        break;
                    }

                }

                return $exclusion_check_result;

            }else{

                //
                // NO EXCLUSIONS - THEREFORE, ALL GOOD IN THA HOOD
                return true;

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function return_source_file_userid_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_source_file_groupid_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_size_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_lastaccess_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_lastmodify_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_blocksize_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_blocksize_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_blockallocate_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_blockallocate_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_fullpermissions_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_fullpermissions_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function return_file_octalpermissions_at_path($oEndpoint_serial, $filePath){

        return $this->source_file_octalpermissions_at_path_ARRAY[$oEndpoint_serial][$filePath];

    }

    public function localStorageUse_doNotPassUsagePercent($maxStorageUse){

        $tmp_maxStorage = self::$oCRNRSTN_USR->stringSanitize($maxStorageUse, 'max_storage_utilization');

        try{

            if(is_integer($tmp_maxStorage) || is_int($tmp_maxStorage) || is_float($tmp_maxStorage) || is_double($tmp_maxStorage)){

                $this->max_storage_utilization = $tmp_maxStorage;

            }else{

                if(strtolower($tmp_maxStorage) == 'fullretard'){

                    $this->max_storage_utilization = 100;

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum max local DIR destination storage utilization has been conveyed with incorrect data type. It should be an integer or double/float, but the value provided is "'.$maxStorageUse.'".');

                }

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function deleteSourceData_OnSuccess($local_dir_path_SOURCE00, $require_ALL_destination_success){

        if($require_ALL_destination_success){

            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is being configured to (upon 100% SUCCESS file copy to ALL destination endpoints) delete all data at the SOURCE endpoint ('.$local_dir_path_SOURCE00.') that was moved by the CRNRSTN :: Electrum profile to destination.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        }else{

            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is being configured to (upon 100% SUCCESS file copy to at least ONE (1) destination endpoint) delete all data at the SOURCE endpoint ('.$local_dir_path_SOURCE00.') that was moved by the CRNRSTN :: Electrum profile to destination.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        }

    }

    private function electrum_datamover_FF($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $oLightning_ftp_conn){

        if(isset($this->timestamp_nom_pattern)){

            $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);

        }

        //
        // ENDPOINT SERIAL
        $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

        $tmp_exclusion_profile_array = $FIREHOT_oEndpoint_SOURCE->asset_transfer_suppression_ARRAY;

        $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
        self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling FF asset transfer of '.$total_wheels_count.' assets from '.$FIREHOT_oEndpoint_SOURCE->return_FTP_SERVER().'::'.$FIREHOT_oEndpoint_SOURCE->return_FTP_PORT().' @ [DIR::'.$FIREHOT_oEndpoint_SOURCE->return_FTP_DIR_PATH().'] to '.$FIREHOT_oEndpoint_DESTINATION->return_FTP_SERVER().'::'.$FIREHOT_oEndpoint_DESTINATION->return_FTP_PORT().' @ [DIR::'.$FIREHOT_oEndpoint_DESTINATION->return_FTP_DIR_PATH().'].', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

        $wheels_high_awesome_cnt = 0;
        foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

            //
            // CHECK FOR CONFIGURED EXCLUSIONS
            $exclusion_check_result = $this->isNotExluded_asset($filePath, $execution_batch_serial, $tmp_exclusion_profile_array, $FIREHOT_oEndpoint_SOURCE);

            $wheels_high_awesome_cnt++;
            $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, self::$oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

            $oWheel_high_awesome->receive_asset_meta($filePath, $this);
            if($wheels_high_awesome_cnt<5){

                self::$oCRNRSTN_USR->error_log('FF TRANSFER['.$wheels_high_awesome_cnt.']=>'.$filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

            }else{

                if($wheels_high_awesome_cnt>($total_wheels_count-5)){

                    self::$oCRNRSTN_USR->error_log('FF TRANSFER['.$wheels_high_awesome_cnt.']=>'.$filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');


                }

            }

            $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;


            //}else{

                //self::$oCRNRSTN_USR->error_log('FF TRANSFER SKIPPED (DUE TO EXCLUSION MATCH)=>'.$filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

            //}
        }

        /**
        //
        // TMP FOR FILE TRANSFER
        $tmp_hash = $this->generateNewKey(10);
        $tmp_filename = basename($source_file_path);
        $local_file = $this->FtpToFtp_tmp_dirPath.$tmp_hash.'_'.$tmp_filename;

        if(file_exists($local_file)){

        //
        // REMOVE FILE
        unlink($local_file);
        }

        $continue_process=false;

        //
        // PULL FROM SOURCE FTP
        $oFTP_stream_res_SOURCE = self::$oFourLivingCreatures_FTP->endpoint_FTP_conn_ARRAY[crc32($endpoint_source_id)];

        #if (ftp_get($oFTP_stream_res_SOURCE, $local_file, $source_file_path, FTP_BINARY)) {
        if (ftp_get($oFTP_stream_res_SOURCE, $local_file, $source_file_path, FTP_BINARY)) {
        //echo "FF - 1 of 2 :: Successfully written to temp ".$local_file;
        $continue_process = true;
        } else {
        echo "<br>Error :: FF - 1 of 2 :: There was a PULL FROM SOURCE FTP problem getting ".$source_file_path;

        ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_ERROR
        // MIGHT NEED TO REQUEUE FOR REPROCESSING.
        }

        if($continue_process) {
        # $source_root_path # /var/www/html/evifweb/
        # $dest_dir_path # /var/www/html/automate_test2/
        # $source_file_path # /var/www/html/evifweb/common/js/lib/jquery_mobi/images/icons-png/heart-white.png

        $tmp_source_root_ARRAY = explode( '/', $source_root_path);
        $tmp_loop_size = sizeof($tmp_source_root_ARRAY);

        $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

        $tmp_trimmed_file_path = str_replace($source_root_path, "", $source_file_path);  # common/js/lib/jquery_mobi/images/icons-png/heart-white.png
        $tmp_trimmed_file_path = str_replace($tmp_filename, "", $tmp_trimmed_file_path);

        $dest_dir_path = rtrim($dest_dir_path, '/') . '/';
        $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');
        $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';
        $destination_file = $dest_dir_path.$timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$tmp_filename;

        //
        // PUT TO DESTINATION FTP
        $oFTP_stream_res_DEST = self::$oFourLivingCreatures_FTP->endpoint_FTP_conn_ARRAY[crc32($endpoint_destination_id)];
        $this->ftp_mksubdirs($oFTP_stream_res_DEST, $dest_dir_path, $timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path);

        if (ftp_put($oFTP_stream_res_DEST, $destination_file, $local_file, FTP_BINARY)) {
        //echo "<br>FF - 2/2 :: Successfully uploaded PUT TO DESTINATION FTP " . $destination_file;

        //
        // CONFIRM FILE TRANSFER TO DESTINATION. IS THIS NECESSARY?
        # [confirm here - get some file data]
        $tmp_res = ftp_size($oFTP_stream_res_DEST, $destination_file);

        if ($tmp_res != -1) {
        //echo "<br><br>size of $destination_file is $tmp_res bytes";
        } else {
        echo "<br>Error :: Couldn't get the size (Not all servers support this feature).";

        // SOURCE :: https://stackoverflow.com/questions/4852767/how-can-i-check-if-a-file-exists-on-a-remote-server-using-php
        // AUTHOR :: https://stackoverflow.com/users/1226089/johan-pretorius
        $contents_on_server = ftp_nlist($oFTP_stream_res_DEST, $dest_dir_path.$timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path);

        if (in_array($tmp_filename, $contents_on_server)){
        // WE ARE GOOD
        }else{
        //
        // WE HAVE MISSING FILE ERROR. MIGHT NEED TO REQUEUE FOR REPROCESSING.
        echo "<br> Error :: Also, we couldn't find the file $tmp_filename.";
        }

        }


        } else {
        echo "<br>Error :: FF - 2/2 :: There was a problem while PUT TO DESTINATION FTP uploading " . $local_file." to ".$destination_file;

        ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_ERROR
        // MIGHT NEED TO REQUEUE FOR REPROCESSING.
        }

        }

        ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_COMPLETE
        $handle = 'UPDATE_DATA_TRANSFER_STATUS_COMPLETE';
        if(!isset(self::$req_execute_batch_update[$handle])){
        self::$req_execute_batch_update[$handle] = 1;
        }

        //$ts = date("Y-m-d H:i:s", time());
        //$field_names_pipe = "PRELOAD_ID|ELECTRUM_ID|DSOURCE_ID|FILE_SIZE_DESTINATION|ENDTIME|STATUS|FINISH_ELECTRUM_PROCESS_ID";
        //$field_values_pipe = $preload_id."|$electrum_id|$endpoint_source_id|$tmp_res|$ts|TRANSFER COMPLETE|".self::$electrum_process_id;
        //self::$oData->queue_request($this, $handle, $field_names_pipe, $field_values_pipe);
        //echo "<br>queue_request $field_values_pipe";

        //
        // DELETE TMP FILE
        if(file_exists($local_file)){

        //
        // REMOVE FILE
        unlink($local_file);
        }

         */
    }

    private function electrum_datamover_FD($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION){

        if(isset($this->timestamp_nom_pattern)){

            $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);

        }

        //
        // ENDPOINT SERIAL
        $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

        //
        // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
        //$oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();

        $tmp_exclusion_profile_array = $FIREHOT_oEndpoint_SOURCE->asset_transfer_suppression_ARRAY;

        $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
        self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling FD asset transfer of '.$total_wheels_count.' assets from '.$FIREHOT_oEndpoint_SOURCE->return_FTP_SERVER().'::'.$FIREHOT_oEndpoint_SOURCE->return_FTP_PORT().' @ [DIR::'.$FIREHOT_oEndpoint_SOURCE->return_FTP_DIR_PATH().'] to DIR['.$FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'].', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

        $wheels_high_awesome_cnt = 0;
        foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

            //
            // CHECK FOR CONFIGURED EXCLUSIONS
            $exclusion_check_result = $this->isNotExluded_asset($filePath, $execution_batch_serial, $tmp_exclusion_profile_array, $FIREHOT_oEndpoint_SOURCE);

            $wheels_high_awesome_cnt++;
            $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, self::$oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

            $oWheel_high_awesome->receive_asset_meta($filePath, $this);
            if ($wheels_high_awesome_cnt < 5) {

                self::$oCRNRSTN_USR->error_log('FD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');


            } else {

                if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                    self::$oCRNRSTN_USR->error_log('FD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                }

            }

            $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

        }

    }

    private function electrum_datamover_DF($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $oLightning_ftp_conn){

        if(isset($this->timestamp_nom_pattern)){

            $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);

        }

        //
        // ENDPOINT SERIAL
        $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

        //
        // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
        //$oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();

        $tmp_exclusion_profile_array = $FIREHOT_oEndpoint_SOURCE->asset_transfer_suppression_ARRAY;

        $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
        self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling DF asset transfer of '.$total_wheels_count.' assets['.self::$oCRNRSTN_USR->formatBytes($this->source_total_filesize_ARRAY[$oEndpoint_serial][0], 4).'] '.$FIREHOT_oEndpoint_DESTINATION->return_FTP_SERVER().'::'.$FIREHOT_oEndpoint_DESTINATION->return_FTP_PORT().' to '.$FIREHOT_oEndpoint_DESTINATION->return_FTP_DIR_PATH(), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

        $wheels_high_awesome_cnt = 0;
        foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

            //
            // CHECK FOR CONFIGURED EXCLUSIONS
            $exclusion_check_result = $this->isNotExluded_asset($filePath, $execution_batch_serial, $tmp_exclusion_profile_array, $FIREHOT_oEndpoint_SOURCE);

            $wheels_high_awesome_cnt++;
            $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, self::$oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

            $oWheel_high_awesome->receive_asset_meta($filePath, $this);
            if ($wheels_high_awesome_cnt < 5) {

                self::$oCRNRSTN_USR->error_log('DF TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

            } else {

                if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                    self::$oCRNRSTN_USR->error_log('DF TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                }

            }

            $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

        }

        /**
        *
        $tmp_filename = basename($source_file_path);  # /mnt/hgfs/jony5/Documents/jharris_code_samples/_crnrstn.config.inc.php

        $tmp_source_root_ARRAY = explode( '/', $source_root_path);
        $tmp_loop_size = sizeof($tmp_source_root_ARRAY);

        $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

        $tmp_trimmed_file_path = str_replace($source_root_path, "", $source_file_path);  # common/js/lib/jquery_mobi/images/icons-png/heart-white.png
        $tmp_trimmed_file_path = str_replace($tmp_filename, "", $tmp_trimmed_file_path);

        $dest_dir_path = rtrim($dest_dir_path, '/') . '/';
        $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');
        $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';
        $destination_file = $dest_dir_path.$tmp_proj_name_dir."/".$timestamp_nom."/".$tmp_trimmed_file_path.$tmp_filename;


        //
        // PULL FROM SOURCE DIR_LOCAL - PUT TO DESTINATION FTP
        $oFTP_stream_res_DEST = self::$oFourLivingCreatures_FTP->endpoint_FTP_conn_ARRAY[crc32($endpoint_destination_id)];

        if($tmp_trimmed_file_path!=""){

            $this->ftp_mksubdirs($oFTP_stream_res_DEST, $dest_dir_path, $tmp_proj_name_dir."/".$timestamp_nom."/".$tmp_trimmed_file_path);
            //error_log("crnrstn_wind_cloud_fire (796) Attempted to mk dir [here::$dest_dir_path] from path $tmp_proj_name_dir"."/".$timestamp_nom."/".$tmp_trimmed_file_path);

        }else{
            $this->ftp_mksubdirs($oFTP_stream_res_DEST, $dest_dir_path, $tmp_proj_name_dir."/".$timestamp_nom."/");
            //error_log("crnrstn_wind_cloud_fire (800) Attempted to mk dir [here::$dest_dir_path] from path $tmp_proj_name_dir"."/".$timestamp_nom."/");

        }

        # https://codereview.stackexchange.com/questions/24578/is-dir-function-for-ftp-ftps-connections
        //error_log("crnrstn_wind_cloud_fire (803) CONSIDER HOOKING UP FTP DIR CREATION VALIDATION HERE [WILL IT BE SLOW?] :: NO DIR AT ".$tmp_proj_name_dir . "/" . $timestamp_nom . "/" . $tmp_trimmed_file_path);

        if (ftp_put($oFTP_stream_res_DEST, $destination_file, $source_file_path, FTP_BINARY)) {
            #if (ftp_put($oFTP_stream_res_DEST, $destination_file, $source_file_path, FTP_ASCII)) {
            //echo "<br>DF - Successfully uploaded ".$destination_file;

            $tmp_res = ftp_size($oFTP_stream_res_DEST, $destination_file);

            if ($tmp_res != -1) {
                //echo "<br><br>size of $destination_file is $tmp_res bytes";
            } else {
                echo "<br>Error :: crnrstn_wind_cloud_fire (859) couldn't get the file size (Not all servers support this feature).";

                // SOURCE :: https://stackoverflow.com/questions/4852767/how-can-i-check-if-a-file-exists-on-a-remote-server-using-php
                // AUTHOR :: https://stackoverflow.com/users/1226089/johan-pretorius
                $contents_on_server = ftp_nlist($oFTP_stream_res_DEST, $dest_dir_path.$tmp_proj_name_dir."/".$timestamp_nom."/".$tmp_trimmed_file_path);

                if (in_array($tmp_filename, $contents_on_server)){
                    // WE ARE GOOD
                }else{
                    //
                    // WE HAVE MISSING FILE ERROR. MIGHT NEED TO REQUEUE FOR REPROCESSING.
                    echo "<br>Error :: Also, couldn't even find the file $tmp_filename.";
                }
            }

            ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_COMPLETE
            $handle = 'UPDATE_DATA_TRANSFER_STATUS_COMPLETE';
            if (!isset(self::$req_execute_batch_update[$handle])) {
                self::$req_execute_batch_update[$handle] = 1;
            }

            $ts = date("Y-m-d H:i:s", time());
            $field_names_pipe = "PRELOAD_ID|ELECTRUM_ID|DSOURCE_ID|FILE_SIZE_DESTINATION|ENDTIME|STATUS|FINISH_ELECTRUM_PROCESS_ID";
            $field_values_pipe = $preload_id . "|$electrum_id|$endpoint_source_id|$tmp_res|$ts|TRANSFER COMPLETE|".self::$electrum_process_id;
            self::$oData->queue_request($this, $handle, $field_names_pipe, $field_values_pipe);
            //echo "<br>queue_request $field_values_pipe";
            //echo "<br>DF - Success uploading " . $source_file_path . " to " . $destination_file;

        } else {
            echo "<br>Error :: DF - There was a problem while uploading " . $source_file_path . " to " . $destination_file;

            ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_ERROR
            // MIGHT NEED TO REQUEUE FOR REPROCESSING.
        }
        *
        */
    }

    private function electrum_datamover_DD($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION){

        try{

            if(isset($this->timestamp_nom_pattern)){

                $FIREHOT_oEndpoint_SOURCE->add_directory_nom_pattern($this->timestamp_nom_pattern);

            }

            //
            // ENDPOINT SERIAL
            $oEndpoint_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

            //
            // ENDPOINT WCR KEY OR PATH (IF LOCAL DIRECTORY VIA INPUT PARAMETER)
            //$oEndpoint_WCRkey_or_path = $FIREHOT_oEndpoint_SOURCE->return_WCRkey_or_PATH();

            $tmp_exclusion_profile_array = $FIREHOT_oEndpoint_SOURCE->asset_transfer_suppression_ARRAY;

            $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);

            //
            // CRNRSTN :: ELECTRUM SUB-REQUEST TOTAL FILE SIZE (bytes)
            $tmp_file_size_total_bytes = $this->source_total_filesize_ARRAY[$oEndpoint_serial][0];
            $tmp_file_size_total = self::$oCRNRSTN_USR->formatBytes($tmp_file_size_total_bytes, 5);

            //
            // TOTAL AVAILABLE STORAGE SIZE AT DESTINATION (bytes)
            $tmp_destination_capacity_bytes = $FIREHOT_oEndpoint_DESTINATION->return_availableByteCapacity();
            $tmp_destination_diskSize_bytes = $FIREHOT_oEndpoint_DESTINATION->return_hardDriveSize();
            $tmp_destination_capacity = self::$oCRNRSTN_USR->formatBytes($tmp_destination_capacity_bytes, 5);

            //
            // CALCULATE PERCENTAGE UTILIZATION OF REQUEST
            $percentage_utilization_ask = 100-((($tmp_file_size_total + ($tmp_destination_diskSize_bytes-$tmp_destination_capacity))/$tmp_destination_diskSize_bytes)*100);

            if($percentage_utilization_ask > $this->max_storage_utilization){

                $percentage_utilization_ask = 100-((($tmp_file_size_total + ($tmp_destination_diskSize_bytes-$tmp_destination_capacity))/$tmp_destination_diskSize_bytes)*100);

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The CRNRSTN :: Electrum max local DIR destination storage utilization has been exceeded with an ask which would result in '.$percentage_utilization_ask.'% usage. This being when '.$this->max_storage_utilization.'% is the currently configured maximum [See electrum_doNotPassDiskUsagePercent()]. For the record, only '.$tmp_destination_capacity.' is available at '.$FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'.');

            }

            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is handling DD['.$tmp_file_size_total.' required/'.$tmp_destination_capacity.' avail] asset transfer of '.$total_wheels_count.' assets['.self::$oCRNRSTN_USR->formatBytes($this->source_total_filesize_ARRAY[$oEndpoint_serial][0], 4).'] to '.$FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH().'.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

            $wheels_high_awesome_cnt = 0;
            $total_wheels_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);
            foreach($this->directory_content_ARRAY[$oEndpoint_serial] as $filePath => $key){

                //
                // CHECK FOR CONFIGURED EXCLUSIONS
                $exclusion_check_result = $this->isNotExluded_asset($filePath, $execution_batch_serial, $tmp_exclusion_profile_array, $FIREHOT_oEndpoint_SOURCE);

                $wheels_high_awesome_cnt++;
                $oWheel_high_awesome = new crnrstn_wheel_high_awesome_eyes($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, self::$oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result);

                $oWheel_high_awesome->receive_asset_meta($filePath, $this);
                if ($wheels_high_awesome_cnt < 5) {

                    self::$oCRNRSTN_USR->error_log('DD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                } else {

                    if ($wheels_high_awesome_cnt > ($total_wheels_count - 5)) {

                        self::$oCRNRSTN_USR->error_log('DD TRANSFER[' . $wheels_high_awesome_cnt . ']=>' . $filePath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                    }

                }

                $this->oWheel_high_awesome_ARRAY[$execution_serial][] = $oWheel_high_awesome;

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    private function process_sub_batch_asset_transfer($execution_serial, $execution_batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY){

        # $hot_src_connection_ARRAY['oLightning_ftp_conn']
        # $hot_src_connection_ARRAY['FIREHOT_oEndpoint']
        # $hot_dest_connection_ARRAY['oLightning_ftp_conn']
        # $hot_dest_connection_ARRAY['FIREHOT_oEndpoint']
        self::$oCRNRSTN_USR->error_log('****** START CRNRSTN :: ELECTRUM SUB-BATCH DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        try{

            $tmp_transfer_profile = '';

            $FIREHOT_oEndpoint_SOURCE = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
            $FIREHOT_oEndpoint_SOURCE->log_connection_status('batch transfer :: source endpoint initialization start');

            $FIREHOT_oEndpoint_DESTINATION = $hot_dest_connection_ARRAY['FIREHOT_oEndpoint'];
            $FIREHOT_oEndpoint_DESTINATION->log_connection_status('batch transfer :: destination endpoint initialization start');

            self::$oCRNRSTN_USR->error_log('****** SOURCE ENDPOINT HANDLING START PROCESS - DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            //
            // SOURCE ENDPOINT HANDLING - DO WE HAVE FTP CONN?
            if(!is_object($hot_src_connection_ARRAY['oLightning_ftp_conn'])){

                //
                // DIRECTORY SOURCE
                $tmp_transfer_profile .= 'D';

                $tmp_src_DIR_PATH = $FIREHOT_oEndpoint_SOURCE->return_LOCAL_DIR_PATH();

                if(!is_dir($tmp_src_DIR_PATH)){

                    $local_oWCR_key = $FIREHOT_oEndpoint_SOURCE->return_local_oWCR_key();
                    $tmp_src_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $local_oWCR_key);

                }

                self::$oCRNRSTN_USR->error_log('****** SOURCE ENDPOINT = DIRECTORY['.$tmp_src_DIR_PATH.'] ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                if($this->validate_DIR_Endpoint('SOURCE', $tmp_src_DIR_PATH)) {

                    $FIREHOT_oEndpoint_SOURCE->log_connection_status('batch transfer :: source validation complete');

                    $tmp_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();

                    if(!isset($this->directory_content_ARRAY[$tmp_serial])){

                        $local_dir_contents_SOURCE = $this->localdir_list_files_recursive($tmp_src_DIR_PATH, $tmp_serial);

                        $this->directory_content_ARRAY[$tmp_serial] = $local_dir_contents_SOURCE;

                        if($local_dir_contents_SOURCE){

                            //
                            // WE HAVE LIST OF ASSETS AT SOURCE DIR ENDPOINT
                            $FIREHOT_oEndpoint_SOURCE->log_connection_status('batch transfer :: local directory file listing['.sizeof($local_dir_contents_SOURCE).' total] complete');

                        }

                    }

                }else{

                    $this->global_execute_authorization = false;
                    $this->global_execute_authorization_reason = 'ERR420.5 - Invalid directory location (or read permissions) at SOURCE endpoint directory, '.$tmp_src_DIR_PATH.'.';

                    if(is_dir($tmp_src_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_src_DIR_PATH) ), 2);

                    }else{

                        $tmp_current_perms = 'invalid path';

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum batch process has failed due to a provided source directory endpoint ('.$tmp_src_DIR_PATH.') being an invalid source ('.$tmp_current_perms.') for asset retrieval.');

                }

            }else{

                //
                // FTP SOURCE
                $tmp_transfer_profile .= 'F';
                $oLightning_ftp_conn_SOURCE = $hot_src_connection_ARRAY['oLightning_ftp_conn'];
                $tmp_src_ftp_stream = $oLightning_ftp_conn_SOURCE->return_ftp_stream();
                $tmp_src_FTP_SERVER = $FIREHOT_oEndpoint_SOURCE->return_FTP_SERVER();
                $tmp_src_FTP_PORT = $FIREHOT_oEndpoint_SOURCE->return_FTP_PORT();
                $tmp_src_FTP_DIR_PATH = $FIREHOT_oEndpoint_SOURCE->return_FTP_DIR_PATH();
                self::$oCRNRSTN_USR->error_log('****** SOURCE ENDPOINT = FTP['.$tmp_src_FTP_SERVER.']['.$tmp_src_FTP_DIR_PATH.'] ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                //
                // EXTRACT ALL FILE PATH
                $tmp_config_serial = self::$oCRNRSTN_USR->return_configSerial();
                $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced FTP directory access related error on '.$tmp_src_FTP_SERVER.'::'.$tmp_src_FTP_PORT.' when accessing the destination directory, '.$tmp_src_FTP_DIR_PATH.' as ';

                $tmp_serial = $FIREHOT_oEndpoint_SOURCE->return_serial();
                if(!isset($this->directory_content_ARRAY[$tmp_serial])) {

                    $ftp_contents_SOURCE = $this->ftp_list_files_recursive($tmp_src_ftp_stream, $tmp_src_FTP_DIR_PATH, $tmp_serial);

                    $ftp_contents_SOURCE = $this->merge_ftp_dir_array_to_file($ftp_contents_SOURCE, $tmp_serial);

                    if($ftp_contents_SOURCE){

                        $this->directory_content_ARRAY[$tmp_serial] = $ftp_contents_SOURCE;

                        //
                        // WE HAVE LIST OF ASSETS AT SOURCE FTP ENDPOINT
                        $FIREHOT_oEndpoint_SOURCE->connection_status = 'batch transfer :: FTP directory file listing['.sizeof($ftp_contents_SOURCE).' total] complete';
                        $FIREHOT_oEndpoint_SOURCE->connection_status_log[] = 'batch transfer :: FTP directory file listing['.sizeof($ftp_contents_SOURCE).' total] complete';

                    }else{

                        $this->global_execute_authorization = false;
                        $this->global_execute_authorization_reason = 'ERR420.5 - Invalid FTP path location (or read permissions) at SOURCE FTP endpoint '.$tmp_src_FTP_SERVER.'::'.$tmp_src_FTP_PORT.', with path of '.$tmp_src_FTP_DIR_PATH.'.';

                    }
                }

                $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

            }

            self::$oCRNRSTN_USR->error_log('****** DESTINATION ENDPOINT HANDLING START PROCESS - DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            //
            // DESTINATION ENDPOINT HANDLING
            if(!is_object($hot_dest_connection_ARRAY['oLightning_ftp_conn'])){

                //
                // DIRECTORY DESTINATION
                $tmp_transfer_profile .= 'D';

                $tmp_dest_DIR = $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();
                $mkdir_permissons_mode = $FIREHOT_oEndpoint_DESTINATION->return_LOCAL_MKDIR_MODE();

                if(!is_dir($tmp_dest_DIR)){

                    $tmp_local_oWCR_key = $FIREHOT_oEndpoint_DESTINATION->return_local_oWCR_key();

                    //error_log('560 - ('.$mkdir_permissons_mode.')tmp_local_oWCR_key='.$tmp_local_oWCR_key.' & tmp_dest_DIR='.$tmp_dest_DIR);
                    $tmp_dest_DIR = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $tmp_local_oWCR_key);
                    $mkdir_permissons_mode = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $tmp_local_oWCR_key);

                }

                self::$oCRNRSTN_USR->error_log('****** DESTINATION ENDPOINT = DIRECTORY['.$tmp_dest_DIR.'] ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                if ($this->validate_DIR_Endpoint('DESTINATION', $tmp_dest_DIR, $mkdir_permissons_mode)) {

                    $FIREHOT_oEndpoint_DESTINATION->log_connection_status('batch transfer :: destination validation complete');

                }else{

                    if(is_dir($tmp_dest_DIR)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_dest_DIR) ), 2);

                    }else{

                        $tmp_current_perms = 'invalid path';

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The CRNRSTN :: Electrum batch process has failed due to a provided destination directory endpoint ('.$tmp_dest_DIR.') being an invalid source ('.$tmp_current_perms.') for temporary asset storage.');

                }

            }else{

                //
                // FTP DESTINATION
                $tmp_transfer_profile .= 'F';
                $oLightning_ftp_conn_DESTINATION = $hot_dest_connection_ARRAY['oLightning_ftp_conn'];
                //$tmp_dest_ftp_stream = $oLightning_ftp_conn_DESTINATION->return_ftp_stream();
                $tmp_dest_FTP_SERVER = $FIREHOT_oEndpoint_DESTINATION->return_FTP_SERVER();
                //$tmp_dest_FTP_PORT = $FIREHOT_oEndpoint_DESTINATION->return_FTP_PORT();
                $tmp_dest_FTP_DIR_PATH = $FIREHOT_oEndpoint_DESTINATION->return_FTP_DIR_PATH();

                self::$oCRNRSTN_USR->error_log('****** DESTINATION ENDPOINT = FTP['.$tmp_dest_FTP_SERVER.']['.$tmp_dest_FTP_DIR_PATH.'] ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

            self::$oCRNRSTN_USR->error_log('****** PROCESS ->'.$tmp_transfer_profile.'<- DATA COPY REQUEST ******', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            switch($tmp_transfer_profile){
                case 'FF':

                    //
                    // FTP TO FTP
                    #$ftp_contents_SOURCE
                    #$this->FtpToFtp_tmp_dirPath
                    #$tmp_dest_ftp_stream
                    $this->electrum_datamover_FF($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $oLightning_ftp_conn_DESTINATION);

                break;
                case 'DD':

                    //
                    // DIR TO DIR
                    #$local_dir_contents_SOURCE
                    #$tmp_dest_DIR_PATH
                    $this->electrum_datamover_DD($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION);

                break;
                case 'FD':

                    //
                    // FTP TO DIR
                    #$ftp_contents_SOURCE
                    #$tmp_dest_DIR_PATH
                    $this->electrum_datamover_FD($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION);

                break;
                case 'DF':

                    //
                    // DIR TO FTP
                    #$local_dir_contents_SOURCE
                    #$tmp_dest_ftp_stream
                    $this->electrum_datamover_DF($execution_serial, $execution_batch_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DESTINATION, $oLightning_ftp_conn_DESTINATION);

                break;

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }


        /*

        //
        // ARE THERE SHELL MOVES TO BE MADE?
        if(isset(self::$electrum_final_move_ARRAY[crc32($electrum_id)])){
            foreach(self::$electrum_final_move_ARRAY[crc32($electrum_id)] AS $key => $value){

                if(is_array($value)){
                    foreach($value AS $key1 => $shellCommand){

                        error_log("crnrstn_wind_cloud_fire (248) executing shell command :: ".$shellCommand);
                        shell_exec($shellCommand);

                    }

                }

            }

            //
            // NOW PERFORM VALIDATION ON DATA MANIPULATION VIA SHELL
            $this->verify_shell_data_manip($electrum_id);

        }

        */

    }

    private function seeennd_it($execution_serial, $batch_serial){

        if($this->global_execute_authorization){

            //
            // FOR EACH SOURCE ENDPOINT
            foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY){

                //
                // SEND TO EACH DESTINATION ENDPOINT
                foreach($this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'] as $key_dest => $hot_dest_connection_ARRAY){

                    $this->process_sub_batch_asset_transfer($execution_serial, $batch_serial, $hot_src_connection_ARRAY, $hot_dest_connection_ARRAY);

                }
            }

        }else{

            self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process is not configured to run properly, and it has locked down all asset transfer requests. Reason Code :: '.$this->global_execute_authorization_reason, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        }

    }

    private function add_batch_SOURCE($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn=NULL){

        $FIREHOT_oEndpoint->log_connection_status('source queued');

        $tmp_array['FIREHOT_oEndpoint'] = $FIREHOT_oEndpoint;

        if(isset($oLightning_ftp_conn)){

            //
            // QUEUE FTP ENDPOINT
            $oLightning_ftp_conn->log_connection_status('source queued');

            $tmp_array['oLightning_ftp_conn'] = $oLightning_ftp_conn;

            $this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'][] = $tmp_array;

        }else{

            //
            // QUEUE DIRECTORY ENDPOINT
            $tmp_array['oLightning_ftp_conn'] = 0;
            $this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'][] = $tmp_array;

        }

    }

    private function add_batch_DESTINATION($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn=NULL){

        $tmp_array = array();
        $FIREHOT_oEndpoint->log_connection_status('destination queued');

        $tmp_array['FIREHOT_oEndpoint'] = $FIREHOT_oEndpoint;

        if(isset($oLightning_ftp_conn)){

            //
            // QUEUE FTP ENDPOINT
            $oLightning_ftp_conn->log_connection_status('destination queued');

            $tmp_array['oLightning_ftp_conn'] = $oLightning_ftp_conn;

            $this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'][] = $tmp_array;

        }else{

            //
            // QUEUE DIRECTORY ENDPOINT
            $tmp_array['oLightning_ftp_conn'] = 0;
            $this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'][] = $tmp_array;

        }

    }

    private function load_exclusion_profile($FIREHOT_oEndpoint){

        $FIREHOT_oEndpoint->asset_transfer_suppression_ARRAY = $this->asset_transfer_suppression_ARRAY;

        return $FIREHOT_oEndpoint;

    }

    public function execute($execution_serial){

        try{

            if(!isset($this->execute_from_source_authorization)){

                if(!isset($this->execute_to_destination_authorization)){

                    self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process has not been configured with any source or destination endpoints.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');


                }else{

                    self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process has not been configured with any source endpoints.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                }

            }else{

                if(!isset($this->execute_to_destination_authorization)){

                    self::$oCRNRSTN_USR->error_log('The CRNRSTN :: Electrum process has not been configured with any destination endpoints.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                }else{

                    //
                    // BOTH AUTH FLAGS ARE SET
                    if($this->execute_to_destination_authorization == true && $this->execute_from_source_authorization == true){

                        //
                        // BATCH EXECUTION SERIALIZATION
                        //$batch_serial = self::$oCRNRSTN_USR->generateNewKey(100);

                        //
                        // BATCH EXECUTION SERIALIZATION
                        $batch_serial = $this->execution_batch_serial;

                        //
                        // RESET BATCH SERIAL IN PREPARATION FOR ANOTHER ELECTRUM EXECUTION (FORCE PROFILE RESET)
                        $this->execution_batch_serial = self::$oCRNRSTN_USR->generateNewKey(100);

                        //
                        // LOAD ALL ENDPOINT SOURCE
                        // $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][$key] = $FIREHOT_oEndpoint;
                        foreach($this->oLighting_bolt_ARRAY['SOURCE'] as $endpoint_serial => $serial_ARRAY){

                            foreach($serial_ARRAY as $endpoint_id => $oEndpoint_ARRAY) {

                                foreach ($oEndpoint_ARRAY as $key => $FIREHOT_oEndpoint) {

                                    if (!isset($this->processed_source_ARRAY[$execution_serial][$endpoint_serial])) {
                                        $this->processed_source_ARRAY[$execution_serial][$endpoint_serial] = 1;

                                        $tmp_connection_type = $FIREHOT_oEndpoint->return_connection_type();

                                        switch($tmp_connection_type){
                                            case 'FTP':

                                                //
                                                // RETRIEVE FTP CONNECTION STREAM OBJECT
                                                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_serial];

                                                $tmp_start_time_micro = $oLightning_ftp_conn->return_start_time_micro();
                                                $tmp_server = $FIREHOT_oEndpoint->return_FTP_SERVER();
                                                $tmp_FTP_DIR_PATH = $FIREHOT_oEndpoint->return_FTP_DIR_PATH();

                                                if($oLightning_ftp_conn->connection_status == 'ready'){

                                                    self::$oCRNRSTN_USR->error_log('QUEUE SOURCE Endpoint[' . $tmp_server . ']['.$tmp_FTP_DIR_PATH.'] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_EXEC');

                                                    //
                                                    // SOURCE FTP RECEIVES EXCLUSION PROFILE
                                                    $FIREHOT_oEndpoint = $this->load_exclusion_profile($FIREHOT_oEndpoint);
                                                    $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][$key] = $FIREHOT_oEndpoint;

                                                    $this->add_batch_SOURCE($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn);
                                                    $oLightning_ftp_conn->connection_status = 'source FTP queued for execution by electrum';
                                                    $oLightning_ftp_conn->connection_status_log[] = 'source FTP queued for execution by electrum';

                                                }

                                                self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_serial] = $oLightning_ftp_conn;

                                            break;
                                            default:

                                                $tmp_path = $FIREHOT_oEndpoint->return_LOCAL_DIR_PATH();
                                                if(!is_dir($tmp_path)){

                                                    $tmp_local_oWCR_key = $FIREHOT_oEndpoint->return_local_oWCR_key();
                                                    $tmp_path = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $tmp_local_oWCR_key);

                                                }

                                                $tmp_start_time_micro = $FIREHOT_oEndpoint->return_start_time_micro();

                                                if($FIREHOT_oEndpoint->connection_status == 'ready'){

                                                    self::$oCRNRSTN_USR->error_log('QUEUE SOURCE Endpoint[' . $tmp_path . '] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_EXEC');

                                                    //
                                                    // SOURCE DIR RECEIVES EXCLUSION PROFILE
                                                    $FIREHOT_oEndpoint = $this->load_exclusion_profile($FIREHOT_oEndpoint);

                                                    $this->add_batch_SOURCE($FIREHOT_oEndpoint, $batch_serial);
                                                    $FIREHOT_oEndpoint->connection_status = 'source DIR queued for execution by electrum';
                                                    $FIREHOT_oEndpoint->connection_status_log[] = 'source DIR queued for execution by electrum';

                                                }

                                                $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][] = $FIREHOT_oEndpoint;

                                            break;
                                        }

                                    }
                                }
                            }
                        }

                        foreach($this->oLighting_bolt_ARRAY['DESTINATION'] as $endpoint_serial => $serial_ARRAY){
                            foreach($serial_ARRAY as $endpoint_id => $oEndpoint_ARRAY){
                                foreach($oEndpoint_ARRAY as $key => $FIREHOT_oEndpoint){

                                    if(!isset($this->processed_source_ARRAY[$execution_serial][$endpoint_serial])){
                                        $this->processed_destination_ARRAY[$execution_serial][$endpoint_serial] = 1;

                                        $tmp_connection_type = $FIREHOT_oEndpoint->return_connection_type();

                                        switch($tmp_connection_type){
                                            case 'FTP':

                                                //
                                                // RETRIEVE FTP CONNECTION STREAM OBJECT
                                                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_serial];
                                                $tmp_start_time_micro = $oLightning_ftp_conn->return_start_time_micro();
                                                $tmp_server = $FIREHOT_oEndpoint->return_FTP_SERVER();
                                                $tmp_FTP_DIR_PATH = $FIREHOT_oEndpoint->return_FTP_DIR_PATH();

                                                if($oLightning_ftp_conn->connection_status == 'ready') {

                                                    self::$oCRNRSTN_USR->error_log('QUEUE DESTINATION Endpoint[' . $tmp_server . '/' . $tmp_FTP_DIR_PATH . '] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_EXEC');

                                                    $this->add_batch_DESTINATION($FIREHOT_oEndpoint, $batch_serial, $oLightning_ftp_conn);
                                                    $oLightning_ftp_conn->log_connection_status('destination FTP queued for execution by electrum');

                                                }

                                                self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$endpoint_serial] = $oLightning_ftp_conn;

                                            break;
                                            default:

                                                $tmp_local_dir_path = $FIREHOT_oEndpoint->return_LOCAL_DIR_PATH();

                                                if(!is_dir($tmp_local_dir_path)){

                                                    $tmp_local_oWCR_key = $FIREHOT_oEndpoint->return_local_oWCR_key();
                                                    //error_log('928 - tmp_local_dir_path='.$tmp_local_dir_path.' || tmp_local_oWCR_key='.$tmp_local_oWCR_key);
                                                    $tmp_local_dir_path = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $tmp_local_oWCR_key);
                                                    $mkdir_permissons_mode = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $tmp_local_oWCR_key);

                                                }

                                                $tmp_start_time_micro = $FIREHOT_oEndpoint->return_start_time_micro();

                                                if($FIREHOT_oEndpoint->connection_status == 'ready') {

                                                    self::$oCRNRSTN_USR->error_log('QUEUE DESTINATION Endpoint[' . $tmp_local_dir_path . '] start time=[' . $tmp_start_time_micro . ']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_EXEC');

                                                    $this->add_batch_DESTINATION($FIREHOT_oEndpoint, $batch_serial);
                                                    $FIREHOT_oEndpoint->log_connection_status('destination DIR queued for execution by electrum');

                                                }

                                                $this->oLighting_bolt_ARRAY['SOURCE'][$endpoint_serial][$endpoint_id][] = $FIREHOT_oEndpoint;

                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        //
                        // ALL ENDPOINTS AGGREGATED. SEEENND IT!
                        $this->seeennd_it($execution_serial, $batch_serial);

                        $this->endTime = self::$oCRNRSTN_USR->getMicroTime();
                        $this->elapsedTime = self::$oCRNRSTN_USR->elapsedDeltaTimeFor('ELECTRUM_PERFORMANCE_CLIENT');

                        //$this->elapsedTime = $this->elapsedTime + 12600000;

                        //
                        // PERFORMANCE REPORT COMMUNICATIONS
                        $this->fire_reportingNotification($execution_serial, $batch_serial);

                    }
                }
            }

            $this->execute_from_source_authorization = NULL;
            $this->execute_to_destination_authorization = NULL;

            flush();
            ob_flush();

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addDestinationLOCAL($dirPath, $mkdir_permissons_mode){

        try{

            //
            // DIRECTORY
            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_MKDIR_MODE = $mkdir_permissons_mode;
            $tmp_DIR_PATH = $dirPath;

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            if($this->ready_for_preload($tmp_endpoint_serial)){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_Endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_destinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    $this->execute_to_destination_authorization = true;

                }else{

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);
                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to '.$tmp_MKDIR_MODE.') the destination directory path ("'.$tmp_DIR_PATH.'" with '.$tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path ('.$tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory ('.$tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addFlattenedDestinationLOCAL($dirPath, $mkdir_permissons_mode){

        try{

            //
            // DIRECTORY
            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [FLATTEN ALL FILES] Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_MKDIR_MODE = $mkdir_permissons_mode;
            $tmp_DIR_PATH = $dirPath;

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            if($this->ready_for_preload($tmp_endpoint_serial)){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_Endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_flattenedDestinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    $this->execute_to_destination_authorization = true;

                }else{

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);
                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to '.$tmp_MKDIR_MODE.') the destination directory path ("'.$tmp_DIR_PATH.'" with '.$tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path ('.$tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory ('.$tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }


    }

    public function addSourceLOCAL($dirPath){

        try{

            //
            // DIRECTORY
            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory SOURCE - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_MKDIR_MODE = NULL;
            $tmp_DIR_PATH = $dirPath;

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            if($this->ready_for_preload($tmp_endpoint_serial)){

                if($this->validate_DIR_Endpoint('SOURCE', $tmp_DIR_PATH)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_sourceLOCAL_meta($dirPath);

                    $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    if(!isset($this->execute_from_source_authorization)){

                        $this->execute_from_source_authorization = true;

                    }

                }else{

                    $this->execute_from_source_authorization = false;

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Electrum process experienced SOURCE directory validation error at '.$tmp_DIR_PATH.'.');

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this SOURCE directory ('.$tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addDestinationLOCAL_WCR($WildCardResource_key){

        try{

            //
            // DIRECTORY
            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $WildCardResource_key);
            $tmp_MKDIR_MODE = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            if($this->ready_for_preload($tmp_endpoint_serial)){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_Endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_destinationLOCAL_WCR_meta($WildCardResource_key);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    $this->execute_to_destination_authorization = true;

                }else{

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);
                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to '.$tmp_MKDIR_MODE.') the destination directory path ("'.$tmp_DIR_PATH.'" in '.$tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path ('.$tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory ('.$tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addFlattenedDestinationLOCAL_WCR($WildCardResource_key){

        try{

            //
            // DIRECTORY
            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum [ALL FLATTENED] Directory DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $WildCardResource_key);
            $tmp_MKDIR_MODE = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            if($this->ready_for_preload($tmp_endpoint_serial)){

                //
                // DESTINATION DIRECTORY
                if($this->validate_DIR_Endpoint('DESTINATION', $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_flattenedDestinationLOCAL_WCR_meta($WildCardResource_key);
                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    $this->execute_to_destination_authorization = true;

                }else{

                    if(!isset($this->execute_to_destination_authorization)){

                        $this->execute_to_destination_authorization = false;

                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    if(is_dir($tmp_DIR_PATH)){

                        $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);
                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to '.$tmp_MKDIR_MODE.') the destination directory path ("'.$tmp_DIR_PATH.'" in '.$tmp_current_perms.' mode) for writing which is preventing successful validation and preload of this endpoint.');

                    }else{

                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path ('.$tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                    }

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION directory ('.$tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }


    }

    public function addSourceLOCAL_WCR($WildCardResource_key){

        try{

            //
            // DIRECTORY
            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory SOURCE - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_MKDIR_MODE = NULL;
            $tmp_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_DIR_PATH);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            if($this->ready_for_preload($tmp_endpoint_serial)){

                if($this->validate_DIR_Endpoint('SOURCE', $tmp_DIR_PATH)){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);

                    $FIREHOT_oEndpoint->initialize_source_LOCAL_WCR_meta($WildCardResource_key);
                    $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    if(!isset($this->execute_from_source_authorization)){

                        $this->execute_from_source_authorization = true;

                    }

                }else{

                    $this->execute_from_source_authorization = false;

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: Electrum process experienced a source directory validation error at '.$tmp_DIR_PATH.'.');

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this SOURCE directory ('.$tmp_DIR_PATH.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addDestination_FTP_WCR($WildCardResource_key){

        try{

            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            /*
            $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
            $oWCR->addAttribute('FTP_USERNAME', 'jony5');
            $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
            $oWCR->addAttribute('FTP_PORT', 21);
            $oWCR->addAttribute('FTP_TIMEOUT', 90);
            $oWCR->addAttribute('FTP_IS_SSL', false);
            $oWCR->addAttribute('FTP_USE_PASV', false);
            $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
            $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', true);
            $oWCR->addAttribute('FTP_DIR_PATH', '../../var/www/html/_backup_test/');
            */

            $tmp_FTP_SERVER = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $WildCardResource_key);
            $tmp_FTP_USERNAME = self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $WildCardResource_key);
            $tmp_FTP_PASSWORD = self::$oCRNRSTN_USR->getEnvResource('FTP_PASSWORD', $WildCardResource_key);
            $tmp_FTP_PORT = self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $WildCardResource_key);
            //$tmp_FTP_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_FTP_SERVER.$tmp_FTP_USERNAME.$tmp_FTP_PASSWORD.$tmp_FTP_PORT);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP ['.$tmp_FTP_SERVER.']['.$tmp_FTP_USERNAME.']['.$tmp_FTP_PORT.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            if($this->ready_for_preload($tmp_endpoint_serial)){

                $this->validate_FTP_Endpoint('DESTINATION', $WildCardResource_key, $tmp_endpoint_serial);
                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_serial);
                if($oLightning_ftp_conn->isValid){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_destination_FTP_WCR_meta($WildCardResource_key);

                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    $this->execute_to_destination_authorization = true;

                }else{

                    if(!isset($this->execute_to_destination_authorization)) {

                        $this->execute_to_destination_authorization = false;
                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP ['.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'] endpoint.');

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION FTP endpoint at ('.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addFlattenedDestinationFTP_WCR($WildCardResource_key){

        try{

            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP DESTINATION - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_FTP_SERVER = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $WildCardResource_key);
            $tmp_FTP_USERNAME = self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $WildCardResource_key);
            $tmp_FTP_PASSWORD = self::$oCRNRSTN_USR->getEnvResource('FTP_PASSWORD', $WildCardResource_key);
            $tmp_FTP_PORT = self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_FTP_SERVER.$tmp_FTP_USERNAME.$tmp_FTP_PASSWORD.$tmp_FTP_PORT);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP ['.$tmp_FTP_SERVER.']['.$tmp_FTP_USERNAME.']['.$tmp_FTP_PORT.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            if($this->ready_for_preload($tmp_endpoint_serial)){

                $this->validate_FTP_Endpoint('DESTINATION', $WildCardResource_key, $tmp_endpoint_serial);
                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_serial);
                if($oLightning_ftp_conn->isValid){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_flattenedDestinationFTP_WCR_meta($WildCardResource_key);

                    $this->oLighting_bolt_ARRAY['DESTINATION'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    $this->execute_to_destination_authorization = true;

                }else{

                    if(!isset($this->execute_to_destination_authorization)) {

                        $this->execute_to_destination_authorization = false;
                    }

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP ['.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'] endpoint.');

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this DESTINATION FTP endpoint at ('.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function addSource_FTP_WCR($WildCardResource_key){

        try{

            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP SOURCE - integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            $tmp_FTP_SERVER = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $WildCardResource_key);
            $tmp_FTP_USERNAME = self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $WildCardResource_key);
            $tmp_FTP_PASSWORD = self::$oCRNRSTN_USR->getEnvResource('FTP_PASSWORD', $WildCardResource_key);
            $tmp_FTP_PORT = self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $WildCardResource_key);
            //$tmp_FTP_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $WildCardResource_key);

            $tmp_endpoint_id = md5($tmp_FTP_SERVER.$tmp_FTP_USERNAME.$tmp_FTP_PASSWORD.$tmp_FTP_PORT);
            $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

            self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP ['.$tmp_FTP_SERVER.']['.$tmp_FTP_USERNAME.']['.$tmp_FTP_PORT.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            if($this->ready_for_preload($tmp_endpoint_serial)){

                $this->validate_FTP_Endpoint('SOURCE', $WildCardResource_key, $tmp_endpoint_serial);
                $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_serial);
                if($oLightning_ftp_conn->isValid){

                    //
                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);
                    $FIREHOT_oEndpoint->initialize_source_FTP_WCR_meta($WildCardResource_key);

                    $this->oLighting_bolt_ARRAY['SOURCE'][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                    if(!isset($this->execute_from_source_authorization)){

                        $this->execute_from_source_authorization = true;

                    }

                }else{

                    $this->execute_from_source_authorization = false;

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP SOURCE ['.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'] endpoint.');

                }

            }else{

                self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this FTP SOURCE at ('.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'), and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    /**
     * @param $flow_type
     * @param $connection_type
     * @param $data_type
     * @param $endpoint_data
     * @param string $mkdir_permissions_mode
     * @return false

    public function addEndpoint($flow_type, $connection_type, $data_type, $endpoint_data, $mkdir_permissions_mode='777'){
        //addEndpoint('SOURCE', 'DIR', 'CRNRSTN_WCR', $wild_card_resource_key)
        //addEndpoint('DESTINATION', 'DIR', 'PARAM_INPUT', $tmp_dirpath_ARRAY)

        try{

            switch($connection_type){
                case 'FTP':

                    self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum FTP '.$flow_type.' endpoint integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    $tmp_FTP_SERVER = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $endpoint_data);
                    $tmp_FTP_USERNAME = self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $endpoint_data);
                    $tmp_FTP_PASSWORD = self::$oCRNRSTN_USR->getEnvResource('FTP_PASSWORD', $endpoint_data);
                    $tmp_FTP_PORT = self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $endpoint_data);
                    //$tmp_FTP_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $endpoint_data);

                    $tmp_endpoint_id = md5($tmp_FTP_SERVER.$tmp_FTP_USERNAME.$tmp_FTP_PASSWORD.$tmp_FTP_PORT);
                    $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

                    self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum process checking FTP ['.$tmp_FTP_SERVER.']['.$tmp_FTP_USERNAME.']['.$tmp_FTP_PORT.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    if($this->ready_for_preload($tmp_endpoint_serial)){

                        $this->validate_FTP_Endpoint($flow_type, $endpoint_data, $tmp_endpoint_serial);
                        $oLightning_ftp_conn = self::$oFourLivingCreatures_FTP->return_lightningFTPConn($tmp_endpoint_serial);
                        if($oLightning_ftp_conn->isValid){

                            //
                            // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                            $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);
                            //error_log('1086 ->'.$flow_type.', '.$connection_type.', '.$data_type.', '.$endpoint_data);
                            //          1086        SOURCE,         FTP,                CRNRSTN_WCR,    ELECTRUM_SOURCE_FTP00
                            $FIREHOT_oEndpoint->initialize_meta($flow_type, $connection_type, $data_type, $endpoint_data);

                            $this->oLighting_bolt_ARRAY[$flow_type][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                            $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                            switch($flow_type){
                                case 'SOURCE':

                                    if(!isset($this->execute_from_source_authorization)){

                                        $this->execute_from_source_authorization = true;

                                    }

                                break;
                                default:

                                    $this->execute_to_destination_authorization = true;

                                break;

                            }

                        }else{

                            switch($flow_type){
                                case 'SOURCE':

                                        $this->execute_from_source_authorization = false;

                                break;
                                default:

                                    if(!isset($this->execute_to_destination_authorization)) {

                                        $this->execute_to_destination_authorization = false;
                                    }

                                break;

                            }

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('This CRNRSTN :: Electrum process experienced error checking this FTP ['.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.'] endpoint.');

                        }

                    }else{

                        self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this FTP endpoint at ('.$tmp_FTP_SERVER.'::'.$tmp_FTP_PORT.') as a data '.strtolower($flow_type).', and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    }

                break;
                default:

                    //
                    // DIRECTORY
                    self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum Directory '.$flow_type.' endpoint integrity check beginning.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    $tmp_MKDIR_MODE = NULL;

                    switch($data_type){
                        case 'CRNRSTN_WCR':

                            $tmp_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $endpoint_data);
                            if($flow_type!='SOURCE'){

                                $tmp_MKDIR_MODE = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $endpoint_data);

                            }

                            //error_log('1095['.$data_type.'] - tmp_DIR_PATH='.$tmp_DIR_PATH.' tmp_MKDIR_MODE='.$tmp_MKDIR_MODE);
                            //self::$oCRNRSTN_USR->error_log('Electrum [WCR DIR PATH] TARGET DIRECTORY ['.$tmp_DIR_PATH.'] REQUEST RECEIVED', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                        break;
                        default:

                            switch($flow_type){
                                case 'SOURCE':

                                    $tmp_DIR_PATH = $endpoint_data;
                                    //self::$oCRNRSTN_USR->error_log('Electrum [PARAM DIR PATH] TARGET DIRECTORY ['.$endpoint_data.'] REQUEST RECEIVED', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                                break;
                                default:

                                    $tmp_DIR_PATH = $endpoint_data;
                                    $tmp_MKDIR_MODE = $mkdir_permissions_mode;
                                    //error_log('1112['.$data_type.'] - tmp_DIR_PATH='.$tmp_DIR_PATH.' tmp_MKDIR_MODE='.$tmp_MKDIR_MODE);

                                    //self::$oCRNRSTN_USR->error_log('Electrum [PARAM DIR PATH] TARGET DIRECTORY ['.$endpoint_data['path'].'] REQUEST RECEIVED', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                                break;
                            }

                            break;

                    }

                    $tmp_endpoint_id = md5($tmp_DIR_PATH);
                    $tmp_endpoint_serial = self::$oCRNRSTN_USR->generateNewKey(100);

                    //self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum '.$flow_type.' directory endpoint, '.$tmp_DIR_PATH.'.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    if($this->ready_for_preload($tmp_endpoint_serial)){

                        switch($flow_type){
                            case 'SOURCE':

                                if($this->validate_DIR_Endpoint($flow_type, $tmp_DIR_PATH)){

                                    //
                                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);

                                    $FIREHOT_oEndpoint->initialize_meta($flow_type, $connection_type, $data_type, $endpoint_data, $tmp_MKDIR_MODE);
                                    $this->oLighting_bolt_ARRAY[$flow_type][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                                    if(!isset($this->execute_from_source_authorization)){

                                        $this->execute_from_source_authorization = true;

                                    }

                                }else{

                                    $this->execute_from_source_authorization = false;

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('CRNRSTN :: Electrum process experienced '.strtolower($flow_type).' directory validation error at '.$tmp_DIR_PATH.'.');

                                }

                            break;
                            default:

                                //
                                // DESTINATION DIRECTORY
                                if($this->validate_DIR_Endpoint($flow_type, $tmp_DIR_PATH, $tmp_MKDIR_MODE)){

                                    //
                                    // COMPLETE THE INTEGRATION OF ENDPOINT INTO THIS ELECTRUM
                                    $FIREHOT_oEndpoint = new crnrstn_lightning_bolt($tmp_endpoint_serial, self::$oCRNRSTN_USR);
                                    //error_log('1170['.$flow_type.']['.$data_type.'] connection_type=['.$connection_type.'] - tmp_DIR_PATH='.$tmp_DIR_PATH.' tmp_MKDIR_MODE='.$tmp_MKDIR_MODE);

                                    $FIREHOT_oEndpoint->initialize_meta($flow_type, $connection_type, $data_type, $tmp_DIR_PATH, $tmp_MKDIR_MODE);
                                    $this->oLighting_bolt_ARRAY[$flow_type][$tmp_endpoint_serial][$tmp_endpoint_id][] = $FIREHOT_oEndpoint;

                                    $this->preload_spoiled_ARRAY[$tmp_endpoint_serial] = 1;

                                    $this->execute_to_destination_authorization = true;

                                }else{

                                    if(!isset($this->execute_to_destination_authorization)){

                                        $this->execute_to_destination_authorization = false;

                                    }

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    if(is_dir($tmp_DIR_PATH)){

                                        $tmp_current_perms = substr(decoct( fileperms($tmp_DIR_PATH) ), 2);
                                        throw new Exception('The CRNRSTN :: Electrum process is unable to access (or chmod to '.$tmp_MKDIR_MODE.') the destination directory path ("'.$tmp_DIR_PATH.'" is currently '.$tmp_current_perms.') for writing which is preventing successful validation and preload of this endpoint.');

                                    }else{

                                        throw new Exception('The CRNRSTN :: Electrum process is unable to access the destination directory path ('.$tmp_DIR_PATH.') for writing which is preventing successful validation and preload of this endpoint.');

                                    }

                                }

                            break;
                        }

                    }else{

                        self::$oCRNRSTN_USR->error_log('This CRNRSTN :: Electrum process has already validated this directory ('.$tmp_DIR_PATH.') as a data '.strtolower($flow_type).', and so will accelerate via skipping the preload check.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    }

                break;

            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    */

    public function ready_for_preload($endpoint_serial){

        if(isset($this->preload_spoiled_ARRAY[$endpoint_serial])){

            return false;

        }else{

            return true;

        }

    }

    public function exclude_DIR($nomination_pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes ['.crc32($this->electrum_process_id).']['.crc32($this->execution_batch_serial).'] DIRECTORY with pattern of (or to which is an exact match of) "'.$nomination_pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'DIRECTORY';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $nomination_pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_FILE($nomination_pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes ['.crc32($this->electrum_process_id).']['.crc32($this->execution_batch_serial).'] FILE with pattern of (or to which is an exact match of) "'.$nomination_pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'FILE';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $nomination_pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_assetGroupID($pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes OWNER GROUP ID with pattern of (or to which is an exact match of) "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'OWNER_GROUP';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_assetUserID($pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes OWNER USER ID with pattern of (or to which is an exact match of) "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'OWNER_USER';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_modifiedNewerThan($pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes MODIFIED NEWER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'MODIFIED_NT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_modifiedOlderThan($pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes MODIFIED OLDER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'MODIFIED_OT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_accessedNewerThan($pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes ACCESSED NEWER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'ACCESSED_NT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_accessedOlderThan($pattern, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes ACCESSED OLDER THAN "'.$pattern.'".', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'ACCESSED_OT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $pattern;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_fileSizeGreaterThan($bytes, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes FILESIZE LESS THAN "'.$bytes.'" bytes.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'FILE_SIZE_GT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $bytes;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    public function exclude_fileSizeLessThan($bytes, $WCRkey_or_DIRPATH){

        self::$oCRNRSTN_USR->error_log('CRNRSTN :: Electrum suppression includes FILESIZE LESS THAN "'.$bytes.'" bytes.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        $tmp_array = array();
        $tmp_array['exclusion_serial'] = self::$oCRNRSTN_USR->generateNewKey(50);
        $tmp_array['exclusion_type'] = 'FILE_SIZE_LT';
        $tmp_array['WCR_or_path'] = $WCRkey_or_DIRPATH;
        $tmp_array['pattern'] = $bytes;

        $this->asset_transfer_suppression_ARRAY[$this->electrum_process_id][$this->execution_batch_serial][] = $tmp_array;

    }

    private function validate_FTP_Endpoint($flow_type, $endpoint_data, $endpoint_serial){
        /*
         - n+1 DATA SOURCE VALIDATION
        * CAN I READ FROM SPECIFIED SOURCE?
        * IF THIS IS FTP ::
        HOW MANY ACTIVE PROCESSES ARE HITTING THIS SERVER? SCAN automation_runtime_config.FTP_SERVER_IP_SOURCE WHERE ISACTIVE=1
        NEED TO ALSO COMPARE FTP_SERVER_IP_DESTINATION AND FTP_SERVER_IP_SOURCE FOR FTP TO FTP ELECTRUM
        IF UNDER SPECIFIED LIMIT,
        1 - INSERT INTO automation_runtime_config WITH AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP SOURCE 123.123.122.123
        2 - INSERT INTO log_runtime_config AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP 123.123.122.123

        IF OVER SPECIFIED LIMIT,
        1 - INSERT INTO log_runtime_config AUTOMATION_STATE=FTP SOURCE CONNECTION SUPPRESSED :: 123.123.122.123
        2 - DIE()

            - n+1 DATA DESTINATION VALIDATION
        * CAN I WRITE TO LOCAL DIR PATH is_writable()
        * IF THIS IS FTP ::
        HOW MANY ACTIVE PROCESSES ARE HITTING THIS SERVER? SCAN automation_runtime_config.FTP_SERVER_IP_DESTINATION WHERE ISACTIVE=1
        IF UNDER SPECIFIED LIMIT,
        1 - UPDATE automation_runtime_config WITH AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP 123.123.122.123
        2 - INSERT INTO log_runtime_config AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP DESTINATION 123.123.122.123

        IF OVER SPECIFIED LIMIT,
        1 - INSERT INTO log_runtime_config AUTOMATION_STATE=FTP DESTINATION CONNECTION SUPPRESSED :: 123.123.122.123
        2 - DIE()

         * */

        if(!isset(self::$oFourLivingCreatures_FTP)){

            self::$oFourLivingCreatures_FTP = new crnrstn_fire_ftp_manager(self::$oCRNRSTN_USR);

        }

        self::$oFourLivingCreatures_FTP->initialize_ftp_endpoint($flow_type, $endpoint_data, $endpoint_serial);

    }

    private function validate_DIR_Endpoint($flow_type, $dirPath, $mkdir_mode=777){

        try{

            switch($flow_type) {
                case 'SOURCE':

                    if(is_dir($dirPath)){

                        //
                        // SOURCE - LOCAL_DIR
                        if(is_readable($dirPath)){

                            return true;

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum process has experienced permissions related errors attempting to read from the source directory, '.$dirPath.'.');

                        }

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The CRNRSTN :: Electrum process has experienced errors attempting to find the source directory, '.$dirPath.', within the local file system.');

                    }

                break;
                default:

                    //
                    // DESTINATION - LOCAL_DIR
                    if(is_dir($dirPath)){

                        if(is_writable($dirPath)){

                            return true;

                        }else{

                            //
                            // ATTEMPT TO CHANGE PERMISSIONS AND CHECK AGAIN
                            // BEFORE COMPLETELY GIVING UP
                            $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);
                            $tmp_config_serial = self::$oCRNRSTN_USR->return_configSerial();

                            $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced permissions related error as the destination directory, '.$dirPath.' ('.$tmp_current_perms.'), is NOT writable to '.$mkdir_mode.', and furthermore ';
                            if(chmod($dirPath, $mkdir_mode)){

                                $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                                return true;

                            }else{

                                $tmp_current_perms = substr(decoct( fileperms($dirPath) ), 2);

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('The CRNRSTN :: Electrum process has experienced permissions related error as the destination directory, '.$dirPath.', is NOT writable as '.$tmp_current_perms.'.');

                            }

                        }

                    }else{

                        if (!$this->mkdir_r($dirPath, $mkdir_mode)) {

                            $mkdir_mode = octdec( str_pad($mkdir_mode,4,'0',STR_PAD_LEFT) );

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The CRNRSTN :: Electrum process has experienced error as the destination directory does NOT exist, and it could NOT be created as '.$mkdir_mode.'.');

                        }else{

                            return true;

                        }

                    }

                break;
            }

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: http://php.net/manual/en/function.mkdir.php#68207
    private function mkdir_r($dirName, $mode=777){

        try{

            $mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
            $mode = (int)$mode;

            $dirs = explode('/', $dirName);
            $dir='';
            foreach ($dirs as $part) {
                $dir.=$part.'/';
                if (!is_dir($dir) && strlen($dir)>0) {
                    if(!mkdir($dir, $mode)){
                        $error = error_get_last();
                        throw new Exception($error['message']. ' mkdir_r() failed to mkdir :: ' . $dir);

                    }
                }
            }

            return true;

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }
    }


    //
    // SOURCE :: https://stackoverflow.com/questions/36310247/php-ftp-recursive-directory-listing
    // AUTHOR :: https://stackoverflow.com/users/850848/martin-prikryl
    private function ftp_list_files_recursive($ftp_stream, $path, $oEndpoint_serial){

        try{

            $path = rtrim($path, '/');

            $tmp_config_serial = self::$oCRNRSTN_USR->return_configSerial();
            
            # HIDDEN FILES HIDDEN - CONFIG UPDATES FOR VSFTPD :: UBUNTU 18.04
            #https://devanswers.co/installing-ftp-server-vsftpd-ubuntu-18-04/

            //ftp_chdir($ftp_stream, $path);
            //$lines = ftp_rawlist($ftp_stream, "-A");
            //$lines = ftp_rawlist($ftp_stream, '-AL '.$path, false);
            $lines = ftp_rawlist($ftp_stream, '-AL '.$path);
            $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
            //$this->tmp_sum = $this->tmp_sum + sizeof($lines);
            //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG lines cnt='.sizeof($lines).' out of '.$this->tmp_sum.' total.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');

            $result = array();

            foreach ($lines as $line){
                //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG LINE=['.$line.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');

                $tokens = explode(" ", $line);
                $name = $tokens[count($tokens) - 1];
                $type = $tokens[0][0];
                $filepath = $path . "/" . $name;

                if ($type == 'd'){

                    $this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial][] = $filepath;
                    $result = array_merge($result, $this->ftp_list_files_recursive($ftp_stream, $filepath, $oEndpoint_serial));

                }else{

                    //$this->tmp_sum = $this->tmp_sum + 1;
                    //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG[sum='.$this->tmp_sum.'] type='.$type.' filepath='.$filepath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');

                    $result[] = $filepath;
                    $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$filepath] = ftp_size($ftp_stream, $name);
                    $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$filepath] = ftp_mdtm($ftp_stream, $name);

                }
            }

            //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG[current files sum='.$this->tmp_sum.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');

            return $result;

        }catch(Exception $e){

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }


    //
    // SOURCE :: https://stackoverflow.com/questions/36310247/php-ftp-recursive-directory-listing
    // AUTHOR :: https://stackoverflow.com/users/850848/martin-prikryl
    private function _original_ftp_list_files_recursive($ftp_stream, $path){

        try{
            $tmp_config_serial = self::$oCRNRSTN_USR->return_configSerial();
            $lines = ftp_rawlist($ftp_stream, $path);
            $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

            $result = array();

            foreach ($lines as $line){
                $tokens = explode(" ", $line);
                $name = $tokens[count($tokens) - 1];
                $type = $tokens[0][0];
                $filepath = $path . "/" . $name;

                if ($type == 'd')
                {
                    $result = array_merge($result, $this->ftp_list_files_recursive($ftp_stream, $filepath));
                }
                else
                {
                    $result[] = $filepath;
                }
            }
            return $result;

        } catch (Exception $e) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function merge_ftp_dir_array_to_file($ftp_contents_SOURCE, $oEndpoint_serial){

        $tmp_dirPath_flag_ARRAY = array();
        $tmp_dirPath_ARRAY = array();
        $tmp_FTP_dirPath_flagOut_ARRAY = array();

        $tmp_file_cnt = sizeof($ftp_contents_SOURCE);
        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP FILE CNT['.$tmp_file_cnt.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');


        foreach($ftp_contents_SOURCE as $fileKey => $filePath){
            $tmp_dirPath_ARRAY[$filePath] = 1;
            foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey => $dirPath){

                $pos = strpos($filePath, $dirPath);
                if ($pos !== false && !isset($tmp_FTP_dirPath_flagOut_ARRAY[$dirPath])) {

                    //
                    // DISQUALIFY THIS DIRECTORY FOR FILE PATH MATCH
                    $tmp_FTP_dirPath_flagOut_ARRAY[$dirPath] = 5;

                }

            }

        }

        foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey => $dirPath){
            foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey2 => $dirPath2) {

                $pos = strpos($dirPath, $dirPath2);
                if ($pos !== false && !isset($tmp_FTP_dirPath_flagOut_ARRAY[$dirPath])) {

                    if( strlen($dirPath2) != strlen($dirPath)){

                        //
                        // DISQUALIFY THIS DIRECTORY FOR FILE PATH MATCH
                        $tmp_FTP_dirPath_flagOut_ARRAY[$dirPath2] = 5;

                    }
                }
            }
        }

        $tmp_tot_dir_cnt = sizeof($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial]);
        foreach($this->ftp_recursive_sniffed_directory_ARRAY[$oEndpoint_serial] as $dirKey => $dirPath) {

            if(!isset($tmp_FTP_dirPath_flagOut_ARRAY[$dirPath])){
                $tmp_dirPath_ARRAY[$dirPath] = 1;
                //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP['.$tmp_tot_dir_cnt.'] DEBUG BETTER DIR ='.$dirPath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');

            }

        }

        return $tmp_dirPath_ARRAY;

        //self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DEBUG DIR ='.$dirPath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_FTP_DEBUG');

    }

    private function path_no_slash_dot($path){

        $tmp_strlen = strlen($path);
        $tmp_path_array = self::$oCRNRSTN_USR->str_split_unicode($path);
        $tmp_path_array_rev = array_reverse($tmp_path_array);

        if($tmp_path_array_rev[0]=='.' && $tmp_path_array_rev[1]=='/'){

            return false;

        }else{

            return true;

        }
        /*
        $path = trim($path);
        $tmp_strlen = strlen($path);
        $tmp_pos = strpos($path,'/.');

        if($tmp_pos==($tmp_strlen-2)){

            return false;

        }else{

            return true;

        }
        */

    }

    private function find_deepest_empty_dir($results, $is_dir_status_array, $results_pos, $tmp_dirPath_flag_ARRAY=NULL, $prev_result_pos=NULL, $prev_result_path=NULL){

        $tmp_results_cnt = sizeof($results);
        for($search_pos=$results_pos; $search_pos<$tmp_results_cnt; $search_pos++){

            if($is_dir_status_array[$search_pos]==1){

                //
                // WE HAVE A DIRECTORY RESULT
                if ($this->path_no_slash_dot($results[$search_pos])) {

                    //
                    // DIRECTORY WITH GOOD FORMAT
                    if(!isset($prev_result_path)){
                        $prev_result_pos = $search_pos;
                        $prev_result_path = $results[$search_pos];
                        $current_result_path = $results[$search_pos];

                    }else{

                        $current_result_path = $results[$search_pos];
                        $pos = strpos($current_result_path, $prev_result_path);
                        if ($pos !== false) {

                            //
                            // TRANSITION CURRENT TO PREVIOUS
                            $prev_result_pos = $search_pos;
                            $prev_result_path = $current_result_path;


                        }else{

                            //
                            // BURN CURRENT PATH
                            if(!isset($tmp_dirPath_flag_ARRAY[$prev_result_path])){

                                //self::$oCRNRSTN_USR->error_log('['.$search_pos.']BURN DIR ->'.$prev_result_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');
                                $tmp_deepest_empty_dir_ARRAY['burn_result_path'] = $prev_result_path;
                                $tmp_deepest_empty_dir_ARRAY['results_pos'] = $search_pos;

                                //$tmp_dirPath_flag_ARRAY[0] = $prev_result_path;
                                $tmp_deepest_empty_dir_ARRAY['flag_array'][0] = $prev_result_path;

                                return $tmp_deepest_empty_dir_ARRAY;

                            }else{

                                return NULL;

                            }

                        }

                    }

                }

            }else{

                //
                // WE HAVE FILE. SKIP DIRECTORY.

            }

        }

    }

    //
    // SOURCE :: http://php.net/manual/en/class.recursivedirectoryiterator.php
    // AUTHOR :: http://php.net/manual/en/class.recursivedirectoryiterator.php#85805
    public function localdir_list_files_recursive($dir, $oEndpoint_serial, $files_only=false){
        $results = array();
        $results_final_output = array();
        $results_filePath_output = array();
        $is_dir_status_array = array();
        $path = realpath($dir);
        $results_totalSize = 0;

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($objects as $name => $object) {
            //if ((strpos($name, '/.') !== false) || (strpos($name, '/..') !== false)) {
            if ((strpos($name, '/..') !== false)) {

            } else {

                if (!$files_only) {

                    $results[] = $name;
                    //self::$oCRNRSTN_USR->error_log('RAW ->' . $name, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                    if (!(is_dir($name))) {
                        //self::$oCRNRSTN_USR->error_log('FILE ->'.$name, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                        //
                        // WE HAVE A FILE
                        if ($this->path_no_slash_dot($name)) {

                            $results_filePath_output[$name] = 1;
                            $results_final_output[$name] = 1;

                            $tmp_filestat_ARRAY = stat($name);
                            $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$name] = $this->find_filesize($name);

                            $tmp_array = posix_getpwuid($tmp_filestat_ARRAY['uid']);
                            $this->source_file_uid_INT_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['uid'];
                            $this->source_file_uid_STRING_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_array['name'];

                            $tmp_array = posix_getgrgid($tmp_filestat_ARRAY['gid']);
                            $this->source_file_gid_INT_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['gid'];
                            $this->source_file_gid_STRING_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_array['name'];

                            $this->source_file_lastaccess_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['atime'];
                            $this->source_file_lastmodify_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['mtime'];

                            $this->source_file_blocksize_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['blksize'];
                            $this->source_file_blockallocate_at_path_ARRAY[$oEndpoint_serial][$name] = $tmp_filestat_ARRAY['blocks'];

                            $perms = fileperms($name);
                            $this->source_file_fullpermissions_at_path_ARRAY[$oEndpoint_serial][$name] = $this->return_full_permissions($perms);

                            // SOURCE :: https://www.php.net/manual/en/function.fileperms.php
                            // AUTHOR :: https://www.php.net/manual/en/function.fileperms.php#113060
                            $this->source_file_octalpermissions_at_path_ARRAY[$oEndpoint_serial][$name] = decoct($perms & 0777);

                            $results_totalSize += $this->source_file_size_at_path_ARRAY[$oEndpoint_serial][$name];

                        }

                        $is_dir_status_array[] = 0;

                    } else {
                        //self::$oCRNRSTN_USR->error_log('DIR ->'.$name, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                        //
                        // WE HAVE A DIRECTORY
                        $is_dir_status_array[] = 1;

                    }

                } else {

                    if (!(is_dir($name))) {

                        $results[] = $name;

                    }

                }

            }

        }

        //
        // SEARCH FOR EMPTY DIRECTORIES
        if (!$files_only) {
            $tmp_dirPath_flag_ARRAY = array();
            $tmp_dirPath_ARRAY = array();
            $tmp_dirPath_flagOut_ARRAY = array();

            //
            // LOOP THROUGH RESULT SET AND ADD ANY EMPTY DIR
            $tmp_result_cnt = sizeof($results);
            for ($results_pos = 0; $results_pos < $tmp_result_cnt; $results_pos++) {

                $tmp_dir_selection = $this->find_deepest_empty_dir($results, $is_dir_status_array, $results_pos, $tmp_dirPath_flag_ARRAY);

                if(isset($tmp_dir_selection)){
                    //self::$oCRNRSTN_USR->error_log('WE LIKE DIR ->'.$tmp_dir_selection['flag_array'][0], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                    $tmp_dirPath_flag_ARRAY[$tmp_dir_selection['flag_array'][0]] = 1;

                }

            }

            //
            // FOR EACH DIRECTORY PATH, IS THERE A FILE CONTAINING IT THEREIN?
            foreach($results_filePath_output as $filePth => $fileKey){

                foreach($tmp_dirPath_flag_ARRAY as $dirPath => $dirKey){
                    $pos = strpos($filePth, $dirPath);
                    if ($pos !== false && !isset($tmp_dirPath_flagOut_ARRAY[$dirPath])) {

                        //
                        // DISQUALIFY THIS DIRECTORY FOR FILE PATH MATCH
                        //self::$oCRNRSTN_USR->error_log('DISQUALIFY THIS DIRECTORY->'.$dirPath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                        $tmp_dirPath_flagOut_ARRAY[$dirPath] = 5;

                    }
                }
            }

            //
            // APPEND EMPTY DIRECTORIES TO ARRAY OF FILEPATH
            foreach($tmp_dirPath_flag_ARRAY as $dirPath => $dirKey){

                if(!isset($tmp_dirPath_flagOut_ARRAY[$dirPath])){
                    //self::$oCRNRSTN_USR->error_log('WE BURN DIR ->'.$dirPath, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

                    $results_final_output[$dirPath] = 1;

                }

            }

        }

        $this->source_total_filesize_ARRAY[$oEndpoint_serial][] = $results_totalSize;

        return $results_final_output;

    }

    private function loadElectrumData($execution_serial, $batch_serial, $content_type, $section_content_shell, $hot_src_connection_ARRAY=NULL){

        $tmp_final_out = '';

        switch($content_type){
            case 'ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT':
            case 'ELECTRUM_DESTINATION_PATHS_DETAIL_HTML':

                $tmp_DEST_oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];

                if(!is_object($hot_src_connection_ARRAY['oLightning_ftp_conn'])) {

                    //
                    // DIRECTORY SOURCE
                    $tmp_DEST_DIR_PATH = $tmp_DEST_oEndpoint->return_LOCAL_DIR_PATH();

                    if (!is_dir($tmp_DEST_DIR_PATH)) {

                        $local_oWCR_key = $tmp_DEST_oEndpoint->return_local_oWCR_key();
                        $tmp_DEST_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $local_oWCR_key);

                    }

                }else{

                    //
                    // FTP SOURCE
                    $tmp_DEST_DIR_PATH = $tmp_DEST_oEndpoint->return_FTP_DIR_PATH();

                }

                foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY) {

                    $tmp_oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
                    $tmp_ts_nom = $tmp_oEndpoint->return_timestamp_nom();

                    if($tmp_ts_nom!=''){
                        $pos_fslash = strpos($tmp_DEST_DIR_PATH, '/');

                        if ($pos_fslash !== false) {

                            $breakChar = '/';

                        } else {

                            $breakChar = '\\';
                        }

                        $tmp_ts_nom .= $breakChar;

                    }

                    /*
                    $tmp_source_root_ARRAY = explode( '/', $this->local_dir_path);
                    $tmp_loop_size = sizeof($tmp_source_root_ARRAY);
                    $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];
                     * */

                    $tmp_sect_final_out .= $section_content_shell;
                    $tmp_sect_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_FILES_MOVED_COUNT}', '0', $tmp_sect_final_out);
                    $tmp_sect_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_FILES_MOVED_PATH}', $tmp_DEST_DIR_PATH.$tmp_ts_nom, $tmp_sect_final_out);

                }

                return $tmp_sect_final_out;

            break;
            case 'ELECTRUM_DATA_DESTINATION_TEXT':
            case 'ELECTRUM_DATA_DESTINATION_HTML':

                /*
                {STATUS_THUMBNAIL_QUICKGLANCE} = return_quickGlanceThumb('success')
                return_quickGlanceCopy('success')
                {ENDPOINT_PATH_OR_IP+PORT} = 123.123.123.123 at port 21
                {FILES_TOTALING_SIZE} = 165,245 files<br>totaling 321.234 GiB
                {ENDPOINT_PATH} = /var/www/html/site2/
                {ENDPOINT_TYPE} = FTP

                {STATUS_THUMBNAIL_QUICKGLANCE}
                {ENDPOINT_TYPE}
                {ENDPOINT_PATH_OR_IP+PORT}
                {STATUS_COPY_QUICKGLANCE} = return_quickGlanceCopy('success')

                {ELECTRUM_DESTINATION_PATHS_DETAIL}
                    {ENDPOINT_FILES_MOVED_COUNT}
                    {ENDPOINT_FILES_MOVED_PATH}

                $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom();

                */

                foreach($this->queued_endpoint_ARRAY[$batch_serial]['DESTINATION'] as $key_src => $hot_src_connection_ARRAY) {
                    $tmp_thumb_border_top_FLAG = false;
                    $tmp_thumb_border_top = 15;
                    $tmp_final_out .= $section_content_shell;

                    $tmp_oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];
                    $tmp_timestamp_nom = $tmp_oEndpoint->return_timestamp_nom();

                    if(!is_object($hot_src_connection_ARRAY['oLightning_ftp_conn'])) {

                        //
                        // DIRECTORY SOURCE
                        $tmp_endpoint_type = 'Local Directory';
                        $tmp_src_DIR_PATH = $tmp_oEndpoint->return_LOCAL_DIR_PATH();

                        if (!is_dir($tmp_src_DIR_PATH)) {

                            $local_oWCR_key = $tmp_oEndpoint->return_local_oWCR_key();
                            $tmp_src_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $local_oWCR_key);

                        }

                        $tmp_src_path_or_ip = $tmp_src_DIR_PATH;

                    }else{

                        //
                        // FTP SOURCE
                        $tmp_endpoint_type = 'FTP';
                        $tmp_src_FTP_SERVER = $tmp_oEndpoint->return_FTP_SERVER();
                        $tmp_src_FTP_PORT = $tmp_oEndpoint->return_FTP_PORT();
                        $tmp_src_DIR_PATH = $tmp_oEndpoint->return_FTP_DIR_PATH();
                        $tmp_src_path_or_ip = $tmp_src_FTP_SERVER.' at port '.$tmp_src_FTP_PORT;

                    }

                    $oEndpoint_serial = $tmp_oEndpoint->return_serial();
                    if(!isset($this->directory_content_ARRAY[$oEndpoint_serial])) {

                        //
                        // CONNECTION ERROR - NO LISTING OF FILES ACQUIRED
                        $tmp_thumb = $this->return_quickGlanceThumb('error');
                        $tmp_copy = $this->return_quickGlanceCopy('error');
                        $tmp_thumb_TEXT = '** CONNECTION ERROR **';

                    }else {

                        $tmp_thumb = $this->return_quickGlanceThumb('success');
                        $tmp_copy = $this->return_quickGlanceCopy('success');
                        $tmp_thumb_TEXT = '** CONNECTION SUCCESS **';
                        $total_endpoint_file_count = 0;

                        if ($content_type == 'ELECTRUM_DATA_DESTINATION_HTML') {

                            if($tmp_timestamp_nom!='' && is_dir($tmp_src_path_or_ip)){

                                $tmp_src_path_or_ip_HTML = $tmp_src_path_or_ip.$tmp_timestamp_nom;

                            }else{

                                $tmp_src_path_or_ip_HTML = $tmp_src_path_or_ip;

                            }

                            if (strlen($tmp_src_path_or_ip) > 52) {
                                $pos_fslash = strpos($tmp_src_path_or_ip, '/');

                                if ($pos_fslash !== false) {

                                    $breakChar = '/';

                                } else {

                                    $breakChar = '\\';
                                }

                                //
                                // ADD TRAILING SLASH
                                if($tmp_timestamp_nom!='' && is_dir($tmp_src_path_or_ip)){

                                    $tmp_src_path_or_ip_HTML .= $breakChar;

                                }

                                //
                                // BREAK AT SLASH 71 CHAR CHUNK TO THE END
                                $tmp_array = self::$oCRNRSTN_USR->properStringBreak($tmp_src_path_or_ip, $breakChar, '71');
                                $tmp_src_path_or_ip_HTML = '';
                                $tmp_break_size = sizeof($tmp_array);

                                for ($i = 0; $i < $tmp_break_size; $i++) {

                                    if ($tmp_thumb_border_top_FLAG) {

                                        $tmp_thumb_border_top_FLAG = false;

                                    } else {

                                        $tmp_thumb_border_top += 25;

                                    }

                                    $tmp_src_path_or_ip_HTML .= $tmp_array[$i] . '<br>...';

                                }

                                $tmp_src_path_or_ip_HTML = rtrim($tmp_src_path_or_ip_HTML, '<br>...');

                            }

                            /*
                            {STATUS_THUMBNAIL_QUICKGLANCE}
                            {ENDPOINT_TYPE}
                            {ENDPOINT_PATH_OR_IP+PORT}
                            {STATUS_COPY_QUICKGLANCE} = return_quickGlanceCopy('success')

                            {ELECTRUM_DESTINATION_PATHS_DETAIL}
                                {ENDPOINT_FILES_MOVED_COUNT}
                                {ENDPOINT_FILES_MOVED_PATH}
                             * */
                            $tmp_cummulative_dest_path = $this->return_electrumDataDestinationPathDetailsOutputShell('HTML');
                            $tmp_cummulative_dest_path = $this->loadElectrumData($execution_serial, $batch_serial, 'ELECTRUM_DESTINATION_PATHS_DETAIL_HTML', $tmp_cummulative_dest_path, $hot_src_connection_ARRAY);

                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{THUMB_BORDER_TOP}', $tmp_thumb_border_top, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{STATUS_COPY_QUICKGLANCE}', $tmp_copy, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_src_path_or_ip_HTML, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_FILES_MOVED_COUNT}', $total_endpoint_file_count . ' files', $tmp_final_out);

                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ELECTRUM_DESTINATION_PATHS_DETAIL_HTML}', $tmp_cummulative_dest_path, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                        } else {

                            if($tmp_timestamp_nom!='' && is_dir($tmp_src_path_or_ip)){

                                $tmp_src_path_or_ip_TEXT = $tmp_src_path_or_ip.$tmp_timestamp_nom;

                            }else{

                                $tmp_src_path_or_ip_TEXT = $tmp_src_path_or_ip;

                            }

                            if (strlen($tmp_src_path_or_ip) > 52) {
                                $pos_fslash = strpos($tmp_src_path_or_ip, '/');

                                if ($pos_fslash !== false) {

                                    $breakChar = '/';


                                } else {

                                    $breakChar = '\\';
                                }

                                if($tmp_timestamp_nom!='' && is_dir($tmp_src_path_or_ip)){

                                    $tmp_src_path_or_ip_TEXT .= $breakChar;

                                }

                                //
                                // BREAK AT SLASH 52 CHAR CHUNK TO THE END
                                $tmp_array = self::$oCRNRSTN_USR->properStringBreak($tmp_src_path_or_ip, $breakChar, '52');
                                $tmp_src_path_or_ip_TEXT = '';
                                $tmp_break_size = sizeof($tmp_array);
                                for ($i = 0; $i < $tmp_break_size; $i++) {

                                    $tmp_src_path_or_ip_TEXT .= $tmp_array[$i] . '
    ...';

                                }

                                $tmp_src_path_or_ip_TEXT = rtrim($tmp_src_path_or_ip_TEXT, '
    ...');

                            }

                            //
                            // TEXT VERSION
                            /*
                             {STATUS_THUMBNAIL_QUICKGLANCE}
                            {ENDPOINT_TYPE}
                            {ENDPOINT_PATH_OR_IP+PORT}
                            {STATUS_COPY_QUICKGLANCE} = return_quickGlanceCopy('success')

                            {ELECTRUM_DESTINATION_PATHS_DETAIL_HTML}
                                {ENDPOINT_FILES_MOVED_COUNT}
                                {ENDPOINT_FILES_MOVED_PATH}
                             * */

                            $tmp_cummulative_dest_path = $this->return_electrumDataDestinationPathDetailsOutputShell();
                            $tmp_cummulative_dest_path = $this->loadElectrumData($execution_serial, $batch_serial, 'ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT', $tmp_cummulative_dest_path, $hot_src_connection_ARRAY);

                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb_TEXT, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_src_path_or_ip_TEXT, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_FILES_MOVED_COUNT}', $total_endpoint_file_count . ' files', $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ELECTRUM_DESTINATION_PATHS_DETAIL_TEXT}', $tmp_cummulative_dest_path, $tmp_final_out);
                            $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                        }
                    }

                }

                return $tmp_final_out;

            break;
            case 'ELECTRUM_DATA_SOURCE_TEXT':
            case 'ELECTRUM_DATA_SOURCE_HTML':

                /*
                {STATUS_THUMBNAIL_QUICKGLANCE} = return_quickGlanceThumb('success')
                return_quickGlanceCopy('success')
                {ENDPOINT_PATH_OR_IP+PORT} = 123.123.123.123 at port 21
                {FILES_TOTALING_SIZE} = 165,245 files<br>totaling 321.234 GiB
                {ENDPOINT_PATH} = /var/www/html/site2/
                {ENDPOINT_TYPE} = FTP

                ===
                {ELECTRUM_DESTINATION_PATHS_DETAIL} = {ENDPOINT_FILES_MOVED_COUNT} files
{ENDPOINT_FILES_MOVED_PATH}
                ===
                */
            //error_log('3515 - '.$section_content_shell);

            foreach($this->queued_endpoint_ARRAY[$batch_serial]['SOURCE'] as $key_src => $hot_src_connection_ARRAY) {
                    $tmp_thumb_border_top_FLAG = false;
                    $tmp_thumb_border_top = 25;
                    $tmp_final_out .= $section_content_shell;
                    //error_log('3518 - '.$tmp_final_out);
                    $tmp_oEndpoint = $hot_src_connection_ARRAY['FIREHOT_oEndpoint'];

                    if(!is_object($hot_src_connection_ARRAY['oLightning_ftp_conn'])) {

                        //
                        // DIRECTORY SOURCE
                        $tmp_endpoint_type = 'Local Directory';
                        $tmp_src_DIR_PATH = $tmp_oEndpoint->return_LOCAL_DIR_PATH();

                        if (!is_dir($tmp_src_DIR_PATH)) {

                            $local_oWCR_key = $tmp_oEndpoint->return_local_oWCR_key();
                            $tmp_src_DIR_PATH = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $local_oWCR_key);

                        }

                        $tmp_src_path_or_ip = $tmp_src_DIR_PATH;

                    }else{

                        //
                        // FTP SOURCE
                        $tmp_endpoint_type = 'FTP';
                        $tmp_src_FTP_SERVER = $tmp_oEndpoint->return_FTP_SERVER();
                        $tmp_src_FTP_PORT = $tmp_oEndpoint->return_FTP_PORT();
                        $tmp_src_DIR_PATH = $tmp_oEndpoint->return_FTP_DIR_PATH();
                        $tmp_src_path_or_ip = $tmp_src_FTP_SERVER.' at port '.$tmp_src_FTP_PORT;

                    }

                    $oEndpoint_serial = $tmp_oEndpoint->return_serial();
                    $tmp_output_fileSize_total = '';
                    if(!isset($this->directory_content_ARRAY[$oEndpoint_serial])) {
                        //
                        // CONNECTION ERROR - NO LISTING OF FILES ACQUIRED
                        $tmp_thumb = $this->return_quickGlanceThumb('error');
                        $tmp_thumb_TEXT = '** CONNECTION ERROR **';

                    }else{

                        $tmp_thumb = $this->return_quickGlanceThumb('success');
                        $tmp_thumb_TEXT = '** CONNECTION SUCCESS **';
                        $total_endpoint_file_count = sizeof($this->directory_content_ARRAY[$oEndpoint_serial]);

                        $tmp_total_filesize = 0;
                        $tmp_null_filesize_cnt = 0;
                        foreach($this->source_file_size_at_path_ARRAY[$oEndpoint_serial] as $path => $filesize){

                            if($filesize>0){

                                $tmp_total_filesize += (int) $filesize;

                            }else{

                                $tmp_null_filesize_cnt++;

                            }


                        }

                        $tmp_output_fileSize_total = self::$oCRNRSTN_USR->formatBytes($tmp_total_filesize, 5);

                    }

                    $tmp_output_fileSize_total_TEXT = $tmp_output_fileSize_total_HTML = $tmp_output_fileSize_total;

                    if($tmp_null_filesize_cnt>0){
                        $tmp_line_wrap_count++;
                        $tmp_thumb_border_top_FLAG = true;
                        $tmp_thumb_border_top += 25;
                        if($tmp_null_filesize_cnt>1){

                            $tmp_output_fileSize_total_HTML = $tmp_output_fileSize_total.'<br><strong>(with ftp_size() err<br>on '.$tmp_null_filesize_cnt.' files)</strong>';
                            $tmp_output_fileSize_total_TEXT = $tmp_output_fileSize_total.'
(with ftp_size() err on '.$tmp_null_filesize_cnt.' files)';

                        }else{

                            $tmp_output_fileSize_total_HTML = $tmp_output_fileSize_total.'<br><strong>(with ftp_size() err<br>on '.$tmp_null_filesize_cnt.' file)</strong>';
                            $tmp_output_fileSize_total_TEXT = $tmp_output_fileSize_total.'
(with ftp_size() err on '.$tmp_null_filesize_cnt.' files)';

                        }
                    }

                    if($content_type=='ELECTRUM_DATA_SOURCE_HTML'){

                        $tmp_src_path_or_ip_HTML = $tmp_src_path_or_ip;

                        if(strlen($tmp_src_path_or_ip)>52){
                            $pos_fslash = strpos($tmp_src_path_or_ip, '/');

                            if($pos_fslash !== false){

                                $breakChar = '/';

                            }else{

                                $breakChar = '\\';
                            }

                            //
                            // BREAK AT SLASH 52 CHAR CHUNK TO THE END
                            $tmp_array = self::$oCRNRSTN_USR->properStringBreak($tmp_src_path_or_ip, $breakChar, '52');
                            $tmp_src_path_or_ip_HTML = '';
                            $tmp_break_size = sizeof($tmp_array);

                            for($i=0;$i<$tmp_break_size;$i++){

                                if($tmp_thumb_border_top_FLAG){

                                    $tmp_thumb_border_top_FLAG = false;

                                }else{

                                    $tmp_thumb_border_top += 25;

                                }

                                $tmp_src_path_or_ip_HTML .= $tmp_array[$i].'<br>...';

                            }

                            $tmp_src_path_or_ip_HTML = rtrim($tmp_src_path_or_ip_HTML, '<br>...');

                        }

                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{THUMB_BORDER_TOP}', $tmp_thumb_border_top, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_src_path_or_ip_HTML, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{FILES_TOTALING_SIZE}', $total_endpoint_file_count.' files<br>totaling '.$tmp_output_fileSize_total_HTML, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_PATH}', $tmp_src_DIR_PATH, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                    }else{

                        $tmp_src_path_or_ip_TEXT = $tmp_src_path_or_ip;

                        if(strlen($tmp_src_path_or_ip)>52){
                            $pos_fslash = strpos($tmp_src_path_or_ip, '/');

                            if($pos_fslash !== false){

                                $breakChar = '/';

                            }else{

                                $breakChar = '\\';
                            }

                            //
                            // BREAK AT SLASH 52 CHAR CHUNK TO THE END
                            $tmp_array = self::$oCRNRSTN_USR->properStringBreak($tmp_src_path_or_ip, $breakChar, '52');
                            $tmp_src_path_or_ip_TEXT = '';
                            $tmp_break_size = sizeof($tmp_array);
                            for($i=0;$i<$tmp_break_size;$i++){

                                $tmp_src_path_or_ip_TEXT .= $tmp_array[$i].'
...';

                            }

                            $tmp_src_path_or_ip_TEXT = rtrim($tmp_src_path_or_ip_TEXT, '
...');

                        }

                        //
                        // TEXT VERSION
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{STATUS_THUMBNAIL_QUICKGLANCE}', $tmp_thumb_TEXT, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_PATH_OR_IP+PORT}', $tmp_src_path_or_ip_TEXT, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{FILES_TOTALING_SIZE}', $total_endpoint_file_count.' files totaling '.$tmp_output_fileSize_total_TEXT, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_PATH}', $tmp_src_DIR_PATH, $tmp_final_out);
                        $tmp_final_out = self::$oCRNRSTN_USR->properReplace('{ENDPOINT_TYPE}', $tmp_endpoint_type, $tmp_final_out);

                    }

                }

                return $tmp_final_out;

            break;
            default:

                return $section_content_shell;

            break;

        }


    }

    private function return_CRNRSTN_SysMsgContent($execution_serial, $batch_serial, $content_type = NULL, $msg_format = 'TEXT'){

        try{

            $msg_format = trim(strtoupper($msg_format));
            $content_type = trim(strtoupper($content_type));

            switch($content_type){
                case 'ELECTRUM_DATA_SOURCE_TEXT':
                case 'ELECTRUM_DATA_SOURCE_HTML':
                    $tmp_section_content_shell = '';

                    $tmp_section_content_shell .= $this->return_electrumDataSourceOutputShell($msg_format);

                    $tmp_section_content_shell = $this->loadElectrumData($execution_serial, $batch_serial, $content_type, $tmp_section_content_shell);

                    return $tmp_section_content_shell;

                break;
                case 'ELECTRUM_DATA_DESTINATION_TEXT':
                case 'ELECTRUM_DATA_DESTINATION_HTML':
                    $tmp_section_content_shell = '';

                    $tmp_section_content_shell .= $this->return_electrumDataDestinationOutputShell($msg_format);

                    $tmp_section_content_shell = $this->loadElectrumData($execution_serial, $batch_serial, $content_type, $tmp_section_content_shell);

                    return $tmp_section_content_shell;

                break;
                case 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT':
                case 'ELECTRUM_DATA_HANDLING_PROFILE_HTML':

                    return $this->return_electrumDataHandling($msg_format);

                break;
                case 'ELECTRUM_ERRORS_TRACE_TITLE_TEXT':

                    return $this->return_electrumErrorsTraceTitle($msg_format);

                break;
                case 'ELECTRUM_ERRORS_TRACE_TEXT':
                case 'ELECTRUM_ERRORS_TRACE_HTML':

                    return $this->return_electrumErrorsTrace($msg_format);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An unknown system message content type "'.$content_type.'" ('.$msg_format.') has been requested.');

                break;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.fileperms.php
    private function return_full_permissions($perms){

        //$perms = fileperms('/etc/passwd');

        switch ($perms & 0xF000) {
            case 0xC000: // socket
                $info = 's';
                break;
            case 0xA000: // symbolic link
                $info = 'l';
                break;
            case 0x8000: // regular
                $info = 'r';
                break;
            case 0x6000: // block special
                $info = 'b';
                break;
            case 0x4000: // directory
                $info = 'd';
                break;
            case 0x2000: // character special
                $info = 'c';
                break;
            case 0x1000: // FIFO pipe
                $info = 'p';
                break;
            default: // unknown
                $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

        // World
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

        return $info;

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

    public function terminate_all_ftp(){

        try{

            //
            // FTP - CLOSE
            if(isset(self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY)){

                foreach(self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY as $serial=>$oLightning_ftp_conn){

                    self::$oCRNRSTN_USR->error_log('Electrum FTP connection_status='.$oLightning_ftp_conn->connection_status, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    if($oLightning_ftp_conn->connection_status != 'FTP connection successfully closed'){

                        $oFTP_stream_resource = $oLightning_ftp_conn->return_ftp_stream();
                        if(isset($oFTP_stream_resource)) {

                            if(ftp_close($oFTP_stream_resource)){

                                $oLightning_ftp_conn->log_connection_status('FTP connection successfully closed');

                            }else{

                                $oLightning_ftp_conn->log_connection_status('Error experienced closing FTP connection.');

                            }

                            self::$oFourLivingCreatures_FTP->lightning_FTP_conn_ARRAY[$serial] = $oLightning_ftp_conn;

                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('oFTP_stream_resource is not set.');

                        }
                    }

                }

            }

            return NULL;

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    private function return_electrumDataHandling($msgFormat='TEXT'){

        switch($msgFormat){
            case 'HTML':

                $tmp_content = '<div style="font-weight: bold; font-size: 20px;">HTML VERSION CONTENT - ELECTRUM_DATA_HANDLING_PROFILE_HTML</div>';

            break;
            default:

                $tmp_content = 'TEXT VERSION CONTENT :: ELECTRUM_DATA_HANDLING_PROFILE_TEXT';

            break;

        }

        return $tmp_content;

    }

    private function return_electrumErrorsTraceTitle($msgFormat='TEXT'){

        switch($msgFormat){
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
'.'{ELECTRUM_ERRORS_TRACE_TITLE_TEXT_}';

            break;

        }

        return $tmp_content;

    }

    private function return_electrumErrorsTrace($msgFormat='TEXT'){

        switch($msgFormat){
            case 'HTML':

                $tmp_content = '<tr>
                                        <td style="background-color: #F0F0F0;">
                                            <div style="border-left:15px solid #F0F0F0; border-top:15px solid #F0F0F0; border-bottom:15px solid #F0F0F0;  font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:23px; text-align:left;">{ELECTRUM_ERRORS_TRACE_HTML_}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ELECTRUM ERRORS TRACE HTML CONTENT HERE...
                                        </td>
                                    </tr>';

            break;
            default:

                $tmp_content = 'TEXT VERSION CONTENT :: ELECTRUM_ERRORS_TRACE_TEXT';

            break;

        }

        return $tmp_content;

    }

    private function return_electrumDataDestinationOutputShell($msg_format){

        switch($msg_format){
            case 'HTML':

                $tmp_content = '<tr>
                                        <td style="border-top:10px solid #FFF;">
                                            <table cellpadding="0" cellspacing="0" border="0" width="800" style="width:100%;">
                                                <tr>
                                                    <td valign="top" style="width:44px; vertical-align:center;">
                                                        <div style="vertical-align:center; border-left:15px solid #FFF; border-top:{THUMB_BORDER_TOP}px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">{STATUS_THUMBNAIL_QUICKGLANCE}</div>
                                                    </td>
                                                    <td valign="top" style="border-left:10px solid #FFF; vertical-align:top;">

                                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                                            <tr>
                                                                <td style="width:140px;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 18px; text-align:left;">{ENDPOINT_TYPE} ::</div></td>
                                                                <td style="text-align: left;"><div style="border-top:14px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height:22px; font-weight: bold; text-align:left;">{ENDPOINT_PATH_OR_IP+PORT}</div></td>
                                                                <td style="width:181px; text-align: right; border-right:15px solid #FFF;">{STATUS_COPY_QUICKGLANCE}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" style="border-right: 15px solid #FFF;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-top: 3px solid #A7C2E6; width:100%;"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                                                    
                                                                        {ELECTRUM_DESTINATION_PATHS_DETAIL}
                                                                        
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </td>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>';


                break;
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
{STATUS_THUMBNAIL_QUICKGLANCE}
{ENDPOINT_PATH_OR_IP+PORT}
{ENDPOINT_PATH}
{FILES_TOTALING_SIZE}
';

                break;

        }

        return $tmp_content;


    }

    private function return_electrumDataDestinationPathDetailsOutputShell($msg_format='TEXT'){

        switch($msg_format) {
            case 'HTML':

                $tmp_content = '<tr>
                                                                            <td><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 22px; text-align:left; font-weight: bold;">{ENDPOINT_FILES_MOVED_COUNT} files</div></td>
                                                                            <td style="border-left:10px solid #FFF;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 22px; text-align:left;">{ENDPOINT_FILES_MOVED_PATH}</div></td>
                                                                        </tr>';

            break;
            default:

                $tmp_content = '{ENDPOINT_FILES_MOVED_COUNT} files
{ENDPOINT_FILES_MOVED_PATH}';

            break;
        }

        return $tmp_content;
    }

    private function return_electrumDataSourceOutputShell($msg_format='TEXT'){

        switch($msg_format){
            case 'HTML':

                $tmp_content = '<tr>
                                    <td style="border-top:10px solid #FFF;">
                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                            <tr>
                                                <td valign="top" style="width:44px; vertical-align:center;">
                                                    <div style="vertical-align:center; border-left:15px solid #FFF; border-top:{THUMB_BORDER_TOP}px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:left;">{STATUS_THUMBNAIL_QUICKGLANCE}</div>
                                                </td>
                                                <td valign="top" style="border-left:10px solid #FFF; vertical-align:top;">
    
                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                                        <tr>
                                                            <td style="width:140px;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 18px; text-align:left;">{ENDPOINT_TYPE} ::</div></td>
                                                            <td style="text-align: left;"><div style="border-top:14px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height:22px; font-weight: bold; text-align:left;">{ENDPOINT_PATH_OR_IP+PORT}</div></td>
                                                            <td style="width:171px; text-align: right; border-right:15px solid #FFF;"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF;font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 23px; text-align:right;"><em>{FILES_TOTALING_SIZE}</em></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="border-right: 15px solid #FFF;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:10px; border-top: 3px solid #A7C2E6; width:100%;"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 22px; text-align:left;">{ENDPOINT_PATH}</div></td>
                                                        </tr>
                                                    </table>
    
                                                </td>
    
                                            </tr>
                                        </table>
                                    </td>
                                </tr>';


            break;
            default:

                $tmp_content = '= = = = = = = = = = = = = = = = = = = = = = = = =
{STATUS_THUMBNAIL_QUICKGLANCE}
{ENDPOINT_PATH_OR_IP+PORT}
{ENDPOINT_PATH}
{FILES_TOTALING_SIZE}
';

            break;

        }

        return $tmp_content;

    }

    public function return_quickGlanceCopy($thumb_type){

        $thumb_type = trim(strtolower($thumb_type));

        switch($thumb_type){
            case 'success':

                $tmp_copy = '<div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 23px; text-align:right; color:#169514;">Connection Successful</div>';

            break;
            default:

                $tmp_copy = '<div style="border-top:12px solid #FFF; border-bottom:10px solid #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:16px; line-height: 23px; text-align:right; color:#D22E37;">Connection Error</div>';

            break;

        }

        return $tmp_copy;

    }

    public function return_quickGlanceThumb($thumb_type){

        $thumb_type = trim(strtolower($thumb_type));

        switch($thumb_type){
            case 'success':

                $tmp_thumb = '<img src="http://v2.crnrstn.evifweb.com/common/imgs/email/success_chk.gif" width="19" height="19" alt="success" title="success">';

            break;
            default:

                $tmp_thumb = '<img src="http://v2.crnrstn.evifweb.com/common/imgs/email/err_x.gif" width="19" height="19" alt="error" title="error">';

            break;

        }

        return $tmp_thumb;

    }

    public function __destruct() {

        $this->terminate_all_ftp();

    }

}