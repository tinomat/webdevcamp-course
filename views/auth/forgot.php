<main class="auth">
    <h2 class="auth__heading"><?= $title ?></h2>
    <p class="auth__text">Reestablece tu password, Dev Web Camp</p>
    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    ?>
    <form method="POST" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input type="email"
                class="form__input"
                placeholder="Tu email"
                id="email"
                name="email">
        </div>
        <input type="submit" class="form__submit" value="Enviar solicitud">
    </form>
    <div class="actions">
        <a href='/login' class="actions__link">Tienes una cuenta? Inicia sesion</a>
        <a href='/register' class="actions__link">Aun no tienes cuenta? Obtener una</a>
    </div>
</main>