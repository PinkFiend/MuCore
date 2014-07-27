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
$config = simplexml_load_file('engine/config_mods/clear_pk_status_settings.xml');
$active = trim($config->active);
if ($active == '0') {
    echo msg('0', 'Sorry, this feature is temporarily unavailable at the moment.');
} else {
    $pk_zen = trim($config->zen);
    if (isset($_GET['cid'])) {
        echo '<div style="margin-top: 10px;">';
        $id = safe_input($_GET['cid'], '');
        if (empty($id) || !is_numeric($id)) {
            header('Location: ' . $core_run_script . '');
            exit();
        } else {
            if (character_and_account($id, $user_auth_id) === false) {
                header('Location: ' . $core_run_script . '');
                exit();
            } else {
                if (account_online($user_auth_id) === true) {
                    echo msg('0', 'Account is connected on game, please logout.');
                } else {
                    $select_req = $core_db->Execute("select money,pklevel from character where mu_id=? and accountid=?", array(
                        $id,
                        safe_input($user_auth_id, '')
                    ));
                    if ($select_req->fields[1] <= 3) {
                        echo msg('0', 'Unable to clear pk status, reason: you not have not killed anyone. go kill some more to use this function.');
                    } else {
                        $required_pk_zen = $pk_zen * ($select_req->fields[1] - 3);
                        if ($select_req->fields[0] < $required_pk_zen) {
                            echo msg('0', 'Unable to clear pk status, reason: lacking ' . number_format($required_pk_zen - $select_req->fields[0]) . ' zen.');
                        } else {
                            $new_zen          = $select_req->fields[0] - $required_pk_zen;
                            $update_pk_status = $core_db->Execute("Update character set [money]=?,[pklevel]=? where mu_id=?", array(
                                $new_zen,
                                '3',
                                $id
                            ));
                            if ($update_pk_status) {
                                echo msg('1', 'Character successfully cleared.');
                            } else {
                                echo msg('0', 'Unable to clear pk status, reason: system error, please contact administrator.');
                            }
                            
                        }
                    }
                }
            }
        }
    }
    echo '<div style="margin-top: 20px;">
<fieldset><legend>Clear PK Status Requirements</legend>
<table border="0" cellspacing="4" cellpadding="0" width="100%" style="padding-left: 10px;">
<tr>
<td align="left"><b>Zen:</b></td>
<td align="left" width="100%">' . number_format($pk_zen) . ' / status (e.g: if you are murder level 2, you will need to pay ' . number_format($pk_zen * 2) . '</td>
</tr>
</table>
</fieldset>
</div>';
    
    $characters = $core_db->Execute("Select mu_id,name,class,money,pklevel,pkcount from character where accountid=? order by clevel desc ", array(
        $user_auth_id
    ));
    
    echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;">';
    while (!$characters->EOF) {
        if ($characters->fields[4] > 3) {
            $need_pk_zen = $pk_zen * ($characters->fields[4] - 3);
            if ($characters->fields[3] < $pk_zen) {
                $lacking_error = '<span class="iR_func_status_lacking">lacking ' . number_format($need_pk_zen - $characters->fields[3]) . ' zen</span>';
            } else {
                $lacking_error = '<input type="button" value="Clear PK Status" onclick="location.href=\'' . $core_run_script . '&cid=' . $characters->fields[0] . '\'">';
            }
        } else {
            if ($characters->fields[4] == '3') {
                $lacking_error = 'You are a coward nab, why don\'t you try and kill someone.';
            } elseif ($characters->fields[4] == '2') {
                $lacking_error = 'Wtg! Kill some more murderers and increase your hero\'s level status.';
            } elseif ($characters->fields[4] == '1') {
                $lacking_error = 'Hurray! Eradicate those nab murderers! You are a real hero.';
            }
        }
        echo '<tr>
    <td width="66" rowspan="2"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($characters->fields[2], '2') . '" width="66" height="66" title="Class"></td>
    <td align="left" class="iR_name" width="100">' . htmlentities($characters->fields[1]) . '</td>
    <td align="left" class="iR_stats">Zen: ' . number_format($characters->fields[3]) . '</td>
    <td align="left" class="iR_stats">Pk Status: ' . decode_pk($characters->fields[4]) . '</td>
    <td align="left" class="iR_stats">Pk Count: ' . number_format($characters->fields[5]) . '</td>
  </tr>
  <tr>
    <td algin="left" class="iR_class">' . decode_class($characters->fields[2]) . '</td>
    <td colspan="3" class="iR_func_status" align="left">' . $lacking_error . '</td>
  </tr>
    <tr>
    <td colspan="5" class="iRg_line_top">&nbsp;</td>
  </tr>';
        $characters->MoveNext();
    }
    echo '</table>';
    
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