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
if (isset($_POST['settings'])) {
    $save_3 = new_config_xml("../engine/config_mods/reset_stats_settings", "resets", $_POST['resets']);
    $save_3 = new_config_xml("../engine/config_mods/reset_stats_settings", "class", $_POST['class']);
    echo notice_message_admin("Settings successfully saved", 1, 0, "index.php?get=usercp_reset_stats_settings");
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml("../engine/config_mods/reset_stats_settings", "active", safe_input($_POST['module_active'], ""));
    }
    $get_config = simplexml_load_file("../engine/config_mods/reset_stats_settings.xml");
    echo "<form action=\"\" name=\"settings\" method=\"POST\">\r\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-bottom: 20px;\">\r\n<tr>\r\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Reset Stats Settings</td>\r\n</tr>\r\n<tr>";
    if ($get_config->active == "1") {
        echo "<td align=\"left\" class=\"panel_buttons\" style=\"background: #0C0;\"><b>Reset Stats is active.</b></td>\r\n<td align=\"right\" class=\"panel_buttons\" style=\"background: #0C0;\">\r\n<input type=\"hidden\" name=\"edit_settings\"><input type=\"submit\" value=\"Turn Reset Stats Off\"><input type=\"hidden\" name=\"module_active\" value=\"0\">";
    } else if ($get_config->active == "0") {
        echo "<td align=\"left\" class=\"panel_buttons\" style=\"background: #C00;\"><b>Reset Stats is inactive.</b></td>\r\n<td align=\"right\" class=\"panel_buttons\" style=\"background: #C00;\">\r\n<input type=\"hidden\" name=\"edit_settings\"><input type=\"submit\" value=\"Turn Reset Stats On\"><input type=\"hidden\" name=\"module_active\" value=\"1\">";
    }
    echo "</td>\r\n</tr>\r\n</table>\r\n</form>";
    echo "\r\n<form action=\"\" name=\"form_edit\" method=\"POST\">\r\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\r\n<tr>\r\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Reset Stats Settings</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Resets</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">Set the amount of resets required to reset stats.</td>\r\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">\r\n<input type=\"text\" value=\"" . $get_config->resets . "\" name=\"resets\"><br>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Class Codes for 7 LevelUp Points</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">Enter the class codes of characters that receive 7 levelup points per level.<br><br>Speare them using comma (,)<br>E.g: 48,58,64</td>\r\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">\r\n<input type=\"text\" value=\"" . $get_config->class . "\" name=\"class\"><br>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"right\" class=\"panel_buttons\" colspan=\"2\">\r\n<input type=\"hidden\" name=\"settings\">\r\n<input type=\"submit\" value=\"Save\"></td>\r\n</tr>\r\n</table>\r\n</form>\r\n";
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