<?php
require_once __DIR__ . '/../lang/trad.php';
require_once __DIR__ . '/../db/database.php';
header('Content-Type: application/json; charset=UTF-8');

$id = intval($_GET['id'] ?? 0);
$db = Database::getInstance();
$stmt = $db->prepare("SELECT description_$lang FROM projects WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(['description' => $row["description_$lang"] ?? '']);
