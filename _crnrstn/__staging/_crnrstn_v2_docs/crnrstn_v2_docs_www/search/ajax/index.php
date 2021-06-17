<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oQueryProfileMgr = new crnrstn_query_profile_manager($oCRNRSTN_USR);
$oSideBitch_Usr = new sideload_user($oCRNRSTN_USR);

//
// ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
if($oCRNRSTN_USR->receiveFormIntegrationPacket()) {
    //error_log('14 search - form IP received...');
    if ($oCRNRSTN_USR->isValid_dataValidationCheck('POST')) {
        $tmp_record_lookup_serial_ARRAY = array();

        //error_log('17 search - POST received...');
        //
        // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
        $oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();
        $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

        //
        // RETRIEVE DOCUMENTATION PAGE DATA
        $query = 'SELECT `search_content`.`CONTENT_ID`,
                    `search_content`.`PAGE_SERIAL`,
                    `search_content`.`LANGCODE`,
                    `search_content`.`CONTENT_PATH`,
                    `search_content`.`BOOLEAN_TEST`,
                    `search_content`.`CONTENT_LENGTH_RAW`,
                    `search_content`.`MODIFIED_BY_IP`,
                    `search_content`.`CREATED_BY_IP`,
                    `search_content`.`MODIFIED_BY_USERAGENT`,
                    `search_content`.`CREATED_BY_USERAGENT`,
                    `search_content`.`DATEMODIFIED`,
                    `search_content`.`DATECREATED`
                FROM `search_content`
                WHERE `search_content`.`ISACTIVE`="1";
                ';

        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH_PREP', '!jesus_is_truly_lord!!', 'PAGE_DATA');
        $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'PAGE_DATA', $query);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $oCRNRSTN_USR->processQuery(true);

        $tmp_page_cnt = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'PAGE_DATA');

        //
        // IF WE HAVE PAGE DATA...
        if ($tmp_page_cnt > 0) {

            $tmp_html_out = '';

            //
            // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
            $tmp_ugc_search_str = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('t');

            $pos_dbl = strpos($tmp_ugc_search_str, '"');
            $pos_sgl = strpos($tmp_ugc_search_str, "'");
            if ($pos_dbl !== false || $pos_sgl !== false) {

                //
                // SEARCH ON QUOTED WORDS
                $tmp_ugc_array = $oSideBitch_Usr->processQuotedSearch($tmp_ugc_search_str);

                //
                // BUILD AND ADD QUERY
                $tmp_cnt = sizeof($tmp_ugc_array);
                $tmp_ugc_search_clean_str_ARRAY = array();
                for ($i = 0; $i < $tmp_cnt; $i++) {

                    $tmp_ugc_search_clean_str_ARRAY[$i] = strtolower($oSideBitch_Usr->strSanitize($tmp_ugc_array[$i], 'search'));

                    $query = 'SELECT `search_content_chunked`.`CHUNK_ID`,
                    `search_content_chunked`.`CONTENT_ID`,
                    `search_content_chunked`.`PAGE_SERIAL`,
                    `search_content_chunked`.`LANGCODE`,
                    `search_content_chunked`.`SEARCH_RESULT_DISPLAY`,
                    `search_content_chunked`.`PAGE_CONTENT_SEARCH`,
                    `search_content_chunked`.`PAGE_CONTENT_RAW`,
                    `search_content_chunked`.`PAGE_CONTENT_TITLE`,
                    `search_content_chunked`.`CONTENT_LENGTH_SEARCH`,
                    `search_content_chunked`.`CONTENT_LENGTH_RAW`,
                    `search_content_chunked`.`MODIFIED_BY_IP`,
                    `search_content_chunked`.`CREATED_BY_IP`,
                    `search_content_chunked`.`MODIFIED_BY_USERAGENT`,
                    `search_content_chunked`.`CREATED_BY_USERAGENT`,
                    `search_content_chunked`.`DATEMODIFIED`,
                    `search_content_chunked`.`DATECREATED`
                FROM `search_content_chunked`
                WHERE `search_content_chunked`.`ISACTIVE`="1"
                AND `search_content_chunked`.`PAGE_CONTENT_SEARCH` LIKE "%' . $mysqli->real_escape_string($tmp_ugc_search_clean_str_ARRAY[$i]) . '%";
                ';

                    $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'QUOTED_SEARCH_'.$i);
                    $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'QUOTED_SEARCH_'.$i, $query);

                }

                //
                // ALL QUERY READY
                // PROCESS ALL QUERY TO CONNECTION(S)
                $oCRNRSTN_USR->processQuery(true);
                $tmp_ugc_s_results_record_cnt = 0;

                //error_log('108 search - process for quotes...will break up words.');
                //die();

                //
                // FOR EACH WORD OR QUOTED STRING RESULT SET
                for ($i = 0; $i < $tmp_cnt; $i++) {

                    $tmp_result_set_cnt = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i);
                    $tmp_ugc_s_results_record_cnt += $tmp_result_set_cnt;

                    $tmp_max_desktop_results = $oCRNRSTN_USR->getEnvResource('AJAX_RESULT_MAX_DESKTOP');

                    if($tmp_result_set_cnt > $tmp_max_desktop_results){

                        $tmp_result_set_cnt = $tmp_max_desktop_results;

                    }

                    //
                    // FOR EACH CHUNK IN RESULT SET
                    for ($ii = 0; $ii < $tmp_result_set_cnt; $ii++) {
                        $tmp_content_id = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'QUOTED_SEARCH_'.$i, 'CONTENT_ID', $ii);
                        $tmp_return_content = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'QUOTED_SEARCH_'.$i, 'SEARCH_RESULT_DISPLAY', $ii);
                        $tmp_return_content_title = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'QUOTED_SEARCH_'.$i, 'PAGE_CONTENT_TITLE', $ii);
                        //$tmp_page_serial = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'PAGE_SERIAL', $ii);
                        //error_log('117 search - CONTENT_ID='.$tmp_content_id);

                        $oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);

                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
                        $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');

                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id, 'CONTENT_PATH');
                        error_log('131 search - ['.$tmp_return_content_title.'] = path = '.$tmp_page_path);

                        //error_log('121 - Documentation path = '.$tmp_page_path);

                        //
                        // BUILD HTML OUTPUT
                        $tmp_html_out .= $oSideBitch_Usr->returnAjaxSearchResultHTML($tmp_page_path, $tmp_return_content, $tmp_return_content_title);

                    }

                }

                if ($tmp_ugc_s_results_record_cnt > 0) {

                    //
                    // RETURN HTML OUTPUT
                    echo $tmp_html_out;

                }

            } else {

                //
                // NO QUOTES...PROCESS ENTIRE UGC
                $tmp_ugc_search_str_clean = strtolower($oSideBitch_Usr->strSanitize($tmp_ugc_search_str, 'search'));

                $query = 'SELECT `search_content_chunked`.`CHUNK_ID`,
                    `search_content_chunked`.`CONTENT_ID`,
                    `search_content_chunked`.`PAGE_SERIAL`,
                    `search_content_chunked`.`LANGCODE`,
                    `search_content_chunked`.`SEARCH_RESULT_DISPLAY`,
                    `search_content_chunked`.`PAGE_CONTENT_SEARCH`,
                    `search_content_chunked`.`PAGE_CONTENT_RAW`,
                    `search_content_chunked`.`PAGE_CONTENT_TITLE`,
                    `search_content_chunked`.`CONTENT_LENGTH_SEARCH`,
                    `search_content_chunked`.`CONTENT_LENGTH_RAW`,
                    `search_content_chunked`.`MODIFIED_BY_IP`,
                    `search_content_chunked`.`CREATED_BY_IP`,
                    `search_content_chunked`.`MODIFIED_BY_USERAGENT`,
                    `search_content_chunked`.`CREATED_BY_USERAGENT`,
                    `search_content_chunked`.`DATEMODIFIED`,
                    `search_content_chunked`.`DATECREATED`
                FROM `search_content_chunked`
                WHERE `search_content_chunked`.`ISACTIVE`="1"
                AND `search_content_chunked`.`PAGE_CONTENT_SEARCH` LIKE "%' . $mysqli->real_escape_string($tmp_ugc_search_str_clean) . '%";
                ';

                //error_log('166 search - search query = ['.$query.']');


                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'PLAIN_SEARCH');
                $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'PLAIN_SEARCH', $query);

                //
                // ALL QUERY READY
                // PROCESS ALL QUERY TO CONNECTION(S)
                $oCRNRSTN_USR->processQuery(true);

                $tmp_ugc_s_results_record_cnt = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'PLAIN_SEARCH');

                if ($tmp_ugc_s_results_record_cnt > 0) {

                    $tmp_max_desktop_results = $oCRNRSTN_USR->getEnvResource('AJAX_RESULT_MAX_DESKTOP');

                    if($tmp_ugc_s_results_record_cnt > $tmp_max_desktop_results){

                        $tmp_ugc_s_results_record_cnt = $tmp_max_desktop_results;

                    }

                    //
                    // BUILD HTML OUTPUT AND RETURN
                    for ($ii = 0; $ii < $tmp_ugc_s_results_record_cnt; $ii++) {

                        $tmp_content_id = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'PLAIN_SEARCH', 'CONTENT_ID', $ii);
                        $tmp_return_content = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'PLAIN_SEARCH', 'SEARCH_RESULT_DISPLAY', $ii);
                        $tmp_page_serial = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'PLAIN_SEARCH', 'PAGE_SERIAL', $ii);
                        $tmp_return_content_title = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'PLAIN_SEARCH', 'PAGE_CONTENT_TITLE', $ii);

                        $oCRNRSTN_USR->initLookupByID($oQueryProfileMgr, 'PAGE_DATA');
                        $tmp_record_lookup_serial_ARRAY = $oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr,'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);
                        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
                        $tmp_record_lookup_serial_ARRAY = $oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
                        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
                        $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');
                        $tmp_CONTENT_LENGTH_RAW = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_LENGTH_RAW');

                        //error_log('200 search - ['.$tmp_return_content_title.'](LEN='.$tmp_CONTENT_LENGTH_RAW.') = path = '.$tmp_page_path);
                        $tmp_html_out .= $oSideBitch_Usr->returnAjaxSearchResultHTML($tmp_page_path, $tmp_return_content, $tmp_return_content_title);

                    }

                    //
                    // TRY TO ACCESS A PREVIOUS LOOKUP ROW
                    //error_log('232 search - lookup array size = '.sizeof($tmp_record_lookup_serial_ARRAY));
                    $oCRNRSTN_USR->loadPreviousRecordLookup($oQueryProfileMgr, 'PAGE_DATA', $tmp_record_lookup_serial_ARRAY[0]);
                    $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');
                    $tmp_CONTENT_LENGTH_RAW = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_LENGTH_RAW');

                    //error_log('233 search - ('.$tmp_CONTENT_LENGTH_RAW.') path = '.$tmp_page_path);

                    echo $tmp_html_out;
                }
            }
        }
    }
}