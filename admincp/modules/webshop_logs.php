<?php
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
require('../engine/webshop.php');
echo '<form action="index.php?get=webshop_logs" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Logs</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">User ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter the User ID.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" name="userid"><br>
</td>
</tr>






<tr>
<td align="left" class="panel_buttons"><input type="hidden" name="search"><a href="index.php?get=webshop_logs&m=today">[Show today logs]</a></td>
<td align="right" class="panel_buttons"><input type="hidden" name="search"><input type="submit" value="Search"></td>
</tr>
</table>
</form>
';

if ($_GET['m'] == 'today') {
    $normal_logs = '0';
} elseif (isset($_POST['search']) && !empty($_POST['userid'])) {
    $normal_logs = '1';
}

if (isset($normal_logs)) {
    if ($normal_logs == '0') {
        $query = $core_db->Execute("Select memb___id,content,item_serial,date_time from MUCore_Shop_Logs where date_time > " . strtotime(date('m/d/Y')) . "");
    } elseif ($normal_logs == '1') {
        $userid = str_replace("'", "", $_POST['userid']);
        $query  = $core_db->Execute("Select memb___id,content,item_serial,date_time from MUCore_Shop_Logs where memb___id like ?", array(
            '%' . $userid . '%'
        ));
    }
    
    
    echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="5">Search Results</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">User ID</td>
<td align="left" class="panel_title_sub2">Action</td>
<td align="left" class="panel_title_sub2">Item Serial</td>
<td align="left" class="panel_title_sub2">Date</td>
</tr>';
    $count = 0;
    while (!$query->EOF) {
        $count++;
        $tr_color = ($count % 2) ? '' : 'even';
        echo '
        <tr class="' . $tr_color . '">
        <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($query->fields[0]) . '</strong></td>
        <td align="left" class="panel_text_alt_list">' . htmlspecialchars($query->fields[1]) . '</td>
        <td align="left" class="panel_text_alt_list">' . $query->fields[2] . '</td>
        <td align="left" class="panel_text_alt_list">' . date("F j, Y H:i", $query->fields[3]) . '</td>
        </tr>';
        
        $query->MoveNext();
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