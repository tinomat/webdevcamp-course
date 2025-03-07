<h2 class="dashboard__heading"><?= $title ?></h2>

<div class="dashboard__container-button">
    <a href='/admin/speakers' class="dashboard__button">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__form">
    <?php include_once __DIR__ . "/../../templates/alerts.php" ?>
    <!-- El enctype es porque vamos a subir archivos -->
    <form method="POST" class="form" enctype="multipart/form-data">
        <?php include_once __DIR__ . "/form.php"; ?>
        <input type="submit" class="form__submit form__submit--register" value="Registrar ponente">
    </form>
</div>