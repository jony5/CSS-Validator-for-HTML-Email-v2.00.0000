<?php
/*
// J5
// Code is Poetry */

$bank_account_number = '1234567890';
$personal_preference = 'pink panties';

$accnt_num_ENCRYPTED = self::$oCRNRSTN_USR->paramTunnelEncrypt($bank_account_number, 'encrypt_key_local_override');
$personal_pref_ENCRYPTED = self::$oCRNRSTN_USR->paramTunnelEncrypt($personal_preference);

$accnt_num_DECRYPTED = self::$oCRNRSTN_USR->paramTunnelDecrypt($accnt_num_ENCRYPTED, false ,'encrypt_key_local_override');
$personal_pref_DECRYPTED = self::$oCRNRSTN_USR->paramTunnelDecrypt($personal_pref_ENCRYPTED);

//
// DON'T WORRY, YOUR INFORMATION IS UNREADABLE. ALSO, ANY
// CHANGE TO THE FOLLOWING OUTPUT STRINGS WILL CAUSE THE
// DECRYPTION ALGORITHM AT THE RECEIVING SERVER (ALSO
// RUNNING ON TOP OF CRNRSTN ;) ) TO THROW AN EXCEPTION.
$tmp_html_out .= $accnt_num_ENCRYPTED;
$tmp_html_out .= '<br>= = =<br>';
$tmp_html_out .= $personal_pref_ENCRYPTED;

$tmp_html_out .= '<br><br>';

//
// PLEASE FORGIVE ME. THIS EXPOSURE IS FOR SCIENCE AND TECHNOLOGY.
$tmp_html_out .= $accnt_num_DECRYPTED;
$tmp_html_out .= '<br>= = =<br>';
$tmp_html_out .= $personal_pref_DECRYPTED;

