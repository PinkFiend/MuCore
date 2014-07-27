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
if(isset($_POST['settings'])){
	$ip_list = ereg_replace("\n\r",'',$_POST['filter_ip_list']);
	$ip_list = ereg_replace("\n",',',$ip_list);
	$ip_list = create_list($ip_list);
	$ip_list_final = explode(",",$ip_list);
	foreach ($ip_list_final as $ip){
			$ip_final .='\''.$ip.'\',';
	}
    require('../engine/filter_ip.php');
	$new_db = fopen("../engine/filter_ip.php", "w");
	$data = "<?\r\n";
	$data .="\$core['config']['filter_ip'] = \"".$core['config']['filter_ip'] ."\";\r\n"; 
	$data .="\$core['config']['filter_ip_list'] = array(".create_list($ip_final).");\r\n"; 
	$data .="?>";
	fwrite($new_db,$data);
	fclose($new_db);
	echo notice_message_admin('Settings successfully saved',1,0,'index.php?get=filter_ip');
}else{
	if(isset($_POST['module_active'])){
		require('../engine/filter_ip.php');
		foreach ($core['config']['filter_ip_list'] as $ip_list){
			$ip_final .='\''.$ip_list.'\',';
			
		}
		$new_db = fopen("../engine/filter_ip.php", "w");
		$data = "<?\r\n";
		$data .="\$core['config']['filter_ip'] = \"".$_POST['module_active']."\";\r\n"; 
		$data .="\$core['config']['filter_ip_list'] = array(".create_list($ip_final).");\r\n"; 
		$data .="?>";
		fwrite($new_db,$data);
		fclose($new_db);	
		}
		require('../engine/filter_ip.php');
		echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">NEVER TURN THE FIREWALL OFF!</td>
</tr>
<tr>';
		if($core['config']['filter_ip'] == '1'){
			echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Firewall is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Firewall Off"><input type="hidden" name="module_active" value="0">';
		
			
		}elseif ($core['config']['filter_ip'] == '0'){
			echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Firewall is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Firewall On"><input type="hidden" name="module_active" value="1">';
		}
		echo '</td>
</tr>

</table>
</form>';
		
		echo '
<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">IP Filter</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Banned IP Addresses</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Use this option to prevent certain IP addresses from accessing your website.<br<br>Place a <b>line break</b> between each IP address.<br>e.g: <br>127.0.0.1<br>127.0.0.2<br>127.0.0.3
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="6" name="filter_ip_list">';
		
		foreach ($core['config']['filter_ip_list'] as $filter_ip_list){
			echo $filter_ip_list."\n";
			
		}
		echo '</textarea></td>
</tr>

<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>
';
		
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