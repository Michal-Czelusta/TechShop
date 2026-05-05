<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'michal-czelusta');
define('DB_USER', 'michal-czelusta');
define('DB_PASS', 'TWOJE_HASLO_TUTAJ');
define('DB_CHARSET', 'utf8mb4');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('Błąd połączenia z bazą danych.');
}