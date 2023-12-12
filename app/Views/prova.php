<?php
//criar botões para escolha de questões
function criarListas($numQuestoes)
{
    $html = '';

    for ($i = 1; $i <= $numQuestoes; $i++) {
        $html .= "<li class='questao-index'><button>{$i}ª</button></li>";
    }

    return $html;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulado - Online e Gratuito - Sala de Estudos</title>
    <meta property="og:title" content="Simulado - Online e Gratuito - Sala de Estudos">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Muli&display=swap');

        body {
            font-family: 'Muli', sans-serif;
            margin: 0;
            padding: 0;
            margin: auto;
        }

        header {
            height: 100px;
            display: flex;
            width: 90%;
            align-items: center;
            justify-content: space-between;
            margin: auto;
            margin-bottom: 30px;
            position: relative;
        }

        .temporizador {
            width: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgb(166, 166, 166);
            font-weight: bolder;
        }

        .container1 {
            position: absolute;
            right: 40px;
            display: flex;
        }

        .btn-finalizar {
            height: 40px;
            width: 160px;
            background-color: rgb(135, 94, 199);
            cursor: pointer;
            color: white;
            font-weight: bolder;
            border: none;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-finalizar:hover {
            opacity: 0.8;
            transition: 0.3s;
        }

        main {
            width: 90%;
            margin: auto;
        }

        ul {
            padding: 0px;
            margin: 0px;
        }

        .selecao-simples {
            display: inline-block;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        label {
            display: none;
        }

        .container-questao {
            position: relative;
        }

        .container-questoes {
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 8px;
            box-shadow: -1px 2px 8px rgb(218, 218, 218);
        }

        .container-questoes ul {
            padding: 10px 20px;
            justify-content: space-between;
        }

        .container-questoes ul li {
            display: inline-block;
            margin: 8px 9px;
        }

        .container-questoes ul li button {
            width: 35px;
            height: 30px;
            cursor: pointer;
            border: none;
        }

        .container-questoes ul li button:hover {
            box-shadow: -1px 2px 12px rgba(0, 0, 0, 0.25);
            transition: 0.15s;
        }

        .question {
            margin-bottom: 50px;
        }

        .question .enunciado {
            min-height: 30px;
        }

        .question .alternativas {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .question .alternativas label {
            width: auto;
            display: inline-block;
            margin-bottom: 10px;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
        }

        .question .alternativas input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .question .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 24px;
            width: 24px;
            border-radius: 50%;
            border: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .question .alternativas label:hover .checkmark {
            background-color: #cccccc5b;
        }

        .question .alternativas input[type="radio"]:checked+.checkmark {
            background-color: #000;
            color: #fff;
        }

        .question .alternativas .option-label {
            margin-left: 10px;
            line-height: 24px;
        }

        .responder-button {
            width: 160px;
            height: 40px;
            cursor: pointer;
            background-color: rgb(88, 175, 233);
            color: white;
            font-weight: bolder;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        }

        .responder-button:hover {
            opacity: 0.8;
            transition: 0.3s;
        }

        .responder-button.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .next-prev {
            width: fit-content;
            display: flex;
            margin-bottom: 40px;
        }

        .btn-next-prev {
            cursor: pointer;
            height: 40px;
            width: 160px;
            margin-right: 40px;
            border: none;
        }

        .btn-next-prev:hover {
            box-shadow: -1px 2px 12px rgba(0, 0, 0, 0.25);
            transition: 0.15s;
        }
    </style>

    <script>
        // Função para o temporizador com horas e minutos informados
        function startTimer(hours, minutes, display) {
            var totalSeconds = (hours * 3600) + (minutes * 60);
            var timer = totalSeconds,
                remainingHours, remainingMinutes, seconds;
            setInterval(function () {
                remainingHours = parseInt(timer / 3600, 10);
                remainingMinutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                remainingHours = remainingHours < 10 ? "0" + remainingHours : remainingHours;
                remainingMinutes = remainingMinutes < 10 ? "0" + remainingMinutes : remainingMinutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = remainingHours + ":" + remainingMinutes + ":" + seconds;

                if (--timer < 0) {
                    // Aqui você pode adicionar a lógica quando o tempo acabar
                    // Por exemplo, finalizar a prova automaticamente
                } else if (remainingHours == 0 && remainingMinutes <= 29) {
                    display.style.color = "red"; // Altera a cor para vermelho
                }
            }, 1000);
        }

        // Quando a página carrega, inicia o temporizador com horas e minutos informados
        window.onload = function () {
            var hours = 0; // Quantidade de horas
            var minutes = 31; // Quantidade de minutos
            var display = document.querySelector('.temporizador');
            startTimer(hours, minutes, display);
        };
    </script>
</head>

<body>
    <header>
        <div class="container1">
            <div class="temporizador"></div>
            <button class="btn-finalizar">Finalizar Simulado</button>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="container-questoes">
                        <ul>
                            <?php echo criarListas(15); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9" style="padding-left: 40px;">
                    <div class="next-prev">
                        <button id="btn-anterior" class="btn-next-prev">Anterior</button>
                        <button id="btn-proxima" class="btn-next-prev">Próxima</button>
                    </div>
                    <div class="container-questao">
                        <!-- Apenas uma questão será mostrada aqui -->
                        <div id="questions-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Dados das questões
        var questions = [{
            enunciado: "Uma cozinheira produz docinhos especiais por encomenda. Usando uma receita-base de massa, ela prepara uma porção, com a qual produz 50 docinhos maciços de formato esférico, com 2 cm de diâmetro. Um cliente encomenda 150 desses docinhos, mas pede que cada um tenha formato esférico com 4 cm de diâmetro. A cozinheira pretende preparar o número exato de porções da receita-base de massa necessário para produzir os docinhos dessa encomenda.<br><br> Quantas porções da receita-base de massa ela deve preparar para atender esse cliente?",
            options: ["2", "3", "6", "12", "24"]
        }, {
            enunciado: "Em uma loja, o preço promocional de uma geladeira é de R$ 1 000,00 para pagamento somente em dinheiro. Seu preço normal, fora da promoção, é 10% maior. Para pagamento feito com o cartão de crédito da loja, é dado um desconto de 2% sobre o preço normal.<br><br>Uma cliente decidiu comprar essa geladeira, optando pelo pagamento com o cartão de crédito da loja. Ela calculou que o valor a ser pago seria o preço promocional acrescido de 8%. Ao ser informada pela loja do valor a pagar, segundo sua opção, percebeu uma diferença entre seu cálculo e o valor que lhe foi apresentado.<br><br>O valor apresentado pela loja, comparado ao valor calculado pela cliente, foi m uma loja, o preço promocional de uma geladeira é de R$ 1 000,00 para pagamento somente em dinheiro. Seu preço normal, fora da promoção, é 10% maior. Para pagamento feito com o cartão de crédito da loja, é dado um desconto de 2% sobre o preço normal.",
            options: ["R$2,00 menor.", "R$100,00 menor.", "R$200,00 menor.", "R$42,00 maior.", "R$80,00 maior."]
        }, {
            enunciado: "A World Seres é a decisão do campeonato norte-americano de beisebol. Os dois times que chegam essa fase jogam, entre si, até sete partidas. O primeiro desses times que completar quatro vitórias é declarado Campeão.<br><br>Considere que, em todas as partidas, a probabilidade de qualquer um dos dois times vencer é sempre 1/2.<br><br>Qual é a probabilidade de o time campeão ser aquele que venceu a primeira partida da World Series?",
            options: ["35/64", "40/64", "42/64", "44/64", "52/64"]
        }];
    </script>

    <script>
        // Função para gerar as questões dinamicamente
        function generateQuestions() {
            var container = $("#questions-container");

            questions.forEach(function (questionData, index) {
                var questionElement = $("<div>").addClass("question");

                var questionEnunciado = $("<div>").addClass("enunciado").html(questionData.enunciado);
                questionElement.append(questionEnunciado);

                var optionsContainer = $("<div>").addClass("alternativas");
                questionElement.append(optionsContainer);

                questionData.options.forEach(function (option, optionIndex) {
                    var optionContainer = $("<div>").addClass("option-container");

                    var label = $("<label>");

                    var input = $("<input>").attr({
                        type: "radio",
                        name: "resposta-" + index,
                        value: optionIndex,
                    });
                    label.append(input);

                    var checkmark = $("<span>").addClass("checkmark").text(String.fromCharCode(65 + optionIndex));
                    label.append(checkmark);

                    var optionLabel = $("<span>").addClass("option-label").text(option);
                    label.append(optionLabel);

                    optionContainer.append(label);
                    optionsContainer.append(optionContainer);
                });

                container.append(questionElement);
            });
        }

        // Chama a função para gerar as questões
        generateQuestions();

        // Seleciona todos os inputs de rádio
        var inputs = $("input[type='radio']");

        // Adiciona um evento de clique aos inputs
        inputs.on("click", function () {
            // Verifica se algum input foi selecionado para habilitar o botão de resposta correspondente
            var questionIndex = $(this).closest(".question").index();
            var checkedInputs = $(".question").eq(questionIndex).find("input[type='radio']:checked");
            var btnResponder = $(".responder-button").eq(questionIndex);
            btnResponder.prop("disabled", checkedInputs.length === 0);
            btnResponder.removeClass("disabled"); // Remove a classe "disabled" para habilitar o botão
        });
    </script>

    <script>
        $(document).ready(function () {
            // Oculta todas as questões, exceto a primeira
            $(".question").not(":first").hide();

            // Seleciona todos os botões na lista
            var buttons = $(".container-questoes ul li button");

            // Adiciona um evento de clique aos botões
            buttons.on("click", function () {
                // Obtém o índice da questão com base no índice do botão na lista
                var questionIndex = $(this).parent().index();

                // Oculta todas as questões
                $(".question").hide();

                // Exibe apenas a questão correspondente ao índice
                $(".question").eq(questionIndex).show();
            });

            // Seleciona o botão "Anterior" pelo ID e adiciona o evento de clique
            $("#btn-anterior").on("click", function () {
                // Obtém o índice da questão atualmente visível
                var currentIndex = $(".question:visible").index();

                // Verifica se há uma questão anterior
                if (currentIndex > 0) {
                    // Oculta a questão atual
                    $(".question").eq(currentIndex).hide();

                    // Exibe a questão anterior
                    $(".question").eq(currentIndex - 1).show();
                }
            });

            // Seleciona o botão "Próxima" pelo ID e adiciona o evento de clique
            $("#btn-proxima").on("click", function () {
                // Obtém o índice da questão atualmente visível
                var currentIndex = $(".question:visible").index();

                // Verifica se há uma próxima questão
                if (currentIndex < $(".question").length - 1) {
                    // Oculta a questão atual
                    $(".question").eq(currentIndex).hide();

                    // Exibe a próxima questão
                    $(".question").eq(currentIndex + 1).show();
                }
            });
        });
    </script>
</body>

</html>