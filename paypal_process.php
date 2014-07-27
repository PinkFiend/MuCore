<?php
require( "config.php" );
require( "engine/global_config.php" );
require( "engine/global_functions.php" );
require( "engine/adodb/adodb.inc.php" );
if ( $core['debug'] == "1" )
{
    ini_set( "display_errors", "On" );
    error_reporting( E_ERROR | E_WARNING | E_PARSE );
}
else
{
    ini_set( "display_errors", "Off" );
    error_reporting( E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING );
}
include( "engine/connect_core.php" );
$log_dir = "engine/logs/paypal";
echo "<div style=\"font: 15px arial; width: 600px;\">";
if ( isset( $_POST['code'] ) )
{
    $code = safe_input( $_POST['code'], "" );
    if ( empty( $code ) )
    {
        echo "<span style=\"color:#ff0000\">Please enter an valid verification code.</span>";
    }
    else
    {
        $check = $core_db->Execute( "Select memb___id,credits,credits_issued,id from MUCore_PayPal_Donate_Transactions where code=?", array(
            $code
        ) );
        if ( $check->EOF )
        {
            echo "<span style=\"color:#ff0000\">You have entred an invalid verification code.</span>";
        }
        else if ( $check->fields[2] == 1 )
        {
            echo "<span style=\"color:#ff0000\">You have entred an invalid verification code.</span>";
        }
        else
        {
            $check_for_memb_id = $core_db2->Execute( "Select ".MU_COINS_USERID_COLUMN." from ".MU_COINS_TABLE." where ".MU_COINS_USERID_COLUMN."=?", array(
                $check->fields[0]
            ) );
            if ( $check_for_memb_id->EOF )
            {
                $set_credits = $core_db2->Execute( "insert into ".MU_COINS_TABLE." (".MU_COINS_USERID_COLUMN.",".MU_COINS_COLUMN.")VALUES(?,?)", array(
                    $check->fields[0],
                    $check->fields[1]
                ) );
            }
            else
            {
                $set_credits = $core_db2->Execute( "Update ".MU_COINS_TABLE." set ".MU_COINS_COLUMN."=".MU_COINS_COLUMN."+?  where ".MU_COINS_USERID_COLUMN."=?", array(
                    $check->fields[1],
                    $check->fields[0]
                ) );
            }
            if ( $set_credits )
            {
                $update_code = $core_db->Execute( "Update MUCore_PayPal_Donate_Transactions set credits_issued='1' where id=?", array(
                    $check->fields[3]
                ) );
                if ( $update_code )
                {
                    write_log( $log_dir, "[PayPal Donate Step 3/3] Set Credits [userid: ".$check->fields[0]."] [credits: ".number_format( $check->fields[1] )."]" );
                    echo "<b>".number_format( $check->fields[1] )." credits have been issued to you.!</b><br>You will be redirected to ".$core['config']['websitetitle']." in 5 seconds<br><br><a href=\"".$core['config']['website_url']."\">Click here if your browser does not automatically redirect you.</a><meta http-equiv=\"Refresh\" content=\"5; URL=".$core['config']['website_url']."\">";
                    $success = 1;
                }
            }
        }
    }
    echo "<br><br>";
}
if ( !$success )
{
    if ( isset( $_GET['note'] ) )
    {
        $note = "<fieldset><legend>Note</legend>Your verification code have been sent into your <b>paypal email addresss</b>. Please check your paypal email.</blink></fieldset>";
    }
    echo "\r\n<form action=\"\" name=\"credits\" method=\"post\">\r\n<em>Enter your donation verification code to receive your credits.</em><br>\r\n<b>Verification Code:</b> <input type=\"text\" name=\"code\" maxlength=\"40\" size=\"31\"> <input type=\"submit\" value=\"Get Credits\">\r\n</form>\r\n<br>\r\n".$note."\r\n";
}
echo "</div>";
?>
