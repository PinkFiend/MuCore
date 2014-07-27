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
require('config.php');
require('engine/global_config.php');
require('engine/global_functions.php');
require("engine/adodb/adodb.inc.php");
if ($core['debug'] == '1') {
    ini_set('display_errors', 'On');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    ini_set('display_errors', 'Off');
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
}
include("engine/connect_core.php");
ob_start();
include('mucore.core');
$core_ob = ob_get_contents();
ob_end_clean();
$extract_core     = crypt_it($core_ob, $core['config']['SN']);
$core_extract     = base64_decode($extract_core);
$core_md5_encrypt = md5_decrypt($core_extract);
$remove_core      = substr_replace($core_md5_encrypt, "", -60);
$core_dob         = crypt_it($remove_core, $core['config']['SN']);
$core_l           = preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['SERVER_NAME'], $lru);
$lru              = $lru[1];
$core_Ozu         = preg_match('/[^.]+\.[^.]+$/', $lru, $sync);
$m_sync           = $sync[0];
$sync_alfa        = md5($core['config']['SN'] . $m_sync);
if ($sync_alfa == $core_dob) {
    $daopay_settings = simplexml_load_file('engine/config_mods/donate_daopay_settings.xml');
    $log_dir         = 'engine/logs/daopay';
    
    
    $appcode  = $daopay_settings->app_code;
    $prodcode = safe_input(trim($_GET["prodcode"]), '');
    $pin      = safe_input(trim($_GET["pin"]), '');
    
    $transaction_id = safe_input($_GET['orderno'], '');
    $item_number    = safe_input($_GET['item_number'], '');
    
    
    
    if ($appcode != $_GET["appcode"]) {
        header('Location: ' . $core['config']['website_url'] . '');
    }
    
    if (strlen($prodcode) && strlen($pin)) {
        $handle = fopen("http://daopay.com/svc/pincheck?appcode=" . $appcode . "&prodcode=" . $prodcode . "&pin=" . $pin, "r");
        if ($handle) {
            $reply = fgets($handle);
            if (substr($reply, 0, 2) == "ok") {
                write_log($log_dir, '[DaoPay Donate System] [DaoPay Sent Status: OK] [order no: ' . $transaction_id . ']');
                $check_for_temp = $core_db->Execute("Select memb___id,credits,code from MUCore_DaoPay_Donate_Orders where hash=?", array(
                    $item_number
                ));
                if (!$check_for_temp->EOF) {
                    write_log($log_dir, '[DaoPay Donate System] [Check Order: OK] [order no: ' . $transaction_id . ']');
                    $check_if_transaction_exist = $core_db->Execute("Select id from MUCore_DaoPay_Donate_Transactions where transaction_id=?", array(
                        $transaction_id
                    ));
                    if ($check_if_transaction_exist->EOF) {
                        write_log($log_dir, '[DaoPay Donate System] [Check Transaction: OK] [order no: ' . $transaction_id . ']');
                        $order_date_time = time();
                        $insert_txn_id   = $core_db->Execute("INSERT INTO MUCore_DaoPay_Donate_Transactions (transaction_id,code,memb___id,credits,order_date,status)VALUES(?,?,?,?,?,?)", array(
                            $transaction_id,
                            $check_for_temp->fields[2],
                            $check_for_temp->fields[0],
                            $check_for_temp->fields[1],
                            $order_date_time,
                            'OK'
                        ));
                        if ($insert_txn_id) {
                            write_log($log_dir, '[DaoPay Donate Step 1/2] Insert Transaction Infos [order no: ' . $transaction_id . '] [product code: ' . $check_for_temp->fields[2] . '] [userid: ' . $check_for_temp->fields[0] . '] [credits: ' . number_format($check_for_temp->fields[1]) . ']');
                            $check_for_memb_id = $core_db2->Execute("Select " . MU_COINS_USERID_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
                                $check_for_temp->fields[0]
                            ));
                            if ($check_for_memb_id->EOF) {
                                $set_credits = $core_db2->Execute("insert into " . MU_COINS_TABLE . " (" . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . ")VALUES(?,?)", array(
                                    $check_for_temp->fields[0],
                                    $check_for_temp->fields[1]
                                ));
                            } else {
                                $set_credits = $core_db2->Execute("Update " . MU_COINS_TABLE . " set " . MU_COINS_COLUMN . "=" . MU_COINS_COLUMN . "+?  where " . MU_COINS_USERID_COLUMN . "=?", array(
                                    $check_for_temp->fields[1],
                                    $check_for_temp->fields[0]
                                ));
                            }
                            if ($set_credits) {
                                write_log($log_dir, '[DaoPay Donate Step 2/2] Set Credits [order no: ' . $transaction_id . '] [product code: ' . $check_for_temp->fields[2] . '] [userid: ' . $check_for_temp->fields[0] . '] [credits: ' . number_format($check_for_temp->fields[1]) . ']');
                                echo '<b>Payment successfully completed!</b><br>You will be redirected to ' . $core['config']['websitetitle'] . ' in 5 seconds<br><br><a href="' . $core['config']['website_url'] . '">Click here if your browser does not automatically redirect you.</a><meta http-equiv="Refresh" content="5; URL=' . $core['config']['website_url'] . '">';
                            }
                        }
                    } else {
                        write_log($log_dir, '[DaoPay Donate System] [Check Transaction: ALREADY PROCESSED] [order no: ' . $transaction_id . ']');
                        header('Location: ' . $core['config']['website_url'] . '');
                    }
                    
                } else {
                    write_log($log_dir, '[DaoPay Donate System] [Check Order: INVALID ORDER] [order no: ' . $transaction_id . ']');
                    header('Location: ' . $core['config']['website_url'] . '');
                }
            } else {
                write_log($log_dir, '[DaoPay Donate System] [DaoPay Sent Status: ' . $reply . '] [order no: ' . $transaction_id . ']');
                header('Location: ' . $core['config']['website_url'] . '');
            }
            
        }
        
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