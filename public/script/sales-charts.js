// Variáveis com os dados
var horas = ["Hoje, 0:00", "Hoje, 23:59"];
var faturamento = [/* Inclua seus dados de faturamento aqui */];
var valorMinimo = 0; // Substitua pelo seu valor mínimo em reais
var valorMaximo = 1000; // Substitua pelo seu valor máximo em reais

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
            borderColor: 'blue',
            fill: false
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: false,
                    text: 'Hora'
                }
            },
            y: {
                title: {
                    display: false,
                    text: 'Faturamento (em R$)'
                },
                min: valorMinimo,
                max: valorMaximo
            }
        }
    }
});
