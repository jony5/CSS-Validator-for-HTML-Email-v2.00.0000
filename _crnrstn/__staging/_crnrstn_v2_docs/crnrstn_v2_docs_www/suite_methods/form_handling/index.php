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

$iAmMobileBOOL = $oCRNRSTN_USR->isClientMobile(true);

if($iAmMobileBOOL){
    //
    // MOBILE/TABLET DEVICE EXPERIENCE
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

        $tmp_HTML = $oSideBitch_Usr->returnPageHTML($tmp_page_serial);

        ?>
        <div class="cb"></div>
        <div id="body_shell">
            <?php
            include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/nav/sidenav.inc.php');
            ?>
            <div id="body_content_area">
                <?php
                echo $tmp_HTML;
                ?>
            </div>
        </div>

        <div class="cb_40"></div>
        <?php
        include_once($oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").'/common/inc/footer/footer.inc.php');
        ?>

    </div>


    </body>
    </html>

    <?php
}
?>