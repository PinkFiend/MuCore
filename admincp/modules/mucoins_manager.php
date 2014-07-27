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
    if (empty($_GET['id'])) {
        echo notice_message_admin('Unable to proceed your request.', '0', '1', '0');
    } else {
        $id   = safe_input($_GET['id'], '');
        $info = $core_db2->Execute("Select " . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
            $id
        ));
        if ($info->EOF) {
            echo notice_message_admin('Unable to find account.', '0', '1', '0');
        } else {
            if (isset($_POST['edit'])) {
                if (empty($_POST['mucoins'])) {
                    $mucoins = '0';
                } else {
                    $mucoins = safe_input($_POST['mucoins'], '');
                }
                $update = $core_db2->Execute("Update " . MU_COINS_TABLE . " set " . MU_COINS_COLUMN . "=?  where " . MU_COINS_USERID_COLUMN . "=?", array(
                    $mucoins,
                    $id
                ));
                if ($update) {
                    echo notice_message_admin('Account\'s MU Coins successfully edited', 1, 0, 'index.php?get=mucoins_manager&mod=edit&id=' . $id . '');
                } else {
                    echo notice_message_admin('Unable to edit account\'s MU Coins, system error.', '0', '1', '0');
                }
                
            } else {
                echo '

    <div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=mucoins_manager">[Return MU Coins Manager]</a></div>
    <form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit MU Coins (User ID: ' . htmlspecialchars($info->fields[0]) . ')</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">MU Coins</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Account\'s MU Coins</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="mucoins" value="' . $info->fields[1] . '"></td>
    </tr>

        <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit">
    <input type="submit" value="Edit MU Coins" onclick="return ask_form(\'Are you sure?\')">&nbsp;<input type="reset" value="Reset"></td>
    </tr>
    </table>
    </form>';
            }
        }
    }
    
} else {
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Search Account\'s MU Coins</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">User ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter User ID of account which you want to find.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
';
    if (isset($_SESSION['search_user'])) {
        if (isset($_POST['user'])) {
            echo '<input type="text" value="' . $_POST['user'] . '" name="user">';
        } else {
            echo '<input type="text" value="' . $_SESSION['search_user'] . '" name="user">';
        }
        
    } else {
        echo '<input type="text" name="user">';
    }
    echo '
<br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Search Criteria</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Select search type.<br<br><b>Exact Match</b> - Will search for exact match of use id you enter.
<br><b>Partial Match</b> - Will search for a partial match of user id you enter.<br><br>Note: If you choose \'Partial Match\' only first 100 matches will be displayed.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">';
    if (isset($_SESSION['search_t'])) {
        if (isset($_POST['search_t'])) {
            switch ($_POST['search_t']) {
                case '0':
                    echo '<label><input type="radio" name="search_t" value="1">Exact Match</label> <label><input type="radio" name="search_t" value="0"  checked="checked">Partial Match</label>';
                    break;
                case '1':
                    echo '<label><input type="radio" name="search_t" value="1" checked="checked">Exact Match</label> <label><input type="radio" name="search_t" value="0"  >Partial Match</label>';
                    break;
            }
        } else {
            switch ($_SESSION['search_t']) {
                case '0':
                    echo '<label><input type="radio" name="search_t" value="1">Exact Match</label> <label><input type="radio" name="search_t" value="0"  checked="checked">Partial Match</label>';
                    break;
                case '1':
                    echo '<label><input type="radio" name="search_t" value="1" checked="checked">Exact Match</label> <label><input type="radio" name="search_t" value="0"  >Partial Match</label>';
                    break;
            }
        }
        
    } else {
        echo '<label><input type="radio" name="search_t" value="1" checked="checked">Exact Match</label> <label><input type="radio" name="search_t" value="0"  >Partial Match</label>';
    }
    
    echo '

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
    
    
    
    if (isset($_POST['search'])) {
        if (!empty($_POST['user'])) {
            $_SESSION['search_user'] = $_POST['user'];
            $_SESSION['search_t']    = $_POST['search_t'];
            $userid                  = safe_input($_POST['user'], '');
            
            echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="5">Search Results</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">User ID</td>
<td align="left" class="panel_title_sub2">MU COins</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
            
            if ($_POST['search_t'] == '1') {
                $user = $core_db2->Execute("Select " . MU_COINS_USERID_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
                    $userid
                ));
                
                if (!$user->EOF) {
                    header('Location: index.php?get=mucoins_manager&mod=edit&id=' . $user->fields[0] . '');
                } else {
                    $not_found = '1';
                }
                
            } elseif ($_POST['search_t'] == '0') {
                $user  = $core_db2->Execute("Select top 100 " . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . " like ? order by " . MU_COINS_COLUMN . " desc", array(
                    '%' . $userid . '%'
                ));
                $count = 0;
                while (!$user->EOF) {
                    $count++;
                    $tr_color = ($count % 2) ? '' : 'even';
                    echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($user->fields[0]) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . number_format($user->fields[1]) . '</td>
            <td align="left" class="panel_text_alt_list"><a href="index.php?get=mucoins_manager&mod=edit&id=' . $user->fields[0] . '">[Edit]</a></td>
            </tr>';
                    $user->MoveNext();
                }
                if ($count == '0') {
                    echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Accounts Found</td></tr>';
                }
                
                
            }
            
            if ($not_found == '1') {
                echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Accounts Found</td></tr>';
            }
            echo '</table>';
            
        }
    } else {
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="5">Top 50 MU Coins</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">User ID</td>
<td align="left" class="panel_title_sub2">MU Coins</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
        $user  = $core_db2->Execute("Select top 50 " . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . " from " . MU_COINS_TABLE . " order by " . MU_COINS_COLUMN . " desc");
        $count = 0;
        while (!$user->EOF) {
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($user->fields[0]) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . number_format($user->fields[1]) . '</td>
            <td align="left" class="panel_text_alt_list"><a href="index.php?get=mucoins_manager&mod=edit&id=' . $user->fields[0] . '">[Edit]</a></td>
            </tr>';
            $user->MoveNext();
        }
        if ($count == '0') {
            echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Accounts Found</td></tr>';
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