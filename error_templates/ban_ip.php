<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?= $core['config']['websitetitle'] ?></title>
<style type="text/css">
<!--
.maintenance { 
 background-color:#F7F3F7; 
 border:1px #425584 solid; margin:4px; padding:2px; width: 600px;}
.maintenance .maintenance_title { 
 background-color:#425584;  
 position:relative;
 font: bold 14px Arial, Helvetica, sans-serif;  color:#FFFFFF; 
 padding:4px;  }
.maintenance .maintenance_reason { 
 font:normal 12px/20px Arial, Helvetica, sans-serif; 
 color:#375264; margin:5px; }
.maintenance .maintenance_author { 
 font:normal 12px Arial, Helvetica, sans-serif; 
 color:#375264;  
 padding: 4px;}
-->
</style>
    
</head>
<body>

    <div align="center">
    <div class="maintenance" style="margin-top: 40px;">
     <div class="maintenance_title" align="left">Banned</div>
     <div class="maintenance_reason" align="left">
     Your are browsing from a banned IP. Your access to this website is not permitted.
    </div>
    <div class="maintenance_author" align="right" style="margin-top: 4px;">Sorry for inconvience,<br><b><?= $core['config']['admin_nick'] ?></b></div>
    </div>
    </div>
</body>
</html>