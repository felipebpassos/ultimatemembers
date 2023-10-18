let tempoInicial = new Date().getTime(); // Variável para armazenar o tempo inicial
let timeoutId; // Variável para armazenar o ID do timeout

// Função para adicionar a classe "encolher"
function adicionarClasseEncolher() {
    const elementosParaEncolher = document.querySelectorAll('.titulo, .pre-titulo');

    // Adicione a classe "encolher" aos elementos
    elementosParaEncolher.forEach(function (elemento) {
        elemento.classList.add('encolher');
    });
}

// Função para remover a classe "encolher"
function removerClasseEncolher() {
    const elementosParaEncolher = document.querySelectorAll('.titulo, .pre-titulo');

    // Remova a classe "encolher" dos elementos
    elementosParaEncolher.forEach(function (elemento) {
        elemento.classList.remove('encolher');
    });
}

// Aguarde 4 segundos (4000 milissegundos) e, em seguida, adicione a classe "encolher"
timeoutId = setTimeout(adicionarClasseEncolher, 4000);

// Adicione um evento para remover a classe "encolher" quando o mouse passar sobre .pre-titulo
const preTitulo = document.querySelector('.pre-titulo');
preTitulo.addEventListener('mouseover', function() {
    // Cancela o timeout para evitar que a classe "encolher" seja adicionada após 4 segundos
    clearTimeout(timeoutId);
    removerClasseEncolher(); // Remove a classe "encolher"
});

// Adicione um evento para remover a classe "encolher" quando o mouse sai de .pre-titulo
preTitulo.addEventListener('mouseleave', function () {
    adicionarClasseEncolher(); // Remove a classe "encolher"
});
