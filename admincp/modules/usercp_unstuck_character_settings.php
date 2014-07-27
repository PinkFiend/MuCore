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
    if ($_POST['map_number'] == 'x' || empty($_POST['map_pos_y']) || empty($_POST['map_pos_x'])) {
        echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
    } else {
        $save_1 = new_config_xml('../engine/config_mods/unstuck_character_settings', 'map_number', safe_input($_POST['map_number'], ''));
        $save_2 = new_config_xml('../engine/config_mods/unstuck_character_settings', 'map_pos_x', safe_input($_POST['map_pos_x'], ''));
        $save_3 = new_config_xml('../engine/config_mods/unstuck_character_settings', 'map_pos_y', safe_input($_POST['map_pos_y'], ''));
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=usercp_unstuck_character_settings');
    }
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/unstuck_character_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/unstuck_character_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Unstuck Character Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Unstuck Character is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Unstuck Character Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Unstuck Character is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Unstuck Character On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Unstuck Character Settings</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Map</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Choose a map where you want character to be teleported after using unstuck character feature.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="map_number">
<option value="x">Choose a map</option>
        <optgroup label="---------------">';
    foreach ($maps_codes as $map_id => $map_name) {
        if ($get_config->map_number == $map_id) {
            echo '<option value="' . $map_id . '" selected="selected">' . $map_name . '</option>';
        } else {
            echo '<option value="' . $map_id . '" >' . $map_name . '</option>';
        }
    }
    echo '
</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Map Pos X</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the X coordonate of chosen map.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->map_pos_x . '" name="map_pos_x"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Map Pos Y</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the Y coordonate of chosen map.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->map_pos_y . '" name="map_pos_y"><br>
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