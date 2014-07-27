<?
//links
define('link_home','Home');
define('link_announcements','Announcements');
define('link_new_account','Register New Account');
define('link_log_out','Log Out');
define('link_lost_password','Lost User ID or Password ?');
define('link_sign_up','Sign Up!');
define('link_read_more','Read More');
define('link_permanent_banned_characters','View Permanently Banned Characters');
define('link_banned_characters','View Banned Characters');
define('link_check_available','Check if is Available');
define('link_check_status','Check Status');
define('link_location','Location');
define('link_account_settings','Account Settings');

//buttons
define('button_log_in','Log In');
define('button_proceed_checkout','Proceed Checkout');
define('button_post_message','Post Message');
define('button_reset_character','Reset Character');
define('button_add_points','Add Points');
define('button_clear_pk','Clear PK Status');
define('button_unstuck_character','Unstuck Character');
define('button_clear_inventory','Clear Inventory');
define('button_clear_skills','Clear Skills');
define('button_purchase_credits','Purchase Credits');
define('button_grand_reset_character','Grand Reset Character');

/*--------------------------------------*\
| This are the links from menu           |
| and user cp.                           |
|                                        |
| $menu_links_title - Pages titles       |
| from admincp (dont translate them)     |
|                                        |
| $menu_links_translated - Pages titles  |
| translated (translate this)            |
\*--------------------------------------*/

//dont translate here
$menu_links_title      = array('News','Announcements','Downloads','Donate for Credits','Banned Characters','Chat','Rankings','Register','Terms of Service','Contact Us','Forum','Reset Character','Add Points','Clear PK Status','Unstuck Character','Clear Inventory','Clear Skills','MU Coins','Grand Reset Character','Account Settings','User CP',);

//translate here
$menu_links_translated = array('News','Announcements','Downloads','Donate for Credits','Banned Characters','Chat','Rankings','Register','Terms of Service','Contact Us','Forum','Reset Character','Add Points','Clear PK Status','Unstuck Character','Clear Inventory','Clear Skills','MU Coins','Grand Reset Character','Account Settings','User CP',);



/*-----------------------------------------*\
| This are the modues from pages            |
| and user cp.                              |
|                                           |
| $modules_text_tile - Modules titles       |
| from admincp (dont translate them)        |
|                                           |
| $modules_text_translate - Modules titles  |
| translated (translate this)               |
\*-----------------------------------------*/
//dont translate here
$modules_text_tile      = array('News','Downloads','Chat','Announcements','Rankings','Register','Terms of Service','Log In','Lost Password','User CP','Log Out','Contact Us','Banned Characters','Donate with PayPal','Latest RSS','Reset Character','Add Points','Clear PK Status','Unstuck Character','Clear Inventory','Clear Skills','MU Coins','Grand Reset Character','Account Settings',);

//translate here
$modules_text_translate = array('News','Downloads','Chat','Announcements','Rankings','Register','Terms of Service','Log In','Lost Password','User CP','Log Out','Contact Us','Banned Characters','Donate with PayPal','Latest RSS','Reset Character','Add Points','Clear PK Status','Unstuck Character','Clear Inventory','Clear Skills','MU Coins','Grand Reset Character','Account Settings',);



