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
if (isset($_POST['module_active'])) {
    $save_status = new_config_xml('../engine/config_mods/clear_skills_settings', 'active', safe_input($_POST['module_active'], ''));
}
$get_config = simplexml_load_file('../engine/config_mods/clear_skills_settings.xml');
echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Clear Skills Settings</td>
</tr>
<tr>';
if ($get_config->active == '1') {
    echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Clear Skills is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Clear Skills Off"><input type="hidden" name="module_active" value="0">';
    
    
} elseif ($get_config->active == '0') {
    echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Clear Skills is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Clear Skills On"><input type="hidden" name="module_active" value="1">';
}
echo '</td>
</tr>
</table>
</form>';
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