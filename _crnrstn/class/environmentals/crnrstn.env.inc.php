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
#  CLASS :: crnrstn_environment
#  VERSION :: 2.00.0000
#  DATE :: September 11, 2012 @ 1720hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: The first one to know who you are. Hello, there.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_environment {

	public $configSerial;
	
	protected $oLogger;

	private static $oLog_ProfileManager;

    private static $lang_content_ARRAY = array();
    private static $sys_logging_profile_ARRAY = array();
    private static $sys_logging_meta_ARRAY = array();

    private static $sys_logging_endpoint_ARRAY = array();

    private static $sys_logging_wcr_ARRAY = array();
    private static $sys_logging_update_profile_ARRAY = array();
    private static $sys_logging_update_endpoint_ARRAY = array();

    private static $resourceKey;

    protected $oCRNRSTN_USR;
    protected $oCRNRSTN_DEV_INPUT_CONTROLLER;
    public $oCRNRSTN_BITFLIP_MGR;
	public $oCRNRSTN_IPSECURITY_MGR;
	public $oSESSION_MGR;
	public $oCOOKIE_MGR;
	public $oMYSQLI_CONN_MGR;
	public $oHTTP_MGR;
	public $oFINITE_EXPRESS;            # SHOULD HAVE ISOCODE CONSIDERATIONS. MAKING FOR INTEGRATION WITH EVIFWEB EXTRANET LANG ENGINE.
    private static $oCommRichMediaProvider;

	private static $sess_env_param_ARRAY = array();
	private static $m_starttime = array();
	private static $encryptableDataTypes = array();
	public $logging_profile_constants = array();
	private static $creativeElementsKeys = array();
    public $soap_permissions_file_path_ARRAY = array();
	
	private static $requestProtocol;
	
	public $CRNRSTN_debugMode;
	public $PHPMAILER_debugMode;
    public $log_silo_profile;
	public $starttime;
	public $oLog_output_ARRAY = array();
	public $oWildCardResource_ARRAY = array();
    public $wildCardResource_filePath = array();
    public $handle_env_cleartext_ARRAY = array();
	public $env_cleartext_name;
    public $sys_notices_creative_mode = 'ALL_HTML';
    public $sys_notice_creative_http_path;
    public $colorScheme;

    public $crnrstn_as_error_handler_ARRAY = array();
    public $crnrstn_as_error_handler_constants_ARRAY = array();
    protected $oSOAP_services_access_manager = array();
    protected $oSOAP_services_oClient_manager = array();
    protected $oSOAP_services_oAuth_manager = array();

    protected $oAdminAccount_ARRAY = array();

    public $cache_ttl_default = 80;
    public $useCURL_default = true;
    public $operating_system;
    public $process_id;
    public $version_crnrstn;
    public $version_apache;
    public $version_apache_sysimg;
    public $version_php;
    public $version_mysqli;
    private static $process_id_perf_stat_ARRAY = array();

    public function __construct($oCRNRSTN, $instanceType=NULL) {
		
		$this->starttime = $oCRNRSTN->getStartTime();
		$this->sys_notices_creative_mode = $oCRNRSTN->sys_notices_creative_mode;
		$this->sys_notice_creative_http_path = $oCRNRSTN->sys_notice_creative_http_path;
        $this->version_crnrstn = $oCRNRSTN->version_crnrstn;
        $this->version_apache = $oCRNRSTN->version_apache;
        $this->version_apache_sysimg = $oCRNRSTN->version_apache_sysimg;
        $this->version_php = $oCRNRSTN->version_php;
        $this->oCRNRSTN_BITFLIP_MGR = $oCRNRSTN->oCRNRSTN_BITFLIP_MGR;
        $this->operating_system = $oCRNRSTN->operating_system;
        $this->process_id = $oCRNRSTN->process_id;

		//
		// INITIALIZE ARRAY OF ENCRYPTABLE DATATYPES
		self::$encryptableDataTypes = array('string','integer','double','float','int');
        //self::$logging_profile_constants = array(CRNRSTN_LOG_EMAIL, CRNRSTN_LOG_EMAIL_PROXY, CRNRSTN_LOG_FILE, CRNRSTN_LOG_FILE_FTP, CRNRSTN_LOG_SCREEN_TEXT, CRNRSTN_LOG_SCREEN, CRNRSTN_LOG_SCREEN_HTML, CRNRSTN_LOG_SCREEN_HTML_HIDDEN, CRNRSTN_LOG_DEFAULT, CRNRSTN_LOG_ELECTRUM);
        $this->logging_profile_constants = $oCRNRSTN->logging_profile_constants;

        self::$creativeElementsKeys = $oCRNRSTN->creativeElementsKeys;

        //$this->initialize_language();
        self::$lang_content_ARRAY = $oCRNRSTN->return_lang_content_ARRAY();

		//
        // ROLL OVER ENVIRONMENT NAMES
        $this->handle_env_cleartext_ARRAY = $oCRNRSTN->handle_env_cleartext_ARRAY;

        //
        // ROLL OVER SOAP PERMISSIONS
        $this->soap_permissions_file_path_ARRAY = $oCRNRSTN->soap_permissions_file_path_ARRAY;

		//
		// ROLL OVER DEBUG/ERROR_LOG TRACE FROM CRNRSTN OBJECT AND THEN CONTINUE TO APPEND
        self::$m_starttime = $oCRNRSTN->return_m_start_time();
		$this->CRNRSTN_debugMode = $oCRNRSTN->CRNRSTN_debugMode;
        $this->PHPMAILER_debugMode = $oCRNRSTN->PHPMAILER_debugMode;
        $this->log_silo_profile = $oCRNRSTN->log_silo_profile;
		$this->oLog_output_ARRAY = $oCRNRSTN->oLog_output_ARRAY;

        $this->crnrstn_as_error_handler_ARRAY = $oCRNRSTN->crnrstn_as_error_handler_ARRAY;
        $this->crnrstn_as_error_handler_constants_ARRAY = $oCRNRSTN->crnrstn_as_error_handler_constants_ARRAY;

        //
        // SUPPORT FOR CRNRSTN_->PRINT_R()
        self::$oCommRichMediaProvider = new crnrstn_image_v_html_content_manager($this);

        self::$oLog_ProfileManager = $oCRNRSTN->return_oLog_ProfileManager();
        self::$oLog_ProfileManager->sync_to_environment($oCRNRSTN, $this);

        //
        // CLEAR oCRNRSTN oLOG OUTPUT ARRAY TO FREE MEMORY
        array_splice($oCRNRSTN->oLog_output_ARRAY, 0);

		$this->oLogger = new crnrstn_logging($this->CRNRSTN_debugMode, __CLASS__, $this->log_silo_profile, $this);

		$this->configSerial = $oCRNRSTN->configSerial;
        
		$this->oCOOKIE_MGR = new crnrstn_cookie_manager();
		$this->oHTTP_MGR = new crnrstn_http_manager();
        $this->oFINITE_EXPRESS = new finite_expression();

        if(!($instanceType == 'session_initialization_ping')){
			
			try{

                //
                //	DETERMINE KEY DESIGNATING THE RUNNING ENVIRONMENT, WHERE KEY = CRC32(env key)
                self::$resourceKey = $oCRNRSTN->getServerEnv();

                if(self::$resourceKey == ''){

                    //
                    // WE DON'T HAVE THE ENVIRONMENT DETECTED. THROW EXCEPTION.
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('CRNRSTN :: environmental configuration error :: unable to detect environment on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

                }else{

                    $this->env_cleartext_name = $oCRNRSTN->handle_env_cleartext_ARRAY[crc32($this->configSerial)][self::$resourceKey];

                    //
                    // FLASH WILD CARD RESOURCES OBJECT ARRAY TO ENVIRONMENTAL CLASS OBJECT
                    $this->initializeWildCardResource($oCRNRSTN);

                    $this->oSESSION_MGR = new crnrstn_session_manager($this);

                    $this->oCRNRSTN_IPSECURITY_MGR = clone $oCRNRSTN->oCRNRSTN_IPSECURITY_MGR;
                    unset($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR);

                    //
                    // WE HAVE SELECTED ENVIRONMENT KEY. INITIALIZE. CONFIG KEY AND ENV KEY.
                    // FLASH CONFIG KEY AND ENV KEY TO SESSION.
                    $this->initRuntimeConfig();

                    //
                    // INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
                    $this->initializeErrorReporting($oCRNRSTN);

                    //
                    // INITIALIZE SYSTEM CREATIVE HTTP PATH FOR THIS ENVIRONMENT
                    $this->initializeSystemCreative($oCRNRSTN);

                    //
                    // INITIALIZE ENVIRONMENTAL LOGGING BEHAVIOR
                    $this->initEnvLoggingProfile($oCRNRSTN);

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from grantExclusiveAccess()
                    if(isset($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initExclusiveAccess($oCRNRSTN);
                    }

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from denyAccess()
                    if(isset($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initDenyAccess($oCRNRSTN);
                    }

                    //
                    // INITIALIZE ADMINISTRATOR ACCESS
                    if(isset($oCRNRSTN->add_admin_creds_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initAdminAccess($oCRNRSTN);
                    }

                    //
                    // INITIALIZE DATABASE
                    $this->oMYSQLI_CONN_MGR = clone $oCRNRSTN->oMYSQLI_CONN_MGR;
                    $this->oMYSQLI_CONN_MGR->setEnvironment($this);

                    //
                    // INITIALIZE SESSION ENCRYPTION
                    if(isset($oCRNRSTN->opensslSessEncryptCipher[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initSessionEncryption($oCRNRSTN);
                    }

                    //
                    // INITIALIZE COOKIE ENCRYPTION
                    if(isset($oCRNRSTN->opensslCookieEncryptCipher[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initCookieEncryption($oCRNRSTN);

                    }

                    //
                    // INITIALIZE TUNNEL ENCRYPTION
                    if(isset($oCRNRSTN->opensslTunnelEncryptCipher[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initTunnelEncryption($oCRNRSTN);

                    }

                    //
                    // BEFORE ALLOCATING ADDITIONAL MEMORY RESOURCES, PROCESS IP AUTHENTICATION
                    if(isset($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey]) || isset($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){

                        $this->oLog_output_ARRAY[] = $this->error_log('We have IP restrictions to process and apply for CRNRSTN :: config serial ['.$this->configSerial.'] and environment key ['.self::$resourceKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        if(!$this->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, self::$resourceKey)){

                            //
                            // WE COULD PERHAPS USE A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
                            // THE METHOD returnSrvrRespStatus() CONTAINS SOME CUSTOM HTML FOR OUTPUT IF YOU WANT TO TWEAK ITS DESIGN
                            // PERHAPS SOME FUTURE RELEASE OF CRNRSTN CAN
                            $this->returnSrvrRespStatus(403);
                            exit();

                        }

                    }else{

                        $this->oLog_output_ARRAY[] = $this->error_log('There are NO IP restrictions to process and apply for CRNRSTN :: config serial ['.$this->configSerial.'] and environment key ['.self::$resourceKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    }

                    //
                    // FLASH CRNRSTN :: CONFIG DEFINED ENV RESOURCES FOR THE DETECTED ENV TO SESSION MEMORY
                    $this->initEnvResources($oCRNRSTN);

                    //
                    // INITIALIZE SOAP AUTHORIZATION PROFILES FOR THIS ENVIRONMENT
                    //$this->initSOAPAuthorizationProfiles();

                    //
                    // END OF CRNRSTN :: ENVIRONMENTAL CONFIG OPERATION
                    $this->oLog_output_ARRAY[] = $this->error_log('You have reached the end of the CRNRSTN :: environmental detection and configuration process.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                }

            } catch( Exception $e ) {

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $oCRNRSTN->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                return false;

			}

        }else{
			
			//
			// THIS IS A SIMPLE CONFIG CHECK.
            $this->oLog_output_ARRAY[] = $this->error_log(__METHOD__.' performing simple config check prior to loading of define_env_resource() in the CRNRSTN :: config file.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
			
		}

	}

	//
    // SOURCE :: https://aloneonahill.com/blog/if-php-were-british/
    // AUTHOR :: https://aloneonahill.com/blog/about-dave/
	public function hello_world($is_bastard = true){

        try{

            if($is_bastard){

                $str = 'Hello World.';  // bastard dialect

            }else{

                $str = 'Good morrow, fellow subjects of the Crown.';

            }

            error_log(__LINE__.' '.get_class().' exception! '.$str);
            throw new Exception('CRNRSTN '.$this->version_crnrstn.' :: '.$str.' This is an exception handling test from '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

            if($this->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_SCREEN_TEXT)){

                $str .= '<br><br>'.$this->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->stringout();

            }

            if(file_exists('/proc/'.$this->process_id)){

                //$this->print_r(self::$process_id_perf_stat_ARRAY[0], "PID Testing :: [".$this->operating_system."][running]PID ".$this->process_id, CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }else{

                //$this->print_r(self::$process_id_perf_stat_ARRAY[0], "PID Testing :: [dead]PID ".$this->process_id, CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }

            return $str;

        } catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function ui_content_module_out($integer_constant, $meta_profile_data){

        //
        // MODES OF OUTPUT
        // IMG
        //    - CRNRSTN_ASSET_MODE_PNG
        //    - CRNRSTN_ASSET_MODE_JPEG
        //    - CRNRSTN_ASSET_MODE_BASE64  <CONTENT EMBED MODE>
        //
        if($this->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_ASSET_MODE_PNG)){

            $asset_mode = 'PNG';

            switch($integer_constant){
                case CRNRSTN_UI_JS_JQUERY:
                case CRNRSTN_UI_JS_JQUERY_UI:
                case CRNRSTN_UI_JS_JQUERY_MOBILE:
                case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                    return $this->return_output_CRNRSTN_UI_JS($integer_constant, $meta_profile_data, $asset_mode);

                    break;
                case CRNRSTN_UI_CSS_MAIN:
                case CRNRSTN_UI_CSS_MOBILE:
                case CRNRSTN_UI_CSS_TABLET:
                case CRNRSTN_UI_CSS_DESKTOP:

                    return $this->return_output_CRNRSTN_UI_CSS_MAIN($integer_constant, $meta_profile_data, $asset_mode);

                    break;
                case CRNRSTN_UI_TAG_ANALYTICS:

                    return $this->return_output_CRNRSTN_UI_TAG_ANALYTICS($integer_constant, $meta_profile_data, $asset_mode);

                    break;
                case CRNRSTN_UI_TAG_ENGAGEMENT:

                    return $this->return_output_CRNRSTN_UI_TAG_ENGAGEMENT($integer_constant, $meta_profile_data, $asset_mode);

                    break;
                default:

                    $this->error_log('The requested UI content module...honoring the provided integer constant,  "'.$integer_constant.'", could not be found.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                    return '';

                    break;

            }

        }else{

            if($this->oCRNRSTN_BITFLIP_MGR->oCRNRSTN_BITWISE->read(CRNRSTN_ASSET_MODE_JPEG)){

                $asset_mode = 'JPEG';

                switch($integer_constant){
                    case CRNRSTN_UI_JS_JQUERY:
                    case CRNRSTN_UI_JS_JQUERY_UI:
                    case CRNRSTN_UI_JS_JQUERY_MOBILE:
                    case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                        return $this->return_output_CRNRSTN_UI_JS($integer_constant, $meta_profile_data, $asset_mode);

                    break;
                    case CRNRSTN_UI_CSS_MAIN:
                    case CRNRSTN_UI_CSS_MOBILE:
                    case CRNRSTN_UI_CSS_TABLET:
                    case CRNRSTN_UI_CSS_DESKTOP:

                        return $this->return_output_CRNRSTN_UI_CSS_MAIN($integer_constant, $meta_profile_data, $asset_mode);

                        break;
                    case CRNRSTN_UI_TAG_ANALYTICS:

                        return $this->return_output_CRNRSTN_UI_TAG_ANALYTICS($integer_constant, $meta_profile_data, $asset_mode);

                        break;
                    case CRNRSTN_UI_TAG_ENGAGEMENT:

                        return $this->return_output_CRNRSTN_UI_TAG_ENGAGEMENT($integer_constant, $meta_profile_data, $asset_mode);

                        break;
                    default:

                        $this->error_log('The requested UI content module...honoring the provided integer constant,  "'.$integer_constant.'", could not be found.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                        return '';

                        break;

                }


            }else{

                //
                // CRNRSTN_ASSET_MODE_BASE64
                //error_log(__LINE__.' env CRNRSTN_ASSET_MODE_BASE64');


                switch($integer_constant){
                    case CRNRSTN_UI_JS_JQUERY:
                    case CRNRSTN_UI_JS_JQUERY_UI:
                    case CRNRSTN_UI_JS_JQUERY_MOBILE:
                    case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:

                        return $this->return_output_CRNRSTN_UI_JS($integer_constant, $meta_profile_data);

                        break;
                    case CRNRSTN_UI_CSS_MAIN:
                    case CRNRSTN_UI_CSS_MOBILE:
                    case CRNRSTN_UI_CSS_TABLET:
                    case CRNRSTN_UI_CSS_DESKTOP:

                        return $this->return_output_CRNRSTN_UI_CSS_MAIN($integer_constant, $meta_profile_data);

                        break;
                    case CRNRSTN_UI_TAG_ANALYTICS:

                        return $this->return_output_CRNRSTN_UI_TAG_ANALYTICS($integer_constant, $meta_profile_data);

                        break;
                    case CRNRSTN_UI_TAG_ENGAGEMENT:

                        return $this->return_output_CRNRSTN_UI_TAG_ENGAGEMENT($integer_constant, $meta_profile_data);

                        break;
                    default:

                        $this->error_log('The requested UI content module...honoring the provided integer constant,  "'.$integer_constant.'", could not be found.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);
                        return '';

                        break;

                }


            }

        }

    }

    private function return_output_CRNRSTN_UI_JS($integer_constant, $meta_profile_data, $asset_mode = 'BASE64'){

        switch($asset_mode){
            case 'PNG':
            case 'JPEG':

                $tmp_str = '
<!-- BEGIN CRNRSTN :: '.$this->oCRNRSTN_USR->version_crnrstn.' UI JS/CSS MODULE OUTPUT -->';

                switch ($integer_constant){
                    case CRNRSTN_UI_JS_JQUERY:

                        $tmp_str = $tmp_str .'
<!-- jquery 3.6.0 --><script src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js?v=420.00.'. filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') .'.0"></script>';

                    break;
                    case CRNRSTN_UI_JS_JQUERY_UI:

                        $tmp_str = $tmp_str .'
<!-- jquery 3.6.0 --><script src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js?v=420.00.'. filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') .'.0"></script>';

                        $tmp_str = $tmp_str .'
<!-- jquery ui 1.12.1 --><style type="text/css" rel="stylesheet" href="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css') .'.0" ></style>';

                    break;
                    case CRNRSTN_UI_JS_JQUERY & CRNRSTN_UI_JS_JQUERY_UI:

                        $tmp_str = $tmp_str .'
<!-- jquery 3.6.0 --><script src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js"></script>';

                    break;
                    case CRNRSTN_UI_JS_JQUERY_MOBILE:
                        $tmp_str = $tmp_str .'
<!-- jquery.mobile 1.4.5 --><style type="text/css" rel="stylesheet" href="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css') .'.0" ></style>

<!-- jquery 3.6.0 --><script src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js?v=420.00.'. filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') .'.0" ></script>
<!-- jquery mobile helpmate --><script src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js?v=420.00.'. filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js') .'.0" ></script>
<!-- jquery.mobile 1.4.5 --><script src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js?v=420.00.'. filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js') .'.0" ></script>
';

                        break;
                    case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:
                        $tmp_str = $tmp_str .'
<!-- lightbox 2.11.3 --><style type="text/css" rel="stylesheet" href="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css?v=420.00.' . filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') .'.0" ></style>
<!-- lightbox 2.11.3 plus jquery.min.js --><script type="application/javascript" src="'.$this->oCRNRSTN_USR->sys_notice_creative_http_path.'js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js?v=420.00.'. filesize(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js') . '.' . filemtime(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/js/lightbox-plus-jquery.min.js') .'.0" ></script>
';

                        break;

                }

                $tmp_str = $tmp_str . '
<!-- END CRNRSTN :: '.$this->oCRNRSTN_USR->version_crnrstn.' UI JS MODULE OUTPUT -->

';

            break;
            default:

                //
                // BASE64
                $tmp_str = '
<!-- BEGIN CRNRSTN :: '.$this->oCRNRSTN_USR->version_crnrstn.' UI JS/CSS MODULE OUTPUT -->';

                switch ($integer_constant){
                    case CRNRSTN_UI_JS_JQUERY:

                        $tmp_str = $tmp_str .'
<!-- jquery 3.6.0 --><script>
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '
</script>';

                    break;
                    case CRNRSTN_UI_JS_JQUERY_UI:

                        $tmp_str = $tmp_str .'
<!-- jquery 3.6.0 --><script>
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '
</script>';
                        $tmp_str = $tmp_str .'
<!-- jquery ui 1.12.1 --><style>
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui-1.12.1/jquery-ui.min.css') . '
</style>';

                    break;
                    case CRNRSTN_UI_JS_JQUERY & CRNRSTN_UI_JS_JQUERY_UI:
                        $tmp_str = $tmp_str .'
<script>
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '
</script>';
                    break;
                    case CRNRSTN_UI_JS_JQUERY_MOBILE:
                        $tmp_str = $tmp_str .'
<!-- jquery.mobile 1.4.5 --><style type="text/css">
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css') . '
</style>


<!-- jquery 3.6.0 - jquery helpmate - jquery.mobile 1.4.5 --><script>
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery/3.6.0/jquery-3.6.0.min.js') . '

'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/index.js') . '

'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js') . '
</script>';

                    break;
                    case CRNRSTN_UI_JS_LIGHTBOX_DOT_JS:
                        $tmp_str = $tmp_str .'
<!-- lightbox 2.11.3 --><style type="text/css">
'.file_get_contents(CRNRSTN_ROOT . '/_crnrstn/ui/js/_lib/frameworks/lightbox.js/2.11.3/lightbox-2.11.3/css/lightbox.min.css') . '
</style>';

                    break;

                }

                $tmp_str = $tmp_str . '
<!-- END CRNRSTN :: '.$this->oCRNRSTN_USR->version_crnrstn.' UI JS MODULE OUTPUT -->
';

            break;

        }

        return $tmp_str;

    }

    private function return_output_CRNRSTN_UI_CSS_MAIN($integer_constant, $meta_profile_data, $asset_mode = 'BASE64'){

        return '<!-- '.__METHOD__.' -->';

    }

    private function return_output_CRNRSTN_UI_TAG_ANALYTICS($integer_constant, $meta_profile_data, $asset_mode = 'BASE64'){

        return '<!-- '.__METHOD__.' -->';

    }

    private function return_output_CRNRSTN_UI_TAG_ENGAGEMENT($integer_constant, $meta_profile_data, $asset_mode = 'BASE64'){

        return '<!-- '.__METHOD__.' -->';

    }


    public function return_sys_logging_profile(){

        return self::$sys_logging_profile_ARRAY;

    }

    public function return_sys_logging_meta(){

        return self::$sys_logging_meta_ARRAY;

    }

	public function return_oCRNRSTN_USR(){

        //$this->version_php = '5.5.420';

        if(!isset($this->oCRNRSTN_USR)){

            //
            // CLASS DEFINITION BY SUPPORTED PHP VERSION
            if(version_compare ('8' , $this->version_php) < 1){

                //
                // PHP 8.0
                require(CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP8.0.inc.php');
                //$this->print_r('PHP '.$this->version_php.' >= 8.0...'.CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP8.0.inc.php', 'version_php oCRNRSTN_USR driver', CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

            }else{

                if(version_compare ('7' , $this->version_php) < 1){

                    //
                    // PHP 7.0
                    require(CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP7.0.inc.php');
                    //$this->print_r('PHP '.$this->version_php.' >= 7.0...'.CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP7.0.inc.php', 'version_php oCRNRSTN_USR driver', CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

                }else{

                    //
                    // PHP < 7.0 (e.g. 5.5)
                    require(CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP5.5.inc.php');
                    //$this->print_r('PHP '.$this->version_php.' < 7.0...'.CRNRSTN_ROOT . '/_crnrstn/class/user/crnrstn.user_PHP5.5.inc.php', 'version_php oCRNRSTN_USR driver', CRNRSTN_HTML, __LINE__, __METHOD__, __FILE__);

                }

            }

            $this->oCRNRSTN_USR = new crnrstn_user($this);

        }

        return $this->oCRNRSTN_USR;

    }

    public function return_serialized_bit_value($bitwise_object_array_index_serial, $integer_constant){

        return $this->oCRNRSTN_BITFLIP_MGR->return_serialized_bit_value($bitwise_object_array_index_serial, $integer_constant);

    }

    public function return_bit_constant($const_nom){

        return $this->oCRNRSTN_BITFLIP_MGR->return_bit_constant($const_nom);

    }

    public function initialize_serialized_bit($const_nom, $integer_const, $default_state){

        return $this->oCRNRSTN_BITFLIP_MGR->initialize_serialized_bit($const_nom, $integer_const, $default_state);

    }

    public function initialize_bit($const_nom, $default_state){

        return $this->oCRNRSTN_BITFLIP_MGR->initialize_bit($const_nom, $default_state);

    }

	public function isBitSet($const){

        return $this->oCRNRSTN_BITFLIP_MGR->isBitSet($const);

    }

    public function serialized_isBitSet($const_nom, $integer_const){

        return $this->oCRNRSTN_BITFLIP_MGR->serialized_isBitSet($const_nom, $integer_const);

    }

    public function return_oLog_ProfileManager(){

        return self::$oLog_ProfileManager;

    }

    public function chunkPageData($tmp_page_content, $max_len, $encoding='UTF-8'){

        $oChunkRestrictData = new crnrstn_chunk_restrictor($tmp_page_content, $max_len, $this, $encoding);

        return $oChunkRestrictData;

    }
	
	public function is_configured($oCRNRSTN){
		
		//
		// INSTANTIATE SESSION MANAGER
		if(!isset($this->oSESSION_MGR)){

			$this->oSESSION_MGR = new crnrstn_session_manager($this);

		}
		
		//
		// DO WE HAVE SESSION DATA IN LINE WITH THE CONFIGURATION SERIALIZATION
		if(isset($_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'])){

            $this->oLog_output_ARRAY[] = $this->error_log('sessionid['.session_id().'] has been initialized by CRNRSTN ::. current value of CRNRSTN_RESOURCE_KEY ['.$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'].'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

			//
			// SESSION IS SET
			try{
			    
                //
                // DETERMINE KEY DESIGNATING THE RUNNING ENVIRONMENT, WHERE KEY = CRC32(env key)
                $oCRNRSTN->setServerEnv();

                self::$resourceKey = $oCRNRSTN->getServerEnv();

                if(self::$resourceKey==""){

                    //
                    // WE DON'T HAVE THE ENVIRONMENT DETECTED. THROW EXCEPTION.
                    // HOOOSTON...VE HAF PROBLEM!
                    $this->oLog_output_ARRAY[] = $this->error_log('ERROR :: unable to detect environment on server.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    return false;

                }else{

                    $this->env_cleartext_name = $oCRNRSTN->handle_env_cleartext_ARRAY[crc32($this->configSerial)][self::$resourceKey];

                    //
                    // FLASH WILD CARD RESOURCES OBJECT ARRAY TO ENVIRONMENTAL CLASS OBJECT
                    $this->initializeWildCardResource($oCRNRSTN);

                    $this->oCRNRSTN_IPSECURITY_MGR = clone $oCRNRSTN->oCRNRSTN_IPSECURITY_MGR;
                    unset($oCRNRSTN->oCRNRSTN_IPSECURITY_MGR);

                    //
                    // WE HAVE SELECTED ENVIRONMENT KEY. INITIALIZE. CONFIG KEY AND ENV KEY.
                    // FLASH CONFIG KEY AND ENV KEY TO SESSION.
                    $this->initRuntimeConfig();

                    //
                    // INITIALIZE ERROR REPORTING FOR THIS ENVIRONMENT
                    $this->initializeErrorReporting($oCRNRSTN);

                    //
                    // INITIALIZE SYSTEM CREATIVE HTTP PATH FOR THIS ENVIRONMENT
                    $this->initializeSystemCreative($oCRNRSTN);

                    //
                    // INITIALIZE ENVIRONMENTAL LOGGING BEHAVIOR
                    $this->initEnvLoggingProfile($oCRNRSTN);

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from grantExclusiveAccess()
                    if(isset($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initExclusiveAccess($oCRNRSTN);
                    }

                    //
                    // INITIALIZE IP ADDRESS RESTRICTIONS from denyAccess()
                    if(isset($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initDenyAccess($oCRNRSTN);
                    }

                    //
                    // INITIALIZE ADMINISTRATOR ACCESS
                    if(isset($oCRNRSTN->add_admin_creds_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
                        $this->initAdminAccess($oCRNRSTN);
                    }

                    //
                    // INITIALIZE DATABASE
                    $this->oMYSQLI_CONN_MGR = clone $oCRNRSTN->oMYSQLI_CONN_MGR;
                    $this->oMYSQLI_CONN_MGR->setEnvironment($this);

                    //
                    // BEFORE ALLOCATING ADDITIONAL MEMORY RESOURCES, PROCESS IP AUTHENTICATION
                    if(isset($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey]) || isset($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){

                        $this->oLog_output_ARRAY[] = $this->error_log('We have IP restrictions to process and apply for CRNRSTN :: config serial ['.$this->configSerial.'] and environment key ['.self::$resourceKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                        if(!$this->oCRNRSTN_IPSECURITY_MGR->authorizeEnvAccess($this, self::$resourceKey)){

                            //
                            // WE COULD PERHAPS USE A MORE GRACEFUL WAY TO TRANSITION TO ERR...BUT THIS WORKS
                            // THE METHOD returnSrvrRespStatus() CONTAINS SOME CUSTOM HTML FOR OUTPUT IF YOU WANT TO TWEAK ITS DESIGN
                            // PERHAPS SOME FUTURE RELEASE OF CRNRSTN CAN
                            $this->returnSrvrRespStatus(403);
                            exit();

                        }

                    }else{

                        $this->oLog_output_ARRAY[] = $this->error_log('There are NO IP restrictions to process and apply for CRNRSTN :: config serial ['.$this->configSerial.'] and environment key ['.self::$resourceKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    }

                    //
                    // INITIALIZE SOAP AUTHORIZATION PROFILES FOR THIS ENVIRONMENT
                    //$this->initSOAPAuthorizationProfiles();

                    //
                    // END OF CRNRSTN ENVIRONMENTAL CONFIG OPERATION
                    $this->oLog_output_ARRAY[] = $this->error_log('You have reached the end of the CRNRSTN :: environmental detection and configuration process. All remaining config data exists in (and will be pulled from) session['.session_id().'] for optimized loading experience.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    return true;

                }

            } catch( Exception $e ) {

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $oCRNRSTN->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

                return false;

            }

		}else{
			
			//
			// NO SESSION SET
            $this->oLog_output_ARRAY[] = $this->error_log('session['.session_id().'] has not been initialized with CRNRSTN :: configuration yet. process all config parameters and initialize.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            //
            // CLEAR OUT ANY INACCESSIBLE MEMORY RESOURCES IN SESSION FROM PREVIOUS SESSION CONFIG INITIALIZATION
            $this->removePreviousSessEnvDetectData($oCRNRSTN);

			return false;

		}

	}

	private function removePreviousSessEnvDetectData($oCRNRSTN){

        $oCRNRSTN->oLog_output_ARRAY = $this->oLog_output_ARRAY;

        $oCRNRSTN->removePreviousSessEnvDetectData();

        $this->oLog_output_ARRAY = $oCRNRSTN->oLog_output_ARRAY;

    }
	
	public function getEnvKey(){

		return self::$resourceKey;

	}
	
	public function getEnvSerial(){

		return $this->configSerial;

	}

	public function safe_getServerArrayVar($param, $oCRNRSTN_USR=NULL){

	    if($this->isset_ServerArrayVar($param)){

	        return $this->getServerArrayVar($param, $oCRNRSTN_USR);

        }else{

	        return false;

        }
    }

	public function isset_ServerArrayVar($param){

        if(isset($_SERVER[$param])){

            return true;

        }else{

            return false;

        }

    }

	public function getServerArrayVar($param, $oCRNRSTN_USR=NULL){

        try {

	        if(!isset($_SERVER[$param])){

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('The requested _SERVER super global parameter ['.$param.'] cannot be found.');

            }else{

                return $_SERVER[$param];

            }

        }catch( Exception $e ) {

            if(isset($oCRNRSTN_USR)){

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            }else{

                //
                // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
                $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            }

            return false;

        }

    }

    public function issetHTTP($protocol){

	    switch($protocol){
            case 'GET':

                $super_global = $_GET;

            break;
            default:

                //
                // POST
                $super_global = $_POST;

            break;

        }

	    return $this->oHTTP_MGR->issetHTTP($super_global);

    }

    public function return_SOAP_svc_config_param($param_key){

        foreach($this->oSOAP_services_access_manager as $serial => $oSOAP_svc_mgr){

            return $oSOAP_svc_mgr->return_soap_encryption_config_param($param_key);

        }

    }

    public function return_SOAP_svc_oClient_meta($param_key, $CRNRSTN_SOAP_SVC_USERNAME, $CRNRSTN_SOAP_SVC_PASSWORD){

        foreach($this->oSOAP_services_oClient_manager as $serial => $oSOAP_oClient){

            $tmp_un = $oSOAP_oClient->return_username();
            $tmp_pwd = $oSOAP_oClient->return_password();
            //error_log(__LINE__.' env - ['.$param_key.']['.$tmp_un.']['.$CRNRSTN_SOAP_SVC_USERNAME.']['.$tmp_pwd.']['.$CRNRSTN_SOAP_SVC_PASSWORD.']');
            if($tmp_un == $CRNRSTN_SOAP_SVC_USERNAME && $this->validate_pwdHash_LOGIN_storage($tmp_pwd, $CRNRSTN_SOAP_SVC_PASSWORD)){

                $tmp_soap_encryption_config_ARRAY = $oSOAP_oClient->return_soap_services_soap_encryption_config();

                switch($param_key){
                    case 'SOAP_ENCRYPT_CIPHER':

                        return $tmp_soap_encryption_config_ARRAY['encryptCipher'];

                    break;
                    case 'SOAP_ENCRYPT_SECRET_KEY':

                        return $tmp_soap_encryption_config_ARRAY['encryptSecretKey'];

                    break;
                    case 'SOAP_ENCRYPT_HMAC_ALG':

                        return $tmp_soap_encryption_config_ARRAY['hmac_alg'];

                    break;
                    case 'SOAP_ENCRYPT_OPTIONS':

                        return $tmp_soap_encryption_config_ARRAY['encryptOptions'];

                    break;
                    default:

                        return $tmp_soap_encryption_config_ARRAY;

                    break;

                }

            }

        }

        return false;

    }

    private function initSOAPAuthorizationProfiles(){

        //
        // PROCESS IP ADDRESS ACCESS AND RESTRICTION FOR SELECTED ENVIRONMENT
        //error_log(__LINE__.' env - initSOAPAuthorizationProfiles['.$this->configSerial.']['.self::$resourceKey.']');

        foreach($this->soap_permissions_file_path_ARRAY[crc32($this->configSerial)][self::$resourceKey] as $key => $soap_config_file_path){

            if(is_file($soap_config_file_path)){

                //
                // EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
                $this->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for the initialization of endpoint profiles authorized to connect to the CRNRSTN :: SOAP Services layer ['.$this->soap_permissions_file_path_ARRAY[crc32($this->configSerial)][self::$resourceKey][$key].'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
                //include_once($this->soap_permissions_file_path_ARRAY[crc32($this->configSerial)][self::$resourceKey][$key]);
                include_once($soap_config_file_path);

            }

        }

    }

    public function update_SOAP_services_oAuth($SOAP_oAuth){

        $this->oSOAP_services_oAuth_manager[$SOAP_oAuth->serial] = $SOAP_oAuth;

        return true;

    }

    public function update_SOAP_services_oClient($SOAP_oClient){

        $this->oSOAP_services_oClient_manager[$SOAP_oClient->serial] = $SOAP_oClient;

        return true;

    }

    public function update_SOAP_services_oAuth_update_permissions($origin_oAuth_serial, $services_authorization_group_key, $soap_services_resource_access_ARRAY, $soap_services_resource_denyaccess_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth){

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key){

                if($serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_update_permissions($soap_services_resource_access_ARRAY, $soap_services_resource_denyaccess_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_update_permissions($origin_oClient_serial, $services_client_group_key, $soap_services_resource_access_ARRAY, $soap_services_resource_denyaccess_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient){

            if($SOAP_oClient->services_client_group_key == $services_client_group_key){

                if($serial != $origin_oClient_serial){

                    $SOAP_oClient->sync_update_permissions($soap_services_resource_access_ARRAY, $soap_services_resource_denyaccess_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_soap_encryption_config($origin_oAuth_serial, $services_authorization_group_key, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth) {

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_soap_encryption_config($origin_oClient_serial, $services_client_group_key, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oClient_serial){

                    $SOAP_oClient->sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_activate_SOAP_method($origin_oAuth_serial, $services_client_group_key, $soap_services_method_activate_ARRAY, $soap_services_method_deactivate_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oClient->sync_activate_SOAP_method($soap_services_method_activate_ARRAY, $soap_services_method_deactivate_ARRAY);
                    $SOAP_oClient->sync_deactivate_SOAP_method($soap_services_method_deactivate_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_deactivate_SOAP_method($origin_oAuth_serial, $services_client_group_key, $soap_services_method_deactivate_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial!= $origin_oAuth_serial){

                    $SOAP_oClient->sync_deactivate_SOAP_method($soap_services_method_deactivate_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_IP_denyAccess($origin_oAuth_serial, $services_authorization_group_key, $ip_auth_denial_ARRAY){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth) {

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key) {

                if($SOAP_oAuth->serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_IP_denyAccess($ip_auth_denial_ARRAY);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_IP_denyAccess($origin_oClient_serial, $services_client_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if ($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($SOAP_oClient->serial != $origin_oClient_serial) {

                    $SOAP_oClient->sync_IP_denyAccess($ip);
                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_oAuth_IP_exclusiveAccess($origin_oAuth_serial, $services_authorization_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oAuth_manager as $serial => $SOAP_oAuth) {

            if($SOAP_oAuth->services_authorization_group_key == $services_authorization_group_key) {

                if($serial != $origin_oAuth_serial){

                    $SOAP_oAuth->sync_IP_exclusiveAccess($ip);

                }

            }

            $tmp_array[$serial] = $SOAP_oAuth;

        }

        $this->oSOAP_services_oAuth_manager = $tmp_array;

    }

    public function update_SOAP_services_oClient_IP_exclusiveAccess($origin_oClient_serial, $services_client_group_key, $ip){

        $tmp_array = array();

        foreach($this->oSOAP_services_oClient_manager as $serial => $SOAP_oClient) {

            if($SOAP_oClient->services_client_group_key == $services_client_group_key) {

                if($serial != $origin_oClient_serial) {

                    $SOAP_oClient->sync_IP_exclusiveAccess($ip);

                }

            }

            $tmp_array[$serial] = $SOAP_oClient;

        }

        $this->oSOAP_services_oClient_manager = $tmp_array;

    }

    public function update_SOAP_services_access_manager($oSOAP_svc_mgr){

        $this->oSOAP_services_access_manager[$oSOAP_svc_mgr->serial] = $oSOAP_svc_mgr;

        return true;

    }

    public function return_SOAP_SVC_debugMode(){

        foreach($this->oSOAP_services_access_manager as $serial => $oSOAP_svc_mgr){

            //error_log(__LINE__.' env - ['.$serial.']['.is_object($oSOAP_svc_mgr).']['.$oSOAP_svc_mgr->CRNRSTN_NUSOAP_SVC_debugMode.']');
            return $oSOAP_svc_mgr->CRNRSTN_NUSOAP_SVC_debugMode;

        }

    }

    public function isAuthorized_SOAP_request($CRNRSTN_SOAP_SVC_AUTH_KEY, $USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        //$AUTHORIZATION_GRANTED = false;
        $AUTHORIZATION_GRANTED_oAUTH = false;
        $AUTHORIZATION_GRANTED_oCLIENT = false;

        foreach($this->oSOAP_services_access_manager as $serial => $oSOAP_svc_mgr){

            error_log(__LINE__.' env - RUN isAuthorized_oAuth()...');
            if($oSOAP_svc_mgr->isAuthorized_oAuth($CRNRSTN_SOAP_SVC_AUTH_KEY, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES)){

                $AUTHORIZATION_GRANTED_oAUTH = true;

            }

            error_log(__LINE__.' env - RUN isAuthorized_oClient()...');
            if($oSOAP_svc_mgr->isAuthorized_oClient($USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE)){

                $AUTHORIZATION_GRANTED_oCLIENT = true;

            }

        }

        if($AUTHORIZATION_GRANTED_oAUTH && $AUTHORIZATION_GRANTED_oCLIENT){

            error_log(__LINE__.' SERVER - proxy login successful.');
            return true;

        }else{
            error_log(__LINE__.' SERVER - proxy login denied.');

            return false;

        }

    }

	private function initEnvLoggingProfile($oCRNRSTN){

        //
        // DETECTED RESOURCE KEY
        if(isset(self::$resourceKey)){

            //
            // CLEAR OUT BITS FOR NEW LOGGING PROFILE DATA
            foreach($this->logging_profile_constants as $key => $integer_constant){

                //
                // LET'S TRY THIS. OTHERWISE WE HAVE TO READ() AND THEN TOGGLE() IF TRUE.
                $this->initialize_bit($integer_constant, false);

            }

            //
            // RETRIEVE LOGGING PROFILE DATA FROM CRNRSTN ::
            self::$sys_logging_profile_ARRAY = $oCRNRSTN->return_logging_profile(self::$resourceKey);
            self::$sys_logging_meta_ARRAY = $oCRNRSTN->return_logging_meta(self::$resourceKey);

            //
            // PROCESS BITWISE DATA FOR LOGGING PROFILE
            foreach(self::$sys_logging_profile_ARRAY as $key => $int_const_profile){

                //error_log(__LINE__.' env init bit const (int) '.$int_const_profile.'.');
                $this->initialize_bit($int_const_profile, true);

            }

            //
            // NOW THAT WE HAVE LOGGING PROFILE DATA...SYNC LOGGING PROFILE MANAGER
            self::$oLog_ProfileManager->sync_to_environment($oCRNRSTN, $this);

            $this->oLogger->sync_olog_profile_manager(self::$oLog_ProfileManager);

        }

	}
	
	private function initRuntimeConfig(){
		
		//
		// INITIALIZE CONFIG AND ENV KEYS.
		#$_SESSION['CRNRSTN_CONFIG_SERIAL'] = $this->configSerial;  # MOVED TO CRNRSTN __construct() @ ~line 105
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'] = self::$resourceKey;
        $this->oLog_output_ARRAY[] = $this->error_log('Initialize session['.session_id().'] with CRNRSTN :: config serial ['.$this->configSerial.'] and environmental resource key ['.self::$resourceKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
		
	}
	
	private function initializeErrorReporting($oCRNRSTN){

        $this->oLog_output_ARRAY[] = $this->error_log('Initialize server error_reporting() to ['.$oCRNRSTN->handle_env_ARRAY[crc32($this->configSerial)][self::$resourceKey].'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
		error_reporting((int) $oCRNRSTN->handle_env_ARRAY[crc32($this->configSerial)][self::$resourceKey]);

	}

	private function initExclusiveAccess($oCRNRSTN){
		
		//
		// PROCESS IP ADDRESS ACCESS AND RESTRICTION FOR SELECTED ENVIRONMENT
		if(is_file($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
			
			//
			// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
            $this->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for exclusive access IP restrictions at ['.$oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey].'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
			include_once($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey]);
			
		}else{
			
			//
			// DO WE HAVE ANY IP DATA TO PROCESS
			if($oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey] != ""){

                $this->oLog_output_ARRAY[] = $this->error_log('Process grant exclusive access IP['.$oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey].'] for this connection.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
				$this->oCRNRSTN_IPSECURITY_MGR->grantAccessWKey(self::$resourceKey, $oCRNRSTN->grant_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey]);

			}else{
					//
					// NO IP ADDRESSES PROVIDED. NOTHING TO DO HERE.
			}
		}
	}
	
	private function initDenyAccess($oCRNRSTN){

		if(is_file($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey])){
			
			//
			// EXTRACT ACCESS-BY-IP AUTHORIZATION PROFILE FROM FILE
            $this->oLog_output_ARRAY[] = $this->error_log('We have a file to include and process for deny access IP restrictions at ['.$oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey].'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
			include_once($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey]);
				
		}else{

			if($oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey] != ""){

                $this->oLog_output_ARRAY[] = $this->error_log('Process deny access IP['.$oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey].'] for this connection.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
				$this->oCRNRSTN_IPSECURITY_MGR->denyAccessWKey(self::$resourceKey, $oCRNRSTN->deny_accessIP_ARRAY[crc32($this->configSerial)][self::$resourceKey]);

			}else{
				
				//
				// NO IP ADDRESSES PROVIDED. NOTHING TO DO HERE.

			}		
		}		
	}

	private function initAdminAccess($oCRNRSTN){

        $tmp_cnt = sizeof($oCRNRSTN->add_admin_creds_ARRAY[crc32($this->configSerial)][self::$resourceKey]['email']);

        for($i=0; $i<$tmp_cnt; $i++){

            $tmp_email = $oCRNRSTN->add_admin_creds_ARRAY[crc32($this->configSerial)][self::$resourceKey]['email'][$i];
            $tmp_pwdhash = $oCRNRSTN->add_admin_creds_ARRAY[crc32($this->configSerial)][self::$resourceKey]['pwdhash'][$i];
            $tmp_ttl = $oCRNRSTN->add_admin_creds_ARRAY[crc32($this->configSerial)][self::$resourceKey]['ttl'][$i];

            $this->addAdministrativeAccount($tmp_email, $tmp_pwdhash, $tmp_ttl);

        }

        return true;

    }

    private function addAdministrativeAccount($email, $pwdhash, $ttl){

        $this->oAdminAccount_ARRAY[] = new crnrstn_administrative_account($this, $email, $pwdhash, $ttl);

        return true;

    }
	
	public function returnResourceKey(){
		
		//
		// RETURN RESOURCE KEY FOR DETECTED ENVIRONMENT
		return 	self::$resourceKey;

	}
	
	public function initSessionEncryption($oCRNRSTN){
		
		//
		// TRANSFER SESSION ENCRYPT PARAMS TO SESSION
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_SESS_ENCRYPT_CIPHER"] = $oCRNRSTN->opensslSessEncryptCipher[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_SESS_ENCRYPT_SECRET_KEY"] = $oCRNRSTN->opensslSessEncryptSecretKey[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_SESS_ENCRYPT_OPTIONS"] = $oCRNRSTN->opensslSessEncryptOptions[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_SESS_ENCRYPT_HMAC_ALG"] = $oCRNRSTN->sessHmac_algorithm[crc32($this->configSerial)][self::$resourceKey];
		
		#$this->oLog_output_ARRAY[] = $this->error_log("session encryption configured to _CRNRSTN_SESS_ENCRYPT_CIPHER[".$oCRNRSTN->opensslSessEncryptCipher[crc32($this->configSerial)][self::$resourceKey]."] _CRNRSTN_SESS_ENCRYPT_HMAC_ALG[".$oCRNRSTN->sessHmac_algorithm[crc32($this->configSerial)][self::$resourceKey]."].", __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->oLog_output_ARRAY[] = $this->error_log('Session encryption configured to _CRNRSTN_SESS_ENCRYPT_CIPHER[##### REDACTED #####] _CRNRSTN_SESS_ENCRYPT_HMAC_ALG[##### REDACTED #####].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
		
	}
	
	public function initCookieEncryption($oCRNRSTN){
		
		//
		// TRANSFER COOKIE ENCRYPT PARAMS TO SESSION
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_COOKIE_ENCRYPT_CIPHER"] = $oCRNRSTN->opensslCookieEncryptCipher[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_COOKIE_ENCRYPT_SECRET_KEY"] = $oCRNRSTN->opensslCookieEncryptSecretKey[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_COOKIE_ENCRYPT_OPTIONS"] = $oCRNRSTN->opensslCookieEncryptOptions[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG"] = $oCRNRSTN->cookieHmac_algorithm[crc32($this->configSerial)][self::$resourceKey];
		
		#$this->oLog_output_ARRAY[] = $this->error_log("cookie encryption configured to _CRNRSTN_COOKIE_ENCRYPT_CIPHER[".$oCRNRSTN->opensslCookieEncryptCipher[crc32($this->configSerial)][self::$resourceKey]."] _CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG[".$oCRNRSTN->cookieHmac_algorithm[crc32($this->configSerial)][self::$resourceKey]."].", __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->oLog_output_ARRAY[] = $this->error_log('Cookie encryption configured to _CRNRSTN_COOKIE_ENCRYPT_CIPHER[##### REDACTED #####] _CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG[##### REDACTED #####].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

	}
	
	public function initTunnelEncryption($oCRNRSTN){
		
		//
		// TRANSFER COOKIE ENCRYPT PARAMS TO SESSION
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_TUNNEL_ENCRYPT_CIPHER"] = $oCRNRSTN->opensslTunnelEncryptCipher[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_TUNNEL_ENCRYPT_SECRET_KEY"] = $oCRNRSTN->opensslTunnelEncryptSecretKey[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_TUNNEL_ENCRYPT_OPTIONS"] = $oCRNRSTN->opensslTunnelEncryptOptions[crc32($this->configSerial)][self::$resourceKey];
		$_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]["_CRNRSTN_TUNNEL_ENCRYPT_HMAC_ALG"] = $oCRNRSTN->tunnelHmac_algorithm[crc32($this->configSerial)][self::$resourceKey];
		
		#$this->oLog_output_ARRAY[] = $this->error_log("cookie encryption configured to _CRNRSTN_COOKIE_ENCRYPT_CIPHER[".$oCRNRSTN->opensslTunnelEncryptCipher[crc32($this->configSerial)][self::$resourceKey]."] _CRNRSTN_COOKIE_ENCRYPT_HMAC_ALG[".$oCRNRSTN->tunnelHmac_algorithm[crc32($this->configSerial)][self::$resourceKey]."].", __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
        $this->oLog_output_ARRAY[] = $this->error_log('Tunnel encryption configured to _CRNRSTN_TUNNEL_ENCRYPT_CIPHER[##### REDACTED #####] _CRNRSTN_TUNNEL_ENCRYPT_HMAC_ALG[##### REDACTED #####].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
		
	}
	
	public function paramTunnelEncrypt($data=NULL, $cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

		try{

			if(isset($data)){
			
				//
				// DATA TYPE MUST BE ENCRYPTABLE...AND SAFE FOR URI
				if(in_array(gettype($data), self::$encryptableDataTypes)){

                    $tmp_encrypt_val = $this->tunnelParamEncrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override);

                    //
                    // MAKE SAFE FOR URI PASSTHROUGH.
                    $tmp_encrypt_val = urlencode($tmp_encrypt_val);

					return $tmp_encrypt_val;
								
				}else{
					
					//
					// NOT ENCRYPTABLE
					return NULL;
					
				}

			}else{
				
				//
				// NOT ENCRYPTABLE
				return NULL;
				
			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

		return NULL;

	}
	
	public function paramTunnelDecrypt($data=NULL, $uri_passthrough=false, $cipher_override=NULL, $secret_key_override=NULL, $hmac_algorithm_override=NULL, $options_bitwise_override=NULL){

		try{

			if(!isset($data) || $data == ''){

				return NULL;

			}else{

			    if($uri_passthrough == true){

                    //
                    // BACK OUT OF URL ENCODING
                    $data = urldecode($data);

                }

				return trim($this->tunnelParamDecrypt($data, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override));
			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

        }

        return NULL;
	}	
	
	private function tunnelParamEncrypt($val, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

		try{

			if(isset($cipher_override) || isset($_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_CIPHER'])){
				
				if(!isset($secret_key_override)){
                    //error_log('783 tunnelParamEncrypt - secret_key from session...');

                    $secret_key = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_SECRET_KEY'];

				}else{

                    $secret_key = $secret_key_override;

				}

				//
                // ENABLE CIPHER OVERRIDE :: v2.0.0
				if(!isset($cipher_override)){
                    //error_log('796 tunnelParamEncrypt - cipher from session...');
                    $cipher = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_CIPHER'];

                }else{

                    $cipher = $cipher_override;

                }

                //
                // ENABLE HMAC ALG OVERRIDE :: v2.0.0
                if(!isset($hmac_algorithm_override)){
                    //error_log('808 tunnelParamEncrypt - hmac from session...');

                    $hmac_algorithm = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_HMAC_ALG'];

                }else{

                    $hmac_algorithm = $hmac_algorithm_override;

                }

                //
                // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
                if(!isset($options_bitwise_override)){
                    //error_log('821 tunnelParamEncrypt - bitwise from session...');

                    $options_bitwise = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_OPTIONS'];

                }else{

                    $options_bitwise = $options_bitwise_override;

                }
				
				#
				# Source: http://php.net/manual/en/function.openssl-encrypt.php
				#
				$ivlen = openssl_cipher_iv_length($cipher);
				$iv = openssl_random_pseudo_bytes($ivlen);
				$ciphertext_raw = openssl_encrypt($val, $cipher, $secret_key, $options=$options_bitwise, $iv);
				$hmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary=true);
				$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
				
				return $ciphertext;

			}else{
				
				return $val;

			}

		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

		}

        return NULL;

	}
	
	private function tunnelParamDecrypt($val, $cipher_override, $secret_key_override, $hmac_algorithm_override, $options_bitwise_override){

		try{
			
			if(isset($cipher_override) || isset($_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_CIPHER'])){
				
				if(!isset($secret_key_override)){

					$secret_key = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_SECRET_KEY'];

				}else{

                    $secret_key = $secret_key_override;

				}

                //
                // ENABLE CIPHER OVERRIDE :: v2.0.0
				if(!isset($cipher_override)){

                    $cipher = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_CIPHER'];

                }else{

                    $cipher = $cipher_override;

                }

                //
                // ENABLE HMAC ALG OVERRIDE :: v2.0.0
                if(!isset($hmac_algorithm_override)){

                    $hmac_algorithm = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_HMAC_ALG'];

                }else{

                    $hmac_algorithm = $hmac_algorithm_override;

                }

                //
                // ENABLE OPTIONS BITWISE OVERRIDE :: v2.0.0
                if(!isset($options_bitwise_override)){

                    $options_bitwise = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_'.self::$resourceKey]['_CRNRSTN_TUNNEL_ENCRYPT_OPTIONS'];

                }else{

                    $options_bitwise = $options_bitwise_override;

                }

				#
                # Source: http://php.net/manual/en/function.openssl-encrypt.php
                #
                $c = base64_decode($val);
				$ivlen = openssl_cipher_iv_length($cipher);
				$iv = substr($c, 0, $ivlen);
				$hmac = substr($c, $ivlen, $sha2len=32);
				$ciphertext_raw = substr($c, $ivlen+$sha2len);
				$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $secret_key, $options=$options_bitwise, $iv);
				$calcmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $secret_key, $as_binary=true);
				
				if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
				{
					return $original_plaintext;

				}else{

					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN :: Tunnel Param Decrypt Notice :: Oops. Something went wrong. Hash_equals comparison failed during data decryption.');

				}
			
			}else{
				
				//
				// NO ENCRYPTION. RETURN VAL
				return $val;

			}
			
		}catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return NULL;

		}

        return NULL;

	}
	
	private function initEnvResources($oCRNRSTN){
		
		//
		// ITERATE THROUGH handle_resource_ARRAY TO EXTRACT ENV SPECIFIC USER DEFINED PARAMS
		// TRANSFER DATA (JUST FOR THE RUNNING ENV) FROM oCRNRSTN RESOURCE ARRAY TO SESSION
		$this->getHandle_resource_ARRAY = $oCRNRSTN->getHandle_resource_ARRAY();
		$tmp_envkey = $this->oSESSION_MGR->getSessionKey();
		foreach($this->getHandle_resource_ARRAY[crc32($this->configSerial)][$tmp_envkey] as $key=>$value){

            $this->oLog_output_ARRAY[] = $this->error_log('Initializing session['.session_id().'] with resource ['.$key.'] receiving value [##### REDACTED #####] for environmental key ['.$tmp_envkey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
			$this->oSESSION_MGR->setSessionParam($key, $value);

		}
		
		//
		// INITIALIZE SESSION WITH ANY WILDCARDS
		if(isset($this->getHandle_resource_ARRAY[crc32($this->configSerial)][crc32('*')])){
			foreach($this->getHandle_resource_ARRAY[crc32($this->configSerial)][crc32('*')] as $key=>$value){

                $this->oLog_output_ARRAY[] = $this->error_log('Initializing session['.session_id().'] with resource [*] receiving value [##### REDACTED #####] for environmental key ['.$tmp_envkey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);
				$this->oSESSION_MGR->setSessionParam($key, $value);

			}
		}
	}

    private function define_wildcard_resource($key){

        $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

	private function initializeWildCardResource($oCRNRSTN){

        $envKey = $this->env_cleartext_name;
        $this->wildCardResource_filePath = $oCRNRSTN->wildCardResource_filePath_ARRAY[crc32($this->configSerial)][self::$resourceKey];

        $oWildCardResource_ARRAY = array();
        //error_log(__LINE__.' env ['.$envKey.']['.self::$resourceKey.']['.$this->wildCardResource_filePath.']');

        try{

            if(is_file($this->wildCardResource_filePath)){

                //
                // INITIALIZE WILDCARD RESOURCES
                $this->oLog_output_ARRAY[] = $this->error_log('Storing initialized Wild Card Resources at ['.$this->wildCardResource_filePath.'] in memory for this environment ['.self::$resourceKey.'].', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                include_once($this->wildCardResource_filePath);

                $this->oWildCardResource_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL][] = $oWildCardResource_ARRAY;

                $this->tmp_wcr_config_envKey = '';

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('CRNRSTN :: wildcard resource file cannot be loaded, because it ['.$this->wildCardResource_filePath.'] is not a file.');

            }

        }catch( Exception $e ) {

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $oCRNRSTN->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    private function initializeSystemCreative($oCRNRSTN){

        $this->sys_notice_creative_http_path = $oCRNRSTN->returnSystemCreative(self::$resourceKey);

    }

    /*
    public function isset_WCR($key){

        //$tmp_array = $this->oWildCardResource_ARRAY[crc32($this->configSerial)][self::$resourceKey];

        if(isset($this->oWildCardResource_ARRAY[crc32($this->configSerial)])){

            //error_log('1206 env - we have WCR data...');

        }else{

            //error_log('1206 env - NO WCR data...['.$this->configSerial.']['.self::$resourceKey.']');


        }
        //foreach ($tmp_array as $key => $value){

            //error_log('1211 env - ['.$key.']');

       // }

        die();
    }
    */

    public function augmentWCR_array($oWCR){

	    $tmp_array = $this->oWildCardResource_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL];
        $tmp_array[$oWCR->returnResourceKey()] = $oWCR;
        $this->oWildCardResource_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL] = $tmp_array;

    }
	
	public function returnSrvrRespStatus($errorCode, $html_burn = NULL){
		
		//
		// Source: http://php.net/manual/en/function.http-response-code.php
		// Source of source: Wikipedia "List_of_HTTP_status_codes"
        $http_status_codes = array(100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing', 200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-Status', 300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 306 => '(Unused)', 307 => 'Temporary Redirect', 308 => 'Permanent Redirect', 400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable', 417 => 'Expectation Failed', 418 => 'I\'m a teapot', 419 => 'Authentication Timeout', 420 => 'Enhance Your Calm', 422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency', 424 => 'Method Failure', 425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required', 429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large', 444 => 'No Response', 449 => 'Retry With', 450 => 'Blocked by Windows Parental Controls', 451 => 'Unavailable For Legal Reasons', 494 => 'Request Header Too Large', 495 => 'Cert Error', 496 => 'No Cert', 497 => 'HTTP to HTTPS', 499 => 'Client Closed Request', 500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Timeout', 505 => 'HTTP Version Not Supported', 506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected', 509 => 'Bandwidth Limit Exceeded', 510 => 'Not Extended', 511 => 'Network Authentication Required', 598 => 'Network read timeout error', 599 => 'Network connect timeout error');
		header($this->getServerArrayVar('SERVER_PROTOCOL').' '.$errorCode.' '.$http_status_codes[$errorCode]);

		if(!isset($html_burn)){

            $html_burn = '';

        }

        switch($this->sys_notices_creative_mode){
            case 'ALL_IMAGE':
            case 'ALL_IMAGE_LOGO_OFF':

                $str = '<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    '.$this->return_email_creative('CRNRSTN_FAVICON').'
    <title>'.$errorCode.' '.$http_status_codes[$errorCode].'</title>
</head>
<body style="background-color: #FFF; width:100%; text-align: left; margin:0px auto;">
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 2px solid #FF0000;"></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 1px solid #DB1717;"></div>

<div style=\'width:96%; margin:0 0 0 0; padding:6px 2% 0 2%; color:#FFF; font-family:"trebuchet MS", Verdana, sans-serif;background-color:#BEBEBE; height:30px; line-height: 28px;\'><h1 style="font-size: 30px; overflow: hidden; height:23px; padding-top:7px; margin-top: 0;">Server Error</h1></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-top: 2px solid #FFF;"></div>

<div style="height:5px; '.$this->return_email_creative('BG_ELEMENT_RESPONSE_CODE', CRNRSTN_UI_IMG_BASE64).' background-repeat: repeat-x;">
    <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
</div>

<div style="padding:100px 0 300px 100px; float:left; font-family:arial; font-weight:bold; font-size:11px;">'.$errorCode.' '.$http_status_codes[$errorCode].'</div>
<!--
<div style="position:absolute; padding:200px 0 0 10px; float:left;"><pre>

'.$html_burn.'

</pre></div>
-->
<div style="padding:16px 2% 0 0; float:right; width:260px;">
    <div style="float:right; ">
        '.$this->return_component_branding_creative(true).'
    </div>
</div>

<div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
    <div style="position: absolute; width:100%; text-align: right; background-color: #FFF; padding-top: 20px;">
        '.$this->return_email_creative('J5_WOLF_PUP_RAND').'
    </div>
</div>

<div style="height:0px; width:100%; clear:both; display: block; overflow: hidden;"></div>

</body>
</html>';

            break;
            case 'ALL_HTML_LOGO_OFF':
            case 'ALL_HTML':
            default:

                $str = '<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>'.$errorCode.' '.$http_status_codes[$errorCode].'</title>
</head>
<body style="background-color: #FFF; text-align: left; margin:0px auto; border: 0; padding:0; margin:0; font-family:Arial, Helvetica, sans-serif; ">
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 2px solid #FF0000;"></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-bottom: 1px solid #DB1717;"></div>

<div style=\'width:96%; margin:0 0 0 0; padding:6px 2% 0 2%; color:#FFF; font-family:"trebuchet MS", Verdana, sans-serif;background-color:#BEBEBE; height:30px; line-height: 28px;\'><h1 style="font-size: 30px; overflow: hidden; height:23px; padding-top:7px; margin-top: 0;">Server Error</h1></div>
<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px; border-top: 2px solid #FFF;"></div>

<div style="height:5px; '.$this->return_email_creative('BG_ELEMENT_RESPONSE_CODE', CRNRSTN_UI_IMG_BASE64).' background-repeat: repeat-x;">
    <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
</div>

<div style="padding:100px 0 300px 100px; float:left; font-family:arial; font-weight:bold; font-size:11px;">'.$errorCode.' '.$http_status_codes[$errorCode].'</div>
<!--
<div style="position:absolute; padding:200px 0 0 10px; float:left;"><pre>

'.$html_burn.'

</pre></div>
-->
<div style="padding:16px 2% 0 0; float:right; width:260px;">
    <div style="float:right; ">
        '.$this->return_component_branding_creative(true).'
    </div>
</div>

<div style="float:right; padding:420px 0 0 0; margin:0; width:100%;">
    <div style="position: absolute; width:100%; text-align: right; background-color: #FFF; padding-top: 20px;">
        '.$this->return_email_creative('J5_WOLF_PUP_RAND').'
    </div>
</div>

<div style="height:0px; width:100%; clear:both; display: block; overflow: hidden;"></div>

</body>
</html>';

            break;

        }
		
		echo $str;
		
		exit();

	}
	
	public function getEnvParam($paramName, $wildCardKey = NULL, $SOAP_output_mode = false){

	    try{

            //
            // CHECK FOR EXISTENCE OF PARAMETER WITHIN WILD CARD RESOURCE
            if(isset($wildCardKey)){

                if(isset($this->oWildCardResource_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL])) {

                    $tmp_oWCR_ARRAY = $this->oWildCardResource_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL];

                    if(!isset($tmp_oWCR_ARRAY[$wildCardKey])){

                        $this->error_log('The requested WCR (wild card resource), "'.$wildCardKey.'", has not been configured for this environment (e.g. NULL WCR array index, here)...albeit there are other environments CRNRSTN :: is currently configured to support here which have had at least one (1) WCR defined and initialized therein (so...there is that).', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The requested WCR (wild card resource), "'.$wildCardKey.'", has not been configured for this environment (e.g. NULL WCR array index, here)...albeit there are other environments CRNRSTN :: is currently configured to support here which have had at least one (1) WCR defined and initialized therein (so...there is that).');

                    }else{

                        $tmp_oWCR = $tmp_oWCR_ARRAY[$wildCardKey];

                        if ($tmp_oWCR->isset_WCR($wildCardKey, $paramName)) {

                            //
                            // PARAM HAS BEEN DEFINED WITHIN WILD CARD RESOURCE
                            return $tmp_oWCR->get_attribute($wildCardKey, $paramName, $SOAP_output_mode);

                        } else {

                            $this->error_log('The "'.$paramName.'" parameter has been requested from wild card resource (i.e. WCR), "'.$wildCardKey.'", but this parameter was not found to have been initialized therein via oWCR->add_attribute().', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('The "'.$paramName.'" parameter has been requested from wild card resource (i.e. WCR), "'.$wildCardKey.'", but this parameter was not found to have been initialized therein via oWCR->add_attribute().');

                        }

                    }

                }else{

                    $this->error_log('The wild card resource (i.e. WCR), "'.$wildCardKey.'", has been requested, but no WCR of the kind has been configured for this environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_BARNEY);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('The wild card resource (i.e. WCR), "'.$wildCardKey.'", has been requested, but no WCR of the kind has been configured for this environment.');

                }

            }else{

                if(!isset(self::$sess_env_param_ARRAY[$paramName])){

                    self::$sess_env_param_ARRAY[$paramName] = $this->pullFromSession($paramName);

                }

                return self::$sess_env_param_ARRAY[$paramName];

            }

        } catch (Exception $e) {

	        //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

	}
	
	private function pullFromSession($key) {

		//
		// PULL FROM SESSION CACHE
		return $this->oSESSION_MGR->getSessionParam($key);

	}

	/**
	* @see http://php.net/manual/en/function.openssl-encrypt.php
	*/
	public function openssl_get_cipher_methods(){
		$ciphers             = openssl_get_cipher_methods();
		$ciphers_and_aliases = openssl_get_cipher_methods(true);
		$cipher_aliases      = array_diff($ciphers_and_aliases, $ciphers);
		
		//
		// ECB MODE SHOULD BE AVOIDED
		$ciphers = array_filter( $ciphers, function($n) { return stripos($n,"ecb")===FALSE; } );
		
		//
		// AT LEAST AS EARLY AS AUG 2016, OPENSSL DECLARED THE FOLLOWING WEAK: RC2, RC4, DES, 3DES, MD5 based
		$ciphers = array_filter( $ciphers, function($c) { return stripos($c,"des")===FALSE; } );
		$ciphers = array_filter( $ciphers, function($c) { return stripos($c,"rc2")===FALSE; } );
		$ciphers = array_filter( $ciphers, function($c) { return stripos($c,"rc4")===FALSE; } );
		$ciphers = array_filter( $ciphers, function($c) { return stripos($c,"md5")===FALSE; } );
		$cipher_aliases = array_filter($cipher_aliases,function($c) { return stripos($c,"des")===FALSE; } );
		$cipher_aliases = array_filter($cipher_aliases,function($c) { return stripos($c,"rc2")===FALSE; } );
		$mergedCiphers = array_merge($ciphers,$cipher_aliases);
		
		return $mergedCiphers;
		
	}

    public function getMicroTime(){

        return $this->oLogger->returnMicroTime();

    }
	
	public function wallTime(){

		$timediff = $this->microtime_float() - $this->starttime;
		
		return substr($timediff,0,-8);
		
	}
	
	public function monitoringDeltaTimeFor($watchKey, $decimal=8){
		
		if(!isset(self::$m_starttime[$watchKey])){

			self::$m_starttime[$watchKey] = $this->microtime_float();
            $timediff = self::$m_starttime[$watchKey] - self::$m_starttime[$watchKey];

            $len = $decimal * -1;

            return substr($timediff,0, $len);

            //return 0.0;

		}else{

			$timediff = $this->microtime_float() - self::$m_starttime[$watchKey];

			$len = $decimal * -1;

            return substr($timediff,0, $len);

			//return substr($timediff,0,-8);

		}
	}
	
	//
	// SOURCE :: http://www.php.net/manual/en/function.microtime.php
	private function microtime_float(){

	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);

	}
	
	//
	// RETURN HTTP/S PATH OF CURRENT SCRIPT
	public function currentLocation(){

		if(isset($_SERVER['HTTPS'])){

			if($_SERVER['HTTPS'] && ($_SERVER['HTTPS'] != 'off')){

				self::$requestProtocol='https://';

			}else{

				if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])){

					if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ){

					    self::$requestProtocol='https://';

					}else{

						self::$requestProtocol='http://';

					}

				}else{

					self::$requestProtocol='http://';

				}
			}

		}else{

			self::$requestProtocol='http://';

		}
		
		return self::$requestProtocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	}

    //
    // METHOD SOURCE :: Stack Overflow ::  https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/1698153/scott
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function generateNewKey($len = 32, $char_selection = NULL){

        $token = "";

        if(isset($char_selection)){

            $codeAlphabet = $char_selection;

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }else{

            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            $max = strlen($codeAlphabet); // edited

            if (function_exists('random_int')) {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            } else {

                for ($i = 0; $i < $len; $i++) {

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }

        return $token;

    }

    //
    // METHOD SOURCE :: Stack Overflow :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // Contributor :: https://stackoverflow.com/users/4895359/yumoji
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    private function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function elapsedDeltaTimeFor($watchKey, $decimal = 8){

        return $this->monitoringDeltaTimeFor($watchKey, $decimal);

    }


    public function return_prettyDeltaTime($delta_secs, $microsecs=0, $mode='ELAPSED_VERBOSE'){

        $microsecs = '0.'.$microsecs;
        switch($mode){
            case 'ELAPSED':

                $tmp_output = $this->elapsed($delta_secs, $microsecs);

                break;
            case 'ELAPSED_VERBOSE':

                $tmp_output = $this->elapsed_verbose($delta_secs, $microsecs);

                break;

        }

        return $tmp_output;

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_from_current($secs){
        $ts = time();
        $delta_secs = $ts-$secs;

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => $delta_secs % 60
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $secs);
                    }

                }else{
                    $ret[] = $v . $k;
                }
            }
        }

        if(!isset($ret)){
            $ret[] = 'just now.';
        }else{
            if(sizeof($ret)==0){

                $ret[] = 'just now.';
            }else{
                $ret[] = self::$lang_content_ARRAY['AGO'];
            }
        }

        return join(' ', $ret);

    }

    private function elapsed($delta_secs, $microsecs=0){

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => ($delta_secs % 60) + $microsecs
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $delta_secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $delta_secs);
                    }

                }else{
                    $ret[] = $v . $k;
                }
            }
        }

        if(!isset($ret)){
            $ret[] = 'just now.';
        }else{
            if(sizeof($ret)==0){

                $ret[] = 'just now.';
            }else{
                $ret[] = self::$lang_content_ARRAY['AGO'];
            }
        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($delta_secs, $microsecs=0){

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => ($delta_secs % 60) + $microsecs
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        if(isset($ret)){

            array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);

            $tmp_output = trim(join(' ', $ret));

            $tmp_output = ltrim($tmp_output, 'and');

        }else{

            $tmp_output = $this->wallTime();

            $tmp_output .= ' secs';

        }

        return $tmp_output;

    }

    private function elapsed_verbose_from_current($secs){
        $ts = time();
        $delta_secs = $ts-$secs;

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $delta_secs / 31556926 % 12,
            '1'        => $delta_secs / 604800 % 52,
            '2'        => $delta_secs / 86400 % 7,
            '3'        => $delta_secs / 3600 % 24,
            '4'        => $delta_secs / 60 % 60,
            '5'        => $delta_secs % 60
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.CRNRSTN_LOG_ALL_SILO
     * @access   private
     * [EMAIL, FILE, SCREEN_TEXT, SCREEN|SCREEN_HTML, SCREEN_HTML_HIDDEN, DEFAULT]
     * LIVE WIRE
     */
    public function error_log($str, $line_num = NULL, $method = NULL, $file = NULL, $log_silo_key=NULL){

        $tmp_oLog = $this->oLogger->error_log($str, $line_num, $method, $file, $log_silo_key, $this);

        if(is_object($tmp_oLog)){

            $this->oLog_output_ARRAY[] = $tmp_oLog;

        }

        return true;

    }

    public function print_r($expression, $title=NULL, $colorScheme = NULL, $line_num = NULL, $method = NULL, $file = NULL){

        if(!isset($colorScheme)){

            if(isset($this->colorScheme)){

                $colorScheme = $this->colorScheme;

            }else{

                $this->colorScheme = CRNRSTN_PHPNIGHT;
                $colorScheme = CRNRSTN_PHPNIGHT;

            }

        }

        $tmp_meta = '['.$this->getMicroTime().' '.date('T').'] [rtime '. $this->wallTime().' secs]';

        if(!isset($method) || $method==''){

            if(isset($file)){

                $tmp_meta .= ' [file '.$file.']';

            }

        }else{

            $tmp_meta .= ' [methd '.$method.']';

        }

        if(isset($line_num)){

            $tmp_meta .= ' [lnum '.$line_num.']';

        }

        $tmp_print_r = print_r($expression, true);

        $tmp_print_r = $this->properReplace('\r\n', '\n', $tmp_print_r);
        $lines = preg_split('#\r?\n#', trim($tmp_print_r));
        $tmp_line_cnt = sizeof($lines);

        $lineHTML = implode('<br />', range(1, $tmp_line_cnt+0));
        $tmp_linecnt_html_out = '<div style="line-height:20px; position:absolute; width:25px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:25px; padding-bottom:25px; padding-left:4px;">'.$lineHTML.'</div>';

        if(isset($title) && $title != ''){

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= $title;
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }else{

            $tmp_title = '<div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div><div style="float:left; padding:5px 0 0 30px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">';
            $tmp_title .= 'Begin print_r() output by C<span style="color:#F00;">R</span>NRSTN ::';
            $tmp_title .= '</div><div style="display:block; clear:both; height:0px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>';

        }

        $tmp_hash = $this->generateNewKey(10);

        switch($colorScheme){
            case CRNRSTN_UI_PHP:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#CCC; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#CCC; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_HTML:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#FFF; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#FFF; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            case CRNRSTN_UI_PHPNIGHT:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#000; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#000; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

            break;
            default:

                $tmp_out = '
                <div id="crnrstn_print_r_output_'.$tmp_hash.'" class="crnrstn_print_r_output"  style="width:100%;">
                '.$tmp_title.'
                <div style="padding: 5px 30px 20px 25px;"><div style="position:relative; background-color:#E6E6E6; color:#DEDECB; width:100%; padding:0px; margin:0; border:3px solid #CC9900; overflow:scroll; overflow-y:hidden; font-size:14px;">
                '.$tmp_linecnt_html_out.'
                <div style="background-color:#E6E6E6; color:#DEDECB; width:3000px; padding:10px; margin-top:0; margin-left:10px; padding-left:35px; line-height:20px;">
                <code>';

                break;

        }

        echo '<div style="background-color: #FFF; padding: 10px 20px 10px 20px;">';
        echo $tmp_out;

        $output = $this->highlightText($tmp_print_r, $colorScheme);
        $output = $this->properReplace('<br />', '
', $output);

        if($output == '<span style="color: #DEDECB"></span>' || $output == '<span style="color: #000000"></span>' || $output == '<span style="color: #CC0000"></span>'){

            $output = '<span style="color: #DEDECB">&nbsp;</span>';

        }

        echo '<pre>';
        print_r($output);
        echo '</pre>';

        $component_crnrstn_title = $this->return_component_branding_creative();

        echo '</code></div></div>
        <div style="width:100%;">
            <div style="display:block; clear:both; height:4px; line-height:1px; overflow:hidden; width:100%; font-size:1px;"></div>

            '.$component_crnrstn_title.'

            <div style="float:right; max-width:88%; max-width:82%; padding:4px 0 5px 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:11px;">'.$tmp_meta.'</div>
                
            <div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>
        </div>
        </div></div>';

        echo '<div style="display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;"></div>';

    }

    public function return_component_branding_creative($strip_formatting = false, $output_mode = NULL){

        /*

        'CRNRSTN ::', 1
        'LINUX_PENGUIN', 10
        'REDHAT_BAR', 2
        'REDHAT_CIRCLE', 6
        'APACHE_POWER_2.0', 3
        'APACHE_POWER', 2
        'CRNRSTN_R', 3
        '5', 1
        'REDHAT_POWER', 8
        'MYSQL_DOLPHIN', 7
        'PHP_ELLIPSE', 7
        */

        $tmp_weighted_elements_keys_ARRAY = array();

        $output_ratio_ARRAY = array(1, 10, 2, 6, 5, 3, 1, 8, 7, 7, 6, 7, 5, 5, 5);

        $tmp_ratio_cnt = sizeof($output_ratio_ARRAY);

        for($i = 0; $i < $tmp_ratio_cnt; $i++){

            for($ii = 0; $ii < $output_ratio_ARRAY[$i]; $ii++){

                $tmp_weighted_elements_keys_ARRAY[] = self::$creativeElementsKeys[$i];

            }

        }

        $tmp_cnt = sizeof($tmp_weighted_elements_keys_ARRAY);
        $tmp_cnt--;
        $tmp_int = rand(0, $tmp_cnt);

        if($strip_formatting){

            if($tmp_int == 0){

                $creative = '<div style="padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v'.$this->version_crnrstn.'</div>';

            }else{

                $creative = '<span style="font-family: Courier New, Courier, monospace; font-size:11px;">'.$this->return_email_creative($tmp_weighted_elements_keys_ARRAY[$tmp_int]).'</span>';

            }

        }else{

            if($tmp_int == 0){

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">C<span style="color:#F00;">R</span>NRSTN :: v'.$this->version_crnrstn.'</div>';

            }else{

                $creative = '<div style="float:left; padding:4px 0 5px 5px; text-align:left; font-family: Courier New, Courier, monospace; font-size:11px;">'.$this->return_email_creative($tmp_weighted_elements_keys_ARRAY[$tmp_int]).'</div>';

            }

        }

        return $creative;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.base64-encode.php
    // AUTHOR :: luke at lukeoliff.com :: https://www.php.net/manual/en/function.base64-encode.php#105200
    public function base64_encode_image ($filename, $filetype) {

        if (is_file($filename) || (is_string($filename) && $filename != '')) {

            $imgbinary = fread(fopen($filename, "r"), $this->find_filesize($filename));

            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);

        }

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.filesize.php
    // AUTHOR :: https://www.php.net/manual/en/function.filesize.php#119435
    private function find_filesize($file){

        if(substr(PHP_OS, 0, 3) == "WIN"){

            exec('for %I in ("'.$file.'") do @echo %~zI', $output);
            $return = $output[0];

        }else{

            $return = filesize($file);

            // SOURCE :: https://www.php.net/manual/en/function.filesize.php
            // AUTHOR :: https://www.php.net/manual/en/function.filesize.php#121437
            //$fsobj = new COM("Scripting.FileSystemObject");
            //$f = $fsobj->GetFile($file);
            //$return = $f->Size;

        }

        return $return;

    }

    public function return_email_creative($creative_element_key, $image_output_mode = NULL){

        return self::$oCommRichMediaProvider->return_creative($creative_element_key, $image_output_mode);

    }

    public function catchException($exception_obj, $syslog_constant = LOG_DEBUG, $method = NULL, $namespace = NULL, $output_profile = NULL, $output_profile_override_meta = NULL, $wcr_override_pipe = NULL){

        $tmp_err_trace_str = $this->return_PHPExceptionTracePretty($exception_obj->getTraceAsString());

        if(strlen($tmp_err_trace_str)>0){

            $this->error_log('PHP native exception output log trace received ::'.$tmp_err_trace_str, __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        }

        error_log(__LINE__.' env we run env->catchException() now.');

        //
        // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER
        $this->oLogger->catchException($exception_obj, $syslog_constant, $method, $namespace, $output_profile, $output_profile_override_meta, $wcr_override_pipe, $this);

    }

    public function return_PHPExceptionTracePretty($exception_obj_trace_str, $format = 'ERROR_LOG'){

        switch($format){
            case 'HTML':

                $exception_obj_trace_str = $this->properReplace('\n', '<br>', $exception_obj_trace_str);
                $exception_obj_trace_str = $this->properReplace('
', '<br>', $exception_obj_trace_str);

                break;
            case 'TEXT':

                $exception_obj_trace_str = $this->properReplace('\n', '
', $exception_obj_trace_str);

                break;
            default:

                //
                // DO NOTHING :: STRAIGHT UNPROCESSED PHP NATIVE OUT


                break;

        }

        return $exception_obj_trace_str;

    }

    public function return_lang_content_ARRAY(){

        return self::$lang_content_ARRAY;

    }

    public function return_logPriorityPretty($logPriority, $format='TEXT'){

        $tmp_output_format = trim(strtoupper($format));

        if($tmp_output_format == 'HTML'){
            //'LOG_EMERG</span>:: system is unusable.</span>'

            switch($logPriority){
                case 0:
                    $tmp_priority_const = 'LOG_EMERG';
                    $tmp_priority_msg = ':: system is unusable.';
                    break;
                case 1:
                    $tmp_priority_const = 'LOG_ALERT';
                    $tmp_priority_msg = ':: action must be taken immediately.';
                    break;
                case 2:
                    $tmp_priority_const = 'LOG_CRIT';
                    $tmp_priority_msg = ':: critical conditions encountered.';
                    break;
                case 3:
                    $tmp_priority_const = 'LOG_ERR';
                    $tmp_priority_msg = ':: error conditions encountered.';
                    break;
                case 4:
                    $tmp_priority_const = 'LOG_WARNING';
                    $tmp_priority_msg = ':: warning conditions encountered.';
                    break;
                case 5:
                    $tmp_priority_const = 'LOG_NOTICE';
                    $tmp_priority_msg = ':: normal, but significant, condition encountered.';
                    break;
                case 6:
                    $tmp_priority_const = 'LOG_INFO';
                    $tmp_priority_msg = ':: informational message.';
                    break;
                case 7:
                    $tmp_priority_const = 'LOG_DEBUG';
                    $tmp_priority_msg = ':: debug-level message.';
                    break;
                default:
                    $tmp_priority_const = 'UNKNOWN';
                    $tmp_priority_msg = '';
                    break;
            }

            $tmp_priority = '<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#FF0000; font-weight: bold;">'.$tmp_priority_const.'</span>&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:left; color:#000; font-weight: bold;">'.$tmp_priority_msg.'</span>';

        }else{

            switch($logPriority){
                case 0:
                    $tmp_priority = 'LOG_EMERG :: system is unusable.';
                    break;
                case 1:
                    $tmp_priority = 'LOG_ALERT :: action must be taken immediately';
                    break;
                case 2:
                    $tmp_priority = 'LOG_CRIT :: critical conditions encountered';
                    break;
                case 3:
                    $tmp_priority = 'LOG_ERR :: error conditions encountered';
                    break;
                case 4:
                    $tmp_priority = 'LOG_WARNING :: warning conditions encountered';
                    break;
                case 5:
                    $tmp_priority = 'LOG_NOTICE :: normal, but significant, condition encountered';
                    break;
                case 6:
                    $tmp_priority = 'LOG_INFO :: informational message';
                    break;
                case 7:
                    $tmp_priority = 'LOG_DEBUG :: debug-level message';
                    break;
                default:
                    $tmp_priority = 'UNKNOWN';
                    break;
            }

        }

        return $tmp_priority;

    }

    public function properReplace($pattern, $replacement, $original_str){

        $pattern_array[0] = $pattern;
        $replacement_array[0] = $replacement;

        $original_str = str_replace($pattern_array, $replacement_array, $original_str);

        return $original_str;

    }

    public function tidy_boolean($val){

        if(is_bool($val) === true){

            return $val;

        }else{

            if(!isset($val)){

                return false;

            }else{

                return $this->boolean_conversion($val);

            }

        }

    }

    /**
     * Check "Booleanic" Conditions :)
     *
     * @param  [mixed]  $variable  Can be anything (string, bool, integer, etc.)
     * @return [boolean]           Returns TRUE  for "1", "true", "on" and "yes"
     *                             Returns FALSE for "0", "false", "off" and "no"
     *                             Returns NULL otherwise.
     *
     * SOURCE :: https://www.php.net/manual/en/function.is-bool.php
     * AUTHOR :: https://www.php.net/manual/en/function.is-bool.php#124179
     */
    public function boolean_conversion($variable=NULL){

        if (!isset($variable)) return null;
        return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    }

    public function stringSanitize($str, $type){

        return $this->strSanitize($str, $type);

    }

    private function strSanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        try {

            switch ($type) {
                case 'max_storage_utilization':

                    $patterns[0] = '%';
                    $patterns[1] = 'percent';
                    $patterns[2] = ' ';
                    $patterns[3] = '!';

                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';
                    $replacements[3] = '';

                    break;
                case 'email_private':
                    $tmp_new_post_at_ARRAY = array();
                    $clean_str = '';
                    $last_dot_flag = false;
                    $tmp_at_split_ARRAY = explode('@', $str);
                    $tmp_post_at_len = strlen($tmp_at_split_ARRAY[1]);
                    $tmp_str_ARRAY = $this->str_split_unicode($str);
                    $tmp_post_at_str_ARRAY = $this->str_split_unicode($tmp_at_split_ARRAY[1]);
                    $tmp_post_at_str_rev_ARRAY = array_reverse($tmp_post_at_str_ARRAY);

                    //
                    // PREP POST @ SITUATION
                    for($i=0;$i<$tmp_post_at_len;$i++){

                        if(!$last_dot_flag){
                            if($tmp_post_at_str_rev_ARRAY[$i]=='.'){
                                $last_dot_flag = true;

                            }

                            $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                            if($last_dot_flag){

                                $i = $tmp_post_at_len+420;
                                $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                            }
                        }
                    }

                    $tmp_str_len = sizeof($tmp_str_ARRAY);
                    for($i=0; $i<$tmp_str_len; $i++){
                        if($i==0){

                            $clean_str .= $tmp_str_ARRAY[$i].'*****';

                        }else{

                            if($tmp_str_ARRAY[$i] == '@'){

                                $at_flag = true;
                                $tmp_plus_one = $i+1;
                                $clean_str .= $tmp_str_ARRAY[$i].$tmp_str_ARRAY[$tmp_plus_one].'*****';
                                $clean_str .= implode($tmp_new_post_at_ARRAY);
                                $i = $tmp_str_len + 420;
                            }
                        }
                    }

                    return $clean_str;

                break;
                case 'custom_mobi_detect_alg':

                    $patterns[0] = '(';
                    $patterns[1] = ')';
                    $replacements[0] = '';
                    $replacements[1] = '';

                break;
                case 'http_protocol_simple':

                    $patterns[0] = '_';
                    $patterns[1] = '$';
                    $patterns[2] = ' ';
                    $replacements[0] = '';
                    $replacements[1] = '';
                    $replacements[2] = '';

                break;
                case 'select_statement':

                    $patterns[0] = "`";
                    $replacements[0] = '';

                break;
                case 'select_field_name':

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
                    $patterns[17] = '>';

                    $replacements = array();
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
                    $replacements[17] = '';

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine string sanitization algorithm [' . $type . '] for the content[' . $str . '].');

                break;
            }

            $str = str_replace($patterns, $replacements, $str);

            return $str;


        } catch (Exception $e) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function validate_pwdHash_LOGIN_storage($user_submitted_password, $database_result_pwdHash){

        $user_password_md5 = md5($user_submitted_password);

        if(password_verify($user_password_md5, $database_result_pwdHash)){

            return true;

        }else{

            return false;

        }

    }

    public function create_pwdHash_for_storage($user_submitted_password){

        /**
         * CONSIDER RUNNING benchmark_bestPasswordHashCost() AND THEN UPDATE
         * THIS METHOD, ACCORDINGLY FOR 'cost' => ???
         * You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. benchmark_bestPasswordHashCost() aims for ≤ 50 milliseconds
         * stretching time, which is a good baseline for systems handling interactive logins.
         */

        $options = [
            'cost' => 9,
        ];

        $user_password_md5 = md5($user_submitted_password);

        $user_password_strong_hash = password_hash($user_password_md5, PASSWORD_BCRYPT, $options);

        return $user_password_strong_hash;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.highlight-string.php#118550
    // AUTHOR :: stanislav dot eckert at vizson dot de
    /**
     * Retrieves an environmental parameter. If it doesn't exist, no exception/error is caused.
     * Simply null is returned.
     *
     * Note ::
     *
     * @param string $resourceKey The resource key.
     * @return string|null|mixed The value of the header.
     * @access   private
     */
    public function highlightText($text, $colorScheme = 'phpnight')   // [EDIT] CRNRSTN v2.0.0 FOR PHPNIGHT :: J5
    {
        $colorScheme = trim(strtolower($colorScheme));              // [EDIT] CRNRSTN v2.0.0 :: J5

        if ($colorScheme == 'php') {

            ini_set('highlight.comment', '#008000');
            ini_set('highlight.default', '#000');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#00B; font-weight: bold');
            ini_set('highlight.string', '#D00');

        } else if ($colorScheme == 'html') {

            ini_set('highlight.comment', 'green');
            ini_set('highlight.default', '#C00');
            ini_set('highlight.html', '#000');
            ini_set('highlight.keyword', 'black; font-weight: bold');
            ini_set('highlight.string', '#00F');

        } else if ($colorScheme == 'phpnight')                        // [EDIT] CRNRSTN v2.0.0 :: J5
        {
            ini_set('highlight.comment', '#FC0');
            ini_set('highlight.default', '#DEDECB');
            ini_set('highlight.html', '#808080');
            ini_set('highlight.keyword', '#8FE28F; font-weight: normal');
            ini_set('highlight.string', '#F66');

        }
        // ...

        $text = trim($text);
        $text = highlight_string("<?php " . $text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
        $text = trim($text);  // remove line breaks
        $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "

        return $text;
    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.str-split.php
    // AUTHOR :: https://www.php.net/manual/en/function.str-split.php#113274
    public function str_split_unicode($str, $length = 1) {
        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);
        if ($length > 1) {
            $chunks = array_chunk($tmp, $length);
            foreach ($chunks as $i => $chunk) {
                $chunks[$i] = join('', (array) $chunk);
            }
            $tmp = $chunks;
        }
        return $tmp;
    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_administrative_account
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Tuesday Feb 16, 2021 @ 2242hrs
#  DESCRIPTION :: Holds administrative account access credentials for CRNRSTN ::.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_administrative_account {

    protected $oLogger;
    private static $oCRNRSTN_n;

    public $email;
    public $pwdhash;
    public $ttl;

    protected $attribute_key_ARRAY = array();
    protected $attribute_datatype_ARRAY = array();
    protected $attribute_set_flag_ARRAY = array();

    public function __construct($oCRNRSTN_ENV, $email, $pwdhash, $ttl) {

        self::$oCRNRSTN_n = $oCRNRSTN_ENV;
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_n->log_silo_profile, self::$oCRNRSTN_n);

        $this->email = $email;
        $this->pwdhash = self::$oCRNRSTN_n->create_pwdHash_for_storage($pwdhash);
        $this->ttl = $ttl;

        //self::$oCRNRSTN_n->oLog_output_ARRAY[] = self::$oCRNRSTN_n->error_log('Instantiating an administrative account with email='.self::$oCRNRSTN_n->stringSanitize($this->email, 'email_private').' for the '.$this->envKey.' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_wildcard_resource
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday Sept 7, 2020 @ 1539hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_wildcard_resource {

    protected $oLogger;
    private static $oCRNRSTN_n;

    protected $envKey;
    protected $resourceKey;
    protected $attribute_key_ARRAY = array();
    protected $attribute_datatype_ARRAY = array();
    protected $attribute_set_flag_ARRAY = array();

    public function __construct($resourceKey, $oCRNRSTN) {

        // $oCRNRSTN OR $oCRNRSTN_ENV or $oCRNRSTN_USR
        self::$oCRNRSTN_n = $oCRNRSTN;
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_n->log_silo_profile, self::$oCRNRSTN_n);

        if(get_class($oCRNRSTN) != 'crnrstn'){

            $this->envKey = self::$oCRNRSTN_n->env_cleartext_name;
            //error_log('1476 ['.get_class($oCRNRSTN).']['.$this->envKey.'] - '.__CLASS__);

        }

        $this->resourceKey = $resourceKey;
        self::$oCRNRSTN_n->oLog_output_ARRAY[] = self::$oCRNRSTN_n->error_log('Instantiating a '.$resourceKey.' wild card resource for the '.$this->envKey.' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function returnResourceKey(){

        return $this->resourceKey;

    }

    public function add_attribute($attribute_key, $attribute_value){

        self::$oCRNRSTN_n->oLog_output_ARRAY[] = self::$oCRNRSTN_n->error_log('Adding ->'.$attribute_key.'<- data attribute to the '.$this->resourceKey.' wild card resource for the '.$this->envKey.' environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

        $resource_key_crc = crc32($this->resourceKey);
        $attribute_key_crc = crc32($attribute_key);

        //$this->flag_attribute_key[$resource_key_crc][$attribute_key_crc] = 1;
        $this->attribute_key_ARRAY[$resource_key_crc][$attribute_key_crc] = $attribute_value;
        $this->attribute_set_flag_ARRAY[$resource_key_crc][$attribute_key_crc] = 1;

    }

    public function isset_WCR($WCR_key, $attribute_key){

        $tmp_wc_key_crc = crc32($WCR_key);
        $attribute_key_crc = crc32($attribute_key);

        if(isset($this->attribute_set_flag_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

            return true;

        }else{

            return false;

        }

    }

    // USED IN CONTEXT OF "GET A VALUE"
    public function get_attribute($wildCardKey, $attribute_key, $SOAP_output_mode=false){

        //
        // THROWING AN EXCEPTION HERE CAN CAUSE ETERNAL LOOP.
        //try{
        $tmp_wc_key_crc = crc32($wildCardKey);
        $attribute_key_crc = crc32($attribute_key);

        if($SOAP_output_mode){

            //error_log(__LINE__.' env - ['.$wildCardKey.'] '.$attribute_key);
            $tmp_data_type = strtolower($this->getDataType($wildCardKey, $attribute_key));
            $tmp_data = $this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];
            //error_log(__LINE__.' env - ['.$tmp_data_type.'] '.$tmp_data);

            switch($tmp_data_type){
                case 'bool':
                case 'boolean':

                    if($tmp_data){

                        return 'true';

                    }else{

                        return 'false';

                    }

                break;
                default:

                    return $tmp_data;

                break;

            }


        }else{

            if(isset($this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

                return $this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('An unknown wild card resource by attribute key, "'.$attribute_key.'" and by wild card key '.$wildCardKey.' has been requested.');
                self::$oCRNRSTN_n->error_log('An unknown wild card resource by wild card key '.$wildCardKey.' and by attribute key, "'.$attribute_key.'" has been requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                return false;

            }

        }

    }

    public function getDataType($wildCardKey, $attribute_key){

        //
        // THROWING AN EXCEPTION HERE CAN CAUSE ETERNAL LOOP.
        //try{

        $tmp_wc_key_crc = crc32($wildCardKey);
        $attribute_key_crc = crc32($attribute_key);

        if(isset($this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

            if(isset($this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

                return $this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

            }else{

                $tmp_data = $this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

                $this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc] = gettype($tmp_data);

                return $this->attribute_datatype_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

            }

        }else{

            //
            // HOOOSTON...VE HAF PROBLEM!
            //throw new Exception('An unknown wild card resource by attribute key, "'.$attribute_key.'" and by wild card key '.$wildCardKey.' has been requested.');
            self::$oCRNRSTN_n->error_log('Data type for an unknown wild card resource by wild card key "'.$wildCardKey.'" and attribute key, "'.$attribute_key.'" has been requested.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

            return NULL;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_decoupled_data_object
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday November 3, 2020 @ 2035hrs
#  DESCRIPTION :: Prevent data loss by storing variable data as objects.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_decoupled_data_object {

    protected $oLogger;
    private static $oCRNRSTN_n;

    public $attribute_value_ARRAY = array();
    public $attribute_type_ARRAY = array();
    public $attribute_set_flag_ARRAY = array();
    protected $data_type_lock;
    protected $data_type;

    public $soap_encrypt_cipher;
    public $soap_encrypt_secret_key;
    public $soap_encrypt_hmac_alg;
    public $soap_encrypt_options;

    protected $soap_decrypt_cipher;
    protected $soap_decrypt_secret_key;
    protected $soap_decrypt_hmac_alg;
    protected $soap_decrypt_options;

    public function __construct($oCRNRSTN_n, $attribute_value = NULL, $attribute_key=NULL, $data_type_lock = false) {

        self::$oCRNRSTN_n = $oCRNRSTN_n;

        $this->data_type_lock = $data_type_lock;

        if($this->data_type_lock){

            $this->data_type = strtolower(gettype($attribute_value));

        }

        if(!isset($attribute_key)){

            $attribute_key = '';

        }

        if(is_bool($attribute_value) === true){

            $this->attribute_type_ARRAY[$attribute_key][] = 'bool';
            $this->attribute_set_flag_ARRAY[$attribute_key][] = 1;

        }else{

            $this->attribute_type_ARRAY[$attribute_key][] = strtolower(gettype($attribute_value));
            $this->attribute_set_flag_ARRAY[$attribute_key][] = 1;

        }

        /*
        // https://www.php.net/manual/en/function.gettype.php
        gettype()
        Possible values for the returned string are:
            "bool"
            "int"
            "double" (for historical reasons "double" is returned in case of a float, and not simply "float")
            "string"
            "array"
            "object"
            "resource"
            "resource (closed)" as of PHP 7.2.0
            "NULL"
            "unknown type"

        // https://www.php.net/manual/en/language.types.type-juggling.php#language.types.typecasting
        The casts allowed are:
            (int), (integer) - cast to int
            (bool), (boolean) - cast to bool
            (float), (double), (real) - cast to float
            (string) - cast to string
            (array) - cast to array
            (object) - cast to object
            (unset) - cast to NULL. The (unset) cast has been deprecated as
                of PHP 7.2.0. Note that the (unset) cast is the same as
                assigning the value NULL to the variable or call. The (unset)
                cast is removed as of PHP 8.0.0.
         * */

        switch($this->attribute_type_ARRAY[$attribute_key]){
            case 'int':

                $this->attribute_value_ARRAY[$attribute_key][] = (int) $attribute_value;

            break;
            case 'integer':

                $this->attribute_value_ARRAY[$attribute_key][] = (integer) $attribute_value;

            break;
            case 'bool':
            case 'boolean':

                if($attribute_value){

                    $this->attribute_value_ARRAY[$attribute_key][] = 'true';

                }else{

                    $this->attribute_value_ARRAY[$attribute_key][] = 'false';

                }

            break;
            case 'double':

                $this->attribute_value_ARRAY[$attribute_key][] = (double) $attribute_value;

            break;
            case 'float':

                $this->attribute_value_ARRAY[$attribute_key][] = (float) $attribute_value;

            break;
            case 'string':

                $this->attribute_value_ARRAY[$attribute_key][] = (string) $attribute_value;

            break;
            case 'array':

                $this->attribute_value_ARRAY[$attribute_key][] = (array) $attribute_value;

            break;
            case 'object':

                $this->attribute_value_ARRAY[$attribute_key][] = (object) $attribute_value;

            break;
            case 'resource':

                $this->attribute_value_ARRAY[$attribute_key][] = $attribute_value;

            break;
            case 'resource (closed)':

                $this->attribute_value_ARRAY[$attribute_key][] = $attribute_value;

            break;
            case 'null':

                $this->attribute_value_ARRAY[$attribute_key][] = NULL;

            break;
            case 'unknown type':

                $this->attribute_value_ARRAY[$attribute_key][] = $attribute_value;

            break;
            default:

                $this->attribute_value_ARRAY[$attribute_key][] =  $attribute_value;

            break;

        }

        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_n->log_silo_profile, self::$oCRNRSTN_n);

        //$oCRNRSTN->oLog_output_ARRAY[] = $oCRNRSTN_n->error_log('Instantiating logging output profile manager within this environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function getCount($attribute_key){

        $tmp_cnt = sizeof($this->attribute_value_ARRAY[$attribute_key]);

        return $tmp_cnt;

    }

    public function preach($data_attribute = 'value', $attribute_key = NULL, $soap_transport=false, $iterator = 0){

        if(!isset($attribute_key)){

            $attribute_key = '';

        }

        switch($data_attribute){
            case 'isset':

                if(isset($this->attribute_set_flag_ARRAY[$attribute_key][$iterator])){

                    return $this->attribute_set_flag_ARRAY[$attribute_key][$iterator];

                }else{

                    return false;

                }

            break;
            case 'type':

                return $this->attribute_type_ARRAY[$attribute_key][$iterator];

            break;
            case 'value':

                if(isset($this->attribute_value_ARRAY[$attribute_key][$iterator]) || $this->attribute_value_ARRAY[$attribute_key][$iterator] == ''){

                    switch($this->attribute_type_ARRAY[$attribute_key][$iterator]){
                        case 'int':

                            return (int) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'integer':

                            return (integer) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'bool':

                            if($soap_transport){

                                return $this->attribute_value_ARRAY[$attribute_key][$iterator];

                            }else{

                                return $this->boolean_conversion($this->attribute_value_ARRAY[$attribute_key][$iterator]);

                            }

                        break;
                        case 'boolean':

                            if($soap_transport){

                                return $this->attribute_value_ARRAY[$attribute_key][$iterator];

                            }else{

                                return $this->boolean_conversion($this->attribute_value_ARRAY[$attribute_key][$iterator]);

                            }

                        break;
                        case 'float':

                            return (float) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'double':

                            return (double) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'real':

                            return (float) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'string':

                            return (string) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'array':

                            return (array) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'object':

                            return (object) $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;
                        case 'NULL':

                            return NULL;

                        break;
                        default:
                            //error_log(__LINE__.' env - RETURN DEFAULT ['.$attribute_key.']');
                            return $this->attribute_value_ARRAY[$attribute_key][$iterator];

                        break;

                    }

                }else{

                    // BOOLEAN FALSE WILL RETURN (string) 'false'
                    //error_log(__LINE__.' env - return false... NOT SET ['.$attribute_key.']');
                    return false;

                }

            break;
            default:
                //error_log(__LINE__.' env - RETURN DEFAULT VALUE ['.$attribute_key.']');
                return $this->attribute_value_ARRAY[$attribute_key][$iterator];

            break;

        }

    }

    /**
     * Check "Booleanic" Conditions :)
     *
     * @param  [mixed]  $variable  Can be anything (string, bol, integer, etc.)
     * @return [boolean]           Returns TRUE  for "1", "true", "on" and "yes"
     *                             Returns FALSE for "0", "false", "off" and "no"
     *                             Returns NULL otherwise.
     *
     * SOURCE :: https://www.php.net/manual/en/function.is-bool.php
     * AUTHOR :: https://www.php.net/manual/en/function.is-bool.php#124179
     */
    public function boolean_conversion($variable=NULL, $attribute_key=NULL){

        if(!isset($attribute_key)){

            $attribute_key = '';

        }

        if(isset($variable)){

            if (!isset($variable)) return null;
            return filter_var($variable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        }else{

            if (!isset($this->attribute_value)) return null;
            return filter_var($this->attribute_value_ARRAY[$attribute_key], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        }

    }

    public function add($attribute_value, $attribute_key=NULL){

        //error_log(__LINE__.' env - add() '.$attribute_key.'['.strtolower(gettype($attribute_value)).']');
        if(!isset($attribute_key)){

            $attribute_key = '';

        }

        if(!isset($this->data_type)) {

            $data_type = strtolower(gettype($attribute_value));
            $this->attribute_type_ARRAY[$attribute_key][] = strtolower(gettype($attribute_value));
            $this->attribute_set_flag_ARRAY[$attribute_key][] = 1;

        }else{

            $data_type = $this->data_type;
            $this->attribute_type_ARRAY[$attribute_key][] = $this->data_type;
            $this->attribute_set_flag_ARRAY[$attribute_key][] = 1;

        }

        switch($data_type){
            case 'int':

                $this->attribute_value_ARRAY[$attribute_key][] = (int) $attribute_value;

            break;
            case 'integer':

                $this->attribute_value_ARRAY[$attribute_key][] = (integer) $attribute_value;

            break;
            case 'bool':
            case 'boolean':

                // strings 'true' or 'false'
                if(is_bool($attribute_value) === true){

                    if($attribute_value){
                        //error_log(__LINE__.' env - BOOL['.$attribute_key.']['.$attribute_value.']true');

                        $this->attribute_value_ARRAY[$attribute_key][] = 'true';

                    }else{
                        //error_log(__LINE__.' env - BOOL['.$attribute_key.']['.$attribute_value.']false');

                        $this->attribute_value_ARRAY[$attribute_key][] = 'false';

                    }

                }else{

                    if(boolval($attribute_value)){
                        //error_log(__LINE__.' env - BOOL['.$attribute_key.']['.$attribute_value.']true');

                        $this->attribute_value_ARRAY[$attribute_key][] = 'true';

                    }else{
                        //error_log(__LINE__.' env - BOOL['.$attribute_key.']['.$attribute_value.']false');

                        $this->attribute_value_ARRAY[$attribute_key][] = 'false';

                    }

                }

            break;
            case 'double':

                $this->attribute_value_ARRAY[$attribute_key][] = (double) $attribute_value;

            break;
            case 'string':

                $this->attribute_value_ARRAY[$attribute_key][] = (string) $attribute_value;

            break;
            case 'array':

                $this->attribute_value_ARRAY[$attribute_key][] = (array) $attribute_value;

            break;
            case 'object':

                $this->attribute_value_ARRAY[$attribute_key][] = (object) $attribute_value;

            break;
            case 'resource':

                $this->attribute_value_ARRAY[$attribute_key][] = $attribute_value;

            break;
            case 'resource (closed)':

                $this->attribute_value_ARRAY[$attribute_key][] = $attribute_value;

            break;
            case 'null':

                $this->attribute_value_ARRAY[$attribute_key][] = NULL;

            break;
            case 'unknown type':

                $this->attribute_value_ARRAY[$attribute_key][] = $attribute_value;

            break;
            default:

                $this->attribute_value_ARRAY[$attribute_key][] =  $attribute_value;

            break;

        }

    }

    public function generate_SOAP_request_object($method, $SOAP_response = NULL){

        switch($method){
            case 'tunnelEncryptCalibrationRequest':

                $tmp_SOAP_ENCRYPT_CIPHER = $this->preach('value', 'SOAP_ENCRYPT_CIPHER');
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->preach('value', 'SOAP_ENCRYPT_OPTIONS');
                $this->soap_encrypt_secret_key = self::$oCRNRSTN_n->generateNewKey(42);

                $SOAP_request_ARRAY = array();
                $SOAP_request = array('oTunnelEncryptionCalibrationRequest' =>
                    array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'FALSE',
                        'SERVER_NAME_SOAP_CLIENT' => $_SERVER['SERVER_NAME'],
                        'SERVER_ADDRESS_SOAP_CLIENT' => $_SERVER['SERVER_ADDR'],
                        'SOAP_ENCRYPT_CIPHER' => $tmp_SOAP_ENCRYPT_CIPHER,
                        'SOAP_ENCRYPT_SECRET_KEY' => $this->soap_encrypt_secret_key,
                        'SOAP_ENCRYPT_HMAC_ALG' => $tmp_SOAP_ENCRYPT_HMAC_ALG,
                        'SOAP_ENCRYPT_OPTIONS' => $tmp_SOAP_ENCRYPT_OPTIONS

                    ));

                $SOAP_request_ARRAY[] = $SOAP_request;

            break;
            case 'mayItakeTheKingsHighway':

                $tmp_SOAP_ENCRYPT_CIPHER = $this->preach('value', 'SOAP_ENCRYPT_CIPHER');
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->soap_encrypt_secret_key;
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                //error_log(__LINE__.' env - mayItakeTheKingsHighway RESPONSE DECRYPT = ['.$tmp_SOAP_ENCRYPT_CIPHER.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG.']['.$tmp_SOAP_ENCRYPT_OPTIONS.']');
                $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                //error_log(__LINE__.' env - mayItakeTheKingsHighway RESPONSE DECRYPT tmp_SOAP_SERVICES_AUTH_STATUS = ['.$tmp_SOAP_SERVICES_AUTH_STATUS.'][');

                $tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_STATUS_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_ISERROR_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                $tmp_SOAP_ENCRYPT_CIPHER = $tmp_SOAP_ENCRYPT_CIPHER_resp;
                $this->soap_encrypt_secret_key = $this->preach('value', 'SOAP_ENCRYPT_SECRET_KEY_ENVIRONMENT');
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                $tmp_SOAP_ENCRYPT_OPTIONS = $tmp_SOAP_ENCRYPT_OPTIONS_resp;

                //error_log(__LINE__.' env - oKingsHighwayAuthRequest ENCRYPT USERNAME ['.$tmp_SOAP_ENCRYPT_CIPHER.']['.$this->soap_encrypt_secret_key.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG.']['.$tmp_SOAP_ENCRYPT_OPTIONS.']');
                $SOAP_request_ARRAY = array();
                $SOAP_request = array('oKingsHighwayAuthRequest' =>
                    array(
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_AUTH_KEY'), $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'CRNRSTN_SOAP_SVC_USERNAME' => self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_USERNAME'), $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'CRNRSTN_SOAP_SVC_PASSWORD' => self::$oCRNRSTN_n->paramTunnelEncrypt(self::$oCRNRSTN_n->create_pwdHash_for_storage(md5($this->preach('value', 'CRNRSTN_SOAP_SVC_PASSWORD'))), $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => self::$oCRNRSTN_n->paramTunnelEncrypt('EMAIL', $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => self::$oCRNRSTN_n->paramTunnelEncrypt('mayItakeTheKingsHighway|takeTheKingsHighway', $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'CRNRSTN_SOAP_ACTION_TYPE' => self::$oCRNRSTN_n->paramTunnelEncrypt('EXCEPTION_NOTIFICATION', $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'SERVER_NAME_SOAP_CLIENT' => self::$oCRNRSTN_n->paramTunnelEncrypt($_SERVER['SERVER_NAME'], $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS),
                        'SERVER_ADDRESS_SOAP_CLIENT' => self::$oCRNRSTN_n->paramTunnelEncrypt($_SERVER['SERVER_ADDR'], $tmp_SOAP_ENCRYPT_CIPHER, $this->soap_encrypt_secret_key, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS)

                    ));

                $SOAP_request_ARRAY[] = $SOAP_request;

            break;
            case 'takeTheKingsHighway':

                //self::$oCRNRSTN_n->print_r('takeTheKingsHighway', 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY ::', NULL,  __LINE__, __METHOD__, __FILE__);

                $tmp_SOAP_ENCRYPT_CIPHER = $this->soap_encrypt_cipher;
                $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->preach('value', 'SOAP_ENCRYPT_SECRET_KEY_ENVIRONMENT');
                $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->soap_encrypt_hmac_alg;
                $tmp_SOAP_ENCRYPT_OPTIONS = $this->soap_encrypt_options;

                $tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_CRNRSTN_SOAP_SVC_USERNAME = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['CRNRSTN_SOAP_SVC_USERNAME'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                $tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_SECRET_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                $tmp_STATUS_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_ISERROR_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SERVER_NAME_SOAP_CLIENT = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SERVER_NAME_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                $tmp_SERVER_ADDRESS_SOAP_CLIENT = self::$oCRNRSTN_n->paramTunnelDecrypt($SOAP_response['SERVER_ADDRESS_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE.' :: '.$tmp_ISERROR_MESSAGE, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY ::', NULL, __LINE__, __METHOD__, __FILE__);

                $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->preach('value', 'SOAP_ENCRYPT_SECRET_KEY_CONNECTION');

                if($tmp_SOAP_ENCRYPT_SECRET_KEY_resp == ''){

                    //
                    // IF CLIENT HAS NO PERSONAL SECRET KEY...ATTEMPT TO FALL BACK ON ENVIRONMENT SECRET KEY.
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = $this->soap_encrypt_cipher;
                    $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->preach('value', 'SOAP_ENCRYPT_SECRET_KEY_ENVIRONMENT');
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = $this->soap_encrypt_hmac_alg;
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = $this->soap_encrypt_options;

                }

                error_log(__LINE__.' env - CLIENT ENCRYPT SENDING VIA -->'.$tmp_SOAP_ENCRYPT_CIPHER.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG.']['.$tmp_SOAP_ENCRYPT_OPTIONS.']');

                $SOAP_request_ARRAY = array();

                $tmp_recipient_email_cnt = $this->getCount('RECIPIENT_EMAIL');
                for($i=0; $i<$tmp_recipient_email_cnt; $i++){

                    $tmp_curr = 1 + $i;
                    error_log(__LINE__.' CLIENT - PROXY email '.$i.'.');

                    $SOAP_request = array('oKingsHighwayNotification' =>
                        array(
                            'CRNRSTN_PACKET_IS_ENCRYPTED' => 'TRUE',
                            'CRNRSTN_SOAP_ACTION_TYPE' => self::$oCRNRSTN_n->paramTunnelEncrypt('EXCEPTION_NOTIFICATION', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => self::$oCRNRSTN_n->paramTunnelEncrypt('mayItakeTheKingsHighway|takeTheKingsHighway', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'SERVER_NAME_SOAP_CLIENT' => self::$oCRNRSTN_n->paramTunnelEncrypt($_SERVER['SERVER_NAME'], $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'SERVER_ADDRESS_SOAP_CLIENT' => self::$oCRNRSTN_n->paramTunnelEncrypt($_SERVER['SERVER_ADDR'], $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp),
                            'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => self::$oCRNRSTN_n->paramTunnelEncrypt('EMAIL', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)

                        ));

                    self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST ASSEMBLY TEST ('.$tmp_curr.' of '.$tmp_recipient_email_cnt.'[tmp_recipient_email_cnt]) - KING\'S HIGHWAY ::', NULL,  __LINE__, __METHOD__, __FILE__);

                    if($this->preach('isset', 'CRNRSTN_SOAP_SVC_AUTH_KEY')){

                        error_log(__LINE__.' env - encrypt CRNRSTN_SOAP_SVC_AUTH_KEY for oKingsHighwayNotification ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');
                        $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_AUTH_KEY'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_AUTH_KEY', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'CRNRSTN_SOAP_SVC_USERNAME')){

                        error_log(__LINE__.' env - encrypt username for oKingsHighwayNotification ['.$tmp_SOAP_ENCRYPT_CIPHER.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG.']['.$tmp_SOAP_ENCRYPT_OPTIONS.']');
                        $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_USERNAME'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CRNRSTN_SOAP_SVC_USERNAME', true), $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    }

                    if($this->preach('isset', 'CRNRSTN_SOAP_SVC_PASSWORD')){

                        $SOAP_request['oKingsHighwayNotification']['CRNRSTN_SOAP_SVC_PASSWORD'] = self::$oCRNRSTN_n->paramTunnelEncrypt(self::$oCRNRSTN_n->create_pwdHash_for_storage(md5($this->preach('value', 'CRNRSTN_SOAP_SVC_PASSWORD', true))), $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    }

                    if($this->preach('isset', 'EMAIL_PROTOCOL')){

                        error_log(__LINE__.' env - EMAIL_PROTOCOL');

                        $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'EMAIL_PROTOCOL', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'EMAIL_PROTOCOL', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'EMAIL_PROTOCOL', true));
                        $SOAP_request['oKingsHighwayNotification']['EMAIL_PROTOCOL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_AUTH')){

                        error_log(__LINE__.' env - SMTP_AUTH');

                        $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_AUTH', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_AUTH', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_AUTH', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_AUTH']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_SERVER')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_SERVER', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_SERVER', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_SERVER', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_SERVER']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_PORT_OUTGOING')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_PORT_OUTGOING', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_PORT_OUTGOING', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_PORT_OUTGOING', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_PORT_OUTGOING']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_USERNAME')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_USERNAME', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_USERNAME', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_USERNAME', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_USERNAME']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_PASSWORD')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_PASSWORD', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_PASSWORD', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_PASSWORD', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_PASSWORD']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_KEEPALIVE')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_KEEPALIVE', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_KEEPALIVE', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_KEEPALIVE', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_KEEPALIVE']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_SECURE')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_SECURE', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_SECURE', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_SECURE', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_SECURE']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_AUTOTLS')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_AUTOTLS', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_AUTOTLS', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_AUTOTLS', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_AUTOTLS']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'SMTP_TIMEOUT')){

                        $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'SMTP_TIMEOUT', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'SMTP_TIMEOUT', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'SMTP_TIMEOUT', true));
                        $SOAP_request['oKingsHighwayNotification']['SMTP_TIMEOUT']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'DIBYA_SAHOO_SSL_CERT_BYPASS')){

                        $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'DIBYA_SAHOO_SSL_CERT_BYPASS', true));
                        $SOAP_request['oKingsHighwayNotification']['DIBYA_SAHOO_SSL_CERT_BYPASS']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'DUP_SUPPRESS')){

                        $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'DUP_SUPPRESS', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'DUP_SUPPRESS', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'DUP_SUPPRESS', true));
                        $SOAP_request['oKingsHighwayNotification']['DUP_SUPPRESS']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'CHARSET')){

                        $SOAP_request['oKingsHighwayNotification']['CHARSET']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CHARSET', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['CHARSET']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'CHARSET', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'CHARSET', true));
                        $SOAP_request['oKingsHighwayNotification']['CHARSET']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'MESSAGE_ENCODING')){

                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'MESSAGE_ENCODING', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'MESSAGE_ENCODING', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'MESSAGE_ENCODING', true));
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_ENCODING']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'ALLOW_EMPTY')){

                        $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'ALLOW_EMPTY', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'ALLOW_EMPTY', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'ALLOW_EMPTY', true));
                        $SOAP_request['oKingsHighwayNotification']['ALLOW_EMPTY']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'TRY_OTHER_EMAIL_METHODS_ON_ERR')){

                        $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'TRY_OTHER_EMAIL_METHODS_ON_ERR', true));
                        error_log(__LINE__.' env - TRY_OTHER_EMAIL_METHODS_ON_ERR['.$tmp_len.']');

                        $SOAP_request['oKingsHighwayNotification']['TRY_OTHER_EMAIL_METHODS_ON_ERR']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }
                    /*
                     $server->wsdl->addComplexType(
                        'oEmailArray',
                        'complexType',
                        'array',
                        '',
                        'SOAP-ENC:Array',
                        array(),
                        array(
                            array(
                                'ref' => 'SOAP-ENC:arrayType',
                                'wsdl:arrayType' => 'tns:oEmail[]'
                            )
                        ),
                        'tns:oEmail'
                    );

                    $server->wsdl->addComplexType(
                        'oEmail',
                        'complexType',
                        'struct',
                        'all',
                        '',
                        array(
                            'EMAIL_PROXY_SERIAL' => array( 'name' => 'EMAIL_PROXY_SERIAL',  'type' => 'tns:oSOAP_Data' ),
                            'EMAIL' => array( 'name' => 'EMAIL',  'type' => 'tns:oSOAP_Data' ),
                            'NAME' => array( 'name' => 'NAME',  'type' => 'tns:oSOAP_Data' ),
                            'FIRSTNAME' => array( 'name' => 'FIRSTNAME',  'type' => 'tns:oSOAP_Data' ),
                            'LASTNAME' => array( 'name' => 'LASTNAME',  'type' => 'tns:oSOAP_Data' )
                        )
                    );

                    $server->wsdl->addComplexType(
                        'oSOAP_Data',
                        'complexType',
                        'struct',
                        'all',
                        '',
                        array(
                            'CONTENT' => array( 'name' => 'CONTENT',  'type' => 'xsd:string' ),
                            'TYPE' => array( 'name' => 'TYPE',  'type' => 'xsd:string' ),
                            'LENGTH' => array( 'name' => 'LENGTH',  'type' => 'xsd:string' )
                        )
                    );

                    'oSENDER' => array( 'name' => 'oSENDER',  'type' => 'tns:oEmailArray' ),
                    'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
                    'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
                    'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),

                    REPLYTO_EMAIL
                    REPLYTO_NAME

                    CC_EMAIL
                    CC_NAME

                    BCC_EMAIL
                    BCC_NAME

                    FROM_EMAIL
                    FROM_NAME
                     * */

                    // 'oRECIPIENT' => array( 'name' => 'oRECIPIENT',  'type' => 'tns:oEmailArray' ),
                    if($this->preach('isset', 'RECIPIENT_EMAIL', $i)){

                        $tmp_md5_email = md5($this->preach('value', 'RECIPIENT_EMAIL', true, $i));
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_md5_email, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($tmp_md5_email), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL_PROXY_SERIAL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt('string', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'RECIPIENT_EMAIL', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'RECIPIENT_EMAIL', true, $i)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['EMAIL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'RECIPIENT_EMAIL', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'RECIPIENT_NAME', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'RECIPIENT_NAME', true, $i)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['oRECIPIENT'][$i]['NAME']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'RECIPIENT_NAME', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);


                    }

                    // 'oSENDER' => array( 'name' => 'oSENDER',  'type' => 'tns:oEmailArray' ),
                    if($this->preach('isset', 'FROM_EMAIL')){

                        $tmp_cnt = $this->getCount('FROM_EMAIL');

                        for($ii=0; $ii<$tmp_cnt; $ii++){

                            $tmp_md5_email = md5($this->preach('value', 'FROM_EMAIL', true, $ii));
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_md5_email, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($tmp_md5_email), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt('string', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'FROM_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'FROM_EMAIL', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['EMAIL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'FROM_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'FROM_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'FROM_NAME', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oSENDER'][$ii]['NAME']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'FROM_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }

                    // 'oREPLYTO' => array('name' => 'oREPLYTO', 'type' => 'tns:oEmailArray' ),
                    if($this->preach('isset', 'REPLYTO_EMAIL')){

                        $tmp_cnt = $this->getCount('REPLYTO_EMAIL');

                        for($ii=0; $ii<$tmp_cnt; $ii++){

                            $tmp_md5_email = md5($this->preach('value', 'REPLYTO_EMAIL', true, $ii));
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_md5_email, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($tmp_md5_email), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt('string', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'REPLYTO_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'REPLYTO_EMAIL', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['EMAIL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'REPLYTO_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'REPLYTO_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'REPLYTO_NAME', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oREPLYTO'][$ii]['NAME']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'REPLYTO_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }

                    // 'oCC' => array('name' => 'oCC', 'type' => 'tns:oEmailArray' ),
                    if($this->preach('isset', 'CC_EMAIL')){

                        $tmp_cnt = $this->getCount('CC_EMAIL');

                        for($ii=0; $ii<$tmp_cnt; $ii++){

                            $tmp_md5_email = md5($this->preach('value', 'CC_EMAIL', true, $ii));
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_md5_email, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($tmp_md5_email), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt('string', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CC_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'CC_EMAIL', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['EMAIL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'CC_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'CC_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'CC_NAME', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oCC'][$ii]['NAME']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'CC_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }

                    // 'oBCC' => array('name' => 'oBCC', 'type' => 'tns:oEmailArray' ),
                    if($this->preach('isset', 'BCC_EMAIL')){

                        $tmp_cnt = $this->getCount('BCC_EMAIL');

                        for($ii=0; $ii<$tmp_cnt; $ii++){

                            $tmp_md5_email = md5($this->preach('value', 'BCC_EMAIL', true, $ii));
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_md5_email, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($tmp_md5_email), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL_PROXY_SERIAL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt('string', $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'BCC_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'BCC_EMAIL', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['EMAIL']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'BCC_EMAIL', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'BCC_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt(strlen($this->preach('value', 'BCC_NAME', true, $ii)), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            $SOAP_request['oKingsHighwayNotification']['oBCC'][$ii]['NAME']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'BCC_NAME', true, $ii), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        }

                    }

                    if($this->preach('isset', 'MESSAGE_SUBJECT', $i)){

                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'MESSAGE_SUBJECT', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'MESSAGE_SUBJECT', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'MESSAGE_SUBJECT', true, $i));
                        //error_log(__LINE__.' env - MESSAGE_SUBJECT['.$tmp_len.'] ['.$this->preach('value', 'MESSAGE_SUBJECT', true, $i).']');

                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_SUBJECT']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'MESSAGE_BODY_HTML', $i)){

                        //error_log($this->getCount('MESSAGE_BODY_HTML').' CLIENT BUILD REQUEST - MESSAGE_BODY_HTML string count ::');
                        //error_log(__LINE__.' CLIENT - HTML ENCRYPT LEN='.strlen(self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp)));

                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp); // self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'MESSAGE_BODY_HTML', true), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'MESSAGE_BODY_HTML', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'MESSAGE_BODY_HTML', true, $i));
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_HTML']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    if($this->preach('isset', 'MESSAGE_BODY_TEXT', $i)){

                        //error_log($this->getCount('MESSAGE_BODY_TEXT').' CLIENT BUILD REQUEST - MESSAGE_BODY_TEXT string count['.$i.']='.strlen($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i)).' ::');

                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['CONTENT'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['TYPE'] = self::$oCRNRSTN_n->paramTunnelEncrypt($this->preach('type', 'MESSAGE_BODY_TEXT', true, $i), $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                        $tmp_len = strlen($this->preach('value', 'MESSAGE_BODY_TEXT', true, $i));
                        $SOAP_request['oKingsHighwayNotification']['MESSAGE_BODY_TEXT']['LENGTH'] = self::$oCRNRSTN_n->paramTunnelEncrypt($tmp_len, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);

                    }

                    $SOAP_request_ARRAY[] = $SOAP_request;

                }

                break;

        }

        return $SOAP_request_ARRAY;

    }

    public function set_decryption_profile($SOAP_ENCRYPT_CIPHER, $SOAP_ENCRYPT_SECRET_KEY, $SOAP_ENCRYPT_HMAC_ALG, $SOAP_ENCRYPT_OPTIONS){

        $this->soap_encrypt_cipher = $SOAP_ENCRYPT_CIPHER;
        $this->soap_encrypt_secret_key = $SOAP_ENCRYPT_SECRET_KEY;
        $this->soap_encrypt_hmac_alg = $SOAP_ENCRYPT_HMAC_ALG;
        $this->soap_encrypt_options = $SOAP_ENCRYPT_OPTIONS;

        $this->soap_decrypt_cipher = $SOAP_ENCRYPT_CIPHER;
        $this->soap_decrypt_secret_key = $SOAP_ENCRYPT_SECRET_KEY;
        $this->soap_decrypt_hmac_alg = $SOAP_ENCRYPT_HMAC_ALG;
        $this->soap_decrypt_options = $SOAP_ENCRYPT_OPTIONS;

    }

    public function consume_SOAP_data_object($soap_data_object, $object_name, $object_type){

        switch($object_type){
            case 'tns:oSOAP_Data':

                //error_log(__LINE__.' SERVER - decrypting '.$object_name.' data as tyep='.$object_type);
                //error_log(__LINE__.' SERVER ['.$soap_data_object['CONTENT'].']['.$soap_data_object['TYPE'].']['.$soap_data_object['LENGTH'].']');
                //error_log(__LINE__.' SERVER - ENCRYPT profile['.$this->soap_encrypt_cipher.']['.$this->soap_encrypt_secret_key.']['.$this->soap_encrypt_hmac_alg.']['.$this->soap_encrypt_options.']');
                error_log(__LINE__.' SERVER - '.$object_name.' | '.$object_type);
                ///error_log(__LINE__.' SERVER - DECRYPT [TYPE='.gettype($soap_data_object['CONTENT']).']['.$soap_data_object['CONTENT'].'] profile['.$this->soap_decrypt_cipher.']['.$this->soap_decrypt_secret_key.']['.$this->soap_decrypt_hmac_alg.']['.$this->soap_decrypt_options.']');

                //
                // DECRYPT SOAP OBJECT DATA
                $tmp_content = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object['CONTENT'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                $tmp_type = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object['TYPE'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                $tmp_len = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object['LENGTH'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                error_log(__LINE__.' SERVER - ['.$object_name.']['.$tmp_len.'!='.strlen($tmp_content).']['.$tmp_type.']');
                if((int)$tmp_len != strlen($tmp_content)){

                    //
                    // DATA CORRUPTION. TERMINATE.
                    error_log(__LINE__.' SERVER - DATA CORRUPTION['.$object_name.']['.$object_type.']. TERMINATE. Content['.$tmp_content.'|['.$tmp_type.']] of len['.strlen($tmp_content).'] !=SOAP len['.$tmp_len.']');
                    return false;

                }else{

                    //
                    // CONSUME SOAP STRING DATA INTO DTL WITH TYPE RECOGNITION.
                    return $this->injest_SOAP_request_param($tmp_content, $tmp_type, $object_name);

                }

            break;
            case 'tns:oEmailArray':

                $tmp_obj_cnt = sizeof($soap_data_object);

                switch($object_name){
                    case 'oRECIPIENT':

                        $tmp_email_nom = 'RECIPIENT_EMAIL';
                        $tmp_name_nom = 'RECIPIENT_NAME';

                    break;
                    case 'oSENDER':

                        $tmp_email_nom = 'FROM_EMAIL';
                        $tmp_name_nom = 'FROM_NAME';

                    break;
                    case 'oREPLYTO':

                        $tmp_email_nom = 'REPLYTO_EMAIL';
                        $tmp_name_nom = 'REPLYTO_NAME';

                    break;
                    case 'oCC':

                        $tmp_email_nom = 'CC_EMAIL';
                        $tmp_name_nom = 'CC_NAME';

                    break;
                    case 'oBCC':

                        error_log(__LINE__);
                        $tmp_email_nom = 'BCC_EMAIL';
                        $tmp_name_nom = 'BCC_NAME';

                    break;

                }

                for($i=0; $i<$tmp_obj_cnt; $i++){

                    //
                    // DECRYPT SOAP OBJECT DATA
                    $tmp_EMAIL_PROXY_SERIAL_content = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['CONTENT'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_EMAIL_PROXY_SERIAL_type = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['TYPE'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_EMAIL_PROXY_SERIAL_len = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['EMAIL_PROXY_SERIAL']['LENGTH'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                    //
                    // DECRYPT SOAP OBJECT DATA
                    $tmp_EMAIL_content = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['EMAIL']['CONTENT'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_EMAIL_type = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['EMAIL']['TYPE'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_EMAIL_len = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['EMAIL']['LENGTH'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                    //
                    // DECRYPT SOAP OBJECT DATA
                    $tmp_NAME_content = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['NAME']['CONTENT'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_NAME_type = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['NAME']['TYPE'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);
                    $tmp_NAME_len = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object[$i]['NAME']['LENGTH'], true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                    if((int)$tmp_EMAIL_PROXY_SERIAL_len != strlen($tmp_EMAIL_PROXY_SERIAL_content)){

                        //
                        // DATA CORRUPTION. TERMINATE.
                        error_log(__LINE__.' SERVER - DATA CORRUPTION['.$object_name.']['.$object_type.']. TERMINATE. Content['.$tmp_EMAIL_PROXY_SERIAL_content.'|['.$tmp_EMAIL_PROXY_SERIAL_type.']] of len['.strlen($tmp_EMAIL_PROXY_SERIAL_content).'] !=SOAP len['.$tmp_EMAIL_PROXY_SERIAL_len.']');
                        return false;

                    }else{

                        if((int)$tmp_EMAIL_len != strlen($tmp_EMAIL_content)){

                            //
                            // DATA CORRUPTION. TERMINATE.
                            error_log(__LINE__.' SERVER - DATA CORRUPTION['.$object_name.']['.$object_type.']. TERMINATE. Content['.$tmp_EMAIL_content.'|['.$tmp_EMAIL_type.']] of len['.strlen($tmp_EMAIL_content).'] !=SOAP len['.$tmp_EMAIL_len.']');
                            return false;

                        }else{

                            if((int)$tmp_NAME_len != strlen($tmp_NAME_content)){

                                //
                                // DATA CORRUPTION. TERMINATE.
                                error_log(__LINE__.' SERVER - DATA CORRUPTION['.$object_name.']['.$object_type.']. TERMINATE. Content['.$tmp_NAME_content.'|['.$tmp_NAME_type.']] of len['.strlen($tmp_NAME_content).'] !=SOAP len['.$tmp_NAME_len.']');
                                return false;

                            }else{

                                //
                                // CONSUME SOAP STRING DATA INTO DTL WITH TYPE RECOGNITION.
                                $this->injest_SOAP_request_param($tmp_EMAIL_PROXY_SERIAL_content, $tmp_EMAIL_PROXY_SERIAL_type, 'EMAIL_PROXY_SERIAL');
                                $this->injest_SOAP_request_param($tmp_NAME_content, $tmp_NAME_type, $tmp_name_nom);

                                return $this->injest_SOAP_request_param($tmp_EMAIL_content, $tmp_EMAIL_type, $tmp_email_nom);

                            }

                        }

                    }

                }

            break;
            case 'xsd:string':

                $tmp_content = self::$oCRNRSTN_n->paramTunnelDecrypt($soap_data_object, true, $this->soap_decrypt_cipher, $this->soap_decrypt_secret_key, $this->soap_decrypt_hmac_alg, $this->soap_decrypt_options);

                return $this->injest_SOAP_request_param($tmp_content, 'string', $object_name);

            break;

        }

        return true;

    }

    private function injest_SOAP_request_param($content, $type, $object_name){

        error_log(__LINE__.' SERVER ['.$type.']['.$object_name.']');

        switch($type){
            case 'int':

                $content = (int) $content;

            break;
            case 'integer':

                $content = (integer) $content;

            break;
            case 'bool':
            case 'boolean':

                // strings 'true' or 'false'
                if($content == 'true'){
                    error_log(__LINE__.' env - BOOL['.$object_name.']['.$content.']true');

                    $content = true;

                }else{
                    error_log(__LINE__.' env - BOOL['.$object_name.']['.$content.']false');

                    $content = false;

                }

            break;
            case 'double':

                $content = (double) $content;

            break;
            case 'string':

                $content = (string) $content;

            break;
            case 'array':
                error_log(__LINE__.' env - ARRAY['.$object_name.']['.$content.']array');

                //$content = (array) $content;
                $content = (string) $type;

            break;
            case 'object':
                error_log(__LINE__.' env - OBJECT['.$object_name.']['.$content.']object');

                //$content = (object) $content;
                $content = (string) $type;

            break;
            case 'resource':
            case 'resource (closed)':
                error_log(__LINE__.' env - RESOURCE/RESOURCE (CLOSED)['.$object_name.']['.$content.']object');

                //$content = $content;
                $content = (string) $type;

            break;
            case 'null':
                error_log(__LINE__.' env - NULL['.$object_name.']['.$content.']null');

                $content = NULL;

            break;
            case 'unknown type':
            default:
                error_log(__LINE__.' env - SURE, I BELIEVE IN YOU.['.$object_name.']['.$content.']');

                //
                // SURE, I BELIEVE IN YOU.
                //$content =  $content;

            break;

        }

        $this->add($content, $object_name);

        return true;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_logging_oprofile_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday October 26, 2020 @ 2054hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_logging_oprofile_manager {
    
    protected $oLogger;

    protected $envKey;
    protected $resourceKey;
    protected $configSerial;

    protected $oLog_profiles_ARRAY = array();
    protected $log_profiles_ARRAY = array();
    protected $logging_profile_pack;
    protected $oWildCardResource_ARRAY = array();

    protected $profile_endpoint_criteria_ARRAY = array();

    public function __construct($sys_logging_profile_pack, $oCRNRSTN) {

        /*
        $sys_logging_profile_pack['sys_logging_profile_ARRAY'] = ARRAY[crc32($this->configSerial)][self::$resourceKey];
        $sys_logging_profile_pack['sys_logging_meta_ARRAY'] = ARRAY[crc32($this->configSerial)][self::$resourceKey];
        $sys_logging_profile_pack['sys_logging_wcr_ARRAY'] = ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL];
        */

        $this->configSerial = $oCRNRSTN->configSerial;

        $this->oWildCardResource_ARRAY = $oCRNRSTN->oWildCardResource_ARRAY;

        $this->build_sys_wcr_profile_criteria();

        $this->load_system_profiles();

        $this->logging_profile_pack = $sys_logging_profile_pack;

        $this->spool_up_logging_profiles($oCRNRSTN);

        $this->oLogger = new crnrstn_logging($oCRNRSTN->CRNRSTN_debugMode, __CLASS__, $oCRNRSTN->log_silo_profile, $oCRNRSTN);

        $oCRNRSTN->oLog_output_ARRAY[] = $oCRNRSTN->error_log('Instantiating logging output profile manager within this environment.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

    }

    public function return_olog_profile($profile_key){

        foreach ($this->oLog_profiles_ARRAY as $key => $oLog_profile) {

            if ($oLog_profile->isValid) {

                error_log(__LINE__.' env VALID log profile ['.$profile_key.']['.$key.']['.$oLog_profile->logging_profile.']');
                if ($profile_key == $oLog_profile->logging_profile) {

                    return $oLog_profile;

                }

            }else{

                error_log(__LINE__.' env !INVALID! log profile ['.$profile_key.']['.$key.']['.$oLog_profile->logging_profile.']');

            }
        }

        return false;

    }

    public function notification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            switch(get_class($oCRNRSTN_n)){
                case 'crnrstn_user':
                case 'crnrstn_environment':
                case 'crnrstn':

                    if($oCRNRSTN_n->isBitSet($oLog_profile->logging_profile)){

                        //
                        // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
                        if (!$oLog_profile->no_cars_tification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj)) {

                            error_log('Error processing the following message through logging profile (int) '.$oLog_profile->logging_profile.'. :: ' . $tmp_exception_output_str);

                            die();

                        }

                    }

                break;

            }

        }

    }

    private function build_sys_wcr_profile_criteria(){

        $this->profile_endpoint_criteria_ARRAY = array();

        //
        // EMAIL
        $log_profile_key = CRNRSTN_LOG_EMAIL;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['TRY_OTHER_EMAIL_METHODS_ON_ERR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;

        //
        // EMAIL_PROXY
        $log_profile_key = CRNRSTN_LOG_EMAIL_PROXY;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY_ENVIRONMENT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY_CONNECTION'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['TRY_OTHER_EMAIL_METHODS_ON_ERR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;

        //
        // FILE
        $log_profile_key = CRNRSTN_LOG_FILE;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_DIR_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['LOCAL_MKDIR_MODE'] = 1;

        //
        // FTP
        $log_profile_key = CRNRSTN_LOG_FILE_FTP;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_SERVER'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USERNAME'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_PASSWORD'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_PORT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_TIMEOUT'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_IS_SSL'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USE_PASV'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_USE_PASV_ADDR'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_DISABLE_AUTOSEEK'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_DIR_PATH'] = 1;
        $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FTP_MKDIR_MODE'] = 1;

        //
        // XXXXX
        //$log_profile_key = 'XXXXX';
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PORT'] = 1;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USERNAME'] = 1;
        //$this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PASSWORD'] = 1;

    }

    private function is_WCR_key($sys_logging_wcr_ARRAY, $str){

        //if(isset($this->oWildCardResource_ARRAY)){
        // error_log('2448 env - is_WCR_key() TEST NEW !!ARRAY FORK AGAINST ARRAY sizeof>0, where sizeof='.sizeof($this->oWildCardResource_ARRAY[crc32($this->configSerial)]));

        //
        // SOURCE :: https://www.php.net/manual/en/language.types.boolean.php
        // AUTHOR :: artktec at gmail dot com :: https://www.php.net/manual/en/language.types.boolean.php#78099
        if(!!$sys_logging_wcr_ARRAY){

            foreach ($sys_logging_wcr_ARRAY as $key0 => $chunkArray0) {

                foreach($chunkArray0 as $key => $oWCR){

                    if($str == $oWCR->returnResourceKey()){

                        return $oWCR;

                    }

                }

            }

        }

        return false;

    }

                                                    # EMAIL, E@E.COM, FALSE
                                                    # EMAIL, WCR_KEY, TRUE
    private function oLog_profile_endpoint_update($profile, $value, $oWCR = NULL){

        foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

            if($profile == $oLog_profile->return_profile()){

                //
                // WCR?
                if(is_object($oWCR)){

                    switch($profile){
                        case CRNRSTN_LOG_EMAIL:

                            error_log(__LINE__.' env - RUN receive_profile_EMAIL_WCR() '.$oLog_profile->return_profile());

                            //
                            // ADD WCR DATA TO oLog_profile
                            $oLog_profile->receive_profile_EMAIL_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_EMAIL_PROXY:
                            error_log(__LINE__.' env - RUN receive_profile_EMAIL_PROXY_WCR() '.$oLog_profile->return_profile());

                            $oLog_profile->receive_profile_EMAIL_PROXY_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE_FTP:
                            error_log(__LINE__.' env - RUN receive_profile_FTP_WCR() '.$oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FTP_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE:
                            error_log(__LINE__.' env - RUN receive_profile_FILE_WCR() '.$oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FILE_WCR($oWCR, $value);
                            $oLog_profile->isValid = true;

                        break;

                    }

                }else{

                    //
                    // ADD RAW DATA TO oLog_profile
                    switch($profile){
                        case CRNRSTN_LOG_EMAIL:
                        case CRNRSTN_LOG_EMAIL_PROXY:

                            error_log(__LINE__.' env - RUN receive_profile_EMAIL() '.$oLog_profile->return_profile());

                            //
                            // ADD DATA TO oLog_profile
                            $oLog_profile->receive_profile_EMAIL($value, 'RECIPIENTS_EMAIL_PIPED');
                            $oLog_profile->isValid = true;

                        break;
                        case CRNRSTN_LOG_FILE:
                            error_log(__LINE__.' env - RUN receive_profile_FILE() '.$oLog_profile->return_profile());

                            $oLog_profile->receive_profile_FILE($value);
                            $oLog_profile->isValid = true;

                        break;

                    }

                }

            }

        }

        return true;

    }

    public function consume_init_profile_pack($init_profile_pack){

        /*
        init_profile_pack_ARRAY ::
        $init_profile_pack['sys_logging_profile_ARRAY'] = self::$sys_logging_profile_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL];
        $init_profile_pack['sys_logging_meta_ARRAY'] = self::$sys_logging_meta_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL];
        $init_profile_pack['sys_logging_wcr_ARRAY'] = $this->oWildCardResource_ARRAY[crc32($this->configSerial)][CRNRSTN_LOG_ALL];
        */

        if(isset($init_profile_pack['sys_logging_meta_ARRAY'])){

            foreach ($init_profile_pack['sys_logging_meta_ARRAY'] as $key => $value) {

                //error_log(__LINE__.' env - HOW MANY META DATA PROCESS? ['.$init_profile_pack['sys_logging_meta_ARRAY'][$key].'] FOR DATA  ' . $value);
                //error_log(__LINE__.' env - (int) '.print_r($init_profile_pack['sys_logging_profile_ARRAY'][$key], true).' HANDLE META VALUE ' . print_r($value, true));

                switch($init_profile_pack['sys_logging_profile_ARRAY'][$key]){
                    case CRNRSTN_LOG_EMAIL:

                        $pos_at = strpos($value, '@');

                        //error_log(__LINE__.' env ['.get_class().'] ping. wcr=' . print_r($this->oWildCardResource_ARRAY, true));
                        if($pos_at !== false){

//                            if($this->is_WCR_key($value)){
//                                error_log(__LINE__.' env ['.get_class().'] ping.');
//                                //
//                                // PROCESS FOR WCR
//                                $tmp_oWCR = $this->is_WCR_key($value);
//                                if(is_array($tmp_oWCR)){
//
//                                    foreach($tmp_oWCR as $wcr_key => $oWCR){
//
//                                        if($value == $oWCR->returnResourceKey()){
//
//                                            //
//                                            // PROCESS FOR WCR
//                                            error_log(__LINE__.' env - PROCESS['.$init_profile_pack['sys_logging_meta_ARRAY'][$key].'] FOR WCR ' . $value);
//                                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_meta_ARRAY'][$key], $value, $oWCR);
//
//                                        }
//
//                                    }
//
//                                }
//
//                                error_log(__LINE__.' env ['.get_class().'] ping.');
//
//                            }
                            //else{
                                //
                                // PROCESS FOR EMAIL ADDRESS
                                //error_log(__LINE__.' env - PROCESS['.$init_profile_pack['sys_logging_meta_ARRAY'][$key].'] FOR EMAIL_ADDR ' . $value);
                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                            //}

                        }else{

                            $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);
                            if(is_object($tmp_oWCR)){

                                error_log(__LINE__.' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);

                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            }

                        }

                    break;
                    case CRNRSTN_LOG_EMAIL_PROXY:

                        $pos_at = strpos($value, '@');
                        if($pos_at !== false){

                            //
                            // PROCESS FOR EMAIL ADDRESS
                            //error_log(__LINE__.' env - PROCESS['.$init_profile_pack['sys_logging_meta_ARRAY'][$key].'] FOR EMAIL_ADDR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                        }else{

                            $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);
                            if(is_object($tmp_oWCR)){

                                error_log(__LINE__.' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);

                                $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            }

                        }

                    break;
                    case CRNRSTN_LOG_FILE:

                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);
                        if(is_object($tmp_oWCR)){
                            error_log(__LINE__.' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR WCR ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                        }else{

                            error_log(__LINE__.' env - PROCESS[' . $init_profile_pack['sys_logging_meta_ARRAY'][$key] . '] FOR PATH ' . $value);
                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value);

                        }

                    break;
                    case CRNRSTN_LOG_FILE_FTP:

                        $tmp_oWCR = $this->is_WCR_key($init_profile_pack['sys_logging_wcr_ARRAY'], $value);
                        if(is_object($tmp_oWCR)){

                            $tmp_wcr_key = $tmp_oWCR->returnResourceKey();

                            $this->oLog_profile_endpoint_update($init_profile_pack['sys_logging_profile_ARRAY'][$key], $value, $tmp_oWCR);

                            //
                            // CHECK oWCR FOR ANY OTHER RELEVANT ENDPOINT DATA
                            // DETECT oWCR ENDPOINT [TYPE=EMAIL] FROM FIELD EMAIL_PROTOCOL IN WCR EMAIL TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'EMAIL_PROTOCOL') && (CRNRSTN_LOG_EMAIL != $init_profile_pack['sys_logging_profile_ARRAY'][$key])){

                                //error_log(__LINE__.' env - PROCESS[WCR] update oLog_profile_endpoint_update() ...has EMAIL_PROTOCOL ' .$tmp_wcr_key);

                                //
                                // WCR FOR EMAIL OF TRACE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_EMAIL, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=FTP] FROM FIELD FTP_SERVER IN WCR FTP TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'FTP_SERVER') && (CRNRSTN_LOG_FILE_FTP != $init_profile_pack['sys_logging_profile_ARRAY'][$key])) {

                                //
                                // WCR FOR FTP OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_FILE_FTP, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=EMAIL_PROXY] FROM FIELD FTP_SERVER IN WCR EMAIL_PROXY TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'WSDL_URI') && (CRNRSTN_LOG_EMAIL_PROXY != $init_profile_pack['sys_logging_profile_ARRAY'][$key])) {

                                //
                                // WCR FOR EMAIL_PROXY OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_EMAIL_PROXY, $tmp_wcr_key, $tmp_oWCR);

                            }

                            //
                            // DETECT WCR ENDPOINT [TYPE=FILE] FROM FIELD LOCAL_DIR_PATH IN WCR FILE TEMPLATE
                            if($tmp_oWCR->isset_WCR($tmp_wcr_key, 'LOCAL_DIR_PATH') && (CRNRSTN_LOG_FILE != $init_profile_pack['sys_logging_profile_ARRAY'][$key])) {

                                //
                                // WCR FOR FILE WRITE OF TRACE IN FILE
                                $this->oLog_profile_endpoint_update(CRNRSTN_LOG_FILE, $tmp_wcr_key, $tmp_oWCR);

                            }

                        }

                    break;

                }

            }

        }else{

            error_log(__LINE__.' env - sys_logging_meta_ARRAY NOT set...');

        }

    }

    public function sync_to_environment($oCRNRSTN = NULL, $oCRNRSTN_ENV = NULL, $oCRNRSTN_USR = NULL){

        $tmp_array = array();

        if(!isset($oCRNRSTN_ENV)){

            foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

                //
                // LOAD CRNRSTN OBJ INTO EACH LOGGING PROFILE OBJECT
                $oLog_profile->load_CRNRSTN_ENV($oCRNRSTN);

                $tmp_array[] = $oLog_profile;
            }

            $this->oLog_profiles_ARRAY = $tmp_array;

        }else{

            foreach($this->oLog_profiles_ARRAY as $key => $oLog_profile){

                //
                // LOAD CRNRSTN_ENV OBJ INTO EACH LOGGING PROFILE OBJECT
                $oLog_profile->load_CRNRSTN_ENV($oCRNRSTN_ENV);

                $tmp_array[] = $oLog_profile;

            }

            $this->oLog_profiles_ARRAY = $tmp_array;

        }

    }

    private function spool_up_logging_profiles($oCRNRSTN){

        foreach($this->log_profiles_ARRAY as $key => $profile){

            $tmp_oLoggingProfile = new crnrstn_logging_oprofile($profile, $this->configSerial, $this->profile_endpoint_criteria_ARRAY, $oCRNRSTN);

            $this->oLog_profiles_ARRAY[] = $tmp_oLoggingProfile;

        }

    }

    /*
    private function objectify_profiles($oCRNRSTN){

        foreach($this->log_profiles_ARRAY as $key => $profile){

            $tmp_oLoggingProfile = new crnrstn_logging_oprofile($profile, $this->configSerial, $oCRNRSTN);

            switch($profile){
                case 'DEFAULT':

                break;
                case 'EMAIL':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    //$tmp_oLoggingProfile->load_EMAIL_endpoint_data();

                break;
                case 'EMAIL_PROXY':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_EMAIL_PROXY_endpoint_data();

                break;
                case 'FILE':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_FILE_endpoint_data();

                break;
                case 'SCREEN_TEXT':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_TEXT_endpoint_data();

                break;
                case 'SCREEN':
                case 'SCREEN_HTML':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_HTML_endpoint_data();

                break;
                case 'SCREEN_HTML_HIDDEN':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SCREEN_HTML_HIDDEN_endpoint_data();

                break;
                case 'SPLUNK':

                    $tmp_oLoggingProfile->consume_logging_profile_pack($profile);

                    $tmp_oLoggingProfile->load_SPLUNK_endpoint_data();

                break;
                default:
                    //
                    // ALSO DEFAULT

                break;

            }

            $this->oLog_profiles_ARRAY[] = $tmp_oLoggingProfile;

        }

    }
    */

    private function load_system_profiles(){

        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_DEFAULT;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_EMAIL;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_EMAIL_PROXY;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_FILE_FTP;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_FILE;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_ELECTRUM;  // n + 1 DESTINATIONS
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_TEXT;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_HTML;
        $this->log_profiles_ARRAY[] = CRNRSTN_LOG_SCREEN_HTML_HIDDEN;

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_logging_oprofile
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Monday October 26, 2020 @ 2101hrs
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_logging_oprofile{

    protected $oLogger;
    protected $oSoapClient;
    protected $oSoapDataTransportLayer;
    private static $oCRNRSTN_n;
    protected $oLog_output_manager;

    public $logging_profile;
    public $isValid = false;

    protected $resourceKey;
    protected $configSerial;

    private static $sys_logging_profile_ARRAY;
    private static $sys_logging_endpoint_ARRAY;
    private static $sys_logging_wcr_ARRAY;
    private static $sys_logging_update_profile_ARRAY;
    private static $sys_logging_update_endpoint_ARRAY;

    protected $profile_endpoint_criteria_ARRAY = array();
    protected $profile_endpoint_data_ARRAY = array();
    protected $profile_endpoint_set_flag_ARRAY = array();
    protected $wcr_profiles_cnt = 0;

    protected $mail_protocol_flag_ARRAY = array();
    protected $tmp_mail_protocol_options_ARRAY = array('SENDMAIL', 'MAIL', 'QMAIL', 'SMTP');
    protected $tmp_mail_protocol_options_cnt = 4;

    public function __construct($logging_profile, $configSerial, $profile_endpoint_criteria_ARRAY, $oCRNRSTN){

        /**
         TODO :: EXPIRE WCR DRIVEN CONTENT WITH ANY MODIFICATION OF THE SAME TO FORCE REFRESH
         *       BEFORE FINAL OUTPUT.
         */

        self::$oCRNRSTN_n = $oCRNRSTN;

        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_n->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_n->log_silo_profile, self::$oCRNRSTN_n);

        $this->profile_endpoint_criteria_ARRAY = $profile_endpoint_criteria_ARRAY;
        $this->logging_profile = $logging_profile;
        //$this->resourceKey = $resourceKey;
        $this->configSerial = $configSerial;

        //$this->active_by_default($logging_profile);

    }

    public function return_profile_endpoint_data(){

        return $this->profile_endpoint_data_ARRAY;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=u4-PGjwdARg
    private function no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $tmp_data_transport_layer_serial = $oCRNRSTN_n->generateNewKey();  // 32
        $this->oSoapDataTransportLayer = new crnrstn_decoupled_data_object($oCRNRSTN_n, $tmp_data_transport_layer_serial, 'SOAP_DTL_SERIAL');

        $tmp_ISHTML = true;
        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();

        $this->load_log_output_mgr($oCRNRSTN_n);

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                //error_log(__LINE__.' env - '.$data_attribute.' with value size=['.sizeof($chunkArray1).']');

                foreach($chunkArray1 as $content_count => $attribute_content){

                    if(isset($this->profile_endpoint_set_flag_ARRAY[$config_version][$data_attribute][$content_count])){

                        //error_log(__LINE__.' env - ['.sizeof($chunkArray1).'] ['.$config_version.'] ['.$data_attribute.'] ['.$content_count.'] ['.$attribute_content.']');

                        switch($data_attribute){
                            case 'EMAIL_PROTOCOL':

                                //error_log(__LINE__.' env - adding to SDTL...email protocol='.$attribute_content);
                                $this->oSoapDataTransportLayer->add(trim(strtoupper($attribute_content)), $data_attribute);

                            break;
                            case 'SMTP_AUTH':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'SMTP_KEEPALIVE':
                                //error_log(__LINE__.' env - adding to SDTL...email SMTP_KEEPALIVE='.$attribute_content);
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'SMTP_AUTOTLS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'SMTP_TIMEOUT':

                                $this->oSoapDataTransportLayer->add((int) $attribute_content, $data_attribute);

                            break;
                            case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'USE_SENDMAIL_OPTIONS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'WORDWRAP':

                                $this->oSoapDataTransportLayer->add((int) $attribute_content, $data_attribute);

                            break;
                            case 'ISHTML':

                                $tmp_ISHTML = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                                $this->oSoapDataTransportLayer->add((bool) $tmp_ISHTML, $data_attribute);

                            break;
                            case 'PRIORITY':

                                $tmp_PRIORITY = $attribute_content;

                                $priority = trim(strtoupper($tmp_PRIORITY));

                                switch($priority){
                                    case '1':
                                    case 1:
                                    case 'HIGH':

                                        $tmp_PRIORITY = 1;

                                    break;
                                    case '3':
                                    case 3:
                                    case 'NORMAL':

                                        $tmp_PRIORITY = 3;

                                    break;
                                    case '5':
                                    case 5:
                                    case 'LOW':

                                        $tmp_PRIORITY = 5;

                                    break;
                                    default:

                                        $tmp_PRIORITY = 3;

                                        //
                                        // HOOOSTON...VE HAF PROBLEM!
                                        $oCRNRSTN_n->error_log('The provided priority level of "'.$tmp_PRIORITY.'" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                        break;

                                }

                                $this->oSoapDataTransportLayer->add($tmp_PRIORITY, $data_attribute);

                            break;
                            case 'DUP_SUPPRESS':

                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'ALLOW_EMPTY':

                                //error_log(__LINE__.' env - adding to SDTL...email ALLOW_EMPTY='.$attribute_content);
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                                //error_log(__LINE__.' env - adding to SDTL...TRY_OTHER_EMAIL_METHODS_ON_ERR='.$oCRNRSTN_n->tidy_boolean($attribute_content));
                                $this->oSoapDataTransportLayer->add((bool) $oCRNRSTN_n->tidy_boolean($attribute_content), $data_attribute);

                            break;
                            default:

                                //error_log(__LINE__.' env - oSoapDataTransportLayer add('.$data_attribute.')=('.$attribute_content.')');
                                $this->oSoapDataTransportLayer->add($attribute_content, $data_attribute);

                            break;

                        }

                    }

                }

            }

        }

        //
        // GET N COUNT OF RECIPIENT EMAIL ADDRESSES?
        $tmp_recipient_email_cnt = $this->oSoapDataTransportLayer->getCount('RECIPIENT_EMAIL');

        //error_log(__LINE__.' env - recipient email cnt = '.$tmp_recipient_email_cnt);

        //for($i=0; $i<$tmp_recipient_email_cnt; $i++){
        // $tmp_email = $this->oSoapDataTransportLayer->preach('value', 'RECIPIENT_EMAIL', false, $i);
        // $tmp_name = $this->oSoapDataTransportLayer->preach('value', 'RECIPIENT_NAME', false, $i);
        // error_log(__LINE__.' env - ['.$tmp_name.'] ['.self::$oCRNRSTN_n->stringSanitize($tmp_email, 'email_private').']');
        //}

        //
        // CONSTANTS
        $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHPExceptionTracePretty($exception_obj->getTraceAsString(), 'TEXT');
        $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
        $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');

        if($tmp_ISHTML){

            $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHPExceptionTracePretty($exception_obj->getTraceAsString(), 'HTML');
            $tmp_log_constant_HTML = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant, 'HTML');
            $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

        }

        switch(get_class($oCRNRSTN_n)){
            case 'crnrstn_user':
            case 'crnrstn_environment':
            case 'crnrstn':

                //
                // LOOP THROUGH N COUNT TO BUILD N CUSTOM EMAIL (SUBJECT, HTML, TEXT). AND STORE CONTENT WITHIN SOAP DTL.
                for ($i = 0; $i < $tmp_recipient_email_cnt; $i++) {

                    $CRNRSTN_oGabriel = new crnrstn_messenger_from_north($i, 'mail', NULL, NULL, NULL, $oCRNRSTN_n);
                    $tmp_email = $this->oSoapDataTransportLayer->preach('value', 'RECIPIENT_EMAIL', false, $i);

                    //error_log(__LINE__.' env - building ['.$i.'] of ['.$tmp_recipient_email_cnt.'] message for '.self::$oCRNRSTN_n->stringSanitize($tmp_email, 'email_private'));

                    //
                    // PREPARE TEXT VERSION
                    $tmp_TEXT_Body = $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION::SOAP_TRANSPORT');
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{EMAIL}', $tmp_email, $tmp_TEXT_Body);
                    $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                    $tmp_MESSAGE_SUBJECT = 'Exception Notification from '.$_SERVER['SERVER_NAME'].' via CRNRSTN ::';
                    $this->oSoapDataTransportLayer->add($tmp_MESSAGE_SUBJECT, 'MESSAGE_SUBJECT');
                    $tmp_TEXT_Body = trim($tmp_TEXT_Body);
                    $this->oSoapDataTransportLayer->add($tmp_TEXT_Body, 'MESSAGE_BODY_TEXT');

                    if ($tmp_ISHTML) {

                        //
                        // PREPARE HTML VERSION
                        $tmp_HTML_Body = $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION::SOAP_TRANSPORT');
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{METHOD}', $exception_method, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{EMAIL}', $tmp_email, $tmp_HTML_Body);
                        $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                        $tmp_HTML_Body = trim($tmp_HTML_Body);
                        $this->oSoapDataTransportLayer->add($tmp_HTML_Body, 'MESSAGE_BODY_HTML');

                    }

                }

                //
                // DONE. BUILD SOAP REQUEST AND SEND TO PROXY.
                $SOAP_endpoint = $this->oSoapDataTransportLayer->preach('value', 'WSDL_URI');

                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('tunnelEncryptCalibrationRequest', NULL);

                //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: oTunnelEncryptionCalibrationRequest', NULL,  __LINE__, __METHOD__, __FILE__);

                //
                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                $tmp_response = $this->clientSend_CRNRSTN_SOAP_REQUEST('tunnelEncryptCalibrationRequest', $SOAP_request[0], $SOAP_endpoint);

                self::$oCRNRSTN_n->print_r($tmp_response, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest', NULL,  __LINE__, __METHOD__, __FILE__);

                if($tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'] != 'TRUE'){

                    //
                    // UNABLE TO CONTINUE. ENCRYPTION IS REQUIRED. HANDLE AS ERROR.

                    error_log(__LINE__.' env - SOAP err CRNRSTN_PACKET_IS_ENCRYPTED != TRUE');
                    die();

                }else{

                    $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_CIPHER');
                    $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                    $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                    $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                    $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    $tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                    //$tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                    /*

                    NEED TO UPDATE PARAMETER ORDER TO THE NEW BEFORE RUNNING THIS
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_SERVICES_AUTH_STATUS');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_CIPHER');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_HMAC_ALG');
                    self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SOAP_ENCRYPT_OPTIONS');
                    self::$oCRNRSTN_n->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_CODE');
                    self::$oCRNRSTN_n->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: STATUS_MESSAGE');
                    self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_CODE');
                    self::$oCRNRSTN_n->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: ISERROR_MESSAGE');
                    self::$oCRNRSTN_n->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_RECEIVED_SOAP_REQUEST');
                    self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_NAME_SOAP_SERVER');
                    self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: SERVER_ADDRESS_SOAP_SERVER');
                    self::$oCRNRSTN_n->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE :: tunnelEncryptCalibrationRequest :: DATE_CREATED_SOAP_RESPONSE');
                    */

                    if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                        $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('mayItakeTheKingsHighway', $tmp_response);

                        /*
                        'CRNRSTN_PACKET_IS_ENCRYPTED' => array( 'name' => 'CRNRSTN_PACKET_IS_ENCRYPTED',  'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES' => array( 'name' => 'CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES',  'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_METHOD_REQUESTED' => array( 'name' => 'CRNRSTN_SOAP_SVC_METHOD_REQUESTED',  'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_ACTION_TYPE' => array( 'name' => 'CRNRSTN_SOAP_ACTION_TYPE',  'type' => 'xsd:string' ),
                        'CRNRSTN_SOAP_SVC_AUTH_KEY' => array( 'name' => 'CRNRSTN_SOAP_SVC_AUTH_KEY',  'type' => 'xsd:string' ),
                        'USERNAME' => array( 'name' => 'USERNAME',  'type' => 'xsd:string' ),
                        'PASSWORD' => array( 'name' => 'PASSWORD',  'type' => 'xsd:string' ),
                        'CRNRSTN_NOTIFICATION_TYPE' => array( 'name' => 'CRNRSTN_NOTIFICATION_TYPE',  'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_CIPHER' => array( 'name' => 'SOAP_ENCRYPT_CIPHER',  'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_SECRET_KEY' => array( 'name' => 'SOAP_ENCRYPT_SECRET_KEY',  'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_HMAC_ALG' => array( 'name' => 'SOAP_ENCRYPT_HMAC_ALG',  'type' => 'xsd:string' ),
                        'SOAP_ENCRYPT_OPTIONS' => array( 'name' => 'SOAP_ENCRYPT_OPTIONS',  'type' => 'xsd:string' )
                         * */

                        self::$oCRNRSTN_n->print_r($SOAP_endpoint, '', NULL, __LINE__, __METHOD__, __FILE__);

                        //
                        // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                        $tmp_response = $this->clientSend_CRNRSTN_SOAP_REQUEST('mayItakeTheKingsHighway', $SOAP_request[0], $SOAP_endpoint);

                        //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: mayItakeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);
                        //self::$oCRNRSTN_n->print_r($this->returnClientRequest(), 'CLIENT REQUEST :: oKingsHighwayAuthRequest', NULL,  __LINE__, __METHOD__, __FILE__);
                        self::$oCRNRSTN_n->print_r($tmp_response, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);

                        $tmp_CRNRSTN_PACKET_IS_ENCRYPTED = $tmp_response['CRNRSTN_PACKET_IS_ENCRYPTED'];
                        if($tmp_CRNRSTN_PACKET_IS_ENCRYPTED != 'TRUE'){

                            //
                            // ENCRYPTION REQUIRED - DO NOT CONTINUE.

                        }else{

                            $tmp_SOAP_ENCRYPT_CIPHER = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_CIPHER');
                            $tmp_SOAP_ENCRYPT_SECRET_KEY_resp = $this->oSoapDataTransportLayer->soap_encrypt_secret_key;
                            $tmp_SOAP_ENCRYPT_HMAC_ALG = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_HMAC_ALG');
                            $tmp_SOAP_ENCRYPT_OPTIONS = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_OPTIONS');

                            $tmp_SOAP_ENCRYPT_SECRET_KEY = $this->oSoapDataTransportLayer->preach('value', 'SOAP_ENCRYPT_SECRET_KEY_ENVIRONMENT');

                            //mayItakeTheKingsHighway decrypt with [AES-192-OFB][for_a_stranger-this-Is-the_soap-encrypti0n-key][sha256][1]

                            //
                            // DECRYPT SOAP OBJECT
                            //$tmp_CRNRSTN_SOAP_SVC_AUTH_KEY = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['CRNRSTN_SOAP_SVC_AUTH_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_CRNRSTN_SOAP_SVC_USERNAME = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['CRNRSTN_SOAP_SVC_USERNAME'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            self::$oCRNRSTN_n->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_response['SOAP_SERVICES_AUTH_STATUS'].' ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.'] ['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$this->oSoapDataTransportLayer->soap_encrypt_secret_key.']', 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            //error_log(__LINE__.' env paramTunnelDecrypt(1/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');
                            $tmp_SOAP_SERVICES_AUTH_STATUS = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_SERVICES_AUTH_STATUS'], true, $tmp_SOAP_ENCRYPT_CIPHER_resp, $tmp_SOAP_ENCRYPT_SECRET_KEY_resp, $tmp_SOAP_ENCRYPT_HMAC_ALG_resp, $tmp_SOAP_ENCRYPT_OPTIONS_resp);
                            //error_log(__LINE__.' env paramTunnelDecrypt(2/2) ['.$tmp_SOAP_ENCRYPT_CIPHER_resp.']['.$tmp_SOAP_ENCRYPT_SECRET_KEY_resp.']['.$tmp_SOAP_ENCRYPT_HMAC_ALG_resp.']['.$tmp_SOAP_ENCRYPT_OPTIONS_resp.']');

                            self::$oCRNRSTN_n->print_r('SOAP_SERVICES_AUTH_STATUS = '.$tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE DECRYPT :: mayItakeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);
                            //$tmp_SOAP_ENCRYPT_CIPHER_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_CIPHER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_SECRET_KEY_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_SECRET_KEY'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_HMAC_ALG_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_HMAC_ALG'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SOAP_ENCRYPT_OPTIONS_resp = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SOAP_ENCRYPT_OPTIONS'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                            //$tmp_STATUS_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_ISERROR_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_DATE_RECEIVED_SOAP_REQUEST = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['DATE_RECEIVED_SOAP_REQUEST'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_NAME_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SERVER_NAME_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_ADDRESS_SOAP_SERVER = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SERVER_ADDRESS_SOAP_SERVER'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_DATE_CREATED_SOAP_RESPONSE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['DATE_CREATED_SOAP_RESPONSE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_NAME_SOAP_CLIENT = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SERVER_NAME_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                            //$tmp_SERVER_ADDRESS_SOAP_CLIENT = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['SERVER_ADDRESS_SOAP_CLIENT'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                            /*
                             DO NOT RUN UNTIL BRINGING INPUT PARAM ORDER INTO TO NEW SEQUENCE
                            self::$oCRNRSTN_n->print_r($tmp_CRNRSTN_SOAP_SVC_AUTH_KEY, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_AUTH_KEY');
                            self::$oCRNRSTN_n->print_r($tmp_CRNRSTN_SOAP_SVC_USERNAME, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: CRNRSTN_SOAP_SVC_USERNAME');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_SERVICES_AUTH_STATUS');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_CIPHER_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_CIPHER');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_SECRET_KEY_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_SECRET_KEY');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_HMAC_ALG_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_HMAC_ALG');
                            self::$oCRNRSTN_n->print_r($tmp_SOAP_ENCRYPT_OPTIONS_resp, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SOAP_ENCRYPT_OPTIONS');
                            self::$oCRNRSTN_n->print_r($tmp_STATUS_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_CODE');
                            self::$oCRNRSTN_n->print_r($tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: STATUS_MESSAGE');
                            self::$oCRNRSTN_n->print_r($tmp_ISERROR_CODE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_CODE');
                            self::$oCRNRSTN_n->print_r($tmp_ISERROR_MESSAGE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: ISERROR_MESSAGE');
                            self::$oCRNRSTN_n->print_r($tmp_DATE_RECEIVED_SOAP_REQUEST, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_RECEIVED_SOAP_REQUEST');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_SERVER');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_SERVER, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_SERVER');
                            self::$oCRNRSTN_n->print_r($tmp_DATE_CREATED_SOAP_RESPONSE, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: DATE_CREATED_SOAP_RESPONSE');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_NAME_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_NAME_SOAP_CLIENT');
                            self::$oCRNRSTN_n->print_r($tmp_SERVER_ADDRESS_SOAP_CLIENT, __LINE__, __METHOD__, __FILE__, NULL, 'SERVER RESPONSE - APPROVED FOR KING\'S HIGHWAY :: SERVER_ADDRESS_SOAP_CLIENT');
                            */

                            self::$oCRNRSTN_n->print_r($tmp_SOAP_SERVICES_AUTH_STATUS, 'SERVER RESPONSE :: mayItakeTheKingsHighway', NULL, __LINE__, __METHOD__, __FILE__);
                            if($tmp_SOAP_SERVICES_AUTH_STATUS == 'AUTHORIZATION GRANTED'){

                                //
                                // BUILD PAYLOAD SOAP REQUEST :: takeTheKingsHighway
                                $this->oSoapDataTransportLayer->soap_encrypt_cipher = $tmp_SOAP_ENCRYPT_CIPHER_resp;
                                $this->oSoapDataTransportLayer->soap_encrypt_hmac_alg = $tmp_SOAP_ENCRYPT_HMAC_ALG_resp;
                                $this->oSoapDataTransportLayer->soap_encrypt_options = $tmp_SOAP_ENCRYPT_OPTIONS_resp;

                                $SOAP_request = $this->oSoapDataTransportLayer->generate_SOAP_request_object('takeTheKingsHighway', $tmp_response);

                                //self::$oCRNRSTN_n->print_r($SOAP_request, 'CLIENT REQUEST :: takeTheKingsHighway', NULL,  __LINE__, __METHOD__, __FILE__);

                                error_log(__LINE__.' env - READY TO takeTheKingsHighway TO SERVER.');

                                //
                                // SUBMIT SERVICES REQUEST [LIMIT OF 65535 bytes]
                                $tmp_request_cnt = sizeof($SOAP_request);
                                //error_log(__LINE__.' env - READY TO SEND count='.$tmp_request_cnt.' TO SERVER.');

                                for($ii=0; $ii<$tmp_request_cnt; $ii++){

                                    $tmp_cur = 1 + $ii;
                                    $tmp_response = $this->clientSend_CRNRSTN_SOAP_REQUEST('takeTheKingsHighway', $SOAP_request[$ii], $SOAP_endpoint);
                                    self::$oCRNRSTN_n->print_r($tmp_response, 'CLIENT - SERVER RESPONSE  :: takeTheKingsHighway '.$tmp_cur.' of '.$tmp_request_cnt, NULL, __LINE__, __METHOD__, __FILE__);

                                }

                               // error_log(__LINE__.' env - WE JUST TOOK takeTheKingsHighway '.$ii.' times!');

                            }

                        }

                    }else{

                        error_log(__LINE__.' env - authorization NOT granted...');
                        $tmp_STATUS_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['STATUS_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_STATUS_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['STATUS_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_ISERROR_CODE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['ISERROR_CODE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);
                        $tmp_ISERROR_MESSAGE = self::$oCRNRSTN_n->paramTunnelDecrypt($tmp_response['ISERROR_MESSAGE'], true, $tmp_SOAP_ENCRYPT_CIPHER, $tmp_SOAP_ENCRYPT_SECRET_KEY, $tmp_SOAP_ENCRYPT_HMAC_ALG, $tmp_SOAP_ENCRYPT_OPTIONS);

                        self::$oCRNRSTN_n->error_log('CRNRSTN :: SOAP Services proxy error. Error Code: '.$tmp_ISERROR_CODE.' :: Error Message: '.$tmp_ISERROR_MESSAGE.' :: Status Code: '.$tmp_STATUS_CODE.' :: Status Message: '.$tmp_STATUS_MESSAGE, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_SOAP_SERVICES');

                    }

                    return true;

                }

            break;

        }

        return true;

    }

    private function returnClientRequest(){

        return $this->oSoapClient->returnClientRequest();

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    private function no_cars_go_EMAIL($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        $tmp_exception_msg = $exception_obj->getMessage();
        $tmp_exception_linenum = $exception_obj->getLine();

        $this->load_log_output_mgr($oCRNRSTN_n);

        $tmp_sent_suppression = array();
        $config_data_ARRAY = array();

        //
        // PHPMAILER DEFAULT VALUES
        $tmp_DUP_SUPPRESS = true;  // CRNRSTN DEFAULT
        $tmp_ALLOW_EMPTY = false;
        $tmp_SMTP_KEEPALIVE = false;
        $tmp_isHTML = true;
        $tmp_SMTP_TIMEOUT = 300;
        $tmp_PRIORITY = 3;
        $tmp_WORDWRAP = 52;
        $tmp_EMAIL_PROTOCOL = 'mail';
        $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = true;
        $tmp_SMTP_AUTH = false;
        $tmp_SMTP_SERVER = 'localhost';
        $tmp_SMTP_PORT_OUTGOING = 25;
        $tmp_SMTP_USERNAME = '';
        $tmp_SMTP_PASSWORD = '';
        $tmp_CHARSET = 'iso-8859-1';
        $tmp_MESSAGE_ENCODING = '8bit';
        $tmp_SMTP_SECURE = '';
        $tmp_SMTP_AUTOTLS = true;
        $tmp_FROM_EMAIL = 'root@localhost';
        $tmp_FROM_NAME = 'Root User';
        $tmp_RECIPIENT_EMAIL = array();
        $tmp_RECIPIENT_NAME = array();
        $tmp_REPLYTO_EMAIL = array();
        $tmp_REPLYTO_NAME = array();
        $tmp_CC_EMAIL = array();
        $tmp_CC_NAME = array();
        $tmp_BCC_EMAIL = array();
        $tmp_BCC_NAME = array();
        $tmp_SENDMAIL_PATH = '/usr/sbin/sendmail';
        $tmp_USE_SENDMAIL_OPTIONS = true;
        $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = true;

        $tmp_size = sizeof($this->profile_endpoint_data_ARRAY);

        //error_log(__LINE__.' env profile_endpoint_data_ARRAY='.print_r($this->profile_endpoint_data_ARRAY, true));

        //
        // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
        foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

            //error_log(__LINE__.' env - should be (more than one) '.$tmp_size.'...config_version='.$config_version);

            foreach($chunkArray0 as $data_attribute => $chunkArray1){

                foreach($chunkArray1 as $content_count => $attribute_content){

                    //error_log(__LINE__.' env - ['.$config_version.'] ['.$data_attribute.'] ['.$content_count.'] ['.$attribute_content.']');

                    switch($data_attribute){
                        case 'RECIPIENT_EMAIL':

                            $tmp_RECIPIENT_EMAIL[] = $attribute_content;

                        break;
                        case 'RECIPIENT_NAME':

                            $tmp_RECIPIENT_NAME[] = $attribute_content;

                        break;
                        case 'FROM_EMAIL':

                            $tmp_FROM_EMAIL = $attribute_content;

                        break;
                        case 'FROM_NAME':

                            $tmp_FROM_NAME = $attribute_content;

                        break;
                        case 'REPLYTO_EMAIL':

                            $tmp_REPLYTO_EMAIL[] = $attribute_content;

                        break;
                        case 'REPLYTO_NAME':

                            $tmp_REPLYTO_NAME[] = $attribute_content;

                        break;
                        case 'CC_EMAIL':

                            $tmp_CC_EMAIL[] = $attribute_content;

                        break;
                        case 'CC_NAME':

                            $tmp_CC_NAME[] = $attribute_content;

                        break;
                        case 'BCC_EMAIL':

                            $tmp_BCC_EMAIL[] = $attribute_content;

                        break;
                        case 'BCC_NAME':

                            $tmp_BCC_NAME[] = $attribute_content;

                        break;
                        case 'SMTP_KEEPALIVE':

                            $tmp_SMTP_KEEPALIVE = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);;

                        break;
                        case 'DUP_SUPPRESS':

                            $tmp_DUP_SUPPRESS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'ALLOW_EMPTY':

                            $tmp_ALLOW_EMPTY = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'ISHTML':

                            $tmp_isHTML = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'SMTP_TIMEOUT':

                            $tmp_SMTP_TIMEOUT = (int) $attribute_content;

                        break;
                        case 'PRIORITY':

                            $tmp_PRIORITY = $attribute_content;

                            $priority = trim(strtoupper($tmp_PRIORITY));

                            switch($priority){
                                case '1':
                                case 1:
                                case 'HIGH':

                                    $tmp_PRIORITY = 1;

                                break;
                                case '3':
                                case 3:
                                case 'NORMAL':

                                    $tmp_PRIORITY = 3;

                                break;
                                case '5':
                                case 5:
                                case 'LOW':

                                    $tmp_PRIORITY = 5;

                                break;
                                default:

                                    $tmp_PRIORITY = 3;

                                    //
                                    // HOOOSTON...VE HAF PROBLEM!
                                    $oCRNRSTN_n->error_log('The provided priority level of "'.$tmp_PRIORITY.'" is invalid; NORMAL priority has been applied. Options include, "HIGH" or 1, "NORMAL" or 3 and "LOW" or 5.', __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);

                                break;

                            }

                        break;
                        case 'WORDWRAP':

                            $tmp_WORDWRAP = (int) $attribute_content;

                        break;
                        case 'EMAIL_PROTOCOL':

                            $tmp_EMAIL_PROTOCOL = trim(strtoupper($attribute_content));

                        break;
                        case 'CHARSET':

                            $tmp_CHARSET = $attribute_content;

                        break;
                        case 'MESSAGE_ENCODING':

                            $tmp_MESSAGE_ENCODING = $attribute_content;

                        break;
                        case 'SMTP_SECURE':

                            $tmp_SMTP_SECURE = strtolower(trim($attribute_content));

                        break;
                        case 'SMTP_AUTOTLS':

                            $tmp_SMTP_AUTOTLS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'SMTP_AUTH':

                            $tmp_SMTP_AUTH = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'SMTP_SERVER':

                            $tmp_SMTP_SERVER = $attribute_content;

                        break;
                        case 'SMTP_PORT_OUTGOING':

                            $tmp_SMTP_PORT_OUTGOING = $attribute_content;

                        break;
                        case 'SMTP_USERNAME':

                            $tmp_SMTP_USERNAME = $attribute_content;

                        break;
                        case 'SMTP_PASSWORD':

                            $tmp_SMTP_PASSWORD = $attribute_content;

                        break;
                        case 'SENDMAIL_PATH':

                            $tmp_SENDMAIL_PATH = $attribute_content;

                        break;
                        case 'USE_SENDMAIL_OPTIONS':

                            $tmp_USE_SENDMAIL_OPTIONS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'DIBYA_SAHOO_SSL_CERT_BYPASS':

                            $tmp_DIBYA_SAHOO_SSL_CERT_BYPASS = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;
                        case 'TRY_OTHER_EMAIL_METHODS_ON_ERR':

                            $tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR = (bool) $oCRNRSTN_n->tidy_boolean($attribute_content);

                        break;

                    }

                }

            }

        }

        //$tmp_config_version_cnt = sizeof($config_data_ARRAY);
        error_log(__LINE__.' env class to send email = '.get_class($oCRNRSTN_n));
        //error_log(__LINE__.' $tmp_config_version_cnt='.$tmp_config_version_cnt);
        //for($config_vs=0; $config_vs < $tmp_config_version_cnt; $config_vs++) {

            $tmp_oGabriel_serial = $oCRNRSTN_n->generateNewKey(50);

            error_log(__LINE__.' env die $tmp_RECIPIENT_EMAIL='.print_r($tmp_RECIPIENT_EMAIL, true));

            switch(get_class($oCRNRSTN_n)){
                case 'crnrstn_user':
                case 'crnrstn_environment':
                case 'crnrstn':

                    $tmp_recipient_cnt = count($tmp_RECIPIENT_EMAIL);

                    for ($i = 0; $i < $tmp_recipient_cnt; $i++) {

                        error_log(__LINE__.' processing recipient email='.$tmp_RECIPIENT_EMAIL[$i]);

                        if(!($tmp_DUP_SUPPRESS && isset($tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])]))){

                            if($tmp_DUP_SUPPRESS){

                                $tmp_sent_suppression[strtolower($tmp_RECIPIENT_EMAIL[$i])] = 1;

                            }

                            $CRNRSTN_oGabriel = new crnrstn_messenger_from_north($tmp_oGabriel_serial, $tmp_EMAIL_PROTOCOL, $tmp_SMTP_USERNAME, $tmp_SMTP_PASSWORD, $tmp_SMTP_PORT_OUTGOING, $oCRNRSTN_n);

                            $crnrstn_phpmailer = new \PHPMailer\crnrstn_PHPMailer\crnrstn_PHPMailer($oCRNRSTN_n);
                            $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".
                            $crnrstn_phpmailer->Timeout = $tmp_SMTP_TIMEOUT;
                            $crnrstn_phpmailer->SMTPKeepAlive = $tmp_SMTP_KEEPALIVE;
                            $crnrstn_phpmailer->Priority = $tmp_PRIORITY;
                            $crnrstn_phpmailer->CharSet = $tmp_CHARSET;
                            $crnrstn_phpmailer->Encoding = $tmp_MESSAGE_ENCODING;
                            $crnrstn_phpmailer->SMTPSecure = $tmp_SMTP_SECURE;
                            $crnrstn_phpmailer->SMTPAutoTLS = $tmp_SMTP_AUTOTLS;
                            $crnrstn_phpmailer->Sendmail = $tmp_SENDMAIL_PATH;
                            $crnrstn_phpmailer->UseSendmailOptions = $tmp_USE_SENDMAIL_OPTIONS;

                            if($tmp_isHTML){

                                $crnrstn_phpmailer->isHTML();

                            }

                            $crnrstn_phpmailer->WordWrap = $tmp_WORDWRAP;
                            $crnrstn_phpmailer->AllowEmpty = $tmp_ALLOW_EMPTY;

                            $crnrstn_phpmailer->setFrom($tmp_FROM_EMAIL, $tmp_FROM_NAME);
                            //error_log(__LINE__ . ' env - Adding setFrom:' . $tmp_FROM_NAME . ' ' . $tmp_FROM_EMAIL);
                            //$crnrstn_phpmailer->From = $config_data_ARRAY[$config_vs]['FROM_EMAIL'][0];
                            //$crnrstn_phpmailer->FromName = $config_data_ARRAY[$config_vs]['FROM_NAME'][0];

                            $tmp_e_cnt = sizeof($tmp_REPLYTO_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addReplyTo($tmp_REPLYTO_EMAIL[$e_pos], $tmp_REPLYTO_NAME[$e_pos]);
                                    //error_log(__LINE__ . ' env - Adding ReplyTo:' . $tmp_REPLYTO_NAME[$e_pos] . ' ' . $tmp_REPLYTO_EMAIL[$e_pos]);

                                }

                            }

                            $tmp_e_cnt = sizeof($tmp_CC_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addCC($tmp_CC_EMAIL[$e_pos], $tmp_CC_NAME[$e_pos]);
                                    //error_log(__LINE__ . ' env - Adding CC:' . $tmp_CC_NAME[$e_pos] . ' ' . $tmp_CC_EMAIL[$e_pos]);

                                }

                            }

                            $tmp_e_cnt = sizeof($tmp_BCC_EMAIL);
                            if($tmp_e_cnt > 0){

                                for($e_pos=0; $e_pos<$tmp_e_cnt; $e_pos++){

                                    $crnrstn_phpmailer->addBCC($tmp_BCC_EMAIL[$e_pos], $tmp_BCC_NAME[$e_pos]);
                                    error_log(__LINE__ . ' env - Adding BCC:' . $tmp_BCC_NAME[$e_pos] . ' ' . $tmp_BCC_EMAIL[$e_pos]);

                                }

                            }

                            switch($tmp_EMAIL_PROTOCOL){
                                case 'SMTP':

                                    if($tmp_SMTP_AUTH){

                                        $crnrstn_phpmailer->SMTPAuth = true;
                                        $crnrstn_phpmailer->Username = $tmp_SMTP_USERNAME;
                                        $crnrstn_phpmailer->Password = $tmp_SMTP_PASSWORD;
                                        $crnrstn_phpmailer->Host = $tmp_SMTP_SERVER;
                                        $crnrstn_phpmailer->Port = $tmp_SMTP_PORT_OUTGOING;

                                    }

                                    if($tmp_DIBYA_SAHOO_SSL_CERT_BYPASS){

                                        //
                                        // WORK AROUND FOR PHPMAILER SSL CERT VERIFICATION *ERRORS INTRODUCED
                                        // THROUGH THE STRICTER SSL BEHAVIOR THAT CAME WITH THE RELEASE OF PHP 5.6
                                        // SOURCE :: https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
                                        // AUTHOR :: https://pepipost.com/tutorials/author/dibya-sahoo/
                                        // DETAIL :: https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#certificate-verification-failure
                                        // * You may not see this error; In implicit encryption mode (SMTPS) it may be
                                        // hidden because there isn't a way for the channel to show messages - SMTP+STARTTLS
                                        // is generally easier to debug because of this.
                                        $crnrstn_phpmailer->SMTPOptions = array(
                                            'ssl' => array(
                                                'verify_peer' => false,
                                                'verify_peer_name' => false,
                                                'allow_self_signed' => true
                                            )
                                        );

                                        error_log(__LINE__.' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN APPLIED.');

                                    }else{

                                        error_log(__LINE__.' env - DIBYA_SAHOO_SSL_CERT_BYPASS HAS BEEN BYPASSED.');

                                    }

                                break;
                                case 'SENDMAIL':

                                    $crnrstn_phpmailer->isSendmail();

                                break;
                                case 'QMAIL':

                                    $crnrstn_phpmailer->isQmail();

                                break;
                                case 'MAIL':

                                    $crnrstn_phpmailer->isMail();

                                break;

                            }

                            //
                            // CONSTANTS
                            $tmp_php_trace_TEXT = $oCRNRSTN_n->return_PHPExceptionTracePretty($exception_obj->getTraceAsString(), 'TEXT');
                            $tmp_log_constant_TEXT = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant);
                            $tmp_crnrstn_trace_TEXT = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_TEXT');
                            $crnrstn_phpmailer->Subject = 'Exception Notification from '.$_SERVER['SERVER_NAME'].' via CRNRSTN ::';

                            if($tmp_isHTML){

                                $tmp_php_trace_HTML = $oCRNRSTN_n->return_PHPExceptionTracePretty($exception_obj->getTraceAsString(), 'HTML');
                                $tmp_log_constant_HTML = $oCRNRSTN_n->return_logPriorityPretty($syslog_constant, 'HTML');
                                $tmp_crnrstn_trace_HTML = $this->oLog_output_manager->return_log_trace_output_str('EMAIL_HTML');

                            }

                            if (isset($tmp_RECIPIENT_NAME[$i])) {

                                $tmp_name = $tmp_RECIPIENT_NAME[$i];

                            } else {

                                $tmp_name = '';

                            }

                            error_log(__LINE__ . ' env - Adding Recipient:' . $tmp_name . ' ' . $oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private'));
                            $crnrstn_phpmailer->AddAddress($tmp_RECIPIENT_EMAIL[$i], $tmp_name);

                            //
                            // PREPARE TEXT VERSION
                            $tmp_TEXT_Body = $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgTEXTBody('EXCEPTION_NOTIFICATION');
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_TEXT, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{MESSAGE}', $tmp_exception_msg, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{LINE_NUM}', $tmp_exception_linenum, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{METHOD}', $exception_method, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{PHP_TRACE}', $tmp_php_trace_TEXT, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{SYSTEM_TIME}', $exception_systemtime, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_TEXT_Body);
                            $tmp_TEXT_Body = $oCRNRSTN_n->properReplace('{LOG_TRACE}', $tmp_crnrstn_trace_TEXT, $tmp_TEXT_Body);

                            $crnrstn_phpmailer->AltBody = $tmp_TEXT_Body;

                            if ($tmp_isHTML) {

                                //
                                // PREPARE HTML VERSION
                                $tmp_HTML_Body = $CRNRSTN_oGabriel->return_CRNRSTN_SysMsgHTMLBody('EXCEPTION_NOTIFICATION');
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{SYSTEM_LOG_INTEGER_CONSTANT}', $tmp_log_constant_HTML, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{MESSAGE}', $tmp_exception_msg, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{LINE_NUM}', $tmp_exception_linenum, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{METHOD}', $exception_method, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{PHP_TRACE}', $tmp_php_trace_HTML, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{SYSTEM_TIME}', $exception_systemtime, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{PROCESS_RUN_TIME}', $exception_runtime, $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{EMAIL}', $tmp_RECIPIENT_EMAIL[$i], $tmp_HTML_Body);
                                $tmp_HTML_Body = $oCRNRSTN_n->properReplace('{LOG_TRACE}', $tmp_crnrstn_trace_HTML, $tmp_HTML_Body);

                                $crnrstn_phpmailer->Body = $tmp_HTML_Body;

                            }

                            error_log(__LINE__.' env - crnrstn_phpmailer->send()');

                            $crnrstn_phpmailer->Mailer = strtolower($tmp_EMAIL_PROTOCOL);  // "mail", "qmail", "sendmail", or "smtp".

                            if(!$crnrstn_phpmailer->Send()){

                                if($tmp_TRY_OTHER_EMAIL_METHODS_ON_ERR){

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to secondary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__.' - An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to secondary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo);

                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                    if(!$crnrstn_phpmailer->Send()){

                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to tertiary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                        error_log(__LINE__.' - An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to tertiary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo);

                                        $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                        if(!$crnrstn_phpmailer->Send()){

                                            $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to quatiary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                            error_log(__LINE__.' - An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to quatiary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo);

                                            $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                            if(!$crnrstn_phpmailer->Send()){

                                                $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to pentiary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                error_log(__LINE__.' - An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Graceful degradation to pentiary email send protocol is commencing due to: '.$crnrstn_phpmailer->ErrorInfo);

                                                $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                if(!$crnrstn_phpmailer->Send()) {

                                                    //
                                                    // ...on my usage of the term "hexapolynomial"...as being of the
                                                    // same ilk as usages (contained also herein) of secondary,
                                                    // tertiary, etc...I feel pretty good standing in this shadow.
                                                    //
                                                    // - J5, November 9, 2020 0845hrs
                                                    //
                                                    // SOURCE :: https://ieeexplore.ieee.org/abstract/document/9195628
                                                    // AUTHOR :: https://ieeexplore.ieee.org/author/37086360445
                                                    // This paper discusses twice continuously differentiable and three times
                                                    // continuously differentiable approximations with polynomial and
                                                    // non-polynomial splines. To construct the approximation, a polynomial and
                                                    // non-polynomial local basis of the second level and the sixth order
                                                    // approximation is constructed. We call the approximation a second level
                                                    // approximation because it uses the first and the second derivatives of the
                                                    // function. The non-polynomial approximation has the properties of
                                                    // polynomial and trigonometric functions. Here we have also constructed a
                                                    // non-polynomial interpolating spline which has the first, the second and
                                                    // the third continuous derivative. This approximation uses the values of
                                                    // the function at the nodes, the values of the first derivative of the
                                                    // function at the nodes and the values of the second derivative of the
                                                    // function at the ends of the interval [a, b]. The theorems of the
                                                    // approximations are given. Numerical examples are given.
                                                    //
                                                    // - I. G. Burova,
                                                    // St. Petersburg State University,
                                                    // Dept. of Computational Mathematics

                                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                    error_log(__LINE__ . 'An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . ' via ' . strtoupper($crnrstn_phpmailer->Mailer) . '. Attempting final graceful degradation...hexapolynomial in nature...albeit CRNRSTN :: has, at this point, already measured and found to be wanting the fifth (5th) and final email send use case of the four (4) official and available protocols for things of this nature per /crnrstn_PHPMailer/. TLDR; ...an empty string will now be sent as the mailer protocol, and the results for which what one would hope...could only be the best. ' . $crnrstn_phpmailer->ErrorInfo);

                                                    $crnrstn_phpmailer = $this->next_mail_protocol_option($crnrstn_phpmailer);
                                                    if (!$crnrstn_phpmailer->Send()) {

                                                        $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                                        error_log(__LINE__ . ' - An error was experienced while attempting to send an email to ' . $oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private') . '. Abandoning email delivery efforts due to: ' . $crnrstn_phpmailer->ErrorInfo);

                                                    }

                                                }

                                            }

                                        }else{

                                            error_log(__LINE__.' - A SUCCESS was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'.');

                                        }

                                    }else{

                                        error_log(__LINE__.' - A SUCCESS was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'.');

                                    }

                                }else{

                                    $oCRNRSTN_n->error_log('An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Abandoning email delivery efforts due to: '.$crnrstn_phpmailer->ErrorInfo, __LINE__, __METHOD__, __FILE__, CRNRSTN_GABRIEL);
                                    error_log(__LINE__.' - An error was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'. Abandoning email delivery efforts due to: '.$crnrstn_phpmailer->ErrorInfo);

                                }

                            }else{

                                error_log(__LINE__.' - A SUCCESS was experienced while attempting to send an email to '.$oCRNRSTN_n->stringSanitize($tmp_RECIPIENT_EMAIL[$i], 'email_private').' via '.strtoupper($crnrstn_phpmailer->Mailer).'.');

                            }

                            array_splice($this->mail_protocol_flag_ARRAY, 0);

                            //
                            // CLEAR SEND DATA (ALSO ANY MESSAGE ATTACHMENTS CLEARED)
                            $crnrstn_phpmailer->ClearAddresses();

                        }

                    }

                    if(isset($tmp_SMTP_KEEPALIVE)){

                        if($tmp_SMTP_KEEPALIVE){

                            $crnrstn_phpmailer->smtpClose();

                        }

                    }

                    break;
            }

        //}

        return true;

    }

    //
    // SOURCE :: https://www.youtube.com/watch?v=83KR_UBWdPI
    public function no_cars_tification_go($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj){

        switch($this->logging_profile){
            case CRNRSTN_LOG_DEFAULT:

                error_log(__LINE__.' env - Run DEFAULT...');
                return true;

            break;
            case CRNRSTN_LOG_EMAIL:

                //
                // DEFAULT CRNRSTN CONFIGURATION - RECOMMENDATION FOR CONFIG PRIORITY ::
                // EMAIL_PRIMARY = [n] USER SELECTION
                // EMAIL_SECONDARY = SENDMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // EMAIL_TERTIARY = MAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_QUATIARY = QMAIL (NO AUTHENTICATION) WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_PENTIARY = UNAUTHENTICATED SMTP WITH CRNRSTN WCR CONFIGURATION
                // *EMAIL_HEXAPOLYNOMIALLY = NULL MODE FIRE
                // * UNTESTED

                error_log(__LINE__.' ABOUT TO TRY TO no_cars_go_EMAIL()...');

                return $this->no_cars_go_EMAIL($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_EMAIL_PROXY:

                /*
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_SOAP_SVC_AUTH_KEY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CRNRSTN_PROXY_CONNECTION_ID'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOA_NAMESPACE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_URI'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WSDL_CACHE_TTL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['NUSOAP_USECURL'] = 1;

                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_SECRET_KEY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_CIPHER'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_OPTIONS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SOAP_ENCRYPT_HMAC_ALG'] = 1;

                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['EMAIL_PROTOCOL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTH'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SERVER'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PORT_OUTGOING'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_USERNAME'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_PASSWORD'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_TIMEOUT'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_KEEPALIVE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_SECURE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SMTP_AUTOTLS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DIBYA_SAHOO_SSL_CERT_BYPASS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SENDMAIL_PATH'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['USE_SENDMAIL_OPTIONS'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ALLOW_EMPTY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_NAME'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_NAME_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['FROM_EMAIL'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['REPLYTO_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CC_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['BCC_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['RECIPIENTS_EMAIL_PIPED'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['SUBJECT_LINE'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_HTML'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_BODY_TEXT'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['WORDWRAP'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['ISHTML'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['PRIORITY'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['CHARSET'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['MESSAGE_ENCODING'] = 1;
                $this->profile_endpoint_criteria_ARRAY[$log_profile_key]['DUP_SUPPRESS'] = 1;
                 * */
                //error_log(__LINE__.' env - would run no_cars_go_EMAIL_PROXY() now for :: '.$tmp_exception_output_str);
                //$tmp_resp = $this->no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);
                //error_log(__LINE__.' env - no_cars_go_EMAIL_PROXY return=['.$tmp_resp.']');
                //die();

                return $this->no_cars_go_EMAIL_PROXY($oCRNRSTN_n, $tmp_exception_output_str, $syslog_constant, $exception_method, $exception_runtime, $exception_systemtime, $exception_obj);

            break;
            case CRNRSTN_LOG_FILE:

                error_log(__LINE__.' ABOUT TO TRY TO no_cars_go_CRNRSTN_LOG_FILE()...');

                //
                // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

                    foreach($chunkArray0 as $data_attribute => $chunkArray1){

                        foreach($chunkArray1 as $content_count => $attribute_content){

                            error_log(__LINE__.' env - ['.$data_attribute.']['.$config_version.']['.$content_count.']['.$attribute_content.']');
                            $config_data_ARRAY[$config_version][$data_attribute][$content_count] = $attribute_content;

                        }

                    }

                }

                return true;

            break;
            case CRNRSTN_LOG_FILE_FTP:

                //
                // REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
                foreach($this->profile_endpoint_data_ARRAY as $config_version => $chunkArray0){

                    foreach($chunkArray0 as $data_attribute => $chunkArray1){

                        foreach($chunkArray1 as $content_count => $attribute_content){

                            error_log('2286 env - ['.$data_attribute.']['.$config_version.']['.$content_count.']['.$attribute_content.']');
                            $config_data_ARRAY[$config_version][$data_attribute][$content_count] = $attribute_content;

                        }

                    }

                }

            break;

        }

        return false;

    }

    public function clientSend_CRNRSTN_SOAP_REQUEST($SOAP_method, $SOAP_request, $SOAP_endpoint=NULL){

        if(!isset($SOAP_endpoint)){

            $SOAP_endpoint = $this->oSoapDataTransportLayer->preach('value', 'WSDL_URI');

        }

        $WSDL_cache_ttl = $this->oSoapDataTransportLayer->preach('value', 'WSDL_CACHE_TTL');
        $nusoap_useCURL = $this->oSoapDataTransportLayer->preach('value', 'NUSOAP_USECURL');

        //
        // INSTANTIATE SOAP CLIENT
        $this->oSoapClient = new crnrstn_soap_client_manager(self::$oCRNRSTN_n, $SOAP_endpoint, $WSDL_cache_ttl, $nusoap_useCURL);

        //return $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);
        self::$oCRNRSTN_n->print_r($SOAP_request, 'SEND CLIENT REQUEST :: '.$SOAP_method, NULL, __LINE__, __METHOD__, __FILE__);
        $tmp_resp = $this->oSoapClient->sendRequest_SOAP($SOAP_method, $SOAP_request);
        self::$oCRNRSTN_n->print_r($tmp_resp, 'OUTPUT SERVER RESPONSE :: '.$SOAP_method, NULL, __LINE__, __METHOD__, __FILE__);

        $tmp_title = 'Description: '.$SOAP_method.' returnError output.';
        $tmp_err = $this->oSoapClient->returnError();
        $tmp_arr = array();
        $tmp_arr[] = $tmp_title;
        $tmp_arr[] = $tmp_err;

        self::$oCRNRSTN_n->print_r($tmp_arr, 'SERVER RESPONSE :: '.$SOAP_method.' oSoapClient->returnError', NULL, __LINE__, __METHOD__, __FILE__);
        //self::$oCRNRSTN_n->print_r($this->oSoapClient->returnClientResponse(), 'SERVER RESPONSE :: '.$SOAP_method.' oSoapClient->returnClientResponse', NULL, __LINE__, __METHOD__, __FILE__);
        //self::$oCRNRSTN_n->print_r($this->oSoapClient->returnClientGetDebug(), 'SERVER RESPONSE :: '.$SOAP_method.' oSoapClient->returnClientGetDebug', NULL, __LINE__, __METHOD__, __FILE__);

        return $tmp_resp;
        //die();
    }

    private function next_mail_protocol_option($crnrstn_phpmailer){

        for($i=0; $i<$this->tmp_mail_protocol_options_cnt; $i++){

            if(!isset($this->mail_protocol_flag_ARRAY[$this->tmp_mail_protocol_options_ARRAY[$i]])){

                $this->mail_protocol_flag_ARRAY[$this->tmp_mail_protocol_options_ARRAY[$i]] = 1;

                switch($this->tmp_mail_protocol_options_ARRAY[$i]){
                    case 'SMTP':

                        $crnrstn_phpmailer->SMTPAuth = false;
                        $crnrstn_phpmailer->Mailer = strtolower($this->tmp_mail_protocol_options_ARRAY[$i]);

                    break;
                    default:

                        $crnrstn_phpmailer->Mailer = strtolower($this->tmp_mail_protocol_options_ARRAY[$i]);

                    break;
                }

                return $crnrstn_phpmailer;

            }

        }

        $crnrstn_phpmailer->SMTPAuth = false;
        $crnrstn_phpmailer->Mailer = '';

        return $crnrstn_phpmailer;

    }

    public function receive_profile_EMAIL_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM EMAIL PROFILE. RECEIVE EMAIL WCR DATA.
        $this->wcr_profiles_cnt++;

        //error_log(__LINE__.' profile_endpoint_criteria_ARRAY='.print_r($this->profile_endpoint_criteria_ARRAY, true));
        //
        // *ALL* POSSIBLE EMAIL WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL] as $param_key => $value){

            //error_log(__LINE__.' env - Checking for existence of '.$param_key.' data within config init oWCR, '.$WCR_key);

            if($oWCR->isset_WCR($WCR_key, $param_key)){

                //error_log(__LINE__.' env - Found existence of '.$param_key.' data within config init oWCR, '.$WCR_key);
                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

                if(isset($tmp_wcr_data)){

                    switch($param_key){
                        case 'RECIPIENTS_NAME_PIPED':
                        case 'REPLYTO_NAME_PIPED':
                        case 'CC_NAME_PIPED':
                        case 'BCC_NAME_PIPED':
                        break;
                        case 'RECIPIENTS_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'RECIPIENTS_NAME_PIPED');

                            if($tmp_name_data != ''){

                                $tmp_name_array = explode('|', $tmp_name_data);

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'REPLYTO_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'REPLYTO_NAME_PIPED');

                            if($tmp_name_data != ''){

                                $tmp_name_array = explode('|', $tmp_name_data);

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'CC_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'CC_NAME_PIPED');
                            //error_log(__LINE__.' env - CC_NAME_PIPED tmp_name_data='.$tmp_name_data);
                            if($tmp_name_data != ''){

                                $tmp_name_array = explode('|', $tmp_name_data);

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        case 'BCC_EMAIL_PIPED':

                            $tmp_name_array = array();
                            $tmp_name_data = $oWCR->get_attribute($WCR_key, 'BCC_NAME_PIPED');

                            if($tmp_name_data != ''){

                                $tmp_name_array = explode('|', $tmp_name_data);

                            }

                            $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                        break;
                        default:

                            //error_log(__LINE__.' env - profile_endpoint_data_ARRAY storing['.$this->wcr_profiles_cnt.']['.$param_key.']['.$tmp_wcr_data.']');
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

                        break;

                    }

                }

            }

        }

    }

    public function receive_profile_EMAIL($data, $param_key, $name_array = NULL){

        $this->isValid = true;

        //
        // I AM EMAIL PROFILE. RECEIVE EMAIL DATA.
        #$oWCR->add_attribute('RECIPIENTS_EMAIL_PIPED', 'Jonathan J5 Harris c00000101@gmail.com|jharris@eVifweb.com');
        #$oWCR->add_attribute('RECIPIENTS_NAME_PIPED', '|Jonathan J5 Harris');
        //error_log(__LINE__.' - I AM EMAIL PROFILE. RECEIVE EMAIL DATA. '.$data);
        $tmp_email_name_ARRAY = $this->reformat_pipe_data(CRNRSTN_LOG_EMAIL, $data);

        #$tmp_email_name_ARRAY['email'][]
        #$tmp_email_name_ARRAY['name'][]

        //return $tmp_email_name_ARRAY;
        $tmp_e_cnt = sizeof($tmp_email_name_ARRAY['email']);
        for($i=0; $i<$tmp_e_cnt; $i++){

            switch($param_key){
                case 'RECIPIENTS_EMAIL_PIPED':
                    //error_log(__LINE__.' env - storing RECIPIENT_EMAIL ['.$this->wcr_profiles_cnt.']['.$param_key.']['.self::$oCRNRSTN_n->stringSanitize($tmp_email_name_ARRAY['email'][$i], 'email_private').']');
                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_EMAIL'][] = 1;

                    if(isset($name_array[$i])){

                        if($name_array[$i] != ''){
                            //error_log('3062 env - ['.$param_key.'] name['.$i.']'.$name_array[$i]);
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] !=''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                            }

                        }

                    }else{

                        if(isset($tmp_email_name_ARRAY['name'][$i])){

                            if($tmp_email_name_ARRAY['name'][$i] != ''){

                                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                            }else{

                                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = '';

                            }

                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['RECIPIENT_NAME'][] = 1;

                        }

                    }

                break;
                case 'REPLYTO_EMAIL_PIPED':
                    //error_log(__LINE__.' env - storing REPLYTO_EMAIL_PIPED ['.$this->wcr_profiles_cnt.']['.$param_key.']['.self::$oCRNRSTN_n->stringSanitize($tmp_email_name_ARRAY['email'][$i], 'email_private').']');
                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;


                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = $tmp_email_name_ARRAY['name'][$i];
                                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = '';
                                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['REPLYTO_NAME'][] = 1;

                                }

                            }

                        }

                    }

                break;
                case 'CC_EMAIL_PIPED':

                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            //error_log(__LINE__.' env - CC_EMAIL_PIPED name data['.$i.'] saved='.$name_array[$i]);
                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = 1;


                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    //error_log(__LINE__.' env - CC_EMAIL_PIPED WCR name data['.$i.'] saved='.$tmp_email_name_ARRAY['name'][$i]);
                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    //error_log(__LINE__.' env - CC_EMAIL_PIPED WCR name data['.$i.'] saved=[\'\']');
                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['CC_NAME'][] = 1;

                            }

                        }

                    }

                break;
                case 'BCC_EMAIL_PIPED':

                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_EMAIL'][] = $tmp_email_name_ARRAY['email'][$i];
                    $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_EMAIL'][] = 1;

                    if(isset($name_array)){

                        if(isset($name_array[$i])){

                            $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = $name_array[$i];
                            $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = 1;

                        }else{

                            if(isset($tmp_email_name_ARRAY['name'][$i])){

                                if($tmp_email_name_ARRAY['name'][$i] != ''){

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = $tmp_email_name_ARRAY['name'][$i];

                                }else{

                                    $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = '';

                                }

                                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['BCC_NAME'][] = 1;

                            }

                        }

                    }

                break;

            }

        }

    }

    public function receive_profile_EMAIL_PROXY_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM EMAIL_PROXY PROFILE. RECEIVE EMAIL_PROXY WCR DATA.
        //error_log(__LINE__.' - I AM EMAIL_PROXY[WCR] PROFILE. RECEIVE EMAIL WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE EMAIL_PROXY WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL_PROXY] as $param_key => $value){

            // $this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_EMAIL_PROXY]['ISHTML'] = 1;
            if($oWCR->isset_WCR($WCR_key, $param_key)){

                $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key, true);

                switch($param_key){
                    case 'RECIPIENTS_NAME_PIPED':
                    case 'REPLYTO_NAME_PIPED':
                    case 'CC_NAME_PIPED':
                    case 'BCC_NAME_PIPED':
                    break;
                    case 'RECIPIENTS_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'RECIPIENTS_NAME_PIPED');

                        if($tmp_name_data != ''){

                            $tmp_name_array = explode('|', $tmp_name_data);

                        }

                        //$tmp_email_array = $this->receive_profile_EMAIL($tmp_wcr_data, $param_key);
                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'REPLYTO_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'REPLYTO_NAME_PIPED');

                        if($tmp_name_data != ''){

                            $tmp_name_array = explode('|', $tmp_name_data);

                        }

                        //$tmp_email_array = $this->receive_profile_EMAIL($tmp_wcr_data, $param_key);
                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'CC_EMAIL_PIPED':

                        $tmp_name_array = array();
                        $tmp_name_data = $oWCR->get_attribute($WCR_key, 'CC_NAME_PIPED');

                        if($tmp_name_data != ''){

                            $tmp_name_array = explode('|', $tmp_name_data);

                        }

                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    case 'BCC_EMAIL_PIPED':

                        $tmp_name_array = array();$tmp_name_data = $oWCR->get_attribute($WCR_key, 'BCC_NAME_PIPED');

                        if($tmp_name_data != ''){

                            $tmp_name_array = explode('|', $tmp_name_data);

                        }

                        $this->receive_profile_EMAIL($tmp_wcr_data, $param_key, $tmp_name_array);

                    break;
                    default:

                        //error_log(__LINE__.' env - ['.$this->wcr_profiles_cnt.']['.strtoupper($param_key).']['.$tmp_wcr_data.']');
                        $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                        $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

                    break;

                }

            }

        }

    }

    public function receive_profile_FTP_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FTP PROFILE. RECEIVE FTP WCR DATA.
        error_log('3343 - I AM FTP PROFILE. RECEIVE FTP WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FTP WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE_FTP] as $param_key => $value){

            $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

            if($tmp_wcr_data != ''){

                error_log(__LINE__.' env - Data from WCR['.$WCR_key.'] @ ['.$param_key.']=['.$tmp_wcr_data.']');
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_FILE_WCR($oWCR, $WCR_key){

        $this->isValid = true;

        //
        // I AM FILE PROFILE. RECEIVE FILE WCR DATA.
        error_log('3369 - I AM FILE[WCR] PROFILE. RECEIVE FILE WCR DATA. '.$WCR_key);
        $this->wcr_profiles_cnt++;

        //
        // *ALL* POSSIBLE FILE WCR KEYS
        foreach($this->profile_endpoint_criteria_ARRAY[CRNRSTN_LOG_FILE] as $param_key => $value){

            $tmp_wcr_data = $oWCR->get_attribute($WCR_key, $param_key);

            if($tmp_wcr_data != ''){

                //error_log('2174 env - Data from WCR['.$WCR_key.'] @ ['.$param_key.']=['.$tmp_wcr_data.']');
                $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = $tmp_wcr_data;
                $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt][strtoupper($param_key)][] = 1;

            }

        }

    }

    public function receive_profile_FILE($data){

        $this->isValid = true;

        //
        // I AM FILE PROFILE. RECEIVE FILE DATA.
        //error_log(__LINE__.' - I AM FILE PROFILE. RECEIVE FILE DATA. '.$data);
        $this->profile_endpoint_data_ARRAY[$this->wcr_profiles_cnt]['LOCAL_DIR_PATH'][] = $data;
        $this->profile_endpoint_set_flag_ARRAY[$this->wcr_profiles_cnt]['LOCAL_DIR_PATH'][] = 1;

    }

    public function return_profile(){

        return $this->logging_profile;

    }

    private function active_by_default($logging_profile){

        switch($logging_profile){
            case CRNRSTN_LOG_DEFAULT:
            case CRNRSTN_LOG_SCREEN_TEXT:
            case CRNRSTN_LOG_SCREEN:
            case CRNRSTN_LOG_SCREEN_HTML:
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                //$this->isValid = true;

            break;

        }

    }

    private function reformat_pipe_data($profile_key, $data){

        $tmp_array = array();

        switch($profile_key){
            case CRNRSTN_LOG_EMAIL:
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_pipe_to_array = explode('|', $data);

                if(count($tmp_pipe_to_array)<2){

                    $tmp_pipe_to_array = explode(',', $data);

                }

                foreach ($tmp_pipe_to_array as $key => $email_data){

                    $email_data = trim($email_data);

                    //
                    // @ SYMBOL ?. IF NO...SKIP...MAYBE LOG.
                    $pos_at = strpos($email_data, '@');
                    if($pos_at!==false){

                        //error_log('3523 env - WE HAVE EMAIL IN '.$email_data);
                        //
                        // WE HAVE EMAIL. CHECK FOR SPACES AS INDICATION OF PRESENCE OF NAME DATA
                        $pos_space = strpos($email_data, ' ');
                        if($pos_space === false){

                            //
                            // NO NAME DATA? CHECK FOR COMMA.
                            $pos_comma = strpos($email_data, ',');
                            if($pos_comma === false){

                                //
                                // YEP. JUST EMAIL.
                                $tmp_array['email'][] = $email_data;
                                $tmp_array['name'][] = '';

                            }else{

                                $tmp_name = '';

                                //
                                // EXPLODE ON COMMA AND PROCESS FOR SINGLE EMAIL AND NAME COMBO.
                                $tmp_comma_to_array = explode(',', $email_data);
                                foreach($tmp_comma_to_array as $commaKey => $comma_delim_data){

                                    $pos_at = strpos($comma_delim_data, '@');
                                    if($pos_at !== false){

                                        //
                                        // PROCESS EMAIL.
                                        $tmp_email = $comma_delim_data;

                                    }else{

                                        //
                                        // PROCESS NAME.
                                        if($comma_delim_data != ''){

                                            $tmp_name .= $comma_delim_data.' ';

                                        }

                                    }

                                }

                                $tmp_name = rtrim($tmp_name, ' ');

                                $tmp_array['email'][] = $tmp_email;
                                $tmp_array['name'][] = $tmp_name;

                            }

                        }else{

                            $tmp_name = '';
                            //error_log('3579 env - WE HAVE NAME DATA IN '.$email_data);

                            //
                            // CHECK FOR NAME AND EMAIL DUE TO SPACE.
                            $tmp_space_to_array = explode(' ', $email_data);
                            foreach($tmp_space_to_array as $spaceKey => $space_delim_data){

                                $pos_at = strpos($space_delim_data, '@');
                                if($pos_at !== false){

                                    //
                                    // PROCESS EMAIL.
                                    $tmp_email = $space_delim_data;

                                }else{

                                    //
                                    // PROCESS NAME.
                                    if($space_delim_data != ''){

                                        $tmp_name .= $space_delim_data.' ';
                                        //error_log('3600 env - BUILDING NAME=>'.$tmp_name);

                                    }

                                }

                            }

                            $tmp_name = rtrim($tmp_name, ' ');

                            $tmp_array['email'][] = $tmp_email;
                            $tmp_array['name'][] = $tmp_name;
                            //error_log('3615 env - ADDING NAME to tmp_array[\'name\']=>'.$tmp_name);

                        }

                    }else{

                        //
                        // NO EMAIL DATA IN THIS DATA!
                        if(is_object(self::$oCRNRSTN_n)){

                            self::$oCRNRSTN_n->error_log('The provided '.$profile_key.' data "'.$data.'" does not contain an email address, and it will be ignored.', __LINE__, __METHOD__, __FILE__,CRNRSTN_SETTINGS_CRNRSTN);

                        }

                    }

                }

            break;

        }

        //
        // $tmp_array['email'][]
        // $tmp_array['name'][]
        //error_log('3642 env - returning tmp_array[\'email\'] & [\'name\']');
        return $tmp_array;

    }

    private function consume_pipe_aligned_values($key_array, $aligns_to_key_array, $key, $is_WCR_data=false){

        if(isset($key_array)){

            //error_log('1775 env - '.sizeof($key_array).' data');

        }else{

            //error_log('1775 env - no data['.sizeof($key_array).']');
        }


        $tmp_index_pos = 0;

        try{

            switch($key){
                case CRNRSTN_LOG_DEFAULT:

                break;
                case CRNRSTN_LOG_EMAIL:
                    $tmp_cnt = sizeof($key_array);
                    for($i=0; $i<$tmp_cnt; $i++){

                        if($key_array[$i]!=''){

                            error_log('1794 env consume_pipe_aligned_values() - ['.$key_array.']');

                        }else{

                            error_log('1798 env consume_pipe_aligned_values() - ['.$key_array.'][size='.$tmp_cnt.']');

                        }

                    }

                    error_log('die() @  HELLO APR 8, 2021['.$key.']');
                    die();

                break;
                case 'EMAIL_PROXY':

                break;
                case 'FILE':

                break;
                case 'SCREEN_TEXT':

                break;
                case 'SCREEN':

                break;
                case 'SCREEN_HTML':

                break;
                case 'SCREEN_HTML_HIDDEN':

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unknown logging profile type of "'.$key.'" provided.');

                break;

            }

        }catch( Exception $e ) {

            $this->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function consume_logging_profile_pack($sys_logging_profile_pack = NULL){

        if(isset($sys_logging_profile_pack['sys_logging_profile'])){

            error_log(__LINE__.' env - we have sys_logging_profile_pack data...WHAT YOU DO HERE?');
            die();

            self::$sys_logging_profile_ARRAY = $sys_logging_profile_pack['sys_logging_profile'];
            self::$sys_logging_endpoint_ARRAY = $sys_logging_profile_pack['sys_logging_endpoint'];
            self::$sys_logging_wcr_ARRAY = $sys_logging_profile_pack['sys_logging_wcr'];

            self::$sys_logging_update_profile_ARRAY = $sys_logging_profile_pack['sys_logging_update_profile'];
            self::$sys_logging_update_endpoint_ARRAY = $sys_logging_profile_pack['sys_logging_update_endpoint'];

            $this->consume_pipe_aligned_values(self::$sys_logging_profile_ARRAY, self::$sys_logging_endpoint_ARRAY, $this->logging_profile);
            $this->consume_pipe_aligned_values(self::$sys_logging_profile_ARRAY, self::$sys_logging_wcr_ARRAY, $this->logging_profile, true);
            $this->consume_pipe_aligned_values(self::$sys_logging_update_profile_ARRAY, self::$sys_logging_update_endpoint_ARRAY, $this->logging_profile);

        }

    }

    /*
    private function isWildCardResourceKey($str_content){

        if(isset(self::$oCRNRSTN_n)){

            return self::$oCRNRSTN_n->isset_WCR($str_content);

        }else{

            return false;

        }

    }
    */

    public function load_CRNRSTN_ENV($oCRNRSTN_ENV){

        self::$oCRNRSTN_n = $oCRNRSTN_ENV;

    }

    private function load_log_output_mgr($oCRNRSTN_n){

        $this->oLog_output_manager = new crnrstn_log_output_manager($oCRNRSTN_n);

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_soap_services_authorization_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Thursday November 12, 2020 @ 1645hrs
#  DESCRIPTION :: Manage CRNRSTN :: SOAP Services layer authorization keys.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_soap_services_authorization_manager{

    protected $oLogger;
    private static $oCRNRSTN_ENV;

    public $serial;
    public $services_authorization_group_key;
    public $ISACTIVE = false;
    protected $resourceKey;

    protected $ip_auth_denial_ARRAY = array();
    protected $ip_auth_ARRAY = array();

    protected $soap_services_auth_key_ARRAY = array();
    protected $soap_services_resource_denyaccess_ARRAY = array();
    protected $soap_services_resource_access_ARRAY = array();

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $encryptOptions;
    protected $hmac_alg;

    public function __construct($envKey, $SOAP_AuthKey, $oCRNRSTN_ENV){

        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_ENV->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_ENV->log_silo_profile, self::$oCRNRSTN_ENV);

        $this->serial = self::$oCRNRSTN_ENV->generateNewKey(50);

        $tmp_resource_key = self::$oCRNRSTN_ENV->returnResourceKey();
        if(crc32($envKey) == $tmp_resource_key){

            $this->resourceKey = $tmp_resource_key;
            $this->ISACTIVE = true;

            $this->soap_services_auth_key_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $SOAP_AuthKey;

            self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

        }

    }

    public function return_soap_services_IP_access_ARRAY(){

        return $this->ip_auth_ARRAY;

    }

    public function return_soap_services_IP_denyaccess_ARRAY(){

        return $this->ip_auth_denial_ARRAY;

    }

    public function return_soap_services_auth_key_ARRAY(){

        return $this->soap_services_auth_key_ARRAY;

    }

    public function return_soap_services_resource_denyaccess_ARRAY(){

        return $this->soap_services_resource_denyaccess_ARRAY;

    }

    public function return_soap_services_resource_access_ARRAY(){

        return $this->soap_services_resource_access_ARRAY;

    }

    public function sync_IP_denyAccess($ip){

        $this->ip_auth_denial_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_IP_exclusiveAccess($ip){

        $this->ip_auth_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_update_permissions($soap_services_resource_access_ARRAY, $soap_services_resource_denyaccess_ARRAY){

        foreach($soap_services_resource_access_ARRAY as $key => $resource){

            $this->soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $resource;

        }

        foreach($soap_services_resource_denyaccess_ARRAY as $key => $resource){

            $this->soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $resource;

        }

        self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

    }

    public function sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $this->encryptCipher = $encryptCipher;
        $this->encryptSecretKey = $encryptSecretKey;
        $this->hmac_alg = $hmac_alg;
        $this->encryptOptions = $encryptOptions;

    }

    public function update_permissions($authorized_resource_pipe){

        if($this->ISACTIVE) {

            $tmp_resource_access_profile_ARRAY = explode('|', $authorized_resource_pipe);
            $tmp_cnt = sizeof($tmp_resource_access_profile_ARRAY);
            $tmp_accept_array = array();
            $tmp_deny_array = array();

            for ($i = 0; $i < $tmp_cnt; $i++) {

                //
                // CHECK FOR NOT
                $pos_silo_tilde = strpos($tmp_resource_access_profile_ARRAY[$i], '~');

                if ($pos_silo_tilde !== false) {

                    //
                    // HONOR THE NEGATION
                    // STRIP ~ AND TRIM
                    $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
                    $tmp_clean_profile = trim($tmp_clean_silo_negation);
                    $this->soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $tmp_clean_profile;

                    error_log(__LINE__.' env - negation of resource '.$tmp_clean_profile.' added ['.crc32(self::$oCRNRSTN_ENV->configSerial).']['.$this->resourceKey.']['.$this->serial.'].');

                } else {

                    $this->soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = trim($tmp_resource_access_profile_ARRAY[$i]);

                }

                if(isset($this->services_authorization_group_key)){

                    if ($pos_silo_tilde !== false) {

                        //
                        // HONOR THE NEGATION
                        // STRIP ~ AND TRIM
                        $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
                        $tmp_clean_profile = trim($tmp_clean_silo_negation);
                        $tmp_deny_array[] = $tmp_clean_profile;

                        error_log(__LINE__.' env - negation of resource '.$tmp_clean_profile.' added ['.crc32(self::$oCRNRSTN_ENV->configSerial).']['.$this->resourceKey.']['.$this->serial.'].');

                    } else {

                        $tmp_accept_array[] = trim($tmp_resource_access_profile_ARRAY[$i]);

                    }

                }

            }

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_update_permissions($this->serial, $this->services_authorization_group_key, $tmp_accept_array, $tmp_deny_array);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function override_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        if($this->ISACTIVE){

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_soap_encryption_config($this->serial, $this->services_authorization_group_key, $this->encryptCipher, $this->encryptSecretKey, $this->hmac_alg, $this->encryptOptions);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function IP_exclusiveAccess($ip){

        if($this->ISACTIVE) {

            $this->ip_auth_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_IP_exclusiveAccess($this->serial, $this->services_authorization_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function IP_denyAccess($ip){

        if($this->ISACTIVE) {

            $this->ip_auth_denial_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

            if(isset($this->services_authorization_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth_IP_denyAccess($this->serial, $this->services_authorization_group_key, $this->ip_auth_denial_ARRAY);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oAuth($this);

            }

        }

    }

    public function init_services_authorization_group_key(){

        if($this->ISACTIVE) {

            $this->services_authorization_group_key = self::$oCRNRSTN_ENV->generateNewKey(50);

        }

    }

    public function sync_to_services_authorization_group_key($services_authorization_group_key){

        if($this->ISACTIVE) {

            $this->services_authorization_group_key = $services_authorization_group_key;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_proxy_connection_id_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Thursday November 12, 2020 @ 1646hrs
#  DESCRIPTION :: Manage authorization profiles of CRNRSTN :: SOAP Services layer connection ids.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_soap_services_client_manager{

    protected $oLogger;
    private static $oCRNRSTN_ENV;
    public $ISACTIVE = false;

    protected $resourceKey;

    public $serial;
    public $services_client_group_key;
    public $CRNRSTN_NUSOAP_SVC_debugMode = 0;
    protected $soap_services_username_ARRAY = array();
    protected $soap_services_password_ARRAY = array();
    protected $soap_services_method_deactivate_ARRAY = array();
    protected $soap_services_method_activate_ARRAY = array();

    protected $ip_auth_ARRAY = array();
    protected $ip_auth_denial_ARRAY = array();

    protected $soap_services_resource_denyaccess_ARRAY = array();
    protected $soap_services_resource_access_ARRAY = array();

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $hmac_alg;
    protected $encryptOptions;

    public function __construct($envKey, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, $oCRNRSTN_ENV){

        self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_ENV->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_ENV->log_silo_profile, self::$oCRNRSTN_ENV);

        if(is_null($username)){


        }else{

            $this->CRNRSTN_NUSOAP_SVC_debugMode = $CRNRSTN_NUSOAP_SVC_debugMode;

            $this->serial = self::$oCRNRSTN_ENV->generateNewKey(50);

            if(crc32($envKey) == self::$oCRNRSTN_ENV->returnResourceKey()){

                $this->resourceKey = self::$oCRNRSTN_ENV->returnResourceKey();
                $this->ISACTIVE = true;

                $this->soap_services_username_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $username;
                $this->soap_services_password_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = md5($password);

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function return_soap_services_soap_encryption_config(){

        $tmp_array = array();

        //error_log(__LINE__.' env - this->encryptCipher = '.$this->encryptCipher);
        $tmp_array['encryptCipher'] = $this->encryptCipher;
        $tmp_array['encryptSecretKey'] = $this->encryptSecretKey;
        $tmp_array['hmac_alg'] = $this->hmac_alg;
        $tmp_array['encryptOptions'] = $this->encryptOptions;

        return $tmp_array;

    }

    public function return_soap_services_method_activate_ARRAY(){

        return $this->soap_services_method_activate_ARRAY;

    }

    public function return_soap_services_method_deactivate_ARRAY(){

        return $this->soap_services_method_deactivate_ARRAY;

    }

    public function return_soap_services_username_ARRAY(){

        return $this->soap_services_username_ARRAY;

    }

    public function return_soap_services_password_ARRAY(){

        return $this->soap_services_password_ARRAY;

    }

    public function return_soap_services_resource_denyaccess_ARRAY(){

        return $this->soap_services_resource_denyaccess_ARRAY;

    }

    public function return_soap_services_resource_access_ARRAY(){

        return $this->soap_services_resource_access_ARRAY;

    }

    public function return_soap_services_IP_access_ARRAY(){

        return $this->ip_auth_ARRAY;

    }

    public function return_soap_services_IP_denyaccess_ARRAY(){

        return $this->ip_auth_denial_ARRAY;

    }

    public function return_username(){

        return $this->soap_services_username_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][0];

    }

    public function return_password(){

        return $this->soap_services_password_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][0];

    }

    public function sync_update_permissions($soap_services_resource_access_ARRAY, $soap_services_resource_denyaccess_ARRAY){

        foreach($soap_services_resource_access_ARRAY as $key => $resource){

            $this->soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $resource;

        }

        foreach($soap_services_resource_denyaccess_ARRAY as $key => $resource){

            $this->soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $resource;

        }

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        $this->encryptCipher = $encryptCipher;
        $this->encryptSecretKey = $encryptSecretKey;
        $this->hmac_alg = $hmac_alg;
        $this->encryptOptions = $encryptOptions;

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);


    }

    public function sync_activate_SOAP_method($soap_services_method_activate_ARRAY, $soap_services_method_deactivate_ARRAY){

        foreach($soap_services_method_deactivate_ARRAY as $key => $method){

            $this->soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $method;

        }

        foreach($soap_services_method_activate_ARRAY as $key => $method){

            $this->soap_services_method_activate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $method;

        }

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_deactivate_SOAP_method($soap_services_method_deactivate_ARRAY){

        foreach($soap_services_method_deactivate_ARRAY as $key => $method){

            $this->soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $method;

        }

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_IP_denyAccess($ip){

        $this->ip_auth_denial_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function sync_IP_exclusiveAccess($ip){

        $this->ip_auth_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

        self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

    }

    public function update_permissions($authorized_resource_pipe){

        if($this->ISACTIVE) {

            $tmp_resource_access_profile_ARRAY = explode('|', $authorized_resource_pipe);
            $tmp_cnt = sizeof($tmp_resource_access_profile_ARRAY);
            $tmp_grant_array = array();
            $tmp_deny_array = array();

            for ($i = 0; $i < $tmp_cnt; $i++) {

                //
                // CHECK FOR NOT
                $pos_silo_tilde = strpos($tmp_resource_access_profile_ARRAY[$i], '~');

                if ($pos_silo_tilde !== false) {

                    //
                    // HONOR THE NEGATION
                    // STRIP ~ AND TRIM
                    $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
                    $tmp_clean_profile = trim($tmp_clean_silo_negation);
                    $this->soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $tmp_clean_profile;

                } else {

                    $this->soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = trim($tmp_resource_access_profile_ARRAY[$i]);

                }

                if(isset($this->services_client_group_key)){

                    if ($pos_silo_tilde !== false) {

                        //
                        // HONOR THE NEGATION
                        // STRIP ~ AND TRIM
                        $tmp_clean_silo_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_resource_access_profile_ARRAY[$i]);
                        $tmp_clean_profile = trim($tmp_clean_silo_negation);
                        $tmp_deny_array[] = $tmp_clean_profile;

                    } else {

                        $tmp_grant_array[] = trim($tmp_resource_access_profile_ARRAY[$i]);

                    }

                }

            }

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_update_permissions($this->serial, $this->services_client_group_key, $tmp_grant_array, $tmp_deny_array);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function override_soap_encryption_config($encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        if($this->ISACTIVE){

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            if(isset($this->services_client_group_key)){

                //error_log(__LINE__.' env oClient GROUP override_soap_encryption_config ['.$encryptCipher.']['.$encryptSecretKey.']['.$hmac_alg.']['.$encryptOptions.']');
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_soap_encryption_config($this->serial, $this->services_client_group_key, $this->encryptCipher, $this->encryptSecretKey, $this->hmac_alg, $this->encryptOptions);

            }else{

                //error_log(__LINE__.' env oClient SINGLE override_soap_encryption_config ['.$encryptCipher.']['.$encryptSecretKey.']['.$hmac_alg.']['.$encryptOptions.']');
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function activate_SOAP_method($method){

        if($this->ISACTIVE){

            $tmp_method_access_profile_ARRAY = explode('|', $method);
            $tmp_cnt = sizeof($tmp_method_access_profile_ARRAY);
            $tmp_group_activate_ARRAY = array();
            $tmp_group_deactivate_ARRAY = array();

            for ($i = 0; $i < $tmp_cnt; $i++) {

                $pos_tilde = strpos($tmp_method_access_profile_ARRAY[$i],'~');
                if($pos_tilde !== false){

                    $tmp_clean_method_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                    $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                    $this->soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $tmp_clean_method_negation;

                }else{

                    $this->soap_services_method_activate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $tmp_method_access_profile_ARRAY[$i];

                }

                if(isset($this->services_client_group_key)){
                    if($pos_tilde !== false){

                        $tmp_clean_method_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                        $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                        $tmp_group_deactivate_ARRAY[] = $tmp_clean_method_negation;

                    }else{

                        $tmp_group_activate_ARRAY[] = $tmp_method_access_profile_ARRAY[$i];

                    }

                }

            }

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_activate_SOAP_method($this->serial, $this->services_client_group_key, $tmp_group_activate_ARRAY, $tmp_group_deactivate_ARRAY);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function deactivate_SOAP_method($method){

        if($this->ISACTIVE){

            $tmp_method_access_profile_ARRAY = explode('|', $method);
            $tmp_cnt = sizeof($tmp_method_access_profile_ARRAY);
            $tmp_deny_array = array();

            for ($i = 0; $i < $tmp_cnt; $i++) {

                $pos_tilde = strpos($tmp_method_access_profile_ARRAY[$i],'~');
                if($pos_tilde !== false){

                    $tmp_clean_method_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                    $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                    $this->soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $tmp_clean_method_negation;

                }else{

                    $this->soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $tmp_method_access_profile_ARRAY[$i];

                }

                if(isset($this->services_authorization_group_key)){

                    if($pos_tilde !== false){

                        $tmp_clean_method_negation = self::$oCRNRSTN_ENV->properReplace('~', '', $tmp_method_access_profile_ARRAY[$i]);
                        $tmp_clean_method_negation = trim($tmp_clean_method_negation);
                        $tmp_deny_array[] = $tmp_clean_method_negation;

                    }else{

                        $tmp_deny_array[] = $tmp_method_access_profile_ARRAY[$i];

                    }

                }

            }

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_deactivate_SOAP_method($this->serial, $this->services_client_group_key, $tmp_deny_array);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function IP_exclusiveAccess($ip){

        if($this->ISACTIVE){

            $this->ip_auth_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_IP_exclusiveAccess($this->serial, $this->services_client_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }

    }

    public function IP_denyAccess($ip){

        if($this->ISACTIVE){

            $this->ip_auth_denial_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][$this->resourceKey][$this->serial][] = $ip;

            if(isset($this->services_client_group_key)){

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);
                self::$oCRNRSTN_ENV->update_SOAP_services_oClient_IP_denyAccess($this->serial, $this->services_client_group_key, $ip);

            }else{

                self::$oCRNRSTN_ENV->update_SOAP_services_oClient($this);

            }

        }
        
    }

    public function init_services_client_group(){

        if($this->ISACTIVE) {

            $this->services_client_group_key = self::$oCRNRSTN_ENV->generateNewKey(50);

        }

    }

    public function sync_to_services_client_group($services_client_group_key){

        if($this->ISACTIVE) {

            $this->services_client_group_key = $services_client_group_key;

        }

    }

    public function __destruct() {

    }

}

# # C # R # N # R # S # T # N # : : # # ##
#  CLASS :: crnrstn_soap_services_access_manager
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: Friday November 13, 2020 @ 1352hrs
#  DESCRIPTION :: Manage SOAP handshake and alignment to and with CRNRSTN :: SOAP Services layer and determine
#  authorization for access unto the same.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
class crnrstn_soap_services_access_manager{

    protected $oLogger;
    private static $oCRNRSTN_ENV;

    protected $encryptCipher;
    protected $encryptSecretKey;
    protected $encryptOptions;
    protected $hmac_alg;
    public $CRNRSTN_NUSOAP_SVC_debugMode;
    public $ISACTIVE = false;

    protected $SOAP_oAuth_ARRAY = array();
    protected $SOAP_oClient_ARRAY = array();

    public $serial;

    public function __construct($envKey, $CRNRSTN_NUSOAP_SVC_debugMode, $oCRNRSTN_ENV){

        if(crc32($envKey) == $oCRNRSTN_ENV->returnResourceKey()){

            self::$oCRNRSTN_ENV = $oCRNRSTN_ENV;

            $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_ENV->CRNRSTN_debugMode, __CLASS__, self::$oCRNRSTN_ENV->log_silo_profile, self::$oCRNRSTN_ENV);

            $this->serial = self::$oCRNRSTN_ENV->generateNewKey(50);

            $this->ISACTIVE = true;

            $this->CRNRSTN_NUSOAP_SVC_debugMode = $CRNRSTN_NUSOAP_SVC_debugMode;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            $this->resourceKey = '';

        }else{

            error_log(__LINE__.' '.__METHOD__.' $envKey is not match...so construct fail...'.$envKey);

        }

    }

    public function isAuthorized_oAuth($CRNRSTN_SOAP_SVC_AUTH_KEY, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES){

        //
        // SUPPORT FOR OPEN PROXY
        $tmp_is_authorized = true;

        error_log(__LINE__.' env - checking oAuth ['.$CRNRSTN_SOAP_SVC_AUTH_KEY.']['.$CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES.']');
        foreach($this->SOAP_oAuth_ARRAY as $serial => $SOAP_oAuth){

            $wildcard_honor = false;

            if(!isset($mandatory_match_fulfilled_flag)){

                $mandatory_match_fulfilled_flag = false;

            }

            if($SOAP_oAuth->ISACTIVE){

                //
                // NOT JUST IS VALID CHECK.
                // AGGREGATE ALL AUTH CHECKS HERE (LIST THEM), AND THEN, TRACE ALL DATA DEPENDENCIES...BRING THEM HERE.
                $tmp_return_soap_services_auth_key_ARRAY = $SOAP_oAuth->return_soap_services_auth_key_ARRAY();
                $tmp_return_soap_services_resource_denyaccess_ARRAY = $SOAP_oAuth->return_soap_services_resource_denyaccess_ARRAY();
                $tmp_return_soap_services_resource_access_ARRAY = $SOAP_oAuth->return_soap_services_resource_access_ARRAY();

                //error_log(__LINE__.' SERVER env die() - ['.$serial.'] ::'.print_r($tmp_return_soap_services_auth_key_ARRAY, true));

                $tmp_requested_resources_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

                if(in_array('*', $tmp_return_soap_services_auth_key_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial])){

                    //
                    // WILDCARD AUTH KEY PROVIDED. ANY AUTH KEY (INCLUDING NULL) IS ACCEPTABLE.
                    $wildcard_honor = true;

                }

                if(isset($tmp_return_soap_services_auth_key_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial])){

                    foreach ($tmp_return_soap_services_auth_key_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial] as $key0 => $auth_key) {

                        //error_log(__LINE__.' env - ['.$auth_key.']==['.$CRNRSTN_SOAP_SVC_AUTH_KEY.']');
                        if($auth_key == $CRNRSTN_SOAP_SVC_AUTH_KEY || $wildcard_honor){
                            //
                            // WE HAVE CRNRSTN :: SOAP SERVICES LAYER oAuth OBJECT TO VERIFY THIS REQUEST AGAINST
                            //error_log(__LINE__.' SERVER env - soap_services_auth_key ['.$SOAP_oAuth->serial.'] VALIDATION GOING IN FOR '.$auth_key);
                            $mandatory_match_fulfilled_flag = true;

                            //
                            // DENY ACCESS
                            if(isset($tmp_return_soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial])){

                                //error_log(__LINE__.' SERVER env - we have tmp_return_soap_services_resource_denyaccess_ARRAY data['.sizeof($tmp_return_soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial]).'].');
                                foreach($tmp_return_soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()] as $key1 => $SOAP_resource){

                                    //error_log(__LINE__.' SERVER env - looking to honor denial of '.$SOAP_resource.', if requested.');

                                    //
                                    // IS THE CLIENT ASKING FOR RESOURCES WHICH ARE DENIED TO THIS AUTHORIZATION KEY?
                                    if(in_array($SOAP_resource, $tmp_requested_resources_ARRAY)){

                                        error_log(__LINE__.' SERVER env - ACCESS DENIED ON ACCOUNT OF THE '.$SOAP_resource.' CRNRSTN :: SOAP SERVICES RESOURCE THAT IS REQUESTED...NOTE THAT '.$SOAP_resource.' HAS ALSO BEEN CONFIGURED AT THIS PROXY PROFILE TO BE DENIED TO THIS AUTH KEY.');
                                        $tmp_is_authorized = false;

                                    }

                                }

                            }

                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial])){

                                    foreach($tmp_requested_resources_ARRAY as $key2 => $resource_req){

                                        //error_log(__LINE__.' env - $resource_req='.$resource_req);
                                        $tmp_SOAP_resource = false;

                                        foreach($tmp_return_soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial] as $key1 => $SOAP_resource){
                                            //error_log(__LINE__.' env - $SOAP_resource='.print_r($SOAP_resource, true));

                                            if($SOAP_resource == $resource_req){

                                                error_log(__LINE__.' SERVER env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for '.$SOAP_resource);
                                                $tmp_SOAP_resource = true;

                                            }

                                        }

                                        //
                                        // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                        if(!$tmp_SOAP_resource){

                                            error_log(__LINE__.' SERVER env - ACCESS DENIED ON ACCOUNT OF RESOURCE REQUESTED NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS AUTH KEY.');
                                            $tmp_is_authorized = false;

                                        }

                                    }

                                }else{

                                    error_log(__LINE__.' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_denyaccess_ARRAY = $SOAP_oAuth->return_soap_services_IP_denyaccess_ARRAY();

                    //
                    // CHECK IP ACCESS - DENY
                    if(isset($tmp_return_soap_services_IP_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial])){

                        foreach($tmp_return_soap_services_IP_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial] as $key1 => $ip){

                            error_log(__LINE__.' SERVER env - checking denyIPAccess() on '.$ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip)){

                                error_log(__LINE__.' SERVER env - BY IP...YOU ARE TO BE DENIED...'.self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_access_ARRAY = $SOAP_oAuth->return_soap_services_IP_access_ARRAY();

                    //
                    // CHECK IP ACCESS - EXCLUSIVE ACCESS
                    if(isset($tmp_return_soap_services_IP_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial])){

                        foreach($tmp_return_soap_services_IP_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oAuth->serial] as $key => $ip){

                            //if(is_array($ip)){

                            //    self::$oCRNRSTN_ENV->print_r($ip, '', NULL, __LINE__, __METHOD__, __FILE__);
                            //    error_log(__LINE__.' SERVER env - die()::['.$key.'] '.print_r($ip, true));
                            //    die();

                            //}

                            //error_log(__LINE__.' SERVER env checking exclusiveAccess() on '.$ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip)){

                                //error_log(__LINE__.' SERVER env - BY IP...YOU ARE TO BE GRANTED ACCESS...'.self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());

                            }else{

                                error_log(__LINE__.' SERVER env - BY IP...YOU ARE TO BE DENIED...'.self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

            }

        }

        if($tmp_is_authorized && isset($mandatory_match_fulfilled_flag)){

            if(!$mandatory_match_fulfilled_flag){

                error_log(__LINE__.' SERVER env - THIS IS NOT AN OPEN PROXY. ACCESS DENIED ON ACCOUNT OF AT LEAST ONE AUTH KEY BEING CONFIGURED AT PROXY, BUT NO SUBSEQUENT MANDATORY MATCH WAS FULFILLED BY THE CLIENT.');
                $tmp_is_authorized = false;

            }

        }

        error_log(__LINE__.' SERVER env - returning oAuth validation result of ['.$tmp_is_authorized.'].');
        return $tmp_is_authorized;

    }

    public function isAuthorized_oClient($USERNAME, $PASSWORD, $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES, $CRNRSTN_SOAP_SVC_METHOD_REQUESTED, $CRNRSTN_SOAP_ACTION_TYPE){

        //
        // SUPPORT FOR OPEN PROXY
        $tmp_is_authorized = true;

        error_log(__LINE__.' SERVER env - checking oClient ['.$USERNAME.']['.$PASSWORD.']['.$CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES.']['.$CRNRSTN_SOAP_SVC_METHOD_REQUESTED.']['.$CRNRSTN_SOAP_ACTION_TYPE.']');
        foreach($this->SOAP_oClient_ARRAY as $serial => $SOAP_oClient){

            if(!isset($mandatory_match_fulfilled_flag)){

                $mandatory_match_fulfilled_flag = false;

            }

            if($SOAP_oClient->ISACTIVE){

                //
                // NOT JUST IS VALID CHECK.
                // AGGREGATE ALL AUTH CHECKS HERE (LIST THEM), AND THEN, TRACE ALL DATA DEPENDENCIES...BRING THEM HERE.
                $tmp_return_soap_services_username_ARRAY = $SOAP_oClient->return_soap_services_username_ARRAY();
                $tmp_return_soap_services_password_ARRAY = $SOAP_oClient->return_soap_services_password_ARRAY();
                $tmp_return_soap_services_resource_denyaccess_ARRAY = $SOAP_oClient->return_soap_services_resource_denyaccess_ARRAY();
                $tmp_return_soap_services_resource_access_ARRAY = $SOAP_oClient->return_soap_services_resource_access_ARRAY();
                $tmp_return_soap_services_method_activate_ARRAY = $SOAP_oClient->return_soap_services_method_activate_ARRAY();
                $tmp_return_soap_services_method_deactivate_ARRAY = $SOAP_oClient->return_soap_services_method_deactivate_ARRAY();

                $tmp_requested_resources_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_REQUESTED_RESOURCES);

                if(isset($tmp_return_soap_services_username_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                    foreach ($tmp_return_soap_services_username_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial] as $key0 => $username) {

                        if($username == $USERNAME){

                            if(self::$oCRNRSTN_ENV->validate_pwdHash_LOGIN_storage($tmp_return_soap_services_password_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial][$key0], $PASSWORD)){

                                error_log(__LINE__.' SERVER env - CRNRSTN :: SOAP SERVICES CLIENT LOGIN VALID. ['.$USERNAME.']['.$PASSWORD.']['.$tmp_return_soap_services_password_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial][$key0].']');

                            }else{

                                error_log(__LINE__.' SERVER env - CRNRSTN :: SOAP SERVICES CLIENT LOGIN INVALID. ['.$USERNAME.']['.$PASSWORD.']['.$tmp_return_soap_services_password_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial][$key0].']');

                            }

                            //
                            // WE HAVE CRNRSTN :: SOAP SERVICES LAYER oAuth OBJECT TO VERIFY THIS REQUEST AGAINST
                            error_log(__LINE__.' SERVER env - isAuthorized_oClient ['.$SOAP_oClient->serial.'] VALIDATION GOING IN FOR '.$username);
                            $mandatory_match_fulfilled_flag = true;

                            //
                            // DENY ACCESS
                            if(isset($tmp_return_soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                                error_log(__LINE__.' SERVER env - we have tmp_return_soap_services_resource_denyaccess_ARRAY data['.sizeof($tmp_return_soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial]).'].');
                                foreach($tmp_return_soap_services_resource_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()] as $key1 => $SOAP_resource){

                                    error_log(__LINE__.' SERVER env - looking to honor denial of '.$SOAP_resource.', if requested.');

                                    //
                                    // IS THE CLIENT ASKING FOR RESOURCES WHICH ARE DENIED TO THIS AUTHORIZATION KEY?
                                    if(in_array($SOAP_resource, $tmp_requested_resources_ARRAY)){

                                        error_log(__LINE__.' SERVER env - ACCESS DENIED ON ACCOUNT OF THE '.$SOAP_resource.' CRNRSTN :: SOAP SERVICES RESOURCE THAT IS REQUESTED...NOTE THAT '.$SOAP_resource.' HAS ALSO BEEN CONFIGURED AT THIS PROXY PROFILE TO BE DENIED TO THIS CLIENT.');
                                        $tmp_is_authorized = false;

                                    }

                                }

                            }

                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                                    foreach($tmp_requested_resources_ARRAY as $key2 => $resource_req){

                                        $tmp_SOAP_resource = false;

                                        foreach($tmp_return_soap_services_resource_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                            if($SOAP_resource == $resource_req){

                                                //error_log(__LINE__.' env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for '.$SOAP_resource);
                                                $tmp_SOAP_resource = true;

                                            }

                                        }

                                        //
                                        // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                        if(!$tmp_SOAP_resource){

                                            error_log(__LINE__.' SERVER env - ACCESS DENIED ON ACCOUNT OF RESOURCE REQUESTED NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                            $tmp_is_authorized = false;

                                        }

                                    }

                                }else{

                                    error_log(__LINE__.' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                            //
                            // CRNRSTN :: SOAP SERVICES LAYER METHOD AUTHORIZATION
                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_method_activate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                                    if(sizeof($tmp_return_soap_services_method_activate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])>0){

                                        $tmp_req_methods_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_METHOD_REQUESTED);

                                        foreach($tmp_req_methods_ARRAY as $key2 => $method_req){

                                            $tmp_SOAP_resource = false;

                                            foreach($tmp_return_soap_services_method_activate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                                if($SOAP_resource == $method_req){

                                                    //error_log(__LINE__.' env - soap_services_auth_key GRANT RESOURCE ACCESS = TRUE for '.$SOAP_resource);
                                                    $tmp_SOAP_resource = true;

                                                }

                                            }

                                            //
                                            // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                            if(!$tmp_SOAP_resource){

                                                error_log(__LINE__.' SERVER env - ACCESS DENIED ON ACCOUNT OF A REQUESTED METHOD NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                                $tmp_is_authorized = false;

                                            }

                                        }

                                    }

                                }else{

                                    error_log(__LINE__.' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                            //
                            // CRNRSTN :: SOAP SERVICES LAYER METHOD AUTHORIZATION
                            if($tmp_is_authorized){

                                $tmp_SOAP_resource = true;

                                if(isset($tmp_return_soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                                    if(sizeof($tmp_return_soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])>0){

                                        $tmp_req_methods_ARRAY = explode('|', $CRNRSTN_SOAP_SVC_METHOD_REQUESTED);

                                        foreach($tmp_req_methods_ARRAY as $key2 => $method_req){

                                            $tmp_SOAP_resource = false;

                                            foreach($tmp_return_soap_services_method_deactivate_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial] as $key1 => $SOAP_resource){

                                                if($SOAP_resource == $method_req){

                                                    $tmp_SOAP_resource = true;

                                                }

                                            }

                                            //
                                            // ALL REQUESTED RESOURCES MUST BE LISTED AS AUTHORIZED FOR THIS AUTHORIZATION KEY.
                                            if(!$tmp_SOAP_resource){

                                                error_log(__LINE__.' SERVER env - ACCESS DENIED ON ACCOUNT OF A REQUESTED METHOD NOT BEING FOUND WITHIN THE PROXY PROFILE CONFIGURATION FOR THIS CLIENT.');
                                                $tmp_is_authorized = false;

                                            }

                                        }

                                    }

                                }else{

                                    error_log(__LINE__.' SERVER env - NEW ARRAY STRUCT...NOT SEEING.');

                                }

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_denyaccess_ARRAY = $SOAP_oClient->return_soap_services_IP_denyaccess_ARRAY();

                    //
                    // CHECK IP ACCESS - DENY
                    if(isset($tmp_return_soap_services_IP_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                        foreach($tmp_return_soap_services_IP_denyaccess_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial] as $key => $ip){

                            error_log(__LINE__.' SERVER env checking denyIPAccess() on '.$ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($ip)){

                                error_log(__LINE__.' SERVER env - BY IP...YOU ARE TO BE DENIED...'.self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

                if($tmp_is_authorized){

                    $tmp_return_soap_services_IP_access_ARRAY = $SOAP_oClient->return_soap_services_IP_access_ARRAY();

                    //
                    // CHECK IP ACCESS - EXCLUSIVE ACCESS
                    if(isset($tmp_return_soap_services_IP_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial])){

                        foreach($tmp_return_soap_services_IP_access_ARRAY[crc32(self::$oCRNRSTN_ENV->configSerial)][self::$oCRNRSTN_ENV->returnResourceKey()][$SOAP_oClient->serial] as $key => $ip){

                            //error_log(__LINE__.' SERVER env checking exclusiveAccess() on '.$ip);
                            if(self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($ip)){

                                //error_log(__LINE__.' SERVER env - BY IP...YOU ARE TO BE GRANTED ACCESS...'.self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());

                            }else{

                                error_log(__LINE__.' SERVER env - BY IP...YOU ARE TO BE DENIED...'.self::$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->clientIpAddress());
                                $tmp_is_authorized = false;

                            }

                        }

                    }

                }

            }else{

                //error_log(__LINE__.' SERVER env - $SOAP_oClient is NOT ACTIVE.');

            }

        }

        if($tmp_is_authorized && isset($mandatory_match_fulfilled_flag)){

            if(!$mandatory_match_fulfilled_flag){

                error_log(__LINE__.' SERVER env - THIS IS NOT AN OPEN PROXY. ACCESS DENIED ON ACCOUNT OF AT LEAST ONE AUTH KEY BEING CONFIGURED AT PROXY, BUT NO SUBSEQUENT MANDATORY MATCH WAS FULFILLED BY THE CLIENT.');
                $tmp_is_authorized = false;

            }

        }

        return $tmp_is_authorized;

    }

    public function return_soap_encryption_config_param($param_key){

        switch($param_key){
            case 'SOAP_ENCRYPT_CIPHER':

                return $this->encryptCipher;

            break;
            case 'SOAP_ENCRYPT_SECRET_KEY':

                return $this->encryptSecretKey;

            break;
            case 'SOAP_ENCRYPT_HMAC_ALG':

                return $this->hmac_alg;

            break;
            case 'SOAP_ENCRYPT_OPTIONS':

                return $this->encryptOptions;

            break;
            default:

                return false;

            break;

        }

    }

    public function init_soap_encryption_config($envKey, $encryptCipher, $encryptSecretKey, $hmac_alg, $encryptOptions){

        if($this->ISACTIVE){

            $this->encryptCipher = $encryptCipher;
            $this->encryptSecretKey = $encryptSecretKey;
            $this->hmac_alg = $hmac_alg;
            $this->encryptOptions = $encryptOptions;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

        }

    }

    public function generate_SOAPAuthKey($envKey, $SOAP_AuthKey = '*'){

        if($this->ISACTIVE){

            $SOAP_oAuth = new crnrstn_soap_services_authorization_manager($envKey, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

            $this->SOAP_oAuth_ARRAY[$SOAP_oAuth->serial] = $SOAP_oAuth;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            return $SOAP_oAuth;

        }

    }

    public function generate_SOAPAuthKeyInGroup($envKey, $SOAP_AuthKey='*', $SOAP_oAuth = NULL){

        if($this->ISACTIVE){

            if(isset($SOAP_oAuth)){

                $tmp_SOAP_oAuth = new crnrstn_soap_services_authorization_manager($envKey, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

                $tmp_SOAP_oAuth->sync_to_services_authorization_group_key($SOAP_oAuth->services_authorization_group_key);

                $this->SOAP_oAuth_ARRAY[$tmp_SOAP_oAuth->serial] = $tmp_SOAP_oAuth;
                //error_log(__LINE__.' SERVER env - gkey['.$SOAP_oAuth->services_authorization_group_key.']['.$tmp_SOAP_oAuth->serial.'] $SOAP_AuthKey='.$SOAP_AuthKey);

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $tmp_SOAP_oAuth;

            }else{

                $SOAP_oAuth = new crnrstn_soap_services_authorization_manager($envKey, $SOAP_AuthKey, self::$oCRNRSTN_ENV);

                $SOAP_oAuth->init_services_authorization_group_key();

                $this->SOAP_oAuth_ARRAY[$SOAP_oAuth->serial] = $SOAP_oAuth;
                //error_log(__LINE__.' SERVER env - origin gkey['.$SOAP_oAuth->services_authorization_group_key.']['.$SOAP_oAuth->serial.'] $SOAP_AuthKey='.$SOAP_AuthKey);

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $SOAP_oAuth;

            }

        }

    }

    public function addClient($envKey, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode = 0){

        if($this->ISACTIVE) {
            
            $SOAP_oClient = new crnrstn_soap_services_client_manager($envKey, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

            $this->SOAP_oClient_ARRAY[$SOAP_oClient->serial] = $SOAP_oClient;

            self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

            return $SOAP_oClient;
        }

    }

    public function addClientToGroup($envKey, $username, $password, $SOAP_oClient = NULL, $CRNRSTN_NUSOAP_SVC_debugMode = false){

        if($this->ISACTIVE){

            if(isset($SOAP_oClient)){

                $tmp_SOAP_oClient = new crnrstn_soap_services_client_manager($envKey, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

                $tmp_SOAP_oClient->sync_to_services_client_group($SOAP_oClient->services_client_group_key);

                $this->SOAP_oClient_ARRAY[$tmp_SOAP_oClient->serial] = $tmp_SOAP_oClient;

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $tmp_SOAP_oClient;

            }else{

                $SOAP_oClient = new crnrstn_soap_services_client_manager($envKey, $username, $password, $CRNRSTN_NUSOAP_SVC_debugMode, self::$oCRNRSTN_ENV);

                $SOAP_oClient->init_services_client_group();

                $this->SOAP_oClient_ARRAY[$SOAP_oClient->serial] = $SOAP_oClient;

                self::$oCRNRSTN_ENV->update_SOAP_services_access_manager($this);

                return $SOAP_oClient;

            }

        }
        
    }

    public function __destruct() {

    }

}