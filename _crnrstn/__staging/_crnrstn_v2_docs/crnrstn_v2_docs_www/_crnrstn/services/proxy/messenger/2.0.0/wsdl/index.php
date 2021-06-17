<?php
/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
require($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

//
// INSTANTIATE SOAP SERVER AND PROVIDE SESSION ACCESS TO ENVIRONMENTAL CLASS OBJECT
$server = new soap_server();
$server->debug_flag = false;
$server->configureWSDL("CRNRSTN_SOAP_SERVICES", $oCRNRSTN_USR->getEnvResource('SOA_NAMESPACE'));
$server->wsdl->schemaTargetNamespace = $oCRNRSTN_USR->getEnvResource('SOA_NAMESPACE');
$_SESSION['oCRNRSTN_USR']=$oCRNRSTN_USR;

//
// REGISTER THE DATA STRUCTURES USED BY THE SERVICE
$server->wsdl->addComplexType(
    'oElectrumPerformanceReport',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PACKET_IS_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_IS_ENCRYPTED',  'type' => 'xsd:string' ),
        'CRNRSTN_PROXY_AUTH_KEY' => array( 'name' => 'CRNRSTN_PROXY_AUTH_KEY',  'type' => 'xsd:string' ),
        'CRNRSTN_PROXY_EMAIL_PROTOCOL' => array( 'name' => 'CRNRSTN_PROXY_EMAIL_PROTOCOL',  'type' => 'xsd:string' ),
        'oRECIPIENT' => array( 'name' => 'oRECIPIENT',  'type' => 'tns:oEmailArray' ),
        'oSENDER' => array( 'name' => 'oSENDER',  'type' => 'tns:oEmailArray' ),
        'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
        'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
        'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
        'SUPPRESS_DUPLICATE_RECIPIENT' => array( 'name' => 'SUPPRESS_DUPLICATE_RECIPIENT',  'type' => 'xsd:string' ),
        'MESSAGE_SUBJECT' => array('name' => 'MESSAGE_SUBJECT', 'type' => 'xsd:string' ),
        'WORD_WRAP' => array('name' => 'WORD_WRAP', 'type' => 'xsd:string' ),
        'PRIORITY' => array('name' => 'PRIORITY', 'type' => 'xsd:string' ),
        'IS_HTML' => array('name' => 'IS_HTML', 'type' => 'xsd:string' ),
        'SYS_MESSAGE_TITLE_HTML' => array('name' => 'SYS_MESSAGE_TITLE_HTML', 'type' => 'xsd:string' ),
        'SYS_MESSAGE_TITLE_TEXT' => array('name' => 'SYS_MESSAGE_TITLE_TEXT', 'type' => 'xsd:string' ),
        'SYS_LOG_INTEGER_CONSTANT' => array('name' => 'SYS_LOG_INTEGER_CONSTANT', 'type' => 'xsd:string' ),
        'SYS_MESSAGE_HTML' => array('name' => 'SYS_MESSAGE_HTML', 'type' => 'xsd:string' ),
        'SYS_MESSAGE_TEXT' => array('name' => 'SYS_MESSAGE_TEXT', 'type' => 'xsd:string' ),
        'SYS_REMOTE_ADDR' => array('name' => 'SYS_REMOTE_ADDR', 'type' => 'xsd:string' ),
        'SYS_SERVER_NAME' => array('name' => 'SYS_SERVER_NAME', 'type' => 'xsd:string' ),
        'SYS_SYSTEM_TIME' => array('name' => 'SYS_SYSTEM_TIME', 'type' => 'xsd:string' ),
        'SYS_PROCESS_RUN_TIME' => array('name' => 'SYS_PROCESS_RUN_TIME', 'type' => 'xsd:string' ),
        'ELECTRUM_ERRORS_TRACE_HTML' => array('name' => 'ELECTRUM_ERRORS_TRACE_HTML', 'type' => 'xsd:string' ),
        'ELECTRUM_ERRORS_TRACE_TITLE_TEXT' => array('name' => 'ELECTRUM_ERRORS_TRACE_TITLE_TEXT', 'type' => 'xsd:string' ),
        'ELECTRUM_ERRORS_TRACE_TEXT' => array('name' => 'ELECTRUM_ERRORS_TRACE_TEXT', 'type' => 'xsd:string' ),
        'ELECTRUM_START_TIME' => array('name' => 'ELECTRUM_START_TIME', 'type' => 'xsd:string' ),
        'ELECTRUM_END_TIME' => array('name' => 'ELECTRUM_END_TIME', 'type' => 'xsd:string' ),
        'ELECTRUM_PRETTY_RUN_TIME' => array('name' => 'ELECTRUM_PRETTY_RUN_TIME', 'type' => 'xsd:string' ),
        'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_TOTAL_COUNT_FILES_TRANSFERRED', 'type' => 'xsd:string' ),
        'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED' => array('name' => 'ELECTRUM_TOTAL_COUNT_FILES_SKIPPED', 'type' => 'xsd:string' ),
        'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_TOTAL_FILESIZE_FILES_TRANSFERRED', 'type' => 'xsd:string' ),
        'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED' => array('name' => 'ELECTRUM_TOTAL_ERRORS_FILES_TRANSFERRED', 'type' => 'xsd:string' ),
        'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR' => array('name' => 'ELECTRUM_TOTAL_COUNT_ENDPOINT_CONNECTION_ERROR', 'type' => 'xsd:string' ),
        'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED' => array('name' => 'ELECTRUM_PERCENTAGE_FILES_SUCCESSFUL_TRANSFERRED', 'type' => 'xsd:string' ),
        'ELECTRUM_DATA_SOURCE_HTML' => array('name' => 'ELECTRUM_DATA_SOURCE_HTML', 'type' => 'xsd:string' ),
        'ELECTRUM_DATA_DESTINATION_HTML' => array('name' => 'ELECTRUM_DATA_DESTINATION_HTML', 'type' => 'xsd:string' ),
        'ELECTRUM_DATA_HANDLING_PROFILE_HTML' => array('name' => 'ELECTRUM_DATA_HANDLING_PROFILE_HTML', 'type' => 'xsd:string' ),
        'ELECTRUM_DATA_SOURCE_TEXT' => array('name' => 'ELECTRUM_DATA_SOURCE_TEXT', 'type' => 'xsd:string' ),
        'ELECTRUM_DATA_DESTINATION_TEXT' => array('name' => 'ELECTRUM_DATA_DESTINATION_TEXT', 'type' => 'xsd:string' ),
        'ELECTRUM_DATA_HANDLING_PROFILE_TEXT' => array('name' => 'ELECTRUM_DATA_HANDLING_PROFILE_TEXT', 'type' => 'xsd:string' )

    )
);

