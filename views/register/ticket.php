<mian class="page">
    <h2 class="page__heading"><?= $title ?></h2>
    <div class="page__description">Tu boleto - Te recomendamos guardarlo, puedes compartirlo en redes sociales</div>

    <div class="virtual-ticket">
        <div class="ticket ticket--<?= strtolower($register->package->name) ?> ticket--access">
            <div class="ticket__content">
                <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
                <p class="ticket__plan"><?= $register->package->name ?></p>
                <p class="ticket__name"><?= ucfirst($register->user->name) . " " . ucfirst($register->user->lastname) ?></p>
            </div>
            <p class="ticket__code"><?= "#" . $register->token ?></p>
        </div>
    </div>
</mian>