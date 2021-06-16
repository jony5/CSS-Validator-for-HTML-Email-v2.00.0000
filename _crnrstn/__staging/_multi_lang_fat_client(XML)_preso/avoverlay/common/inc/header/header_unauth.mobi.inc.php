	<div data-role="header" data-position="fixed" style="background-color:#FFF;">
         <div style="float:left; padding:5px; padding-bottom:0px; margin:5px;">
            <div data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;">
                <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext"  data-ajax="false">Home</a>
                <a href="#rightpanel_contact" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-mail ui-btn-icon-notext">Contact</a>
                <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>account/signin/" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-lock ui-btn-icon-notext" data-transition="slidedown">Sign In</a>
            </div>

        </div>
        <h1 style="padding-top:20px;">AV Service</h1>
        <div id="hdr_dbl_hr_shell">
            <div id="hdr_hr_top"></div>
            <div id="hdr_hr_btm"></div>
        </div>
	</div><!-- /header -->