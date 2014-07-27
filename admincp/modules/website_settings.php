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
    if (empty($_POST['w_title']) || empty($_POST['w_url']) || empty($_POST['c_key']) || empty($_POST['w_nick']) || empty($_POST['master_mail']) || empty($_POST['template'])) {
        echo notice_message_admin('Some fields where left blank.', '0', '1', '0');
    } else {
        if (strlen($_POST['c_key']) != '8') {
            echo notice_message_admin('Encryption key must be 8 digits length, letters and numbers only.', '0', '1', '0');
        } elseif (strlen($_POST['w_sn']) != '20') {
            echo notice_message_admin('MUCore Serial Number must be 20 digits length.', '0', '1', '0');
        } else {
            require('../engine/global_config.php');
            $new_db = fopen("../engine/global_config.php", "w");
            $data   = "<?\r\n";
            $data .= "\$core['config']['on_off'] = \"" . $core['config']['on_off'] . "\";\r\n";
            $data .= "\$core['config']['website_url'] = \"" . $_POST['w_url'] . "\";\r\n";
            $data .= "\$core['config']['websitetitle'] = \"" . htmlspecialchars(addslashes($_POST['w_title'])) . "\";\r\n";
            $data .= "\$core['config']['md5'] = \"" . $_POST['md5'] . "\";\r\n";
            $data .= "\$core['config']['crypt_key'] = \"" . safe_input($_POST['c_key'], '') . "\";\r\n";
            $data .= "\$core['config']['admin_nick'] = \"" . safe_input($_POST['w_nick'], '\ ') . "\";\r\n";
            $data .= "\$core['config']['master_mail'] = \"" . safe_input($_POST['master_mail'], '\_\-\.\@') . "\";\r\n";
            $data .= "\$core['config']['template'] = \"" . safe_input($_POST['template'], '\_\.\-') . "\";\r\n";
            $data .= "\$core['config']['copyright'] = \"" . htmlspecialchars(addslashes($_POST['copyright'])) . "\";\r\n";
            $data .= "\$core['config']['SN'] = \"" . safe_input($_POST['w_sn'], '') . "\";\r\n";
            $data .= "?>";
            fwrite($new_db, $data);
            fclose($new_db);
            echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=website_settings');
        }
        
    }
    
} else {
    if (isset($_POST['module_active'])) {
        require('../engine/global_config.php');
        $new_db = fopen("../engine/global_config.php", "w");
        $data   = "<?\r\n";
        $data .= "\$core['config']['on_off'] = \"" . $_POST['module_active'] . "\";\r\n";
        $data .= "\$core['config']['website_url'] = \"" . $core['config']['website_url'] . "\";\r\n";
        $data .= "\$core['config']['websitetitle'] = \"" . $core['config']['websitetitle'] . "\";\r\n";
        $data .= "\$core['config']['md5'] = \"" . $core['config']['md5'] . "\";\r\n";
        $data .= "\$core['config']['crypt_key'] = \"" . $core['config']['crypt_key'] . "\";\r\n";
        $data .= "\$core['config']['admin_nick'] = \"" . $core['config']['admin_nick'] . "\";\r\n";
        $data .= "\$core['config']['master_mail'] = \"" . $core['config']['master_mail'] . "\";\r\n";
        $data .= "\$core['config']['template'] = \"" . $core['config']['template'] . "\";\r\n";
        $data .= "\$core['config']['copyright'] = \"" . $core['config']['copyright'] . "\";\r\n";
        $data .= "\$core['config']['SN'] = \"" . $core['config']['SN'] . "\";\r\n";
        $data .= "?>";
        fwrite($new_db, $data);
        fclose($new_db);
        
        $new_db2 = fopen("../engine/cms_data/maintenance/maintenance.cms", "w");
        fwrite($new_db2, stripslashes($_POST['reason']));
        fclose($new_db2);
    }
    
    require('../engine/global_config.php');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Turn your website On and Off</td>
</tr>
<tr>';
    if ($core['config']['on_off'] == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Website is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Website Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($core['config']['on_off'] == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Website is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Website On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Reason for turning website Off</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Let users know why website is Off.</b>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3" name="reason">';
    include('../engine/cms_data/maintenance/maintenance.cms');
    echo '</textarea></td>
</tr>


</table>
</form>';
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">MUCore Serial Number</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Serial Number</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Enter MUCore Serial Number. 20 digits length.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_sn" value="' . $core['config']['SN'] . '" maxlength="20"></td>
</tr>
</table>





<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px">
<tr>
 <td align="center" class="panel_title" colspan="2">Website Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Website URL</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">URL of your website, where MUCore is running.<br>*Don\'t add trailing slash ("/") at the end of URL.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_url" value="' . $core['config']['website_url'] . '"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Website Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Title of your website.</b>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_title" value="' . stripslashes($core['config']['websitetitle']) . '"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">MU Online databsae use MD5 Encryption</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' website will perform functions,checks,features under MD5 encryption method.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($core['config']['md5']) {
        case '0':
            echo '<label><input type="radio" name="md5" value="1">Yes</label> <label><input type="radio" name="md5" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="md5" value="1" checked="checked">Yes</label> <label><input type="radio" name="md5" value="0">No</label>';
            break;
    }
    
    
    echo '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Encrypt Key</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Provide an encryption key, <b>8 digits length, letters and nubmers only</b>.<br>Encryption key will be used in website features and functions in order to protect your users data.</b>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="c_key" value="' . $core['config']['crypt_key'] . '" maxlength="8"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Administrator Nickname</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Enter an nickname for your Administrator account. (letters,numbers and spaces only)</b>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_nick" value="' . $core['config']['admin_nick'] . '"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Webmaster\'s Email</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">This is the email address of the webmaster. It will be used as the From address for certain emails sent by the system.</b>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="master_mail" value="' . $core['config']['master_mail'] . '"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Template</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Select website template.<br><br>Note: each template</b>
has his own folder that is stored on <b>template</b> folder.</td> 
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="template">
<option value="0" >Choose a template</option>
        <optgroup label="---------------">

';
    $directory = opendir('../template');
    while ($modfile = readdir($directory)) {
        if ($modfile != "." && $modfile != ".." && $modfile != 'index.html') {
            if ($core['config']['template'] == $modfile) {
                echo '<option value="' . $modfile . '" selected="selected">' . $modfile . '</option>';
            } else {
                echo '<option value="' . $modfile . '">' . $modfile . '</option>';
            }
            
        }
        
        
        
        
        
        
    }
    
    echo '</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Copyright Text</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Copyright text will appear in the footer of page.</b>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="copyright" value="' . stripslashes($core['config']['copyright']) . '"></td>
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