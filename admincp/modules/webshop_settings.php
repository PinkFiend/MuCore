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
if (isset($_POST['save_settings'])) {
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'columns', safe_input($_POST['columns'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'display_class', safe_input($_POST['display_class'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'limit_level', safe_input($_POST['limit_level'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'limit_option', safe_input($_POST['limit_option'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'limit_exc_option', safe_input($_POST['limit_exc_option'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_level', safe_input($_POST['credits_level'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_luck', safe_input($_POST['credits_luck'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_skill', safe_input($_POST['credits_skill'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_option', safe_input($_POST['credits_option'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_ancient1', safe_input($_POST['credits_ancient1'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_ancient2', safe_input($_POST['credits_ancient2'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_refined', safe_input($_POST['credits_refined'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_harmony', safe_input($_POST['credits_harmony'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_weapon1', safe_input($_POST['credits_weapon1'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_weapon2', safe_input($_POST['credits_weapon2'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_weapon3', safe_input($_POST['credits_weapon3'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_weapon4', safe_input($_POST['credits_weapon4'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_weapon5', safe_input($_POST['credits_weapon5'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_weapon6', safe_input($_POST['credits_weapon6'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_armor1', safe_input($_POST['credits_armor1'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_armor2', safe_input($_POST['credits_armor2'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_armor3', safe_input($_POST['credits_armor3'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_armor4', safe_input($_POST['credits_armor4'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_armor5', safe_input($_POST['credits_armor5'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_armor6', safe_input($_POST['credits_armor6'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_wing1', safe_input($_POST['credits_wing1'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_wing2', safe_input($_POST['credits_wing2'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_wing3', safe_input($_POST['credits_wing3'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_wing4', safe_input($_POST['credits_wing4'], ''));
    $save = new_config_xml('../engine/config_mods/webshop_settings', 'credits_wing5', safe_input($_POST['credits_wing5'], ''));
    
    echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=webshop_settings');
    
} else {
    if (isset($_POST['module_active'])) {
        $save_status = new_config_xml('../engine/config_mods/webshop_settings', 'active', safe_input($_POST['module_active'], ''));
    }
    $get_config = simplexml_load_file('../engine/config_mods/webshop_settings.xml');
    echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Webshop Settings</td>
</tr>
<tr>';
    if ($get_config->active == '1') {
        echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Webshop is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Webshop Off"><input type="hidden" name="module_active" value="0">';
        
        
    } elseif ($get_config->active == '0') {
        echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Webshop is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Webshop On"><input type="hidden" name="module_active" value="1">';
    }
    echo '</td>
</tr>
</table>
</form>';
    
    echo '<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Display Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Columns</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Set how many columns with items you want to be displayed on webshop.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->columns . '" name="columns"><br>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Class Requirement</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">If \'Yes\' class requirement will be displayed on item infos.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
';
    switch ($get_config->display_class) {
        case '0':
            echo '<label><input type="radio" name="display_class" value="1">Yes</label> <label><input type="radio" name="display_class" value="0" checked="checked">No</label>';
            break;
        case '1':
            echo '<label><input type="radio" name="display_class" value="1" checked="checked">Yes</label> <label><input type="radio" name="display_class" value="0">No</label>';
            break;
    }
    
    echo '
</td>
</tr>


<tr>
 <td align="center" class="panel_title" colspan="2">Item Limits Settings</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Level</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Item\'s level limit.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->limit_level . '" name="limit_level"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Options</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Item\'s options limit.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->limit_option . '" name="limit_option"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Excelent Options</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Item\'s excelent options limit.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->limit_exc_option . '" name="limit_exc_option"><br>
</td>
</tr>


<tr>
 <td align="center" class="panel_title" colspan="2">Credits Cost Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Level</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits per item level.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->credits_level . '" name="credits_level"><br>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Luck</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for item\'s luck option.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->credits_luck . '" name="credits_luck"><br>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Skill</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for item\'s skill option.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->credits_skill . '" name="credits_skill"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Option</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits per item option.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->credits_option . '" name="credits_option"><br>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Ancient I, Ancient II</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credit cost for both ancient options.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
Ancient I: <input type="text" value="' . $get_config->credits_ancient1 . '" name="credits_ancient1" size="3"><br>
Ancient II: <input type="text" value="' . $get_config->credits_ancient2 . '" name="credits_ancient2" size="3"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Refined</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for item\'s refined option.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->credits_refined . '" name="credits_refined"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Harmony</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for item\'s harmony option.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->credits_harmony . '" name="credits_harmony"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Weapon Options</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for weapon options.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
Option 1: <input type="text" value="' . $get_config->credits_weapon1 . '" name="credits_weapon1" size="3"><br>
Option 2: <input type="text" value="' . $get_config->credits_weapon2 . '" name="credits_weapon2" size="3"><br>
Option 3: <input type="text" value="' . $get_config->credits_weapon3 . '" name="credits_weapon3" size="3"><br>
Option 4: <input type="text" value="' . $get_config->credits_weapon4 . '" name="credits_weapon4" size="3"><br>
Option 5: <input type="text" value="' . $get_config->credits_weapon5 . '" name="credits_weapon5" size="3"><br>
Option 6: <input type="text" value="' . $get_config->credits_weapon6 . '" name="credits_weapon6" size="3"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Armor Options</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for armor options.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
Option 1: <input type="text" value="' . $get_config->credits_armor1 . '" name="credits_armor1" size="3"><br>
Option 2: <input type="text" value="' . $get_config->credits_armor2 . '" name="credits_armor2" size="3"><br>
Option 3: <input type="text" value="' . $get_config->credits_armor3 . '" name="credits_armor3" size="3"><br>
Option 4: <input type="text" value="' . $get_config->credits_armor4 . '" name="credits_armor4" size="3"><br>
Option 5: <input type="text" value="' . $get_config->credits_armor5 . '" name="credits_armor5" size="3"><br>
Option 6: <input type="text" value="' . $get_config->credits_armor6 . '" name="credits_armor6" size="3"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Wings Options</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Credits for wing options.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
Option 1: <input type="text" value="' . $get_config->credits_wing1 . '" name="credits_wing1" size="3"><br>
Option 2: <input type="text" value="' . $get_config->credits_wing2 . '" name="credits_wing2" size="3"><br>
Option 3: <input type="text" value="' . $get_config->credits_wing3 . '" name="credits_wing3" size="3"><br>
Option 4: <input type="text" value="' . $get_config->credits_wing4 . '" name="credits_wing4" size="3"><br>
Option 5: <input type="text" value="' . $get_config->credits_wing5 . '" name="credits_wing5" size="3"><br>
</td>
</tr>

<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="save_settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>';
    
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