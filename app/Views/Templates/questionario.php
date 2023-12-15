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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ... meta tags, título e icone ... -->
    <?php echo isset($description) && !empty($description) ? '<meta name="description" content="' . $description . '">' : ''; ?>
    <title>
        <?php echo $title; ?>
    </title>

    <?php $favicon = !empty($curso['url_favicon']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_favicon']) : "http://localhost/ultimatemembers/public/img/logo-default.png"; ?>
    <link rel="icon" href="<?php echo $favicon; ?>">

    <!-- ... estilos ... -->
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/' . $style . '.css">' . PHP_EOL;
    }
    ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts (head) -->
    <?php
    foreach ($scripts_head as $script) {
        echo '<script src="http://localhost/ultimatemembers/public/script/' . $script . '.js"></script>';
    }
    ?>
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

    <!-- js files (body) -->
    <?php
    foreach ($scripts_body as $script) {
        echo '<script src="http://localhost/ultimatemembers/public/script/' . $script . '.js"></script>';
    }
    ?>

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