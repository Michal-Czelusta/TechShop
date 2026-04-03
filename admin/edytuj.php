<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rola'] !== 'admin') {
    header('Location: /sklep/logowanie.php');
    exit;
}
require_once '../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM produkty WHERE id = ?');
$stmt->execute([$id]);
$produkt = $stmt->fetch();

if (!$produkt) {
    header('Location: /sklep/admin/index.php');
    exit;
}

$bledy = $_SESSION['bledy'] ?? [];
unset($_SESSION['bledy']);

$kategorie = $pdo->query('SELECT * FROM kategorie ORDER BY nazwa')->fetchAll();
$pageTitle = 'Edytuj produkt';
require_once '../includes/header.php';
?>

<div class="container page-admin">
    <h1 class="page-title">Edytuj produkt</h1>
    <a href="/sklep/admin/index.php" class="btn btn-secondary" style="margin-bottom:24px">&#8592; Wróć do listy</a>

    <?php if (!empty($bledy)): ?>
        <div class="alert alert-blad">
            <?php foreach ($bledy as $b): ?>
                <p><?= htmlspecialchars($b) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="admin-form">
        <h2>Edycja: <?= htmlspecialchars($produkt['nazwa']) ?></h2>
        <form action="/sklep/admin/akcje.php" method="POST" id="formDodaj" novalidate>
            <input type="hidden" name="akcja" value="edytuj">
            <input type="hidden" name="id" value="<?= $produkt['id'] ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="nazwa">Nazwa produktu</label>
                    <input type="text" id="nazwa" name="nazwa" required
                           value="<?= htmlspecialchars($produkt['nazwa']) ?>">
                    <span class="form-error" id="nazwaError"></span>
                </div>
                <div class="form-group">
                    <label for="kategoria_id">Kategoria</label>
                    <select id="kategoria_id" name="kategoria_id" required>
                        <option value="">-- wybierz --</option>
                        <?php foreach ($kategorie as $k): ?>
                            <option value="<?= $k['id'] ?>"
                                <?= $k['id'] == $produkt['kategoria_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['nazwa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-error" id="kategoriaError"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="cena">Cena (zł)</label>
                    <input type="number" id="cena" name="cena" required min="0" step="0.01"
                           value="<?= $produkt['cena'] ?>">
                    <span class="form-error" id="cenaError"></span>
                </div>
                <div class="form-group">
                    <label for="cena_przed">Cena przed promocją (zł) – opcjonalnie</label>
                    <input type="number" id="cena_przed" name="cena_przed" min="0" step="0.01"
                           value="<?= $produkt['cena_przed'] ?? '' ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="zdjecie">Nazwa pliku zdjęcia</label>
                    <input type="text" id="zdjecie" name="zdjecie"
                           value="<?= htmlspecialchars($produkt['zdjecie']) ?>">
                </div>
                <div class="form-group">
                    <label for="dostepnosc">Dostępność</label>
                    <select id="dostepnosc" name="dostepnosc">
                        <option value="1" <?= $produkt['dostepnosc'] ? 'selected' : '' ?>>Dostępny</option>
                        <option value="0" <?= !$produkt['dostepnosc'] ? 'selected' : '' ?>>Niedostępny</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="opis">Opis produktu</label>
                <textarea id="opis" name="opis"><?= htmlspecialchars($produkt['opis']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
<script src="/sklep/assets/js/walidacja-admin.js"></script>