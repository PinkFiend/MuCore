   <script type="text/javascript" src="script/yahoo-dom-event.js"></script>

    <script type="text/javascript">
    function fetch_object(A){
    if(document.getElementById){
        return document.getElementById(A)
    }else{
        if(document.all){
            return document.all[A]}else{
                if(document.layers){
                    return document.layers[A]
                }else{
                    return null
                }
            }
    }
}
    </script>
<script type="text/javascript" src="script/animation-min.js"></script>
<script type="text/javascript" src="script/dragdrop-min.js"></script>
<script type="text/javascript" src="script/core_cms_admin_dd.js"></script>

<style type="text/css">
<!--
ul.draglist { 
    position: relative;
    border: 1px dashed gray;
    list-style: none;
    margin: 0;
    padding: 13px 5px 13px 5px;
    
}

ul.draglist li {
    margin: 2px;
    cursor: move;
    width: 97%;
}

ul.draglist_inact { 
    position: relative;
    border: 1px dashed gray;
    list-style: none;
    margin: 0;
    padding: 13px 5px 13px 5px;
}

ul.draglist_inact li {
    margin: 2px;
    cursor: move;
    width: 97%;
}

li.dlistitem {
    text-align: left;
    margin: 0;
    padding: 3px;
    border: 1px outset #7EA6B2;
}
-->
</style>    

<?

