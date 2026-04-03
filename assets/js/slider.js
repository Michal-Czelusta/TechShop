document.addEventListener('DOMContentLoaded', function () {

    var slajdy = document.querySelectorAll('.slide');
    var aktualny = 0;
    var timer;

    function pokazSlajd(index) {
        for (var i = 0; i < slajdy.length; i++) {
            slajdy[i].classList.remove('active');
        }
        var kropki = document.querySelectorAll('.dot');
        for (var i = 0; i < kropki.length; i++) {
            kropki[i].classList.remove('active');
        }
        slajdy[index].classList.add('active');
        if (kropki[index]) kropki[index].classList.add('active');
    }

    function nastepny() {
        aktualny = (aktualny + 1) % slajdy.length;
        pokazSlajd(aktualny);
    }

    function poprzedni() {
        aktualny = (aktualny - 1 + slajdy.length) % slajdy.length;
        pokazSlajd(aktualny);
    }

    function startTimer() {
        timer = setInterval(nastepny, 4000);
    }

    function stopTimer() {
        clearInterval(timer);
    }

    var btnNext = document.getElementById('sliderNext');
    var btnPrev = document.getElementById('sliderPrev');

    if (btnNext) {
        btnNext.addEventListener('click', function () {
            stopTimer();
            nastepny();
            startTimer();
        });
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', function () {
            stopTimer();
            poprzedni();
            startTimer();
        });
    }

    var kontenerKropek = document.getElementById('sliderDots');
    if (kontenerKropek) {
        for (var i = 0; i < slajdy.length; i++) {
            var kropka = document.createElement('button');
            kropka.classList.add('dot');
            if (i === 0) kropka.classList.add('active');
            kropka.setAttribute('aria-label', 'Slajd ' + (i + 1));
            (function (idx) {
                kropka.addEventListener('click', function () {
                    stopTimer();
                    aktualny = idx;
                    pokazSlajd(aktualny);
                    startTimer();
                });
            })(i);
            kontenerKropek.appendChild(kropka);
        }
    }

    if (slajdy.length > 0) {
        pokazSlajd(0);
        startTimer();
    }

});