//texts
//Vote For Credits
define('text_module_vote_credits_t1','Unable to vote, reason: An IP can only vote once every {delay_hours} hours.');
define('text_module_vote_credits_t2','Unable to vote, reason: system error, please contact administrator.');
define('text_module_vote_credits_t3','Unable to vote, reason: {delay_hours} hours have not passed.');
define('text_module_vote_credits_t4','Credits Issued');
define('text_module_vote_credits_t5','Vote Now!');
define('text_module_vote_credits_t6','There are no vote links at the moment.');
define('text_not_loggd_in','You are not loged in');
define('text_log_in','Log in');
define('text_start_play_now','Start playing now');
define('text_member_area','Member Area');
define('text_menu','Menu');
define('text_announcement','Announcement');
define('text_posted_on','Posted on');
define('text_untill','untill');
define('text_notice','Notice');
define('text_ban_expire','Banned accounts are <b>not listed</b>. After the specified ban period account will be unbaned automatically.');
define('text_banned_on','Banned on');
define('text_expire_date','Expire date');
define('text_rason','Rason');
define('text_sorry_no_ban','Sorry, no banned characters found.');
define('text_user_id','User ID');
define('text_password','Password');
define('text_cnf_password','Confirm Password');
define('text_personal_id','Personal ID');
define('text_email_address','Email Address');
define('text_country','Country');
define('text_gender','Gender');
define('text_male','Male');
define('text_female','Female');
define('text_select','Select');
define('text_wrong_login_ban','<b>Wrong Account Informations.</b><br><br> The limit for failed log in has been reached. <b>Waiting time for 15 minutes is now implimented.</b> <br>Always remember that password or username is case sensitive.');
define('text_wrong_login','<b>User ID or Password you entered is incorrect.</b> <br><br>Log In System is case sensitive and further log in attempts failure will result to inability to log in to the website for <b>15 minutes</b>.<br /><br /><b>You have used {attempts_count} out of 5 login attempts.</b> In case you used the allowable 5 login attempts and still unable to provide correct information, Log In Protection will disable the log in for 15 Minutes.');
define('text_sorry_no_donations','Sorry, there are no donation options at this moment.');
define('text_sorry_feature_disabled','Sorry, this feature is temporarily unavailable at the moment.');
define('text_issued_credits','Credits Issued');
define('text_your_donate_info','Your Donate Info');
define('text_donate_amount','Donate Amount');
define('text_checkout_error','Unable to checkout donate, reason: system error, please contact administrator.');
define('text_chat_error1','Unable to post message, reason: some fields where left blank.');
define('text_chat_error2','Unable to post message, reason: name must contains at last 4 characters.');
define('text_chat_error3','Unable to post message, reason: this name is reserved.');
define('text_chat_name','Name');
define('text_chat_req1','4-10 characters.');
define('text_chat_message','Message');
define('text_chat_req2','300 characters.');
define('text_register_error1','You have entered an invalid User ID (4-10 characters, letters and numbers only)');
define('text_register_error2','You have entered an invalid Password (6-12 characters, letters and numbers only)');
define('text_register_error3','Passwords did not match');
define('text_register_error4','You have entered an invalid Personal ID number ({pers_id_length} digits, numbers only)');
define('text_register_error5','You have entered an invalid  Email Address (ex. somebody@gmail.com)');
define('text_register_error6','Country Code is invalid');
define('text_register_error7','Gender Code is invalid');
define('text_register_error8','Secret Question Code is invalid');
define('text_register_error9','You have entered an invalid Answer for your Secret Question (4-20 characters, letters and numbers only)');
define('text_register_error10','Are you really a human? Enter the verification code correctly!');
define('text_register_error11','User ID already in use.');
define('text_register_error12','Email Address already in use.');
define('text_register_success1','Thank you, {userid}. Your registration is now complete.!');
define('text_register_success2','Thank you, {userid}. Your registration is now complete.!<br>An email has been sent to '.$email.' with details on how to activate your account.<br><br>You will receive an email in your inbox or spam (bulk). You must follow the link in that email before you can start playing.');
define('text_register_error13','Unable to proceed your request, reason: system error, please contact administrator.');
define('text_register_error14','Unable to proceed your request, reason: could not connect to SMTP Server, please contact administrator.');
define('text_register_error15','Unable to register, reason: system error, please contact administrator.');
define('text_register_error16','Unable to activate account, reason: system error, please contact administrator.');
define('text_register_error17','Your account has already been activated.');
define('text_register_success3','Thank you, {userid}. Your registration is now complete.!');
define('text_register_error18','Unable to activate account, reason: system error, please contact administrator.');
define('text_register_complete_form','Complete Form');
define('text_register_activate_account','Activate Account');
define('text_register_t1','Provide your desired login info');
define('text_register_req1','4-10 characters, letters/numbers only');
define('text_register_req2','6-12 characters, letters/numbers only');
define('text_register_req3','Passwords are case-sensitve');
define('text_register_t2','Enter a Personal ID number (used in game)');
define('text_register_req4','12 digits, numbers only');
define('text_register_t3','Please enter a valid email address');
define('text_register_req5','e.g: somebody@gmail.com');
define('text_register_t4','Additional Info');
define('text_register_t5','To help you with support issue\'s and account identification, please select a question from the lists below and provide answer');
define('text_register_secret_question','Secret Question');
define('text_register_answer_question','Question Answer');
define('text_register_req6','4-20 characters, letters/numbers only');
define('text_register_t6','Image Verification');
define('text_register_type_code','Type the code here');
define('text_register_read_terms1','I have read and agree to the');
define('text_register_read_terms2','terms of service');
define('text_rankings_update_date','Next Scheduled Update for Rankings is on {date}');
define('text_contact_us_invalid_name','You have entered an invalid Name.');
define('text_contact_us_invalid_email','You have entered an invalid  Email Address (ex. somebody@gmail.com).');
define('text_contact_us_invalid_subject','You have entered an invalid Subject.');
define('text_contact_us_err1','Are you really a human? Enter the verification code correctly!');
define('text_contact_us_msg1','Message Sent Successfully.!');
define('text_contact_us_err2','Unable to proceed your request, reason: system error, please contact administrator.');
define('text_contact_us_err3','Unable to proceed your request, reason: could not connect to SMTP Server, please contact administrator.');
define('text_contact_us_t1','Your Contact Details');
define('text_contact_us_t2','Name');
define('text_contact_us_t3','Email Address');
define('text_contact_us_t4','e.g: somebody@gmail.com');
define('text_contact_us_t5','Subject');
define('text_contact_us_t6','Message');
define('text_contact_us_t7','{msg_length} Characters');
define('text_contact_us_t8','Image Verification');
define('text_contact_us_t9','Type the code here');
define('text_contact_us_t10','Contact us at {mail}');
define('text_lostpwd_t1','You have entered an invalid User ID (4-12 characters, letters and numbers only)');
define('text_lostpwd_t2','Are you really a human? Enter the verification code correctly!');
define('text_lostpwd_t3','User ID could not be found.');
define('text_lostpwd_t4','You have entered an invalid Answer for your Secret Question (4-20 characters, letters and numbers only)');
define('text_lostpwd_t5','You supplied a wrong answer.');
define('text_lostpwd_t6','Unable to change password, reason: system error, please contact administrator.');
define('text_lostpwd_t7','Complete Form');
define('text_lostpwd_t8','Answer to Secret Question');
define('text_lostpwd_t9','Find out Password');
define('text_lostpwd_t10','Success!');
define('text_lostpwd_t11','Your New Password Is');
define('text_lostpwd_t12','To see password, select with mouse in box.');
define('text_lostpwd_t13','Please answer to your Secret Question');
define('text_lostpwd_t14','Secret Question');
define('text_lostpwd_t15','Answer');
define('text_lostpwd_t16','4-20 characters, letters/numbers only');
define('text_lostpwd_t17','Image Verification');
define('text_lostpwd_t18','Type the code here');
define('text_lostpwd_t19','Please enter your User ID');
define('text_lostpwd_t20','User ID');
define('text_lostpwd_t21','4-12 characters, letters/numbers only');
define('text_lostpwd_t22','Email Address could not be found.');
define('text_lostpwd_t23','Your username and details about how to reset your password have been sent to you by email.');
define('text_lostpwd_t24','Unable to proceed your request, reason: system error, please contact administrator.');
define('text_lostpwd_t25','Unable to proceed your request, reason: could not connect to SMTP Server, please contact administrator.');
define('text_lostpwd_t26','Your password has now been reset and emailed to you. Please check your email to find your new password.');
define('text_lostpwd_t27','Please enter your Email Addres');
define('text_lostpwd_t28','Email Address');
define('text_lostpwd_t29','e.g: somebody@gmail.com');

