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
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|TEXT_CLICK_HERE|PROXY_REDIRECT_HELP';
$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE RESPONSE OBJECT
$tmp_serial_handle = 'PROXY';
$oDB_RESP = $oUSER->getProxyData($tmp_serial_handle);

# I WANT THIS PAGE TO BE AS LIGHT AS POSSIBLE...CLIENT-SIDE. NO DOWNLOADS OF SUPPORT FILES (ALTHOUGH, THEY
# WOULD BE CACHED BY BROWSER ANYWAYS....) SO PROBABLY NO JS/CSS INCLUDES. WE WILL PUT EVERYTHING HERE.


if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
?>

<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
    <meta http-equiv="refresh" content="0; url=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'URI'); ?>" />
    <style>
        p               { padding:10px; font-size: 15px;}

    </style>
</head>
<body>
<p><a href="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'URI'); ?>" target="_self"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('PROXY_REDIRECT_HELP'); ?></p>
</body>
</html>

<?php
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="0; url=<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'URI'); ?>" />
    <style>
        p               { padding:10px; font-size: 15px;}

    </style>
</head>

<body>
<p><a href="<?php echo $oDB_RESP->return_data_element($oDB_RESP->return_serial(), 'PROXY', 'URI'); ?>" target="_self"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('PROXY_REDIRECT_HELP'); ?></p>
</body>
</html>
<?php
}
?>
