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
$get_config = simplexml_load_file('engine/config_mods/register_settings.xml');
if ($get_config->active == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    $register_method = $get_config->method;
    
    $verification_config = simplexml_load_file('engine/config_mods/human_verification.xml');
    if ($verification_config->human_verification_type == 'reCAPTCHA') {
        $is_reCAPTCHA = '1';
        require_once('engine/recaptchalib.php');
        $privatekey = $verification_config->reCAPTCHA_private_key;
        $resp       = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
    }
    
    
    
    echo '
<script type="text/javascript">    
load_image= new Image(16,16); 
load_image.src="template/' . $core['config']['template'] . '/images/load.gif"; 

function Ajax(div,id, page, form, append, data){

    document.getElementById(div).innerHTML = \'<img src="template/' . $core['config']['template'] . '/images/load.gif" width="16" height="16"> Please wait...\';
    var veri = \'\';
    if( typeof(data) == "string")
        veri = data;
    else 
        veri = $(form).serialize();
    $.ajax({
   type: "POST",
   url: page,
   data: veri,
   error: function(html)
   {
           alert("falied");
   },
   success: function(html)
   {
        if( typeof(append) == "boolean")
            $(id).append(html);
        else
            $(id).html(html);
   }
  });
  return false;
}
</script>

<script type="text/javascript">
function cs_ua_a(){
    if (document.sign_up_frm.userid.value.length < 4){
        alert(\'User ID, 4-10 characters\n(letters and numbers only)\');
    }else{
        uss = document.getElementById(\'userid\').value;
        url_p = "get.php?aA="+uss;
        Ajax(\'c_uss\',\'#c_uss\',url_p, null, \'data=c_uss\');
    }

}

function csm_uam_am(){
    if (document.sign_up_frm.email_address.value.length < 2){
        alert(\'Please enter an valid mail address \n(e.g: somebody@yahoo.com)\');
    }else{
        uss = document.getElementById(\'email_address\').value;
        url_p = "get.php?aMl="+uss;
        Ajax(\'c_mss\',\'#c_mss\',url_p, null, \'data=c_mss\');
    }

}

function parse_inputs(){
    if (document.sign_up_frm.userid.value.length < 4){
        alert(\'User ID, 4-12 characters\n(letters and numbers only)\');
        return false;
    }
    
    if (document.sign_up_frm.password.value.length < 6){
        alert(\'Password, 6-12 characters\n(letters and numbers only, passwords are case-sensitive.)\');
        return false;
    }
    
    if (document.sign_up_frm.confirm_password.value.length < 6){
        alert(\'Confirm Password, 6-12 characters\n(letters and numbers only, passwords are case-sensitive.)\');
        return false;
    }
    if (document.sign_up_frm.password.value != document.sign_up_frm.confirm_password.value){
        alert(\'Passwords did not match.\');
        return false;
    }
    ';
    if ($get_config->pers_id_active == '1') {
        echo 'if (document.sign_up_frm.pers_id.value.length < ' . $get_config->pers_id_length . '){
        alert(\'Please enter an valid Personal ID number \n(12 digits, numbers only.)\');
        return false;
    }';
    }
    
    echo '
    if (document.sign_up_frm.email_address.value.length < 2){
        alert(\'Please enter an valid mail address \n(e.g: somebody@gmail.com)\');
        return false;
    }
    if (document.sign_up_frm.country.value ==  \'x\'){
        alert(\'Please select country.\');
        return false;
    }
    if ((document.sign_up_frm.gender[0].checked==false)&&(document.sign_up_frm.gender[1].checked==false)){
        alert(\'Please select gender.\');
        return false;
    }
    if (document.sign_up_frm.question.value ==  \'x\'){
        alert(\'Please select question.\');
        return false;
    }
    if (document.sign_up_frm.answer.value.length < 4){
        alert(\'Please enter the answer to your secret question.\n(letters and numbers only)\');
        return false;
    }';
    if ($is_reCAPTCHA != '1') {
        echo '    if (document.sign_up_frm.verify_int.value.length < 6){
        alert(\'Please enter the code from verification image.\');
        return false;
    }';
        
    }
    
    
    echo '
    if ((document.sign_up_frm.terms.checked==false)){
        alert(\'Please read the Terms of Service.\');
        return false;
    }
    
    document.sign_up_frm.submit();
}

</script>';
    
    
    if (isset($_POST['create_account'])) {
        require("engine/validate.php");
        $elems[] = array(
            'name' => 'userid',
            'label' => text_register_error1,
            'type' => 'text',
            'uname' => 'true',
            'required' => true,
            'len_min' => 4,
            'len_max' => 10,
            'cont' => 'alpha'
        );
        
        
        $elems[] = array(
            'name' => 'password',
            'label' => text_register_error2,
            'type' => 'text',
            'required' => true,
            'len_min' => 6,
            'len_max' => 12,
            'cont' => 'alpha'
        );
        $elems[] = array(
            'name' => 'confirm_password',
            'label' => text_register_error3,
            'type' => 'text',
            'required' => true,
            'len_min' => 6,
            'len_max' => 12,
            'cont' => 'alpha',
            'equal' => array(
                'password'
            )
        );
        
        if ($get_config->pers_id_active == '1') {
            $elems[] = array(
                'name' => 'pers_id',
                'label' => str_replace("{pers_id_length}", $get_config->pers_id_length, text_register_error4),
                'type' => 'text',
                'required' => true,
                'len_min' => $get_config->pers_id_length,
                'len_max' => $get_config->pers_id_length,
                'cont' => 'digit'
            );
        }
        
        $elems[] = array(
            'name' => 'email_address',
            'label' => text_register_error5,
            'type' => 'text',
            'required' => true,
            'len_max' => 50,
            'cont' => 'email'
        );
        
        $elems[] = array(
            'name' => 'country',
            'label' => text_register_error6,
            'type' => 'text',
            'required' => true,
            'len_max' => 3,
            'cont' => 'digit'
        );
        $elems[] = array(
            'name' => 'gender',
            'label' => text_register_error7,
            'type' => 'text',
            'required' => true,
            'len_max' => 1,
            'cont' => 'digit'
        );
        $elems[] = array(
            'name' => 'question',
            'label' => text_register_error8,
            'type' => 'text',
            'required' => true,
            'len_max' => 2,
            'cont' => 'digit'
        );
        
        $elems[] = array(
            'name' => 'answer',
            'label' => text_register_error9,
            'type' => 'text',
            'required' => true,
            'len_min' => 4,
            'len_max' => 20,
            'cont' => 'alpha'
        );
        $f       = new FormValidator($elems);
        $err     = $f->validate($_POST);
        if ($err === true) {
            $valid = $f->getValidElems();
            foreach ($valid as $k => $v) {
                if ($valid[$k][0][1] == false) {
                    if (empty($valid[$k][0][2])) {
                        $msg_error = msg('0', $valid[$k][0][2]);
                    } else {
                        $msg_error = msg('0', $valid[$k][0][2]);
                    }
                }
            }
        } else {
            $userid   = safe_input($_POST['userid'], '');
            $password = safe_input($_POST['password'], '');
            $email    = safe_input($_POST['email_address'], '\_\@\.\-');
            $country  = safe_input($_POST['country'], '');
            $gender   = safe_input($_POST['gender'], '');
            $question = safe_input($_POST['question'], '');
            $anaswer  = safe_input($_POST['answer'], '');
            if ($get_config->pers_id_active == '1') {
                $pid = safe_input($_POST['pers_id'], '');
            } else {
                $pid = trim($get_config->pers_id);
            }
            
            
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
                $msg_error = msg('0', text_register_error10);
                
            } else {
                if (check_account($userid) === true) {
                    $msg_error = msg('0', text_register_error11);
                } else {
                    if (check_mail($email) === true) {
                        $msg_error = msg('0', text_register_error12);
                    } else {
                        if ($register_method == '1') {
                            $confirmed       = '1';
                            $blocked         = '0';
                            $activation_need = '0';
                            $activation_id   = md5($userid);
                        } elseif ($register_method == '2') {
                            $confirmed       = '0';
                            $blocked         = '1';
                            $activation_need = '1';
                            $activation_id   = md5($userid);
                        }
                        
                        if ($core['config']['md5'] == '1') {
                            $make_me_acc = $core_db2->Execute("INSERT INTO MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,bloc_code,ctl1_code,mail_chek,mail_addr,appl_days,modi_days,out__days,true_days,SecretQuestion,SecretAnswer,Country,Gender,confirmed,activation_id) VALUES (?,[dbo].[fn_md5](?,?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array(
                                $userid,
                                $password,
                                $userid,
                                'test',
                                $pid,
                                $blocked,
                                '0',
                                '1',
                                $email,
                                date('m/d/Y'),
                                date('m/d/Y'),
                                '2005-01-03',
                                '2005-01-03',
                                $question,
                                $anaswer,
                                $country,
                                $gender,
                                $confirmed,
                                $activation_id
                            ));
                        } elseif ($core['config']['md5'] == '0') {
                            $make_me_acc  = $core_db2->Execute("INSERT INTO MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,bloc_code,ctl1_code,mail_chek,mail_addr,appl_days,modi_days,out__days,true_days,SecretQuestion,SecretAnswer,Country,Gender,Confirmed,activation_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array(
                                $userid,
                                $password,
                                'test',
                                $pid,
                                $blocked,
                                '0',
                                '1',
                                $email,
                                date('m/d/Y'),
                                date('m/d/Y'),
                                '2005-01-03',
                                '2005-01-03',
                                $question,
                                $anaswer,
                                $country,
                                $gender,
                                $confirmed,
                                $activation_id
                            ));
                            $make_me_acc_ = 1;
                            /*
                            $make_me_acc_ = $core_db2->Execute("INSERT INTO VI_CURR_INFO (ends_days,chek_code,used_time,memb___id,memb_name,memb_guid,sno__numb,Bill_Section,Bill_value,Bill_Hour,Surplus_Point,Surplus_Minute,Increase_Days ) VALUES ('2005','1',1234,?,?,1,'7','6','3','6','6',".date('m/d/Y').",'0' )", array($userid,'test'));
                            */
                        }
                        if ($make_me_acc) {
                            if ($activation_need == '0') {
                                $msg_error = msg('1', str_replace("{userid}", $userid, text_register_success1));
                                $complete  = 1;
                            } elseif ($activation_need == '1') {
                                /*
                                require("engine/smtp.php");
                                $smtp_config = simplexml_load_file('engine/config_mods/smtp_settings.xml');
                                $mail = new SMTP($smtp_config->smtp_server,$smtp_config->smtp_username,$smtp_config->smtp_password);
                                $header = $mail->make_header($core['config']['master_mail'],$email,'Account Activation for '.$core['config']['websitetitle'].'');
                                $header .= "Content-Type: text/html; charset=\"iso-8859-1\" \r\n";
                                $header .= "Content-Transfer-Encoding: 8bit \r\n";
                                $header .= "MIME-Version: 1.0 \r\n";
                                */
                                
                                
                                $body = str_replace("{user_id}", $userid, mail_register_t1);
                                $body = str_replace("{website_title}", $core['config']['websitetitle'], $body);
                                $body = str_replace("{activation_url}", $core['config']['website_url'] . '/' . ROOT_INDEX . '?' . LOAD_GET_PAGE . '=' . REGISTER_CMS_PAGE . '&activation_id=' . $activation_id, $body);
                                /*
                                
                                $body = 'Dear '.$userid.',<br><br>
                                Thank you for registering at the '.$core['config']['websitetitle'].'. Before we can activate your account one last step must be taken to complete your registration.<br><br>
                                Please note - you must complete this last step to become a registered member. You will only need to visit this URL once to activate your account.<br>
                                <br>
                                To complete your registration, please visit this URL:<br>
                                <a href="'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.REGISTER_CMS_PAGE.'&activation_id='.$activation_id.'">'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.REGISTER_CMS_PAGE.'&activation_id='.$activation_id.'</a>
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
                                $m->AddTo(trim($email));
                                $m->Subject('Contact Us - ' . $subject_set . '');
                                $m->Html($body);
                                
                                if ($get_config->smtp_connection == 'none') {
                                    $c = $m->Connect(trim($get_config->smtp_server), intval($get_config->smtp_port), trim($get_config->smtp_username), trim($get_config->smtp_password)) or $smtp_connect_fail = '1';
                                } else {
                                    $c = $m->Connect(trim($get_config->smtp_server), intval($get_config->smtp_port), trim($get_config->smtp_username), trim($get_config->smtp_password), trim($get_config->smtp_connection), 10, 'localhost', null, 'plain') or $smtp_connect_fail = '1';
                                }
                                if ($smtp_connect_fail != '1') {
                                    if ($m->Send($c)) {
                                        $msg_error = msg('1', str_replace("{userid}", $userid, text_register_success2));
                                    } else {
                                        echo msg('0', text_register_error13);
                                    }
                                } else {
                                    echo msg('0', text_register_error14);
                                }
                                
                                
                            }
                        } else {
                            $msg_error = msg('0', text_register_error15);
                        }
                    }
                }
            }
        }
    }
    
    if ($register_method == '2') {
        if (isset($_GET['activation_id'])) {
            $activate_md5 = '1';
            if (empty($_GET['activation_id'])) {
                header('Location: ' . ROOT_INDEX . '');
            } else {
                $md5_link   = safe_input($_GET['activation_id'], '');
                $check_link = $core_db2->Execute("Select confirmed,memb___id from MEMB_INFO where activation_id=?", array(
                    $md5_link
                ));
                if ($check_link->EOF) {
                    $msg_error = msg('0', text_register_error16);
                } else {
                    if ($check_link->fields[0] == '1') {
                        $msg_error = msg('0', text_register_error17);
                    } elseif ($check_link->fields[0] == '0') {
                        $active_id = $core_db2->Execute("Update MEMB_INFO set bloc_code='0',confirmed='1' where activation_id=?", array(
                            $md5_link
                        ));
                        if ($active_id) {
                            $msg_error = msg('1', str_replace("{userid}", $check_link->fields[1], text_register_success3));
                        } else {
                            $msg_error = msg('0', text_register_error18);
                        }
                        
                    }
                }
            }
        }
        
        echo '    <table  border="0" cellspacing="4" cellpadding="0"  align="center" width="100%" >
            <tr>';
        if ($activate_md5 != 1) {
            echo '<td align="left" class="curent_step" width="33%">1. ' . text_register_complete_form . '</td>';
        } else {
            echo '<td align="left" class="step" width="33%">1. ' . text_register_complete_form . '</td>';
        }
        if ($activate_md5 == '1') {
            echo '<td align="left" class="curent_step"  width="33%">2. ' . text_register_activate_account . '</td>';
        } else {
            echo '<td align="left" class="step"  width="33%">2. ' . text_register_activate_account . '</td>';
        }
        echo '
    </tr>
    </table>';
        
        
        
    }
    if ($msg_error) {
        echo $msg_error;
    }
    if ($activate_md5 != '1') {
        if ($complete != '1') {
            $userid_post   = htmlspecialchars($_POST['userid']);
            $p_id_post     = htmlspecialchars($_POST['pers_id']);
            $email_post    = htmlspecialchars($_POST['email_address']);
            $country_post  = htmlspecialchars($_POST['country']);
            $question_post = htmlspecialchars($_POST['question']);
            $anaswer_post  = htmlspecialchars($_POST['answer']);
        }
        echo '
<form name="sign_up_frm" method="post" action="" id="sign_up_frm">
<div id="a"></div>
<table border="0" cellspacing="10" cellpadding="0" width="100%" style="margin-top: 10px;" align="center">
<tr>
<td colspan="3" align="left" class="iRg_line">' . text_register_t1 . ':</td>
</tr>
<tr>
<td align="left" class="iRg_text" style="padding-left: 24px;" width="130">' . text_user_id . '</td>
<td align="left" class="iRg_inf"><input class="iRg_input" type="text" name="userid" id="userid" maxlength="10" onclick="document.getElementById(\'c_uss\').innerHTML=\'' . text_register_req1 . '\'" value="' . $userid_post . '"> <a href="javascript:void(0)" onclick="cs_ua_a();">' . link_check_available . '</a></td>
<td align="left" ><span class="iRg_inf"><div id="c_uss">' . text_register_req1 . '</div></span></td>
</tr>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_password . '</td>
<td align="left"><input class="iRg_input" type="password" name="password" id="password" maxlength="12"></td>
<td align="left"><span class="iRg_inf">' . text_register_req2 . '</span></td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_cnf_password . '</td>
<td align="left"><input class="iRg_input" type="password" name="confirm_password" id="confirm_password" maxlength="12"> <span class="iRg_inf"></span></td>
<td align="left"><span class="iRg_inf"><em>*' . text_register_req3 . '</em></span></td>
</tr>
</tr>';
        if ($get_config->pers_id_active == '1') {
            echo '<tr>
<td colspan="3" align="left" class="iRg_line">' . text_register_t2 . ':</td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_personal_id . '</td>
<td align="left"><input class="iRg_input" type="text" name="pers_id" id="pers_id" maxlength="' . $get_config->pers_id_length . '" value="' . $p_id_post . '"> <span class="iRg_inf"></span></td>
<td align="left"><span class="iRg_inf"><span class="iRg_inf">' . text_register_req4 . '</span></td>
</tr>
</tr>
';
        }
        
        echo '
<tr>
<td colspan="3" align="left" class="iRg_line">' . text_register_t3 . ':</td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_email_address . '</td>
<td align="left" class="iRg_inf"><input class="iRg_input" maxlength="50" type="text" name="email_address" id="email_address" onclick="document.getElementById(\'c_mss\').innerHTML=\'' . text_register_req5 . '\'" value="' . $email_post . '"> <a href="javascript:void(0)" onclick="csm_uam_am();">' . link_check_available . '</a></td>
<td align="left"><span class="iRg_inf"><div id="c_mss">' . text_register_req5 . '</div></span></td>
</tr>
<tr>
<td colspan="3" align="left" class="iRg_line">' . text_register_t4 . ':</td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_country . '</td>
<td align="left"><select name="country" class="iRg_input" id="country"><option value="x">--' . text_select . '</option>';
        
        $c = getcountry('list');
        foreach ($c as $cc => $v) {
            if ($country_post == $cc) {
                echo '<option value="' . $cc . '" selected="selected">' . $v . '</option>';
            } else {
                echo '<option value="' . $cc . '">' . $v . '</option>';
            }
            
        }
        
        echo '</select></td>
<td align="left"></td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_gender . '</td>
<td align="left" class="iRg_gender"><label><input name="gender" id="gender" type="radio" value="1">' . text_male . '</label>&nbsp;&nbsp;&nbsp;<label><input name="gender" type="radio" value="2" id="gender">' . text_female . '</label></td>
<td align="left"></td>
</tr>
<tr>
<td colspan="3" align="left" class="iRg_line">' . text_register_t5 . ':</td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_register_secret_question . '</td>
<td align="left" colspan="2"><select name="question" id="question"  class="iRg_input"><option value="x">--' . text_select . '</option>
';
        foreach ($secret_questions as $sq_id => $sq_name) {
            if ($question_post == $sq_id) {
                echo '<option value="' . $sq_id . '" selected="selected">' . $sq_name . '</option>';
            } else {
                echo '<option value="' . $sq_id . '">' . $sq_name . '</option>';
            }
            
            
            
        }
        echo '</select></td>
<td align="left"></td>
</tr>
<tr>
<td align="left" class="iRg_text"  style="padding-left: 24px;">' . text_register_answer_question . '</td>
<td align="left" colspan="2"><input class="iRg_input" type="text" name="answer" id="answer" maxlength="20" value="' . $anaswer_post . '">&nbsp;&nbsp;&nbsp;' . text_register_req6 . '</td>
</tr>
</tr>
<tr>
<td colspan="3" align="left" class="iRg_line">' . text_register_t6 . ':</td>
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
<td align="left" class="iRg_inf"><div align="left" style="padding-bottom: 4px; ">' . text_register_type_code . '</div><input class="iRg_input" type="text" name="verify_int" id="verify_int"></td>
</tr>
</table>';
        }
        echo '
</td>
</tr>
</table>

<table border="0" cellspacing="10" cellpadding="0" width="100%"  align="center">
<tr>
<td align="center" colspan="2" class="iRg_terms_agree"><label><input type="checkbox" name="terms" value="1"> ' . text_register_read_terms1 . '</label> <a href="' . ROOT_INDEX . '?' . LOAD_GET_PAGE . '=' . TERMSOFSERVICE_CMS_PAGE . '" target="_blank">' . text_register_read_terms2 . '</a>.<input type="hidden" name="create_account"></td>
</tr>
<tr>
<td align="right"><input type="image" src="template/' . $core['config']['template'] . '/images/submit_btn.gif" onclick="return parse_inputs()"></td>
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