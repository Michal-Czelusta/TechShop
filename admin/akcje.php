<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rola'] !== 'admin') {
    header('Location: /sklep/logowanie.php');
    exit;
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sklep/admin/index.php');
    exit;
}

$akcja = $_POST['akcja'] ?? '';

$nazwa       = trim($_POST['nazwa'] ?? '');
$opis        = trim($_POST['opis'] ?? '');
$cena        = $_POST['cena'] ?? '';
$cena_przed  = $_POST['cena_przed'] ?? '';
$zdjecie     = trim($_POST['zdjecie'] ?? 'brak.jpg');
$kategoria_id = (int)($_POST['kategoria_id'] ?? 0);
$dostepnosc  = isset($_POST['dostepnosc']) ? (int)$_POST['dostepnosc'] : 1;

$bledy = [];

if ($nazwa === '') {
    $bledy[] = 'Nazwa produktu jest wymagana.';
} elseif (strlen($nazwa) > 200) {
    $bledy[] = 'Nazwa produktu jest za długa.';
}

if (!is_numeric($cena) || (float)$cena < 0) {
    $bledy[] = 'Podaj prawidłową cenę.';
}

if ($kategoria_id <= 0) {
    $bledy[] = 'Wybierz kategorię.';
}

$cena_przed_val = ($cena_przed !== '' && is_numeric($cena_przed)) ? (float)$cena_przed : null;
if ($zdjecie === '') $zdjecie = 'brak.jpg';

if (!empty($bledy)) {
    $_SESSION['bledy'] = $bledy;
    $redirect = $akcja === 'edytuj' ? '/sklep/admin/edytuj.php?id=' . (int)$_POST['id'] : '/sklep/admin/dodaj.php';
    header('Location: ' . $redirect);
    exit;
}

if ($akcja === 'dodaj') {
    $stmt = $pdo->prepare('INSERT INTO produkty (nazwa, opis, cena, cena_przed, zdjecie, kategoria_id, dostepnosc) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nazwa, $opis, (float)$cena, $cena_przed_val, $zdjecie, $kategoria_id, $dostepnosc]);
    header('Location: /sklep/admin/index.php?komunikat=Produkt+został+dodany&typ=sukces');

} elseif ($akcja === 'edytuj') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id <= 0) {
        header('Location: /sklep/admin/index.php');
        exit;
    }
    $stmt = $pdo->prepare('UPDATE produkty SET nazwa=?, opis=?, cena=?, cena_przed=?, zdjecie=?, kategoria_id=?, dostepnosc=? WHERE id=?');
    $stmt->execute([$nazwa, $opis, (float)$cena, $cena_przed_val, $zdjecie, $kategoria_id, $dostepnosc, $id]);
    header('Location: /sklep/admin/index.php?komunikat=Produkt+został+zaktualizowany&typ=sukces');
}

exit;