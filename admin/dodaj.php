<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rola'] !== 'admin') {
    header('Location: /sklep/logowanie.php');
    exit;
}
require_once '../includes/db.php';

$bledy = $_SESSION['bledy'] ?? [];
unset($_SESSION['bledy']);

$kategorie = $pdo->query('SELECT * FROM kategorie ORDER BY nazwa')->fetchAll();
$pageTitle = 'Dodaj produkt';
require_once '../includes/header.php';
?>

<div class="container page-admin">
    <h1 class="page-title">Dodaj produkt</h1>
    <a href="/sklep/admin/index.php" class="btn btn-secondary" style="margin-bottom:24px">&#8592; Wróć do listy</a>

    <?php if (!empty($bledy)): ?>
        <div class="alert alert-blad">
            <?php foreach ($bledy as $b): ?>
                <p><?= htmlspecialchars($b) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="admin-form">
        <h2>Nowy produkt</h2>
        <form action="/sklep/admin/akcje.php" method="POST" id="formDodaj" novalidate>
            <input type="hidden" name="akcja" value="dodaj">
            <div class="form-row">
                <div class="form-group">
                    <label for="nazwa">Nazwa produktu</label>
                    <input type="text" id="nazwa" name="nazwa" required placeholder="np. RTX 4060">
                    <span class="form-error" id="nazwaError"></span>
                </div>
                <div class="form-group">
                    <label for="kategoria_id">Kategoria</label>
                    <select id="kategoria_id" name="kategoria_id" required>
                        <option value="">-- wybierz --</option>
                        <?php foreach ($kategorie as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nazwa']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-error" id="kategoriaError"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="cena">Cena (zł)</label>
                    <input type="number" id="cena" name="cena" required min="0" step="0.01" placeholder="np. 1299.00">
                    <span class="form-error" id="cenaError"></span>
                </div>
                <div class="form-group">
                    <label for="cena_przed">Cena przed promocją (zł) – opcjonalnie</label>
                    <input type="number" id="cena_przed" name="cena_przed" min="0" step="0.01" placeholder="np. 1499.00">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="zdjecie">Nazwa pliku zdjęcia</label>
                    <input type="text" id="zdjecie" name="zdjecie" placeholder="np. rtx4060.jpg">
                </div>
                <div class="form-group">
                    <label for="dostepnosc">Dostępność</label>
                    <select id="dostepnosc" name="dostepnosc">
                        <option value="1">Dostępny</option>
                        <option value="0">Niedostępny</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="opis">Opis produktu</label>
                <textarea id="opis" name="opis" placeholder="Krótki opis produktu..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj produkt</button>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
<script src="/sklep/assets/js/walidacja-admin.js"></script>