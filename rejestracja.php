<?php
session_start();
$pageTitle = 'Rejestracja';

$bledy      = $_SESSION['bledy']       ?? [];
$stary_input = $_SESSION['stary_input'] ?? [];
unset($_SESSION['bledy'], $_SESSION['stary_input']);

require_once 'includes/header.php';
?>

<div class="container page-auth">
    <div class="auth-box">
        <h1>Rejestracja</h1>

        <?php if (!empty($bledy)): ?>
            <div class="alert alert-blad">
                <?php foreach ($bledy as $b): ?>
                    <p><?= htmlspecialchars($b) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="/sklep/includes/rejestracja_akcja.php" method="POST" id="formRejestracja" novalidate>
            <div class="form-group">
                <label for="nazwa">Nazwa użytkownika</label>
                <input type="text" id="nazwa" name="nazwa" required
                       placeholder="np. janek123"
                       value="<?= htmlspecialchars($stary_input['nazwa'] ?? '') ?>">
                <span class="form-error" id="nazwaError"></span>
            </div>
            <div class="form-group">
                <label for="email">Adres e-mail</label>
                <input type="email" id="email" name="email" required
                       placeholder="np. jan@example.com"
                       value="<?= htmlspecialchars($stary_input['email'] ?? '') ?>">
                <span class="form-error" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="haslo">Hasło</label>
                <input type="password" id="haslo" name="haslo" required placeholder="Min. 8 znaków">
                <span class="form-error" id="hasloError"></span>
            </div>
            <div class="form-group">
                <label for="haslo2">Powtórz hasło</label>
                <input type="password" id="haslo2" name="haslo2" required placeholder="Powtórz hasło">
                <span class="form-error" id="haslo2Error"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Zarejestruj się</button>
        </form>
        <p class="auth-link">Masz już konto? <a href="/sklep/logowanie.php">Zaloguj się</a></p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="/sklep/assets/js/walidacja-rejestracja.js"></script>