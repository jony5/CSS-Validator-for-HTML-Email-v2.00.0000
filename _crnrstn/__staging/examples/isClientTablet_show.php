<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASSING TRUE ALLOWS MOBILE DEVICES TO BE DETECTED AS TABLET.
$iAmTablet = $oCRNRSTN_USR->isClientTablet();

if($iAmTablet){
    //
    // TABLET DEVICE EXPERIENCE
    echo 'I am a tablet!';

}else{
    //
    // DESKTOP (OR EVEN MOBILE, FOR THIS EXAMPLE) EXPERIENCE
    echo 'I am not a tablet!';

}

?>