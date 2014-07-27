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
    if (empty($_POST['cron_job'])) {
        echo notice_message_admin('Some fields where left blank.', '0', '1', '0');
    } else {
        $save_1 = new_config_xml('../engine/config_mods/account_settings_settings', 'cron_job', $_POST['cron_job']);
        $save_2 = new_config_xml('../engine/config_mods/account_settings_settings', 'method', $_POST['method']);
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=usercp_mu_account_settings');
    }
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/account_settings_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/account_settings_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Account Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Account Settings is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Account Settings Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Account Settings is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Account Settings On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Change Password Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Cron Job ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Set cron job id for cleaning temporary change passwords requests.<br>

<a href="index.php?get=cron_jobs">view cron jobs list</a></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->cron_job . '" name="cron_job"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Verify Email address in Change Password</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If you set to \'Yes\' user\'s password will not be chnaged until they visit a link that is sent to them in an email when they chnage password.<br><br>

If a user is not visiting the link, password will remain the same.<br><br>Note: <b>Verify Email address in Chnage Password</b> require SMTP Server, <a href="index.php?get=smtp_settings">SMTP Settings</a></td>
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