$server->wsdl->addComplexType(
	'oKingsHighwayNotification',
	'complexType',
	'struct',
	'all',
	'',
	array(
        'CRNRSTN_PACKET_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_ENCRYPTED',  'type' => 'xsd:string' ),
		'CRNRSTN_PROXY_AUTH_KEY' => array( 'name' => 'CRNRSTN_PROXY_AUTH_KEY',  'type' => 'xsd:string' ),
		'oRECIPIENT' => array( 'name' => 'oRECIPIENT',  'type' => 'tns:oEmailArray' ),
		'oSENDER' => array( 'name' => 'oSENDER',  'type' => 'tns:oEmailArray' ),
		'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
		'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
		'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
        'MESSAGE_SUBJECT' => array('name' => 'MESSAGE_SUBJECT', 'type' => 'xsd:string' ),
		'MESSAGE_BODY_HTML' => array('name' => 'MESSAGE_BODY_HTML', 'type' => 'xsd:string' ),
		'MESSAGE_BODY_TEXT' => array('name' => 'MESSAGE_BODY_TEXT', 'type' => 'xsd:string' ),
		'WORD_WRAP' => array('name' => 'WORD_WRAP', 'type' => 'xsd:string' ),
		'PRIORITY' => array('name' => 'PRIORITY', 'type' => 'xsd:string' ),
		'IS_HTML' => array('name' => 'IS_HTML', 'type' => 'xsd:string' )
	)
);

$server->wsdl->addComplexType(
    'oEmailArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:oEmail[]'
        )
    ),
    'tns:oEmail'
);

/*
$server->wsdl->addComplexType(
    'oEmailArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'xsd:integer[]'
        )
    ),
    'xsd:integer'
);
*/

$server->wsdl->addComplexType(
    'oEmail',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'EMAIL_PROXY_SERIAL' => array( 'name' => 'EMAIL_PROXY_SERIAL',  'type' => 'xsd:string' ),
        'EMAILADDRESS' => array( 'name' => 'EMAILADDRESS',  'type' => 'xsd:string' ),
        'FIRSTNAME' => array( 'name' => 'FIRSTNAME',  'type' => 'xsd:string' ),
        'LASTNAME' => array( 'name' => 'LASTNAME',  'type' => 'xsd:string' )
    )
);

