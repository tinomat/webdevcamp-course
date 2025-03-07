<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href='/admin/dashboard'>
            <h2 class="dashboard__logo">
                &#60;WebDevCamp/>
            </h2>
        </a>
        <?php
        if (!current_page("/edit") && !current_page("/create")) { ?>
            <nav class="dashboard__nav">
                <form class="dashboard__form-logout" method="POST">
                    <input type="submit"
                        value="Cerrar sesion"
                        class="dashboard__submit dashboard__submit--logout" />
                </form>
            </nav>
        <?php } ?>
    </div>
</header>