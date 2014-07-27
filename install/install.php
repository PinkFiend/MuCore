<?
require('../config.php');
require('../engine/core.php');
require('../engine/global_config.php');
require('../engine/global_functions.php');
require("../engine/adodb/adodb.inc.php");
if ($core['debug'] == '1') {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
}
$core['version'] = crypt_it($engine, '', '1');
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>Install Mucore 1.0.8 by MaryJo</title><style type="text/css"><!--body{background: #E1E1E1;color: #000000;font: 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;margin:0px;padding: 0px;}a{text-decoration: underline;color: #22229C;}a:hover {text-decoration: none;color:  #22229C;}.border_big a{text-decoration: none;color: #ffffff;}.border_big a:hover {text-decoration: underline;color:  #ffffff;}.nav_table a:link, .nav_table a:visited, nav_table a:active{text-decoration: none;}.nav_table a:hover {text-decoration: none;}.cat{background: #465786;color: #FFFFFF;font: bold 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding: 2px;}.border{background: #F2F2F2;color: #000000;border: outset 1px #DEE0E2;}.border_big{background: #F2F2F2;color: #000000;border-right: outset 1px #DEE0E2;}.cat_big{background: #465786;color: #FFFFFF;font: bold 12px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding: 4px;}.left_table{background: #465786;color: #000000;border-right: outset 1px #DEE0E2;padding: 4px;}.nav_table{background: #6E7A9A;color: #000000;}.nav_title{background: #EFEFEF;color: #7C7C7C;font: bold 12px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding: 2px;}.nav_title_sub{background: #ffffff;color: #FFFFFF;padding: 2px;padding-left: 4px;}.nav_title_sub:hover{background: #F8F8F8;color: #FFFFFF;padding: 2px;padding-left: 4px;}input, option, select, textarea{font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;}.smallfont{font: 10px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;}.curent_version{font: 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;}.last_version a{font: 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;text-decoration: underline;}.module_title{background: #EFEFEF;font: bold 14px  tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;color: #7C7C7C;padding: 2px;border: inset 1px #DEE0E2;}.table_panel{background: #ffffff;color: #000000;border: outset 1px #DEE0E2;width: 800px;}.panel_title{background: #6E7A9A;color: #FFFFFF;font: bold 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding: 2px;}.panel_title_sub{background: #B0BDD3;font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding: 2px;padding-left: 4px;color: #595959;}.panel_title_sub2{background: #B0BDD3;font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding: 2px;padding-left: 4px;color: #595959;border: outset 1px #666666;}.panel_text_alt1{padding-left: 4px;padding-top: 8px;padding-bottom: 8px;padding-right: 8px;height: 20px;}.panel_text_area{padding: 10px;}.panel_text_alt2{padding-left: 4px;padding-top: 8px;padding-bottom: 8px;padding-right: 8px;height: 20px;}.panel_text_alt_list{padding-left: 4px;padding-top: 8px;padding-bottom: 8px;padding-right: 8px;height: 20px;color: #666666;}.panel_buttons{background: #EEEEEE;padding: 4px;border-top: outset 1px #666666;}input[type="radio"] { border: 0px; }.even{background: #EAEAEA;}a.info_l {text-decoration:none;cursor:default;}a.info_l:hover {text-decoration:none;}.info_show {background-color:#ffffff;padding:5px 10px;border:1px solid #999;width: 130px;position:absolute;filter:progid:DXImageTransform.Microsoft.Shadow(color="#777777", Direction=135, Strength=3);z-index:10000;}--></style></head><body><?
if (!isset($_GET['step'])) {
    $step_proccess = 'Preparing to Install';
} else {
    $step_count    = safe_input($_GET['step'], '\_');
    $step_count    = substr_replace($step_count, "", 0, -1);
    $step_proccess = 'Step (' . $step_count . '/7)';
}
?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border_big"><tr> <td class="cat_big"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> <tr> <td align="left" class="curent_version"><b>MUCore Version <?= $core['version'] ?> by MaryJo</b></td> <td align="right"><?= $step_proccess; ?></td> </tr>  <tr> <td align="left">&nbsp;</td> <td align="right">&nbsp;</td> </tr> </table> </td></tr></table><div align="center" style="margin-top: 40px; margin-bottom: 40px;"><?
if (!isset($_GET['step'])) {
    include('step.php');
} else {
    $step = safe_input($_GET['step'], '\_');
    if (is_file($step . '.php')) {
        include($step . '.php');
    } else {
        echo '' . $step . ' not found';
    }
}
?></div></body></html>
