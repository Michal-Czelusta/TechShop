<?php
session_start();
require_once 'db.php';

// Wylogowanie
if (isset($_GET['akcja']) && $_GET['akcja'] === 'wyloguj') {
    session_destroy();
    header('Location: /sklep/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sklep/logowanie.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$haslo = $_POST['haslo'] ?? '';

$bledy = [];

if ($email === '') {
    $bledy[] = 'Podaj adres e-mail.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $bledy[] = 'Podaj prawidłowy adres e-mail.';
}

if ($haslo === '') {
    $bledy[] = 'Podaj hasło.';
}

if (!empty($bledy)) {
    $_SESSION['bledy'] = $bledy;
    header('Location: /sklep/logowanie.php');
    exit;
}

// Szukamy użytkownika
$stmt = $pdo->prepare('SELECT * FROM uzytkownicy WHERE email = ?');
$stmt->execute([$email]);
$uzytkownik = $stmt->fetch();

if (!$uzytkownik || !password_verify($haslo, $uzytkownik['haslo'])) {
    $_SESSION['bledy'] = ['Nieprawidłowy adres e-mail lub hasło.'];
    header('Location: /sklep/logowanie.php');
    exit;
}

// Ustawiamy sesję
session_regenerate_id(true);
$_SESSION['user_id'] = $uzytkownik['id'];
$_SESSION['nazwa']   = $uzytkownik['nazwa'];
$_SESSION['rola']    = $uzytkownik['rola'];

if ($uzytkownik['rola'] === 'admin') {
    header('Location: /sklep/admin/index.php');
} else {
    header('Location: /sklep/index.php');
}
exit;