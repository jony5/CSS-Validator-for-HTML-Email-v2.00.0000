<?php
$tmp_ROOT_HTTP = $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR');

$tmp_str = '<div data-role="panel" id="leftpanel_nav">
    <a href="#close_lnk" data-rel="close" data-icon="delete" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini ui-btn-icon-right">Close</a>
    <p><strong>Welcome, friend ::</strong></p>
    <div data-role="collapsibleset" data-theme="a" data-content-theme="a">
        <div>
            <h3>Suite Methods by Purpose</h3>
            <ul data-role="listview" data-theme="a">
                <li><a href="#popupConfigFile" data-rel="popup" data-transition="slideup">Configuration File</a></li>
                <li><a href="#popupLogging" data-rel="popup" data-transition="slideup">Logging</a></li>
            </ul>
        </div>
    </div>

    <div data-role="popup" id="popupConfigFile" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/crnrstn/" target="_self" data-ajax="false">crnrstn()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/addenvironment/" target="_self" data-ajax="false">addEnvironment()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/init_crnrstn_aserrorhandler/" target="_self" data-ajax="false">init_CRNRSTN_asErrorHandler()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/set_crnrstn_aserrorhandler/" target="_self" data-ajax="false">set_CRNRSTN_asErrorHandler()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/initsystemnoticesimagesmode/" target="_self" data-ajax="false">initSystemNoticesImagesMode()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/initsystemnotices_imghttp_dir/" target="_self" data-ajax="false">initSystemNotices_imgHTTP_DIR()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/initresourcewildcards/" target="_self" data-ajax="false">initResourceWildCards()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/initlogging/" target="_self" data-ajax="false">initLogging()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/adddatabase/" target="_self" data-ajax="false">addDatabase()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/grantexclusiveaccess/" target="_self" data-ajax="false">grantExclusiveAccess()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/denyaccess/" target="_self" data-ajax="false">denyAccess()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/initsessionencryption/" target="_self" data-ajax="false">initSessionEncryption()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/initcookieencryption/" target="_self" data-ajax="false">initCookieEncryption()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/inittunnelencryption/" target="_self" data-ajax="false">initTunnelEncryption()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/requireddetectionmatches/" target="_self" data-ajax="false">requiredDetectionMatches()</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/configuration_file/defineenvresource/" target="_self" data-ajax="false">defineEnvResource()</a></li>
        </ul>
    </div>

    <div data-role="popup" id="popupLogging" data-theme="a">
        <ul data-role="listview" data-inset="true" data-filter="true" style="min-width:210px;">
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/logging/" target="_self" data-ajax="false">Overview</a></li>
            <li><a href="'.$tmp_ROOT_HTTP.'suite_methods/logging/error_log/" target="_self" data-ajax="false">error_log()</a></li>
        </ul>
    </div>

</div><!-- /panel -->
';


$oUSER->add_content_resource($tmp_str, JONY5_CONTENT_MOBILE_SIDE_NAV);
unset($tmp_str);