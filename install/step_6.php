<?
if (isset($_POST['settings'])) {
    if (empty($_POST['w_url'])) {
        $error = '1';
        $w_url = '<blink> - Fix this</blink>';
    }
    if (empty($_POST['w_title'])) {
        $error   = '1';
        $w_title = '<blink> - Fix this</blink>';
    }
    if (empty($_POST['c_key'])) {
        $error = '1';
        $c_key = '<blink> - Fix this</blink>';
    } else {
        if (strlen($_POST['c_key']) != '8') {
            $error = '1';
            $c_key = '<blink> - Fix this</blink>';
        }
    }
    if (empty($_POST['w_nick'])) {
        $error  = '1';
        $w_nick = '<blink> - Fix this</blink>';
    }
    if (empty($_POST['template'])) {
        $error    = '1';
        $template = '<blink> - Fix this</blink>';
    }
    if (empty($_POST['master_mail'])) {
        $error       = '1';
        $master_mail = '<blink> - Fix this</blink>';
    }
    if ($error != '1') {
        require('../engine/global_config.php');
        $new_db = fopen("../engine/global_config.php", "w");
        $data   = "<?
";
        $data .= "\$core['config']['on_off'] = \"" . $core['config']['on_off'] . "\";
";
        $data .= "\$core['config']['website_url'] = \"" . $_POST['w_url'] . "\";
";
        $data .= "\$core['config']['websitetitle'] = \"" . htmlspecialchars(addslashes($_POST['w_title'])) . "\";
";
        $data .= "\$core['config']['md5'] = \"" . $_POST['md5'] . "\";
";
        $data .= "\$core['config']['crypt_key'] = \"" . safe_input($_POST['c_key'], '') . "\";
";
        $data .= "\$core['config']['admin_nick'] = \"" . safe_input($_POST['w_nick'], '\ ') . "\";
";
        $data .= "\$core['config']['master_mail'] = \"" . safe_input($_POST['master_mail'], '\_\-\.\@') . "\";
";
        $data .= "\$core['config']['template'] = \"" . safe_input($_POST['template'], '\_\.\-') . "\";
";
        $data .= "\$core['config']['copyright'] = \"" . htmlspecialchars(addslashes($_POST['copyright'])) . "\";
";
        $data .= "\$core['config']['SN'] = \"" . $core['config']['SN'] . "\";
";
        $data .= "?>";
        fwrite($new_db, $data);
        fclose($new_db);
    }
} else {
    $error = 1;
}
echo '<form action="" name="form_edit" method="POST"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px"><tr> <td align="center" class="panel_title" colspan="2">Website Settings</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Website URL</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">URL of your website, where MUCore is running.<br>*Don\'t add trailing slash ("/") at the end of URL.</td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_url" value="';
if (isset($_POST['w_title'])) {
    echo $_POST['w_url'];
} else {
    echo 'http://' . $_SERVER['HTTP_HOST'] . '';
}
echo '"> ' . $w_url . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Website Title</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">Title of your website.</b></td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_title" value="';
if (isset($_POST['w_title'])) {
    echo $_POST['w_title'];
} else {
    echo 'MUCore ' . $core['version'] . '';
}
echo '"> ' . $w_title . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">MU Online databsae use MD5 Encryption</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' website will perform functions,checks,features under MD5 encryption method.</td><td align="left" class="panel_text_alt2" width="45%" valign="top">';
if (isset($_POST['md5'])) {
    switch ($_POST['md5']) {
        case '0':
            echo '<label><input type="radio" name="md5" value="1">Yes</label> <label><input type="radio" name="md5" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="md5" value="1" checked="checked">Yes</label> <label><input type="radio" name="md5" value="0">No</label>';
            break;
    }
} else {
    echo '<label><input type="radio" name="md5" value="1" checked="checked">Yes</label> <label><input type="radio" name="md5" value="0">No</label>';
}
echo '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Encrypt Key</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">Provide an encryption key, <b>8 digits length, letters and nubmers only</b>.<br>Encryption key will be used in website features and functions in order to protect your users data.</b></td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="c_key" maxlength="8" value="' . $_POST['c_key'] . '"> ' . $c_key . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Administrator Nickname</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">Enter an nickname for your Administrator account. (letters,numbers and spaces only)</b></td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_nick" value="' . $_POST['w_nick'] . '"> ' . $w_nick . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Webmaster\'s Email</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">This is the email address of the webmaster. It will be used as the From address for certain emails sent by the system.</b></td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="master_mail" value="' . $_POST['master_mail'] . '"> ' . $master_mail . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Template</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">Select website template.<br><br>Note: each template</b>has his own folder that is stored on <b>template</b> folder.</td> <td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="template"><option value="0" >Choose a template</option><optgroup label="---------------">';
if (isset($_POST['template'])) {
    $core['config_temp']['template'] = $_POST['template'];
} else {
    $core['config_temp']['template'] = 'default';
}
$directory = opendir('../template');
while ($modfile = readdir($directory)) {
    if ($modfile != "." && $modfile != ".." && $modfile != 'index.html') {
        if ($core['config_temp']['template'] == $modfile) {
            echo '<option value="' . $modfile . '" selected="selected">' . $modfile . '</option>';
        } else {
            echo '<option value="' . $modfile . '">' . $modfile . '</option>';
        }
    }
}
echo '</select> ' . $template . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Copyright Text</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">Copyright text will appear in the footer of page.</b></td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="copyright" value="' . $_POST['copyright'] . '"> <em>*optional</em></td></tr>';
if ($error == 1) {
    if (isset($_POST['settings'])) {
        $error_msg = 'Step 5 Status: Please fix errors and click save.';
    } else {
        $error_msg = 'Step 5 Status: Please complete fields and click save.';
    }
    $button = '<input type="submit" value="Next Step" disabled>';
} else {
    $button    = '<input type="button" value="Next Step" onclick="location.href=\'install.php?step=step_7\'">';
    $error_msg = 'Step 5 Status: Success.';
}
echo '<tr><td align="left" class="panel_buttons"><input type="hidden" name="settings">' . $error_msg . '</td><td align="right" class="panel_buttons"><input type="submit" value="Save">&nbsp;' . $button . '</td></tr></table></form>';
?>
