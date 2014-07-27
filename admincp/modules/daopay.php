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
if ($_GET['sys'] == 'settings') {
    if (isset($_POST['settings'])) {
        $save_1 = new_config_xml('../engine/config_mods/donate_daopay_settings', 'app_code', safe_input($_POST['app_code'], '\#\.\_\@\-'));
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=daopay&sys=settings');
        
    } else {
        if (isset($_POST['module_active'])) {
            $save_status = new_config_xml('../engine/config_mods/donate_daopay_settings', 'active', safe_input($_POST['module_active'], ''));
        }
        $get_config = simplexml_load_file('../engine/config_mods/donate_daopay_settings.xml');
        echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">DaoPay Settings</td>
</tr>
<tr>';
        if ($get_config->active == '1') {
            echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Donate with DaoPay is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Donate with DaoPay Off"><input type="hidden" name="module_active" value="0">';
            
            
        } elseif ($get_config->active == '0') {
            echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Donate with DaoPay is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Donate with DaoPay On"><input type="hidden" name="module_active" value="1">';
        }
        echo '</td>
</tr>
</table>
</form>';
        
        
        
        echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">DaoPay Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Application Code</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Enter daopay application code.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" value="' . $get_config->app_code . '" name="app_code"><br>
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
    
} elseif ($_GET['sys'] == 'manager') {
    if (isset($_GET['mod'])) {
        if ($_GET['mod'] == 'new') {
            if (isset($_POST['new'])) {
                if (empty($_POST['title']) || empty($_POST['amount']) || $_POST['currency'] == 'x' || empty($_POST['credits']) || empty($_POST['code'])) {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    $title    = str_replace("¦", "", $_POST['title']);
                    $order    = safe_input($_POST['order'], '');
                    $active   = safe_input($_POST['active'], '');
                    $amount   = safe_input($_POST['amount'], '\.');
                    $currency = safe_input($_POST['currency'], '');
                    $credits  = safe_input($_POST['credits'], '');
                    $code     = safe_input($_POST['code'], '');
                    
                    
                    $db = fopen("../engine/variables_mods/daopay_donate.tDB", "a+");
                    fwrite($db, $order . "¦" . uniqid() . "¦" . $title . "¦" . $active . "¦" . $amount . "¦" . $currency . "¦" . $credits . "¦" . $code . "¦\n");
                    fclose($db);
                    
                    echo notice_message_admin('Donate Package successfully added', 1, 0, 'index.php?get=daopay&sys=manager');
                    
                }
                
            } else {
                echo '<form action="" method="POST" name="form">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add Donate Package</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Product Code</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter daopay product code.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="code"></td>
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Donate Package Title that will appear on donate packages list.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="title"></td>
    </tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Display Order</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">This controls the order that the donate package will be displayed in for the donate package list and in the Admin Control Panel.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="order" value="0"></td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' doante pacakge will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <label><input type="radio" name="active" checked="checked" value="1">Yes</label> 
    <label><input type="radio" name="active" value="0">No</label></td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Cost Amount and Currency</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set the cost amount and currency for this donate package.</td>
    <td align="left" class="panel_text_alt2" width="50%">Amount <input type="text"  name="amount" size="4">&nbsp;Currency 
    <select name="currency">
    <option value="x">Select Currency</option>
    <optgroup label="----------------">
    <option value="USD">USD</option>
    <option value="EUR">EUR</option>
    </select>
    </td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Credits (MU Coins)</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set the amount of credits that user will recive after donate payment proccess finish.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="credits"></td
    </tr>
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="new">
    <input type="submit" value="Add Donate Package"></td>
    </tr>
    
    </table>
    </form>';
            }
        } elseif ($_GET['mod'] == 'edit') {
            $id  = safe_input(xss_clean($_GET['id']), '');
            $get = file('../engine/variables_mods/daopay_donate.tDB');
            foreach ($get as $data) {
                $data = explode("¦", $data);
                if ($data[1] == $id) {
                    $title    = $data[2];
                    $order    = $data[0];
                    $active   = $data[3];
                    $amount   = $data[4];
                    $currency = $data[5];
                    $credits  = $data[6];
                    $code     = $data[7];
                    
                    break;
                }
            }
            if (isset($_POST['edit'])) {
                if (empty($_POST['title']) || empty($_POST['amount']) || $_POST['currency'] == 'x' || empty($_POST['credits']) || empty($_POST['code'])) {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    $title    = str_replace("¦", "", $_POST['title']);
                    $order    = safe_input($_POST['order'], '');
                    $active   = safe_input($_POST['active'], '');
                    $amount   = safe_input($_POST['amount'], '\.');
                    $currency = safe_input($_POST['currency'], '');
                    $credits  = safe_input($_POST['credits'], '');
                    $code     = safe_input($_POST['code'], '');
                    
                    $old_db = file("../engine/variables_mods/daopay_donate.tDB");
                    $new_db = fopen("../engine/variables_mods/daopay_donate.tDB", "w");
                    foreach ($old_db as $old_db_line) {
                        $old_db_arr = explode("¦", $old_db_line);
                        if ($id != $old_db_arr[1]) {
                            fwrite($new_db, "$old_db_line");
                        } else {
                            fwrite($new_db, $order . "¦" . $id . "¦" . $title . "¦" . $active . "¦" . $amount . "¦" . $currency . "¦" . $credits . "¦" . $code . "¦\n");
                        }
                    }
                    fclose($new_db);
                    echo notice_message_admin('Donate Package successfully edited', 1, 0, 'index.php?get=daopay&sys=manager');
                }
                
                
            } else {
                echo '<form action="" method="POST" name="form">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Donate Package</td>
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Product Code</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter daopay product code.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="code" value="' . $code . '"></td>
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Donate Package Title that will appear on donate packages list.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="title" value="' . $title . '"></td>
    </tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Display Order</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">This controls the order that the donate package will be displayed in for the donate package list and in the Admin Control Panel.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="order" value="' . $order . '"></td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' doante pacakge will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%">';
                switch ($active) {
                    case '0':
                        echo '<label><input type="radio" name="active" value="1">Yes</label> <label><input type="radio" name="active" checked="checked" value="0">No';
                        break;
                    case '1':
                        echo '<label><input type="radio" name="active" checked="checked" value="1">Yes</label> <label><input type="radio" name="active" value="0">No</label>';
                        break;
                }
                
                echo '</td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Cost Amount and Currency</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set the cost amount and currency for this donate package.</td>
    <td align="left" class="panel_text_alt2" width="50%">Amount <input type="text"  name="amount" value="' . $amount . '" size="4">&nbsp;Currency 
    <select name="currency">
    <option value="x">Select Currency</option>
    <optgroup label="----------------">';
                switch ($currency) {
                    case 'USD':
                        echo '<option value="USD" selected="selected">USD</option><option value="EUR">EUR</option>';
                        break;
                    case 'EUR':
                        echo '<option value="USD">USD</option><option value="EUR"  selected="selected">EUR</option>';
                        break;
                }
                
                echo '
    
    
    </select>
    </td
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Credits (MU Coins)</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set the amount of credits that user will recive after donate payment proccess finish.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="credits" value="' . $credits . '"></td
    </tr>
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit">
    <input type="submit" value="Edit Donate Package"></td>
    </tr>
    
    </table>
    </form>';
            }
            
        }
        
        
        
        
    } else {
        if (isset($_POST['save_order'])) {
            foreach ($_POST['display_order'] as $post_name => $post_order) {
                $get_true_config = file('../engine/variables_mods/daopay_donate.tDB');
                foreach ($get_true_config as $old_config) {
                    $old_config = explode("¦", $old_config);
                    if ($old_config[1] == $post_name) {
                        $title    = $old_config[2];
                        $active   = $old_config[3];
                        $amount   = $old_config[4];
                        $currency = $old_config[5];
                        $credits  = $old_config[6];
                        $code     = $old_config[7];
                        break;
                    }
                }
                $new_cfg = safe_input($post_order, '') . "¦" . $post_name . "¦" . $title . "¦" . $active . "¦" . $amount . "¦" . $currency . "¦" . $credits . "¦" . $code . "¦\n";
                
                
                #echo $new_cfg.'<br>';
                
                $old_db = file("../engine/variables_mods/daopay_donate.tDB");
                $new_db = fopen("../engine/variables_mods/daopay_donate.tDB", "w");
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
            echo notice_message_admin('Display Order successfully saved', 1, 0, 'index.php?get=daopay&sys=manager');
        } elseif (isset($_GET['delete'])) {
            if (empty($_GET['delete'])) {
                echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=daopay&sys=manager');
            } else {
                $id = safe_input(xss_clean($_GET['delete']), '_');
                delete_variable('../engine/variables_mods/daopay_donate.tDB', '1', $id, '¦');
                echo notice_message_admin('Donate Package successfully deleted', 1, 0, 'index.php?get=daopay&sys=manager');
            }
            
        } else {
            echo '
<form action="" method="POST" name="save_order">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="8">DaoPay Donate Packages</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2" width="80">Product Code</td>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2" width="100">Display Order</td>
<td align="left" class="panel_title_sub2" width="80">Status</td>
<td align="left" class="panel_title_sub2" width="100">Amount</td>
<td align="left" class="panel_title_sub2" width="60">Currency</td>
<td align="left" class="panel_title_sub2" width="140">Credits (MU Coins)</td>
<td align="left" class="panel_title_sub2" width="80">Controls</td>
</tr>';
            
            $donate_file = get_sort('../engine/variables_mods/daopay_donate.tDB', '¦');
            $count       = 0;
            foreach ($donate_file as $donate) {
                $count++;
                $tr_color = ($count % 2) ? '' : 'even';
                switch ($donate[3]) {
                    case '0':
                        $status = '<em>Inactive</em>';
                        break;
                    case '1':
                        $status = '<b>Active</b';
                        break;
                }
                echo '
        <tr class="' . $tr_color . '">
        <td align="left" class="panel_text_alt_list">' . $donate[7] . '</td>
        <td align="left" class="panel_text_alt_list"><b>' . $donate[2] . '</b></td>
        <td align="left" class="panel_text_alt_list"><input type="text" name="display_order[' . $donate[1] . ']" value="' . $donate[0] . '" size="3"></td>
        <td align="left" class="panel_text_alt_list">' . $status . '</td>
        <td align="left" class="panel_text_alt_list">' . $donate[4] . '</td>
        <td align="left" class="panel_text_alt_list">' . $donate[5] . '</td>
        <td align="left" class="panel_text_alt_list">' . number_format($donate[6]) . '</td>
        <td align="left" class="panel_text_alt_list" width="80"><a href="index.php?get=daopay&sys=manager&mod=edit&id=' . $donate[1] . '">[Edit]</a> / <a href="#" onclick="ask_url(\'Are you sure you want to delete this donate package?\',\'index.php?get=daopay&sys=manager&delete=' . $donate[1] . '\')";>[Delete]</a></td>

        </tr>';
                
            }
            if ($count == '0') {
                echo '<td align="center" class="panel_text_alt_list" colspan="8"><em>No donate packages</em></td>';
            }
            echo '<tr>
<td align="center" class="panel_buttons" colspan="8">

<input type="hidden" name="save_order">
<input type="submit" value="Save Display Order"> <input type="button" value="Add New Donate Package" onclick="location.href=\'index.php?get=daopay&sys=manager&mod=new\'"></td>
</tr>
</table>
</form>';
            
        }
        
        
    }
    
} elseif ($_GET['sys'] == 'logs') {
    $log_dir = '../engine/logs/daopay';
    
    if (isset($_GET['delete_logs_date'])) {
        if (empty($_GET['delete_logs_date'])) {
            echo notice_message_admin('Unable to proceed your request.', '0', '1', '0');
        } else {
            $log_id = safe_input($_GET['delete_logs_date'], '\_');
            if (unlink($log_dir . '/' . $log_id . '.log')) {
                echo notice_message_admin('Logs from  ' . str_replace("_", " ", $log_id) . ' successfully deleted', 1, 0, 'index.php?get=daopay&sys=logs');
            }
        }
        
    } elseif (isset($_POST['clean_logs'])) {
        if (is_dir($log_dir)) {
            if ($dh = opendir($log_dir)) {
                $count = 0;
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        if (unlink($log_dir . '/' . $file)) {
                            $count++;
                        }
                        
                    }
                }
            }
        }
        echo notice_message_admin('<b>' . $count . '</b> logs have been successfully deleted', 1, 0, 'index.php?get=daopay&sys=logs');
    } else {
        if (isset($_GET['date'])) {
            $date = safe_input($_GET['date'], '\_');
        }
        
        
        echo '
        
<form action="" name="form_c" method="POST">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Logs Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Delete Logs</td>
</tr>

<tr>
<td align="left" class="panel_buttons">This is used to delete all logs.</td>
<td align="right" class="panel_buttons">
<input type="hidden" name="clean_logs">
<input type="submit" value="Delete All Logs" onclick="return ask_form(\'Are you sure you want to delete all logs?\')"></td>
</tr>


</table>
</form>';
        
        
        echo '


<div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=daopay&sys=logs">[View Today Logs]</a></div>
<div align="left" style="width: 90%; margin-bottom: 2px;"><form name="form1">
  <select name="date" onChange="MM_jumpMenu(\'parent\',this,0)">
  <optgroup label="---------------------------------------">
  <option value="index.php?get=daopay&sys=logs" selected="selected">Today (' . date('F j Y') . ')</option>
        <optgroup label="---------------------------------------">';
        
        
        
        if (is_dir($log_dir)) {
            if ($dh = opendir($log_dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $file = substr_replace($file, "", -4);
                        if ($date == $file) {
                            echo '<option value="index.php?get=daopay&sys=logs&date=' . $file . '" selected="selected">' . str_replace("_", " ", $file) . '</option>';
                        } else {
                            echo '<option value="index.php?get=daopay&sys=logs&date=' . $file . '">' . str_replace("_", " ", $file) . '</option>';
                        }
                    }
                    
                }
                closedir($dh);
            }
        }
        echo '
    
  </select>
</form></div>
';
        
        if (!isset($_GET['date'])) {
            $date = date('F_j_Y');
        } else {
            $date = safe_input($_GET['date'], '\_');
        }
        
        
        
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">DaoPay Donate System Logs</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Action</td>
<td align="left" class="panel_title_sub2" width="110">Date</td>
</tr>';
        
        
        $count = 0;
        
        if (is_file($log_dir . '/' . $date . '.log')) {
            $open_log = array_reverse(file($log_dir . '/' . $date . '.log'));
            foreach ($open_log as $log) {
                $count++;
                $tr_color = ($count % 2) ? '' : 'even';
                echo '
    <tr class="' . $tr_color . '">
    <td align="left" class="panel_text_alt_list">' . $log . '</td>
    <td align="left" class="panel_text_alt_list" >' . str_replace("_", " ", $date) . '</td>
    </tr>';
                
            }
        }
        
        if ($count == '0') {
            echo '
    <tr>
    <td align="center" class="panel_text_alt_list" colspan="2"><em>No logs found on ' . str_replace("_", " ", $date) . '</em></td>
    </tr>';
        } else {
            if ($date != date('F_j_Y')) {
                echo '<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="button" value="Delete ' . str_replace("_", " ", $date) . ' Logs" onclick="ask_url(\'Are you sure?\',\'index.php?get=daopay&sys=logs&delete_logs_date=' . $date . '\')"></td>
</tr>';
            }
            
        }
        echo '</table>';
        
    }
    
    
    
} elseif ($_GET['sys'] == 'transactions') {
    if (isset($_GET['delete'])) {
        if (empty($_GET['delete'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=daopay&sys=transactions');
        } else {
            $id         = safe_input($_GET['delete'], '');
            $delete_txn = $core_db->Execute("Delete from MUCore_DaoPay_Donate_Transactions where id=?", array(
                $id
            ));
            if ($delete_txn) {
                echo notice_message_admin('DaoPay Transaction successfully deleted.', 1, 0, 'index.php?get=daopay&sys=transactions');
            } else {
                echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=daopay&sys=transactions');
            }
        }
        
    } else {
        echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Search DaoPay Donate Transactions</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Order No</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter DaoPay Order No.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" name="txn_id">
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">User ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter User ID of account.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" name="userid">
</td>
</tr>




<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="search">
<input type="submit" value="Search"></td>
</tr>
</table>
</form>
';
        
        if (!isset($_POST['txn_id']) || !isset($_POST['userid'])) {
            $txn_select = $core_db->Execute("Select top 50 id,memb___id,transaction_id,code,order_date,credits,status from MUCore_DaoPay_Donate_Transactions order by order_date desc");
            $txn_text   = 'Last 50 DaoPay Donate Transactions';
        } else {
            if (!empty($_POST['txn_id'])) {
                $txn_text   = 'Search Results';
                $search     = safe_input($_POST['txn_id']);
                $txn_select = $core_db->Execute("Select id,memb___id,transaction_id,code,order_date,credits,status from MUCore_DaoPay_Donate_Transactions where transaction_id=? order by order_date desc", array(
                    $search
                ));
            } elseif (!empty($_POST['userid'])) {
                $txn_text   = 'Search Results';
                $search     = safe_input($_POST['userid']);
                $txn_select = $core_db->Execute("Select id,memb___id,transaction_id,code,order_date,credits,status from MUCore_DaoPay_Donate_Transactions where memb___id=? order by order_date desc", array(
                    $search
                ));
            } else {
                $txn_text   = 'Last 50 PayPal Donate Transactions';
                $txn_select = $core_db->Execute("Select top 50 id,memb___id,transaction_id,code,order_date,credits,status from MUCore_DaoPay_Donate_Transactions order by order_date desc");
            }
            
        }
        
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="8">' . $txn_text . '</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2" width="80">User ID</td>
<td align="left" class="panel_title_sub2">Order No</td>
<td align="left" class="panel_title_sub2">Product Code</td>
<td align="left" class="panel_title_sub2" width="100">Issued Credits</td>
<td align="left" class="panel_title_sub2" width="140">Processed Date</td>
<td align="left" class="panel_title_sub2" width="100">Payment Status</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
        $count = 0;
        
        while (!$txn_select->EOF) {
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            echo '<tr class="' . $tr_color . '">
                <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($txn_select->fields[1]) . '</strong></td>
                <td align="left" class="panel_text_alt_list">' . $txn_select->fields[2] . '</td>
                <td align="left" class="panel_text_alt_list">' . $txn_select->fields[3] . '</td>
                <td align="left" class="panel_text_alt_list">' . number_format($txn_select->fields[5]) . '</td>
                <td align="left" class="panel_text_alt_list">' . date('F j, Y / H:i', $txn_select->fields[4]) . '</td>
                <td align="left" class="panel_text_alt_list">' . $txn_select->fields[6] . '</td>
                <td align="left" class="panel_text_alt_list"><a href="#" onclick="ask_url(\'Are you sure you want to delete this transaction?\',\'index.php?get=daopay&sys=transactions&delete=' . $txn_select->fields[0] . '\')";>[Delete]</a></td>
                </tr>';
            
            $txn_select->MoveNext();
        }
        if ($count == '0') {
            echo '<tr>
                <td align="center" class="panel_text_alt_list" colspan="8"><em>No transactions</em></td>
                </tr>';
        }
        echo '</table>';
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