<fieldset class="form__fieldset">
    <legend class="form__legend">
        Informacion Personal
    </legend>
    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input type="text"
            id="name"
            placeholder="Nombre del ponente"
            class="form__input"
            name="name"
            value="<?= $speaker->name ?? "" ?>">
    </div>
    <div class="form__field">
        <label for="lastname" class="form__label">Apellido</label>
        <input type="text"
            id="lastname"
            placeholder="Apelldio del ponente"
            class="form__input"
            name="lastname"
            value="<?= $speaker->lastname ?? "" ?>">
    </div>
    <div class="form__field">
        <label for="city" class="form__label">Ciudad</label>
        <input type="text"
            id="city"
            placeholder="Ciudad del ponente"
            class="form__input"
            name="city"
            value="<?= $speaker->city ?? "" ?>">
    </div>
    <div class="form__field">
        <label for="country" class="form__label">Pais</label>
        <input type="text"
            id="country"
            placeholder="Pais del ponente"
            class="form__input"
            name="country"
            value="<?= $speaker->country ?? "" ?>">
    </div>
    <div class="form__field">
        <label for="image" class="form__label">Imagen</label>
        <input type="file"
            id="image"
            class="form__input form__input--file"
            name="image">
    </div>
    <?php
    if (isset($speaker->current_image)) { ?>
        <div class="form__text">Imagen:actual</div>
        <div class="form__image">
            <picture>
                <!-- Cargamos formato webp en caso de que sea compatible -->
                <source srcset="<?= $_ENV["HOST"] . "/img/speakers/" . $speaker->image; ?>.webp" type="image/webp">
                <source srcset="<?= $_ENV["HOST"] . "/img/speakers/" . $speaker->image; ?>.png" type="image/png">
                <img loading="lazy" src="<?= $_ENV["HOST"] . "/img/speakers/" . $speaker->image; ?>.png" alt="Imagen Ponente">
            </picture>
        </div>
    <?php }
    ?>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">
        Informacion Extra
    </legend>
    <div class="form__field">
        <label for="tags_input" class="form__label">Areas de experiencia (separadas por coma)</label>
        <input type="text"
            id="tags_input"
            placeholder="Ej. Node.js, PHP, Laravel, JS, UI/UX"
            class="form__input">
    </div>
    <div id="tags" class="form__lists"></div>
    <input type="hidden" name="tags" value="<?= $speaker->tags ?? "" ?>">
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">
        Redes Sociales
    </legend>
    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text"
                placeholder="Facebook"
                class="form__input form__input--socials"
                name="networks[facebook]"
                value="<?= $networks->facebook ?? "" ?>">
        </div>
    </div>
    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text"
                placeholder="Instagram"
                class="form__input form__input--socials"
                name="networks[instagram]"
                value="<?= $networks->instagram ?? "" ?>">
        </div>
    </div>
    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input type="text"
                placeholder="Twitter"
                class="form__input form__input--socials"
                name="networks[twitter]"
                value="<?= $networks->twitter ?? "" ?>">
        </div>
    </div>
    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text"
                placeholder="Youtube"
                class="form__input form__input--socials"
                name="networks[youtube]"
                value="<?= $networks->youtube ?? "" ?>">
        </div>
    </div>
    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text"
                placeholder="GitHub"
                class="form__input form__input--socials"
                name="networks[github]"
                value="<?= $networks->github ?? "" ?>">
        </div>
    </div>
    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text"
                placeholder="TikTok"
                class="form__input form__input--socials"
                name="networks[tiktok]"
                value="<?= $networks->tiktok ?? "" ?>">
        </div>
    </div>
</fieldset>