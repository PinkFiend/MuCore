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
    if ($daopay_settings->active == '0') {
        echo msg('0', text_sorry_feature_disabled);
    } else {
        if (isset($_POST['process_donate_dp'])) {
            if (empty($_POST['item_order_dp'])) {
                echo msg('0', 'Please select one donate pacakge.');
            } else {
                $donate_process_dp = '1';
                $id                = safe_input($_POST['item_order_dp'], '');
                $donate_file       = file('engine/variables_mods/daopay_donate.tDB');
                foreach ($donate_file as $donate_data) {
                    $donate_data = explode("¦", $donate_data);
                    if ($donate_data[1] == $id && $donate_data[3] == '1') {
                        $donate_found    = '1';
                        $donate_title    = $donate_data[2];
                        $donate_id       = $donate_data[1];
                        $donate_amount   = $donate_data[4];
                        $donate_currency = $donate_data[5];
                        $donate_credits  = $donate_data[6];
                        $donate_code     = $donate_data[7];
                        break;
                    }
                }
                
                if ($donate_found == '1') {
                    $hash_item         = md5($user_auth_id . $amount . $period . $pay . uniqid(microtime(), 1));
                    $insert_pre_donate = $core_db->Execute("insert into MUCore_DaoPay_Donate_Orders (donate_id,code,credits,memb___id,hash)VALUES(?,?,?,?,?)", array(
                        $donate_id,
                        $donate_code,
                        $donate_credits,
                        $user_auth_id,
                        $hash_item
                    ));
                    if ($insert_pre_donate) {
                        echo '
                <div style="margin-top: 10px; margin-bottom: 10px;">
                <fieldset><legend>' . text_your_donate_info . '</legend>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="4" style="padding-left: 10px; padding-right: 10px;">
                <tr>
                <td align="left" width="90"><b>' . text_user_id . '</b> :</td>
                <td align="left">' . $user_auth_id . '</td>
                </tr>
                <tr>
                <td align="left"><b>' . text_issued_credits . '</b> :</td>
                <td align="left">' . number_format($donate_credits) . '</td>
                </tr>
                <tr>
                <td style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x; height: 2px;" colspan="2">
                </td>
                </tr>
                </table> 
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="4" style="padding-left: 10px; padding-right: 10px; padding-bottom: 5px;">        
                <tr>
                <td align="left"><b>' . text_donate_amount . '</b> : ' . $donate_amount . ' ' . $donate_currency . '</td>
                <td align="right">
            <input type="button" value="Donate Using DaoPay" class="submit_big" onclick="location.href=\'http://daopay.com/payment/?appcode=' . $daopay_settings->app_code . '&prodcode=' . $donate_code . '&item_number=' . $hash_item . '\'">

            </td>
                </tr>
  
                </table>
                </fildset>
                </div>
                
                
                ';
                        
                    } else {
                        echo msg('0', text_checkout_error);
                    }
                    
                } else {
                    echo msg('0', text_checkout_error);
                }
            }
            
        }
        if ($donate_process_dp != '1') {
            echo '
<form name="daopay_donate" action="" method="POST">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="8">';
            $donate_file = get_sort('engine/variables_mods/daopay_donate.tDB', '¦');
            $count       = 0;
            foreach ($donate_file as $donate) {
                if ($donate[3] == '1') {
                    $count++;
                    echo '
    <tr>
    <td rowspan="3" align="left" width="120"><label for="radio_' . $donate[1] . '"><img src="template/' . $core['config']['template'] . '/images/daopay_logo.png"></label></td>
    <td align="left" class="iR_class"><label for="radio_' . $donate[1] . '_dp">' . htmlspecialchars($donate[2]) . '</label></td>
    <td rowspan="3" align="center" width="70" class="iR_stats_reset">
    <input name="item_order_dp" type="radio" value="' . $donate[1] . '" id="radio_' . $donate[1] . '_dp"></td>
  </tr>
  <tr>
    <td class="iR_stats">' . text_issued_credits . ' : ' . number_format($donate[6]) . '</td>
  </tr>
  <tr>
    <td class="iR_stats_level">' . text_donate_amount . ' : ' . $donate[4] . ' ' . $donate[5] . '</td>
  </tr>
  <tr>
  <td style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x; height: 2px;" colspan="3"></td>
  </tr>';
                }
            }
            if ($count == '0') {
                echo '
    <tr>
    <td align"center">' . msg('0', text_sorry_no_donations) . '</td>
    </td>';
            } else {
                echo '<tr>
    <td align="right" colspan="3">
    <input type="hidden" name="process_donate_dp">
    <input type="submit" value="' . button_proceed_checkout . '"></td>
    </tr>';
            }
            
            echo '</table>

</form>';
            
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