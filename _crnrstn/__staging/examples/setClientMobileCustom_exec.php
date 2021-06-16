<?php
/*
// J5
// Code is Poetry */

self::$oCRNRSTN_USR->setClientMobileCustom('isWindowsMobileOS()');

$iAmWindowsMobileOS = self::$oCRNRSTN_USR->isClientTablet();

self::$oCRNRSTN_USR->resetDeviceDetect();

if($iAmWindowsMobileOS){
    //
    // MOBILE DEVICE EXPERIENCE
    $tmp_html_out .= 'Hey, I am now permanently Windows Mobile OS...and will be so until resetDeviceDetect() is called!';

}else{
    //
    // DESKTOP EXPERIENCE
    $tmp_html_out .= 'I am not Windows Mobile OS!  :(';

}