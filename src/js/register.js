const { register } = require("swiper/element");

(function () {
    let events = [];
    const eventsButton = document.querySelectorAll(".event__add");
    const resume = document.querySelector("#register-resume");

    eventsButton.forEach((button) => {
        button.addEventListener("click", selectEvent);
    });

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
                    title: target.parentElement.querySelector(".event__name")
                        .textContent,
                },
            ];
        }
        // Mostrar eventos a medida que los vamos agregando
        showEvents();
    }

    function showEvents() {
        // Validamos que events no esté vacío
        clearEvents();
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
            ? eventsButton.forEach((eventBtn) => (eventBtn.disabled = false))
            : "";
    }

    // Limpiar html
    function clearEvents() {
        while (resume.firstChild) {
            resume.firstChild.remove();
        }
    }
})();
