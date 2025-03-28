<header class="header">
    <div class="header__container">
        <nav class="header__nav">
            <?php
            if (is_auth()) { ?>
                <a href=<?= is_admin() ? "/admin/dashboard" : "/finish-register" ?> class="header__link ">Administrar</a>
                <form class="header__form-logout" method="POST" action="/logout">
                    <input type="submit"
                        value="Cerrar sesion"
                        class="dashboard__submit dashboard__submit--logout" />
                </form>
            <?php } else { ?>
                <a href='/register' class="header__link ">Registro</a>
                <a href='/login' class="header__link">Iniciar sesion</a>
            <?php } ?>
        </nav>
        <div class="header__content">
            <a href='/'>
                <h1 class="header__logo">
                    &#60;DevWebCamp/>
                </h1>
            </a>

            <p class="header__text">Octubre 5-6 - 2023</p>
            <p class="header__text header__text--modality">En linea - Presencial</p>
            <a href=<?= empty($_SESSION) ? "/register" : "/finish-register"  ?> class="header__button">Comprar pase</a>

        </div>
    </div>
</header>

<div class="bar">
    <div class="bar__content">
        <a href="/">
            <h2 class="bar__logo">
                &#60;DevWebCamp/>
            </h2>
        </a>
        <nav class="navegation">
            <a href="/devwebcamp" class="navegation__link <?= current_page("/devwebcamp") ? "navegation__link--current" : "" ?>">Evento</a>
            <a href="/packages" class="navegation__link <?= current_page("/packages") ? "navegation__link--current" : "" ?>">Paquetes</a>
            <a href="/workshops-conferences" class="navegation__link <?= current_page("/workshops-conferences") ? "navegation__link--current" : "" ?>">WorkShops - Conferencias</a>
            <?php if (empty($_SESSION)) { ?>
                <a href="/register" class="navegation__link <?= current_page("/register") ? "navegation__link--current" : "" ?>">Comprar pase</a>
            <?php } ?>

        </nav>
    </div>
</div>