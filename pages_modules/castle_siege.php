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
$config = simplexml_load_file("engine/config_mods/castle_siege.xml");
$active = trim($config->active);
if ($active == "0") {
    echo msg("0", text_sorry_feature_disabled);
} else {
    $siege_group = trim($config->group);
    $cs          = $core_db->Execute("Select SIEGE_ENDED,CASTLE_OCCUPY,OWNER_GUILD,MONEY,TAX_RATE_CHAOS,TAX_RATE_STORE,TAX_HUNT_ZONE from MuCastle_DATA where MAP_SVR_GROUP=?", array(
        $siege_group
    ));
    if ($cs->fields[0] == "1") {
        $cs_status = "<font color=\"red\">" . cs_end . "</span>";
    } else if ($cs->fields[0] == "0") {
        $cs_open   = "1";
        $cs_status = "<font color=\"#2e9e1b\">" . cs_start . "</font>";
    }
    if ($cs->fields[1] == "0") {
        $owner = "<em>" . cs_no_owner . "</em>";
    } else if ($cs->fields[1] == "1") {
        $owner = htmlspecialchars($cs->fields[2]);
    }
    echo "<div style=\"margin-top: 20px;\">\r\n<fieldset><legend>" . cs_info . "</legend>\r\n<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"padding-left: 10px;\">\r\n<tr>\r\n<td align=\"left\">" . cs_status . ": <b>" . $cs_status . "</b></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">" . cs_guild_owner . ": <b>" . $owner . "</b></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">" . cs_money . ": <b>" . number_format($cs->fields[3]) . "</b></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">" . cs_chaos_tax . ": <b>" . number_format($cs->fields[4]) . "</b></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">" . cs_store_tax . ": <b>" . number_format($cs->fields[5]) . "</b></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">" . cs_hunt_tax . ": <b>" . number_format($cs->fields[6]) . "</b></td>\r\n</tr>\r\n</table>\r\n</fieldset>\r\n</div>";
    if ($cs_open == "1") {
        echo "<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"margin-top: 10px;\">\r\n<tr>\r\n<td align=\"left\" colspan=\"4\">\r\n<div class=\"iR_rank_type\">\r\n<span style=\"color: #990000;\">" . cs_registered_guilds . "</span>\r\n</div>\r\n</td>\r\n</tr>";
        $g       = $core_db->Execute("Select GUILD_NAME from MuCastle_SIEGE_GUILDLIST where MAP_SVR_GROUP=?", array(
            $siege_group
        ));
        $g_count = 0;
        while (!$g->EOF) {
            ++$g_count;
            $ico = $core_db->Execute("Select G_Mark,G_Master,G_Score from Guild where G_Name=?", array(
                $g->fields[0]
            ));
            echo "\r\n\t\t\t\t<tr>\r\n\t\t\t\t<td align=\"center\"  rowspan=\"2\" class=\"iR_rank\">" . $g_count . "</td>\r\n\t\t\t\t<td align=\"left\" class=\"iR_name\" >" . htmlspecialchars($g->fields[0]) . "</td>\r\n\t\t\t\t<td align=\"right\" rowspan=\"2\"><img src=\"get.php?aL=" . $ico->fields[0] . "\" width=\"50\" height=\"50\"></td>\r\n\t\t\t\t<td align=\"left\" class=\"iR_stats\">" . cs_guild_master . ": " . htmlspecialchars($ico->fields[1]) . "</td>\r\n\t\t\t\t</tr>\r\n\t\t\t\t<tr>\r\n\t\t\t\t<td align=\"left\" class=\"iR_class\"></td>\r\n\t\t\t\t<td align=\"left\" class=\"iR_stats_level\">" . cs_score . ": " . $ico->fields[2] . "</td>\r\n\t\t\t\t</tr>\r\n\t\t\t\t<tr>\r\n\t\t\t\t<td colspan=\"4\" colspan=\"6\" style=\"background-image:url(template/" . $core['config']['template'] . "/images/inner_line.jpg); background-repeat:repeat-x;\"> </td>\r\n\t\t\t\t</tr>\r\n\t\t\t\t";
            $g->MoveNext();
        }
        if ($g_count == "0") {
            echo "\r\n\t<tr>\r\n\t<td align=\"left\">" . msg("0", cs_no_guilds) . "</td>\r\n\t</tr>\r\n\t<tr>\r\n\t<td colspan=\"4\" colspan=\"6\" style=\"background-image:url(template/" . $core['config']['template'] . "/images/inner_line.jpg); background-repeat:repeat-x;\"> </td>\r\n\t</tr>\r\n\t";
        }
        echo "</table>";
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