<main class="register">
    <h2 class="register__heading"><?= $title ?></h2>
    <p class="register__description">Elige tu plan</p>

    <div class="packages__grid">
        <div class="package">
            <h3 class="package__name">Pase gratis</h3>
            <ul class="package__list">
                <li class="package__element">Acceso virtual a DevWebCamp</li>
            </ul>
            <p class="package__price">$0</p>
            <form method="POST" action="/finish-register/free">
                <input type="submit" class="package__submit" value="Inscripcion gratis">
            </form>
        </div>
        <div class="package">
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
            <div id="paypal-container-T398V3B7MLX22"></div>

        </div>
        <div class="package">
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

<script src="https://www.paypal.com/sdk/js?client-id=BAAzZV3Cs_EGULXONMmy-zBKydhKkValTdlB62P8FWrV4rBakaAJH8ZLtSuVPWydzLMiUT1BfE15GwZbb0&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>
<script>
    paypal.HostedButtons({
        hostedButtonId: "T398V3B7MLX22",
    }).render("#paypal-container-T398V3B7MLX22")
</script>