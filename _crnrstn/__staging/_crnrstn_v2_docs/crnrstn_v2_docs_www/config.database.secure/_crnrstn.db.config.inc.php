<?php
//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $this->oMYSQLI_CONN_MGR->addConnection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', '127.0.0.4', 'crnrstn_demo3_un', 'FZZ88X3EU5s8vFAC', 'crnrstn_demo3');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', '127.0.0.3', 'crnrstn_demo2_un', 'PwdBNBvuFHrwMqCS', 'crnrstn_demo2');
$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_MAC', 'localhost', 'jony5_v2_stage', 'aXNTPxGPeLRwYzTS', 'jony5_v2_stage','3306');
$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PRO', 'localhost', 'jony5_v2_stage', 'aXNTPxGPeLRwYzTS', 'jony5_v2_stage','3306');
$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', 'localhost', 'crnrstn2_stage', 'KNUcSHWCARrZUsaZ', 'crnrstn2_stage','3306');
$this->oMYSQLI_CONN_MGR->addConnection('CYEXX_SYSTEMS', 'localhost', 'jony5_prod02', '1234567890', 'jony5_prod02','3306');
$this->oMYSQLI_CONN_MGR->addConnection('BLUEHOST', 'localhost', 'evifwebc_prod2', '1234567890', 'evifwebc_prod2','3306');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'aXNTPxGPeLRwYzTS', 'crnrstn_demo', 3306);