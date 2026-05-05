</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <p>&copy; <?= date('Y') ?> TechShop. Wszelkie prawa zastrzeżone.</p>
        <ul class="footer-links">
            <li><a href="/michal-czelusta/index.php">Strona główna</a></li>
            <li><a href="/michal-czelusta/produkty.php">Produkty</a></li>
            <li><a href="/michal-czelusta/kontakt.php">Kontakt</a></li>
            <li><a href="/michal-czelusta/logowanie.php">Logowanie</a></li>
        </ul>
    </div>
</footer>

<script>
    var toggle = document.getElementById('navToggle');
    var nav    = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('open');
        });
    }
</script>

<script src="/michal-czelusta/assets/js/slider.js"></script>
<script src="/michal-czelusta/assets/js/canvas.js"></script>

<script>
    // Przełącznik trybu jasny/ciemny
    var toggleBtn = document.getElementById('toggleTryb');
    
    if (localStorage.getItem('tryb') === 'jasny') {
        document.body.classList.add('jasny');
        if (toggleBtn) toggleBtn.innerHTML = '&#9728;';
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            document.body.classList.toggle('jasny');
            if (document.body.classList.contains('jasny')) {
                localStorage.setItem('tryb', 'jasny');
                toggleBtn.innerHTML = '&#9728;';
            } else {
                localStorage.setItem('tryb', 'ciemny');
                toggleBtn.innerHTML = '&#9790;';
            }
        });
    }
</script>

</body>
</html>