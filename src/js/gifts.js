(function () {
    const graphic = document.querySelector("#gifts-graphic");
    if (graphic) {
        // Funcion para obtener los regalos desde la api
        (async function getGifts() {
            const url = "/api/gifts";
            const answ = await fetch(url);
            const res = await answ.json();

            const ctx = document
                .getElementById("gifts-graphic")
                .getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    // Parte visible por el usuario
                    // Creamos array solo con los nombres de los regalos
                    labels: res.map((gift) => gift.name),
                    datasets: [
                        {
                            label: "",
                            // El primer data se vincua con el primer label y asi
                            // Creamos array con el total de regalos adquiridos
                            data: res.map((gift) => gift.total),
                            backgroundColor: [
                                "#ea580c",
                                "#84cc16",
                                "#22d3ee",
                                "#a855f7",
                                "#ef4444",
                                "#14b8a6",
                                "#db2777",
                                "#e11d48",
                                "#7e22ce",
                            ],
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legends: false,
                    },
                },
            });
        })();
    }
})();
