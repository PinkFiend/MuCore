<?
require("../engine/securelogin.class.php");
$admin_auth                        = new securelogin;
$admin_auth->handler['checklogin'] = 'uss_login_check';
$admin_auth->handler['encode']     = 'md5_encrypt';
$admin_auth->post_index            = array(
    'user' => 'admin_id',
    'pass' => 'admin_password'
);
$admin_auth->use_cookie            = false;
$admin_auth->use_session           = true;


if ($admin_auth->haslogin(true)) {
    $admin_auth->savelogin();
    $admin_login = "1";
    $admin_user  = safe_input(set_limit($admin_auth->username, '20', ''), '_');
}

if ($_GET['get'] == 'logout') {
    $admin_auth->clearlogin();
    header('Location: index.php');
}

?> 