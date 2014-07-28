<?
echo '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel"><tr> <td align="center" class="panel_title" colspan="2">MuCore Installation Status</td></tr><tr><td align="center" class="panel_text_alt1" width="100%"  colspan="2"><b>The Installation of MuCore Version ' . $core['version'] . ' by MaryJo & Isumeru - Bizarre-networks.net has finished.</b><br><br><b>Note:</b> For security reasons, a Restriction has been attempted in the installation folder.<br>At the bottom of the page you will see if it was applied successfully</td><tr><td align="left" class="panel_buttons"><input type="hidden" name="settings">' . $error_msg . '</td><td align="right" class="panel_buttons"><input type="submit" value="Go to MUCore ' . $core['version'] . ' Admin Control Panel" onclick="location.href=\'../admincp\'"></td></tr></table><br><br><b>Restriction Status:</b><br><br>';
@rename('Restrict.bmn', '.htaccess');
if (file_exists('.htaccess'))
    print '<font color="#006600"><b>Restriction to Installation folder added successfully<br>You may leave your installation folder intact, but it is not recommended</b><font>';
else
    print '<font color="#990000"><blink><b>WARNING!</b> The installation folder can still be accessed, please delete your entire installation folder</blink></font>';
?>
