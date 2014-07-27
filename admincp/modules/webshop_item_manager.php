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
require('../engine/webshop_custom_variables.php');
if ($_GET['m'] == 'new') {
    $insert_item = $core_db->Execute("INSERT INTO MUCore_Shop_Items (i_type,i_id,name,credits,i_skill_option,i_option,size_x,size_y,i_default_durability,category,i_exc_option,i_max_level,i_luck_option,i_stick_level,serial,class_requirement,exc_anc) VALUES ('14','13','New Item','0','0','0','1','1','','14','0',0,0,0,1,'999','0')");
    if ($insert_item) {
        $take_last_item = $core_db->Execute("Select top 1 id from MUCore_Shop_Items order by id desc");
        
        
        echo notice_message_admin('Item successfully created, you wil be redirected to edit panel.', 1, 0, 'index.php?get=webshop_item_manager&m=edit&id=' . $take_last_item->fields[0] . '');
        
    }
    
} elseif ($_GET['m'] == 'edit') {
    $id = safe_input($_GET['id'], '');
    if (isset($_POST['edit'])) {
        if (empty($_POST['i_name'])) {
            echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
        } else {
            $i_serial = '1';
            
            if (@$_POST['credits'] == '') {
                $_POST['credits'] = '0';
            }
            if (@!$_POST['i_luck']) {
                @!$_POST['i_luck'] = '0';
            }
            if (@!$_POST['i_skill']) {
                $_POST['i_skill'] = '0';
            }
            if (@$_POST['i_stick_level'] == '0') {
                $_POST['i_stick_level'] = '';
            }
            if (@$_POST['i_max_excelent_option'] == '0') {
                $_POST['i_max_excelent_option'] = '';
            }
            if (@$_POST['i_max_option'] == '0') {
                $_POST['i_max_option'] = '';
            }
            if (@$_POST['i_max_level'] == '0') {
                $_POST['i_max_level'] = '';
            }
            if (@!$_POST['i_refined']) {
                $_POST['i_refined'] = '0';
            }
            if (@!$_POST['i_harmony']) {
                $_POST['i_harmony'] = '0';
            }
            
            if (@!$_POST['i_sell']) {
                $_POST['i_sell'] = '0';
            }
            
            
            $count_class_id = 0;
            foreach ($_POST['class_requirement'] as $class_post_id => $class_post_var) {
                $class_requirement[] = $class_post_var;
                $count_class_id++;
            }
            
            if ($count_class_id <= 0) {
                $i_class = '999';
            } else {
                $i_class = implode(',', $class_requirement);
                
            }
            
            
            $update_item = $core_db->Execute("Update MUCore_Shop_Items set 
        name=?,
        i_id=?,
        i_type=?,
        i_stick_level=?,
        category=?,
        size_x=?,
        size_y=?,
        i_option=?,
        i_exc_option=?,
        i_max_level=?,
        i_max_option=?,
        i_max_excelent_option=?,
        i_default_durability=?,
        i_maximum_durability=?,
        i_harmony_option=?,
        i_refined_option=?,
        i_socket_option=?,
        i_luck_option=?,
        i_skill_option=?,
        class_requirement=?,
        ancient_id=?,
        credits=?,
        i_stock=?,
        serial=?,
        i_sell=?,
        i_image=?, 
        exc_anc=? where id=?", array(
                $_POST['i_name'],
                $_POST['i_id'],
                $_POST['i_type'],
                $_POST['i_stick_level'],
                $_POST['i_category'],
                $_POST['i_x'],
                $_POST['i_y'],
                $_POST['i_option'],
                $_POST['i_excelent_option'],
                $_POST['i_max_level'],
                $_POST['i_max_option'],
                $_POST['i_max_excelent_option'],
                $_POST['i_default_durability'],
                $_POST['i_max_durability'],
                $_POST['i_harmony'],
                $_POST['i_refined'],
                $_POST['i_socket'],
                $_POST['i_luck'],
                $_POST['i_skill'],
                $i_class,
                $_POST['i_ancient'],
                $_POST['credits'],
                $_POST['i_stock'],
                $i_serial,
                $_POST['i_sell'],
                $_POST['i_image'],
                $_POST['exc_anc'],
                $id
            ));
            if ($update_item) {
                echo notice_message_admin('Item successfully edited', 1, 0, 'index.php?get=webshop_item_manager&m=edit&id=' . $id . '');
            }
            
        }
    } else {
        $item = $core_db->Execute("Select 
        id,
        name,
        i_id,
        i_type,
        i_stick_level,
        category,
        size_x,
        size_y,
        i_option,
        i_exc_option,
        i_max_level,
        i_max_option,
        i_max_excelent_option,
        i_default_durability,
        i_maximum_durability,
        i_harmony_option,
        i_refined_option,
        i_socket_option,
        i_luck_option,
        i_skill_option,
        class_requirement,
        ancient_id,
        credits,
        i_stock,
        i_sell,
        i_image,exc_anc from MUCore_Shop_Items where id=?", array(
            $id
        ));
        echo '<div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=webshop_item_manager">[Return Search Item]</a></div>
    <form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Item (' . htmlspecialchars($item->fields[1]) . ') </td>
    </tr>

        <tr>
    <td align="left" class="panel_title_sub" colspan="2">On Sell</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">If checked item will be available for sell on webshop.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="checkbox" name="i_sell" value="1"';
        if ($item->fields[24] == '1') {
            echo 'checked="checked"';
        }
        echo '> Yes</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Credits Cost</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">How much dose this item cost in webshop.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="credits" value="' . $item->fields[22] . '"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Item Stock</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set how many items like this can be sell on webshop.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="i_stock" value="' . $item->fields[23] . '"> <b>Note:</b> Leave empty for unlimited sell item.</td>
    </tr>
        <tr>
    <td align="right" class="panel_buttons" colspan="2">
    <input type="submit" value="Edit Item" onclick="return ask_form(\'Are you sure?\')"></td>
    </tr>    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Name</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s name.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="i_name" value="' . htmlspecialchars($item->fields[1]) . '"></td>
    </tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Image Path</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Item\'s image path.</td>
    <td align="left" class="panel_text_alt2" width="50%">Default: ' . item_image($item->fields[2], $item->fields[3], '0', $item->fields[4]) . '<br>
    Custom: <input type="text" name="i_image" value="' . $item->fields[25] . '"> <b>Note:</b> Leave empty if you want to use default.</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Category</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s category.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="i_category">
    <option>Choose Cateogry</option>
    <optgroup label="---------------">
    ';
        foreach ($items_categories as $category_id => $category_value) {
            if ($category_id == $item->fields[5]) {
                echo '<option value="' . $category_id . '" selected>' . $category_value . '</option>';
                
            } else {
                echo '<option value="' . $category_id . '">' . $category_value . '</option>';
            }
        }
        
        echo '
    </select>
    </td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Size</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s X and Y size.</td>
    <td align="left" class="panel_text_alt2" width="50%">X: <input type="text" name="i_x" value="' . $item->fields[6] . '" size="3"> Y: <input type="text" name="i_y" value="' . $item->fields[7] . '" size="3"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Type / Index</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s type and index.</td>
    <td align="left" class="panel_text_alt2" width="50%">Type: <input type="text" name="i_type" value="' . $item->fields[3] . '" size="3"> 
    Index: <input type="text" name="i_id" value="' . $item->fields[2] . '" size="3"></td>
    </tr>
    
