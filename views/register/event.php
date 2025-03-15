<div class="event">
    <p class=" event__hour"><?= $event->hour->hour ?></p>

    <div class="event__information">
        <h4 class="event__name"><?= $event->name ?></h4>
        <p class="event__intro"><?= $event->description ?></p>

        <div class="event__info-author">
            <picture>
                <!-- Cargamos formato webp en caso de que sea compatible -->
                <source srcset="<?= $_ENV["HOST"] . "/img/speakers/" . $event->speaker->image; ?>.webp" type="image/webp">
                <source srcset="<?= $_ENV["HOST"] . "/img/speakers/" . $event->speaker->image; ?>.png" type="image/png">
                <img class="event__img-author" width="200" height="300" loading="lazy" src="<?= $_ENV["HOST"] . "/img/speakers/" . $event->speaker->image; ?>.png" alt="Imagen ponente">
            </picture>
            <div class="event__name-author">
                <?= $event->speaker->name . " " . $event->speaker->lastname ?>
            </div>
        </div>
        <button
            type="button"
            data-id="<?= $event->id ?>"
            class="event__add"
            <?= ($event->availables == 0) ? "disabled" : ""; ?>>
            <?= $event->availables > 0 ? "Agregar - " . $event->availables . " Disponibles" : "Agotado" ?>
        </button>
    </div>
</div>