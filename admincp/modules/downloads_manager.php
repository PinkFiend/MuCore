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
if (isset($_GET['mod'])) {
    if ($_GET['mod'] == 'add_download') {
        if (isset($_POST['add_download'])) {
            if (empty($_POST['d_cat']) || empty($_POST['d_title']) || empty($_POST['d_url'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $d_desc = str_replace("\r", "", $_POST['d_desc']);
                $d_desc = str_replace("\n", "", $d_desc);
                $d_desc = str_replace("\r\n", "", $d_desc);
                $d_desc = str_replace("¦", "", $d_desc);
                
                $db = fopen("../engine/variables_mods/downloads.tDB", "a+");
                fwrite($db, uniqid() . "¦" . $_POST['d_active'] . "¦" . $_POST['d_cat'] . "¦" . str_replace("¦", "", stripslashes($_POST['d_title'])) . "¦" . stripslashes($d_desc) . "¦" . $_POST['d_url'] . "¦\n");
                fclose($db);
                echo notice_message_admin('Download successfully added', 1, 0, 'index.php?get=downloads_manager');
            }
            
        } else {
            echo '<form action="" method="POST" name="download">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add Download</td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Category</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Select cataegory.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="d_cat">
    <option value="0" selected="selected">Choose category</option>
        <optgroup label="---------------">';
            foreach ($downloads_cat as $cat_id => $cat) {
                if ($_GET['cat'] == $cat_id) {
                    echo '<option value="' . $cat_id . '" selected="selected">' . $cat . '</option>';
                } else {
                    echo '<option value="' . $cat_id . '">' . $cat . '</option>';
                }
            }
            
            echo '</select></td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Download Title that will appear on downloads.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="d_title" ></td>
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">URL</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Download url.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="d_url" ></td>
    </tr>
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' this download will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%"><label><input type="radio" name="d_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="d_active" value="0">No</label></td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Description</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Download description that will appear on download.</td>
    <td align="left" class="panel_text_alt2" width="50%"><textarea cols="40" rows="3" name="d_desc"></textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="add_download">
    <input type="submit" value="Add Download"></td>
    </tr>
    
    </table>
    </form>';
        }
        
    } elseif ($_GET['mod'] == 'edit_download') {
        $p_id   = safe_input(xss_clean($_GET['id']), '_');
        $p_file = file('../engine/variables_mods/downloads.tDB');
        foreach ($p_file as $check_id) {
            $check_id = explode("¦", $check_id);
            if ($check_id[0] == $p_id) {
                $d_title  = $check_id[3];
                $d_desc   = $check_id[4];
                $d_url    = $check_id[5];
                $d_active = $check_id[1];
                $d_cat    = $check_id[2];
                $d_id     = $check_id[0];
                break;
            }
        }
        if (isset($_POST['edit_download'])) {
            if (empty($_POST['d_cat']) || empty($_POST['d_title']) || empty($_POST['d_url'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $d_desc = str_replace("\r", "", $_POST['d_desc']);
                $d_desc = str_replace("\n", "", $d_desc);
                $d_desc = str_replace("\r\n", "", $d_desc);
                $d_desc = str_replace("¦", "", $d_desc);
                
                $old_db = file("../engine/variables_mods/downloads.tDB");
                $new_db = fopen("../engine/variables_mods/downloads.tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($p_id != $old_db_arr[0]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $d_id . "¦" . $_POST['d_active'] . "¦" . $_POST['d_cat'] . "¦" . str_replace("¦", "", stripslashes($_POST['d_title'])) . "¦" . stripslashes($d_desc) . "¦" . $_POST['d_url'] . "¦\n");
                    }
                }
                fclose($new_db);
                echo notice_message_admin('Download successfully edited', 1, 0, 'index.php?get=downloads_manager');
            }
            
        } else {
            echo '<form action="" method="POST" name="download">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Download</td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Category</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Select cataegory.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="d_cat">
    <option value="0" selected="selected">Choose category</option>
        <optgroup label="---------------">';
            foreach ($downloads_cat as $cat_id => $cat) {
                if ($d_cat == $cat_id) {
                    echo '<option value="' . $cat_id . '" selected="selected">' . $cat . '</option>';
                } else {
                    echo '<option value="' . $cat_id . '">' . $cat . '</option>';
                }
            }
            
            echo '</select></td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Download Title that will appear on downloads.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="d_title" value="' . $d_title . '"></td>
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">URL</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Download url.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="d_url" value="' . $d_url . '"></td>
    </tr>
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' this download will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%">';
            switch ($d_active) {
                case '0':
                    echo '<label><input type="radio" name="d_active" value="1">Yes</label> <label><input type="radio" name="d_active" value="0" checked="checked">No</label>';
                    break;
                case '1':
                    echo '<label><input type="radio" name="d_active" value="1" checked="checked">Yes</label> <label><input type="radio" name="d_active" value="0">No</label>';
                    break;
            }
            echo '</td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Description</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Download description that will appear on download.</td>
    <td align="left" class="panel_text_alt2" width="50%"><textarea cols="40" rows="3" name="d_desc">' . $d_desc . '</textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit_download">
    <input type="submit" value="Edit Download"></td>
    </tr>
    
    </table>
    </form>';
        }
        
    }
    
} else {
    if (isset($_GET['delete_download'])) {
        if (empty($_GET['delete_download'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=downloads_manager');
        } else {
            $p_id   = safe_input(xss_clean($_GET['delete_download']), '_');
            $p_file = file('../engine/variables_mods/downloads.tDB');
            foreach ($p_file as $check_id) {
                $check_id = explode("¦", $check_id);
                if ($check_id[0] == $p_id) {
                    $p_id_found = '1';
                    break;
                }
            }
            if ($p_id_found != '1') {
                echo notice_message_admin('Download with ID: <b>' . $p_id . '</b> does not exist.', '0', '1', '0');
            } else {
                delete_variable('../engine/variables_mods/downloads.tDB', '0', $p_id, '¦');
                echo notice_message_admin('Download successfully deleted', 1, 0, 'index.php?get=downloads_manager');
            }
        }
        
        
    } else {
        if (isset($_POST['module_active'])) {
            $save_status = new_config_xml('../engine/config_mods/downloads_settings', 'active', safe_input($_POST['module_active'], ''));
        }
        $get_config = simplexml_load_file('../engine/config_mods/downloads_settings.xml');
        echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Downloads Settings</td>
</tr>
<tr>';
        if ($get_config->active == '1') {
            echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Downloads are active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Downloads Off"><input type="hidden" name="module_active" value="0">';
            
            
        } elseif ($get_config->active == '0') {
            echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Downloads are inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Downloads On"><input type="hidden" name="module_active" value="1">';
        }
        echo '</td>
</tr>
</table>
</form>';
        
        $downloads_file = file('../engine/variables_mods/downloads.tDB');
        $count          = 0;
        foreach ($downloads_cat as $download_id => $download_cat) {
            echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="5">Downloads (' . $download_cat . ')</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Download URL</td>

<td align="left" class="panel_title_sub2">Status</td>
<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
            
            foreach ($downloads_file as $download) {
                $download = explode("¦", $download);
                if ($download[2] == $download_id) {
                    $count++;
                    $tr_color    = ($count % 2) ? '' : 'even';
                    $download[3] = strlen($download[3]) > 28 ? substr($download[3], 0, 28) . "..." : $download[3];
                    $download[5] = strlen($download[5]) > 78 ? substr($download[5], 0, 78) . "..." : $download[5];
                    echo '
                    <tr class="' . $tr_color . '">
                    <td align="left" class="panel_text_alt_list"><strong>' . $download[3] . '</strong></td>
                    <td align="left" class="panel_text_alt_list">' . $download[5] . '</td>
            
                    <td align="left" class="panel_text_alt_list" width="50"><strong>';
                    switch ($download[1]) {
                        case '1':
                            echo 'Active';
                            break;
                        case '0':
                            echo 'Inactive';
                            break;
                    }
                    echo '</strong></td>
            <td align="left" class="panel_text_alt_list" width="80"><a href="index.php?get=downloads_manager&mod=edit_download&id=' . $download[0] . '">[Edit]</a> / <a href="javascript:;" onclick="ask_url(\'Are you sure you want to delete this download?\',\'index.php?get=downloads_manager&delete_download=' . $download[0] . '\')";>[Delete]</a></td></tr>
            ';
                    
                }
            }
            echo '<tr>
<td align="center" class="panel_buttons" colspan="5">
<input type="button" value="Add Download" onclick="location.href=\'index.php?get=downloads_manager&mod=add_download&cat=' . $download_id . '\'"></td>
</tr>
</table>';
            
        }
        
        
        
        
        
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