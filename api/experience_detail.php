<?php
// api/experience_detail.php
require_once __DIR__ . '/../lang/trad.php';
header('Content-Type: application/json; charset=UTF-8');

$key    = $_GET['key'] ?? '';
$points = $t['experience_data'][$key]['points'] ?? [];

echo json_encode([
  'points' => $points
]);
