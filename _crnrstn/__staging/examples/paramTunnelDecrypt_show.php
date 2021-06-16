<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// HERE IS SOME DATA THAT IS TO BE INJECTED INTO A COUPLE OF
// HIDDEN FIELDS IN A FORM (POST) OR APPENDED TO A LINK ON THE
// RETURNED PAGE (GET), AND WHICH *WE DO NOT WANT TO GO ACROSS
// AS CLEAR TEXT*.
$bank_account_number = '1234567890';
$personal_preference = 'pink panties';

//
// PLEASE NOTE, THE TUNNEL ENCRYPT KEY CAN BE MANAGED GLOBALLY
// IN THE CRNRSTN CONFIG FILE FOR THE ENTIRE APPLICATION AND
// OVERRIDDEN LOCALLY AT FUNCTION CALL ACCORDING TO THE NEED
// OF THE APPLICATION.
$accnt_num_ENCRYPTED = $oCRNRSTN_USR->paramTunnelEncrypt($bank_account_number,'encrypt_key_local_override');
$personal_pref_ENCRYPTED = $oCRNRSTN_USR->paramTunnelEncrypt($personal_preference);

$accnt_num_DECRYPTED = $oCRNRSTN_USR->paramTunnelDecrypt($accnt_num_ENCRYPTED, false ,'encrypt_key_local_override');
$personal_pref_DECRYPTED = $oCRNRSTN_USR->paramTunnelDecrypt($personal_pref_ENCRYPTED);

//
// DON'T WORRY, YOUR INFORMATION IS UNREADABLE. ALSO, ANY
// CHANGE TO THE FOLLOWING OUTPUT STRINGS WILL CAUSE THE
// DECRYPTION ALGORITHM AT THE RECEIVING SERVER (ALSO
// RUNNING ON TOP OF CRNRSTN ;) ) TO THROW AN EXCEPTION.
echo $accnt_num_ENCRYPTED;
echo '<br>= = =<br>';
echo $personal_pref_ENCRYPTED;

echo '<br><br>';

//
// PLEASE FORGIVE ME. THIS EXPOSURE IS FOR SCIENCE AND TECHNOLOGY.
echo $accnt_num_DECRYPTED;
echo '<br>= = =<br>';
echo $personal_pref_DECRYPTED;


?>