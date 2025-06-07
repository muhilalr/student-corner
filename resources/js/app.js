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
        }).mount();
    });
});
window.addEventListener("load", () => {
    AOS.refresh();
});
