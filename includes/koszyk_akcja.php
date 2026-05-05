<?php
session_start();

$akcja     = $_POST['akcja'] ?? $_GET['akcja'] ?? '';
$produkt_id = isset($_POST['produkt_id']) ? (int)$_POST['produkt_id'] : 0;

if (!isset($_SESSION['koszyk'])) {
    $_SESSION['koszyk'] = [];
}

if ($akcja === 'dodaj' && $produkt_id > 0) {
    require_once __DIR__ . '/db.php';
    $stmt = $pdo->prepare('SELECT id, nazwa, cena, zdjecie FROM produkty WHERE id = ? AND dostepnosc = 1');
    $stmt->execute([$produkt_id]);
    $produkt = $stmt->fetch();

    if ($produkt) {
        if (isset($_SESSION['koszyk'][$produkt_id])) {
            $_SESSION['koszyk'][$produkt_id]['ilosc']++;
        } else {
            $_SESSION['koszyk'][$produkt_id] = [
                'id'     => $produkt['id'],
                'nazwa'  => $produkt['nazwa'],
                'cena'   => $produkt['cena'],
                'zdjecie' => $produkt['zdjecie'],
                'ilosc'  => 1
            ];
        }
    }
    header('Location: /michal-czelusta/koszyk.php?dodano=1');
    exit;
}

if ($akcja === 'usun' && $produkt_id > 0) {
    unset($_SESSION['koszyk'][$produkt_id]);
    header('Location: /michal-czelusta/koszyk.php');
    exit;
}

if ($akcja === 'zmien_ilosc' && $produkt_id > 0) {
    $ilosc = (int)($_POST['ilosc'] ?? 1);
    if ($ilosc <= 0) {
        unset($_SESSION['koszyk'][$produkt_id]);
    } elseif (isset($_SESSION['koszyk'][$produkt_id])) {
        $_SESSION['koszyk'][$produkt_id]['ilosc'] = $ilosc;
    }
    header('Location: /michal-czelusta/koszyk.php');
    exit;
}

if ($akcja === 'wyczysc') {
    $_SESSION['koszyk'] = [];
    header('Location: /michal-czelusta/koszyk.php');
    exit;
}

header('Location: /michal-czelusta/koszyk.php');
exit;