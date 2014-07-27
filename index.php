<?php
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.com                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
function build_header_seo( )
{
    require( "engine/seo_config.php" );
    global $core;
    global $core_run_script;
    global $head_keywords;
    global $head_description;
    if ( empty( $head_keywords ) )
    {
        $meta_keywords = $core_seo['meta_keywords'];
    }
    else
    {
        $meta_keywords = $head_keywords.",".$core_seo['meta_keywords'];
    }
    if ( empty( $head_description ) )
    {
        $meta_description = $core_seo['meta_description'];
    }
    else
    {
        $meta_description = $head_description;
    }
    if ( !isset( $_GET[LOAD_GET_PAGE] ) )
    {
        echo "<!-- no cache headers -->\n<meta http-equiv=\"Pragma\" content=\"no-cache\" />\n<meta http-equiv=\"Expires\" content=\"-1\" />\n<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />\n<!-- end no cache headers -->\n<link rel=\"canonical\" href=\"".$core['config']['website_url']."/\" />\n";
    }
    else
    {
        echo "<base href=\"".$core['config']['website_url']."/\" /><!--[if IE]></base><![endif]-->\n<link rel=\"canonical\" href=\"".$core['config']['website_url']."/".$core_run_script."\" />\n";
    }
    echo "<meta name=\"author\" content=\"PHPCore\" />\n<meta name=\"generator\" content=\"MUCore ".$core['version']."\" />\n<meta name=\"keywords\" content=\"".$meta_keywords."\" />\n<meta name=\"description\" content=\"".$meta_description."\" />\n";
}

function build_header_title( )
{
    global $core;
    global $page_title;
    global $menu_links_title;
    global $menu_links_translated;
    if ( isset( $page_title ) )
    {
        echo "".str_replace( $menu_links_title, $menu_links_translated, $page_title )." - ".$core['config']['websitetitle']."";
    }
    else
    {
        echo "".$core['config']['websitetitle']."";
    }
}

function build_footer( )
{
    global $core;
    echo "<div align=\"center\" class=\"footer_font\">\n<!-- Do not remove MMORPG Core copyright notice -->\n<a href=\"http://bizarre-networks.com/mucore\" target=\"_blank\">MUCore&#8482;</a> Engine Version ".$core['version']."<br>\nCopyright ©";
    if ( date( "Y" ) == "2009" )
    {
        echo "2009";
    }
    else
    {
        echo "2009 - ".date( "Y" )."";
    }
    echo ", MU Core. All rights reserved.\n<!-- Do not remove MMORPG Core copyright notice -->";
    if ( !empty( $core['config']['copyright'] ) )
    {
        echo "\n<br>".stripslashes( $core['config']['copyright'] )."";
    }
    echo "\n</div>\n";
}

