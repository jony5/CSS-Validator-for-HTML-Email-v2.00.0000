<?php
/*
// J5
// Code is Poetry */

#  CLASS :: content_generator
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 4, 2020 @ 1620hrs

class content_generator {

    protected $oLogger;
    private static $oCRNRSTN_USR;
    private static $oSideBitch_USR;
    private static $oCSController;

    public $page_content_ARRAY = array();
    public $page_uri;
    public $page_category_name_ARRAY;
    public $page_subcategory_name_ARRAY;
    public $page_subsubcateg_name_ARRAY;
    public $page_serial;
    public $content_load_sequence_ARRAY = array();
    public $page_subcategory_name;
    public $page_subsubcateg_name;

	public function __construct($oCRNRSTN_USR, $oSideBitch_USR, $page_path) {

		// 
		// INSTANTIATE LOGGER
		$this->oLogger = new crnrstn_logging($oCRNRSTN_USR->debugMode, __CLASS__, $oCRNRSTN_USR->log_silo_key_piped);
		self::$oCRNRSTN_USR = $oCRNRSTN_USR;
		self::$oSideBitch_USR = $oSideBitch_USR;

        //
        // INSTANTIATE CONTENT SOURCE CONTROLLER
		self::$oCSController = new content_source_controller($oCRNRSTN_USR, $oSideBitch_USR, $this, $page_path);

	}

	public function initPage($serial){

	    $this->page_content_ARRAY[] = $serial;
	    $this->page_serial = $serial;

    }

    public function returnPageSerial(){

	    return self::$oCSController->returnPageSerial();
    }

    public function returnLoadedBitch(){

        return self::$oCSController->returnLoadedBitch();

    }

    public function loadPage(){

        self::$oCSController->loadContent();
    }

    public function addPageElement($serial, $key, $attribute_00, $attribute_01=NULL, $attribute_02=NULL, $attribute_03=NULL){

	    try{

            switch($key){
                case 'PARAMETER_DEFINITION':
                case 'RETURNED_VALUE':
                case 'METHOD_DEFINITION':
                case 'TECH_SPEC':
                case 'INVOKING_CLASS':
                case 'BASIC_COPY':
                case 'NOTE_COPY':
                case 'SUB_TITLE':
                    $tmp_seq_key = self::$oCRNRSTN_USR->generateNewKey(10);
                    $this->content_load_sequence_ARRAY[] = $tmp_seq_key;
                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key] = $attribute_00;
                    //error_log('81 gen - data='.$attribute_00);

                break;
                case 'EXAMPLE':
                    $tmp_seq_key = self::$oCRNRSTN_USR->generateNewKey(10);
                    $this->content_load_sequence_ARRAY[] = $tmp_seq_key;

                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['title_string'] = $attribute_00;
                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['description_string'] = $attribute_01;
                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['pres_file'] = $attribute_02;
                    $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['exec_file'] = $attribute_03;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unhandled key ['.$key.'].');

                break;
            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage());
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;

        }

