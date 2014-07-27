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
$config = simplexml_load_file('engine/config_mods/contact_settings.xml');
if ($config->active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    $verification_config = simplexml_load_file('engine/config_mods/human_verification.xml');
    if ($verification_config->human_verification_type == 'reCAPTCHA') {
        $is_reCAPTCHA = '1';
        require_once('engine/recaptchalib.php');
        $privatekey = $verification_config->reCAPTCHA_private_key;
        $resp       = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
    }
    
    if (trim($config->method) == '1') {
        if (isset($_POST['send_message'])) {
            require("engine/validate.php");
            $elems[] = array(
                'name' => 'name',
                'label' => '' . text_contact_us_invalid_name . '',
                'type' => 'text',
                'required' => true,
                'len_max' => 30,
                'cont' => 'word_space'
            );
            $elems[] = array(
                'name' => 'email',
                'label' => '' . text_contact_us_invalid_email . '',
                'type' => 'text',
                'required' => true,
                'len_max' => 50,
                'cont' => 'email'
            );
            if ($_POST['subject'] == 'other') {
                $elems[] = array(
                    'name' => 'other_subject',
                    'label' => '' . text_contact_us_invalid_subject . '',
                    'type' => 'text',
                    'required' => true,
                    'len_max' => 100,
                    'cont' => 'mail_subject'
                );
            }
            
            
            $f = new FormValidator($elems);
            
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
                if (empty($_POST['subject'])) {
                    echo msg('0', 'Please select one subject.');
                } else {
                    if (empty($_POST['message'])) {
                        echo msg('0', 'Please write a message.');
                    } else {
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
                            echo msg('0', '' . text_contact_us_err1 . '');
                        } else {
                            /*
                            require("engine/smtp.php");
                            $get_config = simplexml_load_file('engine/config_mods/smtp_settings.xml');
                            $mail = new SMTP($get_config->smtp_server,$get_config->smtp_username,$get_config->smtp_password);
                            */
                            
                            if ($_POST['subject'] == 'other') {
                                $subject_set = set_limit(htmlspecialchars($_POST['other_subject']), '100', '');
                            } else {
                                $subject_set = get_contact_subject($_POST['subject']);
                            }
                            $contact_name = safe_input($_POST['name'], '\ ');
                            $email        = safe_input($_POST['email'], '\_\@\.\-');
                            
                            /*
                            $header = $mail->make_header($core['config']['master_mail'], $config->email,$core['config']['websitetitle'].' Contact Us - '.$subject_set.'');
                            $header .= "Content-Type: text/html; charset=\"iso-8859-1\" \r\n";
                            $header .= "Content-Transfer-Encoding: 8bit \r\n";
                            $header .= "MIME-Version: 1.0 \r\n";
                            */
                            
                            $body = '' . $contact_name . ' ( <a href="mailto:' . $email . '">' . $email . '</a> ) has sent you a message,<br><br>
            ---------------------------------------------------------<br>
            ' . htmlspecialchars(set_limit($_POST['message'], trim($config->message_length), '')) . '<br>
            ---------------------------------------------------------<br><br>
            Referring Page: <a href="' . $_SERVER['HTTP_REFERER'] . '">' . $_SERVER['HTTP_REFERER'] . '</a> IP Address: ' . $_SERVER['REMOTE_ADDR'] . '';
                            
                            if ($core['debug'] == '1') {
                                define('DISPLAY_XPM4_ERRORS', true);
                            } else {
                                define('DISPLAY_XPM4_ERRORS', false);
                            }
                            
                            $get_config = simplexml_load_file('engine/config_mods/smtp_settings.xml');
                            
                            require("engine/mail.php");
                            $m = new MAIL;
                            $m->From($core['config']['master_mail']);
                            $m->AddTo(trim($config->email));
                            $m->Subject('Contact Us - ' . $subject_set . '');
                            $m->Html($body);
                            
                            if ($get_config->smtp_connection == 'none') {
                                $c = $m->Connect(trim($get_config->smtp_server), intval($get_config->smtp_port), trim($get_config->smtp_username), trim($get_config->smtp_password)) or $smtp_connect_fail = '1';
                            } else {
                                $c = $m->Connect(trim($get_config->smtp_server), intval($get_config->smtp_port), trim($get_config->smtp_username), trim($get_config->smtp_password), trim($get_config->smtp_connection), 10, 'localhost', null, 'plain') or $smtp_connect_fail = '1';
                            }
                            if ($smtp_connect_fail != '1') {
                                if ($m->Send($c)) {
                                    echo msg('1', '' . text_contact_us_msg1 . '');
                                } else {
                                    echo msg('0', '' . text_contact_us_err2 . '');
                                }
                            } else {
                                echo msg('0', '' . text_contact_us_err3 . '');
                            }
                            
                        }
                        
                    }
                    
                    
                }
                
            }
        }
        
        echo '

    <script language="javascript" type="text/javascript">
