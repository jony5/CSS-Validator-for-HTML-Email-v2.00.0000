<?php
/*
// J5
// Code is Poetry */

/*
// CLASS :: content_generator
// AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
// VERSION :: 1.0.0
// DATE :: June 10, 2020 @ 2130 hrs
*/

class sideload_user {

	protected $oLogger;
	private static $oCRNRSTN_USR;
	private static $oContentGen;

	private static $page_path;

	public function __construct($oCRNRSTN_USR) {

	    self::$oCRNRSTN_USR = $oCRNRSTN_USR;

		// 
		// INSTANTIATE LOGGER
		$this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

        $tmp_page_path = $_SERVER['SCRIPT_NAME'];
        $tmp_page_path = str_replace("index.php", "", $tmp_page_path);
        $tmp_page_path = str_replace(self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'), "", $tmp_page_path);
        self::$page_path = $tmp_page_path;

	}

	public function initializePageContent(){

        //
        // INSTANTIATE DOCUMENTATION CONTENT MANAGER
        self::$oContentGen = new content_generator(self::$oCRNRSTN_USR, $this, self::$page_path);

    }

    public function loadPage(){

        self::$oContentGen->loadPage();

    }

    public function indexPage(){

	    if(self::$oCRNRSTN_USR->getEnvResource('INDEX_PAGES_4SEARCH')){

            $tmp_page_serial = self::$oContentGen->returnPageSerial();
            //$tmp_page_content = self::$oContentGen->returnPageHTML($tmp_page_serial, 'index');

            $this->indexPageContent();

        }
    }

    private function indexPageContent(){

	    //error_log('67 side bitch usr - '.$page_content);
        $oQueryProfileMgr = new crnrstn_query_profile_manager(self::$oCRNRSTN_USR);
        $tmp_page_serial = self::$oContentGen->returnPageSerial();
        $tmp_page_content_ARRAY = $this->returnPageHTML($tmp_page_serial, 'index');

        $tmp_page_content = $tmp_page_content_ARRAY['page_content'];
        $tmp_search_result_display = $tmp_page_content_ARRAY['page_result_display'];
        //error_log('73 side bitch usr - '.$tmp_page_content);
        $tmp_chunk_title = $tmp_page_content_ARRAY['page_title'];
        $tmp_page_content_len = strlen($tmp_page_content);

        $ts = self::$oCRNRSTN_USR->return_queryDateTimeStamp();

        /*
        search_content
        CONTENT_ID              char(70)
        PAGE_SERIAL             int(11) unsigned
        ISACTIVE                tinyint(1) default 1
        LANGCODE                char(2)
        CONTENT_PATH            varchar(200)
        PAGE_CONTENT_RAW        blob
        CONTENT_LENGTH_RAW      int(11) unsigned
        MODIFIED_BY_IP          varbinary(16)
        CREATED_BY_IP           varbinary(16)
        MODIFIED_BY_USERAGENT   varchar(500)
        CREATED_BY_USERAGENT    varchar(500)
        DATEMODIFIED            datetime
        DATECREATED             timestamp

        search_content_chunked
        CHUNK_ID                char(70)
        CONTENT_ID              FK :: char(70)
        PAGE_SERIAL             FK :: int(11) unsigned
        ISACTIVE                tinyint(1) default 1
        LANGCODE                char(2)
        ...

        INET6_ATON("' . $_SERVER['REMOTE_ADDR'] . '")

         * */

        $oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
        $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

        //
        // CLEAR CHUNKED DATA
        $query = 'DELETE FROM `search_content_chunked`
                    WHERE `search_content_chunked`.`PAGE_SERIAL`="'.$mysqli->real_escape_string($tmp_page_serial).'" 
                    AND `search_content_chunked`.`PAGE_SERIAL_CRC`="'.crc32($tmp_page_serial).'";';

        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'INIT_PAGE_SEARCH', '!jesus_is_my_dear_lord!', 'DELETE_CHUNKED');
        self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'DELETE_CHUNKED', $query);

