<?php
include_once __DIR__ . "/conferences.php";
?>
<section class="resume">
    <div class="resume__grid">
        <div data-aos=<?php aos_animations() ?> class="resume__block">
            <p class="resume__text resume__text--number"><?= $totalSpeakers ?></p>
            <p class="resume__text ">Speakers</p>
        </div>
        <div data-aos=<?php aos_animations() ?> class="resume__block">
            <p class="resume__text resume__text--number"><?= $totalConferences ?></p>
            <p class="resume__text ">Conferencias</p>
        </div>
        <div data-aos=<?php aos_animations() ?> class="resume__block">
            <p class="resume__text resume__text--number"><?= $totalWorkshops ?></p>
            <p class="resume__text ">Workshops</p>
        </div>
        <div data-aos=<?php aos_animations() ?> class="resume__block">
            <p class="resume__text resume__text--number">500</p>
            <p class="resume__text ">Asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__description">Conoce a nuestros expertos de devwebcamp</p>
    <div data-aos=<?php aos_animations() ?> class="speakers__grid ">
        <?php foreach ($speakers as $speaker) { ?>
            <?php include __DIR__ . "/../templates/speaker.php"; ?>
        <?php } ?>
    </div>
</section>

<!-- Inyection map from js -->
<div class="wrapper-map">
    <h2 class="map__heading">Nuestro centro</h2>
    <div class="map" id="map"></div>
</div>

<section class="tickets">
    <h2 class="tickets__heading">Boletos & Precios</h2>
    <p class="tickets__description">Precios para DevWebCamp</p>

    <div class="tickets__grid">
        <div data-aos=<?php aos_animations() ?> class="ticket ticket--presencial">
            <h4 class="ticket__logo">
                &#60;DevWebCamp/>
            </h4>
            <p class="ticket__plan">Presencial</p>
            <p class="ticket__price">$199</p>
        </div>
        <div data-aos=<?php aos_animations() ?> class="ticket ticket--virtual">
            <h4 class="ticket__logo">
                &#60;DevWebCamp/>
            </h4>
            <p class="ticket__plan">Virtual</p>
            <p class="ticket__price">$49</p>
        </div>
        <div data-aos=<?php aos_animations() ?> class="ticket ticket--free">
            <h4 class="ticket__logo">
                &#60;DevWebCamp/>
            </h4>
            <p class="ticket__plan">Gratis</p>
            <p class="ticket__price">Gratis - $0</p>
        </div>
    </div>

    <div class="tickets__link-container">
        <a href="/packages" class="tickets__link">Ver paquetes</a>
    </div>
</section>