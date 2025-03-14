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
            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
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

<!-- Reemplazar CLIENT_ID por tu client id proporcionado al crear la app desde el developer dashboard) -->
<script src="https://www.paypal.com/sdk/js?client-id=AR8Hcskm7bw6OMMkT4jaf_8B8oi3Tx1Fc6Zv1ZIg0BL4pVvVZCcCxKhYxDcdP-V_gsCpPip0bYvs5LuM&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'sharp',
                color: 'blue',
                layout: 'horizontal',
                label: 'pay',
                tagline: false,
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "1",
                        "amount": {
                            "currency_code": "USD",
                            "value": 199
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Almacenar el id del pago
                    const data = new FormData();
                    // Id del packete en el json con la informacion
                    data.append("package_id", orderData.purchase_units[0].description);
                    // Id del pago
                    data.append("pay_id", orderData.purchase_units[0].payments.captures[0].id);

                    // Mandamos la informacion al endpoint
                    fetch("/finish-register/pay", {
                            // Configuramos metodo post
                            method: "POST",
                            // Pasamos el form data
                            body: data
                        })
                        // Trabajamos con then porque es una promesa
                        .then(answ => answ.json()) // convertimos a json
                        .then(res => { // imprimimos la respuesta
                            if (res.res) {
                                actions.redirect(location.origin + "/finish-register/conferences");
                            }
                        })

                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }

    initPayPalButton();
</script>