        $query_select = 'SELECT `search_content`.`CONTENT_ID`,
                    `search_content`.`PAGE_SERIAL`,
                    `search_content`.`PAGE_SERIAL_CRC`,
                    `search_content`.`ISACTIVE`,
                    `search_content`.`LANGCODE`,
                    `search_content`.`CONTENT_PATH`,
                    `search_content`.`BOOLEAN_TEST`,
                    `search_content`.`PAGE_CONTENT_RAW`,
                    `search_content`.`CONTENT_LENGTH_RAW`,
                    `search_content`.`MODIFIED_BY_IP`,
                    `search_content`.`CREATED_BY_IP`,
                    `search_content`.`MODIFIED_BY_USERAGENT`,
                    `search_content`.`CREATED_BY_USERAGENT`,
                    `search_content`.`DATEMODIFIED`,
                    `search_content`.`DATECREATED`
                FROM `search_content`
                WHERE `search_content`.`PAGE_SERIAL`="'.$mysqli->real_escape_string($tmp_page_serial).'" 
                AND `search_content`.`PAGE_SERIAL_CRC`="'.crc32($tmp_page_serial).'" LIMIT 1;
                ';

        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'INIT_PAGE_SEARCH', '!jesus_is_my_dear_lord!', 'CHECK_PAGE_INDEX_EXISTS');
        self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'CHECK_PAGE_INDEX_EXISTS', $query_select);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        self::$oCRNRSTN_USR->processQuery(true);

        $tmp_record_cnt = self::$oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'CHECK_PAGE_INDEX_EXISTS');

        //self::$oCRNRSTN_USR->closeConnection_MySQLi($mysqli);

        if($tmp_record_cnt > 0){

            $oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
            $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

            $tmp_content_id = self::$oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'CHECK_PAGE_INDEX_EXISTS', 'CONTENT_ID');

            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UPDATE_SEARCH', '!jesus_is_my_dear_lord!!', 'SEARCH_CONTENT');

            //
            // UPDATE
            $query = 'UPDATE `search_content`
            SET
            `PAGE_CONTENT_RAW` = "'.$mysqli->real_escape_string($tmp_page_content).'",
            `BOOLEAN_TEST` = true,
            `CONTENT_LENGTH_RAW` = "'.$tmp_page_content_len.'",
            `MODIFIED_BY_IP` = "'.self::$oCRNRSTN_USR->returnClientIP().'",
            `MODIFIED_BY_USERAGENT` = "'.$_SERVER['HTTP_USER_AGENT'].'",
            `DATEMODIFIED` = "'.$ts.'"
            WHERE `CONTENT_ID`= "'.$tmp_content_id.'"
            AND `CONTENT_ID_CRC`= "'.crc32($tmp_content_id).'"
            AND `PAGE_SERIAL` = "'.$tmp_page_serial.'" AND `PAGE_SERIAL_CRC` = "'.crc32($tmp_page_serial).'";';

            self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'SEARCH_CONTENT', $query);

            //
            // REMOVE LINKS...ETC...
            $tmp_page_content = strip_tags($tmp_page_content);
            $tmp_search_result_display = strip_tags($tmp_search_result_display);

            //
            // BREAK CONTENT INTO CHUNKS
            $tmp_page_content = $this->strSanitize($tmp_page_content,'index');
            $tmp_search_result_display = $this->strSanitize($tmp_search_result_display,'index');

            $tmp_sresult_array = $this->chunkPageData($tmp_search_result_display, 200);
            $tmp_search_result_display = $tmp_sresult_array[0];

            //error_log('186 side bitch usr - content=>'.$tmp_page_content);
            $tmp_chunked_array = $this->chunkPageData($tmp_page_content, 1000);
            $chunk_cnt = sizeof($tmp_chunked_array);

            for($i=0;$i<$chunk_cnt;$i++){
                $tmp_chunk_id = self::$oCRNRSTN_USR->generateNewKey(70);
                $tmp_chunk_search = strtolower($this->strSanitize($tmp_chunked_array[$i],'search'));

                $tmp_chunk_len_search = strlen($tmp_chunk_search);
                $tmp_chunk_len_raw = strlen($tmp_chunked_array[$i]);
                //error_log('203 side bitch usr - chunk='.$tmp_chunked_array[$i]);

                $query_chunked = 'INSERT INTO `search_content_chunked`
                                    (`CHUNK_ID`,
                                    `CONTENT_ID`,
                                    `PAGE_SERIAL`,
                                    `PAGE_SERIAL_CRC`,
                                    `SEARCH_RESULT_DISPLAY`,
                                    `PAGE_CONTENT_SEARCH`,
                                    `PAGE_CONTENT_RAW`,
                                    `PAGE_CONTENT_TITLE`,
                                    `CONTENT_LENGTH_SEARCH`,
                                    `CONTENT_LENGTH_RAW`,
                                    `MODIFIED_BY_IP`,
                                    `CREATED_BY_IP`,
                                    `MODIFIED_BY_USERAGENT`,
                                    `CREATED_BY_USERAGENT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("'.$tmp_chunk_id.'",
                                    "'.$tmp_content_id.'",
                                    "'.$mysqli->real_escape_string($tmp_page_serial).'",
                                    "'.crc32($tmp_page_serial).'",
                                    "'.$mysqli->real_escape_string($tmp_search_result_display).'",
                                    "'.$mysqli->real_escape_string($tmp_chunk_search).'",
                                    "'.$mysqli->real_escape_string($tmp_chunked_array[$i]).'",
                                    "'.$mysqli->real_escape_string($tmp_chunk_title).'",
                                    "'.$tmp_chunk_len_search.'",
                                    "'.$tmp_chunk_len_raw.'",
                                    "'.self::$oCRNRSTN_USR->returnClientIP().'",
                                    "'.self::$oCRNRSTN_USR->returnClientIP().'",
                                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                                    "'.$ts.'");
                                    ';

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'UPDATE_SEARCH', '!jesus_is_my_dear_lord!!', 'NEW_SEARCH_CHUNK_PUSH_'.$i);
                self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'NEW_SEARCH_CHUNK_PUSH_'.$i, $query_chunked);

            }

        }else{

            //$oCRNRSTN_MySQLi = self::$oCRNRSTN_USR->returnConnection_MySQLi();
            //$mysqli = $oCRNRSTN_MySQLi->returnConnObject();

            //
            // INSERT
            $tmp_content_id = self::$oCRNRSTN_USR->generateNewKey(70);

            $query = 'INSERT INTO `search_content`
                        (`CONTENT_ID`,
                        `CONTENT_ID_CRC`,
                        `PAGE_SERIAL`,
                        `PAGE_SERIAL_CRC`,
                        `BOOLEAN_TEST`,
                        `CONTENT_PATH`,
                        `PAGE_CONTENT_RAW`,
                        `CONTENT_LENGTH_RAW`,
                        `MODIFIED_BY_IP`,
                        `CREATED_BY_IP`,
                        `MODIFIED_BY_USERAGENT`,
                        `CREATED_BY_USERAGENT`,
                        `DATEMODIFIED`)
                        VALUES
                        ("'.$tmp_content_id.'",
                        "'.crc32($tmp_content_id).'",
                        "'.$mysqli->real_escape_string($tmp_page_serial).'",
                        "'.crc32($tmp_page_serial).'",
                        true,
                        "'.$mysqli->real_escape_string(self::$page_path).'",
                        "'.$mysqli->real_escape_string($tmp_page_content).'",
                        "'.$tmp_page_content_len.'",
                        "'.self::$oCRNRSTN_USR->returnClientIP().'",
                        "'.self::$oCRNRSTN_USR->returnClientIP().'",
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "'.$_SERVER['HTTP_USER_AGENT'].'",
                        "'.$ts.'");
                        ';

            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'NEW_SEARCH', '!jesus_is_my_dear_lord!!', 'NEW_SEARCH_PUSH');
            self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'NEW_SEARCH_PUSH', $query);

            //
            // REMOVE LINKS...ETC...
            $tmp_page_content = strip_tags($tmp_page_content);
            $tmp_search_result_display = strip_tags($tmp_search_result_display);

            //
            // BREAK CONTENT INTO CHUNKS
            $tmp_page_content = $this->strSanitize($tmp_page_content,'index');
            $tmp_search_result_display = $this->strSanitize($tmp_search_result_display,'index');

            $tmp_sresult_array = $this->chunkPageData($tmp_search_result_display, 200);
            $tmp_search_result_display = $tmp_sresult_array[0];

            //
            // BREAK CONTENT INTO CHUNKS
            //error_log('252 side bitch usr - content='.$tmp_page_content);
            $tmp_chunked_array = $this->chunkPageData($tmp_page_content, 1000);
            $chunk_cnt = sizeof($tmp_chunked_array);

            for($i=0;$i<$chunk_cnt;$i++){
                $tmp_chunk_id = self::$oCRNRSTN_USR->generateNewKey(70);
                $tmp_chunk_search = strtolower($this->strSanitize($tmp_chunked_array[$i],'search'));

                $tmp_chunk_len_search = strlen($tmp_chunk_search);
                $tmp_chunk_len_raw = strlen($tmp_chunked_array[$i]);

                $query_chunked = 'INSERT INTO `search_content_chunked`
                                    (`CHUNK_ID`,
                                    `CONTENT_ID`,
                                    `PAGE_SERIAL`,
                                    `PAGE_SERIAL_CRC`,
                                    `SEARCH_RESULT_DISPLAY`,
                                    `PAGE_CONTENT_SEARCH`,
                                    `PAGE_CONTENT_RAW`,
                                    `PAGE_CONTENT_TITLE`,
                                    `CONTENT_LENGTH_SEARCH`,
                                    `CONTENT_LENGTH_RAW`,
                                    `MODIFIED_BY_IP`,
                                    `CREATED_BY_IP`,
                                    `MODIFIED_BY_USERAGENT`,
                                    `CREATED_BY_USERAGENT`,
                                    `DATEMODIFIED`)
                                    VALUES
                                    ("'.$tmp_chunk_id.'",
                                    "'.$tmp_content_id.'",
                                    "'.$mysqli->real_escape_string($tmp_page_serial).'",
                                    "'.crc32($tmp_page_serial).'",
                                    "'.$mysqli->real_escape_string($tmp_search_result_display).'",
                                    "'.$mysqli->real_escape_string($tmp_chunk_search).'",
                                    "'.$mysqli->real_escape_string($tmp_chunked_array[$i]).'",
                                    "'.$mysqli->real_escape_string($tmp_chunk_title).'",
                                    "'.$tmp_chunk_len_search.'",
                                    "'.$tmp_chunk_len_raw.'",
                                    "'.self::$oCRNRSTN_USR->returnClientIP().'",
                                    "'.self::$oCRNRSTN_USR->returnClientIP().'",
                                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                                    "'.$_SERVER['HTTP_USER_AGENT'].'",
                                    "'.$ts.'");
                                    ';

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'NEW_SEARCH', '!jesus_is_my_dear_lord!!', 'NEW_SEARCH_CHUNK_PUSH_'.$i);
                self::$oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'NEW_SEARCH_CHUNK_PUSH_'.$i, $query_chunked);

            }

        }

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        self::$oCRNRSTN_USR->processQuery(true);

    }

    public function returnPageSearchResultsHTML($serial, $channel='desktop'){

        return self::$oContentGen->returnPageSearchResultsHTML($this, $serial, $channel);

    }

    public function returnSearchResultHTML($page_path, $return_content, $content_title, $ugc_search_str){

        $tmp_result_id = self::$oCRNRSTN_USR->generateNewKey(10);
        $page_path = ltrim($page_path, "/");
        $tmp_page_uri = self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP").self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP_DIR").$page_path;

        if($content_title!=''){
            $content_title = '<span class="s_result_title">'.$content_title.' ::</span> ';

            $result_HTML = '<div id="sresult_'.$tmp_result_id.'" class="s_resultfull_wrapper" onmouseover="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseout\'); return false;" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">'.$content_title.$return_content.'...</div>';
        }else{

            $result_HTML = '';

        }

        return $result_HTML;
    }

    public function returnSearchResultMOBILE($page_path, $return_content, $content_title, $ugc_search_str){

        $tmp_result_id = self::$oCRNRSTN_USR->generateNewKey(10);
        $page_path = ltrim($page_path, "/");
        $tmp_page_uri = self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP").self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP_DIR").$page_path;

        if($content_title!=''){
            $content_title = '<span class="s_result_title">'.$content_title.' ::</span> ';

            //$result_HTML = '<div id="sresult_'.$tmp_result_id.'" class="s_resultfull_wrapper" onmouseover="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseout\'); return false;" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">'.$content_title.$return_content.'...</div>';

            /*
            $result_HTML = '<div class="ui-corner-all custom-corners" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">
              <div class="ui-bar ui-bar-a">
                <h3>'.$content_title.'</h3>
              </div>
              <div class="ui-body ui-body-a">
                <p>'.$return_content.'...</p>
              </div>
            </div>';
            */

            $result_HTML = '<div class="ui-body ui-body-a ui-corner-all" style="background-color:#FFF; border-bottom:0;" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">
                <h3>'.$content_title.'</h3>
                      <p>'.$return_content.'...</p>
                      <div id="custom-border-radius_'.$tmp_result_id.'" class="ui-shadow-icon">
                            <a href="'.$tmp_page_uri.'" class="ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-icon-notext ui-shadow-icon" style="float: right;" data-ajax="false">Go</a>
                        </div>
                  </div>';
        }else{

            $result_HTML = '<div class="ui-body ui-body-a ui-corner-all" style="background-color:#FFF; border-bottom:0;" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">
                  <p>'.$return_content.'...</p>
                  <div id="custom-border-radius_'.$tmp_result_id.'" class="ui-shadow-icon">
                        <a href="'.$tmp_page_uri.'" class="ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-icon-notext ui-shadow-icon" style="float: right;" data-ajax="false">Go</a>
                    </div>
              </div>';

        }

        return $result_HTML;
    }

    public function returnAjaxSearchResultMOBILE($ugc_search_str, $page_path, $return_content, $content_title){

        //$tmp_result_id = self::$oCRNRSTN_USR->generateNewKey(10);
        $page_path = ltrim($page_path, "/");
        $tmp_page_uri = self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP").self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP_DIR").$page_path;

        //if($content_title!=''){
        //     $content_title = '<span class="s_result_title">'.$content_title.' ::</span> ';
        //}

        //$result_HTML = '<li id="sresult_'.$tmp_result_id.'" onmouseover="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseout\'); return false;" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">'.$content_title.$return_content.'...</li>';

        $result_JSON = '{"kivotosname":"'.$content_title.'","kivotosuri":"'.$tmp_page_uri.'","kivotossearch":"'.$ugc_search_str.'"},';

        return $result_JSON;

    }

    public function returnAjaxSearchResultHTML($page_path, $return_content, $content_title){

	    $tmp_result_id = self::$oCRNRSTN_USR->generateNewKey(10);
        $page_path = ltrim($page_path, "/");
	    $tmp_page_uri = self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP").self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP_DIR").$page_path;

	    if($content_title!=''){
            $content_title = '<span class="s_result_title">'.$content_title.' ::</span> ';
        }

        $result_HTML = '<li id="sresult_'.$tmp_result_id.'" onmouseover="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseover\'); return false;" onmouseout="ajax_search_result(\'#sresult_'.$tmp_result_id.'\', \'mouseout\'); return false;" onclick="loadPage(\''.$tmp_page_uri.'\'); return false;">'.$content_title.$return_content.'...</li>';

	    return $result_HTML;
    }

    public function chunkPageData($tmp_page_content, $max_len){

	    //error_log('208 side bitch usr - len='.strlen($tmp_page_content));

	    //
	    // SOURCE :: https://www.php.net/manual/en/function.preg-split.php
	    // AUTHOR :: (canadian dot in dot exile at gmail dot com) https://www.php.net/manual/en/function.preg-split.php#118326
        // "word-wrap" at, for example, 60 characters or less

        // this regular expression will split $long_string on any sub-string of
        // 1-or-more non-word characters (spaces or punctuation)
        if(preg_match_all("/.{1,{$max_len}}(?=\W+)/", $tmp_page_content, $lines) !== False) {

            return $lines[0];

        }

        return false;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.preg-split.php
    // AUTHOR :: (buzoganylaszlo at yahoo dot com) https://www.php.net/manual/en/function.preg-split.php#92632
    public function processQuotedSearch($ugc_str){

        $words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $ugc_str, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        //error_log('399 side bitch usr - '.sizeof($words));

        return $words;

        /*
        $search_expression = "apple bear \"Tom Cruise\" or 'Mickey Mouse' another word";

        ?>

        The result will be:
        Array
        (
            [0] => apple
            [1] => bear
            [2] => Tom Cruise
            [3] => or
            [4] => Mickey Mouse
            [5] => another
            [6] => word
        )
	     * */
    }

    public function initializePage($key, $category_name, $subcategory_name, $subsubcat_name){

        try {

            if(strlen($category_name)<3 || strlen($subcategory_name)<3){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Error building page ['.$category_name.'/'.$subcategory_name.'] from provided key ['.$key.'].');

            }

            //self::$oCRNRSTN_USR->error_log('Breaking the switch(key) now to throw an exception...', __LINE__, __METHOD__, __FILE__, 'SKIP ME NOW!');

            switch($key){
                case 'PAGE':
                    //self::$oCRNRSTN_USR->error_log('See me?...CERTAIN_DESTRUCTION', __LINE__, __METHOD__, __FILE__, 'CERTAIN_DESTRUCTION');

                    //error_log('215 side bitch usr - '.self::$oContentGen->page_serial);
                    //
                    // AFTER TESTING...MAY NEED TO MAKE MORE ROBUST IF APPENDING $_GET PARAMS TO LINKS
                    $tmp_uri = $_SERVER['SCRIPT_NAME'];
                    $tmp_uri = str_replace("index.php", "", $tmp_uri);

                    self::$oContentGen->page_uri = $tmp_uri;
                    self::$oContentGen->page_category_name = $category_name;
                    self::$oContentGen->page_subcategory_name = $subcategory_name;
                    self::$oContentGen->page_subsubcateg_name = $subsubcat_name;

                    //
                    // GENERATE UNIQUE HANDLE FOR THIS DATA
                    self::$oContentGen->initPage(crc32(self::$oContentGen->page_uri.self::$oContentGen->page_category_name.self::$oContentGen->page_subcategory_name.self::$oContentGen->page_subsubcateg_name));

                    self::$oContentGen->page_category_name_ARRAY[self::$oContentGen->page_serial] = $category_name;
                    self::$oContentGen->page_subcategory_name_ARRAY[self::$oContentGen->page_serial] = $subcategory_name;
                    self::$oContentGen->page_subsubcateg_name_ARRAY[self::$oContentGen->page_serial] = $subsubcat_name;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Error building page within section ['.$category_name.'/'.$subcategory_name.'] from provided key ['.$key.'].');

                break;
            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //self::$oCRNRSTN_USR->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;
        }

        return self::$oContentGen->page_serial;

    }

	public function addPageElement($serial, $key, $attribute_00, $attribute_01=NULL, $attribute_02=NULL, $attribute_03=NULL, $attribute_04=NULL){

        try {

            if(strlen($key)<1){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Error adding page element with data ['.$attribute_00.'] from provided key ['.$key.'].');

            }

            switch($key){
                case 'PARAMETER_DEFINITION':
                case 'RETURNED_VALUE':
                case 'INVOKING_CLASS':
                case 'METHOD_DEFINITION':
                case 'TECH_SPEC':
                case 'BASIC_COPY':
                case 'NOTE_COPY':
                case 'SUB_TITLE':

                    self::$oContentGen->addPageElement($serial, $key, $attribute_00);

                break;
                case 'EXAMPLE':
                    //$oSideBitch_Usr->addPageElement($tmp_page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    self::$oContentGen->addPageElement($serial, $key, $attribute_00, $attribute_01, $attribute_02, $attribute_03);

                break;

            }

        } catch (Exception $e) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice('sideload_user->addPageElement()', LOG_EMERG, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
        }

    }

    public function getCategory($serial){

	    return self::$oContentGen->page_category_name_ARRAY[$serial];
    }

    public function getSubCategory($serial){

        return self::$oContentGen->page_subcategory_name_ARRAY[$serial];
    }

    public function returnPageHTML($serial, $channel='desktop'){

        return self::$oContentGen->returnPageHTML($serial, $channel);

    }

    public function returnPageSerial(){

        return self::$oContentGen->returnPageSerial();
    }

    public function navActiveState($nav_copy){
        //error_log('317 side bitch usr - serial='.self::$oContentGen->page_serial);
	    if(strtolower($nav_copy) == strtolower(self::$oContentGen->page_subcategory_name_ARRAY[self::$oContentGen->page_serial])){

            echo ' subnav_active';

        }else{

	        echo '';
        }

	    return NULL;
    }

    //
    // SOURCE :: https://gist.github.com/breakermind forked from https://gist.github.com/jasny/2000705
    private function linkify($showimg = 1, $value, $protocols = array('http', 'mail', 'https'), array $attributes = array('target' => '_blank')){
        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr = ' ' . $key . '="' . htmlentities($val) . '"';
        }

        $links = array();

        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
                    function ($match) use ($protocol, &$links, $attr, $showimg) {
                        if ($match[1]){
                            $protocol = $match[1]; $link = $match[2] ?: $match[3];
                            // Youtube
                            if($showimg == 1){
                                if(strpos($link, 'youtube.com')>0 || strpos($link, 'youtu.be')>0){
                                    $link = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.end(explode('=', $link)).'?rel=0&showinfo=0&color=orange&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>';
                                    return '<' . array_push($links, $link) . '></a>';
                                }
                                if(strpos($link, '.png')>0 || strpos($link, '.jpg')>0 || strpos($link, '.jpeg')>0 || strpos($link, '.gif')>0 || strpos($link, '.bmp')>0){
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\"><img src=\"$protocol://$link\" class=\"htmlimg\">") . '></a>';
                                }
                            }

                            //
                            // PROXY CHECK HERE. DO WE HAVE EXTERNAL LINK? IF SO, PROXY IT. self::$transform_output_ARRAY['QUERY'/'STYLED_CONTENT']
                            if(strpos($link, 'evifweb.com')>0){

                                if(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\" data-ajax=\"false\">$link</a>") . '>';
                                }else {
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\">$link</a>") . '>';
                                }

                            }else{

                                //
                                // LINK NEEDS TO BE PROXIED
                                # $tmp_output_ARRAY[0]=PROTOCOL $tmp_output_ARRAY[1]=LINK
                                $tmp_output_ARRAY = $this->buildProxy($protocol,$link);

                                if(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
                                    return '<' . array_push($links, "<a $attr href=\"$tmp_output_ARRAY[0]://$tmp_output_ARRAY[1]\" class=\"htmllink\" data-ajax=\"false\">$link</a>") . '>';
                                }else {
                                    return '<' . array_push($links, "<a $attr href=\"$tmp_output_ARRAY[0]://$tmp_output_ARRAY[1]\" class=\"htmllink\">$link</a>") . '>';
                                }


                            }

                        }
                    }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\" class=\"htmllink\">{$match[0]}</a>") . '>'; }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
            }
        }

        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
    }

    public function strSanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try{

            switch($type){
                case 'index':

                    $patterns[0] = '&nbsp;';
                    $patterns[1] = ')';
                    $replacements[0] = ' ';
                    $replacements[1] = ') ';

                break;
                case 'search':

                    $patterns[0] = "
";
                    $patterns[1] = '"';
                    $patterns[2] = '=';
                    $patterns[3] = '{';
                    $patterns[4] = '}';
                    $patterns[5] = '(';
                    $patterns[6] = ')';
                    $patterns[7] = ' ';
                    $patterns[8] = '	';
                    $patterns[9] = ',';
                    $patterns[10] = '\n';
                    $patterns[11] = '\r';
                    $patterns[12] = '\'';
                    $patterns[13] = '/';
                    $patterns[14] = '#';
                    $patterns[15] = ';';
                    $patterns[16] = ':';
                    //$patterns[17] = '>';

                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';
                    $replacements[4] = '';
                    $replacements[5] = '';
                    $replacements[6] = '';
                    $replacements[7] = '';
                    $replacements[8] = '';
                    $replacements[9] = '';
                    $replacements[10] = '';
                    $replacements[11] = '';
                    $replacements[12] = '';
                    $replacements[13] = '';
                    $replacements[14] = '';
                    $replacements[15] = '';
                    $replacements[16] = '';
                    //$replacements[17] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm ['.$type.'] for the content['.$str.'].');

                break;
            }

        } catch( Exception $e ) {

            //$this->oLogger->captureNotice('CRNRSTN :: Error Notification :: '.__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_NOTICE, $e->getMessage(), self::$oCRNRSTN_USR->oLog_output_ARRAY);
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
            return false;
        }

        $str = str_replace($patterns, $replacements, $str);

        return $str;
    }

	public function __destruct() {
		
	}
}