<?php
/*
// J5
// Code is Poetry */
#
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: user_jony5_dot_com
#  VERSION :: 1.00.0000
#  DATE :: April 21, 2021 @ 1223hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: User class object for the website, www.jony5.com.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class user_jony5_dot_com {

    protected $oLogger;
    protected $oCRNRSTN_USR;

    protected $oSoapDataTransportLayer;

    public function __construct($oCRNRSTN_USR) {

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // HTML CONTENT OUTPUT MANAGEMENT
        $this->oCRNRSTN_CONTENT_MGR = new crnrstn_advanced_content_output_manager($this->oCRNRSTN_USR);

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($this->oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, $this->oCRNRSTN_USR->log_silo_profile, $this->oCRNRSTN_USR);

    }
    
    private function return_oCRNRSTN_UI_GLOBAL_SYNCSOAP($execution_serial, $batch_serial){

        $this->secret_key_override = $this->oCRNRSTN_USR->return_secret_key_override($this->oCRNRSTN_USR->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS'));
        $this->cipher_override = $this->oCRNRSTN_USR->return_cipher_override($this->oCRNRSTN_USR->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS'));
        $this->hmac_algorithm_override = $this->oCRNRSTN_USR->return_hmac_algorithm_override($this->oCRNRSTN_USR->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS'));
        $this->options_bitwise_override = $this->oCRNRSTN_USR->return_options_bitwise_override($this->oCRNRSTN_USR->get_resource('WSDL_URI', 'CRNRSTN::INTEGRATIONS'));

        $tmp_runtime = $this->oCRNRSTN_USR->wallTime();
        $tmp_microsecs_explode = explode(".", $tmp_runtime);

        $tmp_elapsedTime = $this->oCRNRSTN_USR->elapsed_delta_time_for('JONY5_GLOBAL_SYNC');

        $tmp_elapsedTime = $tmp_elapsedTime + 7000;

        $tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES = 'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES';
        $tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED = 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED';
        $tmp_CRNRSTN_SOAP_ACTION_TYPE = 'CRNRSTN_SOAP_ACTION_TYPE';
        $tmp_CRNRSTN_SOAP_SVC_USERNAME = 'CRNRSTN_SOAP_SVC_USERNAME';
        $tmp_CRNRSTN_SOAP_SVC_PASSWORD = 'CRNRSTN_SOAP_SVC_PASSWORD';

        $tmp_RESPONSE_GENERATE_EXECUTION_SERIAL = $execution_serial;
        $tmp_RESPONSE_GENERATE_BATCH_SERIAL = $batch_serial;
        $tmp_RESPONSE_GENERATE_OUTPUT_FORMAT = 'SOAP_OUTPUT';

        $tmp_ELECTRUM_ERRORS_TRACE_HTML = 'ELECTRUM_ERRORS_TRACE_HTML';
        $tmp_ELECTRUM_ERRORS_TRACE_TEXT = 'ELECTRUM_ERRORS_TRACE_TEXT';
        $tmp_ELECTRUM_START_TIME = 'ELECTRUM_START_TIME';
        $tmp_ELECTRUM_END_TIME = 'ELECTRUM_END_TIME';
        $tmp_ELECTRUM_PRETTY_RUN_TIME = $this->oCRNRSTN_USR->return_pretty_delta_time($tmp_elapsedTime, $tmp_microsecs_explode[1]);

        $tmp_ACTIVITY_STATUS_MESSAGE = 'ACTIVITY_STATUS_MESSAGE';
        $tmp_oACTIVITY_STATUS_REPORT = 'oACTIVITY_STATUS_REPORT';
        $tmp_STATUS_CODE = '420';
        $tmp_STATUS_MESSAGE = 'Enhance Your Calm';
        $tmp_ISERROR_CODE = 'ISERROR_CODE';
        $tmp_ISERROR_MESSAGE = 'ISERROR_MESSAGE';
        $tmp_SERVER_NAME_SOAP_SERVER = 'SERVER_NAME_SOAP_SERVER';
        $tmp_SERVER_ADDRESS_SOAP_SERVER = 'SERVER_ADDRESS_SOAP_SERVER';
        $tmp_SERVER_NAME_SOAP_CLIENT = $_SERVER['SERVER_NAME'];
        $tmp_SERVER_ADDRESS_SOAP_CLIENT = $_SERVER['SERVER_ADDR'];
        $tmp_DATE_RECEIVED_SOAP_REQUEST = 'DATE_RECEIVED_SOAP_REQUEST';
        $tmp_DATE_CREATED_SOAP_RESPONSE = 'DATE_CREATED_SOAP_RESPONSE';
        $tmp_SOAP_OPERATION_RUNTIME_SECONDS  = 'SOAP_OPERATION_RUNTIME_SECONDS';

        $soapRequest_ARRAY = array('oCRNRSTN_UI_GLOBAL_SYNC_REQUEST' =>
            array(
                'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => $this->oCRNRSTN_USR->param_tunnel_encrypt($this->oCRNRSTN_USR->get_resource('CRNRSTN_SOAP_SVC_AUTH_KEY', 'CRNRSTN::INTEGRATIONS'), $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_SOAP_ACTION_TYPE' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_CRNRSTN_SOAP_ACTION_TYPE, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_SOAP_SVC_USERNAME' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_CRNRSTN_SOAP_SVC_USERNAME, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'CRNRSTN_SOAP_SVC_PASSWORD' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_CRNRSTN_SOAP_SVC_PASSWORD, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_HTML' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ELECTRUM_ERRORS_TRACE_HTML, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_ERRORS_TRACE_TEXT' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ELECTRUM_ERRORS_TRACE_TEXT, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_START_TIME' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ELECTRUM_START_TIME, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_END_TIME' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ELECTRUM_END_TIME, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ELECTRUM_PRETTY_RUN_TIME' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ELECTRUM_PRETTY_RUN_TIME, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'RESPONSE_GENERATE_EXECUTION_SERIAL' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_RESPONSE_GENERATE_EXECUTION_SERIAL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'RESPONSE_GENERATE_BATCH_SERIAL' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_RESPONSE_GENERATE_BATCH_SERIAL, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'RESPONSE_GENERATE_OUTPUT_FORMAT' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_RESPONSE_GENERATE_OUTPUT_FORMAT, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ACTIVITY_STATUS_MESSAGE' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ACTIVITY_STATUS_MESSAGE, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'oACTIVITY_STATUS_REPORT' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_oACTIVITY_STATUS_REPORT, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'STATUS_CODE' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_STATUS_CODE, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'STATUS_MESSAGE' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_STATUS_MESSAGE, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ISERROR_CODE' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ISERROR_CODE, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'ISERROR_MESSAGE' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_ISERROR_MESSAGE, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SERVER_NAME_SOAP_SERVER' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_SERVER_NAME_SOAP_SERVER, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SERVER_ADDRESS_SOAP_SERVER' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_SERVER_ADDRESS_SOAP_SERVER, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SERVER_NAME_SOAP_CLIENT' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_SERVER_NAME_SOAP_CLIENT, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SERVER_ADDRESS_SOAP_CLIENT' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_SERVER_ADDRESS_SOAP_CLIENT, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override),
                'SOAP_OPERATION_RUNTIME_SECONDS' => $this->oCRNRSTN_USR->param_tunnel_encrypt($tmp_SOAP_OPERATION_RUNTIME_SECONDS, $this->cipher_override, $this->secret_key_override, $this->hmac_algorithm_override, $this->options_bitwise_override)

            ));

        return $soapRequest_ARRAY;

    }

    public function request_ui_data_sync_packet(){

        $tmp_execution_serial = $this->oCRNRSTN_USR->generate_new_key(8, '01');
        $tmp_batch_serial = $this->oCRNRSTN_USR->generate_new_key(42, '01');

        $this->oSoapDataTransportLayer = new crnrstn_decoupled_data_object($this->oCRNRSTN_USR, $tmp_execution_serial, 'SOAP_DTL_SERIAL');

        $this->oCRNRSTN_USR->print_r($tmp_execution_serial, 'oUSER :: request_ui_data_sync_packet()', NULL,  __LINE__, __METHOD__, __FILE__);

        return $this->crnrstn_soap_services_layer_sync($tmp_execution_serial, $tmp_batch_serial);

    }

    private function crnrstn_soap_services_layer_sync($execution_serial, $batch_serial){

        //
        // FLIP BITS FOR RESOURCES REQUESTED
        $tmp_bit_state_nomination = 'CRNRSTN_CLIENT_SOAP_PERMS_REQUESTED';
        $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_bit_state_nomination, CRNRSTN_RESOURCE_OPENSOURCE);
        $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_bit_state_nomination, CRNRSTN_RESOURCE_NEWS_SYNDICATION);
        $this->oCRNRSTN_USR->initialize_serialized_bit($tmp_bit_state_nomination, CRNRSTN_LOG_EMAIL);

        $this->oSoapDataTransportLayer->add((string) $this->oCRNRSTN_USR->get_resource('SOAP_ENCRYPT_CIPHER', 'CRNRSTN::INTEGRATIONS'), 'SOAP_ENCRYPT_CIPHER');
        $this->oSoapDataTransportLayer->add((string) $this->oCRNRSTN_USR->get_resource('SOAP_ENCRYPT_HMAC_ALG', 'CRNRSTN::INTEGRATIONS'), 'SOAP_ENCRYPT_HMAC_ALG');
        $this->oSoapDataTransportLayer->add((int) $this->oCRNRSTN_USR->get_resource('SOAP_ENCRYPT_OPTIONS', 'CRNRSTN::INTEGRATIONS'), 'SOAP_ENCRYPT_OPTIONS');

        $this->oCRNRSTN_USR->print_r($execution_serial, 'CLIENT REQUEST :: crnrstn_soap_services_layer_sync', NULL,  __LINE__, __METHOD__, __FILE__);

        $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('tunnelEncryptCalibrationRequest', NULL);

        //error_log(__LINE__.' $SOAP_request'. print_r(CRNRSTN_DEBUG_AGGREGATION_ON, true));
        $this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST :: oTunnelEncryptionCalibrationRequest', NULL,  __LINE__, __METHOD__, __FILE__);

        //
        // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
        $tmp_response = $this->oCRNRSTN_USR->client_send_CRNRSTN_SOAP_REQUEST('tunnelEncryptCalibrationRequest', $SOAP_request[0]);

        $this->oCRNRSTN_USR->print_r($tmp_response, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest', NULL,  __LINE__, __METHOD__, __FILE__);

        if($tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'] != 'TRUE'){

            //
            // UNABLE TO CONTINUE. ENCRYPTION IS REQUIRED. HANDLE AS ERROR.

            error_log(__LINE__.' user me - SOAP err CRNRSTN_PACKET_IS_ENCRYPTED != TRUE');
            die();

        }else{

            //
            // EXTRACT ENCRYPTED DATA FROM SERVER RESPONSE :: tunnelEncryptCalibrationRequest
            $tmp_SOAP_ENCRYPT_CIPHER = $this->oCRNRSTN_USR->get_resource('SOAP_ENCRYPT_CIPHER', 'CRNRSTN::INTEGRATIONS');
            $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
            $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oCRNRSTN_USR->get_resource('SOAP_ENCRYPT_HMAC_ALG', 'CRNRSTN::INTEGRATIONS');
            $tmp_SOAP_ENCRYPT_OPTIONS = $this->oCRNRSTN_USR->get_resource('SOAP_ENCRYPT_OPTIONS', 'CRNRSTN::INTEGRATIONS');

            $tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_STATUS_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_STATUS_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_ISERROR_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_ISERROR_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_DATE_RECEIVED_SOAP_REQUEST = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_SERVER_NAME_SOAP_SERVER = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_SERVER_ADDRESS_SOAP_SERVER = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
            //$tmp_DATE_CREATED_SOAP_RESPONSE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

            /*

            NEED TO UPDATE PARAMETER ORDER TO THE NEW BEFORE RUNNING THIS
            $this->oCRNRSTN_USR->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_SERVICES_AUTH_STATUS');
            $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_CIPHER');
            $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_HMAC_ALG');
            $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_OPTIONS');
            $this->oCRNRSTN_USR->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_CODE');
            $this->oCRNRSTN_USR->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_MESSAGE');
            $this->oCRNRSTN_USR->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_CODE');
            $this->oCRNRSTN_USR->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_MESSAGE');
            $this->oCRNRSTN_USR->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_RECEIVED_SOAP_REQUEST');
            $this->oCRNRSTN_USR->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_NAME_SOAP_SERVER');
            $this->oCRNRSTN_USR->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_ADDRESS_SOAP_SERVER');
            $this->oCRNRSTN_USR->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_CREATED_SOAP_RESPONSE');
            */

            if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                $this->oCRNRSTN_USR->print_r('user '.$tmp_SOAP_SERVICES_AUTH_STATUS, ' FOR NEXT CLIENT REQUEST :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('mayItakeTheKingsHighway', $tmp_response);
                $this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                /*
                'CRNRSTN_PACKET_IS_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_IS_ENCRYPTED',  'type' => 'xsd:string' ),
                'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array( 'name' => 'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES',  'type' => 'xsd:string' ),
                'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array( 'name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED',  'type' => 'xsd:string' ),
                'CRNRSTN_SOAP_ACTION_TYPE' => array( 'name' => 'CRNRSTN_SOAP_ACTION_TYPE',  'type' => 'xsd:string' ),
                'CRNRSTN_SOAP_SVC_AUTH_KEY' => array( 'name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY',  'type' => 'xsd:string' ),
                'USERNAME' => array( 'name' => 'USERNAME',  'type' => 'xsd:string' ),
                'PASSWORD' => array( 'name' => 'PASSWORD',  'type' => 'xsd:string' ),
                'CRNRSTN_NOTIFICATION_TYPE' => array( 'name' => 'CRNRSTN_NOTIFICATION_TYPE',  'type' => 'xsd:string' ),
                'SOAP_ENCRYPT_CIPHER' => array( 'name' => 'SOAP_ENCRYPT_CIPHER',  'type' => 'xsd:string' ),
                'SOAP_ENCRYPT_SECRET_KEY' => array( 'name' => 'SOAP_ENCRYPT_SECRET_KEY',  'type' => 'xsd:string' ),
                'SOAP_ENCRYPT_HMAC_ALG' => array( 'name' => 'SOAP_ENCRYPT_HMAC_ALG',  'type' => 'xsd:string' ),
                'SOAP_ENCRYPT_OPTIONS' => array( 'name' => 'SOAP_ENCRYPT_OPTIONS',  'type' => 'xsd:string' )
                 * */
                
                //
                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                $tmp_response = $this->oCRNRSTN_USR->client_send_CRNRSTN_SOAP_REQUEST('mayItakeTheKingsHighway', $SOAP_request[0]);

                //$this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST :: mayItakeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);
                //$this->oCRNRSTN_USR->print_r($this->returnClientRequest(), 'CLIENT REQUEST :: oKingsHighwayAuthRequest', NULL,  __LINE__, __METHOD__, __FILE__);
                $this->oCRNRSTN_USR->print_r($tmp_response, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);


               // die();
                $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'];
                if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'TRUE'){

                    //
                    // ENCRYPTION REQUIRED - DO NOT CONTINUE.

                }else{

                    $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_CIPHER');
                    $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                    $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                    $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->preach('value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY');

                    //mayItakeTheKingsHighway decrypt with [AES-192-OFB][for_a_stranger-this-Is-the_soap-encrypti0n-key][sha256][1]

                    //
                    // DECRYPT SOAP OBJECT
                    //$tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['CRNRSTN_SOAP_SVC_USERNAME'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $this->oCRNRSTN_USR->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_response['SOAP_SERVICES_AUTH_STATUS'].' ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.'] ['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$this->oSoapDataTransportLayer->soap_encrypt_secret_key.']', 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                    //error_log(__LINE__.' env param_tunnel_decrypt(1/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');
                    $tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                    //error_log(__LINE__.' env param_tunnel_decrypt(2/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');

                    $this->oCRNRSTN_USR->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);
                    //$tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_SECRET_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    //$tmp_STATUS_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_RECEIVED_SOAP_REQUEST = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_SERVER = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_SERVER = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_CREATED_SOAP_RESPONSE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_CLIENT = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_NAME_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_ADDRESS_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    /*
                     DO NOT RUN UNTIL BRINGING INPUT PARAM ORDER INTO TO NEW SEQUENCE
                    $this->oCRNRSTN_USR->print_r($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_AUTH_KEY');
                    $this->oCRNRSTN_USR->print_r($tmp_CRNRSTN_SOAP_SVC_USERNAME, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_USERNAME');
                    $this->oCRNRSTN_USR->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_SERVICES_AUTH_STATUS');
                    $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_CIPHER');
                    $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_SECRET_KEY_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_SECRET_KEY');
                    $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_HMAC_ALG');
                    $this->oCRNRSTN_USR->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_OPTIONS');
                    $this->oCRNRSTN_USR->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_CODE');
                    $this->oCRNRSTN_USR->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_MESSAGE');
                    $this->oCRNRSTN_USR->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_CODE');
                    $this->oCRNRSTN_USR->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_MESSAGE');
                    $this->oCRNRSTN_USR->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_RECEIVED_SOAP_REQUEST');
                    $this->oCRNRSTN_USR->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_SERVER');
                    $this->oCRNRSTN_USR->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_SERVER');
                    $this->oCRNRSTN_USR->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_CREATED_SOAP_RESPONSE');
                    $this->oCRNRSTN_USR->print_r($tmp_SERVER_NAME_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_CLIENT');
                    $this->oCRNRSTN_USR->print_r($tmp_SERVER_ADDRESS_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_CLIENT');
                    */

                    $this->oCRNRSTN_USR->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                    if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                        //
                        // BUILD PAYLOAD SOAP REQUEST :: takeTheKingsHighway
                        $this->oSoapDataTransportLayer->soap_encrypt_cipher = $tmp_SOAP_ENCRYPT_CIPHER_resp;
                        $this->oSoapDataTransportLayer->soap_encrypt_hmac_alg = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                        $this->oSoapDataTransportLayer->soap_encrypt_options = $tmp_SOAP_ENCRYPT_OPTIONS_resp;

                        error_log(__LINE__.' env - READY TO returnCRNRSTN_UI_GLOBAL_SYNC TO SERVER.');

                        //
                        // BUILD SOAP REQUEST OBJECT
                        $SOAP_request = $this->return_oCRNRSTN_UI_GLOBAL_SYNCSOAP($execution_serial, $batch_serial);

                        $this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST :: returnCRNRSTN_UI_GLOBAL_SYNC', NULL,  __LINE__, __METHOD__, __FILE__);

                        $tmp_response = $this->oCRNRSTN_USR->client_send_CRNRSTN_SOAP_REQUEST('returnCRNRSTN_UI_GLOBAL_SYNC', $SOAP_request);

                        $this->oCRNRSTN_USR->print_r($this->oCRNRSTN_USR->SOAP_return_client_request(), NULL, NULL, __LINE__, __METHOD__, __FILE__);

                        error_log(__LINE__.' user die soap $tmp_response='.print_r($tmp_response, true));

                        error_log(__LINE__.' env - WE JUST TOOK returnCRNRSTN_UI_GLOBAL_SYNC!');

                    }

                }


                //$this->oCRNRSTN_USR->print_r($SOAP_request, 'CLIENT REQUEST :: mayItakeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);
                //$this->oCRNRSTN_USR->print_r($this->returnClientRequest(), 'CLIENT REQUEST :: oKingsHighwayAuthRequest', NULL,  __LINE__, __METHOD__, __FILE__);
                //$this->oCRNRSTN_USR->print_r($tmp_response, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'];
                if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'TRUE'){

                    //
                    // ENCRYPTION REQUIRED - DO NOT CONTINUE.

                }else{

                    $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_CIPHER');
                    $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                    $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                    $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->preach('value', 'CRNRSTN_SOAP_SVC_ENCRYPTION_KEY');

                    //mayItakeTheKingsHighway decrypt with [AES-192-OFB][for_a_stranger-this-Is-the_soap-encrypti0n-key][sha256][1]

                    //
                    // DECRYPT SOAP OBJECT
                    //$tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_CRNRSTN_SOAP_SVC_USERNAME = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['CRNRSTN_SOAP_SVC_USERNAME'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                   // $this->oCRNRSTN_USR->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_response['SOAP_SERVICES_AUTH_STATUS'].' ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.'] ['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$this->oSoapDataTransportLayer->soap_encrypt_secret_key.']', 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                    //error_log(__LINE__.' env param_tunnel_decrypt(1/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');
                    //$tmp_SOAP_SERVICES_AUTH_STATUS = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                    //error_log(__LINE__.' env param_tunnel_decrypt(2/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');

                    //$this->oCRNRSTN_USR->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);
                    //$tmp_SOAP_ENCRYPT_CIPHER_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_SECRET_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    //$tmp_STATUS_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_RECEIVED_SOAP_REQUEST = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_SERVER = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_SERVER = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_CREATED_SOAP_RESPONSE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_CLIENT = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_NAME_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_CLIENT = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['SERVER_ADDRESS_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    //$this->oCRNRSTN_USR->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE :: returnCRNRSTN_UI_GLOBAL_SYNC', NULL, __LINE__, __METHOD__, __FILE__);


                }

            }else{


                error_log(__LINE__.' env - authorization NOT granted...');
                $tmp_STATUS_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_STATUS_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_ISERROR_CODE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_ISERROR_MESSAGE = $this->oCRNRSTN_USR->param_tunnel_decrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                $this->oCRNRSTN_USR->error_log('CRNRSTN :: SOAP Services proxy error. Error Code: '.$tmp_ISERROR_CODE.' :: Error Message: '.$tmp_ISERROR_MESSAGE.' :: Status Code: '.$tmp_STATUS_CODE.' :: Status Message: '.$tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_SOAP_SERVICES');

                die();
            }

            return $tmp_response;

        }

    }

    public function init_mobile_ui_resources(){

        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR') . '/common/css/mobi/themes/mobi_jony5com.min.css');
        $resource_str = '<!-- jquery.mobile 1.4.5 THEMEROLLER CUSTOM CSS -->
<link rel="stylesheet" href="' . $this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') .  'common/css/mobi/themes/mobi_jony5com.min.css?v=420.00.' . $tmp_cache_ver . '" >
';

        $this->add_content_resource($resource_str, JONY5_CONTENT_MOBILE_HEAD);

        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR') . '/common/css/mobi/themes/jquery.mobile.icons.min.css');
        $resource_str = '<!-- jquery.mobile 1.4.5 THEMEROLLER CUSTOM CSS -->
<link rel="stylesheet" href="' . $this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/css/mobi/themes/jquery.mobile.icons.min.css?v=420.00.' . $tmp_cache_ver . '" >
';

        $this->add_content_resource($resource_str, JONY5_CONTENT_MOBILE_HEAD);

        $this->init_mobile_inline_css();

        $this->init_mobile_search_js();

    }

    public function init_desktop_ui_resources(){


        /*
        <form action="#" method="post" id="crnrstn_sdt_frm" name="crnrstn_sdt_frm" enctype="multipart/form-data" >

            <textarea id="crnrstn_soap_data_tunnel_data" name="crnrstn_soap_data_tunnel_data"></textarea></div>
            <button type="submit">SUBMIT</button>

        </form>

        */

        //
        // CRNRSTN :: SOAP DATA TUNNEL
        $this->add_content_resource($this->oCRNRSTN_USR->soap_data_tunnel_output, JONY5_CONTENT_SOAP_DATA_TUNNEL);

        $resource_str =  '
<script>

function crnrstn_soap_data_tunnel_request(event) {
  //log.textContent = \'Form Submitted! Time stamp: ${event.timeStamp}\';
  
  alert(\'Form Submitted! Time stamp: ${event.timeStamp}\');
  event.preventDefault();
  
}

const crnrstn_soap_data_tunnel_form = document.getElementById(\'crnrstn_sdt_frm\');
//crnrstn_soap_data_tunnel_form.addEventListener(\'submit\', crnrstn_soap_data_tunnel_request);

      //var tmp_crnrstn_soap_data_tunnel_data = document.getElementById("crnrstn_soap_data_tunnel_data").innerText;     //$("#crnrstn_soap_data_tunnel_data").val();
        
      //
      // CLEAN DATA PACKET OF META FOR SUBMISSION TO CRNRSTN :: v'.$this->oCRNRSTN_USR->version_crnrstn.' SOAP SERVICES LAYER
      // FOR THE SOAP SERVICE TO BE ABLE TO SUPPORT THE DATA DRIVEN COMPONENTS 
      // ON THIS PAGE INCLUDING ELEMENTS RELATED TO:: BASSDRIVE, WETHRBUG, AND ROTATING LIFESTYLE BANNER IMAGES.
      //var tmp_crnrstn_soap_data_tunnel_data_ARRAY = tmp_crnrstn_soap_data_tunnel_data.split(\'<?xml\');      
      //var tmp_crnrstn_soap_data_clean_str = \'<\?xml\' + tmp_crnrstn_soap_data_tunnel_data_ARRAY[1];
      
      //alert(tmp_crnrstn_soap_data_clean_str);
            
      //if(tmp_crnrstn_soap_data_clean_str.length < 420){
          
      //    event.preventDefault();
          
      //}
   
</script>';

        $resource_str .= $this->oCRNRSTN_USR->SOAP_client_request_listener('alpha_testing');


        $this->add_content_resource($resource_str,JONY5_CONTENT_SOAP_DATA_TUNNEL, 'ALPHA_TESTING');

        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR') . '/common/css/main.css');
        $resource_str = '<!-- JONY5.COM CUSTOM CSS -->
<link rel="stylesheet" href="' . $this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') .  'common/css/main.css?v=420.00.' . $tmp_cache_ver . '" >
';

        $this->add_content_resource($resource_str, JONY5_CONTENT_DESKTOP_HEAD);

        $tmp_cache_ver = $this->oCRNRSTN_USR->resource_filecache_version($this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$this->oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR') . '/common/js/main.js');
        $resource_str = '<!-- JONY5.COM CUSTOM JS -->
<script src="' . $this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') .  'common/js/main.js?v=420.00.' . $tmp_cache_ver . '" ></script>
';

        $this->add_content_resource($resource_str, JONY5_CONTENT_DESKTOP_HEAD);

    }

    public function add_content_resource($str, $integer_constant, $content_silo = 'page'){

        $this->oCRNRSTN_CONTENT_MGR->add_content_resource($str, $integer_constant, $content_silo);

    }

    public function output_content($integer_constant, $content_silo = NULL){

         print_r($this->oCRNRSTN_CONTENT_MGR->return_content($integer_constant, $content_silo));

    }

    private function init_mobile_inline_css(){

        $resource_str = '
    <style>
        .ui-header .ui-title { /*margin-left: 1em;*/ margin-right: 4em; }
        a									{ text-decoration: none; font-weight: normal;}
        #hdr_dbl_hr_shell					{ width:100%;}
        #hdr_hr_top							{ width:100%; clear:both; background-color:#FC0D1B; height:10px; margin:0 0 2px 0;}
        #hdr_hr_btm							{ width:100%; clear:both; background-color:#606060; height:3px; margin:0 0 0 0;}

        .hdr_dbl_hr_shell					{ width:100%;}
        .hdr_hr_top							{ width:100%; clear:both; background-color:#000; height:10px; margin:0 0 2px 0;}
        .hdr_hr_btm							{ width:100%; clear:both; background-color:#606060; height:3px; margin:0 0 0 0;}
        .hdr_pg_ttl_hr_btm                  { width:100%; clear:both; background-color:#999; height:2px; margin:0 0 0 0;}

        .frm_errstatus						{ color:#FF0000; font-weight:bold; font-size:13px; text-align:right;}
        .req_star							{ font-weight:bold; font-size:14px; color:#F00;}
        .the_R								{ color:#F00;}
        .the_V								{ color:#F00;}

        .ui-filter-inset 					{ margin-top: 0; }
        .ui-li-aside						{ /*margin-top: 20px;*/}


        /*JQUERY*/
        @media ( min-width: 10em ) {
            /* Show the table header rows and set all cells to display: table-cell */
            .evif-asset-report td,
            .evif-asset-report th,
            .evif-asset-report tbody th,
            .evif-asset-report tbody td,
            .evif-asset-report thead td,
            .evif-asset-report thead th {
                display: table-cell;
                margin: 0;
            }
            /* Hide the labels in each cell */
            .evif-asset-report td .ui-table-cell-label,
            .evif-asset-report th .ui-table-cell-label {
                display: none;
            }
        }

        /*DASHBOARD*/
        .agg_element_hr						{border-top:solid 2px #EEE; width:100%; height:1px;}
        .agg_element_wrapper				{ }
        .icon_wrapper						{ position:relative; float:left; width:20px; height:20px; margin-top:5px;}
        .icon_img							{ position:absolute;}
        .element_detail_wrapper				{ float:left; padding-left:10px; width:88%;}
        .element_title a					{ text-decoration: none; font-weight:normal;}
        .element_date						{float: left;}
        .element_owner						{float: left; padding-left:8px;}
        .element_feeder_cnt					{ position:absolute; top:-8px; left:10px; background-color: #B50F23; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;}

        .ui-btn.cia00_submit			    { background-color:#CC3939; color:#F0F0F0; text-shadow:1px 1px 2px #C62222;}

        .main_copy_header					{ text-align: center;}
        .main_document_title				{ text-align: center;}

        #content_results_title				{ color:#333; font-size:38px; font-weight:bold;}
        .content_results_subtitle			{ font-weight:bold; color:#333; font-size:19px; margin-top:0;}
        .content_results_subtitle_divider	{ width:100%; background-color: #C3C8D6; height:2px; margin:5px 0 5px 0; border-bottom:1px dashed #7C8FC6;}


        .section_title                      { font-weight: bold; font-size:19px; padding:20px 0 0 0;}
        .tech_specs_wrapper                 { }
        .tech_specs_wrapper li              { list-style: square; line-height: 24px; font-size:17px; margin:0 0 15px 0; padding-bottom: 0;}

        .basic_section_content             { line-height: 24px; font-size:17px; margin:0 0 15px 0;}

        .method_parameter					{ font-size:17px; margin-top:15px; font-weight:normal; padding-bottom:0; margin-bottom: 0;}
        .method_parameter_definition		{ margin-left:30px; font-size:15px; padding-top: 0; margin-top: 0;}
        .parameter_require_optional			{ font-family:"Courier New", Courier, monospace; font-size:16px; font-style:italic; font-weight:normal;}
        .parameter_require_required			{ font-family:"Courier New", Courier, monospace; font-size:16px; font-style:italic; font-weight:normal; color:#FF0000;}


        iframe 								{ border: none;}

        /*CODE*/
        code                                { text-shadow: none;}
        .crnrstn_code_wrapper               { position:relative; background-color:#000; color:#DEDECB; width:98%; padding:0; margin-top:0; border:3px solid #CC9900; overflow:scroll; font-size:14px; text-shadow: none; max-width: 650px;}
        .crnrstn_code_shell                 { background-color:#000; color:#DEDECB; width:1920px; padding:10px; margin-top:0; padding-left:35px; line-height:20px; text-shadow: none;}
        .crnrstn_l_num                      { line-height:20px; position:absolute; width:25px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:10px; padding-left:4px; text-shadow: none;}

        .crnrstn_code_output_wrapper        { background-color:#FFF; width:98%; margin-top:10px; border: 3px solid #999; color:#333333; font-family: Verdana, Arial, Helvetica, sans-serif; overflow:scroll; font-size:14px; }
        .crnrstn_code_output_copy           { padding:20px; line-height: 25px; font-size:19px;}

        .crnrstn_note_wrapper               { width:98%; border:2px solid #CCC; font-size:15px; margin:20px 0 20px 0; background-color:#E6E6FF; max-width: 650px;}
        .crnrstn_note_notetitle             { float:left; width:75px; font-size:23px; padding:10px 0 0 10px; color:#45494E;}
        .crnrstn_note_notecopy              { float:left; padding:14px 10px 10px 10px; color:#45494E; line-height: 24px;}
        .crnrstn_note_crnrstn_icon          { padding:0 10px 0 0; margin-top:10px;}

        .crnrstn_page_description           { font-size:17px; padding:10px 0 0 20px; line-height: 24px; max-width: 650px;}
        .crnrstn_example_title_wrapper      { font-family: Arial, Helvetica, sans-serif; padding: 10px 0 10px 15px; max-width: 650px;}
        .crnrstn_example_title              { font-weight: bold; font-size:19px;}
        .crnrstn_example_description        { font-size:17px; padding:10px 0 0 0; line-height: 24px;}
        .crnrstn_example_output_title       { font-weight: bold; font-size:19px; line-height:24px; font-family: Arial, Helvetica, sans-serif; padding: 20px 0 10px 15px; max-width: 650px; }

        /*UTILITY*/
        .hidden								{ width:0px; height:0px; position:absolute; left:-2000px; overflow:hidden;}
        .cb 								{ display:block; clear:both; height:0px; line-height:0px; overflow:hidden; width:100%; font-size:1px;}
        .cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_60	 							{ display:block; clear:both; height:60px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_200								{ display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    </style>';

        $this->add_content_resource($resource_str, JONY5_CONTENT_MOBILE_HEAD);

    }

    private function init_mobile_search_js(){

        $resource_str = '<!-- SEARCH SUPPORT-->
    <script>
        $( document ).on( "pagecreate", "#myPage", function() {
            $( "#autocomplete" ).on( "filterablebeforefilter", function ( e, data ) {
                var $ul = $( this ),
                    $input = $( data.input ),
                    value = $input.val(),
                    html = "";
                $ul.html( "" );
                if ( value && value.length > 2 ) {
                    $ul.html( "<li><div class=\'ui-loader\'><span class=\'ui-icon ui-icon-loading\'></span></div></li>" );
                    $ul.listview( "refresh" );
                    $.ajax({

                        url: "'.$this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$this->oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'search/ajax/m/",
                        //url: "http://gd.geobytes.com/AutoCompleteCity",
                        dataType: "jsonp",
                        crossDomain: true,
                        data: {
                            q: $input.val()
                        }
                    })
                        .then( function ( response ) {
                            $.each( response, function ( i, val ) {
                                html += "<li data-filtertext=\'"+val[\'kivotossearch\']+"|"+val[\'kivotosname\'] +"\'><a href=\'" + val[\'kivotosuri\'] + "\' data-ajax=\'false\'>" + val[\'kivotosname\'] + "</a></li>";
                                //html += "<li><a>" + val + "</a></li>";
                                //html += "<li><a>" + val[\'kivotosname\'] + "</a></li>";

                            });

                            $ul.html( html );
                            $ul.listview(\'refresh\');
                            $ul.trigger( "updatelayout");
                        });
                }
            });
        });
    </script>
';

        $this->add_content_resource($resource_str, JONY5_CONTENT_MOBILE_HEAD);


    }

    public function __destruct(){

    }

}
#
# # C # U # S # T # O # M # # # : : # # ##
#
#  CLASS :: crnrstn_advanced_content_output_manager
#  VERSION :: 1.00.0000
#  DATE :: April 21, 2021 @ 1258hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION :: Store and return string content intelligently for output.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_advanced_content_output_manager {

    protected $oLogger;
    protected $oCRNRSTN_USR;

    private static $input_content_sequence_ARRAY = array();
    private static $output_content_ARRAY = array();
    private static $output_constant_serialization_ARRAY = array();
    private static $output_content_queue_ARRAY = array();

    public function __construct($oCRNRSTN_USR) {

        $this->oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($this->oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, $this->oCRNRSTN_USR->log_silo_profile, $this->oCRNRSTN_USR);

    }

    public function add_content_resource($str, $integer_constant, $content_silo){

        if($content_silo == '' || $content_silo == NULL){

            $content_silo = 'page';

        }

        //
        // THROW BIT TO INDICATE CONTENT IS SET.
        if(!$this->oCRNRSTN_USR->is_bit_set($integer_constant)){

            $this->oCRNRSTN_USR->initialize_bit($integer_constant, true);

        }

        $tmp_content_serial = $this->oCRNRSTN_USR->generate_new_key(100);

        //
        // TRACK CONTENT CREATION SEQUENCE
        self::$input_content_sequence_ARRAY[] = $tmp_content_serial;

        //
        // STORE CONTENT
        self::$output_content_ARRAY[$integer_constant][$content_silo][$tmp_content_serial][] = $str;

        //
        //$content_silo
        self::$output_constant_serialization_ARRAY[$integer_constant][] = $tmp_content_serial;

    }

    public function return_content($integer_constant = JONY5_CONTENT_ALL, $content_silo = NULL){

        $tmp_html = '';

        if($content_silo == '' || $content_silo == NULL){

            $content_silo = 'page';

        }

        if($integer_constant != JONY5_CONTENT_ALL){

            //
            // RETURN CONTENT RESULTS FOR THE PROVIDED INTEGER CONSTANT
            foreach(self::$output_constant_serialization_ARRAY[$integer_constant] as $key => $tmp_content_serial){

                if(isset(self::$output_content_ARRAY[$integer_constant][$content_silo][$tmp_content_serial])){

                    $tmp_html .= self::$output_content_ARRAY[$integer_constant][$content_silo][$tmp_content_serial][0];

                }

            }

        }else{

            //
            // RETURN ALL FOR THIS CONTENT SILO
            foreach(self::$input_content_sequence_ARRAY as $key => $tmp_content_serial){

                if(isset(self::$output_content_ARRAY[$integer_constant][$content_silo][$tmp_content_serial])){

                    $tmp_html .= self::$output_content_ARRAY[$integer_constant][$content_silo][$tmp_content_serial][0];

                }

            }

        }

        return $tmp_html;

    }

    public function __destruct(){

    }

}