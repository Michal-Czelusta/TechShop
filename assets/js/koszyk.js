function zmienIlosc(btn, zmiana) {
    var form = btn.closest('.form-ilosc');
    var input = form.querySelector('.ilosc-input');
    var nowaWartosc = parseInt(input.value) + zmiana;
    if (nowaWartosc < 1) nowaWartosc = 1;
    if (nowaWartosc > 99) nowaWartosc = 99;
    input.value = nowaWartosc;
}