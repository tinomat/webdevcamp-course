<fieldset class="form__fieldset">
    <legend class="form__legend">
        Informacion del evento
    </legend>
    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input type="text"
            id="name"
            placeholder="Nombre del evento"
            class="form__input"
            name="name"
            value="<?= $event->name ?? "" ?>">
    </div>
    <div class="form__field">
        <label for="category" class="form__label">Categoria o tipo de evento</label>
        <select
            class="form__select"
            id="category"
            name="category_id">
            <option value="" disabled selected>- Selecciona una opcion</option>
            <?php
            foreach ($categories as $category) { ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form__field">
        <label for="day" class="form__label">Selecciona el dia</label>
        <div class="form__radio">
            <?php foreach ($days as $day) { ?>
                <div>
                    <label for="<?= strtolower($day->name) ?>"><?= $day->name ?></label>
                    <input type="radio"
                        id="<?= strtolower($day->name) ?>"
                        name="day"
                        value="<?= $day->id ?>">
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="form__field">
        <label for="hour" class="form__label">Selecciona la hora del evento</label>
        <ul class="hours">
            <?php foreach ($hours as $hour) { ?>
                <li class="hours__hour"><?= $hour->hour ?></li>
            <?php } ?>
        </ul>
    </div>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">
        Informacion extra
    </legend>
    <div class="form__field">
        <label for="speakers" class="form__label">Ponente</label>
        <input type="text"
            class="form__input"
            id="speakers"
            placeholder="Buscar Ponente">
    </div>
    <div class="form__field">
        <label for="available" class="form__label">Lugares disponibles</label>
        <input type="number"
            min="1"
            class="form__input"
            id="available"
            placeholder="Ej. 20">
    </div>
</fieldset>