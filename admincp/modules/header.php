<?php
echo " < tablewidth = \"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"border_big\" style=\"height: 60px;\">
<tr>
 <td class=\"cat_big\" valign=\"top\">
 <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
 <tr>
 <td align=\"left\" class=\"curent_version\"><b>MUCore Admin Control Panel version ";
echo $core["version"];
echo "</b></td>
 <td align=\"right\"><a href=\"";
echo $core["config"]["website_url"];
echo "\" target=\"_blank\">";
echo $core["config"]["websitetitle"];
echo " Home Page</a> | <a href=\"index.php?get=home\" target=\"body\">Admin Home</a> | <a href=\"index.php?get=logout\" target=\"_top\">Log Out</a></td>
 </tr>
  <tr>
 <td align=\"left\">";
echo "<s";
echo "pan class=\"last_version\">";
echo "<s";
echo "cript type=\"text/javascript\">document.write('<a href=\"'+engine_announcement_url+'\" target=\"_blank\">');</script>Latest version available: ";
echo "<s";
echo "cript type=\"text/javascript\">document.write(engine_version_txt);</script></a></span></td>
 <td align=\"right\">&nbsp;</td>
 </tr>
 </table>
 </td>
</tr>
</table>";
?>
