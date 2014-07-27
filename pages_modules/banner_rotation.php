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
$banner_config = simplexml_load_file('engine/config_mods/banner_settings.xml');

echo '
<script type="text/javascript" src="js/jquery.innerfade.js"></script>
<script type="text/javascript">
       $(document).ready(
                function(){

                    
                    $(\'ul#banners\').innerfade({
                        speed: ' . $banner_config->fade . ',
                        timeout: ' . $banner_config->delay . ',
                        type: \'sequence\',
                        containerheight: \'' . $banner_config->height . 'px\'
                    });
                    

                    


            });
      </script>
      

<style type="text/css">
ul#banners {list-style:none; margin:0;padding:0;}
li#banners { margin:0;padding:0;}
</style>

<ul id="banners">';
$list_banners = file('engine/variables_mods/banners.tDB');
foreach ($list_banners as $banner) {
    $banner = explode("¦", $banner);
    echo '
    <li>
    <a href="' . $banner[3] . '" title="' . $banner[1] . '">
    <img src="' . $banner[2] . '" alt="' . $banner[1] . '" border="0"></a>
    </li>';
}

echo '
</ul>
';
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