<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?=build_header_seo(); ?>
<title><?=build_header_title(); ?></title>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script src="js/core_global.js" language="javascript" type="text/javascript"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, textarea, blockquote, object, iframe { padding: 0; margin: 0; font:normal 12px Arial, Helvetica, sans-serif; color:#375264; font-weight:normal; line-height:150%;

}
a { font:normal 12px Arial, Helvetica, sans-serif; color:#375264; text-decoration:underline; }

a:hover { text-decoration: none;}

ol, ul { list-style: none; }


fieldset{
background: #ffffff;
border: 1px solid #cccccc;
}

legend{
background: #ECECFF;
border: 1px solid #cccccc;
font: bold 11px Arial, Helvetica, sans-serif;
margin-left: 5px;
}

body { background:#0D1517 url(template/<?=$core['config']['template'] ?>/images/tmp_bg.jpg) no-repeat top; margin:0; padding: 0 }

.top_shadow{
	height:10px;
	background:url(template/<?=$core['config']['template'] ?>/images/top_shadow.jpg) repeat-x top;}
	
.bottom_shadow{
	height:14px;
	background:url(template/<?=$core['config']['template'] ?>/images/bottom_shadow.jpg) repeat-x top;}



ul#menu{
	margin:0;
	padding:0px 0px 0px 85px;
	list-style-type:none;
	width:auto;
	position:relative;
	display:block;
	height:38px;
	text-transform:uppercase;
	font-size:12px;
	font-weight:bold;
	background:transparent url("template/<?=$core['config']['template'] ?>/images/button_bg.jpg") repeat-x top left;
	font-family:Arial, Helvetica, sans-serif;
	
}

ul#menu li{
	display:block;
	float:left;
	margin:0;
	pading:0;
	height:38px;
}


ul#menu li a{
	display:block;
	float:left;
	color:#ffffcc;
	text-decoration:none;
	font-weight:bold;
	padding:10px 16px 0 10px;
	
	background:transparent url("template/<?=$core['config']['template'] ?>/images/sep.jpg") no-repeat top right; 
	}


ul#menu li a:hover{
	background:transparent url("template/<?=$core['config']['template'] ?>/images/hover.jpg") no-repeat top right;
	color:#FFF;
	}
