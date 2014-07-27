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
            if (empty($_POST['title']) || empty($_POST['amount']) || $_POST['currency'] == 'x' || empty($_POST['credits'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $title    = str_replace("¦", "", $_POST['title']);
                $order    = safe_input($_POST['order'], '');
                $active   = safe_input($_POST['active'], '');
                $amount   = safe_input($_POST['amount'], '\.');
                $currency = safe_input($_POST['currency'], '');
                $credits  = safe_input($_POST['credits'], '');
                
                $db = fopen("../engine/variables_mods/paypal_donate.tDB", "a+");
                fwrite($db, $order . "¦" . uniqid() . "¦" . $title . "¦" . $active . "¦" . $amount . "¦" . $currency . "¦" . $credits . "¦\n");
                fclose($db);
                
                echo notice_message_admin('Donate Package successfully added', 1, 0, 'index.php?get=doante_paypal_manager');
                
            }
            
        } else {
            echo '<form action="" method="POST" name="form">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add Donate Package</td>
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
        $get = file('../engine/variables_mods/paypal_donate.tDB');
        foreach ($get as $data) {
            $data = explode("¦", $data);
            if ($data[1] == $id) {
                $title    = $data[2];
                $order    = $data[0];
                $active   = $data[3];
                $amount   = $data[4];
                $currency = $data[5];
                $credits  = $data[6];
                
                break;
            }
        }
        if (isset($_POST['edit'])) {
            if (empty($_POST['title']) || empty($_POST['amount']) || $_POST['currency'] == 'x' || empty($_POST['credits'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $title    = str_replace("¦", "", $_POST['title']);
                $order    = safe_input($_POST['order'], '');
                $active   = safe_input($_POST['active'], '');
                $amount   = safe_input($_POST['amount'], '\.');
                $currency = safe_input($_POST['currency'], '');
                $credits  = safe_input($_POST['credits'], '');
                
                $old_db = file("../engine/variables_mods/paypal_donate.tDB");
                $new_db = fopen("../engine/variables_mods/paypal_donate.tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($id != $old_db_arr[1]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $order . "¦" . $id . "¦" . $title . "¦" . $active . "¦" . $amount . "¦" . $currency . "¦" . $credits . "¦\n");
                    }
                }
                fclose($new_db);
                echo notice_message_admin('Donate Package successfully edited', 1, 0, 'index.php?get=doante_paypal_manager');
            }
            
            
        } else {
            echo '<form action="" method="POST" name="form">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Donate Package</td>
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
            $get_true_config = file('../engine/variables_mods/paypal_donate.tDB');
            foreach ($get_true_config as $old_config) {
                $old_config = explode("¦", $old_config);
                if ($old_config[1] == $post_name) {
                    $title    = $old_config[2];
                    $active   = $old_config[3];
                    $amount   = $old_config[4];
                    $currency = $old_config[5];
                    $credits  = $old_config[6];
                    break;
                }
            }
            $new_cfg = safe_input($post_order, '') . "¦" . $post_name . "¦" . $title . "¦" . $active . "¦" . $amount . "¦" . $currency . "¦" . $credits . "¦\n";
            
            
            #echo $new_cfg.'<br>';
            
            $old_db = file("../engine/variables_mods/paypal_donate.tDB");
            $new_db = fopen("../engine/variables_mods/paypal_donate.tDB", "w");
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
        echo notice_message_admin('Display Order successfully saved', 1, 0, 'index.php?get=doante_paypal_manager');
    } elseif (isset($_GET['delete'])) {
        if (empty($_GET['delete'])) {
            echo notice_message_admin('Unable to proceed your request.', '1', '1', 'index.php?get=doante_paypal_manager');
        } else {
            $id = safe_input(xss_clean($_GET['delete']), '_');
            delete_variable('../engine/variables_mods/paypal_donate.tDB', '1', $id, '¦');
            echo notice_message_admin('Donate Package successfully deleted', 1, 0, 'index.php?get=doante_paypal_manager');
        }
        
    } else {
        echo '
<form action="" method="POST" name="save_order">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="7">PayPal Donate Packages</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2" width="100">Display Order</td>
<td align="left" class="panel_title_sub2" width="80">Status</td>
<td align="left" class="panel_title_sub2" width="100">Amount</td>
<td align="left" class="panel_title_sub2" width="60">Currency</td>
<td align="left" class="panel_title_sub2" width="140">Credits (MU Coins)</td>
<td align="left" class="panel_title_sub2" width="80">Controls</td>
</tr>';
        
        $donate_file = get_sort('../engine/variables_mods/paypal_donate.tDB', '¦');
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
        <td align="left" class="panel_text_alt_list"><b>' . $donate[2] . '</b></td>
        <td align="left" class="panel_text_alt_list"><input type="text" name="display_order[' . $donate[1] . ']" value="' . $donate[0] . '" size="3"></td>
        <td align="left" class="panel_text_alt_list">' . $status . '</td>
        <td align="left" class="panel_text_alt_list">' . $donate[4] . '</td>
        <td align="left" class="panel_text_alt_list">' . $donate[5] . '</td>
        <td align="left" class="panel_text_alt_list">' . number_format($donate[6]) . '</td>
        <td align="left" class="panel_text_alt_list" width="80"><a href="index.php?get=doante_paypal_manager&mod=edit&id=' . $donate[1] . '">[Edit]</a> / <a href="#" onclick="ask_url(\'Are you sure you want to delete this donate package?\',\'index.php?get=doante_paypal_manager&delete=' . $donate[1] . '\')";>[Delete]</a></td>

        </tr>';
            
        }
        if ($count == '0') {
            echo '<td align="center" class="panel_text_alt_list" colspan="7"><em>No donate packages</em></td>';
        }
        echo '<tr>
<td align="center" class="panel_buttons" colspan="7">

<input type="hidden" name="save_order">
<input type="submit" value="Save Display Order"> <input type="button" value="Add New Donate Package" onclick="location.href=\'index.php?get=doante_paypal_manager&mod=new\'"></td>
</tr>
</table>
</form>';
        
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