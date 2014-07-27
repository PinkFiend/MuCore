<?
if (isset($_POST['settings'])) {
    if (empty($_POST['w_sn'])) {
        $error = '1';
        $w_sn  = '<blink> - Fix this!</blink>';
    } else {
        if (strlen($_POST['w_sn']) != '20') {
            $error = '1';
            $w_sn  = '<blink> - Fix this!</blink>';
        } else {
            require('../engine/global_config.php');
            $new_db = fopen("../engine/global_config.php", "w");
            $data   = "<?
";
            $data .= "\$core['config']['on_off'] = \"" . $core['config']['on_off'] . "\";
";
            $data .= "\$core['config']['website_url'] = \"" . $core['config']['website_url'] . "\";
";
            $data .= "\$core['config']['websitetitle'] = \"" . $core['config']['websitetitle'] . "\";
";
            $data .= "\$core['config']['md5'] = \"" . $core['config']['md5'] . "\";
";
            $data .= "\$core['config']['crypt_key'] = \"" . $core['config']['crypt_key'] . "\";
";
            $data .= "\$core['config']['admin_nick'] = \"" . $core['config']['admin_nick'] . "\";
";
            $data .= "\$core['config']['master_mail'] = \"" . $core['config']['master_mail'] . "\";
";
            $data .= "\$core['config']['template'] = \"" . $core['config']['template'] . "\";
";
            $data .= "\$core['config']['copyright'] = \"" . $core['config']['copyright'] . "\";
";
            $data .= "\$core['config']['SN'] = \"" . safe_input($_POST['w_sn'], '') . "\";
";
            $data .= "?>";
            fwrite($new_db, $data);
            fclose($new_db);
            ob_start();
            include('../mucore.core');
            $core_ob = ob_get_contents();
            ob_end_clean();
            require('../engine/global_config.php');
            $extract_core     = crypt_it($core_ob, $core['config']['SN']);
            $core_extract     = base64_decode($extract_core);
            $core_md5_encrypt = md5_decrypt($core_extract);
            $remove_core      = substr_replace($core_md5_encrypt, "", -60);
            $core_dob         = crypt_it($remove_core, $core['config']['SN']);
            $core_l           = preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['SERVER_NAME'], $lru);
            $lru              = $lru[1];
            $core_Ozu         = preg_match('/[^.]+\.[^.]+$/', $lru, $sync);
            $m_sync           = $sync[0];
            echo $core_dob;
            $sync_alfa = md5($core['config']['SN'] . $m_sync);
            echo "<br>$sync_alfa";
            if ($sync_alfa != $core_dob) {
                $error = 1;
                $w_sn  = '<blink> - Fix this!</blink>';
            }
        }
    }
} else {
    $error = '1';
}
echo '<form action="" name="form_edit" method="POST"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel"><tr> <td align="center" class="panel_title" colspan="2">MUCore Serial Number</td></tr><tr><td align="left" class="panel_title_sub" colspan="2">Serial Number</td></tr><tr><td align="left" class="panel_text_alt1" width="45%" valign="top">Input a Serial Number. 20 digits.</td><td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="w_sn" value="';
if (isset($_POST['w_sn'])) {
    echo $_POST['w_sn'];
}
echo '" maxlength="20"> ' . $w_sn . '</td></tr>';
if (!$error == 1) {
    if (isset($_POST['settings'])) {
        $error_msg = 'Preparing Install Status: Please fix the errors and click on save.';
    } else {
        $error_msg = 'Preparing Install Status: Please complete fields and click save.';
    }
    $button = '<input type="submit" value="Next Step" disabled>';
} else {
    $button    = '<input type="button" value="Next Step" onclick="location.href=\'install.php?step=step_1\'">';
    $error_msg = 'Preparing Install Status : Success.';
}
echo '<tr><td align="left" class="panel_buttons"><input type="hidden" name="settings">' . $error_msg . '</td><td align="right" class="panel_buttons"><input type="submit" value="Save">&nbsp;' . $button . '</td></tr></table></form>';
?>
