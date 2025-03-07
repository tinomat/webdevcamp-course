<main class="auth">
    <h2 class="auth__heading"><?= $title ?></h2>
    <p class="auth__text">Coloca tu nuevo password</p>
    <?php
    require_once __DIR__ . "/../templates/alerts.php";
    if ($valid_token) { ?>
        <form method="POST" class="form">
            <div class="form__field">
                <label for="password" class="form__label">Password</label>
                <input type="password"
                    class="form__input"
                    placeholder="Tu password"
                    id="password"
                    name="password">
            </div>
            <input type="submit" class="form__submit" value="Cambiar password">
        </form>
        <div class="actions">
            <a href='/login' class="actions__link">Tienes una cuenta? Inicia sesion</a>
            <a href='/forgot' class="actions__link">Olvidaste tu password</a>
        </div>
    <?php } ?>
</main>