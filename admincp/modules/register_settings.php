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
    $save_1 = new_config_xml('../engine/config_mods/register_settings', 'pers_id_active', '' . safe_input($_POST['pers_id_active'], '') . '');
    $save_2 = new_config_xml('../engine/config_mods/register_settings', 'pers_id_length', '' . safe_input($_POST['pers_id_length'], '') . '');
    $save_3 = new_config_xml('../engine/config_mods/register_settings', 'pers_id', '' . safe_input($_POST['pers_id'], '') . '');
    
    $save_4 = new_config_xml('../engine/config_mods/register_settings', 'method', '' . safe_input($_POST['method'], '') . '');
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=register_settings');
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/register_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/register_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Register Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Register is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Register Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Register is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Register On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    $get_config = simplexml_load_file('../engine/config_mods/register_settings.xml');
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Register Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Verify Email address in Registration</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
If you set to \'Yes\' new user will not be allowed top play until they visit a link that is sent to them in an email when they register.<br><br>

If a user\'s account is not activated by the user visiting the link, it will remain in the \'<a href="index.php?get=users_activate">Users Awaiting Activation</a>\' group.<br><br>Note: <b>Verify Email address in Registration</b> require SMTP Server, <a href="index.php?get=smtp_settings">SMTP Settings</a></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
';
    
    switch ($get_config->method) {
        case '1':
            echo '<label><input type="radio" name="method" value="2">Yes</label> <label><input type="radio" name="method" checked="checked" value="1">No</label>';
            break;
        case '2':
            echo '<label><input type="radio" name="method" value="2" checked="checked">Yes</label> <label><input type="radio" name="method" value="1">No</label>';
            break;
    }
    echo '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Personal ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
When \'Yes\' user can put his own custom Personal ID, set the minimum digits (default 12)<br>
When \'No\' you must set the Personal ID (default 111111111111).
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    
    switch ($get_config->pers_id_active) {
        case '0':
            echo '<label><input type="radio" name="pers_id_active" value="1">Yes</label> <label><input type="radio" name="pers_id_active" value="0" checked="checked">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="pers_id_active" value="1" checked="checked">Yes</label> <label><input type="radio" name="pers_id_active" value="0">No</label>';
            break;
    }
    echo '

    </td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Personal ID Length</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the length required for Personal ID, default is 12 digits.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" value="' . $get_config->pers_id_length . '" name="pers_id_length">
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Pre-set Personal ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the custom Personal ID, default is 111111111111.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" value="' . $get_config->pers_id . '" name="pers_id">
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