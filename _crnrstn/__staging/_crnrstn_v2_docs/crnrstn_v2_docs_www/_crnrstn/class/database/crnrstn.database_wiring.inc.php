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
#  CLASS :: crnrstn_db_wiring
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 15, 2020 @ 1209hrs

class crnrstn_db_wiring{

    protected $oLogger;
    public $class_name;
    private static $oCRNRSTN_USR;

    private static $RAIL_query_wiring_serial = array();
    private static $RAIL_crnrstn_db_query_serial = array();
    private static $RAIL_connection_serial = array();
    private static $RAIL_query_MD5 = array();
    private static $RAIL_activeQuery = array();

    private static $RAIL_result_handle = array();
    private static $RAIL_batch_key = array();
    private static $RAIL_result_set_key = array();

    private static $expectResultSetQuery = array();

    private static $positionInTotal = array();
    private static $positionInSelect = array();

    protected $query = array();
    private static $mysqli = array();
    private static $queryType = array();

    public $currentSelectQueryPos;

    private static $querySerialByKey = array();

    public function __construct($oCRNRSTN_USR){

        $this->class_name = get_class();

        try {

            if(isset($oCRNRSTN_USR)){
                self::$oCRNRSTN_USR = $oCRNRSTN_USR;

                $oEnv = self::$oCRNRSTN_USR->return_oCRNRSTN_ENV();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for '.$this->class_name.' :: '.__FUNCTION__.'.');

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage());
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function hasSelectResults($request_serial, $connection_serial, $batch_key){

        if(!isset(self::$expectResultSetQuery[$request_serial][$connection_serial][$batch_key])){

            return false;

        }else{

            return true;

        }
    }

    public function returnQuerySerialByKey($request_serial, $connection_serial, $batch_key, $result_set_key){

        try{

            if(isset(self::$querySerialByKey[$request_serial][$connection_serial][$batch_key][$result_set_key])){

                return self::$querySerialByKey[$request_serial][$connection_serial][$batch_key][$result_set_key];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate the initialized query serial by key, where connection serial=['.$connection_serial.'] batch key=['.$batch_key.'] and result set key=['.$result_set_key.'].');

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

    }

    public function returnQuerySerial($request_serial, $connection_serial, $batch_key){

        try{

            if(isset(self::$expectResultSetQuery[$request_serial][$connection_serial][$batch_key][$this->currentSelectQueryPos])){

                return self::$expectResultSetQuery[$request_serial][$connection_serial][$batch_key][$this->currentSelectQueryPos];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the initialized query serial, where the connection serial=['.$connection_serial.'] and the batch key=['.$batch_key.'].');

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

    }

    public function returnConn($request_serial, $connection_serial, $batch_key){

        try{

            if(isset(self::$mysqli[$request_serial][$connection_serial][$batch_key])){

                return self::$mysqli[$request_serial][$connection_serial][$batch_key];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to return the mysqli connection, where the connection serial=['.$connection_serial.'] and the batch key=['.$batch_key.'].');

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;
        }

    }

    public function returnSQLSpooledConn($request_serial){

        try{

            if(isset($this->query[$request_serial])){

                $tmp_spooled_conn_ARRAY = array();
                $i=0;

                //
                // FOR EACH CONNECTION
                foreach($this->query[$request_serial] as $connection_serial=>$batchkeyArray){

                    //
                    // FOR EACH BATCH PER CONNECTION
                    foreach($batchkeyArray as $batch_key=>$query){

                        $tmp_spooled_conn_ARRAY[$i]['query'] = $query;
                        $tmp_spooled_conn_ARRAY[$i]['batch_key'] = $batch_key;
                        $tmp_spooled_conn_ARRAY[$i]['connection_serial'] = $connection_serial;
                        $tmp_spooled_conn_ARRAY[$i]['type'] = self::$queryType[$request_serial][$connection_serial][$batch_key];

                    }

                }

                return $tmp_spooled_conn_ARRAY;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('No database connections have been spooled for the request serial, "'.$request_serial.'".');

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function spoolRequestedQuery($oQuery, $request_serial){

        $tmp_crnrstn_db_query_serial = $oQuery->crnrstn_db_query_serial;
        $tmp_connection_serial = $oQuery->return_attribute('connection_serial');
        //$tmp_select_query = $oQuery->return_attribute('select_query');
        $tmp_batch_key = $oQuery->return_attribute('batch_key');
        $tmp_result_set_key = $oQuery->return_attribute('result_set_key');
        //$tmp_query_wiring_serial = $oQuery->return_attribute('query_wiring_serial');

        //error_log('248 wire - ['.$request_serial.']['.$tmp_connection_serial.']['.$tmp_batch_key.']['.$tmp_result_set_key.']['.$tmp_crnrstn_db_query_serial.']');
        self::$querySerialByKey[$request_serial][$tmp_connection_serial][$tmp_batch_key][$tmp_result_set_key] = $tmp_crnrstn_db_query_serial;

        if(!isset($this->query[$request_serial][$tmp_connection_serial][$tmp_batch_key])){
            //error_log('First batch query=>['.$request_serial.']['.$tmp_connection_serial.']['.$tmp_batch_key.']['.$tmp_select_query.']');
            $this->query[$request_serial][$tmp_connection_serial][$tmp_batch_key] = '';
            self::$queryType[$request_serial][$tmp_connection_serial][$tmp_batch_key] = 'single';
            self::$mysqli[$request_serial][$tmp_connection_serial][$tmp_batch_key] = $oQuery->return_attribute('mysqli');

        }else{

            //error_log('Multi batch query=>['.$request_serial.']['.$tmp_connection_serial.']['.$tmp_batch_key.']['.$tmp_select_query.']');
            self::$queryType[$request_serial][$tmp_connection_serial][$tmp_batch_key] = 'multi';

        }

        $this->query[$request_serial][$tmp_connection_serial][$tmp_batch_key] .= $oQuery->return_attribute('raw_query');

    }

    public function activateQuery($request_serial, $oQuery){

        $tmp_crnrstn_db_query_serial = $oQuery->crnrstn_db_query_serial;
        $tmp_connection_serial = $oQuery->return_attribute('connection_serial');
        $tmp_select_query = $oQuery->return_attribute('select_query');
        $tmp_batch_key = $oQuery->return_attribute('batch_key');

        //
        // TOTAL QUERY
        self::$RAIL_activeQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key][] = $tmp_crnrstn_db_query_serial;

        //
        // SELECT QUERY
        if(strlen($tmp_select_query)>0){

            if(!isset(self::$expectResultSetQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key])){

                $tmp_sel_query_cnt = 0;

            }else{

                $tmp_sel_query_cnt = sizeof(self::$expectResultSetQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key]);

            }

            self::$expectResultSetQuery[$request_serial][$tmp_connection_serial][$tmp_batch_key][] = $tmp_crnrstn_db_query_serial;
            self::$positionInSelect[$request_serial][$tmp_connection_serial][$tmp_batch_key][] = $tmp_sel_query_cnt;

        }else{

           // error_log('182 wire - die(); YEPPERS! NEED TO INIT...');
        }

    }

    public function connectQuery($oQuery){

        $tmp_query_wiring_serial = self::$oCRNRSTN_USR->generateNewKey(70);

        //
        // STORE QUERY METADATA
        return $this->wireQueryUp($tmp_query_wiring_serial, $oQuery);

    }

    private function wireQueryUp($query_wiring_serial, $oQuery){

        $tmp_current_query_count = sizeof(self::$RAIL_query_wiring_serial);

        $oQuery->load_wire_serial($query_wiring_serial);

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED.
        $tmp_crnrstn_db_query_serial = $oQuery->crnrstn_db_query_serial;
        $tmp_connection_serial = $oQuery->return_attribute('connection_serial');
        $tmp_query_MD5 = $oQuery->return_attribute('query_MD5');
        $tmp_result_handle = $oQuery->return_attribute('result_handle');
        $tmp_batch_key = $oQuery->return_attribute('batch_key');
        $tmp_result_set_key = $oQuery->return_attribute('result_set_key');

        self::$RAIL_query_wiring_serial[] = $query_wiring_serial;
        self::$RAIL_crnrstn_db_query_serial[] = $tmp_crnrstn_db_query_serial;
        self::$RAIL_connection_serial[] = $tmp_connection_serial;
        self::$RAIL_query_MD5[] = $tmp_query_MD5;

        self::$RAIL_result_handle[] = $tmp_result_handle;
        self::$RAIL_batch_key[] = $tmp_batch_key;
        self::$RAIL_result_set_key[] = $tmp_result_set_key;

        self::$positionInTotal[$tmp_connection_serial][$query_wiring_serial][] = $tmp_current_query_count;

        return $oQuery;

    }

    public function __destruct(){

    }
}