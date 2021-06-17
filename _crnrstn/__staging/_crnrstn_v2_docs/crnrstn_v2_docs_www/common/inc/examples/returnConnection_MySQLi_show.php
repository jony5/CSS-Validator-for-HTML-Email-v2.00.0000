<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// RETURN SLIGHTLY ROBUST CRNRSTN DATABASE
// CONNECTION OBJECT (MYSQLI)
$oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();

//
// TO FACILITATE QUERY PREPARATION OR ESCAPING,
// THE $mysqli CONNECTION OBJECT ITSELF CAN BE EXPOSED.
$mysqli = $oCRNRSTN_MySQLi->returnConnObject();

//
// INSTANTIATE QUERY PROFILE MANAGER
$oQueryProfileMgr = new crnrstn_query_profile_manager($oCRNRSTN_USR);

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
$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'NICE_COLORS', $query);
# NOTE ::  $query IS OPTIONAL. QUERY SQL CAN BE STORED
#          REMOTELY IN THE crnrstn_database_sql_silo CLASS.
#          SEE /config.database.sql/crnrstn.db_sql_silo.inc.php

//
// SEND THE QUERY
$oCRNRSTN_USR->processQuery(true);

//
// CHECK MYSQLI RESULT RECORD COUNT
$record_count = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'NICE_COLORS');

echo $record_count.' records have been returned.<br>';

//
// EXPOSE RESULT RECORD SET FIELDS DATA VIA
// A TRADITIONAL FOR LOOP
for($i=0; $i<$record_count; $i++){

    $tmp_COLOR_NAME = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'NICE_COLORS', 'COLOR_NAME', $i);
    $tmp_COLOR_HEX = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'NICE_COLORS', 'COLOR_HEX', $i);

    echo $tmp_COLOR_NAME.' is artistically reflected in the HEX value, '.$tmp_COLOR_HEX.'.<br>';

}

$desired_color = 'Periwinkle Blue';
if($oCRNRSTN_USR->pingValueExistence($oQueryProfileMgr, 'NICE_COLORS', 'COLOR_NAME', $desired_color)){

    echo $desired_color.' is in the data set!<br>';

}else{

    echo $desired_color.' is <strong>NOT</strong> in the data set!<br>';

}

?>