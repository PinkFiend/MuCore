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
$config = simplexml_load_file('engine/config_mods/unstuck_character_settings.xml');
$active = trim($config->active);
if ($active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    $mapnumber = trim($config->map_number);
    $map_pos_y = trim($config->map_pos_y);
    $map_pos_x = trim($config->map_pos_x);
    if (isset($_GET['uid'])) {
        echo '<div style="margin-top: 10px;">';
        $id = safe_input($_GET['uid'], '');
        if (empty($id) || !is_numeric($id)) {
            header('Location: ' . $core_run_script . '');
            exit();
        } else {
            if (character_and_account($id, $user_auth_id) === false) {
                header('Location: ' . $core_run_script . '');
                exit();
            } else {
                if (account_online($user_auth_id) === true) {
                    echo msg('0', text_ustuckcharacter_t1);
                } else {
                    $unstuck = $core_db->Execute("Update character set [mapnumber]=?,[mapposx]=?,[mapposy]=? where mu_id=?", array(
                        $mapnumber,
                        $map_pos_x,
                        $map_pos_y,
                        $id
                    ));
                    if ($unstuck) {
                        echo msg('1', text_ustuckcharacter_t2);
                    } else {
                        echo msg('0', text_ustuckcharacter_t3);
                    }
                }
            }
        }
    }
    
    $t4 = str_replace("{map}", decode_map($mapnumber), text_ustuckcharacter_t4);
    $t4 = str_replace("{coord_x}", $map_pos_x, $t4);
    $t4 = str_replace("{coord_y}", $map_pos_y, $t4);
    
    echo '<div style="margin-top: 20px;">
<fieldset><legend>' . text_ustuckcharacter_t6 . '</legend>
<table border="0" cellspacing="4" cellpadding="0" width="100%" style="padding-left: 10px;">
<tr>
<td align="left">' . $t4 . '</td>
</tr>
</table>
</fieldset>
</div>';
    
    $characters = $core_db->Execute("Select mu_id,name,class,mapnumber,mapposx,mapposy from character where accountid=? order by clevel desc ", array(
        $user_auth_id
    ));
    
    echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;">';
    while (!$characters->EOF) {
        echo '<tr>
     <td width="66" rowspan="2"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($characters->fields[2], '2') . '" width="66" height="66" title="Class"></td>
     <td align="left" class="iR_name" width="100">' . htmlentities($characters->fields[1]) . '</td>
     <td align="left" class="iR_stats">' . text_ustuckcharacter_t5 . ': ' . decode_map($characters->fields[3]) . ' on ' . $characters->fields[4] . ' with ' . $characters->fields[5] . '</td>
  </tr>
  <tr>
   <td algin="left" class="iR_class">' . decode_class($characters->fields[2]) . '</td>
    <td class="iR_func_status" align="left"><input type="button" value="' . button_unstuck_character . '" onclick="location.href=\'' . $core_run_script . '&uid=' . $characters->fields[0] . '\'"></td>
  </tr>
    </tr>
    <tr>
    <td colspan="3" class="iRg_line_top">&nbsp;</td>
  </tr>
  ';
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