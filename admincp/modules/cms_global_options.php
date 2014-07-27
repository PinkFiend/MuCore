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
if (isset($_POST['settings'])) {
    if (empty($_POST['ROOT_INDEX']) || empty($_POST['LOAD_GET_PAGE']) || empty($_POST['USER_GET_PAGE'])) {
        echo notice_message_admin('Some fields where left blank.', '0', '1', '0');
    } else {
        require('../engine/global_cms.php');
        $new_db = fopen("../engine/global_cms.php", "w");
        $data   = "<?\r\n";
        $data .= "define('ROOT_INDEX','" . safe_input($_POST['ROOT_INDEX'], '\_\.') . "');\r\n";
        $data .= "define('LOAD_GET_PAGE','" . safe_input($_POST['LOAD_GET_PAGE'], '_') . "');\r\n";
        $data .= "define('USER_GET_PAGE','" . safe_input($_POST['USER_GET_PAGE'], '_') . "');\r\n";
        $data .= "define('HOME_CMS_PAGE','" . safe_input($_POST['HOME_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('HOME_CMS_USER','" . safe_input($_POST['HOME_CMS_USER'], '_') . "');\r\n";
        $data .= "define('ACCOUNTSETTINGS_CMS_USER','" . safe_input($_POST['ACCOUNTSETTINGS_CMS_USER'], '_') . "');\r\n";
        $data .= "define('LOGIN_CMS_PAGE','" . safe_input($_POST['LOGIN_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('USER_CMS_PAGE','" . safe_input($_POST['USER_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('LOGOUT_CMS_PAGE','" . safe_input($_POST['LOGOUT_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('REGISTER_CMS_PAGE','" . safe_input($_POST['REGISTER_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('LOSTPASSWORD_CMS_PAGE','" . safe_input($_POST['LOSTPASSWORD_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('ANNOUNCEMENTS_CMS_PAGE','" . safe_input($_POST['ANNOUNCEMENTS_CMS_PAGE'], '_') . "');\r\n";
        $data .= "define('TERMSOFSERVICE_CMS_PAGE','" . safe_input($_POST['TERMSOFSERVICE_CMS_PAGE'], '_') . "');\r\n";
        $data .= "?>";
        fwrite($new_db, $data);
        fclose($new_db);
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=cms_global_options');
        
    }
    
    
} else {
    require('../engine/global_cms.php');
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Global Options - Define GET Variables</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">CMS Filename (index filename)</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">The filename of your CMS file (originally named index.php).
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="ROOT_INDEX" value="' . ROOT_INDEX . '"></td>
</tr>

<td align="left" class="panel_title_sub" colspan="2">Page Variable</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">This is the variable that will be used in the URL to link to your new pages. For example, if this option is set to \'page_id\', then a link to a new page would look like this: <br>http://yoursite.com/' . ROOT_INDEX . '?<b>page_id</b>=pagename.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="LOAD_GET_PAGE" value="' . LOAD_GET_PAGE . '"></td>
</tr>


<td align="left" class="panel_title_sub" colspan="2">User Module Page Variable</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">This is the variable that will be used in the URL to link to your new user cp modules. For example, if this option is set to \'panel\', then a link to a new user cp module would look like this: <br>http://yoursite.com/' . ROOT_INDEX . '?' . LOAD_GET_PAGE . '=' . USER_CMS_PAGE . '&<b>panel</b>=modulename.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="USER_GET_PAGE" value="' . USER_GET_PAGE . '"></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>


<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Global Options - Define Page and Module for Home and User CP</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Home</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select what page to be loaded when user access website.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="HOME_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (HOME_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '


</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">User CP</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select what module to be loaded when user login.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="HOME_CMS_USER">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_module = get_sort('../engine/cms_data/mods_uss.cms', '¦');
    $count      = 0;
    foreach ($get_module as $module) {
        explode("¦", $module);
        if (HOME_CMS_USER == $module[3]) {
            echo '<option value="' . $module[3] . '" selected="selected">' . $module[2] . '</option>';
        } else {
            echo '<option value="' . $module[3] . '">' . $module[2] . '</option>';
        }
        
    }
    echo '


</select>
</td>
</tr>



<tr>
<td align="left" class="panel_title_sub" colspan="2">User CP - Account Settings</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select account settings module for User CP.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="ACCOUNTSETTINGS_CMS_USER">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_module = get_sort('../engine/cms_data/mods_uss.cms', '¦');
    $count      = 0;
    foreach ($get_module as $module) {
        explode("¦", $module);
        if (ACCOUNTSETTINGS_CMS_USER == $module[3]) {
            echo '<option value="' . $module[3] . '" selected="selected">' . $module[2] . '</option>';
        } else {
            echo '<option value="' . $module[3] . '">' . $module[2] . '</option>';
        }
        
    }
    echo '


</select>
</td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>



<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Global Options - Define Needed Pages</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Announcements</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select announcements page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="ANNOUNCEMENTS_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (ANNOUNCEMENTS_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Log In</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select log in page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="LOGIN_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (LOGIN_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">User CP</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select user cp page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="USER_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (USER_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>
</td>
</tr>




<tr>
<td align="left" class="panel_title_sub" colspan="2">Log Out</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select log out page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="LOGOUT_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (LOGOUT_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Register</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select register page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="REGISTER_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (REGISTER_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>

</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Lost Password</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select lost password page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="LOSTPASSWORD_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (LOSTPASSWORD_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>
</td>
</tr>


<tr>
<td align="left" class="panel_title_sub" colspan="2">Terms of Service</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Please select terms of service page.
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<select name="TERMSOFSERVICE_CMS_PAGE">
<option value="">Choose a page</option>
        <optgroup label="---------------">';
    $get_pages = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count     = 0;
    foreach ($get_pages as $page) {
        explode("¦", $page);
        if (TERMSOFSERVICE_CMS_PAGE == $page[3]) {
            echo '<option value="' . $page[3] . '" selected="selected">' . $page[2] . '</option>';
        } else {
            echo '<option value="' . $page[3] . '">' . $page[2] . '</option>';
        }
        
    }
    echo '
</select>
</td>
</tr>

<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>


<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save">&nbsp;<input type="reset" value="Reset"></td>
</tr>
</table>


</form>
';
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