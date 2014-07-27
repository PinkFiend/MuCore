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
$log_dir = '../engine/logs/gmcp/gmcp_access';
if (isset($_GET['delete_logs_date'])) {
    if (empty($_GET['delete_logs_date'])) {
        echo notice_message_admin('Unable to proceed your request.', '0', '1', '0');
    } else {
        $log_id = safe_input($_GET['delete_logs_date'], '\_');
        if (unlink($log_dir . '/' . $log_id . '.log')) {
            echo notice_message_admin('Logs from  ' . str_replace("_", " ", $log_id) . ' successfully edited', 1, 0, 'index.php?get=logs_gm_access');
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
    echo notice_message_admin('<b>' . $count . '</b> logs have been successfully deleted', 1, 0, 'index.php?get=logs_gm_access');
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


<div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=logs_gm_access">[View Today Logs]</a></div>
<div align="left" style="width: 90%; margin-bottom: 2px;"><form name="form1">
  <select name="date" onChange="MM_jumpMenu(\'parent\',this,0)">
  <optgroup label="---------------------------------------">
  <option value="index.php?get=logs_gm_access" selected="selected">Today (' . date('F j Y') . ')</option>
        <optgroup label="---------------------------------------">';
    
    
    
    if (is_dir($log_dir)) {
        if ($dh = opendir($log_dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..') {
                    $file = substr_replace($file, "", -4);
                    if ($date == $file) {
                        echo '<option value="index.php?get=logs_gm_access&date=' . $file . '" selected="selected">' . str_replace("_", " ", $file) . '</option>';
                    } else {
                        echo '<option value="index.php?get=logs_gm_access&date=' . $file . '">' . str_replace("_", " ", $file) . '</option>';
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
 <td align="center" class="panel_title" colspan="2">Game Master Access Logs</td>
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
<input type="button" value="Delete ' . str_replace("_", " ", $date) . ' Logs" onclick="ask_url(\'Are you sure?\',\'index.php?get=logs_gm_access&delete_logs_date=' . $date . '\')"></td>
</tr>';
        }
        
    }
    echo '</table>';
    
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