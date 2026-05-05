<?php
$pageTitle = 'Strona główna';
require_once 'includes/header.php';
?>

<section class="hero-slider" id="heroSlider">
    <div class="slide slide-1 active">
        <div class="slide-content">
            <div class="slide-icon">&#128187;</div>
            <h2>Najlepsze podzespoły w świetnych cenach</h2>
            <p>Karty graficzne, procesory, pamięci RAM i wiele więcej.</p>
            <a href="/michal-czelusta/produkty.php" class="btn btn-primary">Zobacz ofertę</a>
        </div>
    </div>
    <div class="slide slide-2">
        <div class="slide-content">
            <div class="slide-icon">&#127881;</div>
            <h2>Promocje tygodnia</h2>
            <p>Sprawdź przecenione produkty &ndash; tylko przez ograniczony czas!</p>
            <a href="/michal-czelusta/produkty.php" class="btn btn-primary">Sprawdź promocje</a>
        </div>
    </div>
    <div class="slide slide-3">
        <div class="slide-content">
            <div class="slide-icon">&#127381;</div>
            <h2>Nowości &ndash; RTX 4060 już dostępna</h2>
            <p>Karta graficzna nowej generacji z obsługą DLSS 3.</p>
            <a href="/michal-czelusta/produkty.php" class="btn btn-primary">Dowiedz się więcej</a>
        </div>
    </div>
    <button type="button" class="slider-btn prev" id="sliderPrev">&#10094;</button>
    <button type="button" class="slider-btn next" id="sliderNext">&#10095;</button>
</section>

<section class="section-categories">
    <div class="container">
        <h2 class="section-title">Kategorie produktów</h2>
        <div class="categories-grid">
            <a href="/michal-czelusta/produkty.php?kategoria=karty-graficzne" class="category-card">
                <span class="category-icon">&#127918;</span>
                <span>Karty graficzne</span>
            </a>
            <a href="/michal-czelusta/produkty.php?kategoria=procesory" class="category-card">
                <span class="category-icon">&#9881;</span>
                <span>Procesory</span>
            </a>
            <a href="/michal-czelusta/produkty.php?kategoria=pamieci-ram" class="category-card">
                <span class="category-icon">&#128190;</span>
                <span>Pamięć RAM</span>
            </a>
            <a href="/michal-czelusta/produkty.php?kategoria=dyski-ssd" class="category-card">
                <span class="category-icon">&#128191;</span>
                <span>Dyski SSD</span>
            </a>
        </div>
    </div>
</section>

<section class="section-canvas">
    <div class="container">
        <h2 class="section-title">Zbuduj swój komputer</h2>
        <p class="section-subtitle">Interaktywna wizualizacja</p>
        <canvas id="techCanvas" width="800" height="220">
            Twoja przeglądarka nie obsługuje elementu canvas.
        </canvas>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>