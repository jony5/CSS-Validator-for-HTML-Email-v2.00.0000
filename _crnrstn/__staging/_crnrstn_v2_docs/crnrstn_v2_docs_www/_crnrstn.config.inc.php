<?php
/**
* @package CRNRSTN
// J5
// Code is Poetry
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2020 eVifweb development
#  VERSION :: 2.0.0 on Saturday July 4, 2020 @ 1620hrs
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
*/# # C # R # N # R # S # T # N # # : : # #

if ( ! session_id() ) @ session_start();
require( dirname( __FILE__ ) . '/_crnrstn.root.inc.php' );

//
// CRNRSTN Suite :: CLASS DEFINITIONS
require( $CRNRSTN_ROOT . '/_crnrstn/_crnrstn.classdefinitions.inc.php' );

//
// INSTANTIATE AN INSTANCE OF CRNRSTN BY PASSING A SERIALIZATION KEY FOR THIS CONFIG FILE.
/**
    $CRNRSTN_debugMode ::
    # $debugMode = 0
    * LOGGING OFF
    * MINIMAL MEMORY AND PROCESSING OVERHEAD

    # $debugMode = 1
    * REAL-TIME FULL LOG TRACE ERROR_LOG() OUTPUT
    * LOG SILOS IGNORED UNLESS SPECIFIED TO CRNRSTN CONSTRUCTOR
    * MINIMAL MEMORY OVERHEAD WITH SOME PROCESSING

    # $debugMode = 2
    * 100% LOG TRACE ROLLING AGGREGATION
    * ACCESS TO AGGREGATED (AND ALWAYS LINEARLY SPLICED VIA POINTER DRIVEN
    OUTPUT ASSEMBLY WITH RESPECT TO CHRONOLOGICALLY COLLECTED METADATA) LOG DATA
    TRACE FOR ANY PIPED LOG SILO KEY/KEYS PASSED TO CALL OF get_errorLogTrace() OR
    INCLUDED IN PIPED SILO WATCH STRING PASSED INTO CRNRSTN CONSTRUCTOR
    * MAXIMUM MEMORY AND PROCESSING OVERHEAD

*/
$CRNRSTN_debugMode = 2;

/**
 * PHPMAILER_debugMode ::
 * PHPMAILER Debug output level.
 * Options:
 * * self::DEBUG_OFF (`0`) No debug output, default
 * * self::DEBUG_CLIENT (`1`) Client commands
 * * self::DEBUG_SERVER (`2`) Client commands and server responses
 * * self::DEBUG_CONNECTION (`3`) As DEBUG_SERVER plus connection status
 * * self::DEBUG_LOWLEVEL (`4`) Low-level data output, all messages (including exposure of usernames and passwords!!)
 *
 * @var int
 */
$PHPMAILER_debugMode = 0;

$serial = 'hertyeedwlR42h3';
// CRNRSTN_oELECTRUM 'CRNRSTN_oELECTRUM|CRNRSTN_oELECTRUM_EXEC|CRNRSTN_oELECTRUM_TRANSFER'  CRNRSTN_oELECTRUM_TRANSFER CRNRSTN_oELECTRUM_WHEEL CRNRSTN_oELECTRUM_COMM
$oCRNRSTN = new crnrstn($serial, $CRNRSTN_debugMode, $PHPMAILER_debugMode);

//
// HIGH LEVEL AND GLOBAL (ALL ENVIRONMENTS) CUSTOM EXCEPTION HANDLER
$oCRNRSTN->crnrstn_error_ownership(false);

