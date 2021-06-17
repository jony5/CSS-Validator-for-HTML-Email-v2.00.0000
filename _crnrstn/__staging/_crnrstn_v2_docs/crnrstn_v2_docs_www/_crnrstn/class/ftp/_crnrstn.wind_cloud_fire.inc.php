<?php
/*
// J5
// Code is Poetry */

/*
// CLASS :: crnrstn_wind_cloud_fire
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
// DATE :: Nov 9, 2018 11:17AM
// EZEKIEL 1:4 - AND I LOOKED, AND THERE CAME A STORM WIND FROM THE NORTH, A GREAT CLOUD AND A FIRE
// FLASHING INCESSANTLY; AND THERE WAS A BRIGHTNESS AROUND IT, AND FROM THE MIDST OF IT
// THERE WAS SOMETHING LIKE THE SIGHT OF ELECTRUM, FROM THE MIDST OF THE FIRE.
*/

class crnrstn_wind_cloud_fire {

    private static $oLogger;
    private static $oEnv;
    private static $oData;
    private static $oFourLivingCreatures_FTP;

    private static $electrum_process_id;

    private static $db_response_serial_handle_ARRAY = array();
    public $electrum_process_ARRAY;
    private static $endpoint_container_ARRAY;
    private static $oDB_RESP;
    private static $data_param_handle = array();

    private static $conn_session_active_ARRAY = array();
    private static $terminate_endpoint_conn_ARRAY = array();
    private static $electrum_id_by_endpoint_ARRAY = array();
    private static $endpoint_connection_session_ARRAY = array();

    private static $desitnation_directory_flag = array();

    private static $electrum_final_move_ARRAY = array();
    private static $req_execute_batch_update = array();

    private static $destination_endpoint_cleanup_session_ARRAY = array();
    private static $dest_conn_cleanup_session_ARRAY = array();

    public $transaction_status;

    private static $data_move_flag_ARRAY = array();
    private static $preload_spoiled = array();

    public function __construct($oENV)
    {
        try{

            self::$oEnv = $oENV;

            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();

            //
            // INSTANTIATE DATABASE INTEGRATION
            self::$oData = new database_integration();
            #evifweb_backup.electrum_data_preload.START_ELECTRUM_PROCESS_ID
            self::$electrum_process_id = $this->generateNewKey(100);  // START_ELECTRUM_PROCESS_ID

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->__construct()', LOG_EMERG, $e->getMessage());
        }

    }

    public function initialize($config_data=NULL){

        try{

            error_log("crnrstn_wind_cloud_fire (60) initialize.");

            //
            // RETRIEVE ELIGIBLE ELECTRUM
            $tmp_serial_handle = 'ELECTRUM_CONFIG';
            $tmp_output_ARRAY = $this->return_eligible_electrum($tmp_serial_handle);

            $this->electrum_process_ARRAY = $tmp_output_ARRAY[0];
            self::$endpoint_container_ARRAY = $tmp_output_ARRAY[1];
            self::$oDB_RESP = $tmp_output_ARRAY[2];

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->initialize()', LOG_EMERG, $e->getMessage());

        }

        /*
         *
        ## INITIALIZATION STAGE ##

        1) - CHECK FOR ELIGIBLE ELECTRUM AND STORE
        - ISACTIVE = 1
        - DATA SOURCE SPECIFIED  (AT LEAST 1)
        - DATA DESTINATION SPECIFIED (AT LEAST 1)
        - FREQUENCY STATE AND LAST RUN TIME DO NOT EXCLUDE ELECTRUM OPERATION

        # NOW WE HAVE LIST OF BASICALLY ELIGIBLE ELECTRUM

        ** WE NEED TO LIMIT # OF CONNECTIONS TO FTP TO SPECIFIED VALUE **

        2) - FURTHER ELECTRUM VALIDATION FOR INITIALIZATION
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

        # WE NOW HAVE LIST OF ELIGIBLE AND VERIFIED ELECTRUM + OPEN FTP CONNECTIONS FOR ALL SOURCE AND DESTINATION
        # IF WE REALLY END UP HAVING TO DO FTP TO FTP...MIGHT HAVE TO HANDLE DIFFERENTLY. PATH TO FILE PROB CANNOT BE FTP_GET() METHOD
        # SO WE ESTABLISH ALL FTP CONNECTIONS AT INIT BUT PROCESS ONE SOURCE AT A TIME. WHAT IF EACH SOURCE IS SAME FTP...WE WOULD BE HOLDING DOWN FTP CONN TO SOURCE #2 BUT NOT TOUCHING IT UNTIL DONE WITH SOURCE #1. THIS IS OUTSIDE IMMEDIATE SCOPE OF USE...BUT ONLY MAKES SENSE TO HANDLE IF WE EXPECT THIS TOOL TO HAVE VIABILITY BEYOND CURRENT SCENARIO.

        # PROCESS DESTINATION ONE AT A TIME. AS IN.. S1->D1, S2->D1, S(n)->D1...THEN S1->D2, S2->D2, S(n)->D2

        ## DATA ANALYSIS AND PRELOAD STAGE ##

        3) - FOR ELECTRUM[n]
        - READ DATA SOURCE[n+1] TOP LEVEL CONTENTS [FILE AND DIRECTORY]
        - STORE (IN MEMORY) DATA SOURCE[n+1] TOP LEVEL CONTENTS [FILE AND DIRECTORY] WITH ID FOR EACH ITEM
        * WE WILL LOOP THROUGH EACH ITEM INDIVIDUALLY AND PROCESS TO COMPLETION BEFORE MOVING TO THE NEXT ITEM

        # # # # # # DATA ANALYSIS AND PRELOAD STAGE ^

        # # # # # # INITIALIZATION STAGE ^
         * */

    }

    private function electrum_preload_success($electrum_id){
        try{

            $this->save_data_param('ELECTRUM_ID', $electrum_id);
            $tmp_result = self::$oData->processRequest('electrum_preload_success', $this, self::$oEnv, self::$oDB_RESP);

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->electrum_preload_success()', LOG_EMERG, $e->getMessage());

        }

    }

    private function electrum_execute_success($electrum_id){
        try{

            $this->save_data_param('ELECTRUM_ID', $electrum_id);
            $tmp_result = self::$oData->processRequest('electrum_execute_success', $this, self::$oEnv, self::$oDB_RESP);

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->electrum_execute_success()', LOG_EMERG, $e->getMessage());

        }

    }

