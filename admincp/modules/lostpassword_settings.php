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
    $save_1 = new_config_xml('../engine/config_mods/lostpassword_settings', 'method', $_POST['method']);
    $save_2 = new_config_xml('../engine/config_mods/lostpassword_settings', 'cron_job', $_POST['cron_job']);
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=lostpassword_settings');
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/lostpassword_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/lostpassword_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Lost Password Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Lost Password is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Lost Password Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Lost Password is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Lost Password On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Lost Password Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Cron Job ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Set cron job id for cleaning temporary lost passwords request.<br>

<a href="index.php?get=cron_jobs">view cron jobs list</a></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->cron_job . '" name="cron_job"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Recover Password Method</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Select method that users will use to recover password.<br><br>
<b>Secret Question</b> - user will need to enter answer of hid secret question.<br>
<b>Restore Password via Email</b> - user will need to enter email address that used on account registration in order to receive instructions on how to reset password.<br><br>Note: <b>Restore Password via Email</b> require SMTP Server, <a href="index.php?get=smtp_settings">SMTP Settings</a></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="method">';
    switch ($get_config->method) {
        case '1':
            echo '<option value="1" selected="selected">Secret Question</option><option value="2">Restore Password via Email</option>';
            break;
        case '2':
            echo '<option value="1">Secret Question</option><option value="2" selected="selected">Restore Password via Email</option>';
            break;
    }
    
    echo '</select></td>
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