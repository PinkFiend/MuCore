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
if ( $_GET['sys'] == "gameserver" )
{
    $accounts = $core_db2->Execute( "Select memb___id from MEMB_INFO" );
    $characters = $core_db->Execute( "Select name from Character" );
    $guilds = $core_db->Execute( "Select G_Name from Guild" );
    $online = $core_db2->Execute( "Select memb___id from MEMB_STAT where ConnectStat='1'" );
    $banned_accounts = $core_db2->Execute( "Select memb___id from MEMB_INFO where bloc_code='1'" );
    $banned_characters = $core_db->Execute( "Select name from Character where CtlCode='1'" );
    echo "\r\n\t\t\r\n\r\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\r\n<tr>\r\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Game Server Statistics</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Accounts</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".number_format( $accounts->RecordCount( ) )."</td>\r\n</tr>\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Characters</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".number_format( $characters->RecordCount( ) )."</td>\r\n</tr>\r\n\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Guilds</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".number_format( $guilds->RecordCount( ) )."</td>\r\n</tr>\r\n\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Online Accounts</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".number_format( $online->RecordCount( ) )."</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Banned Accounts</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".number_format( $banned_accounts->RecordCount( ) )."</td>\r\n</tr>\r\n\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Banned Characters</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".number_format( $banned_characters->RecordCount( ) )."</td>\r\n</tr>\r\n\r\n\r\n\r\n</table>\r\n\r\n\r\n\r\n";
}
else if ( $_GET['sys'] == "webserver" )
{
    $server_info = explode( ", ", shell_exec( "uptime" ) );
    $load_avg = explode( ": ", $server_info[2] );
    echo "\r\n\t\t\r\n\r\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\r\n<tr>\r\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Webserver Statistics</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Server Type</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".PHP_OS."</td>\r\n</tr>\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Webserver</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".$_SERVER['SERVER_SOFTWARE']."</td>\r\n</tr>\r\n\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">PHP</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".PHP_VERSION."</td>\r\n</tr>\r\n\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">PHP Memory Limit</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".ini_get( "memory_limit" )."</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">PHP Max Post Size</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".ini_get( "post_max_size" )."</td>\r\n</tr>\r\n\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Time / Up Time</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".$server_info[0]."</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Page Users</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".$server_info[1]."</td>\r\n</tr>\r\n\r\n<tr class=\"even\">\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"30%\" valign=\"top\">Server Load Averages</td>\r\n<td align=\"left\" class=\"panel_text_alt1\" width=\"70%\" valign=\"top\">".$load_avg[1]."</td>\r\n</tr>\r\n\r\n\r\n\r\n</table>\r\n\r\n\r\n\r\n";
}
else if ( $_GET['sys'] == "empty" )
{
    if ( $_GET['go'] == 1 )
    {
        if ( isset( $_POST['number'] ) )
        {
            $number_proccess = safe_input( $_POST['number'], "" );
        }
        else
        {
            $number_proccess = safe_input( $_GET['number'], "" );
        }
        if ( !isset( $_GET['row'] ) )
        {
            $row = 0;
            $total_acc = $core_db2->Execute( "Select memb_guid from MEMB_INFO" );
            $total_accounts = $total_acc->RecordCount( );
        }
        else
        {
            $row = safe_input( $_GET['row'], "" );
            $total_accounts = safe_input( $_GET['accounts'], "" );
        }
        $last_row = $row + $number_proccess;
        $i = $core_db2->Execute( "Select top ".$number_proccess." memb___id,memb_guid from MEMB_INFO where memb_guid > ".$row." order by memb_guid asc" );
        $count = 0;
        if ( isset( $_GET['affected'] ) )
        {
            $affect = safe_input( $_GET['affected'], "" );
        }
        else
        {
            $affect = 0;
        }
        if ( isset( $_GET['processed'] ) )
        {
            $processed = safe_input( $_GET['processed'], "" );
        }
        else
        {
            $processed = 0;
        }
        echo "<div align=\"left\" style=\"width:90%\">\r\n\t\t\r\n\t\t";
        while ( !$i->EOF )
        {
            ++$count;
            ++$processed;
            echo "Processing: ID ".$i->fields[1].", ".$i->fields[0]."<br>";
            $last_guid = $i->fields[1];
            $check_char = $core_db->Execute( "Select mu_id from Character where AccountID=?", array(
                $i->fields[0]
            ) );
            if ( $check_char->EOF )
            {
                $delete_account = $core_db2->Execute( "Delete from MEMB_INFO where memb___id=?", array(
                    $i->fields[0]
                ) );
                $delete_stat = $core_db2->Execute( "Delete from MEMB_STAT where memb___id=?", array(
                    $i->fields[0]
                ) );
                $delete_warehouse = $core_db->Execute( "Delete from warehouse where AccountID=?", array(
                    $i->fields[0]
                ) );
                $delete_accountchar = $core_db->Execute( "Delete from AccountCharacter where Id=?", array(
                    $i->fields[0]
                ) );
                $delete_credits = $core_db->Execute( "Delete from MEMB_CREDITS where memb___id=?", array(
                    $i->fields[0]
                ) );
                ++$affect;
            }
            $i->MoveNext( );
        }
        if ( 0 < $count )
        {
            echo "\r\n\t\t\t<br>\r\n\t\t\t<b>\r\n\t\t\tProcessed Accounts: ".number_format( $processed )."/".number_format( $total_accounts )."\r\n\t\t<br>Deleted Accounts: ".number_format( $affect )."\r\n\t\t</b>\r\n\t\t\r\n\t\t\r\n\t\t\t<script type=\"text/javascript\">\r\n\t\t\twindow.location=\"index.php?get=".__FILE__."tenance&sys=empty&go=1&number=".$number_proccess."&row=".$last_guid."&affected=".$affect."&accounts=".$total_accounts."&processed=".$processed."\";\r\n\t\t\t</script>\r\n\t\t\t</div>\r\n\t\t\t";
        }
        else
        {
            echo notice_message_admin( "".$affect." accounts have been deleted", 1, 0, "index.php?get=".__FILE__."tenance&sys=empty" );
        }
    }
    else
    {
        echo "\r\n\t\t\r\n<form action=\"index.php?get=".__FILE__."tenance&sys=empty&go=1\" name=\"form_c\" method=\"POST\">\r\n\r\n\t\t<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-bottom: 20px;\">\r\n<tr>\r\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Maintenance</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Delete Empty Accounts</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" valign=\"top\">\r\nNumber of accounts to process per cycle <input type=\"text\" value=\"10\" size=\"6\" name=\"number\">\r\n</td>\r\n<td align=\"right\" class=\"panel_text_alt1\" valign=\"top\">\r\n<input type=\"submit\" value=\"Delete Empty Accounts\" onclick=\"return ask_form('Are you sure?')\"></td>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</table>\r\n</form>\r\n\r\n";
    }
}
else if ( $_GET['sys'] == "inactive" )
{
    if ( $_GET['go'] == 1 )
    {
        if ( isset( $_POST['number'] ) )
        {
            $number_proccess = safe_input( $_POST['number'], "" );
        }
        else
        {
            $number_proccess = safe_input( $_GET['number'], "" );
        }
        if ( isset( $_POST['days'] ) )
        {
            $days_proccess = safe_input( $_POST['days'], "" );
        }
        else
        {
            $days_proccess = safe_input( $_GET['days'], "" );
        }
        if ( !isset( $_GET['row'] ) )
        {
            $row = 0;
            $total_acc = $core_db2->Execute( "Select memb___id from MEMB_STAT" );
            $total_accounts = $total_acc->RecordCount( );
        }
        else
        {
            $row = safe_input( $_GET['row'], "" );
            $total_accounts = safe_input( $_GET['accounts'], "" );
        }
        $last_row = $row + $number_proccess;
        $i = $core_db2->Execute( "Select top ".$number_proccess." memb___id,memb_guid,DisConnectTM from MEMB_STAT where memb_guid > ".$row." and DisConnectTM is not null order by memb_guid asc" );
        $count = 0;
        if ( isset( $_GET['affected'] ) )
        {
            $affect = safe_input( $_GET['affected'], "" );
        }
        else
        {
            $affect = 0;
        }
        if ( isset( $_GET['processed'] ) )
        {
            $processed = safe_input( $_GET['processed'], "" );
        }
        else
        {
            $processed = 0;
        }
        $time_delete = 86400 * $days_proccess;
        echo "<div align=\"left\" style=\"width:90%\">";
        while ( !$i->EOF )
        {
            ++$count;
            ++$processed;
            $db_time = time( ) - strtotime( $i->fields[2] );
            $time_db = strtotime( $i->fields[2] );
            $last_guid = $i->fields[1];
            if ( !empty( $time_db ) )
            {
                echo "Processing: ID ".$i->fields[1].", ".$i->fields[0]."<br>";
                $timestamp = 1;
            }
            else
            {
                echo "Processing: ID ".$i->fields[1].", ".$i->fields[0]." <b>[FAILED: INVALID TIMESTAMP]</b><br>";
                $timestamp = 0;
                break;
            }
            if ( $time_delete < $db_time && $timestamp == 1 )
            {
                ++$affect;
                $c = $core_db->Execute( "Select name from Character where AccountID=?", array(
                    $i->fields[0]
                ) );
                while ( !$c->EOF )
                {
                    $delete_Character = $core_db->Execute( "Delete from Character where name=?", array(
                        $c->fields[0]
                    ) );
                    $delete_GuildMember = $core_db->Execute( "Delete from GuildMember where name=?", array(
                        $c->fields[0]
                    ) );
                    $delete_Guild = $core_db->Execute( "Delete from Guild where G_Master=?", array(
                        $c->fields[0]
                    ) );
                    $c->MoveNext( );
                }
                $delete_account = $core_db2->Execute( "Delete from MEMB_INFO where memb___id=?", array(
                    $i->fields[0]
                ) );
                $delete_stat = $core_db2->Execute( "Delete from MEMB_STAT where memb___id=?", array(
                    $i->fields[0]
                ) );
                $delete_warehouse = $core_db->Execute( "Delete from warehouse where AccountID=?", array(
                    $i->fields[0]
                ) );
                $delete_accountchar = $core_db->Execute( "Delete from AccountCharacter where Id=?", array(
                    $i->fields[0]
                ) );
                $delete_credits = $core_db->Execute( "Delete from MEMB_CREDITS where memb___id=?", array(
                    $i->fields[0]
                ) );
            }
            $i->MoveNext( );
        }
        if ( 0 < $count )
        {
            echo "\r\n\t\t\t<br>\r\n\t\t\t<b>\r\n\t\t\tProcessed Accounts: ".number_format( $processed )."/".number_format( $total_accounts )."\r\n\t\t<br>Deleted Accounts: ".number_format( $affect )."\r\n\t\t</b>";
            if ( $timestamp == 1 )
            {
                echo "\r\n\t\t\t\t\r\n\t\t\t\t<script type=\"text/javascript\">\r\n\t\t\twindow.location=\"index.php?get=".__FILE__."tenance&sys=inactive&go=1&number=".$number_proccess."&row=".$last_guid."&affected=".$affect."&accounts=".$total_accounts."&processed=".$processed."&days=".$days_proccess."\";\r\n\t\t\t</script>";
            }
            echo "\r\n\t\t\r\n\t\t\r\n\t\t\t\r\n\t\t\t</div>\r\n\t\t\t";
        }
        else
        {
            echo notice_message_admin( "".$affect." accounts have been deleted", 1, 0, "index.php?get=".__FILE__."tenance&sys=inactive" );
        }
    }
    else
    {
        echo "\r\n\t\t\r\n<form action=\"index.php?get=".__FILE__."tenance&sys=inactive&go=1\" name=\"form_c\" method=\"POST\">\r\n\r\n\t\t<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-bottom: 20px;\">\r\n<tr>\r\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Maintenance</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Delete Inactive Accounts</td>\r\n</tr>\r\n\r\n<tr>\r\n<td align=\"left\" class=\"panel_text_alt1\" valign=\"top\">\r\nNumber of accounts to process per cycle <input type=\"text\" value=\"10\" size=\"6\" name=\"number\"><br>\r\nInactive Days <input type=\"text\" value=\"60\" size=\"6\" name=\"days\"><br><br>\r\n\r\n<b>Note:</b> This function is to delete accounts that are no longer active for more than * days\r\n</td>\r\n<td align=\"right\" class=\"panel_text_alt1\" valign=\"top\">\r\n<input type=\"submit\" value=\"Delete Inactive Accounts\" onclick=\"return ask_form('Are you sure?')\"></td>\r\n\r\n\r\n</tr>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</table>\r\n</form>\r\n\r\n";
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
