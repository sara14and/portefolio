<?php
// read requested language and default to french
$lang = $_GET['lang'] ?? 'fr';

// only accept 'fr' or 'en'
if (! in_array($lang, ['fr','en'])) {
    $lang = 'fr';
}

// set cookie for one year
setcookie('lang', $lang, time() + 365*24*3600, '/');

// redirect back to referrer 
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
