<fieldset class="form__fieldset">
    <legend class="form__legend">
        Informacion del evento
    </legend>
    <div class="form__field">
        <label for="name" class="form_label">Nombre</label>
        <input type="text"
            id="name"
            placeholder="Nombre del evento"
            class="form__input"
            name="name"
            value="<?= $event->name ?? "" ?>">
    </div>
    <div class="form__field">
        <label for="name" class="form_label">Nombre</label>
        <textarea
            id="description"
            placeholder="Descripcion del evento"
            class="form__input form__input--textarea"
            name="description"
            value="<?= $event->descrition ?? "" ?>"
            rows="8">
        </textarea>
    </div>

</fieldset>