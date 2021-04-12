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

    $tmp_validation_results = $oCRNRSTN_USR->validate_css($raw_html_data);

    $tmp_key = $oCRNRSTN_USR->generateNewKey(50);

    $oCRNRSTN_USR->setSessionParam('DISPLAY_AUTH_KEY', $tmp_key);
    $oCRNRSTN_USR->setSessionParam('RAW_VALIDATION_DATA', $tmp_validation_results);

    $tmp_score_numeric_raw = $oCRNRSTN_USR->getSessionParam('SCORE_NUMERIC_RAW');
    $tmp_packet_size = $oCRNRSTN_USR->getSessionParam('PACKET_BYTES_SIZE');
    $tmp_run_time = $oCRNRSTN_USR->getSessionParam('WALLTIME');
    $tmp_run_time = $tmp_run_time.'secs';
    $tmp_post_uri = $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR');
    $tmp_post_uri = $tmp_post_uri . '?rtime='.urlencode($tmp_run_time).'&bytes='.urlencode($tmp_packet_size).'&score='.urlencode($tmp_score_numeric_raw);

    //
    // I WOULD LIKE TO SEE GOOGLE ANALYTICS DATA WITH CSS SCORES AND PERFORMANCE OF THE SYSTEM.
    header("Location: ".$tmp_post_uri);
    exit();

}else{

    if($oCRNRSTN_USR->isset_HTTP_Param('rtime','GET')){

        $tmp_validation_results = $oCRNRSTN_USR->getSessionParam('RAW_VALIDATION_DATA');

        if(strlen($tmp_validation_results) > 1){

            $oCRNRSTN_USR->setSessionParam('RAW_VALIDATION_DATA','0');

            header( 'Content-type: text/html; charset=utf-8' );
            echo $tmp_validation_results;

        }else{

            //
            // HOME PAGE
            echo $oCRNRSTN_USR->return_form_html('CSS_VALIDATION_EMAIL_HTML_INPUT');

        }

    }else{

        if($oCRNRSTN_USR->isset_HTTP_Param('css_valptrn', 'GET')){

            echo $oCRNRSTN_USR->output_css_algorithm_profile();

        }else{

            echo $oCRNRSTN_USR->return_form_html('CSS_VALIDATION_EMAIL_HTML_INPUT');

        }

    }

}