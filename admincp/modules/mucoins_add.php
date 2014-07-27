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
if ( isset( $_POST['add'] ) )
{
    $mucoins = safe_input( $_POST['mucoins'], "" );
    $id = safe_input( $_POST['userid'], "" );
    $update = $core_db2->Execute( "Update ".MU_COINS_TABLE." set ".MU_COINS_COLUMN."=".MU_COINS_COLUMN."+?  where ".MU_COINS_USERID_COLUMN."=?", array(
        $mucoins,
        $id
    ) );
    if ( $update )
    {
        echo notice_message_admin( "MU Coins successfully added", 1, 0, "index.php?get=mucoins_add" );
    }
    else
    {
        echo notice_message_admin( "Unable to add MU Coins, system error.", "0", "1", "0" );
    }
}
else if ( isset( $_POST['edit'] ) )
{
    if ( empty( $_POST['userid'] ) )
    {
        echo notice_message_admin( "Some fields where left blank.", "0", "1", "0" );
    }
    else
    {
        $id = safe_input( $_POST['userid'], "" );
        if ( empty( $_POST['mucoins'] ) )
        {
            $mucoins = "0";
        }
        else
        {
            $mucoins = safe_input( $_POST['mucoins'], "" );
        }
        $check_acc = $core_db2->Execute( "Select memb___id from MEMB_INFO where memb___id=?", array(
            $id
        ) );
        if ( $check_acc->EOF )
        {
            echo notice_message_admin( "Account not found.", "0", "1", "0" );
        }
        else
        {
            $info = $core_db2->Execute( "Select ".MU_COINS_USERID_COLUMN.",".MU_COINS_COLUMN." from ".MU_COINS_TABLE." where ".MU_COINS_USERID_COLUMN."=?", array(
                $id
            ) );
            if ( $info->EOF )
            {
                $insert_cred = $core_db2->Execute( "INSERT INTO ".MU_COINS_TABLE."(".MU_COINS_USERID_COLUMN.",".MU_COINS_COLUMN.")VALUES(?,?)", array(
                    $id,
                    "0"
                ) );
                if ( $insert_cred )
                {
                    $found_acc = "1";
                }
            }
            else
            {
                $found_acc = "1";
            }
            if ( $found_acc )
            {
                echo "\n\n\t\t\t\t<div align=\"right\" style=\"width: 90%; margin-bottom: 2px;\"><a href=\"index.php?get=mucoins_add\">[Return Add MU Coins]</a></div>\n\t\t\t\t<form action=\"\" method=\"POST\" name=\"forum\">\n\t\t\t\t<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\n\t\t\t\t<tr>\n\t\t\t\t <td align=\"center\" class=\"panel_title\" colspan=\"2\">Add MU Coins (User ID: ".htmlspecialchars( $check_acc->fields[0] ).")</td>\n\t\t\t\t</tr>\n\t\n\t\t\t\t<tr>\n\t\t\t\t<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">MU Coins</td>\n\t\t\t\t</tr>\n\t\t\t\t<tr>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt1\" width=\"50%\">The amount between account's MU Coins and amount you set.</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt2\" width=\"50%\">".number_format( $info->fields[1] )." + <b>".number_format( $mucoins )."</b> = <b>".number_format( $info->fields[1] + $mucoins )."</b></td>\n\t\t\t\t</tr>\n\n\t\t\t\t<tr>\n\t\t\t\t<td align=\"center\" class=\"panel_buttons\" colspan=\"2\">\n\t\t\t\t<input type=\"hidden\" name=\"add\"><input type=\"hidden\" name=\"userid\" value=\"".$check_acc->fields[0]."\">\n\t\t\t\t<input type=\"hidden\" name=\"mucoins\" value=\"".$mucoins."\">\n\t\t\t\t<input type=\"submit\" value=\"Add MU Coins\" onclick=\"return ask_form('Are you sure?')\"></td>\t</tr>\n\t\t\t\t</table>\n\t\t\t\t</form>";
            }
        }
    }
}
else
{
    echo "<form action=\"\" method=\"POST\" name=\"forum\">\n\t<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\n\t<tr>\n\t <td align=\"center\" class=\"panel_title\" colspan=\"2\">Add MU Coins</td>\n\t</tr>\n\t\n\t<tr>\n\t<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">User ID</td>\n\t</tr>\n\t<tr>\n\t<td align=\"left\" class=\"panel_text_alt1\" width=\"50%\">Enter account's User ID </td>\n\t<td align=\"left\" class=\"panel_text_alt2\" width=\"50%\"><input type=\"text\" name=\"userid\" ></td>\n\t</tr>\n\t<tr>\n\t<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">MU Coins</td>\n\t</tr>\n\t<tr>\n\t<td align=\"left\" class=\"panel_text_alt1\" width=\"50%\">Enter amount of MU Coins you want to add.</td>\n\t<td align=\"left\" class=\"panel_text_alt2\" width=\"50%\"><input type=\"text\" name=\"mucoins\"></td>\n\t</tr>\n\n\t\t<tr>\n\t<td align=\"center\" class=\"panel_buttons\" colspan=\"2\">\n\t<input type=\"hidden\" name=\"edit\">\n\t<input type=\"submit\" value=\"Add MU Coins\"></td>\n\t</tr>\n\t</table>\n\t</form>";
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