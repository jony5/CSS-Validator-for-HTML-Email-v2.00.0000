<?php
/*
// J5
// Code is Poetry */

$bank_account_number = '1234567890';
$personal_preference = 'pink panties';

$accnt_num_ENCRYPTED = self::$oCRNRSTN_USR->paramTunnelEncrypt($bank_account_number, 'encrypt_key_local_override');
$personal_pref_ENCRYPTED = self::$oCRNRSTN_USR->paramTunnelEncrypt($personal_preference);

$tmp_html_out .= $accnt_num_ENCRYPTED;
$tmp_html_out .= '<br>= = =<br>';
$tmp_html_out .= $personal_pref_ENCRYPTED;
