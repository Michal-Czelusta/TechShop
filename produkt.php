<?php
require_once 'includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT p.*, k.nazwa AS kategoria_nazwa FROM produkty p JOIN kategorie k ON p.kategoria_id = k.id WHERE p.id = ?');
$stmt->execute([$id]);
$produkt = $stmt->fetch();

if (!$produkt) {
    header('Location: /sklep/produkty.php');
    exit;
}

$pageTitle = $produkt['nazwa'];
require_once 'includes/header.php';
?>

<div class="container page-produkt">
    <nav class="breadcrumb">
        <a href="/sklep/index.php">Strona główna</a> &rsaquo;
        <a href="/sklep/produkty.php">Produkty</a> &rsaquo;
        <span><?= htmlspecialchars($produkt['nazwa']) ?></span>
    </nav>

    <div class="produkt-szczegoly">
        <div class="produkt-szczegoly-img">
            <img src="/sklep/assets/img/<?= htmlspecialchars($produkt['zdjecie']) ?>"
                 alt="<?= htmlspecialchars($produkt['nazwa']) ?>"
                 onerror="this.src='/sklep/assets/img/brak.jpg'">
        </div>
        <div class="produkt-szczegoly-info">
            <p class="produkt-kategoria"><?= htmlspecialchars($produkt['kategoria_nazwa']) ?></p>
            <h1><?= htmlspecialchars($produkt['nazwa']) ?></h1>
            <div class="produkt-cena">
                <?php if ($produkt['cena_przed']): ?>
                    <span class="cena-przed"><?= number_format($produkt['cena_przed'], 2, ',', ' ') ?> zł</span>
                <?php endif; ?>
                <span class="cena-aktualna duza"><?= number_format($produkt['cena'], 2, ',', ' ') ?> zł</span>
            </div>
            <p class="dostepnosc <?= $produkt['dostepnosc'] ? 'dostepny' : 'niedostepny' ?>">
                <?= $produkt['dostepnosc'] ? '✔ Dostępny' : '✘ Niedostępny' ?>
            </p>
            <div class="produkt-opis">
                <h3>Opis produktu</h3>
                <p><?= nl2br(htmlspecialchars($produkt['opis'])) ?></p>
            </div>
            <a href="/sklep/produkty.php" class="btn btn-secondary">&#8592; Wróć do listy</a>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>