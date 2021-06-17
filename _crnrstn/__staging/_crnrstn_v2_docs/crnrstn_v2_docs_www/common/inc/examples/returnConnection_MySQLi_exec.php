<?php
/*
// J5
// Code is Poetry */

//
// PASSING TRUE ALLOWS TABLET COMPUTERS TO BE DETECTED AS MOBILE.

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// RETURN SLIGHTLY ROBUST CRNRSTN DATABASE
// CONNECTION OBJECT (MYSQLI)
$oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();

//
// TO FACILITATE QUERY PREPARATION OR ESCAPING,
// THE $mysqli CONNECTION OBJECT ITSELF CAN BE EXPOSED.
$mysqli = $oCRNRSTN_MySQLi->returnConnObject();

//
// INSTANTIATE QUERY PROFILE MANAGER
$oQueryProfileMgr = new crnrstn_query_profile_manager(self::$oCRNRSTN_USR);

$activeState = 1;
$query = 'SELECT `colors_hex`.`COLOR_ID` AS `THA_BOSS_COLORID`,
            `colors_hex`.`COLOR_HEX`,
            `colors_hex`.`COLOR_NAME`,
            `colors_hex`.`CREATOR_IP`,
            `colors_hex`.`DATECREATED` 
            FROM `colors_hex`
            WHERE `colors_hex`.`ISACTIVE` = "'.$mysqli->real_escape_string($activeState).'";';

//
// PREPARE A PROFILE FOR THE ABOVE QUERY
$oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'SYS_COLORS', 'batch-us_separately', 'NICE_COLORS');

//
// ADD QUERY PROFILE TO CRNRSTN
self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'NICE_COLORS', $query);
# NOTE ::  $query IS OPTIONAL. QUERY SQL CAN BE STORED
#          REMOTELY IN THE crnrstn_database_sql_silo CLASS.
#          SEE /config.database.sql/crnrstn.db_sql_silo.inc.php

//
// SEND THE QUERY
self::$oCRNRSTN_USR->processQuery(true);

//
// CHECK RECORD COUNT
$record_count = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'NICE_COLORS');

$tmp_html_out .= $record_count.' records have been returned.<br><br>';

for($i=0; $i<$record_count; $i++){

    $tmp_COLOR_NAME = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'NICE_COLORS', 'COLOR_NAME', $i);
    $tmp_COLOR_HEX = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'NICE_COLORS', 'COLOR_HEX', $i);

    $tmp_html_out .= $tmp_COLOR_NAME.' is artistically reflected in the HEX value, '.$tmp_COLOR_HEX.'.<br>';

}

$desired_color = 'Periwinkle Blue';
if(self::$oCRNRSTN_USR->pingValueExistence($oQueryProfileMgr, 'NICE_COLORS', 'COLOR_NAME', $desired_color)){

    $tmp_html_out .= '<br>'.$desired_color.' is in the data set!';

}else{

    $tmp_html_out .= '<br>'.$desired_color.' is <strong>NOT</strong> in the returned result data set!';

}
