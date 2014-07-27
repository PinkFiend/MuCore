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
if (isset($_GET['get_edit'])) {
    $get_edit = safe_input($_GET['get_edit'], '');
    $get_id   = $core_db2->Execute("Select memb_guid from memb_info where memb___id=?", array(
        $get_edit
    ));
    if (!$get_id->EOF) {
        header('Location: index.php?get=edit_account&mod=edit&id=' . $get_id->fields[0] . '');
        
    }
}
if (isset($_GET['mod'])) {
    if (empty($_GET['id'])) {
        echo notice_message_admin('Unable to proceed your request.', '0', '1', '0');
    } else {
        $id   = safe_input($_GET['id'], '');
        $info = $core_db2->Execute("Select  memb_guid,memb___id,bloc_code,mail_addr,sno__numb,SecretQuestion,SecretAnswer,Country,Gender from memb_info where memb_guid=?", array(
            $id
        ));
        if ($info->EOF) {
            echo notice_message_admin('Unable to find account.', '0', '1', '0');
        } else {
            if (isset($_POST['edit'])) {
                if ($_POST['mode'] == 'x' || $_POST['question'] == 'x' || $_POST['country'] == 'x') {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    if (!empty($_POST['password'])) {
                        $password = safe_input($_POST['password'], '');
                    }
                    $mode = safe_input($_POST['mode'], '');
                    $mail = safe_input($_POST['email'], '\_\@\.\-');
                    if (empty($_POST['pid'])) {
                        $pid = '111111111111';
                    } else {
                        $pid = safe_input($_POST['pid'], '');
                    }
                    $question = safe_input($_POST['question'], '');
                    $answer   = safe_input($_POST['answer'], '');
                    $country  = safe_input($_POST['country'], '');
                    $gender   = safe_input($_POST['gender'], '');
                    
                    
                    
                    if (isset($password)) {
                        if ($core['config']['md5'] == '1') {
                            $update = $core_db2->Execute("Update memb_info set memb__pwd=[dbo].[fn_md5](?,?),bloc_code=?,mail_addr=?,sno__numb=?,SecretQuestion=?,SecretAnswer=?,Country=?,Gender=? from memb_info where memb_guid=?", array(
                                $password,
                                $info->fields[1],
                                $mode,
                                $mail,
                                $pid,
                                $question,
                                $answer,
                                $country,
                                $gender,
                                $id
                            ));
                        } elseif ($core['config']['md5'] == '1') {
                            $update = $core_db2->Execute("Update memb_info set memb__pwd,bloc_code=?,mail_addr=?,sno__numb=?,SecretQuestion=?,SecretAnswer=?,Country=?,Gender=? from memb_info where memb_guid=?", array(
                                $password,
                                $mode,
                                $mail,
                                $pid,
                                $question,
                                $answer,
                                $country,
                                $gender,
                                $id
                            ));
                        }
                    } else {
                        $update = $core_db2->Execute("Update memb_info set bloc_code=?,mail_addr=?,sno__numb=?,SecretQuestion=?,SecretAnswer=?,Country=?,Gender=? from memb_info where memb_guid=?", array(
                            $mode,
                            $mail,
                            $pid,
                            $question,
                            $answer,
                            $country,
                            $gender,
                            $id
                        ));
                    }
                    if ($update) {
                        echo notice_message_admin('Account successfully edited', 1, 0, 'index.php?get=edit_account&mod=edit&id=' . $id . '');
                    } else {
                        echo notice_message_admin('Unable to edit account, system error.', '0', '1', '0');
                    }
                }
            } else {
                echo '

    <div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=edit_account">[Return Search Account]</a></div>
    <form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Edit Account (User ID: ' . htmlspecialchars($info->fields[1]) . ')</td>
    </tr>
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Mode</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Account mode.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="mode">
    <option value="x">Choose mode</option>
    <optgroup label="---------------">
        ';
                foreach ($account_mode as $mode_id => $mode_name) {
                    if ($info->fields[2] == $mode_id) {
                        echo '<option value="' . $mode_id . '" selected="selected">' . $mode_name . '</option>';
                        
                    } else {
                        echo '<option value="' . $mode_id . '">' . $mode_name . '</option>';
                    }
                    
                }
                echo '</select></td>
    </tr>

    <tr>
    <td align="left" class="panel_title_sub" colspan="2">New Password</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Set new password for this Account. Leve it blank if you don\'t want to change password.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="password"></td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Email Address</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Account email address.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="email" value="' . htmlspecialchars($info->fields[3]) . '"></td>
    </tr>    
    
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Personal ID</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Account\'s personal id.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="pid" value="' . htmlspecialchars($info->fields[4]) . '"></td>
    </tr>    
    
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Secret Question</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Account\'s secret question.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="question">
    <option value="x">Choose a Secret Question</option>
    <optgroup label="---------------">
        ';
                foreach ($secret_questions as $sq_id => $sq_name) {
                    if ($info->fields[5] == $sq_id) {
                        echo '<option value="' . $sq_id . '" selected="selected">' . $sq_name . '</option>';
                        
                    } else {
                        echo '<option value="' . $sq_id . '">' . $sq_name . '</option>';
                    }
                    
                }
                
                echo '</select></td>
    </tr>    
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Secret Answer</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Secret answer of account\'s secret question.</td>
    <td align="left" class="panel_text_alt2" width="50%"><input type="text" name="answer" value="' . htmlspecialchars($info->fields[6]) . '"></td>
    </tr>
    
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Country</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">User\'s country.</td>
    <td align="left" class="panel_text_alt2" width="50%">
    <select name="country">
    <option value="x">Choose a Country</option>
    <optgroup label="---------------">
        ';
                $c = getcountry('list');
                foreach ($c as $cc => $v) {
                    if ($cc == $info->fields[7]) {
                        echo '<option value="' . $cc . '" selected="selected">' . $v . '</option>';
                    } else {
                        echo '<option value="' . $cc . '">' . $v . '</option>';
                    }
                    
                }
                
                echo '</select></td>
    </tr>    
    
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">Gender</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">User\'s gender.</td>
    <td align="left" class="panel_text_alt2" width="50%">';
                switch ($info->fields[8]) {
                    case '1':
                        echo '<label><input type="radio" name="gender" value="1" checked="checked">Male</label> <label><input type="radio" name="gender" value="2">Female</label>';
                        break;
                    case '2':
                        echo '<label><input type="radio" name="gender" value="1">Male</label> <label><input type="radio" name="gender" value="2" checked="checked">Female</label>';
                        break;
                }
                
                echo '</td>
    </tr>
    
    </tr>
    <tr>
    <td align="center" class="panel_buttons" colspan="2">
    <input type="hidden" name="edit">
    <input type="submit" value="Edit Account" onclick="return ask_form(\'Are you sure?\')">&nbsp;<input type="reset" value="Reset"></td>
    </tr>
    
    </table>
    </form>';
                
                $char = $core_db2->Execute("Select mu_id,name from character where accountid=?", array(
                    $info->fields[1]
                ));
                echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="3">' . htmlspecialchars($info->fields[1]) . '\'s Characters</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Character</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
                $count = 0;
                while (!$char->EOF) {
                    $count++;
                    $tr_color = ($count % 2) ? '' : 'even';
                    echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($char->fields[1]) . '</strong></td>
            <td align="left" class="panel_text_alt_list" width="50"><a href="index.php?get=edit_character&mod=edit&id=' . $char->fields[0] . '">[Edit]</a></td>
            </tr>';
                    $char->MoveNext();
                }
                if ($count == '0') {
                    echo '<tr><td align="center" class="panel_text_alt_list" colspan="3">No Characters Found</td></tr>';
                }
                
                
                echo '</table>';
                
                
                
                
            }
            
        }
    }
} else {
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Search IP Using Account</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">User ID</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter User ID of account which you want to find ip.</td>
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
<td align="left" class="panel_title_sub2">IP Address</td>
<td align="left" class="panel_title_sub2" width="50">Controls</td>
</tr>';
            
            
            if ($_POST['search_t'] == '1') {
                $user = $core_db2->Execute("Select memb___id,ip from memb_stat where memb___id=?", array(
                    $userid
                ));
                if ($user->EOF) {
                    $not_found = '1';
                }
            } elseif ($_POST['search_t'] == '0') {
                $user = $core_db2->Execute("Select top 100 memb___id,ip from memb_stat where memb___id like ?", array(
                    '%' . $userid . '%'
                ));
            }
            
            
            $count = 0;
            while (!$user->EOF) {
                $count++;
                $tr_color = ($count % 2) ? '' : 'even';
                echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($user->fields[0]) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . htmlspecialchars($user->fields[1]) . '</td>
            <td align="left" class="panel_text_alt_list"><a href="index.php?get=edit_account&mod=edit&id=' . $user->fields[0] . '">[Edit]</a></td>
            </tr>';
                $user->MoveNext();
            }
            
            if ($count == '0') {
                echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No IP Found</td></tr>';
            }
            
            
            
            
            if ($not_found == '1') {
                echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No IP Found</td></tr>';
            }
            echo '</table>';
            
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