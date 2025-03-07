<main class="auth">
    <h2 class="auth__heading"><?= $title ?></h2>
    <p class="auth__text">Tu cuenta DevWebCamp</p>
    <?php
    require_once __DIR__ . "/../templates/alerts.php";
    ?>
    <div class="actions actions--center">
        <a href='/login' class="actions__link">Tienes una cuenta? Inicia sesion</a>
    </div>
</main>