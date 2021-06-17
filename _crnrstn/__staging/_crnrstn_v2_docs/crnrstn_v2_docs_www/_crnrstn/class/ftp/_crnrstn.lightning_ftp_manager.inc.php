<?php
/*
// J5
// Code is Poetry */

/*
// CLASS :: crnrstn_lightning_ftp_connection
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
// DATE :: November 10, 2018 @ 1730
// Ezekiel 1:13b - AND THE FIRE WAS BRIGHT; AND OUT OF THE FIRE WENT FORTH LIGHTENING.
*/

/*
 * # ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
 * resource ftp_ssl_connect ( string $host [, int $port = 21 [, int $timeout = 90 ]] )

$ftp_server = "172.16.195.132";
    $ftp_user_name = 'jony5';
    $ftp_user_pass = 'gY96sb21';
    $conn_id = ftp_connect($ftp_server);

    // login with username and password
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    # $login_result = ftp_ssl_connect ( string $host [, int $port = 21 [, int $timeout = 90 ]] );
    # $login_result = ftp_connect ( string $host [, int $port = 21 [, int $timeout = 90 ]] )

    // turn passive mode on
    ftp_pasv($conn_id, true);

    // get contents of the current directory
    $contents = ftp_nlist($conn_id, "../../var/www/html/");

    // output $contents
    var_dump($contents);
    ftp_close($conn_id);

    ==========

    $ftp_server = "ftp.example.com";
    $ftp_user = "foo";
    $ftp_pass = "bar";

    // set up a connection or die
    $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");

    // try to login
    if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
        echo "Connected as $ftp_user@$ftp_server\n";
    } else {
        echo "Couldn't connect as $ftp_user\n";
    }


`endpoint_config`.`FTP_TIMEOUT`,
`endpoint_config`.`FTP_IS_SSL`,
`endpoint_config`.`FTP_USE_PASV`,
`endpoint_config`.`FTP_USE_PASV_ADDR`,
`endpoint_config`.`FTP_DISABLE_AUTOSEEK`,


$oLightning_conn = new crnrstn_lightning_ftp_conn($ftp_server, $username, $password);

if(FTP_IS_SSL==1){
    $oLightning_conn->enable_ssl(true);    // CALL BEFORE connReturn()
}

$tmp_ftp_stream = $oLightning_conn->connReturn();

if(FTP_USE_PASV==1){
    $oLightning_conn->enable_passive(true); // CALL AFTER connReturn()

    if(FTP_USE_PASV_ADDR==0){
        $oLightning_conn->set_option(FTP_USEPASVADDRESS, false);     # enabled by default.
    }
}

if(FTP_DISABLE_AUTOSEEK==1){
    $oLightning_conn->set_option(FTP_AUTOSEEK, false);          # enabled by default
}
         *

 * */

class crnrstn_lightning_ftp_conn{

    private static $oLogger;

    private static $ftp_server;
    private static $ftp_username;
    private static $ftp_password;
    private static $ftp_port;
    private static $ftp_timeout;
    private static $ftp_is_ssl=false;

    private static $ftp_conn_id;
    private static $ftp_login_result;

    public function __construct($ftp_server, $username, $password, $port=21, $timeout=90){

        self::$oLogger = new crnrstn_logging();

        self::$ftp_server = $ftp_server;
        self::$ftp_username = $username;
        self::$ftp_password = $password;
        self::$ftp_port = $port;
        self::$ftp_timeout = $timeout;

    }

    public function return_ftp_stream(){


        return self::$ftp_conn_id;
    }

    public function enable_ssl($is_ssl){

        self::$ftp_is_ssl = $is_ssl;

    }

