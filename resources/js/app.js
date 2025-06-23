import "./bootstrap";
import Splide from "@splidejs/splide";
import "@splidejs/splide/dist/css/splide.min.css";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".splide").forEach(function (el) {
        new Splide(el, {
            type: "loop",
            perPage: 3,
            gap: "1rem",
            breakpoints: {
                1024: {
                    perPage: 2, // tablet
                },
                640: {
                    perPage: 1, // sm dan di bawahnya
                },
            },
        }).mount();
    });
});
window.addEventListener("load", () => {
    AOS.refresh();
});
