<?php
$pageTitle = 'Produkty';
require_once 'includes/db.php';
require_once 'includes/header.php';

$kategoria_slug = isset($_GET['kategoria']) ? trim($_GET['kategoria']) : '';

if ($kategoria_slug !== '') {
    $stmt = $pdo->prepare('SELECT p.*, k.nazwa AS kategoria_nazwa FROM produkty p JOIN kategorie k ON p.kategoria_id = k.id WHERE k.slug = ? ORDER BY p.data_dodania DESC');
    $stmt->execute([$kategoria_slug]);
} else {
    $stmt = $pdo->query('SELECT p.*, k.nazwa AS kategoria_nazwa FROM produkty p JOIN kategorie k ON p.kategoria_id = k.id ORDER BY p.data_dodania DESC');
}
$produkty = $stmt->fetchAll();

$kategorie = $pdo->query('SELECT * FROM kategorie ORDER BY nazwa')->fetchAll();
?>

<div class="container page-produkty">
    <h1 class="page-title">Produkty</h1>

    <div class="produkty-layout">

        <aside class="sidebar">
            <h3>Kategorie</h3>
            <ul class="sidebar-list">
                <li><a href="/sklep/produkty.php" <?= $kategoria_slug === '' ? 'class="active"' : '' ?>>Wszystkie</a></li>
                <?php foreach ($kategorie as $kat): ?>
                    <li>
                        <a href="/sklep/produkty.php?kategoria=<?= htmlspecialchars($kat['slug']) ?>"
                           <?= $kategoria_slug === $kat['slug'] ? 'class="active"' : '' ?>>
                            <?= htmlspecialchars($kat['nazwa']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="produkty-grid">
            <?php if (empty($produkty)): ?>
                <p class="brak-wynikow">Brak produktów w tej kategorii.</p>
            <?php else: ?>
                <?php foreach ($produkty as $p): ?>
                    <article class="produkt-karta">
                        <?php if ($p['cena_przed']): ?>
                            <span class="badge-promo">PROMOCJA</span>
                        <?php endif; ?>
                        <a href="/sklep/produkt.php?id=<?= $p['id'] ?>">
                            <div class="produkt-img">
                                <img src="/sklep/assets/img/<?= htmlspecialchars($p['zdjecie']) ?>"
                                     alt="<?= htmlspecialchars($p['nazwa']) ?>"
                                     onerror="this.src='/sklep/assets/img/brak.jpg'">
                            </div>
                            <div class="produkt-info">
                                <p class="produkt-kategoria"><?= htmlspecialchars($p['kategoria_nazwa']) ?></p>
                                <h3 class="produkt-nazwa"><?= htmlspecialchars($p['nazwa']) ?></h3>
                                <div class="produkt-cena">
                                    <?php if ($p['cena_przed']): ?>
                                        <span class="cena-przed"><?= number_format($p['cena_przed'], 2, ',', ' ') ?> zł</span>
                                    <?php endif; ?>
                                    <span class="cena-aktualna"><?= number_format($p['cena'], 2, ',', ' ') ?> zł</span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

    </div>
</div>

<?php require_once 'includes/footer.php'; ?>