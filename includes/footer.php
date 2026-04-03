</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <p>&copy; <?= date('Y') ?> TechShop. Wszelkie prawa zastrzeżone.</p>
        <ul class="footer-links">
            <li><a href="/sklep/index.php">Strona główna</a></li>
            <li><a href="/sklep/produkty.php">Produkty</a></li>
            <li><a href="/sklep/rejestracja.php">Rejestracja</a></li>
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

<script src="/sklep/assets/js/slider.js"></script>
<script src="/sklep/assets/js/canvas.js"></script>

</body>
</html>