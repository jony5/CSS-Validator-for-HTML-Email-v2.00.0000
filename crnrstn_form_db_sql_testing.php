<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2021 eVifweb development
#  VERSION :: 2.00.0000 on Sun May 31, 2020 at 1259
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
# # C # R # N # R # S # T # N # : : # # ##
#
// NOTE: THIS IS ALL OLD DEV AND TESTING CODE...SOME METHOD NAMES MAY HAVE CHANGED.
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN_USR->returnSrvrRespStatus(503);
exit();

$test = '';
$test_append = '';
$oQueryProfileMgr = new crnrstn_query_profile_manager($oCRNRSTN_USR);

//
// ENABLE THIS PAGE TO RECEIVE HTTP POST/GET DATA
if($oCRNRSTN_USR->receiveFormIntegrationPacket()){

    if($oCRNRSTN_USR->isValid_dataValidationCheck('POST')){

        //
        // PREPARE RECEIVED INPUT PARAMETERS FOR DATABASE QUERY
        $tmp_personal_preference = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('personal_preference');
        $tmp_animal_type = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('animal_type');
        $tmp_php_sessionid = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('php_sessionid');

        //
        // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
        $oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();
        $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

        $query1 = 'SELECT `colors_hex`.`COLOR_ID` AS `THA_BOSS_COLORID`,`colors_hex`.`COLOR_HEX`,`colors_hex`.`COLOR_NAME`,`colors_hex`.`CREATOR_IP`,`colors_hex`.`DATECREATED` FROM `colors_hex`;';

        if(strlen($tmp_php_sessionid)==26){
            $tmp_delete_session = true;

            $query2 = 'SELECT `sessions`.`SESSIONID`, `sessions`.`USERID`, `sessions`.`REMOTE_ADDR_IPV4`, `sessions`.`REMOTE_ADDR_IPV6`, `sessions`.`ISACTIVE`, `sessions`.`DATEMODIFIED`,`sessions`.`DATECREATED` FROM `sessions` WHERE `sessions`.`SESSIONID`!="'.$mysqli->real_escape_string($tmp_php_sessionid).'" ORDER BY `sessions`.`DATEMODIFIED` DESC;';
            $query3 = 'DELETE FROM `sessions` WHERE `sessions`.`SESSIONID`="'.$mysqli->real_escape_string($tmp_php_sessionid).'" LIMIT 1;';

            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'SESSION_DATA_DELETE');
            $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr, 'SESSION_DATA_DELETE', $query3);

            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->updateTTL(3600);
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->returnTTL_wallTime();
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->expireQuery(ttl=-3000);
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->updateQuery();
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->getQueryStatus();
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->cacheQuery();        # SESSION
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->cacheQueryResults(); # SESSION
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->returnQuery();
            #$oCRNRSTN_USR->oCRNRSTN_QueryMgr->returnConnection(type=mysqli);


        }else{

            $query2 = 'SELECT `sessions`.`SESSIONID`, `sessions`.`USERID`, `sessions`.`REMOTE_ADDR_IPV4`, `sessions`.`REMOTE_ADDR_IPV6`, `sessions`.`ISACTIVE`, `sessions`.`DATEMODIFIED`,`sessions`.`DATECREATED` FROM `sessions` ORDER BY `sessions`.`DATEMODIFIED` DESC;';

        }

        //
        // addDatabaseQuery() WILL SERIALIZE THE QUERY TO THE CONNECTION PROVIDED. CRNRSTN :: SUPPORTS n+1 MYSQLI DATABASE CONNECTIONS.
        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'COLOR_TYPES');
        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'NEW_OR_KEEPALIVE_SESSION');
        $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'SESSION_DATA');

        $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'COLOR_TYPES', $query1);
        $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'NEW_OR_KEEPALIVE_SESSION');
        $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'SESSION_DATA', $query2);

        //
        // PROCESS ALL QUERY TO CONNECTION(S)
        $oCRNRSTN_USR->processQuery(true);

        $tmp_record_cnt_COLOR = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'COLOR_TYPES');
        error_log('76 demo - result record count[COLOR_TYPES]='.$tmp_record_cnt_COLOR);

        $tmp_record_cnt_SESSION = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr, 'SESSION_DATA');
        error_log('79 demo - result record count[SESSION_DATA]='.$tmp_record_cnt_SESSION);

        $desired_color = 'White';

        if($oCRNRSTN_USR->pingValueExistence($oQueryProfileMgr, 'COLOR_TYPES', 'COLOR_NAME', $desired_color)){

            $test .= $desired_color.' is in the data set!<br>';

        }else{

            $test .= $desired_color.' is <strong>NOT</strong> in the data set!<br>';

        }

        if($oCRNRSTN_USR->pingValueExistence($oQueryProfileMgr, 'SESSION_DATA', 'SESSIONID', session_id())){

            $test .= 'Your session is ACTIVE!<br>';

        }else{

            //if(strlen($tmp_php_sessionid)==26){

            $test .= 'Your session has been <strong class="the_R">DESTROYED!</strong><br>';

            //}

        }

        for($i=0; $i<$tmp_record_cnt_SESSION; $i++){

            $tmp_SESSIONID = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'SESSION_DATA', 'SESSIONID', $i);
            $tmp_DATEMODIFIED = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'SESSION_DATA', 'DATEMODIFIED', $i);
            $tmp_DATECREATED = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'SESSION_DATA', 'DATECREATED', $i);

            if($tmp_SESSIONID == session_id()){

                $test .= '<span class="the_R" style="font-size:10px;">'.$tmp_SESSIONID.'&nbsp;'.$tmp_DATEMODIFIED.'&nbsp;'.$tmp_DATECREATED.'</span><br>';

            }else{
                $test .= '<span style="font-size:10px; color:#ccc;">'.$tmp_SESSIONID.'&nbsp;'.$tmp_DATEMODIFIED.'&nbsp;'.$tmp_DATECREATED.'</span><br>';

            }
        }
        
        //
        // RECEIVE AND PROCESS DATABASE RESULTS
        // retrieveDataByID()
        // keyDataByID()
        // data_prep_flagUserAssociations()
        // returnDatabaseValue()
        // pingValueExistence()
        // ping_profile_existence()
        // $oDB_RESP->returnRecordCount($oDB_RESP->return_serial($tmp_serial_handle), 'USERS');

        $test_append = '';
        for($i=0;$i<$tmp_record_cnt_COLOR;$i++){

            $tmp_name = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'COLOR_TYPES', 'COLOR_NAME', $i);

            $test .= $tmp_name.'<br>';

            if($tmp_name == $desired_color){
                $oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();
                $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI_TWO', '!jesus_is_my_dear_lord!!', 'COLOR_TYPES_NEW');

                $query2 = 'SELECT `colors_hex`.`COLOR_ID`,`colors_hex`.`COLOR_HEX`,`colors_hex`.`COLOR_NAME`,`colors_hex`.`CREATOR_IP`,`colors_hex`.`DATECREATED` FROM `colors_hex` WHERE `colors_hex`.`COLOR_NAME`="'.$tmp_name.'" LIMIT 1;';
                $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'COLOR_TYPES_NEW', $query2);

                //
                // PROCESS ALL QUERY TO CONNECTION(S)
                error_log('152 [POST] demo - process 2 round to database...');
                $oCRNRSTN_USR->processQuery(true);

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI_TWO', '!jesus_is_my_dear_lord!!', 'COLOR_TYPES_NEW');

                $tmp_loop_count2 = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr,'COLOR_TYPES_NEW');
                error_log('156 demo - twice fire (COLOR_TYPES_NEW LIMIT 1) result count = '.$tmp_loop_count2);

                //
                // TODO :: CONSIDER $oCRNRSTN_USR->connectionLock($oCRNRSTN_MySQLi) CONNECTION ARRAY
                // TODO :: (CONTINUED) OR SOMETHING PASSED IN TO SPECIFY CONNECTION FOR DUP SERIAL USE-CASE
                $tmp_desired_color_hex = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'COLOR_TYPES_NEW', 'COLOR_NAME');

                $test_append = '<br>Desired Color Hex As In the System ::<br>= = =<br>'.$tmp_desired_color_hex.'<br>= = =<br>';

            }

        }


        if($oCRNRSTN_USR->pingResultSetExistence($oQueryProfileMgr, 'COLOR_TYPES')){

            $test .= '<br>COLOR_TYPES has been returned!<br>';
        }else{
            $test .= '<br>COLOR_TYPES has NOT been returned!<br>';

        }

        if($oCRNRSTN_USR->pingResultSetExistence($oQueryProfileMgr, 'COLOR_TYPES_NEW')){

            $test .= '<br>COLOR_TYPES_NEW has been set!<br>';
        }else{
            $test .= '<br>COLOR_TYPES_NEW has NOT been returned!<br>';

        }

    }else{

        if($oCRNRSTN_USR->isValid_dataValidationCheck('GET')){

            $tmp_personal_preference = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('personal_preference');
            $tmp_animal_type = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('animal_type');
            $tmp_php_sessionid = $oCRNRSTN_USR->returnHTTP_FormIntegration_InputVal('php_sessionid');

            //
            // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
            $oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();
            $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

            $query1 = 'SELECT `colors_hex`.`COLOR_ID`,`colors_hex`.`COLOR_HEX`,`colors_hex`.`COLOR_NAME`,`colors_hex`.`CREATOR_IP`,`colors_hex`.`DATECREATED` FROM `colors_hex`;';

            if(strlen($tmp_php_sessionid)==26){
                $query2 = 'SELECT `sessions`.`SESSIONID`, `sessions`.`USERID`, `sessions`.`REMOTE_ADDR_IPV4`, `sessions`.`REMOTE_ADDR_IPV6`, `sessions`.`ISACTIVE`, `sessions`.`DATEMODIFIED`,`sessions`.`DATECREATED` FROM `sessions` WHERE `sessions`.`SESSIONID`!="'.$mysqli->real_escape_string($tmp_php_sessionid).'" ORDER BY `sessions`.`DATEMODIFIED` DESC;';
                $query3 = 'DELETE FROM `sessions` WHERE `sessions`.`SESSIONID`="'.$mysqli->real_escape_string($tmp_php_sessionid).'" LIMIT 1;';

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'SESSION_DATA');
                $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'SESSION_DATA', $query3);

                $tmp_delete_session = true;

            }else{

                $query2 = 'SELECT `sessions`.`SESSIONID`, `sessions`.`USERID`, `sessions`.`REMOTE_ADDR_IPV4`, `sessions`.`REMOTE_ADDR_IPV6`, `sessions`.`ISACTIVE`, `sessions`.`DATEMODIFIED`,`sessions`.`DATECREATED` FROM `sessions` ORDER BY `sessions`.`DATEMODIFIED` DESC;';

                $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'NEW_OR_KEEPALIVE_SESSION');
                $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'NEW_OR_KEEPALIVE_SESSION');

            }

            //
            // addDatabaseQuery() WILL SERIALIZE THE QUERY TO THE CONNECTION PROVIDED. CRNRSTN :: SUPPORTS n+1 MYSQLI DATABASE CONNECTIONS.
            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'COLOR_TYPES');
            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'SESSION_DATA');

            $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'COLOR_TYPES', $query1);
            $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'SESSION_DATA', $query2);

            //
            // PROCESS ALL QUERY TO CONNECTION(S)
            $oCRNRSTN_USR->processQuery(true);

            $desired_color = 'White';

            if($oCRNRSTN_USR->pingValueExistence($oQueryProfileMgr, 'COLOR_TYPES', 'COLOR_NAME', $desired_color)){

                $test .= $desired_color.' is in the data set!<br>';

            }else{

                $test .= $desired_color.' is <strong>NOT</strong> in the data set!<br>';

            }

            $tmp_loop_count = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr,'SESSION_DATA');
            if($tmp_loop_count>0){

                if($oCRNRSTN_USR->pingValueExistence($oQueryProfileMgr, 'SESSION_DATA', 'SESSIONID', session_id())){

                    $test .= 'Your session is ACTIVE!<br>';

                }else{

                    if(strlen($tmp_php_sessionid)==26){

                        //$test .= 'Your session has been <strong class="the_R">DESTROYED!</strong><br>';

                    }
                }

            }

            for($i=0;$i<$tmp_loop_count;$i++){
                $tmp_SESSIONID = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'SESSION_DATA', 'SESSIONID', $i);
                $tmp_DATEMODIFIED = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'SESSION_DATA', 'DATEMODIFIED', $i);
                $tmp_DATECREATED = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'SESSION_DATA', 'DATECREATED', $i);

                if($tmp_SESSIONID==session_id()){

                    $test .= '<span class="the_R" style="font-size:10px;">'.$tmp_SESSIONID.'&nbsp;'.$tmp_DATEMODIFIED.'&nbsp;'.$tmp_DATECREATED.'</span><br>';

                }else{
                    
                    $test .= '<span style="font-size:10px; color:#ccc;">'.$tmp_SESSIONID.'&nbsp;'.$tmp_DATEMODIFIED.'&nbsp;'.$tmp_DATECREATED.'</span><br>';

                }

            }

            $tmp_loop_count = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr,'COLOR_TYPES');
            $test_append = '';
            for($i=0;$i<$tmp_loop_count;$i++){

                $tmp_name = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'COLOR_TYPES', 'COLOR_NAME', $i);

                $test .= $tmp_name.'<br>';

                if($tmp_name == $desired_color){
                    $oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();
                    error_log('266 demo - Add second query...');
                    $query2 = 'SELECT `colors_hex`.`COLOR_ID`,`colors_hex`.`COLOR_HEX`,`colors_hex`.`COLOR_NAME`,`colors_hex`.`CREATOR_IP`,`colors_hex`.`DATECREATED` FROM `colors_hex` WHERE `colors_hex`.`COLOR_NAME`="'.$mysqli->real_escape_string($tmp_name).'" LIMIT 1;';

                    $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI_THREE', '!jesus_is_my_dear_lord!!', 'COLOR_TYPES_NEW');
                    $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'COLOR_TYPES_NEW', $query2);

                    //
                    // PROCESS ALL QUERY TO CONNECTION(S)
                    error_log('272 [GET] demo - process 2 round to database...');
                    $oCRNRSTN_USR->processQuery(true);

                    $tmp_loop_count2 = $oCRNRSTN_USR->returnRecordCount($oQueryProfileMgr,'COLOR_TYPES_NEW');
                    error_log('276 [GET] demo - returnRecordCount() fire (COLOR_TYPES_NEW LIMIT 1) result count = '.$tmp_loop_count2);


                    //
                    // TODO :: CONSIDER $oCRNRSTN_USR->connectionLock($oCRNRSTN_MySQLi) CONNECTION ARRAY
                    // TODO :: (CONTINUED) OR SOMETHING PASSED IN TO SPECIFY CONNECTION FOR DUP SERIAL USE-CASE
                    $tmp_desired_color_hex = $oCRNRSTN_USR->returnDatabaseValue($oQueryProfileMgr, 'COLOR_TYPES_NEW', 'COLOR_NAME');

                    $test_append = '<br>Desired Color Hex As In the System ::<br>= = =<br>'.$tmp_desired_color_hex.'<br>= = =<br>';
                }

            }

            //
            // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
            $tmp_err_array = $oCRNRSTN_USR->returnErr_dataValidationCheck('POST');

            foreach($tmp_err_array as $key=>$val){

                $test .= $val.'<br>';

            }

            //
            // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
            $tmp_err_array = $oCRNRSTN_USR->returnErr_dataValidationCheck('GET');

            foreach($tmp_err_array as $key=>$val){

                $test .= $val.'<br>';

            }

            if($oCRNRSTN_USR->pingResultSetExistence($oQueryProfileMgr, 'COLOR_TYPES')){

                $test .= '<br>COLOR_TYPES has been returned!<br>';
            }else{
                $test .= '<br>COLOR_TYPES has NOT been returned!<br>';

            }

            $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI_THREE', '!jesus_is_my_dear_lord!!', 'COLOR_TYPES_NEW');

            if($oCRNRSTN_USR->pingResultSetExistence($oQueryProfileMgr, 'COLOR_TYPES_NEW')){

                $test .= '<br>COLOR_TYPES_NEW has been set!<br>';
            }else{
                $test .= '<br>COLOR_TYPES_NEW has NOT been returned!<br>';

            }


        }else{

            //
            // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
            $tmp_err_array = $oCRNRSTN_USR->returnErr_dataValidationCheck('POST');
            $test = '';

            foreach($tmp_err_array as $key=>$val){

                $test .= $val.'<br>';

            }

            //
            // FORM INPUT ERROR HANDLING. CAN MANUALLY HANDLE REDIRECTS HERE IF DESIRED.
            $tmp_err_array = $oCRNRSTN_USR->returnErr_dataValidationCheck('GET');
            //$test = '';

            foreach($tmp_err_array as $key=>$val){

                $test .= $val.'<br>';

            }

            $test .= '<br>'.session_id().'<br>';

        }

    }

}else{

    //
    // ACQUIRE NECESSARY DATABASE CONNECTION(S) AND SERIALIZE THEIR QUERIES...TO THEM, RESPECTIVELY.
    $oCRNRSTN_MySQLi = $oCRNRSTN_USR->returnConnection_MySQLi();
    $mysqli = $oCRNRSTN_MySQLi->returnConnObject();

    $query1 = 'SELECT `colors_hex`.`COLOR_ID` AS `THA_BOSS_COLORID`,`colors_hex`.`COLOR_HEX`, `colors_hex`.`COLOR_APPLICATION_KEY`,`colors_hex`.`COLOR_NAME`,`colors_hex`.`ISACTIVE`,`colors_hex`.`CREATOR_IP`,`colors_hex`.`DATECREATED` FROM `colors_hex`;';

    $oQueryProfileMgr->loadQueryProfile($oCRNRSTN_MySQLi, 'DEMO_MYSQLI', '!jesus_is_my_dear_lord!', 'COLOR_TYPES');

    $oCRNRSTN_USR->addDatabaseQuery($oQueryProfileMgr,'COLOR_TYPES', $query1);

    //
    // PROCESS ALL QUERY TO CONNECTION(S)
    $oCRNRSTN_USR->processQuery(true);

    $tmp_color_hex = $oCRNRSTN_USR->retrieveDataByID($oQueryProfileMgr,'COLOR_TYPES','COLOR_NAME|COLOR_HEX|COLOR_APPLICATION_KEY|ISACTIVE','Black|#172B16|BACKGROUND|1','THA_BOSS_COLORID');

    $test .= '<br>Color Lookup By ID: <br>8GQLUBH4aedQ9l7c71DPb66U6t4QvCd2CqC23lpsAGqPSKjrVQYu12VbvYN5BWUbOaTS5R = <br>'.$tmp_color_hex.'<br>';

}

