document.addEventListener('DOMContentLoaded', function () {

    var slajdy = document.querySelectorAll('.slide');
    var aktualny = 0;
    var timer;

    function pokazSlajd(index) {
        for (var i = 0; i < slajdy.length; i++) {
            slajdy[i].classList.remove('active');
        }
        slajdy[index].classList.add('active');
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

    if (slajdy.length > 0) {
        pokazSlajd(0);
        startTimer();
    }

});