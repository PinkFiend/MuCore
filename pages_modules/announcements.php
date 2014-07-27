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
require('engine/announcement_config.php');

if ($core['ANNOUNCEMENT']['ACTIVE'] == '0') {
    echo msg('0', text_sorry_feature_disabled);
} else {
    $ann = array_reverse(file('engine/variables_mods/announcements.tDB'));
    foreach ($ann as $info) {
        $info = explode("¦", $info);
        echo '<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 20px;">
    <tr>
         <td align="left" colspan="2" class="iN_title" width="97%"><a name="announcement-' . $info[0] . '"></a>' . htmlentities($info[1]) . '</td>
        </tr>
        <tr>
         <td colspan="2" algin="left" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg);  height: 2px;"></td>
        </tr>
        <tr>
         <td  align="left" class="iN_date">' . date('F j, Y', $info[2]) . ' ' . text_untill . ' ' . date('F j, Y', $info[3]) . '</td>
          <td align="right">';
        if ($core['ANNOUNCEMENT']['AUTHOR'] == '1') {
            echo '<b>' . $core['config']['admin_nick'] . '</b> (Administrator)</td>';
        }
        echo '</tr>
          </tr>
         <td colspan="2" algin="left" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); height: 2px;"></td>
        </tr>
         <tr>
         <td colspan="2" align="left" class="iN_news_content">&nbsp;&nbsp;&nbsp;' . $info[4] . '</td>
        </tr>

        </table>
    
    ';
        
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