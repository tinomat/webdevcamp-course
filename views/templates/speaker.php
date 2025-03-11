<div data-aos=<?php aos_animations() ?> class="speaker">
    <picture>
        <!-- Cargamos formato webp en caso de que sea compatible -->
        <source srcset="<?= $_ENV["HOST"] . "/img/speakers/" . $speaker->image; ?>.webp" type="image/webp">
        <source srcset="<?= $_ENV["HOST"] . "/img/speakers/" . $speaker->image; ?>.png" type="image/png">
        <img class="speaker__img" width="200" height="300" loading="lazy" src="<?= $_ENV["HOST"] . "/img/speakers/" . $speaker->image; ?>.png" alt="Imagen ponente">
    </picture>
    <div class="speaker__info">
        <h4 class="speaker__name">
            <?= $speaker->name . " " . $speaker->lastname ?>
        </h4>
        <p class="speaker__location">
            <?= $speaker->city . ", " .  $speaker->country ?>
        </p>
        <nav class="speaker-socials">
            <?php
            // con (array) convertimos el json_decode en un array
            $networks = (array) json_decode($speaker->networks);
            // Iteramos como array asociativo
            foreach ($networks as $key => $network) {
                // Si la red social existe
                if (!empty($network)) { ?>
                    <!-- Agregamos enlace de referencia, el link será igual a la url almacenada -->
                    <a class="speaker-socials__link" rel="noopener noreferrer" target="_blank" href="<?= $network ?>">
                        <!-- Span para accesibilidad, con el nombre de la red social es decir su $key en el array asociativo -->
                        <!-- ucfirst($text), cambia a mayusculas la primer letra de un string -->
                        <span class="speaker-socials__hidden"><?= ucfirst($key) ?></span>
                    </a>
            <?php  }
            } ?>
        </nav>
        <ul class="speaker__skills-list">
            <?php
            // Creamos array con los tags separados por coma
            $tags = explode(",", $speaker->tags);
            foreach ($tags as $tag) { ?>
                <li class="speaker__skill"><?= $tag ?></li>
            <?php } ?>
        </ul>
    </div>
</div>