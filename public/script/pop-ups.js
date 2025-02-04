//AULAS

// Quando o botão de adicionar aula for clicado
$('#add-aula').click(function () {
    exibirFormulario('add-aula'); // Função para exibir o formulário
    // Aqui fazemos a requisição AJAX para buscar videos das plataformas integradas
    $.ajax({
        url: url_principal + 'auth/videos',
        type: 'POST',
        dataType: 'json',
        success: function (data) {

            // Seleciona a div.videos
            var videos = $('.videos');

            // Seleciona a div.videos.row
            var videosContainer = $('.videos .row');
            videosContainer.empty();

            // Itera sobre os vídeos e cria as divs conforme necessário
            for (var i = 0; i < data.length; i++) {
                // Verifica se o elemento tem success true
                if (!data[i].success) {
                    // Se não tiver, cria um span com a mensagem de erro e adiciona à div.videos
                    var errorMessage = $('<span class="alert-erro">Houve um erro com a plataforma ' + data[i].plataforma + '. Atualizar integração.</span>');
                    videos.append(errorMessage);
                    continue; // Pula para o próximo elemento do loop
                }

                // Cria a div.video
                var videoDiv = $('<div class="video col-md-3 col-lg-3"></div>');

                // Cria a imagem com o src definido pela thumbnailUrl
                var thumbnailImg = $('<img src="' + data[i].thumbnailUrl + '" alt="Thumbnail">');

                // Cria a imagem da integração
                let plataforma = integracoes[data[i].plataforma];
                var plataformaImg = $('<img class="plataforma-img" src="' + plataforma['img-mini'] + '" alt="Thumbnail">');

                // Cria o título
                var title = $('<p>' + data[i].title + '</p>');

                // Adiciona o data-id ao elemento
                videoDiv.attr('data-id', data[i].videoId);

                // Adiciona o data-nome ao elemento
                videoDiv.attr('data-nome', data[i].title);

                // Adiciona o data-plataforma ao elemento
                videoDiv.attr('data-plataforma', data[i].plataforma);

                // Adiciona o data-integracao ao elemento
                videoDiv.attr('data-integracao', data[i].integracao);

                // Adiciona a imagem e o título à div.video
                videoDiv.append(thumbnailImg);
                videoDiv.append(plataformaImg);
                videoDiv.append(title);

                // Adiciona a div.video à div.videos
                videosContainer.append(videoDiv);
            }
        },
        error: function (error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });
});

// Quando o botão de fechar for clicado
$('#closePopup').click(function () {
    fecharFormulario('add-aula');
});

// Quando os botões de editar aula forem clicados
$('.aulas').on('click', '.editar-aula', function () {
    const aulaId = $(this).data('id'); // Obtém o ID da aula do atributo data-id

    $('#idAula').val(aulaId);

    // Encontra aula correspondente
    const aula = encontrarPorId(aulaId, aulasData);

    // Verifique se aula é definido e possui as propriedades 'nome' e 'descricao'
    if (aula) {
        // Preenche os campos do popup com os valores da aula
        $('#nomeAulaEdit').val(aula['nome']);
        $('#descricaoAulaEdit').val(aula['descricao']);
    } else {
        console.error('Aula não encontrada ou propriedades ausentes.');
    }

    // Aqui fazemos a requisição AJAX para buscar videos das plataformas integradas
    $.ajax({
        url: url_principal + 'auth/videos',
        type: 'POST',
        dataType: 'json',
        success: function (data) {

            // Seleciona a div.videos
            var videos = $('.videos');

            // Seleciona a div.videos.row
            var videosContainer = $('.videos .row');

            videosContainer.empty();

            // Itera sobre os vídeos e cria as divs conforme necessário
            for (var i = 0; i < data.length; i++) {
                // Verifica se o elemento tem success true
                if (!data[i].success) {
                    // Se não tiver, cria um span com a mensagem de erro e adiciona à div.videos
                    var errorMessage = $('<span class="alert-erro">Houve um erro com a plataforma ' + data[i].plataforma + '. Atualizar integração.</span>');
                    videos.append(errorMessage);
                    continue; // Pula para o próximo elemento do loop
                }

                // Cria a div.video
                var videoDiv = $('<div class="video col-md-3 col-lg-3"></div>');

                // Cria a imagem com o src definido pela thumbnailUrl
                var thumbnailImg = $('<img src="' + data[i].thumbnailUrl + '" alt="Thumbnail">');

                // Cria a imagem da integração
                let plataforma = integracoes[data[i].plataforma];
                var plataformaImg = $('<img class="plataforma-img" src="' + plataforma['img-mini'] + '" alt="Thumbnail">');

                // Cria o título
                var title = $('<p>' + data[i].title + '</p>');

                // Adiciona o data-id ao elemento
                videoDiv.attr('data-id', data[i].videoId);

                // Adiciona o data-nome ao elemento
                videoDiv.attr('data-nome', data[i].title);

                // Adiciona o data-plataforma ao elemento
                videoDiv.attr('data-plataforma', data[i].plataforma);

                // Adiciona o data-integracao ao elemento
                videoDiv.attr('data-integracao', data[i].integracao);

                // Adiciona a imagem e o título à div.video
                videoDiv.append(thumbnailImg);
                videoDiv.append(plataformaImg);
                videoDiv.append(title);

                // Adiciona a div.video à div.videos
                videosContainer.append(videoDiv);
            }
        },
        error: function (error) {
            console.error('Erro na requisição AJAX:', error);
        }
    });

    exibirFormulario('edit-aula'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupEdit').click(function () {
    fecharFormulario('edit-aula');
});

//MÓDULOS

$('#editar-modulos').click(function () {
    exibirFormulario('modulos'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupModulos').click(function () {
    fecharFormulario('modulos');
});

// Quando o botão de adicionar modulo for clicado
$('#add-modulo').click(function () {
    $('#modulos-list').hide();
    $('#add-modulo-form').show(); // Exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupModulo').click(function () {
    $('#add-modulo-form').hide();
    $('#modulos-list').show();
});

// Quando os botões de editar modulo for clicado
$('.editar-modulo').click(function () {
    const moduloId = $(this).data('id'); // Obtém o ID da módulo do atributo data-id

    $('#idModulo').val(moduloId);

    // Encontra módulo correspondente
    const modulo = encontrarPorId(moduloId, modulosArray);

    // Verifique se módulo é definido e possui as propriedades 'nome' e 'descricao'
    if (modulo) {
        // Preenche os campos do popup com os valores do módulo
        $('#nomeModuloEdit').val(modulo['nome']);
    } else {
        console.error('Módulo não encontrado ou propriedades ausentes.');
    }

    $('#modulos-list').hide();
    $('#edit-modulo-form').show();
});

// Quando o botão de fechar for clicado
$('#closePopupModuloEdit').click(function () {
    $('#edit-modulo-form').hide();
    $('#modulos-list').show();
});

//TRILHAS

$('#editar-trilhas').click(function () {
    exibirFormulario('trilhas'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupTrilhas').click(function () {
    fecharFormulario('trilhas');
});

// Quando o botão de adicionar trilha for clicado
$('#add-trilha').click(function () {
    $('#trilhas-list').hide();
    $('#add-trilha-form').show(); // Exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupTrilha').click(function () {
    $('#add-trilha-form').hide();
    $('#trilhas-list').show();
});

// Quando os botões de editar trilha for clicado
$('.editar-trilha').click(function () {
    const trilhaId = $(this).data('id'); // Obtém o ID da trilha do atributo data-id

    $('#idTrilha').val(trilhaId);

    // Encontra trilha correspondente
    const trilha = encontrarPorId(trilhaId, trilhasArray);

    // Verifica se trilha é definida e possui as propriedades 'nome' e 'descricao'
    if (trilha) {
        // Preenche os campos do popup com os valores da trilha
        $('#nomeTrilhaEdit').val(trilha['nome_trilha']);
        $('#descricaoTrilhaEdit').val(trilha['descricao_trilha']);

        // Marca as caixas de seleção dos módulos da trilha
        trilha['modulos'].forEach(modulo => {
            $('input[type="checkbox"][value="' + modulo['id'] + '"]').prop('checked', true);
        });
    } else {
        console.error('Trilha não encontrada ou propriedades ausentes.');
    }

    $('#trilhas-list').hide();
    $('#edit-trilha-form').show();
});

// Quando o botão de fechar for clicado
$('#closePopupTrilhaEdit').click(function () {
    $('#edit-trilha-form').hide();
    $('#trilhas-list').show();
});

//BANNERS

$('#editar-banners').click(function () {
    exibirFormulario('banners'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupBanners').click(function () {
    fecharFormulario('banners');
});

// Quando o botão de adicionar banner for clicado
$('#add-banner').click(function () {
    $('#banners-list').hide();
    $('#addBanner').show(); // Exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupAddBanner').click(function () {
    $('#addBanner').hide();
    $('#banners-list').show();
});

// Quando os botões de editar banner for clicado
$('.editar-banner').click(function () {
    const bannerId = $(this).data('id'); // Obtém o ID do banner do atributo data-id

    $('#idBanner').val(bannerId);

    // Encontra banner correspondente
    const banner = encontrarPorId(bannerId, bannersArray);

    // Verifica se banner é definido e possui as propriedades 'nome_banner', 'botao_acao', 'texto_botao' e 'link_botao'
    if (banner) {
        // Preenche os campos do popup com os valores do banner
        $('#nomeBannerEdit').val(banner['nome_banner']);
        if (banner['botao_acao'] == 1) {
            $('#acao-btn-checkbox-edit').prop('checked', true);
            $('#textoBotaoEdit').val(banner['texto_botao']).prop('disabled', false);
            $('#linkBotaoEdit').val(banner['link_botao']).prop('disabled', false);
        } else {
            $('#acao-btn-checkbox-edit').prop('checked', false);
            $('#textoBotaoEdit').val('').prop('disabled', true);
            $('#linkBotaoEdit').val('').prop('disabled', true);
        }
    } else {
        console.error('Banner não encontrado ou propriedades ausentes.');
    }

    $('#banners-list').hide();
    $('#editBanner').show();
});

// Quando o botão de fechar for clicado
$('#closePopupBannerEdit').click(function () {
    $('#editBanner').hide();
    $('#banners-list').show();
});

//LANÇAMENTOS

$('#editar-lancamentos').click(function () {
    exibirFormulario('lancamentos'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopuplancamentos').click(function () {
    fecharFormulario('lancamentos');
});

// Quando o botão de adicionar lançamento for clicado
$('#add-lancamento').click(function () {
    $('#lancamentos-list').hide();
    $('#addLancamento').show(); // Exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupAddLancamento').click(function () {
    $('#addLancamento').hide();
    $('#lancamentos-list').show();
});

// Quando os botões de editar lançamento for clicado
$('.editar-lancamento').click(function () {
    const lancamentoId = $(this).data('id'); // Obtém o ID do lançamento do atributo data-id

    $('#idLancamento').val(lancamentoId);

    // Encontra lançamento correspondente
    const lancamento = encontrarPorId(lancamentoId, lancamentosArray);

    // Verifica se lançamento é definido e possui as propriedades 'nome' e 'link'
    if (lancamento) {
        // Preenche os campos do popup com os valores do lançamento
        $('#nomeLancamentoEdit').val(lancamento['nome']);
        $('#linkLancamentoEdit').val(lancamento['link_url']);
    } else {
        console.error('Lançamento não encontrado ou propriedades ausentes.');
    }

    $('#lancamentos-list').hide();
    $('#editLancamento').show();
});

// Quando o botão de fechar for clicado
$('#closePopupLancamentoEdit').click(function () {
    $('#editLancamento').hide();
    $('#lancamentos-list').show();
});

//USUÁRIOS

// Quando o botão de adicionar aula for clicado
$('#add-user').click(function () {
    exibirFormulario('add-user'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupUsuario').click(function () {
    fecharFormulario('add-user');
});

// Quando os botões de editar usuário for clicado
$('#usuarios').on('click', '.editar-user', function () {
    const userId = $(this).data('id'); // Obtém o ID do usuário do atributo data-id

    $('#idUser').val(userId);

    // Encontra usuário correspondente
    const user = encontrarPorId(userId, users);

    // Verifique se usuário é definido e possui as propriedades
    if (user) {
        // Preenche os campos do popup com os valores do usuário
        $('#nomeEdit').val(user['nome']);
        $('#emailEdit').val(user['email']);
        $('#whatsappEdit').val(user['whatsapp']);
        $('#nascimentoEdit').val(user['nascimento']);
        if (user['adm'] === "1" && user['instrutor'] === "0") {
            $('#administradorEdit').prop('checked', true);
        } else if (user['adm'] === "1" && user['instrutor'] === "1") {
            $('#instrutorEdit').prop('checked', true);
        } else {
            $('#alunoEdit').prop('checked', true);
        }
        if (user['plano'] === "0") {
            $('#statusEdit').prop('checked', false);
        } else {
            $('#statusEdit').prop('checked', true);
        }
    } else {
        console.error('Usuário não encontrada ou propriedades ausentes.');
    }

    exibirFormulario('edit-user');
});

// Quando o botão de fechar for clicado
$('#closePopupUsuarioEdit').click(function () {
    fecharFormulario('edit-user');
});

//INTEGRAÇÃO OAUTH

// Quando o botão da integracao for clicado
$('#integracoes').on('click', '.integracao', function () {

    const integracao = $(this).data('id');
    $('#plataforma_oauth').val(integracao);
    const integracaoData = integracoes[integracao];

    const popup = $('#oauth-integracao');
    const popupContent = popup.find('.popup-content');

    // Substitui os dados da integração no HTML do popup
    popupContent.find('.integracao-logo img').attr('src', integracaoData.img);
    popupContent.find('.integracao-logo img').attr('alt', integracaoData.nome);
    popupContent.find('.int-info h5').text(integracaoData.titulo);
    popupContent.find('.int-info p').text(integracaoData.texto);
    popupContent.find('.auth-btn').text(integracaoData.botao);

    exibirFormulario('oauth-int'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupIntAuth').click(function () {
    fecharFormulario('oauth-int');
});

//PROVAS

$('#novaProva').click(function () {
    exibirFormulario('add-prova'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupAddProva').click(function () {
    fecharFormulario('add-prova');
});

// Quando os botões de editar prova for clicado
$('#provas').on('click', '.editar-prova', function () {
    const provaId = $(this).data('id'); // Obtém o ID da prova do atributo data-id

    $('#idProva').val(provaId);

    // Encontra prova correspondente
    const prova = encontrarPorId(provaId, provasArray);

    // Verifique se prova é definida e possui as propriedades
    if (prova) {
        // Preenche os campos do popup com os valores da prova
        $('#nomeProvaEdit').val(prova['titulo']);
        if (prova['prazo'] !== null) {
            // Separar data e hora
            const prazoData = prova['prazo'].split(' ')[0];
            const prazoHora = prova['prazo'].split(' ')[1];

            $('#toggle-prazo-edit').addClass('active');
            $('#toggle-prazo-edit').addClass('active');
            $('#prazoFinalEdit').val(prazoData).prop('disabled', false).prop('required', true); // Preencher campo de data e remover disabled e adicionar required
            $('#horaPrazoFinalEdit').val(prazoHora).prop('disabled', false).prop('required', true); // Preencher campo de hora e remover disabled e adicionar required
        }
        $('#tempoRealizacaoEdit').val(prova['tempo_limite']);
        $('#numeroTentativasEdit').val(prova['numero_tentativas']);
        $('#pontuacaoMinimaEdit').val(prova['pontuacao_minima']);
        if (prova['descricao'] !== null) {
            $('#descricaoProvaEdit').val(prova['descricao']);
        }
    } else {
        console.error('Prova não encontrada ou propriedades ausentes.');
    }

    exibirFormulario('edit-prova');
});

// Quando o botão de fechar for clicado
$('#closePopupEditProva').click(function () {
    fecharFormulario('edit-prova');
});

// Função para encontrar aula por ID
function encontrarPorId(id, data) {
    // Obtém as aulas da variável JavaScript aulasData
    const objetos = data;

    // Encontra a aula correspondente com base no ID
    const objeto = objetos.find(function (objeto) {
        return objeto.id == id;
    });

    return objeto;
}

// Função para exibir o formulário
function exibirFormulario(option) {
    if (option === 'add-aula') {
        $('#add').show();
    } else if (option === 'edit-aula') {
        $('#edit').show();
    } else if (option === 'modulos') {
        $('#modulos-list').show();
    } else if (option === 'trilhas') {
        $('#trilhas-list').show();
    } else if (option === 'banners') {
        $('#banners-list').show();
    } else if (option === 'lancamentos') {
        $('#lancamentos-list').show();
    } else if (option === 'add-user') {
        $('#add-usuario').show();
    } else if (option === 'edit-user') {
        $('#edit-usuario').show();
    } else if (option === 'oauth-int') {
        $('#oauth-integracao').show();
    } else if (option === 'add-prova') {
        $('#addProva').show();
    } else if (option === 'edit-prova') {
        $('#editProva').show();
    }
    $('.scrollbar-container').addClass('blur');
    $('.whatsapp-button').addClass('blur');
    $('body').css('overflow', 'hidden'); // Impede o scroll da página
}

// Função para exibir o formulário
function fecharFormulario(option) {
    if (option === 'add-aula') {
        $('#add').hide();
    } else if (option === 'edit-aula') {
        $('#edit').hide();
    } else if (option === 'modulos') {
        $('#modulos-list').hide();
    } else if (option === 'trilhas') {
        $('#trilhas-list').hide();
    } else if (option === 'banners') {
        $('#banners-list').hide();
    } else if (option === 'lancamentos') {
        $('#lancamentos-list').hide();
    } else if (option === 'add-user') {
        $('#add-usuario').hide();
    } else if (option === 'edit-user') {
        $('#edit-usuario').hide();
    } else if (option === 'oauth-int') {
        $('#oauth-integracao').hide();
    } else if (option === 'add-prova') {
        $('#addProva').hide();
    } else if (option === 'edit-prova') {
        $('#editProva').hide();
    }
    $('.scrollbar-container').removeClass('blur');
    $('.whatsapp-button').removeClass('blur');
    $('body').css('overflow', 'auto'); // Restaura o scroll da página
}

// Evento de envio do formulário
$('#aulaFormAdd').submit(function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this); // Crie um objeto FormData com os dados do formulário

    $.ajax({
        type: 'POST',
        url: this.action, // URL de destino do formulário
        data: formData, // Dados do formulário
        processData: false,
        contentType: false,
        success: function (response) {
            // A resposta do servidor foi recebida e processada com sucesso.
            // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
            fecharFormulario('add-aula');
            console.log('Resposta do servidor:', response);
        },
        error: function () {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#aulaFormEdit').submit(function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this); // Crie um objeto FormData com os dados do formulário

    $.ajax({
        type: 'POST',
        url: this.action, // URL de destino do formulário
        data: formData, // Dados do formulário
        processData: false,
        contentType: false,
        success: function (response) {
            // A resposta do servidor foi recebida e processada com sucesso.
            // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
            fecharFormulario('edit-aula');
            console.log('Resposta do servidor:', response);
        },
        error: function () {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#moduloFormAdd').submit(function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this); // Crie um objeto FormData com os dados do formulário

    $.ajax({
        type: 'POST',
        url: this.action, // URL de destino do formulário
        data: formData, // Dados do formulário
        processData: false,
        contentType: false,
        success: function (response) {
            // A resposta do servidor foi recebida e processada com sucesso.
            // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
            $('#add-modulo-form').hide();
            console.log('Resposta do servidor:', response);
        },
        error: function () {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#moduloFormEdit').submit(function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this); // Crie um objeto FormData com os dados do formulário

    $.ajax({
        type: 'POST',
        url: this.action, // URL de destino do formulário
        data: formData, // Dados do formulário
        processData: false,
        contentType: false,
        success: function (response) {
            // A resposta do servidor foi recebida e processada com sucesso.
            // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
            $('#edit-modulo-form').hide();
            console.log('Resposta do servidor:', response);
        },
        error: function () {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});