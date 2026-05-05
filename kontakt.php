<?php
$pageTitle = 'Kontakt';
require_once 'includes/header.php';

$wyslano = false;
$bledy = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie      = trim($_POST['imie'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $temat     = trim($_POST['temat'] ?? '');
    $wiadomosc = trim($_POST['wiadomosc'] ?? '');

    if ($imie === '') $bledy[] = 'Imię jest wymagane.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $bledy[] = 'Podaj prawidłowy adres e-mail.';
    if ($temat === '') $bledy[] = 'Temat jest wymagany.';
    if (strlen($wiadomosc) < 10) $bledy[] = 'Wiadomość jest za krótka (min. 10 znaków).';

    if (empty($bledy)) {
        $wyslano = true;
    }
}
?>

<div class="container page-kontakt">
    <h1 class="page-title">Kontakt</h1>

    <div class="kontakt-layout">

        <aside class="kontakt-info">
            <h2>Dane kontaktowe</h2>

            <div class="kontakt-karta">
                <div class="kontakt-item">
                    <div class="kontakt-item-ikona">&#128205;</div>
                    <div class="kontakt-item-tresc">
                        <strong>Adres</strong>
                        <span>ul. Przykładowa 12<br>00-001 Warszawa</span>
                    </div>
                </div>
                <div class="kontakt-item">
                    <div class="kontakt-item-ikona">&#128222;</div>
                    <div class="kontakt-item-tresc">
                        <strong>Telefon</strong>
                        <span>+48 123 456 789</span>
                    </div>
                </div>
                <div class="kontakt-item">
                    <div class="kontakt-item-ikona">&#9993;</div>
                    <div class="kontakt-item-tresc">
                        <strong>E-mail</strong>
                        <span>kontakt@techshop.pl</span>
                    </div>
                </div>
                <div class="kontakt-item">
                    <div class="kontakt-item-ikona">&#128336;</div>
                    <div class="kontakt-item-tresc">
                        <strong>Godziny otwarcia</strong>
                        <span>Pon&ndash;Pt: 9:00&ndash;18:00<br>Sob: 10:00&ndash;14:00</span>
                    </div>
                </div>
            </div>
        </aside>

        <section class="kontakt-formularz">
            <h2>Napisz do nas</h2>

            <?php if ($wyslano): ?>
                <p class="alert alert-sukces">Wiadomość została wysłana! Odezwiemy się wkrótce.</p>
            <?php else: ?>

                <?php if (!empty($bledy)): ?>
                    <div class="alert alert-blad">
                        <?php foreach ($bledy as $b): ?>
                            <p><?= htmlspecialchars($b) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="/michal-czelusta/kontakt.php" method="POST" id="formKontakt" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="imie">Imię i nazwisko</label>
                            <input type="text" id="imie" name="imie" required
                                   placeholder="np. Jan Kowalski"
                                   value="<?= htmlspecialchars($_POST['imie'] ?? '') ?>">
                            <span class="form-error" id="imieError"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input type="email" id="email" name="email" required
                                   placeholder="np. jan@example.com"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            <span class="form-error" id="emailError"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="temat">Temat</label>
                        <input type="text" id="temat" name="temat" required
                               placeholder="np. Pytanie o produkt"
                               value="<?= htmlspecialchars($_POST['temat'] ?? '') ?>">
                        <span class="form-error" id="tematError"></span>
                    </div>
                    <div class="form-group">
                        <label for="wiadomosc">Wiadomość</label>
                        <textarea id="wiadomosc" name="wiadomosc" required
                                  placeholder="Treść wiadomości..."><?= htmlspecialchars($_POST['wiadomosc'] ?? '') ?></textarea>
                        <span class="form-error" id="wiadomoscError"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Wyślij wiadomość</button>
                </form>

            <?php endif; ?>
        </section>

    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="/michal-czelusta/assets/js/walidacja-kontakt.js"></script>