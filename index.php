<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// CRNRSTN :: TO HANDLE HTTP DATA
if($oCRNRSTN_USR->receiveFormIntegrationPacket()) {

    if ($oCRNRSTN_USR->isValid_dataValidationCheck('POST')) {

        $raw_html_data = $oCRNRSTN_USR->extractData_HTTP('ugc_html', 'POST');

    }

    header( 'Content-type: text/html; charset=utf-8' );
    echo $oCRNRSTN_USR->validate_css($raw_html_data);

}else{

    if($oCRNRSTN_USR->isset_HTTP_Param('css_valptrn', 'GET')){

        echo $oCRNRSTN_USR->output_css_algorithm_profile();

    }else{

        echo $oCRNRSTN_USR->return_form_html('CSS_VALIDATION_EMAIL_HTML_INPUT');

    }

}