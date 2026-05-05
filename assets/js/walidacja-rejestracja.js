document.getElementById('formRejestracja').addEventListener('submit', function (e) {
    var ok = true;

    var nazwa  = document.getElementById('nazwa').value.trim();
    var email  = document.getElementById('email').value.trim();
    var haslo  = document.getElementById('haslo').value;
    var haslo2 = document.getElementById('haslo2').value;

    document.getElementById('nazwaError').textContent  = '';
    document.getElementById('emailError').textContent  = '';
    document.getElementById('hasloError').textContent  = '';
    document.getElementById('haslo2Error').textContent = '';

    var reEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var reNazwa = /^[a-zA-Z0-9_]+$/;

    if (nazwa === '') {
        document.getElementById('nazwaError').textContent = 'Nazwa użytkownika jest wymagana.';
        ok = false;
    } else if (nazwa.length < 3) {
        document.getElementById('nazwaError').textContent = 'Nazwa musi mieć co najmniej 3 znaki.';
        ok = false;
    } else if (!reNazwa.test(nazwa)) {
        document.getElementById('nazwaError').textContent = 'Tylko litery, cyfry i znak _.';
        ok = false;
    }

    if (email === '') {
        document.getElementById('emailError').textContent = 'Adres e-mail jest wymagany.';
        ok = false;
    } else if (!reEmail.test(email)) {
        document.getElementById('emailError').textContent = 'Podaj prawidłowy adres e-mail.';
        ok = false;
    }

    if (haslo.length < 8) {
        document.getElementById('hasloError').textContent = 'Hasło musi mieć co najmniej 8 znaków.';
        ok = false;
    }

    if (haslo2 === '') {
        document.getElementById('haslo2Error').textContent = 'Powtórz hasło.';
        ok = false;
    } else if (haslo !== haslo2) {
        document.getElementById('haslo2Error').textContent = 'Hasła nie są identyczne.';
        ok = false;
    }

    if (!ok) e.preventDefault();
});