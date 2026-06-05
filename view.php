<?php
require_once __DIR__ . '/../includes/db.php';

use App\Repository\MovieRepository;

header('Content-Type: application/json');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id < 1) {
    echo json_encode(['ok' => false]);
    exit;
}

$repo = new MovieRepository();
$repo->incrementViews($id);

echo json_encode(['ok' => true]);
