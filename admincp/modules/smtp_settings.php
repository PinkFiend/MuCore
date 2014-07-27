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
    $save_1 = new_config_xml('../engine/config_mods/smtp_settings', 'smtp_server', $_POST['smtp_server']);
    $save_2 = new_config_xml('../engine/config_mods/smtp_settings', 'smtp_username', $_POST['smtp_username']);
    $save_3 = new_config_xml('../engine/config_mods/smtp_settings', 'smtp_password', $_POST['smtp_password']);
    $save_3 = new_config_xml('../engine/config_mods/smtp_settings', 'smtp_port', $_POST['smtp_port']);
    $save_3 = new_config_xml('../engine/config_mods/smtp_settings', 'smtp_connection', $_POST['smtp_connection']);
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=smtp_settings');
} else {
    $smtp_connection = array(
        'none' => 'None',
        'ssl' => 'SSL',
        'tls' => 'TLS'
    );
    $get_config      = simplexml_load_file('../engine/config_mods/smtp_settings.xml');
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">SMTP Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Server Address</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">SMTP server address.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="smtp_server" value="' . $get_config->smtp_server . '"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Server Username</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">SMTP server username.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="smtp_username" value="' . $get_config->smtp_username . '"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Server Password</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">SMTP server password.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="smtp_password" value="' . $get_config->smtp_password . '"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Port</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">SMTP server port.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="smtp_port" value="' . $get_config->smtp_port . '"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Secure Connection</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If SMTP server requires a secure connection, please set the appropriate setting.<br><br><b>Note:</b> Connection SSL or TLS require php_openssl.dll to be enabled in php.ini</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="smtp_connection">
';
    foreach ($smtp_connection as $smtp_type => $smtp_var) {
        if ($get_config->smtp_connection == $smtp_type) {
            echo '<option value="' . $smtp_type . '" selected="selected">' . $smtp_var . '</smtp>';
        } else {
            echo '<option value="' . $smtp_type . '">' . $smtp_var . '</smtp>';
        }
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