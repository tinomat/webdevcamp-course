// IIFE - Permiten mantener el scope del codigo en este archivo
(function () {
    const tagsInput = document.querySelector("#tags_input");
    const tagsContainer = document.querySelector("#tags");
    const tagsInputHidden = document.querySelector("[name='tags']");

    if (tagsInput) {
        let tags = [];
        // Listen for changes
        tagsInput.addEventListener("keypress", function (e) {
            saveTag(e);
        });

        // Recuperar tags del input hidden
        // Si el input no está vacío
        if (tagsInputHidden.value !== "") {
            // Creamos array a partir del string, de los elementos separados por coma (,)
            tags = tagsInputHidden.value.split(",");
            showTags();
        }

        function saveTag(e) {
            // keyCode nos retorna el codigo equivalente a la tecla presionada
            // si presiono una coma
            if (e.keyCode === 44) {
                // Prevenimos la accion por default para que la coma no se agregue al formulario, de esta forma evitamos que al limpiar el input nos quede la coma
                e.preventDefault();

                // Si el valor del input está vacío o es menor a 1, evitamos que agregue contenido vacío al array de tags
                if (e.target.value.trim() === "" || e.target.value < 1) {
                    return;
                }

                tags = [...tags, e.target.value.trim()];
                // Limpiamos el input para que no se dupliquen los valores en el array
                e.target.value = "";

                showTags();
            }
        }

        function showTags() {
            // Limpiamos el contenedor, para que al mostrar el array no se dupliquen
            tagsContainer.textContent = "";

            tags.forEach((tag) => {
                const t = document.createElement("LI");
                t.classList.add("form__tag");
                t.textContent = tag;
                tagsContainer.appendChild(t);

                t.ondblclick = deleteTag;
            });

            // A la vez que mostramos actualizamos el input hidden
            updateInputHidden();
        }

        // Agregar o eliminar tags en la base de datos
        function updateInputHidden() {
            // Convertimos el arreglo en un string
            tagsInputHidden.value = tags.toString();
        }

        // Pasamos el evento para obtener al tag que se le esta haciendo doble click
        function deleteTag(e) {
            // Actualizamos el array de tags, vamos a almacenar todos los elementos que sean distintos al que estamos queriendo eliminar
            tags = tags.filter((t) => t !== e.target.textContent);
            e.target.remove();
            // Actalizamos el input
            updateInputHidden();
        }
    }
})();
