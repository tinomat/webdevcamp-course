<main class="auth">
    <h2 class="auth__heading"><?= $title ?></h2>
    <p class="auth__text">Crea tu cuenta en Dev Web Camp</p>
    <?php
    require_once __DIR__ . "/../templates/alerts.php";
    ?>
    <form method="POST" class="form">
        <div class="form__field">
            <label for="name" class="form__label">Nombre</label>
            <input type="text"
                class="form__input"
                placeholder="Tu name"
                id="name"
                name="name"
                value="<?= $user->name; ?>">
        </div>
        <div class="form__field">
            <label for="lastname" class="form__label">Apellido</label>
            <input type="text"
                class="form__input"
                placeholder="Tu lastname"
                id="lastname"
                name="lastname"
                value="<?= $user->lastname; ?>">
        </div>
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input type="email"
                class="form__input"
                placeholder="Tu email"
                id="email"
                name="email"
                value="<?= $user->email; ?>">
        </div>
        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input type="password"
                class="form__input"
                placeholder="Tu password"
                id="password"
                name="password">
        </div>
        <div class="form__field">
            <label for="password2" class="form__label">Repite tu password</label>
            <input type="password"
                class="form__input"
                placeholder="Repite tu password"
                id="password2"
                name="password2">
        </div>
        <input type="submit" class="form__submit" value="Crear cuenta">
    </form>

    <div class="actions">
        <a href='/login' class="actions__link">Tienes una cuenta? Inicia sesion</a>
        <a href='/forgot' class="actions__link">Olvidaste tu password</a>
    </div>
</main>