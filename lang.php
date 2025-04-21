<?php
// read requested language and default to 'en'
$lang = $_GET['lang'] ?? 'en';

// only accept 'fr' or 'en'
if (! in_array($lang, ['fr','en'])) {
    $lang = 'fr';
}

// set a cookie for one year
setcookie('lang', $lang, time() + 365*24*3600, '/');

// redirect back to the referrer 
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
