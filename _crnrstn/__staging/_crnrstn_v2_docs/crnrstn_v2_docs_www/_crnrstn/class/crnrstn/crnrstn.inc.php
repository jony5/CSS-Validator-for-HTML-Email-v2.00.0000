<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to both facilitate, augment, and enhance basic operations of code base for an application across multiple hosting environments.
#  Copyright (C) 2012-2020 eVifweb development
#  VERSION :: 2.0.0 on Sun May 31, 2020 at 1259
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#		application from one environment to the next without having to change your code-base to account for environmentally 
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::

#  MIT LICENSE :: Copyright 2018 Jonathan J5 Harris
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:

#		The above copyright notice and this permission notice shall be included in all copies or substantial portions 
#		of the Software.

#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS 
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/*
// CLASS :: crnrstn
// AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
// VERSION :: 1.0.1
*/
class crnrstn {

	protected $oLogger;
	public static $log_profl_ARRAY = array();
	public static $log_endpt_ARRAY = array();
	public static $log_wcr_ARRAY = array();
	
	public $configSerial;
	
	public $opensslSessEncryptCipher = array();
	public $opensslSessEncryptSecretKey = array();
	public $opensslSessEncryptOptions = array();
	public $sessHmac_algorithm = array();
	
	public $opensslCookieEncryptCipher = array();
	public $opensslCookieEncryptSecretKey = array();
	public $opensslCookieEncryptOptions = array();
	public $cookieHmac_algorithm = array();
	
	public $opensslTunnelEncryptCipher = array();
	public $opensslTunnelEncryptSecretKey = array();
	public $opensslTunnelEncryptOptions = array();
	public $tunnelHmac_algorithm = array();
	
	private static $handle_srvr_ARRAY = array();

	private static $env_detect_ARRAY = array();
	public $handle_env_ARRAY = array();
	public $handle_env_cleartext_ARRAY = array();
	private static $env_name_ARRAY = array();
	
	public $grant_accessIP_ARRAY = array();
	public $deny_accessIP_ARRAY = array();

	public $oMYSQLI_CONN_MGR;

	private static $database_extension_type_ARRAY = array();

	private static $envDetectRequiredCnt;
	
	public static $handle_resource_ARRAY = array();
	
	private static $serverAppKey = array();
	
	private static $env_select_ARRAY = array();
	
	private static $envMatchCount;

	public $debugMode;
	public $PHPMAILER_debugMode;
    public $log_silo_key_piped;
	public $starttime;
	public $oLog_output_ARRAY = array();
	private static $oWildCardResource_ARRAY = array();
	public $tmp_wcr_config_envKey;

