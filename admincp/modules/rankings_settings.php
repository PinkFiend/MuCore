<?
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
    if (empty($_POST['cron_job_1']) || empty($_POST['cron_job_2']) || empty($_POST['cron_job_3']) || empty($_POST['char_top']) || empty($_POST['guild_top'])) {
        echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
    } else {
        $save_1 = new_config_xml('../engine/config_mods/rankings_settings', 'cron_job_1', '' . safe_input($_POST['cron_job_1'], '') . '');
        $save_2 = new_config_xml('../engine/config_mods/rankings_settings', 'cron_job_2', '' . safe_input($_POST['cron_job_2'], '') . '');
        $save_3 = new_config_xml('../engine/config_mods/rankings_settings', 'cron_job_3', '' . safe_input($_POST['cron_job_3'], '') . '');
        $save_4 = new_config_xml('../engine/config_mods/rankings_settings', 'char_top', '' . safe_input($_POST['char_top'], '') . '');
        $save_5 = new_config_xml('../engine/config_mods/rankings_settings', 'guild_top', '' . safe_input($_POST['guild_top'], '') . '');
        $save_6 = new_config_xml('../engine/config_mods/rankings_settings', 'gm', '' . safe_input($_POST['gm'], '') . '');
        $save_7 = new_config_xml('../engine/config_mods/rankings_settings', 'char_status', '' . safe_input($_POST['char_status'], '') . '');
        $save_8 = new_config_xml('../engine/config_mods/rankings_settings', 'location', '' . safe_input($_POST['location'], '') . '');
        $save_8 = new_config_xml('../engine/config_mods/rankings_settings', 'hide_stats', '' . safe_input($_POST['hide_stats'], '') . '');
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=rankings_settings');
    }
    
    
    
    
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/rankings_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/rankings_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Rankings Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Rankings are active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Rankings Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Rankings are inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Rankings On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Rankings Settings</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Cron Job ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Set cron job id for all characters rankings.<br>
Set cron job id for all characters rankings. (class filter).<br>
Set cron job id for guild rankings<br><br>
<a href="index.php?get=cron_jobs">view cron jobs list</a></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->cron_job_1 . '" name="cron_job_1"><br>
<input type="text" value="' . $get_config->cron_job_2 . '" name="cron_job_2"><br>
<input type="text" value="' . $get_config->cron_job_3 . '" name="cron_job_3"><br>
</td>
</tr>



<tr>
<td align="left" class="panel_title_sub" colspan="2">Characters Top</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set top for characters rankings.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" value="' . $get_config->char_top . '" name="char_top">
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Guilds Top</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set top for guilds rankings.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" value="' . $get_config->char_top . '" name="guild_top">
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Game Masters Tops</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' Game Masters will show on top.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->gm) {
        case '0':
            echo '<label><input type="radio" name="gm" value="1">Yes</label> <label><input type="radio" name="gm" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="gm" value="1" checked="checked">Yes</label> <label><input type="radio" name="gm" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Status Check</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' users will be able to check character status.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->char_status) {
        case '0':
            echo '<label><input type="radio" name="char_status" value="1">Yes</label> <label><input type="radio" name="char_status" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="char_status" value="1" checked="checked">Yes</label> <label><input type="radio" name="char_status" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Location Check</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' users will be able to check character location.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->location) {
        case '0':
            echo '<label><input type="radio" name="location" value="1">Yes</label> <label><input type="radio" name="location" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="location" value="1" checked="checked">Yes</label> <label><input type="radio" name="location" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Hide Stats</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">When \'Yes\' characters stats will not be displayed.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    switch ($get_config->hide_stats) {
        case '0':
            echo '<label><input type="radio" name="hide_stats" value="1">Yes</label> <label><input type="radio" name="hide_stats" checked="checked" value="0">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="hide_stats" value="1" checked="checked">Yes</label> <label><input type="radio" name="hide_stats" value="0">No</label>';
            break;
    }
    echo '
</td>
</tr>


<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>
';
    
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