<?php
//======================CONFIG START ==============================//
$fname = "hacks.txt";	// cheat log file
$maxsize = 100000;		// Maximum log size in bytes
$logactive = 1;			// 1 = Enable log, 0 = Disable log
$maxlogcount = 20;		// Maximum log files before autopurge start.

//====================== CONFIG END  ==============================//
$ip = $_SERVER['REMOTE_ADDR'];
$time = date("d-m-Y H:i");

$id = $_GET['id']*1;
$obj = $_GET['obj'];

if($id == 17){ $obj = $obj * 1; }

//======================Memory Cheat DB============================//
$cname_[0] = "Speed Gear";
$cname_[1] = "Simple Hithack";
$cname_[2] = "Moonlight Engine";
$cname_[3] = "Moonlight Engine";
$cname_[4] = "Moonlight Engine";
$cname_[5] = "Moonlight Engine";
$cname_[6] = "Moonlight Engine";
$cname_[7] = "Moonlight Engine";
$cname_[8] = "Moonlight Engine";
$cname_[9] = "Moonlight Engine";
$cname_[10] = "Moonlight Engine";
$cname_[11] = "Moonlight Engine";
$cname_[12] = "Moonlight Engine";
$cname_[13] = "Moonlight Engine";
$cname_[14] = "Moonlight Engine";
$cname_[15] = "Quick Memory Editor";
$cname_[16] = "xspeednet";
$cname_[17] = "Noob Hack";
$cname_[18] = "Artmoneypro";
$cname_[19] = "ModzMu";
$cname_[20] = "Injector";
$cname_[21] = "Hasty MU";
$cname_[22] = "Catastrophe";
$cname_[23] = "Speed Net";
$cname_[24] = "Speed Net";
$cname_[25] = "UoPilot";
$cname_[26] = "SpeederXP";
$cname_[27] = "Auto Q";
$cname_[28] = "Speed Net";
$cname_[29] = "SND BOT";
$cname_[30] = "Hasty MU";
$cname_[31] = "!xSpeed.net";
$cname_[32] = "HastyMu";
$cname_[33] = "MuPie";
$cname_[34] = "DKAEMultiStrike";
$cname_[35] = "DKAEMultiStrike";
$cname_[36] = "rPE Packet Editor";
$cname_[37] = "Catastrophe";
$cname_[38] = "Catastrophe";
$cname_[39] = "Catastrophe";
$cname_[40] = "WPePro";
$cname_[41] = "WPePro";
$cname_[42] = "WPePro";
$cname_[43] = "WPePro";
$cname_[44] = "Permit";
$cname_[45] = "Permit";
$cname_[46] = "T Search";
$cname_[47] = "T Search";
$cname_[48] = "Speed Gear";
$cname_[49] = "Speed Gear";
$cname_[50] = "WildProxy";
$cname_[51] = "WildProxy";
$cname_[52] = "WildProxy";
$cname_[53] = "WildProxy";
$cname_[54] = "WildProxy";
$cname_[55] = "WildProxy";
$cname_[56] = "WildProxy";
$cname_[57] = "WildProxy";
$cname_[58] = "Speed Hack Simplifier 1.0";
$cname_[59] = "Cheat Happens";
$cname_[60] = "Cheat Happens";
$cname_[61] = "Cheat Happens";
$cname_[62] = "Cheat Happens";
$cname_[63] = "!xSpeed.net";
$cname_[64] = "!xSpeed.net";
$cname_[65] = "!xSpeed.net";
$cname_[66] = "Cheat Engine";
$cname_[67] = "Cheat Engine";
$cname_[68] = "Cheat Engine";
$cname_[69] = "Cheat Engine";
$cname_[70] = "Cheat Engine";
$cname_[71] = "Cheat Engine";
$cname_[72] = "Cheat Engine";
$cname_[73] = "Cheat Engine";
$cname_[74] = "Cheat Engine";
$cname_[75] = "Cheat Engine";
$cname_[76] = "Cheat Engine";
$cname_[77] = "UoPilot";
$cname_[78] = "Speed Hack";
$cname_[79] = "SpotHack";
$cname_[80] = "MJB DL Bot";
$cname_[81] = "HahaMu";
$cname_[82] = "Game Speed Changer";
$cname_[83] = "eXpLoRer";
$cname_[84] = "Xelerator";
$cname_[85] = "Capotecheat";
$cname_[86] = "Cheat4Fun";
$cname_[87] = "AutoBuff";
$cname_[88] = "HastyMu";
$cname_[89] = "MuPie";
$cname_[90] = "MuPie";
$cname_[91] = "Lipsum";
$cname_[92] = "FunnyZhyper";
$cname_[93] = "MuPie";
$cname_[94] = "Auto_Buff";
$cname_[95] = "Auto_Buff";
$cname_[96] = "HYBRID AEBOT";
$cname_[97] = "Jewel Drop Beta";
$cname_[98] = "Chaos Bot";
$cname_[99] = "MU-SS4 Speed Hack";
$cname_[100] = "Hit Count";
$cname_[101] = "Dizzys Auto Buff";
$cname_[102] = "GodMode";
$cname_[103] = "Mu Cheater";
$cname_[104] = "MU Utilidades";
$cname_[105] = "MuBot";
$cname_[106] = "Snd Bot";
$cname_[107] = "SpotHack";
$cname_[108] = "Godlike";
$cname_[109] = "Godlike";
$cname_[110] = "Mu Philiphinas Cheat";
$cname_[111] = "Packet Editor";
$cname_[112] = "D-C DupeHack";
$cname_[113] = "Auto Combo";
$cname_[114] = "AIO Bots";
$cname_[115] = "Nsauditor";
$cname_[116] = "Super Bot";
$cname_[117] = "Ultimate Cheat";
$cname_[118] = "ArtMoney";
$cname_[119] = "JoyToKey";
$cname_[120] = "Codez";
$cname_[121] = "Mush";
$cname_[122] = "NoNameMini";
$cname_[123] = "Tablet2";
$cname_[124] = "Dupe-Full  ";
$cname_[125] = "Wall";
$cname_[126] = "Process Explorer";
$cname_[127] = "HastyMu";
$cname_[128] = "Perfect AutoPotion";
$cname_[129] = "Ghost mouse";
$cname_[130] = "CPCH";
$cname_[131] = "GOP";
$cname_[132] = "Sandbox";
$cname_[133] = "GOP";
$cname_[134] = "GzL MultiHack";
$cname_[135] = "DK-DW-MG";
//==================================Case Error===========================================//
$case_[1] = "Client closed, muguard case 001. Hint: Run client with admin level.";
$case_[2] = "Client closed, muguard case 002, main.dat is missing.";
$case_[3] = "Client closed, muguard case 003, $obj is missing.";
$case_[4] = "Client closed, muguard case 004, $obj is altered.";
$case_[5] = "Client closed, muguard case 005. Hint: Avoid replacing muguard files.";
$case_[6] = "Client closed, muguard case 006. Hint: Avoid replacing main.";
$case_[7] = "Client closed, muguard case 007, muguard system file missing.";
$case_[8] = "Client closed, muguard case 008, muguard system file missing.";
$case_[9] = "Client closed, muguard case 009, muguard system file missing.";
$case_[10] = "Client closed, muguard case 010, muguard system file missing.";
$case_[11] = "Client closed, muguard case 011, muguard system file altered.";
$case_[12] = "Client closed, muguard case 012, muguard system file altered.";
$case_[13] = "Client closed, muguard case 013, muguard system file altered.";
$case_[14] = "Client closed, muguard case 014, muguard system file altered.";
$case_[15] = "Client closed, muguard case 015. Hint: Avoid replacing muguard files.";
$case_[16] = "Client closed, muguard case 016.";
$case_[17] = "Client closed, muguard case 017, ".$cname_[$obj]."($obj) fingerprint detected.";
$case_[18] = "Client closed, muguard case 018, $obj fingerprint detected.";
$case_[19] = "Client closed, muguard case 019.";
$case_[20] = "Client closed, muguard case 020.";
$case_[21] = "Client closed, muguard case 021.";
$case_[22] = "Client closed, muguard case 022.";
$case_[23] = "Client closed, muguard case 023.";
$case_[24] = "Client closed, muguard case 024.";
$case_[25] = "Client closed, muguard case 025.";
$case_[26] = "Client closed, muguard case 026.";
$case_[27] = "Client closed, muguard case 027, you have to uninstall $obj from your system.";
$case_[28] = "Client closed, muguard case 028, main instance is restricted to one only.";
// id=%d&obj=%s",weburl,cid,cobj

