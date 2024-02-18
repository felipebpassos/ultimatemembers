$(document).ready(function () {

    $('.aulas').on('click', '.excluir-aula', function () {
        const idAula = $(this).data('id');
        // Define o ID da aula no popup de confirmação.
        $('#confirmacao').data('id-aula', idAula);

        $('#confirmacao-form').attr('action', url_principal + 'modulos/deletar_aula/');

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir a aula?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a exclusão de um módulo
    $('#modulos-list').on('click', '.delete-modulo', function () {
        const idModulo = $(this).data('id');
        // Define o ID do módulo no popup de confirmação.
        $('#confirmacao').data('id-modulo', idModulo);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os botões ao formulário
        $('#confirmacao-form').append(confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'modulos/deletar_modulo/');

        $('#modulos-list').hide();
        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir o módulo?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a exclusão de uma trilha
    $('#trilhas-list').on('click', '.delete-trilha', function () {
        const idTrilha = $(this).data('id');
        // Define o ID da trilha no popup de confirmação.
        $('#confirmacao').data('id-trilha', idTrilha);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os botões ao formulário
        $('#confirmacao-form').append(confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'modulos/deletar_trilha/');

        $('#trilhas-list').hide();
        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir a trilha?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a exclusão de um lançamento
    $('#lancamentos-list').on('click', '.delete-lancamento', function () {
        const idLancamento = $(this).data('id');
        // Define o ID do lançamento no popup de confirmação.
        $('#confirmacao').data('id-lancamento', idLancamento);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os botões ao formulário
        $('#confirmacao-form').append(confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'painel/deletar_lancamento/');

        $('#lancamentos-list').hide();
        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir lançamento?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a exclusão de uma integracao
    $('.integracao-instalada').on('click', '.delete-integracao', function () {
        const idIntegracao = $(this).data('id');
        // Define o ID do módulo no popup de confirmação.
        $('#confirmacao').data('id-integracao', idIntegracao);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os botões ao formulário
        $('#confirmacao-form').append(confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'auth/deletar_integracao/');

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir integração?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a exclusão de um comentario
    $('.op-comentario').on('click', '.deletar-comentario', function () {
        const idComentario = $(this).data('id');
        // Define o ID do módulo no popup de confirmação.
        $('#confirmacao').data('id-comentario', idComentario);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os botões ao formulário
        $('#confirmacao-form').append(confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'modulos/deletar_comentario/');

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir comentário?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('.usuarios').on('click', '.delete-user', function () {
        const idUser = $(this).data('id');
        // Define o ID do usuario no popup de confirmação.
        $('#confirmacao').data('id-user', idUser);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        // Adiciona dinamicamente os campos de email e senha
        const emailField = $('<div class="campo-popup"> \
                            <input type="email" id="adminEmail" name="adminEmail" class="campo-input" placeholder="E-mail de administrador" required> \
                        </div>');

        const passwordField = $('<div class="campo-popup"> \
                                <input type="password" id="adminPassword" name="adminPassword" class="campo-input" placeholder="Senha" required> \
                                <span class="olho" onclick="togglePasswordVisibility(\'adminPassword\', \'togglePassword\')"> \
                                    <i class="fa-solid fa-eye-slash" id="togglePassword"></i> \
                                </span> \
                            </div>');

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os campos ao formulário
        $('#confirmacao-form').append(emailField, passwordField, confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'painel/deletar_user/');

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja remover usuário?');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('.popup').on('click', '.btn-deletar', function () {
        const action = $('#confirmacao-form').attr('action'); // Obtém a ação do formulário
        const formData = {};

        // Obtem os campos do formulário
        const emailField = $('#adminEmail');
        const passwordField = $('#adminPassword');

        // Verifica se os campos obrigatórios estão preenchidos
        if (action.includes('deletar_user') && (!emailField.val() || !passwordField.val())) {
            // Campos obrigatórios não preenchidos, exibe uma mensagem de erro ou toma a ação apropriada
            alert('Para excluir um usuário, é necessário fornecer o email e a senha de administrador.');
            return; // Impede o envio do formulário
        }

        // Adiciona os dados do formulário ao objeto formData
        $('#confirmacao-form input').each(function () {
            formData[$(this).attr('id')] = $(this).val();
        });

        formData['idUser'] = $('#confirmacao').data('id-user');
        formData['idAula'] = $('#confirmacao').data('id-aula');
        formData['idModulo'] = $('#confirmacao').data('id-modulo');
        formData['idIntegracao'] = $('#confirmacao').data('id-integracao');
        formData['idComentario'] = $('#confirmacao').data('id-comentario');
        formData['idTrilha'] = $('#confirmacao').data('id-trilha');
        formData['idLancamento'] = $('#confirmacao').data('id-lancamento');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                $('#confirmacao').hide();
                $('.scrollbar-container, .whatsapp-button').removeClass('blur');
                $('body').css('overflow', 'auto'); // Restaura o scroll da página

                console.log(response);
            },
            error: function () {
                // Lida com erros de solicitação
                console.error('Erro na solicitação AJAX');
            }
        });
    });

    $('.popup').on('click', '#btn-cancelar', function () {
        // Fecha o popup de confirmação.
        $('#confirmacao').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });

    $('.popup').on('click', '#closeDelPopup', function () {
        // Fecha o popup de confirmação.
        $('#confirmacao').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });
});