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
if ( isset( $_GET['delete'] ) )
{
    if ( empty( $_GET['delete'] ) )
    {
        echo notice_message_admin( "Unable to proceed your request.", "1", "1", "index.php?get=doante_paypal_transactions" );
    }
    else
    {
        $id = safe_input( $_GET['delete'], "" );
        $delete_txn = $core_db->Execute( "Delete from MUCore_PayPal_Donate_Transactions where id=?", array(
            $id
        ) );
        if ( $delete_txn )
        {
            echo notice_message_admin( "PayPal Transaction successfully deleted.", 1, 0, "index.php?get=doante_paypal_transactions" );
        }
        else
        {
            echo notice_message_admin( "Unable to proceed your request.", "1", "1", "index.php?get=doante_paypal_transactions" );
        }
    }
}
else
{
    echo "\n<form action=\"\" name=\"form_edit\" method=\"POST\">\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">\n<tr>\n <td align=\"center\" class=\"panel_title\" colspan=\"2\">Search PayPal Donate Transactions</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Transaction ID</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">\nEnter PayPal Transaction ID.</td>\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">\n<input type=\"text\" name=\"txn_id\">\n</td>\n</tr>\n\n<tr>\n<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">User ID</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">\nEnter User ID of account.\n</td>\n<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">\n<input type=\"text\" name=\"userid\">\n</td>\n</tr>\n\n\n\n\n<tr>\n<td align=\"right\" class=\"panel_buttons\" colspan=\"2\">\n<input type=\"hidden\" name=\"search\">\n<input type=\"submit\" value=\"Search\"></td>\n</tr>\n</table>\n</form>\n";
    if ( !isset( $_POST['txn_id'] ) || !isset( $_POST['userid'] ) )
    {
        $txn_select = $core_db->Execute( "Select top 50 id,memb___id,transaction_id,amount,currency,order_date,payer_email,credits,status,code from MUCore_PayPal_Donate_Transactions order by order_date desc" );
        $txn_text = "Last 50 PayPal Donate Transactions";
    }
    else if ( !empty( $_POST['txn_id'] ) )
    {
        $txn_text = "Search Results";
        $search = safe_input( $_POST['txn_id'] );
        $txn_select = $core_db->Execute( "Select id,memb___id,transaction_id,amount,currency,order_date,payer_email,credits,status,code from MUCore_PayPal_Donate_Transactions where transaction_id=? order by order_date desc", array(
            $search
        ) );
    }
    else if ( !empty( $_POST['userid'] ) )
    {
        $txn_text = "Search Results";
        $search = safe_input( $_POST['userid'] );
        $txn_select = $core_db->Execute( "Select id,memb___id,transaction_id,amount,currency,order_date,payer_email,credits,status,code from MUCore_PayPal_Donate_Transactions where memb___id=? order by order_date desc", array(
            $search
        ) );
    }
    else
    {
        $txn_text = "Last 50 PayPal Donate Transactions";
        $txn_select = $core_db->Execute( "Select top 50 id,memb___id,transaction_id,amount,currency,order_date,payer_email,credits,status,code from MUCore_PayPal_Donate_Transactions order by order_date desc" );
    }
    echo "\n<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-top: 20px;\">\n<tr>\n <td align=\"center\" class=\"panel_title\" colspan=\"9\">".$txn_text."</td>\n</tr>\n<tr>\n<td align=\"left\" class=\"panel_title_sub2\" width=\"80\">User ID</td>\n<td align=\"left\" class=\"panel_title_sub2\">Transaction ID</td>\n<td align=\"left\" class=\"panel_title_sub2\">Verification Code</td>\n<td align=\"left\" class=\"panel_title_sub2\">PayPal Email</td>\n<td align=\"left\" class=\"panel_title_sub2\">Amount</td>\n<td align=\"left\" class=\"panel_title_sub2\" width=\"100\">Issued Credits</td>\n<td align=\"left\" class=\"panel_title_sub2\" width=\"140\">Processed Date</td>\n<td align=\"left\" class=\"panel_title_sub2\" width=\"100\">Payment Status</td>\n<td align=\"left\" class=\"panel_title_sub2\" width=\"50\">Controls</td>\n</tr>";
    $count = 0;
    while ( !$txn_select->EOF )
    {
        ++$count;
        $tr_color = $count % 2 ? "" : "even";
        echo "<tr class=\"".$tr_color."\">\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\"><strong>".htmlspecialchars( $txn_select->fields[1] )."</strong></td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".$txn_select->fields[2]."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".$txn_select->fields[9]."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".$txn_select->fields[6]."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".$txn_select->fields[3]." ".$txn_select->fields[4]."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".number_format( $txn_select->fields[7] )."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".date( "F j, Y / H:i", $txn_select->fields[5] )."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\">".$txn_select->fields[8]."</td>\n\t\t\t\t<td align=\"left\" class=\"panel_text_alt_list\"><a href=\"#\" onclick=\"ask_url('Are you sure you want to delete this transaction?','index.php?get=doante_paypal_transactions&delete=".$txn_select->fields[0]."')\";>[Delete]</a></td>\n\t\t\t\t</tr>";
        $txn_select->MoveNext( );
    }
    if ( $count == "0" )
    {
        echo "<tr>\n\t\t\t\t<td align=\"center\" class=\"panel_text_alt_list\" colspan=\"9\"><em>No transactions</em></td>\n\t\t\t\t</tr>";
    }
    echo "</table>";
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