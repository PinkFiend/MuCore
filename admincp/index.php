<?php
if (!isset($_GET["frame"]) && !isset($_GET["get"])) {
    session_start();
}
ob_start();
require("../config.php");
require("../engine/custom_variables.php");
require("../engine/global_functions.php");
require("../engine/global_config.php");
require("../engine/global_cms.php");
require("../engine/adodb/adodb.inc.php");
include("/admin logger.php");
if ($core["debug"] == "1") {
    ini_set("display_errors", "On");
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    ini_set("display_errors", "Off");
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
}
if ($_GET["get"] == "logout") {
    setcookie("logout", "1");
    header("Location: index.php");
    exit();
}
if ($_COOKIE["logout"] == "1") {
    unset($_SERVER["PHP_AUTH_USER"]);
    unset($_SERVER["PHP_AUTH_PW"]);
    unset($_SESSION["admin_login_auth"]);
    setcookie("logout");
}
$admin_username  = md5(safe_input($_SERVER["PHP_AUTH_USER"], ""));
$admin_passsword = md5(safe_input($_SERVER["PHP_AUTH_PW"], ""));
if ($admin_username == md5($core["admin_username"]) && $admin_passsword == md5($core["admin_password"])) {
    $_SESSION["admin_login_auth"] = "1";
    require("script/global_functions.php");
    include("../engine/connect_core.php");
    require("../engine/core.php");
    $core["version"] = crypt_it($engine, "", "1");
    if ($_GET["frame"] == "header") {
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">
    <html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/default/panel.css\" />
<script type=\"text/javascript\" src=\"http://bizarre-networks.com/mucore/version_eng.js\"></script>
<script type=\"text/javascript\">
var engine_current_version = '" . $core["version"] . "';
</script>
<title>" . $core["config"]["websitetitle"] . " - Admin control panel</title></head>

<body>";
        include("modules/header.php");
        echo "</body></html>";
    } else if ($_GET["frame"] == "navigation") {
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">
    <html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/default/panel.css\" />
<title>" . $core["config"]["websitetitle"] . " - Admin control panel</title></head>

<body>";
        include("modules/left_side.php");
        echo "</body></html>";
    } else if ($_GET["frame"] == "body" || isset($_GET["get"])) {
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/default/panel.css\" />
<script type=\"text/javascript\" src=\"script/global.js\"></script>
<script type=\"text/javascript\" src=\"script/helptip.js\"></script>
";
        if ($_GET["get"] == "home" || $_GET["frame"] == "body") {
            echo "<script type=\"text/javascript\" src=\"http://bizarre-networks.com/mucore/version_eng.js\"></script>
<script type=\"text/javascript\">
var engine_current_version = '" . $core["version"] . "';
</script>";
        }
        echo "
<title>" . $core["config"]["websitetitle"] . " - Admin Control Panel</title></head>

<body>";
        if (!isset($_GET["get"])) {
            $m_am = "home";
        } else {
            $m_am = safe_input($_GET["get"], "_");
        }
        echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
     <tr>
     <td valign=\"top\"><div align=\"center\" style=\"margin-top: 20px; margin-bottom: 20px;\">
     <!--
     <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
     <tr>
     <td align=\"right\" class=\"module_title\">" . htmlentities(strtoupper(str_replace("_", " ", $m_am))) . "</td>
     </tr>
     </table>
     -->
     
     ";
        if (is_file("modules/" . $m_am . ".php")) {
            include("modules/" . $m_am . ".php");
        } else {
            echo "Module " . $m_am . ".php could not be found.";
        }
        echo "</div></td>
     </tr>
     </table>";
        echo "</body></html>";
    } else {
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<title>" . $core["config"]["websitetitle"] . " - Admin Control Panel - Bizarre Mind Networks & Chileplanet</title></head>

    <frameset rows=\"42,*\"  framespacing=\"0\" border=\"0\" frameborder=\"0\" frameborder=\"no\" border=\"0\">
    <frame src=\"index.php?frame=header\" name=\"header\" scrolling=\"no\" noresize=\"noresize\" frameborder=\"0\" marginwidth=\"10\" marginheight=\"0\" border=\"no\" />
    
    <frameset cols=\"230,*\"  framespacing=\"0\" border=\"0\" frameborder=\"0\" frameborder=\"no\" border=\"0\">

        <frame src=\"index.php?frame=navigation\" name=\"navigation\" scrolling=\"yes\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" border=\"no\" />
        <frame src=\"index.php?frame=body\" name=\"body\" scrolling=\"yes\" frameborder=\"0\" marginwidth=\"10\" marginheight=\"10\" border=\"no\" />
        
    </frameset>
    </frameset>

    
    <noframes>
        <body>
            <p>Your browser does not support frames. Please get one that does!</p>
        </body>
    </noframes>
    </html>
    ";
    }
} else {
    header("WWW-Authenticate: Basic realm=\"" . $core["config"]["websitetitle"] . "\"");
    header("HTTP/1.0 401 Unauthorized");
    echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">
<head>
<title>Se Requiere Identificacin!</title>
<link rev=\"made\" href=\"mailto:postmaster@localhost\" />
<style type=\"text/css\"><!--/*--><![CDATA[/*><!--*/ 
    body { color: #000000; background-color: #FFFFFF; }
    a:link { color: #0000CC; }
    p, address {margin-left: 3em;}
    span {font-size: smaller;}
/*]]>*/--></style>
</head>

<body>
<h1>Authorization Required!</h1>
</body>
</html>
";
    exit();
}
ob_end_flush();
?>
