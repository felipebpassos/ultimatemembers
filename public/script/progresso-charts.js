// Função para atualizar o valor da porcentagem e o stroke-dashoffset
function atualizarPorcentagem(valorPorcentagem) {
    // Atualize o valor da porcentagem na tela
    document.getElementById('total-progress').innerText = valorPorcentagem.toFixed(2) + '%';
    const circle = document.getElementById('progress-circle');

    circle.setAttribute('stroke-dashoffset', '310');

    // Calcule o novo valor de stroke-dashoffset
    const novoStroke = 310 * (100 - valorPorcentagem) / 100;

    // Adicione um pequeno atraso (10ms) antes de aplicar a transição
    setTimeout(function () {
        circle.setAttribute('stroke-dashoffset', novoStroke);
        circle.style.transition = 'stroke-dashoffset 2s linear';
    }, 10);
}

// Chamada inicial para definir a porcentagem inicial
atualizarPorcentagem(porcentagemGeral);

// Seus dados de progresso ao longo do tempo (por exemplo, um array de objetos)
var dadosProgresso = [
    { data: '2023-01-01', progresso: 10 },
    { data: '2023-02-01', progresso: 20 },
    { data: '2023-03-01', progresso: 30 },
    { data: '2023-04-01', progresso: 60 },
    { data: '2023-05-01', progresso: 70 },
    // Adicione mais dados aqui
];

// Converta os dados em duas arrays separadas para o Chart.js (índices e progresso)
var indices = dadosProgresso.map(function (item, index) {
    return index + 1; // Usando índices sequenciais para o eixo X
});
var valoresProgresso = dadosProgresso.map(function (item) {
    return item.progresso;
});

// Obtenha o elemento do canvas
var ctx = document.getElementById('graficoEvolucao').getContext('2d');

// Crie o gráfico de linha
var grafico = new Chart(ctx, {
    type: 'line',
    data: {
        labels: indices, // Índices no eixo X
        datasets: [{
            label: 'Progresso',
            data: valoresProgresso, // Valores de progresso no eixo Y
            borderColor: '#989898', // Cor da linha do gráfico
            borderWidth: 2, // Largura da linha do gráfico
            fill: false, // Não preencha a área sob a linha
        },],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                type: 'linear', // Usar escala linear em vez de tempo
                position: 'bottom',
            },
            y: {
                beginAtZero: true, // Comece o eixo Y a partir do zero
                max: 100, // Valor máximo no eixo Y
            },
        },
    },
});


// Dados para o gráfico de rosca (anel)
var dadosRosca = {
    labels: ["Acertos", "Erros"],
    datasets: [{
        data: [10, 4], // Valores correspondentes aos dados
        backgroundColor: ["#464646", "#2e2e2e"], // Cores das fatias
        borderWidth: 8,
        cutout: '60%', // Define o tamanho do círculo vazio no centro
        borderColor: '#0A0A0A' // Cor do contorno transparente
    }]
};

// Opções do gráfico (opcional)
var opcoesRosca = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false // Ocultar a legenda
        },
    },
};

// Obtenha o elemento do canvas
var ctx = document.getElementById('graficoRosca').getContext('2d');

// Crie o gráfico de rosca (anel)
var graficoRosca = new Chart(ctx, {
    type: 'doughnut', // Use o tipo 'doughnut' para criar um gráfico de rosca
    data: dadosRosca,
    options: opcoesRosca
});
