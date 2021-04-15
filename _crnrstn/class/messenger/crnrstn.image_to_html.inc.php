<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
# 
#  CLASS :: crnrstn_image_v_html_content_manager
#  VERSION :: 1.00.0000
#  DATE :: October 3, 2020 @ 1211hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Soo much HTML. Just wanted to put in some place nice.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
#
class crnrstn_image_v_html_content_manager {

    protected $oLogger;
    private static $oCRNRSTN_n;

    public $sys_asset_mode;
    private static $method_request_mode;
    private static $image_output_mode;

    public function __construct($oCRNRSTN_n){

        self::$oCRNRSTN_n = $oCRNRSTN_n;

        if(self::$oCRNRSTN_n->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_ASSET_MODE_HTTPS)){

            //self::$image_output_mode = '';
            $this->sys_asset_mode = CRNRSTN_UI_IMG_URI_HTML_WRAPPED;
            //error_log(__LINE__.' img sys_asset_mode=HTTPS'.CRNRSTN_UI_IMG_URI_HTML_WRAPPED.']');

        }else{

            if(self::$oCRNRSTN_n->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_ASSET_MODE_HTTP)){

                $this->sys_asset_mode = CRNRSTN_UI_IMG_URI_HTML_WRAPPED;
                //error_log(__LINE__.' img sys_asset_mode=HTTP['.CRNRSTN_UI_IMG_URI_HTML_WRAPPED.']');

            }else{

                //
                // BASE64
                $this->sys_asset_mode = CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED;
                //error_log(__LINE__.' img sys_asset_mode=BASE64['.CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED.']');

            }

        }

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_n->log_silo_profile, self::$oCRNRSTN_n);

        //$tmp_file_path = __FILE__;

        //$tmp_path_ARRAY = explode(DIRECTORY_SEPARATOR, $tmp_file_path);
        //$tmp_sect_cnt = sizeof($tmp_path_ARRAY);

    }

    public function return_creative($creative_element_key, $image_output_mode = NULL, $creative_mode=NULL){

        if(!isset($image_output_mode)){

            self::$image_output_mode = $this->sys_asset_mode;

        }else{

            if($image_output_mode == CRNRSTN_UI_IMG_BASE64 && $this->sys_asset_mode == CRNRSTN_UI_IMG_URI_HTML_WRAPPED){

                self::$image_output_mode = CRNRSTN_UI_IMG_BASE64;

            }else{

                if($image_output_mode == CRNRSTN_UI_IMG_URI && $this->sys_asset_mode == CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED){

                    self::$image_output_mode = CRNRSTN_UI_IMG_URI;

                }else{

                    self::$image_output_mode = $image_output_mode;

                }

            }

        }

        //
        // USE THIS TO SUPPORT WHITE LABELING
        if(isset($creative_mode)){

            $tmp_sys_notices_creative_mode = $creative_mode;

        }else{

            $tmp_sys_notices_creative_mode = self::$oCRNRSTN_n->sys_notices_creative_mode;

        }

        //error_log(__LINE__.' img $tmp_sys_notices_creative_mode=['.$tmp_sys_notices_creative_mode.'] self::$image_output_mode=['.self::$image_output_mode.']');


        //
        // ALL_IMAGE, ALL_HTML, ALL_IMAGE_LOGO_OFF, ALL_HTML_LOGO_OFF
        switch($tmp_sys_notices_creative_mode){
            case 'ALL_IMAGE':

                //error_log(__LINE__.' image_output_mode='.$image_output_mode.' ,creative_element_key='.$creative_element_key);

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                break;
                    case 'J5_WOLF_PUP_RAND':

                        return $this->J5_WOLF_PUP_RAND();

                break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO_EMAIL();

                break;
                    case 'CRNRSTN_R':

                        return $this->R();

                break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                break;
                    case 'ERR_X':

                        return $this->ERR_X();

                break;
                    case 'CRNRSTN_FAVICON':

                        return $this->FAVICON();

                break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                break;
                    case 'BG_ELEMENT_RESPONSE_CODE':

                        return $this->BG_SHADOW_RESPONSE_CODE();

                break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                break;
                    case 'J5_WOLF_PUP_LAY_00':

                        return $this->J5_WOLF_PUP_LAY_00();

                break;
                    case 'J5_WOLF_PUP_LAY_01':

                        return $this->J5_WOLF_PUP_LAY_01();

                break;
                    case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                        return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED();

                break;
                    case 'J5_WOLF_PUP_LIL_5_PTS':

                        return $this->J5_WOLF_PUP_LIL_5_PTS();

                break;
                    case 'J5_WOLF_PUP_SIT':

                        return $this->J5_WOLF_PUP_SIT();

                break;
                    case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                        return $this->J5_WOLF_PUP_SIT_EYES_CLOSED();

                break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT();

                break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW();

                break;
                    case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                        return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP();

                break;
                    case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                        return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT();

                break;
                    case 'J5_WOLF_PUP_STAND_LOOK_UP':

                        return $this->J5_WOLF_PUP_STAND_LOOK_UP();

                break;
                    case 'J5_WOLF_PUP_WALK':

                        return $this->J5_WOLF_PUP_WALK();

                break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP();

                break;

                }

            break;
            case 'ALL_HTML':

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP();

                break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO_EMAIL();

                break;
                    case 'CRNRSTN_R':

                        return $this->R();

                break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                break;
                    case 'ERR_X':

                        return $this->ERR_X();

                break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                break;
                    case 'WOLF_PUP_LIL_FIVE_POINTS':

                        return $this->WOLF_PUP_LIL_FIVE_POINTS();

                break;

                }

            break;
            case 'ALL_IMAGE_LOGO_OFF':

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP();

                break;
                    case 'CRNRSTN_LOGO':

                        return '&nbsp;';

                break;
                    case 'CRNRSTN_R':

                        return $this->R();

                break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                break;
                    case 'ERR_X':

                        return $this->ERR_X();

                break;
                    case 'CRNRSTN_FAVICON':

                        return $this->FAVICON();

                break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                break;
                    case 'BG_ELEMENT_RESPONSE_CODE':

                        return $this->BG_SHADOW_RESPONSE_CODE();

                break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                break;
                    case 'WOLF_PUP_LIL_FIVE_POINTS':

                        return $this->WOLF_PUP_LIL_FIVE_POINTS();

                break;


                }

            break;
            case 'ALL_HTML_LOGO_OFF':

                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP();

                break;
                    case 'CRNRSTN_LOGO':

                        return '&nbsp;';

                break;
                    case 'CRNRSTN_R':

                        return $this->R();

                break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                break;
                    case 'ERR_X':

                        return $this->ERR_X();

                break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                break;
                    case 'WOLF_PUP_LIL_FIVE_POINTS':

                        return $this->WOLF_PUP_LIL_FIVE_POINTS();

                break;


                }

            break;
            case 'SOAP_TRANSPORT':

                return '{'.$creative_element_key.'::SOAP_TRANSPORT}';

            break;
            default:

                //
                // ALL_HTML
                switch($creative_element_key){
                    case '5':

                        return $this->FIVE();

                break;
                    case 'J5_WOLF_PUP':

                        return $this->J5_WOLF_PUP();

                break;
                    case 'CRNRSTN_LOGO':

                        return $this->CRNRSTN_LOGO_EMAIL();

                break;
                    case 'CRNRSTN_R':

                        return $this->R();

                break;
                    case 'CRNRSTN_R_WALL':

                        return $this->R_PLUS_WALL();

                break;
                    case 'SUCCESS_CHECK':

                        return $this->SUCCESS_CHECK();

                break;
                    case 'ERR_X':

                        return $this->ERR_X();

                break;
                    case 'CRNRSTN_FAVICON':

                        //return $this->FAVICON();
                        return '';

                break;
                    case 'LINUX_PENGUIN':

                        return $this->LINUX_PENGUIN();

                break;
                    case 'MYSQL_DOLPHIN':

                        return $this->MYSQL_DOLPHIN();

                break;
                    case 'REDHAT_BAR':

                        return $this->REDHAT_BAR();

                break;
                    case 'REDHAT_CIRCLE':

                        return $this->REDHAT_CIRCLE();

                break;
                    case 'APACHE_POWER_VERS':

                        return $this->APACHE_POWER_VERSION();

                break;
                    case 'APACHE_POWER':

                        return $this->APACHE_POWER();

                break;
                    case 'REDHAT_POWER':

                        return $this->REDHAT_POWER();

                break;
                    case 'PHP_ELLIPSE':

                        return $this->PHP_ELLIPSE();

                break;
                    case 'POW_BY_PHP':

                        return $this->POW_BY_PHP();

                break;
                    case 'BG_ELEMENT_LOGO_SIGNIN':

                        return $this->BG_ELEMENT_LOGO_SIGNIN();

                break;
                    case 'BG_ELEMENT_REFLECTION_SIGNING':

                        return $this->BG_ELEMENT_REFLECTION_SIGNIN();

                break;
                    case 'ZEND_LOGO':

                        return $this->ZEND_LOGO();

                break;
                    case 'ZEND_FRAMEWORK_3':

                        return $this->ZEND_FRAMEWORK_3();

                break;
                    case 'ZEND_FRAMEWORK':

                        return $this->ZEND_FRAMEWORK();

                break;
                    case 'DOT_GREEN':

                        return $this->DOT_GREEN();

                break;
                    case 'DOT_RED':

                        return $this->DOT_RED();

                break;
                    case 'DOT_OFF':

                        return $this->DOT_OFF();

                break;
                    case 'NOTICE_TRI_ALERT':

                        return $this->NOTICE_TRI_ALERT();

                break;
                    case 'ICON_EMAIL_INBOX_REFLECT':

                        return $this->ICON_EMAIL_INBOX_REFLECT();

                break;
                    case 'SEARCH_MAGNIFY_GLASS':

                        return $this->SEARCH_MAGNIFY_GLASS();

                break;
                    case 'WOLF_PUP_LIL_FIVE_POINTS':

                        return $this->WOLF_PUP_LIL_FIVE_POINTS();

                break;


                }

            break;

        }

        return '';

    }

    private function FAVICON(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:
            case CRNRSTN_UI_IMG_URI_HTML_WRAPPED:

                return '<link rel="shortcut icon" type="image/x-icon" href="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/favicon.ico?v=420.00" />';

            break;
            default:
                //
                // BASE64
                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/favicon.ico';

            break;

        }

    }

    private function FIVE(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/5.php');

                return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;"><a href="http://jony5.com/projects/crnrstn/philosophy/" target="_blank"><img src="'.$tmp_str.'" width="18" height="17" alt="5" title="5" style="border: 0;"></a></div>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/5.php');

                //
                // BASE64
                return $tmp_str;

            break;
            default:
                //case CRNRSTN_UI_IMG_URI_HTML_WRAPPED:

                return '<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight: normal;"><a href="http://jony5.com/projects/crnrstn/philosophy/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/5.png" width="18" height="17" alt="5" title="5" style="border: 0;"></a></div>';

            break;

        }

    }

    private function SUCCESS_CHECK(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/success_chk.php');

                return '<img src="'.$tmp_str.'" width="19" height="19" alt="success" title="success">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/success_chk.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/success_chk.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/success_chk.png" width="19" height="19" alt="success" title="success" style="border: 0;" >';

            break;

        }

    }

    private function ERR_X(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/err_x.php');

                return '<img src="'.$tmp_str.'" width="19" height="19" alt="X" title="error">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/err_x.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/err_x.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/err_x.png" width="19" height="19" alt="X" title="error" style="border: 0;" >';

            break;

        }

    }

    private function CRNRSTN_LOGO_EMAIL(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_logo_md.php');

                return '<img src="'.$tmp_str.'" width="165" height="100" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_logo_md.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_logo_md.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_logo_md.png" width="165" height="100" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;" >';

            break;

        }

    }

    private function R(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_R_md.php');

                return '<img src="'.$tmp_str.'" width="26" height="35" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_R_md.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_R_md.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_R_md.png" width="26" height="35" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;" >';

            break;

        }

    }

    private function R_PLUS_WALL(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_R_md_plus_wall.php');

                return '<img src="'.$tmp_str.'" width="66" height="35" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_R_md_plus_wall.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_R_md_plus_wall.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_R_md_plus_wall.png" width="66" height="35" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;" >';

            break;

        }

    }

    private function BG_SHADOW_RESPONSE_CODE(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/elem_shadow_btm.php');

                return '<img src="'.$tmp_str.'" width="1" height="5" alt="|" title="|" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/elem_shadow_btm.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/elem_shadow_btm.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/elem_shadow_btm.png" width="1" height="5" alt="" title="" style="border: 0;" >';

            break;

        }

    }

    private function PHP_ELLIPSE(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/php_logo.php');

                return '<a href="https://www.php.net/" target="_blank"><img src="'.$tmp_str.'" width="65" height="35" alt="php v'.self::$oCRNRSTN_n->version_php.'" title="CRNRSTN :: php v'.self::$oCRNRSTN_n->version_php.'" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/php_logo.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/php_logo.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.php.net/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/php_logo.png" width="65" height="35" alt="php v'.self::$oCRNRSTN_n->version_php.'" title="CRNRSTN :: php v'.self::$oCRNRSTN_n->version_php.'" style="border: 0;"></a>';

            break;

        }

    }

    private function POW_BY_PHP(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_php.php');

                return '<a href="https://www.php.net/" target="_blank"><img src="'.$tmp_str.'" width="100" height="35" alt="php v'.self::$oCRNRSTN_n->version_php.'" title="CRNRSTN :: php v'.self::$oCRNRSTN_n->version_php.'" style="border:0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_php.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_php.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.php.net/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_php.png" width="100" height="35" alt="php v'.self::$oCRNRSTN_n->version_php.'" title="CRNRSTN :: php v'.self::$oCRNRSTN_n->version_php.'" style="border: 0;"></a>';

            break;

        }

    }

    private function ZEND_LOGO(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/zend_logo.php');

                return '<a href="https://www.zend.com/" target="_blank"><img src="'.$tmp_str.'" width="73" height="35" alt="ZEND" title="CRNRSTN :: ZEND" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/zend_logo.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/zend_logo.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.zend.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/zend_logo.png" width="73" height="35" alt="ZEND" title="CRNRSTN :: ZEND" style="border: 0;"></a>';

            break;

        }

    }

    private function ZEND_FRAMEWORK(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/zend_framework.php');

                return '<a href="https://www.zend.com/" target="_blank"><img src="'.$tmp_str.'" width="212" height="35" alt="ZEND FRAMEWORK" title="CRNRSTN :: ZEND FRAMEWORK"  style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/zend_framework.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/zend_framework.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.zend.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/zend_framework.png" width="212" height="35" alt="ZEND FRAMEWORK" title="CRNRSTN :: ZEND FRAMEWORK" style="border: 0;"></a>';

            break;

        }

    }

    private function ZEND_FRAMEWORK_3(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/zend_framework_3.php');

                return '<a href="https://www.zend.com/" target="_blank"><img src="'.$tmp_str.'" width="224" height="35" alt="ZEND FRAMEWORK 3" title="CRNRSTN :: ZEND FRAMEWORK 3" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/zend_framework_3.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/zend_framework_3.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.zend.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/zend_framework_3.png" width="224" height="35" alt="ZEND FRAMEWORK 3" title="CRNRSTN :: ZEND FRAMEWORK 3" style="border: 0;" ></a>';

            break;

        }

    }

    private function LINUX_PENGUIN(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/linux_penguin_sm.php');

                return '<a href="https://www.linux.com/" target="_blank"><img src="'.$tmp_str.'" width="30" height="35" alt="Linux :: Tux the Penguin" title="CRNRSTN :: Linux" style="border: 0;"></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/linux_penguin_sm.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/linux_penguin_sm.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                //_crnrstn/creative/_encoded/.png
                return '<a href="https://www.linux.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/linux_penguin_sm.png" width="30" height="35" alt="Linux :: Tux the Penguin" title="CRNRSTN :: Linux" style="border: 0;"></a>';

            break;

        }

    }

    private function MYSQL_DOLPHIN(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/mysql_logo.php');

                return '<a href="https://www.mysql.com/" target="_blank"><img src="'.$tmp_str.'" width="66" height="35" alt="MySQLi v'.self::$oCRNRSTN_n->version_mysqli.'" title="CRNRSTN :: MySQLi v'.self::$oCRNRSTN_n->version_mysqli.'" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/mysql_logo.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/mysql_logo.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.mysql.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/mysql_logo.png" width="66" height="35" alt="MySQLi v'.self::$oCRNRSTN_n->version_mysqli.'" title="CRNRSTN :: MySQLi v'.self::$oCRNRSTN_n->version_mysqli.'" style="border: 0;"></a>';

            break;

        }

    }

    private function REDHAT_POWER(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_redhat.php');

                return '<a href="https://www.redhat.com/" target="_blank"><img src="'.$tmp_str.'" width="103" height="35" alt="Powered by Red Hat" title="CRNRSTN :: Powered by Red Hat Linux" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_redhat.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_redhat.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.redhat.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_redhat.png" width="103" height="35" alt="Powered by Red Hat" title="CRNRSTN :: Powered by Red Hat Linux" style="border: 0;"></a>';

            break;

        }

    }

    private function REDHAT_BAR(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/redhat_bar.php');

                return '<a href="https://www.redhat.com/" target="_blank"><img src="'.$tmp_str.'" width="106" height="35" alt="Red Hat" title="CRNRSTN :: Red Hat Linux" style="border: 0;"></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/redhat_bar.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/redhat_bar.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.redhat.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/redhat_bar.png" width="106" height="35" alt="Red Hat" title="CRNRSTN :: Red Hat Linux" style="border: 0;"></a>';

            break;

        }

    }

    private function REDHAT_CIRCLE(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/redhat_circle.php');

                return '<a href="https://www.redhat.com/" target="_blank"><img src="'.$tmp_str.'" width="40" height="35" alt="Red Hat" title="CRNRSTN :: Red Hat Linux" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/redhat_circle.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/redhat_circle.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="https://www.redhat.com/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/redhat_circle.png" width="40" height="35" alt="Red Hat" title="CRNRSTN :: Red Hat Linux" style="border: 0;"></a>';

            break;

        }

    }

    private function APACHE_POWER_VERSION(){

        $version = self::$oCRNRSTN_n->version_apache_sysimg;

        switch($version){
            case 2.4:

                return $this->APACHE_POWER_2_4();

            break;
            case 2.2:

                return $this->APACHE_POWER_2_2();

            break;
            case 2.0:

                return $this->APACHE_POWER_2_0();

            break;
            case 1.3:

                return $this->APACHE_POWER_1_3();

            break;
            default:

                return $this->APACHE_POWER();

            break;

        }

    }

    private function APACHE_POWER_2_4(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_2_4.php');

                return '<a href="http://apache.org/" target="_blank"><img src="'.$tmp_str.'" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_2_4.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_2_4.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="http://apache.org/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_2_4.png" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;"></a>';

            break;

        }

    }

    private function APACHE_POWER_2_2(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_2_2.php');

                return '<a href="http://apache.org/" target="_blank"><img src="'.$tmp_str.'" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_2_2.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_2_2.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="http://apache.org/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_2_2.png" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;"></a>';

            break;

        }

    }

    private function APACHE_POWER_2_0(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_2.php');

                return '<a href="http://apache.org/" target="_blank"><img src="'.$tmp_str.'" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_2.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_2.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="http://apache.org/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_2.png" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;"></a>';

            break;

        }

    }

    private function APACHE_POWER_1_3(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_1_3.php');

                return '<a href="http://apache.org/" target="_blank"><img src="'.$tmp_str.'" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache_1_3.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_1_3.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="http://apache.org/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache_1_3.png" width="259" height="32" alt="Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" title="CRNRSTN :: Powered by APACHE v'.self::$oCRNRSTN_n->version_apache.'" style="border: 0;"></a>';

            break;

        }

    }

    private function APACHE_POWER(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache.php');

                return '<a href="http://apache.org/" target="_blank"><img src="'.$tmp_str.'" width="259" height="32" alt="Powered by APACHE" title="CRNRSTN :: Powered by APACHE" style="border: 0;" /></a>';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/powered_by_apache.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<a href="http://apache.org/" target="_blank"><img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/powered_by_apache.png" width="259" height="32" alt="Powered by APACHE" title="CRNRSTN :: Powered by APACHE" style="border: 0;"></a>';

            break;

        }

    }

    private function BG_ELEMENT_LOGO_SIGNIN(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_logo_lg.php');

                return '<img src="'.$tmp_str.'" width="345" height="208" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;" >';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/crnrstn_logo_lg.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_logo_lg.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/crnrstn_logo_lg.png" width="345" height="208" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;" >';

            break;

        }

    }

    private function BG_ELEMENT_REFLECTION_SIGNIN(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/signin_frm_reflection.php');

                return '<img src="'.$tmp_str.'" width="259" height="32" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/signin_frm_reflection.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/signin_frm_reflection.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/signin_frm_reflection.png" width="722" height="55" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;">';

            break;

        }

    }

    private function DOT_GREEN(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/dot_grn.php');

                return '<img src="'.$tmp_str.'" width="20" height="20" alt="O" title="O" style="border: 0;" >';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/dot_grn.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/dot_grn.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/dot_grn.png" width="20" height="20" alt="O" title="O" style="border: 0;">';

            break;

        }

    }

    private function DOT_RED(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/dot_red.php');

                return '<img src="'.$tmp_str.'" width="20" height="20" alt="O" title="O" style="border: 0;" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/dot_red.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/dot_red.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/dot_red.png" width="20" height="20" alt="O" title="O" style="border: 0;">';

            break;

        }

    }

    private function DOT_OFF(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/dot_grey.php');

                return '<img src="'.$tmp_str.'" width="20" height="20" alt="O" title="O" style="border: 0;" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/dot_grey.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/dot_grey.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/dot_grey.png" width="20" height="20" alt="O" title="O" style="border: 0;">';

            break;

        }

    }

    private function NOTICE_TRI_ALERT(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/triangle_alert.php');

                return '<img src="'.$tmp_str.'" width="19" height="19" alt="!" title="alert">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/triangle_alert.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/triangle_alert.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/triangle_alert.png" width="19" height="19" alt="!" title="alert" style="border: 0;">';

            break;

        }

    }

    private function SEARCH_MAGNIFY_GLASS(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/mag_glass_search.php');

                return '<img src="'.$tmp_str.'" width="14" height="14" alt="Search" title="Search" style="border: 0;" >';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/mag_glass_search.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/mag_glass_search.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/mag_glass_search.png" width="14" height="14" alt="Search" title="Search" style="border: 0;" >';

            break;

        }

    }

    private function ICON_EMAIL_INBOX_REFLECT(){

        //error_log(__LINE__.' img ICON_EMAIL_INBOX_REFLECT='.self::$image_output_mode);

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/email_inbox_icon.php');

                return '<img src="'.$tmp_str.'" width="201" height="185" alt="CRNRSTN :: EMAIL" title="CRNRSTN :: EMAIL">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/email_inbox_icon.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/email_inbox_icon.png';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/email_inbox_icon.png" width="201" height="185" alt="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" title="CRNRSTN :: v'.self::$oCRNRSTN_n->version_crnrstn.'" style="border: 0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_RAND(){

        $tmp_array = array('J5_WOLF_PUP_LAY_00', 'J5_WOLF_PUP_LAY_01', 'J5_WOLF_PUP_LEASH_EYES_CLOSED',
            'J5_WOLF_PUP_LIL_5_PTS', 'J5_WOLF_PUP_SIT', 'J5_WOLF_PUP_SIT_EYES_CLOSED',
            'J5_WOLF_PUP_SIT_LOOK_RIGHT', 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW', 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP',
            'J5_WOLF_PUP_STAND_LOOK_RIGHT', 'J5_WOLF_PUP_STAND_LOOK_UP', 'J5_WOLF_PUP_WALK', 'J5_WOLF_PUP');
        $tmp_cnt = count($tmp_array);

        $tmp_int = rand(0, $tmp_cnt-1);

        switch($tmp_array[$tmp_int]){
            case 'J5_WOLF_PUP_LAY_00':

                return $this->J5_WOLF_PUP_LAY_00();

            break;
            case 'J5_WOLF_PUP_LAY_01':

                return $this->J5_WOLF_PUP_LAY_01();

            break;
            case 'J5_WOLF_PUP_LEASH_EYES_CLOSED':

                return $this->J5_WOLF_PUP_LEASH_EYES_CLOSED();

            break;
            case 'J5_WOLF_PUP_LIL_5_PTS':

                return $this->J5_WOLF_PUP_LIL_5_PTS();

            break;
            case 'J5_WOLF_PUP_SIT':

                return $this->J5_WOLF_PUP_SIT();

            break;
            case 'J5_WOLF_PUP_SIT_EYES_CLOSED':

                return $this->J5_WOLF_PUP_SIT_EYES_CLOSED();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW();

            break;
            case 'J5_WOLF_PUP_SIT_LOOK_RIGHT_UP':

                return $this->J5_WOLF_PUP_SIT_LOOK_RIGHT_UP();

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_RIGHT':

                return $this->J5_WOLF_PUP_STAND_LOOK_RIGHT();

            break;
            case 'J5_WOLF_PUP_STAND_LOOK_UP':

                return $this->J5_WOLF_PUP_STAND_LOOK_UP();

            break;
            case 'J5_WOLF_PUP_WALK':

                return $this->J5_WOLF_PUP_WALK();

            break;
            default:
                //J5_WOLF_PUP

                return $this->J5_WOLF_PUP();

            break;

        }

    }

    private function J5_WOLF_PUP_LAY_00(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_lay_00';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="480" height="378" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="480" height="378" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_LAY_01(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_lay_01';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="431" height="400" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="431" height="400" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_LEASH_EYES_CLOSED(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_leash_eyes_closed';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="478" height="390" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="478" height="390" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_LIL_5_PTS(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_lil_5_pts';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="300" height="340" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="300" height="340" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP(){

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/j5_wolf_pup_right_align.php');

                return '<img src="'.$tmp_str.'" width="293" height="300" alt="J5 wolf pup" title="J5 wolf pup" />';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/j5_wolf_pup_right_align.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/j5_wolf_pup_right_align.png';

            break;
            default:

                // CRNRSTN_UI_IMG_URI_HTML_WRAPPED

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/j5_wolf_pup_right_align.png" width="293" height="300" alt="J5 wolf pup" title="J5 wolf pup" style="border: 0;" >';

            break;

        }

    }

    private function J5_WOLF_PUP_SIT(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_sit';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="340" height="342" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="340" height="342" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_SIT_EYES_CLOSED(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_sit_eyes_closed';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="352" height="411" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="352" height="411" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_sit_look_right';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="261" height="416" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="261" height="416" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_SHADOW(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_sit_look_right_shadow';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="553" height="300" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="553" height="300" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_SIT_LOOK_RIGHT_UP(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_sit_look_right_up';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="248" height="414" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="248" height="414" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_STAND_LOOK_RIGHT(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_stand_look_right';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="300" height="390" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="340" height="390" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_STAND_LOOK_UP(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_stand_look_up';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'" width="315" height="360" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="315" height="360" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    private function J5_WOLF_PUP_WALK(){

        //
        // NO EXTENSION
        $tmp_filename = 'j5_wolf_pup_walk';

        switch(self::$image_output_mode){
            case CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                return '<img src="'.$tmp_str.'"  width="340" height="342" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_str = '';
                require(CRNRSTN_ROOT . '/_crnrstn/ui/imgs/base64/'.$tmp_filename.'.php');

                //
                // BASE64
                return $tmp_str;

            break;
            case CRNRSTN_UI_IMG_URI:

                return self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.php';

            break;
            default:

                // HTML_DOM_WRAPPED_URI

                //
                // HTTP/S PATH TO IMAGE - PUBLIC IP...OF COURSE.
                return '<img src="'.self::$oCRNRSTN_n->sys_notice_creative_http_path . 'imgs/png/'.$tmp_filename.'.png" width="340" height="342" alt="J5 Wolf Pup" title="J5 Wolf Pup" style="border:0;">';

            break;

        }

    }

    public function __destruct() {

    }

}