if (isset($_POST['save_order'])) {
    foreach ($_POST['display_order'] as $post_name => $post_order) {
        $get_true_config = file('../engine/cms_data/pag_d.cms');
        foreach ($get_true_config as $old_config) {
            $old_config = explode("¦", $old_config);
            if ($old_config[1] == $post_name) {
                $title         = $old_config[2];
                $page_id       = $old_config[3];
                $modules_left  = $old_config[4];
                $modules_right = $old_config[5];
                $page_hide     = $old_config[6];
                $page_type     = $old_config[7];
                
                $page_active      = $old_config[8];
                $page_auth        = $old_config[9];
                $page_url         = $old_config[10];
                $page_target      = $old_config[11];
                $page_sql         = $old_config[12];
                $page_keywords    = $old_config[13];
                $page_description = $old_config[14];
                break;
            }
        }
        $new_cfg = safe_input($post_order, '') . '¦' . safe_input($post_name, '') . '¦' . $title . '¦' . $page_id . '¦' . $modules_left . '¦' . $modules_right . '¦' . $page_hide . '¦' . $page_type . '¦' . $page_active . '¦' . $page_auth . '¦' . $page_url . '¦' . $page_target . "¦" . $page_sql . "¦" . $page_keywords . "¦" . $page_description . "¦\r\n";
        
        
        #echo $new_cfg.'<br>';
        
        
        $old_db = file("../engine/cms_data/pag_d.cms");
        $new_db = fopen("../engine/cms_data/pag_d.cms", "w");
        foreach ($old_db as $old_db_line) {
            $old_db_arr = explode("¦", $old_db_line);
            if ($post_name != $old_db_arr[1]) {
                fwrite($new_db, "$old_db_line");
            } else {
                fwrite($new_db, $new_cfg);
            }
        }
        fclose($new_db);
        
        
    }
    echo notice_message_admin('Display Order successfully saved', 1, 0, 'index.php?get=edit_pages');
    
} else {
    if (isset($_GET['edit_page'])) {
        if ($_GET['m'] == '0') {
            if (isset($_POST['edit_page'])) {
                if ($_POST['p_order'] == '0') {
                    $order = 'not_blank';
                } else {
                    $order = $_POST['p_order'];
                }
                
                if (empty($_POST['p_title']) || empty($_POST['p_id']) || empty($order)) {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    if ($_POST['p_auth'] == '1' && $_POST['p_sql'] != '1') {
                        echo notice_message_admin('Page Authentication requires sql connection, set SQL Connection to \'Yes\'.', '0', '1', '0');
                    } else {
                        foreach ($_POST['mods'] AS $modcol => $rawmods) {
                            if ($modcol == "1") {
                                $new_mods_left = safe_input(substr($rawmods, 0, -1), '\_\ ');
                            }
                            echo '&nbsp; &nbsp; &nbsp; &nbsp;';
                            if ($modcol == "2") {
                                $new_mods_right = safe_input(substr($rawmods, 0, -1), '\_\ ');
                            }
                        }
                        
                        $new_cfg = safe_input($_POST['p_order'], '') . '¦' . safe_input(xss_clean($_GET['edit_page']), '') . '¦' . safe_input($_POST['p_title'], '\_\.\-\ ') . '¦' . safe_input($_POST['p_id'], '\_') . '¦' . $new_mods_left . '¦' . $new_mods_right . '¦' . safe_input($_POST['p_hide'], '') . '¦' . safe_input($_POST['p_type'], '') . '¦' . safe_input($_POST['p_active'], '') . '¦' . safe_input($_POST['p_auth'], '') . "¦¦¦" . safe_input($_POST['p_sql'], '') . "¦" . str_replace('"', "", str_replace("¦", "", $_POST['meta_keywords'])) . "¦" . str_replace('"', "", str_replace("¦", "", $_POST['meta_description'])) . "¦\r\n";
                        
                        
                        
                        
                        
                        $old_db = file("../engine/cms_data/pag_d.cms");
                        $new_db = fopen("../engine/cms_data/pag_d.cms", "w");
                        foreach ($old_db as $old_db_line) {
                            $old_db_arr = explode("¦", $old_db_line);
                            if (safe_input(xss_clean($_GET['edit_page']), '') != $old_db_arr[1]) {
                                fwrite($new_db, "$old_db_line");
                            } else {
                                fwrite($new_db, $new_cfg);
                            }
                        }
                        fclose($new_db);
                        echo notice_message_admin('Page successfully saved', 1, 0, 'index.php?get=edit_pages#' . safe_input(xss_clean($_GET['edit_page']), '') . '');
                        
                    }
                }
            } else {
                $page_id         = safe_input(xss_clean($_GET['edit_page']), '');
                $get_true_config = file('../engine/cms_data/pag_d.cms');
                foreach ($get_true_config as $old_config) {
                    $old_config = explode("¦", $old_config);
                    if ($old_config[1] == $page_id) {
                        $order            = $old_config[0];
                        $title            = $old_config[2];
                        $page_id          = $old_config[3];
                        $modules_left     = $old_config[4];
                        $modules_right    = $old_config[5];
                        $page_hide        = $old_config[6];
                        $page_type        = $old_config[7];
                        $page_active      = $old_config[8];
                        $page_auth        = $old_config[9];
                        $page_sql         = $old_config[12];
                        $page_keywords    = $old_config[13];
                        $page_description = $old_config[14];
                        break;
                    }
                }
                
                
                
                echo '<form action="" method="POST" name="save_page" onsubmit="return YAHOO.DDApp.showOrder()">
<input type="hidden" id="columns" name="vba_mod_cols" value="1,2,3" />
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Edit Page: ' . $title . '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Page Title that will appear on website menu.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="' . $title . '" name="p_title"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page ID</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">This is the variable that will be used in the URL to link to this page. 
<br>For example, if this option is set to \'some_page\', then the link to this page would look like this: <br>
http://yoursite.com/index.php?page_id=<b>some_page</b>.<br><br>Note: Use only numbers and letters, symbols allowed: <b>_</b> (underscore)</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="' . $page_id . '" name="p_id"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Order</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">This controls the order that the page will be displayed in for the Website Menu and in the MUCore Admin Control Panel.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="' . $order . '" name="p_order"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Meta Keywords</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Here you may enter a list of meta keywords for this page. Leave this setting blank to use your default MUCore Meta Keywords setting.<br><br>Separe each word with comma<br>e.g: game,muonline,mmorpg,free play,season 5,bugless
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="meta_keywords" value="' . $page_keywords . '" size="45"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Meta Description</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Here you may enter a meta description for this page. Leave this setting blank to use your default MUCore Meta Keywords description.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="meta_description" value="' . $page_description . '" size="45"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Active</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set to \'No\', page will not be visible.</td>
<td align="left" class="panel_text_alt2" width="50%">';
                switch ($page_active) {
                    case '0':
                        echo '<label><input type="radio" name="p_active" value="1"> Yes</label> <label><input type="radio" name="p_active" value="0" checked="checked"> No</label>';
                        break;
                    case '1':
                        echo '<label><input type="radio" name="p_active" value="1" checked="checked"> Yes</label> <label><input type="radio" name="p_active" value="0" > No</label>';
                        break;
                }
                echo '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">SQL Connection</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set to \'Yes\', page will establish connection with SQL Server (MU Online database).<br><br>Note: Set \'Yes\' only if one or more of modules that you will add on this page will require SQL Connection.</td>
<td align="left" class="panel_text_alt2" width="50%">';
                switch ($page_sql) {
                    case '0':
                        echo '<label><input type="radio" name="p_sql" value="1"> Yes</label> <label><input type="radio" name="p_sql" value="0" checked="checked"> No</label>';
                        break;
                    case '1':
                        echo '<label><input type="radio" name="p_sql" value="1" checked="checked"> Yes</label> <label><input type="radio" name="p_sql" value="0" > No</label>';
                        break;
                }
                echo '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Authentication</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set \'Yes\', user will need to log in before to see page.<br><br>
<b>Note: Page Authentication require SQL Connection<b></td>
<td align="left" class="panel_text_alt2" width="50%">';
                
                switch ($page_auth) {
                    case '0':
                        echo '<label><input type="radio" name="p_auth" value="1"> Yes</label> <label><input type="radio" name="p_auth" value="0" checked="checked"> No</label>';
                        break;
                    case '1':
                        echo '<label><input type="radio" name="p_auth" value="1" checked="checked"> Yes</label> <label><input type="radio" name="p_auth" value="0"> No</label>';
                        break;
                }
                
                
                echo '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Hide</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set \'Yes\', page will not appear on Website Menu, but will still be accessible if page URL knows.</td>
<td align="left" class="panel_text_alt2" width="50%">';
                
                switch ($page_hide) {
                    case '1':
                        echo '<label><input type="radio" name="p_hide" value="0"> Yes</label> <label><input type="radio" name="p_hide" value="1" checked="checked"> No</label>';
                        break;
                    case '0':
                        echo '<label><input type="radio" name="p_hide" value="0" checked="checked"> Yes</label> <label><input type="radio" name="p_hide" value="1" > No</label>';
                        break;
                }
                echo '
</td>
</tr>


</table>


<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Active Modules</td>
</tr>

<tr>
<td align="left" class="panel_title_sub2" width="50%">Left Column</td>
<td align="left" class="panel_title_sub2" width="50%">Center Column</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%" valign="top">';
                echo '<input type="hidden" name="mods[1]" id="col1" value="' . $modules_left . '" />';
                
                echo '
<ul id="ul1" class="draglist">';
                
                
                $modules_list      = file('../engine/cms_data/mods.cms');
                $modules_list_left = preg_split("/\ /", $modules_left);
                
                
                foreach ($modules_list as $modules_left_active) {
                    $modules_left_active = explode("¦", $modules_left_active);
                    if (in_array($modules_left_active[0], $modules_list_left)) {
                        $_c_id_m_lef[] = $modules_left_active[0];
                    } else {
                        $_c_id_m_lef[] = 'NULL';
                    }
                }
                
                foreach ($modules_list_left as $give_left_modules) {
                    if (in_array($give_left_modules, $_c_id_m_lef)) {
                        foreach ($modules_list as $module_left_out) {
                            $module_left_out = explode("¦", $module_left_out);
                            if ($module_left_out[0] == $give_left_modules) {
                                if ($module_left_out[4] == 0) {
                                    echo '<li class="dlistitem alt1" id="' . $module_left_out[0] . '" title="' . $module_left_out[3] . '">' . $module_left_out[3] . ' (Inactive Module)</li>';
                                } else {
                                    echo '<li class="dlistitem alt1" id="' . $module_left_out[0] . '" title="' . $module_left_out[3] . '">' . $module_left_out[3] . '</li>';
                                }
                                
                            }
                        }
                    }
                }
                
                
                echo '</ul></td>
<td align="left" class="panel_text_alt1" width="50%" valign="top">';
                
                echo '<input type="hidden" name="mods[2]" id="col2" value="' . $modules_list_right . '" />';
                echo '            
<ul id="ul2" class="draglist">
';
                
                #$modules_list = file('../engine/cms_data/mods.cms');
                $modules_list_right = preg_split("/\ /", $modules_right);
                
                
                foreach ($modules_list as $modules_right_active) {
                    $modules_right_active = explode("¦", $modules_right_active);
                    if (in_array($modules_right_active[0], $modules_list_right)) {
                        $_c_id_m_right[] = $modules_right_active[0];
                    } else {
                        $_c_id_m_right[] = 'NULL';
                    }
                }
                
                foreach ($modules_list_right as $give_right_modules) {
                    if (in_array($give_right_modules, $_c_id_m_right)) {
                        foreach ($modules_list as $module_right_out) {
                            $module_right_out = explode("¦", $module_right_out);
                            if ($module_right_out[0] == $give_right_modules) {
                                if ($module_right_out[4] == 0) {
                                    echo '<li class="dlistitem alt1" id="' . $module_right_out[0] . '" title="' . $module_right_out[3] . '">' . $module_right_out[3] . ' (Inactive Module)</li>';
                                } else {
                                    echo '<li class="dlistitem alt1" id="' . $module_right_out[0] . '" title="' . $module_right_out[3] . '">' . $module_right_out[3] . '</li>';
                                }
                                
                            }
                        }
                    }
                }
                
                echo '
            </ul></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Inactive Modules</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">
<ul id="ulinact" class="draglist_inact">';
                $full_active_modules      = $modules_left . ' ' . $modules_right;
                $full_active_modules_list = preg_split("/\ /", $full_active_modules);
                foreach ($modules_list as $inactive_modules) {
                    $inactive_modules = explode("¦", $inactive_modules);
                    
                    if (!in_array($inactive_modules[0], $full_active_modules_list)) {
                        if ($inactive_modules[4] == 0) {
                            echo '<li class="dlistitem alt1" id="' . $inactive_modules[0] . '" title="' . $inactive_modules[3] . '">' . $inactive_modules[3] . ' (Inactive Module)</li>';
                        } else {
                            echo '<li class="dlistitem alt1" id="' . $inactive_modules[0] . '" title="' . $inactive_modules[3] . '">' . $inactive_modules[3] . '</li>';
                        }
                        
                    }
                }
                
                
                
                echo '
            </ul></td>
<td align="left" class="panel_text_alt2" width="50%" valign="top">To arrange the modules on this page, click on the module title and drag it to the location you would like it to appear. To remove a module from this page, drag it to the Inactive Modules box to the left.</td>
</tr>


</table>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_buttons" colspan="2">
<input type="hidden" name="p_type" value="' . $page_type . '">
<input type="hidden" name="edit_page">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>
';
            }
            
        } elseif ($_GET['m'] == '1') {
            if (isset($_POST['edit_page'])) {
                if (empty($_POST['p_title']) || empty($_POST['p_url'])) {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                    
                } else {
                    $new_cfg = safe_input($_POST['p_order'], '') . '¦' . safe_input(xss_clean($_GET['edit_page']), '') . '¦' . safe_input($_POST['p_title'], '\_\.\-\ ') . '¦NULL¦¦¦¦' . safe_input($_POST['p_type'], '') . '¦¦¦' . safe_input($_POST['p_url'], '\:\/\_\.\?\=\#\-') . '¦' . safe_input($_POST['p_target'], '') . "¦0¦¦¦\r\n";
                    
                    
                    
                    
                    
                    $old_db = file("../engine/cms_data/pag_d.cms");
                    $new_db = fopen("../engine/cms_data/pag_d.cms", "w");
                    foreach ($old_db as $old_db_line) {
                        $old_db_arr = explode("¦", $old_db_line);
                        if (safe_input(xss_clean($_GET['edit_page']), '') != $old_db_arr[1]) {
                            fwrite($new_db, "$old_db_line");
                        } else {
                            fwrite($new_db, $new_cfg);
                        }
                    }
                    fclose($new_db);
                    echo notice_message_admin('Page successfully saved', 1, 0, '');
                }
                
            } else {
                $page_id         = safe_input(xss_clean($_GET['edit_page']), '');
                $get_true_config = file('../engine/cms_data/pag_d.cms');
                foreach ($get_true_config as $old_config) {
                    $old_config = explode("¦", $old_config);
                    if ($old_config[1] == $page_id) {
                        $order       = $old_config[0];
                        $title       = $old_config[2];
                        $page_id     = $old_config[3];
                        $page_url    = $old_config[10];
                        $page_target = $old_config[11];
                        $page_type   = $old_config[7];
                        break;
                    }
                }
                
                echo '<form action="" method="POST" name="save_page">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Edit Page: ' . $title . '</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Page Title that will appear on website menu.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="' . $title . '" name="p_title"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page URL</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Enter the URL you would like to link.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="' . $page_url . '" name="p_url"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">URL Target</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">Open URL in:<br><br><b>_blank</b> - will open url in new window.
<br><b>_self</b> - will open url in same window.</td>
<td align="left" class="panel_text_alt2" width="50%">
<select name="p_target">';
                switch ($page_target) {
                    case '0':
                        echo '<option value="0" selected="selected">_self</option><option value="1">_blank</option>';
                        break;
                    case '1':
                        echo '<option value="0">_self</option><option value="1" selected="selected">_blank</option>';
                        break;
                }
                echo '
                </select></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Order</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">This controls the order that the page will be displayed in for the Website Menu and in the MUCore Admin Control Panel.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="' . $order . '" name="p_order"></td>
</tr>
<tr>
<td align="center" class="panel_buttons" colspan="2">
<input type="hidden" name="p_type" value="' . $page_type . '">
<input type="hidden" name="edit_page">
<input type="submit" value="Save"></td>
</tr>

</table>
</form>';
            }
            
        }
        
    } else {
        if (isset($_GET['delete_page'])) {
            if (empty($_GET['delete_page'])) {
                echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=edit_pages');
                
            } else {
                $p_id   = safe_input(xss_clean($_GET['delete_page']), '');
                $p_file = file('../engine/cms_data/pag_d.cms');
                foreach ($p_file as $check_id) {
                    $check_id = explode("¦", $check_id);
                    if ($check_id[1] == $p_id) {
                        $p_id_found = '1';
                        break;
                    }
                }
                if ($p_id_found != '1') {
                    echo notice_message_admin('Page with ID: <b>' . $p_id . '</b> does not exist.', '0', '1', '0');
                } else {
                    $new_db = fopen("../engine/cms_data/pag_d.cms", "w");
                    foreach ($p_file as $new_db_line) {
                        $db_line = explode("¦", $new_db_line);
                        if ($db_line[1] != $p_id) {
                            fwrite($new_db, $new_db_line);
                            #echo $new_db_line;
                        }
                    }
                    fclose($new_db);
                    echo notice_message_admin('Page successfully deleted', 1, 0, 'index.php?get=edit_pages');
                }
                
            }
            
        } else {
            echo '
<form action="" method="POST" name="save_order">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="9">Edit Pages</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Page ID</td>
<td align="left" class="panel_title_sub2">Display Order</td>
<td align="left" class="panel_title_sub2">Type</td>
<td align="left" class="panel_title_sub2">Status</td>
<td align="left" class="panel_title_sub2">SQL Connection</td>
<td align="left" class="panel_title_sub2">Authentication</td>
<td align="left" class="panel_title_sub2">Hidden</td>

<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
            $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
            $count     = 0;
            foreach ($get_pages as $page) {
                explode("¦", $page);
                $count++;
                $tr_color = ($count % 2) ? '' : 'even';
                echo '
    <tr class="' . $tr_color . '">
    <td align="left" class="panel_text_alt_list"><a name="' . $page[1] . '"></a><strong>' . $page[2] . '</strong></td>
    <td align="left" class="panel_text_alt_list" >';
                switch ($page[7]) {
                    case '0':
                        echo $page[3];
                        break;
                    case '1':
                        echo set_limit($page[10], '30', '...');
                }
                
                echo '</td>
    <td align="left" class="panel_text_alt_list"><input type="text" name="display_order[' . $page[1] . ']" value="' . $page[0] . '" size="3"></td>
    ';
                switch ($page[7]) {
                    case '0':
                        echo '<td align="left" class="panel_text_alt_list">Built-in Page</td>';
                        $p_type    = 'Built-in Page';
                        $link_edit = 'index.php?get=edit_pages&m=0&edit_page=' . $page[1] . '';
                        break;
                    case '1':
                        echo '<td align="left" class="panel_text_alt_list">Additional URL</td>';
                        $p_type    = 'Additional URL';
                        $link_edit = 'index.php?get=edit_pages&m=1&edit_page=' . $page[1] . '';
                        break;
                }
                switch ($page[8]) {
                    case '0':
                        $status = '<em>Inactive</em>';
                        break;
                    case '1':
                        $status = '<b>Active</b>';
                        break;
                }
                
                switch ($page[12]) {
                    case '0':
                        $sql = 'No';
                        break;
                    case '1':
                        $sql = '<b>Yes</b>';
                        break;
                }
                switch ($page[9]) {
                    case '0':
                        $auth = 'No';
                        break;
                    case '1':
                        $auth = '<b>Yes</b>';
                        break;
                }
                switch ($page[6]) {
                    case '1':
                        $hide = 'No';
                        break;
                    case '0':
                        $hide = '<b>Yes</b>';
                        break;
                }
                echo '<td align="left" class="panel_text_alt_list">' . $status . '</td>
    <td align="left" class="panel_text_alt_list">' . $sql . '</td>
    <td align="left" class="panel_text_alt_list">' . $auth . '</td>
    <td align="left" class="panel_text_alt_list">' . $hide . '</td>';
                
                
                echo '<td align="left" class="panel_text_alt_list" ><a href="' . $link_edit . '">[Edit]</a> / <a href="javascript:void(0);" onclick="ask_url(\'Delete ' . $p_type . ': ' . $page[2] . '?\',\'index.php?get=edit_pages&delete_page=' . $page[1] . '\')";>[Delete]</a></td>
    </tr>';
            }
            
            echo '
<tr>
<td align="center" class="panel_buttons" colspan="9">

<input type="hidden" name="save_order">
<input type="submit" value="Save Display Order"> <input type="button" value="Add New Page" onclick="location.href=\'index.php?get=add_page\'"></td>
</tr>
</table>
</form>
';
        }
    }
}
?>