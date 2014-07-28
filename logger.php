<?php
$LogFileLocation = "/logs_tracker/user_logs.txt";
$fh              = fopen($_SERVER["DOCUMENT_ROOT"] . $LogFileLocation, "at");
fwrite($fh, date("dMy H:i:s") . "	" . $_SERVER["REMOTE_ADDR"] . "	" . $_SERVER["REQUEST_URI"] . "
");
fclose($fh);
?>
