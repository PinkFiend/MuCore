<?php
/**
* @+===========================================================================+
* @� MuCore 1.0.8 English.       					       �
* @� Credits: Isumeru & MaryJo  					       �
* @� +=======================================================================+ �
* @� �  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  � �
* @� +=======================================================================+ �
* @� Official Site:   http://bizarre-networks.net                              �
* @+===========================================================================+
* @� Our Allied Site: http://chileplanet.org                                   �
* @+===========================================================================+
*/
echo "\n\n<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"left_table\" height=\"900\">\n<tr>\n <td align=\"left\" valign=\"top\">\n \n \n ";
$nav_xml = array( );
if ( $handle = @opendir( "nav_bar" ) )
{
    while ( ( $file = readdir( $handle ) ) !== false )
    {
        if ( preg_match( "#^nav_(.*).xml\$#i", $file, $matches ) )
        {
            $nav_key = preg_replace( "#[^a-z0-9]#i", "", $matches[1] );
            $nav_xml["{$nav_key}"] = $file;
        }
    }
    closedir( $handle );
}
$nav_categories = array( );
foreach ( $nav_xml as $xml => $xml_file )
{
    $o_xml = simplexml_load_file( "nav_bar/".$xml_file."" );
    foreach ( $o_xml as $nav_cat )
    {
        $nav_group = $nav_cat['group'];
        $nav_categories["{$nav_group}"] = $nav_cat['title'];
    }
}
ksort( $nav_categories );
foreach ( $nav_categories as $cat => $cat_value )
{
    echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\" class=\"nav_table\" style=\"margin-top: 10px;\">\n\t   <tr>\n    <td align=\"left\" class=\"nav_title\">".$cat_value."</td>\n   </tr>";
    foreach ( $nav_xml as $xml => $xml_file )
    {
        $o_xml = simplexml_load_file( "nav_bar/".$xml_file."" );
        foreach ( $o_xml as $nav_cat )
        {
            foreach ( $nav_cat as $nav_script )
            {
                if ( $nav_script['group'] == $cat )
                {
                    echo "   <tr>\n    <td align=\"left\" class=\"nav_title_sub\"><a href=\"".$nav_script['link']."\" target=\"body\">".$nav_script[0]."</a></td>\n   </tr>";
                }
            }
        }
    }
    echo "</table>";
}
echo "\n  \n\n\n </td>\n</tr>\n</table>";
/**
* @+===========================================================================+
* @� MuCore 1.0.8 English.       					       �
* @� Credits: Isumeru & MaryJo  					       �
* @� +=======================================================================+ �
* @� �  "He who Copy/Pastes Shall Inherit My Mistakes But Not My Knowledge"  � �
* @� +=======================================================================+ �
* @� Official Site:   http://bizarre-networks.net                              �
* @+===========================================================================+
* @� Our Allied Site: http://chileplanet.org                                   �
* @+===========================================================================+
*/
?>
