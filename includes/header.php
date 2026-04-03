<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'TechShop') ?> &ndash; TechShop</title>
    <link rel="stylesheet" href="/sklep/assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">

        <a href="/sklep/index.php" class="logo">
            <span class="logo-icon">&#9889;</span>TechShop
        </a>

        <nav class="main-nav" id="mainNav" aria-label="Nawigacja główna">
            <ul>
                <li><a href="/sklep/index.php">Strona główna</a></li>
                <li><a href="/sklep/produkty.php">Produkty</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['rola'] === 'admin'): ?>
                        <li><a href="/sklep/admin/index.php">Panel admina</a></li>
                    <?php endif; ?>
                    <li><a href="/sklep/includes/logowanie_akcja.php?akcja=wyloguj">Wyloguj (<?= htmlspecialchars($_SESSION['nazwa']) ?>)</a></li>
                <?php else: ?>
                    <li><a href="/sklep/logowanie.php">Logowanie</a></li>
                    <li><a href="/sklep/rejestracja.php">Rejestracja</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <button class="nav-toggle" id="navToggle" aria-label="Otwórz menu">&#9776;</button>

    </div>
</header>

<main class="main-content">