        return true;

    }

    public function returnPageSearchResultsHTML($oSideBitch_Usr, $serial, $channel){

        $oQueryProfileMgr = new crnrstn_query_profile_manager(self::$oCRNRSTN_USR);
        $html_out = '';

        switch($channel){
            case 'mobile':

                //
                // MOBILE EXPERIENCE
                // PROCESS FOR SEARCH RESULTS
                // ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
                if(self::$oCRNRSTN_USR->receiveFormIntegrationPacket()) {

                    if(self::$oCRNRSTN_USR->isValid_dataValidationCheck() || self::$oCRNRSTN_USR->isValid_dataValidationCheck('GET')) {

                        //
                        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                        $tmp_ugc_search_str = self::$oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('q');

                        if(self::$oCRNRSTN_USR->isset_HTTPSuper('GET')){

                            $tmp_encrypt = self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET_ENCRYPTED', 'POST');
                            $tmp_ipacket = urlencode(self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET', 'POST'));
                            //error_log('154 gen - encode=>packet='.$tmp_ipacket);

                        }else{

                            $tmp_encrypt = self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET_ENCRYPTED');
                            $tmp_ipacket = urlencode(self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET'));
                            //error_log('160 gen - packet='.$tmp_ipacket);
                        }

                        $html_out .= '<div class="section_title">'.$this->page_subsubcateg_name_ARRAY[$serial].' :: <a href="#" onClick="ugc_search_sync(); return false;">'.$tmp_ugc_search_str.'</a></div>
                <div class="content_results_subtitle_divider"></div>';

                        //
                        // TOUCH DATABASE WITH UGC CONTENT
                        // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                        $oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
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
                        self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'PAGE_DATA', $query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        self::$oCRNRSTN_USR->processQuery(true);

                        $tmp_page_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'PAGE_DATA');

                        //
                        // IF WE HAVE PAGE DATA...
                        if ($tmp_page_cnt > 0) {

                            //
                            // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                            $tmp_ugc_search_str = self::$oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('q');

                            $pos = strpos($tmp_ugc_search_str, '"');
                            if ($pos !== false) {
                                error_log('200 search - process for quotes...will break up words.');
                                //
                                // SEARCH ON QUOTED WORDS
                                $tmp_ugc_array = $oSideBitch_Usr->processQuotedSearch($tmp_ugc_search_str);

                                //
                                // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                                $oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
                                $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

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
                                    self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'QUOTED_SEARCH_'.$i, $query);

                                }

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                self::$oCRNRSTN_USR->processQuery(true);

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    #self::$oCRNRSTN_USR->resultSetMerge(($oQueryProfileMgr, {ORIGINAL RESULT SET KEY}, {TARGET RESULT SET KEY}, {MERGE KEY FIELD...PIPE OK}, {SEQUENCE KEY FIELD(S)...PIPE OK} {MERGE FIELD DATATYPE...PIPE OK})
                                    self::$oCRNRSTN_USR->resultSetMerge($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                self::$oCRNRSTN_USR->increment_results_count_total($tmp_result_set_cnt);

                                $tmp_max_desktop_results = self::$oCRNRSTN_USR->getEnvResource('RESULT_MAX_DESKTOP');
                                self::$oCRNRSTN_USR->set_maximum_display_result_count($tmp_max_desktop_results);

                                $pagination_serial = self::$oCRNRSTN_USR->returnPaginationSerial();
                                self::$oCRNRSTN_USR->specifyPaginationVariableName('p', $pagination_serial);
                                self::$oCRNRSTN_USR->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);

                                error_log('265 gen - call returnCurrentPaginationPos('.$pagination_serial.')');
                                $tmp_current_pagination_pos = self::$oCRNRSTN_USR->returnCurrentPaginationPos($pagination_serial);
                                error_log('267 gen - returnCurrentPaginationPos('.$pagination_serial.')='.$tmp_current_pagination_pos);

                                //$tmp_ugc_s_results_record_cnt = $tmp_merged_result_set_cnt;

                                //
                                // FOR EACH ROW IN MERGED RESULT SET
                                $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                for ($i = $cur_pos; $i < $tmp_max_desktop_results+$cur_pos; $i++) {

                                    $tmp_content_id = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $i);

                                    $tmp_return_content = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $i);
                                    $tmp_return_content_title = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $i);
                                    // $tmp_page_serial = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'PAGE_SERIAL', $ii);
                                    // error_log('117 search - CONTENT_ID='.$tmp_content_id);

                                    self::$oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                    // $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
                                    $tmp_page_path = self::$oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id, 'CONTENT_PATH');
                                    //error_log('302 gen - ['.$tmp_return_content_title.'] = path = '.$tmp_page_path);

                                    //
                                    // BUILD HTML OUTPUT
                                    $html_out .= $oSideBitch_Usr->returnSearchResultMOBILE($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

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

                                //error_log('333 search - search query = ['.$query.']');

                                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'PLAIN_SEARCH');
                                self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'PLAIN_SEARCH', $query);

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                self::$oCRNRSTN_USR->processQuery(true);

                                $tmp_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'PLAIN_SEARCH');

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    self::$oCRNRSTN_USR->resultSetMerge($oQueryProfileMgr, 'PLAIN_SEARCH', 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                self::$oCRNRSTN_USR->increment_results_count_total($tmp_result_set_cnt);

                                if ($tmp_ugc_s_results_record_cnt > 0) {

                                    $tmp_max_desktop_results = self::$oCRNRSTN_USR->getEnvResource('RESULT_MAX_DESKTOP');
                                    self::$oCRNRSTN_USR->set_maximum_display_result_count($tmp_max_desktop_results);

                                    $pagination_serial = self::$oCRNRSTN_USR->returnPaginationSerial();
                                    //self::$oCRNRSTN_USR->setCurrentPaginationSensation();
                                    //error_log('341 gen - ['.$pagination_serial.']['.$tmp_ugc_search_str.']');
                                    self::$oCRNRSTN_USR->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);
                                    self::$oCRNRSTN_USR->specifyPaginationVariableName('p', $pagination_serial);

                                    //
                                    // BUILD HTML OUTPUT AND RETURN
                                    //for ($ii = {PAGINATION_START_POS}; $ii < $tmp_max_desktop_results; $ii++) {
                                    $tmp_current_pagination_pos = self::$oCRNRSTN_USR->returnCurrentPaginationPos($pagination_serial);
                                    //error_log('348 - ['.$tmp_max_desktop_results.'] current_pagination_pos='.$tmp_current_pagination_pos);

                                    if($tmp_max_desktop_results>$tmp_ugc_s_results_record_cnt){

                                        $cur_pos = ($tmp_ugc_s_results_record_cnt*$tmp_current_pagination_pos) - $tmp_ugc_s_results_record_cnt;
                                        $tmp_max_desktop_results = $tmp_ugc_s_results_record_cnt;

                                    }else{

                                        $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                    }

                                    for ($ii = $cur_pos; $ii < $tmp_max_desktop_results+$cur_pos; $ii++) {

                                        $tmp_content_id = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $ii);

                                        $tmp_return_content = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $ii);
                                        $tmp_page_serial = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_SERIAL', $ii);
                                        $tmp_return_content_title = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $ii);

                                        self::$oCRNRSTN_USR->initLookupByID($oQueryProfileMgr, 'PAGE_DATA');
                                        $tmp_record_lookup_serial_ARRAY = self::$oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr,'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);
                                        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
                                        $tmp_record_lookup_serial_ARRAY = self::$oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
                                        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

                                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
                                        $tmp_page_path = self::$oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');
                                        $tmp_CONTENT_LENGTH_RAW = self::$oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_LENGTH_RAW');

                                        //error_log('365 gen - ['.$tmp_return_content_title.'](LEN='.$tmp_CONTENT_LENGTH_RAW.') = path = '.$tmp_page_path);
                                        $html_out .= $oSideBitch_Usr->returnSearchResultMOBILE($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

                                    }

                                }
                            }

                            $tmp_walltime = self::$oCRNRSTN_USR->wallTime();
                            $tmp_stats = '<div class="s_result_stats">'.$tmp_ugc_s_results_record_cnt.' results returned in '.$tmp_walltime.' seconds.</div>';

                            $html_out = $tmp_stats.$html_out;

                            $html_out .= self::$oCRNRSTN_USR->returnPaginationStateHTML();
                        }

                    }else{

                        $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                        require(self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');

                    }

                }else{

                    $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                    require(self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');

                }

            break;
            default:

                //
                // DESKTOP EXPERIENCE
                // PROCESS FOR SEARCH RESULTS
                // ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
                if(self::$oCRNRSTN_USR->receiveFormIntegrationPacket()) {

                    if(self::$oCRNRSTN_USR->isValid_dataValidationCheck() || self::$oCRNRSTN_USR->isValid_dataValidationCheck('GET')) {

                        //
                        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                        $tmp_ugc_search_str = self::$oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('t');

                        if(self::$oCRNRSTN_USR->isset_HTTPSuper('POST')){

                            $tmp_encrypt = self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET_ENCRYPTED', 'POST');
                            $tmp_ipacket = urlencode(self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET', 'POST'));
                            //error_log('154 gen - encode=>packet='.$tmp_ipacket);

                        }else{

                            $tmp_encrypt = self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET_ENCRYPTED');
                            $tmp_ipacket = urlencode(self::$oCRNRSTN_USR->extractData_HTTP('CRNRSTN_INTEGRATION_PACKET'));
                            //error_log('160 gen - packet='.$tmp_ipacket);
                        }

                        $html_out .= '<div class="section_title">'.$this->page_subsubcateg_name_ARRAY[$serial].' :: <a href="#" onClick="ugc_search_sync(); return false;">'.$tmp_ugc_search_str.'</a></div>
                <div class="content_results_subtitle_divider"></div>';

                        //
                        // TOUCH DATABASE WITH UGC CONTENT
                        // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                        $oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
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
                        self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'PAGE_DATA', $query);

                        //
                        // PROCESS ALL QUERY TO CONNECTION(S)
                        self::$oCRNRSTN_USR->processQuery(true);

                        $tmp_page_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'PAGE_DATA');

                        //
                        // IF WE HAVE PAGE DATA...
                        if ($tmp_page_cnt > 0) {

                            //
                            // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
                            $tmp_ugc_search_str = self::$oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('t');

                            $pos = strpos($tmp_ugc_search_str, '"');
                            if ($pos !== false) {
                                error_log('200 search - process for quotes...will break up words.');
                                //
                                // SEARCH ON QUOTED WORDS
                                $tmp_ugc_array = $oSideBitch_Usr->processQuotedSearch($tmp_ugc_search_str);

                                //
                                // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
                                $oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
                                $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

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
                                    self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'QUOTED_SEARCH_'.$i, $query);

                                }

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                self::$oCRNRSTN_USR->processQuery(true);

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    #self::$oCRNRSTN_USR->resultSetMerge(($oQueryProfileMgr, {ORIGINAL RESULT SET KEY}, {TARGET RESULT SET KEY}, {MERGE KEY FIELD...PIPE OK}, {SEQUENCE KEY FIELD(S)...PIPE OK} {MERGE FIELD DATATYPE...PIPE OK})
                                    self::$oCRNRSTN_USR->resultSetMerge($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                self::$oCRNRSTN_USR->increment_results_count_total($tmp_result_set_cnt);

                                $tmp_max_desktop_results = self::$oCRNRSTN_USR->getEnvResource('RESULT_MAX_DESKTOP');
                                self::$oCRNRSTN_USR->set_maximum_display_result_count($tmp_max_desktop_results);

                                $pagination_serial = self::$oCRNRSTN_USR->returnPaginationSerial();
                                self::$oCRNRSTN_USR->specifyPaginationVariableName('p', $pagination_serial);
                                self::$oCRNRSTN_USR->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);

                                error_log('265 gen - call returnCurrentPaginationPos('.$pagination_serial.')');
                                $tmp_current_pagination_pos = self::$oCRNRSTN_USR->returnCurrentPaginationPos($pagination_serial);
                                error_log('267 gen - returnCurrentPaginationPos('.$pagination_serial.')='.$tmp_current_pagination_pos);

                                //$tmp_ugc_s_results_record_cnt = $tmp_merged_result_set_cnt;

                                //
                                // FOR EACH ROW IN MERGED RESULT SET
                                $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                for ($i = $cur_pos; $i < $tmp_max_desktop_results+$cur_pos; $i++) {

                                    $tmp_content_id = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $i);

                                    $tmp_return_content = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $i);
                                    $tmp_return_content_title = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $i);
                                    // $tmp_page_serial = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'QUOTED_SEARCH_' . $i, 'PAGE_SERIAL', $ii);
                                    // error_log('117 search - CONTENT_ID='.$tmp_content_id);

                                    self::$oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                    // $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
                                    $tmp_page_path = self::$oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');

                                    // $tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_ID', $tmp_content_id, 'CONTENT_PATH');
                                    //error_log('302 gen - ['.$tmp_return_content_title.'] = path = '.$tmp_page_path);

                                    //
                                    // BUILD HTML OUTPUT
                                    $html_out .= $oSideBitch_Usr->returnSearchResultHTML($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

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

                                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UGC_SEARCH', '!jesus_is_truly_lord!', 'PLAIN_SEARCH');
                                self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'PLAIN_SEARCH', $query);

                                //
                                // ALL QUERY READY
                                // PROCESS ALL QUERY TO CONNECTION(S)
                                self::$oCRNRSTN_USR->processQuery(true);

                                $tmp_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'PLAIN_SEARCH');

                                //
                                // COMBINE ALL DESIRED RESULT SETS INTO ONE TO SEQUENCE AND/OR PURGE DUPLICATES
                                // FOR EACH WORD OR QUOTED STRING RESULT SET
                                for ($i = 0; $i < $tmp_cnt; $i++) {

                                    self::$oCRNRSTN_USR->resultSetMerge($oQueryProfileMgr, 'PLAIN_SEARCH', 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', true,'CONTENT_LENGTH_RAW|DATECREATED', 'INTEGER|DATETIME');

                                }

                                $tmp_result_set_cnt = $tmp_ugc_s_results_record_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS');
                                self::$oCRNRSTN_USR->increment_results_count_total($tmp_result_set_cnt);

                                if ($tmp_ugc_s_results_record_cnt > 0) {

                                    $tmp_max_desktop_results = self::$oCRNRSTN_USR->getEnvResource('RESULT_MAX_DESKTOP');
                                    self::$oCRNRSTN_USR->set_maximum_display_result_count($tmp_max_desktop_results);

                                    $pagination_serial = self::$oCRNRSTN_USR->returnPaginationSerial();
                                    //self::$oCRNRSTN_USR->setCurrentPaginationSensation();
                                    //error_log('341 gen - ['.$pagination_serial.']['.$tmp_ugc_search_str.']');
                                    self::$oCRNRSTN_USR->addPaginationPassthroughInputVal('t', $tmp_ugc_search_str, $pagination_serial);
                                    self::$oCRNRSTN_USR->specifyPaginationVariableName('p', $pagination_serial);

                                    //
                                    // BUILD HTML OUTPUT AND RETURN
                                    //for ($ii = {PAGINATION_START_POS}; $ii < $tmp_max_desktop_results; $ii++) {
                                    $tmp_current_pagination_pos = self::$oCRNRSTN_USR->returnCurrentPaginationPos($pagination_serial);
                                    //error_log('348 - ['.$tmp_max_desktop_results.'] current_pagination_pos='.$tmp_current_pagination_pos);

                                    if($tmp_max_desktop_results>$tmp_ugc_s_results_record_cnt){

                                        $cur_pos = ($tmp_ugc_s_results_record_cnt*$tmp_current_pagination_pos) - $tmp_ugc_s_results_record_cnt;
                                        $tmp_max_desktop_results = $tmp_ugc_s_results_record_cnt;

                                    }else{

                                        $cur_pos = ($tmp_max_desktop_results*$tmp_current_pagination_pos) - $tmp_max_desktop_results;

                                    }

                                    for ($ii = $cur_pos; $ii < $tmp_max_desktop_results+$cur_pos; $ii++) {

                                        $tmp_content_id = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'CONTENT_ID', $ii);

                                        $tmp_return_content = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'SEARCH_RESULT_DISPLAY', $ii);
                                        $tmp_page_serial = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_SERIAL', $ii);
                                        $tmp_return_content_title = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'MERGED_SEARCH_RESULTS', 'PAGE_CONTENT_TITLE', $ii);

                                        self::$oCRNRSTN_USR->initLookupByID($oQueryProfileMgr, 'PAGE_DATA');
                                        $tmp_record_lookup_serial_ARRAY = self::$oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr,'PAGE_DATA', 'CONTENT_ID', $tmp_content_id);
                                        //error_log('218 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));
                                        $tmp_record_lookup_serial_ARRAY = self::$oCRNRSTN_USR->addLookupFieldData($oQueryProfileMgr, 'PAGE_DATA', 'PAGE_SERIAL', $tmp_page_serial);
                                        //error_log('220 search - lookup serial array size='.sizeof($tmp_record_lookup_serial_ARRAY));

                                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID', $tmp_content_id);
                                        //$tmp_page_path = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA','CONTENT_PATH','CONTENT_ID|PAGE_SERIAL', $tmp_content_id.'|'.$tmp_page_serial);
                                        $tmp_page_path = self::$oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_PATH');
                                        $tmp_CONTENT_LENGTH_RAW = self::$oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr, 'PAGE_DATA', 'CONTENT_LENGTH_RAW');

                                        //error_log('365 gen - ['.$tmp_return_content_title.'](LEN='.$tmp_CONTENT_LENGTH_RAW.') = path = '.$tmp_page_path);
                                        $html_out .= $oSideBitch_Usr->returnSearchResultHTML($tmp_page_path, $tmp_return_content, $tmp_return_content_title, $tmp_ugc_search_str);

                                    }

                                }
                            }

                            $tmp_walltime = self::$oCRNRSTN_USR->wallTime();
                            $tmp_stats = '<div class="s_result_stats">'.$tmp_ugc_s_results_record_cnt.' results returned in '.$tmp_walltime.' seconds.</div>';

                            $html_out = $tmp_stats.$html_out;
                            require(self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');

                            $html_out .= self::$oCRNRSTN_USR->returnPaginationStateHTML();
                        }

                    }else{

                        $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                        require(self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');

                    }

                }else{

                    $html_out .= '<div class="section_title">&nbsp;</div><div class="content_results_subtitle_divider"></div>';
                    require(self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');

                }

            break;

        }

        return $html_out;

    }

    public function returnPageHTML($serial, $channel='mobile'){

        $html_out = '';

	    switch($channel){
            case 'index':
                //$html_out .= $this->prepPageIndexContent($this->page_subsubcateg_name_ARRAY[$serial]);
                $search_result = '';
                if(strlen($this->page_subsubcateg_name_ARRAY[$serial])>2){

                    $tmp_page_title = $this->page_subsubcateg_name_ARRAY[$serial];

                }else{

                    $tmp_page_title = $this->page_subcategory_name_ARRAY[$serial];

                }

                //$tmp_page_title = $this->page_subsubcateg_name_ARRAY[$serial];

                $tmp_page_element_cnt = sizeof($this->content_load_sequence_ARRAY);
                //error_log('415 gen - count='.$tmp_page_element_cnt);
                for($i=0;$i<$tmp_page_element_cnt;$i++){

                    //
                    // FOR EACH PAGE ELEMENT IN SEQUENCE.
                    foreach($this->page_content_ARRAY[$serial][$this->content_load_sequence_ARRAY[$i]] as $key=>$val){
                        //error_log('422 gen - index me key['.$key.'] val['.$val.']');
                        switch($key){
                            case 'SUB_TITLE':
                            case 'BASIC_COPY':
                                if($search_result==''){

                                    $search_result = $this->prepPageIndexContent($val);

                                }
                            case 'NOTE_COPY':
                            case 'METHOD_DEFINITION':
                            case 'INVOKING_CLASS':
                            case 'RETURNED_VALUE':
                                //error_log('430 gen - val='.$val);
                                $html_out .= $this->prepPageIndexContent($val);
                                //error_log('432 gen - out='.$html_out);
                            break;
                            case 'EXAMPLE':

                                $html_out .= $this->prepPageIndexContent($val['title_string']);
                                $html_out .= $this->prepPageIndexContent($val['description_string']);

                                //
                                // CODE EXAMPLE
                                // $html_out .= $this->prepPageIndexContent($this->retrieveCodeExampleHTML($val['pres_file']));
                                $html_out .= $this->prepPageIndexContent($val['pres_file'], 'file');

                                //
                                // EXAMPLE OUTPUT
                                //$html_out .= $this->prepPageIndexContent($val['title_string']);

                            break;
                            case 'TECH_SPEC':

                                $tmp_spec_size = sizeof($val);
                                for($ii=0;$ii<$tmp_spec_size;$ii++){
                                    $html_out .= $this->prepPageIndexContent($val[$ii]);
                                }

                            break;
                            case 'PARAMETER_DEFINITION':

                                foreach($val as $tmp_key=>$tmp_val){

                                        $html_out .=  $this->prepPageIndexContent($tmp_val['param_name']);
                                        $html_out .=  $this->prepPageIndexContent($tmp_val['param_copy']);

                                }

                            break;

                        }

                        //error_log('470 - '.$html_out);

                    }

                }

            break;
            case 'mobile':

                if(strlen($this->page_subsubcateg_name_ARRAY[$serial])>2){

                    $html_out = '<h3 class="content_results_subtitle">'.$this->page_subsubcateg_name_ARRAY[$serial].' ::</h3>
                <div class="content_results_subtitle_divider"></div>';

                }else{

                    $html_out = '<h3 class="content_results_subtitle">'.strtolower($this->page_subcategory_name_ARRAY[$serial]).' ::</h3>
                <div class="content_results_subtitle_divider"></div>';

                }

                //
                // LOOP THROUGH CONTENT ARRAY
                $tmp_page_element_cnt = sizeof($this->content_load_sequence_ARRAY);

                for($i=0;$i<$tmp_page_element_cnt;$i++){

                    //
                    // FOR EACH PAGE ELEMENT IN SEQUENCE.
                    foreach($this->page_content_ARRAY[$serial][$this->content_load_sequence_ARRAY[$i]] as $key=>$val){

                        switch($key){
                            case 'SUB_TITLE':
                                $html_out .= '<h3 class="content_results_subtitle">'.$val.' ::</h3>
                <div class="content_results_subtitle_divider"></div>';
                            break;
                            case 'BASIC_COPY':
                                # <div class="crnrstn_page_description">....</div>
                                $html_out .= '<div class="crnrstn_page_description">'.$val.'</div>';
                            break;
                            case 'NOTE_COPY':

                                /*
                                <div class="crnrstn_note_wrapper">
                                    <div class="crnrstn_note_crnrstn_icon" style="background-image: url('<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_sm.png'); background-repeat: no-repeat; width:50px; height:30px; float:right;"></div>
                                    <div class="crnrstn_note_notetitle">Note ::</div>
                                    <div class="crnrstn_note_notecopy">This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it's developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.</div>
                                    <div class="cb"></div>
                                </div>
                                 * */

                                $html_out .= '<div class="crnrstn_note_wrapper">
                                    <div class="crnrstn_note_crnrstn_icon" style="background-image: url(\''.self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/logo_sm.png\'); background-repeat: no-repeat; width:50px; height:30px; float:right;"></div>
                                    <div class="crnrstn_note_notetitle">Note ::</div>
                                    <div class="crnrstn_note_notecopy">'.$val.'</div>
                                    <div class="cb"></div>
                                </div>';

                            break;
                            case 'EXAMPLE':

                                /*
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['title_string'] = $attribute_00;
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['description_string'] = $attribute_01;
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['pres_file'] = $attribute_02;
                                $this->page_content_ARRAY[$serial][$tmp_seq_key][$key]['exec_file'] = $attribute_03;
                                 * */

                                $html_out .= '<div class="crnrstn_example_title_wrapper">
                                    <div class="crnrstn_example_title">'.$val['title_string'].' ::</div>
                                    <div class="crnrstn_example_description">'.$val['description_string'].'</div>
                                </div>';

                                //
                                // CODE EXAMPLE
                                $html_out .= $this->retrieveCodeExampleHTML($val['pres_file']);

                                //
                                // EXAMPLE OUTPUT
                                $html_out .= '<div class="crnrstn_example_output_title">'.$val['title_string'].' Output :: </div>';
                                $html_out .= $this->retrieveCodeExampleOutputHTML($val['exec_file']);

                            break;
                            case 'TECH_SPEC':

                                $html_out .= '<div class="section_title">Technical specifications ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="tech_specs_wrapper">
                                    <ul>';

                                $tmp_spec_size = sizeof($val);
                                for($ii=0;$ii<$tmp_spec_size;$ii++){
                                    $html_out .= '<li>'.$val[$ii].'</li>';
                                }

                                $html_out .= '</ul>
                                </div>';

                            break;
                            case 'INVOKING_CLASS':
                                $html_out .= '<div class="section_title">Invoking class ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">'.$val.'</div>';
                            break;
                            case 'METHOD_DEFINITION':
                                $html_out .= '<div class="section_title">Method definition ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">'.$val.'</div>';
                            break;
                            case 'PARAMETER_DEFINITION':
                                $html_out .= '<div class="section_title">Method parameter definitions ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">';

                                foreach($val as $tmp_key=>$tmp_val){

                                    if($tmp_val['param_required']){
                                        $html_out .=  '<div class="method_parameter">'.$tmp_val['param_name'].'&nbsp;<span class="parameter_require_required">(Required)</span></div>
                                    <blockquote class="method_parameter_definition">'.$tmp_val['param_copy'].'</blockquote>';

                                    }else{
                                        $html_out .=  '<div class="method_parameter">'.$tmp_val['param_name'].'&nbsp;<span class="parameter_require_optional">(Optional)</span></div>
                                    <blockquote class="method_parameter_definition">'.$tmp_val['param_copy'].'</blockquote>';

                                    }

                                }

                                $html_out .= '</div>';
                            break;
                            case 'RETURNED_VALUE':
                                $html_out .= '<div class="section_title">Returned value ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">'.$val.'</div>';
                            break;

                        }

                    }

                }

            break;
            default:

                require(self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/inc/search/search.inc.php');

                $html_out .= '<div class="cb"></div>';

                //
                // DESKTOP EXPERIENCE
                if(strlen($this->page_subsubcateg_name_ARRAY[$serial])>2){

                    $html_out .= '<div class="section_title">'.$this->page_subsubcateg_name_ARRAY[$serial].' ::</div>
                <div class="content_results_subtitle_divider"></div>';

                }else{

                    $html_out .= '<div class="section_title">'.strtolower($this->page_subcategory_name_ARRAY[$serial]).' ::</div>
                <div class="content_results_subtitle_divider"></div>';

                }

                //
                // LOOP THROUGH CONTENT ARRAY
                $tmp_page_element_cnt = sizeof($this->content_load_sequence_ARRAY);

                for($i=0;$i<$tmp_page_element_cnt;$i++){

                    //
                    // FOR EACH PAGE ELEMENT IN SEQUENCE.
                    foreach($this->page_content_ARRAY[$serial][$this->content_load_sequence_ARRAY[$i]] as $key=>$val){

                        switch($key){
                            case 'SUB_TITLE':
                                $html_out .= '<div class="section_title">'.$val.' ::</div>
                <div class="content_results_subtitle_divider"></div>';
                            break;
                            case 'BASIC_COPY':

                                $html_out .= '<div class="crnrstn_page_description">'.$val.'</div>';

                            break;
                            case 'NOTE_COPY':

                                $html_out .= '<div class="crnrstn_note_wrapper">
                                    <div class="crnrstn_note_crnrstn_icon" style="background-image: url(\''.self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/logo_sm.png\'); background-repeat: no-repeat; width:50px; height:30px; float:right;"></div>
                                    <div class="crnrstn_note_notetitle">Note ::</div>
                                    <div class="crnrstn_note_notecopy">'.$val.'</div>
                                    <div class="cb"></div>
                                </div>';

                            break;
                            case 'EXAMPLE':
                                $html_out .= '<div class="crnrstn_example_title_wrapper">
                                    <div class="section_title">'.$val['title_string'].' ::</div>
                                    <div class="crnrstn_example_description">'.$val['description_string'].'</div>
                                </div>';

                                //
                                // CODE EXAMPLE
                                $html_out .= $this->retrieveCodeExampleHTML($val['pres_file']);

                                //
                                // EXAMPLE OUTPUT
                                $html_out .= '<div class="crnrstn_example_output_title">'.$val['title_string'].' Output :: </div>';
                                $html_out .= $this->retrieveCodeExampleOutputHTML($val['exec_file']);

                            break;
                            case 'TECH_SPEC':

                                $html_out .= '<div class="section_title">Technical specifications ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="tech_specs_wrapper">
                                    <ul>';

                                $tmp_spec_size = sizeof($val);
                                for($ii=0;$ii<$tmp_spec_size;$ii++){
                                    $html_out .= '<li>'.$val[$ii].'</li>';
                                }

                                $html_out .= '</ul>
                                </div>';

                            break;
                            case 'INVOKING_CLASS':
                                $html_out .= '<div class="section_title">Invoking class ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">'.$val.'</div>';
                            break;
                            case 'METHOD_DEFINITION':
                                $html_out .= '<div class="section_title">Method definition ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">'.$val.'</div>';
                            break;
                            case 'PARAMETER_DEFINITION':
                                $html_out .= '<div class="section_title">Method parameter definitions ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">';

                                foreach($val as $tmp_key=>$tmp_val){

                                    if($tmp_val['param_required']){
                                        $html_out .=  '<div class="method_parameter">'.$tmp_val['param_name'].'&nbsp;<span class="parameter_require_required">(Required)</span></div>
                                    <blockquote class="method_parameter_definition">'.$tmp_val['param_copy'].'</blockquote>';

                                    }else{
                                        $html_out .=  '<div class="method_parameter">'.$tmp_val['param_name'].'&nbsp;<span class="parameter_require_optional">(Optional)</span></div>
                                    <blockquote class="method_parameter_definition">'.$tmp_val['param_copy'].'</blockquote>';

                                    }

                                }

                                $html_out .= '</div>';
                            break;
                            case 'RETURNED_VALUE':
                                $html_out .= '<div class="section_title">Returned value ::</div>
                                <div class="content_results_subtitle_divider"></div>
                                <div class="basic_section_content">'.$val.'</div>';
                            break;
                        }
                    }
                }

            break;

        }

        switch($channel){
            case 'index':
                $tmp_array_out = array();
                $tmp_array_out['page_title'] = $tmp_page_title;
                $tmp_array_out['page_content'] = $html_out;
                $tmp_array_out['page_result_display'] = $search_result;

                return $tmp_array_out;

            break;
            default:

                return $html_out;
            break;

        }

    }

    private function prepPageIndexContent($str, $file=NULL){

	    if(isset($file)){

	        $filepath = self::$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT").self::$oCRNRSTN_USR->getEnvResource("DOCUMENT_ROOT_DIR").$str;

            $str = file_get_contents($filepath, true);

        }else{

            $str = self::$oSideBitch_USR->strSanitize($str, 'index');
            $str = $str.' ';

        }

	    return $str;
    }

    public function retrieveCodeExampleHTML($filepath){

        $filepath = self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').$filepath;

        $tmp_html_output = '';

        $tmp_html_output .= '<div class="crnrstn_code_wrapper">';
        $tmp_html_output .= $this->retrieveCodeExampleLineNumHTML($filepath);

        $tmp_html_output .= '<div class="crnrstn_code_shell">
                <code>';

        //$tmp_html_output .= highlight_file($filepath,true);
        $tmp_html_output .= self::$oCRNRSTN_USR->highlightCode($filepath);

        $tmp_html_output .= '</code>
            </div>';

        $tmp_html_output .= '</div>';

	    return $tmp_html_output;

    }

    public function retrieveCodeExampleOutputHTML($filepath){

	    $filepath = self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').self::$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').$filepath;

        $tmp_html_out = '';

        $tmp_html_out .= '<div class="crnrstn_code_output_wrapper">
            <div class="crnrstn_code_output_copy">';


        include($filepath);


        $tmp_html_out .= '</div>
    </div>';

        return $tmp_html_out;

    }

    public function retrieveCodeExampleLineNumHTML($filepath){
	    $tmp_html_out = '';

        //$lineHTML = implode(range(1, count(file($filepath))+0), '<br />');
        $lineHTML = implode('<br />', range(1, count(file($filepath))+0));
        $tmp_html_out .= '<div class="crnrstn_l_num">'.$lineHTML.'</div>';

        return $tmp_html_out;
    }

	public function __destruct() {
		
	}
}