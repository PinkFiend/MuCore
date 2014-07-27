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
        $info = $core_db->Execute("Select mu_id,Name,AccountID,CtlCode,Class,cLevel,Resets,Grand_Resets,MapNumber,MapPosX,MapPosY,PkLevel,PkCount,Strength,Dexterity,Vitality,Energy,Leadership,LevelUpPoint,Money,SCFMasterPoints,SCFPCPoints,SCFMasterLevel from Character where mu_id=?", array(
            $id
        ));
        if ($info->EOF) {
            echo notice_message_admin('Unable to find character.', '0', '1', '0');
        } else {
            if (isset($_POST['edit'])) {
                if ($_POST['class'] == 'x' || $_POST['mode'] == 'x' || $_POST['map'] == 'x' || $_POST['pklevel'] == 'x') {
                    echo notice_message_admin('Error some fields where left blank.', '0', '1', '0');
                } else {
                    if (account_online($info->fields[2]) === true) {
                        echo notice_message_admin('Character is connected in game.', '0', '1', '0');
                    } else {
                        if (empty($_POST['level'])) {
                            $level = '1';
                        } else {
                            $level = safe_input($_POST['level'], '');
                        }
                        if (empty($_POST['resets'])) {
                            $resets = '0';
                        } else {
                            $resets = safe_input($_POST['resets'], '');
                        }
                        if (empty($_POST['grand_resets'])) {
                            $grand_resets = '0';
                        } else {
                            $grand_resets = safe_input($_POST['grand_resets'], '');
                        }
                        if (empty($_POST['mapx'])) {
                            $mapx = '60';
                        } else {
                            $mapx = safe_input($_POST['mapx'], '');
                        }
                        if (empty($_POST['mapy'])) {
                            $mapy = '60';
                        } else {
                            $mapy = safe_input($_POST['mapy'], '');
                        }
                        if (empty($_POST['pkcount'])) {
                            $pkcount = '0';
                        } else {
                            $pkcount = safe_input($_POST['pkcount'], '');
                        }
                        if (empty($_POST['str'])) {
                            $str = '25';
                        } else {
                            $str = safe_input($_POST['str'], '');
                        }
                        if (empty($_POST['agi'])) {
                            $agi = '25';
                        } else {
                            $agi = safe_input($_POST['agi'], '');
                        }
                        if (empty($_POST['vit'])) {
                            $vit = '25';
                        } else {
                            $vit = safe_input($_POST['vit'], '');
                        }
                        if (empty($_POST['eng'])) {
                            $eng = '25';
                        } else {
                            $eng = safe_input($_POST['eng'], '');
                        }
                        if (empty($_POST['cmd'])) {
                            $cmd = '25';
                        } else {
                            $cmd = safe_input($_POST['cmd'], '');
                        }
                        if (empty($_POST['levelup'])) {
                            $levelup = '0';
                        } else {
                            $levelup = safe_input($_POST['levelup'], '');
                        }
                        if (empty($_POST['zen'])) {
                            $zen = '1';
                        } else {
                            $zen = safe_input($_POST['zen'], '');
                        }
                        if (empty($_POST['master_level'])) {
                            $master_level = '1';
                        } else {
                            $master_level = safe_input($_POST['master_level'], '');
                        }
                        if (empty($_POST['master_points'])) {
                            $master_points = '0';
                        } else {
                            $master_points = safe_input($_POST['master_points'], '');
                        }
                        if (empty($_POST['pc_points'])) {
                            $pc_points = '0';
                        } else {
                            $pc_points = safe_input($_POST['pc_points'], '');
                        }
                        $update = $core_db->Execute("update Character set CtlCode=?,Class=?,cLevel=?,Resets=?,Grand_Resets=?,MapNumber=?,MapPosX=?,MapPosY=?,PkLevel=?,PkCount=?,Strength=?,Dexterity=?,Vitality=?,Energy=?,Leadership=?,LevelUpPoint=?,Money=?,SCFMasterPoints=?,SCFPCPoints=?,SCFMasterLevel=? where mu_id=?", array(
                            safe_input($_POST['mode'], ''),
                            safe_input($_POST['class'], ''),
                            $level,
                            $resets,
                            $grand_resets,
                            safe_input($_POST['map'], ''),
                            $mapx,
                            $mapy,
                            safe_input($_POST['pklevel'], ''),
                            $pkcount,
                            $str,
                            $agi,
                            $vit,
                            $eng,
                            $cmd,
                            $levelup,
                            $zen,
                            $master_points,
                            $pc_points,
                            $master_level,
                            $id
                        ));
                        if ($update) {
                            echo notice_message_admin('Character successfully edited', 1, 0, 'index.php?get=edit_character&mod=edit&id=' . $id . '');
                        } else {
                            echo notice_message_admin('Unable to edit character, system error.', '0', '1', '0');
                        }
                    }
                }
            } else {
                echo '

    <div align="right" style="width: 90%; margin-bottom: 2px;"><a href="index.php?get=edit_character">[Return Search Character]</a></div>
    <form action="" method="POST" name="forum">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
    <tr>
     <td align="center" class="panel_title" colspan="2">Search Character (' . htmlspecialchars($info->fields[1]) . ')</td>
    </tr>
    
    <tr>
    <td align="left" class="panel_title_sub" colspan="2">User ID</td>
    </tr>
    <tr>
    <td align="left" class="panel_text_alt1" width="50%">Character\'s User ID.</td>
    <td align="left" class="panel_text_alt2" width="50%">' . $info->fields[2] . '</a></td>
    </tr>
    

    </form>';
            }
            
        }
    }
} else {
    echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Search Character</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Character Name</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter character name which you want to find.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
';
    if (isset($_SESSION['search_character'])) {
        if (isset($_POST['character'])) {
            echo '<input type="text" value="' . $_POST['character'] . '" name="character">';
        } else {
            echo '<input type="text" value="' . $_SESSION['search_character'] . '" name="character">';
        }
        
    } else {
        echo '<input type="text" name="character">';
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
Select search type.<br<br><b>Exact Match</b> - Will search for exact match of character name you enter.
<br><b>Partial Match</b> - Will search for a partial match of character name you enter.<br><br>Note: If you choose \'Partial Match\' only first 100 matches will be displayed.</td>
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
        if (!empty($_POST['character'])) {
            $_SESSION['search_character'] = $_POST['character'];
            $_SESSION['search_t']         = $_POST['search_t'];
            $character                    = safe_input($_POST['character'], '');
            
            echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="3">Search Results</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">Character</td>
<td align="left" class="panel_title_sub2">User ID</td>
<td align="left" class="panel_title_sub2" width="120">Controls</td>
</tr>';
            
            if ($_POST['search_t'] == '1') {
                $char = $core_db->Execute("Select mu_id,Name,AccountID from Character where Name=?", array(
                    $character
                ));
                if (!$char->EOF) {
                    header('Location: index.php?get=edit_character&mod=edit&id=' . $char->fields[0] . '');
                    
                } else {
                    $not_found = '1';
                }
                
            } elseif ($_POST['search_t'] == '0') {
                $char  = $core_db->Execute("Select top 100 mu_id,Name,AccountID from Character where Name like ?", array(
                    '%' . $character . '%'
                ));
                $count = 0;
                while (!$char->EOF) {
                    $count++;
                    $tr_color = ($count % 2) ? '' : 'even';
                    echo '<tr class="' . $tr_color . '">
            <td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($char->fields[1]) . '</strong></td>
            <td align="left" class="panel_text_alt_list" >' . $char->fields[2] . '</a></td>
            
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