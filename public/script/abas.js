var conteudos = document.getElementsByClassName('content');
var abas = document.getElementsByClassName('aba');
var outrosButton = document.getElementById('outrosButton');
var dropdown = document.getElementById('outrosDropdown');

function abrirAba(event, idAba) {
    for (var i = 0; i < conteudos.length; i++) {
        conteudos[i].style.display = 'none';
    }

    for (var i = 0; i < abas.length; i++) {
        abas[i].className = abas[i].className.replace('aba-ativa', '');
    }

    document.getElementById(idAba).style.display = 'block';
    event.currentTarget.className += ' aba-ativa';

    // Se a aba clicada não estiver no dropdown, redefina o texto do botão "Outras"
    var outrosButton = document.getElementById('outrosButton');
    if (!event.target.closest('.dropdown') && !event.target.closest('.aba-ativa')) {
        outrosButton.textContent = 'Outras';
    }
}

function selecionarOpcao(opcaoSelecionada, textoNome) {

    // Lógica para abrir o conteúdo correspondente à opção selecionada
    var conteudoSelecionado = document.getElementById(opcaoSelecionada);
    if (conteudoSelecionado) {
        for (var i = 0; i < conteudos.length; i++) {
            conteudos[i].style.display = 'none';
        }

        for (var i = 0; i < abas.length; i++) {
            abas[i].className = abas[i].className.replace('aba-ativa', '');
        }

        conteudoSelecionado.style.display = 'block';

        // Atualizar o texto do botão "Outras" com o texto da aba selecionada
        var outrosButton = document.getElementById('outrosButton');
        outrosButton.textContent = textoNome;

        // Remover a classe 'aba-ativa' do botão "Outras"
        outrosButton.className = outrosButton.className.replace('aba-ativa', '');
    }

}

function mostrarDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.style.display = 'block';
}

function esconderDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.style.display = 'none';
}

// Adicionar evento para redefinir o texto do botão "Outras" ao clicar fora do dropdown
document.addEventListener('click', function (event) {
    var outrosButton = document.getElementById('outrosButton');
    var dropdown = document.getElementById('outrosDropdown');

    // Verificar se o clique foi fora do dropdown e fora do botão "Outras"
    if (!event.target.closest('.dropdown') && event.target.closest('.aba-ativa')) {
        outrosButton.textContent = 'Outras';
        dropdown.style.display = 'none';
    }
});
