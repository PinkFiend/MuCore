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
$load_levelup_settings = simplexml_load_file( "engine/config_mods/add_points_settings.xml" );
$active = trim( $load_levelup_settings->active );
if ( $active == "0" )
{
    echo msg( "0", text_sorry_feature_disabled );
}
else
{
    $str_limit = trim( $load_levelup_settings->str_limit );
    $agi_limit = trim( $load_levelup_settings->agi_limit );
    $vit_limit = trim( $load_levelup_settings->vit_limit );
    $eng_limit = trim( $load_levelup_settings->eng_limit );
    $cmd_limit = trim( $load_levelup_settings->cmd_limit );
    if ( isset( $_POST['levelup_add'] ) )
    {
        echo "<div style=\"margin-top: 10px;\">";
        $id = safe_input( $_POST['levelup_id'], "" );
        $str = safe_input( $_POST['str'], "" );
        $agi = safe_input( $_POST['agi'], "" );
        $vit = safe_input( $_POST['vit'], "" );
        $eng = safe_input( $_POST['eng'], "" );
        $cmd = safe_input( $_POST['cmd'], "" );
        if ( empty( $str ) )
        {
            $str = "0";
        }
        if ( empty( $agi ) )
        {
            $agi = "0";
        }
        if ( empty( $vit ) )
        {
            $vit = "0";
        }
        if ( empty( $eng ) )
        {
            $eng = "0";
        }
        if ( empty( $cmd ) )
        {
            $cmd = "0";
        }
        if ( empty( $id ) || !is_numeric( $id ) || !is_numeric( $str ) || !is_numeric( $agi ) || !is_numeric( $vit ) || !is_numeric( $eng ) || !is_numeric( $cmd ) )
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
            echo msg( "0", text_points_t1 );
        }
        else
        {
            $select_points = $core_db->Execute( "Select LevelUpPoint,Strength,Dexterity,Vitality,Energy,Leadership from Character where mu_id=? and AccountID=?", array(
                $id,
                $user_auth_id
            ) );
            $total_amount_points = $str + $agi + $vit + $eng + $cmd;
            $new_levelup_points = $select_points->fields[0] - $total_amount_points;
            if ( $select_points->fields[0] < $total_amount_points )
            {
                echo msg( "0", text_points_t2 );
            }
            else
            {
                if ( isset( $_POST['str'] ) && $str_limit < $select_points->fields[1] + $str )
                {
                    echo msg( "0", str_replace( "{str_limit}", number_format( $str_limit ), text_points_t3 ) );
                    $no_points = 1;
                }
                if ( isset( $_POST['agi'] ) && $agi_limit < $select_points->fields[2] + $agi )
                {
                    echo msg( "0", str_replace( "{agi_limit}", number_format( $agi_limit ), text_points_t4 ) );
                    $no_points = 1;
                }
                if ( isset( $_POST['vit'] ) && $vit_limit < $select_points->fields[3] + $vit )
                {
                    echo msg( "0", str_replace( "{vit_limit}", number_format( $vit_limit ), text_points_t5 ) );
                    $no_points = 1;
                }
                if ( isset( $_POST['eng'] ) && $eng_limit < $select_points->fields[4] + $eng )
                {
                    echo msg( "0", str_replace( "{eng_limit}", number_format( $eng_limit ), text_points_t6 ) );
                    $no_points = 1;
                }
                if ( isset( $_POST['cmd'] ) && $cmd_limit < $select_points->fields[5] + $cmd )
                {
                    echo msg( "0", str_replace( "{cmd_limit}", number_format( $cmd_limit ), text_points_t7 ) );
                    $no_points = 1;
                }
                if ( $no_points != "1" )
                {
                    $update_points = $core_db->Execute( "Update Character set [LevelUpPoint]=?,[Strength]=Strength+?,[Dexterity]=Dexterity+?,[Vitality]=Vitality+?,[Energy]=Energy+?,[Leadership]=Leadership+? where mu_id=?", array(
                        $new_levelup_points,
                        $str,
                        $agi,
                        $vit,
                        $eng,
                        $cmd,
                        $id
                    ) );
                    if ( $update_points )
                    {
                        echo msg( "1", text_points_t8 );
                    }
                    else
                    {
                        echo msg( "0", text_points_t9 );
                    }
                }
            }
        }
        echo "</div>";
    }
    echo "<div style=\"margin-top: 20px;\">\n<fieldset><legend>".text_points_t12."</legend>\n<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"padding-left: 10px;\">\n<tr>\n<td align=\"left\" width=\"70\"><b>Strength:</b></td>\n<td align=\"left\">".number_format( $str_limit )."</td>\n</tr>\n<tr>\n<td align=\"left\"><b>Agility:</b></td>\n<td align=\"left\">".number_format( $agi_limit )."</td>\n</tr>\n<tr>\n<td align=\"left\"><b>Vitlaity:</b></td>\n<td align=\"left\">".number_format( $vit_limit )."</td>\n</tr>\n<tr>\n<td align=\"left\"><b>Energy:</b></td>\n<td align=\"left\">".number_format( $eng_limit )."</td>\n</tr>\n<tr>\n<td align=\"left\"><b>Command:</b></td>\n<td align=\"left\">".number_format( $cmd_limit )."</td>\n</tr>\n</table>\n</fieldset>\n</div>";
    $select_characters = $core_db->Execute( "Select mu_id,Name,Class,LevelUpPoint,Strength,Dexterity,Vitality,Energy,Leadership from Character where AccountID=? order by LevelUpPoint desc ", array(
        $user_auth_id
    ) );
    echo "<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\" style=\"margin-top: 10px; margin-bottom: 10px;\">";
    $count_points = 0;
    while ( !$select_characters->EOF )
    {
        ++$count_points;
        if ( $select_characters->fields[3] <= "0" )
        {
            $lacking_error = "<span class=\"iR_func_status_lacking\">".text_points_t10."</span>";
        }
        else
        {
            $lacking_error = "<input type=\"submit\" value=\"".button_add_points."\">";
        }
        echo "\n\t<form action=\"\" method=\"POST\" name=\"levelup_points_".$count_points."\">\n<tr>\n    <td width=\"71\" rowspan=\"7\" width=\"66\" valign=\"top\"><img src=\"template/".$core['config']['template']."/images/class/".decode_class( $select_characters->fields[2], "2" )."\" width=\"66\" height=\"66\" title=\"Class\"></td>\n\t<td align=\"left\" class=\"iR_name\" width=\"100\">".htmlentities( $select_characters->fields[1] )."<input type=\"hidden\" name=\"levelup_id\" value=\"".$select_characters->fields[0]."\"><input type=\"hidden\" name=\"levelup_add\"></td>\n    <td colspan=\"2\" align=\"left\" class=\"iR_stats_2\"><b>Levelup Points: ".number_format( $select_characters->fields[3] )."</b></td>\n  </tr>\n  <tr>\n    <td class=\"iR_class\" width=\"100\">".decode_class( $select_characters->fields[2] )."</td>\n    <td align=\"left\" class=\"iR_stats\" width=\"200\">Strength: ".number_format( fix_negative( $select_characters->fields[4] ) )."</td>\n    <td align=\"left\" class=\"iR_stats\">";
        if ( $str_limit <= fix_negative( $select_characters->fields[4] ) )
        {
            echo "".text_points_t11."";
        }
        else
        {
            echo "<input type=\"text\" maxlength=\"5\" class=\"iRg_input\" name=\"str\">";
        }
        echo "</td>\n  </tr>\n  <tr>\n    <td rowspan=\"5\">&nbsp;</td>\n    <td align=\"left\" class=\"iR_stats\">Agility: ".number_format( fix_negative( $select_characters->fields[5] ) )."</td>\n    <td align=\"left\" class=\"iR_stats\">";
        if ( $str_limit <= fix_negative( $select_characters->fields[5] ) )
        {
            echo "".text_points_t11."";
        }
        else
        {
            echo "<input type=\"text\" maxlength=\"5\" class=\"iRg_input\" name=\"agi\">";
        }
        echo "</td>\n  </tr>\n  <tr>\n    <td align=\"left\" class=\"iR_stats\">Vitality: ".number_format( fix_negative( $select_characters->fields[6] ) )."</td>\n    <td align=\"left\" class=\"iR_stats\">";
        if ( $str_limit <= fix_negative( $select_characters->fields[6] ) )
        {
            echo "".text_points_t11."";
        }
        else
        {
            echo "<input type=\"text\" maxlength=\"5\" class=\"iRg_input\" name=\"vit\">";
        }
        echo "</td>\n  </tr>\n  <tr>\n    <td align=\"left\" class=\"iR_stats\">Energy: ".number_format( fix_negative( $select_characters->fields[7] ) )."</td>\n    <td align=\"left\" class=\"iR_stats\">";
        if ( $str_limit <= fix_negative( $select_characters->fields[7] ) )
        {
            echo "".text_points_t11."";
        }
        else
        {
            echo "<input type=\"text\" maxlength=\"5\" class=\"iRg_input\" name=\"eng\">";
        }
        echo "</td>\n  </tr>";
        if ( in_array( $select_characters->fields[2], $darklord_classes_levelup ) )
        {
            echo " <tr>\n    <td align=\"left\" class=\"iR_stats\">Command: ".number_format( fix_negative( $select_characters->fields[8] ) )."</td>\n    <td align=\"left\" class=\"iR_stats\">";
            if ( $str_limit <= fix_negative( $select_characters->fields[8] ) )
            {
                echo "".text_points_t11."";
            }
            else
            {
                echo "<input type=\"text\" maxlength=\"5\" class=\"iRg_input\" name=\"cmd\">  Only for Dark Lord.";
            }
            echo "</td>\n  </tr>";
        }
        echo "\n  <tr>\n    <td>&nbsp;</td>\n    <td class=\"iR_func_status\" align=\"left\">".$lacking_error."</td>\n  </tr>\n   <tr>\n    <td colspan=\"4\" class=\"iRg_line_top\">&nbsp;</td>\n  </tr>\n  </form>\n  \n\t\n\t \n\t";
        $select_characters->MoveNext( );
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