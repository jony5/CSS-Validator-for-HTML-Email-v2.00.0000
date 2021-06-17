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
# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_query_manager
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: Tues July 14, 2020 @ 1037hrs

class crnrstn_database_request {

    protected $oLogger;
    private static $oEnv;
    private static $oCRNRSTN_USR;
    protected $oQuery_ARRAY = array();

	public $crnrstn_database_request_serial;

	public function __construct($oCRNRSTN_USR) {

        try{

            if(isset($oCRNRSTN_USR)){

                //
                // HOLD USER and ENVIRONMENTALS
                self::$oCRNRSTN_USR = $oCRNRSTN_USR;
                self::$oEnv = $oCRNRSTN_USR->return_oCRNRSTN_ENV();

                //
                // SERIALIZE OBJECT - LEN32
                $this->crnrstn_database_request_serial = $oCRNRSTN_USR->generateNewKey();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for crnrstn_database_request :: __construct().');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    public function spoolQuery($oQuery, $request_serial, $oDB_wiring){

	    //
        // RUNS FROM LOOP THOUGH ALL VALID QUERY GOING TO DATABASE (n+1 connections, n+1 batches)
        $oDB_wiring->spoolRequestedQuery($oQuery, $request_serial);

    }

    public function sendIt($request_serial, $oDB_wiring, $oQueryManager){

        //error_log('71 user request - SEEENND IIIIT!');

        $tmp_spooled_conn_ARRAY = $oDB_wiring->returnSQLSpooledConn($request_serial);
        # $tmp_spooled_conn_ARRAY[n]['batch_key']
        # $tmp_spooled_conn_ARRAY[n]['query']
        # $tmp_spooled_conn_ARRAY[n]['connection_serial']
        # $tmp_spooled_conn_ARRAY[n]['type'] = multi, single

        foreach($tmp_spooled_conn_ARRAY  as $index=>$spooledConnectionArray){

            $tmp_conn = $oDB_wiring->returnConn($request_serial, $spooledConnectionArray['connection_serial'], $spooledConnectionArray['batch_key']);

            //error_log('83 db req - '.$spooledConnectionArray['type'].' query type to be processed.');
            if($spooledConnectionArray['type'] == 'multi'){

                //
                // MULTI-QUERY
                //error_log('88 db req - multi query out...');
                $mysqli = self::$oEnv->oMYSQLI_CONN_MGR->processMultiQuery($tmp_conn, $spooledConnectionArray['query']);

                //$this->mysqli[$request_serial][$connection_serial] = $mysqli;
                // $oDB_wiring->updateConn($mysqli);

                //
                // STORE DATABASE RESPONSE
                $this->receive_databaseResultSet($tmp_conn, $request_serial, $spooledConnectionArray['connection_serial'], $spooledConnectionArray['batch_key'], $mysqli, $spooledConnectionArray['type'], $oDB_wiring, $oQueryManager);

            }else{

                //
                // SINGLE QUERY
                //error_log('102 db req - single query out...');
                $result = self::$oEnv->oMYSQLI_CONN_MGR->processQuery($tmp_conn, $spooledConnectionArray['query']);

                //
                // STORE DATABASE RESPONSE
                $this->receive_databaseResultSet($tmp_conn, $request_serial, $spooledConnectionArray['connection_serial'], $spooledConnectionArray['batch_key'], $result, $spooledConnectionArray['type'], $oDB_wiring, $oQueryManager);

            }

        }

        return true;

    }

    private function receive_databaseResultSet($mysqli, $request_serial, $connection_serial, $batch_key, $db_element, $query_type, $oDB_wiring, $oQueryManager){

	    try{

            switch($query_type){
                case 'multi':

                    $this->consume_mysqli_multi_result($request_serial, $connection_serial, $batch_key, $db_element, $oDB_wiring, $oQueryManager);

                break;
                case 'single':

                    $this->consume_mysqli_single_result($mysqli, $request_serial, $connection_serial, $batch_key, $db_element, $oDB_wiring, $oQueryManager);

                break;
                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Missing or NULL query type.');

                break;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

        }

    }

    private function consume_mysqli_single_result($heavy_mysqli, $request_serial, $connection_serial, $batch_key, $result, $oDB_wiring, $oQueryManager){

	    try{

            if($heavy_mysqli->error){

                throw new Exception('CRNRSTN Suite :: ERROR ['.$heavy_mysqli->error.']');

            }else{

                $rowcount=0;
                $oDB_wiring->currentSelectQueryPos = $select_query_pos = 0;

                //error_log('162 req - ['.$request_serial.']['.$connection_serial.']['.$batch_key.']');
                $tmp_query_serial = $oDB_wiring->returnQuerySerial($request_serial, $connection_serial, $batch_key);
                $tmp_oQuery = $oQueryManager->returnQuery($tmp_query_serial);

                //
                // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                # $rowcount=0; CONTINUE ROWCNT FROM PREVIOUS RESULT PROCESSING
                while ($row = $result->fetch_row()) {

                    foreach($row as $field_position=>$value){
                        //
                        // STORE RESULT
                        $this->process_field_db_response_in_row($connection_serial, $request_serial, $rowcount, $field_position, $value, $tmp_oQuery);
                        //error_log("175 single SQL - row[".$rowcount."] field[".$field_position."] value[".$value."]");

                    }

                    $rowcount++;

                }

                $tmp_oQuery->updateRecordCount();

                $result->free();

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

        return NULL;

    }

    private function consume_mysqli_multi_result($request_serial, $connection_serial, $batch_key, $heavy_mysqli, $oDB_wiring, $oQueryManager){

	    try{

            //
            // FOR EACH CONNECTION...PROCESS RESULT SET
            if($heavy_mysqli->error){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN Suite :: ERROR ['.$heavy_mysqli->error.']');

            }else{

                //
                // THIS IS WHERE THE MAGIC HAPPENS. NEED TO STORE DATA EXACTLY WHERE IT NEEDS TO BE FOR LATER ACCESS.
                # $this->oQuery_ARRAY[$request_serial][$conn_serial] = $oQuery;
                $oDB_wiring->currentSelectQueryPos = $select_query_pos = 0;

                //
                // DO WE HAVE A RESULT SET?
                if($oDB_wiring->hasSelectResults($request_serial, $connection_serial, $batch_key)){

                    do {

                        $first_run = NULL;

                        if ($result = $heavy_mysqli->store_result()) {

                            while ($row = $result->fetch_row()) {

                                if(!isset($first_run)){
                                    $first_run = true;
                                    $rowcount = 0;
                                    //error_log('219 req - ['.$request_serial.']['.$connection_serial.']['.$batch_key.']');
                                    $tmp_query_serial = $oDB_wiring->returnQuerySerial($request_serial, $connection_serial, $batch_key);
                                    $tmp_oQuery = $oQueryManager->returnQuery($tmp_query_serial);
                                    //error_log('222 db req - ['.$select_query_pos.'] FIRST RECORD OF NEW SELECT DATASET - QUERY['.$tmp_oQuery->return_attribute('select_query').']');
                                }

                                foreach($row as $field_position=>$value){

                                    //
                                    // THE GOAL IS TO HAVE THIS METHOD STORE THE DATA IN A NON-LOOP-INDUCING MANNER WHERE EACH ELEMENT CAN BE ACCESSED DIRECTLY.
                                    $this->process_field_db_response_in_row($connection_serial, $request_serial, $rowcount, $field_position, $value, $tmp_oQuery);

                                }

                                $rowcount++;

                            }

                            $result->free();
                        }

                        if(!isset($tmp_oQuery)){
                            //error_log('241 req - ['.$request_serial.']['.$connection_serial.']['.$batch_key.']');
                            $tmp_query_serial = $oDB_wiring->returnQuerySerial($request_serial, $connection_serial, $batch_key);
                            $tmp_oQuery = $oQueryManager->returnQuery($tmp_query_serial);
                        }

                        $tmp_oQuery->updateRecordCount();

                        if ($heavy_mysqli->more_results()) {
                            //
                            // END OF RECORD. MORE TO FOLLOW. LET'S SMOKE TEST THIS. I HOPE IT INCREMENTS PER EACH SELECT QUERY RESULTS COMPLETION. (APPARENTLY, IT DOES)
                            // NOPE...WILL NOT ALWAYS INCREMENT...IF NO RESULTS...NO INCREMENT.
                            if(isset($first_run)){

                                $select_query_pos++;
                                $oDB_wiring->currentSelectQueryPos = $select_query_pos;
                                //error_log('298 db req - ** PROCESS NEXT SELECT DATA SET NEXT ** ['.$select_query_pos.']');

                            }

                            $first_run = false;

                        }

                    } while ($heavy_mysqli->more_results() && $heavy_mysqli->next_result());
                }
            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;

        }

        return NULL;

    }

    private function process_field_db_response_in_row($connection_serial, $request_serial, $rowcount, $field_position, $value, $oQuery){

        $oQuery->addDBResultData($rowcount, $field_position, $value);
        //error_log('332 db req - ROW/FIELD['.$rowcount.']/['.$field_position.'] VAL['.$value.']');

    }

    private function track_db_response_field_count($connection_serial, $request_serial, $rowcount, $field_position, $oDB_wiring){

        //error_log('343 db req - ** END OF ROW '.$rowcount.' @ FIELD '.$field_position.'.');

    }

    public function __destruct() {

	}
}
