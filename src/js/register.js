import Swal from "sweetalert2";

(function () {
    // or via CommonJS
    let events = [];

    const eventsButton = document.querySelectorAll(".event__add");
    const resume = document.querySelector("#register-resume");
    // Evitamos tener errores en otras paginas
    if (resume) {
        eventsButton.forEach((button) => {
            button.addEventListener("click", selectEvent);
        });

        const registerForm = document.querySelector("#register");
        registerForm.addEventListener("submit", submitForm);

        // Para mostrar mensaje de añadir eventos
        showEvents();

        // Aplicamos destructuring al evento, obteniendo el target
        function selectEvent({ target }) {
            if (events.length < 5) {
                // Deshabilitamos el evento una vez clickeado
                target.disabled = true;
                // Llenamos array de eventos, va a tener objetos con la diferente informacion de los eventos, en este caso id y titulo
                events = [
                    // Copia de lo que ya teníamos en evento
                    ...events,
                    {
                        id: target.dataset.id,
                        // Seleccionamos el elemento padre del target, y dentro de ese elemento padre buscamos el h4, para acceder a su contenido
                        title: target.parentElement.querySelector(
                            ".event__name"
                        ).textContent,
                    },
                ];
            }
            // Mostrar eventos a medida que los vamos agregando
            showEvents();
        }

        function showEvents() {
            // Limpiamos html
            clearEvents();
            // Validamos que events no esté vacío
            if (events.length > 0) {
                events.forEach((event) => {
                    const eventDOM = document.createElement("DIV");
                    eventDOM.classList.add("register__event");
                    const title = document.createElement("H4");
                    title.classList.add("register__name");
                    title.textContent = event.title;

                    const deleteBtn = document.createElement("BUTTON");
                    deleteBtn.classList.add("register__delete");
                    deleteBtn.innerHTML = "<i class='fa-solid fa-trash'></i>";
                    deleteBtn.onclick = function () {
                        deleteEvent(event.id);
                    };

                    eventDOM.appendChild(title);
                    eventDOM.appendChild(deleteBtn);
                    resume.appendChild(eventDOM);
                });
            } else {
                const noRegister = document.createElement("P");
                noRegister.textContent = "No hay eventos, añade hasta 5";
                noRegister.classList.add("register__text");
                resume.appendChild(noRegister);
            }
            if (events.length === 5) {
                eventsButton.forEach((eventBtn) => (eventBtn.disabled = true));
                const msg = document.createElement("P");
                msg.classList.add("register__msg");
                msg.textContent = "Puedes añadir un maximo de 5 eventos";
                resume.appendChild(msg);
            }
        }

        function deleteEvent(id) {
            events = events.filter((e) => e.id !== id);
            const btnAdd = document.querySelector(`[data-id='${id}']`);
            // Quitamos el disabled para poder volver a usar el boton
            btnAdd.disabled = false;
            showEvents();
            events.length < 5
                ? eventsButton.forEach(
                      (eventBtn) => (eventBtn.disabled = false)
                  )
                : "";
        }

        // Limpiar html
        function clearEvents() {
            while (resume.firstChild) {
                resume.firstChild.remove();
            }
        }

        // Enviamos registro de evento presencial y regalo elegido por medio de fetch API
        async function submitForm(e) {
            // Prevenimos comportamiento del submit
            e.preventDefault();

            // Obtenemos regalo elegido por el usuario
            const giftId = document.querySelector("#gift").value;

            // Creamos array con los id de los eventos seleccionados
            const eventsId = events.map((event) => event.id);

            if (events.length === 0 || giftId === "") {
                Swal.fire({
                    title: "Error",
                    text: "Debes agregar minimo un evento y un regalo",
                    icon: "error",
                    confirmButtonText: "OK",
                });
                return;
            }

            // Objeto formData
            const data = new FormData();
            data.append("events", eventsId);
            data.append("gift_id", giftId);

            const url = "/finish-register/conferences";
            const answ = await fetch(url, {
                method: "POST",
                body: data,
            });
            const res = await answ.json();
            if (res.res) {
                Swal.fire(
                    "Registro exitoso",
                    "Tus conferencias se han almacenado, te esperamos en DevWebCamp",
                    "success"
                )
                    // Una vez presionemos okey en la alerta, nos redirecciona a nuestro ticket virtual
                    .then(() => (location.href = `/ticket?id=${res.token}`));
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK",
                })
                    // Recargamos la pagina, en caso de que el error sea porque el evento no tiene más espacios disponibles, se muestren los cambios
                    .then(() => location.reload());
            }
        }
    }
})();
