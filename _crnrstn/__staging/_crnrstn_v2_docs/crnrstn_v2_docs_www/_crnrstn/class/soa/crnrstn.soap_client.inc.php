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
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.ncluding without limitation the rights to use, copy, 
#			  modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
#			  Software is furnished to do so, subject to the following conditions:

#			  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

#			  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#			  WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
#			  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
#			  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/*
# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_soap_client_manager
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 2.0.0
#  CLASS DATE :: September 22, 2020 @ 1859hrs
*/
class crnrstn_soap_client_manager {

    protected $oLogger;
    private static $oCRNRSTN_USR;
	public $result;
	
	protected $cache;
    protected $wsdl;
    protected $client;
    protected $err;

    protected $WSDL_uri;
    protected $cache_TTL;
    protected $use_CURL;
	
	public function __construct($oCRNRSTN_USR, $wsdl_uri, $cache_ttl=NULL, $useCURL=NULL) {

	    self::$oCRNRSTN_USR = $oCRNRSTN_USR;
        $cache_ttl_default = self::$oCRNRSTN_USR->cache_ttl_default;
        $useCURL_default = self::$oCRNRSTN_USR->useCURL_default;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

        $this->WSDL_uri = $wsdl_uri;

        if(!isset($cache_ttl)){

            $this->cache_TTL = $cache_ttl_default;

        }else{

            if($cache_ttl==''){

                $this->cache_TTL = $cache_ttl_default;

            }else{

                $this->cache_TTL = $cache_ttl;
            }
        }

        if(!isset($useCURL)){

            $this->use_CURL = $useCURL_default;

        }else{

            if($useCURL==''){

                $this->use_CURL = $useCURL_default;

            }else{

                $this->use_CURL = $useCURL;
            }

        }

        //
        // INITIALIZE CLIENT WITH WSDL
        if($this->WSDL_uri != self::$oCRNRSTN_USR->currentLocation()){	// AVOID INFINITE LOOP WHERE WEB SERVICE STANDS ON CRNRSTN

		    try{

                $this->cache = new wsdlcache('.', $this->cache_TTL);
                
                $this->wsdl = $this->cache->get($this->WSDL_uri);
				if (is_null($this->wsdl)) {
                    $this->wsdl = new wsdl($this->WSDL_uri);

                    $this->err = $this->wsdl->getError();
					if ($this->err) {
						
						//
						// HOOOSTON...VE HAF PROBLEM!
						throw new Exception('WSDL Constructor Error :: '.$this->err.' :: WSDL :: '.$this->WSDL_uri);

					}

                    $this->cache->put($this->wsdl);
					
				} else {

                    $this->wsdl->clearDebug();
                    $this->wsdl->debug('Retrieved from cache');

				}
				
				//
				// INSTANTIATE SOAP CLIENT
                $this->client = new nusoap_client($this->wsdl, true);

                $this->err = $this->client->getError();
				if ($this->err) {
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('SOAP Client Constructor Error :: '.$this->err);

				}

                $this->client->setUseCurl($this->use_CURL);
				
			}catch ( Exception $e ){

                self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
				
				return false;

			}
		}
	}
	
	//
	// SEND SOAP REQUEST TO WEB SERVICE
	public function sendRequest_SOAP($methodName, $params){
		
		//
		// SEND SOAP REQUEST
		try{

			$this->result = $this->client->call($methodName, $params);
			
			//
			// CHECK FOR A FAULT
			if ($this->client->fault) {
				
				//
				// HOOOSTON...VE HAF PROBLEM!
				throw new Exception('SOAP Client returnContent() Fault :: '.$this->result);
				
			} else {
				
				//
				// CHECK FOR ERRORS
				$this->err = $this->client->getError();
				
				if ($this->err) {
					
					//
					// HOOOSTON...VE HAF PROBLEM!
					throw new Exception('SOAP Client returnContent() Error :: '.$this->err);
					
				} else {
					
					//
					// RETURN RESULT
					return $this->result;

				}
			}
			
		}catch( Exception $e ) {

            //self::$oCRNRSTN_USR->error_log($this->returnClientRequest(), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
            //self::$oCRNRSTN_USR->error_log($this->returnClientResponse(), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');
            //self::$oCRNRSTN_USR->error_log($this->returnClientGetDebug(), __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_COMM');

            //
			// SEND THIS THROUGH THE LOGGER OBJECT
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

		}
		
		return $this->result;

	}

	public function returnError(){
		return $this->client->getError();
	}
	
	public function returnResult(){
		return $this->result;
	}
	
	public function returnClientRequest(){
		return $this->client->request;
	}
	
	public function returnClientResponse(){
		return $this->client->response;
	}
	
	public function returnClientGetDebug(){
		return $this->client->getDebug();
	}
	
	public function __destruct() {

	}
}