<!--
function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}
-->
</script>


    <form name="form" method="post" action="">
            <table border="0" cellspacing="10" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;" align="center">
            <tr>
            <td colspan="3" align="left" class="iRg_line">' . text_contact_us_t1 . ':</td>
            </tr>
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="160">' . text_contact_us_t2 . ' :</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="text" name="name" maxlength="30" value="' . htmlspecialchars($_POST['name']) . '"></td>
            <td align="left" ><span class="iRg_inf"></span></td>
            </tr>
            <tr>
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="130">' . text_contact_us_t3 . ' :</td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="text" name="email" maxlength="50" value="' . htmlspecialchars($_POST['email']) . '"></td>
            <td align="left" ><span class="iRg_inf">' . text_contact_us_t4 . ' </span></td>
            </tr>
            <tr>        
            <tr>    
            <tr>
            <td colspan="3" align="left" class="iRg_line">' . text_contact_us_t5 . ':</td>
            </tr>';
        
        foreach ($contact_subjects as $subject_id => $subject) {
            if ($_POST['subject'] == $subject_id) {
                echo '<tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="160" colspan="3"><label><input type="radio" value="' . $subject_id . '" name="subject" checked> ' . $subject . '</label></td>
            </tr>';
            } else {
                echo '<tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="160" colspan="3"><label><input type="radio" value="' . $subject_id . '" name="subject"> ' . $subject . ' </label></td>
            </tr>';
            }
            
        }
        
        echo '
            <tr>
            <td align="left" class="iRg_text" style="padding-left: 24px;" width="160"><label><input type="radio" value="other" name="subject" ';
        if ($_POST['subject'] == 'other') {
            echo 'checked';
        }
        echo '> Other :</label></td>
            <td align="left" class="iRg_inf"><input class="iRg_input" type="text" name="other_subject" maxlength="100" size="30" value="' . htmlspecialchars($_POST['other_subject']) . '"></td>
            <td align="left"><span class="iRg_inf"></td>
            </tr>
<tr>
            <td colspan="3" align="left" class="iRg_line">' . text_contact_us_t6 . ':</td>
            </tr>
</tr>
<tr>
            <td colspan="3" align="left"><textarea class="iRg_input" rows="10" style="width: 100%; height: auto;" onkeypress="return imposeMaxLength(this,' . trim($config->message_length) . '-1);" name="message">' . htmlspecialchars($_POST['message']) . '</textarea></td>
            </tr>
            <tr>
            <td align="right" colspan="3"><span class="iRg_inf">' . str_replace("{msg_length}", trim($config->message_length), text_contact_us_t7) . '</span></td>
            </tr>
            
            
<td colspan="3" align="left" class="iRg_line">' . text_contact_us_t8 . ':</td>
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
<td align="left" class="iRg_inf"><div align="left" style="padding-bottom: 4px; ">' . text_contact_us_t9 . '</div><input class="iRg_input" type="text" name="verify_int" id="verify_int"></td>
</tr>
</table>';
        }
        
        echo '
</td>
</tr>
            </table>
            <input type="hidden" name="send_message">
            
            <table border="0" cellspacing="10" cellpadding="0" width="100%"  align="center">
            <tr>
            <td align="right"><input type="image" src="template/' . $core['config']['template'] . '/images/submit_btn.gif" onclick="return prse_inputs()"></td>
            <td align="left"><img src="template/' . $core['config']['template'] . '/images/cancel_btn.gif" border="0" onclick="location.href=\'' . $core['config']['website_url'] . '\'"></td>
            </table>
            </form>';
        
        
    } elseif (trim($config->method == '2')) {
        echo '<div align="center" style="padding-top: 10px; padding-bottom: 10px;"><b>' . str_replace("{mail}", '<a href="mailto:' . $config->email . '">' . $config->email . '</a>', text_contact_us_t10) . '</b></div>';
        
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