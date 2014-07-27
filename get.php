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
require('config.php');
require("engine/global_config.php");
require('engine/global_functions.php');
require('engine/custom_variables.php');
require("engine/adodb/adodb.inc.php");
if ($core['debug'] == '1') {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}

if (isset($_GET['aG'])) {
    include("engine/connect_core.php");
    $acc_G  = base64_decode(crypt_it(set_limit($_GET['aG'], '12', ''), $core['config']['crypt_key']));
    $acc_Gs = safe_input($acc_G, '');
    $c_s    = $core_db2->Execute("Select connectstat from MEMB_STAT where memb___id=?", array(
        $acc_Gs
    ));
    if ($c_s->EOF) {
        echo 'N/A';
    } else {
        if ($c_s->fields[0] == '0') {
            echo '<span style="color:#990000;"><b>Offline</b></span>';
        } elseif ($c_s->fields[0] == '1') {
            echo '<span style="color:#99CC00;"><b>Online</b></span>';
        }
    }
} elseif (isset($_GET['aI'])) {
    session_start();
    $alphanum             = "01234567890abcdefghijklmnopqrstuvwxyz";
    $rand                 = substr(str_shuffle($alphanum), 0, 6);
    $_SESSION['SID_code'] = md5($rand);
    $image                = imagecreatefromgif('template/' . $core['config']['template'] . '/images/captcha.gif');
    $bgColor              = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
    $textColor            = imagecolorallocate($image, 0xff, 0Xff, 0xff);
    $textColor2           = imagecolorallocate($image, 0x00, 0X00, 0x00);
    $font                 = "engine/captcha/mentone-semibol.otf";
    imagefttext($image, 36, 0, 58, 63, $textColor2, $font, $rand);
    imagefttext($image, 35, 0, 60, 63, $textColor, $font, $rand);
    
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);
    
} elseif (isset($_GET['aA'])) {
    include("engine/connect_core.php");
    
    $acc_aA = safe_input(set_limit($_GET['aA'], '12', ''), '');
    $c_aa   = $core_db2->Execute("Select memb___id from memb_info where memb___id=?", array(
        $acc_aA
    ));
    if ($c_aa->RecordCount() > 0) {
        echo '<span style="color:#C00;"><b>User ID already in use.</b></span>';
    } else {
        echo '<span style="color:#0C0;"><b>User ID is available.</b></span>';
    }
    
    
} elseif (isset($_GET['aMl'])) {
    if (!empty($_GET['aMl'])) {
        include("engine/connect_core.php");
        
        $acc_aM = safe_input(set_limit($_GET['aMl'], '50', ''), '.@_');
        $c_am   = $core_db2->Execute("Select mail_addr from memb_info where mail_addr=?", array(
            $acc_aM
        ));
        if ($c_am->RecordCount() > 0) {
            echo '<span style="color:#C00;"><b>Mail Address already in use.</b></span>';
        } else {
            echo '<span style="color:#0C0;"><b>Mail Address is is available.</b></span>';
        }
    }
} elseif (isset($_GET['aM'])) {
    include("engine/connect_core.php");
    
    
    $acc_Ms = safe_input($_GET['aM'], '');
    $c_m    = $core_db->Execute("Select mapnumber,mapposx,mapposy from character where mu_id=?", array(
        $acc_Ms
    ));
    if ($c_m->EOF) {
        echo 'N/A';
    } else {
        echo '<span style="color:#333333; font-size: 10px;">' . decode_map($c_m->fields[0]) . ', X:' . $c_m->fields[1] . ' Y:' . $c_m->fields[2] . '</span>';
    }
    
} elseif (isset($_GET['aL'])) {
    $acc_aL = safe_input($_GET['aL'], '');
    function hex2bin($RawInput)
    {
        $BinStr = '';
        for ($i = 0; $i < strlen($RawInput); $i += 2)
            $BinStr .= '%' . substr($RawInput, $i, 2);
        return rawurldecode($BinStr);
    }
    
    function binhex($bin)
    {
        $hex = dechex(bindec($bin));
        return $hex;
    }
    $size      = 40;
    $pixelSize = $size / 8;
    $hex       = $acc_aL;
    function color($mark)
    {
        if ($mark == 0) {
            $color = "#ffffff";
        }
        if ($mark == 1) {
            $color = "#000000";
        }
        if ($mark == 2) {
            $color = "#8c8a8d";
        }
        if ($mark == 3) {
            $color = "#ffffff";
        }
        if ($mark == 4) {
            $color = "#fe0000";
        }
        if ($mark == 5) {
            $color = "#ff8a00";
        }
        if ($mark == 6) {
            $color = "#ffff00";
        }
        if ($mark == 7) {
            $color = "#8cff01";
        }
        if ($mark == 8) {
            $color = "#00ff00";
        }
        if ($mark == 9) {
            $color = "#01ff8d";
        }
        if ($mark == 'a') {
            $color = "#00ffff";
        }
        if ($mark == 'b') {
            $color = "#008aff";
        }
        if ($mark == 'c') {
            $color = "#0000fe";
        }
        if ($mark == 'd') {
            $color = "#8c00ff";
        }
        if ($mark == 'e') {
            $color = "#ff00fe";
        }
        if ($mark == 'f') {
            $color = "#ff008c";
        }
        return $color;
    }
    
    for ($y = 0; $y < 8; $y++) {
        for ($x = 0; $x < 8; $x++) {
            $offset               = ($y * 8) + $x;
            $Cuadrilla8x8[$y][$x] = substr($hex, $offset, 1);
        }
    }
    $SuperCuadrilla = array();
    for ($y = 1; $y <= 8; $y++) {
        for ($x = 1; $x <= 8; $x++) {
            $bit = $Cuadrilla8x8[$y - 1][$x - 1];
            for ($repiteY = 0; $repiteY < $pixelSize; $repiteY++) {
                for ($repite = 0; $repite < $pixelSize; $repite++) {
                    $translatedY                                = ((($y - 1) * $pixelSize) + $repiteY);
                    $translatedX                                = ((($x - 1) * $pixelSize) + $repite);
                    $SuperCuadrilla[$translatedY][$translatedX] = $bit;
                }
            }
        }
    }
    
    $img = ImageCreate($size, $size);
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            $bit        = $SuperCuadrilla[$y][$x];
            $color      = substr(color($bit), 1);
            $r          = substr($color, 0, 2);
            $g          = substr($color, 2, 2);
            $b          = substr($color, 4, 2);
            $superPixel = ImageCreate(1, 1);
            $cl         = imageColorAllocateAlpha($superPixel, hexdec($r), hexdec($g), hexdec($b), 0);
            ImageFilledRectangle($superPixel, 0, 0, 1, 1, $cl);
            ImageCopy($img, $superPixel, $x, $y, 0, 0, 1, 1);
            ImageDestroy($superPixel);
        }
    }
    header("Content-type: image/jpeg");
    ImageRectangle($img, 0, 0, $size - 1, $size - 1, ImageColorAllocate($img, 0, 0, 0));
    imagecolortransparent($img, 'FFFFFF');
    ImageGif($img);
} elseif (isset($_GET['aChat'])) {
    $get_chat   = array_reverse(file('engine/variables_mods/chat.tDB'));
    $post_count = 0;
    $get_config = simplexml_load_file('engine/config_mods/chat_settings.xml');
    foreach ($get_chat as $chat) {
        $chat = explode("¦", $chat);
        
        $post_count++;
        $row = ($post_count % 2) ? "chat_even" : "chat_odd";
        if ($post_count <= 20) {
            if ($chat[4] == '1') {
                echo '<div align="left" class="' . $row . '">[' . date('H:iA', $chat[2]) . '] <b><font color="' . $get_config->admin_color . '">' . $chat[0] . '</font> :</b> <font color="' . $get_config->admin_color2 . '">' . wordwrap($chat[1], 76, "<br/>\n", true) . '</font></div>';
            } else {
                echo '<div align="left" class="' . $row . '">[' . date('H:iA', $chat[2]) . '] <b>' . $chat[0] . ' :</b> ' . wordwrap($chat[1], 76, "<br/>\n", true) . '</div>';
            }
        }
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