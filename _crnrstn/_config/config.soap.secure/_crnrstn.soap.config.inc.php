<?php
//
// INITIALIZE RESOURCE AUTHORIZATION PROFILE FOR CRNRSTN :: SOAP SERVICES LAYER

$CRNRSTN_NUSOAP_SVC_debugMode = false;
$oSOAP_access_manager = new crnrstn_soap_services_access_manager('BLUEHOST', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('BLUEHOST', 'AES-192-OFB', 'for_a_stra12345678the_soap-encrypti0n-key', 'sha256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_MACBOOKTERMINAL',$CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_MACBOOKTERMINAL', 'AES-256-CTR', 'for_a_stranger-this-3456765oap-encrypt444n-key', 'ripemd256', OPENSSL_RAW_DATA);

//
// CREATE AND CONFIGURE SINGLE/GROUP ACCESS AUTHORIZATION KEY(S) - LOCALHOST_MACBOOKTERMINAL
$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('BLUEHOST', '*---TRM');
$oAuth_single->update_permissions('FTP|FILE|DEFAULT|EMAIL');
$oAuth_single->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
$oAuth_single->IP_exclusiveAccess('111.111.110.*');
$oAuth_single->IP_denyAccess('111.111.111.112');
$oAuth_single->override_soap_encryption_config('AES-256-CTR', 'this-Is-the_soap-3ncrypti0n-key-for_an_outsider', 'ripemd256', OPENSSL_RAW_DATA);
$oAuth_single->override_soap_encryption_config('AES-192-OFB', 'this-Is-the_soap-3ncrypti0n-key-for_an_outsider', 'sha256', OPENSSL_RAW_DATA);

$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', '4k4;2kl;k;k4j3o4ouotjkl;0TN:nrtjkljl433jlwuO~u}DI2FKP');
$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';1;0TN:nrtjkljl433Bza?!#btjkljlLQf{wc$1k$;cs=fFO~u}DI2FKP', $oAuth_group);
$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';TN:nn8Q{U0P;0TN:nrtjkljl433ljlQf{wc$1k$;cs=fFO~u}DI2FKP', $oAuth_group);
$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';3TN:nn8Q{eqwqweT34T43U0Ptjkljlvbduy|D>rre;0TN:nrtjkljl433', $oAuth_group);
$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';4TU3U4422jJLJoi9U8u99ji=fFO;0TN:nrtjkljl433P', $oAuth_group);

$oAuth_group->update_permissions('FTP|FILE|EMAIL|DEFAULT|ELECTRUM');
//$oAuth_group->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
$oAuth_group->IP_exclusiveAccess('111.111.111.*');
//$oAuth_group->IP_denyAccess('172.16.* - 172.16.195.131, 172.16.195.132 - 172.16.*');
//$oAuth_group->override_soap_encryption_config('AES-192-OFB', 'this-Is-the_soap-3ncrypti0n-key-for_an_outsider', 'sha256', OPENSSL_RAW_DATA);
$oAuth_group->override_soap_encryption_config('aes256', 'this-Is-the_soap-3ncrypti0n-key-for_an_outsider', 'fnv1a32', OPENSSL_RAW_DATA);

$CRNRSTN_NUSOAP_SVC_debugMode = true;

//
// ADD USER ACCOUNT - LOCALHOST_MACBOOKTERMINAL
$oClient_044 = $oSOAP_access_manager->addClient('LOCALHOST_MACBOOKTERMINAL', '044390840840844240', 'jkl#3j232^^#ljrl$%', $CRNRSTN_NUSOAP_SVC_debugMode);

$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un00737289745665293879240', 'password123bvdffg');
$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un01737289745665293879240', 'password123frettn', $oClient_group_007);
$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', '00737289745665293879240', 'password123wr4t4t', $oClient_group_007, $CRNRSTN_NUSOAP_SVC_debugMode);
$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un03737289745665293879240', 'password123dadggh', $oClient_group_007);
$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un04737289745665293879240', 'password123wqewed', $oClient_group_007);

$oClient_044->update_permissions('*');
$oClient_group_007->update_permissions('EMAIL|FTP|FILE|DEFAULT|ELECTRUM');
$oClient_group_007->override_soap_encryption_config('AES-192-OFB', 'hi, this-Is-the_soap-encrypti0n-key-for_a_group of _outsiders', 'sha256', OPENSSL_RAW_DATA);
$oClient_044->override_soap_encryption_config('AES-192-OFB', 'hi, this-Is-the_soap-encrypti0n-key-for_an_outsider', 'sha256', OPENSSL_RAW_DATA);

$oClient_044->activate_SOAP_method('*');
$oClient_group_007->activate_SOAP_method('mayItakeTheKingsHighway');
$oClient_group_007->activate_SOAP_method('takeTheKingsHighway');
$oClient_group_007->deactivate_SOAP_method('sendElectrumPerformanceReport');
$oClient_group_007->IP_exclusiveAccess('111.111.111.111');
$oClient_044->IP_denyAccess('111.111.111.112');
$oClient_044->IP_exclusiveAccess('111.111.111.10');