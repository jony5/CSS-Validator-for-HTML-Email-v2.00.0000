<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

$tmp_serial_handle = 'STREAM_META';
$oDB_RESP = $oUSER->prepStreamDeepData($tmp_serial_handle);

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
	
?>	
<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
?>

</head>

<body>

<div data-role="page" id="myPage">
    <?php
	
	//
	// KIVOTOS MENU [NEW/BACK - FILTER RESULTS - ACTIIVITY LOG]
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');								// CUSTOM NAV CLASS
	$oMiniNav = new miniNav('back');
	$oMiniNav->configureLink('back', $oCRNRSTN_ENV->paramTunnelDecrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'ruri')));
	
	$xxxFILTERHASBEENAPPLIEDTORESULTSxxx = true;
	if($xxxFILTERHASBEENAPPLIEDTORESULTSxxx){
		$oMiniNav->configureLink('editFilter', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/filter/');
		
	}
	
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
        <?php

        //
        // SO I THINK WHAT IS HERE IS ACCEPTABLE. WHEN IT COMES TO STREAM IMPLEMENTATION ON A PAGE, THIS IS ALL THAT IS REQUIRED.
        $oSTREAM_MGR = new stream_manager($oCRNRSTN_ENV, $oUSER);
        $tmp_serial = "Hallelujah, Christ is Victor!";
        $tmp_stream_type = 'DEEP';
        $tmp_resp_obj_profile = 'DEEP';          // THIS WILL TELL US WHAT DATA TO PULL FROM DB RESPONSE OBJECT. PIPE DELIM.
        $tmp_resp_obj_profile_key_fields = 'DEEP';    // THIS WILL TELL US KEY FIELD FOR DATA PROFILE. PIPE DELIM.

        echo $oSTREAM_MGR->return_streams('WEB', $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE"), $tmp_stream_type, $tmp_resp_obj_profile, $tmp_resp_obj_profile_key_fields, $tmp_serial, $oDB_RESP);
        echo '<div id="stream_dom_handles" class="hidden">'.$oSTREAM_MGR->stream_vert_flow_DOM_handles.'</div>';

        ?>

        <div class="cb_20"></div>
        
	</div><!-- /content -->


	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>

<?php 

}else{
?>

<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>


<main id="content">
<?php 
define('APACHE_MIME_TYPES_URL','http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');

function generateUpToDateMimeArray($url){
    $s=array();
    foreach(@explode("\n",@file_get_contents($url))as $x)
        if(isset($x[0])&&$x[0]!=='#'&&preg_match_all('#([^\s]+)#',$x,$out)&&isset($out[1])&&($c=count($out[1]))>1)
            for($i=1;$i<$c;$i++)
                $s[]='&nbsp;&nbsp;&nbsp;\''.$out[1][$i].'\' => \''.$out[1][0].'\'';
    return @sort($s)?'$mime_types = array(<br />'.implode($s,',<br />').'<br />);':false;
}

echo generateUpToDateMimeArray(APACHE_MIME_TYPES_URL);
?>

</main>


<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');

?>
</body>
</html>

<?php
}
?>