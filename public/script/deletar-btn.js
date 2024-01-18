$(document).ready(function () {

    $('.aulas').on('click', '.excluir-aula', function () {
        const idAula = $(this).data('id');
        // Define o ID da aula no popup de confirmação.
        $('#confirmacao').data('id-aula', idAula);

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir a aula?');
        $('header, main, footer, .video-intro-container').addClass('blur');
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
                            <label for="adminEmail">E-mail de Administrador:</label> \
                            <input type="email" id="adminEmail" class="campo-input" required> \
                        </div>');

        const passwordField = $('<div class="campo-popup"> \
                                <label for="adminPassword">Senha de Administrador:</label> \
                                <div class="input-group"> \
                                    <input type="password" id="adminPassword" class="campo-input" required> \
                                    <span class="olho" onclick="togglePasswordVisibility(\'adminPassword\', \'togglePassword\')"> \
                                        <i class="fa-solid fa-eye-slash" id="togglePassword"></i> \
                                    </span> \
                                </div> \
                            </div>');

        const confirmButton = $('<button type="submit" class="btn-2">Confirmar Remoção</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os campos ao formulário
        $('#confirmacao-form').append(emailField, passwordField, confirmButton, cancelButton);

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja remover usuário?');
        $('header, main, footer, .video-intro-container').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('#btn-deletar').click(function () {
        const idAula = $('#confirmacao').data('id-aula');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: url_principal + 'modulos/deletar_aula/',
            data: { idAula: idAula },
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                $('#confirmacao').hide();
                $('header, main, footer, .video-intro-container').removeClass('blur');
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
        $('header, main, footer, .video-intro-container').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });
});