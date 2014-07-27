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
if(isset($_GET['mod'])){
	if($_GET['mod'] == 'new'){
		if(isset($_POST['new'])){
			if(empty($_POST['agm_id']) || empty($_POST['agm_pwd']) || empty($_POST['agm_nick'])){
				echo notice_message_admin('Error some fields where left blank.','0','1','0');
			}else{
				if($_POST['ban_manager'] == '1'){
					$ban_manager = '1';
				}else{
					$ban_manager = '0';
				}
				
				if($_POST['credits_manager'] == '1'){
					$credits_manager = '1';
				}else{
					$credits_manager = '0';
				}
				
				$db = fopen("../engine/agm.users/agmcp.users", "a+");
				fwrite($db,uniqid()."¦".str_replace("¦","",stripslashes($_POST['agm_id']))."¦".str_replace("¦","",stripslashes(md5($_POST['agm_pwd'])))."¦".str_replace("¦","",stripslashes($_POST['agm_nick']))."¦".$ban_manager."¦".$credits_manager."¦".$_POST['coins']."¦".$_POST['coins_day']."¦".(time()+($_POST['coins_day']*86400))."¦".$_POST['coins']."¦".$_POST['agm_ip']."¦\r\n");
				fclose($db);
				echo notice_message_admin('AGM Access successfully added',1,0,'index.php?get=agm_panel');	
				
			}
			
		}else{
			echo '<form action="" method="POST" name="form">
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
	 <td align="center" class="panel_title" colspan="2">Add AGM Access</td>
	</tr>
	<tr>

	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Access ID</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter AGM ID, with this GM will be able to log in. Use only letters and numbers.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_id" ></td>
	</tr>
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Access Password</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter GM  Access Password, with this GM will be able to log in. Use only letters and numbers.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_pwd" ></td>
	</tr>
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Restrict IP Address</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">If ip address present, GM can login only from that ip address. Leave it blank if you dont want ip restriction.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_ip" ></td>
	</tr>
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Nickname</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter GM Nickname.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_nick" ></td>
	</tr>
	
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Advanced Game Masters Options</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%" valign="top">Select modules permissions for GM.</td>
	<td align="left" class="panel_text_alt2" width="50%">
	<label><input type="checkbox" name="ban_manager" value="1"> Ban Manager</label><br>
	<label><input type="checkbox" name="credits_manager" value="1"> MU Coins Manager</label><br>
	</td>
	</tr>
	</table>
	
	
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
	 <td align="center" class="panel_title" colspan="2">MU Coins Manager Options</td>
	</tr>
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">MU Coins Amount and Spent Time</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter the amount of mucoins/credits a gm can issue in days.<br><br>E.g. 600 coins in one day : means he is only allowed to issue a total of 600 coins/credits in 1 day.</td>
	<td align="left" class="panel_text_alt2" width="50%" valign="top">MU Coins : <input type="text"  name="coins" value="0" size="6"> Days : <input type="text"  name="coins_day" size="4" value="1"></td>
	</tr>
</table>
	
	
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
	<td align="center" class="panel_buttons" colspan="2">
	<input type="hidden" name="new">
	<input type="submit" value="Add GM Access"></td>
	</tr>
	
	</table>
	</form>';
		}
	}elseif ($_GET['mod'] == 'edit'){
		$p_id = safe_input(xss_clean($_GET['id']),'_');
		$p_file = file('../engine/agm.users/agmcp.users');
			foreach ($p_file as $check_id){
				$check_id = explode("¦",$check_id);
				if($check_id[0] == $p_id){
					$p_id_found = '1';
					$agm_id = $check_id[0];
					$agm_id_access = $check_id[1];
					$agm_pwd = $check_id[2];
					$agm_nick = $check_id[3];
					$agm_ban_manager = $check_id[4];
					$agm_credits_manager = $check_id[5];
					$agm_coins = $check_id[6];
					$agm_coins_day = $check_id[7];
					$agm_coins_days_left = $check_id[8];
					$agm_coins_preset = $check_id[9];
					$agm_ip = $check_id[10];
					break;
				}
			}
		if(isset($_POST['edit'])){
			if(empty($_POST['agm_id']) || empty($_POST['agm_nick'])){
				echo notice_message_admin('Error some fields where left blank.','0','1','0');
			}else {
				if(empty($_POST['agm_pwd'])){
					$agm_pass = $agm_pwd;
				}else{
					$agm_pass = md5($_POST['agm_pwd']);
				}

				if($_POST['ban_manager'] == '1'){
					$ban_manager = '1';
				}else{
					$ban_manager = '0';
				}
				
				if($_POST['credits_manager'] == '1'){
					$credits_manager = '1';
				}else{
					$credits_manager = '0';
				}
				
				$old_db = file("../engine/agm.users/agmcp.users");
				$new_db = fopen("../engine/agm.users/agmcp.users", "w");
				foreach($old_db as $old_db_line){
					$old_db_arr = explode("¦", $old_db_line);
					if($p_id != $old_db_arr[0]){
			    		fwrite($new_db,"$old_db_line");
			    	}else{
			    		fwrite($new_db,$agm_id."¦".str_replace("¦","",stripslashes($_POST['agm_id']))."¦".str_replace("¦","",stripslashes($agm_pass))."¦".str_replace("¦","",stripslashes($_POST['agm_nick']))."¦".$ban_manager."¦".$credits_manager."¦".$agm_coins_preset."¦".$_POST['coins_day']."¦".$agm_coins_days_left."¦".$_POST['coins']."¦".$_POST['agm_ip']."¦\r\n");
			    	}
			    }
			    fclose($new_db);
			    echo notice_message_admin('GM Acces successfully edited',1,0,'index.php?get=agm_panel');
				
			}
			
		}else{
				echo '<form action="" method="POST" name="form">
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
	 <td align="center" class="panel_title" colspan="2">Edit GM Access</td>
	</tr>
	<tr>

	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Access ID</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter GM ID, with this GM will be able to log in. Use only letters and numbers.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_id" value="'.$agm_id_access.'"></td>
	</tr>
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Access Password</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter GM  Access Password, with this GM will be able to log in. Use only letters and numbers.<br><br><b>Note: Leave it blank if you don\'t want to change it.</b></td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_pwd" ></td>
	</tr>
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Restrict IP Address</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">If ip address present, GM can login only from that ip address. Leave it blank if you dont want ip restriction.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_ip" value="'.$agm_ip.'"></td>
	</tr>	
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Nickname</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter GM Nickname.</td>
	<td align="left" class="panel_text_alt2" width="50%"><input type="text"  name="agm_nick" value="'.$agm_nick.'"></td>
	</tr>
	
	
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">Game Masters Options</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Select modules permissions for GM.</td>
	<td align="left" class="panel_text_alt2" width="50%">
	<label><input type="checkbox" name="ban_manager" value="1"'; if($agm_ban_manager == '1'){echo 'checked'; } echo '> Ban Manager</label><br>
	<label><input type="checkbox" name="credits_manager" value="1"'; if($agm_credits_manager == '1'){echo 'checked'; } echo '> MU Coins Manager</label><br>
	</td>
	</tr>
	</table>
	
	
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
	 <td align="center" class="panel_title" colspan="2">MU Coins Manager Options</td>
	</tr>
	<tr>
	<td align="left" class="panel_title_sub" colspan="2">MU Coins Amount and Spent Time</td>
	</tr>
	<tr>
	<td align="left" class="panel_text_alt1" width="50%">Enter the amount of mucoins/credits a gm can issue in days.<br><br>E.g. 600 coins in one day : means he is only allowed to issue a total of 600 coins/credits in 1 day.</td>
	<td align="left" class="panel_text_alt2" width="50%" valign="top">MU Coins : <input type="text"  name="coins" value="'.$agm_coins_preset.'" size="6"> Days : <input type="text"  name="coins_day" size="4" value="'.$agm_coins_day.'"></td>
	</tr>
</table>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
	<td align="center" class="panel_buttons" colspan="2">
	<input type="hidden" name="edit">
	<input type="submit" value="Edit GM Access"></td>
	</tr>
	
	

	</table>
	</form>';
			
		}
	}
	
}else{
	if(isset($_GET['delete'])){
		$p_id = safe_input(xss_clean($_GET['delete']),'_');
		delete_variable('../engine/agm.users/agmcp.users','0',$p_id,'¦');
		echo notice_message_admin('GM Access successfully deleted',1,0,'index.php?get=agm_panel');
		
	}else{
		echo '
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="5">GM Control Panel Access List</td>
</tr>
<tr>
<td align="left" class="panel_title_sub2">GM ID</td>
<td align="left" class="panel_title_sub2">Nickname</td>
<td align="left" class="panel_title_sub2">Ban Manager Access</td>
<td align="left" class="panel_title_sub2">MU Coins Manager Access</td>
<td align="left" class="panel_title_sub2">Controls</td>
</tr>';
		$agm_file = array_reverse(file('../engine/agm.users/agmcp.users'));
		$count=0;
		foreach ($agm_file as $agm){
			$agm = explode("¦",$agm);
			$count++;
			$tr_color = ($count % 2) ? '' : 'even'; 
			
			
			switch ($agm[4]){
				case '1': $ban_manager = '<b>Yes</b>'; break;
				case '0': $ban_manager = '<em>No</em>'; break;
			}
		
			switch ($agm[5]){
				case '1': $credits_manager = '<b>Yes</b>'; break;
				case '0': $credits_manager = '<em>No</em>'; break;
			}
			
			echo '<tr class="'.$tr_color.'">
			<td align="left" class="panel_text_alt_list" width="150"><b>'.$agm[1].'</b></td>
			<td align="left" class="panel_text_alt_list" width="150"><b>'.$agm[3].'</b></td>
			<td align="left" class="panel_text_alt_list" width="150">'.$ban_manager.'</td>
			<td align="left" class="panel_text_alt_list" width="150">'.$credits_manager.'</td>
			<td align="left" class="panel_text_alt_list" width="80"><a href="index.php?get=agm_panel&mod=edit&id='.$agm[0].'">[Edit]</a> / <a href="javascript:;" onclick="ask_url(\'Are you sure you want to delete this GM Access?\',\'index.php?get=agm_panel&delete='.$agm[0].'\')";>[Delete]</a></td>
			</tr>';
		}
		if($count == '0'){
			echo '<tr><td align="center" class="panel_text_alt_list" colspan="5"><em>No gm access</em></td></tr>';
		}
		echo '<tr>
<td align="center" class="panel_buttons" colspan="5">
<input type="button" value="Add New AGM Access" onclick="location.href=\'index.php?get=agm_panel&mod=new\'"></td>
</tr></table>';
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