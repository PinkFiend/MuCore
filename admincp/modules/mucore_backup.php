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
if (isset($_POST['backup'])) {
    if (is_dir('../mucore_backup')) {
        if (substr(decoct(fileperms('../mucore_backup')), 2) == '777') {
            $folder_name = 'backup_' . date('d.m.Y_H.i.s');
            $create_dir  = mkdir("../mucore_backup/$folder_name", 0777);
            
            //Create dir mucore_backup/backup_file/engine
            $create_dir = mkdir("../mucore_backup/$folder_name/engine", 0777);
            
            //Copy engine/config_mods
            full_copy('../engine/config_mods', "../mucore_backup/$folder_name/engine/config_mods");
            
            //Copy engine/variables_mods
            full_copy('../engine/variables_mods', "../mucore_backup/$folder_name/engine/variables_mods");
            
            //Copy engine/cms_data
            full_copy('../engine/cms_data', "../mucore_backup/$folder_name/engine/cms_data");
            
            //Copy engine/gm.users
            full_copy('../engine/gm.users', "../mucore_backup/$folder_name/engine/gm.users");
            
            //Copy engine/cache
            full_copy('../engine/cache', "../mucore_backup/$folder_name/engine/cache");
            
            
            //Copy engine/logs
            full_copy('../engine/logs', "../mucore_backup/$folder_name/engine/logs");
            
            //Copy engine/needed files
            $engine_files = array(
                'announcement_config.php',
                'custom_variables.php',
                'filter_ip.php',
                'global_cms.php',
                'global_config.php',
                'style_cms.php'
            );
            
            foreach ($engine_files as $engine_file) {
                full_copy("../engine/$engine_file", "../mucore_backup/$folder_name/engine/$engine_file");
            }
            
            echo notice_message_admin('Backup successfully saved', 1, 0, 'index.php?get=mucore_backup');
            
            
        } else {
            echo notice_message_admin('Unable to create backup, reason: <b>mucore_backup</b> folder don\'t have full permission to be writed.', '0', '1', '0');
        }
        
    } else {
        echo notice_message_admin('Unable to create backup, reason: <b>mucore_backup</b> folder not found.', '0', '1', '0');
    }
    
} else {
    echo '
        
<form action="" name="form_c" method="POST">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">MUCore DB Backup</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Backup</td>
</tr>

<tr>
<td align="left" class="panel_buttons">All backups are saved on mucore root/<b>mucore_backup</b> folder.<br><br>backup folder name format: <b>backup_date_time</b></td>
<td align="right" class="panel_buttons">
<input type="hidden" name="backup">
<input type="submit" value="Create Backup" onclick="return ask_form(\'Are you sure you want to create backup now?\')"></td>
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