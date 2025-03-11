<main class="schedule">
    <h2 class="schedule__heading">Workshops & Conferencias</h2>
    <p class="schedule__description">Talleres y conferencias dictados por expertos en desarrollo web</p>

    <div class="events">
        <h3 class="events__heading">&lt; Conferencias /></h3>
        <p class="events__date">Viernes 3 de octubre</p>

        <div class="events__list slider swiper">
            <div class="swiper-wrapper">
                <?php
                foreach ($events["f_conferences"] as $event) {
                    include __DIR__ . "/../templates/event.php";
                } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="events__date">Sabado 4 de octubre</p>
        <div class="events__list">
            <div class="events__list slider swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($events["s_conferences"] as $event) {
                        include __DIR__ . "/../templates/event.php";
                    } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <div class="events events--workshops">
        <h3 class="events__heading">&lt; Workshops /></h3>
        <p class="events__date">Viernes 3 de octubre</p>

        <div class="events__list">
            <div class="events__list slider swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($events["f_workshops"] as $event) {
                        include __DIR__ . "/../templates/event.php";
                    } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <p class="events__date">Sabado 4 de octubre</p>
        <div class="events__list">
            <div class="events__list slider swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($events["s_workshops"] as $event) {
                        include __DIR__ . "/../templates/event.php";
                    } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</main>