define('text_resetcharacter_t1','Account is connected on game, please logout.');
define('text_resetcharacter_t2','Unable to reset, reason: lacking {levels} levels.');
define('text_resetcharacter_t3','Unable to reset, reason: lacking {zen} zen.');
define('text_resetcharacter_t4','Unable to reset, reason: reset limit reached : {resets_limit}');
define('text_resetcharacter_t5','Character successfully reseted.');
define('text_resetcharacter_t6','Unable to reset, reason: system error, please contact administrator.');
define('text_resetcharacter_t7','Reset Character Requirements');
define('text_resetcharacter_t8','Reset Forumla');
define('text_resetcharacter_t9','Levelup Bonus Points');
define('text_resetcharacter_t10','Resets Limit');
define('text_resetcharacter_t11','Zen');
define('text_resetcharacter_t12','Level');
define('text_resetcharacter_t13','Clear Skills');
define('text_resetcharacter_t14','Clear Inventory');
define('text_resetcharacter_t15','Reset Stats');
define('text_resetcharacter_t16','lacking {levels} level and {zen} zen');
define('text_resetcharacter_t17','lacking {levels} level');
define('text_resetcharacter_t18','lacking {zen} zen');
define('text_resetcharacter_t19','reset limit reached : {resets_limit}');

define('text_points_t1','Account is connected on game, please logout.');
define('text_points_t2','Unable to add levelup points, reason: you don\'t have enough levelup points.');
define('text_points_t3','Unable to add levelup points, reason: strength limit reached (strength limit: {str_limit}).');
define('text_points_t4','Unable to add levelup points, reason: agility limit reached (agility limit: {agi_limit}).');
define('text_points_t5','Unable to add levelup points, reason: vitality limit reached (vitality limit: {vit_limit}).');
define('text_points_t6','Unable to add levelup points, reason: energy limit reached (energy limit: {eng_limit}).');
define('text_points_t7','Unable to add levelup points, reason: command limit reached (command limit: {cmd_limit}).');
define('text_points_t8','Levelup Points successfully added.');
define('text_points_t9','Unable to add levelup points, reason: system error, please contact administrator.');
define('text_points_t10','no levelup points found.');
define('text_points_t11','Limit reached.');
define('text_points_t12','Stats Limits');