##
# REFERENCE OF ERROR LEVEL CONSTANTS
# http://php.net/error-reporting
/*
The error level constants are always available as part of the PHP core.
; E_ALL             - All errors and warnings (includes E_STRICT as of PHP 6.0.0)
; E_ERROR           - fatal run-time errors
; E_RECOVERABLE_ERROR  - almost fatal run-time errors
; E_WARNING         - run-time warnings (non-fatal errors)
; E_PARSE           - compile-time parse errors
; E_NOTICE          - run-time notices (these are warnings which often result
;                     from a bug in your code, but it's possible that it was
;                     intentional (e.g., using an uninitialized variable and
;                     relying on the fact it's automatically initialized to an
;                     empty string)
; E_STRICT          - run-time notices, enable to have PHP suggest changes
;                     to your code which will ensure the best interoperability
;                     and forward compatibility of your code
; E_CORE_ERROR      - fatal errors that occur during PHP's initial startup
; E_CORE_WARNING    - warnings (non-fatal errors) that occur during PHP's
;                     initial startup
; E_COMPILE_ERROR   - fatal compile-time errors
; E_COMPILE_WARNING - compile-time warnings (non-fatal errors)
; E_USER_ERROR      - user-generated error message
; E_USER_WARNING    - user-generated warning message
; E_USER_NOTICE     - user-generated notice message
; E_DEPRECATED      - warn about code that will not work in future versions
;                     of PHP
; E_USER_DEPRECATED - user-generated deprecation warnings

; Common Values for error reporting:
;   	E_ALL (Show all errors, warnings and notices including coding standards.)
;   	E_ALL & ~E_NOTICE  (Show all errors, except for notices)
;   	E_ALL & ~E_NOTICE & ~E_STRICT  (Show all errors, except for notices and coding standards warnings.)
;   	E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR  (Show only errors)
;
; Default Value: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
; Development Value: E_ALL
; Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT
*/

# INITIALIZE A KEY + ERROR REPORTING FOR EACH APPLICATION DEV/HOSTING ENVIRONMENT ::
# PARAMETER 1 [environment-key] = A KEY TO REPRESENT EACH ENVIRONMENT THAT WILL RUN THIS INSTANTIATION OF CRNRSTN
# PARAMETER 2 [error-reporting-constants] = ERROR REPORTING PROFILE
#
# $oCRNRSTN->addEnvironment([environment-key], [error-reporting-constants]);
//$oCRNRSTN->addEnvironment('LOCALHOST_PC', E_ERROR);
$oCRNRSTN->addEnvironment('BLUEHOST', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('CYEXX_SYSTEMS', E_ALL & ~E_NOTICE & ~E_STRICT);
$oCRNRSTN->addEnvironment('LOCALHOST_MAC', E_ALL);
$oCRNRSTN->addEnvironment('LOCALHOST_PRO', E_ALL);


//
// INITIALIZE SENSITIVE "WILDCARD" RESOURCES RELEVANT TO EACH ENVIRONMENT ABOVE
# $oCRNRSTN->initResourceWildCards([environment-key], [path-to-db-resource-wildcard-definition-file]);
#$oCRNRSTN->initResourceWildCards('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.resource_wildcards.secure//_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('LOCALHOST_MAC', '/var/www/html/crnrstn_v2/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('LOCALHOST_PRO', '/var/www/html/crnrstn_v2/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('CYEXX_SYSTEMS', '/home2/jony5/crnrstn.v2.jony5.com/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');
$oCRNRSTN->initResourceWildCards('BLUEHOST', '/home3/evifwebc/public_html/v2.crnrstn.evifweb/config.resource_wildcards.secure/_crnrstn.resource_wildcards.inc.php');

//
// INITIALIZE LOGGING FUNCTIONALITY FOR EACH ENVIRONMENT. IF NULL OR UNDEFINED, WILL LOG TO SCREEN.
# $oCRNRSTN->initLogging([environment-key], [logging-constant], [additional-logging-parameters]);
#
# CRNRSTN LOGGING CONSTANTS FOR INITIALIZATION = [EMAIL, FILE, SCREEN_TEXT, SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
# e.g. LOGGING TO SCREEN
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'SCREEN');

# e.g. LOGGING TO EMAIL
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'EMAIL', 'email_one@address.com, email_two@address.com, email_n@address.com');

# e.g. LOGGING TO FILE
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'DEFAULT');					// SYSTEM DEFAULT FILE LOGGING
# $oCRNRSTN->initLogging('000WEBHOSTJONY5', 'FILE', '/var/logFolder');	// INCLUDE PATH TO DIRECTORY FOR CUSTOM LOG FILE

