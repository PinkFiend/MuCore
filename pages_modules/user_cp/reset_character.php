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
$load_reset_settings = simplexml_load_file('engine/config_mods/reset_character_settings.xml');
$active              = trim($load_reset_settings->active);
if ($active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    $reset_level          = trim($load_reset_settings->level);
    $reset_zen            = trim($load_reset_settings->zen);
    $reset_points         = trim($load_reset_settings->bpoints);
    $reset_points_formula = trim($load_reset_settings->bpoints_formula);
    $reset_clear_skills   = trim($load_reset_settings->clear_skills);
    $reset_clear_inv      = trim($load_reset_settings->clear_inv);
    $reset_stats          = trim($load_reset_settings->reset_stats);
    $reset_limit          = trim($load_reset_settings->reset_limit);
    
    if (isset($_GET['rid'])) {
        echo '<div style="margin-top: 10px;">';
        $id = safe_input($_GET['rid'], '');
        if (empty($id) || !is_numeric($id)) {
            header('Location: ' . $core_run_script . '');
            exit();
        } else {
            if (character_and_account($id, $user_auth_id) === false) {
                header('Location: ' . $core_run_script . '');
                exit();
            } else {
                if (account_online($user_auth_id) === true) {
                    echo msg('0', text_resetcharacter_t1);
                } else {
                    $select_req = $core_db->Execute("select clevel,money,resets,leveluppoint from character where mu_id=? and accountid=?", array(
                        $id,
                        $user_auth_id
                    ));
                    if ($select_req->fields[0] < $reset_level) {
                        echo msg('0', str_replace("{levels}", ($reset_level - $select_req->fields[0]), text_resetcharacter_t2));
                        $no_reset = 1;
                    }
                    if ($select_req->fields[1] < $reset_zen) {
                        echo msg('0', str_replace("{zen}", number_format($reset_zen - $select_req->fields[1]), text_resetcharacter_t3));
                        $no_reset = 1;
                    }
                    if ($select_req->fields[2] >= $reset_limit) {
                        echo msg('0', str_replace("{resets_limit}", number_format($reset_limit), text_resetcharacter_t4));
                        $no_reset = 1;
                    }
                    if ($no_reset != '1') {
                        $new_money = $select_req->fields[1] - $reset_zen;
                        switch ($reset_points_formula) {
                            case '0':
                                $new_bpoints = ($select_req->fields[3] + $reset_points);
                                break;
                            case '1':
                                $new_bpoints = ($reset_points * ($select_req->fields[2] + 1));
                                break;
                        }
                        switch ($reset_stats) {
                            case '1':
                                if ($reset_clear_inv == '1' and $reset_clear_skills == '1') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[inventory]=CONVERT(varbinary(1080), null),[magiclist]=CONVERT(varbinary(180), null) where mu_id=?";
                                } elseif ($reset_clear_inv == '1') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[inventory]=CONVERT(varbinary(1080), null) where mu_id=?";
                                } elseif ($reset_clear_skills == '1') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[magiclist]=CONVERT(varbinary(180), null) where mu_id=?";
                                } elseif ($reset_clear_inv == '0' and $reset_clear_skills == '0') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25' where mu_id=?";
                                }
                                break;
                            case '0':
                                if ($reset_clear_inv == '1' and $reset_clear_skills == '1') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[inventory]=CONVERT(varbinary(1080), null),[magiclist]=CONVERT(varbinary(180), null) where mu_id=?";
                                } elseif ($reset_clear_inv == '1') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[inventory]=CONVERT(varbinary(1080), null) where mu_id=?";
                                } elseif ($reset_clear_skills == '1') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[magiclist]=CONVERT(varbinary(180), null) where mu_id=?";
                                } elseif ($reset_clear_inv == '0' and $reset_clear_skills == '0') {
                                    $reset_formula = "Update character set [resets]=(resets+1),[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=? where mu_id=?";
                                }
                                break;
                        }
                        $exc_reset_formula = $core_db->Execute($reset_formula, array(
                            $new_bpoints,
                            $new_money,
                            $id
                        ));
                        if ($exc_reset_formula) {
                            echo msg('1', text_resetcharacter_t5);
                        } else {
                            echo msg('0', text_resetcharacter_t6);
                        }
                    }
                }
            }
        }
        echo '</div>';
    }
    
    echo '<div style="margin-top: 20px;">