define('text_pk_t1','Account is connected on game, please logout.');
define('text_pk_t2','Unable to clear pk status, reason: you not have not killed anyone. go kill some more to use this function.');
define('text_pk_t3','Unable to clear pk status, reason: lacking {zen} zen.');
define('text_pk_t4','Character successfully cleared.');
define('text_pk_t5','Unable to clear pk status, reason: system error, please contact administrator.');
define('text_pk_t6','Clear PK Status Requirements');
define('text_pk_t7','{zen} / status (e.g: if you are murder level 2, you will need to pay {total_zen}');
define('text_pk_t8','You are a coward nab, why don\'t you try and kill someone.');
define('text_pk_t9','Wtg! Kill some more murderers and increase your hero\'s level status.');
define('text_pk_t10','Hurray! Eradicate those nab murderers! You are a real hero.');
define('text_pk_t11','lacking {zen} zen');

define('text_ustuckcharacter_t1','Account is connected on game, please logout.');
define('text_ustuckcharacter_t2','Character successfully unstucked.');
define('text_ustuckcharacter_t3','Unable to unstuck, reason: system error, please contact administrator.');
define('text_ustuckcharacter_t4','After using unstuck character function, character will be teleported on <b>{map}</b>, coords: <b>{coord_x}</b> with <b>{coord_y}</b>');
define('text_ustuckcharacter_t5','Location');
define('text_ustuckcharacter_t6','Unstuck Character Info');

