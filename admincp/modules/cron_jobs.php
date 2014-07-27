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
            if ($_POST['time'] == 'x' || empty($_POST['title']) || empty($_POST['cron_id'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $title        = safe_input($_POST['title'], '\ ');
                $cron_id      = safe_input($_POST['cron_id'], '');
                $time         = safe_input($_POST['time'], '');
                $check_for_id = $core_db->Execute("Select id from MUCore_Cron_Jobs where cron_id=?", array(
                    $cron_id
                ));
                if (!$check_for_id->EOF) {
                    echo notice_message_admin('There is already ony cron job with this cron job id: <b>' . $cron_id . '</b>.', '0', '1', '0');
                } else {
                    $total_time  = $time * 3600;
                    $insert_cron = $core_db->Execute("Insert into MUCore_Cron_Jobs (name,cron_id,next_cron,cron_time_set) VALUES (?,?,?,?)", array(
                        $title,
                        $cron_id,
                        time() + $total_time,
                        $total_time
                    ));
                    if ($insert_cron) {
                        echo notice_message_admin('Cron Job successfully added', 1, 0, 'index.php?get=cron_jobs');
                    }
                }
                
                
            }
            
        } else {
            echo '<form action="" method="POST" name="form">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add Cron Job</td>
    </tr>
    <tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter cron job title.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="title" ></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Run Time</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Select run time of cron job.</td>
    <td align="left" class="panel_text_alt2" width="50%"><select name="time">
    <option value="x" selected="selected">Select run time</option>
        <optgroup label="---------------------------">
        <option value="1">1 Hour</option>
        ';
            $i = 1;
            while ($i <= 167) {
                $i++;
                echo '<option value="' . $i . '">' . $i . ' Hours</option>';
            }
            echo '
        

        
    </select></td>
    </tr>
    

    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">ID</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter cron job ID. Use only letters and numbers.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="cron_id" ></td>
    </tr>
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="new">
    <input type="submit" value="Add Cron Job"></td>
    </tr>
    
    </table>
    </form>';
        }
    } elseif ($_GET['mod'] == 'edit') {
        $id        = safe_input($_GET['id'], '');
        $take_info = $core_db->Execute("Select name,next_cron,cron_id,cron_time_set from MUCore_Cron_Jobs where id=?", array(
            $id
        ));
        if (isset($_POST['edit'])) {
            if ($_POST['time'] == 'x' || empty($_POST['title']) || empty($_POST['cron_id'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $title   = safe_input($_POST['title'], '\ ');
                $cron_id = safe_input($_POST['cron_id'], '');
                $time    = safe_input($_POST['time'], '');
                
                $total_time  = $time * 3600;
                $update_cron = $core_db->Execute("Update MUCore_Cron_Jobs set name=?,cron_time_set=?,cron_id=? where id=?", array(
                    $title,
                    $total_time,
                    $cron_id,
                    $id
                ));
                if ($update_cron) {
                    echo notice_message_admin('Cron Job successfully edited', 1, 0, 'index.php?get=cron_jobs');
                }
                
                
            }
            
        } else {
            if (!$take_info->EOF) {
                echo '<form action="" method="POST" name="form">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Cron Job</td>
    </tr>
    <tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter cron job title.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="title" value="' . $take_info->fields[0] . '"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Run Time</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Select run time of cron job.</td>
    <td align="left" class="panel_text_alt2" width="50%"><select name="time">
    <option value="x" selected="selected">Select run time</option>
        <optgroup label="---------------------------">
        
        ';
                $i           = 0;
                $time_select = $take_info->fields[3] / 3600;
                while ($i <= 168) {
                    $i++;
                    if ($i == $time_select) {
                        echo '<option value="' . $i . '" selected="selected">' . $i . ' Hours</option>';
                    } else {
                        echo '<option value="' . $i . '">' . $i . ' Hours</option>';
                    }
                    
                }
                echo '
        

        
    </select></td>
    </tr>
    

    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">ID</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter cron job ID. Use only letters and numbers.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="cron_id" value="' . $take_info->fields[2] . '"></td>
    </tr>
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit">
    <input type="submit" value="Edit Cron Job"></td>
    </tr>
    
    </table>
    </form>';
            }
            
        }
    }
    
} else {
    if (isset($_GET['delete'])) {
        $id          = safe_input($_GET['delete'], '');
        $delete_cron = $core_db->Execute("Delete from MUCore_Cron_Jobs where id=?", array(
            $id
        ));
        if ($delete_cron) {
            echo notice_message_admin('Cron Job successfully deleted', 1, 0, 'index.php?get=cron_jobs');
        }
        
    } else {
        $cron = $core_db->Execute("Select id,name,cron_id,next_cron,cron_time_set from MUCore_Cron_Jobs order by next_cron asc");
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="5">Cron Jobs</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Cron ID</td>
<td align="left" class="panel_title_sub2">Time Set</td>
<td align="left" class="panel_title_sub2">Next Run</td>
<td align="left" class="panel_title_sub2" width="80">Controls</td>
</tr>';
        $count = 0;
        while (!$cron->EOF) {
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($cron->fields[1]) . '</strong></td>
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($cron->fields[2]) . '</strong></td>
            <td align="left" class="panel_text_alt_list"><strong>' . ($cron->fields[4] / 3600) . ' Hours</strong></td>
            <td align="left" class="panel_text_alt_list">' . decode_time(time(), $cron->fields[3], 'long', 'Running...') . '</td>
            <td align="left" class="panel_text_alt_list" width="80"><a href="index.php?get=cron_jobs&mod=edit&id=' . $cron->fields[0] . '">[Edit]</a> / <a href="javascript:;" onclick="ask_url(\'Are you sure you want to delete this Cron Job?\',\'index.php?get=cron_jobs&delete=' . $cron->fields[0] . '\')";>[Delete]</a></td>
            </tr>';
            $cron->MoveNext();
        }
        if ($count == '0') {
            echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Cron Jobs Found</td></tr>';
        }
        
        
        echo '
            <tr>
<td align="center" class="panel_buttons" colspan="5">
<input type="button" value="Add New Cron Job" onclick="location.href=\'index.php?get=cron_jobs&mod=new\'"></td>
</tr>
            </table>';
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