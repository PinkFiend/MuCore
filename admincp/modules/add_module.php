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
if (!isset($_GET['m'])) {
    echo '
    
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Module Type</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Please select Module type would like to add.</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="30%" valign="top"><a href="index.php?get=add_module&m=0">[Template Module]</a></td>
<td align="left" class="panel_text_alt1" width="70%" valign="top">

Template Modules allow you to use the text editor to format your module using html codes. Template Modules are recommended for simpler modules containing text, images, or anything else that can be done using htmlcodes.</td>
</tr>


<tr class="even">
<td align="left" class="panel_text_alt1" width="30%" valign="top"><a href="index.php?get=add_module&m=1">[PHP File Module]</a></td>
<td align="left" class="panel_text_alt1" width="70%" valign="top">PHP File Modules will allow you to specify a file from the mucore_dir/pages_modules/ directory on your server that will be displayed as the content for the module. </td>
</tr>
</table>
    ';
} else {
    if ($_GET['m'] == '0') {
        if (isset($_POST['add_module'])) {
            if ($_POST['m_active'] == '0') {
                $active = 'not_active';
            } elseif ($_POST['m_active'] == '1') {
                $active = 'active';
            }
            
            if ($_POST['m_type'] == '0') {
                $type = 'template_module';
            }
            if (empty($_POST['m_title']) || empty($active) || empty($_POST['m_content']) || empty($type)) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $m_title  = safe_input($_POST['m_title'], '\_\.\-\ ');
                $m_active = safe_input($_POST['m_active'], '');
                $m_type   = safe_input($_POST['m_type'], '');
                $m_id     = uniqid();
                
                $mod_db = fopen("../engine/cms_data/mods.cms", "a+");
                fwrite($mod_db, "mod_" . $m_id . "¦" . $m_type . "¦template_module¦" . $m_title . "¦" . $m_active . "¦\n");
                fclose($mod_db);
                
                
                $cms_content = $_POST['m_content'];
                if (substr($cms_content, 0, 3) == '<p>') {
                    $cms_content = substr_replace($cms_content, "", 0, 3);
                }
                $new_cms = fopen('../engine/cms_data/cms_co/mod_' . $m_id . '_cms.cms', "w");
                fwrite($new_cms, str_replace("<?", "", str_replace("?>", "", $cms_content)));
                fclose($new_cms);
                
                
                echo notice_message_admin('Template Module successfully added', 1, 0, 'index.php?get=edit_modules');
            }
            
            
            
            
        } else {
            echo '
    <!-- tinyMCE -->
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
    
    <form action="" method="POST" name="module">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add Template Module</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Title</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Module Title that will appear on module list.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="m_title"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Active</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">When set \'No\' module will not be visibile.</td>
    <td align="left" class="panel_text_alt2" width="50%"><label><input type="radio" name="m_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="m_active" value="0">No</label></td
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Module Content</td>
    </tr>
    <tr>
    <td  class="panel_text_area" colspan="2" width="60%"><textarea id="m_content" name="m_content" rows="24" style="width: 100%;"></textarea></td>
    </tr>
    
    
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="m_type" value="0">
    <input type="hidden" name="add_module">
    <input type="submit" value="Add Module"></td>
    </tr>
    
    </table>
    </form>';
            
        }
        
    } elseif ($_GET['m'] == '1') {
        if (isset($_POST['add_module'])) {
            if ($_POST['m_active'] == '0') {
                $active = 'not_active';
            } elseif ($_POST['m_active'] == '1') {
                $active = 'active';
            }
            
            
            if (empty($_POST['m_title']) || empty($active) || empty($_POST['m_file']) || empty($_POST['m_type'])) {
                echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
            } else {
                $m_title  = safe_input($_POST['m_title'], '\_\.\-\ ');
                $m_active = safe_input($_POST['m_active'], '');
                $m_file   = safe_input($_POST['m_file'], '\_\.\-\ ');
                $m_type   = safe_input($_POST['m_type'], '');
                $m_id     = uniqid();
                
                $mod_db = fopen("../engine/cms_data/mods.cms", "a+");
                fwrite($mod_db, "mod_" . $m_id . "¦" . $m_type . "¦" . $m_file . "¦" . $m_title . "¦" . $m_active . "¦\n");
                fclose($mod_db);
                echo notice_message_admin('PHP File Module successfully added', 1, 0, 'index.php?get=edit_modules');
            }
            
            
        } else {
            echo '<form action="" method="POST" name="module">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Add PHP File Module</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Module Title</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Module Title that will appear on module list.</td>
<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="m_title"></td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Module Active</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">When set \'No\' module will not be visibile.</td>
<td align="left" class="panel_text_alt2" width="50%"><label><input type="radio" name="m_active" checked="checked" value="1">Yes</label> <label><input type="radio" name="m_active" value="0">No</label></td
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Module PHP File</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="50%">Choose PHP file you want to include.</td>
<td align="left" class="panel_text_alt2" width="50%">
<select name="m_file">
<option value="0" selected="selected">Choose a File</option>
        <optgroup label="---------------">

';
            $directory = opendir('../pages_modules');
            while ($modfile = readdir($directory)) {
                if (ereg('[^.]+', $modfile) AND $modfile != 'index.html') {
                    echo '<option value="' . $modfile . '">' . $modfile . '</option>';
                }
            }
            
            echo '</select></td>
</tr>


<tr>
<td align="center" class="panel_buttons" colspan="2">
<input type="hidden" name="m_type" value="1">
<input type="hidden" name="add_module">
<input type="submit" value="Add Module"></td>
</tr>

</table>
</form>';
        }
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