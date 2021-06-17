<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');
$tmp_navOnly=true;
require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

//
// RETRIEVE NAVIGATION CONTENT (SOAP)
$tmp_dataMode = explode('|',$oCRNRSTN_USR->getEnvResource('DATA_MODE'));
if($tmp_dataMode[0]=='SOAP'){
	$oCRNRSTN_USR->navigationRetrieve();
}
$page_title = "ABOUT";

?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<div id="admin_form_shell"></div>
<div id="admin_overlay"></div>
<div id="content_wrapper">
	<div id="top_border" ></div>
	<div id="header_shell_bkgd"></div>
	<div id="header_shell_wrapper">
		<div id="header_shell">
			<div class="cb"></div>
			<div id="header_content">
				<?php
				require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
				?>
			</div>
		</div>
	</div>
	<?php
	require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/comments/feedback.inc.php');
	?>
	<div id="content_area_wrapper">
		<div id="content_area_main">
			<div id="doc_nav_wrapper">
				<h2 id="nav_title_element">Classes</h2>
				<?php
				require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/nav/docnav.inc.php');
				?>
			</div>
			<div id="doc_content_results_wrapper">
				<div id="doc_content_results">
					<h1 id="content_results_title">an amalekite princess ::</h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="cb_5"></div>
                        
						<h3 class="content_results_subtitle">Scriptures :: <span style="font-size:11px;">(scrollable section)</span></h3>
						<div class="content_results_subtitle_divider"></div>


                        <div class="cb_15"></div>
                        <h3 class="content_results_subtitle">Revelation ::</h3>
						<div class="content_results_subtitle_divider"></div>

						<div class="cb_15"></div>
                        <h3 class="content_results_subtitle">Application ::</h3>
						<div class="content_results_subtitle_divider"></div>


						
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="cb"></div>
	<div id="footer_shell_wrapper">
		<?php
		require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
		?>	
	</div>
</div>
</body>
</html>