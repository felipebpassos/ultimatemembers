document.addEventListener("DOMContentLoaded", function () {
    const modules = document.querySelectorAll(".progress-container");

    modules.forEach(function (module) {
        const circle = module.querySelector(".progress-ring__circle");
        const text = module.querySelector(".progress-text");

        const circumference = 2 * Math.PI * circle.getAttribute("r");
        const percentage = parseInt(text.innerText); // Pegue a porcentagem do texto

        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = `${circumference - (percentage / 100) * circumference}`;
    });
});