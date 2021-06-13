<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// FORCE MOBILE DEVICE PROFILE TO SESSION
$tmp = $oCRNRSTN_USR->setClientMobile();

//
// LET'S CHECK TO SEE IF THE USER IS MOBILE. YES, WE
// FORCED THIS WITH setClientMobile() ON LINE 10 ABOVE.
$iAmMobile = $oCRNRSTN_USR->isClientMobile();

//
// MUST CALL resetDeviceDetect() RIGHT NOW...OR YA'LL
// WILL NEVER SEE THE DESKTOP VERSION OF THIS PAGE! SERIOUSLY!
$oCRNRSTN_USR->resetDeviceDetect();

//
// NOW TO SUPPORT MOBILE DEVICES ON THIS DOCUMENTATION WEB
// SITE...GENUINELY. AGAIN, IF I DON'T CALL THE FOLLOWING
// METHOD, THEN MOBILE DEVICES WILL BE FORCED TO GET
// DESKTOP 100% OF THE TIME ON THIS DOCUMENTATION PAGE.
// SERIOUSLY!
$tmp = $oCRNRSTN_USR->isClientMobile(true);

if($iAmMobile){
    //
    // MOBILE DEVICE EXPERIENCE
    echo 'Hey, I am now permanently mobile...and will be so until resetDeviceDetect() is called!';

}else{
    //
    // DESKTOP EXPERIENCE. THIS WILL NEVER RUN,YO.
    // WE BRUTE FORCED MOBILE PROFILE ON LINE 10 ABOVE.
    // YOU WILL BE MOBILE!  ;)
    echo 'I am not mobile!';

}

?>