define('text_clearinventory_t1','Account is connected on game, please logout.');
define('text_clearinventory_t2','Character\'s inventory successfully cleared.');
define('text_clearinventory_t3','Unable to clear inventory, reason: system error, please contact administrator.');
define('text_clearinventory_t4','Clear Inventory Info');
define('text_clearinventory_t5','After using clear inventory function, <b>character\'s inventory will be reseted</b>.');
define('text_clearinventory_t6','Are you sure you want to clear inventory?');

define('text_clearskills_t1','Account is connected on game, please logout.');
define('text_clearskills_t2','Character\'s skills successfully cleared.');
define('text_clearskills_t3','Unable to clear skills, reason: system error, please contact administrator.');
define('text_clearskills_t4','Clear Skills Info');
define('text_clearskills_t5','After using clear skills function, <b>character\'s skils will be reseted</b>.');
define('text_clearskills_t6','Are you sure you want to clear skills?');

define('text_mucoins_t1','Credits Account successfully created.');
define('text_mucoins_t2','Unable to create Credits Account, reason: system error, please contact administrator.');
define('text_mucoins_t3','Credits Info');
define('text_mucoins_t4','Credits');
define('text_mucoins_t5','Your PayPal Donate Transactions');
define('text_mucoins_t6','Transaction ID');
define('text_mucoins_t7','Amount');
define('text_mucoins_t8','Issued Credits');
define('text_mucoins_t9','Order Date');
define('text_mucoins_t10','Payment Status');
define('text_mucoins_t11','No transactions found.');

define('text_grandreset_t1','Account is connected on game, please logout.');
define('text_grandreset_t2','Unable to reset, reason: lacking {resets} resets.');
define('text_grandreset_t3','Unable to reset, reason: lacking {level} levels.');
define('text_grandreset_t4','Unable to reset, reason: lacking {zen} zen.');
define('text_grandreset_t5','Character successfully grand reseted.');
define('text_grandreset_t6','Unable to grand reset, reason: system error, please contact administrator.');
define('text_grandreset_t7','Reset Character Requirements');
define('text_grandreset_t8','Reset Forumla');
define('text_grandreset_t9','Credits Bonus');
define('text_grandreset_t10','Levelup Bonus Points');
define('text_grandreset_t11','Clear Skills');
define('text_grandreset_t12','Clear Inventory');
define('text_grandreset_t13','Reset Stats');
define('text_grandreset_t14','lacking {resets} resets, {level} level and {zen} zen');
define('text_grandreset_t15','lacking {resets} resets');
define('text_grandreset_t16','lacking {level} level');
define('text_grandreset_t17','lacking {zen} zen');
define('text_grandreset_t18','Are you sure?');

