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
    if (empty($_POST['CMS_STYLE_LEFT_WIDTH'])) {
        echo notice_message_admin('Some fields where left blank.', '0', '1', '0');
    } else {
        require('../engine/style_cms.php');
        $new_db = fopen("../engine/style_cms.php", "w");
        $data   = "<?\r\n";
        $data .= "define('CMS_STYLE_LEFT_WIDTH','" . safe_input($_POST['CMS_STYLE_LEFT_WIDTH'], '') . "');\r\n";
        $data .= "define('CMS_NAVBAR','" . safe_input($_POST['CMS_NAVBAR'], '') . "');\r\n";
        $data .= "?>";
        fwrite($new_db, $data);
        fclose($new_db);
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=cms_style_options');
        
    }
    
    
} else {
    require('../engine/style_cms.php');
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Style Options</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Left Column Width</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">The width in pixels of left column.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="CMS_STYLE_LEFT_WIDTH" value="' . CMS_STYLE_LEFT_WIDTH . '"></td>
</tr>

<td align="left" class="panel_title_sub" colspan="2">Enable Navbar</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Turn this option on to enable the MUCore navbar.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch (CMS_NAVBAR) {
        case '0':
            echo '<label><input type="radio" name="CMS_NAVBAR" value="1">Yes</label> <label><input type="radio" name="CMS_NAVBAR" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="CMS_NAVBAR" value="1" checked="checked">Yes</label> <label><input type="radio" name="CMS_NAVBAR" value="0">No</label>';
            break;
    }
    
    echo '</td>
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