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
if ( isset( $_POST['active'] ) )
{
    if ( empty( $_POST['activate_code_delete'] ) )
    {
        echo notice_message_admin( "No User IDs selected.", 0, 1, 0 );
    }
    else if ( empty( $_POST['option'] ) )
    {
        echo notice_message_admin( "No option selected.", 0, 1, 0 );
    }
    else
    {
        $count = 0;
        $option = safe_input( $_POST['option'], "" );
        if ( $option == 1 )
        {
            $delete = 0;
            $text = "activated";
        }
        else if ( $option == 2 )
        {
            $delete = 1;
            $text = "deleted";
        }
        foreach ( $_POST['activate_code_delete'] as $post_name => $post_code )
        {
            if ( $delete == 1 )
            {
                $activate_user = $core_db2->Execute( "Delete from memb_info where memb_guid=?", array(
                    $post_code
                ) );
            }
            else
            {
                $activate_user = $core_db2->Execute( "Update memb_info set bloc_code='0',confirmed='1' where memb_guid=?", array(
                    $post_code
                ) );
            }
            if ( $activate_user )
            {
                ++$count;
            }
        }
        echo notice_message_admin( "<b>".$count."</b> users ids successfully ".$text.".", 1, 0, "index.php?get=users_activate" );
    }
}
else if ( isset( $_GET['activate'] ) )
{
    if ( empty( $_GET['activate'] ) )
    {
        echo notice_message_admin( "Unable to proceed your request.", "1", "1", "index.php?get=users_activate" );
    }
    else
    {
        $id = safe_input( $_GET['activate'], "" );
        $activate_user = $core_db2->Execute( "Update memb_info set bloc_code='0',confirmed='1' where memb_guid=?", array(
            $id
        ) );
        if ( $activate_user )
        {
            echo notice_message_admin( "Uers successfully activated.", 1, 0, "index.php?get=users_activate" );
        }
        else
        {
            echo notice_message_admin( "Unable to proceed your request.", "1", "1", "index.php?get=users_activate" );
        }
    }
}
else if ( isset( $_GET['delete'] ) )
{
    if ( empty( $_GET['delete'] ) )
    {
        echo notice_message_admin( "Unable to proceed your request.", "1", "1", "index.php?get=users_activate" );
    }
    else
    {
        $id = safe_input( $_GET['delete'], "" );
        $delete_user = $core_db2->Execute( "Delete from memb_info where memb_guid=?", array(
            $id
        ) );
        if ( $delete_user )
        {
            echo notice_message_admin( "Uers successfully deleted.", 1, 0, "index.php?get=users_activate" );
        }
        else
        {
            echo notice_message_admin( "Unable to proceed your request.", "1", "1", "index.php?get=users_activate" );
        }
    }
}
else
{
    echo "<form action=\"\" method=\"POST\" name=\"delete_archive\" onclick=\"cCheck(document.delete_archive,'activate_code_delete[]','archive_selected','Go');\"><input type=\"hidden\" name=\"masive_delete\">\n\t<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-top: 20px\">\n<tr>\n <td align=\"center\" class=\"panel_title\" colspan=\"5\">Users Awaiting Activation</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_title_sub2\">User ID</td>\n<td align=\"left\" class=\"panel_title_sub2\">Email Address</td>\n<td align=\"left\" class=\"panel_title_sub2\">Controls</td>\n</tr>\n\t\n\t";
    $take_accounts = $core_db2->Execute( "Select memb_guid,memb___id,mail_addr from memb_info where confirmed='0'" );
    $count = 0;
    while ( !$take_accounts->EOF )
    {
        ++$count;
        $tr_color = $count % 2 ? "" : "even";
        echo "<tr class=\"".$tr_color."\">\n\t\t\t<td align=\"left\" class=\"panel_text_alt_list\"><strong>".$take_accounts->fields[1]."</strong></td>\n\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".$take_accounts->fields[2]."</td>\n\t\t\t<td align=\"left\" class=\"panel_text_alt_list\" width=\"150\"><a href=\"#\" onclick=\"ask_url('Are you sure you want activate User ID : ".$take_accounts->fields[1]."?','index.php?get=users_activate&activate=".$take_accounts->fields[0]."')\";>[Activate]</a> / <a href=\"#\" onclick=\"ask_url('Are you sure you want delete User ID : ".$take_accounts->fields[1]."?','index.php?get=users_activate&delete=".$take_accounts->fields[0]."')\";>[Delete]</a>&nbsp;<input name=\"activate_code_delete[]\" type=\"checkbox\"  value=\"".$take_accounts->fields[0]."\"></td></tr>\n\t\t\t";
        $take_accounts->MoveNext( );
    }
    if ( $count == "0" )
    {
        echo "<tr>\n\t\t<td align=\"center\" colspan=\"3\" class=\"panel_text_alt_list\"><em>No users</em></td>\n\t\t</tr>";
    }
    echo "<tr>\n<td align=\"center\" class=\"panel_buttons\" colspan=\"3\">\n<div id=\"\"><div align=\"right\">\n<input type=\"hidden\" name=\"active\"><a href=\"javascript:void(0)\" onclick=\"CheckAll(document.delete_archive,'activate_code_delete[]'); \">[Check All]</a> <a href=\"javascript:void(0)\" onclick=\"UnCheckAll(document.delete_archive,'activate_code_delete[]'); \">[Uncheck All]</a><br><br>\n<select name=\"option\">\n<option value=\"\">Select</option>\n<option value=\"1\">Activate</option>\n<option value=\"2\">Delete</option>\n</select>\n<input type=\"submit\" name=\"archive_selected\" id=\"archive_selected\" value=\"Go (0)\" onclick=\"return ask_form('Are you sure?')\"> </div>\n\n\n</tr>\n</table></form>";
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