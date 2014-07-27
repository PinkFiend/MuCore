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
$get_config = simplexml_load_file('engine/config_mods/rankings_settings.xml');
if ($get_config->active == '0') {
    echo msg('0', 'Sorry, this feature is temporarily unavailable at the moment.');
} else {
    $hide_stats = trim($get_config->hide_stats);
    
    if (!isset($_GET['rank'])) {
        $rank_type = 'characters';
    } elseif (isset($_GET['rank'])) {
        $rank_type = safe_input($_GET['rank'], '');
    }
    if (!isset($_GET['class'])) {
        if ($_GET['rank'] == 'guilds') {
            $rank_class_type = 'no_rank_type';
        } else {
            $rank_class_type = 'all';
        }
    } elseif (isset($_GET['class'])) {
        $rank_class_type = safe_input(set_limit($_GET['class'], '4', ''), '');
    }
    echo '
<script type="text/javascript">  
load_image= new Image(16,16); 
load_image.src="template/' . $core['config']['template'] . '/images/load_page.gif";  
function get_data(div,id, page, form, append, data){
    document.getElementById(div).innerHTML = \'<img src="template/' . $core['config']['template'] . '/images/load_page.gif" width="16" height="16">\';
    var veri;
    if( typeof(data) == "string")
        veri = data;
    else 
        veri = $(form).serialize();
    $.ajax({
   type: "POST",
   url: page,
   data: veri,
   error: function(html)
   {
           alert("Falied to get data.");
   },
   success: function(html)
   {
        if( typeof(append) == "boolean")
            $(id).append(html);
        else
            $(id).html(html);
   }
  });
  return false;
}
</script>';
    echo '<div class="iR_rank_type" style="margin-top: 3px;">';
    switch ($rank_type) {
        case 'rankings':
            echo '<span style="color: #990000;">Characters </span> - <a href="' . $core_run_script . '&rank=guilds">Guilds</a>';
            break;
        case 'characters':
            echo '<span style="color: #990000;">Characters</span> - <a href="' . $core_run_script . '&rank=guilds">Guilds</a>';
            break;
        case 'guilds':
            echo '<a href="' . $core_run_script . '&rank=characters">Characters</a> - <span style="color: #990000;">Guilds</span>';
            break;
    }
    echo '</div>';
    if ($rank_type == 'characters') {
        echo '<div style="margin-left: 4px; border-left: #2A2A2A dashed 1px; border-bottom: #2A2A2A dashed 1px; padding: 4px;" class="iR_rank_type_sub">';
        if ($rank_class_type == 'all') {
            echo '<span style="color: #990000;">[ All ]</span>';
        } else {
            echo '<a href="' . $core_run_script . '&rank=characters&class=all">[ All ]</a>';
        }
        
        
        foreach ($characters_class as $cls => $cls_n) {
            if ($rank_class_type == 'all') {
                echo ' - <a href="' . $core_run_script . '&rank=characters&class=' . $cls . '">' . $cls_n[0] . '</a>';
            } else {
                if ($rank_class_type == $cls) {
                    echo ' - <span style="color: #990000;">' . $cls_n[0] . '</span>';
                } else {
                    echo ' - <a href="' . $core_run_script . '&rank=characters&class=' . $cls . '">' . $cls_n[0] . '</a>';
                }
            }
            
        }
        echo '</div>
    ';
    }
    switch ($rank_type) {
        case 'characters':
            if ($rank_class_type == 'all') {
                //Cron Job check
                $jq_cron = $core_db->Execute("Select next_cron from MUCore_Cron_Jobs where cron_id=?", array(
                    trim($get_config->cron_job_1)
                ));
                if (cron_check($jq_cron->fields[0]) == false) {
                    $jq_cron_up = $core_db->Execute("Update MUCore_Cron_Jobs set next_cron=(" . time() . "+cron_time_set) where cron_id=?", array(
                        trim($get_config->cron_job_1)
                    ));
                    $qry_r      = $core_db->Execute("Select top " . $get_config->char_top . " mu_id,name,class,clevel,resets,strength,dexterity,vitality,energy,ctlcode,accountid,leadership,grand_resets from character order by grand_resets desc, resets desc, clevel desc");
                    while (!$qry_r->EOF) {
                        $init_r .= "" . $qry_r->fields[0] . "|" . base64_encode($qry_r->fields[1]) . "|" . $qry_r->fields[2] . "|" . $qry_r->fields[3] . "|" . $qry_r->fields[4] . "|" . $qry_r->fields[5] . "|" . $qry_r->fields[6] . "|" . $qry_r->fields[7] . "|" . $qry_r->fields[8] . "|" . $qry_r->fields[9] . "|" . $qry_r->fields[10] . "|" . $qry_r->fields[11] . "|" . $qry_r->fields[12] . "|\n";
                        $qry_r->MoveNext();
                    }
                    $ge_ra_0 = "engine/cache/ra_0/ra_0.cache";
                    $o_ra_0  = fopen($ge_ra_0, 'w');
                    fputs($o_ra_0, $init_r);
                    fclose($o_ra_0);
                }
                
                //Show All Rankings from cache
                echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px;">';
                $cache_ra_0  = file('engine/cache/ra_0/ra_0.cache');
                $cache_count = 0;
                foreach ($cache_ra_0 as $r_cache) {
                    $r_cache = explode("|", $r_cache);
                    if ($get_config->gm == '1') {
                        if (in_array($r_cache[9], get_array_variables($characters_ctlcode))) {
                            $cache_count++;
                            echo '
                        <tr>
                        <td align="center" rowspan="3"  class="iR_rank">' . $cache_count . '</td>
                        <td align="left" class="iR_name" >' . htmlspecialchars(base64_decode($r_cache[1])) . '</td>
                        <td align="left" rowspan="3" width="60"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($r_cache[2], '2') . '" width="60" height="60"></td>
                        <td align="left" class="iR_stats" >Str: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[5]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats" >Vit: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[7]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats" >PK Level: Hero</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_class">' . decode_class($r_cache[2]) . '</td>
                        <td align="left" class="iR_stats">Agi: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[6]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats">Eng: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[8]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats_level">Level ' . ($r_cache[3]) . '</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_status">';
                            if ($get_config->char_status == '1') {
                                echo '<div id="s_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'s_' . $cache_count . '\',\'#s_' . $cache_count . '\', \'get.php?aG=' . base64_encode(crypt_it($r_cache[10], $core['config']['crypt_key'])) . '\', null, \'data=s_' . $cache_count . '\');">Check Status</a></div>';
                            }
                            
                            echo '</td>
                        <td align="left" class="iR_status">';
                            if ($get_config->location == '1') {
                                echo '<div id="m_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'m_' . $cache_count . '\',\'#m_' . $cache_count . '\', \'get.php?aM=' . $r_cache[0] . '\', null, \'data=m_' . $cache_count . '\');">Location</a></div>';
                            }
                            echo '</td>
                        <td align="left" class="iR_stats">Com: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[9]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats_reset">Resets ' . ($r_cache[4]) . ', Grand Resets ' . $r_cache[12] . '</td>
                        </tr>
                        <tr>
                        <td colspan="6" colspan="6" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                        </tr>
                    
                        ';
                        }
                        
                    } else {
                        if ($r_cache[9] == '0') {
                            $cache_count++;
                            echo '
                        <tr>
                        <td align="center" rowspan="3"  class="iR_rank">' . $cache_count . '</td>
                        <td align="left" class="iR_name" >' . htmlspecialchars(base64_decode($r_cache[1])) . '</td>
                        <td align="left" rowspan="3" width="60"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($r_cache[2], '2') . '" width="60" height="60"></td>
                        <td align="left" class="iR_stats" >Str: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[5]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats" >Vit: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[7]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats" >PK Level: Hero</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_class">' . decode_class($r_cache[2]) . '</td>
                        <td align="left" class="iR_stats">Agi: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[6]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats">Eng: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[8]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats_level">Level ' . ($r_cache[3]) . '</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_status">';
                            if ($get_config->char_status == '1') {
                                echo '<div id="s_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'s_' . $cache_count . '\',\'#s_' . $cache_count . '\', \'get.php?aG=' . base64_encode(crypt_it($r_cache[10], $core['config']['crypt_key'])) . '\', null, \'data=s_' . $cache_count . '\');">Check Status</a></div>';
                            }
                            
                            echo '</td>
                        <td align="left" class="iR_status">';
                            if ($get_config->location == '1') {
                                echo '<div id="m_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'m_' . $cache_count . '\',\'#m_' . $cache_count . '\', \'get.php?aM=' . $r_cache[0] . '\', null, \'data=m_' . $cache_count . '\');">Location</a></div>';
                            }
                            echo '</td>
                        <td align="left" class="iR_stats">Com: ';
                            if ($hide_stats == '1') {
                                echo '--';
                            } else {
                                echo number_format($r_cache[9]);
                            }
                            echo '</td>
                        <td align="left" class="iR_stats_reset">Resets ' . ($r_cache[4]) . ', Grand Resets ' . $r_cache[12] . '</td>
                        </tr>
                        <tr>
                        <td colspan="6" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                        </tr>';
                        }
                    }
                }
                echo '</table>';
                
                echo '<div align="right" class="iR_task">Next Scheduled Update for Rankings is on ' . date('M j, Y H:i A', $jq_cron->fields[0]) . '</div>';
                
            } elseif (is_numeric($rank_class_type)) {
                //Cron Job Check
                $jq_cron = $core_db->Execute("Select next_cron from MUCore_Cron_Jobs where cron_id=?", array(
                    trim($get_config->cron_job_2)
                ));
                if (cron_check($jq_cron->fields[0]) == false) {
                    $jq_cron_up = $core_db->Execute("Update MUCore_Cron_Jobs set next_cron=(" . time() . "+cron_time_set) where cron_id=?", array(
                        trim($get_config->cron_job_2)
                    ));
                    $qry_c_dis  = $core_db->Execute("Select DISTINCT class from character");
                    while (!$qry_c_dis->EOF) {
                        $qry_c = $core_db->Execute("Select top " . $get_config->char_top . " mu_id,name,class,clevel,resets,strength,dexterity,vitality,energy,ctlcode,accountid,leadership,grand_resets from character where class='" . $qry_c_dis->fields[0] . "' order by grand_resets desc, resets desc, clevel desc");
                        while (!$qry_c->EOF) {
                            $init_cls .= "" . $qry_c->fields[0] . "|" . base64_encode($qry_c->fields[1]) . "|" . $qry_c->fields[2] . "|" . $qry_c->fields[3] . "|" . $qry_c->fields[4] . "|" . $qry_c->fields[5] . "|" . $qry_c->fields[6] . "|" . $qry_c->fields[7] . "|" . $qry_c->fields[8] . "|" . $qry_c->fields[9] . "|" . $qry_c->fields[10] . "|" . $qry_c->fields[11] . "|" . $qry_c->fields[12] . "|\n";
                            $qry_c->MoveNext();
                        }
                        $qry_c_dis->MoveNext();
                    }
                    $ge_ra_1 = "engine/cache/ra_0/ra_1.cache";
                    $o_ra_1  = fopen($ge_ra_1, 'w');
                    fputs($o_ra_1, $init_cls);
                    fclose($o_ra_1);
                }
                //Show Class Rankings from cache
                echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px;">';
                $cache_ra_1  = file('engine/cache/ra_0/ra_1.cache');
                $cache_count = 0;
                foreach ($cache_ra_1 as $r_cache) {
                    $r_cache = explode("|", $r_cache);
                    if ($r_cache[2] == $rank_class_type) {
                        if ($get_config->gm == '1') {
                            if (in_array($r_cache[9], get_array_variables($characters_ctlcode))) {
                                $cache_count++;
                                echo '
                        <tr>
                        <td align="center" rowspan="3"  class="iR_rank">' . $cache_count . '</td>
                        <td align="left" class="iR_name" >' . htmlspecialchars(base64_decode($r_cache[1])) . '</td>
                        <td align="left" rowspan="3" width="60"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($r_cache[2], '2') . '" width="60" height="60"></td>
                        <td align="left" class="iR_stats" >Str: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[5]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats" >Vit: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[7]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats" >PK Level: Hero</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_class">' . decode_class($r_cache[2]) . '</td>
                        <td align="left" class="iR_stats">Agi: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[6]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats">Eng: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[8]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats_level">Level ' . ($r_cache[3]) . '</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_status">';
                                if ($get_config->char_status == '1') {
                                    echo '<div id="s_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'s_' . $cache_count . '\',\'#s_' . $cache_count . '\', \'get.php?aG=' . base64_encode(crypt_it($r_cache[10], $core['config']['crypt_key'])) . '\', null, \'data=s_' . $cache_count . '\');">Check Status</a></div>';
                                }
                                
                                echo '</td>
                        <td align="left" class="iR_status">';
                                if ($get_config->location == '1') {
                                    echo '<div id="m_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'m_' . $cache_count . '\',\'#m_' . $cache_count . '\', \'get.php?aM=' . $r_cache[0] . '\', null, \'data=m_' . $cache_count . '\');">Location</a></div>';
                                }
                                echo '</td>
                        <td align="left" class="iR_stats">Com: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[9]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats_reset">Resets ' . ($r_cache[4]) . ', Grand Resets ' . $r_cache[12] . '</td>
                        </tr>
                        <tr>
                        <td colspan="6" colspan="6" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                        </tr>';
                            }
                            
                        } else {
                            if ($r_cache[9] == '0') {
                                $cache_count++;
                                echo '
                        <tr>
                        <td align="center" rowspan="3"  class="iR_rank">' . $cache_count . '</td>
                        <td align="left" class="iR_name" >' . htmlspecialchars(base64_decode($r_cache[1])) . '</td>
                        <td align="left" rowspan="3" width="60"><img src="template/' . $core['config']['template'] . '/images/class/' . decode_class($r_cache[2], '2') . '" width="60" height="60"></td>
                        <td align="left" class="iR_stats" >Str: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[5]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats" >Vit: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[7]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats" >PK Level: Hero</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_class">' . decode_class($r_cache[2]) . '</td>
                        <td align="left" class="iR_stats">Agi: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[6]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats">Eng: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[8]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats_level">Level ' . ($r_cache[3]) . '</td>
                        </tr>
                        <tr>
                        <td align="left" class="iR_status">';
                                if ($get_config->char_status == '1') {
                                    echo '<div id="s_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'s_' . $cache_count . '\',\'#s_' . $cache_count . '\', \'get.php?aG=' . base64_encode(crypt_it($r_cache[10], $core['config']['crypt_key'])) . '\', null, \'data=s_' . $cache_count . '\');">Check Status</a></div>';
                                }
                                
                                echo '</td>
                        <td align="left" class="iR_status">';
                                if ($get_config->location == '1') {
                                    echo '<div id="m_' . $cache_count . '"><a href="javascript:void(0)" onclick="get_data(\'m_' . $cache_count . '\',\'#m_' . $cache_count . '\', \'get.php?aM=' . $r_cache[0] . '\', null, \'data=m_' . $cache_count . '\');">Location</a></div>';
                                }
                                echo '</td>
                        <td align="left" class="iR_stats">Com: ';
                                if ($hide_stats == '1') {
                                    echo '--';
                                } else {
                                    echo number_format($r_cache[9]);
                                }
                                echo '</td>
                        <td align="left" class="iR_stats_reset">Resets ' . ($r_cache[4]) . ', Grand Resets ' . $r_cache[12] . '</td>
                        </tr>
                        <tr>
                        <td colspan="6" colspan="6" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                        </tr>';
                            }
                        }
                    }
                }
                echo '</table>';
                echo '<div align="right" class="iR_task">Next Scheduled Update for Rankings is on ' . date('M j, Y H:i A', $jq_cron->fields[0]) . '</div>';
            }
            break;
        case 'guilds':
            $jq_cron = $core_db->Execute("Select next_cron from MUCore_Cron_Jobs where cron_id=?", array(
                trim($get_config->cron_job_3)
            ));
            if (cron_check($jq_cron->fields[0]) == false) {
                $jq_cron_up = $core_db->Execute("Update MUCore_Cron_Jobs set next_cron=(" . time() . "+cron_time_set) where cron_id=?", array(
                    trim($get_config->cron_job_3)
                ));
                $qry_g      = $core_db->Execute("Select top " . $get_config->guilds_top . " G_name,G_Mark,G_Score,G_Master from Guild order by G_Score desc");
                while (!$qry_g->EOF) {
                    $qry_n_m = $core_db->Execute("Select name from GuildMember where G_name=?", array(
                        $qry_g->fields[0]
                    ));
                    $ra_02 .= "" . md5_encrypt($qry_g->fields[0]) . "|" . urlencode(bin2hex($qry_g->fields[1])) . "|" . $qry_g->fields[2] . "|" . md5_encrypt($qry_g->fields[3]) . "|" . $qry_n_m->RecordCount() . "|\n";
                    $qry_g->MoveNext();
                }
                $ge_ra_2 = "engine/cache/ra_0/ra_2.cache";
                $o_ra_2  = fopen($ge_ra_2, 'w');
                fputs($o_ra_2, $ra_02);
                fclose($o_ra_2);
            }
            echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px;">';
            $cache_ra_1  = file('engine/cache/ra_0/ra_2.cache');
            $cache_count = 0;
            foreach ($cache_ra_1 as $r_cache) {
                $r_cache = explode("|", $r_cache);
                $cache_count++;
                echo '
                <tr>
                <td align="center"  rowspan="2" class="iR_rank">' . $cache_count . '</td>
                <td align="left" class="iR_name" >' . htmlspecialchars(md5_decrypt($r_cache[0])) . '</td>
                <td align="right" rowspan="2"><img src="get.php?aL=' . $r_cache[1] . '" width="50" height="50"></td>
                <td align="left" class="iR_stats">Guild Master: ' . htmlspecialchars(md5_decrypt($r_cache[3])) . '</td>
                </tr>
                <tr>
                <td align="left" class="iR_class">' . $r_cache[4] . ' members</td>
                <td align="left" class="iR_stats_level">Score: ' . $r_cache[2] . '</td>
                </tr>
                <tr>
                <td colspan="4" colspan="6" style="background-image:url(template/' . $core['config']['template'] . '/images/inner_line.jpg); background-repeat:repeat-x;">&nbsp;</td>
                </tr>
                ';
                
            }
            
            echo '</table>';
            
            echo '<div align="right" class="iR_task">Next Scheduled Update for Rankings is on ' . date('M j, Y H:i A', $jq_cron->fields[0]) . '</div>';
            break;
    }
    echo '';
    
    
    
    
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