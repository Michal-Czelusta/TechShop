<?php
session_start();
$pageTitle = 'Koszyk';
require_once 'includes/header.php';

$koszyk = $_SESSION['koszyk'] ?? [];
$suma = 0;
foreach ($koszyk as $p) {
    $suma += $p['cena'] * $p['ilosc'];
}
?>

<div class="container page-koszyk">
    <h1 class="page-title">Koszyk</h1>

    <?php if (isset($_GET['dodano'])): ?>
        <p class="alert alert-sukces">Produkt został dodany do koszyka!</p>
    <?php endif; ?>

    <?php if (empty($koszyk)): ?>
        <div class="koszyk-pusty">
            <div class="koszyk-pusty-ikona">&#128722;</div>
            <h2>Twój koszyk jest pusty</h2>
            <p>Dodaj produkty do koszyka i wróć tutaj.</p>
            <a href="/michal-czelusta/produkty.php" class="btn btn-primary">Przejdź do produktów</a>
        </div>
    <?php else: ?>

        <div class="koszyk-layout">

            <section class="koszyk-lista">
                <?php foreach ($koszyk as $p): ?>
                    <div class="koszyk-produkt">
                        <div class="koszyk-produkt-img">
                            <img src="/michal-czelusta/assets/img/<?= htmlspecialchars($p['zdjecie']) ?>"
                                 alt="<?= htmlspecialchars($p['nazwa']) ?>"
                                 onerror="this.src='/michal-czelusta/assets/img/brak.jpg'">
                        </div>
                        <div class="koszyk-produkt-info">
                            <h3><?= htmlspecialchars($p['nazwa']) ?></h3>
                            <p class="koszyk-cena-jednostkowa"><?= number_format($p['cena'], 2, ',', ' ') ?> zł / szt.</p>
                        </div>
                        <div class="koszyk-produkt-akcje">
                            <form action="/michal-czelusta/includes/koszyk_akcja.php" method="POST" class="form-ilosc">
                                <input type="hidden" name="akcja" value="zmien_ilosc">
                                <input type="hidden" name="produkt_id" value="<?= $p['id'] ?>">
                                <button type="button" class="ilosc-btn" onclick="zmienIlosc(this, -1)">&#8722;</button>
                                <input type="number" name="ilosc" value="<?= $p['ilosc'] ?>"
                                       min="1" max="99" class="ilosc-input" readonly>
                                <button type="button" class="ilosc-btn" onclick="zmienIlosc(this, 1)">&#43;</button>
                                <button type="submit" class="btn btn-secondary btn-sm">Aktualizuj</button>
                            </form>
                            <p class="koszyk-cena-suma"><?= number_format($p['cena'] * $p['ilosc'], 2, ',', ' ') ?> zł</p>
                            <form action="/michal-czelusta/includes/koszyk_akcja.php" method="POST">
                                <input type="hidden" name="akcja" value="usun">
                                <input type="hidden" name="produkt_id" value="<?= $p['id'] ?>">
                                <button type="submit" class="btn-usun" title="Usuń produkt">&#10005;</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>

                <form action="/michal-czelusta/includes/koszyk_akcja.php" method="POST" class="koszyk-wyczysc">
                    <input type="hidden" name="akcja" value="wyczysc">
                    <button type="submit" class="btn btn-secondary btn-sm">Wyczyść koszyk</button>
                </form>
            </section>

            <aside class="koszyk-podsumowanie">
                <h2>Podsumowanie</h2>
                <div class="podsumowanie-wiersz">
                    <span>Produkty (<?= array_sum(array_column($koszyk, 'ilosc')) ?> szt.)</span>
                    <span><?= number_format($suma, 2, ',', ' ') ?> zł</span>
                </div>
                <div class="podsumowanie-wiersz">
                    <span>Dostawa</span>
                    <span class="darmowa">Darmowa</span>
                </div>
                <div class="podsumowanie-razem">
                    <span>Razem</span>
                    <span><?= number_format($suma, 2, ',', ' ') ?> zł</span>
                </div>
                <button type="button" class="btn btn-primary btn-full" onclick="alert('Funkcja płatności nie jest zaimplementowana.')">
                    Przejdź do kasy
                </button>
                <a href="/michal-czelusta/produkty.php" class="btn btn-secondary btn-full" style="margin-top: 10px; text-align:center;">
                    Kontynuuj zakupy
                </a>
            </aside>

        </div>

    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="/michal-czelusta/assets/js/koszyk.js"></script>