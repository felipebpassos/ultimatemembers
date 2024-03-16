$(document).ready(function () {

    function atualizaDiscussoes(data) {
        var $encontrados = $('.encontrados ul');
    
        // Limpa o conteúdo atual das discussões
        $encontrados.empty();
    
        if (data.length > 0) {
            // Loop pelos resultados recebidos e atualiza a interface com as discussões
            data.forEach(function(discussao) {
                var discussaoHTML = '<li class="resultado">';
                discussaoHTML += '<a href="' + discussao.url + '">';
                discussaoHTML += '<div class="container">';
                discussaoHTML += '<div class="row" style="align-items:center; justify-content: space-between;">';
                discussaoHTML += '<div class="col-md-8" style="display:flex; align-items:center;">';
                discussaoHTML += '<div class="foto-perfil-mini"><img class="perfil-img" name="imagem" src="http://localhost/ultimatemembers' + 
                (discussao.foto ? discussao.foto : '/public/img/default.png') + '" alt="Foto de Perfil"></div>';
                discussaoHTML += '<div class="box">';
                discussaoHTML += '<span style="font-size: 22px; font-weight: bold;">' + discussao.title + '</span>';
                discussaoHTML += '<div style="display:flex;">';
                discussaoHTML += '<p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i class="fa-regular fa-circle-user " style="margin-right:5px;"></i>' + discussao.autor + '</p>';
                discussaoHTML += '<p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i class="fa-regular fa-clock"></i> ' + discussao.publish_date + '</p>';
                discussaoHTML += '</div>';
                discussaoHTML += '</div>';
                discussaoHTML += '</div>';
                discussaoHTML += '<div class="col-md-4" style="width:fit-content;">';
                discussaoHTML += '<ul class="engajamento">';
                discussaoHTML += '<li><i class="fa-solid fa-heart"></i><span>' + discussao.likes + '</span></li>';
                discussaoHTML += '<li><i class="fa-solid fa-comments"></i><span>' + discussao.respostas + '</span></li>';
                discussaoHTML += '</ul>';
                discussaoHTML += '</div>';
                discussaoHTML += '</div>';
                discussaoHTML += '</div>';
                discussaoHTML += '</a>';
                discussaoHTML += '</li>';
    
                // Adiciona a discussão à lista de discussões
                $encontrados.append(discussaoHTML);
            });
        } else {
            // Caso não haja discussões, exibe uma mensagem informando
            $encontrados.append('<p>Nenhuma publicação encontrada.</p>');
        }
    }    

    function atualizarPaginacao() {
        $('.pagination').empty();

        if (totalPaginas > 1) {
            var inicio = Math.max(1, paginaAtual - 3); // Garante que haja no mínimo 3 botões antes da página atual
            var fim = Math.min(totalPaginas, paginaAtual + 3); // Garante que haja no mínimo 3 botões após a página atual

            // Adiciona o botão 1 antes dos três pontos, se necessário
            if (inicio > 1) {
                $('.pagination').append('<button class="pag-btn" data-id="1">1</button>');
                if (inicio > 2) {
                    $('.pagination').append('<span>&nbsp;...&nbsp;</span>');
                }
            }

            // Botões antes da página atual
            for (var i = inicio; i < paginaAtual; i++) {
                $('.pagination').append('<button class="pag-btn" data-id="' + i + '">' + i + '</button>');
            }

            // Página atual
            $('.pagination').append('<button class="pag-btn pagina-atual" data-id="' + paginaAtual + '">' + paginaAtual + '</button>');

            // Botões após a página atual
            for (var i = paginaAtual + 1; i <= fim; i++) {
                $('.pagination').append('<button class="pag-btn" data-id="' + i + '">' + i + '</button>');
            }

            // Adiciona os três pontos se necessário
            if (fim < totalPaginas) {
                if (fim < totalPaginas - 1) {
                    $('.pagination').append('<span>&nbsp;...&nbsp;</span>');
                }
                $('.pagination').append('<button class="pag-btn" data-id="' + totalPaginas + '">' + totalPaginas + '</button>');
            }
        }
    }

    // Função para fazer a requisição AJAX
    function buscarResultadosPaginacao(url, pagina, updateFunction) {
        $.ajax({
            url: url,
            type: 'POST',
            data: { pagina: pagina },
            success: function (response) {
                console.log(response)
                // Chama a função de atualização de HTML com os resultados recebidos
                updateFunction(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('Erro ao buscar resultados.');
            }
        });
    }

    atualizarPaginacao();

    $(document).on('click', '.pag-btn', function () {
        paginaAtual = parseInt($(this).attr('data-id'));
        atualizarPaginacao();
        buscarResultadosPaginacao(url_principal + 'comunidade/discussoes/', paginaAtual, atualizaDiscussoes);
    });
});