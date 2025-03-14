<main class="packages">
    <h2 class="packages__heading"><?= $title ?></h2>
    <p class="packages__description">
        Compara los paquetes de DevWebCamp
    </p>

    <div class="packages__grid">
        <div data-aos=<?php aos_animations() ?> class="package">
            <h3 class="package__name">Pase gratis</h3>
            <ul class="package__list">
                <li class="package__element">Acceso virtual a DevWebCamp</li>
            </ul>
            <p class="package__price">$0</p>
        </div>
        <div data-aos=<?php aos_animations() ?> class="package">
            <h3 class="package__name">Pase Presencial</h3>
            <ul class="package__list">
                <li class="package__element">Acceso presencial a DevWebCamp</li>
                <li class="package__element">Pase por 2 días</li>
                <li class="package__element">Acceso a talleres y conferencias</li>
                <li class="package__element">Acceso a las grabaciones</li>
                <li class="package__element">Camisa del evento</li>
                <li class="package__element">Comida y bebida</li>
            </ul>
            <p class="package__price">$199</p>

        </div>
        <div data-aos=<?php aos_animations() ?> class="package">
            <h3 class="package__name">Pase virtual</h3>
            <ul class="package__list">
                <li class="package__element">Acceso virtual a DevWebCamp</li>
                <li class="package__element">Pase por 2 días</li>
                <li class="package__element">Enlace a talleres y conferencias</li>
                <li class="package__element">Acceso a las grabaciones</li>
            </ul>
            <p class="package__price">$49</p>
        </div>
    </div>
</main>