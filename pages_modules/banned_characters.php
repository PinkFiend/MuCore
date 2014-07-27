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
echo '

<script type="text/javascript" src="js/helptip.js"></script>

<style type="text/css">
a.info_l {

    text-decoration:    none;

    cursor:                default;
}

a.info_l:hover {

    text-decoration:    none;

}

.info_show {
background-color:#ffffff;


    padding: 4px;
    border:1px solid #999;
    width: 130px;
    font-size: 11px;

    position:    absolute;
    filter:        progid:DXImageTransform.Microsoft.Shadow(color="#777777", Direction=135, Strength=3);
    z-index:    10000;
}


</style>
<div style="margin-top: 20px;">
<fieldset><legend>' . text_notice . '</legend>
<table border="0" cellspacing="4" cellpadding="0" width="100%" style="padding-left: 10px;">
<tr>
<td align="left">' . text_ban_expire . '</td>
</tr>
<tr>
</table>
</fieldset>
</div>';



if (!isset($_GET['permanent'])) {
    $fetch_permanent = '0';
} else {
    $fetch_permanent = '1';
}

if ($fetch_permanent == '1') {
    echo '    <div align="right" style="width: 100%; margin-bottom: 2px; margin-top: 20px;"><a href="' . $core_run_script . '#list" name="list">[' . link_banned_characters . ']</a></div>';
} elseif ($fetch_permanent == '0') {
    echo '    <div align="right" style="width: 100%; margin-bottom: 2px; margin-top: 20px;"><a href="' . $core_run_script . '&permanent=1#list" name="list">[' . link_permanent_banned_characters . ']</a></div>';
}
echo '<table border="0" cellspacing="4" cellpadding="0" width="100%">';
$banned = $core_db->Execute("Select id,ban_id,type,ban_name,ban_date,ban_expire,reason,ban_permanent from MUCore_Ban where ban_permanent='" . $fetch_permanent . "' order by ban_expire asc");
$count  = 0;
while (!$banned->EOF) {
    if ($banned->fields[7] == '0') {
        $time_left = $banned->fields[5] - time();
        if ($time_left <= 0) {
            if ($banned->fields[2] == '1') {
                $set_unban = $core_db->Execute("Update character set ctlcode='0' where mu_id=?", array(
                    $banned->fields[1]
                ));
                if ($set_unban) {
                    $delete_from_list = $core_db->Execute("Delete from MUCore_ban where id=? and type=?", array(
                        $banned->fields[0],
                        $banned->fields[2]
                    ));
                }
            } elseif ($banned->fields[2] == '0') {
                $set_unban = $core_db2->Execute("Update memb_info set bloc_code='0' where memb_guid=?", array(
                    $banned->fields[1]
                ));
                if ($set_unban) {
                    $delete_from_list = $core_db->Execute("Delete from MUCore_ban where id=? and type=?", array(
                        $banned->fields[0],
                        $banned->fields[2]
                    ));
                    
                }
            }
            
        }
    }
    if ($banned->fields[2] == '1') {
        $count++;
        if (empty($banned->fields[6])) {
            $reason = '<em>No reason</em>';
        } else {
            $reason = '<a class="info_l" onmouseover="showHelpTip(event, \'' . htmlspecialchars(stripslashes($banned->fields[6])) . '\'); return false" onmouseout="helpTipHandler.hideHelpTip(this);"><img src="template/' . $core['config']['template'] . '/images/question_mark.gif" border="0"></a>';
        }
        
        if ($banned->fields[7] == '1') {
            $expire_date = 'Never';
        } else {
            $expire_date = date('F j, Y / H:i', $banned->fields[5]) . ' (' . decode_time(time(), $banned->fields[5], 'short', 'Expired') . ')';
        }
        echo '  <tr>
    <td align="center" rowspan="3" class="iR_rank" width="3%">' . $count . '</td>
    <td align="left" rowspan="3" class="iR_name" width="100">' . htmlspecialchars($banned->fields[3]) . '</td>
    <td align="left" class="iR_stats">' . text_banned_on . ' ' . date('F j, Y / H:i', $banned->fields[4]) . '</td>
  </tr>
    <tr>
    <td align="left" class="iR_stats_level">' . text_expire_date . ' : ' . $expire_date . '</td>
  </tr>
  <tr>
    <td align="left" class="iR_stats_reset">' . text_rason . ' : ' . $reason . '</td>
  </tr>
  <tr>
  <td colspan="3" algin="left" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); height: 2px;"></td>
  </tr>
  ';
    }
    $banned->MoveNext();
}
if ($count == '0') {
    echo '<tr>
    <td align="left">' . msg('0', text_sorry_no_ban) . '</td>
    </tr>
      <tr>
  <td algin="left" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); height: 2px;"></td>
  </tr>
  ';
}
echo '</table>';
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