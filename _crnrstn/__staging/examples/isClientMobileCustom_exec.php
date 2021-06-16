<?php
/*
// J5
// Code is Poetry */

//
// PASSING TRUE ALLOWS TABLET COMPUTERS TO BE DETECTED AS MOBILE.
$iAmWindowsMobileOS = self::$oCRNRSTN_USR->isClientMobile(true);

if($iAmWindowsMobileOS){
    //
    // SUCCESSFUL DEVICE MATCH
    $tmp_html_out .= 'Yay, I am Windows Mobile OS!';

}else{
    //
    // DEVICE IS NOT WINDOWS
    $tmp_html_out .= 'Sorry, friend...I am not Windows Mobile OS ;)';

}