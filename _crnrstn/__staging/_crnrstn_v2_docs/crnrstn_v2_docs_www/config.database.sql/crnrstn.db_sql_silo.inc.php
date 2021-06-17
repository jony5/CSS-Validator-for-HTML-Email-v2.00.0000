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
# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_database_sql_silo
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 4, 2020 @ 1620hrs

class crnrstn_database_sql_silo {

    protected $oLogger;
    private static $oCRNRSTN_USR;

	public function __construct($oCRNRSTN_USR) {

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

		// 
		// INSTANTIATE LOGGER
		$this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

	}

    # $oCRNRSTN_USR->addDatabaseQuery('TRANSLATION_DATA','!jesus_is_my_dear_lord!','LANG_PACKS');
    public function returnDatabaseQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key){

        return $this->returnQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key);

    }

    private function returnQuery($oCRNRSTN_USR, $oCRNRSTN_MySQLi, $result_set_key){

        $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

        try{

            switch($result_set_key){
                case 'LANG_PACKS':
                    $query = 'SELECT `cia00_lang_packs`.`LANGPACK_ID`,
                            `cia00_lang_packs`.`LANG_ID`,
                            `cia00_lang_packs`.`NAME`,
                            `cia00_lang_packs`.`NATIVE_NAME`,
                            `cia00_lang_packs`.`NATIVE_NAME_BLOB`,
                            `cia00_lang_packs`.`ISACTIVE`,
                            `cia00_lang_packs`.`RTL_FLAG`,
                            `cia00_lang_packs`.`FONT_SIZE_PERCENTAGE`,
                            `cia00_lang_packs`.`TIMER_FONT_SIZE_PERCENTAGE`,
                            `cia00_lang_packs`.`COPY_PADDING_TOP_PX`,
                            `cia00_lang_packs`.`DATEMODIFIED`,
                            `cia00_lang_packs`.`DATECREATED`
                        FROM `cia00_lang_packs`  
                        WHERE `cia00_lang_packs`.`ISACTIVE`="1";';

                break;
                case 'NEW_OR_KEEPALIVE_SESSION':

                    $ts = $oCRNRSTN_USR->return_queryDateTimeStamp();

                    if(!$oCRNRSTN_USR->issetSessionParam('USER_ID')){

                        //
                        // THIS IS A NEW USER. GENERATE NEW USER_ID.
                        $tmp_userid = $oCRNRSTN_USR->generateNewKey(50);
                        $oCRNRSTN_USR->setSessionParam('USER_ID', $tmp_userid);

                        $query = 'INSERT INTO `sessions`
                        (`SESSIONID`,
                        `SESSIONID_CRC32`,
                        `USERID`,
                        `USERID_CRC32`,
                        `REMOTE_ADDR_IPV4`,
                        `REMOTE_ADDR_IPV6`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.session_id().'",
                        "'.crc32(session_id()).'",
                        "'.$tmp_userid.'",
                        "'.crc32($tmp_userid).'",
                        INET_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '"),
                        "'.$ts.'");
                        ';
                    }else{

                        //
                        // THIS USER SESSION IS ACTIVE. RETRIEVE USER_ID FROM SESSION.
                        $tmp_userid = $oCRNRSTN_USR->getSessionParam('USER_ID');

                        $query = 'UPDATE `sessions` SET `sessions`.`DATEMODIFIED`="'.$ts.'" 
                                WHERE `sessions`.`SESSIONID`="'.$mysqli->real_escape_string(session_id()).'" AND 
								`sessions`.`SESSIONID_CRC32`="'.crc32(session_id()).'" AND
								`sessions`.`USERID`="'.$mysqli->real_escape_string($tmp_userid).'" AND 
								`sessions`.`USERID_CRC32`="'.crc32($tmp_userid).'" LIMIT 1;';
                    }

                    //$oCRNRSTN_USR->create_AdHocVar('USER_ID', $tmp_userid);
                    //$tmp_userid = $oCRNRSTN_USR->get_AdHocVar('USER_ID');


                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('No query has been configured able to be loaded from the result set key ['.$result_set_key.'].');

                break;
            }

        }catch( Exception $e ) {

            //$this->oLogger->captureNotice('CRNRSTN :: Error Notification :: crnrstn_database_sql_silo->returnQuery() on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_NOTICE, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;
        }

        //
        // RETURN QUERY
        return $query;

    }

	public function __destruct() {
		
	}
}