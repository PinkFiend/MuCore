<?php
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
if ( isset( $_POST['settings'] ) )
{
    $save_1 = new_config_xml( "../engine/config_mods/donate_paypal_settings", "pp_email", safe_input( $_POST['pp_email'], "\\#\\.\\_\\@\\-" ) );
    $save_2 = new_config_xml( "../engine/config_mods/donate_paypal_settings", "punish", safe_input( $_POST['punish'], "\\#\\.\\_\\@\\-" ) );
    $save_3 = new_config_xml( "../engine/config_mods/donate_paypal_settings", "code", safe_input( $_POST['code'], "\\#\\.\\_\\@\\-" ) );
    echo notice_message_admin( "Settings successfully saved", 1, 0, "index.php?get=donate_paypal_settings" );
}
else
{
    if ( isset( $_POST['module_active'] ) )
    {
        $save_status = new_config_xml( "../engine/config_mods/donate_paypal_settings", "active", safe_input( $_POST['module_active'], "" ) );
    }
    $get_config = simplexml_load_file( "../engine/config_mods/donate_paypal_settings.xml" );
    echo "<form action=\"\" name=\"settings\" method=\"POST\">\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-bottom: 20px;\">\n<tr>\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">PayPal Settings</td>\n</tr>\n<tr>";
    if ( $get_config->active == "1" )
    {
        echo "<td align=\"left\" class=\"panel_buttons\" style=\"background: #0C0;\"><b>Donate with PayPal is active.</b></td>\n<td align=\"right\" class=\"panel_buttons\" style=\"background: #0C0;\">\n<input type=\"hidden\" name=\"edit_settings\"><input type=\"submit\" value=\"Turn Donate with PayPal Off\"><input type=\"hidden\" name=\"module_active\" value=\"0\">";
    }
    else if ( $get_config->active == "0" )
    {
        echo "<td align=\"left\" class=\"panel_buttons\" style=\"background: #C00;\"><b>Donate with PayPal is inactive.</b></td>\n<td align=\"right\" class=\"panel_buttons\" style=\"background: #C00;\">\n<input type=\"hidden\" name=\"edit_settings\"><input type=\"submit\" value=\"Turn Donate with PayPal On\"><input type=\"hidden\" name=\"module_active\" value=\"1\">";
    }
    echo "</td>\n</tr>\n</table>\n</form>";
    echo "\n<form action=\"\" name=\"form_edit\" method=\"POST\">\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\n<tr>\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">PaPal Settings</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">PayPal Email Address</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">Enter paypal email address.</td>\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">\n<input type=\"text\" value=\"".$get_config->pp_email."\" name=\"pp_email\"><br>\n</td>\n</tr>\n\n<tr>\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Chargeback Punish</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">If set to 'Yes' user's account will be blocked if him make an paypal chargeback or payment is refunded.</td>\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">";
    switch ( $get_config->punish )
    {
    case "0" :
        echo "<label><input type=\"radio\" name=\"punish\" value=\"1\">Yes</label> <label><input type=\"radio\" name=\"punish\" checked=\"checked\" value=\"0\">No</label>";
        break;
    case "1" :
        echo "<label><input type=\"radio\" name=\"punish\" value=\"1\" checked=\"checked\">Yes</label> <label><input type=\"radio\" name=\"punish\" value=\"0\">No</label>";
    }
    echo "\n</td>\n</tr>\n\n\n<tr>\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">PayPal Verification</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">If set to 'Yes' buyer's paypal email will receive mail with confirmation code in order to claim his credits for his paypal transcation.<br><br>If set to 'No' buyer will receive credits after paypal transaction is finihsed. <br><br><b>This function will need buyers to verify their donation/transaction to avoid chargeback. They will need the verification code sent to their paypal email in order to finish the donation process.</b>\n\n<br><br>Note: <b>PayPal Verification</b> require SMTP Server, <a href=\"index.php?get=smtp_settings\">SMTP Settings</a>\n</td>\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">";
    switch ( $get_config->code )
    {
    case "0" :
        echo "<label><input type=\"radio\" name=\"code\" value=\"1\">Yes</label> <label><input type=\"radio\" name=\"code\" checked=\"checked\" value=\"0\">No</label>";
        break;
    case "1" :
        echo "<label><input type=\"radio\" name=\"code\" value=\"1\" checked=\"checked\">Yes</label> <label><input type=\"radio\" name=\"code\" value=\"0\">No</label>";
    }
    echo "\n</td>\n</tr>\n\n<tr>\n<td align=\"right\" class=\"panel_buttons\" colspan=\"2\">\n<input type=\"hidden\" name=\"settings\">\n<input type=\"submit\" value=\"Save\"></td>\n</tr>\n</table>\n</form>\n";
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