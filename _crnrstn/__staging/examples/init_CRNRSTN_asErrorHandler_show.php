<?php
/*
// J5
// Code is Poetry */
if ( ! session_id() ) @ session_start();
require( dirname( __FILE__ ) . '/_crnrstn.root.inc.php' );

//
// CRNRSTN Suite :: CLASS DEFINITIONS
require( $CRNRSTN_ROOT . '/_crnrstn/_crnrstn.classdefinitions.inc.php' );

$CRNRSTN_debugMode = 0;
$PHPMAILER_debugMode = 0;   # !! NEVER PROMOTE 4 TO PRODUCTION IP !! BEST NOT TO USE 4 AT ALL...imho.
$CRNRSTN_config_serialization = 'hertyea420dwlR42h3';
$CRNRSTN_log_silo_key_piped = '*';

//
// INSTANTIATE AN INSTANCE OF CRNRSTN ::
$oCRNRSTN = new crnrstn(__FILE__, $CRNRSTN_config_serialization, $CRNRSTN_debugMode, $PHPMAILER_debugMode, $CRNRSTN_log_silo_key_piped);

//
// ADD ALL ENVIRONMENTS THAT WILL BE RUNNING THIS APPLICATION
// TEAM DEV PROJECTS WARRANT A LINE FOR EVERY UNIQUE LOCALHOST ENV
$oCRNRSTN->addEnvironment('BLUEHOST', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('CYEXX_SOLUTIONS', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('LOCALHOST_MACBOOKTERMINAL', E_ALL);
$oCRNRSTN->addEnvironment('LOCALHOST_MACBOOKPRO', E_ALL);

//
// BELOW, THE CRNRSTN :: CONFIGURATION & ENVIRONMENTAL DETECTION PROCESS
// IS SET TO HANDLE ALL ERROR LEVEL CONSTANTS EXCEPT E_USER_DEPRECATED.
// PHP NATIVE WILL HANDLE THE E_USER_DEPRECATED ERROR LEVEL CONSTANT.
$oCRNRSTN->init_CRNRSTN_asErrorHandler(true, ~E_USER_DEPRECATED);



?>