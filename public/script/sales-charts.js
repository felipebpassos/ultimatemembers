// Variáveis com os dados
var dados = [
    { hora: 0, faturamento: 0 },
    { hora: 1, faturamento: 100 },
    { hora: 2, faturamento: 200 },
    { hora: 3, faturamento: 300 },
    // Adicione mais dados aqui
    { hora: 22, faturamento: 900 },
    { hora: 23, faturamento: 1000 }
];

// Valores mínimos e máximos para os eixos X e Y
var valorMinimoX = 0;
var valorMaximoX = 23;

var valorMinimoY = 0;
var valorMaximoY = 1000;

// Função para formatar a hora
function formatarHora(value) {
    return 'Hoje, ' + (value < 10 ? '0' : '') + value + ':00';
}

// Função para formatar números como "R$ 0,00"
function formatarReais(value) {
    return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
}

// Extrair as horas e faturamento dos dados
var horas = dados.map(function (item) {
    return formatarHora(item.hora);
});

var faturamento = dados.map(function (item) {
    return item.faturamento;
});

// Configuração do gráfico
var ctx = document.getElementById('grafico').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: horas,
        datasets: [{
            label: 'Faturamento Acumulativo',
            data: faturamento,
            borderWidth: 1,
            borderColor: 'grey',
            fill: false
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: false,
                    text: 'Hora'
                },
                grid: {
                    display: false // Remove as linhas de grade do eixo X
                },
                min: 0, // Valor mínimo no eixo X
                max: 22, // Valor máximo no eixo X
                ticks: {
                    maxTicksLimit: 2, // Define o número máximo de ticks
                    callback: function (value) {
                        if (value === valorMinimoX || value === valorMaximoX) {
                            return formatarHora(value); // Formatar apenas os valores mínimos e máximos
                        } else {
                            return ''; // Ocultar outros valores
                        }
                    }
                }
            },
            y: {
                title: {
                    display: false,
                    text: 'Faturamento (em R$)'
                },
                min: valorMinimoY, // Valor mínimo no eixo Y
                max: valorMaximoY, // Valor máximo no eixo Y
                ticks: {
                    maxTicksLimit: 2,
                    callback: function (value, index, values) {
                        return formatarReais(value);
                    }
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true, // Use estilo de ponto para a label
                    boxWidth: 0, // Largura da caixa da label (0 para torná-la invisível)
                    pointStyle: 'line', // Estilo de ponto para a label (linha sólida)
                    color: 'grey' // Cor da linha da label
                }
            }
        }
    }
});