<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'TechShop') ?> &ndash; TechShop</title>
    <link rel="stylesheet" href="/michal-czelusta/assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">

        <a href="/michal-czelusta/index.php" class="logo">
            <span class="logo-icon">&#9889;</span>TechShop
        </a>

        <nav class="main-nav" id="mainNav" aria-label="Nawigacja główna">
            <ul>
                <li><a href="/michal-czelusta/index.php">Strona główna</a></li>
                <li><a href="/michal-czelusta/produkty.php">Produkty</a></li>
                <li><a href="/michal-czelusta/kontakt.php">Kontakt</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['rola'] === 'admin'): ?>
                        <li><a href="/michal-czelusta/admin/index.php">Panel admina</a></li>
                    <?php endif; ?>
                    <li><a href="/michal-czelusta/includes/logowanie_akcja.php?akcja=wyloguj">Wyloguj (<?= htmlspecialchars($_SESSION['nazwa']) ?>)</a></li>
                <?php else: ?>
                    <li><a href="/michal-czelusta/logowanie.php">Logowanie</a></li>
                <?php endif; ?>
                <li>
                    <a href="/michal-czelusta/koszyk.php" class="nav-koszyk">
                        &#128722;
                        <?php
                        $liczba_koszyk = 0;
                        if (isset($_SESSION['koszyk'])) {
                            foreach ($_SESSION['koszyk'] as $p) {
                                $liczba_koszyk += $p['ilosc'];
                            }
                        }
                        ?>
                        <?php if ($liczba_koszyk > 0): ?>
                            <span class="koszyk-badge"><?= $liczba_koszyk ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </nav>

        <button type="button" id="toggleTryb" class="toggle-tryb" aria-label="Zmień tryb">&#9790;</button>
        <button class="nav-toggle" id="navToggle" aria-label="Otwórz menu">&#9776;</button>

    </div>
</header>

<main class="main-content">