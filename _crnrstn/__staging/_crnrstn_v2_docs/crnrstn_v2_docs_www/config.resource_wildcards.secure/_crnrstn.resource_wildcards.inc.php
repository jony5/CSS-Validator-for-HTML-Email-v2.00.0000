<?php
if(isset($envKey)){
    $this->tmp_wcr_config_envKey = $envKey;
}else{
    //
    // HOOOSTON...VE HAF PROBLEM!
    throw new Exception('The environmental reference key has not been provided for this environment. CRNRSTN configuration resource wildcards cannot be initialized without a key.');
}

if(!isset($oWildCardResource_ARRAY)){
    $oWildCardResource_ARRAY = array();
}
# # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # #
# BEGIN INITIALIZATION OF ENVIRONMENTALLY
# RELEVANT RESOURCE WILDCARDS

switch($envKey){
    case 'BLUEHOST':
        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('CRNRSTN_SMTP_COMM_PROFILE');
        $oWCR->addAttribute('EMAIL_TEST_AUTH', true);

        $oWCR->addAttribute('EMAIL_PROTOCOL', 'SMTP');     //SMTP, MAIL, QMAIL, SENDMAIL
        $oWCR->addAttribute('SYS_SMTP_AUTH', true);
        $oWCR->addAttribute('SYS_SMTP_SERVER', 'v2.crnrstn.evifweb.com;v2.crnrstn.evifweb.com');
        $oWCR->addAttribute('SYS_SMTP_PORT_OUTGOING', '587');
        $oWCR->addAttribute('SYS_SMTP_USERNAME', 'no_reply@v2.crnrstn.evifweb.com');
        $oWCR->addAttribute('SYS_SMTP_PASSWORD', '1234567890');

        $oWCR->addAttribute('SYS_FROM_EMAIL', 'no_reply@v2.crnrstn.evifweb.com');
        $oWCR->addAttribute('SYS_FROM_NAME', 'CRNRSTN v2.0.0 Mailer');

        $oWCR->addAttribute('SYS_REPLYTO_EMAIL', 'jharris@eVifweb.com');
        $oWCR->addAttribute('SYS_REPLYTO_NAME', 'CRNRSTN v2.0.0 :: Lead Developer');

        $oWCR->addAttribute('SYS_MSG_DEFAULT_WORD_WRAP', 72);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_ISHTML', true);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_PRIORITY', 'NORMAL');
        $oWCR->addAttribute('SYS_MSG_DEFAULT_DUP_SUPPRESS', true);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('BACKUP_EMAIL_COMM_PROFILE');
        $oWCR->addAttribute('EMAIL_TEST_AUTH', true);

        $oWCR->addAttribute('EMAIL_PROTOCOL', 'SENDMAIL');
        $oWCR->addAttribute('SYS_SMTP_AUTH', false);

        $oWCR->addAttribute('SYS_FROM_EMAIL', 'no_reply@v2.crnrstn.evifweb.com');
        $oWCR->addAttribute('SYS_FROM_NAME', 'CRNRSTN v2.0.0 Mailer');

        $oWCR->addAttribute('SYS_REPLYTO_EMAIL', 'jharris@eVifweb.com');
        $oWCR->addAttribute('SYS_REPLYTO_NAME', 'CRNRSTN v2.0.0 :: Lead Developer');

        $oWCR->addAttribute('SYS_MSG_DEFAULT_WORD_WRAP', 72);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_ISHTML', true);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_PRIORITY', 'NORMAL');
        $oWCR->addAttribute('SYS_MSG_DEFAULT_DUP_SUPPRESS', true);

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('SOAP_v1.0.0_CRNRSTN_DOCS');

        $oWCR->addAttribute('NUSOAP_USECURL', '0');
        $oWCR->addAttribute('SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
        $oWCR->addAttribute('WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
        $oWCR->addAttribute('WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
        $oWCR->addAttribute('WSDL_CACHE_TTL', '80');    # REQUIRED BY SOAP CONNECTION MANAGER
        $oWCR->addAttribute('NUSOAP_USECURL', true);    # REQUIRED BY SOAP CONNECTION MANAGER

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        break;
    case 'CYEXX_SYSTEMS':
        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('CRNRSTN_SMTP_COMM_PROFILE');
        $oWCR->addAttribute('EMAIL_TEST_AUTH', true);

        $oWCR->addAttribute('EMAIL_PROTOCOL', 'SMTP');     //SMTP, MAIL, QMAIL, SENDMAIL
        $oWCR->addAttribute('SYS_SMTP_AUTH', true);
        $oWCR->addAttribute('SYS_SMTP_SERVER', 'mail.crnrstn.v2.jony5.com;mail.crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_SMTP_PORT_OUTGOING', '587');
        $oWCR->addAttribute('SYS_SMTP_USERNAME', 'no_reply@crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_SMTP_PASSWORD', '1234567890');

        $oWCR->addAttribute('SYS_FROM_EMAIL', 'no_reply@crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_FROM_NAME', 'CRNRSTN v2.0.0 Mailer');

        $oWCR->addAttribute('SYS_REPLYTO_EMAIL', 'jharris@eVifweb.com');
        $oWCR->addAttribute('SYS_REPLYTO_NAME', 'CRNRSTN v2.0.0 :: Lead Developer');

        $oWCR->addAttribute('SYS_MSG_DEFAULT_WORD_WRAP', 72);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_ISHTML', true);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_PRIORITY', 'NORMAL');
        $oWCR->addAttribute('SYS_MSG_DEFAULT_DUP_SUPPRESS', true);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('BACKUP_EMAIL_COMM_PROFILE');
        $oWCR->addAttribute('EMAIL_TEST_AUTH', true);

        $oWCR->addAttribute('EMAIL_PROTOCOL', 'SENDMAIL');
        $oWCR->addAttribute('SYS_SMTP_AUTH', false);

        $oWCR->addAttribute('SYS_FROM_EMAIL', 'no_reply@crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_FROM_NAME', 'CRNRSTN v2.0.0 Mailer');

        $oWCR->addAttribute('SYS_REPLYTO_EMAIL', 'jharris@eVifweb.com');
        $oWCR->addAttribute('SYS_REPLYTO_NAME', 'CRNRSTN v2.0.0 :: Lead Developer');

        $oWCR->addAttribute('SYS_MSG_DEFAULT_WORD_WRAP', 72);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_ISHTML', true);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_PRIORITY', 'NORMAL');
        $oWCR->addAttribute('SYS_MSG_DEFAULT_DUP_SUPPRESS', true);

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('SOAP_v1.0.0_CRNRSTN_DOCS');

        $oWCR->addAttribute('NUSOAP_USECURL', '0');
        $oWCR->addAttribute('SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
        $oWCR->addAttribute('WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
        $oWCR->addAttribute('WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
        $oWCR->addAttribute('WSDL_CACHE_TTL', '80');    # REQUIRED BY SOAP CONNECTION MANAGER
        $oWCR->addAttribute('NUSOAP_USECURL', true);    # REQUIRED BY SOAP CONNECTION MANAGER

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

    break;
    case 'LOCALHOST_MAC':
        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('CRNRSTN_SMTP_COMM_PROFILE');
        $oWCR->addAttribute('EMAIL_TEST_AUTH', true);

        $oWCR->addAttribute('EMAIL_PROTOCOL', 'CRNRSTN_PROXY');     //SMTP, MAIL, QMAIL, SENDMAIL, CRNRSTN_PROXY
        $oWCR->addAttribute('SYS_SMTP_AUTH', true);
        $oWCR->addAttribute('SYS_SMTP_SERVER', 'mail.crnrstn.v2.jony5.com;mail.crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_SMTP_PORT_OUTGOING', '587');
        $oWCR->addAttribute('SYS_SMTP_USERNAME', 'no_reply@crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_SMTP_PASSWORD', '1234567890');

        $oWCR->addAttribute('SYS_FROM_EMAIL', 'no_reply@crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_FROM_NAME', 'CRNRSTN v2.0.0 Mailer');

        $oWCR->addAttribute('SYS_REPLYTO_EMAIL', 'jharris@eVifweb.com');
        $oWCR->addAttribute('SYS_REPLYTO_NAME', 'CRNRSTN v2.0.0 :: Lead Developer');

        $oWCR->addAttribute('SYS_MSG_DEFAULT_WORD_WRAP', 72);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_ISHTML', true);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_PRIORITY', 'NORMAL');
        $oWCR->addAttribute('SYS_MSG_DEFAULT_DUP_SUPPRESS', true);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('BACKUP_EMAIL_COMM_PROFILE');
        $oWCR->addAttribute('EMAIL_PROTOCOL', 'SENDMAIL');
        $oWCR->addAttribute('SYS_SMTP_AUTH', false);

        $oWCR->addAttribute('SYS_FROM_EMAIL', 'no_reply@crnrstn.v2.jony5.com');
        $oWCR->addAttribute('SYS_FROM_NAME', 'CRNRSTN v2.0.0 Mailer');

        $oWCR->addAttribute('SYS_REPLYTO_EMAIL', 'jharris@eVifweb.com');
        $oWCR->addAttribute('SYS_REPLYTO_NAME', 'CRNRSTN v2.0.0 :: Lead Developer');

        $oWCR->addAttribute('SYS_MSG_DEFAULT_WORD_WRAP', 72);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_ISHTML', true);
        $oWCR->addAttribute('SYS_MSG_DEFAULT_PRIORITY', 'NORMAL');
        $oWCR->addAttribute('SYS_MSG_DEFAULT_DUP_SUPPRESS', true);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->defineWildCardResource('SOAP_v1.0.0_CRNRSTN_DOCS');

        $oWCR->addAttribute('NUSOAP_USECURL', '0');
        $oWCR->addAttribute('SOA_NAMESPACE', 'http://services.crnrstn.jony5.com/soap/services');
        $oWCR->addAttribute('WSDL_URI_MGMT', 'http://services.crnrstn.jony5.com/soa/crnrstnmgmt/1.0.0/wsdl/index.php?wsdl');
        $oWCR->addAttribute('WSDL_URI', 'http://services.crnrstn.jony5.com/soa/crnrstn/1.0.0/wsdl/index.php?wsdl');
        $oWCR->addAttribute('WSDL_CACHE_TTL', '80');    # REQUIRED BY SOAP CONNECTION MANAGER
        $oWCR->addAttribute('NUSOAP_USECURL', true);    # REQUIRED BY SOAP CONNECTION MANAGER

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;


        # # # # #
        ### NEW WILD CARD RESOURCE - FTP SOURCE
        $oWCR = $this->defineWildCardResource('ELECTRUM_SOURCE_FTP00');

        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', true);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->addAttribute('FTP_DIR_PATH', '/var/www/html/_backup_test/crnrstn_v2/');

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - FTP SOURCE
        $oWCR = $this->defineWildCardResource('ELECTRUM_SOURCE_FTP01');

        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', true);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->addAttribute('FTP_DIR_PATH', '/var/www/html/_backup_test/source_ftp01_WCR/');

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - DIR SOURCE
        $oWCR = $this->defineWildCardResource('ELECTRUM_SOURCE_DIR00');
        $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/source00_WCR/');
        //$oWCR->addAttribute('MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - DIR SOURCE
        $oWCR = $this->defineWildCardResource('ELECTRUM_SOURCE_DIR01');
        $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/crnrstn_v2/');
        //$oWCR->addAttribute('MKDIR_MODE', 777);
        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - FTP DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_FTP00');

        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', true);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->addAttribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest_ftp00_WCR/');
        $oWCR->addAttribute('FTP_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - FTP DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_FTP420');

        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', true);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->addAttribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420_FTP_WCR/');
        $oWCR->addAttribute('FTP_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;


        # # # # #
        ### NEW WILD CARD RESOURCE - FTP DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_FTP420FLAT');

        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', true);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->addAttribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420FLAT_FTP_WCR/');
        $oWCR->addAttribute('FTP_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - DIR DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_DIR00');
        $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/dest00_DIR_WCR/');
        $oWCR->addAttribute('LOCAL_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - DIR DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_DIR01');
        $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/dest01_DIR_WCR/');
        $oWCR->addAttribute('LOCAL_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE - DIR DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_DIR420');
        $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/dest420_DIR_WCR/');
        $oWCR->addAttribute('LOCAL_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;


        # # # # #
        ### NEW WILD CARD RESOURCE - DIR DESTINATION
        $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_DIR420FLAT');
        $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/dest420FLAT_DIR_WCR/');
        $oWCR->addAttribute('LOCAL_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        /*
         *
         * self::$ftp_server = $ftp_server;
        self::$ftp_username = $username;
        self::$ftp_password = $password;
        self::$ftp_port = $port;
        self::$ftp_timeout = $timeout;

        $oCRNRSTN_USR->electrum_AddSourceWCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_FTP00');
        $oCRNRSTN_USR->electrum_AddSourceWCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_DIR00');
        $oCRNRSTN_USR->electrum_AddSourceWCR($CRNRSTN_oELECTRUM, 'ELECTRUM_SOURCE_DIR01');

        $oCRNRSTN_USR->electrum_AddDestinationWCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_FTP00');
        $oCRNRSTN_USR->electrum_AddDestinationWCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_DIR00');
        $oCRNRSTN_USR->electrum_AddDestinationWCR($CRNRSTN_oELECTRUM, 'ELECTRUM_DESTINATION_DIR01');
         * */

        break;
    case 'LOCALHOST_PC':

    break;
    default:
        //
        // HOOOSTON...VE HAF PROBLEM!
        throw new Exception('An unknown...and hence unhandled...environmental reference key,"'.$envKey.'", has been provided for this environment. CRNRSTN configuration resource wildcards cannot be initialized without an acknowledged key.');

    break;
}





