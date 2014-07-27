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
    if ($_GET['mod'] == 'new') {
        if (isset($_POST['new'])) {
            if (empty($_POST['ann_title']) || empty($_POST['ann_expire']) || empty($_POST['ann_content'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $ann_content = str_replace("\r", "", $_POST['ann_content']);
                $ann_content = str_replace("\n", "", $ann_content);
                $ann_content = str_replace("\r\n", "", $ann_content);
                $ann_content = str_replace("¦", "", $ann_content);
                
                if (substr($ann_content, 0, 3) == '<p>') {
                    $ann_content = substr_replace($ann_content, "", 0, 3);
                }
                
                $db = fopen("../engine/variables_mods/announcements.tDB", "a+");
                fwrite($db, uniqid() . "¦" . str_replace("¦", "", stripslashes($_POST['ann_title'])) . "¦" . time() . "¦" . (time() + ($_POST['ann_expire'] * 86400)) . "¦" . stripslashes($ann_content) . "¦\n");
                fclose($db);
                echo notice_message_admin('Announcement successfully added', 1, 0, 'index.php?get=announcements_manager');
            }
            
        } else {
            echo '
    <!-- tinyMCE -->
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
     <td align="center" class="panel_title" colspan="2">Add Announcement</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Announcement Title that will appear on announcement.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="ann_title"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Expire</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set in how many days announcement will expire.</td>
    <td align="left" class="panel_text_alt2" width="50%">    <select name="ann_expire">
    <option value="0" selected="selected">Choose days</option>
        <optgroup label="---------------">
        <option value="1">1 day</option>
        ';
            $i = 1;
            while ($i <= 89) {
                $i++;
                echo '<option value="' . $i . '">' . $i . ' days</option>';
            }
            echo '
        

        
    </select></td
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Announcement Content</td>
    </tr>
    <tr>
    <td  class="panel_text_area" colspan="2" width="60%"><textarea id="ann_content" name="ann_content" rows="24" style="width: 100%;"></textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="new">
    <input type="submit" value="Post Announcement"></td>
    </tr>
    
    </table>
    </form>';
        }
        
    } elseif ($_GET['mod'] == 'edit') {
        $p_id   = safe_input(xss_clean($_GET['id']), '_');
        $p_file = file('../engine/variables_mods/announcements.tDB');
        foreach ($p_file as $check_id) {
            $check_id = explode("¦", $check_id);
            if ($check_id[0] == $p_id) {
                $p_id_found  = '1';
                $ann_id      = $check_id[0];
                $ann_title   = $check_id[1];
                $ann_date    = $check_id[2];
                $ann_expire  = $check_id[3];
                $ann_content = $check_id[4];
                break;
            }
        }
        if (isset($_POST['edit'])) {
            if (empty($_POST['ann_title']) || empty($_POST['ann_content'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $ann_content = str_replace("\r", "", $_POST['ann_content']);
                $ann_content = str_replace("\n", "", $ann_content);
                $ann_content = str_replace("\r\n", "", $ann_content);
                $ann_content = str_replace("¦", "", $ann_content);
                
                if (substr($ann_content, 0, 3) == '<p>') {
                    $ann_content = substr_replace($ann_content, "", 0, 3);
                }
                
                $old_db = file("../engine/variables_mods/announcements.tDB");
                $new_db = fopen("../engine/variables_mods/announcements.tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($p_id != $old_db_arr[0]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $ann_id . "¦" . str_replace("¦", "", stripslashes($_POST['ann_title'])) . "¦" . $ann_date . "¦" . $ann_expire . "¦" . stripslashes($ann_content) . "¦\n");
                    }
                }
                fclose($new_db);
                
                
                
                
                #delete_variable('../engine/variables_mods/news.tDB','0',$p_id,'¦');
                echo notice_message_admin('Announcement successfully edited', 1, 0, 'index.php?get=announcements_manager');
                
            }
            
        } else {
            echo '
    <!-- tinyMCE -->
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
     <td align="center" class="panel_title" colspan="2">Edit Announcement</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Announcement Title that will appear on announcement.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="ann_title" value="' . $ann_title . '"></td>
    </tr>
    

    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Announcement Content</td>
    </tr>
    <tr>
    <td  class="panel_text_area" colspan="2" width="60%"><textarea id="ann_content" name="ann_content" rows="24" style="width: 100%;">' . $ann_content . '</textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit">
    <input type="submit" value="Edit Announcement"></td>
    </tr>
    
    </table>
    </form>';
        }
        
    }
    
} else {
    if (isset($_GET['delete'])) {
        $p_id = safe_input(xss_clean($_GET['delete']), '_');
        delete_variable('../engine/variables_mods/announcements.tDB', '0', $p_id, '¦');
        echo notice_message_admin('Announcement successfully deleted', 1, 0, 'index.php?get=announcements_manager');
        
    } else {
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="4">Announcements</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Date</td>
<td align="left" class="panel_title_sub2">Expire</td>
<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
        $ann_file = array_reverse(file('../engine/variables_mods/announcements.tDB'));
        $count    = 0;
        foreach ($ann_file as $ann) {
            $ann = explode("¦", $ann);
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            if ($ann[3] < time()) {
                $expire = '<b>Expired</b>';
            } else {
                $expire = date('F j, Y / H:i', $ann[3]);
            }
            $ann[1] = strlen($ann[1]) > 78 ? substr($ann[1], 0, 78) . "..." : $ann[1];
            echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . $ann[1] . '</strong></td>
            <td align="left" class="panel_text_alt_list" width="150">' . date('F j, Y / H:i', $ann[2]) . '</td>
            <td align="left" class="panel_text_alt_list" width="150">' . $expire . '</td>
            <td align="left" class="panel_text_alt_list" width="80"><a href="index.php?get=announcements_manager&mod=edit&id=' . $ann[0] . '">[Edit]</a> / <a href="javascript:;" onclick="ask_url(\'Are you sure you want to delete this announcement?\',\'index.php?get=announcements_manager&delete=' . $ann[0] . '\')";>[Delete]</a></td>
            </tr>';
        }
        echo '<tr>
<td align="center" class="panel_buttons" colspan="4">
<input type="button" value="Post New Announcement" onclick="location.href=\'index.php?get=announcements_manager&mod=new\'"></td>
</tr></table>';
        
        
        
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