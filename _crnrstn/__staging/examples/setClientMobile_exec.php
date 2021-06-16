<?php
/*
// J5
// Code is Poetry */

self::$oCRNRSTN_USR->setClientMobile();

$iAmMobile = self::$oCRNRSTN_USR->isClientMobile();

self::$oCRNRSTN_USR->resetDeviceDetect();

if($iAmMobile){
    //
    // MOBILE DEVICE EXPERIENCE
    $tmp_html_out .= 'Hey, I am now permanently mobile...and will be so until resetDeviceDetect() is called!';

}else{
    //
    // DESKTOP EXPERIENCE
    $tmp_html_out .= 'I am not mobile!';

}