session_start( );
ob_start( );
if ( function_exists( "ini_set" ) )
{
    @ini_set( "magic_quotes_runtime", "Off" );
}
include( "logger.php" );
require( "config.php" );
require( "engine/core.php" );
require( "engine/global_config.php" );
require( "engine/filter_ip.php" );
if ( $core['config']['filter_ip'] == "1" && in_array( $_SERVER['REMOTE_ADDR'], $core['config']['filter_ip_list'] ) )
{
    include( "error_templates/ban_ip.php" );
    exit( );
}
if ( ( $core['config']['on_off'] == "0" || $core['debug'] == "1" ) && !isset( $_SESSION['admin_login_auth'] ) )
{
    include( "error_templates/website_offline.php" );
    exit( );
}
require( "engine/custom_variables.php" );
require( "engine/global_cms.php" );
require( "engine/global_functions.php" );
require( "engine/adodb/adodb.inc.php" );
if ( $core['debug'] == "1" )
{
    ini_set( "display_errors", "On" );
    error_reporting( E_ERROR | E_WARNING | E_PARSE );
}
else
{
    ini_set( "display_errors", "Off" );
    error_reporting( E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING );
}
require( "language_config.php" );
if ( $core['language_switch'] == "1" )
{
    if ( isset( $_GET['change_language'] ) )
    {
        $get_langauge = safe_input( $_GET['change_language'], "\\_" );
        if ( array_key_exists( $get_langauge, $languages ) && setcookie( "mucore_language", $get_langauge, time( ) + 604800 ) )
        {
            if ( isset( $_SERVER['HTTP_REFERER'] ) )
            {
                header( "Location: ".$_SERVER['HTTP_REFERER']."" );
            }
            else
            {
                header( "Location: ".ROOT_INDEX."" );
            }
        }
    }
    if ( !isset( $_COOKIE['mucore_language'] ) )
    {
        require( "languages/".$core['language_set'].".php" );
    }
    else if ( isset( $_COOKIE['mucore_language'] ) )
    {
        $core['language_set'] = safe_input( $_COOKIE['mucore_language'], "\\_" );
        require( "languages/".$core['language_set'].".php" );
    }
}
else
{
    require( "languages/".$core['language_set'].".php" );
}
if ( isset( $_GET[LOAD_GET_PAGE] ) )
{
    $page_check_id = xss_clean( safe_input( $_GET[LOAD_GET_PAGE], "_" ) );
}
else
{
    $page_check_id = HOME_CMS_PAGE;
}
$load_pages_check = file( "engine/cms_data/pag_d.cms" );
foreach ( $load_pages_check as $page_check )
{
    $page_check = explode( "\xA6", $page_check );
    if ( !( $page_check[3] == $page_check_id ) )
    {
        continue;
    }
    $found_page_mw = "1";
    $page_title = $page_check[2];
    $head_keywords = $page_check[13];
    $head_description = $page_check[14];
    if ( $page_check[8] == "0" )
    {
        header( "Location: ".ROOT_INDEX."" );
        exit( );
    }
    if ( $page_check[9] == "1" )
    {
        $req_log = "1";
    }
    else
    {
        $req_log = "0";
    }
    if ( $page_check[12] == "1" )
    {
        $req_sql = "1";
    }
    else
    {
        $req_sql = "0";
    }
    break;
    break;
}
if ( $found_page_mw != "1" )
{
    header( "Location: ".ROOT_INDEX."" );
    exit( );
}
if ( $req_sql == "1" )
{
    include( "engine/connect_core.php" );
    include( "engine/secure_login.php" );
}
if ( $_SESSION['user_auth'] == "1" )
{
    $user_login = "1";
    $user_auth_id = safe_input( $_SESSION['user_auth_id'], "\\_" );
}
else
{
    $user_login = "0";
    $user_auth_id = "";
}
if ( $req_log == "1" && $user_login != "1" )
{
    $_SESSION['last_url'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header( "Location: ".ROOT_INDEX."?".LOAD_GET_PAGE."=".LOGIN_CMS_PAGE."" );
    exit( );
}
if ( isset( $_GET[USER_GET_PAGE] ) )
{
    $core_run_script = ROOT_INDEX."?".LOAD_GET_PAGE."=".$page_check_id."&".USER_GET_PAGE."=".xss_clean( safe_input( $_GET[USER_GET_PAGE], "_" ) );
}
else
{
    $core_run_script = ROOT_INDEX."?".LOAD_GET_PAGE."=".$page_check_id."";
}
require( "engine/style_cms.php" );
$core['version'] = crypt_it( $engine, "", "1" );
include( "template/".$core['config']['template']."/index.php" );
ob_end_flush( );
/**
* @+===========================================================================+
* @¦ MuCore 1.0.8 English.       					       ¦
* @¦ Credits: Isumeru & MaryJo  					       ¦
* @¦ +=======================================================================+ ¦
* @¦ ¦  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  ¦ ¦
* @¦ +=======================================================================+ ¦
* @¦ Official Site:   http://bizarre-networks.com                              ¦
* @+===========================================================================+
* @¦ Our Allied Site: http://chileplanet.org                                   ¦
* @+===========================================================================+
*/
?>
