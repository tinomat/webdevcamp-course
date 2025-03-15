<h2 class="page__heading"><?= $title  ?></h2>
<p class="page__description">Elige hasta 5 eventos para asistir de forma presencial</p>

<div class="register-events">
    <main class="register-events__list">
        <h3 class="register-events__heading--conferences">&lt; Conferencias /></h3>
        <p class="register-events__date">Viernes 3 de octubre</p>

        <div class="register-events__grid">
            <?php
            foreach ($events["f_conferences"] as $event) {
                include __DIR__ . "/event.php";
            } ?>
        </div>

        <p class="register-events__date">Sabado 4 de octubre</p>
        <div class="register-events__grid">
            <?php
            foreach ($events["s_conferences"] as $event) {
                include __DIR__ . "/event.php";
            } ?>
        </div>
        <h3 class="register-events__heading--workshops">&lt; WorkShops /></h3>
        <p class="register-events__date">Viernes 3 de octubre</p>

        <div class="register-events__grid events--workshops">
            <?php
            foreach ($events["f_workshops"] as $event) {
                include __DIR__ . "/event.php";
            } ?>
        </div>

        <p class="register-events__date ">Sabado 4 de octubre</p>
        <div class="register-events__grid events--workshops">
            <?php
            foreach ($events["s_workshops"] as $event) {
                include __DIR__ . "/event.php";
            } ?>
        </div>
    </main>
    <aside class="register">
        <h2 class="register__heading">Tu Registro</h2>
        <!-- Se llena con js -->
        <div id="register-resume" class="register__resume"></div>

        <div class="register__gift">
            <label for="gift" class="register__label">Selecciona un regalo</label>
            <select id="gift" class="register__select">
                <option value="" selected disabled>- Selecciona tu regalo</option>
                <?php
                foreach ($gifts as $gift) { ?>
                    <option value="<?= $gift->id ?>"><?= $gift->name ?></option>
                <?php }
                ?>
            </select>
        </div>

        <form id="register" class="form">
            <div class="form__field">
                <input type="submit" class="form__submit form__submit--full" value="Registrarme">
            </div>
        </form>
    </aside>
</div>