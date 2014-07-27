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
$config = simplexml_load_file( "engine/config_mods/reset_stats_settings.xml" );
$active = trim( $config->active );
if ( $active == "0" )
{
    echo msg( "0", text_sorry_feature_disabled );
}
else
{
    $reset_resets_need = trim( $config->resets );
    $class = trim( $config->class );
    if ( isset( $_GET['sid'] ) )
    {
        echo "<div style=\"margin-top: 10px;\">";
        $id = safe_input( $_GET['sid'], "" );
        if ( empty( $id ) || !is_numeric( $id ) )
        {
            header( "Location: ".$core_run_script."" );
            exit( );
        }
        else if ( character_and_account( $id, $user_auth_id ) === false )
        {
            header( "Location: ".$core_run_script."" );
            exit( );
        }
        else if ( account_online( $user_auth_id ) === true )
        {
            echo msg( "0", text_resetstats_t1 );
        }
        else
        {
            $select_req = $core_db->Execute( "select cLevel,Resets,LevelUpPoint,Class from Character where mu_id=? and AccountID=?", array(
                $id,
                $user_auth_id
            ) );
            if ( $select_req->fields[1] < $reset_resets_need )
            {
                echo msg( "0", str_replace( "{resets}", $reset_resets_need - $select_req->fields[1], text_resetstats_t7 ) );
            }
            else
            {
                $array_class = explode( ",", $class );
                $load_reset_settings = simplexml_load_file( "engine/config_mods/reset_character_settings.xml" );
                $reset_points_formula = trim( $load_reset_settings->bpoints_formula );
                $reset_points = trim( $load_reset_settings->bpoints );
                if ( $reset_points_formula == 0 )
                {
                    if ( in_array( $select_req->fields[3], $array_class ) )
                    {
                        $points_level = 7 * $select_req->fields[0];
                        $points_resets = 2394 * $select_req->fields[1];
                        $bonous_resets = $reset_points * $select_req->fields[1];
                        $total_points = $points_level + $points_resets + $bonous_resets;
                    }
                    else
                    {
                        $points_level = 5 * $select_req->fields[0];
                        $points_resets = 1995 * $select_req->fields[1];
                        $bonous_resets = $reset_points * $select_req->fields[1];
                        $total_points = $points_level + $points_resets + $bonous_resets;
                    }
                }
                else if ( $reset_points_formula == 1 )
                {
                    if ( in_array( $select_req->fields[3], $array_class ) )
                    {
                        $points_level = 7 * $select_req->fields[0];
                        $bonous_resets = $reset_points * $select_req->fields[1];
                        $total_points = $points_level + $bonous_resets;
                    }
                    else
                    {
                        $points_level = 5 * $select_req->fields[0];
                        $bonous_resets = $reset_points * $select_req->fields[1];
                        $total_points = $points_level + $bonous_resets;
                    }
                }
                $update_stats = $core_db->Execute( "Update Character set LevelUpPoint=?,Strength='25',Dexterity='25',Vitality='25',Energy='25',Leadership='25' where mu_id=?", array(
                    $total_points,
                    $id
                ) );
                if ( $update_stats )
                {
                    echo msg( "1", text_resetstats_t2 );
                }
                else
                {
                    echo msg( "0", text_resetstats_t3 );
                }
            }
        }
    }
    echo "<div style=\"margin-top: 20px;\">\r\n\t\r\n<fieldset><legend>".text_resetstats_t8."</legend>\r\n<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"padding-left: 10px;\">\r\n<tr>\r\n<td align=\"left\"><b>Resets:</b></td>\r\n<td align=\"left\" width=\"100%\">".$reset_resets_need."</td>\r\n</tr>\r\n</table>\r\n</fieldset>\r\n</div>\r\n\r\n<div style=\"margin-top: 10px;\">\r\n<fieldset><legend>".text_resetstats_t4."</legend>\r\n<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"padding-left: 10px;\">\r\n<tr>\r\n<td align=\"left\">".text_resetstats_t5."\r\n</td>\r\n</tr>\r\n</table>\r\n</fieldset>\r\n</div>";
    $characters = $core_db->Execute( "Select mu_id,Name,Class,Resets from Character where AccountID=? order by cLevel desc ", array(
        $user_auth_id
    ) );
    echo "<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"margin-top: 10px; margin-bottom: 10px;\">";
    while ( !$characters->EOF )
    {
        if ( $characters->fields[3] < $reset_resets_need )
        {
            $lacking_error = "<span class=\"iR_func_status_lacking\">".str_replace( "{resets}", $reset_resets_need - $characters->fields[3], text_resetstats_t7 )."</span>";
        }
        else
        {
            $lacking_error = "<input type=\"button\" value=\"".button_reset_stats."\" onclick=\"ask_url('".text_resetstats_t6."','".$core_run_script."&sid=".$characters->fields[0]."');\">";
        }
        echo " \r\n\t\t<tr>\r\n    \t\t<td width=\"66\" rowspan=\"2\"><img src=\"template/".$core['config']['template']."/images/class/".decode_class( $characters->fields[2], "2" )."\" width=\"66\" height=\"66\" title=\"Class\"></td>\r\n     \t\t<td align=\"left\" class=\"iR_name\" width=\"100\">".htmlentities( $characters->fields[1] )."</td>\r\n    \t\t<td class=\"iR_stats\" align=\"left\">Resets: ".$characters->fields[3]."</td>\r\n  \t\t</tr>\r\n \t\t <tr>\r\n    \t\t<td algin=\"left\" class=\"iR_class\">".decode_class( $characters->fields[2] )."</td>\r\n    \t\t<td  class=\"iR_func_status\" align=\"left\">".$lacking_error."</td>\r\n  \t\t</tr>\r\n    \t  <tr>\r\n   \t\t\t <td colspan=\"3\" class=\"iRg_line_top\">&nbsp;</td>\r\n \t\t </tr>\r\n  \t\t\t\t";
        $characters->MoveNext( );
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