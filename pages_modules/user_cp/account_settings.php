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
$settings = simplexml_load_file('engine/config_mods/account_settings_settings.xml');
$active   = trim($settings->active);
if ($active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    if ($settings->method == '2') {
        $verification_config = simplexml_load_file('engine/config_mods/human_verification.xml');
        if ($verification_config->human_verification_type == 'reCAPTCHA') {
            $is_reCAPTCHA = '1';
            require_once('engine/recaptchalib.php');
            $privatekey = $verification_config->reCAPTCHA_private_key;
            $resp       = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
        }
        
        $jq_cron = $core_db->Execute("Select next_cron from MUCore_Cron_Jobs where cron_id=?", array(
            trim($settings->cron_job)
        ));
        if (cron_check($jq_cron->fields[0]) == false) {
            $jq_cron_up          = $core_db->Execute("Update MUCore_Cron_Jobs set next_cron=(" . time() . "+cron_time_set) where cron_id=?", array(
                trim($settings->cron_job)
            ));
            $_get_temp_passwords = $core_db->Execute("Select id,expire from MUCore_Change_Passwords order by expire asc");
            while (!$_get_temp_passwords->EOF) {
                $temp_expire_pass_time = $_get_temp_passwords->fields[1] - time();
                if ($temp_expire_pass_time <= 0) {
                    $delete_temp_pass = $core_db->Execute("Delete from MUCore_Change_Passwords where id=?", array(
                        $_get_temp_passwords->fields[0]
                    ));
                }
                $_get_temp_passwords->MoveNext();
            }
        }
        
        if (isset($_POST['change_pass'])) {
            require("engine/validate.php");
            
            $elems[] = array(
                'name' => 'current_password',
                'label' => '' . text_accountsettings_t1 . '',
                'type' => 'text',
                'required' => true,
                'len_min' => 6,
                'len_max' => 12,
                'cont' => 'alpha'
            );
            $elems[] = array(
                'name' => 'new_password',
                'label' => '' . text_accountsettings_t2 . '',
                'type' => 'text',
                'required' => true,
                'len_min' => 6,
                'len_max' => 12,
                'cont' => 'alpha'
            );
            $elems[] = array(
                'name' => 'confirm_new_password',
                'label' => '' . text_accountsettings_t3 . '',
                'type' => 'text',
                'required' => true,
                'len_min' => 6,
                'len_max' => 12,
                'cont' => 'alpha',
                'equal' => array(
                    'new_password'
                )
            );
            
            $f   = new FormValidator($elems);
            $err = $f->validate($_POST);
            if ($err === true) {
                $valid = $f->getValidElems();
                foreach ($valid as $k => $v) {
                    if ($valid[$k][0][1] == false) {
                        if (empty($valid[$k][0][2])) {
                            echo msg('0', $valid[$k][0][2]);
                            $error_password = '1';
                        } else {
                            echo msg('0', $valid[$k][0][2]);
                            $error_password = '1';
                        }
                    }
                }
            } else {
                $current_password     = safe_input($_POST['current_password'], '');
                $new_password         = safe_input($_POST['new_password'], '');
                $confirm_new_password = safe_input($_POST['confirm_new_password'], '');
                
                if ($is_reCAPTCHA == '1') {
                    if (!$resp->is_valid) {
                        $bot_check = '1';
                    }
                } else {
                    if ($_SESSION['SID_code'] != md5($_POST['verify_int'])) {
                        $bot_check = '1';
                    }
                }
                
                
                if ($bot_check == '1') {
                    echo msg('0', text_accountsettings_t4);
                    $error_password = '1';
                } else {
                    if ($core['config']['md5'] == '1') {
                        $pass_ver = $core_db2->Execute("Select memb__pwd,mail_addr from MEMB_INFO where memb__pwd = [dbo].[fn_md5](?,?) and memb___id = ?", array(
                            $current_password,
                            $user_auth_id,
                            $user_auth_id
                        ));
                    } elseif ($core['config']['md5'] == '0') {
                        $pass_ver = $core_db2->Execute("Select memb__pwd,mail_addr from MEMB_INFO where memb__pwd = ? and memb___id = ?", array(
                            $current_password,
                            $user_auth_id
                        ));
                    }
                    if ($pass_ver) {
                        if ($pass_ver->EOF) {
                            echo msg('0', text_accountsettings_t5);
                            $error_password = '1';
                        } else {
                            $hash                   = md5(uniqid(microtime(), 1));
                            $insert_change_password = $core_db->Execute("Insert into MUCore_Change_Passwords(password,email,expire,memb___id,hash) VALUES (?,?,?,?,?)", array(
                                $new_password,
                                $pass_ver->fields[1],
                                time() + 86400,
                                $user_auth_id,
                                $hash
                            ));
                            if ($insert_change_password) {
                                $password_insert = '1';
                            }
                            /*
                            if($core['config']['md5'] == '1'){
                            $pass_up = $core_db2->Execute("Update memb_info set memb__pwd = [dbo].[fn_md5](?,?) where memb___id=?",array($new_password,$user_auth_id,$user_auth_id));
                            }elseif ($core['config']['md5'] == '0'){
                            $pass_up = $core_db2->Execute("Update memb_info set memb__pwd = ? where memb___id=?",array($new_password,$user_auth_id));
                            }
                            if($pass_up){
                            echo msg('1','Password successfully changed, please re log-in.');
                            }else{
                            echo msg('0','Unable to change password, reason: system error, please contact administrator.');
                            }*/
                        }
                        
                    } else {
                        echo msg('0', text_accountsettings_t6);
                    }
                }
            }
        }
        
        
        if (isset($_GET['change_password_md5'])) {
            $change_password_md5 = '1';
        }
        
        
        echo '    <table  border="0" cellspacing="4" cellpadding="0"  align="center" width="100%" >
            <tr>';
        if ($password_insert != '1' && $change_password_md5 != '1') {
            echo '<td align="left" class="curent_step" width="33%">1. ' . text_accountsettings_t7 . '</td>';
        } else {
            echo '<td align="left" class="step" width="33%">1. ' . text_accountsettings_t7 . '</td>';
        }
        if ($password_insert == '1' && $change_password_md5 != '1') {
            echo '<td align="left" class="curent_step"  width="33%">2. ' . text_accountsettings_t8 . '</td>';
        } else {
            echo '<td align="left" class="step"  width="33%">2. ' . text_accountsettings_t8 . '</td>';
        }
        if ($change_password_md5 == '1') {
            echo '<td align="left" class="curent_step"  width="33%">3. ' . text_accountsettings_t9 . '</td>';
        } else {
            echo '<td align="left" class="step"  width="33%">3. ' . text_accountsettings_t9 . '</td>';
        }
        echo '
            </tr>
            </table>';
        
        if ($password_insert != '1' && $change_password_md5 != '1') {
            echo '    <form name="form" method="post" action="">
            <table border="0" cellspacing="10" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;" align="center">
            <tr>
            <td colspan="3" align="left" class="iRg_line">' . text_accountsettings_t10 . ':</td>
            </tr>
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="160">' . text_accountsettings_t11 . '</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="password" name="current_password" maxlength="12"></td>
            <td align="left" ><span class="iRg_inf">' . text_accountsettings_t12 . '</span></td>
            </tr>
            <tr>
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="130">' . text_accountsettings_t13 . '</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="password" name="new_password" maxlength="12"></td>
            <td align="left" ><span class="iRg_inf">' . text_accountsettings_t12 . '</span></td>
            </tr>
            <tr>        
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="130">' . text_accountsettings_t14 . '</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="password" name="confirm_new_password" maxlength="12"></td>
            <td align="left" ><span class="iRg_inf"><em>*' . text_accountsettings_t16 . '</em></span></td>
            </tr>
            <tr>    
            
<td colspan="3" align="left" class="iRg_line">' . text_accountsettings_t17 . ':</td>
</tr>
            <tr>
<td align="left" colspan="3"> ';
            if ($is_reCAPTCHA == '1') {
                $publickey = $verification_config->reCAPTCHA_public_key;
                echo '<script type="text/javascript">
        var RecaptchaOptions = {
            theme : \'' . $verification_config->reCAPTCHA_theme . '\'
            ,lang : \'en\'
        };
    </script>
';
                echo recaptcha_get_html($publickey);
                
            } else {
                echo '
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left"><img src="get.php?aI" border="0"></td>
<td align="left" class="iRg_inf"><div align="left" style="padding-bottom: 4px; ">' . text_accountsettings_t18 . '</div><input class="iRg_input" type="text" name="verify_int" id="verify_int"></td>
</tr>
</table>';
            }
            
            echo '
</td>
</tr>
            </table>
            <input type="hidden" name="change_pass">
            
            <table border="0" cellspacing="10" cellpadding="0" width="100%"  align="center">
            <tr>
            <td align="right"><input type="image" src="template/' . $core['config']['template'] . '/images/submit_btn.gif" onclick="return prse_inputs()"></td>
            <td align="left"><img src="template/' . $core['config']['template'] . '/images/cancel_btn.gif" border="0" onclick="location.href=\'' . $core['config']['website_url'] . '\'"></td>
            </table>
            </form>';
            
        } elseif ($password_insert == '1') {
            /*
            require("engine/smtp.php");
            $get_config = simplexml_load_file('engine/config_mods/smtp_settings.xml');
            $mail = new SMTP($get_config->smtp_server,$get_config->smtp_username,$get_config->smtp_password);
            $header = $mail->make_header($core['config']['master_mail'],$pass_ver->fields[1],'Change Password for '.$core['config']['websitetitle'].'');
            $header .= "Content-Type: text/html; charset=\"iso-8859-1\" \r\n";
            $header .= "Content-Transfer-Encoding: 8bit \r\n";
            $header .= "MIME-Version: 1.0 \r\n";
            */
            $body = str_replace("{user_id}", $user_auth_id, mail_changepassword_t1);
            $body = str_replace("{website_title}", $core['config']['websitetitle'], $body);
            $body = str_replace("{change_password_url}", $core['config']['website_url'] . '/' . ROOT_INDEX . '?' . LOAD_GET_PAGE . '=' . USER_CMS_PAGE . '&' . USER_GET_PAGE . '=' . ACCOUNTSETTINGS_CMS_USER . '&change_password_md5=' . $hash, $body);
            $body = str_replace("{new_password}", $new_password, $body);
            
            /*
            $body = 'Dear '.$user_auth_id.',<br><br>
            You have requested to change your password on '.$core['config']['websitetitle'].'. If you did not request this, please ignore it. It will expire in 24 hours time.<br>
            <br>
            To change your password, please visit the following page:<br>
            <a href="'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.USER_CMS_PAGE.'&'.USER_GET_PAGE.'='.ACCOUNTSETTINGS_CMS_USER.'&change_password_md5='.$hash.'">'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.USER_CMS_PAGE.'&'.USER_GET_PAGE.'='.ACCOUNTSETTINGS_CMS_USER.'&change_password_md5='.$hash.'</a><br><br>
            When you visit that page, your password will be changed.<br><br>
            Your username is: '.$user_auth_id.'<br>
            Your new password is: '.$new_password.'
            <br><br><br>
            All the best,<br>
            '.$core['config']['websitetitle'].' Team.';
            */
            if ($core['debug'] == '1') {
                define('DISPLAY_XPM4_ERRORS', true);
            } else {
                define('DISPLAY_XPM4_ERRORS', false);
            }
            
            $get_config = simplexml_load_file('engine/config_mods/smtp_settings.xml');
            
            require("engine/mail.php");
            $m = new MAIL;
            $m->From($core['config']['master_mail']);
            $m->AddTo(trim($pass_ver->fields[1]));
            $m->Subject('Change Password for ' . $core['config']['websitetitle'] . '');
            $m->Html($body);
            
            if ($get_config->smtp_connection == 'none') {
                $c = $m->Connect(trim($get_config->smtp_server), intval($get_config->smtp_port), trim($get_config->smtp_username), trim($get_config->smtp_password)) or $smtp_connect_fail = '1';
            } else {
                $c = $m->Connect(trim($get_config->smtp_server), intval($get_config->smtp_port), trim($get_config->smtp_username), trim($get_config->smtp_password), trim($get_config->smtp_connection), 10, 'localhost', null, 'plain') or $smtp_connect_fail = '1';
            }
            
            if ($smtp_connect_fail != '1') {
                if ($m->Send($c)) {
                    echo msg('1', text_accountsettings_t19);
                } else {
                    echo msg('0', text_accountsettings_t20);
                }
            } else {
                echo msg('0', text_accountsettings_t21);
            }
            
        } elseif ($change_password_md5 == '1') {
            if (empty($_GET['change_password_md5'])) {
                header('Location: ' . ROOT_INDEX . '');
            } else {
                $md5_link = safe_input($_GET['change_password_md5'], '');
                
                
                $take_pass = $core_db->Execute("Select memb___id,password from MUCore_Change_Passwords where hash=?", array(
                    $md5_link
                ));
                if ($take_pass->EOF) {
                    echo msg('0', text_accountsettings_t22);
                } else {
                    if ($core['config']['md5'] == '1') {
                        $pass_up = $core_db2->Execute("Update MEMB_INFO set memb__pwd = [dbo].[fn_md5](?,?) where memb___id=?", array(
                            $take_pass->fields[1],
                            $take_pass->fields[0],
                            $take_pass->fields[0]
                        ));
                    } elseif ($core['config']['md5'] == '0') {
                        $pass_up = $core_db2->Execute("Update MEMB_INFO set memb__pwd = ? where memb___id=?", array(
                            $take_pass->fields[1],
                            $take_pass->fields[0]
                        ));
                    }
                    if ($pass_up) {
                        echo msg('1', text_accountsettings_t23);
                    } else {
                        echo msg('0', text_accountsettings_t24);
                    }
                }
            }
        }
        
    } elseif ($settings->method == '1') {
        $verification_config = simplexml_load_file('engine/config_mods/human_verification.xml');
        if ($verification_config->human_verification_type == 'reCAPTCHA') {
            $is_reCAPTCHA = '1';
            require_once('engine/recaptchalib.php');
            $privatekey = $verification_config->reCAPTCHA_private_key;
            $resp       = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
        }
        
        if (isset($_POST['change_pass'])) {
            require("engine/validate.php");
            
            $elems[] = array(
                'name' => 'current_password',
                'label' => '' . text_accountsettings_t1 . '',
                'type' => 'text',
                'required' => true,
                'len_min' => 6,
                'len_max' => 12,
                'cont' => 'alpha'
            );
            $elems[] = array(
                'name' => 'new_password',
                'label' => '' . text_accountsettings_t2 . '',
                'type' => 'text',
                'required' => true,
                'len_min' => 6,
                'len_max' => 12,
                'cont' => 'alpha'
            );
            $elems[] = array(
                'name' => 'confirm_new_password',
                'label' => '' . text_accountsettings_t3 . '',
                'type' => 'text',
                'required' => true,
                'len_min' => 6,
                'len_max' => 12,
                'cont' => 'alpha',
                'equal' => array(
                    'new_password'
                )
            );
            
            $f   = new FormValidator($elems);
            $err = $f->validate($_POST);
            if ($err === true) {
                $valid = $f->getValidElems();
                foreach ($valid as $k => $v) {
                    if ($valid[$k][0][1] == false) {
                        if (empty($valid[$k][0][2])) {
                            echo msg('0', $valid[$k][0][2]);
                        } else {
                            echo msg('0', $valid[$k][0][2]);
                        }
                    }
                }
            } else {
                $current_password     = safe_input($_POST['current_password'], '');
                $new_password         = safe_input($_POST['new_password'], '');
                $confirm_new_password = safe_input($_POST['confirm_new_password'], '');
                
                if ($is_reCAPTCHA == '1') {
                    if (!$resp->is_valid) {
                        $bot_check = '1';
                    }
                } else {
                    if ($_SESSION['SID_code'] != md5($_POST['verify_int'])) {
                        $bot_check = '1';
                    }
                }
                
                if ($bot_check == '1') {
                    echo msg('0', text_accountsettings_t4);
                } else {
                    if ($core['config']['md5'] == '1') {
                        $pass_ver = $core_db2->Execute("Select memb__pwd from MEMB_INFO where memb__pwd = [dbo].[fn_md5](?,?) and memb___id = ?", array(
                            $current_password,
                            $user_auth_id,
                            $user_auth_id
                        ));
                    } elseif ($core['config']['md5'] == '0') {
                        $pass_ver = $core_db2->Execute("Select memb__pwd from MEMB_INFO where memb__pwd = ? and memb___id = ?", array(
                            $current_password,
                            $user_auth_id
                        ));
                    }
                    if ($pass_ver) {
                        if ($pass_ver->EOF) {
                            echo msg('0', text_accountsettings_t5);
                        } else {
                            if ($core['config']['md5'] == '1') {
                                $pass_up = $core_db2->Execute("Update MEMB_INFO set memb__pwd = [dbo].[fn_md5](?,?) where memb___id=?", array(
                                    $new_password,
                                    $user_auth_id,
                                    $user_auth_id
                                ));
                            } elseif ($core['config']['md5'] == '0') {
                                $pass_up = $core_db2->Execute("Update MEMB_INFO set memb__pwd = ? where memb___id=?", array(
                                    $new_password,
                                    $user_auth_id
                                ));
                            }
                            if ($pass_up) {
                                echo msg('1', text_accountsettings_t23);
                            } else {
                                echo msg('0', text_accountsettings_t24);
                            }
                        }
                        
                    } else {
                        echo msg('0', text_accountsettings_t25);
                    }
                    
                }
                
                
            }
        }
        echo '    <form name="form" method="post" action="">
            <table border="0" cellspacing="10" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;" align="center">
            <tr>
            <td colspan="3" align="left" class="iRg_line">' . text_accountsettings_t10 . ':</td>
            </tr>
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="160">' . text_accountsettings_t11 . '</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="password" name="current_password" maxlength="12"></td>
            <td align="left" ><span class="iRg_inf">' . text_accountsettings_t12 . '</span></td>
            </tr>
            <tr>
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="130">' . text_accountsettings_t13 . '</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="password" name="new_password" maxlength="12"></td>
            <td align="left" ><span class="iRg_inf">' . text_accountsettings_t12 . '</span></td>
            </tr>
            <tr>        
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="130">' . text_accountsettings_t14 . '</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="password" name="confirm_new_password" maxlength="12"></td>
            <td align="left" ><span class="iRg_inf"><em>*' . text_accountsettings_t16 . '</em></span></td>
            </tr>
            <tr>    
            
<td colspan="3" align="left" class="iRg_line">' . text_accountsettings_t17 . ':</td>
</tr>
            <tr>
<td align="left" colspan="3">';
        if ($is_reCAPTCHA == '1') {
            $publickey = $verification_config->reCAPTCHA_public_key;
            echo '<script type="text/javascript">
        var RecaptchaOptions = {
            theme : \'' . $verification_config->reCAPTCHA_theme . '\'
            ,lang : \'en\'
        };
    </script>
';
            echo recaptcha_get_html($publickey);
            
        } else {
            echo '
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td align="left"><img src="get.php?aI" border="0"></td>
<td align="left" class="iRg_inf"><div align="left" style="padding-bottom: 4px; ">' . text_accountsettings_t18 . '</div><input class="iRg_input" type="text" name="verify_int" id="verify_int"></td>
</tr>
</table>';
        }
        
        echo '

</td>
</tr>
            </table>
            <input type="hidden" name="change_pass">
            
            <table border="0" cellspacing="10" cellpadding="0" width="100%"  align="center">
            <tr>
            <td align="right"><input type="image" src="template/' . $core['config']['template'] . '/images/submit_btn.gif" onclick="return prse_inputs()"></td>
            <td align="left"><img src="template/' . $core['config']['template'] . '/images/cancel_btn.gif" border="0" onclick="location.href=\'' . $core['config']['website_url'] . '\'"></td>
            </table>
            </form>';
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