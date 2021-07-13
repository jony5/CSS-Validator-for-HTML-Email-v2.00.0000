<?php

$tmp_str = '<div data-role="header" data-position="fixed">
         <div style="float:left; padding:5px; padding-bottom:0px; margin:5px;">
            <div data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;">
            <!--<a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext">Home</a>-->
                <a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Nav</a>
                <!-- <a href="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-notext" data-ajax="false">Dashboard</a> -->
                <a href="#rightpanel_search" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext">Search</a>
            </div>
        </div>

        <!-- <div style="height:110px; overflow: hidden;">-->
        <div style="float:right;padding:12px 10px 0 0; "><a href="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'" data-ajax="false" style="text-decoration:none;"><img src="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/stache.gif" width="66" height="21" alt="mustache" title="Jonathan J5 Harris"></a></div>
        <h1 style="padding-top:20px; text-align: left;">C<span class="the_R">R</span>NRSTN :: 2.0.0</h1>
        <div class="cb"></div>
        <!-- </div> -->

        <div id="hdr_dbl_hr_shell" class="hdr_dbl_hr_shell">
            <div id="hdr_hr_top" class="hdr_hr_top"></div>
            <div id="hdr_hr_btm" class="hdr_hr_btm"></div>
        </div>
        
        <h3 style="text-align:left; margin-left: 15px; padding-bottom:10px; font-weight:bold;">PAGE HEADER 00 HERE</h3><div class="hdr_pg_ttl_hr_btm"></div>

        <div data-role="controlgroup" data-type="horizontal" data-mini="true">
            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">

            <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-inline" data-ajax="false">Back</a>

            <a href="#" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline" data-ajax="false" onclick="window.open(\'#\', \'_self\')">Refresh</a>

            </fieldset>
        </div>

	</div><!-- /header -->
';


$oUSER->add_content_resource($tmp_str, JONY5_CONTENT_MOBILE_PAGE_HEADER);
unset($tmp_str);
