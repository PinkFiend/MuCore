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
$author = $core['config']['admin_nick'];
if (isset($_GET['mod'])) {
    if ($_GET['mod'] == 'add_news') {
        if (isset($_POST['add_news'])) {
            if (empty($_POST['n_title']) || empty($_POST['n_new']) || empty($_POST['n_content'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $news_content = str_replace("\r", "", $_POST['n_content']);
                $news_content = str_replace("\n", "", $news_content);
                $news_content = str_replace("\r\n", "", $news_content);
                $news_content = str_replace("¦", "", $news_content);
                if (substr($news_content, 0, 3) == '<p>') {
                    $news_content = substr_replace($news_content, "", 0, 3);
                }
                
                
                $db = fopen("../engine/variables_mods/news.tDB", "a+");
                fwrite($db, uniqid() . "¦News¦" . str_replace("¦", "", stripslashes($_POST['n_title'])) . "¦" . stripslashes($news_content) . "¦" . time() . "¦" . $author . "¦" . (time() + ($_POST['n_new'] * 86400)) . "¦" . $_POST['n_active'] . "¦" . $_POST['n_archive'] . "¦\n");
                fclose($db);
                echo notice_message_admin('News successfully added', 1, 0, 'index.php?get=news_manager');
                
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
    
    <form action="" method="POST" name="news">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add News</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">News Title that will appear on news.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="n_title" size="40"></td>
    </tr>
    
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">New Notice</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set the number of days this news will show New Icon.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="n_new">
    <option value="0" selected="selected">Choose days</option>
        <optgroup label="---------------">
        <option value="1">1 day</option>
        ';
            $i = 1;
            while ($i <= 30) {
                $i++;
                echo '<option value="' . $i . '">' . $i . ' days</option>';
            }
            echo '
        

        
    </select></td
    </tr>
    
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">News Archive</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'Yes\' this news will moved to news archive.<br<br>Note: archived news are not displayed on news.</td>
    <td align="left" class="panel_text_alt2" width="50%"><label><input type="radio" name="n_archive" value="0">Yes</label> <label><input type="radio" name="n_archive" value="1" checked="checked">No</label></td
    </tr>
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' this news will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%"><label><input type="radio" name="n_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="n_active" value="0">No</label></td
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">News Content</td>
    </tr>
    <tr>
    <td  class="panel_text_area" colspan="2" width="60%"><textarea id="n_content" name="n_content" rows="24" style="width: 100%;"></textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="m_type" value="0">
    <input type="hidden" name="add_news">
    <input type="submit" value="Add News"></td>
    </tr>
    
    </table>
    </form>';
        }
        
    } elseif ($_GET['mod'] == 'edit_news') {
        $p_id   = safe_input(xss_clean($_GET['id']), '_');
        $p_file = file('../engine/variables_mods/news.tDB');
        foreach ($p_file as $check_id) {
            $check_id = explode("¦", $check_id);
            if ($check_id[0] == $p_id) {
                $p_id_found = '1';
                $n_id       = $check_id[0];
                $n_title    = $check_id[2];
                $n_content  = $check_id[3];
                $n_date     = $check_id[4];
                $n_author   = $check_id[5];
                $n_new      = $check_id[6];
                $n_active   = $check_id[7];
                $n_archive  = $check_id[8];
                break;
            }
        }
        if (isset($_POST['edit_news'])) {
            if (empty($_POST['n_title']) || empty($_POST['n_content'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $news_content = str_replace("\r", "", $_POST['n_content']);
                $news_content = str_replace("\n", "", $news_content);
                $news_content = str_replace("\r\n", "", $news_content);
                $news_content = str_replace("¦", "", $news_content);
                if (substr($news_content, 0, 3) == '<p>') {
                    $news_content = substr_replace($news_content, "", 0, 3);
                }
                
                
                $old_db = file("../engine/variables_mods/news.tDB");
                $new_db = fopen("../engine/variables_mods/news.tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($p_id != $old_db_arr[0]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $n_id . "¦News¦" . str_replace("¦", "", stripslashes($_POST['n_title'])) . "¦" . $news_content . "¦" . $n_date . "¦" . $n_author . "¦" . $n_new . "¦" . $_POST['n_active'] . "¦" . $_POST['n_archive'] . "¦\n");
                    }
                }
                fclose($new_db);
                
                
                
                
                #delete_variable('../engine/variables_mods/news.tDB','0',$p_id,'¦');
                echo notice_message_admin('News successfully edited', 1, 0, 'index.php?get=news_manager');
                
                
                
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
    
    <form action="" method="POST" name="news">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add News</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">News Title that will appear on news.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="n_title" size="40" value="' . htmlspecialchars($n_title) . '"></td>
    </tr>
    
    
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">News Archive</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'Yes\' this news will moved to news archive.<br<br>Note: archived news are not displayed on news.</td>
    <td align="left" class="panel_text_alt2" width="50%">';
            switch ($n_archive) {
                case '0':
                    echo '<label><input type="radio" name="n_archive" value="0"  checked="checked">Yes</label> <label><input type="radio" name="n_archive" value="1">No</label>';
                    break;
                case '1':
                    echo '<label><input type="radio" name="n_archive" value="0"  >Yes</label> <label><input type="radio" name="n_archive" value="1" checked="checked">No</label>';
                    break;
            }
            echo '</td
    </tr>
    

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' this news will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%">';
            switch ($n_active) {
                case '0':
                    echo '<label><input type="radio" name="n_active" value="1">Yes</label> <label><input type="radio" name="n_active" value="0"  checked="checked">No</label>';
                    break;
                case '1':
                    echo '<label><input type="radio" name="n_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="n_active" value="0">No</label>';
                    break;
            }
            echo '</td
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">News Content</td>
    </tr>
    <tr>
    <td  class="panel_text_area" colspan="2" width="60%"><textarea id="n_content" name="n_content" rows="24" style="width: 100%;">' . $n_content . '</textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    
    <input type="hidden" name="edit_news">
    <input type="submit" value="Edit News"></td>
    </tr>
    
    </table>
    </form>';
        }
        
    }
    
} else {
    if (isset($_POST['masive_delete'])) {
        if (empty($_POST['news_code_delete'])) {
            echo notice_message_admin('No news selected.', 0, 1, 0);
        } else {
            $count = 0;
            foreach ($_POST['news_code_delete'] as $post_name => $post_code) {
                $count++;
                delete_variable('../engine/variables_mods/news.tDB', '0', $post_code, '¦');
                
            }
            echo notice_message_admin('<b>' . $count . '</b> news successfully deleted.', 1, 0, 'index.php?get=news_manager');
        }
    } elseif (isset($_GET['delete_news'])) {
        if (empty($_GET['delete_news'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=news_manager');
        } else {
            $p_id   = safe_input(xss_clean($_GET['delete_news']), '_');
            $p_file = file('../engine/variables_mods/news.tDB');
            foreach ($p_file as $check_id) {
                $check_id = explode("¦", $check_id);
                if ($check_id[0] == $p_id) {
                    $p_id_found = '1';
                    break;
                }
            }
            if ($p_id_found != '1') {
                echo notice_message_admin('News with ID: <b>' . $p_id . '</b> does not exist.', '0', '1', '0');
            } else {
                delete_variable('../engine/variables_mods/news.tDB', '0', $p_id, '¦');
                echo notice_message_admin('News successfully deleted', 1, 0, 'index.php?get=news_manager');
            }
        }
        
    } elseif (isset($_GET['move_listed'])) {
        if (empty($_GET['move_listed'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=news_manager');
        } else {
            $p_id   = safe_input(xss_clean($_GET['move_listed']), '_');
            $p_file = file('../engine/variables_mods/news.tDB');
            foreach ($p_file as $check_id) {
                $check_id = explode("¦", $check_id);
                if ($check_id[0] == $p_id) {
                    $p_id_found = '1';
                    $n_id       = $check_id[0];
                    $n_title    = $check_id[2];
                    $n_content  = $check_id[3];
                    $n_date     = $check_id[4];
                    $n_author   = $check_id[5];
                    $n_new      = $check_id[6];
                    $n_active   = $check_id[7];
                    break;
                }
            }
            if ($p_id_found != '1') {
                echo notice_message_admin('News with ID: <b>' . $p_id . '</b> does not exist.', '0', '1', '0');
            } else {
                $old_db = file("../engine/variables_mods/news.tDB");
                $new_db = fopen("../engine/variables_mods/news.tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($p_id != $old_db_arr[0]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $n_id . "¦News¦" . $n_title . "¦" . $n_content . "¦" . $n_date . "¦" . $n_author . "¦" . $n_new . "¦" . $n_active . "¦1¦\n");
                    }
                }
                fclose($new_db);
                #delete_variable('../engine/variables_mods/news.tDB','0',$p_id,'¦');
                echo notice_message_admin('News successfully moved to Listed News', 1, 0, 'index.php?get=news_manager');
            }
        }
        
    } elseif (isset($_GET['move_archive'])) {
        if (empty($_GET['move_archive'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=news_manager');
        } else {
            $p_id   = safe_input(xss_clean($_GET['move_archive']), '_');
            $p_file = file('../engine/variables_mods/news.tDB');
            foreach ($p_file as $check_id) {
                $check_id = explode("¦", $check_id);
                if ($check_id[0] == $p_id) {
                    $p_id_found = '1';
                    $n_id       = $check_id[0];
                    $n_title    = $check_id[2];
                    $n_content  = $check_id[3];
                    $n_date     = $check_id[4];
                    $n_author   = $check_id[5];
                    $n_new      = $check_id[6];
                    $n_active   = $check_id[7];
                    break;
                }
            }
            if ($p_id_found != '1') {
                echo notice_message_admin('News with ID: <b>' . $p_id . '</b> does not exist.', '0', '1', '0');
            } else {
                $old_db = file("../engine/variables_mods/news.tDB");
                $new_db = fopen("../engine/variables_mods/news.tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($p_id != $old_db_arr[0]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $n_id . "¦News¦" . $n_title . "¦" . $n_content . "¦" . $n_date . "¦" . $n_author . "¦" . $n_new . "¦" . $n_active . "¦0¦\n");
                    }
                }
                fclose($new_db);
                #delete_variable('../engine/variables_mods/news.tDB','0',$p_id,'¦');
                echo notice_message_admin('News successfully moved to Archived News', 1, 0, 'index.php?get=news_manager');
            }
        }
    } else {
        if (isset($_POST['module_active'])) {
            $save_status = new_config_xml('../engine/config_mods/news_settings', 'active', safe_input($_POST['module_active'], ''));
        }
        $get_config = simplexml_load_file('../engine/config_mods/news_settings.xml');
        echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">News Settings</td>
</tr>
<tr>';
        if ($get_config->active == '1') {
            echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>News are active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn News Off"><input type="hidden" name="module_active" value="0">';
            
            
        } elseif ($get_config->active == '0') {
            echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>News are inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn News On"><input type="hidden" name="module_active" value="1">';
        }
        echo '</td>
</tr>
</table>
</form>';
        
        
        echo '
        <form action="" method="POST" name="delete_news" onclick="cCheck(document.delete_news,\'news_code_delete[]\',\'news_selected\');"><input type="hidden" name="masive_delete">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="5">Listed News</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Date</td>
<td align="left" class="panel_title_sub2">Status</td>
<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
        $news_file = file('../engine/variables_mods/news.tDB');
        $count     = 0;
        foreach ($news_file as $news) {
            $news = explode("¦", $news);
            if ($news[8] == '1') {
                $count++;
                $tr_color = ($count % 2) ? '' : 'even';
                $news[2]  = strlen($news[2]) > 78 ? substr($news[2], 0, 78) . "..." : $news[2];
                echo '
            
            <tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . $news[2] . '</strong></td>
            <td align="left" class="panel_text_alt_list" width="150">' . date('F j, Y / H:i', $news[4]) . '</td>
            <td align="left" class="panel_text_alt_list" width="50"><strong>';
                switch ($news[7]) {
                    case '1':
                        echo 'Active';
                        break;
                    case '0':
                        echo 'Inactive';
                        break;
                }
                
                echo '</strong></td>
            <td align="left" class="panel_text_alt_list" width="200"><a href="index.php?get=news_manager&mod=edit_news&id=' . $news[0] . '">[Edit]</a> / <a href="javascript:;" onclick="ask_url(\'Move to Archived News?\',\'index.php?get=news_manager&move_archive=' . $news[0] . '\')";>[Move to Archive]</a> / <a href="javascript:;" onclick="ask_url(\'Are you sure you want to delete this news?\',\'index.php?get=news_manager&delete_news=' . $news[0] . '\')";>[Delete]</a>&nbsp;<input name="news_code_delete[]" type="checkbox"  value="' . $news[0] . '"></td></tr>
            
            ';
            }
            
        }
        echo '<tr>
<td align="center" class="panel_buttons" colspan="5">

<div id=""><div align="right"><input type="hidden" name="masive_delete"><a href="javascript:void(0)" onclick="CheckAll(document.delete_news,\'news_code_delete[]\'); ">[Check All]</a> <a href="javascript:void(0)" onclick="UnCheckAll(document.delete_news,\'news_code_delete[]\'); ">[Uncheck All]</a><br><br>
<input type="submit" name="news_selected" id="news_selected" value="Delete Selected (0)" onclick="return ask_form(\'Are you sure you want to delete selected news?\')"> </div>

<input type="button" value="Add News" onclick="location.href=\'index.php?get=news_manager&mod=add_news\'"></td>
</tr>
</table></form>';
        
        echo '
<form action="" method="POST" name="delete_archive" onclick="cCheck(document.delete_archive,\'news_code_delete[]\',\'archive_selected\');"><input type="hidden" name="masive_delete">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px">
<tr>
 <td align="center" class="panel_title" colspan="5">Archived News</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Date</td>
<td align="left" class="panel_title_sub2">Status</td>
<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
        
        $count = 0;
        foreach ($news_file as $news) {
            $news = explode("¦", $news);
            if ($news[8] == '0') {
                $count++;
                $tr_color = ($count % 2) ? '' : 'even';
                $news[2]  = strlen($news[2]) > 78 ? substr($news[2], 0, 78) . "..." : $news[2];
                echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . $news[2] . '</strong></td>
            <td align="left" class="panel_text_alt_list" width="150">' . date('F j, Y / H:i', $news[4]) . '</td>
            <td align="left" class="panel_text_alt_list" width="50"><strong>';
                switch ($news[7]) {
                    case '1':
                        echo 'Active';
                        break;
                    case '0':
                        echo 'Inactive';
                        break;
                }
                echo '</strong></td>
            <td align="left" class="panel_text_alt_list" width="200"><a href="index.php?get=news_manager&mod=edit_news&id=' . $news[0] . '">[Edit]</a> / <a href="javascript:;" onclick="ask_url(\'Move to Listed News?\',\'index.php?get=news_manager&move_listed=' . $news[0] . '\')";>[Move to Listed]</a> / <a href="javascript:;" onclick="ask_url(\'Are you sure you want to delete this news?\',\'index.php?get=news_manager&delete_news=' . $news[0] . '\')";>[Delete]</a>&nbsp;<input name="news_code_delete[]" type="checkbox"  value="' . $news[0] . '"></td></tr>
            ';
            }
            
        }
        echo '
<tr>
<td align="center" class="panel_buttons" colspan="5">

<div id=""><div align="right"><input type="hidden" name="masive_delete"><a href="javascript:void(0)" onclick="CheckAll(document.delete_archive,\'news_code_delete[]\'); ">[Check All]</a> <a href="javascript:void(0)" onclick="UnCheckAll(document.delete_archive,\'news_code_delete[]\'); ">[Uncheck All]</a><br><br>
<input type="submit" name="archive_selected" id="archive_selected" value="Delete Selected (0)" onclick="return ask_form(\'Are you sure you want to delete selected news?\')"> </div>


</tr>
</table></form>';
        
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