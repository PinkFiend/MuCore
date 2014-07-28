<?php
echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\">
<tr>
 <td align=\"center\" class=\"panel_title\" colspan=\"2\">MUCore Engine Version</td>
</tr>
<tr>
<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Current version</td>
</tr>
<tr>
<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">Your MUCore Current Version.
</td>
<td align=\"left\" class=\"panel_text";
echo "_alt2\" width=\"45%\" valign=\"top\">
";
echo "<s";
echo "cript type=\"text/javascript\">
document.write('<b>'+engine_current_version+'</b>');
</script></td>
</tr>


<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Version Status</td>
</tr>
<tr>
<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">MUCore version status.
</td>
<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\">
";
echo "<s";
echo "cript type=\"text/javascript\">
if(engine_version > engine_current_version){
	document.write('<img src=\"styles/default/news_icon.gif\"><blink>New version is available.</blink>');
}else{
	document.write('<b><font color=\"#4a7a14\">Version is up to date.</font></b>');
}
</script></td>
</tr>

<tr>
<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Latest version available</td>
</tr>
<tr>
<td align=\"left\" class=\"panel_t";
echo "ext_alt1\" width=\"45%\" valign=\"top\">Latest stable version of MUCore available
.
</td>
<td align=\"left\" class=\"panel_text_alt2\" width=\"45%\" valign=\"top\"><b>";
echo "<s";
echo "cript type=\"text/javascript\">document.write(engine_version_txt);</script></b> - ";
echo "<s";
echo "cript type=\"text/javascript\">document.write('<a href=\"'+engine_announcement_url+'\" target=\"_blank\">');</script>Read Announcement</a></td>
</tr>
</table>





<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-top: 20px;\">
<tr>
 <td align=\"center\" class=\"panel_title\" colspan=\"2\">About MuCore 1.08 - English</td>
</tr>


<tr>
<td align=\"left\" class=\"panel_title_sub\" ";
echo "colspan=\"2\">Important Information</td>
</tr>
<tr>
<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">This is a project that was originally released only for the Hispanic community, however we decided to release this on its original version aswell.<br><br> This script has been modified by <b>MaryJo</b>. Webmaster, founder of <b><font color=\"#4a7a14\">Bizarre Mind Networks</font></b> and an official staff member of <b><font color=\"#4a7a14\">Chileplanet.org</font></b> a Spanish MU Online community.<br><br><b><font color=\"#CC0000\"><blink>WARNING!</blink></font></b> If you paid for this MuCore then ask for your money back immediately! Or if you got it outside of Bizarre-Networks.com or in this case RageZone, the only place we will release outside of our own, you should delete it and download it from the official site, as it can be a trick for you to download a modified script to steal information from you or it may not even work correctly.<br><br>We will NOT be held responsible for any damage you may get from downloading from other sites/communities. <br><br>Official Sites: <strong>bizarre-networks.com, RageZone.com (English Version) & ChilePlanet.org (Spanish Version)</strong>.<br><br>No support will be given to people who have downloaded this outside the official sites!<br><br><b>Bug Report</b> or <b>Troubleshoot</b> will be attended in our support section as long as you're a registered member and follow the rules.</td>
<td align=\"left\" class=\"panel_text_alt2\" widt";
echo "h=\"45%\" valign=\"top\">";
echo "<s";
echo "cript type=\"text/javascript\">document.write('<a href=\"'+engine_" . __FILE__ . "_url+'\" target=\"_blank\">');</script><b>Webmaster Notes</b></a></td>
</tr>

<tr>
<td align=\"left\" class=\"panel_title_sub\" colspan=\"2\">Suggestions and Support</td>
</tr>
<tr>
<td align=\"left\" class=\"panel_text_alt1\" width=\"45%\" valign=\"top\">Official Support Forum for this release.
</td>
<td align=\"left\" class=\"panel_text_alt2\" ";
echo "width=\"45%\" valign=\"top\">";
echo "<s";
echo "cript type=\"text/javascript\">document.write('<a href=\"'+engine_feedback+'\" target=\"_blank\">');</script>Suggestions, Reports</a></td>
</tr>

</table>



<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"table_panel\" style=\"margin-top: 20px;\">
<tr>
 <td align=\"center\" class=\"panel_title\" colspan=\"2\">Network News</td>
</tr>
<tr>
<td align=\"left\" class=\"pan";
echo "el_text_alt1 panel_text_logo\" valign=\"top\">


";
$last_date = strtotime("Fri, 27 Aug 2010 15:01:45 GMT");
$new_time  = "604800";
require("script/lastrss.php");
$rss              = new lastRSS();
$rss->cache_dir   = "script/temp";
$rss->cache_time  = 1200;
$rss->cp          = "US-ASCII";
$rss->date_format = "l";
$rssurl           = "http://bizarre-networks.com/index.php/rss/forums/1-bizarre-mind-news/";
$count_rss        = 0;
if ($rs = $rss->get($rssurl))
{
    foreach ($rs["items"] as $item)
    {
        ++$count_rss;
        if (time() - strtotime($item["pubDate"]) < $new_time)
        {
            echo "<div align=\"left\" class=\"rss_feed\"><b><a href=\"" . $item["link"] . "\" target=\"_blank\">" . $item["title"] . "</a></b> " . $new_item . " <img src=\"styles/default/new.gif\"></div>";
        }
        else
        {
            echo "<div align=\"left\" class=\"rss_feed\"><a href=\"" . $item["link"] . "\" target=\"_blank\">" . $item["title"] . "</a></div>";
        }
    }
}
else
{
    echo "Error: It's not possible to get rss url.";
}
echo "

</td>
</tr>


</table>";
?>
