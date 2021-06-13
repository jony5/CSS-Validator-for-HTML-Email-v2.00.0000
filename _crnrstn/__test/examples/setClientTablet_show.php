<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// FORCE TABLET COMPUTER PROFILE TO SESSION
$tmp = $oCRNRSTN_USR->setClientTablet();

//
// LET'S CHECK TO SEE IF THE USER IS TABLET. YES, WE
// FORCED THIS WITH setClientTablet() ON LINE 10 ABOVE.
$iAmTablet = $oCRNRSTN_USR->isClientTablet();

//
// MUST CALL resetDeviceDetect() RIGHT NOW...OR YA'LL
// WILL NEVER SEE THE DESKTOP VERSION OF THIS PAGE! SERIOUSLY!
$oCRNRSTN_USR->resetDeviceDetect();

//
// NOW TO SUPPORT MOBILE/TABLET DEVICES ON THIS DOCUMENTATION
// WEB SITE...GENUINELY. AGAIN, IF I DON'T CALL THE FOLLOWING
// METHOD, THEN TABLET DEVICES WILL BE FORCED TO GET
// DESKTOP 100% OF THE TIME ON THIS DOCUMENTATION PAGE.
// SERIOUSLY!
$tmp = $oCRNRSTN_USR->isClientTablet(true);

if($iAmTablet){
    //
    // TABLET DEVICE EXPERIENCE
    echo 'Hey, I am now permanently tablet...and will be so until resetDeviceDetect() is called!';

}else{
    //
    // DESKTOP EXPERIENCE. THIS WILL NEVER RUN,YO.
    // WE BRUTE FORCED TABLET PROFILE ON LINE 10 ABOVE.
    // YOU WILL BE TABLET!  ;)
    echo 'I am not tablet!';

}

?>