if($test==''){
    $test .= '<br>'.session_id().'<br>';
}

$tmp_http_root = $oCRNRSTN_USR->get_resource("ROOT_PATH_CLIENT_HTTP").$oCRNRSTN_USR->get_resource("ROOT_PATH_CLIENT_HTTP_DIR");

//
// INITIALIZE CRNRSTN TO CATCH THE FORM(S) ON THIS PAGE. THEREFORE, NEED TO THROW  SOME THINGS.
// ID THE FORM FOR ALL PARAMS TO BE ASSOCIATED.
# SHOULD BE A UNIQUE HANDLE TO THE FORM PROFILE. IT DETERMINES WHAT POTENTIAL POST/GET
# PARAMETERS FOR WHICH CRNRSTN SHOULD BE LISTENING.
# $oCRNRSTN_USR->initializeFormHandling({CRNRSTN_FORM_HANDLE}, {TRANSPORT_PROTOCOL});
$oCRNRSTN_USR->initFormHandling('crnrstn_form_db_demo');
$oCRNRSTN_USR->initFormHandling('crnrstn_form_db_demo_GET');

//
// THESE ARE THE INPUT FIELDS TO WHICH WE WILL LOOK
# THESE FIELDS ARE NOT HIDDEN. THEY WILL NOT/CANNOT BE
# ENCRYPTED INITIALLY.
# $oCRNRSTN_USR->addFormInputParamListener({CRNRSTN_FORM_HANDLE}, {HTML_DOM_FORM_INPUT_NAME}}, {IS_REQUIRED});
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'username', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'firstname', false);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'lastname', false);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'mobilenumber', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'email', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'zipcode', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo', 'php_sessionid', false);
 # php_sessionid
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo_GET', 'animal_type', false);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo_GET', 'mineral_type', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo_GET', 'plant_type', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo_GET', 'automobile_type', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo_GET', 'aircraft_type', true);
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_db_demo_GET', 'php_sessionid', false);