	public function __construct($serial, $CRNRSTN_debugMode=0, $PHPMAILER_debugMode=0, $log_silo_key_piped='*') {

		$this->starttime = $this->microtime_float();

		$this->debugMode = $CRNRSTN_debugMode;
        $this->PHPMAILER_debugMode = $PHPMAILER_debugMode;

		if($log_silo_key_piped==''){

            $log_silo_key_piped='*';

        }

		$this->log_silo_key_piped = $log_silo_key_piped;

        //
        // SUPPORT FOR ENRICHED DEBUGGING/LOG TRACE
        $_SESSION['CRNRSTN_CONFIG_SERIAL'] = $serial;
        $_SESSION['CRNRSTN_'.crc32($serial)]['CRNRSTN_START_TIME'] = $this->starttime;
        $_SESSION['CRNRSTN_'.crc32($serial)]['CRNRSTN_DEBUG_MODE'] = $this->debugMode;
        $_SESSION['CRNRSTN_'.crc32($serial)]['CRNRSTN_ACTIVE_LOG_SILO'] = $this->log_silo_key_piped;

        //
		// INSTANTIATE LOGGER
		$this->oLogger = new crnrstn_logging($this->debugMode, __CLASS__, $this->log_silo_key_piped);
        $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("SERVER/CRNRSTN start time [".$_SERVER['REQUEST_TIME']."]/[".$this->starttime."]", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION' , $this);

        try{

			if(!array_key_exists('SERVER_ADDR', $_SERVER)){
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				// SOURCE :: https://www.wired.com/2011/04/alt-text-spacecraft/
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: unable to load CRNRSTN. _SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl).", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
				throw new Exception('CRNRSTN initialization error :: $_SERVER[] super global has not been initialized. If calling this program via script, try using cURL (/usr/bin/curl). SERVER_NAME(SERVER_ADDR)-> '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].').');

			}else{
				
				//
				// STORE LOCAL COPY OF SUPER GLOBAL ARRAY WITH SERVER DATA TO SUPPORT ENVIRONMENTAL
                // DETECTION. I GUESS I COULD JUST WORK WITH $_SERVER DIRECTLY...IF WE'RE TRYNG TO SHAVE
                // GRAMS. WHAT DO YOU THINK?
				self::$handle_srvr_ARRAY = $_SERVER;
				
				//
				// STORE CONFIG SERIAL KEY AND INITIALIZE MATCH COUNT
				$this->configSerial = $serial;
                $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
				
				//
				// IF EARLY ENV DETECTION DURING defineEnvResource() DUE TO SPECIFIED requiredDetectionMatches(),
                // STORE ENV HERE:
				self::$serverAppKey[crc32($this->configSerial)] = "";

				//
				// INITIALIZE DATABASE CONNECTION MANAGER.
				$this->oMYSQLI_CONN_MGR = new crnrstn_mysqli_conn_manager($this->configSerial);
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("instantiating mysqli database connection manager object. Ready to configure database authentication profiles.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				//
				// INITIALIZE IP ADDRESS SECURITY MANAGER
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("instantiating IP security manager object with client IP of [".self::$handle_srvr_ARRAY['REMOTE_ADDR']."] and phpsessionid[".session_id()."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				$this->oCRNRSTN_IPSECURITY_MGR = new crnrstn_ip_auth_manager();

			}

		} catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_EMERG, $e->getMessage(), $this->oLog_output_ARRAY);

        }
	}

	public function crnrstn_error_ownership($isActive = true, $errorTypesProfile=NULL){

        if($isActive){

            if(isset($errorTypesProfile)){

                //
                // SOURCE :: https://stackoverflow.com/questions/1241728/can-i-try-catch-a-warning
                // AUTHOR :: https://stackoverflow.com/users/117260/philippe-gerber
                // SET TO THE USER DEFINED ERROR HANDLER
                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
                    // error was suppressed with the @-operator
                    if (0 === error_reporting()) {
                        return false;
                    }

                    $errstr = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                    $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                }, (int) $errorTypesProfile);

            }else{

                $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
                    // error was suppressed with the @-operator
                    if (0 === error_reporting()) {
                        return false;
                    }

                    $errstr = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'].$errstr;
                    $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';
                    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);

                });

            }

        }else{

            //
            // RESTORE ERROR HANDLING TO NATIVE PHP
            restore_error_handler();

        }

    }

    /**
     * Map an error code into an Error word, and log location.
     *
     * @param int $code Error code to map
     * @return array Array of error word, and log location.
     * SOURCE :: https://www.php.net/manual/en/function.set-error-handler.php
     * AUTHOR :: https://www.php.net/manual/en/function.set-error-handler.php#118630
     */
    public function mapErrorCode($code) {
        $error = $log = null;
        switch ($code) {
            case E_PARSE:
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                $error = 'Fatal Error';
                $log = LOG_ERR;
                break;
            case E_WARNING:
            case E_USER_WARNING:
            case E_COMPILE_WARNING:
            case E_RECOVERABLE_ERROR:
                $error = 'Warning';
                $log = LOG_WARNING;
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                $error = 'Notice';
                $log = LOG_NOTICE;
                break;
            case E_STRICT:
                $error = 'Strict';
                $log = LOG_NOTICE;
                break;
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                $error = 'Deprecated';
                $log = LOG_NOTICE;
                break;
            default :
                break;
        }
        return array($error, $log);
    }

	private function defineWildCardResource($key){

	    $oWildCardResource = new crnrstn_wildcard_resource($key, $this);

        return $oWildCardResource;

    }

    public function returnWildCardResource($envKey){

	    try{

	        if(isset(self::$oWildCardResource_ARRAY[crc32($this->configSerial)][$envKey])){

                return self::$oWildCardResource_ARRAY[crc32($this->configSerial)][$envKey];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to locate any wild card resource related to the serialization of this CRNRSTN configuration file and the environment, "'.$envKey.'".');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);

            return false;

        }

    }

	public function initResourceWildCards($envKey, $filepathWildCardResource){

	    try{

            if(is_file($filepathWildCardResource)){

                $oWildCardResource_ARRAY = array();

                //
                // INITIALIZE WILDCARD RESOURCES
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("storing initialized environmental resource wildcards [".$filepathWildCardResource."] in memory for environment key [".$envKey."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
                include_once($filepathWildCardResource);

                self::$oWildCardResource_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $oWildCardResource_ARRAY;
                $this->tmp_wcr_config_envKey = '';

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                //throw new Exception('CRNRSTN wildcard resource file cannot be loaded, because it ['.$filepathWildCardResource.'] is not a file.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_WARNING, $e->getMessage(), $this->oLog_output_ARRAY);

        }

        return true;

    }

	public function addEnvironment($envKey, $errorReporting){

        $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("addEnvironment() key [".$envKey."] converted to checksum [".crc32($envKey)."] and will be referenced as such from time to time.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
		$this->addServerEnv(crc32($this->configSerial), $envKey, $errorReporting);

		return true;

	}

	private function addServerEnv($configSerial, $envKey, $errRptProfl) {

		try{
            $envKey_crc = crc32($envKey);
			if(!isset($this->handle_env_ARRAY[$configSerial][$envKey_crc])){

			    $this->handle_env_cleartext_ARRAY[$configSerial][$envKey_crc] = $envKey;
				$this->handle_env_ARRAY[$configSerial][$envKey_crc] = $errRptProfl;
				self::$env_detect_ARRAY[$configSerial][$envKey_crc] = 0;
				self::$env_name_ARRAY[$configSerial][$envKey_crc] = $envKey_crc;

                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("storing environment [".$envKey."|".$envKey_crc."] in memory.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

			}else{
				
				//
				// 	THIS KEY HAS ALREADY BEEN INITIALIZED
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: there are duplicate environment keys being passed to addEnvironment().", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				throw new Exception('CRNRSTN initialization warning :: This environmental key ('.$envKey.'|'.$envKey_crc.') has already been initialized.');

			}

		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_WARNING, $e->getMessage(), $this->oLog_output_ARRAY);

		}
    }
	
	public function initLogging($envKey, $loggingProfilePipe=NULL, $loggingEndpointPipe=NULL, $wcrProfilePipe=NULL){

		if($loggingProfilePipe!=''){

            $tmp_str_append = '';

			self::$log_profl_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $loggingProfilePipe;
			self::$log_endpt_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $loggingEndpointPipe;
            self::$log_wcr_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $wcrProfilePipe;

            if(isset($loggingProfilePipe)){

                $tmp_str_append .= ' to the pipe profile of ['.$loggingProfilePipe.']';

            }

            if(isset($loggingEndpointPipe)){

                    $tmp_str_append .= ' and the endpoint profile of [##### REDACTED #####]';

            }

            if(isset($wcrProfilePipe)){

                $tmp_str_append .= ' and wildcard resource profile pipe to '.$wcrProfilePipe;

            }

            $tmp_str_append .= '.';

            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug('logging initialized for ["'.$envKey.'"]'.$tmp_str_append, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		}
		
		return true;

	}
	
	public function grantExclusiveAccess($envKey, $ipOrFile){

		$this->grant_accessIP_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $ipOrFile;
        $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("storing grantExclusiveAccess IP profile [".$ipOrFile."] in memory for environment key [".$envKey."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		return true;

	}
	
	public function denyAccess($envKey, $ipOrFile){

		$this->deny_accessIP_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $ipOrFile;
        $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("storing denyAccess IP profile [".$ipOrFile."] in memory for environment key [".$envKey."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		return true;

	}

    public function returnConfigSerial(){

        return $this->configSerial;

    }

    public function returnServerArray(){

        return self::$handle_srvr_ARRAY;

    }

    public function returnDbType($type_id=0){

        $databaseExtensionTypes = array(0 => 'MySQLi', 1 => 'MySQL', 2 => 'PostGreSQL', 3 => 'SYBASE', 4 => 'IBM-DB2', 5 => 'Oracle Database');

        if(isset($databaseExtensionTypes[$type_id])){

            return $databaseExtensionTypes[$type_id];

        }else{

            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: returnDbType() is being called with reference to a value(".$type_id.") that is outside permissible range of [0-5].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
            throw new Exception('CRNRSTN initialization warning :: returnDbType() is being called with reference to a value('.$type_id.') that is outside permissible range of [0-5]');

        }

    }

    public function specifyDatabaseExtension($envKey, $type){

        $this->oLog_output_ARRAY[] = $this->oLogger->logDebug('crnrstn :: specifyDatabaseExtension() database type ['.$type.'] specified for environment ['.$envKey.'] on server ['.$_SERVER['SERVER_NAME'].']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

        self::$database_extension_type_ARRAY[crc32($this->configSerial)][crc32($envKey)] = $type;

    }

    public function addDatabase($envKey, $host, $un=NULL, $pwd=NULL, $db=NULL, $port=NULL){
		
		//
		// HANDLE PATH TO DATABASE CONFIG FILE (E.G. ONLY 2 PARAMS PROVIDED)
		if($db==NULL){

			if(is_file($host)){

				//
				// EXTRACT DATABASE CONFIGURATION FROM FILE
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("addDatabase() for environment [".$envKey."]. including and evaluating file [".$host."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

                include_once($host);
				
			}else{

				//
				// WE COULD NOT FIND THE DATABASE CONFIGURATION FILE
				#$this->oLogger->captureNotice('crnrstn->addDatabase()', LOG_ERR, 'Could not find/interpret the database config file parameter for an addDatabase() method called in the crnrstn configuration.', $this->oLog_output_ARRAY);
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug('NOTICE :: addDatabase() $host parameter not recognized as a file for environment ['.$envKey."] on server [".$_SERVER['SERVER_NAME'].'] value-> ['.$host."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

			}

		}else{
			
			//
			// SEND DATABASE CONFIGURATION PARAMETERS TO THE CONNECTION MANAGER
			#$this->oLog_output_ARRAY[] = $this->oLogger->logDebug("addDatabase() for environment [".$envKey."] sending database authentication profile [db->".$db." | un->".$un." |...etc.] to connection manager.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("addDatabase() for environment [".$envKey."] sending database authentication profile [db->##### REDACTED ##### | un->##### REDACTED ##### |...etc.] to connection manager.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
			$this->oMYSQLI_CONN_MGR->addConnection($envKey, $host, $un, $pwd, $db, $port);

		}
		
		return true;

	}

	public function requiredDetectionMatches($value=''){
		
		//
		// HOW MANY SERVER KEYS ARE REQUIRED TO MATCH IN ORDER TO SUCCESSFULLY 
		// CONFIGURE CRNRSTN TO MATCH WITH ONE ENVIRONMENT
		if($value==''){
			
			//
			// WE WANT THE ENVIRONMENT WITH MOST MATCHES. DELAY ENV DETECTION UNTIL INSTANTIATION OF ENV CLASS OBJECT
			self::$envDetectRequiredCnt = NULL;
            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("requiredDetectionMatches will autodetect environment CRNRSTN profile with strongest correlation to _SERVER params.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		}else{
			
			//
			// NON-ZERO VALUE HAS BEEN RECIEVED. THE ENV CONFIG THAT MEETS THIS REQUIREMENT FIRST IS USED FOR ENV INITIALIZATION
			self::$envDetectRequiredCnt = $value - 0;
            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("requiredDetectionMatches set to [".self::$envDetectRequiredCnt."] in memory.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		}
		
		return true;

	}
	
	public function get_log_profl_ARRAY(){

		return self::$log_profl_ARRAY;

	}
	
	public function get_log_endpt_ARRAY(){

		return self::$log_endpt_ARRAY;

	}

	public function get_log_wcr_ARRAY(){

        return self::$log_wcr_ARRAY;

    }
	
	public function defineEnvResource($envKey, $key, $value){

		try{

			if($envKey=="" || $key==""){

                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR ::  attempt to defineEnvResource() but missing required parameters of env and/or key.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
				throw new Exception('CRNRSTN initialization ERROR :: defineEnvResource was called but was missing paramter information and so was not able to be initialized. envKey and resourceKey are required. envKey['.$envKey.'] resourceKey['.$key.']');
				
			}else{

				if(self::$serverAppKey[crc32($this->configSerial)]=="" || crc32($envKey)==self::$serverAppKey[crc32($this->configSerial)] || $envKey=="*"){

                    $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("defining resource [".$key."] with value [".$value."] for environment [".$envKey."] in memory.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
					$this->addEnvResource(crc32($this->configSerial), crc32($envKey), trim($key), trim($value));

				}
			}
		
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);

		}
		
	}
	
	public function addEnvResource($configSerial, $envKey, $key, $value) {

		self::$handle_resource_ARRAY[$configSerial][$envKey][$key] = $value;
		
		//
		// FOR FASTEST DISCOVERY, RUN ENVIRONMENTAL DETECTION IN PARALLEL WITH INITIALIZATION OF RESOURCE DEFINITIONS.
		// THIS MEANS THERE SHOULD/WOULD BE A NON-NULL / NON ZERO INTEGER PASSED TO $oCRNRSTN->requiredDetectionMatches(2) IN THE
		// CRNRSTN CONFIG FILE. OTHERWISE, WE MUST TRAVERSE ALL ENV CONFIG DEFINITIONS AND THEN TAKE BEST FIT PER SERVER SETTINGS.
		if(self::detectServerEnv($configSerial, $envKey, $key, $value)){
			
			//
			// IF NULL/ZED COUNT, HOLD OFF ON DEFINING APPLICATION ENV KEY UNTIL ALL ENV RESOURCES HAVE BEEN 
			// PROCESSED...E.G. WAIT FOR ENV INSTANTIATION OF CLASS OBJECT BEFORE DETECTING ENVIRONMENT.
			if((self::$env_select_ARRAY[$configSerial] != "" && $envKey == self::$env_select_ARRAY[$configSerial]) || self::$env_select_ARRAY[$configSerial]==""){

				if(self::$envDetectRequiredCnt > 0 && self::$serverAppKey[$configSerial]==''){

					self::$serverAppKey[$configSerial] = $envKey;
                    $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("environmental detection complete. setting application server app key for CRNRSTN config serial [".$configSerial."] to [".$envKey."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				}
			}
		}
    }
	
	private function detectServerEnv($configSerial, $envKey, $key, $value) {
	
		//
		// CHECK THE ENVIRONMENTAL DETECTION KEYS FOR MATCHES AGAINST THE SERVER CONFIGURATION
		if(array_key_exists($key, self::$handle_srvr_ARRAY)){

            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("we have a SERVER param [".$key."] to check value [".$value."] for match against actual SERVER[].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
			return self::isServerKeyMatch($configSerial, $envKey, $key, $value);

		}else{

			return false;

		}
	}
	
	private function isServerKeyMatch($configSerial, $envKey, $key, $value){
		
		//
		// RUN VALUE COMPARISON FOR INCOMING VALUE AND DATA FROM THE SERVERS' SUPER GLOBAL VARIABLE ARRAY
		if($value == self::$handle_srvr_ARRAY[$key]){
			
			//
			// INCREMENT FOR EACH MATCH. 
			self::$env_detect_ARRAY[$configSerial][$envKey]++;
            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("SERVER match found for key [".$key."] with value [".$value."] Increment detection count [".self::$env_detect_ARRAY[$configSerial][$envKey]."] for environment [".$envKey."]. Need [".self::$envDetectRequiredCnt."] matches to detect environment (if 0, then must process all config data).", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		}
		
		//
		// FIRST $ENV TO REACH $envDetectRequiredCnt...YOU KNOW YOU HAVE QUALIFIED MATCH.
		if(self::$env_detect_ARRAY[$configSerial][$envKey] >= self::$envDetectRequiredCnt && self::$envDetectRequiredCnt>0){
			
			//
			// WE HAVE AN ENVIRONMENTAL DEFINITION WITH A SUFFICIENT NUMBER OF SUCCESSFUL MATCHES TO THE RUNNING ENVIRONMENT 
			// AS DEFINED BY THE CRNRSTN CONFIG FILE
			self::$env_select_ARRAY[$configSerial] = $envKey;

            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("environmental detection complete. CRNRSTN selected environmental profile [".$envKey."] running with CRNRSTN serialization of [".$configSerial."] and phpsession[".session_id()."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

			return true;

		}else{
			
			//
			// EVIDENCE OF A MATCH...STILL NOT SUFFICIENT
			return false;

		}
	}
	
	public function initSessionEncryption($envKey, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){

	    try{

			if($envKey=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){

                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: missing required information to configure initSessionEncryption().", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
				throw new Exception('CRNRSTN initialization ERROR :: initSessionEncryption was called but was missing paramter information and so session encryption was not able to be initialized. Some parameters are required. env['.$envKey.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[##### REDACTED #####] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{

				$this->opensslSessEncryptCipher[crc32($this->configSerial)][crc32($envKey)] = $encryptCipher;
				$this->opensslSessEncryptSecretKey[crc32($this->configSerial)][crc32($envKey)] = $encryptSecretKey;
				$this->opensslSessEncryptOptions[crc32($this->configSerial)][crc32($envKey)] = $encryptOptions;
				$this->sessHmac_algorithm[crc32($this->configSerial)][crc32($envKey)] = $hmac_alg; #
				#$this->oLog_output_ARRAY[] = $this->oLogger->logDebug("session encryption initialized for environment [".$env."] to cipher [".$encryptCipher."] and hmac algorithm [".$hmac_alg."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("session encryption initialized for environment [".$envKey."] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				return true;

			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);

			return false;

	    }
	} 
	
	public function initCookieEncryption($envKey, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){

	    try{

			if($envKey=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){

                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: missing required information to configure initCookieEncryption().", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
				throw new Exception('CRNRSTN initialization ERROR :: initCookieEncryption was called but was missing paramter information and so cookie encryption was not able to be initialized. Some parameters are required. env['.$envKey.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[xxx] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				
				$this->opensslCookieEncryptCipher[crc32($this->configSerial)][crc32($envKey)] = $encryptCipher;
				$this->opensslCookieEncryptSecretKey[crc32($this->configSerial)][crc32($envKey)] = $encryptSecretKey;
				$this->opensslCookieEncryptOptions[crc32($this->configSerial)][crc32($envKey)] = $encryptOptions;
				$this->cookieHmac_algorithm[crc32($this->configSerial)][crc32($envKey)] = $hmac_alg;
				#$this->oLog_output_ARRAY[] = $this->oLogger->logDebug("cookie encryption initialized for environment [".$env."] to cipher [".$encryptCipher."] and hmac algorithm [".$hmac_alg."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("cookie encryption initialized for environment [".$envKey."] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				return true;

			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);

			return false;

		}
	} 
	
	public function initTunnelEncryption($envKey, $encryptCipher, $encryptSecretKey, $encryptOptions, $hmac_alg){

	    try{

			if($envKey=="" || $encryptCipher=="" || $encryptSecretKey=="" || $hmac_alg==""){

                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: missing required information to configure initTunnelEncryption().", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

                throw new Exception('CRNRSTN initialization ERROR :: initTunnelEncryption was called but was missing parameter information and so tunnel encryption was not able to be initialized. Some parameters are required. env['.$envKey.'] encryptCipher['.$encryptCipher.'] encryptSecretKey[##### REDACTED #####] (optional)encryptOptions['.$encryptOptions.'] hmac_alg['.$hmac_alg.']');
				
			}else{
				
				$this->opensslTunnelEncryptCipher[crc32($this->configSerial)][crc32($envKey)] = $encryptCipher;
				$this->opensslTunnelEncryptSecretKey[crc32($this->configSerial)][crc32($envKey)] = $encryptSecretKey;
				$this->opensslTunnelEncryptOptions[crc32($this->configSerial)][crc32($envKey)] = $encryptOptions;
				$this->tunnelHmac_algorithm[crc32($this->configSerial)][crc32($envKey)] = $hmac_alg;
				#$this->oLog_output_ARRAY[] = $this->oLogger->logDebug("tunnel encryption initialized for environment [".$envKey."] to cipher [".$encryptCipher."] and hmac algorithm [".$hmac_alg."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);
                $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("tunnel encryption initialized for environment [".$envKey."] to cipher [##### REDACTED #####] and hmac algorithm [##### REDACTED #####].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

				return true;

			}
			
		}catch( Exception $e ) {
			
			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ERR, $e->getMessage(), $this->oLog_output_ARRAY);

			return false;

	    }
	} 
	
	public function setServerEnv(){

		self::$serverAppKey[crc32($this->configSerial)] = $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'];
        $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("detected server environment [".self::$serverAppKey[crc32($this->configSerial)]."] pulled from session[".session_id()."] memory (not the config file) and used to reinitialize CRNRSTN in private static array.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

		return $_SESSION['CRNRSTN_'.crc32($this->configSerial)]['CRNRSTN_RESOURCE_KEY'];
		
	}
	
	public function getServerEnv() {
		
		//
		// DID WE DETERMINE ENVIRONMENT KEY THROUGH INITIALIZATION OF CRNRSTN? IF SO, THIS PARAMETER WILL BE SET. JUST USE IT.
		if(self::$serverAppKey[crc32($this->configSerial)]!=""){

            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("detected server environment [".self::$serverAppKey[crc32($this->configSerial)]."] returned from private static array.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

			return self::$serverAppKey[crc32($this->configSerial)];

		}else{
		
			//
			// SINCE ENV NOT DETERMINED THROUGH INITIAL INITIALIZATION, NEXT CHECK FOR  
			if(!(self::$envDetectRequiredCnt > 0)){
				
				//
				// RETURN SERVER APPLICATION KEY BASED UPON A BEST FIT SCENARIO. FOR ANY TIES...FIRST COME FIRST SERVED.
				foreach (self::$handle_resource_ARRAY as $serial=>$resource_ARRAY) {

					foreach($resource_ARRAY as $env=>$key){

						if(isset(self::$env_detect_ARRAY[$serial][$env])){

							if(self::$env_detect_ARRAY[$serial][$env]>0){

								if(self::$envMatchCount < self::$env_detect_ARRAY[$serial][$env]){

									self::$envMatchCount = self::$env_detect_ARRAY[$serial][$env];
									self::$serverAppKey[$serial] = $env;

                                    $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("attempting to detect running environment. environment [".$env."] is new detection leader having [".self::$envMatchCount."] SERVER matches.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

								}
							}
						}
					}
				}
			}

			try{
				
				//
				// WE SHOULD HAVE THIS VALUE BY NOW. IF EMPTY, HOOOSTON...VE HAF PROBLEM!
				if(self::$serverAppKey[crc32($this->configSerial)] == ""){

                    $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("ERROR :: we have processed ALL defined environmental resources and were unable to detect running environment with CRNRSTN config serial [".$this->configSerial."].", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

                    //
                    // HOOOSTON...VE HAF PROBLEM!
					throw new Exception('CRNRSTN initialization error :: Environmental detection failed to match a sufficient number of parameters (apparently, finding '.self::$envDetectRequiredCnt.' $_SERVER matches was too hard) to your servers configuration to successfully initialize CRNRSTN on server '.self::$handle_srvr_ARRAY['SERVER_NAME'].' ('.self::$handle_srvr_ARRAY['SERVER_ADDR'].')');

				}
			
			}catch( Exception $e ) {
				
				//
				// SEND THIS THROUGH THE LOGGER OBJECT
				$this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ALERT, $e->getMessage(), $this->oLog_output_ARRAY);
				
				//
				// RETURN FALSE
				return false;

			}

            $this->oLog_output_ARRAY[] = $this->oLogger->logDebug("returning detected environment [".self::$serverAppKey[crc32($this->configSerial)]."] as the selected running environment.", __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION', $this);

			return self::$serverAppKey[crc32($this->configSerial)];

		}
	}
	
	public function getHandle_resource_ARRAY(){

		return 	self::$handle_resource_ARRAY;
		
	}

	public function getDebugMode(){
		
		return $this->debugMode;

	}
	
	public function getStartTime(){
		
		return $this->starttime;

	}

    public function wallTime(){

        $timediff = $this->microtime_float() - $this->starttime;

        return substr($timediff,0,-8);

    }

	//	
	// SOURCE :: http://www.php.net/manual/en/function.microtime.php
	private function microtime_float(){

	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);

	}
	
	public function __destruct() {

	}
}


# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_wildcard_resource
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: Monday Sept 7, 2020 @ 1539hrs

class crnrstn_wildcard_resource {

    protected $oLogger;
    private static $oCRNRSTN;

    protected $envKey;
    protected $resourceKey;
    protected $attribute_key_ARRAY = array();

    public function __construct($resourceKey, $oCRNRSTN) {

        self::$oCRNRSTN = $oCRNRSTN;
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN->debugMode, __CLASS__, self::$oCRNRSTN->log_silo_key_piped);

        $this->envKey = self::$oCRNRSTN->tmp_wcr_config_envKey;
        $this->resourceKey = $resourceKey;

        self::$oCRNRSTN->oLog_output_ARRAY[] = $this->oLogger->logDebug('Instantiating a '.$resourceKey.' wild card resource for the '.$this->envKey.' environment.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION' , self::$oCRNRSTN);

    }

    public function returnResourceKey(){

        return $this->resourceKey;

    }

    public function addAttribute($attribute_key, $attribute_value){

        self::$oCRNRSTN->oLog_output_ARRAY[] = $this->oLogger->logDebug('Adding a '.$attribute_key.' data attribute to the '.$this->resourceKey.' wild card resource for the '.$this->envKey.' environment.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_CONFIGURATION' , self::$oCRNRSTN);

        $resource_key_crc = crc32($this->resourceKey);
        $attribute_key_crc = crc32($attribute_key);
        $this->attribute_key_ARRAY[$resource_key_crc][$attribute_key_crc] = $attribute_value;

    }

    public function issetAttribute($tmp_wc_key_crc, $attribute_key){

        //$resource_key_crc = crc32($this->resourceKey);
        $attribute_key_crc = crc32($attribute_key);

        if(isset($this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

            return true;

        }else{

            return false;

        }
    }

    public function getAttribute($wildCardKey, $attribute_key){

        try{

            $tmp_wc_key_crc = crc32($wildCardKey);
            $attribute_key_crc = crc32($attribute_key);

            if(isset($this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc])){

                return $this->attribute_key_ARRAY[$tmp_wc_key_crc][$attribute_key_crc];

            }else{

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An unknown wild card attribute key, "'.$attribute_key.'", has been requested of a '.$wildCardKey.' wild card resource.');

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            $this->oLogger->captureNotice(__METHOD__.' on server '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')', LOG_ALERT, $e->getMessage(), self::$oCRNRSTN->oLog_output_ARRAY);

            //
            // RETURN NULL
            return NULL;

        }

    }

    public function __destruct() {

    }

}
