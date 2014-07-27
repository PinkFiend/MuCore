<?
require('config.php');
require('engine/global_functions.php');
require("engine/adodb/adodb.inc.php");
if ($core['debug'] == '1') {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
}
include("engine/connect_core.php");

if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'paypal':
            $paypal_settings = simplexml_load_file('engine/config_mods/donate_paypal_settings.xml');
            $paypal_email    = $paypal_settings->pp_email;
            $punish          = trim($paypal_settings->punish);
            $log_dir         = 'engine/logs/paypal';
            
            $req = 'cmd=_notify-validate';
            
            foreach ($_POST as $key => $value) {
                $value = urlencode(stripslashes($value));
                $req .= "&$key=$value";
            }
            
            $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
            $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);
            
            /*
            $_POST['receiver_email'] = 'phpcore@mmorpgcore.com';
            $_POST['item_number'] = '57961a654586e0ef18dc78a205a6e7c5';
            $_POST['tax'] = '0';
            $_POST['mc_gross'] = '100';
            $_POST['txn_type'] = 'web_accept';
            $_POST['payment_status'] = 'Refunded';
            $_POST['mc_currency'] = 'USD';
            $_POST['txn_id'] = 'ASDKLJ34234ASD';
            $_POST['mc_gross'] = '100';
            */
            
            
            $bussines       = addslashes($_POST['bussines']);
            $receiver_email = addslashes($_POST['receiver_email']);
            $txn_type       = addslashes($_POST['txn_type']);
            
            $mc_gross       = addslashes($_POST['mc_gross']);
            $tax            = doubleval(addslashes($_POST['tax']));
            $payment_status = addslashes($_POST['payment_status']);
            $item_number    = addslashes($_POST['item_number']);
            $transaction_id = addslashes($_POST['txn_id']);
            $currency       = addslashes($_POST['mc_currency']);
            $payer_email    = addslashes($_POST['payer_email']);
            
            
            if (!$fp) {
            } else {
                fputs($fp, $header . $req);
                while (!feof($fp)) {
                    $res = fgets($fp, 1024);
                    if (strcmp($res, "VERIFIED") == 0) {
                        write_log($log_dir, 'PayPal sent [status: VERIFIED] [transaction id: ' . $transaction_id . ']');
                        if (strtolower($receiver_email) == strtolower($paypal_email)) {
                            $check_for_temp = $core_db->Execute("Select amount,currency,memb___id,credits from MUCore_PayPal_Donate_Orders where hash=?", array(
                                $item_number
                            ));
                            if (!$check_for_temp->EOF) {
                                if (($txn_type == 'web_accept' OR $txn_type == 'subscr_payment') AND $payment_status == 'Completed') {
                                    write_log($log_dir, 'PayPal sent [payment status: ' . $payment_status . ']  [transaction id: ' . $transaction_id . '] [userid: ' . $check_for_temp->fields[2] . '] ' . $mc_gross . ' ' . $currency . '');
                                    $order_cost = $check_for_temp->fields[0];
                                    if ($tax > 0) {
                                        $mc_gross -= $tax;
                                    }
                                    if ($mc_gross == $order_cost) {
                                        if ($currency == $check_for_temp->fields[1]) {
                                            $check_if_transaction_exist = $core_db->Execute("Select id from MUCore_PayPal_Donate_Transactions where transaction_id=?", array(
                                                $transaction_id
                                            ));
                                            if ($check_if_transaction_exist->RecordCount() <= 0) {
                                                $order_date_time = time();
                                                $insert_txn_id   = $core_db->Execute("INSERT INTO MUCore_PayPal_Donate_Transactions (transaction_id,amount,currency,memb___id,credits,order_date,status,payer_email)VALUES(?,?,?,?,?,?,?,?)", array(
                                                    $transaction_id,
                                                    $mc_gross,
                                                    $currency,
                                                    $check_for_temp->fields[2],
                                                    $check_for_temp->fields[3],
                                                    $order_date_time,
                                                    $payment_status,
                                                    $payer_email
                                                ));
                                                if ($insert_txn_id) {
                                                    write_log($log_dir, '[PayPal Donate Step 1/2] Insert Transaction Infos [transaction id: ' . $transaction_id . '] [amount: ' . $mc_gross . ' ' . $currency . '] [userid: ' . $check_for_temp->fields[2] . '] [credits: ' . number_format($check_for_temp->fields[3]) . ']');
                                                    $check_for_memb_id = $core_db2->Execute("Select " . MU_COINS_USERID_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
                                                        $check_for_temp->fields[2]
                                                    ));
                                                    if ($check_for_memb_id->EOF) {
                                                        $set_credits = $core_db2->Execute("insert into " . MU_COINS_TABLE . " (" . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . ")VALUES(?,?)", array(
                                                            $check_for_temp->fields[2],
                                                            $check_for_temp->fields[3]
                                                        ));
                                                    } else {
                                                        $set_credits = $core_db2->Execute("Update " . MU_COINS_TABLE . " set " . MU_COINS_COLUMN . "=" . MU_COINS_COLUMN . "+?  where " . MU_COINS_USERID_COLUMN . "=?", array(
                                                            $check_for_temp->fields[3],
                                                            $check_for_temp->fields[2]
                                                        ));
                                                    }
                                                    if ($set_credits) {
                                                        write_log($log_dir, '[PayPal Donate Step 2/2] Set Credits [userid: ' . $check_for_temp->fields[2] . '] [credits: ' . number_format($check_for_temp->fields[3]) . ']');
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } elseif ($payment_status == 'Reversed' OR $payment_status == 'Refunded') {
                                    write_log($log_dir, 'PayPal sent [payment status: ' . $payment_status . ']  [transaction id: ' . $transaction_id . '] [userid: ' . $check_for_temp->fields[2] . ']');
                                    if ($punish == '1') {
                                        $update_transaction_info = $core_db->Execute("Update MUCore_PayPal_Donate_Transactions set status=? where transaction_id=?", array(
                                            $payment_status,
                                            $transaction_id
                                        ));
                                        if ($update_transaction_info) {
                                            $bloc_userid = $core_db2->Execute("Update memb_info set bloc_code='1' where memb___id=?", array(
                                                $check_for_temp->fields[2]
                                            ));
                                            if ($bloc_userid) {
                                                write_log($log_dir, '[PayPal Donate Chargeback Punish] Block account [userid: ' . $check_for_temp->fields[2] . ']');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                    } else if (strcmp($res, "INVALID") == 0) {
                        write_log($log_dir, 'PayPal sent [status: INVALID] [transaction id: ' . $transaction_id . ']');
                    }
                }
                fclose($fp);
            }
            
            break;
    }
}


?> 