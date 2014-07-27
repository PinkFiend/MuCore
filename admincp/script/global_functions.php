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
function notice_message_admin($notice, $redirect = 0, $error = 0, $url)
{
    if ($url == null) {
        $url_red = '';
    } else {
        $url_red = $url;
    }
    if ($error == 1) {
        $title   = "Error";
        $go_back = '<p><a href="javascript:history.go(-1);">Go Back</a></p>';
    } else {
        $title = "Success";
    }
    $return_msg = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                <tr>
                <td class="cat"><div align="left"><b>' . $title . '</b></div></td>
                </tr>
                <tr>
                <td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>' . $notice . '</p>' . $go_back . '
                </td> 
                </tr>
                </table>';
    if ($redirect == 1) {
        $return_msg .= '<meta http-equiv="Refresh" content="1; URL=' . $url_red . '">';
    }
    return $return_msg;
}





function new_config_xml($file, $field, $ncfg)
{
    $get_xml_config = file_get_contents($file . ".xml");
    $ncfg           = str_replace("\r\n", " ", $ncfg);
    $dat_ocfg       = ereg_replace("<" . $field . ">(.*)</" . $field . ">", "<" . $field . ">" . htmlspecialchars(htmlentities($ncfg)) . "</" . $field . ">", $get_xml_config);
    $o_xml_config   = fopen($file . ".xml", "w");
    $rw_xml_config  = fwrite($o_xml_config, $dat_ocfg);
    $c_xml_config   = fclose($o_xml_config);
    return true;
}


function delete_variable($file, $line, $id, $explode)
{
    $p_file = file($file);
    $new_db = fopen($file, "w");
    foreach ($p_file as $new_db_line) {
        $db_line = explode($explode, $new_db_line);
        if ($db_line[$line] != $id) {
            fwrite($new_db, $new_db_line);
        }
    }
    fclose($new_db);
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