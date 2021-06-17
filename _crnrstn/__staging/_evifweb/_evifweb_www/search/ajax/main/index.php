<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USERS
#$adminContent_ARRAY = $oUSER->loadClientSettings();


$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
				'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4
				);


if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
/*
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 01!</a></li>
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 02!</a></li>
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 03!</a></li>
<li><a href="http://www.jony5.com" target="_self">Hello Mobile Ajax 04!</a></li>
*/
?>["Norcross, GA, United States", "Norcross, MN, United States"]
<?php 
}else{
?>



<?php
}
?>