<fieldset><legend>' . text_resetcharacter_t7 . '</legend>
<table border="0" cellspacing="4" cellpadding="0" width="100%" style="padding-left: 10px;">
<tr>
<td align="left"><b>' . text_resetcharacter_t12 . ':</b></td>
<td align="left" width="100%">' . $reset_level . '</td>
</tr>
<tr>
<td align="left"><b>' . text_resetcharacter_t11 . ':</b></td>
<td align="left" width="100%">' . number_format($reset_zen) . '</td>
</tr>
<tr>
<td align="left"><b>' . text_resetcharacter_t10 . ':</b></td>
<td align="left" width="100%">' . number_format($reset_limit) . '</td>
</tr>
</table>
</fieldset>
</div>

<div style="margin-top: 10px;">
<fieldset><legend>' . text_resetcharacter_t8 . '</legend>
<table border="0" cellspacing="4" cellpadding="0"  style="padding-left: 10px; padding-right: 10px;">
<tr>
<td align="left" width="130" valign="top"><b>' . text_resetcharacter_t9 . ':</b></td>
<td align="left">';
    switch ($reset_points_formula) {
        case '0':
            echo number_format($reset_points);
            break;
        case '1':
            
            $bonus_info_points = str_replace("{reset_points}", number_format($reset_points), text_resetcharacter_t_levelupbonusinfo);
            echo $bonus_info_points;
            break;
    }
    
    echo '</td>
</tr>
<tr>
<td align="left"><b>' . text_resetcharacter_t13 . ':</b></td>
<td align="left">';
    switch ($reset_clear_skills) {
        case '0':
            echo 'No';
            break;
        case '1':
            echo 'Yes';
            break;
    }
    echo '</td>
</tr>
<tr>
<td align="left"><b>' . text_resetcharacter_t14 . ':</b></td>
<td align="left">';
    switch ($reset_clear_inv) {
        case '0':
            echo 'No';
            break;
        case '1':
            echo 'Yes';
            break;
    }
    echo '</td>
</tr>
<tr>
<td align="left"><b>' . text_resetcharacter_t15 . ':</b></td>
<td align="left">';
    switch ($reset_stats) {
        case '0':
            echo 'No';
            break;
        case '1':
            echo 'Yes';
            break;
    }
    echo '</td>
</tr>
</table>
</fieldset>
</div>
';
    
    $select_characters = $core_db->Execute("Select mu_id,name,clevel,class,resets,money from character where accountid=? order by clevel desc ", array(
        $user_auth_id
    ));
    
    echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;">';
    while (!$select_characters->EOF) {
        if ($select_characters->fields[2] < $reset_level && $select_characters->fields[5] < $reset_zen) {
            $lacking_error = '<span class="iR_func_status_lacking">' . str_replace("{levels}", ($reset_level - $select_characters->fields[2]), str_replace("{zen}", number_format($reset_zen - $select_characters->fields[5]), text_resetcharacter_t16)) . '</span>';
            
        } elseif ($select_characters->fields[2] < $reset_level) {
            $lacking_error = '<span class="iR_func_status_lacking">' . str_replace("{levels}", ($reset_level - $select_characters->fields[2]), text_resetcharacter_t17) . '</span>';
        } elseif ($select_characters->fields[5] < $reset_zen) {
            $lacking_error = '<span class="iR_func_status_lacking">' . str_replace("{zen}", number_format($reset_zen - $select_characters->fields[5]), text_resetcharacter_t18) . '</span>';
        } elseif ($select_characters->fields[4] >= $reset_limit) {
            $lacking_error = '<span class="iR_func_status_lacking">' . str_replace("{resets_limit}", number_format($reset_limit), text_resetcharacter_t19) . '</span>';
        } else {
            $lacking_error = '<input type="button" value="' . button_reset_character . '" onclick="location.href=\'' . $core_run_script . '&rid=' . $select_characters->fields[0] . '\'">';
        }
        
        echo '
  <tr>
    <td width="66" rowspan="2"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($select_characters->fields[3], '2') . '" width="66" height="66" title="Class"></td>
    <td align="left" class="iR_name" width="100">' . htmlentities($select_characters->fields[1]) . '</td>
    <td align="left" class="iR_stats">Level: ' . $select_characters->fields[2] . '</td>
    <td align="left" class="iR_stats">Zen: ' . number_format($select_characters->fields[5]) . '</td>
    <td align="left" class="iR_stats">Resets: ' . $select_characters->fields[4] . '</td>
  </tr>
  <tr>
    <td algin="left" class="iR_class">' . decode_class($select_characters->fields[3]) . '</td>
    <td colspan="3" class="iR_func_status" align="left">' . $lacking_error . '</td>
  </tr>
  <tr>
    <td colspan="5" class="iRg_line_top">&nbsp;</td>
  </tr>
    
    
    
  ';
        
        $select_characters->MoveNext();
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