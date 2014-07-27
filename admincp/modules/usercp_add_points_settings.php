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
    if (empty($_POST['str_limit']) || empty($_POST['agi_limit']) || empty($_POST['vit_limit']) || empty($_POST['eng_limit']) || empty($_POST['cmd_limit'])) {
        echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
    } else {
        $save_1 = new_config_xml('../engine/config_mods/add_points_settings', 'str_limit', safe_input($_POST['str_limit'], ''));
        $save_2 = new_config_xml('../engine/config_mods/add_points_settings', 'agi_limit', safe_input($_POST['agi_limit'], ''));
        $save_3 = new_config_xml('../engine/config_mods/add_points_settings', 'vit_limit', safe_input($_POST['vit_limit'], ''));
        $save_4 = new_config_xml('../engine/config_mods/add_points_settings', 'eng_limit', safe_input($_POST['eng_limit'], ''));
        $save_5 = new_config_xml('../engine/config_mods/add_points_settings', 'cmd_limit', safe_input($_POST['cmd_limit'], ''));
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=usercp_add_points_settings');
    }
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/add_points_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/add_points_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Add Points Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Add Points is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Add Points Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Add Points is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Add Points On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Add Points Settings</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Strength Limit</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If character\'s strength reach this limit, will not be able to add points on strength using add points system.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->str_limit . '" name="str_limit"><br>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Agility Limit</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If character\'s agylity reach this limit, will not be able to add points on strength using add points system.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->agi_limit . '" name="agi_limit"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Vitality Limit</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If character\'s vitality reach this limit, will not be able to add points on strength using add points system.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->vit_limit . '" name="vit_limit"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Energy Limit</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If character\'s energy reach this limit, will not be able to add points on strength using add points system.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->eng_limit . '" name="eng_limit"><br>
</td>
</tr>




<tr>
<td align="left" class="panel_title_sub" colspan="2">Command Limit</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If character\'s command reach this limit, will not be able to add points on strength using add points system.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->cmd_limit . '" name="cmd_limit"><br>
</td>
</tr>



<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>';
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