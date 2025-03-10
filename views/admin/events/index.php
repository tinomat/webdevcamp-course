<h2 class="dashboard__heading"><?= $title ?></h2>

<div class="dashboard__container-button">
    <a href='/admin/events/create' class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir evento
    </a>
</div>

<div class="dashboard__container">
    <?php
    if (!empty($events)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Categoria</th>
                    <th scope="col" class="table__th">Dia y hora</th>
                    <th scope="col" class="table__th">Ponentes</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php
                foreach ($events as $event) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?= $event->name ?>
                        </td>
                        <td class="table__td">
                            <?= $event->category->name ?>
                        </td>
                        <td class="table__td">
                            <?= $event->day->name . ", " . $event->hour->hour . "hs" ?>
                        </td>
                        <td class="table__td">
                            <?= $event->speaker->name . " " . $event->speaker->lastname  ?>
                        </td>
                        <td class="table__td table__td--actions">
                            <a class="table__action table__action--edit" href='/admin/events/edit?id=<?= $event->id ?>'>
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>
                            <form method="POST" action="/admin/events/delete" class="table__form">
                                <input type="hidden" name="id" value="<?= $event->id ?>">
                                <button class="table__action table__action--delete" type="submit">
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
        <p class="text-center">Aún no hay eventos</p>
    <?php } ?>
</div>

<!-- Paginacion -->
<?= $pagination ?>