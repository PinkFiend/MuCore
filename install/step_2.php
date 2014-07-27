<?
echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel"><tr> <td align="center" class="panel_title" colspan="2">Connection Info</td></tr><tr><tr><td align="left" class="panel_title_sub" colspan="2">Connection Type</td></tr><tr><td align="left" class="panel_text_alt1" width="50%">MUCore will connect to database using the next connection type.</td><td align="left" class="panel_text_alt2" width="50%" valign="top"><b>' . $core['connection_type'] . '</b></td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Server Databases</td></tr><tr><td align="left" class="panel_text_alt1" width="50%">MUCOre will connect to the following databases.<br><br>If you use <b>only</b> \'MuOnline\' database change $core[\'server_use_2_db\'] to \'0\'. <br><br>If you use <b>2 databases like</b> \'MuOnline\' and \'Me_MuOnline change\' $core[\'server_use_2_db\'] to \'1\'.<br><br>All this configs can be made from <b>config.php</b></td><td align="left" class="panel_text_alt2" width="50%" valign="top"><b>';
if ($core['server_use_2_db'] == '0') {
    echo $core['db_name'];
} elseif ($core['server_use_2_db'] == '1') {
    echo $core['db_name'] . ' and ' . $core['db_name2'];
}
echo '</b></td></tr></table>';
echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px"><tr> <td align="center" class="panel_title" colspan="2">Connection Status</td></tr><tr><tr><td align="left" class="panel_title_sub" colspan="2">' . $core['db_name'] . '</td></tr><tr><td align="left" class="panel_text_alt1" width="50%">Connection with ' . $core['db_name'] . ' Database</td><td align="left" class="panel_text_alt2" width="50%" valign="top">';
if ($core['connection_type'] == "ODBC") {
    $core_db =& ADONewConnection('odbc');
    if ($core['debug'] == 1) {
        $core_db->debug = true;
    }
    $core_db_connect_sql = $core_db->Connect($core['db_name'], $core['db_user'], $core['db_password'], $core['db_host']);
    if (!$core_db_connect_sql) {
        echo 'Failed - <blink>Fix this</blink>';
        $error = '1';
    } else {
        echo '<b>Success</b>';
    }
} elseif ($core['connection_type'] == "MSSQL") {
    $core_db =& ADONewConnection('mssql');
    if ($core['debug'] == 1) {
        $core_db->debug = true;
    }
    $core_db_connect_sql = $core_db->Connect($core['db_host'], $core['db_user'], $core['db_password'], $core['db_name']);
    if (!$core_db_connect_sql) {
        echo 'Failed - <blink>Fix this</b>';
        $error = '1';
    } else {
        echo '<b>Success</b>';
    }
}
echo '</td></tr>';
if ($core['server_use_2_db'] == '1') {
    echo '<tr><td align="left" class="panel_title_sub" colspan="2">' . $core['db_name2'] . '</td></tr><tr><td align="left" class="panel_text_alt1" width="50%">Connection with ' . $core['db_name2'] . ' Database</td><td align="left" class="panel_text_alt2" width="50%" valign="top">';
    if ($core['connection_type'] == "ODBC") {
        $core_db2 =& ADONewConnection('odbc');
        if ($core['debug'] == 1) {
            $core_db2->debug = true;
        }
        $core_db_connect_sql2 = $core_db2->NConnect($core['db_name2'], $core['db_user2'], $core['db_password2'], $core['db_host2']);
        if (!$core_db_connect_sql2) {
            echo 'Failed - <blink>Fix this</b>';
            $error = '1';
        } else {
            echo '<b>Success</b>';
        }
    } elseif ($core['connection_type'] == "MSSQL") {
        $core_db2 =& ADONewConnection('mssql');
        if ($core['debug'] == 1) {
            $core_db2->debug = true;
        }
        $core_db_connect_sql2 = $core_db2->NConnect($core['db_host2'], $core['db_user2'], $core['db_password2'], $core['db_name2']);
        if (!$core_db_connect_sql2) {
            echo 'Failed - <blink>Fix this</b>';
            $error = '1';
        } else {
            echo '<b>Success</b>';
        }
    }
    echo '</td></tr>';
}
if ($error == 1) {
    $button    = '<input type="submit" value="Next Step" disabled>';
    $error_msg = 'Step 2 Status : Please fix errors and refresh page.';
} else {
    $button    = '<input type="submit" value="Next Step" onclick="location.href=\'install.php?step=step_3\'">';
    $error_msg = 'Step 2 Status : Success.';
}
echo '<tr><td align="left" class="panel_buttons">' . $error_msg . '</td><td align="right" class="panel_buttons">' . $button . '</td></tr></table>';
?>
