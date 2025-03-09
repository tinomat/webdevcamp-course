(function () {
    const speakersInput = document.querySelector("#speakers");
    const speakersInputHidden = document.querySelector("[name='speaker_id']");
    if (speakersInput) {
        // Array para almacenar los ponenetes
        let speakers = [];
        let filteredSpeakers = [];
        const speakersList = document.getElementById("speakers-list");

        getSpeakers();

        speakersInput.addEventListener("input", searchSpeakers);

        async function getSpeakers() {
            const url = `${location.origin}/api/speakers`;
            const answ = await fetch(url);
            const res = await answ.json();
            resetSpeakers(res);
        }

        function resetSpeakers(speakersArr = []) {
            // Creamos nuevo array de objetos, solo con el nombre y el id de los ponentes
            speakers = speakersArr.map((speaker) => {
                return {
                    name: `${speaker.name.trim()} ${speaker.lastname.trim()}`,
                    id: speaker.id,
                };
            });
        }

        function searchSpeakers(e) {
            const search = e.target.value;

            if (search.length > 3) {
                // Regex - forma de buscar un patron en un valor
                // definimos que no importa si la busqueda está en mayusculas o minusculas, esto es util a la hora de querer filtrar busquedas
                const regex = new RegExp(removeTildes(search), "i");

                filteredSpeakers = speakers.filter((speaker) => {
                    // search es un metodo para buscar en un string si no la encuentra retorna -1
                    // si la busqueda retorna distinto de -1
                    if (
                        removeTildes(speaker.name.toLowerCase()).search(
                            regex
                        ) != -1
                    ) {
                        return speaker;
                    }
                });
            } else {
                // Cuando el input esté vacio limpiamos para que no se muestre ningun nombre en pantalla
                filteredSpeakers = [];
                speakersInputHidden.value = "";
            }
            showSpeakers();
        }

        function showSpeakers() {
            while (speakersList.firstChild) {
                // Eliminamos los elementos hijos
                speakersList.removeChild(speakersList.firstChild);
            }

            if (filteredSpeakers.length > 0) {
                filteredSpeakers.forEach((speaker) => {
                    // Mientras el listado tenga elmentos hijos
                    const speakerHTML = document.createElement("LI");
                    speakerHTML.classList.add("speakers-list__speaker");
                    speakerHTML.textContent = speaker.name;
                    speakerHTML.dataset.speaker_id = speaker.id;
                    speakerHTML.onclick = selectSpeaker;
                    // Add to DOM
                    speakersList.classList.add("speakers-list--show");
                    speakersList.appendChild(speakerHTML);
                });
            }
        }

        function selectSpeaker(e) {
            const speaker = e.target;

            // Remover clase previa
            const prevSpeaker = document.querySelector(
                ".speakers-list__speaker--selected"
            );
            prevSpeaker &&
                prevSpeaker.classList.remove(
                    "speakers-list__speaker--selected"
                );

            speaker.classList.add("speakers-list__speaker--selected");

            speakersInputHidden.value = e.target.dataset.speaker_id;
        }
    }
})();
