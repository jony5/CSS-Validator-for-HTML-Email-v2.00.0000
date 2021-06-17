<?php
/**
// J5
// Code is Poetry
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2020 eVifweb development
#  VERSION :: 2.0.0 on Saturday July 4, 2020 @ 1620hrs
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
*/# # C # R # N # R # S # T # N # # : : # #

//
// CRNRSTN :: CLASS DEFINITIONS
require($CRNRSTN_ROOT . '/_crnrstn/class/crnrstn/crnrstn.inc.php');								// CRNRSTN
require($CRNRSTN_ROOT . '/_crnrstn/class/logging/crnrstn.log.inc.php');							// LOGGING
require($CRNRSTN_ROOT . '/_crnrstn/class/environmentals/crnrstn.env.inc.php');					// ENVIRONMENTALS
require($CRNRSTN_ROOT . '/_crnrstn/class/security/crnrstn.ipauthmgr.inc.php');					// SECURITY
require($CRNRSTN_ROOT . '/_crnrstn/class/database/mysqli/crnrstn.mysqli.inc.php');				// DATABASE
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_Exception.php');		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_PHPMailer.php');		// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_SMTP.php');			// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_OAuth.php');			// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/phpmailer/src/crnrstn_POP3.php');			// PHPMAILER (3RD PARTY MAIL FUNCTIONALITY)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/nusoap/nusoap.php');						// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/nusoap/class.wsdlcache.php');				// NUSOAP (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT . '/_crnrstn/class/thirdparty/mobiledetect/crnrstn_Mobile_Detect.php');	// MOBILE DETECT (3RD PARTY CLIENT/SERVER SOAP)
require($CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soap_client.inc.php');						// SOAP CLIENT
require($CRNRSTN_ROOT . '/_crnrstn/class/soa/crnrstn.soa_endpoint_request_manager.inc.php');    // SOAP SERVER RESPONSE MANAGER
require($CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.session.inc.php');						// SESSION MANAGEMENT
require($CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.cookie.inc.php');						// COOKIE MANAGEMENT
require($CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.http.inc.php');						// HTTP MANAGEMENT
require($CRNRSTN_ROOT . '/_crnrstn/class/transform/crnrstn.finiteexpress.inc.php');				// OUTPUT FORMATTING - DATE
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_crnrstn.inc.php');			// DATABASE INTEGRATIONS CRNRSTN
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_wiring.inc.php');			// DATABASE QUERY HANDLING WIRING
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.db_conn_handle.inc.php');				// DATABASE CONNECTION GRIP/MANAGEMENT
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_request.inc.php');			// DATABASE REQUEST
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.database_query.inc.php');				// DATABASE QUERY
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.query_manager.inc.php');				// DATABASE QUERY MANAGER
require($CRNRSTN_ROOT . '/_crnrstn/class/database/crnrstn.results_paginator.inc.php');			// DATABASE RESULT SET PAGINATION MANAGER
require($CRNRSTN_ROOT . '/_crnrstn/class/session/crnrstn.redirect_controller.inc.php');			// REDIRECT CONTROLLER
require($CRNRSTN_ROOT . '/config.database.sql/crnrstn.db_sql_silo.inc.php');					// A QUERY SILO
require($CRNRSTN_ROOT . '/_crnrstn/class/messenger/crnrstn.messenger_from_north.inc.php');      // MESSENGER FROM THE FURTHEST REACHES OF THE NORTH
require($CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.lightning_ftp_manager.inc.php');            // FIRE_FTP CONNECTION MANAGER
require($CRNRSTN_ROOT . '/_crnrstn/class/ftp/crnrstn.wind_cloud_fire.inc.php');                  // ELECTRUM :: Ezekiel 1:4
require($CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user.inc.php');							// CRNRSTN USER