#[DATABASE, EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
$oCRNRSTN->initLogging('BLUEHOST', 'EMAIL|DEFAULT|FILE|SCREEN','EMAIL@DOMAIN.com,EMAIL@DOMAIN.com,jharris@evifweb.com||/var/www/html/_debug_output/error.log|','CRNRSTN_SMTP_COMM_PROFILE|||');
//$oCRNRSTN->initLogging('BLUEHOST', 'EMAIL','j5@DOMAIN.com', 'CRNRSTN_SMTP_COMM_PROFILE');
$oCRNRSTN->initLogging('CYEXX_SYSTEMS', 'EMAIL','j5@DOMAIN.com');				// SYSTEM DEFAULT ERROR LOGGING
#$oCRNRSTN->initLogging('LOCALHOST_PC', 'EMAIL','email1@domain.com,email2@domain.com');	// EMAIL LOG INFO TO LIST OF COMMA DELIMITED EMAIL ACCOUNTS
#$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE','/var/log/customlogs/crnrstnlogs');		// PATH TO FOLDER & FILE WHERE LOG DATA WILL BE APPENDEED
//$oCRNRSTN->initLogging('LOCALHOST_MAC', 'FILE', '/var/www/html/_debug_output/error.log');										// SYSTEM DEFAULT ERROR LOGGING
//$oCRNRSTN->initLogging('LOCALHOST_MAC', 'EMAIL|DEFAULT|FILE|SCREEN','j5@DOMAIN.com,EMAIL@DOMAIN.com,jharris@evifweb.com||/var/www/html/_debug_output/error.log|','CRNRSTN_SMTP_COMM_PROFILE||GLOBAL_FILE_OUTPUT|');
$oCRNRSTN->initLogging('LOCALHOST_MAC', 'DEFAULT|FILE|SCREEN','|/var/www/html/_debug_output/error.log|','|GLOBAL_FILE_OUTPUT|');
$oCRNRSTN->initLogging('LOCALHOST_PRO', 'DEFAULT|FILE|SCREEN','|/var/www/html/_debug_output/error.log|','|GLOBAL_FILE_OUTPUT|');

//$oCRNRSTN->initLogging('LOCALHOST_MAC', 'EMAIL','EMAIL@DOMAIN.com','CRNRSTN_SMTP_COMM_PROFILE');

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT. 2 WAYS TO USE THIS METHOD.
#METHOD ONE# $oCRNRSTN->addDatabase([environment-key], [path-to-db-configuration-file]);
$oCRNRSTN->addDatabase('BLUEHOST', '/home3/evifwebc/public_html/v2.crnrstn.evifweb/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_MAC', '/var/www/html/crnrstn_v2/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('LOCALHOST_PRO', '/var/www/html/crnrstn_v2/config.database.secure/_crnrstn.db.config.inc.php');
$oCRNRSTN->addDatabase('CYEXX_SYSTEMS', '/home2/jony5/crnrstn.v2.jony5.com/config.database.secure/_crnrstn.db.config.inc.php');

#METHOD TWO# $oCRNRSTN->addDatabase([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
//$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_assets', '222222222222222', 'db_crnrstn_assets', 80);
//$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_posts', '33333333333333', 'db_crnrstn_posts', 80);
//$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_demo', '44444444444444', 'db_crnrstn_demo', 80);
#$oCRNRSTN->addDatabase('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_users', '1111111111111', 'db_crnrstn_users', 3306);
//
//$oCRNRSTN->addDatabase('LOCALHOST_PC', '127.0.0.4', 'crnrstn_demo3_un', 'FZZ88X3EU5s8vFAC', 'crnrstn_demo3', 80);
//$oCRNRSTN->addDatabase('LOCALHOST_PC', '127.0.0.3', 'crnrstn_demo2_un', 'PwdBNBvuFHrwMqCS', 'crnrstn_demo2', 80);
//$oCRNRSTN->addDatabase('LOCALHOST_PC', '127.0.0.2', 'crnrstn_demo4_un', 'G36NQtqFXYWcVXpA', 'crnrstn_demo4', 80);
#$oCRNRSTN->addDatabase('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'aXNTPxGPeLRwYzTS', 'crnrstn_demo', 3306);

//
// INITIALIZE SECURITY PROTOCOLS FOR EXCLUSIVE RESOURCE ACCESS. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO CONFIGURED CRNRSTN IP AUTHENTICATION MANAGER CONFIG FILE ON THE SERVER.
# $oCRNRSTN->grantExclusiveAccess([environment-key], [path-to-db-configuration-file]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC', '/var/www/html/jony5/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->grantExclusiveAccess('CYEXX_SYSTEMS', '/home/jony5com/woodford.jony5.com/config.ipauthmgr.secure/grantexclusiveaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
# $oCRNRSTN->grantExclusiveAccess([environment-key], [comma-delimited-list-of-IPs]);
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_MAC','192.168.172.*,192.168.173.*,192.168.174.3');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 130.51.10.*');
#$oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 130.*, 130.51.10.*, FE80::230:80FF:FEF3:4701');

