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
session_start();
ob_start();
require('../config.php');
require('../engine/custom_variables.php');
require('../engine/global_functions.php');
require('../engine/global_config.php');
require("../engine/adodb/adodb.inc.php");
if ($core['debug'] == '1') {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
}
if ($_GET['get'] == 'logout') {
    $_SESSION['logout'] = '1';
    header('Location: index.php');
    exit;
}
if ($_SESSION['logout'] == '1') {
    unset($_SERVER['PHP_AUTH_USER']);
    unset($_SERVER['PHP_AUTH_PW']);
    unset($_SESSION['agm_login_auth']);
    unset($_SESSION['logout']);
}


$agm_username  = safe_input($_SERVER['PHP_AUTH_USER'], '');
$agm_passsword = md5(safe_input($_SERVER['PHP_AUTH_PW'], ''));
$agm_ip        = $_SERVER['REMOTE_ADDR'];


$agmusers = file('../engine/agm.users/agmcp.users');
foreach ($agmusers as $agm) {
    $agm_info = explode("¦", $agm);
    if (!empty($agm_info[10])) {
        if ($agm_info[1] == $agm_username && $agm_info[2] == $agm_passsword && $agm_info[10] == $agm_ip) {
            $found          = '1';
            $agm_id          = $agm_info[0];
            $agm_user_id     = $agm_info[1];
            $agm_user_pwd    = $agm_info[2];
            $nickname       = $agm_info[3];
            $agm_ban_manager = $agm_info[4];
            $agm_ban_mucoins = $agm_info[5];
            
            $agm_amount_coins    = $agm_info[6];
            $agm_coins_day       = $agm_info[7];
            $agm_coins_days_left = $agm_info[8];
            $agm_preset_mucoins  = $agm_info[9];
            $agm_ip_dat          = $agm_info[10];
            break;
        }
    } else {
        if ($agm_info[1] == $agm_username && $agm_info[2] == $agm_passsword) {
            $found          = '1';
            $agm_id          = $agm_info[0];
            $agm_user_id     = $agm_info[1];
            $agm_user_pwd    = $agm_info[2];
            $nickname       = $agm_info[3];
            $agm_ban_manager = $agm_info[4];
            $agm_ban_mucoins = $agm_info[5];
            
            $agm_amount_coins    = $agm_info[6];
            $agm_coins_day       = $agm_info[7];
            $agm_coins_days_left = $agm_info[8];
            $agm_preset_mucoins  = $agm_info[9];
            $agm_ip_dat          = $agm_info[10];
            break;
        }
    }
}



if ($found == '1') {
    if (!isset($_SESSION['agm_login_auth'])) {
        write_log('../engine/logs/agmcp/agmcp_access', '' . $nickname . ' logged in Game Master Control Panel.');
    }
    $_SESSION['agm_login_auth'] = '1';
    require('../engine/core.php');
    $core['version'] = crypt_it($engine, '', '1');
    
    require('../admincp/script/global_functions.php');
    include("../engine/connect_core.php");
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="styles/default/panel.css" />
<script type="text/javascript" src="script/global.js"></script>
<script type="text/javascript" src="script/helptip.js"></script>
<title>' . $core['config']['websitetitle'] . ' - Game Master Control Panel</title></head>

<body>';
    
    if (!isset($_GET['get'])) {
        $no_module_selected = 1;
        #$m_am = 'ban_manager';
    } else {
        $m_am = safe_input($_GET['get'], '_');
    }
    include("modules/header.php");
    echo '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
     <td align="left" width="230" valign="top">';
    include("modules/left_side.php");
    echo '</td><td valign="top"><div align="center" style="margin-top: 20px; margin-bottom: 20px;">
     <!--
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
     <td align="right" class="module_title">' . htmlentities(strtoupper(str_replace("_", " ", $m_am))) . '</td>
     </tr>
     </table>
     -->
    
     ';
    if ($no_module_selected != 1) {
        if (is_file('modules/' . $m_am . '.php')) {
            include('modules/' . $m_am . '.php');
        } else {
            echo 'Module ' . $m_am . '.php could not be found.';
        }
    }
    
    
    
    
    echo '</div></td>
     </tr>
     </table></body></html>';
    
    
} else {
    unset($_SESSION['agm_login_auth']);
    unset($_SESSION['logout']);
    header('WWW-Authenticate: Basic realm="' . $core['config']['websitetitle'] . '"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Authentication required!</title>
<link rev="made" href="mailto:postmaster@localhost" />
<style type="text/css"><!--/*--><![CDATA[/*><!--*/ 
    body { color: #000000; background-color: #FFFFFF; }
    a:link { color: #0000CC; }
    p, address {margin-left: 3em;}
    span {font-size: smaller;}
/*]]>*/--></style>
</head>

<body>
<h1>Authentication required!</h1>
</body>
</html>';
    exit;
}
ob_end_flush();
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