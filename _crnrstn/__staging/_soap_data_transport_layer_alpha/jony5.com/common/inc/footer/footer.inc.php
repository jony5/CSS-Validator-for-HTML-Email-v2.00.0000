<?php
if($oCRNRSTN_USR->is_client_mobile(true)){
    //
    // MOBILE DEVICE SPECIFIC CONTENT
    ?>

    <div data-role="footer" data-theme="a" data-content-theme="a">
        <h4>&copy; <?php  echo date("Y"); ?> All Rights Reserved.</h4>

    </div><!-- /footer -->
    <div class="hidden">
        <!-- GLOBAL XHR SUPPORT CONTAINERS -->

        <div id="ajax_root"><?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>
        <div id="timer_copy_persist">0:00:00</div>
        <div id="cache_bust">12345</div>

    </div>

    <?php

}else{
    //
    // DESKTOP DEVICE SPECIFIC CONTENT
    $tmp_str = '';

    $tmp_str = '<div class="cb_3"></div>
<div class="crnrstn_footer_wrapper">
    <div class="crnrstn_footer_copy_wrapper">
        <div class="crnrstn_footer_copyright">&copy; 2012 - '.date('Y').' Jonathan \'J5\' Harris, All Rights Reserved.</div>
        <div class="crnrstn_jony5_footer">'.$oCRNRSTN_USR->return_email_creative('5').'</div>
    </div>
</div>
<div class="hidden">
    <div id="ajax_root">'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'</div>
    <div id="timer_copy_persist">0:00:00</div>
    <div id="timer_lck">OFF</div>
    <div id="cache_bust">'.$oCRNRSTN_USR->generate_new_key(15, '01').'</div>
    <div id="curr_search_profile"></div>
</div>
';

    $oUSER->add_content_resource($tmp_str, JONY5_CONTENT_DESKTOP_FOOTER);
    unset($tmp_str);

}