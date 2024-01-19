$(document).ready(function () {

    $('.aulas').on('click', '.excluir-aula', function () {
        const idAula = $(this).data('id');
        // Define o ID da aula no popup de confirmação.
        $('#confirmacao').data('id-aula', idAula);

        $('#confirmacao-form').attr('action', url_principal + 'modulos/deletar_aula/');

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir a aula?');
        $('.scrollbar-container, header, main, footer, .video-intro-container').addClass('blur');
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
        $('.scrollbar-container, header, main, footer, .video-intro-container').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('.popup').on('click', '.btn-deletar', function () {
        const action = $('#confirmacao-form').attr('action'); // Obtém a ação do formulário
        const formData = {};

        // Obtem os campos do formulário
        const emailField = $('#adminEmail');
        const passwordField = $('#adminPassword');

        // Verifica se os campos obrigatórios estão preenchidos
        if (!emailField.val() || !passwordField.val()) {
            // Campos obrigatórios não preenchidos, exibe uma mensagem de erro ou toma a ação apropriada
            alert('É necessário a permissão de administrador. Por favor, forneça um email e senha.');
            return; // Impede o envio do formulário
        }

        // Adiciona os dados do formulário ao objeto formData
        $('#confirmacao-form input').each(function () {
            formData[$(this).attr('id')] = $(this).val();
        });

        formData['idUser'] = $('#confirmacao').data('id-user');
        formData['idAula'] = $('#confirmacao').data('id-aula');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                $('#confirmacao').hide();
                $('.scrollbar-container, header, main, footer, .video-intro-container').removeClass('blur');
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
        $('.scrollbar-container, header, main, footer, .video-intro-container').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });

    $('.popup').on('click', '#closeDelPopup', function () {
        // Fecha o popup de confirmação.
        $('#confirmacao').hide();
        $('.scrollbar-container, header, main, footer, .video-intro-container').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });
});