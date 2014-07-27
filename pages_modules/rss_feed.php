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
$config = simplexml_load_file('engine/config_mods/rss_feed_settings.xml');
if($config->active == '0'){
	echo msg('0','Sorry, this feature is temporarily unavailable at the moment.');
}else{
	include('engine/rss_feed.php'); 
	$rss = new lastRSS; 
	$rss->cache_dir = './engine/cache/rss';
	$rss->cache_time = trim($config->rss_time)*60; 
	$count_rss = 0;
	

	if ($rs = $rss->get($config->rss_url)) {
		echo '<ul id="rss_feed">';
		foreach ($rs['items'] as $item){
			$count_rss++;
			$item['title'] = str_replace("<![CDATA[","",$item['title']);
			$item['title'] = str_replace("]]>","",$item['title']);
			echo '<li><a href="'.$item['link'].'" target="_blank">'.set_limit($item['title'],trim($config->rss_length),'...').'</a><br></li>';
			
			if($count_rss >= trim($config->rss_count)){
				break;
			}
		}
		echo '</ul>';
		
	}else{
		echo msg('0',''.rss_feed.'');
	}
	
}
?><br>
<br>
<!-- GOOGLE ADS CODE --><div align="center">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-7543471655790612";
/* mucore eng rss ads */
google_ad_slot = "4524982567";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div> 
<!-- GOOGLE ADS CODE END -->
<br><br>