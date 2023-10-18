document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');

    // Função para recolher o campo de pesquisa
    function collapseSearchInput() {
        searchInput.classList.remove('active');
    }

    // Ouvinte de evento para o botão de pesquisa
    searchButton.addEventListener('click', function (event) {
        event.stopPropagation(); // Impede a propagação do clique para o documento
        searchInput.classList.toggle('active');
        if (searchInput.classList.contains('active')) {
            searchInput.focus();
        } else {
            searchInput.blur();
        }
    });

    // Ouvinte de evento para cliques no documento
    document.addEventListener('click', function (event) {
        if (!searchInput.contains(event.target)) {
            collapseSearchInput();
        }
    });

    // Ouvinte de evento para impedir o clique fora do campo de pesquisa
    searchInput.addEventListener('click', function (event) {
        event.stopPropagation();
    });
});
