<?
$load_reset_settings = simplexml_load_file('engine/config_mods/grandreset_character_settings.xml');
$active = trim($load_reset_settings->active);
if($active == '0'){
	echo msg('0','Sorry, this feature is temporarily unavailable at the moment.');
}else{
$reset_resets_need = trim($load_reset_settings->resets_need);
$reset_level = trim($load_reset_settings->level);
$reset_zen  = trim($load_reset_settings->zen);
$reset_points = trim($load_reset_settings->bpoints);
$reset_points_formula = trim($load_reset_settings->bpoints_formula);
$reset_clear_skills = trim($load_reset_settings->clear_skills);
$reset_clear_inv = trim($load_reset_settings->clear_inv);
$reset_stats = trim($load_reset_settings->reset_stats);
$reset_limit = trim($load_reset_settings->reset_limit);
$reset_credits = trim($load_reset_settings->bcredits);
$reset_credits_formula = trim($load_reset_settings->bcredits_formula);

if(isset($_GET['rid'])){
	echo '<div style="margin-top: 10px;">';
	$id = safe_input($_GET['rid'],'');
	if(empty($id) || !is_numeric($id)){
		header('Location: '.$core_run_script.'');
		exit();
	}else{
		if(character_and_account($id,$user_auth_id) === false){
			header('Location: '.$core_run_script.'');
			exit();
		}else {
			if(account_online($user_auth_id) === true){
				echo msg('0','Account is connected on game, please logout.');		
			}else{
				$select_req = $core_db->Execute("select clevel,money,resets,leveluppoint,grand_resets from character where mu_id=? and accountid=?",array($id,$user_auth_id));
				
				if($select_req->fields[2] < $reset_resets_need){
					echo msg('0','Unable to reset, reason: lacking '.($reset_resets_need - $select_req->fields[2]).' resets.');
					$no_reset = 1;
				}
				
				if($select_req->fields[0] < $reset_level){
					echo msg('0','Unable to reset, reason: lacking '.($reset_level - $select_req->fields[0]).' levels.');
					$no_reset = 1;
				}
				if($select_req->fields[1] < $reset_zen){
					echo msg('0','Unable to reset, reason: lacking '.number_format($reset_zen - $select_req->fields[1]).' zen.');
					$no_reset = 1;
				}
				if($no_reset != '1'){
					$new_money = $select_req->fields[1] - $reset_zen;
					switch ($reset_points_formula){
						case '0': $new_bpoints = ($select_req->fields[3]+$reset_points); break;
						case '1': $new_bpoints = ($select_req->fields[3]+ ($reset_points*($select_req->fields[2]+1))); break;
					}
					
					switch ($reset_credits_formula){
						case '0': $new_bcredits = ($reset_credits); break;
						case '1': $new_bcredits = ($reset_credits*($select_req->fields[4]+1)); break;
					}
					switch ($reset_stats){
						case '1': 
							if($reset_clear_inv == '1' and $reset_clear_skills == '1'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[leadership]='25',[inventory]=CONVERT(varbinary(1080), null),[magiclist]=CONVERT(varbinary(180), null),[grand_resets]=(grand_resets+1) where mu_id=?";
							}elseif ($reset_clear_inv == '1'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[leadership]='25',[inventory]=CONVERT(varbinary(1080), null),[grand_resets]=(grand_resets+1) where mu_id=?";
							}elseif ($reset_clear_skills == '1'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[leadership]='25',[magiclist]=CONVERT(varbinary(180), null),[grand_resets]=(grand_resets+1) where mu_id=?";
							}elseif ($reset_clear_inv == '0' and $reset_clear_skills == '0'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[strength]='25',[dexterity]='25',[vitality]='25',[energy]='25',[leadership]='25',[grand_resets]=(grand_resets+1) where mu_id=?";
							}
						break;
						case '0':
							if($reset_clear_inv == '1' and $reset_clear_skills == '1'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[inventory]=CONVERT(varbinary(1080), null),[magiclist]=CONVERT(varbinary(180), null),[grand_resets]=(grand_resets+1) where mu_id=?";
							}elseif ($reset_clear_inv == '1'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[inventory]=CONVERT(varbinary(1080), null),[grand_resets]=(grand_resets+1) where mu_id=?";
							}elseif ($reset_clear_skills == '1'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[magiclist]=CONVERT(varbinary(180), null),[grand_resets]=(grand_resets+1) where mu_id=?";
							}elseif ($reset_clear_inv == '0' and $reset_clear_skills == '0'){
								$reset_formula = "Update character set [resets]='0',[clevel]='1',[experience]='0',[leveluppoint]=?,[money]=?,[grand_resets]=(grand_resets+1) where mu_id=?";
							}
						break;
					}	
					$exc_reset_formula=$core_db->Execute($reset_formula,array($new_bpoints,$new_money,$id));
					
					
					$check_for_memb_id = $core_db2->Execute("Select ".MU_COINS_USERID_COLUMN." from ".MU_COINS_TABLE." where ".MU_COINS_USERID_COLUMN."=?",array($user_auth_id));
					if($check_for_memb_id->EOF){
						$set_credits = $core_db2->Execute("insert into ".MU_COINS_TABLE." (".MU_COINS_USERID_COLUMN.",".MU_COINS_COLUMN.")VALUES(?,?)",array($user_auth_id,$new_bcredits));
					}else{
						$set_credits = $core_db2->Execute("Update ".MU_COINS_TABLE." set ".MU_COINS_COLUMN."=".MU_COINS_COLUMN."+?  where ".MU_COINS_USERID_COLUMN."=?",array($new_bcredits,$user_auth_id));
					}
 													
 													
					if($exc_reset_formula && $set_credits){
						echo msg('1','Character successfully grand reseted.');
					}else{
						echo msg('0','Unable to grand reset, reason: system error, please contact administrator.');
					}
				}
			}
		}
	}
	echo '</div>';
}

echo '<div style="margin-top: 20px;">
<fieldset><legend>Reset Character Requirements</legend>
<table border="0" cellspacing="4" cellpadding="0" width="100%" style="padding-left: 10px;">
<tr>
<td align="left"><b>Resets:</b></td>
<td align="left" width="100%">'.$reset_resets_need.'</td>
</tr>
<tr>
<td align="left"><b>Level:</b></td>
<td align="left" width="100%">'.$reset_level.'</td>
</tr>
<tr>
<td align="left"><b>Zen:</b></td>
<td align="left" width="100%">'.number_format($reset_zen).'</td>
</tr>
<tr>
<td align="left"><b>Resets Limit:</b></td>
<td align="left" width="100%">'.number_format($reset_limit).'</td>
</tr>
</table>
</fieldset>
</div>

<div style="margin-top: 10px;">
<fieldset><legend>Reset Formula</legend>
<table border="0" cellspacing="4" cellpadding="0"  style="padding-left: 10px; padding-right: 10px;">
<tr>
<td align="left" width="130" valign="top"><b>Credits Bonus:</b></td>
<td align="left">';
switch ($reset_credits_formula){
	case '0': echo number_format($reset_credits);  break;
	case '1': echo '('.number_format($reset_credits).'* grand resets number) - The * amount between credits bonus witch is '.number_format($reset_credits).' and number of grand resets that your character have.'; break;
}

echo '</td>
</tr>

<tr>
<td align="left" width="130" valign="top"><b>Levelup Bonus Points:</b></td>
<td align="left">';
switch ($reset_points_formula){
	case '0': echo number_format($reset_points);  break;
	case '1': echo '('.number_format($reset_points).'* resets number) - The * amount between levelup bonus points witch is '.number_format($reset_points).' and number of resets that your character have.'; break;
}

echo '</td>
</tr>
<tr>
<td align="left"><b>Clear Skills:</b></td>
<td align="left">';
switch ($reset_clear_skills){
	case '0': echo 'No'; break;
	case '1': echo 'Yes'; break;
}
echo '</td>
</tr>
<tr>
<td align="left"><b>Clear Inventory:</b></td>
<td align="left">';
switch ($reset_clear_inv){
	case '0': echo 'No'; break;
	case '1': echo 'Yes'; break;
}
echo '</td>
</tr>
<tr>
<td align="left"><b>Reset Stats:</b></td>
<td align="left">';
switch ($reset_stats){
	case '0': echo 'No'; break;
	case '1': echo 'Yes'; break;
}
echo '</td>
</tr>
</table>
</fieldset>
</div>
';

$select_characters = $core_db->Execute("Select mu_id,name,clevel,class,resets,money,grand_resets from character where accountid=? order by clevel desc ",array($user_auth_id));

echo '<table border="0" cellspacing="4" cellpadding="0" width="100%" style="margin-top: 10px; margin-bottom: 10px;">';
while (!$select_characters->EOF){
	if($select_characters->fields[4] < $reset_resets_need && $select_characters->fields[2] < $reset_level && $select_characters->fields[5] < $reset_zen){
		$lacking_error = '<span class="iR_func_status_lacking">lacking '.($reset_resets_need - $select_characters->fields[5]).' resets, '.($reset_level - $select_characters->fields[2]).' level and '.number_format($reset_zen - $select_characters->fields[5]).' zen</span>';
		
	}elseif ($select_characters->fields[4] < $reset_resets_need){
		$lacking_error = '<span class="iR_func_status_lacking">lacking '.($reset_resets_need - $select_characters->fields[4]).' resets</span>';
	}elseif ($select_characters->fields[2] < $reset_level){
		$lacking_error = '<span class="iR_func_status_lacking">lacking '.($reset_level - $select_characters->fields[2]).' level</span>';
	}elseif ($select_characters->fields[5] < $reset_zen){
		$lacking_error = '<span class="iR_func_status_lacking">lacking '.number_format($reset_zen - $select_characters->fields[5]).' zen</span>';
	}else{
		
		$lacking_error = '<input type="button" value="Grand Reset Character" onclick="ask_url(\'Are you sure?\',\''.$core_run_script.'&rid='.$select_characters->fields[0].'\');">';
	}
	
	echo '
  <tr>
    <td width="66" rowspan="2"><img src="template/'.$core['config']['template'].'/images/class/'.decode_class($select_characters->fields[3],'2').'" width="66" height="66" title="Class"></td>
    <td align="left" class="iR_name" width="100">'.htmlentities($select_characters->fields[1]).'</td>
    <td align="left" class="iR_stats">Level: '.$select_characters->fields[2].'</td>
    <td align="left" class="iR_stats">Zen: '.number_format($select_characters->fields[5]).'</td>
    <td align="left" class="iR_stats">Resets: '.$select_characters->fields[4].'</td>
    <td align="left" class="iR_stats">Grand Resets: '.$select_characters->fields[6].'</td>
  </tr>
  <tr>
    <td algin="left" class="iR_class">'.decode_class($select_characters->fields[3]).'</td>
    <td colspan="4" class="iR_func_status" align="left">'.$lacking_error.'</td>
  </tr>
  <tr>
    <td colspan="6" class="iRg_line_top">&nbsp;</td>
  </tr>
	
	
	
  ';
	
	$select_characters->MoveNext();
}

echo '</table>';
}

?>