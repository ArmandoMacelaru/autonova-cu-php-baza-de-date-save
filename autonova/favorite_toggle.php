<?php
require_once __DIR__ . '/config.php';
session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Trebuie să fii logat.']);
    exit;
}

if (!isset($_POST['masina_id']) || !is_numeric($_POST['masina_id'])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'ID invalid.']);
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$masina_id = (int)$_POST['masina_id'];

// există deja?
$check = $conn->prepare("SELECT id FROM favorite WHERE user_id=? AND masina_id=? LIMIT 1");
$check->bind_param("ii", $user_id, $masina_id);
$check->execute();
$exists = $check->get_result()->num_rows > 0;
$check->close();

if ($exists) {
    $del = $conn->prepare("DELETE FROM favorite WHERE user_id=? AND masina_id=?");
    $del->bind_param("ii", $user_id, $masina_id);
    $del->execute();
    $del->close();
    echo json_encode(['ok' => true, 'favorit' => false]);
} else {
    $ins = $conn->prepare("INSERT INTO favorite (user_id, masina_id, created_at) VALUES (?, ?, NOW())");
    $ins->bind_param("ii", $user_id, $masina_id);
    $ins->execute();
    $ins->close();
    echo json_encode(['ok' => true, 'favorit' => true]);
}
