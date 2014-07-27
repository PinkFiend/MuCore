<?
require('connect_core.php');
echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;"><tr> <td align="center" class="panel_title" colspan="5">Adding New Rows To Tables</td></tr><tr><td align="left" class="panel_title_sub2" width="20">#</td><td align="left" class="panel_title_sub2">Table</td><td align="left" class="panel_title_sub2">Row</td><td align="left" class="panel_title_sub2" width="200">Status</td></tr>';
$count = 0;
if ($tables = opendir('mucore_rows_sql/db1')) {
    while (($file_sql = readdir($tables)) !== false) {
        $sql_only = substr_replace($file_sql, "", 0, -4);
        if ($sql_only == '.sql' || $file_sql != '.' && $file_sql != '..') {
            $count++;
            $tr_color       = ($count % 2) ? '' : 'even';
            $row_sql        = substr_replace($file_sql, "", -4);
            $row_sql_fields = explode("^", $row_sql);
            $table_sql      = $row_sql_fields[0];
            $row_table_sql  = $row_sql_fields[1];
            ob_start();
            include 'mucore_rows_sql/db1/' . $file_sql . '';
            $query = ob_get_contents();
            ob_end_clean();
            echo '<tr class="' . $tr_color . '"><td align="left" class="panel_text_alt_list"><strong>' . $count . '</strong></td><td align="left" class="panel_text_alt_list"><strong>' . $table_sql . '</strong></td><td align="left" class="panel_text_alt_list"><strong>' . $row_table_sql . '</strong></td><td align="left" class="panel_text_alt_list">';
            $check_row = $core_db->Execute("Select top 1 " . $row_table_sql . " from " . $table_sql . "");
            if (!$check_row) {
                echo 'Executing....';
                $create_row = $core_db->Execute($query);
                if ($create_row) {
                    echo '<b>Success</b>';
                } else {
                    echo 'Failed - <blink>Fix this</blink>';
                    $error = 1;
                }
            } else {
                echo 'Already exists...<b>Success</b>';
            }
            echo '</td></tr>';
        }
    }
    if ($tables = opendir('mucore_rows_sql/db2')) {
        while (($file_sql = readdir($tables)) !== false) {
            $sql_only = substr_replace($file_sql, "", 0, -4);
            if ($sql_only == '.sql' || $file_sql != '.' && $file_sql != '..') {
                $count++;
                $tr_color       = ($count % 2) ? '' : 'even';
                $row_sql        = substr_replace($file_sql, "", -4);
                $row_sql_fields = explode("^", $row_sql);
                $table_sql      = $row_sql_fields[0];
                $row_table_sql  = $row_sql_fields[1];
                ob_start();
                include 'mucore_rows_sql/db2/' . $file_sql . '';
                $query = ob_get_contents();
                ob_end_clean();
                echo '<tr class="' . $tr_color . '"><td align="left" class="panel_text_alt_list"><strong>' . $count . '</strong></td><td align="left" class="panel_text_alt_list"><strong>' . $table_sql . '</strong></td><td align="left" class="panel_text_alt_list"><strong>' . $row_table_sql . '</strong></td><td align="left" class="panel_text_alt_list">';
                $check_row = $core_db2->Execute("Select top 1 " . $row_table_sql . " from " . $table_sql . "");
                if (!$check_row) {
                    echo 'Executing....';
                    $create_row = $core_db2->Execute($query);
                    if ($create_row) {
                        echo '<b>Success</b>';
                    } else {
                        echo 'Failed - <blink>Fix this</blink>';
                        $error = 1;
                    }
                } else {
                    echo 'Already exists...<b>Success</b>';
                }
                echo '</td></tr>';
            }
        }
    }
    if ($error == 1) {
        $button    = '<input type="submit" value="Next Step" disabled>';
        $error_msg = 'Step 4 Status: Please fix errors and refresh page.';
    } else {
        $button    = '<input type="submit" value="Next Step" onclick="location.href=\'install.php?step=step_5\'">';
        $error_msg = 'Step 4 Status: Success.';
    }
    echo '</table>      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" ><tr><td align="left" class="panel_buttons">' . $error_msg . '</td><td align="right" class="panel_buttons">' . $button . '</td></tr></table>';
}
?>
