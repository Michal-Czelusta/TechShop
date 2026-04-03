<?php
session_start();
$pageTitle = 'Logowanie';

$bledy  = $_SESSION['bledy']  ?? [];
$sukces = $_SESSION['sukces'] ?? '';
unset($_SESSION['bledy'], $_SESSION['sukces']);

require_once 'includes/header.php';
?>

<div class="container page-auth">
    <div class="auth-box">
        <h1>Logowanie</h1>

        <?php if ($sukces): ?>
            <p class="alert alert-sukces"><?= htmlspecialchars($sukces) ?></p>
        <?php endif; ?>

        <?php if (!empty($bledy)): ?>
            <div class="alert alert-blad">
                <?php foreach ($bledy as $b): ?>
                    <p><?= htmlspecialchars($b) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="/sklep/includes/logowanie_akcja.php" method="POST" id="formLogowanie" novalidate>
            <div class="form-group">
                <label for="email">Adres e-mail</label>
                <input type="email" id="email" name="email" required placeholder="np. jan@example.com">
                <span class="form-error" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="haslo">Hasło</label>
                <input type="password" id="haslo" name="haslo" required placeholder="Twoje hasło">
                <span class="form-error" id="hasloError"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Zaloguj się</button>
        </form>
        <p class="auth-link">Nie masz konta? <a href="/sklep/rejestracja.php">Zarejestruj się</a></p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="/sklep/assets/js/walidacja-logowanie.js"></script>