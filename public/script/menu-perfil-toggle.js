document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.querySelector(".perfil-menu-toggle");
    const svg = document.querySelector (".perfil-menu-toggle svg");
    const perfilMenu = document.querySelector(".perfil-menu");

    const notifications = document.querySelector(".notification-dropdown");

    dropdownButton.addEventListener("click", function (e) {
        e.stopPropagation(); // Impede que o evento de clique se propague para o documento
        perfilMenu.classList.toggle("show");
        notifications.classList.add("hidden");
        svg.classList.toggle("rotate");
    });

    // Fecha o menu se clicar fora dele
    document.addEventListener("click", function (e) {
        if (!dropdownButton.contains(e.target) && !perfilMenu.contains(e.target)) {
            notifications.classList.add("hidden");
            perfilMenu.classList.remove("show");
            svg.classList.remove("rotate");
        }
    });
});
