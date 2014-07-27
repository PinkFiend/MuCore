<?
if (!class_exists('MAIL5')) {
    require_once 'engine/mail/MAIL.php';
}
class MAIL extends MAIL5
{
}

if (!class_exists('FUNC5')) {
    require_once 'engine/mail/FUNC.php';
}

if (!class_exists('SMTP5')) {
    require_once 'engine/mail/SMTP.php';
}
if (!class_exists('MIME5')) {
    require_once 'engine/mail/MIME.php';
    class MIME extends MIME5
    {
    }
}
?> 