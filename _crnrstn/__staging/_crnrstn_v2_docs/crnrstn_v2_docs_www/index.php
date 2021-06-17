<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PAGE CONTENT AGGREGATION PERFORMED BY MY BOTTOM BITCH SIDE USER CLASS OBJECT
$oSideBitch_Usr = new sideload_user($oCRNRSTN_USR);
$oSideBitch_Usr->initializePageContent();
$oSideBitch_Usr->loadPage();
$oSideBitch_Usr->indexPage();
$tmp_page_serial = $oSideBitch_Usr->returnPageSerial();

$mobileBOOL = $oCRNRSTN_USR->isClientMobile(true);

if($mobileBOOL){
    //
    // MOBILE/TABLET DEVICE EXPERIENCE
    /*
     * To prefetch a page, add the data-prefetch attribute to a link that points to the page.
     * data-prefetch="true"
     * */
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/head/head.inc.php');
        ?>
    </head>

    <body>
    <div data-role="page" id="myPage">
        <?php

        $tmp_HTML = $oSideBitch_Usr->returnPageHTML($tmp_page_serial, 'mobile');

        $tmp_formUnique = $oCRNRSTN_USR->generateNewKey(4);
        $tmp_pageName_Header =  strtolower($oSideBitch_Usr->getCategory($tmp_page_serial)).' ::';
        require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
        require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/nav/sidenav.mobi.inc.php');
        require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');


        $tmp = '420';
        switch($tmp){
            case '420':
                //
                // AV SERVICE SAINT
                //$oMiniNav = new miniNav('avservice_saint');
                //$oMiniNav->configureLink('streams', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/streams/?kid='.$oCRNRSTN_USR->oHTTP_MGR->extractData($_GET, 'kid'));
                //$oMiniNav->configureLink('obs clients', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/');
                //$oMiniNav->configureLink('logs', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/logs/');
                //$oMiniNav->configureLink('refresh', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');

            break;
            case '320':
                //
                // SAINT SERVING TRANSLATION
                $oMiniNav = new miniNav('translation_saint');
                //$oMiniNav->configureLink('streams', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/streams/?kid='.$oCRNRSTN_USR->oHTTP_MGR->extractData($_GET, 'kid'));
                $oMiniNav->configureLink('logs', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/logs/');
                $oMiniNav->configureLink('refresh', $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');

            break;

        }

        //$tmp_formUnique = $oCRNRSTN_USR->generateNewKey(4);
        //$tmp_pageName_Header = 'home ::';
        //require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
        //require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/nav/sidenav.mobi.inc.php');
        //require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');

        ?>

        <!--
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content" id="myPage">
            <?php
            echo $tmp_HTML;
            ?>

        </div><!-- /content -->

        <?php
        require($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');

        ?>

    </div><!-- /page -->

    </body>
    </html>
<?php
}else{
    //
    // DESKTOP EXPERIENCE
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/head/head.inc.php');
        ?>
    </head>
    <body>
    <div id="body_wrapper">
        <?php
        include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/header/header.inc.php');
        ?>
        <div class="cb"></div>
        <div id="body_shell">
            <?php
            include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/nav/sidenav.inc.php');
            ?>
            <div id="body_content_area">

                <?php
                $tmp_HTML = $oSideBitch_Usr->returnPageHTML($tmp_page_serial);
                echo $tmp_HTML;
                ?>
            </div>
        </div>

        <div class="cb_30"></div>
        <?php
        include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/footer/footer.inc.php');
        ?>

    </div>
    </body>
    </html>

<?php
}
?>