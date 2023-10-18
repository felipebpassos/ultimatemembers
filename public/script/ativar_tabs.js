document.addEventListener("DOMContentLoaded", function() {
    var currentPageURL = window.location.href; // Obtém a URL da página atual
    var links = document.querySelectorAll(".tab"); // Seleciona todas as tags <a> com a classe "aba"

    var exactMatchFound = false;

    links.forEach(function(link) {
        var linkURL = link.getAttribute("href"); // Obtém a URL do link

        if (currentPageURL === linkURL) {
            link.classList.add("ativo"); // Adiciona a classe "ativo" se a URL da página atual for exatamente igual à URL do link
            exactMatchFound = true;
        }
    });

    if (!exactMatchFound) {
        links.forEach(function(link) {
            var linkURL = link.getAttribute("href"); // Obtém a URL do link

            if (currentPageURL.includes(linkURL)) {
                link.classList.add("ativo"); // Adiciona a classe "ativo" se a URL da página atual contém a URL do link
            }
        });
    }
});