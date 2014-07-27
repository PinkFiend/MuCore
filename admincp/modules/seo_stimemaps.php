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
if (isset($_POST['sitemap'])) {
    $start_sitemap = $core['config']['website_url'] . "/\r\n";
    $pages_files   = get_sort('../engine/cms_data/pag_d.cms', '¦');
    $count         = 0;
    foreach ($pages_files as $page) {
        if ($page[7] == '0' && $page[8] == '1' && $page[9] == '0' && $page[6] == '1') {
            $start_sitemap .= $core['config']['website_url'] . '/' . ROOT_INDEX . '?' . LOAD_GET_PAGE . '=' . $page[3] . "\r\n";
        }
    }
    $open_site_maps  = fopen('../sitemap.txt', 'w');
    $add_site_maps   = fwrite($open_site_maps, $start_sitemap);
    $close_site_maps = fclose($open_site_maps);
    echo notice_message_admin('Sitemap successfully generated', 1, 0, 'index.php?get=seo_stimemaps');
} else {
    echo '
        
<form action="" name="form_c" method="POST">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Sitemap Settings</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Generate Sitemap</td>
</tr>

<tr>
<td align="left" class="panel_buttons" valign="top"><br><br><b>Note</b>: Pages that require <b>Authentication</b>, are marked as <b>Hide</b> or are <b>Inactive</b> are not included on sitemap.</td>
<td align="right" class="panel_buttons" valign="top">
<input type="hidden" name="sitemap">
<input type="submit" value="Run Sitemap Generator" onclick="return ask_form(\'Are you sure you want to run sitemap generator\')"></td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Google Sitemap Index URL</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" colspan="2"><b>Your Google Sitemap Index URL:</b> <a href="' . $core['config']['website_url'] . '/sitemap.txt" target="_blank">' . $core['config']['website_url'] . '/sitemap.txt</a></td>
</tr>


</table>
</form>';
    
    
    if (is_file('../sitemap.txt')) {
        echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Sitemap URLs</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">#</td>
<td align="left" class="panel_title_sub2" width="97%">URLs</td>
</tr>';
        $sitemaps = file('../sitemap.txt');
        $count    = 0;
        foreach ($sitemaps as $link) {
            $count++;
            $tr_color = ($count % 2) ? '' : 'even';
            echo '
        <tr class="' . $tr_color . '">
        <td align="left" class="panel_text_alt_list"><b>' . $count . '</b></td>
        <td align="left" class="panel_text_alt_list"><b>' . $link . '</b></td>
        </tr>';
            
        }
        if ($count == '0') {
            echo '<tr>
        <td align="center" class="panel_text_alt_list" colspan="2">No URLs found in sitemap</td>
        </tr>';
            
        }
        
    } else {
        echo 'Sitemap file not found.';
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