$err_uri = $tmp_http_root.'newfeatures/mysql_database/crnrstn_form_demo.php?submission=error';
$success_uri = $tmp_http_root.'newfeatures/mysql_database/crnrstn_form_demo.php?submission=success';
$oCRNRSTN_USR->addValidationRedirect('crnrstn_form_db_demo', '*', '*', $err_uri, $success_uri);
$oCRNRSTN_USR->addValidationRedirect('crnrstn_form_db_demo_GET', 'mineral_type|plant_type|automobile_type|aircraft_type', 'IS_REQUIRED', $err_uri.'&form=crnrstn_form_db_demo_GET', $success_uri.'&form=crnrstn_form_db_demo_GET');

$oCRNRSTN_USR->outputValidationErrMsg('crnrstn_form_db_demo','username', 'Username is a required field.');


//
// THESE FIELDS ARE HIDDEN INPUT FIELDS. WE CAN TUNNEL
// ENCRYPT THE DATA GOING HERE.
# $oCRNRSTN_USR->addHiddenFormInputParamListener({CRNRSTN_FORM_HANDLE}, {HTML_DOM_FORM_INPUT_NAME}, {HTML_DOM_FORM_INPUT_ID <-notrequired}, {IS_REQUIRED}, {DEFAULT_VALUE <-notrequired});
$oCRNRSTN_USR->addHiddenFormInputParamListener('crnrstn_form_db_demo', 'account_number', 'account_number', true, '1234567890');
$oCRNRSTN_USR->addHiddenFormInputParamListener('crnrstn_form_db_demo', 'account_balance', 'account_balance', false, '100000.01');
$oCRNRSTN_USR->addHiddenFormInputParamListener('crnrstn_form_db_demo', 'personal_preference', 'personal_preference', true, 'pink panties');

