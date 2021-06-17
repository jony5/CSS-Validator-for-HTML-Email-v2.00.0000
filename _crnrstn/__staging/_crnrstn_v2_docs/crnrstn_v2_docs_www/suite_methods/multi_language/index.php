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

                if(1==2){

                ?>

                <div class="section_title">Technical specifications ::</div>
                <div class="content_results_subtitle_divider"></div>
                <div class="tech_specs_wrapper">
                    <ul>
                        <li>Currently tested on an Ubuntu Server 16.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.</li>
                        <li>It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.</li>
                    </ul>
                </div>

                <div class="section_title">Invoking class ::</div>
                <div class="content_results_subtitle_divider"></div>
                <div class="basic_section_content">crnrstn_user</div>

                <div class="section_title">Method definition ::</div>
                <div class="content_results_subtitle_divider"></div>
                <div class="basic_section_content">methodName($param00,$param01)</div>

                <div class="section_title">Method parameter definitions ::</div>
                <div class="content_results_subtitle_divider"></div>
                <div class="basic_section_content">
                    <div class="method_parameter">$resourceKey&nbsp;<span class="parameter_require_required">(Required)</span></div>
                    <blockquote class="method_parameter_definition">A user-defined key representing information that the application will be accessing...as specified in the C<span class="\&quot;the_R\&quot;">R</span>NRSTN Suite :: configuration file. E.g. "ROOT_PATH_CLIENT_HTTP","SSL_ENABLED", "DOCUMENT_ROOT" or "FREEDOWNLOADLINK".</blockquote>

                    <div class="method_parameter">$resourceKey&nbsp;<span class="parameter_require_required">(Required)</span></div>
                    <blockquote class="method_parameter_definition">A user-defined key representing information that the application will be accessing...as specified in the C<span class="\&quot;the_R\&quot;">R</span>NRSTN Suite :: configuration file. E.g. "ROOT_PATH_CLIENT_HTTP","SSL_ENABLED", "DOCUMENT_ROOT" or "FREEDOWNLOADLINK".</blockquote>

                    <div class="method_parameter">$resourceKey&nbsp;<span class="parameter_require_required">(Required)</span></div>
                    <blockquote class="method_parameter_definition">A user-defined key representing information that the application will be accessing...as specified in the C<span class="\&quot;the_R\&quot;">R</span>NRSTN Suite :: configuration file. E.g. "ROOT_PATH_CLIENT_HTTP","SSL_ENABLED", "DOCUMENT_ROOT" or "FREEDOWNLOADLINK".</blockquote>
                </div>

                <div class="section_title">Returned value ::</div>
                <div class="content_results_subtitle_divider"></div>
                <div class="basic_section_content">The $resourceValue assigned to the $resourceKey through the crnrstn :: defineEnvResource() method calls in the configuration file.</div>


                <div class="body_content_title"><?php echo strtolower($oSideBitch_Usr->getSubCategory($tmp_page_serial)); ?> ::</div>
                <!--<h3 class="content_results_subtitle">device detection ::</h3>-->
                <div class="content_results_subtitle_divider"></div>

                <div class="crnrstn_page_description">Here is a description of this functionality. Even mentioning example(s) below is OK in this location of the web document. Aenean ornare mi sed urna condimentum molestie. Nam quis bibendum arcu. Nulla vestibulum dapibus enim, ut posuere mi porta vel. Nunc pharetra sed sapien ut maximus. Donec et lectus diam. Sed eleifend, quam non congue interdum, quam sem egestas lorem, sit amet pellentesque ipsum ex at eros. Integer sapien orci, mollis et arcu non, commodo tempor sapien. Maecenas vel eros ut eros tristique finibus.</div>

                <div class="crnrstn_note_wrapper">
                    <div class="crnrstn_note_crnrstn_icon" style="background-image: url('<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm.png'); background-repeat: no-repeat; width:50px; height:30px; float:right;"></div>
                    <div class="crnrstn_note_notetitle">Note ::</div>
                    <div class="crnrstn_note_notecopy">This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it's developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.</div>
                    <div class="cb"></div>
                </div>

                <div class="crnrstn_example_title_wrapper">
                    <div class="crnrstn_example_title">Example 1 ::</div>
                    <div class="crnrstn_example_description">Retrieve boolean response indication of the existence of conditions which are...to a high degree of probability...an indication that this is a request originating from a mobile device or tablet computer.</div>
                </div>

                <?php
                $str = '<?php
/*
// J5
// Code is Poetry */
require(\'_crnrstn.root.inc.php\');
include_once($CRNRSTN_ROOT . \'_crnrstn.config.inc.php\');

//
// PASSING TRUE ALLOWS TABLET COMPUTERS TO BE DETECTED AS MOBILE. 
$iAmMobileBOOL = $oCRNRSTN_USR->isClientMobile(true);

//
// PASSING TRUE ALLOWS MOBILE DEVICES TO BE DETECTED AS TABLET. 
$iAmTabletBOOL = $oCRNRSTN_USR->isClientTablet();

if($iAmMobileBOOL){
    //
    // MOBILE/TABLET DEVICE EXPERIENCE
    echo \'I am mobile!\';

}else{
    //
    // DESKTOP EXPERIENCE
	echo \'I am not mobile!\';

}

echo "<br>";

if($iAmTabletBOOL){
    //
    // TABLET DEVICE EXPERIENCE
    echo \'I am a tablet!\';

}else{
    //
    // DESKTOP (OR MOBILE, FOR THIS EXAMPLE) EXPERIENCE
	echo \'I am not a tablet!\';

}

?>';

                ?>
                <div class="crnrstn_code_wrapper">
                    <div class="crnrstn_l_num">1<br>2<br>3<br>4<br>5<br>6<br>7<br>8<br>9<br>10<br>11<br>12<br>13<br>14<br>15<br>16<br>17<br>18<br>19<br>20<br>21<br>22<br>23<br>24<br>25<br>26<br>27<br>28<br>29<br>30<br>31<br>32<br>33<br>34<br>35<br>36<br>37<br>38<br>39<br>40<br>41<br>42<br>43<br>44<br>45<br>46<br>47<br>48<br>49<br>50<br><br><br><br><br></div>
                    <div class="crnrstn_code_shell">
                        <code>
                <?php
                print_r($oCRNRSTN_USR->highlightText($str));
                ?>
                        </code>
                    </div>
                </div>

                <div class="cb_30"></div>
                <div class="crnrstn_example_output_title">Example 1 Output :: </div>
                <div class="crnrstn_code_output_wrapper">
                    <div class="crnrstn_code_output_copy">

                <?php

                $iAmMobileBOOL = $oCRNRSTN_USR->isClientMobile(true);
                $iAmTabletBOOL = $oCRNRSTN_USR->isClientTablet(false);

                if($iAmMobileBOOL){
                    //
                    // MOBILE/TABLET DEVICE EXPERIENCE
                    echo 'I am mobile!';

                }else{
                    //
                    // DESKTOP EXPERIENCE
                    echo 'I am not mobile!';

                }

                echo "<br>";

                if($iAmTabletBOOL){
                    //
                    // TABLET DEVICE EXPERIENCE
                    echo 'I am a tablet!';

                }else{
                    //
                    // DESKTOP (OR MOBILE, FOR THIS EXAMPLE) EXPERIENCE
                    echo 'I am not a tablet!';

                }

}
                ?>
                    </div>
                </div>


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