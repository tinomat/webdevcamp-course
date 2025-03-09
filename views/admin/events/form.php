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
        <label for="description" class="form__label">Descripcion</label>
        <textarea name="description"
            id="description"
            class="form__input form__input--textarea"
            placeholder="Descripcion del evento"
            rows="8"><?= $event->description ?></textarea>
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
                <option <?= $event->category_id === $category->id ? "selected" : "" ?> value="<?= $category->id ?>"><?= $category->name ?></option>
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
        <input type="hidden" name="day_id" value="">
    </div>
    <div class="form__field">
        <label for="hour" class="form__label">Selecciona la hora del evento</label>
        <ul class="hours" id="hours">
            <?php foreach ($hours as $hour) { ?>
                <li class="hours__hour hours__hour--disabled" data-hour_id="<?= $hour->id ?>"><?= $hour->hour ?></li>
            <?php } ?>
        </ul>
        <input type="hidden" name="hour_id" value="">
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
            placeholder="Buscar Ponente"
            value="">

        <ul id="speakers-list" class="speakers-list"></ul>

        <input type="hidden" name="speaker_id" value="">
    </div>
    <div class="form__field">
        <label for="available" class="form__label">Lugares disponibles</label>
        <input type="number"
            min="1"
            class="form__input"
            id="available"
            placeholder="Ej. 20"
            name="availables"
            value="<?= $event->availables ?>">
    </div>
</fieldset>