//==================================Cycle log files======================================//
if($logactive==1 && $case_[$id] != ''){

	$fsize = filesize($fname);

	if($fsize >= $maxsize){
	
		for($i=0;$i < $maxlogcount;$i++){
		
		$y = 0;
		$maxlog_ = $maxlogcount - 1;
		
			if(file_exists($fname."_".$maxlog_.".txt")){
			
				for($x=0; $x < ($maxlogcount+1); $x++){
					if(!file_exists($fname."_".$x.".txt")){
					$y = $x;
					}
				}
				unlink($fname."_".$y.".txt");
					if($y == $maxlogcount){
					$n = 0;
					}else{
					$n = $y + 1;
					}
				unlink($fname."_".$n.".txt");
				rename($fname,$fname."_".$y.".txt");
				$i = $maxlogcount;
				break;				
			}else{
				if(!file_exists($fname."_".$i.".txt")){
				rename($fname,$fname."_".$i.".txt");
				$i = $maxlogcount;
				break;
				}
			}
		}
	}
//=======================================Record logs=============================================//
	$fp = fopen($fname,"a+");
	$d .= "Source IP - ".$ip."\n";
	$d .= "Message - ".$case_[$id]."\n";
	$d .= "Time - ".$time."\n";
	$d .= "--------------------------------------------------\n";
	fwrite($fp,$d,strlen($d));
	fclose($fp);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MuGuard Warning</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #0000FF}
-->
</style>
</head>

<body>
<h2 align="center" class="style1"><?php echo $case_[$id]; ?></h2>
<p align="center" class="style2">Source Address : <?php echo $ip; ?></p>
</body>
</html>
