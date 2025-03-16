<h2 class="dashboard__heading"><?= $title ?></h2>
<div class="dashboard__container">
    <?php
    if (!empty($registered)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Plan</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php
                foreach ($registered as $register) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?= ucfirst($register->user->name) . " " . ucfirst($register->user->lastname)  ?>
                        </td>
                        <td class="table__td">
                            <?= $register->user->email ?>
                        </td>
                        <td class="table__td">
                            <?= $register->package->name ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">Aún no hay Registros</p>
    <?php } ?>
</div>

<!-- Paginacion -->
<?= $pagination ?>