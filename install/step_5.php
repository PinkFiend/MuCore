<?
require('connect_core.php');
echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;"><tr> <td align="center" class="panel_title" colspan="5">Importing Cron Jobs</td></tr><tr><td align="left" class="panel_title_sub2" width="20">#</td><td align="left" class="panel_title_sub2">Table</td><td align="left" class="panel_title_sub2">Cron Job</td><td align="left" class="panel_title_sub2" width="200">Status</td></tr>';
$count = 0;
if ($tables = opendir('import/cron_jobs')) {
    while (($file_sql = readdir($tables)) !== false) {
        $sql_only = substr_replace($file_sql, "", 0, -4);
        if ($sql_only == '.sql' || $file_sql != '.' && $file_sql != '..') {
            $count++;
            $tr_color       = ($count % 2) ? '' : 'even';
            $row_sql        = substr_replace($file_sql, "", -4);
            $row_sql_fields = explode("^", $row_sql);
            $table_sql      = $row_sql_fields[0];
            $cron_job_name  = $row_sql_fields[1];
            $cron_job_id    = $row_sql_fields[2];
            ob_start();
            include 'import/cron_jobs/' . $file_sql . '';
            $query = ob_get_contents();
            ob_end_clean();
            echo '<tr class="' . $tr_color . '"><td align="left" class="panel_text_alt_list"><strong>' . $count . '</strong></td><td align="left" class="panel_text_alt_list"><strong>' . $table_sql . '</strong></td><td align="left" class="panel_text_alt_list"><strong>' . $cron_job_name . '</strong></td><td align="left" class="panel_text_alt_list">';
            $check_job = $core_db->Execute("Select id from MUCore_Cron_Jobs where cron_id=?", array(
                $cron_job_id
            ));
            if ($check_job->EOF) {
                echo 'Executing....';
                $create_job = $core_db->Execute($query);
                if ($create_job) {
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
    if ($error == 1) {
        $button    = '<input type="submit" value="Next Step" disabled>';
        $error_msg = 'Step 5 Status: Please fix errors and refresh page.';
    } else {
        $button    = '<input type="submit" value="Next Step" onclick="location.href=\'install.php?step=step_6\'">';
        $error_msg = 'Step 5 Status: Success.';
    }
    echo '</table>      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" ><tr><td align="left" class="panel_buttons">' . $error_msg . '</td><td align="right" class="panel_buttons">' . $button . '</td></tr></table>';
}
?>
