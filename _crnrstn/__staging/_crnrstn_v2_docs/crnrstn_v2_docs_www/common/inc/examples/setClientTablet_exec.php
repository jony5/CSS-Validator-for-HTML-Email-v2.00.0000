<?php
/*
// J5
// Code is Poetry */

self::$oCRNRSTN_USR->setClientTablet();

$iAmTablet = self::$oCRNRSTN_USR->isClientTablet();

self::$oCRNRSTN_USR->resetDeviceDetect();

if($iAmTablet){
    //
    // MOBILE DEVICE EXPERIENCE
    $tmp_html_out .= 'Hey, I am now permanently tablet...and will be so until resetDeviceDetect() is called!';

}else{
    //
    // DESKTOP EXPERIENCE
    $tmp_html_out .= 'I am not tablet!';

}