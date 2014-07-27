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
if (isset($_POST['settings'])) {
    if (empty($_POST['level']) || empty($_POST['zen'])) {
        echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
    } else {
        if (empty($_POST['bpoints'])) {
            $_POST['bpoints'] = '0';
        }
        $save_1 = new_config_xml('../engine/config_mods/reset_character_settings', 'level', safe_input($_POST['level'], ''));
        $save_2 = new_config_xml('../engine/config_mods/reset_character_settings', 'zen', safe_input($_POST['zen'], ''));
        $save_3 = new_config_xml('../engine/config_mods/reset_character_settings', 'bpoints', safe_input($_POST['bpoints'], ''));
        $save_4 = new_config_xml('../engine/config_mods/reset_character_settings', 'bpoints_formula', safe_input($_POST['bpoints_formula'], ''));
        $save_5 = new_config_xml('../engine/config_mods/reset_character_settings', 'clear_skills', safe_input($_POST['clear_skills'], ''));
        $save_1 = new_config_xml('../engine/config_mods/reset_character_settings', 'clear_inv', safe_input($_POST['clear_inv'], ''));
        $save_1 = new_config_xml('../engine/config_mods/reset_character_settings', 'reset_stats', safe_input($_POST['reset_stats'], ''));
        $save_1 = new_config_xml('../engine/config_mods/reset_character_settings', 'reset_limit', safe_input($_POST['reset_limit'], ''));
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=usercp_reset_character_settings');
    }
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/reset_character_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/reset_character_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Reset Character Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Reset Character is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Reset Character Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Reset Character is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Reset Character On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Reset Character Settings</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Level</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set what level character should have, to use reset.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->level . '" name="level"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Zen</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the amount of zen required to reset.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->zen . '" name="zen"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Levelup Bonus Points</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the amount of levelup bonus points, that character will recive after reset.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->bpoints . '" name="bpoints"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Levelup Bonus Points Formula</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set formula.<br><Br>
<b>Levelup Bonus Points</b> - Character will recive the set amount of levelup bonus points.<br>
<b>Levelup Bonus Points * Resets Number</b> - Character will recive the set amount of levelup bonus points multiplicated with character\'s resets number.<br>e.g: (4000*2) = 8000 points, 4000 is levelup bonus points amount and 2 is resets number.<br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="bpoints_formula">
 ';
    if ($get_config->bpoints_formula == '0') {
        echo '<option value="0" selected="selected">Levelup Bonus Points</option><option value="1">Levelup Bonus Points * Resets Number</option>';
    } elseif ($get_config->bpoints_formula == '1') {
        echo '<option value="0">Levelup Bonus Points</option><option value="1" selected="selected">Levelup Bonus Points * Resets Number</option>';
        
    }
    echo '
</select>
</td>
</tr>



<tr>
<td align="left" class="panel_title_sub" colspan="2">Clear Skills</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' all character\'s skills will be cleared after reset.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->clear_skills) {
        case '0':
            echo '<label><input type="radio" name="clear_skills" value="1">Yes</label> <label><input type="radio" name="clear_skills" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="clear_skills" value="1" checked="checked">Yes</label> <label><input type="radio" name="clear_skills" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Clear Inventory</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' all character\'s items from inventory will be cleared after reset.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->clear_inv) {
        case '0':
            echo '<label><input type="radio" name="clear_inv" value="1">Yes</label> <label><input type="radio" name="clear_inv" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="clear_inv" value="1" checked="checked">Yes</label> <label><input type="radio" name="clear_inv" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Reset Stats</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' all character\'s stats (Strength, Agility, Vitality, Energy, Command). will be set to 25.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->reset_stats) {
        case '0':
            echo '<label><input type="radio" name="reset_stats" value="1">Yes</label> <label><input type="radio" name="reset_stats" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="reset_stats" value="1" checked="checked">Yes</label> <label><input type="radio" name="reset_stats" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Resets Limit</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the resets limit, after this resets character can\'t reset anymore.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->reset_limit . '" name="reset_limit"><br>
</td>
</tr>


<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>
';
    
    
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