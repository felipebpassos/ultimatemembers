$(document).ready(function () {
    // Seletor para o elemento com a classe .descricao
    var descricaoElement = $('.descricao');

    // Obtém o texto do placeholder
    var placeholderText = descricaoElement.text();

    // Padrão para extrair o ID do módulo ("Módulo XX - Nome do Módulo")
    var moduloPattern = /Módulo (\d+)/;

    // Executa a expressão regular no texto do placeholder
    var match = moduloPattern.exec(placeholderText);

    if (match && match[1]) {
        // O ID do módulo está na posição match[1]
        var idModulo = match[1];
        console.log('ID do Módulo inicial:', idModulo);
    } else {
        console.log('Padrão de Módulo não encontrado no placeholder.');
    }

    // Adiciona um ouvinte de evento para capturar a seleção do item
    $('.items').on('click', 'li', function () {
        // Obtém o texto do item selecionado
        var itemSelecionado = $(this).text();

        // Executa a expressão regular no texto do item selecionado
        var matchItem = moduloPattern.exec(itemSelecionado);

        if (matchItem && matchItem[1]) {
            // O ID do módulo está na posição matchItem[1]
            var idModuloSelecionado = matchItem[1];
            console.log('ID do Módulo selecionado:', idModuloSelecionado);

            // Realiza uma requisição AJAX
            $.ajax({
                url: url_principal + "modulos/aulas_modulo/",
                method: "POST",
                data: { id_modulo: idModuloSelecionado },
                success: function (data) {
                    // Manipula a resposta bem-sucedida aqui
                    console.log('Resposta da requisição AJAX:', data);
                },
                error: function (xhr, status, error) {
                    // Manipula erros aqui
                    console.error('Erro na requisição AJAX:', error);
                }
            });
        } else {
            console.log('Padrão de Módulo não encontrado no item selecionado.');
        }
    });
});
