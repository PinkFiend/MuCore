<?
if (get_magic_quotes_gpc()) {
    $magic_quotes = 'Enabled - <blink>Fix This</blink>';
    $error        = 1;
} else {
    $magic_quotes = '<b>Success</b>';
}
if (extension_loaded('gd')) {
    $gd2 = '<b>Success</b>';
} else {
    $gd2   = 'Disabled - <blink>Fix This</blink>';
    $error = 1;
}
if ($error == 1) {
    $button    = '<input type="submit" value="Next Step" disabled>';
    $error_msg = 'Step 1 Status : Please fix errors and refresh page.';
} else {
    $button    = '<input type="submit" value="Next Step" onclick="location.href=\'install.php?step=step_2\'">';
    $error_msg = 'Step 1 Status : Success.';
}
echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel"><tr> <td align="center" class="panel_title" colspan="2">PHP Extensions</td></tr><tr><tr><td align="left" class="panel_title_sub" colspan="2">php_gd2.dll</td></tr><tr><td align="left" class="panel_text_alt1" width="50%">Extension php_gd2.dll must be <b>enabled</b>. To enable it go to your php.ini and search for \'extension=php_gd2.dll\' and remove the \';\' from front.<br><br>E.g:<br><b>;extension=php_gd2.dll</b> - Disabled<br><b>extension=php_gd2.dll</b> - Enabled</td><td align="left" class="panel_text_alt2" width="50%" valign="top">' . $gd2 . '</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">magic_quotes_gpc</td></tr><tr><td align="left" class="panel_text_alt1" width="50%">magic_quotes_gpc must be <b>disabled</b>. To disable them go to your php.ini search for \'magic_quotes_gpc\' and change value from \'On\' to \'Off\'.</td><td align="left" class="panel_text_alt2" width="50%" valign="top">' . $magic_quotes . '</td></tr><tr><td align="left" class="panel_buttons">' . $error_msg . '</td><td align="right" class="panel_buttons">' . $button . '</td></tr></table>';
?>
