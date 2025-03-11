if (document.querySelector("#map")) {
    const lat = -34.896879;
    const lng = -60.019042;
    const zoom = 16;

    const map = L.map("map", {
        scrollWheelZoom: false,
    }).setView([lat, lng], zoom);
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {}).addTo(
        map
    );

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup(
            `
        <h2 class="map__heading">DevWebCamp</h2>
        <p class=map__text">Centro de convenciones</p>
        `
        )
        .openPopup();
}
