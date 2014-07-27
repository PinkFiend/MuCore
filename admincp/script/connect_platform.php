<?
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.net                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
require("../engine/adodb/adodb.inc.php");

if ($core['connection_type'] == "ODBC") {
    $core_db =& ADONewConnection('odbc');
    if ($core['debug'] == 1) {
        $core_db->debug = true;
    }
    $core_db_connect_sql = $core_db->Connect($core['db_name'], $core['db_user'], $core['db_password'], $core['db_host']);
    if (!$core_db_connect_sql) {
        $sql_part = '1';
        include('../error_templates/sql_error.php');
        exit;
    }
    $core_db2 = $core_db;
    if ($core['server_use_2_db'] == "1") {
        $core_db2 =& ADONewConnection('odbc');
        if ($core['debug'] == 1) {
            $core_db2->debug = true;
        }
        $core_db_connect_sql2 = $core_db2->NConnect($core['db_name2'], $core['db_user2'], $core['db_password2'], $core['db_host2']);
        if (!$core_db_connect_sql2) {
            $sql_part = '2';
            include('../error_templates/sql_error.php');
            exit;
        }
        $core_db2 = $core_db2;
    }
} elseif ($core['connection_type'] == "MSSQL") {
    $core_db =& ADONewConnection('mssql');
    if ($core['debug'] == 1) {
        $core_db->debug = true;
    }
    $core_db_connect_sql = $core_db->Connect($core['db_host'], $core['db_user'], $core['db_password'], $core['db_name']);
    if (!$core_db_connect_sql) {
        $sql_part = '1';
        include('../error_templates/sql_error.php');
        exit;
    }
    $core_db2 = $core_db;
    if ($core['server_use_2_db'] == "1") {
        $core_db2 =& ADONewConnection('mssql');
        if ($core['debug'] == 1) {
            $core_db2->debug = true;
        }
        $core_db_connect_sql2 = $core_db2->NConnect($core['db_host2'], $core['db_user2'], $core['db_password2'], $core['db_name2']);
        if (!$core_db_connect_sql2) {
            $sql_part = '2';
            include('../error_templates/sql_error.php');
            exit;
        }
        $core_db2 = $core_db2;
    }
}
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.net                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
?> 