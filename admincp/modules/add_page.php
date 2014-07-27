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
if (!isset($_GET['m'])) {
    echo '
    
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Page Type</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Please select Page type would like to add.</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="30%" valign="top"><a href="index.php?get=add_page&m=0">[Built-in Page]</a></td>
<td align="left" class="panel_text_alt1" width="70%" valign="top">A Built-in Page will allow you to select any of your modules which you would like to display on this page, ans also page options like:<br><br>
<b>SQL Connection</b> - Set if new page need to connect sql.<br>
<b>Page Authentication</b> - User will need to log in before to see page.<br>
<b>Page Hide</b> - Hide page link on Website Menu but still can be accessed if page URL knows.</td>
</tr>
<tr class="even">
<td align="left" class="panel_text_alt1" width="30%" valign="top"><a href="index.php?get=add_page&m=1">[Additional URL]</a></td>
<td align="left" class="panel_text_alt1" width="70%" valign="top">Add simple simple link to Website Menu.</td>
</tr>
</table>
    ';
    
} else {
    if ($_GET['m'] == '0') {
        if (isset($_POST['add_page'])) {
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
                    $page_id   = uniqid();
                    $page_file = file('../engine/cms_data/pag_d.cms');
                    foreach ($page_file as $pag_data) {
                        $pag_data = explode("¦", $pag_data);
                        if ($pag_data[3] == $_POST['p_id']) {
                            $id_found = 1;
                        }
                    }
                    if ($id_found == '1') {
                        echo notice_message_admin('There is already one page with same page id: <b>' . htmlentities($_POST['p_id']) . '</b>.', '0', '1', '0');
                    } else {
                        foreach ($_POST['mods'] AS $modcol => $rawmods) {
                            if ($modcol == "1") {
                                $new_mods_left = safe_input(substr($rawmods, 0, -1), '\_\ ');
                            }
                            
                            if ($modcol == "2") {
                                $new_mods_right = safe_input(substr($rawmods, 0, -1), '\_\ ');
                            }
                            
                        }
                        $new_cfg = safe_input($_POST['p_order'], '') . '¦' . $page_id . '¦' . safe_input($_POST['p_title'], '\_\.\-\ ') . '¦' . safe_input($_POST['p_id'], '\_') . '¦' . $new_mods_left . '¦' . $new_mods_right . '¦' . safe_input($_POST['p_hide'], '') . '¦' . safe_input($_POST['p_type'], '') . '¦' . safe_input($_POST['p_active'], '') . '¦' . safe_input($_POST['p_auth'], '') . "¦¦¦" . safe_input($_POST['p_sql'], '') . "¦" . str_replace('"', "", str_replace("¦", "", $_POST['meta_keywords'])) . "¦" . str_replace('"', "", str_replace("¦", "", $_POST['meta_description'])) . "¦\r\n";
                        $open_f  = fopen('../engine/cms_data/pag_d.cms', 'a');
                        $write_f = fwrite($open_f, $new_cfg);
                        $close_f = fclose($open_f);
                        echo notice_message_admin('Built-in Page successfully added', 1, 0, 'index.php?get=edit_pages');
                    }
                }
                
            }
            
            
            
            
            
            
        } else {
            echo '<form action="" method="POST" name="add_page" onsubmit="return YAHOO.DDApp.showOrder()">
<input type="hidden" id="columns" name="vba_mod_cols" value="1,2,3" />
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Add Built-in Page</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Page Title that will appear on website menu.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" name="p_title"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page ID</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">This is the variable that will be used in the URL to link to this page. 
<br>For example, if this option is set to \'some_page\', then the link to this page would look like this: <br>
http://yoursite.com/index.php?page_id=<b>some_page</b>.<br><br>Note: Use only numbers and letters, symbols allowed: <b>_</b> (underscore)</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" name="p_id"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Order</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">This controls the order that the page will be displayed in for the Website Menu and in the Admin Control Panel.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" name="p_order" value="0"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Meta Keywords</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Here you may enter a list of meta keywords for this page. Leave this setting blank to use your default MUCore Meta Keywords setting.<br><br>Separe each word with comma<br>e.g: game,muonline,mmorpg,free play,season 5,bugless
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="meta_keywords" value="' . $core['config']['meta_keywords'] . '" size="45"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Meta Description</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Here you may enter a meta description for this page. Leave this setting blank to use your default MUCore Meta Keywords description.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="meta_description" value="' . $core['config']['meta_description'] . '" size="45"></td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Active</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set to \'No\', page will not be visible.</td>
<td align="left" class="panel_text_alt2" width="50%">
<label><input type="radio" name="p_active" value="1" checked="checked"> Yes</label> <label><input type="radio" name="p_active" value="0"> No</label>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">SQL Connection</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set to \'Yes\', page will establish connection with SQL Server (MU Online database).<br><br>Note: Set \'Yes\' only if one or more of modules that you will add on this page will require SQL Connection.</td>
<td align="left" class="panel_text_alt2" width="50%">
<label><input type="radio" name="p_sql" value="1"> Yes</label> <label><input type="radio" name="p_sql" value="0"  checked="checked"> No</label>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Authentication</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set \'Yes\', user will need to log in before to see page.<br><br>
<b>Note: Page Authentication require SQL Connection<b></td>
<td align="left" class="panel_text_alt2" width="50%">
<label><input type="radio" name="p_auth" value="1"> Yes</label> <label><input type="radio" name="p_auth" value="0" checked="checked"> No</label>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Hide</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">When set \'Yes\', page will not appear on Website Menu, but will still be accessible if page URL knows.</td>
<td align="left" class="panel_text_alt2" width="50%">
<label><input type="radio" name="p_hide" value="0"> Yes</label> <label><input type="radio" name="p_hide" value="1" checked="checked"> No</label>
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
            echo '<input type="hidden" name="mods[1]" id="col1" value="" />';
            
            echo '
<ul id="ul1" class="draglist">';
            
            
            
            
            echo '</ul></td>
<td align="left" class="panel_text_alt1" width="50%" valign="top">';
            
            echo '<input type="hidden" name="mods[2]" id="col2" value="" />';
            echo '            
<ul id="ul2" class="draglist">

            </ul></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Inactive Modules</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">
<ul id="ulinact" class="draglist_inact">';
            
            
            $modules_list = file('../engine/cms_data/mods.cms');
            foreach ($modules_list as $inactive_modules) {
                $inactive_modules = explode("¦", $inactive_modules);
                if ($inactive_modules[4] == '0') {
                    echo '<li class="dlistitem alt1" id="' . $inactive_modules[0] . '" title="' . $inactive_modules[3] . '">' . $inactive_modules[3] . ' (Inactive Module)</li>';
                } else {
                    echo '<li class="dlistitem alt1" id="' . $inactive_modules[0] . '" title="' . $inactive_modules[3] . '">' . $inactive_modules[3] . '</li>';
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
<input type="hidden" name="p_type" value="0">
<input type="hidden" name="add_page">
<input type="submit" value="Add Page"></td>
</tr>
</table>
</form>';
        }
        
    } elseif ($_GET['m'] == '1') {
        if (isset($_POST['add_page'])) {
            if ($_POST['p_order'] == '0') {
                $order = 'not_blank';
            } else {
                $order = $_POST['p_order'];
            }
            
            if ($_POST['p_target'] == '0') {
                $p_target = 'not_blank';
            } else {
                $p_target = $_POST['p_target'];
            }
            
            
            if (empty($_POST['p_title']) || empty($_POST['p_url']) || empty($order) || empty($p_target)) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $p_id    = uniqid();
                $new_cfg = safe_input($_POST['p_order'], '') . '¦' . safe_input($p_id, '') . '¦' . safe_input($_POST['p_title'], '\_\.\-\ ') . '¦NULL¦¦¦¦' . safe_input($_POST['p_type'], '') . '¦¦¦' . safe_input($_POST['p_url'], '\:\/\_\.\?\=\#\-') . '¦' . safe_input($_POST['p_target'], '') . "¦0¦¦¦\r\n";
                $open_f  = fopen('../engine/cms_data/pag_d.cms', 'a');
                $write_f = fwrite($open_f, $new_cfg);
                $close_f = fclose($open_f);
                echo notice_message_admin('Additional URL successfully added', 1, 0, 'index.php?get=edit_pages');
            }
            
        } else {
            echo '<form action="" method="POST" name="save_page">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Add Additional URL Page</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Page Title that will appear on website menu.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="p_title"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Page URL</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Enter the URL you would like to link.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" name="p_url"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">URL Target</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">Open URL in:<br><br><b>_blank</b> - will open url in new window.
<br><b>_self</b> - will open url in same window.</td>
<td align="left" class="panel_text_alt2" width="50%">
<select name="p_target">
<option value="" selected="selected">--Select</option>
<option value="0">_self</option>
<option value="1">_blank</option>

                </select></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Display Order</td>
</tr>
<tr> 
<td align="left" class="panel_text_alt1" width="50%">This controls the order that the page will be displayed in for the Website Menu and in the Admin Control Panel.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text" value="0" name="p_order"></td>
</tr>
<tr>
<td align="center" class="panel_buttons" colspan="2">
<input type="hidden" name="p_type" value="1">
<input type="hidden" name="add_page">
<input type="submit" value="Add Page"></td>
</tr>

</table>
</form>';
        }
        
    }
}
?>