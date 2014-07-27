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
    $save_1 = new_config_xml('../engine/config_mods/chat_settings', 'admin_name', safe_input($_POST['admin_name'], '\ '));
    $save_2 = new_config_xml('../engine/config_mods/chat_settings', 'admin_color', safe_input($_POST['admin_color'], '\#'));
    $save_3 = new_config_xml('../engine/config_mods/chat_settings', 'admin_color2', safe_input($_POST['admin_color2'], '\#'));
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=chat_settings');
} elseif (isset($_POST['clean_chat'])) {
    $chat_db = fopen("../engine/variables_mods/chat.tDB", "w");
    fwrite($chat_db, "");
    fclose($chat_db);
    echo notice_message_admin('Chat messages successfully deleted', 1, 0, 'index.php?get=chat_settings');
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/chat_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/chat_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Chat Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Chat is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Chat Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Chat is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Chat On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    echo '
        
<form action="" name="form_c" method="POST">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Chat Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Cleanup Messages</td>
</tr>

<tr>
<td align="left" class="panel_buttons">This is used to clean all messages from chat.</td>
<td align="right" class="panel_buttons">
<input type="hidden" name="clean_chat">
<input type="submit" value="Cleanup Chat Messages" onclick="return ask_form(\'Are you sure you want to cleanup chat messages?\')"></td>
</tr>


</table>
</form>';
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Chat Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Administrator Name</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
This name will be reserved. (letters,numbers and spaces only)<br><br>Note: To use this name you must be logged in admin panel.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->admin_name . '" name="admin_name"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Name Color</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
When you will use Administrator Name to write, you can have one special color for name.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->admin_color . '" name="admin_color"><br>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Text Color</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
When you will use Administrator Name to write, you can have one special color for text.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->admin_color2 . '" name="admin_color2"><br>
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