<?php
/*
// J5
// Code is Poetry */

//
// PASSING TRUE ALLOWS MOBILE DEVICES TO BE DETECTED AS TABLET.
$iAmTablet = self::$oCRNRSTN_USR->isClientTablet();

if($iAmTablet!=''){
    //
    // TABLET DEVICE EXPERIENCE
    $tmp_html_out .= 'I am a tablet!';

}else{
    //
    // DESKTOP (OR MOBILE, FOR THIS EXAMPLE) EXPERIENCE
    $tmp_html_out .= 'I am not a tablet!';

}