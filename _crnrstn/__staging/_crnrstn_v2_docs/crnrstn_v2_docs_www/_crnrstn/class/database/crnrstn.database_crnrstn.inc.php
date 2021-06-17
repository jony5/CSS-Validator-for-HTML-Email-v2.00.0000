<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2020 eVifweb development
#  VERSION :: 2.0.0 :: Sat July 4, 2020 at 1259
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.v2.jony5.com/
# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_database_crnrstn
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 13, 2020 @ 0448hrs

class crnrstn_database_crnrstn {

    private static $oCRNRSTN_USR;
    protected $oLogger;
    private static $oEnv;
    private static $oQueryManager;
    private static $oDB_wiring;

    public $crnrstn_db_crnrstn_serial;

    public function __construct($oCRNRSTN_USR=NULL) {

        try{

            if(isset($oCRNRSTN_USR)){

                self::$oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // SERIALIZE OBJECT - LEN32
                $this->crnrstn_db_crnrstn_serial = self::$oCRNRSTN_USR->generateNewKey();

                //
                // HOLD ENVIRONMENTALS
                self::$oEnv = self::$oCRNRSTN_USR->return_oCRNRSTN_ENV();

                //
                // INSTANTIATE LOGGER
                $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

                //
                // INSTANTIATE DB WIRING
                self::$oDB_wiring = new crnrstn_db_wiring(self::$oCRNRSTN_USR);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('ERR :: oCRNRSTN_USR is a required parameter for '.__CLASS__.' :: '.__FUNCTION__.'.');

            }

            //
            // INSTANTIATE QUERY MANAGER
            self::$oQueryManager = new crnrstn_query_manager(self::$oCRNRSTN_USR);

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage());
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
        }

    }

    public function returnDatabaseValue($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos){

        return self::$oQueryManager->returnDatabaseValue(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $pos);

    }

    public function resultSetMerge($oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped){

        return self::$oQueryManager->resultSetMerge(self::$oDB_wiring, $oQueryProfileMgr, $result_handle, $batch_key, $result_set_key, $target_result_set_key, $merge_fields_piped, $merge_fields_distinct_val, $sequence_fields_piped, $sequence_fields_datatype_piped);

    }

    public function pingValueExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value){

        return self::$oQueryManager->pingValueExistence(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $fieldname, $value);

    }

    public function pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        return self::$oQueryManager->pingProfileExistence($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

    }

    public function returnRecordCount($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        return self::$oQueryManager->returnRecordCount(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

    }

    public function loadPreviousRecordLookup($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_serial){

        self::$oQueryManager->loadPreviousRecordLookup(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $lookup_serial);

    }

    public function initLookupByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key){

        self::$oQueryManager->initLookupByID(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key);

    }

    public function addLookupFieldData($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value){

        return self::$oQueryManager->addLookupFieldData(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $field_name, $field_value);

    }

    public function keyDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields){

        self::$oQueryManager->keyDataByID(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_primary_id_fields);

    }

    public function retrieveDataByID($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data){

        return self::$oQueryManager->retrieveDataByID(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $piped_lookup_fieldname, $piped_lookup_id_data);

    }

    public function processQuery($request_serial){

        //
        // DO WE HAVE ANY SUBSET TO CONSIDER?
        if(self::$oQueryManager->queueValidQuery($request_serial, self::$oDB_wiring)){

            //
            // SEND TO DATABASE
            return self::$oQueryManager->sendQuery($request_serial, self::$oDB_wiring);

        }

        return true;

    }

    public function load_databaseQuery($oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query){

        //
        // LOAD QUERY OBJECT INTO QUERY MANAGER
        return self::$oQueryManager->load_databaseQuery(self::$oDB_wiring, $oCRNRSTN_MySQLi, $result_handle, $batch_key, $result_set_key, $query);

    }

    public function receive_processQueryParam($key, $val, $request_serial){

        //
        // RECEIVE ANY RESTRICTIONS TO THE PROCESSING OF ALL (100%) QUERY AVAILABLE FOR
        // DIRECT SUBSET ACQUISITION.

        try{

            switch($key){
                case 'sql_accelerate_FLAG':
                case 'oCRNRSTN_MySQLi':
                case 'batch_key':
                case 'result_set_key':
                case 'result_handle':
                case 'query_override':
                    self::$oQueryManager->receive_processQueryParam($key, $val, $request_serial);
                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown key provided as parameter reference to oCRNRSTN_USR->processQuery() meta-data '.__CLASS__.' :: '.__FUNCTION__.'.');

                break;
            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
        }

    }

    public function __destruct() {

    }

}