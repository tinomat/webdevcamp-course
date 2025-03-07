<h2 class="dashboard__heading"><?= $title ?></h2>

<div class="dashboard__container-button">
    <a href='/admin/speakers/create' class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir ponente
    </a>
</div>

<div class="dashboard__container">
    <?php
    if (!empty($speakers)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicacion</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php
                foreach ($speakers as $speaker) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?= $speaker->name . " " . $speaker->lastname; ?>
                        </td>
                        <td class="table__td">
                            <?= $speaker->city . ", " . $speaker->country; ?>
                        </td>

                        <td class="table__td table__td--actions">
                            <a class="table__action table__action--edit" href='/admin/speakers/edit?id=<?= $speaker->id ?>'>
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>
                            <form method="POST" action="/admin/speakers/delete" class="table__form">
                                <input type="hidden" name="id" value="<?= $speaker->id ?>">
                                <button class="table__action table__action-delete" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">Aún no hay ponentes</p>
    <?php } ?>
</div>