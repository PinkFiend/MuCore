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
    if (empty($_POST['method']) || empty($_POST['email']) || empty($_POST['length'])) {
        echo notice_message_admin('Some fields where left blank.', '0', '1', '0');
    } else {
        $save_1 = new_config_xml('../engine/config_mods/contact_settings', 'method', safe_input($_POST['method'], ''));
        $save_1 = new_config_xml('../engine/config_mods/contact_settings', 'email', safe_input($_POST['email'], '\_\-\.\@'));
        $save_3 = new_config_xml('../engine/config_mods/contact_settings', 'message_length', safe_input($_POST['length'], ''));
        
        
        
        
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=contact_settings');
    }
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/contact_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/contact_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Contact Us Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Contact Us is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Contact Us Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Contact Us is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Contact Us On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Contact Us Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Contact Method</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Select method.<br><br><b>Send Mail</b> - Users will be able to send mail direct from website.<br>
<b>Contact Info</b> - Contact infos will be displayed.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="method">
<option value="0">Choose Method</option>
        <optgroup label="---------------">';
    switch ($get_config->method) {
        case '1':
            echo '<option value="1" selected="selected">Send Mail</option><option value="2">Contact Info</option>';
            break;
        case '2':
            echo '<option value="1">Send Mail</option><option value="2" selected="selected">Contact Info</option>';
            break;
    }
    
    echo '</select>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Email Address</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Contact email address.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->email . '" name="email"><br>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Message Length</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Set the maximum length of message. This apply only to <b>Send Mail</b> method.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->message_length . '" name="length"><br>
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