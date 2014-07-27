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
    $new_db = fopen("../engine/seo_config.php", "w");
    $data   = "<?\r\n";
    $data .= "\$core_seo['meta_keywords'] = \"" . str_replace('"', "", $_POST['meta_keywords']) . "\";\r\n";
    $data .= "\$core_seo['meta_description'] = \"" . str_replace('"', "", $_POST['meta_description']) . "\";\r\n";
    $data .= "?>";
    fwrite($new_db, $data);
    fclose($new_db);
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=seo_head_tags');
    
} else {
    require('../engine/seo_config.php');
    
    echo '
    <form action="" name="form_edit" method="POST">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Head Tags</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Meta Keywords</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Enter the meta keywords for all pages. These are used by search engines to index your pages with more relevance.<br><br>Separe each word with comma<br>e.g: game,muonline,mmorpg,free play,season 5,bugless
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="meta_keywords" value="' . $core_seo['meta_keywords'] . '" size="45"></td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Meta Description</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Enter the meta description for all pages. This is used by search engines to index your pages more relevantly.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="meta_description" value="' . $core_seo['meta_description'] . '" size="45"></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>';
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