$oCRNRSTN_USR->addHiddenFormInputParamListener('crnrstn_form_db_demo_GET', 'account_number', 'account_number', true, '1234567890');
$oCRNRSTN_USR->addHiddenFormInputParamListener('crnrstn_form_db_demo_GET', 'account_balance', 'account_balance', false, '100000.01');
$oCRNRSTN_USR->addHiddenFormInputParamListener('crnrstn_form_db_demo_GET', 'personal_preference', 'personal_preference', true, 'pink panties');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRNRSTN Suite :: MySQL/Form Integration</title>
    <?php
    include_once($oCRNRSTN_USR->get_resource("DOCUMENT_ROOT").$oCRNRSTN_USR->get_resource("DOCUMENT_ROOT_DIR").'/common/inc/head/head.inc.php');
    ?>
</head>

<body>
<div style="padding:20px;">

    <div class="body_content_title">C<span class="the_R">R</span>NRSTN Suite :: Form Integration Test #1 [$_POST] <span class="content_results_subtitle">&nbsp;&nbsp;<a href="<?php echo $tmp_http_root; ?>newfeatures/mysql_database/crnrstn_form_demo.php" target="_self">home</a></span><span class="content_results_subtitle">&nbsp;&nbsp;<a href="<?php echo $tmp_http_root; ?>crnrstn_config_debug.php" target="_self">clear session</a></span></div>
    <form action="#" method="post" name="crnrstn_db_demo" id="crnrstn_db_demo" enctype="multipart/form-data">

        <div class="crnrstn_example_title">username</div>
        <label><input type="text" name="username" value="soundboy420"></label>
        <div><?php echo $oCRNRSTN_USR->outputValidationErrMsg('crnrstn_form_db_demo','username', 'Username is a required field.'); ?></div>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">firstname</div>
        <label><input type="text" name="firstname" value="<?php echo $oCRNRSTN_USR->formPrepopulateInputValue('crnrstn_form_db_demo','firstname', false, 'enter first name'); ?>"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">lastname</div>
        <label><input type="text" name="lastname" value="<?php echo $oCRNRSTN_USR->formPrepopulateInputValue('crnrstn_form_db_demo','lastname',true, 'enter last name'); ?>"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">mobilenumber</div>
        <label><input type="text" name="mobilenumber" value="<?php echo $oCRNRSTN_USR->formPrepopulateInputValue('crnrstn_form_db_demo','mobilenumber'); ?>"></label>
        <div><?php echo $oCRNRSTN_USR->outputValidationErrMsg('crnrstn_form_db_demo','mobilenumber', 'Mobile number is a required field.'); ?></div>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">email</div>
        <label><input type="text" name="email" value="<?php echo $oCRNRSTN_USR->formPrepopulateInputValue('crnrstn_form_db_demo','email'); ?>"></label>
        <div><?php echo $oCRNRSTN_USR->outputValidationErrMsg('crnrstn_form_db_demo','email', 'Email is a required field.'); ?></div>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">zipcode</div>
        <label><input type="text" name="zipcode" value="<?php echo $oCRNRSTN_USR->formPrepopulateInputValue('crnrstn_form_db_demo','zipcode'); ?>"></label>
        <div><?php echo $oCRNRSTN_USR->outputValidationErrMsg('crnrstn_form_db_demo','zipcode', 'Zipcode is a required field.'); ?></div>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">SESSION ID (FOR DELETE)</div>
        <label><input type="text" name="php_sessionid" value=""></label>
        <div class="cb_20"></div>

        <button type="submit">SUBMIT</button>

        <?php
        echo $oCRNRSTN_USR->injectInputSerialization('crnrstn_form_db_demo');
        ?>

    </form>

    <div style="width:100%; height:35px;">&nbsp;</div>

    <div class="body_content_title">C<span class="the_R">R</span>NRSTN Suite :: Form Integration Test #2 [$_GET] <span class="content_results_subtitle">&nbsp;&nbsp;<a href="<?php echo $tmp_http_root; ?>newfeatures/mysql_database/crnrstn_form_demo.php" target="_self">home</a></span><span class="content_results_subtitle">&nbsp;&nbsp;<a href="<?php echo $tmp_http_root; ?>crnrstn_config_debug.php" target="_self">clear session</a></span></div>
    <form action="#" method="get" name="crnrstn_db_demo" id="crnrstn_db_demo" enctype="multipart/form-data">

        <div class="crnrstn_example_title">animalType</div>
        <label><input type="text" name="animal_type" value="Wolf"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">mineralType</div>
        <label><input type="text" name="mineral_type" value="Jasper"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">plantType</div>
        <label><input type="text" name="plant_type" value="Cannabis"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">automobileType</div>
            <label><input type="text" name="automobile_type" value="Porsche 911 Turbo S"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">aircraftType</div>
        <label><input type="text" name="aircraft_type" value="A-10 Warthog Thunderbolt"></label>
        <div class="cb_5"></div>

        <div class="crnrstn_example_title">SESSION ID (FOR DELETE)</div>
        <label><input type="text" name="php_sessionid" value=""></label>
        <div class="cb_20"></div>
        <button type="submit">SUBMIT</button>
        <?php
        echo $oCRNRSTN_USR->injectInputSerialization('crnrstn_form_db_demo_GET');
        ?>

    </form>

    <div class="cb_10"></div>
    <?php
    if(isset($test)){

        echo '<div class="crnrstn_code_output_wrapper">
        <div class="crnrstn_code_output_copy">'.$test.$test_append.'</div></div>';

    }

    ?>

</div>

</body>
</html>