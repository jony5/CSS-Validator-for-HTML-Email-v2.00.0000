<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// INSTANTIATE DATABASE INTEGRATION
$oData = new database_integration();

//
// BRING IN THE MESSENGER
// Luke 1:19, 26; Daniel 8:16; 9:21-22
$oGabriel = new messenger_from_north($oData, $oUSER, $oCRNRSTN_ENV);

//
// LOAD SYSTEM NOTIFICATIONS
$oGabriel->retrieve_primitive_scroll();

if($oGabriel->has_primitive_scroll()){

    error_log("sys_notice (23) We have scroll notification data.");

    //
    // BUILD PROPER NOTIFICATIONS
    $oGabriel->build_notification_scroll();

    //
    // PROCESS NEW SCROLL
    $oGabriel->process_scroll();

}
