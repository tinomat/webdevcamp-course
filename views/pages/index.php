<?php
include_once __DIR__ . "/conferences.php";
?>
<section class="resume">
    <div class="resume__grid">
        <div class="resume__block">
            <p class="resume__text resume__text--number"><?= $totalSpeakers ?></p>
            <p class="resume__text ">Speakers</p>
        </div>
        <div class="resume__block">
            <p class="resume__text resume__text--number"><?= $totalConferences ?></p>
            <p class="resume__text ">Conferencias</p>
        </div>
        <div class="resume__block">
            <p class="resume__text resume__text--number"><?= $totalWorkshops ?></p>
            <p class="resume__text ">Workshops</p>
        </div>
        <div class="resume__block">
            <p class="resume__text resume__text--number">500</p>
            <p class="resume__text ">Asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__description">Conoce a nuestros expertos de devwebcamp</p>
    <div class="speakers__grid slider swiper">
        <div class="swiper-wrapper">
            <?php foreach ($speakers as $speaker) { ?>
                <?php include __DIR__ . "/../templates/speaker.php"; ?>
            <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<!-- Inyection map from js -->
<div class="wrapper-map">
    <div class="map" id="map"></div>
</div>