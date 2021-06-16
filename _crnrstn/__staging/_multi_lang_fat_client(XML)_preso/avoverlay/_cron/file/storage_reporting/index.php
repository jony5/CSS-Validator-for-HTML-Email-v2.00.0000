<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');


//
// RETRIEVE USER DATA
#$adminContent_ARRAY = $oUSER->getKivotosData();

// DECOUPLED DOWNLOAD VALIDATION PROCESS ::
// 1	#if(strlen(self::$oUserEnvironment->oSESSION_MGR->getSessionParam('USERID'))==50){
// 2	# NEED THE FOLLOWING PASSED TO MOTHERSHIP FOR USER VALIDATION ::
//			A) session_id()
//			B) USERID
//			C) $_SERVER['REMOTE_ADDR']
// 3	# confirm IP address has not changed
// = = = = = = = = = = = = = = = = = = = = = = = =


//
// INSTANTIATE DATABASE INTEGRATION / LOGGING
$oDB = new database_integration();
$oLogger = new crnrstn_logging();
$errMsg = "";
try{
	
	//
	// INSTANTIATE ASSET MANAGER
	$assetMgr = new asset_manager($oUSER, $oCRNRSTN_ENV, $oDB);
	
	//
	// BUILD WORKING DATA SET VIA QUERY OF DB FOR LOG DATA AND CUM DATA
	$tmp_assetCnt = $assetMgr->initStorageReportSync();
	
	if($tmp_assetCnt==0){
		die();	
	}
	
	//
	// PROCESS NEW FILES AND UPDATE CUM FOR REPORTING SYNC.
	$assetMgr->prepReportSync();
	
	//
	// SEND TO DB QUERY WHERE WE WILL BUILD SYNC MULTI-QUERY
	$assetMgr->dbReportingSync();
	
}catch( Exception $e ) {
	//
	// SEND THIS THROUGH THE LOGGER OBJECT
	$oLogger->captureNotice('database_integration->dbQuery()', LOG_EMERG, $e->getMessage());
	
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');
	
	//
	// LANGUAGE SUPPORT
	$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|LABEL_LAST_LOGIN|TEXT_SET';
	$tmp_lang_elem .= '|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_JOB_TITLE|INPUT_TITLE_ISO_CODE|INPUT_TITLE_EMAIL|PAGE_TITLE_USER_SETTINGS|PAGE_USER_SETTINGS_DESCR';
	$oUSER->prepLangElem($tmp_lang_elem);
	
	//
	// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');
	
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
            $tmp_formUnique = $oUSER->generateNewKey(4);
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
            ?>
            
            <!-- 
            //
            // BEGIN MAIN CONTENT -->
            <div role="main" class="ui-content">
                <h3><span>asset download denied</span></h3>
                <p><?php echo $errMsg; ?></p>
                <div class="cb_10"></div>
               
            </div><!-- /content -->
        
            <?php
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
            
            ?>
        
        </div><!-- /page -->
        
        </body>
        </html>
            
        <?php
	
	}else{
		
		echo "desktop asset download error...";
		
		
		
		
	}
	
}



#$oUSER->verifyDownloadReqIntegrity();
#$oUSER->authorizeDownloadRequest();


	
	//
	// VALIDATE USER REQUEST DATA AGAINST SERVICE 
//	if($oUSER->validateDownloadRequest()){
//		
//		header("Content-Type: image/jpeg");
//		
//		$url  = 'http://jony5.com/common/imgs/banner_1180x250/banner_j5_dunk.jpg';
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_HEADER, false);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//		curl_setopt($ch, CURLOPT_USERAGENT, 'Evifweb Asset Handler 1.0');
//		$res = curl_exec($ch);
//		$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
//		curl_close($ch) ;
//		
//		if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
//			echo $res;
//		}else{
//			echo $res;
//		}		
//	}
	
?>