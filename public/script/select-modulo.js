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

                    // Parsing da resposta como JSON
                    try {
                        // Verifica se a resposta é um objeto (e não um array diretamente)
                        data = typeof data === 'object' ? data : JSON.parse(data);
                    } catch (error) {
                        console.error('Erro ao fazer o parsing da resposta JSON:', error);
                        return;
                    }

                    aulasData = data;

                    // Limpa o conteúdo atual das aulas
                    $('.aulas').empty();

                    // Adiciona as novas aulas ao conteúdo
                    data.forEach(function (aula) {
                        var nome_aula = aula['nome'];
                        var id_aula = aula['id'];
                        var capa = aula['capa'] ? aula['capa'].replace("./", "http://localhost/ultimatemembers/") : "http://localhost/ultimatemembers/public/img/video-default.png";

                        if (id_aula >= 0 && id_aula <= 9) {
                            formattedId = "0" + id_aula; // Formata o ID para 0X (sendo X o ID)
                        } else {
                            formattedId = id_aula; // Mantém o ID como está se não estiver entre 0 e 9
                        }

                        // Verificar o comprimento da string
                        if (nome_aula.length > 27) {
                            // Cortar a string para os primeiros 22 caracteres e adicionar "..."
                            nome_aula = nome_aula.substr(0, 27) + '...';
                        }

                        // Título, capa e descrição da aula.
                        var aulaHtml = '<div class="aula">';
                        aulaHtml += '<div class="aula-left-box">';
                        aulaHtml += '<a href="' + url_principal + 'modulos/aula/' + formattedId + '" id="img-aula-3">';
                        aulaHtml += '<img class="imagem-aula" src="' + capa + '" alt="Imagem da Aula">';
                        aulaHtml += '</a>';
                        aulaHtml += '<section>';
                        aulaHtml += '<div class="info-aula">';
                        aulaHtml += '<div class="nome-aula" style="font-weight: bold;">Aula ' + formattedId + ' - ' + nome_aula + '</div>';
                        aulaHtml += '</div>';
                        aulaHtml += '</section>';
                        aulaHtml += '</div>';

                        // Botões de ação da aula.
                        aulaHtml += '<div class="opções-aula">';

                        // Adicione os botões HTML diretamente aos dados
                        aulaHtml += aula['botoes_html'];

                        aulaHtml += '</div>';

                        aulaHtml += '</div>'; // Feche a div 'aula'

                        // Adicione a aula ao conteúdo
                        $('.aulas').append(aulaHtml);
                    });
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
