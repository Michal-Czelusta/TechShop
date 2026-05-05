document.addEventListener('DOMContentLoaded', function () {

    var canvas = document.getElementById('techCanvas');
    if (!canvas) return;

    var ctx = canvas.getContext('2d');

    var symbole = ['0', '1', '#', '//', '<>', '{}', '>>',
                   'CPU', 'GPU', 'RAM', 'SSD', 'PCIe', 'USB'];

    var kolumny = Math.floor(canvas.width / 50);
    var krople = [];

    for (var i = 0; i < kolumny; i++) {
        krople.push({
            x: i * 50 + 10,
            y: Math.random() * canvas.height,
            predkosc: Math.random() * 1.2 + 0.4,
            symbol: symbole[Math.floor(Math.random() * symbole.length)],
            alpha: Math.random() * 0.5 + 0.3
        });
    }

    function rysuj() {
        ctx.fillStyle = 'rgba(22, 33, 62, 0.18)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        for (var i = 0; i < krople.length; i++) {
            var k = krople[i];
            ctx.font = '14px monospace';
            ctx.fillStyle = 'rgba(245, 0, 87, ' + k.alpha + ')';
            ctx.fillText(k.symbol, k.x, k.y);

            k.y += k.predkosc;

            if (Math.random() < 0.01) {
                k.symbol = symbole[Math.floor(Math.random() * symbole.length)];
            }

            if (k.y > canvas.height) {
                k.y = 0;
                k.x = Math.floor(Math.random() * kolumny) * 50 + 10;
                k.predkosc = Math.random() * 1.2 + 0.4;
                k.alpha = Math.random() * 0.5 + 0.3;
            }
        }

        requestAnimationFrame(rysuj);
    }

    rysuj();

});