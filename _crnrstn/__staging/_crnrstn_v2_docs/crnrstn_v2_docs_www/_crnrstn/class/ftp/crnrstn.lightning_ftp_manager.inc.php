<?php
/*
// J5
// Code is Poetry */

# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_wheel_high_awesome_eyes
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: September 17, 2020 @ 0606hrs
#  Ezekiel 1:15-16 - AND AS I WATCHED THE LIVING CREATURES, I SAW A WHEEL UPON
#  THE EARTH BESIDE THE LIVING CREATURES, FOR EACH OF THEIR FOUR FACES. THE APPEARANCE
#  OF THE WHEELS AND THEIR WORKMANSHIP WERE LIKE THE SIGHT OF BERYL. AND THE FOUR OF
#  THEM HAD ONE LIKENESS; THAT IS, THEIR APPEARANCE AND THEIR WORKMANSHIP WERE AS IT
#  WERE A WHEEL WITHIN A WHEEL.
#  Ezekiel 1:18-20 - AS FOR THEIR RIMS, THEY WERE HIGH AND THEY WERE AWESOME; AND THE
#  RIMS OF THE FOUR OF THEM WERE FULL OF EYES ALL AROUND. AND WHENEVER THE LIVING
#  CREATURES WENT, THE WHEELS WENT BESIDE THEM; AND WHENEVER THE LIVING CREATURES WERE
#  LIFTED UP ABOVE THE EARTH, THE WHEELS WERE LIFTED UP ALSO. WHEREEVER THE SPIRIT WAS
#  TO GO, THEY WENT--WHEREVER THE SPIRIT WAS TO GO. AND THE WHEELS WERE LIFTED UP
#  ALONGSIDE THEM, FOR THE SPIRIT OF THE LIVING CREATURE WAS IN THE WHEELS.
class crnrstn_wheel_high_awesome_eyes{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $timestamp_nom;
    protected $start_time_micro;
    protected $start_time_timestamp;
    protected $elapsed_time_at_start;
    protected $execution_serial;
    protected $serial;
    protected $queue_position;
    protected $queue_length;

    protected $oEndpoint_SOURCE;
    protected $oEndpoint_DESTINATION;

    protected $file_name;
    protected $local_dir_path;
    protected $destination_dir_path;
    protected $mkdir_permissons_mode;
    protected $destination_file;

    protected $state_status = 'new';
    protected $state_status_ARRAY = array();
    protected $exclusion_check_result = array();


