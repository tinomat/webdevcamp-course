<h2 class="dashboard__heading"><?= $title ?></h2>

<main class="blocks">
    <div class="blocks__grid">
        <div class="block">
            <h3 class="block__heading">Ultimos Registros</h3>
            <div class="block__content">
                <?php
                foreach ($registers as $register) { ?>
                    <p class="block__text">-
                        <?= ucfirst($register->user->name) . " " . $register->user->lastname ?>
                    </p>
                    <span class="block__text--plan">Paquete <?= $register->package->name ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="block">
            <h3 class="block__heading">Ingresos</h3>
            <p class="block__text--amount">$<?= $earnings ?>USD</p>
        </div>
        <div class="block">
            <h3 class="block__heading">Eventos con menos lugares disponibles</h3>
            <?php
            foreach ($low_availables as $event) { ?>
                <p class="block__text">-
                    <?= $event->name . " - " . $event->availables . " Disponibles" ?>
                </p>
            <?php } ?>
        </div>
        <div class="block">
            <h3 class="block__heading">Eventos con más lugares disponibles</h3>
            <?php
            foreach ($high_availables as $event) { ?>
                <p class="block__text">-
                    <?= $event->name . " - " . $event->availables . " Disponibles" ?>
                </p>
            <?php } ?>
        </div>
    </div>
</main>