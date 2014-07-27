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
$paypal_settings = simplexml_load_file('engine/config_mods/donate_paypal_settings.xml');
if ($paypal_settings->active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    if (isset($_POST['process_donate'])) {
        if (empty($_POST['item_order'])) {
            echo msg('0', 'Please select one donate package.');
        } else {
            $donate_process = '1';
            $id             = safe_input($_POST['item_order'], '');
            $donate_file    = file('engine/variables_mods/paypal_donate.tDB');
            foreach ($donate_file as $donate_data) {
                $donate_data = explode("¦", $donate_data);
                if ($donate_data[1] == $id && $donate_data[3] == '1') {
                    $donate_found    = '1';
                    $donate_title    = $donate_data[2];
                    $donate_id       = $donate_data[1];
                    $donate_amount   = $donate_data[4];
                    $donate_currency = $donate_data[5];
                    $donate_credits  = $donate_data[6];
                    break;
                }
            }
            
            if ($donate_found == '1') {
                $hash_item         = md5($user_auth_id . $amount . $period . $pay . uniqid(microtime(), 1));
                $insert_pre_donate = $core_db->Execute("insert into MUCore_PayPal_Donate_Orders (donate_id,amount,currency,credits,memb___id,hash)VALUES(?,?,?,?,?,?)", array(
                    $donate_id,
                    $donate_amount,
                    $donate_currency,
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
                <td align="right"><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_donations" />
            
            <input type="hidden" name="business" value="' . $paypal_settings->pp_email . '" />
            
            <input type="hidden" name="item_name" value="Donate for ' . $core['config']['websitetitle'] . '" />
            <input type="hidden" name="item_number" value="' . $hash_item . '" />
            <input type="hidden" name="currency_code" value="' . strtoupper($donate_currency) . '" />

            <input type="hidden" name="amount" value="' . $donate_amount . '" />

            <input type="hidden" name="no_shipping" value="1" />
            <input type="hidden" name="shipping" value="0.00" />
            <input type="hidden" name="return" value="' . $core['config']['website_url'] . '" />
            <input type="hidden" name="cancel_return" value="' . $core['config']['website_url'] . '" />
            <input type="hidden" name="notify_url" value="' . $core['config']['website_url'] . '/payment_process.php?method=paypal" />

            <input type="hidden" name="custom" value="' . $user_auth_id . '" />
            <input type="hidden" name="no_note" value="1" />


            <input type="hidden" name="tax" value="0.00" />
            <input type="submit" value="Donate Using PayPal" class="submit_big">

            </form></td>
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
    if ($donate_process != '1') {
        echo '
<form name="paypal_donate" action="" method="POST">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="8">';
        $donate_file = get_sort('engine/variables_mods/paypal_donate.tDB', '¦');
        $count       = 0;
        foreach ($donate_file as $donate) {
            if ($donate[3] == '1') {
                $count++;
                echo '
    <tr>
    <td rowspan="3" align="left" width="120"><label for="radio_' . $donate[1] . '"><img src="template/' . $core['config']['template'] . '/images/paypal_logo.png"></label></td>
    <td align="left" class="iR_class"><label for="radio_' . $donate[1] . '">' . htmlspecialchars($donate[2]) . '</label></td>
    <td rowspan="3" align="center" width="70" class="iR_stats_reset">
    <input name="item_order" type="radio" value="' . $donate[1] . '" id="radio_' . $donate[1] . '"></td>
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
    <input type="hidden" name="process_donate">
    <input type="submit" value="' . button_proceed_checkout . '"></td>
    </tr>';
        }
        
        echo '</table>';
        
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