    public function __construct($execution_serial, $FIREHOT_oEndpoint_SOURCE, $FIREHOT_oEndpoint_DEST, $oCRNRSTN_USR, $total_wheels_count, $wheels_high_awesome_cnt, $exclusion_check_result){

        $this->start_time_micro = $oCRNRSTN_USR->getMicroTime();
        $this->start_time_timestamp = $oCRNRSTN_USR->return_queryDateTimeStamp();
        $this->elapsed_time_at_start = $oCRNRSTN_USR->wallTime();
        $this->timestamp_nom = $FIREHOT_oEndpoint_SOURCE->return_timestamp_nom();

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;
        $this->oEndpoint_SOURCE = $FIREHOT_oEndpoint_SOURCE;
        $this->oEndpoint_DESTINATION = $FIREHOT_oEndpoint_DEST;
        $this->queue_position = $wheels_high_awesome_cnt;
        $this->queue_length = $total_wheels_count;
        $this->exclusion_check_result = $exclusion_check_result;

        if(!$this->exclusion_check_result['not_excluded'] && $exclusion_check_result['pattern']!=''){
            if($this->exclusion_check_result['wcr_path_specified']!=''){

                self::$oCRNRSTN_USR->error_log('oWheel RELATED TO ENDPOINT '.$this->exclusion_check_result['wcr_path_specified'].' TO BE SUPPRESSED FOR '.$exclusion_check_result['exclusion_meta'].' against '.$this->exclusion_check_result['pattern_type'].' PATTERN ('.$this->exclusion_check_result['pattern'].') MATCH CONCERNING =>'.$this->exclusion_check_result['asset_meta'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

            }else{

                self::$oCRNRSTN_USR->error_log('oWheel TO BE SUPPRESSED FOR '.$this->exclusion_check_result['pattern_type'].' PATTERN ('.$exclusion_check_result['exclusion_meta'].' against '.$this->exclusion_check_result['pattern'].') MATCH CONCERNING =>'.$this->exclusion_check_result['asset_meta'], __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

            }

        }
        /*
        $exclusion_check_result['wcr_path_specified'] = $WCRkey_or_DIRPATH;
        $exclusion_check_result['not_excluded'] = false;
        $exclusion_check_result['pattern'] = $nomination_pattern;
        $exclusion_check_result['asset_meta'] = $filePath;
        */

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

        $this->execution_serial = $execution_serial;
        $this->serial = self::$oCRNRSTN_USR->generateNewKey(100);

    }

    public function log_state_status($str){

        $this->state_status = $str;
        $this->state_status_ARRAY[] = $str;

    }

    public function receive_asset_meta($filePath, $oElectrum){

        $this->file_path = $filePath;
        if($this->queue_position<2){

            self::$oCRNRSTN_USR->error_log('oWheel receive file path=>'.$this->file_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

        }

        $connection_type_SOURCE = $this->oEndpoint_SOURCE->return_connection_type();

        if($this->queue_position<2) {

            self::$oCRNRSTN_USR->error_log('oWheel connection_type[SOURCE]=>' . $connection_type_SOURCE, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
        }

        switch($connection_type_SOURCE){
            case 'FTP':

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel ATTEMPTING FTP ****', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $this->file_name = basename($this->file_path);
                $this->local_dir_path = $this->oEndpoint_SOURCE->return_FTP_DIR_PATH();

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel file_name=>' . $this->file_name, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                    self::$oCRNRSTN_USR->error_log('oWheel FTP_dir_path=' . $this->local_dir_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $connection_type_DESTINATION = $this->oEndpoint_DESTINATION->return_connection_type();

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel connection_type[DESTINATION]=>' . $connection_type_DESTINATION, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                switch($connection_type_DESTINATION) {
                    case 'FTP':

                        $this->destination_dir_path = $this->oEndpoint_DESTINATION->return_FTP_DIR_PATH();
                        $this->mkdir_permissons_mode = $this->oEndpoint_DESTINATION->return_FTP_MKDIR_MODE();

                        if($this->queue_position<2) {

                            self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->mkdir_permissons_mode.')_dir_path=>' . $this->destination_dir_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                            self::$oCRNRSTN_USR->error_log('oWheel destination timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    break;
                    default:

                        $this->destination_dir_path = $this->oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();
                        $this->mkdir_permissons_mode = $this->oEndpoint_DESTINATION->return_LOCAL_MKDIR_MODE();

                        if($this->queue_position<2) {

                            self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->mkdir_permissons_mode.')_dir_path=>' . $this->destination_dir_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                            self::$oCRNRSTN_USR->error_log('oWheel destination timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                        break;
                }

                $tmp_source_root_ARRAY = explode( '/', $this->local_dir_path);

                $tmp_loop_size = sizeof($tmp_source_root_ARRAY);
                $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel [oEndpoint_DESTINATION] tmp_proj_name_dir=>' . $tmp_proj_name_dir, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $tmp_trimmed_file_path = str_replace($this->local_dir_path, "", $this->file_path);
                $tmp_trimmed_file_path = str_replace($this->file_name, "", $tmp_trimmed_file_path);

                $dest_dir_path = rtrim($this->destination_dir_path, '/') . '/';
                $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');
                $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';

                if($this->oEndpoint_DESTINATION->return_flatten_all_files()){

                    $this->destination_file = $dest_dir_path.$tmp_proj_name_dir."/".$this->file_name;

                    if($this->queue_position<2){

                        self::$oCRNRSTN_USR->error_log('oWheel FLATTEN ALL FILES :: PATH=>'.$this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                    }

                }else{

                    if($this->timestamp_nom!=''){

                        $this->destination_file = $dest_dir_path.$this->timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->file_name;

                        if($this->queue_position<2) {

                            self::$oCRNRSTN_USR->error_log('oWheel DATESTAMP VERSIONED :: destination_file=>' . $this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    }else{

                        $this->destination_file = $dest_dir_path.$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->file_name;

                        if($this->queue_position<2){

                            self::$oCRNRSTN_USR->error_log('oWheel [NO DATESTAMP VERSIONING] :: destination_file=>'.$this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    }

                }

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel Destination(' . $this->mkdir_permissons_mode . ') File=>' . $this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

            break;
            default:
                //
                // SOURCE && DIRECTORY
                $this->file_name = basename($this->file_path);
                $this->local_dir_path = $this->oEndpoint_SOURCE->return_LOCAL_DIR_PATH();

                /*

                protected $source_file_size_at_path_ARRAY = array();
                protected $source_file_lastaccess_at_path_ARRAY = array();
                protected $source_file_lastmodify_at_path_ARRAY = array();
                protected $source_file_blocksize_at_path_ARRAY = array();
                protected $source_file_blockallocate_at_path_ARRAY = array();
                protected $source_file_fullpermissions_at_path_ARRAY = array();
                protected $source_file_octalpermissions_at_path_ARRAY = array();
                protected $source_file_uid_STRING_at_path_ARRAY = array();
                protected $source_file_gid_STRING_at_path_ARRAY = array();

                */

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel file_name=>' . $this->file_name, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                    self::$oCRNRSTN_USR->error_log('oWheel local_dir_path=' . $this->local_dir_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $connection_type_DESTINATION = $this->oEndpoint_DESTINATION->return_connection_type();

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel connection_type[DESTINATION]=>' . $connection_type_DESTINATION, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                switch($connection_type_DESTINATION) {
                    case 'FTP':

                        $this->destination_dir_path = $this->oEndpoint_DESTINATION->return_FTP_DIR_PATH();
                        $this->mkdir_permissons_mode = $this->oEndpoint_DESTINATION->return_FTP_MKDIR_MODE();

                        if($this->queue_position<2) {

                            self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->mkdir_permissons_mode.')_dir_path=>' . $this->destination_dir_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                            self::$oCRNRSTN_USR->error_log('oWheel timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    break;
                    default:

                        $this->destination_dir_path = $this->oEndpoint_DESTINATION->return_LOCAL_DIR_PATH();
                        $this->mkdir_permissons_mode = $this->oEndpoint_DESTINATION->return_LOCAL_MKDIR_MODE();

                        if($this->queue_position<2) {

                            self::$oCRNRSTN_USR->error_log('oWheel destination('.$this->mkdir_permissons_mode.')_dir_path=>' . $this->destination_dir_path, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');
                            self::$oCRNRSTN_USR->error_log('oWheel timestamp_nom=>' . $this->timestamp_nom, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    break;
                }

                $tmp_source_root_ARRAY = explode( '/', $this->local_dir_path);

                $tmp_loop_size = sizeof($tmp_source_root_ARRAY);
                $tmp_proj_name_dir = $tmp_source_root_ARRAY[($tmp_loop_size-2)];

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel [oEndpoint_DESTINATION] tmp_proj_name_dir=>' . $tmp_proj_name_dir, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

                $tmp_trimmed_file_path = str_replace($this->local_dir_path, "", $this->file_path);
                $tmp_trimmed_file_path = str_replace($this->file_name, "", $tmp_trimmed_file_path);

                $dest_dir_path = rtrim($this->destination_dir_path, '/') . '/';
                $tmp_trimmed_file_path = ltrim($tmp_trimmed_file_path, '/');
                $tmp_trimmed_file_path = rtrim($tmp_trimmed_file_path, '/') . '/';

                if($this->oEndpoint_DESTINATION->return_flatten_all_files()){

                    $this->destination_file = $dest_dir_path.$tmp_proj_name_dir."/".$this->file_name;

                    if($this->queue_position<2){

                        self::$oCRNRSTN_USR->error_log('oWheel FLATTEN ALL FILES :: PATH=>'.$this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                    }

                }else{

                    if($this->timestamp_nom!=''){

                        $this->destination_file = $dest_dir_path.$this->timestamp_nom."/".$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->file_name;

                        if($this->queue_position<2) {

                            self::$oCRNRSTN_USR->error_log('oWheel DATESTAMP VERSIONED :: destination_file=>' . $this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    }else{

                        $this->destination_file = $dest_dir_path.$tmp_proj_name_dir."/".$tmp_trimmed_file_path.$this->file_name;

                        if($this->queue_position<2){

                            self::$oCRNRSTN_USR->error_log('oWheel [NO DATESTAMP VERSIONING] :: destination_file=>'.$this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                        }

                    }

                }

                if($this->queue_position<2) {

                    self::$oCRNRSTN_USR->error_log('oWheel Destination(' . $this->mkdir_permissons_mode . ') File=>' . $this->destination_file, __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_WHEEL');

                }

            break;

        }

    }









    public function __destruct() {

    }


}

# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_lightning_bolt
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: September 13, 2020 @ 0806hrs
#  Ezekiel 1:14 - AND THE LIVING CREATURES RAN TO AND FRO LIKE THE APPEARANCE OF A LIGHTNING BOLT.
class crnrstn_lightning_bolt{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $timestamp_nom_pattern;
    protected $timestamp_nom = '';
    protected $flow_type;
    protected $connection_type;
    protected $data_type;
    protected $flatten_all_files = false;

    protected $ftp_dir_path;
    protected $local_dir_path;
    protected $ftp_oWCR_key;
    protected $local_oWCR_key;
    protected $ftp_mkdir_mode;
    protected $local_mkdir_mode;

    protected $start_time_micro;
    protected $start_time_timestamp;
    protected $elapsed_time_at_start;
    protected $byte_capacity_destination;
    protected $byte_hardDiskSize_destination;

    protected $serial;
    public $connection_status = 'new';
    public $connection_status_log = array();
    public $asset_transfer_suppression_ARRAY = array();

    public function __construct($serial, $oCRNRSTN_USR){

        $this->start_time_micro = $oCRNRSTN_USR->getMicroTime();
        $this->start_time_timestamp = $oCRNRSTN_USR->return_queryDateTimeStamp();
        $this->elapsed_time_at_start = $oCRNRSTN_USR->wallTime();

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

        $this->serial = $serial;

    }

    /*
    $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_FTP00');

    $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
    $oWCR->addAttribute('FTP_USERNAME', 'jony5');
    $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
    $oWCR->addAttribute('FTP_PORT', 21);
    $oWCR->addAttribute('FTP_TIMEOUT', 90);
    $oWCR->addAttribute('FTP_IS_SSL', false);
    $oWCR->addAttribute('FTP_USE_PASV', false);
    $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
    $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', true);
    $oWCR->addAttribute('FTP_DIR_PATH', '../../var/www/html/_backup_test/dest_ftp00_WCR');
    $oWCR->addAttribute('FTP_MKDIR_MODE', true);

    $oWildCardResource_ARRAY[$oWCR->returnResourceKey()] = $oWCR;

    # # # # #
    ### NEW WILD CARD RESOURCE - DIR DESTINATION
    $oWCR = $this->defineWildCardResource('ELECTRUM_DESTINATION_DIR00');
    $oWCR->addAttribute('LOCAL_DIR_PATH', '/var/www/html/_backup_test/dest00_DIR_WCR/');
    $oWCR->addAttribute('LOCAL_MKDIR_MODE', 777);
     * */

    public function return_flatten_all_files(){

        return $this->flatten_all_files;

    }

    public function return_hardDriveSize(){

        $tmp_connection_type = $this->return_connection_type();

        switch($tmp_connection_type){
            case 'FTP':
                //
                // NO FTP SUPPORT FOR THIS FUNCTIONALITY
                $this->byte_hardDiskSize_destination = NULL;

            break;
            default:

                $tmp_dirPath = $this->return_LOCAL_DIR_PATH();
                $this->byte_hardDiskSize_destination = disk_total_space($tmp_dirPath);

            break;

        }

        return $this->byte_hardDiskSize_destination;

    }

    public function return_availableByteCapacity(){

        $tmp_connection_type = $this->return_connection_type();

        switch($tmp_connection_type){
            case 'FTP':
                //
                // NO FTP SUPPORT FOR THIS FUNCTIONALITY
                $this->byte_capacity_destination = NULL;

            break;
            default:
                $tmp_dirPath = $this->return_LOCAL_DIR_PATH();
                $this->byte_capacity_destination = disk_free_space($tmp_dirPath);

            break;

        }

        return $this->byte_capacity_destination;

    }

    public function return_timestamp_nom(){

        return $this->timestamp_nom;

    }

    public function add_directory_nom_pattern($pattern){

        #$this->save_data_param('TIMESTAMP_NOM', date("Ymd_H-i-s", time()))
        $this->timestamp_nom_pattern = $pattern;

        if($this->timestamp_nom==''){

            $this->timestamp_nom = date($this->timestamp_nom_pattern, time());

        }

    }

    public function return_FTP_SERVER(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $this->ftp_oWCR_key);

    }

    public function return_FTP_USERNAME(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $this->ftp_oWCR_key);

    }

    public function return_FTP_PASSWORD(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_PASSWORD', $this->ftp_oWCR_key);

    }

    public function return_FTP_PORT(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $this->ftp_oWCR_key);

    }

    public function return_FTP_TIMEOUT(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_TIMEOUT', $this->ftp_oWCR_key);

    }

    public function return_FTP_IS_SSL(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_IS_SSL', $this->ftp_oWCR_key);

    }

    public function return_FTP_USE_PASV(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_USE_PASV', $this->ftp_oWCR_key);

    }

    public function return_FTP_USE_PASV_ADDR(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_USE_PASV_ADDR', $this->ftp_oWCR_key);

    }

    public function return_FTP_DISABLE_AUTOSEEK(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_DISABLE_AUTOSEEK', $this->ftp_oWCR_key);

    }

    public function return_FTP_DIR_PATH(){

        return self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $this->ftp_oWCR_key);

    }

    public function return_FTP_MKDIR_MODE(){

        if($this->ftp_mkdir_mode!=''){

            return $this->ftp_mkdir_mode;

        }else{

            if($this->flow_type!='SOURCE') {

                $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);

            }else{

                $this->ftp_mkdir_mode = NULL;

            }

        }

        return $this->ftp_mkdir_mode;

    }

    public function return_LOCAL_DIR_PATH(){

        return $this->local_dir_path;

    }

    public function return_LOCAL_MKDIR_MODE(){

        if($this->flow_type!='SOURCE'){

            if(isset($this->local_mkdir_mode)){

                return $this->local_mkdir_mode;

            }else{

                $this->local_mkdir_mode = NULL;

            }

        }else{

            $this->local_mkdir_mode = NULL;
        }

        return $this->local_mkdir_mode;

    }

    public function return_connection_type(){

        return $this->connection_type;

    }

    public function return_serial(){

        return $this->serial;

    }

    public function return_local_oWCR_key(){

        return $this->local_oWCR_key;

    }

    public function return_start_time_micro(){

        return $this->start_time_micro;

    }

    public function return_WCRkey_or_PATH(){

        try{

            if(isset($this->ftp_oWCR_key)){

                return $this->ftp_oWCR_key;

            }else{

                if(isset($this->local_oWCR_key)){

                    return $this->local_oWCR_key;

                }else{

                    if(isset($this->local_dir_path)){

                        return $this->local_dir_path;

                    }else{

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('The CRNRSTN :: Electrum endpoint has not been configured correctly.');

                    }
                }

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;

        }

    }

    public function initialize_sourceLOCAL_meta($dirPath){

        $this->flow_type = 'SOURCE';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'INPUT_PARAM';

        //
        // INPUT_PARAM
        $this->local_dir_path = $dirPath;

        $this->log_connection_status('ready');

    }

    public function initialize_source_LOCAL_WCR_meta($WildCardResource_key){

        $this->flow_type = 'SOURCE';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'CRNRSTN_WCR';

        $this->local_oWCR_key = $WildCardResource_key;

        $this->local_dir_path = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_source_FTP_WCR_meta($WildCardResource_key){

        $this->flow_type = 'SOURCE';                    # SOURCE, DESTINATION
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_dir_path = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_destinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'INPUT_PARAM';

        //
        // INPUT_PARAM
        $this->local_dir_path = $tmp_DIR_PATH;

        if(isset($tmp_MKDIR_MODE)){

            $this->local_mkdir_mode = $tmp_MKDIR_MODE;

        }

        $this->log_connection_status('ready');

    }

    public function initialize_destinationLOCAL_WCR_meta($WildCardResource_key){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'CRNRSTN_WCR';

        $this->local_oWCR_key = $WildCardResource_key;

        $this->local_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

        $this->local_dir_path = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_flattenedDestinationLOCAL_meta($tmp_DIR_PATH, $tmp_MKDIR_MODE){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'INPUT_PARAM';

        //
        // INPUT_PARAM
        $this->local_dir_path = $tmp_DIR_PATH;

        if(isset($tmp_MKDIR_MODE)){

            $this->local_mkdir_mode = $tmp_MKDIR_MODE;

        }

        $this->log_connection_status('ready');


    }

    public function initialize_flattenedDestinationLOCAL_WCR_meta($WildCardResource_key){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'LOCAL_DIR';
        $this->data_type = 'CRNRSTN_WCR';

        $this->local_oWCR_key = $WildCardResource_key;

        $this->local_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

        $this->local_dir_path = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $this->local_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_destination_FTP_WCR_meta($WildCardResource_key){

        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);
        self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DESTINATION MODE ['.$this->ftp_mkdir_mode.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

        $this->ftp_dir_path = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    public function initialize_flattenedDestinationFTP_WCR_meta($WildCardResource_key){

        $this->flatten_all_files = true;
        $this->flow_type = 'DESTINATION';
        $this->connection_type = 'FTP';
        $this->data_type = 'CRNRSTN_WCR';

        $this->ftp_oWCR_key = $WildCardResource_key;

        $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);
        self::$oCRNRSTN_USR->error_log('CRNRSTN :: FTP DESTINATION MODE ['.$this->ftp_mkdir_mode.']', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM_TRANSFER');

        $this->ftp_dir_path = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $this->ftp_oWCR_key);

        $this->log_connection_status('ready');

    }

    /**

    public function OLD_initialize_meta($flow_type, $connection_type, $data_type, $endpoint_data, $mkdir_mode=NULL){
        //addEndpoint('DESTINATION', 'DIR', 'PARAM_INPUT', $tmp_dirpath_ARRAY)
        //DESTINATION, FTP, CRNRSTN_WCR, ELECTRUM_DESTINATION_FTP420
        $this->flow_type = $flow_type;  # SOURCE, DESTINATION
        $this->connection_type = $connection_type;  #FTP, LOCAL_DIR
        $this->data_type = $data_type;  # CRNRSTN_WCR, INPUT_PARAM


        if($this->data_type == 'CRNRSTN_WCR'){

            if($this->connection_type=='FTP'){

                $this->ftp_oWCR_key = $endpoint_data;

                if($this->flow_type!='SOURCE'){

                    $this->ftp_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('FTP_MKDIR_MODE', $this->ftp_oWCR_key);

                }

                $this->ftp_dir_path = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $this->ftp_oWCR_key);

            }else{

                $this->local_oWCR_key = $endpoint_data;
                //error_log('403['.$this->data_type.'] - local_oWCR_key='.$this->local_oWCR_key);
                if($this->flow_type!='SOURCE') {

                    $this->local_mkdir_mode = self::$oCRNRSTN_USR->getEnvResource('LOCAL_MKDIR_MODE', $this->local_oWCR_key);

                }

                $this->local_dir_path = self::$oCRNRSTN_USR->getEnvResource('LOCAL_DIR_PATH', $this->local_oWCR_key);

            }

        }else{

            //
            // INPUT_PARAM
            $this->local_dir_path = $endpoint_data;

            if(isset($mkdir_mode)){

                $this->local_mkdir_mode = $mkdir_mode;

            }

        }

        $this->log_connection_status('ready');

    }

     */

  public function log_connection_status($str){

        $this->connection_status = $str;
        $this->connection_status_log[] = $str;
    }

    public function __destruct() {

    }

}


# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_lightning_ftp_connection
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 2.0.0
#  CLASS DATE :: September 12, 2020 @ 0641hrs
#  Ezekiel 1:13b - AND THE FIRE WAS BRIGHT; AND OUT OF THE FIRE WENT FORTH LIGHTENING.
class crnrstn_lightning_ftp_conn{

    protected $oLogger;
    private static $oCRNRSTN_USR;

    protected $ftp_server;
    protected $ftp_username;
    protected $ftp_password;
    protected $ftp_port;
    protected $ftp_timeout;

    protected $ftp_is_ssl=false;

    protected $ftp_conn_id;
    protected $ftp_login_result;
    public $isValid = false;
    public $connection_status = 'new';
    public $connection_status_log = array();
    protected $start_time_micro;
    protected $start_time_timestamp;
    protected $elapsed_time_at_start;

    public function __construct($oCRNRSTN_USR){

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

        $this->start_time_micro = self::$oCRNRSTN_USR->getMicroTime();
        $this->start_time_timestamp = self::$oCRNRSTN_USR->return_queryDateTimeStamp();
        $this->elapsed_time_at_start = self::$oCRNRSTN_USR->wallTime();

    }

    public function return_start_time_timestamp(){

        return $this->start_time_timestamp;

    }

    public function return_elapsed_time_at_start(){

        return $this->elapsed_time_at_start;

    }

    public function return_start_time_micro(){

        return $this->start_time_micro;

    }

    public function return_ftp_stream(){

        return $this->ftp_conn_id;

    }

    public function set_option($option, $value){
        /*
         * FTP_TIMEOUT_SEC
         * FTP_AUTOSEEK
         * FTP_USEPASVADDRESS
         * */

        try{
            if(!ftp_set_option($this->ftp_conn_id, $option, $value)){

                $this->log_connection_status('error :: setting option ['.$option.'] to value ['.$value.']');

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while setting option ['.$option.'] to value ['.$value.'] for ftp connection with '.$this->ftp_server.' at '.$this->ftp_port.'.');

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

        return NULL;

    }

    public function save_connection_datum($FTP_SERVER_WCR, $FTP_USERNAME_WCR, $FTP_PASSWORD_WCR, $FTP_PORT_WCR, $FTP_TIMEOUT_WCR){

        $this->ftp_server = $FTP_SERVER_WCR;
        $this->ftp_username = $FTP_USERNAME_WCR;
        $this->ftp_password = $FTP_PASSWORD_WCR;
        $this->ftp_port = $FTP_PORT_WCR;
        $this->ftp_timeout = $FTP_TIMEOUT_WCR;

    }

    public function enable_ssl($FTP_IS_SSL_WCR){

        $this->ftp_is_ssl = $FTP_IS_SSL_WCR;

    }

    public function establish_connection(){
        self::$oCRNRSTN_USR->error_log('Electrum ESTABLISHING FTP CONNECTION.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

        //
        // ESTABLISH AND RETURN FTP CONNECTION
        try{

            $tmp_option = ' ';

            if($this->ftp_is_ssl){
                self::$oCRNRSTN_USR->error_log('SSL CONNECT.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                $this->ftp_conn_id = ftp_ssl_connect($this->ftp_server, $this->ftp_port, $this->ftp_timeout);

            }else{
                self::$oCRNRSTN_USR->error_log('NON-SSL CONNECT.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                $this->ftp_conn_id = ftp_connect ($this->ftp_server, $this->ftp_port, $this->ftp_timeout);

            }

            if(!$this->ftp_conn_id){

                if($this->ftp_is_ssl){

                    $tmp_option = ' secure ';
                }

                $this->log_connection_status('error :: connection initialization');

                self::$oCRNRSTN_USR->error_log('CONNECTION ERROR.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while attempting to open a'.$tmp_option.'FTP connection with '.$this->ftp_server.' at '.$this->ftp_port.'.');

            }else{

                $this->ftp_login_result = ftp_login($this->ftp_conn_id, $this->ftp_username, $this->ftp_password);

                if(!$this->ftp_login_result){
                    self::$oCRNRSTN_USR->error_log('LOGIN ERROR.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                    $this->log_connection_status('error :: connection login authorization');

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('An error was experienced while attempting to log into an open'.$tmp_option.'FTP connection with '.$this->ftp_server.'::'.$this->ftp_username.' at '.$this->ftp_port.'.');

                }else{

                    $this->start_time_micro = self::$oCRNRSTN_USR->getMicroTime();
                    $this->start_time_timestamp = self::$oCRNRSTN_USR->return_queryDateTimeStamp();
                    $this->elapsed_time_at_start = self::$oCRNRSTN_USR->wallTime();

                    $this->log_connection_status('ready');

                    self::$oCRNRSTN_USR->error_log('Electrum FTP CONNECTION SUCCESS for '.$this->ftp_username.'!', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                }

            }

        } catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            //
            // RETURN FALSE
            return false;
        }

        return NULL;

    }

    public function enable_passive($is_passive=false){

        try{

            //
            // TURN ON PASSIVE MODE
            if(!ftp_pasv($this->ftp_conn_id, $is_passive)){

                $this->log_connection_status('error :: enabling passive mode');

                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('An error was experienced while enabling passive mode for ftp connection with '.$this->ftp_server.' at '.$this->ftp_port.'.');

            }

        }catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

        return NULL;

    }

    public function log_connection_status($str){

        $this->connection_status = $str;
        $this->connection_status_log[] = $str;

    }

    public function __destruct() {

    }

}


# # C # R # N # R # S # T # N # # : : # #
#  CLASS :: crnrstn_fire_ftp_manager
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 2.0.0
#  CLASS DATE :: September 12, 2020 @ 0640hrs
#  Ezekiel 1:5a - AND FROM THE MIDST OF IT [FIRE] THERE CAME THE LIKENESS OF FOUR LIVING CREATURES.
class crnrstn_fire_ftp_manager {

    protected $oLogger;
    private static $oCRNRSTN_USR;

    public $lightning_FTP_conn_ARRAY = array();

    public function __construct($oCRNRSTN_USR){

        self::$oCRNRSTN_USR = $oCRNRSTN_USR;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

        self::$oCRNRSTN_USR->error_log('NEW FOUR LIVING CREATURES INSTANTIATED.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

    }

    private function establishConnection($endpoint_data, $endpoint_serial){

        /*
        $oWCR->addAttribute('FTP_SERVER', '172.16.195.132');
        $oWCR->addAttribute('FTP_USERNAME', 'jony5');
        $oWCR->addAttribute('FTP_PASSWORD', 'gY96sb21');
        $oWCR->addAttribute('FTP_PORT', 21);
        $oWCR->addAttribute('FTP_TIMEOUT', 90);
        $oWCR->addAttribute('FTP_IS_SSL', false);
        $oWCR->addAttribute('FTP_USE_PASV', false);
        $oWCR->addAttribute('FTP_USE_PASV_ADDR', false);
        $oWCR->addAttribute('FTP_DISABLE_AUTOSEEK', true);
        $oWCR->addAttribute('FTP_DIR_PATH', '../../var/www/html/_backup_test/');
        */

        $tmp_FTP_SERVER_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $endpoint_data);
        $tmp_FTP_USERNAME_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $endpoint_data);
        $tmp_FTP_PASSWORD_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_PASSWORD', $endpoint_data);
        $tmp_FTP_PORT_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $endpoint_data);
        $tmp_FTP_TIMEOUT_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_TIMEOUT', $endpoint_data);
        $tmp_FTP_IS_SSL_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_IS_SSL', $endpoint_data);
        $tmp_FTP_USE_PASV_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_USE_PASV', $endpoint_data);
        $tmp_FTP_USE_PASV_ADDR_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_USE_PASV_ADDR', $endpoint_data);
        $tmp_FTP_DISABLE_AUTOSEEK_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_DISABLE_AUTOSEEK', $endpoint_data);

        //$tmp_endpoint_id = md5($tmp_FTP_SERVER_WCR.$tmp_FTP_USERNAME_WCR.$tmp_FTP_PASSWORD_WCR.$tmp_FTP_PORT_WCR);

        try{

            // DO WE HAVE EXISTING CONNECTION FOR THIS ENDPOINT
            if(isset($this->lightning_FTP_conn_ARRAY[$endpoint_serial])){

                //
                // CONSIDER A PING FOR $oLightning_conn AS IN if($oLightning_conn->conn_ping(ftp_conn)){ Proceed...
                //return $this->lightning_FTP_conn_ARRAY[$tmp_endpoint_serial];
                self::$oCRNRSTN_USR->error_log('FOUR LIVING CREATURES - EXISTING CONN ALREADY.', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                //return $tmp_endpoint_serial;

            }else{

                /*
                 *
                // CONFIRM THAT THERE ARE NOT TOO MANY FTP CONNECTIONS ALREADY
                //if($this->too_many_connections($endpoint_id, $oElectrum, $oDATA, $oDB_RESP)){
                //    $this->transaction_status = 'Too many active connections to this endpoint. Connection attempt suppressed.';
                //    return false;
                }*/

                $oLightning_conn = new crnrstn_lightning_ftp_conn(self::$oCRNRSTN_USR);
                $oLightning_conn->save_connection_datum($tmp_FTP_SERVER_WCR, $tmp_FTP_USERNAME_WCR, $tmp_FTP_PASSWORD_WCR, $tmp_FTP_PORT_WCR, $tmp_FTP_TIMEOUT_WCR);

                if($tmp_FTP_IS_SSL_WCR){

                    $oLightning_conn->enable_ssl(true);

                }

                $oLightning_conn->establish_connection();

                if($tmp_FTP_USE_PASV_WCR){

                    $oLightning_conn->enable_passive(true);         // CALL AFTER establish_connection()

                    if(!$tmp_FTP_USE_PASV_ADDR_WCR){

                        $oLightning_conn->set_option(FTP_USEPASVADDRESS, false);        # ENABLED BY DEFAULT

                    }
                }

                if($tmp_FTP_DISABLE_AUTOSEEK_WCR){

                    $oLightning_conn->set_option(FTP_AUTOSEEK, false);                  # ENABLED BY DEFAULT

                }

                //$this->lightning_FTP_conn_ARRAY[$tmp_endpoint_serial] = $oLightning_conn->return_ftp_stream();
                $this->lightning_FTP_conn_ARRAY[$endpoint_serial] = $oLightning_conn;


            }

        } catch( Exception $e ) {

            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_lightningFTPConn($endpoint_serial){

        return $this->lightning_FTP_conn_ARRAY[$endpoint_serial];

    }

    public function initialize_ftp_endpoint($flow_type, $endpoint_data, $endpoint_serial){

        try{

            //
            // FOR THIS END POINT.
            # PERFORM GENERIC CONNECTION OPEN PROTOCOLS
            $this->establishConnection($endpoint_data, $endpoint_serial);

            # IF CONNECTION ESTABLISHED, FOR SOURCE...CAN I READ ACCESS?
            if(!isset($this->lightning_FTP_conn_ARRAY[$endpoint_serial])){
                //
                // HOOOSTON...VE HAF PROBLEM!
                throw new Exception('Unable to establish FTP connection.');

            }else{

                // AM I SOURCE OR DESTINATION
                switch($flow_type){
                    case 'SOURCE':

                        $tmp_read_permissions = false;
                        $tmp_FTP_DIR_PATH_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_DIR_PATH', $endpoint_data);
                        $tmp_FTP_SERVER_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $endpoint_data);

                        //
                        // WE HAVE ESTABLISHED A VALID FTP CONN TO A SOURCE
                        // JUST VERIFY THAT YOU CAN READ.
                        $oLightning_ftp_conn =  $this->lightning_FTP_conn_ARRAY[$endpoint_serial];
                        $tmp_ftp_conn = $oLightning_ftp_conn->return_ftp_stream();
                        $tmp_config_serial = self::$oCRNRSTN_USR->return_configSerial();

                        $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = 'The CRNRSTN :: Electrum process has experienced permissions related error as the '.$tmp_FTP_SERVER_WCR.' SOURCE FTP directory, '.$tmp_FTP_DIR_PATH_WCR.', is NOT readable by ftp_nlist() ';
                        $endpoint_contents = ftp_nlist($tmp_ftp_conn, $tmp_FTP_DIR_PATH_WCR);
                        $_SESSION['CRNRSTN_'.crc32($tmp_config_serial)]['CRNRSTN_EXCEPTION_PREFIX'] = '';

                        if($endpoint_contents){
                            $tmp_read_permissions = true;

                        }

                        if($tmp_read_permissions){

                            //self::$oCRNRSTN_USR->error_log('Electrum FTP SUCCESS ON READ PERMISSIONS!', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');

                            $oLightning_ftp_conn->isValid = true;
                            $this->lightning_FTP_conn_ARRAY[$endpoint_serial] = $oLightning_ftp_conn;

                            return true;

                        }else{

                            $tmp_FTP_SERVER_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_SERVER', $endpoint_data);
                            $tmp_FTP_USERNAME_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_USERNAME', $endpoint_data);
                            $tmp_FTP_PORT_WCR = self::$oCRNRSTN_USR->getEnvResource('FTP_PORT', $endpoint_data);

                            $oLightning_ftp_conn->isValid = false;
                            $this->lightning_FTP_conn_ARRAY[$endpoint_serial] = $oLightning_ftp_conn;

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to read ['.$tmp_FTP_DIR_PATH_WCR.'] from FTP endpoint '.$tmp_FTP_SERVER_WCR.'::'.$tmp_FTP_USERNAME_WCR.' on port '.$tmp_FTP_PORT_WCR.'.');

                        }

                    break;
                    default:
                        //
                        // DESTINATION FTP
                        self::$oCRNRSTN_USR->error_log('TODO :: Consider FTP destination preload integrity validation check...', __LINE__, __METHOD__, __FILE__, 'CRNRSTN_oELECTRUM');
                        $oLightning_ftp_conn =  $this->lightning_FTP_conn_ARRAY[$endpoint_serial];
                        $oLightning_ftp_conn->isValid = true;
                        $this->lightning_FTP_conn_ARRAY[$endpoint_serial] = $oLightning_ftp_conn;

                        return true;

                    break;

                }

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            return false;

        }

    }

    public function __destruct() {

    }

}