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
if (isset($_GET['edit_module'])) {
    if ($_GET['m'] == '0') {
        $m_id        = safe_input(xss_clean($_GET['edit_module']), '_');
        $get_modules = file('../engine/cms_data/mods.cms');
        
        foreach ($get_modules as $module) {
            $module = explode("¦", $module);
            if ($module[0] == $m_id) {
                $found    = 1;
                $m_idd    = $module[0];
                $m_title  = $module[3];
                $m_active = $module[4];
                $m_type   = $module[1];
                break;
            }
        }
        
        if ($found == '1') {
            if (isset($_POST['edit_module'])) {
                if ($_POST['m_active'] == '0') {
                    $active = 'not_active';
                } elseif ($_POST['m_active'] == '1') {
                    $active = 'active';
                }
                if ($_POST['m_type'] == '0') {
                    $type = 'template_module';
                }
                if (empty($_POST['m_title']) || empty($active) || empty($_POST['m_content']) || empty($type)) {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    $m_title_edit  = safe_input($_POST['m_title'], '\_\.\-\ ');
                    $m_active_edit = safe_input($_POST['m_active'], '');
                    $m_type_edit   = safe_input($_POST['m_type'], '');
                    
                    
                    $old_db = file("../engine/cms_data/mods.cms");
                    $new_db = fopen("../engine/cms_data/mods.cms", "w");
                    foreach ($old_db as $old_db_line) {
                        $old_db_arr = explode("¦", $old_db_line);
                        if (safe_input(xss_clean($_GET['edit_module']), '_') != $old_db_arr[0]) {
                            fwrite($new_db, "$old_db_line");
                        } else {
                            fwrite($new_db, $m_id . "¦" . $m_type_edit . "¦template_module¦" . $m_title_edit . "¦" . $m_active_edit . "¦\n");
                        }
                    }
                    fclose($new_db);
                    
                    $cms_content = $_POST['m_content'];
                    if (substr($cms_content, 0, 3) == '<p>') {
                        $cms_content = substr_replace($cms_content, "", 0, 3);
                    }
                    $edit_cms = fopen('../engine/cms_data/cms_co/' . $m_id . '_cms.cms', "w");
                    fwrite($edit_cms, str_replace("<?", "", str_replace("?>", "", $cms_content)));
                    fclose($edit_cms);
                    
                    echo notice_message_admin('Template Module successfully edited', 1, 0, 'index.php?get=edit_modules');
                    
                    
                }
                
            } else {
                echo '<!-- tinyMCE -->
    <script language="javascript" type="text/javascript" src="script/tiny_mce/tiny_mce.js"></script>
    <script language="javascript" type="text/javascript">
        // Notice: The simple theme does not use all options some of them are limited to the advanced theme
        tinyMCE.init({
            mode : "textareas",
            theme : "advanced",
            theme_advanced_buttons2_add : "forecolor",
               theme_advanced_buttons1_add : "fontselect,fontsizeselect"
        });
    </script>
    
    <form action="" method="POST" name="module">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Template Module</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Module Title that will appear on module list.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="m_title" value="' . $m_title . '"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' module will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    
    ';
                switch ($m_active) {
                    case '0':
                        echo '<label><input type="radio" name="m_active" value="1">Yes</label> <label><input type="radio" name="m_active" checked="checked" value="0">No';
                        break;
                    case '1':
                        echo '<label><input type="radio" name="m_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="m_active" value="0">No</label>';
                        break;
                }
                echo '</td
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Content</td>
    </tr>
    <tr>
    <td  class="panel_text_area" colspan="2" width="60%"><textarea id="m_content" name="m_content" rows="24" style="width: 100%;">
    ';
                include('../engine/cms_data/cms_co/' . $m_idd . '_cms.cms');
                echo '</textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="m_type" value="' . $m_type . '">
    <input type="hidden" name="edit_module">
    <input type="submit" value="Edit Module"></td>
    </tr>
    
    </table>
    </form>';
                
            }
        } else {
            echo notice_message_admin('Module could not be found.', '0', '1', '0');
        }
        
        
    } elseif ($_GET['m'] == '1') {
        $m_id        = safe_input(xss_clean($_GET['edit_module']), '_');
        $get_modules = file('../engine/cms_data/mods.cms');
        foreach ($get_modules as $module) {
            $module = explode("¦", $module);
            if ($module[0] == $m_id) {
                $found    = 1;
                $m_idd    = $module[0];
                $m_title  = $module[3];
                $m_active = $module[4];
                $m_type   = $module[1];
                $m_file   = $module[2];
                break;
            }
            
        }
        
        if ($found == '1') {
            if (isset($_POST['edit_module'])) {
                if ($_POST['m_active'] == '0') {
                    $active = 'not_active';
                } elseif ($_POST['m_active'] == '1') {
                    $active = 'active';
                }
                if (empty($_POST['m_title']) || empty($active) || empty($_POST['m_file']) || empty($_POST['m_type'])) {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    $m_title_edit  = safe_input($_POST['m_title'], '\_\.\-\ ');
                    $m_active_edit = safe_input($_POST['m_active'], '');
                    $m_file_edit   = safe_input($_POST['m_file'], '\_\.\-\ ');
                    $m_type_edit   = safe_input($_POST['m_type'], '');
                    
                    $old_db = file("../engine/cms_data/mods.cms");
                    $new_db = fopen("../engine/cms_data/mods.cms", "w");
                    foreach ($old_db as $old_db_line) {
                        $old_db_arr = explode("¦", $old_db_line);
                        if (safe_input(xss_clean($_GET['edit_module']), '_') != $old_db_arr[0]) {
                            fwrite($new_db, "$old_db_line");
                        } else {
                            fwrite($new_db, $m_id . "¦" . $m_type_edit . "¦" . $m_file_edit . "¦" . $m_title_edit . "¦" . $m_active_edit . "¦\n");
                        }
                    }
                    fclose($new_db);
                    
                    echo notice_message_admin('PHP File Module successfully edited', 1, 0, 'index.php?get=edit_modules#' . $m_idd . '');
                }
                
                
            } else {
                echo '<form action="" method="POST" name="module">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Edit PHP File Module</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Module Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Module Title that will appear on module list.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="m_title" value="' . $m_title . '"></td>
</tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' module will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    
    ';
                switch ($m_active) {
                    case '0':
                        echo '<label><input type="radio" name="m_active" value="1">Yes</label> <label><input type="radio" name="m_active" checked="checked" value="0">No</label>';
                        break;
                    case '1':
                        echo '<label><input type="radio" name="m_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="m_active" value="0">No</label>';
                        break;
                }
                echo '</td
    </tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Module PHP File</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Choose PHP file you want to include.</td>
<td align="left" class="panel_text_alt2" width="50%">
<select name="m_file">
<option value="0">Choose a File</option>
        <optgroup label="---------------">

';
                $directory = opendir('../pages_modules');
                while ($modfile = readdir($directory)) {
                    if (ereg('[^.]+', $modfile) AND $modfile != 'index.html') {
                        if ($m_file == $modfile) {
                            echo '<option value="' . $modfile . '" selected="selected">' . $modfile . '</option>';
                        } else {
                            echo '<option value="' . $modfile . '">' . $modfile . '</option>';
                        }
                        
                    }
                }
                
                echo '</select></td>
</tr>


<tr>
<td align="center" class="panel_buttons" colspan="2">
<input type="hidden" name="m_type" value="' . $m_type . '">
<input type="hidden" name="edit_module">
<input type="submit" value="Edit Module"></td>
</tr>

</table>
</form>';
            }
        } else {
            echo notice_message_admin('Module could not be found.', '0', '1', '0');
        }
        
    }
} else {
    if (isset($_GET['delete_module'])) {
        if (empty($_GET['delete_module'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=edit_modules');
        } else {
            $p_id   = safe_input(xss_clean($_GET['delete_module']), '_');
            $p_file = file('../engine/cms_data/mods.cms');
            foreach ($p_file as $check_id) {
                $check_id = explode("¦", $check_id);
                if ($check_id[0] == $p_id) {
                    $p_id_found = '1';
                    break;
                }
            }
            if ($p_id_found != '1') {
                echo notice_message_admin('Module with ID: <b>' . $p_id . '</b> does not exist.', '0', '1', '0');
            } else {
                $new_db = fopen("../engine/cms_data/mods.cms", "w");
                foreach ($p_file as $new_db_line) {
                    $db_line = explode("¦", $new_db_line);
                    if ($db_line[0] != $p_id) {
                        fwrite($new_db, $new_db_line);
                        #echo $new_db_line;
                    }
                }
                fclose($new_db);
                echo notice_message_admin('Module successfully deleted', 1, 0, 'index.php?get=edit_modules');
            }
            
        }
        
    } else {
        echo '
<form action="" method="POST" name="save_order">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="5">Edit Modules</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Module Type</td>
<td align="left" class="panel_title_sub2">Status</td>
<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
        $get_modules = file('../engine/cms_data/mods.cms');
        $count       = 0;
        foreach ($get_modules as $module) {
            $module = explode("¦", $module);
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            echo '
    <tr class="' . $tr_color . '">
    <td align="left" class="panel_text_alt_list"><a name="' . $module[0] . '"></a><strong>' . $module[3] . '</strong></td>
    ';
            switch ($module[1]) {
                case '0':
                    echo '<td align="left" class="panel_text_alt_list">Template Module</td>';
                    $p_type    = 'Template Module';
                    $link_edit = 'index.php?get=edit_modules&m=0&edit_module=' . $module[0] . '';
                    break;
                case '1':
                    echo '<td align="left" class="panel_text_alt_list">PHP File Module (' . $module[2] . ')</td>';
                    $p_type    = 'PHP File Module';
                    $link_edit = 'index.php?get=edit_modules&m=1&edit_module=' . $module[0] . '';
                    break;
            }
            
            echo '<td align="left" class="panel_text_alt_list">';
            switch ($module[4]) {
                case '0':
                    echo '<em>Inactive</em>';
                    break;
                case '1':
                    echo '<b>Active</b>';
                    break;
            }
            echo '</td>';
            
            
            
            echo '<td align="left" class="panel_text_alt_list" width="80"><a href="' . $link_edit . '">[Edit]</a> / <a href="javascript:void(0);" onclick="ask_url(\'Delete ' . $p_type . ': ' . $module[3] . '?\',\'index.php?get=edit_modules&delete_module=' . $module[0] . '\')";>[Delete]</a></td>
    </tr>';
        }
        
        echo '
<tr>
<td align="center" class="panel_buttons" colspan="4">

<input type="hidden" name="save_order">
<input type="button" value="Add New Module" onclick="location.href=\'index.php?get=add_module\'"></td>
</tr>
</table>
</form>
';
        
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