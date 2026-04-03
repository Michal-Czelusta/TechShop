<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rola'] !== 'admin') {
    header('Location: /sklep/logowanie.php');
    exit;
}
require_once '../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare('DELETE FROM produkty WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: /sklep/admin/index.php?komunikat=Produkt+został+usunięty&typ=sukces');
} else {
    header('Location: /sklep/admin/index.php?komunikat=Błąd+usuwania&typ=blad');
}
exit;