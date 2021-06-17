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
#  CLASS :: crnrstn_db_conn_handle
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 13, 2020 @ 0705hrs

class crnrstn_db_conn_handle{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $connection_serial;
    private static $oConnection;

    public function __construct($oCRNRSTN_USR){

        try {

            if(isset($oCRNRSTN_USR)){

                $oEnv = $oCRNRSTN_USR->return_oCRNRSTN_ENV();
                self::$oCRNRSTN_USR = $oCRNRSTN_USR;

                //
                // INSTANTIATE LOGGER
                //$_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_DEBUG_MODE'] = $this->debugMode;
                $tmp_log_silo_key_piped = $_SESSION['CRNRSTN_'.crc32($_SESSION['CRNRSTN_CONFIG_SERIAL'])]['CRNRSTN_ACTIVE_LOG_SILO'];
                $this->oLogger = new crnrstn_logging($oEnv->debugMode,__CLASS__, $tmp_log_silo_key_piped);

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('oCRNRSTN_USR is a required parameter for crnrstn_mysqli_handle :: __construct().');

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage());

        }

    }

    public function load_connection_serial($tmp_mysqli_serial){

        $this->connection_serial = $tmp_mysqli_serial;

    }

    public function load_connection_obj($mysqli){

        self::$oConnection = $mysqli;

    }

    public function returnConnObject($type='mysqli'){

        try{
            if(isset(self::$oConnection)){

                return self::$oConnection;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('MYSQLI database connection object not set. Unable to return on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ALERT, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }

    }

    public function returnConnSerial(){

        try{

            if(isset($this->connection_serial)){

                return $this->connection_serial;

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('MYSQLI database connection object serialization is not set. Unable to return serial for connection on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

            }


        } catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ALERT, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);

            return false;
        }


    }

    public function __destruct(){

    }
}