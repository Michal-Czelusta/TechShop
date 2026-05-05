document.getElementById('formLogowanie').addEventListener('submit', function (e) {
    var ok = true;

    var email = document.getElementById('email').value.trim();
    var haslo = document.getElementById('haslo').value;

    document.getElementById('emailError').textContent = '';
    document.getElementById('hasloError').textContent = '';

    var reEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '') {
        document.getElementById('emailError').textContent = 'Podaj adres e-mail.';
        ok = false;
    } else if (!reEmail.test(email)) {
        document.getElementById('emailError').textContent = 'Podaj prawidłowy adres e-mail.';
        ok = false;
    }

    if (haslo === '') {
        document.getElementById('hasloError').textContent = 'Podaj hasło.';
        ok = false;
    }

    if (!ok) e.preventDefault();
});