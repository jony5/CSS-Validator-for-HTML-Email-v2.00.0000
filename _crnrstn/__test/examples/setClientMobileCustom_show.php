<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// FORCE WINDOWS MOBILE OS PROFILE TO SESSION
$tmp = $oCRNRSTN_USR->setClientMobileCustom('isWindowsMobileOS()');

//
// LET'S CHECK TO SEE IF THE USER IS WINDOWS MOBILE OS.
// YES, WE FORCED THIS WITH setClientMobileCustom() ON
// LINE 10 ABOVE.
$iAmWindowsMobileOS = $oCRNRSTN_USR->isClientMobileCustom('isWindowsMobileOS()');

//
// MUST CALL resetDeviceDetect() RIGHT NOW...OR YA'LL
// WILL NEVER SEE THE DESKTOP VERSION OF THIS PAGE! SERIOUSLY!
$oCRNRSTN_USR->resetDeviceDetect();

//
// NOW TO SUPPORT MOBILE/TABLET DEVICES ON THIS DOCUMENTATION
// WEB SITE...GENUINELY. AGAIN, IF I DON'T CALL THE FOLLOWING
// METHOD, THEN MOBILE/TABLET DEVICES WILL BE FORCED TO GET
// DESKTOP 100% OF THE TIME ON THIS DOCUMENTATION PAGE.
// SERIOUSLY!
$tmp = $oCRNRSTN_USR->isClientTablet(true);

if($iAmWindowsMobileOS){
    //
    // TABLET DEVICE EXPERIENCE
    echo 'Hey, I am now permanently Windows Mobile OS...and will be so until resetDeviceDetect() is called!';

}else{
    //
    // DESKTOP EXPERIENCE. THIS WILL NEVER RUN,YO.
    // WE BRUTE FORCED WINDOWS MOBILE OS PROFILE
    // ON LINE 10 ABOVE. YOU WILL BE WINDOWS!  ;)
    echo 'I am not Windows Mobile OS!  :(';

}

?>