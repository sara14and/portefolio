<?php
// lang/trad.php
// load users chosen language (cookie) or default to French
$lang = $_COOKIE['lang'] ?? 'fr';
if (! in_array($lang, ['en','fr'])) {
  $lang = 'en';
}

$t = include __DIR__ . "/{$lang}.php";
