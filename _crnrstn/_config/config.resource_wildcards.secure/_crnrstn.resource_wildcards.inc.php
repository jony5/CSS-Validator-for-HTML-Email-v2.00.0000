<?php
# # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # #
# BEGIN INITIALIZATION OF ENVIRONMENTALLY
# RELEVANT RESOURCE WILDCARDS

switch($this->env_cleartext_name){
    case 'BLUEHOST':
        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN_SMTP_COMM_PROFILE');
        $oWCR->add_attribute('EMAIL_TEST_AUTH', true);

        $oWCR->add_attribute('EMAIL_PROTOCOL', 'SMTP');     //SMTP, MAIL, QMAIL, SENDMAIL
        $oWCR->add_attribute('SMTP_AUTH', true);
        $oWCR->add_attribute('SMTP_SERVER', 'v2.crnrstn.WEBDOMAIN.com;v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('SMTP_PORT_OUTGOING', '587');
        $oWCR->add_attribute('SMTP_USERNAME', 'no_reply@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('SMTP_PASSWORD', 'password2345678');

        $oWCR->add_attribute('FROM_EMAIL', 'no_reply@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('FROM_NAME', 'CRNRSTN v2.00.0000 Mailer');

        $oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'no_reply@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('REPLYTO_NAME_PIPED', 'CRNRSTN v2.00.0000 :: Lead Developer');

        $oWCR->add_attribute('WORDWRAP', 72);
        $oWCR->add_attribute('ISHTML', true);
        $oWCR->add_attribute('PRIORITY', 'NORMAL');
        $oWCR->add_attribute('DUP_SUPPRESS', true);

        $oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris email@webdomain.com|j5@webdomain.com');
        $oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan J5 Harris');

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

    break;
    case 'LOCALHOST_MACBOOKTERMINAL':

        //CRNRSTN_ERR_LOG_FTP
        # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN_ERR_LOG_FTP');
        $oWCR->add_attribute('FTP_SERVER', '172.16.195.132');
        $oWCR->add_attribute('FTP_USERNAME', 'jony5');
        $oWCR->add_attribute('FTP_PASSWORD', 'password123');
        $oWCR->add_attribute('FTP_PORT', 21);
        $oWCR->add_attribute('FTP_TIMEOUT', 90);
        $oWCR->add_attribute('FTP_IS_SSL', false);
        $oWCR->add_attribute('FTP_USE_PASV', true);
        $oWCR->add_attribute('FTP_USE_PASV_ADDR', false);
        $oWCR->add_attribute('FTP_DISABLE_AUTOSEEK', false);
        $oWCR->add_attribute('FTP_DIR_PATH', '/var/www/html/_backup_test/dest420_FTP_WCR/');
        $oWCR->add_attribute('FTP_MKDIR_MODE', 777);

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN_SMTP_COMM_PROFILE__');

        $oWCR->add_attribute('FROM_EMAIL', 'no_reply@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('FROM_NAME', 'CRNRSTN v2.0.0 Mailer');
        $oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'no_reply01@v2.crnrstn.WEBDOMAIN.com|no_reply02@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('REPLYTO_NAME_PIPED', '1_CRNRSTN v2.0.0 :: Lead Developer|2_CRNRSTN v2.0.0 :: Lead Developer');

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN_SMTP_COMM_PROFILE');

        $oWCR->add_attribute('CRNRSTN_SOAP_SVC_AUTH_KEY', 'Puy2iu3iu3oi1u313ou23iu1oi3uo1u3=fFO~u}DI2FK;TN:nn8Q{U0');
        $oWCR->add_attribute('SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');
        $oWCR->add_attribute('WSDL_URI', 'http://172.16.195.132/crnrstn_v2/_crnrstn/services/proxy/messenger/2.0.0/wsdl/index.php?wsdl');
        $oWCR->add_attribute('WSDL_CACHE_TTL', 80);
        $oWCR->add_attribute('NUSOAP_USECURL', true);

        //$oWCR->add_attribute('LOCAL_DIR_FILEPATH', '/var/www/html/_backup_test/_tmp/');
        //$oWCR->add_attribute('LOCAL_MKDIR_MODE', 775);

        $oWCR->add_attribute('EMAIL_TEST_AUTH', true);
        $oWCR->add_attribute('EMAIL_PROTOCOL', 'SMTP');     //SMTP, MAIL, QMAIL, SENDMAIL
        $oWCR->add_attribute('SMTP_AUTH', true);
        $oWCR->add_attribute('SMTP_SERVER', 'v2.crnrstn.WEBDOMAIN.com;v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('SMTP_PORT_OUTGOING', '587');
        $oWCR->add_attribute('SMTP_USERNAME', 'no_reply@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('SMTP_PASSWORD', 'password2345678');
        $oWCR->add_attribute('SMTP_KEEPALIVE', false);
        $oWCR->add_attribute('SMTP_SECURE', '');
        $oWCR->add_attribute('SMTP_AUTOTLS', true);
        $oWCR->add_attribute('SMTP_TIMEOUT', 5);
        $oWCR->add_attribute('DIBYA_SAHOO_SSL_CERT_BYPASS', true); // PER PHP +5.6, SEE RESEARCH [lnum 7258] [file /_crnrstn/class/environmentals/crnrstn.env.inc.php]
        $oWCR->add_attribute('SENDMAIL_PATH', '/usr/sbin/sendmail');
        $oWCR->add_attribute('USE_SENDMAIL_OPTIONS', true);
        $oWCR->add_attribute('FROM_EMAIL', 'no_reply@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('FROM_NAME', 'CRNRSTN v2.0.0 Mailer');
        $oWCR->add_attribute('REPLYTO_EMAIL_PIPED', 'no_reply01@v2.crnrstn.WEBDOMAIN.com|no_reply02@v2.crnrstn.WEBDOMAIN.com');
        $oWCR->add_attribute('REPLYTO_NAME_PIPED', '1_CRNRSTN v2.0.0 :: Lead Developer|2_CRNRSTN v2.0.0 :: Lead Developer');
        //$oWCR->add_attribute('CC_EMAIL_PIPED', 'CC_jharris@WEBDOMAIN.com|CC2_jharris@WEBDOMAIN.com');
        //$oWCR->add_attribute('CC_NAME_PIPED', '|CC2_CRNRSTN v2.0.0 :: Lead Developer');
        //$oWCR->add_attribute('BCC_EMAIL_PIPED', 'BCC_jharris@WEBDOMAIN.com|BCC2_jharris@WEBDOMAIN.com');
        //$oWCR->add_attribute('BCC_NAME_PIPED', '|BCC2_CRNRSTN v2.0.0 :: Lead Developer');
        $oWCR->add_attribute('WORDWRAP', 52);
        $oWCR->add_attribute('ISHTML', true);
        $oWCR->add_attribute('PRIORITY', 'NORMAL');
        $oWCR->add_attribute('DUP_SUPPRESS', true);
        $oWCR->add_attribute('CHARSET', 'iso-8859-1');
        $oWCR->add_attribute('MESSAGE_ENCODING', '8bit');
        $oWCR->add_attribute('ALLOW_EMPTY', false);
        $oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris email@webdomain.com|jharris@WEBDOMAIN.com|j5@webdomain.com');
        $oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan Harris|');

        $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;


    break;
    case 'LOCALHOST_PC':

    break;
    default:

        //
        // HOOOSTON...VE HAF PROBLEM!
        throw new Exception('An unknown...and hence unhandled...environmental reference key,"'.$this->env_cleartext_name.'", has been provided for this environment. CRNRSTN :: configuration resource wildcards cannot be initialized without an acknowledged key.');

    break;
}