    public function enable_passive($is_passive=false){

        try{

            //
            // TURN ON PASSIVE MODE
            if(!ftp_pasv(self::$ftp_conn_id, $is_passive)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while enabling passive mode for ftp connection with '.self::$ftp_server.' at '.self::$ftp_port.'.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_lightning_ftp_conn->enable_passive()', LOG_EMERG, $e->getMessage());
            return false;

        }
    }

    public function set_option($option, $value){
        /*
         * FTP_TIMEOUT_SEC
         * FTP_AUTOSEEK
         * FTP_USEPASVADDRESS
         * */

        try{
            if(!ftp_set_option(self::$ftp_conn_id, $option, $value)){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while setting option ['.$option.'] to value ['.$value.'] for ftp connection with '.self::$ftp_server.' at '.self::$ftp_port.'.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_lightning_ftp_conn->set_option()', LOG_EMERG, $e->getMessage());
            return false;

        }
    }

    public function get_option($option){
        /*
         * FTP_TIMEOUT_SEC
         * FTP_AUTOSEEK
         * */

        return ftp_get_option(self::$ftp_conn_id, $option);
    }

    public function conn_establish(){

        //
        // ESTABLISH AND RETURN MYSQLI CONNECTION
        try{
            if(self::$ftp_is_ssl){

                self::$ftp_conn_id = ftp_ssl_connect ( self::$ftp_server, self::$ftp_port, self::$ftp_timeout);

            }else{

                self::$ftp_conn_id = ftp_connect ( self::$ftp_server, self::$ftp_port, self::$ftp_timeout);

            }

            if(!self::$ftp_conn_id){

                if(self::$ftp_is_ssl){

                    $tmp_option = ' secure ';
                }else{
                    $tmp_option = ' ';
                }

                //error_log("fireftp (207) BAD FTP CONN with ".self::$ftp_server." die().");
                //die();

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while attempting to open a'.$tmp_option.'FTP connection with '.self::$ftp_server.' at '.self::$ftp_port.'.');

            }else{

                self::$ftp_login_result = ftp_login(self::$ftp_conn_id, self::$ftp_username, self::$ftp_password);

                if(!self::$ftp_login_result){

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An error was experienced while attempting to log into an open'.$tmp_option.'FTP connection with '.self::$ftp_server.'::'.self::$ftp_username.' at '.self::$ftp_port.'.');

                }

            }

        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_lightning_ftp_conn->conn_establish()', LOG_ERR, $e->getMessage());

            //
            // RETURN FALSE
            return false;
        }

    }

    public function __destruct() {

    }

}


/*
// CLASS :: crnrstn_fire_ftp_manager
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
// DATE :: November 10, 2018 @ 1718
// Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
*/
class crnrstn_fire_ftp_manager {

    private static $oLogger;
    private static $oEnv;
    private static $oDB_RESP;

    public $transaction_status;

    private static $ftp_conn_session_id_ARRAY = array();
    private static $ftp_conn_session_timeout_ARRAY = array();

    public $endpoint_FTP_conn_ARRAY = array();

    public function __construct($oENV){
        try{

            self::$oLogger = new crnrstn_logging();
            self::$oEnv = $oENV;


        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_fire_ftp_manager->__construct()', LOG_EMERG, $e->getMessage());

        }

    }

    public function init_ftp_endpoint($endpoint_id, $oElectrum, $oDATA, $oDB_RESP){

        try{
            self::$oDB_RESP = $oDB_RESP;

            //
            // FOR THIS END POINT.
            # PERFORM GENERIC CONNECTION OPEN PROTOCOLS
            $tmp_conn_session_id = $this->retrieveConnection($endpoint_id, $oElectrum, $oDATA, $oDB_RESP);

            # IF CONNECTION ESTABLISHED, FOR SOURCE...CAN I READ ACCESS?
            if(!isset($this->endpoint_FTP_conn_ARRAY[crc32($endpoint_id)])){
                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('crnrstn_fire_ftp_manager->init_ftp_endpoint() Unable to establish FTP connection. '.$this->transaction_status);

            }else{

                // AM I SOURCE OR DESTINATION
                $tmp_is_source = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'IS_SOURCE');
                switch($tmp_is_source){
                    case '1':
                        error_log("fireftp (293) init_ftp_endpoint() init SOURCE FTP ENDPOINT.");
                        $tmp_read_permissions = false;
                        $tmp_ftp_dir_path = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'FTP_DIR_PATH');

                        //
                        // WE HAVE ESTABLISHED A VALID FTP CONN TO A SOURCE
                        // JUST VERIFY THAT YOU CAN READ.

                        /*
                         * CAN I READ FROM SPECIFIED SOURCE?
                        * IF THIS IS FTP ::
                        IF UNDER SPECIFIED LIMIT,
                        1 - INSERT INTO electrum_runtime_config WITH AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP SOURCE 123.123.122.123
                        2 - INSERT INTO log_runtime_config AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP 123.123.122.123

                         * */
                        $tmp_ftp_conn =  $this->endpoint_FTP_conn_ARRAY[crc32($endpoint_id)];

                        $endpoint_contents = ftp_nlist($tmp_ftp_conn, $tmp_ftp_dir_path);

                        if(sizeof($endpoint_contents)>0){
                            $tmp_read_permissions = true;

                        }

                        if($tmp_read_permissions){

                            return $tmp_conn_session_id;
                        }else{

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            $tmp_server = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'FTP_SERVER_IP');
                            $tmp_user = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'FTP_USERNAME');
                            throw new Exception('crnrstn_fire_ftp_manager->init_ftp_endpoint() Unable to read from FTP endpoint '.$tmp_server.'::'.$tmp_user);

                        }

                        break;
                    default:
                        //
                        // DESTINATION
                        /*
                        - n+1 DATA DESTINATION VALIDATION
                        * CAN I WRITE TO LOCAL DIR PATH is_writable()
                        * IF THIS IS FTP ::
                        HOW MANY ACTIVE PROCESSES ARE HITTING THIS SERVER? SCAN automation_runtime_config.FTP_SERVER_IP_DESTINATION WHERE ISACTIVE=1
                        IF UNDER SPECIFIED LIMIT,
                        1 - UPDATE electrum_runtime_config WITH AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP 123.123.122.123
                        2 - INSERT INTO log_runtime_config AUTOMATION_STATE=ELECTRUM IS INITIALIZING FTP DESTINATION 123.123.122.123

                        IF OVER SPECIFIED LIMIT,
                        1 - INSERT INTO log_runtime_config AUTOMATION_STATE=FTP DESTINATION CONNECTION SUPPRESSED :: 123.123.122.123
                        2 - DIE()
                         * */
                        error_log("fireftp (325) init_ftp_endpoint() init DESTINATION FTP ENDPOINT.");


                        return $tmp_conn_session_id;

                        break;


                }

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_fire_ftp_manager->init_ftp_endpoint()', LOG_EMERG, $e->getMessage());
            return false;
        }
    }

    private function too_many_connections($endpoint_id, $oElectrum, $oDATA, $oDB_RESP){

        error_log("fireftp (382) checking for too many FTP connections.");
        $oElectrum->save_data_param('ENDPOINT_ID', $endpoint_id);

        return $oDATA->processRequest('too_many_connections', $oElectrum, self::$oEnv, $oDB_RESP);

    }

    public function retrieveConnection($endpoint_id, $oElectrum, $oDATA, $oDB_RESP, $force_new=false){

        try{

            // DO WE HAVE EXISTING CONNECTION FOR THIS ENDPOINT
            if(isset($this->endpoint_FTP_conn_ARRAY[crc32($endpoint_id)]) && !$force_new){

                //
                // CONSIDER A PING FOR $oLightning_conn AS IN if($oLightning_conn->conn_ping(ftp_conn)){ Proceed...
                return $this->endpoint_FTP_conn_ARRAY[crc32($endpoint_id)];

            }else{

                //
                // CONFIRM THAT THERE ARE NOT TOO MANY FTP CONNECTIONS ALREADY
                if($this->too_many_connections($endpoint_id, $oElectrum, $oDATA, $oDB_RESP)){
                    $this->transaction_status = 'Too many active connections to this endpoint. Connection attempt suppressed.';
                    return false;
                }

                error_log("fireftp (409) HERE WE CONTINUE TO PERFORM FTP CREATION STUFF.");
                $server = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_SERVER_IP');
                $username = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_USERNAME');
                $password = self::$oEnv->paramTunnelDecrypt($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_PASSWORD'));
                $port = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_PORT');
                $timeout = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_TIMEOUT');

                error_log("fireftp (420) get new crnrstn_lightning_ftp_conn...".$server."::".$username);

                $oLightning_conn = new crnrstn_lightning_ftp_conn($server, $username, $password, $port, $timeout);

                $tmp_is_ssl = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_IS_SSL');
                if($tmp_is_ssl=='1'){
                    $oLightning_conn->enable_ssl(true);    // CALL BEFORE conn_establish()
                    error_log("fireftp (423) YEP FTP CREATION STUFF.");
                    $tmp_conn_session = $this->create_ftp_session($endpoint_id, $server, $oElectrum, $oDATA, $oDB_RESP, true);
                    self::$ftp_conn_session_id_ARRAY[] = $tmp_conn_session;
                    self::$ftp_conn_session_timeout_ARRAY[] = $timeout;
                }else{
                    error_log("fireftp (428) YEP FTP CREATION STUFF.");
                    $tmp_conn_session = $this->create_ftp_session($endpoint_id, $server, $oElectrum, $oDATA, $oDB_RESP);
                    self::$ftp_conn_session_id_ARRAY[] = $tmp_conn_session;
                    self::$ftp_conn_session_timeout_ARRAY[] = $timeout;
                }

                $oLightning_conn->conn_establish();

                $tmp_use_pasv = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_USE_PASV');
                if($tmp_use_pasv=='1'){
                    $oLightning_conn->enable_passive(true); // CALL AFTER conn_establish()

                    $tmp_use_pasv_addr = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_USE_PASV_ADDR');

                    if($tmp_use_pasv_addr=='0'){
                        $oLightning_conn->set_option(FTP_USEPASVADDRESS, false);     # enabled by default.
                    }
                }

                $tmp_disable_autoseek = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_DISABLE_AUTOSEEK');

                if($tmp_disable_autoseek=='1'){
                    $oLightning_conn->set_option(FTP_AUTOSEEK, false);          # enabled by default
                }

                $this->endpoint_FTP_conn_ARRAY[crc32($endpoint_id)] = $oLightning_conn->return_ftp_stream();


                return $tmp_conn_session;
            }

            #return self::$endpoint_FTP_conn_ARRAY[crc32($endpoint_id)];

            //
            // HOOOSTON...VE HAF PROBLEM!
            #throw new Exception('CRNRSTN mysqli connection manager error :: failed to prepDatabaseConfig() for MySQL on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->transaction_status = $e->getMessage();
            self::$oLogger->captureNotice('crnrstn_fire_ftp_manager->retrieveConnection()', LOG_ERR, $e->getMessage());

            //
            // RETURN NOTHING
            return false;
        }
    }

    public function create_ftp_session($endpoint_id, $server, $oElectrum, $oDATA, $oDB_RESP, $is_SSL=false){

        $oElectrum->save_data_param('ENDPOINT_ID', $endpoint_id);
        $oElectrum->save_data_param('SERVER', $server);
        $oElectrum->save_data_param('SSL', $is_SSL);
        $oElectrum->save_data_param('FTP_TIMEOUT', $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_TIMEOUT'));
        $oElectrum->save_data_param('FTP_DIR_PATH', $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'FTP_DIR_PATH'));

        return $oDATA->processRequest('create_ftp_session', $oElectrum, self::$oEnv, $oDB_RESP);

    }

    public function ftp_endpoint_queue_nlist(){



    }

    public function closeConnection($ftp_conn_id){
        if($ftp_conn_id){
            return ftp_close($ftp_conn_id);
        }else{
            return false;
        }
    }

    public function __destruct() {

    }

}

