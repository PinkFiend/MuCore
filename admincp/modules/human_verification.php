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
    $save_1 = new_config_xml('../engine/config_mods/human_verification', 'human_verification_type', $_POST['human_verification_type']);
    
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=human_verification');
} elseif (isset($_POST['recaptcha_settings'])) {
    $save_1 = new_config_xml('../engine/config_mods/human_verification', 'reCAPTCHA_public_key', $_POST['reCAPTCHA_public_key']);
    $save_1 = new_config_xml('../engine/config_mods/human_verification', 'reCAPTCHA_private_key', $_POST['reCAPTCHA_private_key']);
    $save_1 = new_config_xml('../engine/config_mods/human_verification', 'reCAPTCHA_theme', $_POST['reCAPTCHA_theme']);
    
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=human_verification');
} else {
    $human_verifications = array(
        'none' => 'Image Verification',
        'reCAPTCHA' => 'reCAPTCHA&#8482;'
    );
    
    
    $recaptcha_themes = array(
        'red' => 'Red',
        'white' => 'White',
        'blackglass' => 'Black Glass',
        'clean' => 'Clean'
        
    );
    $get_config       = simplexml_load_file('../engine/config_mods/human_verification.xml');
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Human Verification Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Human Verification Library</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Choose the verification type that you wish to present to the user.<br><br><b>Image Verification</b><br>An image consisting of letters will be shown to the user.<br><br>
<b>reCAPTCHA&#8482;</b><br>
A CAPTCHA is a program that protects websites against bots by generating and grading tests that humans can pass but current computer programs cannot. For example, humans can read distorted text, but current computer programs can\'t.</em><br><a href="http://www.captcha.net/" target="blank">Visit reCAPTCHA&trade; site for more infos.</a>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    foreach ($human_verifications as $verification_id => $verification_html) {
        if ($get_config->human_verification_type == $verification_id) {
            echo '<label><input type="radio" value="' . $verification_id . '" name="human_verification_type" checked> ' . $verification_html . '</label><br>';
        } else {
            echo '<label><input type="radio" value="' . $verification_id . '" name="human_verification_type"> ' . $verification_html . '</label><br>';
        }
        
    }
    echo '</td>
</tr>



<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>
';
    
    if ($get_config->human_verification_type == 'reCAPTCHA') {
        echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px">
<tr>
 <td align="center" class="panel_title" colspan="2">reCAPTCHA&#8482; Verification Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">reCAPTCHA&#8482; Public Key</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Public key provided to you by <a href="http://www.captcha.net/" target="blank">reCAPTCHA&trade;.</a>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="reCAPTCHA_public_key" value="' . $get_config->reCAPTCHA_public_key . '" size="40"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">reCAPTCHA&#8482; Private Key</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Private key provided to you by <a href="http://www.captcha.net/" target="blank">reCAPTCHA&trade;.</a>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="reCAPTCHA_private_key" value="' . $get_config->reCAPTCHA_private_key . '" size="40"></td>
</tr>




<tr>
<td align="left" class="panel_title_sub" colspan="2">reCAPTCHA&#8482; Theme</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Choose theme for reCAPTCHA&#8482;.</a>
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
        foreach ($recaptcha_themes as $theme_id => $theme_html) {
            if ($get_config->reCAPTCHA_theme == $theme_id) {
                echo '<label><input type="radio" value="' . $theme_id . '" name="reCAPTCHA_theme" checked> ' . $theme_html . '</label><br>';
            } else {
                echo '<label><input type="radio" value="' . $theme_id . '" name="reCAPTCHA_theme"> ' . $theme_html . '</label><br>';
            }
            
        }
        echo '</td>
</tr>



<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="recaptcha_settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>
';
        
        
    }
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