<tr>
    <td align="left" class="panel_title_sub" colspan="2">Ancient Group / Excelent Ancient Options</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Item\'s ancient group.</td>
    <td align="left" class="panel_text_alt2" width="50%">
        <select name="i_ancient">
    <option>Choose Ancient Group</option>
    <optgroup label="---------------">
    ';
        foreach ($items_ancient_groups as $ancient_id => $ancient_var) {
            if ($ancient_id == $item->fields[21]) {
                echo '<option value="' . $ancient_id . '" selected>' . $ancient_var . '</option>';
            } else {
                echo '<option value="' . $ancient_id . '">' . $ancient_var . '</option>';
            }
        }
        
        echo '
    </select><br><br>
    Enable Excelent Options: <input type="checkbox" name="exc_anc" value="1"';
        if ($item->fields[26] == '1') {
            echo 'checked="checked"';
        }
        echo '> Yes
    </td>
    </tr>    

    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Option / Excelent Option, Types</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Item\'s option and excelent option types.</td>
    <td align="left" class="panel_text_alt2" width="50%">Option Type: 
        <select name="i_option">
    <option>Choose Option</option>
    <optgroup label="---------------">
    ';
        foreach ($items_options_type as $i_opt_id => $i_opt_var) {
            if ($i_opt_id == $item->fields[8]) {
                echo '<option value="' . $i_opt_id . '" selected>' . $i_opt_var . '</option>';
                
            } else {
                echo '<option value="' . $i_opt_id . '">' . $i_opt_var . '</option>';
            }
        }
        
        echo '
    </select><br>
    
    Excelent Option Type:
    
            <select name="i_excelent_option">
    <option>Choose Option</option>
    <optgroup label="---------------">
    ';
        foreach ($items_excelent_options_type as $i_exc_opt_id => $i_exc_opt_var) {
            if ($i_exc_opt_id == $item->fields[9]) {
                echo '<option value="' . $i_exc_opt_id . '" selected>' . $i_exc_opt_var . '</option>';
                
            } else {
                echo '<option value="' . $i_exc_opt_id . '">' . $i_exc_opt_var . '</option>';
            }
        }
        
        echo '
    </select>
    
    </td>
    </tr>    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Maximum: Level / Options / Excelent Options</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s maximum level, options and excelent options.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    Level: <input type="text" name="i_max_level" value="' . $item->fields[10] . '" size="3"> 
    Options: <input type="text" name="i_max_option" value="' . $item->fields[11] . '" size="3">
    Excelent Options: <input type="text" name="i_max_excelent_option" value="' . $item->fields[12] . '" size="3">
    </td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Durability</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s durability.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="i_default_durability" value="' . $item->fields[13] . '"><input type="hidden" name="i_max_durability" value="' . $item->fields[14] . '" size="3">
    </td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Game Options</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Item\'s in game options.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    Add Harmony: <input type="checkbox" name="i_harmony" value="1"';
        if ($item->fields[15] == '1') {
            echo 'checked="checked"';
        }
        echo '> <br>
    Add Refined: <input type="checkbox" name="i_refined" value="1"';
        if ($item->fields[16] == '1') {
            echo 'checked="checked"';
        }
        echo '> <br>
    Can Be Socked: <input type="checkbox" name="i_socket" value="1"';
        if ($item->fields[17] == '1') {
            echo 'checked="checked"';
        }
        echo '> <br>
    Luck: <input type="checkbox" name="i_luck" value="1"';
        if ($item->fields[18] == '1') {
            echo 'checked="checked"';
        }
        echo '> <br>
    Skill: <input type="checkbox" name="i_skill" value="1"';
        if ($item->fields[19] == '1') {
            echo 'checked="checked"';
        }
        echo '> <br>
    </td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Stick Level</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Item\'s stick level.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="i_stick_level" value="' . $item->fields[4] . '"> 
    </td>
    </tr>
    
    

    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Infos</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%" valign="top">Item\'s infos.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <b>Can be equiped by:</b><br>
    ';
        $i_class_requirement = explode(',', $item->fields[20]);
        
        
        
        
        foreach ($characters_class as $class_id => $class_var) {
            if (in_array($class_id, $i_class_requirement)) {
                echo '' . $class_var[0] . ' <input type="checkbox" name="class_requirement[]" value="' . $class_id . '" checked="checked"> <br>';
            } else {
                echo '' . $class_var[0] . ' <input type="checkbox" name="class_requirement[]" value="' . $class_id . '"> <br>';
            }
        }
        echo '
    </td>
    </tr>
    
    </tr>
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit">
    <input type="hidden" name="i_serial" value="1">
    <input type="submit" value="Edit Item" onclick="return ask_form(\'Are you sure?\')">&nbsp;<input type="reset" value="Reset"></td>
    </tr>
    
    </table>
    </form>
    
    ';
        
        
    }
    
} elseif ($_GET['m'] == 'delete') {
    $id     = safe_input($_GET['id'], '');
    $delete = $core_db->Execute("Delete from MUCore_Shop_Items where id=?", array(
        $id
    ));
    if ($delete) {
        echo notice_message_admin('Item successfully deleted', 1, 0, 'index.php?get=webshop_item_manager');
    }
    
} else {
    echo '
<form action="index.php?get=webshop_item_manager" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Search Item</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Item Name</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter the name of item which you want to find.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" name="item_name"><br>
</td>
</tr>






<tr>
<td align="left" class="panel_buttons"><input type="hidden" name="search"><a href="index.php?get=webshop_item_manager&m=new">[Create New Item]</a></td>
<td align="right" class="panel_buttons"><input type="hidden" name="search"><input type="submit" value="Search"></td>
</tr>
</table>
</form>
';
    
    if (isset($_GET['item_cat'])) {
        $item_category_gid = safe_input($_GET['item_cat'], '');
        $category_pressent = 1;
    }
    echo '<div style="margin-top: 20px;">';
    foreach ($items_categories as $item_category_id => $item_category_var) {
        if ($category_pressent == '1') {
            if ($item_category_id == $item_category_gid) {
                echo '[' . $item_category_var . ']&nbsp;&nbsp;';
            } else {
                echo '<a href="index.php?get=webshop_item_manager&item_cat=' . $item_category_id . '">' . $item_category_var . '</a>&nbsp;&nbsp;';
            }
        } else {
            echo '<a href="index.php?get=webshop_item_manager&item_cat=' . $item_category_id . '">' . $item_category_var . '</a>&nbsp;&nbsp;';
        }
    }
    echo '</div>';
    
    
    if (isset($_POST['search']) && !empty($_POST['item_name'])) {
        $item_name   = str_replace("'", "", $_POST['item_name']);
        $search_item = 1;
    }
    if ($category_pressent == 1 || $search_item == 1) {
        if ($search_item == 1) {
            $select_items = $core_db->Execute("Select name,credits,id from MUCore_Shop_Items where name like ?", array(
                '%' . $item_name . '%'
            ));
        } elseif ($category_pressent == 1) {
            $select_items = $core_db->Execute("Select name,credits,id from MUCore_Shop_Items where category=? order by credits asc", array(
                $item_category_gid
            ));
        }
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="5">Search Results</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Item Name</td>
<td align="left" class="panel_title_sub2">Credits Cost</td>
<td align="left" class="panel_title_sub2" width="80">Controls</td>
</tr>';
        
        $count = 0;
        while (!$select_items->EOF) {
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            echo '
        <tr class="' . $tr_color . '">
        <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($select_items->fields[0]) . '</strong></td>
        <td align="left" class="panel_text_alt_list">' . number_format($select_items->fields[1]) . '</td>
        <td align="left" class="panel_text_alt_list"><a href="index.php?get=webshop_item_manager&m=edit&id=' . $select_items->fields[2] . '">[Edit]</a> / <a href="#" onclick="ask_url(\'Are you sure you want to delete this Item?\',\'index.php?get=webshop_item_manager&m=delete&id=' . $select_items->fields[2] . '\')";>[Delete]</a></td>
        
        </tr>';
            
            
            $select_items->MoveNext();
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