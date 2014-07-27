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
if (isset($_POST['edit_settings'])) {
    $save_style  = new_config_xml('../engine/config_mods/news_settings', 'news_style', '' . safe_input($_POST['style'], '') . '');
    $short_long  = new_config_xml('../engine/config_mods/news_settings', 'news_short_long', '' . safe_input($_POST['short'], '') . '');
    $bookmarking = new_config_xml('../engine/config_mods/news_settings', 'news_bookmarking', '' . safe_input($_POST['bookmarking'], '') . '');
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=news_settings');
} else {
    $get_news_config = simplexml_load_file('../engine/config_mods/news_settings.xml');
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">News Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Style</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Choose news display style.<br><br><b>Style 1</b><br>
Will show full news.<br>
<b>Style 2</b><br>
Will show short news, user click required to view full news.<br>
<b>Style 3</b><br>
Will show only news title, user click required to view full news.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    
    switch ($get_news_config->news_style) {
        case '0':
            echo '<label><input type="radio" name="style" value="0" checked="checked">Style 1</label><br><label><input type="radio" name="style" value="1">Style 2</label><br><label><input type="radio" name="style" value="2">Style 3</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="style" value="0">Style 1</label><br><label><input type="radio" name="style" value="1" checked="checked">Style 2</label><br><label><input type="radio" name="style" value="2">Style 3</label>';
            break;
        case '2':
            echo '<label><input type="radio" name="style" value="0">Style 1</label><br><label><input type="radio" name="style" value="1">Style 2</label><br><label><input type="radio" name="style" value="2" checked="checked">Style 3</label>';
            break;
    }
    echo '
    </td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Style 2 Display Options</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set how many characters of news should be displayed on short news (Style 2).</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" value="' . $get_news_config->news_short_long . '" name="short">
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Social Bookmarking</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Display Social Bookmarking Icons</b><br>
Social Bookmarking has evolved as a very effective way of sharing content with others and consequently bringing more traffic to your website. Enable/Disable Social Bookmarking Icons to be displayed in your news pages.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="bookmarking">';
    switch ($get_news_config->news_bookmarking) {
        case '0':
            echo '<option value="1">Enabled</option><option value="0" selected="selected">Disabled</option>';
            break;
        case '1':
            echo '<option value="1" selected="selected">Enabled</option><option value="0">Disabled</option>';
            break;
    }
    echo '

</select>
</td>
</tr>


<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="edit_settings">
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