    public function preload($electrum_id){

        try{

            /*
             self::$endpoint_container_ARRAY = $tmp_output_ARRAY[1];
             self::$oDB_RESP
            */

            $tmp_success = true;
            $tmp_has_source = false;

            //
            // PRELOAD DATASOURCE
            #$tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][0] = 'SOURCE';
            #$tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][1] = #'TRANSMISSION_TYPE');
            foreach(self::$endpoint_container_ARRAY[$electrum_id] AS $endpoint_id => $endpoint_detail_array){
                switch($endpoint_detail_array[0]){
                    case 'SOURCE':
                        $tmp_has_source = true;

                        switch($endpoint_detail_array[1]){
                            case 'FTP':

                                //
                                // BY THIS POINT, CONNECTION IS APPROVED AND HOT
                                if(!$this->preload_FTP_source($endpoint_id)){
                                    $tmp_success = false;

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('Failure experienced during preload of FTP data source ['.$endpoint_id.'].');

                                }
                                break;
                            case 'LOCAL_DIR':
                                if(!$this->preload_LOCAL_DIR_source($endpoint_id)){
                                    $tmp_success = false;
                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('Failure experienced during preload of LOCAL_DIR data source ['.$endpoint_id.'].');


                                }
                                break;
                            default:
                                $tmp_success = false;
                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unable to determine source endpoint detail during preload() for data source ['.$endpoint_id.'].');

                                break;

                        }

                        break;

                }
            }

            if($tmp_success && $tmp_has_source){

                //
                // UPDATE STATUS OF ELECTRUM TO SHOW LASTRUN...AS INDICATION OF SUCCESSFUL PRELOAD
                $this->electrum_preload_success($electrum_id);

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->preload()', LOG_EMERG, $e->getMessage());

        }
    }

    public function ready_for_preload($electrum_id){

        if(self::$preload_spoiled[$electrum_id]!=""){

            return false;
        }else{

            return true;
        }

    }

    public function preload_clear(){

        //
        // EXECUTION SHOULD BE INTERRUPTABLE.
        // ALSO WHAT WE DO HERE IS WHAT WE DO FOR CLEANUP WHEN ELECTRUM BEGINS AND BEFORE NEW PROCESSES ARE STARTED

        # - WE SHOULD ESTABLISH A BATCH SIZE FOR PRELOAD DATA PROCESSING. EACH SCRIPT WILL WORK IN CHUCKS.
        # - SHOULD BE SOMETHING LIKE THIS MAYBE...
        $tmp_electrum_ARRAY = $this->electrum_process_ARRAY;        // THIS ARRAY WILL NOT HAVE ACTIVE YET INCOMPLETE ELECTRUM DATA DUE TO LASTRUN BEING UPDATED.

        foreach($tmp_electrum_ARRAY as $key0 => $electrum_id){

            $tmp_preload_spoiled = false;
            $tmp_term_sessions = array();

            while (is_object($this->grab_preload_batch($electrum_id))) {

                //
                // IF WE DO ANY WORK HERE, DO NOT PRELOAD ANY DATA LATER.
                $tmp_preload_spoiled = true;
                $tmp_term_sessions[$electrum_id] = 1;

                //
                // PROCESS DATA BATCH
                $this->process_batch();

            }

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

            $this->electrum_cleanup_success($electrum_id);

            if($tmp_preload_spoiled) {

                //
                // FOR SKIPPING PRELOAD
                self::$preload_spoiled[$electrum_id] = 1;

                $this->terminate_electrum_sessions($electrum_id);

                //
                // THE DESTRUCTOR WILL CLOSE THE ACTUAL FTP CONNECTIONS
                #foreach ($tmp_term_session AS $key => $value) {
                #    error_log("crnrstn_wind_cloud_fire (327) PRELOAD CLEAN UP FOUND SOMETHING...THEN FINISHED. terminate_electrum_sessions($key)");
                #    $this->terminate_electrum_sessions($key);

                #}
            }
        }
    }

    private function electrum_cleanup_success($electrum_id){
        try{

            $this->save_data_param('ELECTRUM_ID', $electrum_id);
            $tmp_result = self::$oData->processRequest('electrum_cleanup_success', $this, self::$oEnv, self::$oDB_RESP);

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->electrum_cleanup_success()', LOG_EMERG, $e->getMessage());

        }

    }

    public function execute($electrum_id){

        try{
            //
            // PROCESS ELECTRUM
            error_log('crnrstn_wind_cloud_fire->execute() (288) EXECUTE ELECTRUM ['.$electrum_id.'] NOW...');

            //
            // EXECUTION SHOULD BE INTERRUPTABLE.
            // ALSO WHAT WE DO HERE IS WHAT WE DO FOR CLEANUP WHEN ELECTRUM BEGINS AND BEFORE NEW PROCESSES ARE STARTED

            # - WE SHOULD ESTABLISH A BATCH SIZE FOR PRELOAD DATA PROCESSING. EACH SCRIPT WILL WORK IN CHUCKS.
            # - SHOULD BE SOMETHING LIKE THIS MAYBE...


            while (is_object($this->grab_preload_batch($electrum_id))) {     # SELECT FROM

                //
                // PROCESS DATA BATCH
                $this->process_batch();

            }

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

            // TERMINATION INDICATES NO MORE PRELOAD DATA FOR THIS ELECTRUM. IF ANOTHER PROCESS IS HANDLING PRELOAD AND THAT PROCESS FINISHES BEFORE
            // THE BOW-OF-THE-SHIP PROCESS CAN FINISH ITS LAST BATCH AND DISCOVER FOR ITSELF THAT THERE IS NO MORE PRELOAD...AND MARK AS COMPLETE THE CURRENT ELECTRUM
            // ANOTHER PROCESS IS LIABLE TO RESTART THE ENTIRE ELECTRUM PRELOAD SITUATION ON THE ELECRTUM EVERYONE IS CURRENTLY PROCESSING...AS IT WILL BE
            // RETURNED BY THE DATABASE AS A VALID ELECTRUM. WE NEED A WAY TO RETURN ELECTRUM TO THE CLEANER ONLY WHEN IT TRULY IS IN NEED OF PROCESSING.
            //error_log("crnrstn_wind_cloud_fire (323) WE NEED A WAY TO RETURN ELECTRUM TO THE CLEANER ONLY WHEN IT TRULY IS IN NEED OF PROCESSING. die");

            //die();
            $this->terminate_electrum_sessions($electrum_id);

            //
            // UPDATE THIS ELECTRUM AS COMPLETE
            $this->electrum_execute_success($electrum_id);

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->execute()', LOG_EMERG, $e->getMessage());

        }

    }

    private function verify_shell_data_manip($electrum_id){

        # ISACTIVE=7
        # ELECTRUM_ID=$electrum_id
        # STATUS = READY FOR FINAL TRANSFER

        # VERIFY ALL FILES
        # UPDATE STATUS OF PRELOAD DATA WITH DESTINATION FILE SIZES, SUCCESS STATUS MESSAGE, ENDTIME, ETC...

    }

    private function terminate_ftp(){

        //
        // FTP - CLOSE
        $tmp_loop_size = sizeof(self::$terminate_endpoint_conn_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){

            $oFTP_stream_resource = self::$oFourLivingCreatures_FTP->endpoint_FTP_conn_ARRAY[crc32(self::$terminate_endpoint_conn_ARRAY[$i])];

            error_log("crnrstn_wind_cloud_fire (256) ftp_close on [".self::$terminate_endpoint_conn_ARRAY[$i]."]");

            if(isset($oFTP_stream_resource)) {
                ftp_close($oFTP_stream_resource);
            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oFTP_stream_resource is not set.');

            }

        }

    }

    private function process_batch(){

        $tmp_start_time_ARRAY = array();

        $tmp_loop_size = self::$oDB_RESP->return_sizeof(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key),'PRELOAD_DATA');
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // MOVE DATA
            $data_move_result_ARRAY = $this->process_batch_element($i);

        }

