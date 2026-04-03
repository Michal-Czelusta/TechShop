<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rola'] !== 'admin') {
    header('Location: /sklep/logowanie.php');
    exit;
}
$pageTitle = 'Panel administratora';
require_once '../includes/db.php';
require_once '../includes/header.php';

$produkty = $pdo->query('SELECT p.*, k.nazwa AS kategoria_nazwa FROM produkty p JOIN kategorie k ON p.kategoria_id = k.id ORDER BY p.id DESC')->fetchAll();
?>

<div class="container page-admin">
    <h1 class="page-title">Panel administratora</h1>

    <?php if (isset($_GET['komunikat'])): ?>
        <p class="alert alert-<?= htmlspecialchars($_GET['typ'] ?? 'info') ?>">
            <?= htmlspecialchars($_GET['komunikat']) ?>
        </p>
    <?php endif; ?>

    <a href="/sklep/admin/dodaj.php" class="btn btn-primary">+ Dodaj produkt</a>

    <table class="admin-tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Kategoria</th>
                <th>Cena</th>
                <th>Dostępność</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produkty as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nazwa']) ?></td>
                <td><?= htmlspecialchars($p['kategoria_nazwa']) ?></td>
                <td><?= number_format($p['cena'], 2, ',', ' ') ?> zł</td>
                <td><?= $p['dostepnosc'] ? 'Tak' : 'Nie' ?></td>
                <td class="akcje">
                    <a href="/sklep/admin/edytuj.php?id=<?= $p['id'] ?>" class="btn btn-secondary btn-sm">Edytuj</a>
                    <a href="/sklep/admin/usun.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?')">Usuń</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>