document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('formDodaj');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        var ok = true;

        var nazwa = document.getElementById('nazwa').value.trim();
        var cena  = document.getElementById('cena').value;
        var kat   = document.getElementById('kategoria_id').value;

        document.getElementById('nazwaError').textContent    = '';
        document.getElementById('cenaError').textContent     = '';
        document.getElementById('kategoriaError').textContent = '';

        if (nazwa === '') {
            document.getElementById('nazwaError').textContent = 'Nazwa produktu jest wymagana.';
            ok = false;
        }

        if (cena === '' || isNaN(cena) || parseFloat(cena) < 0) {
            document.getElementById('cenaError').textContent = 'Podaj prawidłową cenę.';
            ok = false;
        }

        if (kat === '') {
            document.getElementById('kategoriaError').textContent = 'Wybierz kategorię.';
            ok = false;
        }

        if (!ok) e.preventDefault();
    });
});