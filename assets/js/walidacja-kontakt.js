document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('formKontakt');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        var ok = true;

        var imie      = document.getElementById('imie').value.trim();
        var email     = document.getElementById('email').value.trim();
        var temat     = document.getElementById('temat').value.trim();
        var wiadomosc = document.getElementById('wiadomosc').value.trim();

        document.getElementById('imieError').textContent      = '';
        document.getElementById('emailError').textContent     = '';
        document.getElementById('tematError').textContent     = '';
        document.getElementById('wiadomoscError').textContent = '';

        var reEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (imie === '') {
            document.getElementById('imieError').textContent = 'Imię jest wymagane.';
            ok = false;
        }

        if (!reEmail.test(email)) {
            document.getElementById('emailError').textContent = 'Podaj prawidłowy adres e-mail.';
            ok = false;
        }

        if (temat === '') {
            document.getElementById('tematError').textContent = 'Temat jest wymagany.';
            ok = false;
        }

        if (wiadomosc.length < 10) {
            document.getElementById('wiadomoscError').textContent = 'Wiadomość jest za krótka (min. 10 znaków).';
            ok = false;
        }

        if (!ok) e.preventDefault();
    });
});