$server->wsdl->addComplexType(
    'oEmailSendReport',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CRNRSTN_PROXY_AUTH_KEY' => array( 'name' => 'CRNRSTN_PROXY_AUTH_KEY',  'type' => 'xsd:string' ),
        'REQUEST_RECEIVED_TIMESTAMP' => array( 'name' => 'REQUEST_RECEIVED_TIMESTAMP',  'type' => 'xsd:string' ),
        'REQUEST_COMPLETED_TIMESTAMP' => array( 'name' => 'REQUEST_COMPLETED_TIMESTAMP',  'type' => 'xsd:string' ),
        'REQUEST_RUNTIME' => array( 'name' => 'REQUEST_RUNTIME',  'type' => 'xsd:string' ),
        'TOTAL_EMAILS_RECEIVED' => array( 'name' => 'TOTAL_EMAILS_RECEIVED',  'type' => 'xsd:string' ),
        'TOTAL_EMAILS_SENT' => array( 'name' => 'TOTAL_EMAILS_SENT',  'type' => 'xsd:string' ),
        'TOTAL_EMAILS_SUPPRESSED' => array( 'name' => 'TOTAL_EMAILS_SUPPRESSED',  'type' => 'xsd:string' ),
        'TOTAL_EMAILS_ERROR' => array( 'name' => 'TOTAL_EMAILS_ERROR',  'type' => 'xsd:string' ),
        'ACTIVITY_STATUS_MESSAGE' => array( 'name' => 'ACTIVITY_STATUS_STRING',  'type' => 'xsd:string' ),
        'oACTIVITY_STATUS_REPORT' => array( 'name' => 'oACTIVITY_STATUS_REPORT', 'type' => 'tns:oStatusReportArray' )
    )
);

$server->wsdl->addComplexType(
    'oStatusReportArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array('name'=>array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:oStatusReport[]')
    ),
    'tns:oStatusReport'
);


$server->wsdl->addComplexType(
    'oStatusReport',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'EMAIL_PROXY_SERIAL' => array( 'name' => 'EMAIL_PROXY_SERIAL',  'type' => 'xsd:string' ),
        'IS_SENT' => array( 'name' => 'IS_SENT',  'type' => 'xsd:string' ),
        'SEND_TIMESTAMP' => array( 'name' => 'SEND_TIMESTAMP',  'type' => 'xsd:string' ),
        'SEND_STATUS' => array( 'name' => 'SEND_STATUS',  'type' => 'xsd:string' ),
        'STATUS_DETAIL' => array( 'name' => 'STATUS_DETAIL',  'type' => 'xsd:string' )
    )
);

function takeTheKingsHighway($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE WEB SERVICE REQUEST MANAGER
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    $_SESSION['oCRNRSTN_USR'] = NULL;

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->takeTheKingsHighway($soapRequest);

    return $SERVICE_RESPONSE;

}

function send_electrumPerformanceReport($soapRequest) {

    $SERVICE_RESPONSE = '';

    //
    // INSTANTIATE WEB SERVICE REQUEST MANAGER
    $oSERVICE_REQUEST_MGR = new crnrstn_soa_endpoint_request_manager($_SESSION['oCRNRSTN_USR']);

    $_SESSION['oCRNRSTN_USR'] = NULL;

    //
    // PROCESS SOAP REQUEST AND RETURN RESULT (SOAP)
    $SERVICE_RESPONSE = $oSERVICE_REQUEST_MGR->send_electrumPerformanceReport($soapRequest);

    return $SERVICE_RESPONSE;

}

$server->register('takeTheKingsHighway',     		 	   		            // method name
    array('oKingsHighwayNotification' => 'tns:oKingsHighwayNotification'),	    // input parameters
    array('return' => 'tns:oEmailSendReport'),								    // output parameters
    'urn:takeTheKingsHighwaywsdl',                		            // namespace
    'urn:takeTheKingsHighwaywsdl#takeTheKingsHighway',	            // soapaction
    'rpc',                                    					        // style
    'encoded',                                						        // use
    'Straight send an email message with no changes (i.e. dynamic content injection) to body.'		// documentation
);

$server->register('send_electrumPerformanceReport',     		 	   		            // method name
    array('oElectrumPerformanceReport' => 'tns:oElectrumPerformanceReport'),	            // input parameters
    array('return' => 'tns:oEmailSendReport'),								                // output parameters
    'urn:send_electrumPerformanceReportwsdl',                		                // namespace
    'urn:send_electrumPerformanceReportwsdl#send_electrumPerformanceReport',	    // soapaction
    'rpc',                                    					                    // style
    'encoded',                                						                    // use
    'Send a templated system notification reporting on the performance of a CRNRSTN Electrum process.'		// documentation
);

if(!$oCRNRSTN_USR->isset_HTTPSuper('GET')){

	//if($oCRNRSTN_USR->exclusiveAccess('184.173.96.66, 50.87.249.11, 172.16.110.130, 172.16.*')){

	    $server->service(file_get_contents('php://input'));

	//}else{

    //    $oCRNRSTN_USR->returnSrvrRespStatus(403);

	//}

}else{

	$server->service(file_get_contents('php://input'));

}

exit();