//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE DENIAL. 2 FORMATS.
# FORMAT 1. PASS IN ENVIRONMENT KEY AND PATH TO A CONFIG FILE ON THE SERVER.
#$oCRNRSTN->denyAccess([environment-key], [path-to-ip-authorization-configuration-file]);
#$oCRNRSTN->denyAccess('LOCALHOST_PC', 'C://DATA_GOVT_SURVEILLANCE//_wwwroot//xampp//htdocs//jony5.com//_crnrstn//config.ipauthmgr.secure//_crnrstn.ipauthmgr.config.inc.php');
#$oCRNRSTN->denyAccess('LOCALHOST_MAC', '/var/www/html/woodford/config.ipauthmgr.secure/denyaccess/_crnrstn.ipauthmgr.config.inc.php');

# FORMAT 2. PASS IN ENVIRONMENT KEY AND IP ADDRESS (OR COMMA DELIMITED LIST OF IPv4 or IPv6 (testing needed) IPs)
#$oCRNRSTN->denyAccess('CYEXX_SYSTEMS','172.16.110.1');
#$oCRNRSTN->denyAccess('LOCALHOST_MAC','172.16.110.1');
#$oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.10, 127.0.0.2, 127.0.0.3, 127.0.0.4, 127.0.0.5');

$oCRNRSTN_ENV = new crnrstn_environmentals($oCRNRSTN,'session_initialization_ping');
if(!$oCRNRSTN_ENV->isConfigured($oCRNRSTN)){

	//
	// TRANSFER LOG DEBUG OUTPUT TO oCRNTSTN FROM oCRNRSTN_ENV FOR SAFE KEEPING FOR THE TIME BEING
	$oCRNRSTN->oLog_output_ARRAY = $oCRNRSTN_ENV->oLog_output_ARRAY;
	unset($oCRNRSTN_ENV);

	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN SESSION DATA :: ADVANCED CONFIGURATION PARAMETERS
	/*
	To configure any of your SERVER environments to hide persistent CRNRSTN configuration session data behind a layer of encryption, 
	run $oCRNRSTN->initSessionEncryption(x,x,x,..)...as defined below...specifying the environmental key for 
	each environment where encryption is desired. CAUTION: This feature will increase server load. CAUTION: CRNRSTN applies a combination 
	of encryption cipher and HMAC keyed hash value data manipulationas and comparisons to store and verify CRNRSTN session data. Some 
	encryption-cipher / HMAC-algoirthm combinations will not be compatible with CRNRSTN due to how they are 
	applied to the data when encryption is initialized...so please test your encryption configuration before applying to production environment.
	
	*Note that the available cipher methods can differ between your dev server and your production server! They will depend on the installation 
	and compilation options used for OpenSSL in your machine(s).
	
	$oCRNRSTN->initSessionEncryption([environment-key] -> Specify one of your previously defined addEnvironment() environment keys , 
									   [openssl-encryption-cipher] -> For a list of recommended and available openssl cipher methods...run $oCRNRSTN->openssl_get_cipher_methods(), 
									   [openssl-encryption-key] -> specify an encryption key to be used by the CRNRSTN encryption layer for encryptable session data, 
									   [openssl-encryption-options] -> a bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING, 
									   [hmac-algorithm] -> Specify the algorithm to be used by CRNRSTN when using the HMAC library to generate a keyed hash value. For a list 
														   of available algorithms run hash_algos(). CAUTION :: Some hash_algos returned methods will NOT be compatible
														   with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos 
														   algorithm combinations will not be compatible. Please test the compatibility of your desired encryption cipher and 
														   hmac algoritm in each environment...especially before releasing to production code base. 
										);
	*/
    $oCRNRSTN->initSessionEncryption('BLUEHOST', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	$oCRNRSTN->initSessionEncryption('LOCALHOST_MAC', 'AES-192-OFB', 'this-Is-the-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->initSessionEncryption('LOCALHOST_PRO', 'AES-192-OFB', 'this-Is-the-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->initSessionEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
	
	//
	// INITIALIZATION FOR ENCRYPTION :: CRNRSTN COOKIE DATA :: ADVANCED CONFIGURATION PARAMETERS
    /*
	CAUTION. If cookie encryption is enabled and then changed some time later. It is possible for clients to have cookie data that was
	encrypted with a "no-longer-in-production" encryption cipher or HMAC algorithm...and hence be unreadable to the application. Developer
	needs to take this into consideration and plan for use case where cookie data is unreadable...with graceful degradation or cookie reset.
	*/

	#$oCRNRSTN->initCookieEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm])
	#$oCRNRSTN->initCookieEncryption('LOCALHOST_MAC', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'gost');
	#$oCRNRSTN->initCookieEncryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');
	#$oCRNRSTN->initCookieEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');

    //
    // INITIALIZATION FOR ENCRYPTION :: CRNRSTN TUNNEL DATA :: ADVANCED CONFIGURATION PARAMETERS
    /*
    CAUTION :: Some hash_algos() returned methods will NOT be compatible
    with hash_hmac() which CRNRSTN uses in validating its decryption. And certain openssl encryption cipher / hash_algos
    algorithm combinations will not be compatible. Please test the compatibility of your desired combination of
    encryption cipher and hmac algorithm for each environment...especially before releasing to production code base.
    */

    #$oCRNRSTN->initCookieEncryption([environment-key], [openssl-encryption-cipher], [openssl-encryption-key], [openssl-encryption-options], [hmac-algorithm]);
    $oCRNRSTN->initTunnelEncryption('LOCALHOST_MAC', 'AES-192-OFB', 'hello-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->initTunnelEncryption('LOCALHOST_PRO', 'AES-192-OFB', 'hello-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
    $oCRNRSTN->initTunnelEncryption('CYEXX_SYSTEMS', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
    $oCRNRSTN->initTunnelEncryption('BLUEHOST', 'AES-256-CTR', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');

    //
	// TO ACHIEVE SLIGHT OPTIMIZATION AT FIRST RUNTIME, PASS AN APPROPRIATE INTEGER VALUE TO requiredDetectionMatches(). ONLY AND PRECISELY WHEN THAT QUANTITY OF PROVIDED $_SERVER PARAMETERS MATCH FOR ANY GIVEN 
	// DEFINED ENVIRONMENT'S defineEnvResource() KEYS, WILL THE THE DETECTION SCRIPT STOP PROCESSING ANY FURTHER defineEnvResource() KEYS AND SELECT THE QUALIFYING ENVIRONMENT.
	$oCRNRSTN->requiredDetectionMatches();

	//
	// FOR EACH ENVIRONMENT ABOVE, DEFINE RELEVANT CORE SERVER CONFIG SETTINGS + ADD ANY CUSTOM KEYS/VALUES OF YOUR OWN
	# # # # # # # #
	# RESOURCE KEY DEFINITIONS FOR CORE AND CUSTOM ATTRIBUTES THAT CAN BE USED FOR EACH ENVIRONMENT RUNNING YOUR APPLICATION ::
	# * HERE ARE EXAMPLES OF CORE/RESERVED SERVER SUPER GLOBAL PARAMETERS. 
	# * SUPER GLOBAL SERVER VALUES FROM THESE DEFINITIONS WILL BE USED TO CONFIGURE CRNRSTN TO ITS ENV PER REAL-TIME SERVER SETTINGS
	#___{KEY}__<-- custom or $_SERVER[] value_______{EXAMPLE OF CONTENT}________________
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	# DOCUMENT_ROOT									(e.g. 'C:\\[path]\\[to]\\[site-root]\\[folder]\\' or '/var/www/')
	# SERVER_NAME									(e.g. 'localhost' or 'stage.mydomain.com' or 'mydomain.com')
	# REMOTE_ADDR									(e.g. '127.0.0.1' or '265.121.2.110')
	# SERVER_SIGNATURE
	# ...{ANY OTHER $_SERVER[] SUPER GLOBAL PARAMETER MAY BE USED TO SUPPORT CRNRSTN SERVER DETECTION}...
	# 
	# For a more complete list of available super global array parameters, please see :: 
	# http://php.net/manual/en/reserved.variables.server.php
	#
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	# EXAMPLES OF ADDITIONAL AND CUSTOM KEYS/VALUES THAT ONE MAY DECIDE TO INITIALIZE THROUGH CRNRSTN
	# DOMAIN									(e.g. 'www.domain.com' or 'localhost')
	# SSL_ENABLED								(i.e. true or false/NULL)
	# ROOT_PATH_CLIENT_HTTP						(e.g. NULL for hosting off root {DOMAIN} or '{DOMAIN}/[your-folder]/[your-folder]/')
	#
	# So...for example, here is how one would programatically add/define keys to initialize their crnrstn 
	# application where, $oCRNRSTN->defineEnvResource([environment-key], [resource-key], [value]) ::
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	# $oCRNRSTN->defineEnvResource('STAGE_TESTING_WhAtEvEr', 'SSL_ENABLED', false);
	# $oCRNRSTN->defineEnvResource('PRODUCTION_ZEDS_DEAD', 'ABSPATH', '/home/a8537844/public_html/');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_AN_OLD_MACINTOSH', 'YoUr-custom-resource-key', 'value-for-key');
	# 
	# or, for example...adding some keys (wordpress specific) to run a wordpress blog on top of crnrstn
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_TABLE_PREFIX', 'wp_');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_CHARSET', 'utf8');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'DATABASE_COLLATE', '');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'AUTH_KEY', 				'p19~FS%rRR4C,U8Is3?GsL%T=x2HWO~7PY^NVg}%G0e41:VRDx$u$B75nBDo[z%-');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SECURE_AUTH_KEY', 		'V4L<.%eLV2Ni_~02FT#7bwjuBxAOsbq/q6{RhL)ox^^u8Xy(6[|%+S9v5$rXpD39');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'LOGGED_IN_KEY', 		'$O##gm<>u[WdJCD-pnh)5hNIqAyc3=is<WV%*k]3O%F^p%-l3@$//8?wmHyJ^gY#');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'NONCE_KEY', 			'Pvbduy|D>4}zP2L-<aJNBza?!#bLQf{!wc$1k$;cs=fFO~u}DI2FK;TN:nn8Q{U0');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'AUTH_SALT', 			'OvEKNG`wc0*o8uguR8f^<RrInhDluX0^J:<3@mV:<:LA-V8eaeBr/~DDnJ#,={_1');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'SECURE_AUTH_SALT', 		'%lGQeL#3p9o;lhgsQ1UF_A_`*K-V+y}b8M.lL`!/G4$_,JCidTBz.!Xzy`)[/D*&');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'LOGGED_IN_SALT', 		'*<2 .FW;wq;4gYUkz5Q*7-OClKjrC^ZIDM3IQ|1NS|z>LDfuq$?h!L-=C:-.v,0Y');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'NONCE_SALT', 			'Ai=LA9lW:, @DO6-j)kg}]h}9P)4XUrEXTn{/.Hp]gDw$:V%6@^VP;rs0Lp)%n80');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WPLANG', '');
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'WP_DEBUG', false);
	# $oCRNRSTN->defineEnvResource('LOCALHOST_PC', 'ABSPATH', 'C:\\DATA_GOVT_SURVEILLANCE\\_wwwroot\\xampp\\htdocs\\jony5.com\\');
	# # # # # # # #

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'DOMAIN', 'http://v2.crnrstn.evifweb.com/');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'SERVER_NAME', 'http://v2.crnrstn.evifweb.com/');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'SERVER_ADDR', '50.87.249.11');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'SERVER_PORT', '80');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'SSL_ENABLED', false);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'DOCUMENT_ROOT', '/home3/evifwebc/public_html/v2.crnrstn.evifweb'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'DOCUMENT_ROOT_DIR', '');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'ROOT_PATH_CLIENT_HTTP', 'http://v2.crnrstn.evifweb.com/');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'ROOT_PATH_CLIENT_HTTP_DIR', '');

    $oCRNRSTN->defineEnvResource('BLUEHOST', 'INDEX_PAGES_4SEARCH', true);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'AJAX_RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'RESULT_MAX_MOBILE', 5);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'AJAX_RESULT_MAX_MOBILE', 4);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'ELECTRUM_TEST_AUTH', false);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'EMAIL_TEST_AUTH', true);
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'CRNRSTN_PROXY_AUTH_KEY', 'Pvbduy|D>4}zP2L-<aJNBza?!#bLQf{!wc$1k$;cs=fFO~u}DI2FK;TN:nn8Q{U0');
    $oCRNRSTN->defineEnvResource('BLUEHOST', 'PROXY_SEND_ENABLED', false);


	//
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOMAIN', 'crnrstn.v2.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_NAME', 'crnrstn.v2.jony5.com');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_ADDR', '184.173.96.66');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOCUMENT_ROOT', '/home2/jony5/crnrstn.v2.jony5.com'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'DOCUMENT_ROOT_DIR', '');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP', 'http://crnrstn.v2.jony5.com/');
	$oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ROOT_PATH_CLIENT_HTTP_DIR', '');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'INDEX_PAGES_4SEARCH', true);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'AJAX_RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'RESULT_MAX_MOBILE', 5);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'AJAX_RESULT_MAX_MOBILE', 4);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'ELECTRUM_TEST_AUTH', false);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'EMAIL_TEST_AUTH', true);
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'CRNRSTN_PROXY_AUTH_KEY', 'Pvbduy|D>4}zP2L-<aJNBza?!#bLQf{!wc$1k$;cs=fFO~u}DI2FK;TN:nn8Q{U0');
    $oCRNRSTN->defineEnvResource('CYEXX_SYSTEMS', 'PROXY_SEND_ENABLED', false);


    //
	// BEGIN CONFIG FOR NEXT ENVIRONMENT
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOMAIN', '172.16.195.132');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_NAME', '172.16.195.132');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_ADDR', '172.16.195.132');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PORT', '80');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SERVER_PROTOCOL', 'HTTP/1.1');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'SSL_ENABLED', false);
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'DOCUMENT_ROOT_DIR', '/crnrstn_v2');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.195.132/');
	$oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ROOT_PATH_CLIENT_HTTP_DIR', 'crnrstn_v2/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'INDEX_PAGES_4SEARCH', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'AJAX_RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'RESULT_MAX_MOBILE', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'AJAX_RESULT_MAX_MOBILE', 4);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'ELECTRUM_TEST_AUTH', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'EMAIL_TEST_AUTH', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');  //http://v2.crnrstn.evifweb.com/
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'CRNRSTN_PROXY_AUTH_KEY', 'Pvbduy|D>4}zP2L-<aJNBza?!#bLQf{!wc$1k$;cs=fFO~u}DI2FK;TN:nn8Q{U0');
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'PROXY_SEND_ENABLED', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_MAC', 'WSDL_URI', 'http://v2.crnrstn.evifweb.com/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');

    //
    // BEGIN CONFIG FOR NEXT ENVIRONMENT
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'DOMAIN', '172.16.225.128');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'SERVER_NAME', '172.16.225.128');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'SERVER_ADDR', '172.16.225.128');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'SERVER_PORT', '80');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'SERVER_PROTOCOL', 'HTTP/1.1');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'SSL_ENABLED', false);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'DOCUMENT_ROOT', '/var/www/html'); # VALUE FOR YOUR SERVER['DOCUMENT_ROOT']
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'DOCUMENT_ROOT_DIR', '/crnrstn_v2');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'ROOT_PATH_CLIENT_HTTP', 'http://172.16.225.128/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'ROOT_PATH_CLIENT_HTTP_DIR', 'crnrstn_v2/');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'INDEX_PAGES_4SEARCH', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'AJAX_RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'RESULT_MAX_DESKTOP', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'RESULT_MAX_MOBILE', 5);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'AJAX_RESULT_MAX_MOBILE', 4);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'ELECTRUM_TEST_AUTH', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'EMAIL_TEST_AUTH', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'CRNRSTN_PROXY_WSDL_ENDPOINT', 'http://v2.crnrstn.evifweb.com/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');  //http://v2.crnrstn.evifweb.com/
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'CRNRSTN_PROXY_AUTH_KEY', 'Pvbduy|D>4}zP2L-<aJNBza?!#bLQf{!wc$1k$;cs=fFO~u}DI2FK;TN:nn8Q{U0');
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'PROXY_SEND_ENABLED', true);
    $oCRNRSTN->defineEnvResource('LOCALHOST_PRO', 'WSDL_URI', 'http://v2.crnrstn.evifweb.com/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');

    //
    // FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING '*' AS ENV KEY PARAMETER
    $oCRNRSTN->defineEnvResource('*','SOA_NAMESPACE','http://www.w3.org/2003/05/soap-encoding');
    $oCRNRSTN->defineEnvResource('*','WSDL_CACHE_TTL','80');
    $oCRNRSTN->defineEnvResource('*','NUSOAP_USECURL',true);

    //
	// INSTANTIATE ENVIRONMENTAL CLASS BASED ON ABOVE DEFINED CRNRSTN CONFIGURATION 
	$oCRNRSTN_ENV = new crnrstn_environmentals($oCRNRSTN);

	unset($oCRNRSTN);

}else{

	unset($oCRNRSTN);

}

