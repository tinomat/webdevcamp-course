<main class="auth">
    <h2 class="auth__heading"><?= $title ?></h2>
    <p class="auth__text">Inicia sesion Dev Web Camp</p>
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
        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input type="password"
                class="form__input"
                placeholder="Tu password"
                id="password"
                name="password">
        </div>
        <input type="submit" class="form__submit" value="Iniciar sesion">
    </form>
    <div class="actions">
        <a href='/register' class="actions__link">Aun no tienes cuenta? Obtener una</a>
        <a href='/forgot' class="actions__link">Olvidaste tu password</a>
    </div>
</main>