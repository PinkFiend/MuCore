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
if ($gm_ban_manager == '1') {
 if (isset($_GET['m'])) {
  if ($_GET['m'] == '1') {
   if (isset($_GET['unban'])) {
    $banid     = safe_input($_GET['unban'], '');
    $check_ban = $core_db->Execute("Select type,ban_id from MUCore_ban where type='1' and id=?", array(
     $banid
    ));
    if ($check_ban->EOF) {
     echo notice_message_admin('No character found in ban list.', '0', '1', '0');
    } else {
     $set_unban = $core_db->Execute("Update character set ctlcode='0' where mu_id=?", array(
      $check_ban->fields[1]
     ));
     if ($set_unban) {
      $delete_from_list = $core_db->Execute("Delete from MUCore_ban where id=? and type='1'", array(
       $banid
      ));
      if ($delete_from_list) {
       echo notice_message_admin('Character successfully unbanned', 1, 0, 'index.php?get=ban_manager&m=1');
      }
     }
    }
   } else {
    if (isset($_POST['add'])) {
     if (empty($_POST['ban_id']) || $_POST['ban_period'] == 'x') {
      echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
     } else {
      $banid        = addslashes($_POST['ban_id']);
      $reason       = addslashes($_POST['ban_reason']);
      $period       = addslashes($_POST['ban_period']);
      $check_ban_id = $core_db->Execute("Select mu_id,name from character where name=?", array(
       $banid
      ));
      if ($check_ban_id->EOF) {
       echo notice_message_admin('No character found.', '0', '1', '0');
      } else {
       $check_if_ban_exist = $core_db->Execute("Select ban_id from MUCore_ban where ban_id=? and type='1'", array(
        $check_ban_id->fields[0]
       ));
       if (!$check_if_ban_exist->EOF) {
        echo notice_message_admin('This character is already banned.', '0', '1', '0');
       } else {
        if (account_online($check_ban_id->fields[2]) === true) {
         echo notice_message_admin('Character is connected in game.', '0', '1', '0');
        } else {
         if ($period == 'perm') {
          $ban_permanent = '1';
          $ban_expire    = '0';
         } else {
          $ban_permanent = '0';
          $ban_expire    = time() + (86400 * $period);
         }
         $set_ban = $core_db->Execute("Update character set ctlcode='1' where mu_id=?", array(
          $check_ban_id->fields[0]
         ));
         if ($set_ban) {
          $insert_ban = $core_db->Execute("INSERT INTO MUCore_Ban (ban_id,type,ban_date,ban_expire,reason,ban_name,ban_permanent,author) VALUES (?,?,?,?,?,?,?,?)", array(
           $check_ban_id->fields[0],
           '1',
           time(),
           $ban_expire,
           $reason,
           $check_ban_id->fields[1],
           $ban_permanent,
           $nickname
          ));
          if ($insert_ban) {
           echo notice_message_admin('Character successfully banned', 1, 0, 'index.php?get=ban_manager&m=1');
          } else {
           echo notice_message_admin('Unable to insert ban in banlist., system error.', '0', '1', '0');
          }
         } else {
          echo notice_message_admin('Unable to set ban mode, system error.', '0', '1', '0');
         }
        }
       }
      }
     }
    } else {
     echo '<form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Ban Character</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Character</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter the character name you want to ban.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="ban_id" ></td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Period</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Select ban period.</td>
    <td align="left" class="panel_text_alt2" width="50%"><select name="ban_period">
    <option value="x" selected="selected">Select period</option>
    <optgroup label="---------------------------">
    <option value="perm">Permanent Ban</option>
        <optgroup label="---------------------------">
        <option value="1">1 day</option>
        ';
     $i = 1;
     while ($i <= 364) {
      $i++;
      echo '<option value="' . $i . '">' . $i . ' days</option>';
     }
     echo '
        

        
    </select></td>
    </tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Reason</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Reason for ban.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="ban_reason"></td>
    </tr>
    
        <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="add">
    <input type="submit" value="Ban Character" onclick="return ask_url(\'Are you sure?\')"></td>
    </tr>
    </table>
    </form>';
     if (isset($_GET['permanent'])) {
      echo '<div align="right" style="width: 90%; margin-bottom: 2px; margin-top: 20px;"><a href="index.php?get=ban_manager&m=1">[Return Back]</a></div>';
     } else {
      echo '<div align="right" style="width: 90%; margin-bottom: 2px; margin-top: 20px;"><a href="index.php?get=ban_manager&m=1&permanent=1">[View Permanent Bans]</a></div>';
     }
     echo '

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" >
<tr>
 <td align="center" class="panel_title" colspan="6">Banned Characters</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2" width="100">Character</td>
<td align="left" class="panel_title_sub2" width="200">Ban Date</td>
<td align="left" class="panel_title_sub2">Expire Date</td>
<td align="left" class="panel_title_sub2" width="100">Reason</td>
<td align="left" class="panel_title_sub2" width="100">Banned by</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
     if (isset($_GET['permanent'])) {
      $user = $core_db->Execute("Select id,ban_name,reason,ban_date,ban_expire,ban_permanent,ban_id,type,author from MUCore_Ban where ban_permanent='1' and type='1' order by ban_date desc");
     } else {
      $user = $core_db->Execute("Select id,ban_name,reason,ban_date,ban_expire,ban_permanent,ban_id,type,author from MUCore_Ban where ban_permanent='0' and type='1' order by ban_expire asc");
     }
     $count = 0;
     while (!$user->EOF) {
      if ($user->fields[5] == '0') {
       $time_left = $user->fields[4] - time();
       if ($time_left <= 0) {
        $set_unban = $core_db->Execute("Update character set ctlcode='0' where mu_id=?", array(
         $user->fields[6]
        ));
        if ($set_unban) {
         $delete_from_list = $core_db->Execute("Delete from MUCore_ban where id=? and type=?", array(
          $user->fields[0],
          $user->fields[7]
         ));
        }
       }
      }
      $count++;
      $tr_color = ($count % 2) ? '' : 'even';
      echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars(stripslashes($user->fields[1])) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . date('F j, Y / H:i', $user->fields[3]) . '</td>
            <td align="left" class="panel_text_alt_list" >';
      if ($user->fields[4] == '0') {
       echo '<em>never</em>';
      } else {
       echo '<b>' . date('F j, Y / H:i', $user->fields[4]) . '</b> <br>(' . decode_time(time(), $user->fields[4], 'long', 'Expired') . ')</td>';
      }
      echo '
            <td align="left" class="panel_text_alt_list" >';
      if (empty($user->fields[2])) {
       echo '<em>no reason</em>';
      } else {
       echo '<a class="info_l" onmouseover="showHelpTip(event, \'' . htmlspecialchars($user->fields[2]) . '\'); return false" onmouseout="helpTipHandler.hideHelpTip(this);">Reason <img src="styles/default/info_icon.gif" border="0"></a>';
      }
      echo '</td>
            <td align="left" class="panel_text_alt_list" >' . htmlspecialchars($user->fields[8]) . '</td>
            <td align="left" class="panel_text_alt_list"><a href="#" onclick="ask_url(\'Are you sure you want to unban character ' . htmlspecialchars(stripslashes($user->fields[1])) . '?\',\'index.php?get=ban_manager&m=1&unban=' . $user->fields[0] . '\');">[Unban]</a></td>
            </tr>';
      $user->MoveNext();
     }
     if ($count == '0') {
      echo '<tr><td align="center" class="panel_text_alt_list" colspan="6">No Characters Found</td></tr>';
     }
     echo '</table>';
    }
   }
  } elseif ($_GET['m'] == '0') {
   if (isset($_GET['unban'])) {
    $banid     = safe_input($_GET['unban'], '');
    $check_ban = $core_db->Execute("Select type,ban_id from MUCore_ban where type='0' and id=?", array(
     $banid
    ));
    if ($check_ban->EOF) {
     echo notice_message_admin('No account found in ban list.', '0', '1', '0');
    } else {
     $set_unban = $core_db2->Execute("Update memb_info set bloc_code='0' where memb_guid=?", array(
      $check_ban->fields[1]
     ));
     if ($set_unban) {
      $delete_from_list = $core_db->Execute("Delete from MUCore_ban where id=? and type='0'", array(
       $banid
      ));
      if ($delete_from_list) {
       echo notice_message_admin('Account successfully unbanned', 1, 0, 'index.php?get=ban_manager&m=0');
      }
     }
    }
   } else {
    if (isset($_POST['add'])) {
     if (empty($_POST['ban_id']) || $_POST['ban_period'] == 'x') {
      echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
     } else {
      $banid        = addslashes($_POST['ban_id']);
      $reason       = addslashes($_POST['ban_reason']);
      $period       = addslashes($_POST['ban_period']);
      $check_ban_id = $core_db2->Execute("Select memb_guid,memb___id from memb_info where memb___id=?", array(
       $banid
      ));
      if ($check_ban_id->EOF) {
       echo notice_message_admin('No account found.', '0', '1', '0');
      } else {
       $check_if_ban_exist = $core_db->Execute("Select ban_id from MUCore_ban where ban_id=? and type='0'", array(
        $check_ban_id->fields[0]
       ));
       if (!$check_if_ban_exist->EOF) {
        echo notice_message_admin('This account is already banned.', '0', '1', '0');
       } else {
        if (account_online($check_ban_id->fields[1]) === true) {
         echo notice_message_admin('Account is connected in game.', '0', '1', '0');
        } else {
         if ($period == 'perm') {
          $ban_permanent = '1';
          $ban_expire    = '0';
         } else {
          $ban_permanent = '0';
          $ban_expire    = time() + (86400 * $period);
         }
         $set_ban = $core_db2->Execute("Update memb_info set bloc_code='1' where memb_guid=?", array(
          $check_ban_id->fields[0]
         ));
         if ($set_ban) {
          $insert_ban = $core_db->Execute("INSERT INTO MUCore_Ban (ban_id,type,ban_date,ban_expire,reason,ban_name,ban_permanent,author) VALUES (?,?,?,?,?,?,?,?)", array(
           $check_ban_id->fields[0],
           '0',
           time(),
           $ban_expire,
           $reason,
           $check_ban_id->fields[1],
           $ban_permanent,
           $nickname
          ));
          if ($insert_ban) {
           echo notice_message_admin('Account successfully banned', 1, 0, 'index.php?get=ban_manager&m=0');
          } else {
           echo notice_message_admin('Unable to insert ban in banlist., system error.', '0', '1', '0');
          }
         } else {
          echo notice_message_admin('Unable to set ban mode, system error.', '0', '1', '0');
         }
        }
       }
      }
     }
    } else {
     echo '<form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Ban Account</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">User ID</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter the User ID for account you want to ban.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="ban_id" ></td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Period</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Select ban period.</td>
    <td align="left" class="panel_text_alt2" width="50%"><select name="ban_period">
    <option value="x" selected="selected">Select period</option>
    <optgroup label="---------------------------">
    <option value="perm">Permanent Ban</option>
        <optgroup label="---------------------------">
        <option value="1">1 day</option>
        ';
     $i = 1;
     while ($i <= 364) {
      $i++;
      echo '<option value="' . $i . '">' . $i . ' days</option>';
     }
     echo '
        

        
    </select></td>
    </tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Reason</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Reason for ban.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="ban_reason"></td>
    </tr>
    
        <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="add">
    <input type="submit" value="Ban Account" onclick="return ask_url(\'Are you sure?\')"></td>
    </tr>
    </table>
    </form>';
     if (isset($_GET['permanent'])) {
      echo '<div align="right" style="width: 90%; margin-bottom: 2px; margin-top: 20px;"><a href="index.php?get=ban_manager&m=0">[Return Back]</a></div>';
     } else {
      echo '<div align="right" style="width: 90%; margin-bottom: 2px; margin-top: 20px;"><a href="index.php?get=ban_manager&m=0&permanent=1">[View Permanent Bans]</a></div>';
     }
     echo '

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" >
<tr>
 <td align="center" class="panel_title" colspan="6">Banned Accounts</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2" width="100">User ID</td>
<td align="left" class="panel_title_sub2" width="200">Ban Date</td>
<td align="left" class="panel_title_sub2">Expire Date</td>
<td align="left" class="panel_title_sub2" width="100">Reason</td>
<td align="left" class="panel_title_sub2" width="100">Banned by</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
     if (isset($_GET['permanent'])) {
      $user = $core_db->Execute("Select id,ban_name,reason,ban_date,ban_expire,ban_permanent,ban_id,type,author from MUCore_Ban where ban_permanent='1' and type='0' order by ban_date desc");
     } else {
      $user = $core_db->Execute("Select id,ban_name,reason,ban_date,ban_expire,ban_permanent,ban_id,type,author from MUCore_Ban where ban_permanent='0' and type='0' order by ban_expire asc");
     }
     $count = 0;
     while (!$user->EOF) {
      if ($user->fields[5] == '0') {
       $time_left = $user->fields[4] - time();
       if ($time_left <= 0) {
        $set_unban = $core_db2->Execute("Update memb_info set bloc_code='0' where memb_guid=?", array(
         $user->fields[6]
        ));
        if ($set_unban) {
         $delete_from_list = $core_db->Execute("Delete from MUCore_ban where id=? and type=?", array(
          $user->fields[0],
          $user->fields[7]
         ));
        }
       }
      }
      $count++;
      $tr_color = ($count % 2) ? '' : 'even';
      echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars(stripslashes($user->fields[1])) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . date('F j, Y / H:i', $user->fields[3]) . '</td>
            <td align="left" class="panel_text_alt_list" >';
      if ($user->fields[4] == '0') {
       echo '<em>never</em>';
      } else {
       echo '<b>' . date('F j, Y / H:i', $user->fields[4]) . '</b> <br>(' . decode_time(time(), $user->fields[4], 'long', 'Expired') . ')</td>';
      }
      echo '
            <td align="left" class="panel_text_alt_list" >';
      if (empty($user->fields[2])) {
       echo '<em>no reason</em>';
      } else {
       echo '<a class="info_l" onmouseover="showHelpTip(event, \'' . htmlspecialchars($user->fields[2]) . '\'); return false" onmouseout="helpTipHandler.hideHelpTip(this);">Reason <img src="styles/default/info_icon.gif" border="0"></a>';
      }
      echo '</td>
            <td align="left" class="panel_text_alt_list" >' . htmlspecialchars($user->fields[8]) . '</td>
            <td align="left" class="panel_text_alt_list"><a href="#" onclick="ask_url(\'Are you sure you want to unban account ' . htmlspecialchars(stripslashes($user->fields[1])) . '?\',\'index.php?get=ban_manager&m=0&unban=' . $user->fields[0] . '\');">[Unban]</a></td>
            </tr>';
      $user->MoveNext();
     }
     if ($count == '0') {
      echo '<tr><td align="center" class="panel_text_alt_list" colspan="6">No Accounts Found</td></tr>';
     }
     echo '</table>';
    }
   }
  }
 } else {
  echo '
    
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Ban Manager</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Please select.</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="30%" valign="top"><a href="index.php?get=ban_manager&m=1">[Ban Character]</a></td>
<td align="left" class="panel_text_alt1" width="70%" valign="top">Ban Manager for characters.</td>
</tr>
<tr class="even">
<td align="left" class="panel_text_alt1" width="30%" valign="top"><a href="index.php?get=ban_manager&m=0">[Ban Account]</a></td>
<td align="left" class="panel_text_alt1" width="70%" valign="top">Ban Manager for accounts.</td>
</tr>
</table>
    ';
  echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Search Character\'s Account</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Character Name</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter character name of account which you want to find.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
';
  echo '<input type="text" name="character">';
  echo '
<br>
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
   if (!empty($_POST['character'])) {
    $character = str_replace("'", "", $_POST['character']);
    echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="3">Search Results</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Character</td>
<td align="left" class="panel_title_sub2">User ID</td>
</tr>';
    $char  = $core_db->Execute("Select top 100 mu_id,Name,AccountID from Character where Name like ?", array(
     '%' . $character . '%'
    ));
    $count = 0;
    while (!$char->EOF) {
     $count++;
     $tr_color = ($count % 2) ? '' : 'even';
     echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($char->fields[1]) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . htmlspecialchars($char->fields[2]) . '</td>
            
            </tr>';
     $char->MoveNext();
    }
    if ($count == '0') {
     echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Accounts Found</td></tr>';
    }
   }
   if ($not_found == '1') {
    echo '<tr><td align="center" class="panel_text_alt_list" colspan="3">No Characters Found</td></tr>';
   }
   echo '</table>';
  }
 }
} else {
 echo notice_message_admin('You do not have permission to access this option.', '0', '1', '');
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