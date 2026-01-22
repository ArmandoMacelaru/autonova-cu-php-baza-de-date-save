<?php
require_once __DIR__ . '/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: profil.php?tab=mele");
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$id = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : 0;
$token = $_POST['token'] ?? '';

if (!$id || !isset($_SESSION['csrf_delete']) || !hash_equals($_SESSION['csrf_delete'], $token)) {
    header("Location: profil.php?tab=mele");
    exit;
}

// verifică owner
$chk = $conn->prepare("SELECT id FROM masini WHERE id=? AND user_id=? LIMIT 1");
$chk->bind_param("ii", $id, $user_id);
$chk->execute();
if ($chk->get_result()->num_rows === 0) {
    $chk->close();
    header("Location: profil.php?tab=mele");
    exit;
}
$chk->close();

// curățare relații
$conn->query("DELETE FROM imagini_masini WHERE masina_id=" . (int)$id);
$conn->query("DELETE FROM vizualizari WHERE masina_id=" . (int)$id);
$conn->query("DELETE FROM favorite WHERE masina_id=" . (int)$id);

// șterge mașina
$del = $conn->prepare("DELETE FROM masini WHERE id=? AND user_id=?");
$del->bind_param("ii", $id, $user_id);
$del->execute();
$del->close();

header("Location: profil.php?tab=mele");
exit;
