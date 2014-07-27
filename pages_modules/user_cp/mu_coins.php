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
$config = simplexml_load_file('engine/config_mods/mu_coins_settings.xml');
$active = trim($config->active);
if ($active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    $check_mu_coins = $core_db2->Execute("Select " . MU_COINS_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
        $user_auth_id
    ));
    if ($check_mu_coins->EOF) {
        $insert_mu_coins_id = $core_db2->Execute("INSERT INTO " . MU_COINS_TABLE . " (" . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . ")VALUES(?,?)", array(
            $user_auth_id,
            '0'
        ));
        if ($insert_mu_coins_id) {
            echo msg('1', text_mucoins_t1);
        } else {
            echo msg('0', text_mucoins_t2);
        }
    }
    echo '<div style="margin-top: 20px; margin-bottom: 20px;">
<fieldset><legend>' . text_mucoins_t3 . '</legend>
<table border="0" cellspacing="4" cellpadding="0" width="100%" style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
<tr>
<td align="left" width="60"><b>' . text_mucoins_t4 . ':</b></b>
<td align="left"><b>' . number_format($check_mu_coins->fields[0]) . '</b>
</td>
<tr>
<td align="right" colspan="2"><input type="button" value="' . button_purchase_credits . '" onclick="location.href=\'' . $config->buy_url . '\'">
</td>
</tr>
</table>
</fieldset>
</div>';
    
    
    echo '
    <div align="left" style="margin-bottom: 2px;"><b>' . text_mucoins_t5 . '</b></div>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_list" style="margin-bottom: 10px;">


    <tr>
    <td align="left" class="title">#</td>
    <td align="left" class="title">' . text_mucoins_t6 . '</td>
    <td align="left" class="title">' . text_mucoins_t7 . '</td>
    <td align="left" class="title">' . text_mucoins_t8 . '</td>
    <td align="left" class="title">' . text_mucoins_t9 . '</td>
    <td align="left" class="title">' . text_mucoins_t10 . '</td>
    </tr>
  ';
    $select_transactions = $core_db->Execute("Select transaction_id,amount,currency,credits,order_date,status from MUCore_PayPal_Donate_Transactions where memb___id=? order by order_date desc", array(
        $user_auth_id
    ));
    $count               = 0;
    while (!$select_transactions->EOF) {
        $count++;
        
        $tr_color = ($count % 2) ? '' : 'even';
        echo '
    <tr class="' . $tr_color . '">
    <td align="left" class="content">' . $count . '</td>
    <td align="left" class="content">' . $select_transactions->fields[0] . '</td>
    <td align="left" class="content">' . $select_transactions->fields[1] . ' ' . $select_transactions->fields[2] . '</td>
    <td align="left" class="content">' . number_format($select_transactions->fields[3]) . '</td>
    <td align="left" class="content">' . date('F j, Y / H:i', $select_transactions->fields[4]) . '</td>
    <td align="left" class="content">' . $select_transactions->fields[5] . '</td>
    </tr>
    ';
        $select_transactions->MoveNext();
    }
    
    if ($count == '0') {
        echo '<tr>
    <td align="center" colspan="6"><em>' . text_mucoins_t11 . '</em></td>
    </td>';
    }
    echo '

    </table>';
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