.style1 {color: #B53452}



#tmp_main { width:990px; margin:auto; background-color:#0E1819; border:1px #262E30 solid; padding-bottom:5px; }
.tmp_nav { background:url(template/<?=$core['config']['template'] ?>/images/nav_bg.jpg); width:976px; height:34px; margin:auto; margin-top:3px; margin-bottom:10px; }
.tmp_nav ul { margin-left:20px; }
.tmp_nav li { float:left; background:url(template/<?=$core['config']['template'] ?>/images/nav_mark.gif) no-repeat left top; padding-left:15px; padding-right:10px; height:34px; }
.tmp_nav .menu { color:#ddd; font:bold 14px Arial, Helvetica, sans-serif; line-height:34px; }
.tmp_nav .menu a { color:#ddd; font:bold 14px Arial, Helvetica, sans-serif; line-height:34px; text-decoration:none }
.tmp_nav .menu a:hover { color:#FC0; }
.tmp_nav li:hover { background:url(template/<?=$core['config']['template'] ?>/images/nav_hover_bg.gif) no-repeat left; }


.tmp_main_content { width:auto; margin:5px 5px 0 5px; background-color:#2F343A; }

.tmp_left_side { background-color:#1E2628;   padding-bottom:15px; padding-right: 10px; padding-left: 10px; }

.tmp_left_title { background:url(template/<?=$core['config']['template'] ?>/images/left_title_bg.gif); background-repeat:repeat-x; margin-top:5px; font:bold 16px/33px Arial, Helvetica, sans-serif; text-align:center; color:#fff }




.tmp_left_menu {  margin:0 auto; border:1px #3F4854 solid; padding:1px; }
.tmp_left_menu a { color:#FFFFFF; font:normal 12px Arial, Helvetica, sans-serif; }
.tmp_left_menu a:hover { color:#fc0; text-decoration:none }
.tmp_left_menu ul { border:1px #8D8585 solid; background-color:#8D8585; }
.tmp_left_menu li.list_menu { height:22px; line-height:22px; border-bottom:1px #171D24 solid; color:#eee; background:#434B4C url(template/<?=$core['config']['template'] ?>/images/bullet.gif) no-repeat 20px; padding-left:35px; margin-bottom:1px; }
.tmp_left_menu li.list_menu a { line-height:22px; zoom:1; }
.tmp_left_menu li.list_menu:hover { background-color:#3D1F1F; }

.tmp_left_m {
border-bottom: 1px solid #33302e;
border-right: 1px solid #33302e;
background:#1e1c1b;
padding: 4px;
font: 12px arial, verdana, sans-serif;
color: #ffffff;
}

.tmp_left_m  a{
color:#ffffff;
text-decoration:none;
}

.tmp_left_m  a:hover{
color:#fc0;
text-decoration:none;
}


.yellow  a{
color:#fc0;
text-decoration:none;
}

.yellow  a:hover{
color:#fffff;
text-decoration:none;
}





.right_page_content { font:normal 12px/24px Arial, Helvetica, sans-serif; color:#375264; margin-left:2px; margin-right:2px; margin-bottom: 5px;}
.right_page_content a{color:#fc0; text-decoration:underline;}
.right_page_content a:hover{color:#fc0; text-decoration:none;}

.tmp_right_side { background-color:#505D60; border:1px #5C756E solid; padding:3px;}
.tmp_right_content { width: 100%; background-color:#FFFFFF; }
.tmp_m_content { background-color:#F1F4F9; border:1px #C5CBD0 solid; margin:4px; padding:2px; margin-bottom: 10px;}
.tmp_m_content .tmp_right_title { background-color:#1E2627; height:30px; position:relative; font:normal 18px/30px Georgia; color:#FFFFFF; padding-left:15px; }

.tmp_m_content .tmp_page_content { font:normal 12px/24px Arial, Helvetica, sans-serif; color:#375264; margin:5px; }


.tmp_m_content .tmp_right_title_ann { background-color:#1E2627; height:20px; position:relative; font:bold 15px/20px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif; color:#FFFFFF; padding-left:15px; }
.tmp_m_content .tmp_page_content_ann { font:normal 12px/24px Arial, Helvetica, sans-serif; color:#375264; margin:5px; }
.ann_date { font:normal 11px/24px Arial, Helvetica, sans-serif; color:#555555; }




/*
.tmp_m_content .tmp_page_content a { font:normal 12px/24px Arial, Helvetica, sans-serif; color:#375264; text-decoration:none }
.tmp_m_content .tmp_page_content a:hover { color:#79442F; text-decoration:underline }
*/




.login_field{
background: #4A5952;
border: 0px;
height: 20px;
width: 120px;
color: #222222;
font: bold 11px "Tahoma", Arial, Helvetica, sans-serif;
}

.tmp_advertise { margin-bottom: 20px; width:728px; height:90px; border:2px #6A5151 solid; }

#tmp_nav_header{ text-align:center; height:31px; background:url(template/<?=$core['config']['template'] ?>/images/nav_header_bg.gif) 0 0 repeat-x; font-family:Arial, Helvetica, sans-serif; font-size:11px;}
#tmp_nav_header_menu { width:990px; margin:0 auto; text-align:left; height:28px; padding:1px 0 2px 0; background:url(template/<?=$core['config']['template'] ?>/images/nav_header_bg.gif) 0 0 repeat-x; position:relative;z-index:9999;}



#welcome_stats{float:left; padding-left:5px;  color:#ded1c4; line-height:28px;}
#welcome_stats a {color: #ded1c4; text-decoration: underline;}
#welcome_stats a:hover {color: #ffffff; text-decoration: none;}


#tmp_header_menu{ float:right; padding-right:10px;}
#tmp_header_menu ul li { float:left; height:28px; line-height:28px; padding:0 10px; background:url(template/<?=$core['config']['template'] ?>/images/nav_header_hover.gif) right bottom no-repeat;}
#tmp_header_menu li a { color:#ded1c4; text-decoration: none;}
#tmp_header_menu li a:hover { color:#fff; text-decoration: underline;}	


.where_nav{
margin:4px; padding:2px;
font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
color: #ffffff;
}


/*
MUCore Css Start
*/
.where_nav a{
color: #ffffff;
text-decoration: underline;
}

.where_nav a:hover{
color: #ffffff;
text-decoration: none;
}

.iN_title{
font-size:17px;
font-weight:bold;

}

.iN_title_mirror{

font-size:17px;
font-weight:bold;
color:#990000;
}

.iN_description{
font:11px/14px Arial, Verdana, sans-serif;
color:#777;

}

.iN_download_title{
font:bold 14px/18px arial; color:#898989;
}

.iN_download_cat{
font-size:17px;
font-weight:bold;
color:#990000;
}


.iN_title a{
font-size:17px;
font-weight:bold;
text-decoration: none;
}



.iN_title a:hover{
font-size:17px;
font-weight:bold;
text-decoration: none;
color:#990000;
}


.iN_date{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
color:#666666;
}

.iN_news_table tr:hover{
background: #ffffff;
}

.iN_news_content{
font-family:Georgia, "Times New Roman", Times, serif;
font-size:13px;
color:#333333;
margin:0px;
padding-top: 6px;
}

.iN_news_content a{
font-family:Georgia, "Times New Roman", Times, serif;
font-size:13px;
margin:0px;
text-decoration: underline;
}

.iN_news_content a:hover{
font-family:Georgia, "Times New Roman", Times, serif;
font-size:13px;
margin:0px;
text-decoration: none;
}

.iN_new_read_more{
color:#ffffff; 
font: 10px Arial, Helvetica, sans-serif; 
background: #8b0e0e;

padding: 1px;
}

.iN_new_read_more a{
color: #ffffff;
font-size: 10px;
}
.iRg_text{
font: bold 13px Arial, sans-serif; color: #555555;
}


.iRg_inf{
font: 11px fantasy;  #555555;
}

.iRg_line{
background:url(template/<?=$core['config']['template']; ?>/images/inner_line.jpg); background-position:bottom; background-repeat:repeat-x;
font: 11px fantasy; color: #555555;
padding-bottom: 4px

}

.iRg_line_top{
background:url(template/<?=$core['config']['template']; ?>/images/inner_line.jpg); background-position:top; background-repeat:repeat-x;
font: 11px fantasy; color: #555555;

}

.iR_func_status{
border: 1px solid #cccccc; 
background: #ffffff; 
padding-left: 4px;
font-size: 11px;
}

.iR_func_status_lacking{
background: #CC3300;
padding: 1px; 
padding-left: 3px; 
padding-right: 3px; 
color: #ffffff;
}


.iR_func_status_free{
background: #00FF00; 
padding: 1px; 
padding-left: 3px; 
padding-right: 3px; 
color: #000000;
}

.iR_func_status_free a{
font-size: 11px;
color: #000000;
}



.iRg_inf a{
font: 11px fantasy; 
text-decoration: underline;
}

.iRg_inf a:hover{
font: 11px fantasy;
text-decoration: none;
}


.iRg_input{

font-size: 10pt;
font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
background-color: #ffffff;
border: 1px solid #cccccc;
height: 18px;
}



.iRg_terms_agree{
font:  12px Arial, Verdana, sans-serif; 
}

.iRg_terms_agree a{
font:  12px Arial, Verdana, sans-serif; 
text-decoration: underline;
}

.iR_rank{
background-color: #181C18;
font: bold 11px Georgia, "Times New Roman", Times, serif; color: #ffffff;
}

.iR_stats{
font: 11px Georgia, "Times New Roman", Times, serif; color: #ffffff;
background-color: #5F6D5F;
padding: 1px;
}

.iR_stats_2{
font: 11px Georgia, "Times New Roman", Times, serif; color: #ffffff;
background-color: #CCCCFF;
padding: 1px;
color: #555555;
}




.iR_stats_bg{
background-color: #996600;

}



.iR_stats_level{
border: 1px solid #cccccc;
font: 11px Georgia, "Times New Roman", Times, serif; color: #555555;
background: #ECECFF;
padding: 1px;
}

.iR_stats_reset{
border: 1px solid #cccccc;
font: 11px Georgia, "Times New Roman", Times, serif; color: #555555;
background: #CECEFF;
padding: 1px;
}



.iR_name{
font: bold 13px Arial, sans-serif; color: #FF3300;
}

.iR_class{
font: 12px Impact, fantasy; color: #666666;
}

.iR_status{
font-size: 11px;
}

.iR_task{
font:  11px Georgia, "Times New Roman", Times, serif; 
}

.iR_rank_type{
font: bold 16px Arial, sans-serif; 
}

.iR_rank_type a{
font: bold 16px Arial, sans-serif; 
text-decoration: none;
}

.iR_rank_type a:hover{
font: bold 16px Arial, sans-serif;
text-decoration: none;
color: #990000;
}



.iR_rank_type_sub{
font: 10px fantasy; 
}

.iR_rank_type_sub a{
font: 10px fantasy; 
text-decoration: none;
}

.iR_rank_type_sub a:hover{
font: 10px fantasy; color:#990000;
text-decoration: none;
}




.msg_success{
background: #c2ffaf;
border: 1px solid #cccccc; 
padding: 4px;
padding-left: 33px;
margin-bottom: 6px;
margin-top: 6px;
background-image:url(template/<?=$core['config']['template'] ?>/images/success.gif);
background-repeat:no-repeat;
background-position: 10px;
font-size: 11px;
font-weight: bold;
color: #444444;
}

.msg_error{
background: #F9F2B9;
border: 1px solid #cccccc; 
padding: 4px;

padding-left: 33px;
margin-bottom: 6px;
margin-top: 6px;
background-image:url(template/<?=$core['config']['template'] ?>/images/warning.gif);
background-repeat:no-repeat;
background-position: 10px;
font-size: 11px;
font-weight: bold;
color: #444444;
}


.chat_bg{
border: 1px solid #cccccc; 
background: #ffffff; 
padding: 4px;
font-size: 11px;
}

.chat_even{
background: #D7D7FF;
padding: 2px; 
}

.chat_odd{
padding: 2px; 
}


.warehouse_block{ 
border: 0px;
text-align: center;
background: url(template/<?=$core['config']['template'] ?>/images/warehouse_block.gif);
}

.warehouse_item_block {
border: 0px;
padding: 0px;
text-align: center;
background: url(template/<?=$core['config']['template'] ?>/images/warehouse_item_block.gif);
}

.warehouse_bg {
border: 0px;
padding: 0px;
text-align: center;
background: url(template/<?=$core['config']['template'] ?>/images/warehouse_bg.gif);
}

.item_name{
font: 12px Arial, sans-serif; 
color: #ffffff;
font-weight: bold;
}

.item_dur{
font: 11px Arial, sans-serif; 
color: #ffffff;
}

.item_requirement{
font: 11px Arial, sans-serif; 
color: #ffffff;
}

.item_skill{
font: 11px Arial, sans-serif; 
color: #ffffff;
}

.item_options{
font: 11px Arial, sans-serif; 
color: #ffffff;
}

.iD_dashed{
border-top: #ffffff dashed 1px;
}

.downloads tr:hover{
background: #ffffff;
}


.curent_step{
background: #FFEF73; border: 1px solid #cccccc; 
padding: 2px;
font:bold 11px Arial;
color:#555555;
}

.step{
background: #ECECEC; 
border: 1px solid #cccccc; 
padding: 2px;
font:bold 11px Arial;
color: #D4D4D4;
}

.hidden_password{
border: 1px solid #cccccc; 
background: #ECECEC; 
padding: 2px;
width: 200px;
color: #ECECEC;
}


.footer_font{
font:  normal 11px Tahoma, Calibri, Verdana, Geneva, sans-serif;
color: #ffffff;
}

.footer_font a{
padding-bottom:5px;
font:  normal 11px Tahoma, Calibri, Verdana, Geneva, sans-serif;
color: #ff0000;
text-decoration: none;
}

.footer_font a:hover{
font:  normal 11px Tahoma, Calibri, Verdana, Geneva, sans-serif;
color: #ff0000;
text-decoration: underline;
}

.table_list{
background: #ffffff;
color: #000000;
border: outset 1px #DEE0E2;
}

.table_list .title{
background: #DFDFFF;
font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
padding: 2px;
padding-left: 4px;
color: #595959;
border: outset 1px #555555;
}

.table_list .even{
background: #ECECFF;
}

.table_list .content{
font: 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
padding: 2px;
padding-left: 4px;
}


#rss_feed{
margin-left: 0;
padding-left: 0;
list-style: none;
}

#rss_feed li
{
padding-left: 17px;
background-image: url(template/<?=$core['config']['template'] ?>/images/rss_icon.gif);
background-repeat: no-repeat;
background-position: 0;
}

#rss_feed li a{
text-decoration: none;
}

#rss_feed li a:hover{
text-decoration: underline;
}
.language_select{
margin-top: 4px;
 }

.language_select a{
 font: 11px Arial, Helvetica, sans-serif;
color: #ffffff;
 text-decoration: none;
 }

.language_select a:hover{
font: 11px Arial, Helvetica, sans-serif;
color: #ffffff;
text-decoration: underline;
 }
 
.usercp_module{
font-weight:bold;
background-color:#FF0000;
color: #ffffff;
padding: 2px;
padding-left: 4px;
width: 140px;
}

-->
</style>
</head>

<body>
<?
if($core['config']['on_off'] == '0' || $core['debug'] == '1'){
	if(isset($_SESSION['admin_login_auth'])){
		echo '<div align="center" style="color: red; background-color: white; padding:2px"><b>Warning: The website is currently turned off!</b></div>';
	}

}
echo '<script type="text/javascript">
<!--
var currentTime = new Date();
var c_hours = currentTime.getHours() ;
var c_minutes = currentTime.getMinutes();
time_c_d = c_hours;


function make_header_welcome(time,user,last_msg){
	if(time < \'1\'){
		welcome_start =  "Shouldn\'t you be going to bed soon";
		welcome_end = \'?\';
	}
	else if(time < \'2\'){
		welcome_start =  "Up late, aren\'t we";
		welcome_end = \'?\';
	}
	else if(time < \'4\'){
		welcome_start =  "Having trouble sleeping";
		welcome_end = \'?\';
	}
	else if(time < \'5\'){
		welcome_start =  "Still can\'t sleep";
		welcome_end = \'?\';
	}
	else if(time < \'7\'){
		welcome_start =  "Aren\'t you the early bird";
		welcome_end = \'?\';
	}
	else if(time <\'12\'){
		welcome_start =  "Good morning";
		welcome_end = \'.\';
	}
	else if(time < \'13\'){
		welcome_start =  "Enjoying your lunch break";
		welcome_end = \'?\';
	}
	else if(time < \'17\'){
		welcome_start =  "Good Afternoon";
		welcome_end = \'.\';
	}	
	else if(time < \'18\'){
		welcome_start =  "What\'s for dinner";
		welcome_end = \'?\';
	}
	else if(time < \'22\'){
		welcome_start =  "Good Evening";
		welcome_end =  \'.\';
	}
	else if(time < \'23\'){
		welcome_start =  "Where your children are";
		welcome_end = \'?\';
	}else{
		welcome_start =  "Shouldn\'t you be going to bed soon";
		welcome_end = \'?\';
	}
	document.getElementById(\'welcome_stats\').innerHTML = welcome_start+\', \'+user+welcome_end+last_msg;
}
//-->
</script>';
?>


<div id="tmp_nav_header">
<div id="tmp_nav_header_menu">    

	<div id="welcome_stats">
	
	<?
 if ($user_login == '1') { 
 	echo '<script type="text/javascript">make_header_welcome(time_c_d,\'<a href="">'.$user_auth_id.'</a>\',\'\');</script>';
 }else{
 	echo ''.text_not_loggd_in.', <a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.LOGIN_CMS_PAGE.'">'.text_log_in.'</a>';
 }
?>
	</div>	

	<div id="tmp_header_menu">		
	<ul>	
	<li><a href="http://bizarre-networks.com/" target="_blank">Bizarre Mind Networks</a></li>			
	<li><a href="http://chileplanet.org/" target="_blank">Our Allied Community</a></li>			
	
	</ul>	
	</div>	
	
	</div>
</div>
<div class="wrapper">
<table width="990" border="0" cellspacing="0" cellpadding="0" style="height: 200px; " align="center">

  <tr>
    <td align="center"><img src="template/<?=$core['config']['template'] ?>/images/logo.png"></td>
	<td align="right" width="760" valign="bottom"><table width="0" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    </tr>
	  </table>  
  
    </td>
  </tr>
</table>
<div id="tmp_main">
    <div class="tmp_nav">
  <ul>
    <li class="menu"><a  href="<?=ROOT_INDEX?>"><?=link_home;?></a></li>
    <li class="menu"><a  href="<?=ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.ANNOUNCEMENTS_CMS_PAGE  ?>"><?=link_announcements;?></a></li>
    <li class="menu"><a  href="<?=ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.REGISTER_CMS_PAGE  ?>"><?=link_new_account;?></a></li>
  </ul>
</div>
    <div class="tmp_main_content">

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" >
		  <div class="tmp_left_side" style="width: <?=CMS_STYLE_LEFT_WIDTH;?>px; ">
		  

		  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 15px; ">
		  <tr>
		  <td width="2" height="33"><img src="template/<?=$core['config']['template'] ?>/images/left_title_side.gif" width="2" height="33"></td>
		  <td  class="tmp_left_title"><?=text_member_area; ?></td>
		  <td width="2" height="33"><img src="template/<?=$core['config']['template'] ?>/images/left_title_right.gif" width="2" height="33"></td>
		  </tr>
		  </table>
		  
		  <div class="tmp_left_m">
		  
		  <?
		  if($user_login == '1'){
		  	echo '<div class="tmp_left_menu">
		  	<ul>';
		$m_uss_row_ = get_sort('engine/cms_data/mods_uss.cms','¦');
 	 	$count_m_uss = 0;
		foreach ($m_uss_row_ as $tr){
			explode("¦",$tr);
			$count_m_uss++;
			if($tr[6] == '1'){
				if($tr[3] != ACCOUNTSETTINGS_CMS_USER){
					echo '<li class="list_menu"><a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.USER_CMS_PAGE.'&'.USER_GET_PAGE.'='.$tr[3].'">'.str_replace($menu_links_title,$menu_links_translated,$tr[2]).'</a></li>';
				}
				
			}
		}
		echo ' </ul>
		 </div>
		 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="4">
		 <tr>
		  <td align="left" class="yellow"><a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.USER_CMS_PAGE.'&'.USER_GET_PAGE.'='.ACCOUNTSETTINGS_CMS_USER.'">'.link_account_settings.'</a></td>
		  <td align="right" class="yellow"><a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'=logout">'.link_log_out.'</a></td>
		 </tr>
		 </table>
		 
		 ';
		  }else{
		  	echo '<form method="post" action="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.LOGIN_CMS_PAGE.'" name="uss_login_form">
			 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="4">
  <tr>
    <td style="height: 25px; padding-left: 2px;  " width="130"><input type="text" name="uss_id" maxlength="10" class="login_field" value="USER ID" OnClick="this.value=\'\'"></td>
    <td rowspan="2"><input type="image" src="template/'.$core['config']['template'].'/images/login_button.gif" width="52" height="36" onclick="uss_login_form.submit();"></td>
  </tr>
  <tr>
    <td style="height: 25px; padding-left: 2px;"><input type="password" name="uss_password" class="login_field" value="PASSWORD" maxlength="12" OnClick="this.value=\'\'"><input type="hidden" name="process_login"></td>
  </tr>
    <tr>
    <td style="height: 25px; padding-left: 2px;" colspan="2" align="left" class="yellow"><a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.LOSTPASSWORD_CMS_PAGE.'">'.link_lost_password.'</a></td>
  </tr>
     <tr>
    <td style="height: 25px; padding-left: 2px;"  colspan="2" align="left"  class="yellow">'.text_start_play_now.'</span> <a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.REGISTER_CMS_PAGE.'">'.link_sign_up.'</a></td>
  </tr>
</table>
</form>';
		  }
		  ?>
		  </div>
		 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 15px; ">
		  <tr>
		  <td width="2" height="33"><img src="template/<?=$core['config']['template'] ?>/images/left_title_side.gif" width="2" height="33"></td>
		  <td  class="tmp_left_title"><?=text_menu?></td>
		  <td width="2" height="33"><img src="template/<?=$core['config']['template'] ?>/images/left_title_right.gif" width="2" height="33"></td>
		  </tr>
		  </table>
		  <div class="tmp_left_m">
		  <div class="tmp_left_menu">
		  <ul>
		  <?
					  $m_row_ = get_sort('engine/cms_data/pag_d.cms','¦');
					#  echo $test[1][2][3];
					  foreach ($m_row_ as $li){
					 #  explode("¦",$li);
					   switch ($li[7]){
					   	case '0':
					   		if($li[8] == '1'){
					   			if($li[6] != '0'){
					   				echo '<li class="list_menu"><a  href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.$li[3].'">'.str_replace($menu_links_title,$menu_links_translated,$li[2]).'</a></li>';
					   			}
					   	
					   		}
					   		break;
					   	case '1':
					   		switch ($li[11]){
					   			case '1': $target = "_blank"; break;
					   			case '0': $target = "_self"; break;
					   		}
					   		echo '<li class="list_menu"><a  href="'.$li[10].'"  target="'.$target.'">'.str_replace($menu_links_title,$menu_links_translated,$li[2]).'</a></li>  ';
					   	
					   	break;
					   }


					  	
					  }
					  
		  ?>

		  </ul>
		 </div>
		 </div>
		 <?
$load_pages_lef = file('engine/cms_data/pag_d.cms');
foreach ($load_pages_lef as $pages_loaded_lef){
	$pages_loaded_lef = explode("¦",$pages_loaded_lef);
	if($pages_loaded_lef[3] == $page_check_id){
		$p_loaded_array_lef = preg_split( "/\ /", $pages_loaded_lef[4]); 
		$p_l_lef = '1';
		break;
	}
}
if($p_l_lef == '1'){
$load_mods_lef = file('engine/cms_data/mods.cms');
foreach ($load_mods_lef as $mods_loaded_lef){
	$mods_loaded_lef = explode("¦",$mods_loaded_lef);

	if(in_array($mods_loaded_lef[0],$p_loaded_array_lef)){
		$_c_id_m_lef[] = $mods_loaded_lef[0];
	}else {
		$_c_id_m_lef[] = 'NULL';
	}
}
$co=0;
foreach ($p_loaded_array_lef as $give_lef){
	#echo $give;
	if(in_array($give_lef,$_c_id_m_lef)){
		foreach ($load_mods_lef as $give_me_out_lef){
			$give_me_out_lef = explode("¦",$give_me_out_lef);
			if($give_me_out_lef[0] == $give_lef){
				if($give_me_out_lef[4] == '1'){
					echo '
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 15px; ">
		  <tr>
		  <td width="2" height="33"><img src="template/'.$core['config']['template'].'/images/left_title_side.gif" width="2" height="33"></td>
		  <td  class="tmp_left_title">'.htmlspecialchars(str_replace($modules_text_tile,$modules_text_translate,$give_me_out_lef[3])).'</td>
		  <td width="2" height="33"><img src="template/'.$core['config']['template'].'/images/left_title_right.gif" width="2" height="33"></td>
		  </tr>
		  </table>
		  <div class="tmp_left_m">
		   <div class="right_page_content">';
				
					
				if($give_me_out_lef[1] == '1'){
					$mod_file_lef = $give_me_out_lef[2];
					if(is_file('pages_modules/'.$mod_file_lef.'')){
						include('pages_modules/'.$mod_file_lef.'');
					}else{
						echo 'Unable to load module file, reason: not found.';
					}
				}elseif ($give_me_out_lef[1] == '0'){
					if(is_file('engine/cms_data/cms_co/'.$give_me_out_lef[0].'_cms.cms')){
						include('engine/cms_data/cms_co/'.$give_me_out_lef[0].'_cms.cms');
					}else{
						echo 'Unable to load module content, reason: not found.';
					}
					
					#echo $give_me_out_lef[4];
				}
				
				echo '</div></div>';
				}
			}
		}
		#echo $module;
	}
}
}
      ?>		 <!-- End Left -->
		 </div>
		  </td>
		  <td align="left" valign="top" style="width: 100%; ">
		  <div class="tmp_right_side">
		  <?
		  if(CMS_NAVBAR == '1'){
		  	if(isset($_GET[LOAD_GET_PAGE])){
                  	$l_load = file("engine/cms_data/pag_d.cms");
                  	foreach ($l_load as $l_name){
                  		$l_name = explode("¦",$l_name);
                  		if($l_name[3] == $page_check_id){
                  			$primary_l = $l_name[2];
                  			break;
                  		}

                  	}
                  }
                  
                  if(isset($_GET[USER_GET_PAGE])){
                  	$ti2_td = xss_clean(safe_input($_GET[USER_GET_PAGE],"_"));
                  	$l2_load = file("engine/cms_data/mods_uss.cms");
                  	foreach ($l2_load as $l2_name){
                  		$l2_name = explode("¦",$l2_name);
                  		if($l2_name[3] == $ti2_td){
                  			$secondary_l = $l2_name[2];
                  			break;
                  		}
                  	}
                  }
                  
                  if(!isset($_GET[LOAD_GET_PAGE])){
                                        #&gt;
                                        $title_p =  '<a  href="'.$core['config']['website_url'].'">'.$core['config']['websitetitle'].'</a>';
                                    }elseif  (isset($_GET[LOAD_GET_PAGE])){
                                        if(isset($_GET[USER_GET_PAGE])){
                                            $usercp_module_title =  str_replace($modules_text_tile,$modules_text_translate,$secondary_l);
$title_p =  '<a  href="'.$core['config']['website_url'].'">'.$core['config']['websitetitle'].'</a>  &gt; <a  href="'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.$l_name[3].'">'.str_replace($menu_links_title,$menu_links_translated,$primary_l).'</a>  &gt; <a  href="'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.$l_name[3].'&panel='.$l2_name[3].'">'.$usercp_module_title.'</a>';
                                        }else{ $title_p =  '<a  href="'.$core['config']['website_url'].'">'.$core['config']['websitetitle'].'</a>  &gt; <a  href="'.$core['config']['website_url'].'/'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.$l_name[3].'">'.str_replace($menu_links_title,$menu_links_translated,$primary_l).'</a>';}
                                    }
                  echo '
                  
                  <div class="where_nav">
                  <table cellpadding="0" cellspacing="0" border="0" >
                  <tr>
                  <td align="left"><img src="template/'.$core['config']['template'].'/images/arrow.gif" border="0"></td>
                  <td>&nbsp;</td>
                  <td width="100%" align="left">'.$title_p.'</td>
                  </table>
                  </div>';
		  	
		  }

if($page_check_id != ANNOUNCEMENTS_CMS_PAGE){
	require('engine/announcement_config.php');
if($core['ANNOUNCEMENT']['ACTIVE'] == '1'){
	$ann_file = array_reverse(file('engine/variables_mods/announcements.tDB'));
	$count_ann = '0';
	foreach ($ann_file as $ann){
		$ann = explode("¦",$ann);
		if($ann[3] > time()){
			$ann_found = '1';
			$ann_title = $ann[1];
			$ann_date = $ann[2];
			$ann_id = $ann[0];
;			break;
		}
	}
}
	if($ann_found == '1'){
		echo '
		<div class="tmp_m_content"> 
					<div  class="tmp_right_title">'.text_announcement.'</div>
					<div class="tmp_page_content">
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
					  <tr>
					  <td rowspan="3" align="left" width="60"><img src="template/'.$core['config']['template'].'/images/announcement.gif" width="38" height="38"></td>
					  <td align="left" style="padding-top: 2px; padding-bottom: 2px;"><a href="'.ROOT_INDEX.'?'.LOAD_GET_PAGE.'='.ANNOUNCEMENTS_CMS_PAGE.'#announcement-'.$ann_id.'">'.$ann_title.'</a></td>
					  <td align="right" class="ann_date">'.date('F j, Y | H:i',$ann_date).'</td>
					  </tr>
					  <tr>
					  <td colspan="2"  align="left" style="background-image:url(template/'.$core['config']['template'].'/images/inner_line.jpg); height: 2px;"></td>
					  </tr>
					  
					  ';
		if($core['ANNOUNCEMENT']['AUTHOR'] == '1'){
			echo '<tr>
			<td colspan="2" align="right"><b>'.$core['config']['admin_nick'].'</b> (Administrator)</td>
			</tr>';
			
		}
		echo '</table></div>
							</div>
						';
	}
}
		  
		  
	
$load_pages = file('engine/cms_data/pag_d.cms');
foreach ($load_pages as $pages_loaded){
	$pages_loaded = explode("¦",$pages_loaded);
	
	if($pages_loaded[3] == $page_check_id){
		$p_loaded_array = preg_split( "/\ /", $pages_loaded[5]); 
		$p_l = '1';
		break;
	}
}
if($p_l == '1'){
$load_mods = file('engine/cms_data/mods.cms');
foreach ($load_mods as $mods_loaded){
	$mods_loaded = explode("¦",$mods_loaded);
	if(in_array($mods_loaded[0],$p_loaded_array)){
		$_c_id_m[] = $mods_loaded[0];
	}else {
		$_c_id_m[] = 'NULL';
	}
}
$co=0;
foreach ($p_loaded_array as $give){
	#echo $give;
	if(in_array($give,$_c_id_m)){
		foreach ($load_mods as $give_me_out){
			$give_me_out = explode("¦",$give_me_out);
			if($give_me_out[0] == $give){
				if($give_me_out[4] == '1'){
					if($_GET[LOAD_GET_PAGE] == USER_CMS_PAGE && isset($_GET[USER_GET_PAGE])){
						$construct_title = $secondary_l;
					}else{
						$construct_title = $give_me_out[3];
					}
				
					echo '<div class="tmp_m_content"> 
					 <div  class="tmp_right_title">'.htmlspecialchars(str_replace($modules_text_tile,$modules_text_translate,$give_me_out[3])).'</div>
					<div class="tmp_page_content">';
					if($give_me_out[1] == '1'){
						if(is_file("pages_modules/".$give_me_out[2]."")){
							include('pages_modules/'.$give_me_out[2].'');
						}else{
							echo 'Unable to load module file, reason: not found.';
						}
					}elseif ($give_me_out[1] == '0'){
						if(is_file('engine/cms_data/cms_co/'.$give_me_out[0].'_cms.cms')){
							include('engine/cms_data/cms_co/'.$give_me_out[0].'_cms.cms');
						}else{
							echo 'Unable to load module content, reason: not found.';
						}
					}
					echo '</div> </div>';
				}
			}
		}
	}
}
}
?>	  
		  </div>
		  
		</td>
        </tr>
      </table>
</div>
  </div>
    </div>
  </div>
   <div align="center">
                    <div align="right" style="width: 990px;"  class="language_select">
                    <?
                    if($core['language_switch'] == '1'){
                        foreach ($languages as $language_id =>  $language_data){
                            echo '&nbsp;<img  src="template/'.$core['config']['template'].'/images/flags/'.$language_data[2].'">  <a  href="'.ROOT_INDEX.'?change_language='.$language_id.'">'.$language_data[0].'</a>';
                        }
                    }
                    ?></div>
                    </div>
  </div>
</div>
<div style="margin-top: 20px; margin-bottom: 20px;">
<?=build_footer();?>
  </div>
</div>

</body>
</html>
</body>
</html>
