<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /sklep/rejestracja.php');
    exit;
}

$nazwa  = trim($_POST['nazwa']  ?? '');
$email  = trim($_POST['email']  ?? '');
$haslo  = $_POST['haslo']  ?? '';
$haslo2 = $_POST['haslo2'] ?? '';

$bledy = [];

// Walidacja nazwy
if ($nazwa === '') {
    $bledy[] = 'Nazwa użytkownika jest wymagana.';
} elseif (strlen($nazwa) < 3 || strlen($nazwa) > 50) {
    $bledy[] = 'Nazwa użytkownika musi mieć od 3 do 50 znaków.';
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $nazwa)) {
    $bledy[] = 'Nazwa użytkownika może zawierać tylko litery, cyfry i znak _.';
}

// Walidacja e-mail
if ($email === '') {
    $bledy[] = 'Adres e-mail jest wymagany.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $bledy[] = 'Podaj prawidłowy adres e-mail.';
}

// Walidacja hasła
if (strlen($haslo) < 8) {
    $bledy[] = 'Hasło musi mieć co najmniej 8 znaków.';
}
if ($haslo !== $haslo2) {
    $bledy[] = 'Hasła nie są identyczne.';
}

if (!empty($bledy)) {
    $_SESSION['bledy']      = $bledy;
    $_SESSION['stary_input'] = ['nazwa' => $nazwa, 'email' => $email];
    header('Location: /sklep/rejestracja.php');
    exit;
}

// Sprawdzenie czy nazwa lub e-mail już istnieje
$stmt = $pdo->prepare('SELECT id FROM uzytkownicy WHERE nazwa = ? OR email = ?');
$stmt->execute([$nazwa, $email]);
if ($stmt->fetch()) {
    $_SESSION['bledy']      = ['Podana nazwa użytkownika lub adres e-mail jest już zajęty.'];
    $_SESSION['stary_input'] = ['nazwa' => $nazwa, 'email' => $email];
    header('Location: /sklep/rejestracja.php');
    exit;
}

// Zapis do bazy
$hash = password_hash($haslo, PASSWORD_BCRYPT);
$stmt = $pdo->prepare('INSERT INTO uzytkownicy (nazwa, email, haslo) VALUES (?, ?, ?)');
$stmt->execute([$nazwa, $email, $hash]);

$_SESSION['sukces'] = 'Rejestracja przebiegła pomyślnie! Możesz się teraz zalogować.';
header('Location: /sklep/logowanie.php');
exit;