        //
        // PROCESS BATCH STATUS
        if(isset(self::$req_execute_batch_update)){
            if(is_array(self::$req_execute_batch_update)){
                if(sizeof(self::$req_execute_batch_update)>0){
                    foreach(self::$req_execute_batch_update AS $key => $value){
                        switch($key){
                            case 'UPDATE_DATA_TRANSFER_STATUS_COMPLETE':
                                self::$oData->process_request(self::$oEnv, $key);
                                break;
                            case 'UPDATE_DATA_TRANSFER_QUEUED_FOR_SHELL':
                                self::$oData->process_request(self::$oEnv, $key);
                                break;

                        }
                    }
                }
            }
        }
    }

    private function process_batch_element($pos){

        #$pos = data position in current batch
        //
        // FOR EACH RETURNED PRELOAD ELEMENT
        $preload_id = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'PRELOAD_ID', $pos);
        $electrum_id = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'ELECTRUM_ID', $pos);
        $endpoint_source_id = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'DSOURCE_ID', $pos);
        #$source_conn_session = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'START_ELECTRUM_PROCESS_ID', $pos);
        $source_file_path = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'RESOURCE_ENDPOINT', $pos);
        $source_root_path = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'RESOURCE_ROOT', $pos);
        $timestamp_nom = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.self::$oDB_RESP->recur_key), 'PRELOAD_DATA', 'TIMESTAMP_NOM', $pos);

        $tmp_result_ARRAY = array();
        $tmp_destination_endpoint_session_ARRAY = array();
        $tmp_destination_endpoint_path_ARRAY = array();
        #$tmp_start_time_ARRAY[] = date("Y-m-d H:i:s", time());

        //
        // ENDPOINT SOURCE TYPE
        $tmp_data_source_type = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_source_id, 'TRANSMISSION_TYPE');
        //error_log("crnrstn_wind_cloud_fire (298) source type = ".$tmp_data_source_type);

        //
        // LOAD ELECTRUM DESTINATION ENDPOINTS ELECTRUM_ENDPOINT
        $tmp_loop_size = self::$oDB_RESP->retrieveCountByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ELECTRUM_ENDPOINT', $electrum_id, 'ELECTRUM_ID');
        for($i=0;$i<$tmp_loop_size;$i++){
            $tmp_endpoint_destination_id = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ELECTRUM_ENDPOINT', $electrum_id, 'ENDPOINT_ID', $i);

            $tmp_is_source = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $tmp_endpoint_destination_id, 'IS_SOURCE');
            $tmp_type = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $tmp_endpoint_destination_id, 'TRANSMISSION_TYPE');

            if($tmp_is_source=="0") {

                //error_log("crnrstn_wind_cloud_fire (308) retrieveDataByID BATCH_LOOP_COMM_HANDLES".self::$oDB_RESP->recur_key);
                $tmp_dest_conn_size = self::$oDB_RESP->retrieveCountByID(self::$oDB_RESP->return_serial('BATCH_LOOP_COMM_HANDLES'.self::$oDB_RESP->recur_key), 'COMM_HANDLES'.self::$oDB_RESP->recur_key, $tmp_endpoint_destination_id, 'ENDPOINT_ID');
                for($ii=0;$ii<$tmp_dest_conn_size;$ii++){
                    $tmp_dest_conn_session = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('BATCH_LOOP_COMM_HANDLES'.self::$oDB_RESP->recur_key), 'COMM_HANDLES'.self::$oDB_RESP->recur_key, $tmp_endpoint_destination_id, 'SESSION_ID', $ii);

                    $tmp_dest_ftp_path = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('BATCH_LOOP_COMM_HANDLES'.self::$oDB_RESP->recur_key), 'COMM_HANDLES'.self::$oDB_RESP->recur_key, $tmp_endpoint_destination_id, 'FTP_DIR_PATH', $ii);
                    $tmp_dest_path = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('BATCH_LOOP_COMM_HANDLES'.self::$oDB_RESP->recur_key), 'COMM_HANDLES'.self::$oDB_RESP->recur_key, $tmp_endpoint_destination_id, 'LOCAL_DIR_PATH', $ii);

                    if($tmp_dest_ftp_path==""){
                        $tmp_path = $tmp_dest_path;

                    }else{
                        $tmp_path = $tmp_dest_ftp_path;
                    }

                    //error_log("crnrstn_wind_cloud_fire (314) DEST CONN[".$ii." of ".$tmp_dest_conn_size."] SESSION ID=".$tmp_dest_conn_session);

                    if(isset(self::$conn_session_active_ARRAY[$electrum_id][$tmp_dest_conn_session])){

                        //
                        // THIS IS A DESTINATION ENDPOINT WE CAN ACCESS DUE TO WE ALREADY OWN THE CONNECTION
                        $tmp_destination_endpoint_session_ARRAY[] = $tmp_dest_conn_session;
                        $tmp_destination_endpoint_path_ARRAY[] = $tmp_dest_path;
                        error_log("crnrstn_wind_cloud_fire (544) QUEUE UP CONNECTION WE HAVE ACCESS TO [".$tmp_dest_conn_session."][".sizeof($tmp_destination_endpoint_session_ARRAY)."].");
                    }else{

                        //
                        // THIS IS A DESTINATION ENDPOINT TO WHICH WE HAVE NO ESTABLISHED CONNECTION. MAKE ONE OR DIE.
                        error_log("crnrstn_wind_cloud_fire (549) A CONNECTION SESSION WE DO NOT HAVE 'ACCESS' TO...");
                        #if(!isset(self::$destination_endpoint_cleanup_session_ARRAY[$electrum_id][self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id]])){
                        if(!isset(self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id])){
                            switch($tmp_type){
                                case 'FTP':
                                    self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id] = $this->validate_FTP_Endpoint($tmp_endpoint_destination_id, self::$oDB_RESP);
                                    $tmp_conn_session_id = self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id];

                                    if(!isset(self::$conn_session_active_ARRAY[$electrum_id][$tmp_conn_session_id])){
                                        self::$conn_session_active_ARRAY[$electrum_id][$tmp_conn_session_id] = 1;
                                    }

                                    //
                                    // FOR FLAGGING ENDPOINT TO CALL FTP_CLOSE AGAINST
                                    $tmp_is_FTP[$tmp_endpoint_destination_id] = 1;

                                    if($tmp_conn_session_id){

                                        $tmp_isvalid_electrum_ARRAY[$electrum_id][$tmp_endpoint_destination_id] = true;
                                        error_log("crnrstn_wind_cloud_fire (568) Mark this FTP endpoint as VALID. ".$tmp_endpoint_destination_id);
                                    }else{
                                        $tmp_isvalid_electrum_ARRAY[$electrum_id][$tmp_endpoint_destination_id] = false;
                                        error_log("crnrstn_wind_cloud_fire (571) Mark this FTP endpoint as INVALID. ".$tmp_endpoint_destination_id);
                                    }

                                break;
                                case 'LOCAL_DIR':
                                    if($this->validate_LOCAL_DIR_Endpoint($tmp_endpoint_destination_id, self::$oDB_RESP)){

                                        self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id] = $this->create_local_dir_session($tmp_endpoint_destination_id, self::$oDB_RESP);

                                        $tmp_conn_session_id = self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id];

                                        if(!isset(self::$conn_session_active_ARRAY[$electrum_id][$tmp_conn_session_id])){
                                            self::$conn_session_active_ARRAY[$electrum_id][$tmp_conn_session_id] = 1;
                                        }

                                        $tmp_isvalid_electrum_ARRAY[$electrum_id][$tmp_endpoint_destination_id] = true;
                                        error_log("crnrstn_wind_cloud_fire (587) Mark this DIR endpoint as VALID. ".$tmp_endpoint_destination_id);
                                    }else{
                                        error_log("crnrstn_wind_cloud_fire (589) Mark this DIR endpoint as INVALID. ".$tmp_endpoint_destination_id);
                                        $tmp_isvalid_electrum_ARRAY[$electrum_id][$tmp_endpoint_destination_id] = false;
                                    }

                                    break;
                                default:

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    throw new Exception('We do not know the endpoint type.');

                                    break;
                            }

                        }

                        #private static $destination_endpoint_cleanup_path_ARRAY

                        $tmp_destination_endpoint_session_ARRAY[] = self::$dest_conn_cleanup_session_ARRAY[$electrum_id][$tmp_endpoint_destination_id];
                        $tmp_destination_endpoint_path_ARRAY[] = $tmp_path;

                    }

                }

                //error_log("crnrstn_wind_cloud_fire (320) DEST CONN SESSION SIZE=".$tmp_dest_conn_size);

                #$tmp_dest_move_size = sizeof($tmp_destination_endpoint_session_ARRAY);
                $tmp_dest_move_size = 1;
                //if($tmp_dest_move_size>1){

                //     echo "<br>J5 :: Moving ".$tmp_dest_move_size." tmp_destination_endpoint_session_ARRAY items...";
                //}

                for($ii=0;$ii<$tmp_dest_move_size;$ii++) {
                    switch ($tmp_type) {
                        case 'FTP':
                            //
                            // MOVE DATA TO THIS FTP
                            if ($tmp_data_source_type == "FTP") {
                                //
                                // MOVE DATA FROM FTP TO FTP
                                error_log("crnrstn_wind_cloud_fire (314) move_data() FTP TO FTP");

                                $this->data_transfer('FF', $preload_id, $electrum_id, $timestamp_nom, $endpoint_source_id, $tmp_endpoint_destination_id, $source_file_path, $tmp_path, $source_root_path);

                            } else {
                                if ($tmp_data_source_type == "LOCAL_DIR") {
                                    //
                                    // MOVE DATA FROM LOCAL_DIR TO FTP
                                    error_log("crnrstn_wind_cloud_fire (320) move_data() LOCAL_DIR TO FTP");
                                    $this->data_transfer('DF', $preload_id, $electrum_id, $timestamp_nom, $endpoint_source_id, $tmp_endpoint_destination_id, $source_file_path, $tmp_path, $source_root_path);

                                }

                            }

                            break;
                        case 'LOCAL_DIR':
                            //
                            // MOVE DATA TO THIS LOCAL_DIR
                            if ($tmp_data_source_type == "FTP") {
                                //
                                // MOVE DATA FROM FTP TO LOCAL_DIR
                                error_log("crnrstn_wind_cloud_fire (332) move_data() FTP TO LOCAL_DIR");
                                $this->data_transfer('FD', $preload_id, $electrum_id, $timestamp_nom, $endpoint_source_id, $tmp_endpoint_destination_id, $source_file_path, $tmp_path, $source_root_path);

                            } else {
                                if ($tmp_data_source_type == "LOCAL_DIR") {
                                    //
                                    // MOVE DATA FROM LOCAL_DIR TO LOCAL_DIR
                                    error_log("crnrstn_wind_cloud_fire (337) move_data() LOCAL_DIR TO LOCAL_DIR");
                                    $this->data_transfer('DD', $preload_id, $electrum_id, $timestamp_nom, $endpoint_source_id, $tmp_endpoint_destination_id, $source_file_path, $tmp_path, $source_root_path);

                                }

                            }

                            break;
                    }
                }
            }
        }

        return $tmp_result_ARRAY;

    }

    private function data_transfer($mode, $preload_id, $electrum_id, $timestamp_nom, $endpoint_source_id, $endpoint_destination_id, $source_file_path, $dest_dir_path, $source_root_path){

        switch($mode){
            case 'FF':

                error_log("crnrstn_wind_cloud_fire (679) transfer FF");

                //
                // TMP FOR FILE TRANSFER
                $tmp_hash = $this->generateNewKey(10);
                $tmp_filename = basename($source_file_path);
                $local_file = '/mnt/hgfs/jony5/_data_automate/eVifweb/_tmp_FTP_transfer/'.$tmp_hash.'_'.$tmp_filename;

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

                $ts = date("Y-m-d H:i:s", time());
                $field_names_pipe = "PRELOAD_ID|ELECTRUM_ID|DSOURCE_ID|FILE_SIZE_DESTINATION|ENDTIME|STATUS|FINISH_ELECTRUM_PROCESS_ID";
                $field_values_pipe = $preload_id."|$electrum_id|$endpoint_source_id|$tmp_res|$ts|TRANSFER COMPLETE|".self::$electrum_process_id;
                self::$oData->queue_request($this, $handle, $field_names_pipe, $field_values_pipe);
                //echo "<br>queue_request $field_values_pipe";

                //
                // DELETE TMP FILE
                if(file_exists($local_file)){

                    //
                    // REMOVE FILE
                    unlink($local_file);
                }

                break;
            case 'DF':
                //error_log("crnrstn_wind_cloud_fire (507) transfer DF");

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


            break;
            case 'FD':
                //error_log("crnrstn_wind_cloud_fire (554) transfer FD");

                $tmp_filename = basename($source_file_path);

                //$local_file = '/var/www/html/_tmp_transfer/tmp'.$tmp_hash.'_'.$tmp_filename;

                //$mode = "777";
                //$mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
                //$mode = (int)$mode;

                #$src = "/var/www/html/backup_automate/";
                #$dest = "home/jony5/Desktop/nfs/localmac/jony5/Desktop/desktop/_backup/test/";

                #copy($src, $dest);
                #shell_exec("cp -r $src $dest");

                #shell_exec("mkdir -p  $dest");

                #if(!mkdir($tmp_trimmed_file_path, $mode, true)){
                $tmp_trimmed_file_path = str_replace($source_root_path, "", $source_file_path);  # common/js/lib/jquery_mobi/images/icons-png/heart-white.png
                $tmp_trimmed_file_path = str_replace($tmp_filename, "", $tmp_trimmed_file_path);
                //echo "<br>Try to make /var/www/html/_tmp_transfer/tmp$tmp_trimmed_file_path";
                if(!is_dir("/var/www/html/_tmp_transfer/tmp/".$timestamp_nom.$tmp_trimmed_file_path)){
                    if(!$this->mkdir_r("/var/www/html/_tmp_transfer/tmp/".$timestamp_nom.$tmp_trimmed_file_path)){
                        $error = error_get_last();
                        echo "<br><br>".$error['message'];

                        echo "<br>Error :: making directory[".$tmp_trimmed_file_path."] source_root_path[".$source_root_path."] source_file_path[".$source_file_path."]";
                    }else{

                        //echo "<br>Made :: ".$tmp_trimmed_file_path;
                    }
                }else{

                    //echo "<br>Energy saved not having to make DIR.";
                }

                $tmp_dest = "/var/www/html/_tmp_transfer/tmp/".$timestamp_nom.$tmp_trimmed_file_path;
                $tmp_dest = rtrim($tmp_dest, '/') . '/';
                $tmp_dest = $tmp_dest.$tmp_filename;

                $dest_dir_path = rtrim($dest_dir_path, '/') . '/';

                $tmp_trimmed_file_path = str_replace($source_root_path, "", $source_file_path);  # common/js/lib/jquery_mobi/images/icons-png/heart-white.png
                $tmp_trimmed_file_path = str_replace($tmp_filename, "", $tmp_trimmed_file_path);
                $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');
                $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';    # var/www/html/evifweb/common/jquery_mobi/themes/images/icons-png/
                #$destination_file = $dest_dir_path.$tmp_trimmed_file_path.$tmp_filename;   # /mnt/hgfs/jony5/Desktop/desktop/_backup/

                // PULL FROM SOURCE FTP - PUT TO DESTINATION DIR_LOCAL
                $oFTP_stream_res_SOURCE = self::$oFourLivingCreatures_FTP->endpoint_FTP_conn_ARRAY[crc32($endpoint_source_id)];
                error_log("ftp_get() $tmp_dest <--> $source_file_path");
                #if (ftp_get($oFTP_stream_res_SOURCE, $local_file, $source_file_path, FTP_BINARY)) {
                if (ftp_get($oFTP_stream_res_SOURCE, $tmp_dest, $source_file_path, FTP_BINARY)) {
                    //echo "<br>FD - Successfully written[".$source_file_path."] to ".$tmp_dest;

                } else {
                    echo "<br>Error :: FD - There was a problem writing ".$source_file_path." to ".$tmp_dest;
                }

                //
                // NOW MOVE DATA TO FINAL DESTINATION
                #shell_exec("cp -r /var/www/html/_tmp_transfer/tmp $dest_dir_path"."$tmp_trimmed_file_path");
                #shell_exec("cp -r /var/www/html/_tmp_transfer/tmp$tmp_trimmed_file_path $destination_file");

                //
                // FTP TO LOCAL_DIR TRANSFER HAS AN INEFFECIENCY ASSOCIATED WITH BEING FORCED TO PROCESS FTP ONE FILE AT A TIME.
                // THE MOVE TO FINAL DESTINATION SHOULD BE DONE IN ONE CYCLE AND THEN VERIFICATION SHOULD FOLLOW.

                if(!isset(self::$electrum_final_move_ARRAY[crc32($electrum_id)][crc32($endpoint_destination_id)])){

                    //self::$electrum_final_move_ARRAY[crc32($electrum_id)][crc32($endpoint_destination_id)][] = "mv /var/www/html/_tmp_transfer/tmp/ /var/www/html/_tmp_transfer/$timestamp"."_".$tmp_hash."/";
                    self::$electrum_final_move_ARRAY[crc32($electrum_id)][crc32($endpoint_destination_id)][] = "cp -r /var/www/html/_tmp_transfer/".$timestamp_nom."/ $dest_dir_path";
                    self::$electrum_final_move_ARRAY[crc32($electrum_id)][crc32($endpoint_destination_id)][] = "rm -r /var/www/html/_tmp_transfer/".$timestamp_nom."/";

                }

                ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_COMPLETE
                $handle = 'UPDATE_DATA_TRANSFER_QUEUED_FOR_SHELL';
                if(!isset(self::$req_execute_batch_update[$handle])){
                    self::$req_execute_batch_update[$handle] = 1;
                }

                $field_names_pipe = "PRELOAD_ID|ELECTRUM_ID|DSOURCE_ID|STATUS";
                $field_values_pipe = $preload_id."|$electrum_id|$endpoint_source_id|READY FOR FINAL TRANSFER";
                //echo "<br>queue_request $field_values_pipe";
                self::$oData->queue_request($this, $handle, $field_names_pipe, $field_values_pipe);


                /*
                 *
                 * # THIS WORKS BUT IS SUPER INEFFICIENT. DO THIS FROM HIGHER GROUND.

                $tmp_trimmed_file_path_ARRAY = explode('/', $tmp_trimmed_file_path);
                #$tmp_dest_trimmed = str_replace($source_root_path, "", $source_file_path);

                #shell_exec("cp -r /var/www/html/_tmp_transfer/tmp/$tmp_trimmed_file_path_ARRAY[0] $destination_file");
                if($tmp_trimmed_file_path_ARRAY[0]==""){
                    shell_exec("cp /var/www/html/_tmp_transfer/tmp/$tmp_filename $dest_dir_path");
                }else{
                    shell_exec("cp -r /var/www/html/_tmp_transfer/tmp/$tmp_trimmed_file_path_ARRAY[0] $dest_dir_path");
                }

                $error = error_get_last();
                echo "<br>".$error['message'];

                echo "<br>Did I copy /var/www/html/_tmp_transfer/tmp/$tmp_trimmed_file_path_ARRAY[0] to ".$dest_dir_path;

                $tmp_res = filesize($destination_file);

                if ($tmp_res != -1) {
                    echo "<br><br>size of $destination_file is $tmp_res bytes";
                } else {
                    echo "<br>Couldn't get the size of $destination_file (Not all servers support this feature).";
                }

                ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_COMPLETE
                $handle = 'UPDATE_DATA_TRANSFER_STATUS_COMPLETE';

                $ts = date("Y-m-d H:i:s", time());
                $field_names_pipe = "PRELOAD_ID|ELECTRUM_ID|DSOURCE_ID|FILE_SIZE_DESTINATION|ENDTIME|STATUS|FINISH_ELECTRUM_PROCESS_ID";
                $field_values_pipe = $preload_id."|$electrum_id|$endpoint_source_id|$tmp_res|$ts|TRANSFER COMPLETE|$dest_conn_session";
                self::$oData->queue_request($this, $handle, $field_names_pipe, $field_values_pipe);

                # /home/jony5/Desktop/nfs/localmac/jony5/Desktop/desktop/_backup/
                # /mnt/hgfs/jony5/Desktop/desktop/_backup/

                //
                // DELETE TMP
                if(file_exists($tmp_dest)){

                    //
                    // REMOVE FILE
                    unlink($tmp_dest);
                }


                //
                // STOP AFTER 2 MIN
                if(self::$oEnv->wallTime()>130){

                    echo "<br><br>TIMEOUT!<br>";
                    die();
                }

                */

                break;
            case 'DD':
                error_log("crnrstn_wind_cloud_fire (1017) transfer DD");
                $tmp_filename = basename($source_file_path);

                $tmp_trimmed_file_path = str_replace($source_root_path, "", $source_file_path);  # common/js/lib/jquery_mobi/images/icons-png/heart-white.png
                $tmp_trimmed_file_path = str_replace($tmp_filename, "", $tmp_trimmed_file_path);

                $dest_dir_path = rtrim($dest_dir_path, '/') . '/';
                $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');
                $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';    # var/www/html/evifweb/common/jquery_mobi/themes/images/icons-png/
                #$destination_file = $dest_dir_path.$tmp_trimmed_file_path.$tmp_filename;   # /mnt/hgfs/jony5/Desktop/desktop/_backup/

                # $source_root_path = "/mnt/hgfs/jony5/Documents/jharris_code_samples/";
                $tmp_source_root_ARRAY = explode( '/', $source_root_path);
                $tmp_loop_size = sizeof($tmp_source_root_ARRAY);

                $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

                $destination_file = $dest_dir_path.$tmp_proj_name_dir."/".$timestamp_nom."/".$tmp_trimmed_file_path.$tmp_filename;

                #$dest_dir_only = str_replace($tmp_filename, "", $destination_file);

                //shell_exec("cp -r $source_file_path $dest_dir_only");

                //
                // PULL FROM SOURCE DIR_LOCAL - PUT TO DESTINATION DIR_LOCAL
                #$dest = "/home/jony5/Desktop/nfs/localmac/jony5/Desktop/desktop/_backup/test/";
                #$local_file = '/mnt/hgfs/jony5/_data_automate/eVifweb/_tmp_FTP_transfer/jharris_code_samples/';
                #shell_exec("cp -r $local_file $dest");

                #shell_exec("cp -r $source_file_path $destination_file");
                error_log("crnrstn_wind_cloud_fire (804) source [$source_file_path]  dest [$destination_file]");

                if(!isset(self::$data_move_flag_ARRAY[$source_file_path.$destination_file])){

                    $this->mkdir_r("$dest_dir_path$tmp_proj_name_dir"."/".$timestamp_nom."/".$tmp_trimmed_file_path."/");
                    shell_exec("cp -r $source_file_path $destination_file");

                    $tmp_res = filesize($destination_file);

                    if ($tmp_res != -1) {
                        //echo "<br><br>size of $destination_file is $tmp_res bytes";
                    } else {
                        echo "<br>Error :: Couldn't get the size of $destination_file (Not all servers support this feature).";

                        if (!file_exists($destination_file)) {

                            //
                            // LOG ERROR IN FILE MOVE. POSSIBLY FOR RE-PROCESS.
                            echo "<br>Error :: Also couldn't get $destination_file via file_exists.";

                        }
                    }

                    ## QUEUE THIS ## AS UPDATE_PRELOAD_DATA_STATUS_COMPLETE
                    $handle = 'UPDATE_DATA_TRANSFER_STATUS_COMPLETE';
                    if(!isset(self::$req_execute_batch_update[$handle])){
                        self::$req_execute_batch_update[$handle] = 1;
                    }

                    $ts = date("Y-m-d H:i:s", time());
                    $field_names_pipe = "PRELOAD_ID|ELECTRUM_ID|DSOURCE_ID|FILE_SIZE_DESTINATION|ENDTIME|STATUS|FINISH_ELECTRUM_PROCESS_ID";
                    $field_values_pipe = $preload_id."|$electrum_id|$endpoint_source_id|$tmp_res|$ts|TRANSFER COMPLETE|".self::$electrum_process_id;
                    //echo "<br>queue_request $field_values_pipe";
                    self::$oData->queue_request($this, $handle, $field_names_pipe, $field_values_pipe);

                    //echo "<br>DD - Success moving " . $source_file_path . " to " . $destination_file;

                    self::$data_move_flag_ARRAY[$source_file_path.$destination_file] = 1;


                }else{

                    //echo "<br>Suppressed DD ".$source_file_path . " to " . $destination_file;

                }

                break;

        }

    }

    #private function mkdir_r($dirName, $rights=0777){
    // SOURCE :: http://php.net/manual/en/function.mkdir.php
    // AUTHOR :: http://php.net/manual/en/function.mkdir.php#68207
    private function mkdir_r($dirName){
        try{
            $mode = "777";
            $mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
            $mode = (int)$mode;

            $dirs = explode('/', $dirName);
            $dir='';
            foreach ($dirs as $part) {
                $dir.=$part.'/';
                if (!is_dir($dir) && strlen($dir)>0) {
                    if(!mkdir($dir, $mode)){
                        $error = error_get_last();
                        echo "<br><br>".$error['message']."<br><br>";
                        throw new Exception('EVIFWEB crnrstn_wind_cloud_fire mkdir_r() failed to mkdir :: ' . $dir);

                    }
                }
            }

            return true;

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->mkdir_r()', LOG_EMERG, $e->getMessage());

            return false;
        }
    }

    private function grab_preload_batch($electrum_id=NULL){

        if(!isset($electrum_id)){

            error_log("crnrstn_wind_cloud_fire (985) die()");
            die();
            //
            // RETURN ARRAY OF BATCH PRELOAD DATA...IN GENERAL.
            $this->save_data_param('ELECTRUM_ID', "");

            $tmp_oDB_RESP = self::$oData->processRequest('return_preload_batch', $this, self::$oEnv, self::$oDB_RESP);
            $tmp_data_cnt = $tmp_oDB_RESP->return_sizeof($tmp_oDB_RESP->return_serial('BATCH_LOOP_BY_ID'),'PRELOAD_DATA');
            if($tmp_data_cnt>0){
                self::$oDB_RESP = $tmp_oDB_RESP;
                return $tmp_oDB_RESP;
            }else{
                return false;

            }

        }else{

            //
            // RETURN ARRAY OF BATCH PRELOAD DATA ACCORDING TO $electrum_id
            $this->save_data_param('ELECTRUM_ID', $electrum_id);
            $tmp_oDB_RESP = self::$oData->processRequest('return_preload_batch', $this, self::$oEnv, self::$oDB_RESP);

            if(is_object($tmp_oDB_RESP)){
                $tmp_data_cnt = $tmp_oDB_RESP->return_sizeof($tmp_oDB_RESP->return_serial('BATCH_LOOP_BY_ID'.$tmp_oDB_RESP->recur_key),'PRELOAD_DATA');
                if($tmp_data_cnt>0){
                    self::$oDB_RESP = $tmp_oDB_RESP;
                    return $tmp_oDB_RESP;
                }else{
                    return false;

                }

            }else{

                return false;
            }
        }
    }

    // SOURCE :: http://ee1.php.net/manual/en/function.ftp-mkdir.php
    // AUTHOR :: http://ee1.php.net/manual/en/function.ftp-mkdir.php#112399
    private function ftp_mksubdirs($ftpcon,$ftpbasedir,$ftpath){
        @ftp_chdir($ftpcon, $ftpbasedir); // /var/www/uploads
        $parts = explode('/',$ftpath); // 2013/06/11/username
        //$mode = "777";
        //$mode = octdec( str_pad($mode,4,'0',STR_PAD_LEFT) );
        //$mode = (int)$mode;

        foreach($parts as $part){
            if(!@ftp_chdir($ftpcon, $part)) {

                if ($part != "") {

                    if (!isset(self::$desitnation_directory_flag[$ftpath . $part])) {
                        if (!ftp_mkdir($ftpcon, $part)) {
                            $error = error_get_last();
                            #echo "<br><br>" . $error['message'] . " on [" . $ftpbasedir . "][" . $ftpath . "][" . $part . "]<br><br>";

                        } else {
                            self::$desitnation_directory_flag[$ftpath . $part] = 1;
                            #echo "<br>ftp_mkdir GOOD.  on [" . $ftpbasedir . "][" . $ftpath . "][" . $part . "]<br>";
                        }
                    } else {

                        #echo "<br><br>ftp_mkdir SUPPRESSED<br><br>";
                    }

                    if (!ftp_chdir($ftpcon, $part)) {
                        #$error = error_get_last();
                        #echo "<br><br>" . $error['message'] . " on [" . $ftpbasedir . "][" . $ftpath . "][" . $part . "]<br><br>";
                    } else {
                        #echo "<br>ftp_chdir GOOD.  on [" . $ftpbasedir . "][" . $ftpath . "][" . $part . "]<br>";
                    }
                    /*
                    if (!ftp_chmod($ftpcon, $mode, $part)) {
                        $error = error_get_last();
                        echo "<br><br>" . $error['message'] . " on [" . $ftpbasedir . "][" . $ftpath . "][".$part."]<br><br>";

                    } else {
                        echo "<br>ftp_chmod GOOD.  on [" . $ftpbasedir . "][" . $ftpath . "][".$part."]<br>";
                    }
                    */
                }
            }
        }
    }

    private function terminate_electrum_sessions($electrum_id){

        $this->save_data_param('CONN_SESSION_ARRAY', self::$conn_session_active_ARRAY[$electrum_id]);

        return self::$oData->processRequest('terminate_electrum_sessions', $this, self::$oEnv, self::$oDB_RESP);

    }

    public function close(){

        //
        // ANY CLEAN UP
        error_log("crnrstn_wind_cloud_fire (307) clean up FTP connections...");
        $this->terminate_ftp();

    }

    public function validElectrum($oDB_RESP){

        //
        // OF THE RETURNED ELECTRUM, WHO HAS AT LEAST 1 SOURCE AND 1 DESTINATION
        $tmp_endpoint_flag = array();
        $tmp_endpoint_container_ARRAY = array();
        $tmp_electrum_process_ARRAY = array();
        $tmp_endpoint_flag['SOURCE'] = NULL;
        $tmp_endpoint_flag['DESTINATION'] = NULL;
        $tmp_loop_ELECTRUM_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(),'ELECTRUM');
        for($i=0;$i<$tmp_loop_ELECTRUM_size;$i++){
            $tmp_electrum_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'ELECTRUM', "ELECTRUM_ID", $i);

            $tmp_endpoint_flag['SOURCE'] = NULL;
            $tmp_endpoint_flag['DESTINATION'] = NULL;
            //
            // JUST THE COUNT OF ENDPOINTS FOR THIS ELECTRUM
            //error_log("crnrstn_wind_cloud_fire (163) retrieveCountByID() for ".$tmp_electrum_id."...");
            $tmp_electrum_endpoint_loop_size = $oDB_RESP->retrieveCountByID($oDB_RESP->return_serial(),'ELECTRUM_ENDPOINT', $tmp_electrum_id,'ELECTRUM_ID');
            //error_log("crnrstn_wind_cloud_fire (166) retrieveCountByID()..[".$tmp_electrum_endpoint_loop_size."]");
            for($ii=0;$ii<$tmp_electrum_endpoint_loop_size;$ii++) {
                $tmp_endpoint_ID = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'ELECTRUM_ENDPOINT', $tmp_electrum_id, 'ENDPOINT_ID', $ii);

                //
                // FOR ELECTRUM_ID HAND OFF TO SOURCE PRELOAD - JUST STORE ALL ENDPOINT
                self::$electrum_id_by_endpoint_ARRAY[$tmp_endpoint_ID] = $tmp_electrum_id;

                //
                // IS THIS ENDPOINT A SOURCE OR DESTINATION
                $tmp_is_source = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'ENDPOINT' , $tmp_endpoint_ID, 'IS_SOURCE');
                if($tmp_is_source=="1"){
                    //
                    // SOURCE
                    $tmp_endpoint_flag['SOURCE']=1;
                    $tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][0] = 'SOURCE';
                    $tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][1] = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'ENDPOINT', $tmp_endpoint_ID, 'TRANSMISSION_TYPE');
                    #self::$oLogger->captureNotice('database_manager (2441)', LOG_NOTICE, 'We have SOURCE endpoint for ['.$tmp_electrum_id.']');
                }else{
                    //
                    // DESTINATION
                    $tmp_endpoint_flag['DESTINATION']=1;
                    $tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][0] = 'DESTINATION';
                    $tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][1] = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'ENDPOINT', $tmp_endpoint_ID, 'TRANSMISSION_TYPE');
                    #self::$oLogger->captureNotice('database_manager (2441)', LOG_NOTICE, 'We have DESTINATION endpoint for ['.$tmp_electrum_id.']');
                }

            }

            //
            // IS THIS ELECTRUM WITH SOURCE AND DESTINATION
            //error_log('crnrstn_wind_cloud_fire->validElectrum() (251) Checking for VALID ['.$tmp_endpoint_flag['SOURCE'].'|'.$tmp_endpoint_flag['DESTINATION'].']');

            if($tmp_endpoint_flag['SOURCE']==1 && $tmp_endpoint_flag['DESTINATION']==1) {
                $tmp_electrum_process_ARRAY[] = $tmp_electrum_id;
            }
        }

        $tmp_ouput_ARRAY = array();
        $tmp_ouput_ARRAY[0] = $tmp_endpoint_container_ARRAY;
        $tmp_ouput_ARRAY[1] = $tmp_electrum_process_ARRAY;

        return $tmp_ouput_ARRAY;

    }

    public function validFrequency($electrum_process_ARRAY, $oDB_RESP){

        $tmp_process_ARRAY = array();

        //error_log('crnrstn_wind_cloud_fire->validFrequency() (268) Running...');
        $tmp_loop_size = sizeof($electrum_process_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){

            if($this->validElectrumFreq($electrum_process_ARRAY[$i],$oDB_RESP)){

                $tmp_process_ARRAY[] = $electrum_process_ARRAY[$i];
            }


        }

        return $tmp_process_ARRAY;

    }

    private function validElectrumFreq($electrum_id, $oDB_RESP){
        $tmp_electrum_last_run = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ELECTRUM' , $electrum_id, 'LASTRUN');
        $tmp_electrum_isactive = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ELECTRUM' , $electrum_id, 'ISACTIVE');

        if($tmp_electrum_last_run=="" || $tmp_electrum_isactive=="4"){

            return true;
        }else{
            $tmp_current = strtotime("now");

        }

        $tmp_electrum_frequency_unit = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ELECTRUM' , $electrum_id, 'FREQUENCY');
        $tmp_electrum_frequency_val = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ELECTRUM' , $electrum_id, 'FREQ_'.$tmp_electrum_frequency_unit);

        switch($tmp_electrum_frequency_unit){
            case 'MIN':
                $tmp_conn_expire_target = strtotime($tmp_electrum_last_run." +".$tmp_electrum_frequency_val." minute");

                break;
            case 'HOUR':
                $tmp_conn_expire_target = strtotime($tmp_electrum_last_run." +".$tmp_electrum_frequency_val." hour");

                break;
            case 'DAY':
                $tmp_conn_expire_target = strtotime($tmp_electrum_last_run." +".$tmp_electrum_frequency_val." day");

                break;
            case 'WEEK':
                $tmp_conn_expire_target = strtotime($tmp_electrum_last_run." +".$tmp_electrum_frequency_val." week");

                break;
            case 'MONTH':
                $tmp_conn_expire_target = strtotime($tmp_electrum_last_run." +".$tmp_electrum_frequency_val." month");

                break;

        }

        if($tmp_current > $tmp_conn_expire_target){

            return true;
        }else{

            return false;
        }

    }

    public function validEndpoints($electrum_process_ARRAY, $endpoint_container_ARRAY, $oDB_RESP){

        //
        // THIS IS CALLED FROM WITHIN DATABASE CLASS AFTER RETURN OF ELECTRUM
        $tmp_output_ARRAY = array();
        $tmp_isvalid_electrum_ARRAY = array();
        $tmp_is_FTP = array();

        /*
         * - n+1 DATA SOURCE VALIDATION
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
        */

        //
        // FOR EACH ELECTRUM
        $tmp_loop_electrum_size = sizeof($electrum_process_ARRAY);
        for($i=0;$i<$tmp_loop_electrum_size;$i++){

            //
            // FOR EACH ENDPOINT WITH THIS ELECTRUM
            # $tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][0] = 'SOURCE';
            # $tmp_endpoint_container_ARRAY[$tmp_electrum_id][$tmp_endpoint_ID][1] = #TRANSMISSION_TYPE
            foreach($endpoint_container_ARRAY[$electrum_process_ARRAY[$i]] as $endpoint_id => $endpoint_ARRAY){

                error_log("crnrstn_wind_cloud_fire (268) do I have electrum[".crc32($electrum_process_ARRAY[$i])."|".$i."] endpoint ID[".crc32($endpoint_id)."] size of[".sizeof($endpoint_ARRAY)."]");
                error_log("Endpoint type [".$endpoint_container_ARRAY[$electrum_process_ARRAY[$i]][$endpoint_id][1]."]");
                switch($endpoint_container_ARRAY[$electrum_process_ARRAY[$i]][$endpoint_id][1]){
                    case 'FTP':
                        $tmp_conn_session_id = $this->validate_FTP_Endpoint($endpoint_id, $oDB_RESP);

                        if(!isset(self::$conn_session_active_ARRAY[$electrum_process_ARRAY[$i]][$tmp_conn_session_id])){
                            self::$conn_session_active_ARRAY[$electrum_process_ARRAY[$i]][$tmp_conn_session_id] = 1;
                        }

                        //
                        // FOR FLAGGING ENDPOINT TO CALL FTP_CLOSE AGAINST
                        $tmp_is_FTP[$endpoint_id] = 1;

                        if($tmp_conn_session_id){

                            $tmp_isvalid_electrum_ARRAY[$electrum_process_ARRAY[$i]][$endpoint_id] = true;
                            error_log("crnrstn_wind_cloud_fire (393891) Mark this FTP endpoint as VALID. ".$endpoint_id);
                        }else{
                            $tmp_isvalid_electrum_ARRAY[$electrum_process_ARRAY[$i]][$endpoint_id] = false;
                            error_log("crnrstn_wind_cloud_fire (392) Mark this FTP endpoint as INVALID. ".$endpoint_id);
                        }

                        break;
                    case 'LOCAL_DIR':
                        if($this->validate_LOCAL_DIR_Endpoint($endpoint_id, $oDB_RESP)){

                            $tmp_conn_session_id = $this->create_local_dir_session($endpoint_id, $oDB_RESP);

                            if(!isset(self::$conn_session_active_ARRAY[$electrum_process_ARRAY[$i]][$tmp_conn_session_id])){
                                self::$conn_session_active_ARRAY[$electrum_process_ARRAY[$i]][$tmp_conn_session_id] = 1;
                            }

                            $tmp_isvalid_electrum_ARRAY[$electrum_process_ARRAY[$i]][$endpoint_id] = true;
                            error_log("crnrstn_wind_cloud_fire (401) Mark this DIR endpoint as VALID. ".$endpoint_id);
                        }else{
                            error_log("crnrstn_wind_cloud_fire (403) Mark this DIR endpoint as INVALID. ".$endpoint_id);
                            $tmp_isvalid_electrum_ARRAY[$electrum_process_ARRAY[$i]][$endpoint_id] = false;
                        }

                        break;
                    default:

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('We do not know the endpoint type. ');

                        break;
                }

            }

        }

        $output_electrum_process_ARRAY = array();

        for($i=0;$i<$tmp_loop_electrum_size;$i++) {
            $tmp_electrum_id_status[$electrum_process_ARRAY[$i]] = true;

            foreach($tmp_isvalid_electrum_ARRAY[$electrum_process_ARRAY[$i]] as $key0 => $val0){
                if(!$val0){

                    error_log("crnrstn_wind_cloud_fire (464) We have a bad endpoint [".$key0."].");
                    $tmp_electrum_id_status[$electrum_process_ARRAY[$i]] = false;
                }else{
                    self::$endpoint_connection_session_ARRAY[$key0] = $tmp_conn_session_id;
                    $tmp_valid_conn[$electrum_process_ARRAY[$i]][$key0] = $val0;
                }

            }

            if($tmp_electrum_id_status[$electrum_process_ARRAY[$i]]){

                $output_electrum_process_ARRAY[] = $electrum_process_ARRAY[$i];

                //
                // FOR CONNECTION TERMINATION
                foreach($tmp_valid_conn[$electrum_process_ARRAY[$i]] as $key0 => $val0){
                    if($val0 && isset($tmp_is_FTP[$key0])){
                        error_log("crnrstn_wind_cloud_fire (980) queue for termination [".$key0."]");
                        self::$terminate_endpoint_conn_ARRAY[] = $key0;
                    }

                }
            }
        }

        $tmp_output_ARRAY[0] = $oDB_RESP;
        $tmp_output_ARRAY[1] = $output_electrum_process_ARRAY;
        $tmp_output_ARRAY[2] = $endpoint_container_ARRAY;

        return $tmp_output_ARRAY;
    }

    private function create_local_dir_session($endpoint_id, $oDB_RESP){

        $this->save_data_param('ENDPOINT_ID', $endpoint_id);
        $this->save_data_param('LOCAL_DIR_PATH', $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT', $endpoint_id, 'LOCAL_DIR_PATH'));

        return self::$oData->processRequest('create_local_dir_session', $this, self::$oEnv, $oDB_RESP);

    }

    private function return_eligible_electrum($handle){
        self::$db_response_serial_handle_ARRAY[] = $handle;

        return self::$oData->processRequest('return_eligible_electrum', $this, self::$oEnv);

    }

    private function validate_FTP_Endpoint($endpoint_id, $oDB_RESP){
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
            self::$oFourLivingCreatures_FTP = new crnrstn_fire_ftp_manager(self::$oEnv);
        }

        return self::$oFourLivingCreatures_FTP->init_ftp_endpoint($endpoint_id, $this, self::$oData, $oDB_RESP);

    }

    private function validate_LOCAL_DIR_Endpoint($endpoint_id, $oDB_RESP){

        $tmp_is_source = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'IS_SOURCE');
        $tmp_local_dir_path = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'LOCAL_DIR_PATH');

        if($this->too_many_connections($endpoint_id, $this, self::$oData, $oDB_RESP)){
            $this->transaction_status = 'Too many active local directory connections to this endpoint. Connection attempt suppressed.';
            return false;
        }

        switch($tmp_is_source) {
            case '1':

                //
                // SOURCE - LOCAL_DIR
                if(is_readable($tmp_local_dir_path)){

                    error_log("crnrstn_wind_cloud_fire (504) local dir is readable");
                    return true;

                }else{

                    error_log("crnrstn_wind_cloud_fire (504) local dir is NOT readable");
                    return false;

                }

                break;
            default:

                //
                // DESTINATION - LOCAL_DIR
                if(is_writable($tmp_local_dir_path)){

                    error_log("crnrstn_wind_cloud_fire (504) local dir is writable");
                    return true;

                }else{

                    error_log("crnrstn_wind_cloud_fire (504) local dir is NOT writable");
                    return false;

                }

                break;
        }


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

    }

    private function too_many_connections($endpoint_id, $oElectrum, $oDATA, $oDB_RESP){

        error_log("crnrstn_wind_cloud_fire (581) checking for too many LOCAL DIR connections.");
        $oElectrum->save_data_param('ENDPOINT_ID', $endpoint_id);

        return $oDATA->processRequest('too_many_connections', $oElectrum, self::$oEnv, $oDB_RESP);

    }

    private function prep_ftp_dir_path($dir_path){

        //
        // STRIP TRAILING SLASH
        $dir_path = rtrim($dir_path, '/');

        return $dir_path;
    }


    private function preload_FTP_source($endpoint_id){

        /*

        3) - FOR ELECTRUM[n]
        - READ DATA SOURCE[n+1] TOP LEVEL CONTENTS [FILE AND DIRECTORY]
        - STORE (IN MEMORY) DATA SOURCE[n+1] TOP LEVEL CONTENTS [FILE AND DIRECTORY] WITH ID FOR EACH ITEM
         WE WILL LOOP THROUGH EACH ITEM INDIVIDUALLY AND PROCESS TO COMPLETION BEFORE MOVING TO THE NEXT ITEM

         * */

        //
        // QUEUE DATASOURCE CONTENT FOR PROCESSING BY ELECTRUM
        $ftp_dir_path = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'FTP_DIR_PATH');
        $ftp_dir_path = $this->prep_ftp_dir_path($ftp_dir_path);

        $oFTP_stream_resource = self::$oFourLivingCreatures_FTP->endpoint_FTP_conn_ARRAY[crc32($endpoint_id)];

        #$contents = ftp_nlist($oFTP_stream_resource, $ftp_dir_path);
        $ftp_contents = $this->ftp_list_files_recursive($oFTP_stream_resource, $ftp_dir_path);

        // output $contents
        #var_dump($contents);

        # ELECTRUM_ID
        # DSOURCE_ID
        # ELECTRUM_CONN_SESSION  (100)

        #self::$conn_session_active_ARRAY[ELECTRUM_ID] HOLDS ELECTRUM_CONN_SESSION

        $tmp_electrum_id = self::$electrum_id_by_endpoint_ARRAY[$endpoint_id];

        $this->save_data_param('TIMESTAMP_NOM', date("Ymd_H-i-s", time()));
        $this->save_data_param('FTP_DIR_CONTENTS_ARRAY', $ftp_contents);
        $this->save_data_param('FTP_DIR_ROOT', $ftp_dir_path);
        $this->save_data_param('DSOURCE_ID', $endpoint_id);
        $this->save_data_param('ELECTRUM_ID', $tmp_electrum_id);
        #$this->save_data_param('ELECTRUM_CONN_SESSION', self::$endpoint_connection_session_ARRAY[$endpoint_id]);
        $this->save_data_param('ELECTRUM_CONN_SESSION', self::$electrum_process_id);
        $this->save_data_param('FTP_STREAM_RESOURCE', $oFTP_stream_resource);

        return self::$oData->processRequest('preload_ftp_source', $this, self::$oEnv, self::$oDB_RESP);


        /*
         * 4 LIVING CREATURES :: MAN LION OX EAGLE
         * $oFourLivingCreatures = new crnrstn_fire_ftp_manager();
         * AND FROM THE MIDST OF IT THERE CAME THE LIKENESS OF FOUR LIVING CREATURES. EZEKIEL 1:5a
         * FTP_CONNECTION_MANAGER
         * FTP_CONNECTION
         *
         * */

    }

    public function exclusion_match($oDB_RESP, $endpoint_id, $endpoint_data){
        #$endpoint_data = "../../var/www/html/evifweb/dashboard/kivotos/removeaccess/_crnrstn.root.inc.php"

        $tmp_type = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'TRANSMISSION_TYPE');
        switch($tmp_type){
            case 'FTP':

                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'EXCLUSION_DATA');
                for($i=0;$i<$tmp_loop_size;$i++){

                    $tmp_is_dir = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'EXCLUSION_DATA' , $endpoint_id, 'IS_DIR', $i);
                    $tmp_exclusion_pattern = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'EXCLUSION_DATA' , $endpoint_id, 'EXCLUSION_DATA', $i);

                    if($tmp_is_dir=="1"){

                        //
                        // PROCESS DIRECTORY EXCLUSION
                        # /path/to/directory/only/
                        //error_log("crnrstn_wind_cloud_fire (786) check FTP [".$endpoint_data."] for DIR ".$tmp_exclusion_pattern);
                        $tmp_dir_name = dirname($endpoint_data);
                        $tmp_exclude_pos = strpos($tmp_dir_name, $tmp_exclusion_pattern);
                        //if ($tmp_exclude_pos !== false) {
                        if(fnmatch($tmp_exclusion_pattern, $tmp_dir_name) || ($tmp_exclude_pos !== false)){


                            //error_log("crnrstn_wind_cloud_fire (790) FTP DIR [".$tmp_exclusion_pattern."] SUPPRESSED -->".$endpoint_data);
                            return true;

                        }

                    }else{

                        //
                        // PROCESS FILE EXCLUSION
                        # filename patterns, file names,
                        //error_log("crnrstn_wind_cloud_fire (802) check FTP [".$endpoint_data."] for FILE PATTERN ".$tmp_exclusion_pattern);
                        //error_log("crnrstn_wind_cloud_fire (801) finish validation for FILE PATTERN EXCLUSIONS. die()");

                        $tmp_filename = basename($endpoint_data);

                        if (fnmatch($tmp_exclusion_pattern, $tmp_filename)) {
                            //error_log("crnrstn_wind_cloud_fire (806) FTP [".$tmp_exclusion_pattern."] FILE SUPPRESSED -->".$endpoint_data);

                            return true;
                        }
                    }
                }

                break;
            case 'LOCAL_DIR':

                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial(), 'EXCLUSION_DATA');
                for($i=0;$i<$tmp_loop_size;$i++){

                    $tmp_is_dir = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'EXCLUSION_DATA' , $endpoint_id, 'IS_DIR', $i);
                    $tmp_exclusion_pattern = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial(), 'EXCLUSION_DATA' , $endpoint_id, 'EXCLUSION_DATA', $i);

                    if($tmp_is_dir == "1"){

                        //
                        // PROCESS DIRECTORY EXCLUSION
                        # /path/to/directory/only/
                        //error_log("crnrstn_wind_cloud_fire (821) check LOCAL_DIR [".$endpoint_data."] for DIR ".$tmp_exclusion_pattern);
                        $tmp_dir_name = dirname($endpoint_data);
                        $tmp_exclude_pos = strpos($tmp_dir_name, $tmp_exclusion_pattern);
                        //fnmatch
                        //if ($tmp_exclude_pos !== false) {
                        if(fnmatch($tmp_exclusion_pattern, $tmp_dir_name) || ($tmp_exclude_pos !== false)){

                            //error_log("crnrstn_wind_cloud_fire (837) LOCAL_DIR [".$tmp_exclusion_pattern."] DIR SUPPRESSED -->".$endpoint_data);
                            return true;

                        }

                    }else{

                        //
                        // PROCESS FILE EXCLUSION
                        # filename patterns, file names,
                        //error_log("crnrstn_wind_cloud_fire (835) check LOCAL_DIR [".$endpoint_data."] for FILE PATTERN ".$tmp_exclusion_pattern);
                        $tmp_filename = basename($endpoint_data);

                        if (fnmatch($tmp_exclusion_pattern, $tmp_filename)) {
                            //error_log("crnrstn_wind_cloud_fire (851) LOCAL_DIR [".$tmp_exclusion_pattern."] FILE SUPPRESSED -->".$endpoint_data);

                            return true;
                        }
                    }

                }

                break;
            default:

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to understand source endpoint type detail ['.$tmp_type.'] during exclusion_match().');

                break;

        }

        return false;
    }

    //
    // SOURCE :: https://stackoverflow.com/questions/36310247/php-ftp-recursive-directory-listing
    // AUTHOR :: https://stackoverflow.com/users/850848/martin-prikryl
    private function ftp_list_files_recursive($ftp_stream, $path){
        $lines = ftp_rawlist($ftp_stream, $path);

        $result = array();

        foreach ($lines as $line)
        {
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
    }

    //
    // SOURCE :: http://php.net/manual/en/class.recursivedirectoryiterator.php
    // AUTHOR :: http://php.net/manual/en/class.recursivedirectoryiterator.php#85805
    private function localdir_list_files_recursive($dir){
        $results = array();
        $path = realpath($dir);

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        foreach($objects as $name => $object){
            if ((strpos($name, '/.') !== false) || (strpos($name, '/..') !== false)) {

            }else{
                if(!(is_dir($name))){
                    $results[] = $name;

                }

            }

        }

        return $results;
    }

    private function preload_LOCAL_DIR_source($endpoint_id){

        error_log("crnrstn_wind_cloud_fire (615) preload_LOCAL_DIR_source() Preload DIR SOURCE NOW.");

        $local_dir_path = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'LOCAL_DIR_PATH');

        #$local_dir_contents = scandir($local_dir_path);
        $local_dir_contents = $this->localdir_list_files_recursive($local_dir_path);

        $tmp_electrum_id = self::$electrum_id_by_endpoint_ARRAY[$endpoint_id];

        $this->save_data_param('TIMESTAMP_NOM', date("Ymd_H-i-s", time()));
        $this->save_data_param('LOCAL_DIR_CONTENTS_ARRAY', $local_dir_contents);
        $this->save_data_param('LOCAL_DIR_ROOT', $local_dir_path);
        $this->save_data_param('DSOURCE_ID', $endpoint_id);
        $this->save_data_param('ELECTRUM_ID', $tmp_electrum_id);
        #$this->save_data_param('ELECTRUM_CONN_SESSION', self::$endpoint_connection_session_ARRAY[$endpoint_id]);
        $this->save_data_param('ELECTRUM_CONN_SESSION', self::$electrum_process_id);
        #$this->save_data_param('LOCAL_DIR_PATH', $local_dir_path);

        return self::$oData->processRequest('preload_local_dir_source', $this, self::$oEnv, self::$oDB_RESP);


        /*

        3) - FOR ELECTRUM[n]
        - READ DATA SOURCE[n+1] TOP LEVEL CONTENTS [FILE AND DIRECTORY]
        - STORE (IN MEMORY) DATA SOURCE[n+1] TOP LEVEL CONTENTS [FILE AND DIRECTORY] WITH ID FOR EACH ITEM
         WE WILL LOOP THROUGH EACH ITEM INDIVIDUALLY AND PROCESS TO COMPLETION BEFORE MOVING TO THE NEXT ITEM

         * */

        #$local_dir_mnt = "../../../../home/jony5/Desktop/nfs/localmac/jony5/";

        #$files1 = scandir($local_dir_mnt);
        #print_r($files1);

        /*
        $tmp_path = self::$oDB_RESP->retrieveDataByID(self::$oDB_RESP->return_serial('ELECTRUM_CONFIG'), 'ENDPOINT' , $endpoint_id, 'LOCAL_DIR_PATH');
        error_log("(475) Preloading LOCAL_DIR SOURCE :: ".$tmp_path);

        if(is_dir($tmp_path)){
            error_log("(478) LOCAL_DIR SOURCE IS VALID DIR :: ".$tmp_path);
            $files1 = scandir($tmp_path);
            error_log("crnrstn_wind_cloud_fire (483) directory contents size = ".sizeof($files1));
            #print_r($files1);

        }else{
            error_log("(481) LOCAL_DIR SOURCE NOT VALID DIR :: ".$tmp_path);

        }

        */

    }

    public function push_response_serial_handle($handle){
        if(isset($handle)){
            self::$db_response_serial_handle_ARRAY[] = $handle;
        }else{
            //
            // HOOOSTON...VE HAF PROBLEM!
            self::$oLogger->captureNotice('crnrstn_wind_cloud_fire->push_response_handle() FAILURE', LOG_EMERG, 'No database response handle has been provided.');

        }

    }

    public function return_serial_handle($pos=NULL){

        if(isset($pos)){

            $tmp_last_handle = self::$db_response_serial_handle_ARRAY[$pos];

        }else {
            //
            // RETURN REFERENCE TO DATABASE RESPONSE SERIALIZATION. LAST ELEMENT OF ARRAY.
            $tmp_last_handle = end(self::$db_response_serial_handle_ARRAY);

        }

        return $tmp_last_handle;

    }

    public function retrieve_data_param($key){
        return self::$data_param_handle[$key];
    }

    public function save_data_param($key, $value){

        self::$data_param_handle[$key] = $value;
    }


    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    public function generateNewKey($len=32){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited


        if(function_exists('random_int')){
            for ($i=0; $i < $len; $i++){
                $token .= $codeAlphabet[random_int(0, $max-1)];
            }
        }else{
            for ($i=0; $i < $len; $i++) {
                $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
            }
        }

        return $token;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    private function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }


    public function __destruct() {

        //
        // TERMINATE FTP SESSIONS
        $this->close();

    }

}