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
    $save_1 = new_config_xml('../engine/config_mods/rss_feed_settings', 'rss_url', $_POST['rss_url']);
    $save_1 = new_config_xml('../engine/config_mods/rss_feed_settings', 'rss_length', $_POST['rss_length']);
    $save_1 = new_config_xml('../engine/config_mods/rss_feed_settings', 'rss_count', $_POST['rss_count']);
    $save_1 = new_config_xml('../engine/config_mods/rss_feed_settings', 'rss_time', $_POST['rss_time']);
    
    
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=rss_feed');
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/rss_feed_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/rss_feed_settings.xml');
    
    
    
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">RSS Feed Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>RSS Feed is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn RSS Feed Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>RSS Feed is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn RSS Feed On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">RSS Feed Settings</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">URL of Feed</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Enter URL of the feed to be read.<br><br>e.g: http://mmorpgcore.com/forum/external.php?type=rss</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->rss_url . '" name="rss_url"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Title Length</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set the length title of fetched rss item.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->rss_length . '" name="rss_length"><br>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Maximum Items to Fetch </td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set how many items from feed to be displayed.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->rss_count . '" name="rss_count"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Check Feed Time</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set minutes. On each % minutes MUCore will check feed url for new items. Default is 20 min.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->rss_time . '" name="rss_time"><br>
</td>
</tr><br>


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