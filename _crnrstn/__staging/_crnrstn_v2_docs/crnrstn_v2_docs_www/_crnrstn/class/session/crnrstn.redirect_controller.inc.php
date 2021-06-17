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
# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_redirect_controller
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  VERSION :: 1.0.10
#  DATE :: Jun. 16, 2020 @ 1101hrs

class crnrstn_redirect_controller {

    private static $oEnv;
    protected $oLogger;
	
	public function __construct($oCRNRSTN_USR) {
        //
        // RETRIEVE AND CONSUME ENVIRONMENTAL CONFIGURATION
        self::$oEnv = $oCRNRSTN_USR->return_oCRNRSTN_ENV();

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging($oCRNRSTN_USR->debugMode, __CLASS__, $oCRNRSTN_USR->log_silo_key_piped);
	}

	public function __destruct() {

    }
}