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
$settings = simplexml_load_file('engine/config_mods/downloads_settings.xml');
$active   = trim($settings->active);
if ($active == '0') {
    echo msg('0', 'Sorry, this feature is temporarily unavailable at the moment.');
} else {
    $iD_file = file('engine/variables_mods/downloads.tDB');
    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    $count_fc = 0;
    $count_p  = 0;
    $count_u  = 0;
    
    
    foreach ($downloads_cat as $cat_id => $download_cat) {
        echo '
    <tr>
    <td align="left" class="iN_download_cat" colspan="2" style="padding-bottom: 4px;">' . $download_cat . ' </td>
    </tr>';
        
        foreach ($iD_file as $iD_data) {
            $iD_data = explode("¦", $iD_data);
            if ($iD_data[1] == '1') {
                if ($iD_data[2] == $cat_id) {
                    echo '

    <tr>
    <td align="left" style="padding-top: 10px; padding-bottom: 10px; padding-left: 20px;" valign="top"><span class="iN_download_title"><b>' . $iD_data[3] . '</b></span>
    <br>
    <span class="iN_description">' . htmlspecialchars($iD_data[4]) . '</span>
    </td>
    <td width="150px" align="center"><a href="' . $iD_data[5] . '" target="_blank"><img src="template/' . $core['config']['template'] . '/images/download_btn.gif" border="0" title="Download"></a></td>
  </tr>

        <tr>
            <td colspan="2" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg);  height: 2px;"></td>
            </td>';
                }
                
                
            }
        }
        echo '<tr>
    <td colspan="2">&nbsp;</td>
    </tr>';
        
        
        
    }
    
    echo '</table>';
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