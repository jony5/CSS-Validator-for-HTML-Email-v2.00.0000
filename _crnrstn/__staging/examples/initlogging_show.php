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

//
// AFTER THE INITIALIZATION OF CRNRSTN ::, IT CAN BE ELECTED TO CUSTOMIZE
// THE ERROR HANDLING BEHAVIOR OF EACH ENVIRONMENT RUNNING THE APPLICATION.
// IF NOTHING IS DONE, THE ERROR HANDLING SET ABOVE WILL BE PERSISTED.
$oCRNRSTN->set_CRNRSTN_asErrorHandler('BLUEHOST', true, E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('CYEXX_SOLUTIONS', true, E_ALL & ~E_DEPRECATED & ~E_STRICT);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('LOCALHOST_MACBOOKTERMINAL', true, E_ALL & ~E_NOTICE);
$oCRNRSTN->set_CRNRSTN_asErrorHandler('LOCALHOST_MACBOOKPRO'); // WILL PERSIST THE ERROR PROFILE SET BY init_CRNRSTN_asErrorHandler()

//
// HTML EMAIL CREATIVE PROFILE
$oCRNRSTN->initSystemNoticesImagesMode('ALL_HTML');

//
// HTML EMAIL IMAGES DIRECTORY FOR PUBLIC IP IMAGE HOSTING
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('BLUEHOST', 'http://v2.crnrstn.evifweb.com/_crnrstn/creative/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('CYEXX_SOLUTIONS', 'http://v2.crnrstn.evifweb.com/_crnrstn/creative/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('LOCALHOST_MACBOOKTERMINAL', 'http://v2.crnrstn.evifweb.com/_crnrstn/creative/');
$oCRNRSTN->initSystemNotices_imgHTTP_DIR('LOCALHOST_MACBOOKPRO', 'http://v2.crnrstn.evifweb.com/_crnrstn/creative/');

//
// COMPLEX (n+1 PARAMETER) OR SENSITIVE (USERNAME/PASSWORD) RESOURCE INCLUDES
$oCRNRSTN->initResourceWildCards('BLUEHOST', '/home3/evifwebc/public_html/v2.crnrstn.evifweb/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('CYEXX_SOLUTIONS', '/home2/jony5/crnrstn.v2.jony5.com/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('LOCALHOST_MACBOOKTERMINAL', '/var/www/html/crnrstn_v2/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('LOCALHOST_MACBOOKPRO', '/var/www/html/crnrstn_v2/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');

//
// CONFIGURATION OF LOGGING PROFILES
$oCRNRSTN->initLogging('BLUEHOST', 'EMAIL|DEFAULT|FILE|SCREEN_HTML_HIDDEN', 'email01@email.com, firstname lastname email02@email.com, email03@email.com||/var/www/html/_debug_output/error.log|','CRNRSTN_SMTP_COMM_PROFILE|||');
$oCRNRSTN->initLogging('CYEXX_SOLUTIONS', 'EMAIL', 'email01@email.com, firstname lastname email02@email.com', 'CRNRSTN_SMTP_COMM_PROFILE');
$oCRNRSTN->initLogging('LOCALHOST_MACBOOKTERMINAL', 'FILE', '/var/www/html/_debug_output/error.log');
$oCRNRSTN->initLogging('LOCALHOST_MACBOOKPRO');     // PHP NATIVE ERROR_LOG() ONLY ON EXCEPTIONS, UNLESS $CRNRSTN_debugMode=1 OR 2



?>