define('text_accountsettings_t1','You have entered an invalid Current Password (6-12 characters, letters and numbers only)');
define('text_accountsettings_t2','You have entered an invalid New Password (6-12 characters, letters and numbers only)');
define('text_accountsettings_t3','Passwords did not match');
define('text_accountsettings_t4','Are you really a human? Enter the verification code correctly!');
define('text_accountsettings_t5','Incorrect current password!');
define('text_accountsettings_t6','Unable to verify password, reason: system error, please contact administrator.');
define('text_accountsettings_t7','Complete Form');
define('text_accountsettings_t8','Sending Confirmation Mail');
define('text_accountsettings_t9','Confirm Changing Password');
define('text_accountsettings_t10','Password Fields');
define('text_accountsettings_t11','Current Password');
define('text_accountsettings_t12','6-12 characters, letters/numbers only');
define('text_accountsettings_t13','New Password');
define('text_accountsettings_t14','Confirm New Password');
define('text_accountsettings_t16','Passwords are case-sensitve');
define('text_accountsettings_t17','Image Verification');
define('text_accountsettings_t18','Type the code here');
define('text_accountsettings_t19','Password change request link has been sent to your email address.');
define('text_accountsettings_t20','Unable to proceed your request, reason: system error, please contact administrator.');
define('text_accountsettings_t21','Unable to proceed your request, reason: could not connect to SMTP Server, please contact administrator.');
define('text_accountsettings_t22','Unable to change your password, reason: link expired.');
define('text_accountsettings_t23','Password successfully changed, please re log-in.');
define('text_accountsettings_t24','Unable to change password, reason: system error, please contact administrator.');
define('text_accountsettings_t25','Unable to verify password, reason: system error, please contact administrator.');
//1.0.4
define('text_resetcharacter_t_levelupbonusinfo','({reset_points} * resets number) - The multiplied amount between levelup bonus points witch is {reset_points} and number of resets that your character have.');
define('text_grandresetcharacter_t_levelupbonusinfo','({grandreset_credits} * grand resets number) - The * amount between credits bonus witch is {grandreset_credits} and number of grand resets that your character have.');
//1.0.5
define('mail_register_t1','Dear {user_id},<br><br>Thank you for registering at the {website_title}. Before we can activate your account one last step must be taken to complete your registration.<br><br>Please note - you must complete this last step to become a registered member. You will only need to visit this URL once to activate your account.<br><br>To complete your registration, please visit this URL:<br><a href="{activation_url}">{activation_url}</a><br><br><br>All the best,<br>{website_title} Team.');
define('mail_lostpassword_t1','Dear {user_id},<br><br>You have requested to reset your password on {website_title} because you have forgotten your password. If you did not request this, please ignore it. It will expire in 24 hours time.<br><br>To reset your password, please visit the following page:<br><a href="{reset_password_url}">{reset_password_url}</a><br><br>When you visit that page, your password will be reset, and the new password will be emailed to you.<br><br>Your username is: {user_id}<br><br><br>All the best,<br>{website_title} Team.');
define('mail_lostpassword_t2','Dear {user_id},<br><br>As you requested, your password has now been reset. Your new details are as follows:<br><br>Username: {request_username}<br>Password: {new_password}<br><br>To change your password, please visit the following page:<br><a href="{change_password_url}">{change_password_url}</a><br><br>All the best,<br>{website_title} Team.');
define('mail_changepassword_t1','Dear {user_id},<br><br>You have requested to change your password on {website_title}. If you did not request this, please ignore it. It will expire in 24 hours time.<br><br>To change your password, please visit the following page:<br><a href="{change_password_url}">{change_password_url}</a><br><br>When you visit that page, your password will be changed.<br><br>Your username is: {user_id}<br>Your new password is: {new_password}<br><br><br>All the best,<br>{website_title} Team.');
#Reset Stats
define('button_reset_stats','Reset Stats');
define('text_resetstats_t1','Account is connected on game, please logout.');
define('text_resetstats_t2','Character\'s stats successfully reseted.');
define('text_resetstats_t3','Unable to reset stats, reason: system error, please contact administrator.');
define('text_resetstats_t4','Reset Stats Info');
define('text_resetstats_t5','After using reset stats function, <b>character\'s stats will be reseted</b>.');
define('text_resetstats_t6','Are you sure you want to reset stats?');
define('text_resetstats_t7','lacking {resets} resets');
define('text_resetstats_t8','Reset Stats Requirements');


#Castle Siege
define('cs_end','Siege Ended');
define('cs_start','Siege Started');
define('cs_no_owner','no owner');
define('cs_info','Siege Info');
define('cs_status','Status');
define('cs_guild_owner','Castle Guild Owner');
define('cs_money','Money');
define('cs_chaos_tax','Chaos Tax');
define('cs_store_tax','Store Tax');
define('cs_hunt_tax','Hunt Zone Tax');
define('cs_registered_guilds','Registered Guilds');
define('cs_guild_master','Guild Master');
define('cs_score','Score');
define('cs_no_guilds','There are no registered guilds.');


?>