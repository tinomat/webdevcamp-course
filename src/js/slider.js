import Swiper from "swiper";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".slider")) {
        const options = {
            slidesPerView: 4,
            spaceBetween: 15,
            loop: true,
            freeMode: true,
            centeredSlides: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        };
        // Le pasamos el modulo de navigation a swiper
        Swiper.use([Navigation]);
        new Swiper(".slider", options);
    }
});
