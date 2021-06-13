<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$iAmWindowsMobileOS = $oCRNRSTN_USR->isClientMobileCustom('isWindowsMobileOS()');

if($iAmWindowsMobileOS){
    //
    // SUCCESSFUL DEVICE MATCH
    echo 'Yay, I am Windows Mobile OS!';

}else{
    //
    // NO DEVICE MATCH
    echo 'Sorry, friend...I am not Windows Mobile OS ;)';

}

?>