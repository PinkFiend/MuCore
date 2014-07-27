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
echo '
        
<form action="" name="form_c" method="POST">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Export Items</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Export Items as SQL query file</td>
</tr>

<tr>
<td align="left" class="panel_buttons">All your webshop items will be exported into an text file.</td>
<td align="right" class="panel_buttons">
<input type="hidden" name="export_items">
<input type="submit" value="Export Items"></td>
</tr>


</table>
</form>';

if (isset($_POST['export_items'])) {
    $ex = $core_db->Execute("Select name,i_type,i_id,credits,serial,i_luck_option,i_skill_option,size_x,size_y,i_default_durability,i_maximum_durability,category,i_max_excelent_option,i_max_option,i_max_level,i_refined_option,i_harmony_option,i_socket_option,i_option,i_exc_option,class_requirement,ancient_id,i_stock,i_image,i_sell,i_stick_level,exc_anc from MUCore_Shop_Items");
    while (!$ex->EOF) {
        $ex_data .= "INSERT INTO MUCore_Shop_Items(name,i_type,i_id,credits,serial,i_luck_option,i_skill_option,size_x,size_y,i_default_durability,i_maximum_durability,category,i_max_excelent_option,i_max_option,i_max_level,i_refined_option,i_harmony_option,i_socket_option,i_option,i_exc_option,class_requirement,ancient_id,i_stock,i_image,i_sell,i_stick_level,exc_anc)VALUES('" . str_replace("'", "", $ex->fields[0]) . "','" . $ex->fields[1] . "','" . $ex->fields[2] . "','" . $ex->fields[3] . "','" . $ex->fields[4] . "','" . $ex->fields[5] . "','" . $ex->fields[6] . "','" . $ex->fields[7] . "','" . $ex->fields[8] . "','" . $ex->fields[9] . "','" . $ex->fields[10] . "','" . $ex->fields[11] . "','" . $ex->fields[12] . "','" . $ex->fields[13] . "','" . $ex->fields[14] . "','" . $ex->fields[15] . "','" . $ex->fields[16] . "','" . $ex->fields[17] . "','" . $ex->fields[18] . "','" . $ex->fields[19] . "','" . $ex->fields[20] . "','" . $ex->fields[21] . "','" . $ex->fields[22] . "','" . $ex->fields[23] . "','" . $ex->fields[24] . "','" . $ex->fields[25] . "','" . $ex->fields[26] . "')\r\n";
        
        $ex->MoveNext();
    }
    
    ob_end_clean();
    header("Content-type: txt/plain");
    header("Content-Disposition:attachment;filename=MUCore_Shop_Items.sql");
    echo $ex_data;
    break;
    
    
    
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