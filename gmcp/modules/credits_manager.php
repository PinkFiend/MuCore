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
if ($gm_ban_mucoins == '1') {
 $left_time_mucoins = $gm_coins_days_left - time();
 if ($left_time_mucoins <= 0) {
  $new_coins_time = time() + ($gm_coins_day * 86400);
  $old_db         = file("../engine/gm.users/gmcp.users");
  $new_db         = fopen("../engine/gm.users/gmcp.users", "w");
  foreach ($old_db as $old_db_line) {
   $old_db_arr = explode("¦", $old_db_line);
   if ($gm_id != $old_db_arr[0]) {
    fwrite($new_db, "$old_db_line");
   } else {
    fwrite($new_db, "" . $gm_id . "¦" . $gm_user_id . "¦" . $gm_user_pwd . "¦" . $nickname . "¦" . $gm_ban_manager . "¦" . $gm_ban_mucoins . "¦" . $gm_preset_mucoins . "¦" . $gm_coins_day . "¦" . $new_coins_time . "¦" . $gm_preset_mucoins . "¦" . $gm_ip_dat . "¦\n");
   }
  }
  echo notice_message_admin('Your MU Coins balance successfully updated.', 1, 0, 'index.php?get=credits_manager');
 } else {
  if (isset($_POST['add_final'])) {
   $userid = safe_input($_POST['userid'], '');
   if (empty($_POST['mucoins'])) {
    $mucoins = '0';
   } else {
    $mucoins = safe_input($_POST['mucoins'], '');
   }
   if ($gm_amount_coins < $mucoins) {
    echo notice_message_admin('You don\'t have enough MU Coins.', '0', '1', '0');
   } else {
    $info = $core_db2->Execute("Select " . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
     $userid
    ));
    if ($info->EOF) {
     $insert_cred = $core_db2->Execute("INSERT INTO " . MU_COINS_TABLE . "(" . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . ")VALUES(?,?)", array(
      $userid,
      $mucoins
     ));
     if ($insert_cred) {
      $left_mucoins = $gm_amount_coins - $mucoins;
      $old_db       = file("../engine/gm.users/gmcp.users");
      $new_db       = fopen("../engine/gm.users/gmcp.users", "w");
      foreach ($old_db as $old_db_line) {
       $old_db_arr = explode("¦", $old_db_line);
       if ($gm_id != $old_db_arr[0]) {
        fwrite($new_db, "$old_db_line");
       } else {
        fwrite($new_db, "" . $gm_id . "¦" . $gm_user_id . "¦" . $gm_user_pwd . "¦" . $nickname . "¦" . $gm_ban_manager . "¦" . $gm_ban_mucoins . "¦" . $left_mucoins . "¦" . $gm_coins_day . "¦" . $gm_coins_days_left . "¦" . $gm_preset_mucoins . "¦" . $gm_ip_dat . "¦\n");
       }
      }
      write_log('../engine/logs/gmcp/mucoins_manager', '' . $nickname . ' issued ' . $mucoins . ' credits to ' . $userid . '.');
      echo notice_message_admin('MU Coins successfully added', 1, 0, 'index.php?get=credits_manager');
     } else {
      echo notice_message_admin('Unable to add MU Coins, system error.', '0', '1', '0');
     }
    } else {
     $update = $core_db2->Execute("Update " . MU_COINS_TABLE . " set " . MU_COINS_COLUMN . "=" . MU_COINS_COLUMN . "+?  where " . MU_COINS_USERID_COLUMN . "=?", array(
      $mucoins,
      $userid
     ));
     if ($update) {
      $left_mucoins = $gm_amount_coins - $mucoins;
      $old_db       = file("../engine/gm.users/gmcp.users");
      $new_db       = fopen("../engine/gm.users/gmcp.users", "w");
      foreach ($old_db as $old_db_line) {
       $old_db_arr = explode("¦", $old_db_line);
       if ($gm_id != $old_db_arr[0]) {
        fwrite($new_db, "$old_db_line");
       } else {
        fwrite($new_db, "" . $gm_id . "¦" . $gm_user_id . "¦" . $gm_user_pwd . "¦" . $nickname . "¦" . $gm_ban_manager . "¦" . $gm_ban_mucoins . "¦" . $left_mucoins . "¦" . $gm_coins_day . "¦" . $gm_coins_days_left . "¦" . $gm_preset_mucoins . "¦" . $gm_ip_dat . "¦\n");
       }
      }
      write_log('../engine/logs/gmcp/mucoins_manager', '' . $nickname . ' issued ' . $mucoins . ' credits to ' . $userid . '.');
      echo notice_message_admin('MU Coins successfully added', 1, 0, 'index.php?get=credits_manager');
     } else {
      echo notice_message_admin('Unable to add MU Coins, system error.', '0', '1', '0');
     }
    }
   }
  } elseif (isset($_POST['add'])) {
   if (empty($_POST['userid'])) {
    echo notice_message_admin('Some fields where left blank.', '0', '1', '0');
   } else {
    $userid = safe_input($_POST['userid'], '');
    if (empty($_POST['mucoins'])) {
     $mucoins = '0';
    } else {
     $mucoins = safe_input($_POST['mucoins'], '');
    }
    if ($gm_amount_coins < $mucoins) {
     echo notice_message_admin('You don\'t have enough MU Coins.', '0', '1', '0');
    } else {
     $check_acc = $core_db2->Execute("Select memb___id from MEMB_INFO where memb___id=?", array(
      $userid
     ));
     if ($check_acc->EOF) {
      echo notice_message_admin('Account not found.', '0', '1', '0');
     } else {
      $info = $core_db2->Execute("Select " . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . " from " . MU_COINS_TABLE . " where " . MU_COINS_USERID_COLUMN . "=?", array(
       $userid
      ));
      if ($info->EOF) {
       $insert_cred = $core_db2->Execute("INSERT INTO " . MU_COINS_TABLE . "(" . MU_COINS_USERID_COLUMN . "," . MU_COINS_COLUMN . ")VALUES(?,?)", array(
        $userid,
        '0'
       ));
       if ($insert_cred) {
        $found_acc = '1';
       }
       #echo notice_message_admin('No account found.','0','1','0');
      } else {
       $found_acc = '1';
      }
      if ($found_acc) {
       echo '
                <div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=credits_manager">[Return Add MU Coins]</a></div>
                <form action="" method="POST" name="forum">
                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
                <tr>
                <td align="center" class="panel_title" colspan="2">Add MU Coins (User ID: ' . htmlspecialchars($info->fields[0]) . ')</td>
                </tr>
                <tr>
                <td align="left" class="panel_title_sub" colspan="2">MU Coins</td>
                </tr>
                <tr>
                <td align="left" class="panel_text_alt1" width="50%">The amount between account\'s MU Coins and amount you set.</td>
                <td align="left" class="panel_text_alt2" width="50%">' . number_format($info->fields[1]) . ' + <b>' . number_format($mucoins) . '</b> = <b>' . number_format($info->fields[1] + $mucoins) . '</b></td>
                </tr>
                <tr>
                <td align="center" class="panel_buttons" colspan="2">
                <input type="hidden" name="add_final"><input type="hidden" name="userid" value="' . $info->fields[0] . '">
                <input type="hidden" name="mucoins" value="' . $mucoins . '">
                <input type="submit" value="Add MU Coins" onclick="return ask_form(\'Are you sure?\')"></td>    </tr>
                </table>
                </form>';
      }
     }
    }
   }
  } else {
   echo '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel"  style="margin-bottom: 20px;">
    <tr>
     <td align="center" class="panel_title" colspan="2">MU Coins Balance</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">MU Coins</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">MU Coins left to add.</td>
    <td align="left" class="panel_text_alt2" width="50%"><b>' . number_format($gm_amount_coins) . '</b></td>
    </tr>
    </table>
    ';
   echo '<form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Add MU Coins</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">User ID</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter account\'s User ID </td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="userid" ></td>
    </tr>
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">MU Coins</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Enter amount of MU Coins you want to add.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="mucoins"></td>
    </tr>

        <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="add">
    <input type="submit" value="Add MU Coins"></td>
    </tr>
    </table>
    </form>';
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