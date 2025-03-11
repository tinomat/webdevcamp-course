<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?= $title ?></h2>
    <p class="devwebcamp__description">Conoce la conferencia más importante de Latinoamerica</p>
    <div class="devwebcamp__grid">
        <div data-aos=<?php aos_animations() ?> class="devwebcamp__img">
            <picture>
                <source srcset="/build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="/build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="/build/img/sobre_devwebcamp.jpg" alt="imagen devwebcamp">
            </picture>
        </div>
        <div data-aos=<?php aos_animations() ?> class="devwebcamp__content">
            <p class="devwebcamp__text">
                DevWebCamp es el lugar ideal para los entusiastas de la programación. Ofrecemos conferencias y talleres exclusivos sobre las últimas tendencias y tecnologías en el mundo del desarrollo web. Únete a nosotros y aprende de los mejores profesionales, mejora tus habilidades y conecta con una comunidad apasionada por la innovación. ¡No pierdas la oportunidad de ser parte de este evento único que transformará tu futuro en la programación!
            </p>
            <p class="devwebcamp__text">
                Sumérgete en un ambiente de aprendizaje y colaboración, donde conferencias y talleres sobre las últimas tecnologías y metodologías de desarrollo web te esperan. Aprende de expertos de la industria, mejora tus habilidades técnicas y conéctate con una comunidad vibrante y creativa. No te pierdas la oportunidad de formar parte de DevWebCamp y lleva tu carrera en programación al siguiente nivel.
            </p>
        </div>
    </div>
</main>