//
// INSTANTIATE CRNRSTN USER CLASS OBJECT
$oCRNRSTN_USR = new crnrstn_user($oCRNRSTN_ENV);
/*
if($result = $oCRNRSTN_USR->initProxyCommListener()){

    echo $result;
    die();

}
*/

# # # # # #
# # # # # #
# # # # # # 	END OF CRNRSTN CONFIG

if($oCRNRSTN_USR->getEnvResource('SSL_ENABLED')){
    if(!$oCRNRSTN_USR->isSSL()){

        header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
    }
}else{

    if($oCRNRSTN_USR->isSSL()){

        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
    }

}

//
// DOCUMENTATION SITE :: HELPER CLASSES
require($CRNRSTN_ROOT.'/common/_pleease_help_classes/mininav.inc.php');                  // MOBILE DEVICE VERSION NAVIGATION UI CONTROLLER
require($CRNRSTN_ROOT.'/common/_pleease_help_classes/contentgen.inc.php');               // MOBILE & DESKTOP SITE CONTENT AGGREGATOR
require($CRNRSTN_ROOT.'/common/_pleease_help_classes/sideloadusr.inc.php');              // SIDE BITCH USER CLASS
require($CRNRSTN_ROOT.'/common/_pleease_help_classes/content_source_control.inc.php');   // CONTENT SOURCE CONTROLLER