<?php
// lang/trad.php
// load the users chosen language (cookie) or default to English
$lang = $_COOKIE['lang'] ?? 'en';
if (! in_array($lang, ['en','fr'])) {
  $lang = 'en';
}

$t = include __DIR__ . "/{$lang}.php";
