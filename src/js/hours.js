(function () {
    const hours = document.querySelector("#hours");
    if (hours) {
        // Objeto en memoria para comprobar disponibilidad del dia segun la categoria del evento
        let search = {
            category_id: "",
            day: "",
        };

        const category = document.querySelector("[name='category_id']");
        const days = document.querySelectorAll("[name='day']");
        const daysHidden = document.querySelector("[name='day_id']");
        const hourHidden = document.querySelector("[name='hour_id']");

        // Cuando pasamos el callback directamente podemos acceder sin problema al evento en la funccion que mandamos a llamar
        category.addEventListener("input", searchTerm);
        days.forEach((d) => {
            d.addEventListener("input", searchTerm);
        });

        function searchTerm(e) {
            // le pasamos e.target.name para que de esta forma cuando lo usemos para poder usarlo tanto en el input de dias como de categorias de esta forma toma el atributo del name y lo asocie a la propiedad correspondiente del objeto
            search[e.target.name] = e.target.value;

            // Reiniciar inputs hidden y selector de horas
            hourHidden.value = "";
            daysHidden.value = "";

            // Removes seleccion de la hora previa
            const prevH = document.querySelector(".hours__hour--selected");
            // si existe una hora previa removemos la clase
            prevH && prevH.classList.remove("hours__hour--selected");

            // Si el objeto search tiene alguna de sus propiedades vacías - De esta forma evitamos una consulta innecesaria a la base de datos
            if (Object.values(search).includes("")) {
                return;
            }
            searchEvents();
        }

        async function searchEvents() {
            // Destructuring del objeto
            const { category_id, day } = search;
            // Creamos url
            const url = `${location.origin}/api/events-time?category_id=${category_id}&day_id=${day}`;
            const answ = await fetch(url);
            const events = await answ.json();

            getAvailablesHours(events);
        }

        function getAvailablesHours(events) {
            // Reiniciar horas
            const hoursList = document.querySelectorAll(".hours__hour");
            hoursList.forEach((h) => {
                h.classList.add("hours__hour--disabled");
            });

            // Comprobar eventos ya registrados y quitar horarios no disponibles
            const hoursTaken = events.map((e) => e.hour_id);
            // Convertimos un nodelist en un array, de esta forma podemos utilizar arraymethods
            const hoursListArr = Array.from(hoursList);

            const availablesHours = hoursListArr.filter(
                // Obtenemos las horas que no esten registradas en la base dedatos para algun evento, de esta forma el usuario solo podrá elegir las horas disponibles
                (h) => !hoursTaken.includes(h.dataset.hour_id)
            );

            availablesHours.forEach((hour) => {
                hour.classList.remove("hours__hour--disabled");
                hour.addEventListener("click", selectHour);
            });
        }

        function selectHour(e) {
            // Removes seleccion de la hora previa
            const prevH = document.querySelector(".hours__hour--selected");

            // si existe una hora previa removemos la clase
            prevH && prevH.classList.remove("hours__hour--selected");

            // Agregamos seleccion visual
            e.target.classList.add("hours__hour--selected");

            // Leemos el id de la hora
            const hourId = e.target.dataset.hour_id;
            hourHidden.value = hourId;

            // Llenar el input hidden de dia con el value del input que esté checked, es decir el que está clickeado
            daysHidden.value = document.querySelector(
                "[name='day']:checked"
            ).value;
        }
    }
})();
